<?php

namespace App\Exceptions;

use Exception;

class InvalidEcritureException extends Exception{
    
    public function __construct( $debit , $credit ){
        $message = $this->getPreciseMessage($debit , $credit);
        parent::__construct($message);
    }

    private function getPreciseMessage( $debit , $credit ){
        if( $debit > $credit ){
            return "Il reste : ".$debit." de debit a balancer. Veuillez entrer le reste du credit soit : ".abs($debit - $credit);
        }else if($debit < $credit){
            return "Il reste : ".$credit." de credit a balancer. Veuillez entrer le reste du debit soit : ".abs($debit - $credit);
        }
    }

}
