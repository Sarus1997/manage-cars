<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        return view('loan.calculator');
    }

    public function calculate(Request $req)
    {
        $amount = $req->amount;
        $rate = $req->rate / 100;
        $months = $req->months;

        $installment = ($amount + ($amount * $rate)) / $months;
        return response()->json(['installment' => round($installment, 2)]);
    }
}
