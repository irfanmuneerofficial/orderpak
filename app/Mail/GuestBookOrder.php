<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuestBookOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $orders;
    public $order_id;
    public $username;
    public $shipprice;
    public $product;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orders, $product,$shipprice,$username,$order_id)
    {
        $this->username = $username;
        $this->order_id = $order_id;
        $this->orders = $orders;
        $this->shipprice = $shipprice;
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Orderpak.com Order no.'. $this->order_id .' has been received successfully')->view('emails.guest_book_order');
    }
}
