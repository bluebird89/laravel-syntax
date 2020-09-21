<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Order
     */
    private $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')
            ->markdown('emails.orders.shipped');
//            ->with([
//                'orderName' => $this->order->name,
//                'orderPrice' => $this->order->price,
//            ])
//            ->attach('/path/to/file', [
//                'as' => 'name.pdf',
//                'mime' => 'application/pdf',
//            ])
//            ->attachFromStorage('/path/to/file')
//            ->text('emails.orders.shipped_plain');
    }
}
