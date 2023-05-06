<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\DatabaseException;
use App\Models\Plan;
class Charge extends Model{

    public static function fillZero($numero){
        $var = 0;
        $total = strlen($numero);
        $t = (string) $numero;
        for( $i = $total + 1 ; $i <= 5 ; $i++ ){
            $t = $t.'0';
        }
        return $t;
    }
    public static function getproduitbycharge($idcharge)
    {
        $idcharge = Charge::fillZero($idcharge);
        $produit = DB::select('SELECT * FROM pourcentage_produit join produit on produit.idproduit=pourcentage_produit.idproduit where pourcentage_produit.idcharge=?',[$idcharge]);
        return $produit;
    }

    public static function insertpourcentageproduit($idproduit,$idcharge,$pourcentage)
    {
        if( empty($idproduit) ) throw new \Exception("L'id du produit est non defini");
        if( empty($idcharge) ) throw new \Exception("L'id de la charge est non defini");
        if( $pourcentage<0 || $pourcentage>100 ) throw new \Exception("Le pourcentage ne peut etre negatif ni supérieur a 100");
        try{
            $idcharge=Charge::fillZero($idcharge);
            if($pourcentage>Charge::getrestebycharge($idcharge)) throw new \Exception("Le pourcentage pour cette charge est deja complet");
            else{
                $result = DB::insert("INSERT INTO pourcentage_produit (idproduit,idcharge,pourcentage)values(?,?,?)", [$idproduit,$idcharge,$pourcentage]);
            }
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Insertion pourcentage produit echouee",$e);
        }
    }

    public static function getrestebycharge($idcharge)
    {
        $idcharge=Charge::fillZero($idcharge);
        $produit = DB::select('SELECT COALESCE(100-sum(pourcentage), 100) as somme FROM pourcentage_produit where idcharge=?',[$idcharge]);
        return $produit[0]->somme;
    }

    Public static function updatepourcentageproduit($idproduit,$idcharge,$pourcentage)
    {
        if( empty($idproduit) ) throw new \Exception("L'id du produit est non defini");
        if( empty($idcharge) ) throw new \Exception("L'id de la charge est non defini");
        if( $pourcentage<0 || $pourcentage>100 ) throw new \Exception("Le pourcentage ne peut etre negatif ni supérieur a 100");
        try{
            $idcharge=Charge::fillZero($idcharge);
            $result = DB::update("UPDATE pourcentage_produit SET pourcentage = ? WHERE idproduit = ? and idcharge= ?", [$pourcentage,$idproduit,$idcharge]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Modification pourcentage produit echouee",$e);
        }
    }
}