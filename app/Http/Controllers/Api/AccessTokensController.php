<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Faker\Provider\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class AccessTokensController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'string'
        ]);
        $user =  User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $device_name = $request->post('device_name',$request->userAgent());
            $token = $user->createToken($device_name);
            return response()->json([
                'token' => $token->plainTextToken,
                'user' => $user
            
            ],201);
        }
         return response()->json([
                'code' => 0,
                'message' => 'invalid email or password'
            
            ],401);
    }
    public function destroy( $token = null)
    {
        $user = Auth::guard('sanctum')->user();
        if(null === $token)
        {
            $user->currentAccessToken()->delete();
        }
        $personalAccessToken=PersonalAccessToken::findToken($token);
        
        if($user->id == $personalAccessToken->tokenable_id && get_class($user) == $personalAccessToken->tokenable_type)
        {
          $personalAccessToken->delete();
        }
       
    }
}
// LocalStorage
//token:13|ScZrHfYBVLiOTTyyd6379bsew6BVHUDgUZ2Jr5uz51f2fca3
// Auth::user()
//permission: role:superadmin,permissions:[
//posts.create,post.update,post.delete
//]