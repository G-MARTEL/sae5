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
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('notification_id');
            $table->string('content', 255)->collation('utf8_unicode_ci');
            $table->unsignedInteger('FK_account_id_recipient');
            $table->unsignedInteger('FK_account_id_sender');
            $table->boolean('seen')->default(false);
            $table->timestamp('date')->useCurrent();
        });

        DB::statement('ALTER TABLE notifications ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};