<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
            'idsociety' , 'nom' , 'creation' , 'fondateur' , 'nif' , 'logo' , 
            'date_exercice' , 'status' , 'telecopie', 'telephone', 'desciption' , 'nifpath'
    ];
    protected $table = "society";
    protected $primaryKey = "idsociety";
    public $incrementing = true;

    public function __construct( $data = null  ){
        parent::__construct();
        if($data != null){
            $this->setNom( $data['name'] );
            $this->setCreation( $data['creation'] );
            $this->setFiscImage( $data['nif-image'] );
            $this->setFisc( $data['nif'] );
            $this->setStatus( $data['status'] );
            $this->setFondateur( $data['fondateur'] );
            $this->setLogo( $data['logo'] );
            $this->setDateExercice( $data['date_exercice'] );
            $this->setTelecopie( $data['telecopie'] );
            $this->setTelephonie( $data['telephone'] );
            $this->setDescription( $data['description'] );
        }
    }

    public function setNom($nom){
        $this->nom = $nom;
    }
    public function getNom(){
        return $this->nom;
    }
    public function setCreation($date){
        $this->creation = $date;
    }
    public function getCreation(){
        return $this->creation;
    }

    public function setFiscImage($nif){
        $this->nifpath = $nif;
    }
    public function getFiscImage(){
        return $this->nifpath;
    }

    public function setFisc($nif){
        $this->nif = $nif;
    }
    public function getNif(){
        return $this->nif;
    }

    public function setStatus($nom){
        $this->status = $nom;
    }
    public function getStatus(){
        return $this->status;
    }

    public function setFondateur($nom){
        $this->fondateur = $nom;
    }
    public function getFondateur(){
        return $this->fondateur;
    }

    public function setLogo($nom){
        $this->logo = $nom;
    }
    public function getLogo(){
        return $this->logo;
    }

    public function setDateExercice($date){
        $this->date_exercice = $date;
    }
    public function getDateExercice(){
        return $this->date_exercice;
    }

    public function setTelecopie($nom){
        $this->telecopie = $nom;
    }
    public function getTelecopie(){
        return $this->telecopie;
    }
    public function setTelephonie($nom){
        $this->telephone = $nom;
    }
    public function getTelephonie(){
        return $this->telephone;
    }
    public function setDescription($nom){
        $this->description = $nom;
    }
    public function getDescription(){
        return $this->description;
    }

}
