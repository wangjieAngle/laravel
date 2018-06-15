<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Testtwo;
use Illuminate\Support\Facades\Crypt;

class TestController extends Controller
{
    //

    public function one()
    {
        return view('test/one');
    }

    public function two()
    {
        echo TestController::class;
        echo '<br>';
    }

    public function getTestFacade()
    {

//        $test = resolve('testtwo');
//        var_dump($test->getTest());
        var_dump(Testtwo::getTest());
//        dd(Testtwo::getTest());
        dd(Testtwo::getName());
        $name = Testtwo::getName();
        echo $name;
    }

    public function three()
    {
        $name = '123';
        $encrypt = encrypt($name);
        $decrypt = decrypt($encrypt);
        var_dump($name);
        var_dump($encrypt);
        var_dump($decrypt);

        $name = '123';
        $encrypt = Crypt::encryptString($name);
        $decrypt = Crypt::decryptString($encrypt);
        var_dump($name);
        var_dump($encrypt);
        var_dump($decrypt);

    }
}
