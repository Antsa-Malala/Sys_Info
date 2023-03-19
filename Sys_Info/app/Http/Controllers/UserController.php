<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAll()
    {
        $users = User::getAll();

        return view('user-list', [
            'users' => $users
        ]);
    }
    public function getById($id)
    {
        $user = User::getById($id);

        return view('user-By-Id', [
            'user' => $user
        ]);
    }
    
    public function insert($idSociety,$username,$password)
    {
        User::insert($idSociety,$username,$password);
        $users = User::getAll();

        return view('user-list', [
            'users' => $users
        ]);
    }

    public function delete($id)
    {
        User::remove($id);
        $users = User::getAll();

        return view('user-list', [
            'users' => $users
        ]);
    }
    public function update($id,$idSociety,$username,$password)
    {
        User::modif($id,$idSociety,$username,$password);
        $users = User::getAll();

        return view('user-list', [
            'users' => $users
        ]);
    }


}
