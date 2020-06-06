<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Studio\Totem\Database\TotemMigration;

class UpdateTaskResultsDurationType
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(\Studio\Totem\Helpers\TotemHelper::getDbConnection())
            ->table(\Studio\Totem\Helpers\TotemHelper::getTablePrefix('task_results'), function (Blueprint $table) {
                $table->float('duration', 24, 14)->charset('')->collation('')->change();
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
            ->table(\Studio\Totem\Helpers\TotemHelper::getTablePrefix('task_results'), function (Blueprint $table) {
                $table->string('duration', 255)->change();
            });
    }
}
