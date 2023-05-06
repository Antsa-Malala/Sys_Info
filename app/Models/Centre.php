<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\DatabaseException;
class Centre extends Model{
    protected $table = 'centre';

    public static function insert($nom) {
        if( empty($nom) ) throw new \Exception("Le nom du centre ne peut etre vide");
        try{
            $result = DB::insert("INSERT INTO centre(nomcentre) VALUES(?)", [$nom]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Insertion centre echouee");
        }
    }   
}