<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTeamServicesTable extends Migration
{
    /**
     * Appliquer la migration.
     */
    public function up()
    {
        Schema::create('team_services', function (Blueprint $table) {
            $table->integer('team_service_id')->primary();
            $table->integer('FK_service_id');
            $table->integer('FK_employee_id');
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
}
