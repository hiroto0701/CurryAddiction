<?php

namespace App\Mail\TwoStepAuthentication;

use App\Mail\DbTemplateMailable;
use App\Models\MailTemplate;
use App\Models\Token;
use App\Models\TwoStepAuthentication;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class RegisterMailable extends DbTemplateMailable
{
    // use Queueable;
    // use SerializesModels;

    // private TwoStepAuthentication $twoStepAuthentication;

    // public function __construct(TwoStepAuthentication $twoStepAuthentication)
    // {
    //     $this->twoStepAuthentication = $twoStepAuthentication;
    //     parent::__construct(MailTemplate::TYPE_SEND_TWO_STEP_AUTHENTICATION_TOKEN);
    // }

    // public function build(): RegisterMailable
    // {
    //     if ($this->twoStepAuthentication->user->service_user) {
    //         $mailAddress = $this->twoStepAuthentication->user->service_user->email;
    //     } else {
    //         $mailAddress = $this->twoStepAuthentication->user->administrator->email;
    //     }

    //     return $this->to($mailAddress)
    //         ->with([
    //             'token' => $this->twoStepAuthentication->token,
    //         ]);
    // }
    private Token $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
        parent::__construct(MailTemplate::TYPE_SEND_TWO_STEP_AUTHENTICATION_TOKEN);
    }

    public function build(): RegisterMailable
    {
        $mailAddress = '';
        // if ($this->twoStepAuthentication->user->service_user) {
        //     $mailAddress = $this->twoStepAuthentication->user->service_user->email;
        // } else {
        //     $mailAddress = $this->twoStepAuthentication->user->administrator->email;
        // }
        $mailAddress = $this->token->email;

        return $this->to($mailAddress)
            ->with([
                'token' => $this->token->token,
            ]);
    }
}
