<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Studio\Totem\Database\TotemMigration;

class CreateTasksTable extends \Illuminate\Database\Migrations\Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(\Studio\Totem\Helpers\TotemHelper::getDbConnection())
            ->create(\Studio\Totem\Helpers\TotemHelper::getTablePrefix('tasks'), function (Blueprint $table) {
                $table->increments('id');
                $table->string('description');
                $table->string('command');
                $table->string('parameters')->nullable();
                $table->string('expression')->nullable();
                $table->string('timezone')->default('UTC');
                $table->boolean('is_active')->default(true);
                $table->boolean('dont_overlap')->default(false);
                $table->boolean('run_in_maintenance')->default(false);
                $table->string('notification_email_address')->nullable();
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
            ->dropIfExists(\Studio\Totem\Helpers\TotemHelper::getTablePrefix('tasks'));
    }
}
