<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller;

use App\Domains\Post\Controller\Request\CreateRequest;
use App\Domains\Post\Controller\Resource\PostResource;
use App\Domains\Post\Usecase\Command\CreateCommand;
use App\Domains\Post\Usecase\CreateInteractor;
use App\Models\OperationLog;
use App\Models\User;
use App\Traits\OperationLogTrait;
use Illuminate\Routing\Controller;

class CreateAction extends Controller
{
    use OperationLogTrait;

    public const OPERATION_OVERVIEW = '投稿作成';

    /**
     * @var CreateInteractor
     */
    protected CreateInteractor $interactor;

    /**
     * @param CreateInteractor $interactor
     */
    public function __construct(CreateInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(CreateRequest $request): PostResource
    {
        $command = new CreateCommand(
            User::AuthId(),
            (int)$request->genre_id,
            (int)$request->region_id,
            (int)$request->prefecture_id,
            $request->store_name,
            !is_null($request->comment) ? $request->comment : null,
            (float)$request->latitude,
            (float)$request->longitude,
            $request->official_name,
            $request->formatted_address,
            $request->postcode,
            $request->prefecture,
            $request->municipality,
            $request->ward,
            $request->district,
            $request->post_img->get(),
            $request->post_img->getClientOriginalName(),
            $request->post_img->getClientOriginalExtension(),
            $request->post_img->getMimeType(),
        );

        $post = new PostResource(
            $this->interactor->handle($command)
        );

        $this->addOperationLog(OperationLog::OPERATION_TYPE_REGISTER, "投稿ID", $post->id);

        return $post;
    }
}
