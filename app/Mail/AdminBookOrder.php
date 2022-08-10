<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminBookOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $orders;
    public $shipprice;
    public $product;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orders, $product,$shipprice)
    {
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
        return $this->subject('New Order Received!')->view('emails.admin_book_order');
    }
}
