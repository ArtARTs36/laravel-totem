<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Studio\Totem\Database\TotemMigration;

class AlterTasksTableAddRunOnOneServerSupport extends \Illuminate\Database\Migrations\Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(\Studio\Totem\Helpers\TotemHelper::getTablePrefix())
            ->table(\Studio\Totem\Helpers\TotemHelper::getTablePrefix('tasks'), function (Blueprint $table) {
                $table->boolean('run_on_one_server')->default(false);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(\Studio\Totem\Helpers\TotemHelper::getDbConnection())
            ->table(\Studio\Totem\Helpers\TotemHelper::getTablePrefix('tasks'), function (Blueprint $table) {
                $table->dropColumn('run_on_one_server');
            });
    }
}
