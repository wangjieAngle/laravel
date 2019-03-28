<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;

class LoginController extends Controller
{
    //

    public function index(){
        return view("login.index");
    }


    public function login(Request $request)
    {
//        var_dump(session("15759948261"));exit;
        $tel = $request->tel;
        $passwd = $request->passwd;
        $name = User::where('tel', $tel)->value("name");
        if (empty($name)) return \Response::json(['status'=>404, 'msg' => 'not find']);

        if ($name != $passwd) return response()->json(['status'=> 401, 'msg' => "permission error"])->throwResponse();

        $date = [
            'tel' => $tel,
            'name' => $name
        ];
        $a = session()->put('15759948261', "jiege");
        var_dump($a);
        var_dump(session_id());
//        session($tel, $date);
        return \Response::view('login.success');
    }


    public function getData(Request $request)
    {
        var_dump($_SERVER);exit;
        var_dump($request->cookies);exit;
        $key = $request->key;
        $date = $request->session()->get($key);

        echo 'this is getDate<br>';

    }

}
