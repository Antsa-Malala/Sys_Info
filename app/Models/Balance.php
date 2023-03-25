<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Balance extends Model
{
    protected $table = 'balance';

    public static function getAll()
    {
        $result = DB::select("
            SELECT *, 
                CASE WHEN solde > 0 THEN solde ELSE 0 END AS solde_debit, 
                CASE WHEN solde < 0 THEN solde * -1 ELSE 0 END AS solde_credit 
            FROM balance
        ");
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

}
?>