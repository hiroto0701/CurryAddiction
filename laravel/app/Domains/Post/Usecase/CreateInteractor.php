<?php

declare(strict_types=1);

namespace App\Domains\Post\Usecase;

use App\Domains\Post\Usecase\Command\CreateCommand;
use App\Models\Post;
use App\Models\UploadFile;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class CreateInteractor
{
    /**
     * @param Post $post
     * @param CreateCommand $command
     * @return Post
     */
    public function handle(CreateCommand $command): Post
    {
        return DB::transaction(function () use ($command): Post {
            $post = new Post();
            $post->user_id = $command->getUserId();
            $post->genre_id = $command->getGenreId();
            $post->region_id = $command->getRegionId();
            $post->prefecture_id = $command->getPrefectureId();
            $post->store_name = $command->getStoreName();
            $post->latitude = $command->getLatitude();
            $post->longitude = $command->getLongitude();

            if (!empty($command->getComment())) {
                $post->comment = $command->getComment();
            }

            if (!empty($command->getFileContent())) {
                $uploadDir = sprintf(config('constant.post_img.uploadfiles_path_format'), User::AuthId());

                $uploadfile = new UploadFile();
                $uploadfile->type = UploadFile::TYPE_POST_IMG;
                $uploadfile->user_id = $command->getUserId();
                $uploadfile->uuid = Uuid::uuid4();
                $uploadfile->path = $uploadDir . $uploadfile->uuid . '.' . $command->getFileExtension();
                $uploadfile->content_type = $command->getContentType();
                $uploadfile->uploaded_at = Carbon::now();
                Storage::disk('s3')->put($uploadfile->path, $command->getFileContent());
                $uploadfile->save();
            }
            $post->post_img_id = $uploadfile->id;
            $post->posted_at = Carbon::now();
            $post->save();
            return $post;
        });
    }
}
