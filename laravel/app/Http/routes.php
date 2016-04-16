<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('phpinfo', function () {
    return phpinfo();
});

Route::get('test', function () {

    $lrv = app();
    $lrv = $lrv::VERSION;

    if (function_exists('phpversion')) {
        $php = phpversion();
    } else {
        $php = '[hidden]';
    }

    if (function_exists('mysqli_get_client_version')) {
        $sql = mysqli_get_client_version();
    } else {
        $sql = '[hidden]';
    }

    $out = <<<OUT

    <h1>Test OK!</h1>
    Built with:
    <ul>
        <li>Laravel version $lrv
        <li>PHP version $php
        <li>MySql version $sql

OUT;
    return $out;
});

// Test PHP7
Route::get('php7', function () {
    return 'PHP 7';
    // return (int) (1 <=> 2);
});

/* End of file */
