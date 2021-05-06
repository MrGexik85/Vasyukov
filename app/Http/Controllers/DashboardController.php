<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{

    /**
     * Response on GET query '/dashboard'
     *
     * @return view
     */
    public function index() {
        return view("dashboard", [
            'orders' => Auth::user()->getUserOrders(),
        ]);
    }
}
