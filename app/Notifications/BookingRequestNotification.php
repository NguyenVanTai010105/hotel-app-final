<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingRequestNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database']; // kênh gửi
    }

    public function toDatabase($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'user_name' => $this->booking->user->name,
            'room_name' => $this->booking->room->name,
            'email' => $this->booking->user->email,
            'start_date' => $this->booking->start_date,
            'end_date' => $this->booking->end_date,
            'des' => $this->booking->des,
            'message' => "Người dùng {$this->booking->user->name} gửi yêu cầu đặt phòng {$this->booking->room->name}.",
        ];
    }
}
