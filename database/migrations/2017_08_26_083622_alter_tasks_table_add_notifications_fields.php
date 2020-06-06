<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Studio\Totem\Database\TotemMigration;

class AlterTasksTableAddNotificationsFields extends \Illuminate\Database\Migrations\Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(\Studio\Totem\Helpers\TotemHelper::getDbConnection())
            ->table(\Studio\Totem\Helpers\TotemHelper::getTablePrefix('tasks'), function (Blueprint $table) {
                $table->string('notification_phone_number')->nullable()->after('notification_email_address');
                $table->string('notification_slack_webhook')->nullable()->after('notification_phone_number');
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
                $table->dropColumn('notification_phone_number');
            });

        Schema::connection(\Studio\Totem\Helpers\TotemHelper::getDbConnection())
            ->table(\Studio\Totem\Helpers\TotemHelper::getTablePrefix('tasks'), function (Blueprint $table) {
                $table->dropColumn('notification_slack_webhook');
            });
    }
}
