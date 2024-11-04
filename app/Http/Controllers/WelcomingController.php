<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class WelcomingController extends Controller
{
    public function index(): View
    {
        
        return view('welcome');
        
    }
}
