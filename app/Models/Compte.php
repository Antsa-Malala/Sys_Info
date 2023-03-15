<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;
    protected $fillable = ['numerocompte' , 'libelle'];
    protected $primaryKey = "numerocompte";
    public $timestamps = false;
    public $incrementing = false;

    public function __construct( $code = '' , $libelle = '' ){
        if( !empty($code) && !empty($libelle) ){
            $this->numerocompte = $code;
            $this->libelle = $libelle;
        }
    }
    public function modify( $code = '' , $libelle = '' ){
        if( !empty($code) && !empty($libelle) ){
            $this->numerocompte = $code;
            $this->libelle = $libelle;
        }
    }
}
