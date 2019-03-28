<?php

namespace App\Http\Controllers\One;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Elasticsearch\ClientBuilder;

class OneController extends Controller
{
    //

    public function indexOne()
    {
        $file_path = public_path();
        $file_path .= "/img/qianbao_20181106_164755.png";
        $speed = 512;//此参数为下载最大速度
        $pos = strrpos($file_path, "/");
        $file_name = substr($file_path, $pos+1);
        $file_size = filesize($file_path);
        $ranges = $this->getRange($file_size);
//        var_dump($ranges);exit;
        $fh =  fopen($file_path, "rb");
        header('Cache-control: public');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$file_name);
        if ($ranges != null) {
            header('HTTP/1.1 206 Partial Content');
            header('Accept-Ranges: bytes');
            header(sprintf('Content-Length: %u',$ranges['end'] - $ranges['start']));
            header(sprintf('Content-Range: bytes %s-%s/%s', $ranges['start'], $ranges['end'], $file_size));
            fseek($fh, sprintf('%u',$ranges['start']));
        }else{
            header("HTTP/1.1 200 OK");
            header(sprintf('Content-Length: %s', $file_size));
        }
        while(!feof($fh))
        {
            echo  fread($fh, round($speed*1024, 0));
            ob_flush();
            sleep(1);
        }
        ($fh != null) && fclose($fh);
    }


    /** $file_size  文件大小 */
    public function getRange($file_size){
//        var_dump($file_size);
        $range = isset($_SERVER['HTTP_RANGE'])?$_SERVER['HTTP_RANGE']:null;
        if(!empty($range)){
            $range = preg_replace('/[\s|,].*/', '', $range);
            $range = explode('-',substr($range,6));
            if (count($range) < 2 ) {
                $range[1] = $file_size;
            }
            $range = array_combine(array('start','end'),$range);
            if (empty($range['start'])) {
                $range['start'] = 0;
            }
            if (!isset ($range['end']) || empty($range['end'])) {
                $range['end'] = $file_size;
            }
            return $range;
        }
        return null;
    }

    public function indexThree()
    {
        $path = public_path() . "/img";
        $file = "qianbao_20181106_164755.png";
        $real = $path.'/'.$file;
        if(!file_exists($real)) {
            return false;
        }
        $size = filesize($real);
        $size2 = $size-1;
        $range = 0;
        var_dump(isset($_SERVER['HTTP_RANGE']));exit;
        if(isset($_SERVER['HTTP_RANGE'])) {   //http_range表示请求一个实体/文件的一个部分,用这个实现多线程下载和断点续传！
            header('HTTP /1.1 206 Partial Content');
            $range = str_replace('=','-',$_SERVER['HTTP_RANGE']);
            $range = explode('-',$range);
            $range = trim($range[1]);
            header('Content-Length:'.$size);
            header('Content-Range: bytes '.$range.'-'.$size2.'/'.$size);
        } else {
            header('Content-Length:'.$size);
            header('Content-Range: bytes 0-'.$size2.'/'.$size);
        }
        header('Accenpt-Ranges: bytes');
        header('application/octet-stream');
        header("Cache-control: public");
        header("Pragma: public");
        //解决在IE中下载时中文乱码问题
        $ua = $_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/MSIE/',$ua)) {    //表示正在使用 Internet Explorer。
            $ie_filename = str_replace('+','%20',urlencode($file));
            header('Content-Dispositon:attachment; filename='.$ie_filename);
        } else {
            header('Content-Dispositon:attachment; filename='.$file);
        }
        $fp = fopen($real,'rb+');
        fseek($fp,$range);                //fseek:在打开的文件中定位,该函数把文件指针从当前位置向前或向后移动到新的位置，新位置从文件头开始以字节数度量。成功则返回 0；否则返回 -1。注意，移动到 EOF 之后的位置不会产生错误。
        while(!feof($fp)) {               //feof:检测是否已到达文件末尾 (eof)
            set_time_limit(0);              //注释①
            print(fread($fp,1024));         //读取文件（可安全用于二进制文件,第二个参数:规定要读取的最大字节数）
            ob_flush();                     //刷新PHP自身的缓冲区
            flush();                       //刷新缓冲区的内容(严格来讲, 这个只有在PHP做为apache的Module(handler或者filter)安装的时候, 才有实际作用. 它是刷新WebServer(可以认为特指apache)的缓冲区.)
        }
        fclose($fp);
    }

    public function indexFour()
    {
        throw new UnauthorizedHttpException('one', "error12");
        response()->json()->throwResponse();
        return \Response::json('jie');
    }


    public function es_test()
    {
        $client = ClientBuilder::create()->build();
        var_dump($client);
    }
}
