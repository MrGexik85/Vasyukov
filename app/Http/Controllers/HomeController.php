<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * response on GET query '/home'
     *
     * @return view
     */
    public function index(){
        return view("home");
    }
}
