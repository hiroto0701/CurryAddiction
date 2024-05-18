<?php

declare(strict_types=1);

namespace App\Auth;

use App\Domains\TwoStepAuthentication\Usecase\Command\CreateCommand;
use App\Domains\TwoStepAuthentication\Usecase\CreateInteractor;
use App\Exceptions\AuthenticationTokenException;
use Carbon\Carbon;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;

class ServiceUserEloquentUserProvider extends EloquentUserProvider implements UserProvider
{

    /**
     * retrieveByCredentials をオーバーライドする。
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        // service_usesr テーブルには token が存在しないため、除外して親の function を呼び出す
        $credentials_for_parent = $credentials;
        if (array_key_exists('token', $credentials_for_parent)) {
            unset($credentials_for_parent['token']);
        }
        return parent::retrieveByCredentials($credentials_for_parent);
    }

    /**
     * validateCredentials をオーバーライドして、認証検査を行う。
     *
     * @param UserContract $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        // ２段階認証
        if ($user->use_two_step_authentication) {

            // メールアドレス、パスワードを検証する
            if (!parent::validateCredentials($user, $credentials)) return false;

            if (empty($credentials['token'])) {
                // トークンを発行してメールを送信する
                $command = new CreateCommand(
                    $user->user_id,
                    str_pad((string)random_int(0,999999), 6, '0', STR_PAD_LEFT),
                );
                (new CreateInteractor())->handle($command);

                // ２段階認証のためのレスポンスを返却する
                throw new AuthenticationTokenException(required: true);
            }

            // トークンを検証するよ
            $twoStepAuthentications = $user->twoStepAuthentications->filter(function ($twoStepAuthentication) use ($credentials) {
                if ($twoStepAuthentication->token != $credentials['token']) return false;
                if ($twoStepAuthentication->expire_datetime < Carbon::now()) return false;
                return true;
            });
            if ($twoStepAuthentications->count() == 0) throw new AuthenticationTokenException(unmatched: true);
            return true;
        }
        return parent::validateCredentials($user, $credentials);
    }
}
