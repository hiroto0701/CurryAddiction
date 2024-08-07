<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller;

use App\Domains\Post\Controller\Request\ViewRequest;
use App\Domains\Post\Controller\Resource\PostResource;
use App\Models\Post;
use Illuminate\Routing\Controller;

class ViewAction extends Controller
{
    public const OPERATION_OVERVIEW = '投稿詳細取得';

    public function __invoke(ViewRequest $request, Post $post): PostResource
    {
        return new PostResource($post);
    }
}
