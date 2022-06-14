<?php

use App\Mail\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::post('contact-us', function (Request $request) {
    $data = $request->all();
    $from = trim($request->get('email'));
    $msg = trim($request->get('message'));
    $isBot = $request->get('name'); // this is an invisible honeypot input field, humans will not fill it
    $isBot = $isBot ? ' (bot)' : '';

    info('incoming contact-us' . $isBot, $data);

    $willSend = !$isBot && $from && $msg; // must be not empty
    if ($willSend) {
        Mail::to(config('mail.contact'))
            ->send(new ContactForm($data));
    }

    return [
        'message' => "received from '$from'",
        'status' => 'OK',
    ];
});
