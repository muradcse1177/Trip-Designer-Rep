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
//            $c_domain = $_SERVER['SERVER_NAME'];
            //dd($c_domain);
            $c_domain = 'tripdesigner.net';
            $fixed_domain = 'https://tripdesigner.net'; //http://localhost/tam
            $rows = DB::table('domain')->where('name',$c_domain)->first();
            $c_info = DB::table('company_info')->where('agent_id',@$rows->agent_id)->first();
            $view->with('domain', $fixed_domain);
            $view->with('c_info', $c_info);
            $company = DB::table('users')->where('id',Session::get('user_id'))->first();
            $agent = DB::table('users')->where('id',Session::get('agent_id'))->first();
            if(@$company->status == 'In Active'){
                return redirect()->to('all-login')->with('errorMessage', 'Your Id is Inactive!! Please contact to admin.');
            }
            if(@$company->role == 5){
                $employee = DB::table('employees')->where('email',$company->company_email)->first();
                $role = DB::table('assign_role')->where('agent_id',$employee->agent_id)->where('designation',$employee->designation)->first();
                $attributes = DB::table('attribute')->get();
                $view->with('role', $role);
                $view->with('attributes', $attributes);
            }
            $view->with('company_info', $company);
            $view->with('agent_info', $agent);
        });
        Paginator::useBootstrap();
    }
}
