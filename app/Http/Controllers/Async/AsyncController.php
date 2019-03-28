<?php

namespace App\Http\Controllers\Async;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsyncController extends Controller
{
    public function one()
    {

        $a = microtime(true)*10000;
        var_dump($a);
        exit;

        ignore_user_abort(true);
        set_time_limit(0);
//        $url = 'http://homestead.test/async/one2';
        $url = 'http://www.mytest.com/async/one2?init=0';
        \Log::info("one == begin");
//        $this->doRequest($url, ['init'=> 0]);
//        $this->_sock_get($url);
        $this->_sock_post($url, ['init'=> 0]);
        return ['status' => 200, 'msg' => 'success'];
    }

    public function _sock_post($url, $param)
    {
        ignore_user_abort(true);
        set_time_limit(0);
        $host = parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT);
        $port = $port ? $port : 80;
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $path = parse_url($url, PHP_URL_PATH);
        $query = parse_url($url, PHP_URL_QUERY);
        if ($query) $path .= '?' . $query;
        if ($scheme == 'https') {
            $host = 'ssl://' . $host;
        }
        $error_code = 0;
        $error_msg = '';
        $timeout = 10;
        \Log::info("进入  --- _sock_post");
        \Log::info("host : $host  , port : $port \n");
        \Log::info("$error_code , $error_msg, $timeout \n");
        $fp = fsockopen($host, $port, $error_code, $error_msg, 1);
        if (!$fp) {
            return array('error_code' => $error_code, 'error_msg' => $error_msg);
        } else {
//            stream_set_blocking($fp, true);//开启了手册上说的非阻塞模式
//            stream_set_timeout($fp, 1);//设置超时
            $query = http_build_query($param);
            $header = "POST $path HTTP/1.1\r\n";
            $header .= "Host: $host\r\n";
            $header .= "content-length:".strlen($query)."\r\n";
            $header .= "content-type:application/x-www-form-urlencoded\r\n";
            $header .= "connection:close\r\n\r\n";
            $header .= $query;
//            $header .= "Connection: close\r\n\r\n";//长连接关闭
            fwrite($fp, $header);
            usleep(1000); // 这一句也是关键，如果没有这延时，可能在nginx服务器上就无法执行成功
            fclose($fp);
            return array('error_code' => 0);
        }
    }

    public function _sock_get($url)
    {
        ignore_user_abort(true);
        set_time_limit(0);
        $host = parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT);
        $port = $port ? $port : 80;
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $path = parse_url($url, PHP_URL_PATH);
        $query = parse_url($url, PHP_URL_QUERY);
        if ($query) $path .= '?' . $query;
        if ($scheme == 'https') {
            $host = 'ssl://' . $host;
        }
        $error_code = 0;
        $error_msg = '';
        $timeout = 10;
        \Log::info("进入  --- _sock");
        \Log::info("host : $host  , port : $port \n");
        \Log::info("$error_code , $error_msg, $timeout \n");
        $fp = fsockopen($host, $port, $error_code, $error_msg, 1);
        if (!$fp) {
            return array('error_code' => $error_code, 'error_msg' => $error_msg);
        } else {
            stream_set_blocking($fp, true);//开启了手册上说的非阻塞模式
            stream_set_timeout($fp, 1);//设置超时
            $header = "GET $path HTTP/1.1\r\n";
            $header .= "Host: $host\r\n";
            $header .= "Connection: close\r\n\r\n";//长连接关闭
            fwrite($fp, $header);
            usleep(1000); // 这一句也是关键，如果没有这延时，可能在nginx服务器上就无法执行成功
            fclose($fp);
            return array('error_code' => 0);
        }
    }


    public function doRequest($url, $param)
    {
        try {

            $urlinfo = parse_url($url);
            $host = $urlinfo['host'];
            $path = $urlinfo['path'];
            $query = isset($param)?http_build_query($param):'';
            $port = 80;
            $errno = 0;
            $errstr = '';
            $timeout = 10;
            \Log::info("进入  --- doRequest");
            \Log::info("host : $host  , port : $port \n");
            \Log::info("$errno , $errstr, $timeout \n");
            $fp = fsockopen($host, $port, $errno, $errstr, $timeout);

            $out = "POST". $path . " HTTP/1.1\r\n";
            $out .= "host:".$host."\r\n";
            $out .= "content-length:".strlen($query)."\r\n";
            $out .= "content-type:application/x-www-form-urlencoded\r\n";
            $out .= "connection:close\r\n\r\n";
            $out .= $query;
            \Log::info("$out \n");
            fwrite($fp, $out);
            usleep(1000);
            fclose($fp);
        } catch (\Exception $e) {
            \Log::info("error : " . $e->getMessage() . "  line  :" . $e->getLine() );
        }

    }

    public function doRequest2()
    {
        $errno = 0;
        $errstr = '';
        $fp = fsockopen("homestead.test", 80, $errno, $errstr, 30);
        if (!$fp) {
            echo "$errstr ($errno)<br />\n";
        } else {
            $out = "GET /async/one2 / HTTP/1.1\r\n";
            $out .= "Host: homestead.test\r\n";
            $out .= "Connection: Close\r\n\r\n";

            fwrite($fp, $out);
            /*忽略执行结果
          while (!feof($fp)) {
          echo fgets($fp, 128);
          }*/
            fclose($fp);
        }
    }


    public function one2(Request $request)
    {
        \Log::info("begin");
        \Log::info("init  : value -$request->init \n");

        /*$i = $request->init;
        for (; $i < 100; $i++) {
            echo $i.'--';
//            sleep(2);
            \Log::info("value === " . $i);
        }*/
        ignore_user_abort(true);
        set_time_limit(0);
        \Log::info("value === " . 1);
        sleep(10);
        \Log::info("value === " . 2);
        sleep(20);
        \Log::info("value === " . 3);
        sleep(20);
        \Log::info("value === " . 4);
        sleep(20);
        \Log::info("value === " . 5);
        sleep(20);
        \Log::info("value === " . 6);
        sleep(20);
        \Log::info("value === " . 7);
        sleep(20);
    }

    public function yemian()
    {
        $arr = [1,2,3,4,5];
        return view('yemian/one', [
            'arr' =>$arr
        ]);
    }

    public function yemian2()
    {
        return ['data' =>
            [1,2,3,4,5]
        ];
    }


    public function variable()
    {

        $memory_value1 = memory_get_usage();
        echo "一开始的占用内存值 => $memory_value1  <br />";
        $userno = "U2201711221000245254";
        $user_result = "";
        for ($i = 0; $i < 1000000; $i++) {
            $user_result .= $userno . ',';
        }
        $memory_value2 = memory_get_usage();
        $len = strlen($user_result);
        echo "len   $len  <br />";
        echo "设置一个变量- $userno -的内存占用值 => $memory_value2 <br /> ";
        unset($user_result);
        $memory_value3 = memory_get_usage();
        echo "unset 这个变量的内存占用值 => $memory_value3 <br /> ";
    }


    public function ueditor()
    {
        return view('yemian/ueditor');
    }


    public function arrayone()
    {
        $test = [
            1 => "00:00 - 00:00"
            , 3 => "01:00 - 02:00"
            , 4 => "00:00 - 00:00"
            , 7 => ""
        ];

        /*$new_arr = [];
        foreach ($test as $key => $value) {
            if (!array_key_exists($value, $new_arr)) {
                $new_arr[$value] = $key;
            } else {
                $new_arr[$value] = $new_arr[$value].','.$key;
            }
        }

        $arr = [];
        foreach ($new_arr as $k => $v) {
            $arr[] = [
                'week' => explode(',', $v)
                , 'date' => $k
            ];
        }*/


        for ($i = 0; $i < count($test); $i++) {

        }



//        dd($arr);


//        dd($new_arr);


        dd($test);
    }

}
