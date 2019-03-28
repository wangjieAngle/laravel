<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessing;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        Queue::before(function (JobProcessing $event) {
            /*$arr = [
                $event->connectionName
                , $event->job
                , $event->job->payload()
            ];*/
//            $arr = $event->job->payload();
//            \Log::info('数据---'.json_encode(($arr['data']['command'])));
//            \Log::info('数据---'.json_encode($arr));
//        });

        /*Queue::after(function (JobProcessing $event) {
            $arr = [
                $event->connectionName
                , $event->job
//                , $event->job->delete()
            ];
            \Log::info('失败数据---'.json_encode($arr));
        });*/

        /*Queue::failing(function (JobFailed $event) {
            $arr = [
                $event->connectionName
                , $event->job
                , $event->exception
            ];
            \Log::info('失败数据---'.json_encode($arr));
        });*/

        /*Queue::failing(function ($connection, $job, $data) {
            // Notify team of failing job...
            \Log::info('失败数据---'.json_encode($data));
        });*/

        \DB::listen(function ($query) {
            \Log::info($query->sql . ' ' . json_encode($query->bindings) . '  ' . $query->time . 'ms');
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
