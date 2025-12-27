<?php

namespace App\Http\Controllers\Front\Auh;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TowFactorAuthenticationController extends Controller
{
    public function index(){
        $user=Auth::user();

        return view('front.auth.tow-factor-auth',compact('user'));
    }
}
