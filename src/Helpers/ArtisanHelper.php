<?php

namespace Studio\Totem\Helpers;

class ArtisanHelper
{
    public static function call(string $command)
    {
        exec('cd '. base_path() . ' && php artisan '. $command);
    }
}
