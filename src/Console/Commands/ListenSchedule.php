<?php

namespace Studio\Totem\Console\Commands;

use Illuminate\Console\Scheduling\ScheduleRunCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;
use Studio\Totem\Helpers\ArtisanHelper;

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
        $this->sleep = env('TOTEM_LISTEN_SCHEDULE_SLEEP_MS', 1000000 * 10);
        parent::__construct();
    }

    public function handle(): void
    {
        while (true) {
            ArtisanHelper::call('schedule:run');

            usleep($this->sleep);
        }
    }
}
