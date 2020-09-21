<?php

namespace App\Http\Controllers;

use App\Events\OrderShipped;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    /**
     * 将传递过来的订单发货。
     *
     * @param  int  $orderId
     *
     * @return Response
     */
    public function ship(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        Mail::to($request->user())->send(new OrderShipped($order));
        event(new OrderShipped($order));
    }
}
