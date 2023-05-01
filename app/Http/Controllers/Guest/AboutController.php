<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Guest\Contact\ContactService;

class AboutController extends Controller
{

    public function index()
    {
        return view('guest/about/index');
    }

    public function helpp()
    {
        return view('guest/about/helpp');
    }
}
