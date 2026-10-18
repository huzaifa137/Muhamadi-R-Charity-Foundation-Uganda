<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Support\FoundationNotifier;
use Illuminate\View\View;

class OperationsController extends Controller
{
    private const CONTENT_ROLES = ['super_admin', 'administrator', 'content_manager'];
    private const RECORD_ROLES = ['super_admin', 'administrator', 'content_manager', 'finance_manager'];
    private const VOLUNTEER_ROLES = ['super_admin', 'administrator', 'content_manager', 'finance_manager', 'volunteer_coordinator'];
    private const FINANCE_ROLES = ['super_admin', 'administrator', 'finance_manager'];

    private function config(string $module): array
    {
        $configs = [
            'donations' => ['table' => 'donations', 'title' => 'Donations', 'description' => 'Donor records, payment reconciliation and printable receipts.', 'roles' => self::FINANCE_ROLES, 'fields' => [
                ['name'=>'donor_name','label'=>'Donor name','type'=>'text','required'=>true], ['name'=>'email','label'=>'Email','type'=>'email'], ['name'=>'phone','label'=>'Phone','type'=>'text'],
                ['name'=>'amount','label'=>'Amount','type'=>'number','required'=>true], ['name'=>'currency','label'=>'Currency','type'=>'text','required'=>true], ['name'=>'payment_method','label'=>'Payment method','type'=>'text','required'=>true],
                ['name'=>'payment_status','label'=>'Payment status','type'=>'select','options'=>['pending'=>'Pending','paid'=>'Paid','failed'=>'Failed','refunded'=>'Refunded'],'required'=>true],
                ['name'=>'reference','label'=>'Payment reference','type'=>'text'], ['name'=>'donation_date','label'=>'Donation date','type'=>'date'], ['name'=>'admin_notes','label'=>'Internal notes','type'=>'textarea'],
            ]],
            'impact' => ['table' => 'impact_records', 'title' => 'Projects & impact', 'description' => 'Publish project progress and outcome information. Beneficiary figures should be evidence-backed.', 'roles' => self::CONTENT_ROLES, 'fields' => [
                ['name'=>'title','label'=>'Project / impact title','type'=>'text','required'=>true], ['name'=>'slug','label'=>'URL slug (optional)','type'=>'text'], ['name'=>'category','label'=>'Category','type'=>'text'], ['name'=>'location','label'=>'Location','type'=>'text'],
                ['name'=>'summary','label'=>'Public summary','type'=>'textarea','required'=>true], ['name'=>'description','label'=>'Description / progress notes','type'=>'textarea','required'=>true],
                ['name'=>'beneficiaries_count','label'=>'Verified beneficiaries (leave blank if unknown)','type'=>'number'], ['name'=>'outcome','label'=>'Outcome / evidence notes','type'=>'textarea'],
                ['name'=>'image_path','label'=>'Image path (optional)','type'=>'text'], ['name'=>'start_date','label'=>'Start date','type'=>'date'], ['name'=>'end_date','label'=>'End date','type'=>'date'],
                ['name'=>'status','label'=>'Publication status','type'=>'select','options'=>['draft'=>'Draft','published'=>'Published'],'required'=>true], ['name'=>'sort_order','label'=>'Display order','type'=>'number','required'=>true],
            ]],
            'stories' => ['table' => 'stories', 'title' => 'Stories & news', 'description' => 'Manage approved articles, field stories and announcements.', 'roles' => self::CONTENT_ROLES, 'fields' => [
                ['name'=>'title','label'=>'Title','type'=>'text','required'=>true], ['name'=>'slug','label'=>'URL slug (optional)','type'=>'text'], ['name'=>'excerpt','label'=>'Short summary','type'=>'textarea','required'=>true],
                ['name'=>'body','label'=>'Article body','type'=>'textarea','required'=>true], ['name'=>'category','label'=>'Category','type'=>'text'], ['name'=>'author_name','label'=>'Author / contributor','type'=>'text'],
                ['name'=>'image_path','label'=>'Image path (optional)','type'=>'text'], ['name'=>'status','label'=>'Publication status','type'=>'select','options'=>['draft'=>'Draft','published'=>'Published'],'required'=>true],
            ]],
            'gallery' => ['table' => 'gallery_items', 'title' => 'Gallery management', 'description' => 'Upload, caption, categorise and publish approved photographs.', 'roles' => self::CONTENT_ROLES, 'fields' => [
                ['name'=>'title','label'=>'Image title','type'=>'text','required'=>true], ['name'=>'caption','label'=>'Caption','type'=>'textarea'], ['name'=>'alt_text','label'=>'Accessibility alt text','type'=>'text','required'=>true],
                ['name'=>'category','label'=>'Category','type'=>'text'], ['name'=>'image_path','label'=>'Image file (JPEG, PNG, WebP; max 5 MB)','type'=>'file'], ['name'=>'status','label'=>'Publication status','type'=>'select','options'=>['draft'=>'Draft','published'=>'Published'],'required'=>true], ['name'=>'sort_order','label'=>'Display order','type'=>'number','required'=>true],
            ]],
            'volunteers' => ['table' => 'volunteer_applications', 'title' => 'Volunteer applications', 'description' => 'Review applications and record follow-up decisions.', 'roles' => self::VOLUNTEER_ROLES, 'fields' => [
                ['name'=>'name','label'=>'Applicant name','type'=>'text','required'=>true], ['name'=>'email','label'=>'Email','type'=>'email','required'=>true], ['name'=>'phone','label'=>'Phone','type'=>'text'],
                ['name'=>'area_of_interest','label'=>'Area of interest','type'=>'text','required'=>true], ['name'=>'availability','label'=>'Availability','type'=>'text'], ['name'=>'experience','label'=>'Experience / skills','type'=>'textarea'],
                ['name'=>'motivation','label'=>'Motivation','type'=>'textarea','required'=>true], ['name'=>'status','label'=>'Review status','type'=>'select','options'=>['new'=>'New','reviewing'=>'Reviewing','approved'=>'Approved','declined'=>'Declined'],'required'=>true], ['name'=>'admin_notes','label'=>'Internal review notes','type'=>'textarea'],
            ]],
            'enquiries' => ['table' => 'contact_enquiries', 'title' => 'Contact & enquiries', 'description' => 'Track messages from the public and document follow-up.', 'roles' => self::RECORD_ROLES, 'fields' => [
                ['name'=>'name','label'=>'Sender name','type'=>'text','required'=>true], ['name'=>'email','label'=>'Email','type'=>'email','required'=>true], ['name'=>'phone','label'=>'Phone','type'=>'text'],
                ['name'=>'subject','label'=>'Subject','type'=>'text','required'=>true], ['name'=>'message','label'=>'Message','type'=>'textarea','required'=>true],
                ['name'=>'status','label'=>'Enquiry status','type'=>'select','options'=>['new'=>'New','in_progress'=>'In progress','responded'=>'Responded','closed'=>'Closed'],'required'=>true], ['name'=>'admin_notes','label'=>'Internal notes','type'=>'textarea'], ['name'=>'response_notes','label'=>'Response / follow-up notes','type'=>'textarea'],
            ]],
        ];

        abort_unless(isset($configs[$module]), 404);
        return $configs[$module] + ['key' => $module];
    }

    private function currentAdmin(array $config): object
    {
        $admin = DB::table('admins')->where('id', session('charity_admin_id'))->where('is_active', true)->first();
        abort_unless($admin, 403, 'An active administrator sign-in is required.');
        abort_unless(in_array($admin->role, $config['roles'], true), 403, 'Your role cannot manage this section.');
        return $admin;
    }

    private function log(object $admin, string $module, string $action, int $id, array $details = []): void
    {
        DB::table('admin_activity_logs')->insert([
            'admin_id' => $admin->id, 'action' => $module.'.'.$action, 'subject_type' => $module,
            'subject_id' => $id, 'details' => json_encode($details), 'ip_address' => request()->ip(),
            'created_at' => now(), 'updated_at' => now(),
        ]);
    }

    public function index(string $module): View
    {
        $config = $this->config($module);
        $admin = $this->currentAdmin($config);
        $records = DB::table($config['table'])->orderByDesc('id')->paginate(15)->withQueryString();
        return view('admin.operations.index', ['config' => $config, 'records' => $records, 'adminRole' => $admin->role]);
    }

    public function create(string $module): View
    {
        $config = $this->config($module);
        $admin = $this->currentAdmin($config);
        return view('admin.operations.form', ['config' => $config, 'record' => null, 'adminRole' => $admin->role]);
    }

    public function store(Request $request, string $module): RedirectResponse
    {
        $config = $this->config($module);
        $admin = $this->currentAdmin($config);
        if (in_array($module, ['impact', 'stories'], true)) $request->merge(['slug' => Str::slug((string) ($request->input('slug') ?: $request->input('title')))]);
        $data = $this->validated($request, $config, null);
        $data = $this->prepare($request, $config, $data, null);
        $data['created_at'] = now();
        $data['updated_at'] = now();
        $id = DB::table($config['table'])->insertGetId($data);
        if ($module === 'donations' && ($data['payment_status'] ?? '') === 'paid' && empty($data['receipt_number'] ?? null)) {
            $receipt = 'MRF-'.now()->format('Ymd').'-'.str_pad((string) $id, 6, '0', STR_PAD_LEFT);
            DB::table('donations')->where('id', $id)->update(['receipt_number' => $receipt, 'updated_at' => now()]);
        }
        $this->log($admin, $module, 'created', $id, ['status' => $data['status'] ?? $data['payment_status'] ?? 'recorded']);
        return redirect()->route('admin.operations.index', $module)->with('status', $config['title'].' record created.');
    }

    public function edit(string $module, int $id): View
    {
        $config = $this->config($module);
        $admin = $this->currentAdmin($config);
        $record = DB::table($config['table'])->where('id', $id)->first();
        abort_unless($record, 404);
        return view('admin.operations.form', ['config' => $config, 'record' => $record, 'adminRole' => $admin->role]);
    }

    public function update(Request $request, string $module, int $id): RedirectResponse
    {
        $config = $this->config($module);
        $admin = $this->currentAdmin($config);
        $record = DB::table($config['table'])->where('id', $id)->first();
        abort_unless($record, 404);
        if (in_array($module, ['impact', 'stories'], true)) $request->merge(['slug' => Str::slug((string) ($request->input('slug') ?: $request->input('title')))]);
        $data = $this->validated($request, $config, $id);
        $data = $this->prepare($request, $config, $data, $record);
        $becamePaid = $module === 'donations' && $record->payment_status !== 'paid' && ($data['payment_status'] ?? $record->payment_status) === 'paid';
        $data['updated_at'] = now();
        if ($module === 'donations' && ($data['payment_status'] ?? $record->payment_status) === 'paid' && empty($record->receipt_number)) {
            $data['receipt_number'] = 'MRF-'.now()->format('Ymd').'-'.str_pad((string) $id, 6, '0', STR_PAD_LEFT);
        }
        if ($module === 'enquiries' && ($data['status'] ?? '') === 'responded' && empty($record->responded_at)) {
            $data['responded_at'] = now();
        }
        DB::table($config['table'])->where('id', $id)->update($data);
        $this->log($admin, $module, 'updated', $id, ['status' => $data['status'] ?? $data['payment_status'] ?? 'updated']);
        if ($module === 'volunteers' && isset($data['status']) && $data['status'] !== $record->status) {
            $updatedApplicant = DB::table('volunteer_applications')->where('id', $id)->first();
            FoundationNotifier::send($updatedApplicant->email, 'Volunteer application status updated', 'Hello '.$updatedApplicant->name.'. Your volunteer application status is now: '.str_replace('_', ' ', $updatedApplicant->status).'. Please contact the foundation if you need more information.');
        }
        if ($module === 'enquiries' && ($data['status'] ?? null) === 'responded' && !empty($data['response_notes'])) {
            $updatedEnquiry = DB::table('contact_enquiries')->where('id', $id)->first();
            FoundationNotifier::send($updatedEnquiry->email, 'Update regarding your enquiry', 'Hello '.$updatedEnquiry->name.'. The foundation has added the following response to your enquiry: '.$updatedEnquiry->response_notes);
        }
        if ($becamePaid) {
            $confirmed = DB::table('donations')->where('id', $id)->first();
            $body = 'Thank you. Payment has been confirmed by Muhamadi R Charity Foundation Uganda. Receipt number: '.$confirmed->receipt_number.'. Amount: '.$confirmed->currency.' '.number_format((float) $confirmed->amount, 2).'. Date: '.$confirmed->donation_date.'.';
            FoundationNotifier::send($confirmed->email, 'Donation payment confirmed — receipt '.$confirmed->receipt_number, $body);
            FoundationNotifier::notifyTeam('Donation payment confirmed', 'Donation #'.$confirmed->id.' was marked paid by an administrator. Receipt number: '.$confirmed->receipt_number.'.');
        }
        return redirect()->route('admin.operations.index', $module)->with('status', $config['title'].' record updated.');
    }

    public function destroy(string $module, int $id): RedirectResponse
    {
        $config = $this->config($module);
        $admin = $this->currentAdmin($config);
        $record = DB::table($config['table'])->where('id', $id)->first();
        abort_unless($record, 404);
        if ($module === 'gallery' && $record->image_path && !str_starts_with($record->image_path, 'http')) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('storage/', '', $record->image_path));
        }
        DB::table($config['table'])->where('id', $id)->delete();
        $this->log($admin, $module, 'deleted', $id);
        return redirect()->route('admin.operations.index', $module)->with('status', $config['title'].' record deleted.');
    }

    public function receipt(int $id): View
    {
        $config = $this->config('donations');
        $this->currentAdmin($config);
        $donation = DB::table('donations')->where('id', $id)->first();
        abort_unless($donation, 404);
        abort_unless($donation->payment_status === 'paid', 404, 'Receipts are available only for confirmed paid donations.');
        return view('admin.operations.receipt', compact('donation'));
    }

    private function validated(Request $request, array $config, ?int $id): array
    {
        $module = $config['key'];
        $rules = [];
        foreach ($config['fields'] as $field) {
            $name = $field['name'];
            $required = !empty($field['required']) ? 'required' : 'nullable';
            $rules[$name] = match ($name) {
                'title' => [$required, 'string', 'max:180'],
                'slug' => ['nullable', 'string', 'max:200', 'regex:/^[a-zA-Z0-9\s_-]*$/', Rule::unique($config['table'], 'slug')->ignore($id)],
                'email' => [$required, 'email', 'max:190'],
                'donor_name','name' => [$required, 'string', 'max:160'],
                'phone' => ['nullable', 'string', 'max:40'],
                'payment_method' => ['required', 'string', 'max:60'],
                'reference' => ['nullable', 'string', 'max:160'],
                'category' => ['nullable', 'string', 'max:100'],
                'location' => ['nullable', 'string', 'max:180'],
                'author_name' => ['nullable', 'string', 'max:160'],
                'alt_text' => ['required', 'string', 'max:250'],
                'area_of_interest' => ['required', 'string', 'max:180'],
                'availability' => ['nullable', 'string', 'max:160'],
                'subject' => ['required', 'string', 'max:180'],
                'amount' => ['required', 'numeric', 'gt:0', 'max:999999999999'],
                'currency' => ['required', 'string', 'size:3'],
                'beneficiaries_count' => ['nullable', 'integer', 'min:0', 'max:4294967295'],
                'sort_order' => ['required', 'integer', 'min:0', 'max:999999'],
                'payment_status' => ['required', Rule::in(['pending','paid','failed','refunded'])],
                'status' => ['required', Rule::in($module === 'volunteers' ? ['new','reviewing','approved','declined'] : ($module === 'enquiries' ? ['new','in_progress','responded','closed'] : ['draft','published']))],
                'image_path' => [$module === 'gallery' ? ($id ? 'nullable' : 'required') : 'nullable', $module === 'gallery' ? 'image' : 'string', $module === 'gallery' ? 'mimes:jpg,jpeg,png,webp' : 'max:500', ...($module === 'gallery' ? ['max:5120'] : [])],
                'donation_date','start_date','end_date' => ['nullable', 'date'],
                'receipt_number' => ['nullable', 'string', 'max:40', Rule::unique('donations','receipt_number')->ignore($id)],
                default => [$required, 'string', 'max:'.(in_array($name, ['description','body','message','motivation','experience','admin_notes','response_notes','outcome','caption'] , true) ? 20000 : (in_array($name, ['summary','excerpt'] , true) ? 700 : 500))],
            };
        }
        if ($module === 'stories') $rules['excerpt'] = ['required','string','max:700'];
        if ($module === 'impact') $rules['summary'] = ['required','string','max:600'];
        if ($module === 'gallery') $rules['caption'] = ['nullable','string','max:3000'];
        return $request->validate($rules);
    }

    private function prepare(Request $request, array $config, array $data, ?object $record): array
    {
        $module = $config['key'];
        if (in_array($module, ['impact','stories'], true)) {
            $data['slug'] = Str::slug(($data['slug'] ?? '') ?: $data['title']);
        }
        if ($module === 'gallery') {
            if ($request->hasFile('image_path')) {
                $data['image_path'] = 'storage/'.$request->file('image_path')->store('gallery', 'public');
            } else {
                unset($data['image_path']);
                if (!$record) abort(422, 'Please select an image to upload.');
            }
        }
        if (in_array($module, ['impact','stories'], true)) {
            if (($data['status'] ?? '') === 'published') $data['published_at'] = $record?->published_at ?? now();
            else $data['published_at'] = null;
        }
        if ($module === 'donations') {
            $data['currency'] = strtoupper($data['currency'] ?? 'UGX');
            if (empty($data['donation_date'])) $data['donation_date'] = now()->toDateString();
        }
        return $data;
    }
}
