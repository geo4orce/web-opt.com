<?php

Route::get('/',       'Main@home');
Route::get('clients', 'Main@clients');
Route::get('contact', 'Main@contact');

// Tests!!!!
Route::get('test', function() {
    if (request()->is('test')) {
        echo 'yes';
    } else {
        echo 'no';
    }
});
Route::get('phpinfo', 'Test@phpinfo');
Route::get('php7',    'Test@php7');

/* End of file */
