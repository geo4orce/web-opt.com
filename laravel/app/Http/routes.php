<?php

Route::get('/',       'Main@home');
Route::get('clients', 'Main@clients');
Route::get('contact', 'Main@contact');

Route::get('test',    'Test@test');
Route::get('phpinfo', 'Test@phpinfo');
Route::get('php7',    'Test@php7');

/* End of file */
