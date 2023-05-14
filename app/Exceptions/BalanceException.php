<?php

namespace App\Exceptions;

use Exception;

class BalanceException extends Exception{

    public function __construct($message){
        $this->generateMessage( $message );
        parent::__construct($this->additional_message);
    }
    
    private function generateMessage( $pourcentage ){
        if( $pourcentage < 100 ){
            $this->additional_message =  "Il reste ".(100 - $pourcentage)." de pourcentage à distribuer";
        }else if( $pourcentage > 100 ){
            $this->additional_message ="Le pourcentage ne peut pas depasser 100% , dépassé de ".($pourcentage - 100 )." pourcent";
        }
    }
}
