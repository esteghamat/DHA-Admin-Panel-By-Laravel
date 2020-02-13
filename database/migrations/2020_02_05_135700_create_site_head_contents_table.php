<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteHeadContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_content_heads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('site_content_type_id');
            $table->string('contenthead_title');
            $table->string('contenthead_slug');
            $table->string('contenthead_keywords')->nullable();
            $table->text('contenthead_title_description')->nullable();
            $table->text('contenthead_description')->nullable();
            $table->string('contenthead_image_name')->nullable();
            $table->string('contenthead_logo_image_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_head_contents');
    }
}
