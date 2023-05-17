<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\DatabaseException;
use App\Models\Plan;
class Cout extends Model{

public static function getcout()
{
    $nature = DB::select('SELECT * FROM cout');
    return $nature;
}
public static function coutbycharge()
{
    $nature = DB::select('SELECT COALESCE(sum(montant),0) as montant,idcharge FROM cout group by idcharge');
    return $nature;
}
//Cout de revient par nature
public static function coutbynature()
{
    $nature['fixe']=Cout::getcoutfixe();
    $nature['sommefixe']=Cout::sommecoutfixe();
    $nature['variable']=Cout::getcoutvariable();
    $nature['sommevariable']=Cout::sommecoutvariable();
    return $nature;

}
public static function getcoutfixe()
{
    $nature = DB::select('SELECT COALESCE(sum(montant)*fixe/100,0) as montant,idcharge FROM cout where fixe!=0 group by idcharge,fixe');
    return $nature;
}
public static function sommecoutfixe()
{
    $nature = DB::select('SELECT COALESCE(sum(montant)*fixe/100,0) as montant FROM cout where fixe!=0 group by fixe');
    $somme=0;
    for($i=0;$i<count($nature);$i++)
    {
        $somme+=$nature[$i]->montant;
    }
    return $somme;
}
public static function getcoutvariable()
{
    $nature = DB::select('SELECT COALESCE(sum(montant)*variable/100,0) as montant,idcharge FROM cout where variable!=0 group by idcharge,variable');
    return $nature;
}
public static function sommecoutvariable()
{
    $nature = DB::select('SELECT COALESCE(sum(montant)*variable/100,0) as montant FROM cout where variable!=0 group by variable');
    $somme=0;
    for($i=0;$i<count($nature);$i++)
    {
        $somme+=$nature[$i]->montant;
    }
    return $somme;
}


public static function coutbyproduit()
{
    $produit = DB::select('SELECT produit.idproduit,produit.nomproduit,sum(montant) as montant from cout join produit on produit.idproduit=cout.idproduit group by produit.nomproduit,produit.idproduit');
    return $produit;
}
public static function coutbycentre()
{
    $centre = DB::select('SELECT centre.idcentre,centre.nomcentre,sum(montant) as montant from cout join centre on centre.idcentre=cout.idcentre group by centre.nomcentre,centre.idcentre');
    return $centre;
}
public static function getproduitcentre()
{
    $centreproduit=array();
    $produit=Produit::getAll();
    for ($i = 0; $i < count($produit); $i++) {
        $product=$produit[$i];
        $centre=Cout::coutbyproduitbycentre($product->idproduit);
        $product->centre=$centre;
        array_push($centreproduit,$product);
    }
    return $centreproduit;
}
public static function coutbyproduitbycentre($idproduit)
{
    $nature = DB::select('SELECT cout.idcentre,centre.nomcentre,sum(montant) as montant from cout join centre on centre.idcentre=cout.idcentre where cout.idproduit=? group by cout.idproduit,cout.idcentre,centre.nomcentre',[$idproduit]);
    return $nature;
}
public static function chiffre_affaire()
{
    $nature = DB::select("select COALESCE(sum(credit),0) as somme from operation where compte like '7%'");
    return $nature[0]->somme;
}
public static function getcentreproduit()
{
    $produitcentre=array();
    $centre=Centre::getAll();
    for ($i = 0; $i < count($centre); $i++) {
        $center=$centre[$i];
        $produit=Cout::coutbycentrebyproduit($center->idcentre);
        $center->produit=$produit;
        array_push($produitcentre,$center);
    }
    return $produitcentre;
}
public static function coutbycentrebyproduit($idcentre)
{
    $nature = DB::select('SELECT cout.idproduit,produit.nomproduit,sum(montant) as montant from cout join produit on produit.idproduit=cout.idproduit where cout.idcentre=? group by cout.idcentre,cout.idproduit,produit.nomproduit',[$idcentre]);
    return $nature;
}

public static function insertion_cout($idproduit,$fixe,$variable,$idcentre,$idcharge,$date_operation,$montant)
{
    if( empty($idproduit) ) throw new \Exception("L'id du produit est non defini");
    if( empty($idcharge) ) throw new \Exception("L'id de la charge est non defini");
    if( empty($idcentre) ) throw new \Exception("L'id du centre est non defini");
    try{
        $idcharge=Charge::fillZero($idcharge);
            $result = DB::insert("INSERT INTO cout(idproduit,fixe,variable,idcentre,idcharge,date_operation,montant)values(?,?,?,?,?,?,?)", [$idproduit,$fixe,$variable,$idcentre,$idcharge,$date_operation,$montant]);
    }catch(\Illuminate\Database\QueryException $e){
        throw $e;
        // throw new DatabaseException("Insertion pourcentage centre par produit echouee", $e );
    }
}
public static function insert_cout_produit($idcharge,$montant,$variable,$fixe,$date_operation)
    {
        $produitbycharge = Produit::getproduitcentrebycharge($idcharge);
        // $produitbycharge = Charge::getproduitbycharge($idcharge);
        $f=($fixe*$montant)/100;
        $v=($variable*$montant)/100;
        if( $variable + $fixe !=100 ) throw new \Exception("Le pourcentage variable fixe devrait etre egal a 100");
        if( empty($produitbycharge) ) throw new \Exception("Vous devez definir les pourcentage de produit pour cette charge");
        else{
            for ($i = 0; $i < count($produitbycharge); $i++) {
                $vola = $montant * $produitbycharge[$i]->pourcentage / 100 ;
                $centre = $produitbycharge[$i]->centre;
                // $centre = Produit::getproduitcentrebycharge($idcharge,$produitbycharge[$i]->idproduit);
                // var_dump($idcharge);
                if( empty($centre) ) throw new \Exception("Vous devez definir les pourcentages de centre pour les produits de cette charge");
                else{
                    for($j=0;$j<count($centre);$j++){
                        $vola_centre = $vola * ($centre[$j]->pourcentage) / 100;
                        Cout::insertion_cout($produitbycharge[$i]->idproduit,$f,$v,$centre[$j]->idcentre,$idcharge,$date_operation,$vola_centre);
                    }
                }
            }
        }
    }
}