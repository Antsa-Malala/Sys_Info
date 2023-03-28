<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    use HasFactory;
    protected $table = 'exercice';
    protected $fillable = ['years'];
    protected $primaryKey = "idExercice";
    // Alaina ny exercice farany
    public $timestamps = false;

    public function __construct($exo = ''){
        if(!empty($exo)){
            $this->years = $exo;
        }
    }

    public static function getCurrentExercice(){
        $latestExercice = Exercice::latest('idexercice')->first();
        return $latestExercice;
    }

}
