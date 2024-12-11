<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ServiceUser;
use App\Models\UploadFile;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\App;

class FileViewAction extends Controller
{
    public const TYPE_AVATAR = 1;
    public const TYPE_POST_IMG = 2;

    private const TYPE_CONFIG = [
        self::TYPE_AVATAR => [
            'model' => ServiceUser::class,
            'foreign_key' => 'avatar_id',
        ],
        self::TYPE_POST_IMG => [
            'model' => Post::class,
            'foreign_key' => 'post_img_id',
            'with_trashed' => true,
        ],
    ];

    /**
     * @throws NotFoundHttpException
     * @throws AccessDeniedHttpException
     * @throws FileNotFoundException
     */
    public function __invoke(int $type, string $uuid): Response
    {
        if (!isset(self::TYPE_CONFIG[$type])) {
            throw new NotFoundHttpException();
        }

        return $this->viewFile($uuid, self::TYPE_CONFIG[$type]);
    }

    /**
     * @throws NotFoundHttpException
     * @throws FileNotFoundException
     */
    protected function viewFile(string $uuid, array $config): Response
    {
        // キャッシュキーの生成
        $cacheKey = "file_view_{$uuid}";

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($uuid, $config) {
            $uploadFile = UploadFile::where('uuid', $uuid)->first();
            if ($uploadFile === null) {
                throw new NotFoundHttpException();
            }

            $query = $config['model']::query();
            if ($config['with_trashed'] ?? false) {
                $query->withTrashed();
            }

            $record = $query->where($config['foreign_key'], $uploadFile->id)->first();
            if ($record === null) {
                throw new NotFoundHttpException();
            }

            $content =  Storage::disk(App::environment('local') ? 's3' : 'r2')->get($uploadFile->path);

            return response($content, Response::HTTP_OK, [
                'Content-Type' => $uploadFile->content_type,
                'Content-Disposition' => 'inline',
                'Cache-Control' => 'public, max-age=86400',
                'Expires' => gmdate('D, d M Y H:i:s \G\M\T', time() + 3600),
            ]);
        });
    }
}
