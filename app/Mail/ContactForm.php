<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class ContactForm extends Mailable
{
    use SerializesModels;

    /** @var array */
    private array $data;

    /**
     * Create a new message instance.
     *
     * @param  array  $data
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        $fromEmail = Arr::get($this->data, 'email');
        $msg = Arr::get($this->data, 'message');

        return $this->view('mail.contact-us')
            ->subject("Request from: '$fromEmail'")
            ->with('from', $fromEmail)
            ->with('msg', $msg)
        ;
    }
}
