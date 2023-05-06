<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Centre;
class CentreController extends Controller
{
    public function insert_form()
    {
        $data['title'] = 'Ajouter un centre';
        return view('pages.centre.insert')->with($data);
    }
    public function insert(Request $request)
    {

        $nom = trim($request->input('nom_centre'));
        Centre::insert($nom);
        $data['title'] = 'Ajouter un centre';
        return view('pages.centre.insert')->with($data);
    }
}
