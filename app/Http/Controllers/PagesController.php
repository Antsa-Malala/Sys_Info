<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome Master !";
        $data['title'] = $title;
        return view('pages.login')->with($data);
    }
    public function addSociety(){
        $title = "Add a Society";
        $data['title'] = $title;
        return view('pages.index')->with($data);
    }
}
