<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RejectedController extends Controller
{
    public function index()
    {
        return view('rejected');
    }
}
