<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HardDeleteOldPosts extends Command
{
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
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        $deletedCount = Post::onlyTrashed()
            ->where('deleted_at', '<', $thirtyDaysAgo)
            ->forceDelete();

        $this->info("Hard deleted {$deletedCount} posts that were soft deleted more than 30 days ago.");
    }
}
