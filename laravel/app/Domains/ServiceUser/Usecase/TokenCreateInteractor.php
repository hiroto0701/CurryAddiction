<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase;

use App\Domains\ServiceUser\Usecase\Command\TokenCreateCommand;
use App\Mail\TwoStepAuthentication\RegisterMailable;
use App\Models\ServiceUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TokenCreateInteractor
{
    public function handle(TokenCreateCommand $command)
    {
        return DB::transaction(function () use ($command) {
            $user = ServiceUser::where('email', $command->getEmail())->first();

            $planeToken = $command->getOnetimeToken();
            if ($user === null) {
                $user = User::create([
                    'type' => User::TYPE_SERVICE_USER,
                ]);

                $service_user = $user->service_user()->create([
                    'status' => ServiceUser::STATUS_PENDING,
                    'email' => $command->getEmail(),
                    'onetime_token' => Hash::make($command->getOnetimeToken()),
                    'onetime_expiration' => Carbon::now()->addMinutes(config('constant.token_expire_minutes.default')),
                ]);
            } else {
                $data = [
                    'email' => $command->getEmail(),
                    'onetime_token' => Hash::make($command->getOnetimeToken()),
                    'onetime_expiration' => Carbon::now()->addMinutes(config('constant.token_expire_minutes.default')),
                ];

                $service_user = ServiceUser::updateOrCreate(
                    ['email' => $command->getEmail()],
                    $data
                );
            }

            Mail::send(new RegisterMailable($service_user, $planeToken));
            return $service_user;
        });
    }
}
