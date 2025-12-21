<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        return view('support.index');
    }

    public function documentation()
    {
        return view('support.documentation');
    }

    public function contact()
    {
        return view('support.contact');
    }

    public function forum()
    {
        return view('support.forum');
    }
}
