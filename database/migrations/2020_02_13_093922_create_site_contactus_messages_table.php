<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteContactusMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_contactus_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contactus_name');
            $table->string('contactus_email');
            $table->string('contactus_phonenumber')->nullable();
            $table->string('contactus_message_subject');
            $table->text('contactus_message_text');
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
        Schema::dropIfExists('site_contactus_messages');
    }
}
