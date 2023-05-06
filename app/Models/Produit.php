<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\DatabaseException;
class Produit extends Model{
    protected $table = 'produit';

    public static function insert($nom,$volume,$prix) {
        if( empty($nom) ) throw new \Exception("Le nom du produit ne peut etre vide");
        if( empty($volume) ) throw new \Exception("Le volume ne peut etre vide");
        if( empty($prix) ) throw new \Exception("Le prix ne peut etre vide");
        try{
            $result = DB::insert("INSERT INTO produit(nomProduit,volume,prix) VALUES(?,?,?)", [$nom,$volume,$prix]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Insertion produit echouee");
        }
    }
    public static function remove($id){
        $result = DB::delete("DELETE FROM produit WHERE idproduit = ?", [$id]);
    }
    public static function modifier($idproduit,$nom,$volume,$prix)
    {
        if( empty($idproduit) ) throw new \Exception("L'id du produit est indefini'");
        if( empty($nom) ) throw new \Exception("Le nom du produit ne peut etre vide");
        if( empty($volume) ) throw new \Exception("Le volume ne peut etre vide");
        if( empty($prix) ) throw new \Exception("Le prix ne peut etre vide");
        try{
            $result = DB::update("UPDATE produit SET nomproduit = ?,volume= ?, prix = ? WHERE idproduit = ?", [$nom,$volume,$prix, $idproduit]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Modification produit echouee");
        }
    }

    public static function getAll(){
        $journaux = DB::select('SELECT * FROM produit');
        return $journaux;
    }
    public static function getById($id) {
        $result = DB::select("SELECT * FROM produit WHERE idproduit = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
}