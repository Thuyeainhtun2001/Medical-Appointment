<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //home
    public function home(){
        return view('home');
    }
}
