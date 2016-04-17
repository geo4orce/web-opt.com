<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Test extends Controller
{
    public function php7() {
    	return 'PHP 7';
    	// return (int) (1 <=> 2);
    }

    public function phpinfo() {
    	return phpinfo();
    }

    public function test() {

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
	}


}
