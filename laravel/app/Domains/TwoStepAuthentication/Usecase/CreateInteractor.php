<?php

namespace App\Domains\TwoStepAuthentication\Usecase;

use App\Domains\TwoStepAuthentication\Usecase\Command\CreateCommand;
use App\Mail\TwoStepAuthentication\RegisterMailable;
use App\Models\TwoStepAuthentication;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class CreateInteractor
{
    /**
     * @throws Throwable
     */
    public function handle(CreateCommand $command)
    {
        return DB::transaction(function () use ($command) {
            // 有効期限切れ後１日経過した２段階認証用トークンを削除する
            $deleteTwoStepAuthentication = new TwoStepAuthentication();
            $deleteTwoStepAuthentication->where('expire_datetime', '<', date('Y-m-d H:i:s', time()-(60*60*24)))->delete();
            $deleteTwoStepAuthentication->save();
            // ２段階認証用トークンを登録する
            $twoStepAuthentication = new TwoStepAuthentication();
            $twoStepAuthentication->user_id = $command->getUserId();
            $twoStepAuthentication->token = $command->getToken();
            $twoStepAuthentication->expire_datetime = Carbon::now()->addMinutes(config('constant.two_step_authentication_valid_minute.default'));
            $twoStepAuthentication->save();
            // 確認コード（トークン）メールを送信する
            Mail::send(new RegisterMailable($twoStepAuthentication));
            return $twoStepAuthentication;
        });
    }
}
