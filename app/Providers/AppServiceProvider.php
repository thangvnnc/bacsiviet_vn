<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['request']->server->set('HTTPS','on');
        view()->composer('main.footer',function($view){
            $hl = Config::where('id',1)->where('status',1)->first();
            $view->with('hl',$hl); 
        });
        view()->composer('bacsiviet.contactUs',function($view){
            $hl = Config::where('id',1)->where('status',1)->first();
            $view->with('hl',$hl); 
        });
        view()->composer('bacsi-detail',function($view){
            $hl = Config::where('id',1)->where('status',1)->first();
            $view->with('hl',$hl); 
        });
        view()->composer('chitiet_csyt',function($view){
            $hl = Config::where('id',1)->where('status',1)->first();
            $view->with('hl',$hl); 
        });
        view()->composer('khuyenmai',function($view){
            $hl = Config::where('id',1)->where('status',1)->first();
            $view->with('hl',$hl); 
        });
        view()->composer('khuyenmai_detail',function($view){
            $hl = Config::where('id',1)->where('status',1)->first();
            $view->with('hl',$hl); 
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
