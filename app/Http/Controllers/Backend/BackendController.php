<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function blankPage()
    {
        return view('backend.modules.blankPage');
    }
    public function index()
    {
        return view('backend.modules.index');
    }
}
