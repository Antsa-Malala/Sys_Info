<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidNumberException;
class Society extends Model{
    protected $table = 'society';
    public $timestamps = false;
    protected $fillable = [
            'idsociety' , 'nom' , 'creation' , 'fondateur' , 'nif' , 'logo' , 
            'date_exercice' , 'status' , 'telecopie', 'telephone', 'desciption' , 'nifpath'
    ];
    // protected $table = "society";
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

    public static function getAll(){
        $society = DB::select('SELECT * FROM society');
        return $society;
    }
    public static function getById($id) {
        $result = DB::select("SELECT * FROM society WHERE idSociety = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function insert($nom,$creation,$fondateur,$nif,$logo,$date_exercice,$status,$telecopie,$telephone) {
        $result = DB::insert("INSERT INTO society VALUES(default,?,?,?,?,?,?,?,?,?)", [$nom,$creation,$fondateur,$nif,$logo,$date_exercice,$status,$telecopie,$telephone]);
    }

    public static function remove($id)
    {
        $result = DB::delete("DELETE FROM society WHERE idSociety = ?", [$id]);
    }

    public static function modif($id, $nom,$creation,$fondateur,$nif,$logo,$date_exercice,$status,$telecopie,$telephone)
    {
        $result = DB::update("UPDATE society SET nom = ?, creation= ?, fondateur= ?,nif= ?,logo= ?,date_exercice= ?,status= ?,telecopie= ?,telephone= ? WHERE idSociety = ?", [$nom,$creation,$fondateur,$nif,$logo,$date_exercice,$status,$telecopie,$telephone, $id]);
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

    public function getDescription(){
        return $this->description;
    }
    public function setDescription($d){
        $this->description = $d;
    }

    public function setFondateur($nom){
        $this->fondateur = $nom;
    }
    public function getFondateur(){
        return $this->fondateur;
    }

    public function setTelecopie($nom){
        $this->telecopie = $nom;
    }
    public function getTelecopie(){
        return $this->telecopie;
    }
    
    public function setTelephonie($nom){
        $o = isValidNumber($nom);
        if( $o ){
            $this->telephone = $nom;
        }
        throw new InvalidNumberException("Please Enter a valid Number");
        
    }
    public function getTelephonie(){
        return $this->telephone;
    }

    public function setDateExercice($nom){
        $this->date_exercice = $nom;
    }
    public function getDateExercice(){
        return $this->date_exercice;
    }

    // public function setStatus($nom){
    //     $this->status = $nom;
    // }
    // public function getStatus(){
    //     return $this->status;
    // }

    public function setLogo($nom){
        $this->logo = $nom;
    }
    public function getLogo(){
        return str_replace("\s" , "%20" , $this->logo);
    }

    public function getAge(){
        // $no = date('Y-m-d');
        $dif = new \DateTime($this->getCreation());
        $d = new \DateTime();
        $da = $d->diff($dif);
        return $da->y; 
    }
}
?>