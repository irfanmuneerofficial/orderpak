<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderProcess extends Mailable
{
    use Queueable, SerializesModels;

    public $orders;
    public $username;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orders,$username)
    {
         $this->orders = $orders;
         $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.order_process');
    }
}
