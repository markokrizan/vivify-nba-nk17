<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // Ovu base klasu moze da nasledi vise test klasa
    // Koristimo staticku metodu da delimo stanje ovog flega
    // Sa svim instancama
    private static $migratedAndSeeded = false;

    public function setUp(): void 
    {
        // Parent butstrapuje aplikaciju - potrebno prvo ovo odraditi
        // Da bi dobili pristup koriscenju fasada
        parent::setUp(); 

        if (!self::$migratedAndSeeded) {
            Artisan::call('migrate:fresh --seed');

            self::$migratedAndSeeded = true;
        }
    }
}
