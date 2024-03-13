<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function blankPage()
    {
        return view('backend.modules.blankPage');
    }
    // user
    public function index()
    {
        $users = Profile::with('user','division','district','thana')->orderBy('user_id', 'asc')->get();

        return view('backend.modules.index', compact('users'));
    }
}





