<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getAll()
    {
        $locations = Location::getAll();

        return view('location-list', [
            'locations' => $locations
        ]);
    }
    public function getById($id)
    {
        $location = Location::getById($id);

        return view('location-By-Id', [
            'location' => $location
        ]);
    }
    
    public function insert($idSociety,$localisation,$primaire)
    {
        Location::insert($idSociety,$localisation,$primaire);
        $locations = Location::getAll();

        return view('location-list', [
            'locations' => $locations
        ]);
    }

    public function delete($id)
    {
        Location::remove($id);
        $locations = Location::getAll();

        return view('location-list', [
            'locations' => $locations
        ]);
    }
    public function update($id,$idSociety,$localisation,$primaire)
    {
        Location::modif($id,$idSociety,$localisation,$primaire);
        $locations = Location::getAll();

        return view('location-list', [
            'locations' => $locations
        ]);
    }


}
