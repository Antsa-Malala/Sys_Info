<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
class UserController extends Controller
{
    public function index(){
        // Makany any amin'ny login
    }

    public function home(){
        return view('pages.home');
    }

    public function login(Request $request){
        // Mi-gérer Login
        $username = trim($request->input('username'));
        $password = trim($request->input('password'));
        $user = Users::where('username' , $username)->where('password' , $password)->get();
        if( count($user) > 0 ){
            $user = $user[0];
            return redirect('/home');
        }else{
            return redirect('/');
        }
    }

    public function logout(){
        // Déconnexion
    }
}
