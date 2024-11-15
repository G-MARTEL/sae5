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
        Schema::create('functions', function (Blueprint $table) {
            $table->increments('function_id')->primary();
            $table->string('function_name', 255)->collation('utf8_unicode_ci');
        });

        DB::statement('ALTER TABLE functions ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');

        DB::table('functions')->insert([
            ['function_id' => 1, 'function_name' => 'Admin'],
            ['function_id' => 2, 'function_name' => 'Directeur'],
            ['function_id' => 3, 'function_name' => 'Directeur adjoint'],
            ['function_id' => 4, 'function_name' => 'Assistant'],
            ['function_id' => 5, 'function_name' => 'Comptable'],
        ]);
    }


    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('functions');
    }
};
