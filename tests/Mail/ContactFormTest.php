<?php

namespace Tests\Mail;

use App\Mail\ContactForm;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function testBasicTest(): void
    {
        $this->markTestSkipped('must be revisited.');

        $email = 'tester@here';
        $msg = 'babaganush';
        $data = [
            'email' => $email,
            'message' => $msg,
        ];

        $mailable = new ContactForm($data);

        $mailable->assertSeeInHtml('Email from');
        $mailable->assertSeeInHtml($email);
        $mailable->assertSeeInHtml($msg);
    }
}
