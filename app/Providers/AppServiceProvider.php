<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function($view)
        {
            //$c_domain = $_SERVER['SERVER_NAME'];
            $c_domain = 'tripdesigner.net';
            $fixed_domain = 'http://localhost/tam';
            $rows = DB::table('domain')->where('name',$c_domain)->first();
            $c_info = DB::table('company_info')->where('agent_id',@$rows->agent_id)->first();
            $view->with('domain', $fixed_domain);
            $view->with('c_info', $c_info);
            $company = DB::table('users')->where('id',Session::get('user_id'))->first();
            $view->with('company_info', $company);
        });
        Paginator::useBootstrap();
    }
}
