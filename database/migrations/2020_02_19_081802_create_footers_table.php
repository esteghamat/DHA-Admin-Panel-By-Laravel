<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('whatsapp')->nullable();
            $table->string('phone')->nullable(); 
            $table->string('email')->nullable(); 
            $table->text('address')->nullable(); 
            $table->string('facebook')->nullable(); 
            $table->string('twitter')->nullable(); 
            $table->string('instagram')->nullable(); 
            $table->string('linkedin')->nullable(); 
            $table->string('kvkk_title')->nullable(); 
            $table->string('kvkk_link')->nullable(); 
            $table->string('isortaklari_title')->nullable(); 
            $table->string('isortaklari_link')->nullable(); 
            $table->string('partnerler_title')->nullable(); 
            $table->string('partnerler_link')->nullable(); 
            $table->string('kariyer_title')->nullable(); 
            $table->string('kariyer_link')->nullable(); 
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
        Schema::dropIfExists('footer');
    }
}
