<?php

declare(strict_types=1);

namespace App\Domains\Genre\Controller;

use App\Domains\Genre\Usecase\FavoriteInteractor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FavoriteAction extends Controller
{
    public const OPERATION_OVERVIEW = 'お気に入りのカレージャンル更新';

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
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $userId = User::AuthId();
        $genreIds = $request->input('genres', []);

        $this->interactor->handle($userId, $genreIds);

        return response()->json(['message' => 'お気に入りのカレーのジャンルを更新しました。'], 200);
    }
}
