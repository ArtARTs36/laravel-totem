<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Studio\Totem\Database\TotemMigration;
use Studio\Totem\Helpers\TotemHelper;

class AddIndexesForTasks extends TotemMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = TotemHelper::getDbConnection();

        Schema::connection($connection)
            ->table(TotemHelper::getTablePrefix('task_results'), function (Blueprint $table) {
                $table->index('task_id', 'task_results_task_id_idx');
                $table->index('ran_at', 'task_results_ran_at_idx');
                $table->foreign('task_id', 'task_id_fk')
                    ->references('id')
                    ->on(TotemHelper::getTablePrefix('tasks'));
            });

        Schema::connection($connection)
            ->table(TotemHelper::getTablePrefix('task_frequencies'), function (Blueprint $table) {
                $table->index('task_id', 'task_frequencies_task_id_idx');
                $table->foreign('task_id', 'task_frequencies_task_id_fk')
                    ->references('id')
                    ->on(TotemHelper::getTablePrefix('tasks'));
            });

        Schema::connection($connection)
            ->table(TotemHelper::getTablePrefix('tasks'), function (Blueprint $table) {
                $table->index('is_active', 'tasks_is_active_idx');
                $table->index('dont_overlap', 'tasks_dont_overlap_idx');
                $table->index('run_in_maintenance', 'tasks_run_in_maintenance_idx');
                $table->index('run_on_one_server', 'tasks_run_on_one_server_idx');
                $table->index('auto_cleanup_num', 'tasks_auto_cleanup_num_idx');
                $table->index('auto_cleanup_type', 'tasks_auto_cleanup_type_idx');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = TotemHelper::getDbConnection();

        Schema::connection($connection)
            ->table(TotemHelper::getTablePrefix('task_results'), function (Blueprint $table) {
                $table->dropForeign('task_id_fk');
            });
        Schema::connection($connection)
            ->table(TotemHelper::getTablePrefix('task_results'), function (Blueprint $table) {
                $table->dropIndex('task_results_task_id_idx');
                $table->dropIndex('task_results_ran_at_idx');
            });

        Schema::connection($connection)
            ->table(TotemHelper::getTablePrefix('task_frequencies'), function (Blueprint $table) {
                $table->dropForeign('task_frequencies_task_id_fk');
            });

        Schema::connection($connection)
            ->table(TotemHelper::getTablePrefix('task_frequencies'), function (Blueprint $table) {
                $table->dropIndex('task_frequencies_task_id_idx');
            });

        Schema::connection($connection)
            ->table(TotemHelper::getTablePrefix('tasks'), function (Blueprint $table) {
                $table->dropIndex('tasks_is_active_idx');
                $table->dropIndex('tasks_dont_overlap_idx');
                $table->dropIndex('tasks_run_in_maintenance_idx');
                $table->dropIndex('tasks_run_on_one_server_idx');
                $table->dropIndex('tasks_auto_cleanup_num_idx');
                $table->dropIndex('tasks_auto_cleanup_type_idx');
            });
    }
}
