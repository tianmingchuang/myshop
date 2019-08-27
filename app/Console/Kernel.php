<?php

namespace App\Console;

use App\Http\Tools\Wechat;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function(){
            //业务逻辑
            //获取数据
            $redis = new \Redis();
            $redis->connect('127.0.0.1','6379');
            $app = app('wechat.official_account');
            \Log::Info('123456789');
//            return;
//            $info = file_get_contents('http://www.tianmingchuang.com/youjia');
//            $info = json_decode($info,1);
            $info = file_get_contents('http://www.tianmingchuang.com/youjia');
            $info = json_decode($info,1)['result'];
//            dd($info);
            foreach($info as $v){
//            dump($v);
                if ($redis->exists($v['city'])){
//                dd($v);
//                unset($v['city'],$v['b90'],$v['0h']);

                    $info1 = json_decode($redis->get($v['city']),1);
//                dump($info1);
//                unset($v['city'],$v['b90'],$v['0h']);
                    foreach($info1 as $vv){
                        foreach($v as $k=>$vi){
//                    dump($vi);
                            if($vi != $info1[$k]){
//                            dump(11);
                                unset($v['city'],$v['b90'],$v['0h']);
                                $date = '';
                                foreach($v as $k=>$vi){
//                        dump($vi);
//                        dump($k);
                                    $date .= $k.': 每升'.$vi.'元'."\n";
                                }
                                $openid = $app->user->list($nextOpenId = null)['data']['openid'];
//                            dd($openid);
                                foreach($openid as $vc){
                                    $app->template_message->send([
                                        'touser' => $v['city'],
                                        'template_id' => 's_YzwGdD1NrLBTStf4D_qD88Sqa5OG8oZ3M8cK2QVSs',
//                                    'url' => 'https://easywechat.org',
                                        'data' => [
                                            'first' => $v['city'],
                                            'keyword1' => $date,
                                        ],
                                    ]);
                                }
                            }
                        }

                    }


                }
            }
            //与redis里的数据做对比油价是否有变动
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
