<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidNumberException;
use App\Exceptions\InvalidDataException;
use App\Exceptions\PlanException;
use App\Models\Plan;

class Operation extends Model{
    use HasFactory;
    protected $primaryKey = 'idoperation';
    protected $table = 'operation';
    protected $fillable = [
        'idecriture' , 'numpiece' , 'compte' , 'tiers' , 'libelle' , 'debit' , 'credit'
    ];
    public $incrementing = true;
    public $timestamps = false;

    public function __construct( $idecriture , $ref , $compte , $tiers = '' , $libelle , $debit = 0 , $credit = 0 ){
        $this->setIdEcriture($idecriture);
        $this->setReference($ref);
        $this->setCompte($compte);
        $this->setLibelle($libelle);
        $this->setTiers($tiers);
        $this->setDebit($debit);
        $this->setCredit($credit);
    }


    public function setReference( $reference ){
        if( empty($reference) ){
            throw new InvalidDataException("Le numéro de reference ne peut etre vide");
        }
        $this->numpiece = $reference;
    }

    public function setIdEcriture( $idecriture ){
        if( empty($idecriture) ){
            throw new InvalidDataException("L'écriture choisi n'est pas valide : " .$idecriture);   
        }
            $this->idecriture = $idecriture;
    }

    public function setCompte( $compte ){
        if( empty( $compte ) ) throw new InvalidDataException("Le compte choisi ne doit pas etre vide : ".$compte);
        try{
            Plan::exist(trim($compte));
            $this->compte = $compte;
        }catch( PlanException $plan ){
            throw $plan;
        }
    }

    public function setLibelle( $libelle ){
        if( empty( $libelle ) ){
            throw new InvalidDataException("Le libelle ne doit pas etre vide");
        }
        $this->libelle = $libelle;
    }

    public static function merge( $no , $refere ){
        $array = array();
        for( $i = 0 ; $i < count($no) ; $i++ ){
            $numero = $no[$i].$refere[$i];
            $array[] = $numero;
        }
        return $array;
    }

    public function validate( $reference , $libelle ){
        if( strpos($this->numpiece , $reference) !== false && strpos( $this->libelle , $libelle ) !== false ){
            return true;
        }
        throw new InvalidDataException("Vous ne pouvez pas modifier les reference de pieces ou les libelle");
    }

    public function isValidDate( $date1 , $original_date ){
        $dat1 = date("Y-m-d" , strtotime($date1));
        $dat2 = date("Y-m-d" , strtotime($original_date));
        if( $dat1 == $dat2 ){
            return true;
        }
        throw new InvalidDataException("Vous ne pouvez pas modifier la date d'operation");
    }

    public function setDebit( $debit ){
        $d = strval($debit);
        try{
            $this->checkNumber($d);
            $this->debit = $debit;
        }catch( InvalidDataException $e ){
            throw $e;
        }
    }

    public function setCredit( $credit ){
        $d = strval($credit);
        try{
            $this->checkNumber($d);
            $this->credit = $credit;
        }catch( InvalidDataException $e ){
            throw $e;
        }
    }

    public function setTiers( $tiers = '' ){
        try{
            if( empty($tiers) ){
                $this->tiers = $tiers;
            }else if(Tiers::exist($tiers)){
                $this->tiers = $tiers;
            }
        }catch( PlanException $plan){
            throw $plan;
        }

    }

    private function checkNumber($n){
        $regex = "/[a-zA-Z]/";
        $preg = preg_match($regex , $n);
        if( $preg != 0 ){
            throw new InvalidDataException(" Vous ne pouvez pas introduire des lettres : ".$n);
        }else if( $n < 0 ){
            throw new InvalidDataException(" Vous ne pouvez pas introduire des nombres négatifs : ".$n);
        }
        return $n;
    }


}
