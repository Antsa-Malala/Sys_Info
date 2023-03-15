<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    use HasFactory;
    protected $fillable = ['idcompte' , 'nom' , 'libelle'];
    protected $table = 'tiers';
    protected $primaryKey = 'idtiers';
    public $incrementing = true;
    public $timestamps = false;

    public function __construct($idcompte = '' , $nom ='', $libelle=''){
        if( !empty($idcompte) && !empty($nom) && !empty($libelle) ){
            $this->idcompte = $idcompte;
            $this->nom = $nom;
            $this->libelle = $libelle;
        }
    }

    public function modify( $idcompte = '' , $nom = '' , $libelle = '' ){
        if( !empty($idcompte) && !empty($nom) && !empty($libelle) ){
            $this->idcompte = $idcompte;
            $this->nom = $nom;
            $this->libelle = $libelle;
        }   
    }
}
