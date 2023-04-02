<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeJournal extends Model
{
    use HasFactory;
    protected $fillable = ['code' , 'libelle'];
    protected $primaryKey = "code";
    public $incrementing = false;
    public $timestamps = false;

    public function __construct( $code = '' , $libelle = '' ){
        if( !empty($code) && !empty($libelle) ){
            $this->code = $code;
            $this->libelle = $libelle;
        }
    }
    public function modify( $code = '' , $libelle = '' ){
        if( !empty($code) && !empty($libelle) ){
            $this->code = $code;
            $this->libelle = $libelle;
        }
    }
}
