<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\ViewRequest;
use App\Domains\ServiceUser\Controller\Resource\ServiceUserResource;
use App\Models\ServiceUser;
use Illuminate\Routing\Controller;

class ViewAction extends Controller
{
    public function __invoke(ViewRequest $request, ServiceUser $service_user): ServiceUserResource
    {
        return new ServiceUserResource($service_user);
    }
}
