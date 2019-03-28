<?php

namespace App\Jobs;

use Exception;
use App\Podcast;
use App\AudioProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class QueueWork implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        echo json_encode($processor);
        /*if ($this->data == 150) {
            throw new Exception('杰哥杰哥', 400);
        } else {
            echo "-----\n";
            echo date('Y-m-d H:i:s', time())."\n";
            echo $this->data."\n";
        }*/
        /*echo "-----\n";
        echo date('Y-m-d H:i:s', time())."\n";
        echo $this->data."\n";*/
//        try {
            if ($this->data == 1500) {
//                echo 10/0;
                throw new Exception('杰哥杰哥', 400);
            } else {
                echo "-----22222222222\n";
                echo date('Y-m-d H:i:s', time())."\n";
                echo $this->data."\n";
            }
        /*} catch (Exception $e) {
            \Log::info('失败记录---'.json_encode($e->getMessage()));
//            $this->failed($e);
        }*/
    }


    public function failed()
    {
        // 发送失败通知, etc...
//        \Log::info('失败记录---'.json_encode($exception->getMessage()));
        \Log::info('失败记录---');
    }
}
