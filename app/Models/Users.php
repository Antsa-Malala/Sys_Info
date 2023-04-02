<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $fillable=["idsociety","username" , "password"];
    protected $primaryKey = "idUser";
    public $incrementing = true;
    public $timestamps = false;

    public function __construct($idsociety = '' , $username = '' , $password = ''){
        if( !empty($idsociety) && !empty($username) && !empty($password) ){
            $this->idsociety = $idsociety;
            $this->username = $username;
            $this->password = $password;
        }
    }

    public function modify($idsociety = '' , $username = '' , $password = ''){
        if( !empty($idsociety) && !empty($username) && !empty($password) ){
            $this->idsociety = $idsociety;
            $this->username = $username;
            $this->password = $password;
        }
    }


}
