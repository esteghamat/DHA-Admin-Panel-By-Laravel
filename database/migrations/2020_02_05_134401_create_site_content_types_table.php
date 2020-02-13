<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteContentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_content_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contenttype_title');
            $table->string('contenttype_slug');
            $table->timestamps();
        });

        DB::table('site_content_types')->insert([
          ['contenttype_title' => 'Anasayfa',      'contenttype_slug' => 'anasayfa'],
          ['contenttype_title' => 'Hakkımızda',    'contenttype_slug' => 'hakkimizda'],
          ['contenttype_title' => 'İşlerimiz',     'contenttype_slug' => 'islerimiz'],
          ['contenttype_title' => 'Hizmetlerimiz', 'contenttype_slug' => 'hizmetlerimiz'],
          ['contenttype_title' => 'Referenslar',      'contenttype_slug' => 'referenslar'],
      ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_content_types');
    }
}
