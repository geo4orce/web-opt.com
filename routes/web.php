<?php

Route::get('/', 'MasterController@index')
    ->middleware('cache.headers:public;max_age=3600;etag')
    ->name('home');

Route::get('/qr1', function() {
    Log::info('qr redirect to blinq');

    return Redirect::to('https://blinq.me/f5TLMRTbpG0j', 301);
});
