<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Appliquer la migration.
     */
    public function up()
    {
        Schema::create('log_clients', function (Blueprint $table) {
            $table->increments('log_client_id')->primary();
            $table->unsignedInteger('FK_client_id')->nullable();
            $table->unsignedInteger('FK_account_id')->nullable();
            $table->unsignedInteger('FK_employee_id')->nullable();
            $table->timestamp('edited_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedInteger('FK_action_type_id');
        });

        DB::statement('ALTER TABLE log_clients ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('log_clients');
    }
};
