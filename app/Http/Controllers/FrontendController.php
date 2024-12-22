<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // Show Home Page
    public function home()
    {
        return view('frontend.home');
    }

    // Show About Page
    public function about()
    {
        return view('frontend.about');
    }

    // Show Branch Page
    public function branch()
    {
        return view('frontend.branch');
    }

    // Show Contact Us Page
    public function contact()
    {
        return view('frontend.contact-us');
    }

    // Show Gallery Page
    public function gallery()
    {
        return view('frontend.gallery');
    }

    // Show Registration Page
    public function registration()
    {
        return view('frontend.registration');
    }
}