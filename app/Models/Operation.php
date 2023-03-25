<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidNumberException;


class Operation extends Model
{
    use HasFactory;

    // Inona daholo no atao rehefa anao opération
    // Mila manana idEcriture
    public function __construct(){

    }

    public static function merge( $no , $refere ){
        $array = array();
        for( $i = 0 ; $i < count($no) ; $i++ ){
            $numero = $no[$i].$refere[$i];
            $array[] = $numero;
        }
        return $array;
    }

    public static function isValid( $debit , $credit ){
        // Mila atao manome zero fotsiny izy roa
        $debs = 0;
        $creds = 0;
        var_dump($debit);
        var_dump($credit);
        $debs_length = count($debit);
        $cred_length = count($credit);
        for( $i = 0 ; $i < $debs_length ; $i++ ){
            if( strlen($debit[$i]) == 0 || ( strlen( $debit[$i] ) > 0 && $debit[$i] < 0 )  ){
                throw new InvalidNumberException("Désolé veuillez remplir le débit avec un nombre valide ( hint >= 0 ) : ".$debit[$i]);
            }
            $debs += $debit[$i];
        }
        for( $i = 0 ; $i < $cred_length ; $i++ ){
            if( strlen($credit[$i]) == 0 || ( strlen( $credit[$i] ) > 0 && $credit[$i] < 0 )  ){
                throw new InvalidNumberException("Désolé veuillez remplir le débit avec un nombre valide ( hint >= 0 ) : ".$credit[$i]);
            }
            $creds += $credit[$i];
        }
        return (($debs - $creds) == 0);
    }

}
