<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidNumberException;
use App\Exceptions\InvalidDataException;
use App\Exceptions\PlanException;
use App\Exceptions\BalanceException;
use App\Exceptions\ProductAndCenterException;
use App\Models\Plan;

class Operation extends Model{
    use HasFactory;
    protected $primaryKey = 'idoperation';
    protected $table = 'operation';
    protected $fillable = [
        'idecriture' , 'numpiece' , 'compte' , 'tiers' , 'libelle' , 'debit' , 'credit'
    ];
    public $variable;
    public $fixe;
    public $type;
    public $error;
    protected $guarded = 1;
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
            $compte = Plan::exist(trim($compte));
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
        throw new InvalidDataException("Vous ne pouvez pas modifier la date d'operation ".$dat1."====>".$dat2);
    }

    public function setDebit( $debit = 0){
        $d = $debit;
        try{
            $i = $this->checkNumber($d);
            $this->debit = $i;
        }catch( InvalidDataException $e ){
            throw $e;
        }
    }

    public function setCredit( $credit = 0){
        $d = $credit;
        try{
            $i = $this->checkNumber($d);
            $this->credit = $i;
        }catch( InvalidDataException $e ){
            throw $e;
        }
    }

    public function setTiers( $tiers = '' ){
        try{
            if( empty($tiers) ){
                // var_dump($tiers);
                $this->tiers = null;
            }else if(!empty(Tiers::exist($tiers))){
                $this->tiers = $tiers;
            }
        }catch( PlanException $plan){
            throw $plan;
        }
    }

    public function setVariable($variable){
        if( !is_numeric($variable) || $variable == '' ){
            throw new InvalidDataException("Inserer une valeur valable pour la charge : VARIABLE");
        }
        $this->variable = $variable;
    }


    public function setFixe($fixe){
        if( !is_numeric($fixe) || $fixe == '' ){
            throw new InvalidDataException("Inserer une valeur valable pour la charge : FIXE");
        }
        $this->fixe = $fixe;
    }

    public function getVariable(){
        return $this->variable;    
    }

    public function getFixe(){
        return $this->fixe;
    }

    public function setType( $type ){
        // Définir un type
        // Si $type == 0 alors Incorporel
        // Si $type == 1 alors Non Incorporel
        // Si $type == 2 alors Supplétive
        if( $type == '' || !is_numeric($type)){
            throw new InvalidDataException("Veuillez choisir un option que ce soit Incorporable ou Non");
        }
        $this->type = $type;
    }
    public function getType(){
        return $this->type;
    }

    private function checkNumber($n){
        $regex = "/[a-zA-Z]/";
        $preg = preg_match($regex , $n);
        if($n == ''){
            return 0;
        }
        if( $preg != 0 ){
            throw new InvalidDataException(" Vous ne pouvez pas introduire des lettres : ".$n);
        }else if( $n < 0 ){
            throw new InvalidDataException(" Vous ne pouvez pas introduire des nombres négatifs : ".$n);
        }
        return castToNumber($n);
    }

    public function try_save($date_operation="")
    {
        $this->save();
        if($this->isCharge())
        {
            if( $this->type == 0 ){
                Cout::insert_cout_produit($this->compte,$this->debit,$this->variable,$this->fixe,$date_operation);
            }
        }
    }
    public function isCharge(){
        if(strpos($this->compte, '6') !== 0)
            return false;
        try{
            Plan::contains( $this->compte );
        }catch( ProductAndCenterException $e ){
            throw $e;
        }
        return true;
    }

    public function isBalanced(){
        if( $this->getVariable() + $this->getFixe() != 0 && $this->getVariable() + $this->getFixe() != 100 ){
            throw new BalanceException($this->getVariable() + $this->getFixe());
        }
        return true;
    }

}
