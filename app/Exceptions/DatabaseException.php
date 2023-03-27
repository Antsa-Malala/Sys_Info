<?php

namespace App\Exceptions;

use Exception;

class DatabaseException extends Exception{
    protected $additional_message = '';

    public function __construct( $message , $sql ){
        $this->getPreciseMessage($sql);
        parent::__construct($message.$this->additional_message);
    }

    public function getPreciseMessage( $message ){
        // Alaina ny type an'ilay exception
        if( strpos( $message , 'Duplicate Entry' ) !== false || ( strpos( $message , 'Unique Violation') !== false ) || (strpos($message, 'unique')) ){
            $this->additional_message = "Vous ne pouvez pas ajouter deux elements de meme code";
        }else{
            $this->additional_message = "You can't add that";
        }
    }
}
