<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {

        $user=User::where('email',request('email'))->first();
        $password=Hash::make(request('password'));
        if(Hash::check(request('password'),$password))
        {
           // return "hi";
            $token=$user->createToken('mobile-app')->plainTextToken;
            return response()->json([
                'username' => request('email'),
                'password' => request('password'),
                'data'=>$token,
                'message' => "Credentials valid",
                'status'=>200
            ]);
        }
        else{

            return response()->json([
                'username' => request('email'),
                'password' => request('password'),
                'user' => "Password invalid",
                'status'=>250
            ]);
        }


        }

        public function customerlogin()
    {
$userid=auth()->user()->id;
return $userid;
}

}
