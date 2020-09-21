<?php

namespace App\Http\Controllers;

use App\Events\OrderShipped;
use App\Models\Order;
use Illuminate\Http\Response;

class OrderController extends Controller
{

    /**
     * 将传递过来的订单发货。
     *
     * @param  int  $orderId
     *
     * @return Response
     */
    public function ship($orderId)
    {
        $order = Order::findOrFail($orderId);

        event(new OrderShipped($order));
    }
}
