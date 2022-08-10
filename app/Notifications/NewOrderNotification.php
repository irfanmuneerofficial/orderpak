<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;
    public $order_user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order_user)
    {
        $this->order_user = $order_user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // dd($this->order_user);
        return [
            'order_id' => $this->order_user['order_id'],
            'name' => $this->order_user['name'],
            'email' => $this->order_user['email'],
            'phone_no' => $this->order_user['phone_no'],
            'amount' => $this->order_user['amount'],
            'address' => $this->order_user['address'],
            'city' => $this->order_user['city']
            ];
    }
}
