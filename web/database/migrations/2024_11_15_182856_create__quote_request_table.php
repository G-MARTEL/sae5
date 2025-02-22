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
        Schema::create('quotes_request', function (Blueprint $table) {
            $table->increments('quote_request_id')->primary();
            $table->string('first_name', 255)->collation('utf8_unicode_ci');
            $table->string('last_name', 255)->collation('utf8_unicode_ci');
            $table->string('phone', 255)->collation('utf8_unicode_ci');
            $table->string('email', 255)->collation('utf8_unicode_ci');
            $table->string('type_of_service', 255)->collation('utf8_unicode_ci');
            $table->text('message')->collation('utf8_unicode_ci');
            $table->timestamp('creation_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('checked')->default(false);
        });

        DB::statement('ALTER TABLE quotes_request ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('quotes_request');
    }
};
