<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Main extends Controller
{
    public function home() {
    	return view('home');
    }

    public function clients() {
    	return view('clients');
    }

    public function contact() {
    	return view('contact');
    }
}
