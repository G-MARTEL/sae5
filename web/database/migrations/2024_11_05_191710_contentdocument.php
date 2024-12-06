<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('content_documents', function (Blueprint $table) {
            $table->increments('contentdocument_id'); // Clé primaire
            $table->string('title', 50); // Colonne title
            $table->text('contenu'); // Colonne contenu
            $table->unsignedInteger('FK_createdocument_id'); // Colonne FK_createdocument_id
            $table->date('date')->useCurrent(); // Colonne date avec valeur par défau
        });
    }

    public function down()
    {
        Schema::dropIfExists('content_documents');
    }
};
