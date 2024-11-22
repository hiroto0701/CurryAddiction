<?php

namespace App\Console\Commands;

use App\Models\OperationLog;
use App\Models\ServiceUser;
use App\Traits\OperationLogTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanupPendingServiceUsers extends Command
{
    use OperationLogTrait;

    public const OPERATION_OVERVIEW = 'タスクスケジューラ―によるサービス利用者削除（物理削除）';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-pending-service-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete pending service users older than 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $twentyFourHoursAgo = Carbon::now()->subDay();

        $pendingServiceUsers = ServiceUser::where('status', ServiceUser::STATUS_PENDING)
            ->where('created_at', '<', $twentyFourHoursAgo)
            ->get();

        $deletedCount = 0;
        foreach ($pendingServiceUsers as $serviceUser) {
            // サービス利用者に紐づくUserも削除する
            if ($serviceUser->user) {
                $serviceUser->user->forceDelete();
            }
            $serviceUser->forceDelete();
            $deletedCount++;

            $this->addOperationLog(OperationLog::OPERATION_TYPE_DELETE, "ユーザーID", $serviceUser->user_id);
        }

        $this->info("Deleted {$deletedCount} pending service users and their associated users older than 24 hours.");
    }

}
