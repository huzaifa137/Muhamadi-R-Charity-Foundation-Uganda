<?php

namespace Tests\Feature;

use App\Mail\AdminPasswordResetMail;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AdminHardeningTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(string $email = 'owner@example.test', bool $active = true, string $password = 'old-secret'): int
    {
        return DB::table('admins')->insertGetId([
            'name' => 'Test Administrator',
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'super_admin',
            'is_active' => $active,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function test_every_protected_admin_route_uses_the_shared_admin_middleware(): void
    {
        $open = ['admin.login', 'admin.login.submit', 'admin.logout', 'admin.password.request', 'admin.password.email', 'admin.password.reset', 'admin.password.update'];
        $checked = 0;

        foreach (Route::getRoutes() as $route) {
            $name = $route->getName();
            if (!$name || !str_starts_with($name, 'admin.') || in_array($name, $open, true)) {
                continue;
            }
            $checked++;
            $this->assertContains('admin.auth', $route->gatherMiddleware(), "Route {$name} is missing the admin.auth middleware.");
        }

        $this->assertGreaterThan(20, $checked);
    }

    public function test_signed_out_visitor_is_sent_to_sign_in_with_a_message(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'))
            ->assertSessionHas('status', 'Please sign in to continue.');
    }

    public function test_protected_admin_pages_are_not_cacheable(): void
    {
        $adminId = $this->createAdmin();

        $response = $this->withSession(['charity_admin_id' => $adminId])->get(route('admin.dashboard'));

        $response->assertOk();
        $this->assertStringContainsString('no-store', (string) $response->headers->get('Cache-Control'));
    }

    public function test_admin_sign_in_page_links_to_a_working_forgot_password_page(): void
    {
        $this->get(route('admin.login'))->assertOk()->assertSee(route('admin.password.request'), false);
        $this->get(route('admin.password.request'))->assertOk()->assertSee('Send reset link');
    }

    public function test_admin_can_reset_password_with_emailed_link_once(): void
    {
        Mail::fake();
        $this->createAdmin('owner@example.test');

        $this->post(route('admin.password.email'), ['email' => 'owner@example.test'])->assertSessionHasNoErrors();

        $url = null;
        Mail::assertSent(AdminPasswordResetMail::class, function ($mail) use (&$url) {
            $url = $mail->url;
            return $mail->hasTo('owner@example.test');
        });

        parse_str((string) parse_url($url, PHP_URL_QUERY), $query);
        $token = basename((string) parse_url($url, PHP_URL_PATH));
        $this->assertSame('owner@example.test', $query['email']);

        $payload = ['token' => $token, 'email' => 'owner@example.test', 'password' => '4321', 'password_confirmation' => '4321'];
        $this->post(route('admin.password.update'), $payload)->assertRedirect(route('admin.login'));

        $this->assertTrue(Hash::check('4321', DB::table('admins')->where('email', 'owner@example.test')->value('password')));
        $this->assertDatabaseMissing('admin_password_reset_tokens', ['email' => 'owner@example.test']);
        $this->assertDatabaseHas('admin_activity_logs', ['action' => 'admin.password_reset_completed']);

        // The same link cannot be used twice.
        $this->post(route('admin.password.update'), $payload)->assertSessionHasErrors('email');
    }

    public function test_admin_reset_does_not_reveal_whether_an_email_exists(): void
    {
        Mail::fake();
        $this->createAdmin('inactive@example.test', false);

        $this->post(route('admin.password.email'), ['email' => 'nobody@example.test'])
            ->assertSessionHas('status');
        $this->post(route('admin.password.email'), ['email' => 'inactive@example.test'])
            ->assertSessionHas('status');

        Mail::assertNothingSent();
    }

    public function test_admin_reset_link_expires_and_rejects_wrong_tokens(): void
    {
        Mail::fake();
        $this->createAdmin('owner@example.test');
        $this->post(route('admin.password.email'), ['email' => 'owner@example.test']);

        $token = null;
        Mail::assertSent(AdminPasswordResetMail::class, function ($mail) use (&$token) {
            $token = basename((string) parse_url($mail->url, PHP_URL_PATH));
            return true;
        });

        $good = ['email' => 'owner@example.test', 'password' => '4321', 'password_confirmation' => '4321'];

        $this->post(route('admin.password.update'), $good + ['token' => 'wrong-token'])->assertSessionHasErrors('email');

        $this->travel(61)->minutes();
        $this->post(route('admin.password.update'), $good + ['token' => $token])->assertSessionHasErrors('email');
        $this->assertTrue(Hash::check('old-secret', DB::table('admins')->where('email', 'owner@example.test')->value('password')));
    }

    public function test_admin_reset_requires_a_matching_password_of_at_least_four_characters(): void
    {
        Mail::fake();
        $this->createAdmin('owner@example.test');
        $this->post(route('admin.password.email'), ['email' => 'owner@example.test']);
        $token = null;
        Mail::assertSent(AdminPasswordResetMail::class, function ($mail) use (&$token) {
            $token = basename((string) parse_url($mail->url, PHP_URL_PATH));
            return true;
        });

        $this->post(route('admin.password.update'), ['token' => $token, 'email' => 'owner@example.test', 'password' => 'abc', 'password_confirmation' => 'abc'])
            ->assertSessionHasErrors('password');
        $this->post(route('admin.password.update'), ['token' => $token, 'email' => 'owner@example.test', 'password' => 'abcd', 'password_confirmation' => 'different'])
            ->assertSessionHasErrors('password');
    }

    public function test_public_user_can_reset_password_with_emailed_link(): void
    {
        Notification::fake();
        $user = User::create(['name' => 'Member', 'email' => 'member@example.test', 'password' => 'old-secret']);

        $this->get(route('login'))->assertSee(route('password.request'), false);
        $this->post(route('password.email'), ['email' => 'member@example.test'])->assertSessionHas('status');

        $token = null;
        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use (&$token) {
            $token = $notification->token;
            return true;
        });

        $this->post(route('password.update'), [
            'token' => $token, 'email' => 'member@example.test', 'password' => '2468', 'password_confirmation' => '2468',
        ])->assertRedirect(route('login'));

        $this->assertTrue(Hash::check('2468', $user->fresh()->password));
    }

    public function test_public_reset_for_unknown_email_gives_same_answer_and_sends_nothing(): void
    {
        Notification::fake();

        $this->post(route('password.email'), ['email' => 'nobody@example.test'])->assertSessionHas('status');

        Notification::assertNothingSent();
    }

    public function test_sign_out_button_is_not_hidden_on_phones(): void
    {
        $css = file_get_contents(public_path('admin-static/css/admin.css'));

        $this->assertStringNotContainsString('.top-actions .btn-outline{display:none}', $css);
        $this->assertStringContainsString('.top-actions a.btn-outline{display:none}', $css);
    }

    public function test_views_contain_no_garbled_characters_or_byte_order_marks(): void
    {
        $bad = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(resource_path('views')));
        foreach ($iterator as $file) {
            if (!$file->isFile() || !str_ends_with($file->getFilename(), '.blade.php')) {
                continue;
            }
            $text = file_get_contents($file->getPathname());
            if (str_starts_with($text, "\xEF\xBB\xBF") || preg_match('/Â|â€|ðŸ|â†/u', $text)) {
                $bad[] = str_replace(base_path().DIRECTORY_SEPARATOR, '', $file->getPathname());
            }
        }

        $this->assertSame([], $bad, 'Garbled characters or BOM found in: '.implode(', ', $bad));
    }
}
