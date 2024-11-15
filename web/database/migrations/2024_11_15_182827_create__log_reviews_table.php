<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLogReviewsTable extends Migration
{
    /**
     * Appliquer la migration.
     */
    public function up()
    {
        Schema::create('log_reviews', function (Blueprint $table) {
            $table->integer('log_review_id')->primary();
            $table->integer('FK_review_id');
            $table->integer('FK_account_id')->nullable();
            $table->text('review')->collation('utf8_unicode_ci')->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('edited_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('FK_action_type');
        });

        DB::statement('ALTER TABLE log_reviews ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('log_reviews');
    }
}
