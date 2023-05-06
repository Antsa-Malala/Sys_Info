<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\DatabaseException;
use App\Models\Plan;
class Charge extends Model{

    private static function fillZero($numero){
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
}