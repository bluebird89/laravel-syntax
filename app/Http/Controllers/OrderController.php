<?php

namespace App\Http\Controllers;

use App\Events\OrderShipped;
use App\Models\Order;

class OrderController extends Controller
{

    /**
     * 将传递过来的订单发货。
     *
     * @param  int  $orderId
     *
     * @return Response
     */
    public function ship()
    {
//        $order = Order::findOrFail($orderId);

        $order = new Order();
        // 订单的发货逻辑...
        event(new OrderShipped($order));
    }
}
