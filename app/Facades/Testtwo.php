<?php
/**
 * Created by PhpStorm.
 * User: clown
 * Date: 2018/6/6
 * Time: 16:52
 */
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Testtwo extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'testtwo';
    }

    public static function getName()
    {
        return 'jiege';
    }


}