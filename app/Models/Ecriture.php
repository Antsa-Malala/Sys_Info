<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\OutRangeEcriture;

class Ecriture extends Model
{
    use HasFactory;

    protected $table = 'ecriture';
    protected $fillable = ['dateecriture' , 'libelle' , 'idexercice'];
    protected $primaryKey = 'idecriture';
    public $timestamps = false;
    public $incrementing = true;

    public function __construct( $date = '' , $libelle = '' , $exo = '' ){
        if( !empty($date) && !empty($libelle) && !empty($exo) ){
            $this->dateecriture = $date;
            $this->libelle = $libelle;
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
}