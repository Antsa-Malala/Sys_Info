<?php

namespace App\Exceptions;

use Exception;

class ProductAndCenterException extends Exception
{
    public function __construct( $message ){
        parent::__construct($message);
    }
}
