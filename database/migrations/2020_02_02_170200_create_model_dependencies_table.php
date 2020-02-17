<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelDependenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_dependencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model_name');
            $table->string('related_model_name');
            $table->string('eloquent_related_model_method');
            $table->boolean('is_delete_allowed_with_all_children');
            $table->string('message_first_part');
            $table->string('message_second_part');
            $table->timestamps();
        });

        DB::table('model_dependencies')->insert([ 
          ['model_name' => 'Marka',    'related_model_name' => 'Portfolio', 'eloquent_related_model_method' => 'portfolios' , 'is_delete_allowed_with_all_children' => false, 'message_first_part' => 'Bu mraka ', 'message_second_part' => '  iş/işler var.'],
          ['model_name' => 'Category', 'related_model_name' => 'Category', 'eloquent_related_model_method' => 'get_children', 'is_delete_allowed_with_all_children' => false, 'message_first_part' => 'Bu kategori ', 'message_second_part' => '  alt kategory var.'],
          ['model_name' => 'Filter', 'related_model_name' => 'Portfolio', 'eloquent_related_model_method' => 'portfolios', 'is_delete_allowed_with_all_children' => false, 'message_first_part' => 'Bu filter ', 'message_second_part' => ' işler var.'],
          ['model_name' => 'Portfolio', 'related_model_name' => 'Gallery', 'eloquent_related_model_method' => 'get_galleries', 'is_delete_allowed_with_all_children' => true, 'message_first_part' => 'Bu iş ', 'message_second_part' => ' galeri var.'],
          ['model_name' => 'Gallery', 'related_model_name' => 'Gallery_Image', 'eloquent_related_model_method' => 'get_gallery_images', 'is_delete_allowed_with_all_children' => true, 'message_first_part' => 'Bu galeri ', 'message_second_part' => ' görüntü var.'],
          ['model_name' => 'Config_Type', 'related_model_name' => 'Site_Config', 'eloquent_related_model_method' => 'site_configs', 'is_delete_allowed_with_all_children' => false, 'message_first_part' => 'Bu ayar türü ', 'message_second_part' => ' ayar var.'],
      ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_dependencies');
    }
}
