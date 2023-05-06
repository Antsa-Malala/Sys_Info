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
            throw new DatabaseException("Insertion centre echouee",$e);
        }
    } 
    public static function remove($id){
        $result = DB::delete("DELETE FROM centre WHERE idcentre = ?", [$id]);
    } 
    
    public static function getAllLimited( $limit , $begin ){
        $centre = DB::select('SELECT * FROM centre LIMIT ? OFFSET ?' , [$limit , $begin]);
        return $centre;
    }

    public static function modifier($idcentre, $nomcentre)
    {
        if( empty($nomcentre) ) throw new \Exception("Le nom du centre ne peut etre vide");
        try{
            $result = DB::update("UPDATE centre SET nomcentre = ? WHERE idcentre = ?", [$nomcentre, $idcentre]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Modification centre echouee",$e);
        }
    }
    public static function getAll(){
        $journaux = DB::select('SELECT * FROM centre');
        return $journaux;
    }
    public static function getById($id) {
        $result = DB::select("SELECT * FROM centre WHERE idcentre = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
}