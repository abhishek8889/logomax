<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckTaskCompleteStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-task-complete-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will check that special designer has complete his task with in given time or not if he is not then task will be assign to backup designer.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Yes cron job is working.');
       
    }
}
