<?php

namespace Studio\Totem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Studio\Totem\Helpers\TotemHelper;

abstract class TotemModel extends Model
{
    /**
     * @return string
     */
    public function getConnectionName()
    {
        return TotemHelper::getDbConnection();
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        if (($table = parent::getTable()) && Str::contains($table, TotemHelper::getTablePrefix())) {
            return $table;
        }

        return TotemHelper::getTablePrefix($table);
    }
}
