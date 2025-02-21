<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Alert;
use App\Models\CustomerModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index()
    {
        $totcustomers=CustomerModel::count();
        $totcredit=TransactionModel::where('type','Credit')->sum('amount');
        //dd($totcredit);
        $totdebt=TransactionModel::where('type','Debt')->sum('amount');
        $totrevenue=$totcredit-$totdebt;
       return view("index",['totcustomers'=>$totcustomers,'totrevenue'=>$totrevenue]);
    }
}


