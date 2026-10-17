<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateCharityAdmin extends Command
{
    protected $signature = 'charity:admin';
    protected $description = 'Create or update an administrator account for the charity website';

    public function handle(): int
    {
        $name = trim((string) $this->ask('Administrator full name'));
        $email = strtolower(trim((string) $this->ask('Administrator email')));
        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('A name and valid email address are required.');
            return self::FAILURE;
        }
        $password = (string) $this->secret('Password (minimum 12 characters)');
        if (strlen($password) < 12) {
            $this->error('Use a password with at least 12 characters.');
            return self::FAILURE;
        }
        $now = now();
        $existing = DB::table('admins')->where('email', $email)->first();
        $data = ['name' => $name, 'email' => $email, 'password' => Hash::make($password), 'is_active' => true, 'updated_at' => $now];
        if ($existing) {
            DB::table('admins')->where('id', $existing->id)->update($data);
            $this->info('Administrator account updated.');
        } else {
            $data['created_at'] = $now;
            DB::table('admins')->insert($data);
            $this->info('Administrator account created.');
        }
        return self::SUCCESS;
    }
}
