<?php

namespace App\Mail\TwoStepAuthentication;

use App\Mail\DbTemplateMailable;
use App\Models\MailTemplate;
use App\Models\TwoStepAuthentication;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RegisterMailable extends DbTemplateMailable
{
    use Queueable;
    use SerializesModels;

    private TwoStepAuthentication $twoStepAuthentication;

    public function __construct(TwoStepAuthentication $twoStepAuthentication, MailTemplate $rawMailTemplate = null)
    {
        $this->twoStepAuthentication = $twoStepAuthentication;
        parent::__construct(MailTemplate::TYPE_SEND_TWO_STEP_AUTHENTICATION_TOKEN, $rawMailTemplate);
    }

    public function build(): RegisterMailable
    {
        Log::debug($this->twoStepAuthentication->user->service_users);
        $mailAddress = 'test@mail.com';
        // if ($this->twoStepAuthentication->user->service_users) {
        //     $mailAddress = $this->twoStepAuthentication->user->service_user->email;
        // } else {
        //     $mailAddress = $this->twoStepAuthentication->user->administrator->email;
        // }

        return $this->to($mailAddress)
            ->with([
                'token' => $this->twoStepAuthentication->token,
            ]);
    }
}
