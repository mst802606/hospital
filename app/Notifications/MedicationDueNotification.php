<?php

namespace App\Notifications;

use App\Models\Patient;
use App\Models\Ward;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MedicationDueNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Patient $patient, public Ward $ward, public $message)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $data = array(
            'patient' => $this->patient,
            'message' => "Patient " . $this->patient->id . " in ward " . $this->ward->name . " requires medication",
            'ward' => $this->ward,
        );
        $data = json_encode($data);
        return [
            //

            'data' => $data,
            'link' => route('nurse.patients.offer-medications.show', ['patient_id' => $this->patient->id]),
            'message' => $this->message ? $this->message . " for patient " . $this->patient->id . " in ward " . $this->ward->name . "."
            : "Patient " . $this->patient->id . " in ward " . $this->ward->name . " requires medication",

        ];
    }

    public function notificationType()
    {
        return 'medication_due';
    }
}
