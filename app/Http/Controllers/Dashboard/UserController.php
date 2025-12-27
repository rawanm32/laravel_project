<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Profile; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Laravel\Fortify\TwoFactorAuthenticatable;
class UserController extends Controller
{

   
    public function index()
    {
$request = request();
        $query=User::query();
        $name=$request->query("name");
        $status=$request->query("status");
        if($status){
        $query->where("status", $status);
        }
        if($name){
            $query->where("name","like","%".$name."%");
        }
        if($status) $query->where("status", $status);
        return view("dashboard.pages.users.index",[
            "users"=> $query
            ->latest()->withCount('books')
            ->paginate(10)
        ]);
    
    }
    
    public function create()
    {
        $user = new User();
        $profile = new Profile();
        
        return view('dashboard.pages.users.create', compact('user', 'profile'));
    }


    public function store(Request $request)
    {
        $request->validate([
         
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            
 
        ]);
        
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

 
        return redirect()
            ->route('dashboard.users.index')
            ->with('success', 'تم إنشاء المستخدم بنجاح.');
    }
    
    public function show(User $user)
    {

        return view('dashboard.pages.users.show', compact('user'));
    } 

 
    public function edit(User $user)
    {
      $currentUserId = Auth::id(); 

       
        if ($currentUserId !== $user->id) {
             return abort(403, 'ليش لتعدل حساب مو الك؟.');
        }

        return view('dashboard.pages.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            // User Data
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', Password::defaults(), 'confirmed'], 
            

        ]);

  
        $update_user_data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        
        if ($request->filled('password')) {
            $update_user_data['password'] = Hash::make($request->password);
        }
        $user->update($update_user_data);


        return redirect()
            ->route('dashboard.users.index')
            ->with('success', 'تم تحديث بيانات المستخدم بنجاح.');
    }
    
   
    public function destroy(User $user)
    {
          $currentUserId = Auth::id(); 

       
        if ($currentUserId !== $user->id) {
             return abort(403, 'ليش لتحذف حساب مو الك؟.');
        }

        $user->delete(); 
        
        return redirect()->route('dashboard.users.index')->with('success', 'تم حذف المستخدم بنجاح.');
    }
}