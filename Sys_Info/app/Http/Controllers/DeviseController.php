<?php

namespace App\Http\Controllers;

use App\Models\Devise;
use Illuminate\Http\Request;

class DeviseController extends Controller
{
    public function getAll()
    {
        $devises = Devise::getAll();

        return view('devise-list', [
            'devises' => $devises
        ]);
    }
    public function getById($id)
    {
        $devise = Devise::getById($id);

        return view('devise-By-Id', [
            'devise' => $devise
        ]);
    }
    
    public function insert($nom)
    {
        Devise::insert($nom);
        $devises = Devise::getAll();

        return view('devise-list', [
            'devises' => $devises
        ]);
    }

    public function delete($id)
    {
        Devise::remove($id);
        $devises = Devise::getAll();

        return view('devise-list', [
            'devises' => $devises
        ]);
    }
    public function update($id,$nom)
    {
        Devise::modif($id,$nom);
        $devises = Devise::getAll();

        return view('devise-list', [
            'devises' => $devises
        ]);
    }


}
