<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $name = config('admin.name');
        $email = config('admin.email');
        $password = config('admin.password');

        if (! $name || ! filter_var($email, FILTER_VALIDATE_EMAIL) || ! $password) {
            throw new RuntimeException('Set ADMIN_NAME, ADMIN_EMAIL, and ADMIN_PASSWORD before running AdminSeeder.');
        }

        if (strlen($password) < 12) {
            throw new RuntimeException('ADMIN_PASSWORD must contain at least 12 characters.');
        }

        $role = Role::where('name', 'admin')->first();

        if (! $role) {
            throw new RuntimeException('The admin role is missing. Seed roles before running AdminSeeder.');
        }

        DB::transaction(function () use ($name, $email, $password, $role) {
            $user = User::where('email', $email)->first();

            if ($user && $user->role?->name !== 'admin') {
                throw new RuntimeException('The configured admin email belongs to a non-admin account.');
            }

            $profile = $user?->profile;
            if (! $profile) {
                $profile = Profile::create([
                    'alamat' => '',
                    'umur' => 17,
                    'bio' => 'administrator',
                ]);
            }

            $attributes = [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role_id' => $role->id,
                'profile_id' => $profile->id,
                'email_verified_at' => now(),
            ];

            if ($user) {
                $user->update($attributes);
            } else {
                User::create($attributes);
            }
        });
    }
}
