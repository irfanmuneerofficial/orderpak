<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorGuestBookOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $orders;
    public $orderid;
    public $shipprice;
    public $product;
    public $address;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orders, $product,$shipprice,$orderid,$address)
    {
         $this->orders = $orders;
         $this->address = $address;
         $this->orderid = $orderid;
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
        return $this->subject('You have a New Order Received!')->view('emails.vendor_guest_book_order');
    }
}
