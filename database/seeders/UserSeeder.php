<?php

namespace Database\Seeders;

use App\Enums\UserGender;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@hadith.app',
                'phone' => '966566502430',
                'role' => UserRole::ADMIN,
                'status' => UserStatus::ACTIVE,
                'gender' => UserGender::MALE,
                // 'avatar' => asset('assets/images/users/default_avatar_male.svg'),
                'avatar' => null,
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
                'password' => 'TopSecretPassword',
            ],
        ];

        if (User::count() === 0 && app()->isLocal()) {
            foreach ($users as $userData) {
                User::firstOrCreate($userData);
            }
        }
    }
}
