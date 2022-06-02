<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        
        // Ugradjeni view-ovi za prikaz kontrola za paginaciju
        // Koji se rendaju sa ->links() metodom postoje u varijanti 
        // uradjenoj pomocu tailwind i bootstrap biblioteke
        // ovim naznacujemo da hocemo da prikazujemo bootstrap varijantu
        Paginator::useBootstrap();
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
