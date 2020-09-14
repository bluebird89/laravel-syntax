<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendShipmentNotification implements ShouldQueue
{
    /**
     * 创建事件监听器。
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 处理事件
     *
     * @param  OrderShipped  $event
     *
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        echo "event fire  Ha hA";
        // 使用 $event->order 来访问 order ...
        if (true) {
            $this->release(10);
//            dd($event->order);
        }
    }

    use InteractsWithQueue;
    /**
     * 队列化任务使用的连接名称。
     *
     * @var string|null
     */
//    public $connection = 'sqs';

    /**
     * 队列化任务使用的队列名称。
     *
     * @var string|null
     */
//    public $queue = 'listeners';

    public function failed(OrderShipped $event, $exception)
    {
        //
    }
}

