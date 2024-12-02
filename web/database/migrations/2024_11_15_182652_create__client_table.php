<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('client_id')->primary(); // Colonne clé primaire manuelle
            $table->unsignedInteger('FK_employee_id')->nullable(); // Clé étrangère optionnelle
            $table->unsignedInteger('FK_account_id'); // Clé étrangère obligatoire
        });

        DB::table('clients')->insert([
            ['FK_account_id' => 1,],
        ]);

        // Configurer l'engine et le charset
        DB::statement('ALTER TABLE clients ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
