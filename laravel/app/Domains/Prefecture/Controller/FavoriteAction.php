<?php

declare(strict_types=1);

namespace App\Domains\Prefecture\Controller;

use App\Domains\Prefecture\Usecase\FavoriteInteractor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FavoriteAction extends Controller
{
    public const OPERATION_OVERVIEW = 'お気に入りの都道府県更新';

    /**
     * @var FavoriteInteractor
     */
    protected FavoriteInteractor $interactor;

    /**
     * @param FavoriteInteractor $interactor
     */
    public function __construct(FavoriteInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $userId = User::AuthId();
        $prefectureIds = $request->input('prefectures', []);

        $this->interactor->handle($userId, $prefectureIds);

        return response()->json(['message' => 'お気に入りの都道府県を更新しました。'], 200);
    }
}
