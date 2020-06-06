<?php

namespace Studio\Totem\Helpers;

class TotemHelper
{
    /**
     * Get DataBase Connection Name
     *
     * @return string
     */
    public static function getDbConnection(): string
    {
        return config('totem.database_connection', Schema::getConnection()->getName());
    }

    /**
     * Get Table Prefix
     *
     * @param string|null $tableName
     * @return string
     */
    public static function getTablePrefix(string $tableName = null): string
    {
        return config('totem.table_prefix') . $tableName;
    }

    /**
     * @param string $path
     * @return string
     */
    public static function getPath(string $path): string
    {
        return realpath(__DIR__.'/../../'. $path);
    }
}
