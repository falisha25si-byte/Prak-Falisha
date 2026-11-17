<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

    	if(!Auth::check()){
            return redirect()->route('login')->withErrors(['errors' => 'Silahkan login terlebih dahulu']);
		}
        return view('admin.dashboard.index');
    }

}
