<?php

namespace App\Providers;

use Illuminate\Testing\TestResponse;
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
        TestResponse::macro('assertData', function ($json) {
            $this->assertJson([
                'data' => $json,
            ]);

            return $this;
        });
        TestResponse::macro('assertDataStructure', function ($structure) {
            $this->assertJsonStructure([
                'data' => $structure,
            ]);

            return $this;
        });
    }
}
