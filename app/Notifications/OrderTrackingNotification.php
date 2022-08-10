<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// use Notification;

class OrderTrackingNotification extends Notification
{
    use Queueable;
    private $trackingInfo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($trackingInfo)
    {
        $this->trackingInfo = $trackingInfo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('Order Tracking')->view(
            'emails.orders.order_tracking', ['trackingInfo' => $this->trackingInfo]
        );                  
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'bill_id' => $this->billData['bill_id']
        ];
    }    
}
