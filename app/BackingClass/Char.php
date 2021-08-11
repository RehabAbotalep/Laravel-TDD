<?php


namespace App\BackingClass;


use Illuminate\Support\Str;

class Char
{

    public function getCamelCaseFromSnakeCase(string $string): string
    {
        return Str::camel($string);
    }
}
