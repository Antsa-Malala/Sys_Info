<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bilan extends Model
{

    public static function getCP()
    {
        $result = DB::select("
        SELECT *,
        CASE WHEN solde > 0 THEN solde ELSE NULL END AS solde_debit, 
        CASE WHEN solde < 0 THEN solde * -1 ELSE NULL END AS solde_credit 
        from capitaux_propres where solde!=0");
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }
    public static function getSumCP()
    {
        $result = DB::select("
        SELECT
        CASE WHEN sum(solde)> 0 THEN sum(solde) ELSE NULL END AS solde_debit, 
        CASE WHEN sum(solde) < 0 THEN sum(solde) * -1 ELSE NULL END AS solde_credit 
        from capitaux_propres");
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function getPC()
    {
        $result = DB::select("
        SELECT *,
        CASE WHEN solde > 0 THEN solde ELSE NULL END AS solde_debit, 
        CASE WHEN solde < 0 THEN solde * -1 ELSE NULL END AS solde_credit 
        from passifs_courants where solde!=0");
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }
    public static function getSumPC()
    {
        $result = DB::select("
        SELECT
        CASE WHEN sum(solde)> 0 THEN sum(solde) ELSE NULL END AS solde_debit, 
        CASE WHEN sum(solde) < 0 THEN sum(solde) * -1 ELSE NULL END AS solde_credit 
        from passifs_courants");
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
    public static function getPNC()
    {
        $result = DB::select("
        SELECT *,
        CASE WHEN solde > 0 THEN solde ELSE NULL END AS solde_debit, 
        CASE WHEN solde < 0 THEN solde * -1 ELSE NULL END AS solde_credit 
        from passifs_non_courants where solde!=0");
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }
    public static function getSumPNC()
    {
        $result = DB::select("
        SELECT
        CASE WHEN sum(solde)> 0 THEN sum(solde) ELSE NULL END AS solde_debit, 
        CASE WHEN sum(solde) < 0 THEN sum(solde) * -1 ELSE NULL END AS solde_credit 
        from passifs_non_courants");
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function getAC()
    {
        $result = DB::select("
        SELECT *,
        CASE WHEN solde > 0 THEN solde ELSE NULL END AS solde_debit, 
        CASE WHEN solde < 0 THEN solde * -1 ELSE NULL END AS solde_credit 
        from actifs_courants where solde!=0");
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }
    public static function getSumAC()
    {
        $result = DB::select("
        SELECT
        CASE WHEN sum(solde)> 0 THEN sum(solde) ELSE NULL END AS solde_debit, 
        CASE WHEN sum(solde) < 0 THEN sum(solde) * -1 ELSE NULL END AS solde_credit 
        from actifs_courants");
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
    public static function getANC()
    {
        $result = DB::select("
        SELECT *,
        CASE WHEN solde > 0 THEN solde ELSE NULL END AS solde_debit, 
        CASE WHEN solde < 0 THEN solde * -1 ELSE NULL END AS solde_credit 
        from actifs_non_courants where solde!=0");
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }
    public static function getSumANC()
    {
        $result = DB::select("
        SELECT
        CASE WHEN sum(solde)> 0 THEN sum(solde) ELSE NULL END AS solde_debit, 
        CASE WHEN sum(solde) < 0 THEN sum(solde) * -1 ELSE NULL END AS solde_credit 
        from actifs_non_courants");
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function getSoldeActifs()
    {

        $result = DB::select("
        SELECT
        CASE WHEN sum(solde)> 0 THEN sum(solde) ELSE NULL END AS solde_debit, 
        CASE WHEN sum(solde) < 0 THEN sum(solde) * -1 ELSE NULL END AS solde_credit 
        from solde_actifs");
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
    public static function getSoldePassifs($valeur)
    {
        $result=null;
        if($valeur<0)
        {
            $result = DB::select("
            SELECT
            CASE WHEN sum(solde) > 0 THEN sum(solde) ELSE NULL END AS solde_debit, 
            CASE WHEN sum(solde)+".$valeur." < 0 THEN sum(solde) * -1 ELSE NULL END AS solde_credit 
            from solde_passifs");
        }
        else if($valeur>=0){
            $result = DB::select("
            SELECT
            CASE WHEN sum(solde) +".$valeur." > 0 THEN sum(solde) ELSE NULL END AS solde_debit, 
            CASE WHEN sum(solde)< 0 THEN sum(solde) * -1 ELSE NULL END AS solde_credit 
            from solde_passifs");
        }
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function getresultats()
    {
        $result = DB::select("
        SELECT *
        from resultats");
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
    


}
?>