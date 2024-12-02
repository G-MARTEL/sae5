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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('employee_id')->primary();
            $table->unsignedInteger('FK_function_id');
            $table->unsignedInteger('FK_account_id');
        });

        DB::statement('ALTER TABLE employees ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');

        DB::table('employees')->insert([
            ['FK_function_id' => 1, 'FK_account_id' => 2],
        ]);

    }
    
    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
