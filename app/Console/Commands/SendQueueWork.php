<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\QueueWork;

class SendQueueWork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:queueWork';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description test queue work';

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




        /*$str = 'http://duly5zwcucles.cloudfront.net/answer/1533267372_5b63cdace8b45.png';
        dd( strpos($str,'/', 3) );*/


        //
        /*$i = 1;

        for ($i = 1; $i <= 200; $i++) {
            echo "{$i}\n";
            $pro = (new QueueWork("{$i}"))->onQueue('high');
            dispatch($pro);
        }*/





    }
}
