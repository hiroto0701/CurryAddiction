<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\ViewRequest;
use App\Domains\ServiceUser\Controller\Resource\PrivateServiceUserResource;
use App\Models\ServiceUser;
use Illuminate\Routing\Controller;

class ViewAction extends Controller
{
    public function __invoke(ViewRequest $request, ServiceUser $service_user): PrivateServiceUserResource
    {
        return new PrivateServiceUserResource($service_user);
    }
}
