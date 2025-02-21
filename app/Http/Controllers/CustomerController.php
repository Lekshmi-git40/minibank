<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Alert;
use App\Models\CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

           'email' => 'required|email',
            'firstName' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
            'lastName' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
            'phone'  => 'required|numeric|digits:10',
        ],  [
            'firstName.required'=> 'Please enter First Name', // custom message
            'lastName.required'=> 'Please enter Last Name', // custom message
            'empEmail.email'=> 'Please enter valid email id', // custom message
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
        $content->mobile = $request->phone;
//        $content->amount = $request->amount;
//        $content->credited_on = $request->creditdate;
        $content->created_at = date('Y-m-d H:i:s');
        $content->updated_at = date('Y-m-d H:i:s');

        $content->save();
        return redirect('/customers');
    }
}


