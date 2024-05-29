<?php

namespace App\Mail\TwoStepAuthentication;

use App\Mail\DbTemplateMailable;
use App\Models\MailTemplate;
use App\Models\ServiceUser;

class RegisterMailable extends DbTemplateMailable
{
    private ServiceUser $service_user;
    private $planeToken;

    public function __construct(ServiceUser $service_user, $planeToken)
    {
        $this->service_user = $service_user;
        $this->planeToken = $planeToken;
        parent::__construct(MailTemplate::TYPE_SEND_TWO_STEP_AUTHENTICATION_TOKEN);
    }

    public function build(): RegisterMailable
    {
        $mailAddress = '';
        $mailAddress = $this->service_user->email;

        return $this->to($mailAddress)
            ->with([
                'onetime_token' => $this->planeToken,
            ]);
    }
}
