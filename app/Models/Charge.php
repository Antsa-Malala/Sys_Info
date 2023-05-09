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

    //Liste des produits d'une charge avec pourcentage
    public static function getproduitbycharge($idcharge)
    {
        $idcharge = Charge::fillZero($idcharge);
        $produit = DB::select('SELECT * FROM pourcentage_produit join produit on produit.idproduit=pourcentage_produit.idproduit where pourcentage_produit.idcharge=?',[$idcharge]);
        return $produit;
    }

    //Method ajout de pourcentage de produit
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

    //maka ny pourcentage mbola tsy feno ho ana charge iray mba tsy hihoatra 100% ny charge ray par produit
    public static function getrestebycharge($idcharge)
    {
        $idcharge=Charge::fillZero($idcharge);
    //mamerina 100 raha mbola tsy ao ilay charge
        $produit = DB::select('SELECT COALESCE(100-sum(pourcentage), 100) as somme FROM pourcentage_produit where idcharge=?',[$idcharge]);
        return $produit[0]->somme;
    }

    //Method update pourcentage de produit
    public static function updatepourcentageproduit($idproduit,$idcharge,$pourcentage)
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

    //Methode de insertion de pourcentage de centre
    public static function insertpourcentagecentre($idproduit,$idcharge,$idcentre,$pourcentage)
    {
        if( empty($idproduit) ) throw new \Exception("L'id du produit est non defini");
        if( empty($idcharge) ) throw new \Exception("L'id de la charge est non defini");
        if( empty($idcentre) ) throw new \Exception("L'id du centre est non defini");
        if( $pourcentage<0 || $pourcentage>100 ) throw new \Exception("Le pourcentage ne peut etre negatif ni supérieur a 100");
        try{
            $idcharge=Charge::fillZero($idcharge);
            if($pourcentage>Charge::getrestebychargebycentre($idcharge)) throw new \Exception("Le pourcentage pour cette charge est deja complet");
            else{
                $result = DB::insert("INSERT INTO pourcentage_centre (idproduit,idcharge,idcentre,pourcentage)values(?,?,?,?)", [$idproduit,$idcharge,$idcentre,$pourcentage]);
            }
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Insertion pourcentage centre par produit echouee",$e);
        }
    }
    //maka ny pourcentage mbola tsy feno ho ana charge iray mba tsy hihoatra 100% ny charge ray par centre
    public static function getrestebychargebycentre($idcharge)
    {
        $idcharge=Charge::fillZero($idcharge);
    //mamerina 100 raha mbola tsy ao ilay charge
        $produit = DB::select('SELECT COALESCE(100-sum(pourcentage), 100) as somme FROM pourcentage_centre where idcharge=?',[$idcharge]);
        return $produit[0]->somme;
    }

    //Methode pour modifier le pourcentage d'un centre
    public static function updatepourcentagecentre($idproduit,$idcharge,$idcentre,$pourcentage)
    {
        if( empty($idproduit) ) throw new \Exception("L'id du produit est non defini");
        if( empty($idcharge) ) throw new \Exception("L'id de la charge est non defini");
        if( empty($idcentre) ) throw new \Exception("L'id du centre est non defini");
        if( $pourcentage<0 || $pourcentage>100 ) throw new \Exception("Le pourcentage ne peut etre negatif ni supérieur a 100");
        try{
            $idcharge=Charge::fillZero($idcharge);
            $result = DB::update("UPDATE pourcentage_centre SET pourcentage = ? WHERE idproduit = ? and idcentre = ? and idcharge= ? ", [$pourcentage,$idproduit,$idcentre,$idcharge]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Modification pourcentage centre echouee",$e);
        }
    }


    //Prendre un produit par son ID et leur listes de centres avec pourcentage
    public static function getcentrebyproduit($idcharge,$idproduit)
    {
        $idcharge = Charge::fillZero($idcharge);
        $produit = DB::select('SELECT * FROM pourcentage_centre join produit on produit.idproduit=pourcentage_centre.idproduit join centre on  pourcentage_centre.idcentre= centre.idcentre where pourcentage_centre.idcharge=? and pourcentage_centre.idproduit= ?',[$idcharge,$idproduit]);
        return $produit;
    }
    //Liste des produits avec pourcentage et avec leur pourcentages de centre
    //raha tsy alaina par produit ty zavatra ty dia asorina fotsiny ilay where idproduit
    public static function getproduitcentre($idcharge,$idproduit)
    {
        if( empty($idproduit) ) throw new \Exception("L'id du produit est non defini");
        if( empty($idcharge) ) throw new \Exception("L'id de la charge est non defini");
        $idcharge = Charge::fillZero($idcharge);
        //misy view vao noforonina ao amin'ny base.sql mampifandray pourcentage produit sy centre
        $produit = DB::select('SELECT * FROM produit_centre where idcharge=? and idproduit=?',[$idcharge,$idproduit]);
        return $produit;
    }
}