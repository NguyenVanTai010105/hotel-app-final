<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingRequestNotification extends Notification
{
    use Queueable;

    private $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // kênh gửi
    }

    public function toDatabase($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'user_name' => $this->booking->user->name,
            'room_name' => $this->booking->room->name,
            'message' => "Người dùng {$this->booking->user->name} gửi yêu cầu đặt phòng {$this->booking->room->name}.",
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Yêu cầu đặt phòng mới')
            ->line("Người dùng {$this->booking->user->name} gửi yêu cầu đặt phòng {$this->booking->room->name}.")
            ->action('Xem chi tiết', url('/admin/bookings'));
    }
}
