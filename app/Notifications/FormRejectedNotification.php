<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class FormRejectedNotification extends Notification
{
    protected $form;

    public function __construct($form)
    {
        $this->form = $form;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Form HHMD Ditolak')
            ->line('Form HHMD Anda telah ditolak oleh supervisor.')
            ->line('Catatan Penolakan: ' . $this->form->rejection_note)
            ->action('Lihat Form', route('officer.hhmd.show', $this->form->id));
    }

    public function toArray($notifiable)
    {
        return [
            'form_id' => $this->form->id,
            'message' => 'Form HHMD Anda ditolak',
            'rejection_note' => $this->form->rejection_note
        ];
    }
} 
