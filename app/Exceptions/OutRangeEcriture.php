<?php

namespace App\Exceptions;

use Exception;

class OutRangeEcriture extends Exception
{
    public function report($message = "Une erreur s'est produite"){
        \Log::debug($message);
    }
}
