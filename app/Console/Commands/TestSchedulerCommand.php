<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestSchedulerCommand extends Command
{
    protected $signature = 'test:scheduler';
    protected $description = 'Test if the Laravel scheduler is working';

    public function handle()
    {
        Log::info('✅ The scheduler ran successfully at ' . now());
        $this->info('✅ TestSchedulerCommand ran successfully at ' . now());
    }
}
