<?php

namespace App\Http\Controllers;

class AmpController extends Controller
{
    public function index()
    {
        return view('amp');
    }
    public function ru()
    {
        app()->setLocale('ru');
        return view('amp');
    }
}
