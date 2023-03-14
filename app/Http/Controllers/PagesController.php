<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome Master !";
        $data['title'] = $title;
        return view('pages.index')->with($data);
    }
    public function goto(){
        $title = "HOOOOOO";
        $data['title'] = $title;
        return view('pages.index')->with($data);
    }
}
