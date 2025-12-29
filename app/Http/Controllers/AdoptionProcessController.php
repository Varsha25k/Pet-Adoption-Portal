<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdoptionProcessController extends Controller 
{
    public function index()
    {
        return view('pages.adoption-process');
    }
}