<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedAdminNotification extends Notification
{
    use Queueable;
    public Order $order;
    public array $cart;
    public float $total;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, array $cart, $total)
    {
        $this->order = $order;
        $this->cart = $cart;
        $this->total = $total;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Order Created')
            ->line('A new order has been created.')
            ->line('Order ID: ' . $this->order->id)
            ->action('View Order', url('/admin/orders/' . $this->order->id))
            ->line('Thank you for your attention.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
