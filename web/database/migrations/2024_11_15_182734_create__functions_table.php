<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFunctionsTable extends Migration
{
    /**
     * Appliquer la migration.
     */
    public function up()
    {
        Schema::create('functions', function (Blueprint $table) {
            $table->integer('function_id')->primary();
            $table->string('function_name', 255)->collation('utf8_unicode_ci');
        });

        DB::statement('ALTER TABLE functions ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('functions');
    }
}
