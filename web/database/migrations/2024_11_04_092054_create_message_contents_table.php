<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('message_contents', function (Blueprint $table) {
            $table->increments('message_content_id');
            $table->text('content');
        });
    }

    public function down()
    {
        Schema::dropIfExists('message_contents');
    }
};
