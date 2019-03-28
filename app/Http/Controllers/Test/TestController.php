<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Testtwo;
use Illuminate\Support\Facades\Crypt;
use App\Model\SaleConfig;

class TestController extends Controller
{
    //

    public function one()
    {


        $sum = 0;
        for( $i = 0; $i < 10 ; $i++ ) {
            $sum += $i;
        }
        echo $sum;

        echo 1;
        exit;
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

    public function four()
    {
        $opensslConfigPath = 'E:\phpstudy\Apache\conf\openssl.cnf';

        $config = array(
//            'private_key_bits' => 2048,
            'private_key_bits' => 512,
        );
        $res = openssl_pkey_new($config);
        if(!$res) {
            $config['config'] = $opensslConfigPath;
            $res = openssl_pkey_new($config);
        }
        openssl_pkey_export($res, $private_key, null, ['config' => $opensslConfigPath]);
        $public_key=openssl_pkey_get_details($res);
        var_dump( $private_key );
        echo "<br />";
        var_dump( $public_key['key'] );
        $private_key = $private_key;
        $public_key = $public_key['key'];
        $data = '你好123abc';
        openssl_public_encrypt($data, $encrypted, $public_key);
        $encrypted = base64_encode($encrypted);
        echo "公钥加密后的数据:".$encrypted."<br />";
        openssl_private_decrypt(base64_decode($encrypted), $decrypted, $private_key);//私钥解密
        echo "私钥解密后的数据:".$decrypted."<br />";
//        exit;

        $pri = '-----BEGIN PRIVATE KEY----- MIIBVQIBADANBgkqhkiG9w0BAQEFAASCAT8wggE7AgEAAkEAv1zbJNYJeROswBFk J51zKjabi57o2woZXKSlBhW8z3rmz3ND/tIwBr2nZuyX58p3QSFJrDcMD/zmhnsU YbASzQIDAQABAkAnOSgt57UvXQoGoEnwGMS3PVQqjRrbcrl6FMFCewglWofFZGRm McKWAB/kpd6HnoF8CY6dS8pFdTXCaRDms9fdAiEA6LzBeiffgcz88pYnbpnfhFl9 ZMM5UV0UBqfyqBzTEmcCIQDSfWnjZ1gNRSeZmw0tKeraAV36ixFd5ygCC/NKrMn4 qwIhAJxeNZ/dKk4La+eQ+u1UdNh3R8hrYhdIciwGqwJIW4gBAiBdlakIlCAP9lk+ 8DMRi3uBZe40wLP9/hJJpqqK3vwFdQIhALbxtbr+8E/gi+lRAp+O62aDawnVwBRy PTexWxFkvv3J -----END PRIVATE KEY----- ';
        $pub = '-----BEGIN PUBLIC KEY----- MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAL9c2yTWCXkTrMARZCedcyo2m4ue6NsK GVykpQYVvM965s9zQ/7SMAa9p2bsl+fKd0EhSaw3DA/85oZ7FGGwEs0CAwEAAQ== -----END PUBLIC KEY----- ';
        $encrypted = 'fyZ116OXhFex8OAbUYIQreEvD+BN47AIbHlkzfgfGlCekF7lvGI7Na9lSi0t0gnqRw3B+Lva21xZO8Ym3RcdUg==';
        openssl_private_decrypt(base64_decode($encrypted), $decrypted, $pri);//私钥解密
        var_dump($decrypted);exit;

        $private_key = '';
        //创建公钥和私钥
/*        $res=openssl_pkey_new(array('private_key_bits' => 512)); //此处512必须不能包含引号。
dd($res);
        //提取私钥
        openssl_pkey_export($res, $private_key);

        //生成公钥
        $public_key=openssl_pkey_get_details($res);
        var_dump($res);
        var_dump($public_key);
        var_dump($private_key);*/
    }

    public function Encryption($baseNum, $pub_key, $msg)
    {
        $newmsg = '';

        $newmsg = round(pow($msg, $pub_key)) % $baseNum;
        return $newmsg;

    }

    public function utf8_str_to_unicode($utf8_str) {
        $unicode = 0;
        $unicode = (ord($utf8_str[0]) & 0x1F) << 12;
        $unicode |= (ord($utf8_str[1]) & 0x3F) << 6;
        $unicode |= (ord($utf8_str[2]) & 0x3F);
        return dechex($unicode);
    }

    public function fire()
    {
        $baseNum = 33;
        $pub_key = 3;
        $pri_key = 7;
        $msg = 17;
        var_dump($msg);
        echo "<br />";
//        $msg = $this->utf8_str_to_unicode($msg);
//        var_dump($msg);
//        echo "<br />";
        $encryption = $this->Encryption($baseNum, $pub_key, $msg);

        var_dump($encryption);
        echo "<br />";
        $msg = $encryption;
        $Decrypt = $this->Encryption($baseNum, $pri_key, $msg);

        var_dump($Decrypt);
        echo "<br />";



    }

    public function decrypthtml()
    {
        return view('test/decrypthtml');
    }

    public function decrypt(Request $request)
    {
        $encrypted = $request->encrypt;

        $pri = file_get_contents('./lib/rsa_1024_priv.pem');

        openssl_private_decrypt(base64_decode($encrypted), $decrypted, $pri);

        dd($decrypted);
    }

    public function md5(Request $request)
    {
        dd(md5($request->name));
    }

    public function six(Request $request)
    {
//        $data = array('no_prefix ','foo'=>'bar','baz'=>'boom','cow'=>'milk','php'=>'hypertext processor');
//        var_dump($data);
//        echo "<br />";
//        $one = http_build_query($data);
//        var_dump($one);
//        echo "<br />";
//        $two = http_build_query($data, '', '&');
//        dd($two);

        $param = $request->param;
        $one = $request->one;
        $two = $request->two;
        return [$param, $one, $two];
    }

    public function get(Request $request) {
        $param = $request->param;
        $one = $request->one;
        $two = $request->two;
        return [$param, $one, $two];
    }

    public function post(Request $request) {
        $param = $request->param;
        $one = $request->one;
        $two = $request->two;
        return [$param, $one, $two];
    }

    public function getConfigParam() {
//        dd(config('app.env'));
//        dd(config('app.test'));
        $str = NULL;
        $str .= 'jie';

var_dump($str);
//        dd(env('APP_NAME'));
//        dd(env('APP_ENV'));
//        return config('');
        exit;
    }

    public function ftpUpload() {

        dd(md5('jie-elec'));



        $ppid = posix_getpid();
        $pid = pcntl_fork();
        if ($pid == -1) {
            throw new Exception('fork子进程失败!');
        } elseif ($pid > 0) {
            cli_set_process_title("我是父进程,我的进程id是{$ppid}.");
            sleep(30); // 保持30秒，确保能被ps查到
        } else {
            $cpid = posix_getpid();
            cli_set_process_title("我是{$ppid}的子进程,我的进程id是{$cpid}.");
            sleep(30);
        }
        dd(123);




        /*dd(decbin(7));

        foreach ($this->paytype as $key => $value) {
            if ($payType & $value = $value) {

            }
        }*/

        $one = '{
    "task_name":"任务名称"
    , "execute_type":"1"
    , "sys_type":"1"
    , "business_type":"1"
    , "architecture":[
        {"code_d":"省编号","code_a":"市编号","code_o":"区编号"}
        , {"code_d":"省编号","code_a":"市编号","code_o":"区编号"}
    ]
    , "operateAddress":[
        {"code_p":"省编号","code_c":"市编号","code_d":"区编号","code_a":"商圈编号"}
        , {"code_p":"省编号","code_c":"市编号","code_d":"区编号","code_a":"商圈编号"}
    ]
    , "category":[
        {"code_one":"一级编号", "code_two":"二级编号"}
        , {"code_one":"一级编号", "code_two":"二级编号"}
    ]
    , "credit_amount":{"min_amount":"最小金额", "max_amount":"最大金额"}
    , "rate":"0"
    , "blacklist":"1"
    , "contact_time":{"status":"1","begin_time":"2018-07-30","end_time":"2018-07-31"}
    , "store_status":"0"




    , "approval_amount":{"min_amount":"最小金额", "max_amount":"最大金额"}
    , "contract_expiration_time":{"begin_time":"2018-07-30","end_time":"2018-07-31"}
    , "last_contact_time":{"begin_time":"2018-07-30","end_time":"2018-07-31"}


    , "current_credit_amount":{"min_amount":"最小金额", "max_amount":"最大金额"}
    , "last_loan_settlement_time":{"begin_time":"2018-07-30","end_time":"2018-07-31"}
    , "last_loan_amount":{"min_amount":"最小金额", "max_amount":"最大金额"}

    , "recent_shelf_time":{"begin_time":"2018-07-30","end_time":"2018-07-31"}
    , "ac_transactions_num":{"min_amount":"最小笔数", "max_amount":"最大笔数"}
    , "ac_transactions_amount":{"min_amount":"最小金额", "max_amount":"最大金额"}
    , "is_credit_amount":"1"
}';
        dd(json_decode($one, true));




        $str = SaleConfig::query()->where('key', 'TEST')->value('value');
        dd(json_decode($str, true));

        $str = '{"1111" : [{"A-1" : []}], "2222" : [{"B-1" : [{ "B-1-1" : [{"B-1-1"}]}]}]}';
        var_dump(json_decode(json_encode($str), true));
exit;

        var_dump($str);




        $str = '2018-06-20 13:48:05.631';
        dd(date_create_from_format('Hisu', $str));
        $date = date_create($str);
        var_dump(date_format($date,'Hisu'));
        exit;


        $str = date('Ymd');
        /*$storage_path = public_path().'/'.$str;
        mkdir($storage_path,0775);*/
        $storage_path = public_path().'/'.$str;
        $myfile = fopen($storage_path.'/one.txt', 'w');
        $str = 'jiege --';
        fwrite($myfile, $str);
        fclose($myfile);
        dd(123);




        $conn = ftp_connect("10.10.23.53") or die("Could not connect");    //连接标识ftp_connect("ftp地址")
        ftp_login($conn,"ftptest","123456");  //进行FTP连接ftp_login($conn,"用户名",“登录密码")
//        var_dump($conn);
//        exit;

        var_dump(ftp_put($conn,"one.txt","E:/one.txt",FTP_BINARY));

        //ftp_put($conn,"上传后文件的命名.doc","指定本地要上的文件"，传输模式) *FTP_ASCII   FTP_BINARY（文件中文内容不会乱码）

        ftp_close($conn);
    }


    public function declareTicks()
    {
        declare(ticks=1);

        function tick_handler()
        {
            echo "tick_handler() called\n";
        }

        register_tick_function('tick_handler');

        $a = 1;

        if ($a > 0) {
            $a += 2;
            print($a);
        }
    }


    public function jwt()
    {
        $token = $this->jwt_encode();
        return $token;
    }



    public function jwt_encode()
    {
        $data = [
            'one' => 1
            , 'two' => 2
        ];
        $customClaims = ['sub' => $data];

//        $payload = \Tymon\JWTAuth\Facades\JWTFactory::customClaims($customClaims)->make();
        $payload = \Tymon\JWTAuth\Facades\JWTFactory::sub([
            'one' => 1
            , 'two' => 2
        ])->make();
//        dd($payload);
        $token   = \Tymon\JWTAuth\Facades\JWTAuth::encode($payload);

        $token = current(object_to_array($token));
        return $token;
    }

    public function jwt_decode($token)
    {
        try {
            $data = \JWTAuth::setToken($token)->getPayload()->get('sub');
        } catch (\Exception $exception) {
            $data = [];
        };
        return $data;
    }

    public function testxu()
    {
        \DB::table('vape_shops_audit')->whereIn('id' , function ($query) {
            $query->max('id')
                ->from('vape_shops_audit')
                ->groupBy('shop_id');
        })->orderBy('id', 'desc')
            ->get();

    }

}
