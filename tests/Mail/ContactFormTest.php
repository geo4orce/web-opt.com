<?php

namespace Tests\Mail;

use App\Mail\ContactForm;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function testBasicTest(): void
    {
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

        // $mailable->assertSeeInText($user->email);
        // $mailable->assertSeeInText('Invoice Paid');
    }
}
