<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return '<h1>Test OK!</h1>';
});

// Test PHP7
// Route::get('/test/php7', function () {
//     return (int) (1 <=> 2);
// });

/* End of file */
