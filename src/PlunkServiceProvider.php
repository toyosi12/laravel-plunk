<?php
/**
 * This file is part of the Laravel Plunk Package
 * 
 * (c) Toyosi Oyelayo <toyosioyelayo@gmail.com>
 */

namespace Toyosi12\Plunk;

use Illuminate\Support\ServiceProvider;


class PlunkServiceProvider extends ServiceProvider{
    public function boot(){
        $this->mergeConfigFrom(__DIR__ . '/config/plunk.php', 'plunk');

        $this->publishes([
            __DIR__ . '/config/plunk.php' => config_path('plunk.php'),
        ]);
    }


    public function register(){
        $this->app->bind('laravel-plunk', function(){
            return new Plunk;
        });
    }

    public function provides(){
        return ['laravel-plunk'];
    }
}