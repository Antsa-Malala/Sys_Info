<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidDataException;

class Product extends Model
{
    use HasFactory;
    protected $table = "produit";
    protected $fillable = ["nomProduit" , "prix"];

    public function __construct( $name , $prix = 0){
        try{
            $this->setName($name);
            $this->setPrix($prix);
        }catch( InvalidDataException $e ){
            throw $e;
        }
    }

    public function setName( $name ){
        if( empty($name) ){
            throw new InvalidDataException( "Le nom ne doit pas être vide " );
        }
        $this->nomProduit = $name;
    }

    public function getName(){
        return $this->nomProduit;
    }

    public function setPrice( $prix ){
        if( empty($prix)){
            $prix = 0;
        }
        if( isNumber($prix) ){
            throw new InvalidDataException("Entrer un nombre valide");
        }
        $this->prix = $prix;
    }

    public function getPrice(){
        return $this->prix;
    }

}
