<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('account_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('postal_address');
            $table->string('code_address');
            $table->string('city');
            $table->string('picture');
            $table->string('email');
            $table->string('password');
            $table->timestamp('creation_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        DB::statement('ALTER TABLE accounts ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
