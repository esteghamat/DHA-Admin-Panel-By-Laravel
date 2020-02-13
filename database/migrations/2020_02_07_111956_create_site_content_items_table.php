<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteContentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_content_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('site_content_type_id');
            $table->string('contentitem_title')->unique();
            $table->string('contentitem_slug')->unique();
            $table->string('contentitem_keywords')->nullable();
            $table->text('contentitem_title_description')->nullable();
            $table->text('contentitem_description')->nullable();
            $table->string('contentitem_image_name')->nullable();
            $table->string('contentitem_logo_image_name')->nullable();
            $table->string('contentitem_url')->nullable();
            $table->integer('filter_id')->nullable();
            $table->integer('marka_id')->nullable();
            $table->integer('custom_order')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('site_content_items');
    }
}
