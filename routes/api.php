<?php

use Illuminate\Http\Request;

Route::post('contact-us', function (Request $request) {
    $from = $request->get('email');
    info('incoming contact-us', [$from]);

    return [
        'status' => 'OK',
        'message' => "received from '$from'",
    ];
});
