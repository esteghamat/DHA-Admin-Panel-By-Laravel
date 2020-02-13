<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('marka_name');
            $table->string('marka_keywords')->nullable();
            $table->string('marka_description')->nullable();
            $table->string('marka_logo_image_name');
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
        Schema::dropIfExists('markas');
    }
}
