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
        Schema::create('calendars', function (Blueprint $table) {
            $table->increments('calendar_id');
            $table->unsignedInteger('FK_employee_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('date');
        });

        DB::statement('ALTER TABLE calendars ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('calendars');
    }
};
