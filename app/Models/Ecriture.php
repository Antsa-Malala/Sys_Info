<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\OutRangeEcriture;
use App\Exceptions\InvalidEcritureException;
use App\Models\Operation;

class Ecriture extends Model{
    use HasFactory;

    protected $table = 'ecriture';
    protected $fillable = ['dateecriture' , 'libelle' , 'idexercice' , 'idcode'];
    protected $primaryKey = 'idecriture';
    public $timestamps = false;
    public $incrementing = true;

    public function __construct( $date = '' , $libelle = '' , $exo = '' , $code = ''){
        if( !empty($date) && !empty($libelle) && !empty($exo) && !empty($code)){
            $this->dateecriture = $date;
            $this->libelle = $libelle;
            $this->idcode = $code;
            $this->setIdExercice($exo);
        }
    }

    public function modify($date = '' , $libelle = '' , $exo = '' ){
        if( !empty($date) && !empty($libelle) && !empty($exo) ){
            $this->dateEcriture = $date;
            $this->libelle = $libelle;
            $this->setIdExercice($exo);
        }
    }

    public static function getById($id=''){
        if( empty($id) ){
            return back()->withErrors(["idNull" => "The Id can't be NULL"]);
        }
        return Ecriture::find($id);

    }

    public static function getLast(){
        $lastInsered = Ecriture::latest('idecriture')->first();
        $lastInsered->dateecriture = date('Y-m-d' , strtotime($lastInsered->dateecriture));
        return $lastInsered;
    }


    // getters and setters

    public function setIdExercice( $value = ''){
        if( empty($value)  ) return back()->withErrors("Can't assign null value to idExercice")->withInput();
        $y = trim(date('Y', strtotime($this->dateecriture)));
        $y1 = trim(str($value->years));
        if( strcmp($y, $y1) != 0 ){
            throw new OutRangeEcriture("Vous ne pouvez pas entrer une ecriture en dehors de la date d'exercice : ".$this->dateecriture);
        }
        $this->idexercice = $value->idexercice;
    }
    public static function getMonth(){
        $data = array('Janvier' , 'Fevrier' , 'Mars' , 'Avril' , 'Mai' , 'Juin' , 'Juillet' , 'Aout' , 'Septembre' , 'Octobre' , 'Novembre' , 'Decembre');
        return $data;
    }

    public function createReference(){
        // Alaina aloha ilay code mifanaraka aminy
        $journaux = Journaux::getById($this->idcode);
        $date = date("Y" , strtotime($this->dateecriture));
        return $journaux->code."".$date;
    }

    public function isValidEcriture( $operations ){
        $credit = 0;
        $debit = 0;
        for( $i = 0 ; $i < count($operations) ; $i++ ){
            $debit = $debit + $operations[$i]->debit;
            $credit = $credit + $operations[$i]->credit;
        }
        if( $debit - $credit == 0 ){
            return true;
        }
        throw new InvalidEcritureException( $debit , $credit );
    }
}
