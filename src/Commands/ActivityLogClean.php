<?php

namespace Aginev\ActivityLog\Commands;

use Illuminate\Console\Command;
use Aginev\ActivityLog\ActivityLogFacade;

class ActivityLogClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity-log:clean {days?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean older activity logs';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $days = (int)$this->argument('days');
        $days = isset($days) ? $days : 30;

        ActivityLogFacade::cleanLog($days);

        $this->info('Older activity logs cleaned!');
    }
}
