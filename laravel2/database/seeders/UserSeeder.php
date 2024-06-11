<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\ServiceUser;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = User::factory()->count(10)->create();
    
        foreach ($users as $user) {
            if ($user->type == User::TYPE_SERVICE_USER) {
                $user->service_user()->save(ServiceUser::factory()->make([
                    'user_id' => $user->id,
                ]));
            }
        }
    }
}