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
}