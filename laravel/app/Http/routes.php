<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    $lrv = app();
    $lrv = $lrv::VERSION;

    $php = phpversion();

    $sql = mysqli_get_client_version();

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
// Route::get('/test/php7', function () {
//     return (int) (1 <=> 2);
// });

/* End of file */
