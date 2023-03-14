<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = ['idsociety' , 'localisation' , 'primaire'];
    protected $table = "location";
    protected $primaryKey = "idlocation";
    public $timestamps = false;

    public function __construct($data){
        parent::__construct();
        $this->setIdSociety($data['idsociety']);
        $this->setLocalisation($data['localisation']);
        $this->setPrimaire($data['primaire']);
    }

    public function setIdSociety($id){
        $this->idsociety = $id;
    }
    public function getIdSociety(){
        return $this->idsociety;
    }
    public function setLocalisation($id){
        $this->localisation = $id;
    }
    public function getLocalisation(){
        return $this->localisation;
    }
    public function setPrimaire($id){
        $this->primaire = $id;
    }
    public function getPrimaire(){
        return $this->primaire;
    }

}
