<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Alert;
use App\Models\CustomerModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $data=CustomerModel::all();
        return view("customers",['data'=>$data]);
    }
    public function create()
    {
        return view('addcustomer');
    }
    public function store(Request $request)
    {  $validator = Validator::make($request->all(), [

           'email' => 'required|unique:customer|email',
            'firstName' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
            'lastName' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
        'password' => 'required|max:10',
            'phone'  => 'required|numeric|digits:10',
        ],  [
            'firstName.required'=> 'Please enter First Name', // custom message
            'lastName.required'=> 'Please enter Last Name', // custom message
            'empEmail.email'=> 'Please enter valid email id', // custom message


    ]);
        if ($validator->fails()) {
            // Handle validation failure (e.g., redirect back with error messages)
            return redirect()->back()->withErrors($validator)->withInput()->with('fail','Please fill all the fields.');
            //return back()->with('fail','Please fill all the fields.');

        }
        $content = new CustomerModel();
        $content->customername = $request->firstName." ".$request->lastName;
        $content->email = $request->email;
        $content->password = $request->password;
        $content->mobile = $request->phone;
//        $content->amount = $request->amount;
//        $content->credited_on = $request->creditdate;
        $content->created_at = date('Y-m-d H:i:s');
        $content->updated_at = date('Y-m-d H:i:s');
        $content->save();

        $password=Hash::make($request->password);
//        if(Hash::check($content->password,$password))
//        {
//            dd("hi");
//        }
//$password=Crypt::encryptString($request->password);

        $custid=$content->id;
        $user = new User();
        $user->name = $custid;
        $user->email = $request->email;
        $user->password =$content->password;
        $user->save();
        return redirect('/customers');
    }
}


