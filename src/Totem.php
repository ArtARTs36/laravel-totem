<?php

namespace Studio\Totem;

use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Studio\Totem\Helpers\TotemHelper;
use Symfony\Component\Console\Command\Command;

class Totem
{
    /**
     * The callback that should be used to authenticate Totem users.
     *
     * @var \Closure
     */
    public static $authUsing;

    /**
     * Determine if the given request can access the Totem dashboard.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public static function check($request)
    {
        return (static::$authUsing ?: function () {
            return app()->environment('local');
        })($request);
    }

    /**
     * Set the callback that should be used to authenticate Totem users.
     *
     * @param \Closure $callback
     *
     * @return static
     */
    public static function auth(Closure $callback)
    {
        static::$authUsing = $callback;

        return new static();
    }

    /**
     * Return available frequencies.
     *
     * @return array
     */
    public static function frequencies()
    {
        return config('totem.frequencies');
    }

    /**
     * Return collection of Artisan commands filtered if needed.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getCommands()
    {
        $return = function ($all_commands) {
            return $all_commands->sortBy(function (Command $command) {
                $name = $command->getName();
                if (mb_strpos($name, ':') === false) {
                    $name = ':'.$name;
                }

                return $name;
            });
        };

        if (! empty(config('totem.artisan.concrete_commands'))) {
            return $return(collect(array_map(function ($command) {
                return app()->make($command);
            }, config('totem.artisan.concrete_commands'))));
        }

        $command_filter = config('totem.artisan.command_filter');
        $whitelist = config('totem.artisan.whitelist', true);
        $all_commands = collect(Artisan::all());

        if (! empty($command_filter)) {
            $all_commands = $all_commands->filter(function (Command $command) use ($command_filter, $whitelist) {
                foreach ($command_filter as $filter) {
                    if (fnmatch($filter, $command->getName())) {
                        return $whitelist;
                    }
                }

                return ! $whitelist;
            });
        }

        return $return($all_commands);
    }

    /**
     * @return bool
     */
    public static function baseTableExists(): bool
    {
        if (Cache::get('totem.table.'.TotemHelper::getTablePrefix('tasks'))) {
            return true;
        }

        if (Schema::hasTable(TotemHelper::getTablePrefix('tasks'))) {
            Cache::forever('totem.table.'.TotemHelper::getTablePrefix('tasks'), true);

            return true;
        }

        return false;
    }
}
