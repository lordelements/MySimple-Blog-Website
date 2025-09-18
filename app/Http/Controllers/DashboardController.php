<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function aboutus()
    {
        return inertia('AboutUs');
    }

    public function contactus()
    {
        return inertia('ContactUs');
    }
}
