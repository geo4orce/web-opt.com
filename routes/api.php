<?php

use App\Mail\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::post('contact-us', function (Request $request) {
    $data = $request->all();
    $from = $request->get('email');
    $msg = $request->get('message');

    info('incoming2 contact-us', $data);

    Mail::to(config('mail.contact'))
        ->send(new ContactForm($data));

    return [
        'status' => 'OK',
        'message' => "received from '$from'",
    ];
});
