<?php

namespace App\Exceptions;
use Exception;
use Illuminate\Contracts\Support\Responsable;

class InvalidNumberException extends Exception implements Responsable
{
    public function toResponse($request){
        return response()->json(['error' => $this->message], 400);
    }
    //
    public function shouldntReport(){
        return true;
    }
}
