<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ServiceUser;
use App\Models\UploadFile;
use App\Models\User;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileViewAction extends Controller
{

    public const TYPE_AVATAR = 1;
    public const TYPE_POST_IMG = 2;

    /**
     * @throws NotFoundHttpException
     * @throws AccessDeniedHttpException
     * @throws FileNotFoundException
     */
    public function __invoke(int $type, string $uuid): Response
    {
        if ($type === self::TYPE_AVATAR) {
            return $this->viewAvatar($uuid, 'avatar_id');
        }

        throw new NotFoundHttpException();
    }

    /**
     * @throws NotFoundHttpException
     * @throws AccessDeniedHttpException
     * @throws FileNotFoundException
     */
    protected function viewAvatar(string $uuid, string $foreignKey): Response
    {
        $uploadfile = Uploadfile::where('uuid', $uuid)->first();
        if ($uploadfile === null) {
            throw new NotFoundHttpException();
        }
        $service_user = ServiceUser::where($foreignKey, $uploadfile->id)->first();
        if ($service_user === null) {
            throw new NotFoundHttpException();
        }

        return response(
            Storage::disk('s3')->get($uploadfile->path),
            Response::HTTP_OK,
            [
                'Content-Type' => $uploadfile->content_type,
                'Content-description' => 'inline;',
            ]
        );
    }
}
