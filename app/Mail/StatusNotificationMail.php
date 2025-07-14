<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\RamsForm;

class StatusNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $form;

    public function __construct(RamsForm $form)
    {
        $this->form = $form;
    }

    public function build()
    {
        return $this->subject('Your Form Status Has Been Updated')
            ->view('emails.status-notification')
            ->with([
                'status' => $this->form->status,
                'activity' => $this->form->activity_type,
                'date' => $this->form->activity_date,
            ]);
    }
}