<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Char extends Facade
{
    /**
     * Class Char
     * @method static String testFacade().
     * @package App\Facades
     */
    protected static function getFacadeAccessor(): string
    {
        return "\App\BackingClass\Char";
    }
}
