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
        Schema::create('actions_type', function (Blueprint $table) {
            $table->integer('action_type_id')->primary(); // Colonne clé primaire manuelle
            $table->string('action_name', 255)->collation('utf8_unicode_ci'); // Colonne avec collation spécifique
        });

        // Optionnel : Configurer l'engine et le charset pour la table
        DB::statement('ALTER TABLE actions_type ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_type');
    }
};
