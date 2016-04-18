<?php

Route::get('/', function() {
    $data = [
        'title' => 'Web&amp;Opt',
        'title_wide' => 'W E B &amp; O P T',
        'slogan' => 'Website Development and Optimization',
    ];
    return view('master', $data);
});

// Tests!!!!

// Route::get('test/write', function() {
//     // $file = '/var/www/lara/test.txt';
//     // $dir = '/var/www/lara';

//     // if (File::exists($myfile)) {
//     //     echo "Yup. It exists.";
//     // }
//     $bytes_written = File::put('~/lara-home2.txt', 'burger');
//     echo $bytes_written;
// });


/*
Route::get('test/test', function() {
    if (request()->is('test')) {
        echo 'yes';
    } else {
        echo 'no';
    }
});
Route::get('test/testok', 'Test@test');
Route::get('test/phpinfo', 'Test@phpinfo');
Route::get('test/php7',    'Test@php7');
*/

/* End of file */
