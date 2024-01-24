<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.modules.index');
    }
    public function single()
    {
        return view('frontend.modules.single');
    }
    public function about()
    {
        return view('frontend.modules.about');
    }
    public function contact()
    {
        return view('frontend.modules.contact');
    }
}
