<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\DatabaseException;
class Type_centre extends Model{


    //liste tous les centres 
    public static function getAll(){
        $type_centre = DB::select('SELECT * FROM type_centre');
        return $type_centre;
    }
    
    //maka centre par id
    public static function getById($id) {
        $result = DB::select("SELECT * FROM type_centre WHERE id = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
    public static function getBytype($type) {
        $result = DB::select("SELECT * FROM type_centre WHERE nom = ?", [$type]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }



}