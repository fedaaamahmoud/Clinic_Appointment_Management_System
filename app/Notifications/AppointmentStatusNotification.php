<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AppointmentStatusNotification extends Notification
{
    use Queueable;

    public $appointment;
    public $status;

    public function __construct($appointment, $status)
    {
        $this->appointment = $appointment;
        $this->status = $status;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'appointment_id' => $this->appointment->id,
            'doctor_name' => $this->appointment->doctor->name ?? 'Unknown',
            'appointment_date' => $this->appointment->appointment_date,
            'appointment_time' => $this->appointment->appointment_time,
            'status' => $this->status,
            'message' => $this->status === 'confirmed'
                ? 'Your appointment has been confirmed.'
                : 'Your appointment has been rejected.',
        ];
    }
}
