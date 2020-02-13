<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetSlugToUnıqueOnMarkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('markas' , function($table){
            $table->unique('marka_slug' , 'markas_slug_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
    public function down()
    {
        Schema::table('markas' , function($table){
            $table->dropUnique('markas_slug_unique');
        });
    }
}
