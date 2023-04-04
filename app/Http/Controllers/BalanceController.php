<?php

namespace App\Http\Controllers;
use App\Models\Balance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function getAll()
    {
        $balance = Balance::getAll();

        $data['title'] = "Balance";
        $data['balances']= $balance;
        return view('pages.balance.balance-list')->with($data);
    }
}

