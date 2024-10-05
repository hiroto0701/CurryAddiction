<?php

declare(strict_types=1);

namespace App\Domains\Notification\Controller;

use App\Domains\Notification\Usecase\ReadInteractor;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class ReadAction extends Controller
{
    public const OPERATION_OVERVIEW = '通知既読';

    /**
     * @var ReadInteractor
     */
    protected ReadInteractor $interactor;

    /**
     * @param ReadInteractor $interactor
     */
    public function __construct(ReadInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $this->interactor->handle();

        return response()->json(['status' => 'success'], 200);
    }
}
