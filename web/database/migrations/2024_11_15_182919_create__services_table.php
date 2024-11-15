<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateServicesTable extends Migration
{
    /**
     * Appliquer la migration.
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->integer('service_id')->primary();
            $table->string('title', 255)->collation('utf8_unicode_ci')->nullable();
            $table->text('description')->collation('utf8_unicode_ci')->nullable();
            $table->string('picture', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('advantage', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('situations', 255)->collation('utf8_unicode_ci')->nullable();
        });

        DB::statement('ALTER TABLE services ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
