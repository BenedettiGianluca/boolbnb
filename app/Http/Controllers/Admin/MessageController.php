<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id=Auth::user()->id;
        $apartments = Apartment::all()->where('user_id', $user_id);
        return view('admin.messages', compact('apartments'));
    }
}
