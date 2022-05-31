<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
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
        // DB::listen(function ($query) {
        //     echo '<pre>';
        //     echo $query->sql;
        //     // var_dump([
        //     //     $query->sql,
        //     //     $query->bindings,
        //     //     $query->time
        //     // ]);
        //     echo '</pre>';
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
