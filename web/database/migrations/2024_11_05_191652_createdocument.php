<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('create_documents', function (Blueprint $table) {
            $table->increments('createdocument_id'); // Clé primaire
            $table->unsignedInteger('FK_employee_id'); // Colonne FK_employee_id
            $table->unsignedInteger('FK_client_id'); // Colonne FK_client_id
            $table->boolean('facture'); // Colonne facture (tinyint 1)
        });
    }

    public function down()
    {
        Schema::dropIfExists('create_documents');
    }

};
