<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Resource\ServiceUserResource;
use App\Models\User;
use Illuminate\Routing\Controller;

class GetAction extends Controller
{
    public function __invoke(): ServiceUserResource
    {
        return new ServiceUserResource(User::AuthServiceUser());

    }
}
