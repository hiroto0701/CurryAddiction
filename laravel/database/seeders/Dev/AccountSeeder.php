<?php

declare(strict_types=1);

namespace Database\Seeders\Dev;

use App\Models\Administrator;
use App\Models\ServiceUser;
use App\Models\User;
use Database\Seeders\AbstractSeeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * システムUserIDの登録
         */
        $systemId = DB::table('users')->insertGetId(
            [
                'type' => User::TYPE_ADMINISTRATOR,
            ] + $this->commonColumns
        );
        DB::table('administrators')->insert(
            [
                'user_id' => User::ID_SYSTEM,
                'status' => Administrator::STATUS_ENABLED,
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin0701'),
                'name' => 'システム管理者',
            ] + $this->commonColumns
        );
        if ($systemId !== User::ID_SYSTEM) {
            throw new \Exception('system_id is invalid!');
        }

        /**
         * サービス利用者の登録
         */
        $serviceUserId = DB::table('users')->insertGetId(
            [
                'type' => User::TYPE_SERVICE_USER,
            ] + $this->commonColumns
        );
        DB::table('service_users')->insert(
            [
                'user_id' => $serviceUserId,
                'status' => ServiceUser::STATUS_ENABLED,
				'handle_name' => 'service_user',
				'display_name' => 'ダミーユーザー',
				'email' => 'test@mail.com',
                'avatar_id' => null,
                'registered_at' => Carbon::now(),
            ] + $this->commonColumns
        );
	}
}
