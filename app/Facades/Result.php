<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class Result extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'result';
    }
}