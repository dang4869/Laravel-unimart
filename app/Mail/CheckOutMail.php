<?php

namespace App\Mail;

use App\Order;
use App\Order_detail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckOutMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order_time = Order::max('created_at');
        $order = Order::where('created_at',$order_time)->first();
        $order_detail = Order_detail::where('order_id',$order->id)->get();
        return $this-> view('frontend.email',compact('order','order_detail'))->subject('[UNIMART.VN] đơn hàng của bạn !');
        // return $this->view('view.name');
    }
}
