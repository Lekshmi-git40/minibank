<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {

        return view("login");
    }

    public function customerlogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            //$password=Hash::make($request->password);
            if (Hash::check($request->password, $user->password)) {
                // return "hi";
                return redirect("/customertransactions/$user->name");
            } else {
                return redirect("/customer-login")->with('fail', 'Invalid Login credentials');
            }

        } else {
            return redirect("/customer-login")->with('fail', 'Invalid Login credentials');;
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/customer-login');
    }
}
