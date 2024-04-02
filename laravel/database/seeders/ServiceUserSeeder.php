<?php

namespace Database\Seeders;

use App\Models\ServiceUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ServiceUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('status', User::TYPE_SERVICE_USER)->get();

        foreach ($users as $user) {
            ServiceUser::factory()->create([
                'user_id' => $user->id,
                'handle_name' => 'testuser',
                'display_name' => 'testuser',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'profile_path' => 'test/test/test.png'
            ]);
        }
    }
}