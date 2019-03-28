<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\TestJob;
use Predis\Client;


class TestCommondOne extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testcommond:jie';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command test';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $a = '%E7%81%8F%3F%3F%3F%3F%3F%3F%3F%3F%E5%87%A4%3F%3F%3F%E6%B7%87%EF%BF%A0%3F+%E6%90%
B4%EF%B9%80%E3%81%8A%E6%B5%A3%3F%E9%94%9B%3F%E6%B6%93%3F%3F%3F%3F%3F%E6%B5%A3%3F
%E9%94%9B%3F%3F%E5%86%B2%3F%3F%3F%3F%E6%A5%82%3F%3F%3F%E6%B7%87%EF%BF%A0%3F%2A%E
6%90%B4%EF%B8%BC%3F%E8%B9%87%3F%3F%E5%A9%9A%3F%3F%3F%E5%8D%9E%3F%3F%3F%3F%E7%80%
B9%3Fpp%3F%3F%3F%3F%2A%E6%A3%B0%3F%3F%D1%8D%3F%E6%BF%A1%3F%3F%3F%E7%94%AF%3F%3F%
E2%95%8B%3F%E7%92%87%E7%96%AF%3F%3F%E7%BB%AF%E8%AF%B2%3F%3F%E9%A3%8E%3F%3F%3F%3F
%3F%3F%3F%E7%92%81%E3%88%A2%3F%3F%3F%3FT';

//        var_dump(urlencode('!'));
//        var_dump(urlencode('+'));

//        var_dump(urldecode(urlencode('*')));
//        exit;
//        var_dump(urlencode(mb_convert_encoding('*', 'utf-8')));
//        exit;
//        header("Content-Type:text/html;charset=utf-8");
//        $str = '尊敬的商户，授信额 度太低？一键操作，即可提高授信额度！快登陆钱包商家app里提额吧！如需帮助，请联系客户经理。退订码回T';
        $str = '尊敬的商户，授信额 度太低？一键操作，即可提高授信额*度！快登陆钱包商家app里提*额吧！如需帮助，请联系客户经理。退订码回T';
        echo urlencode(mb_convert_encoding($str, 'utf-8', 'gb2312'));
        exit;
        var_dump(urlencode($str));
        exit;
//        $str = '你好啊';

        var_dump($str === mb_convert_encoding($str, 'utf-8'));

        $a = urlencode(mb_convert_encoding($str, 'utf-8'));
        var_dump($a);
        var_dump(urldecode($a));
        \Log::info(urldecode($a));
        exit;
        $b = '%E5%B0%8A%E6%95%AC%E7%9A%84%E5%95%86%E6%88%B7%EF%BC%8C%E6%8E%88%E4%
BF%A1%E9%A2%9D+%E5%BA%A6%E5%A4%AA%E4%BD%8E%EF%BC%9F%E4%B8%80%E9%94%AE%E6%93%8D%E
4%BD%9C%EF%BC%8C%E5%8D%B3%E5%8F%AF%E6%8F%90%E9%AB%98%E6%8E%88%E4%BF%A1%E9%A2%9D%
2A%E5%BA%A6%EF%BC%81%E5%BF%AB%E7%99%BB%E9%99%86%E9%92%B1%E5%8C%85%E5%95%86%E5%AE
%B6app%E9%87%8C%E6%8F%90%2A%E9%A2%9D%E5%90%A7%EF%BC%81%E5%A6%82%E9%9C%80%E5%B8%A
E%E5%8A%A9%EF%BC%8C%E8%AF%B7%E8%81%94%E7%B3%BB%E5%AE%A2%E6%88%B7%E7%BB%8F%E7%90%
86%E3%80%82%E9%80%80%E8%AE%A2%E7%A0%81%E5%9B%9ET';

        $c = '%E5%B0%8A%E6%95%AC%E7%9A%84%E5%95%86%E6%88%B7%EF%BC%8C%E6%8E%88%E4%
BF%A1%E9%A2%9D+%E5%BA%A6%E5%A4%AA%E4%BD%8E%EF%BC%9F%E4%B8%80%E9%94%AE%E6%93%8D%E
4%BD%9C%EF%BC%8C%E5%8D%B3%E5%8F%AF%E6%8F%90%E9%AB%98%E6%8E%88%E4%BF%A1%E9%A2%9D%
2A%E5%BA%A6%EF%BC%81%E5%BF%AB%E7%99%BB%E9%99%86%E9%92%B1%E5%8C%85%E5%95%86%E5%AE
%B6app%E9%87%8C%E6%8F%90%2A%E9%A2%9D%E5%90%A7%EF%BC%81%E5%A6%82%E9%9C%80%E5%B8%A
E%E5%8A%A9%EF%BC%8C%E8%AF%B7%E8%81%94%E7%B3%BB%E5%AE%A2%E6%88%B7%E7%BB%8F%E7%90%
86%E3%80%82%E9%80%80%E8%AE%A2%E7%A0%81%E5%9B%9ET';

        $a = md5('317c1015759948261'. urlencode($str));
        var_dump($a);
        var_dump(urlencode($str));
        //        var_dump($a == '15198a721bbf7a53379a0bb2bb77bb2c');

/*        $a = '%E5%B0%8A%E6%95%AC%E7%9A%84%E5%95%86%E6%88%B7%EF%BC%8C%E6%8E%88%E4%
BF%A1%E9%A2%9D+%E5%BA%A6%E5%A4%AA%E4%BD%8E%EF%BC%9F%E4%B8%80%E9%94%AE%E6%93%8D%E
4%BD%9C%EF%BC%8C%E5%8D%B3%E5%8F%AF%E6%8F%90%E9%AB%98%E6%8E%88%E4%BF%A1%E9%A2%9D%
E5%BA%A6%EF%BC%81%E5%BF%AB%E7%99%BB%E9%99%86%E9%92%B1%E5%8C%85%E5%95%86%E5%AE%B6
app%E9%87%8C%E6%8F%90%E9%A2%9D%E5%90%A7%EF%BC%81%E5%A6%82%E9%9C%80%E5%B8%AE%E5%8
A%A9%EF%BC%8C%E8%AF%B7%E8%81%94%E7%B3%BB%E5%AE%A2%E6%88%B7%E7%BB%8F%E7%90%86%E3%
80%82%E9%80%80%E8%AE%A2%E7%A0%81%E5%9B%9ET';*/


$a = '%E5%B0%8A%E6%95%AC%E7%9A%84%E5%95%86%E6%88%B7%EF%BC%8C%E6%8E%88%E4%BF%A1%E9%A2%9D+%E5%BA%A6%E5%A4%AA%E4%BD%8E%EF%BC%9F%E4%B8%80%E9%94%AE%E6%93%8D%E4%BD%9C%EF%BC%8C%E5%8D%B3%E5%8F%AF%E6%8F%90%E9%AB%98%E6%8E%88%E4%BF%A1%E9%A2%9D*%E5%BA%A6%EF%BC%81%E5%BF%AB%E7%99%BB%E9%99%86%E9%92%B1%E5%8C%85%E5%95%86%E5%AE%B6app%E9%87%8C%E6%8F%90*%E9%A2%9D%E5%90%A7%EF%BC%81%E5%A6%82%E9%9C%80%E5%B8%AE%E5%8A%A9%EF%BC%8C%E8%AF%B7%E8%81%94%E7%B3%BB%E5%AE%A2%E6%88%B7%E7%BB%8F%E7%90%86%E3%80%82%E9%80%80%E8%AE%A2%E7%A0%81%E5%9B%9ET';



//        var_dump('尊敬的商户，授信额 度太低？一键操作，即可提高授信额*度！快登陆钱包商家app里提*额吧！如需帮助，请联系客户经理。退订码回T');
//        var_dump(json_encode(urlencode('尊敬的商户，授信额 度太低？一键操作，即可提高授信额*度！快登陆钱包商家app里提*额吧！如需帮助，请联系客户经理。退订码回T')));
        exit;
        //
//        for ($i = 0; $i < 10; $i++) {

        /*$subject = "abcdef"; $pattern = '/^def/'; preg_match_all($pattern, $subject, $matches, PREG_OFFSET_CAPTURE, 3); print_r($matches);
        exit;
        $str = "aa hello world";
        $result = preg_match("/^hello$/", $str, $a);
        var_dump($result);
        var_dump($a);
        exit;*/

        /*$str = 'hello {safasfa} 和 {tow} world';
        $preg = "#{([a-zA-Z])*}#";
        $result = preg_match_all($preg, $str, $matchs);
        var_dump($result);
        var_dump($matchs);
        exit;
        $a = [
            0 => 'hello'
            , 'X' => ' '
            , 2 => 'world'
        ];
        $b = implode('', $a);

        var_dump($a);
        var_dump($b);*/

        /*$i = 1;
            echo 'plan-one321';
            $pro = (new TestJob("{$i}"));
//            $pro = (new TestJob("jiege{$i}"));
            dispatch($pro);
//        }
        echo 'end';*/


    }
}
