<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('portfolio_title');
            $table->string('portfolio_slug')->unique();
            $table->string('portfolio_keywords')->nullable();
            $table->string('portfolio_description');
            $table->string('portfolio_image_name');
            $table->integer('marka_id');
            // $table->integer('category_id');
            $table->integer('filter_id');
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
        Schema::dropIfExists('portfolios');
    }
}
