<?php

namespace App\Http\Controllers;

class CommonController extends Controller
{
    public function getHelpPage()
    {
        return view('pages/help-contact', ["isHelp" => true]);
    }

    public function getAboutPage()
    {
        return view('pages/about-us', ["isAbout" => true]);
    }
}
