<?php

namespace App\Exceptions;

use Exception;

class InvalidDataException extends Exception
{
    public function __construct( $message ){
        parent::__construct($message);
    }
}
