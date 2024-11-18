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
        Schema::create('team_services', function (Blueprint $table) {
            $table->increments('team_service_id')->primary();
            $table->unsignedInteger('FK_service_id');
            $table->unsignedInteger('FK_employee_id');
        });

        DB::statement('ALTER TABLE team_services ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('team_services');
    }
};
