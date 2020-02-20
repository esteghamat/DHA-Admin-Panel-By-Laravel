<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Footer;
use View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      
      View::share('key', 'value');
      Schema::defaultStringLength(191);

      // ORM does not work in the boot 
      // $footer = Footer::first();
      $footer = \DB::table('footers')->first();
      View::share('footer',$footer);      

      // sample 
      // this does not work in boot 
      // $ActiveProject = ThemeConfig::where('module_type',"project")->where('active',"1")->first()->file;
      // but this works
      // $ActiveProject = \DB::table('theme_configs')->where('module_type',"project")->where('active',"1")->first()->file;



    }
    
}
