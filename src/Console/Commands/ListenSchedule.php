<?php

namespace Studio\Totem\Console\Commands;

use Illuminate\Console\Scheduling\ScheduleRunCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;

/**
 * Class ListenSchedule
 * @package Studio\Totem\Console\Commands
 */
class ListenSchedule extends Command
{
    protected $signature = 'schedule:listen';

    protected $description = 'Schedule listen';

    private $sleep;

    public function __construct()
    {
        $this->sleep = env('TOTEM_SLEEP_MS', 1000000 * 10);
        parent::__construct();
    }

    public function handle(): void
    {
        while (true) {
            Artisan::call(ScheduleRunCommand::class);

            usleep($this->sleep);
        }
    }
}
