<?php
namespace Toyosi12\Plunk\Facades;
use Illuminate\Support\Facades\Facade;

class Plunk extends Facade{
    protected static function getFacadeAccessor(){
        return 'laravel-plunk';
    }
}