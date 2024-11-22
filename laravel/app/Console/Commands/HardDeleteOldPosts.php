<?php

namespace App\Console\Commands;

use App\Models\OperationLog;
use App\Models\Post;
use App\Traits\OperationLogTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HardDeleteOldPosts extends Command
{
    use OperationLogTrait;

    public const OPERATION_OVERVIEW = 'タスクスケジューラ―によるごみ箱の投稿削除（物理削除）';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hard-delete-old-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hard delete posts that were soft deleted more than 30 days ago';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $post = new Post();
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        $deletedCount = $post::onlyTrashed()
            ->where('deleted_at', '<', $thirtyDaysAgo)
            ->forceDelete();

        $this->info("Hard deleted {$deletedCount} posts that were soft deleted more than 30 days ago.");

        $this->addOperationLog(OperationLog::OPERATION_TYPE_DELETE, "投稿ID", $post->id);
    }
}
