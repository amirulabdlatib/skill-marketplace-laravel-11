<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TalentController extends Controller
{
    //
    public function dashboard(){
        return view('talent.dashboard');
    }

}
