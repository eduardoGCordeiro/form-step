<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfileSubmitMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.profile_submit')->with([
            'name'            => $this->data->name,
            'email'           => $this->data->email,
            'phone'           => $this->data->phone,
            'office'          => $this->data->office,
            'education_level' => $this->data->educationLevel->name,
            'observation'     => $this->data->observation,
            'ip'              => $this->data->ip,
            'created_at'      => date_format($this->data->created_at, 'd/m/Y H:i:s')
        ]);
    }
}
