<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase;

use App\Domains\ServiceUser\Usecase\Command\TokenCreateCommand;
use App\Mail\TwoStepAuthentication\RegisterMailable;
use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class TokenCreateInteractor
{
    /**
     * @throws Throwable
     */
    public function handle(TokenCreateCommand $command)
    {
        return DB::transaction(function () use ($command) {
            $data = [
                'email' => $command->getEmail(),
                'token' => $command->getToken(),
                'is_verified' => false,
                'expire_datetime' => Carbon::now()->addMinutes(config('constant.two_step_authentication_valid_minute.default')),
            ];

            $token = Token::updateOrCreate(
                ['email' => $command->getEmail()],
                $data
            );

            Mail::send(new RegisterMailable($token));
            return $token;
        });
    }
}
