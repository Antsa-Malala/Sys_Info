<?php 

	// Trim all
	if( !function_exists('isValid') ){
		function isValid( $string ){
			if( empty($string) || strlen($string) == 0 )
				throw new Exception("Entrer quelque chose");
			return true;
		}
	}
	if( ! function_exists('trimString') ){
		function trimString( $name ){
			return trim($name);
		}
	}
	// Mi-check Halavana
	if( !function_exists('checkLength') ){
		function checkLength( $string , $length){
			if( strlen($string) > $length )
				throw new Exception("Trop Long, verifier que c'est inférieur à ".$length." caractères ");
			return true;
		}
	}
	// Anontaniana hoe numéro valide ve ilay izy
	

?>