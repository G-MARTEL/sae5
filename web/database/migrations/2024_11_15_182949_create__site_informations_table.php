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
        Schema::create('site_informations', function (Blueprint $table) {
            $table->increments('site_information_id')->primary();
            $table->string('company_name', 255)->collation('utf8_unicode_ci');
            $table->string('logo', 255)->collation('utf8_unicode_ci');
            $table->string('linkedin_link', 255)->collation('utf8_unicode_ci');
            $table->string('facebook_link', 255)->collation('utf8_unicode_ci');
            $table->string('instagram_link', 255)->collation('utf8_unicode_ci');
        });

        DB::statement('ALTER TABLE site_informations ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci');

        // Insertion des données
        DB::table('site_informations')->insert([
            'site_information_id' => 1,
            'company_name' => 'Avycompta',
            'logo' => 'logo.png',
            'linkedin_link' => 'linkedin.com/avycompta',
            'facebook_link' => 'facebook.com/avycompta',
            'instagram_link' => 'instagram.com/avycompta',
        ]);
    }

    /**
     * Annuler la migration.
     */
    public function down()
    {
        Schema::dropIfExists('site_informations');
    }
};
