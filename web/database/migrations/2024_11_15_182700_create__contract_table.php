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
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('contract_id')->primary();
            $table->string('numero_contract', 25)->collation('utf8_unicode_ci');
            $table->unsignedInteger('FK_service_id');
            $table->unsignedInteger('FK_employee_id');
            $table->boolean('is_active');
            $table->unsignedInteger('FK_client_id');
            $table->timestamp('creation_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement('ALTER TABLE contracts ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
        
    }

    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
;