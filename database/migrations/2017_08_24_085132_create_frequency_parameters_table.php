<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Studio\Totem\Database\TotemMigration;
use Studio\Totem\Helpers\TotemHelper;

class CreateFrequencyParametersTable
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(TotemHelper::getDbConnection())
            ->create(TotemHelper::getTablePrefix('frequency_parameters'), function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('frequency_id');
                $table->string('name');
                $table->string('value');
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
        Schema::connection(TotemHelper::getDbConnection())
            ->dropIfExists(TotemHelper::getTablePrefix('frequency_parameters'));
    }
}
