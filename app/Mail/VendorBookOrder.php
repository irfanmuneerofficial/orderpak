<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorBookOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $orderid;
    public $shipprice;
    public $product;
    public $address;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $product,$shipprice,$orderid,$address)
    {
         $this->data = $data;
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
        return $this->subject('You have a New Order Received!')->view('emails.vendor_book_order');
    }
}
