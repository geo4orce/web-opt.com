<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class ContactForm extends Mailable
{
    use SerializesModels;

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

        // fake name
        $name = Arr::get($this->data, 'name');
        $name = $name ? " (BOT: $name)" : '';

        return $this->view('mail.contact-us')
            ->subject("Request from: '$fromEmail'$name")
            ->with('from', $fromEmail)
            ->with('msg', $msg);
    }
}
