<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Studio\Totem\Database\TotemMigration;

class CreateTaskFrequenciesTable
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(\Studio\Totem\Helpers\TotemHelper::getDbConnection())
            ->create(\Studio\Totem\Helpers\TotemHelper::getTablePrefix('task_frequencies'), function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('task_id');
                $table->string('label');
                $table->string('interval');
                $table->timestamps();
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
            ->dropIfExists(\Studio\Totem\Helpers\TotemHelper::getTablePrefix('task_frequencies'));
    }
}
