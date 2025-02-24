<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Alert;
use App\Models\CustomerModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomertransactionController extends Controller
{
    public function index($customer_id)
    {  $customer=CustomerModel::where('id',$customer_id)->get();

        $data=TransactionModel::where('customer_id',$customer_id)->get();
        return view("customertransactions",['data'=>$data,'customer'=>$customer]);
    }
    public function create($customer_id)
    {
        $customer=CustomerModel::where('id',$customer_id)->get();
        return view("addtransaction",['customer'=>$customer]);
    }
    public function store(Request $request)
    {

        $data = TransactionModel::where('customer_id', $request->custid)->where('date', date('Y-m-d'))->count();

        if ($data >= 3) {
            return redirect("/customertransactions/$request->custid")->with('fail','Transaction limit exceeded');
        } else {
            $content = new TransactionModel();
            $content->customer_id = $request->custid;
            $content->type = $request->transtype;
            $content->ip = $request->ip;
            $content->amount = $request->amount;
            $content->date = $request->creditdate;
            $content->created_at = date('Y-m-d H:i:s');
            $content->updated_at = date('Y-m-d H:i:s');

            $content->save();
            $credit = $request->amount;
            $bal = $request->balance;

            if ($request->transtype == "Credit") {
                $amount = $credit + $bal;
                //dd($amount);
            } else {
                $amount = $bal - $credit;
            }

            $ban = CustomerModel::where('id', $request->custid)
                ->update([
                    'amount' => $amount,
                    'credited_on' => $request->creditdate
                ]);
            return redirect("/customertransactions/$request->custid");
        }
    }
}


