<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('document_id'); // Clé primaire
            $table->unsignedInteger('FK_client_id'); 
            $table->string('title');
            $table->string('document'); 
            $table->date('date')->useCurrent(); // Colonne date avec valeur par défaut

        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
