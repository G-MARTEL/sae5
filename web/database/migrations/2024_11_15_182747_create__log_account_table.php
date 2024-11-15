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
        Schema::create('log_accounts', function (Blueprint $table) {
            $table->increments('log_account_id')->primary();
            $table->unsignedInteger('FK_account_id');
            $table->string('first_name', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('last_name', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('phone', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('postal_address', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('code_address', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('city', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('picture', 50)->collation('utf8_unicode_ci')->nullable();
            $table->string('email', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('password', 255)->collation('utf8_unicode_ci')->nullable();
            $table->timestamp('edited_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedInteger('FK_action_type_id');
        });

        DB::statement('ALTER TABLE log_accounts ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('log_accounts');
    }
};
