<?php

namespace App\Http\Controllers;

use App\Models\Society;
use Illuminate\Http\Request;

class SocietyController extends Controller
{
    public function getAll()
    {
        $societies = Society::getAll();

        return view('society-list', [
            'societies' => $societies
        ]);
    }
    public function getById($id)
    {
        $society = Society::getById($id);

        return view('society-By-Id', [
            'society' => $society
        ]);
    }
    
    public function insert($nom,$creation,$fondateur,$nif,$logo,$date_exercice,$status,$telecopie,$telephone)
    {
        Society::insert($nom,$creation,$fondateur,$nif,$logo,$date_exercice,$status,$telecopie,$telephone);
        $societies = Society::getAll();

        return view('society-list', [
            'societies' => $societies
        ]);
    }

    public function delete($id)
    {
        Society::remove($id);
        $societies = Society::getAll();

        return view('society-list', [
            'societies' => $societies
        ]);
    }
    public function update($id,$nom,$creation,$fondateur,$nif,$logo,$date_exercice,$status,$telecopie,$telephone)
    {
        Society::modif($id,$nom,$creation,$fondateur,$nif,$logo,$date_exercice,$status,$telecopie,$telephone);
        $societies = Society::getAll();

        return view('society-list', [
            'societies' => $societies
        ]);
    }


}
