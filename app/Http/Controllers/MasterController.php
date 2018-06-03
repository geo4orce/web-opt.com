<?php

namespace App\Http\Controllers;

class MasterController extends Controller
{
    public function index()
    {
        return view('master');
    }
    public function ru()
    {
        app()->setLocale('ru');
        return view('master');
    }
}
