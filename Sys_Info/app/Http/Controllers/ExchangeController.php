<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    public function getAll()
    {
        $exchanges = Exchange::getAll();

        return view('exchange-list', [
            'exchanges' => $exchanges
        ]);
    }
    public function getById($id)
    {
        $exchange = Exchange::getById($id);

        return view('exchange-By-Id', [
            'exchange' => $exchange
        ]);
    }
    
    public function insert($idSociety,$localisation,$primaire)
    {
        Exchange::insert($idSociety,$localisation,$primaire);
        $exchanges = Exchange::getAll();

        return view('exchange-list', [
            'exchanges' => $exchanges
        ]);
    }

    public function delete($id)
    {
        Exchange::remove($id);
        $exchanges = Exchange::getAll();

        return view('exchange-list', [
            'exchanges' => $exchanges
        ]);
    }
    public function update($id,$idSociety,$localisation,$primaire)
    {
        Exchange::modif($id,$idSociety,$localisation,$primaire);
        $exchanges = Exchange::getAll();

        return view('exchange-list', [
            'exchanges' => $exchanges
        ]);
    }


}
