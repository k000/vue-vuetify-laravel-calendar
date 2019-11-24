<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShumokuController extends Controller
{
    public function store(Request $request){
        \Log::debug($request);
    }
}
