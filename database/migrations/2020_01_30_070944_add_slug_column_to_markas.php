<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Marka;

class AddSlugColumnToMarkas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('markas', function (Blueprint $table) {
        $table->string('marka_slug')->after('marka_name')->default();
        });

        $markas = Marka::all();
        foreach($markas as $marka)
        {
            $marka->marka_slug = str_replace(' ','-',$marka->marka_name) . $marka->id ;
            $marka->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('markas', function (Blueprint $table) {
        $table->dropColumn('marka_slug');
        });
    }
}
