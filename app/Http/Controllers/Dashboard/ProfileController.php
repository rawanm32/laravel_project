<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        return view("");
    }
    public function create(){
        return view("");
    }
    public function store(Request $request){
        
    }
    public function show($id){
        return view("");
    }
    public function edit(){
       
        return view("dashboard.pages.profile.edit",[
             'user'=>Auth::User(),
        ]);
    }
    public function update(Request $request){
        $request->validate([
            'first_name'=>['required'],
            'last_name'=>['required'],
            'birthdate'=>['required'],
            'address'=>['required'],
            'gender'=>['required'],
            'bio'=>['required'],
            'phone'=> ['required'],
        ]);
         $user=$request->user();
         $profile=$user->profile;
   if ($profile) {
    
    $profile->fill($request->except(['email']))->save();
} else {
  
    $user->profile()->create($request->except(['email']));  
}
             return redirect()->route('dashboard.profile.edit')->with('success','Update Successfully');
    }
}