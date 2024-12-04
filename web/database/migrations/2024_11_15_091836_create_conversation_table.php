<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('conversation_id');
            $table->unsignedInteger('FK_employee_id');
            $table->unsignedInteger('FK_client_id');
            $table->date('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversations');
    }
};
