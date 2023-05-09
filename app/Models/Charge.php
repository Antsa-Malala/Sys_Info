<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\DatabaseException;
use App\Exceptions\BalanceException;
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

    public static function isBalanced( $pourcent ){
        $pourcentage = 0;
        $a = count($pourcent);
        for( $i = 0 ; $i < count($pourcent) ; $i++ ){
            if( is_numeric($pourcent[$i]) ){
                $a = (float) $pourcent[$i];
                if( $a < 0 ){
                    throw new \Exception(" Entrer un pourcentage positif ".$pourcent[$i]);
                }
                $pourcentage += $a;
            }else{
                throw new \Exception(" Entrer un pourcentage valide ");
            }
        }
        if( $pourcentage == 100 || $pourcentage == 0 ){
            return true;
        }
        throw new BalanceException( $pourcentage );
    }   
}