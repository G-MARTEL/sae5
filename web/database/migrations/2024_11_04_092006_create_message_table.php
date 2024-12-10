<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('message_id');
            $table->unsignedInteger('FK_sender_id');
            $table->unsignedInteger('FK_recipient_id');
            $table->unsignedInteger('FK_conversation_id');
            $table->unsignedInteger('FK_message_content_id');
            $table->date('creation_date');

        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
