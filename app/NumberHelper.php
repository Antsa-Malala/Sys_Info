<?php 
	
	if( !function_exists('isBetween') ){
		function isBetween( $number , $begin , $final ){
			if( $begin <= $number && $number <= $final ) return true;
			throw new Exception( sprintf("Entrer un nombre valide entre : %d et %d " , $begin , $final));
		}
	}
	if( !function_exists('isNegative') ){
		function isNegative( $number ){
			if( $number >= 0 ) return true;
			throw new Exception( "Vous ne pouvez pas entrer un nombre négatif" );
		}
	}
	if ( !function_exists('convertToMiles')) {
		function convertToMiles($number){
			// 1 - Initialize an array to put the value in
			$numbers = array();
			// 2 - Change the number to array
			$number = array_map('intval' , str_split(strval($number)));
			// 3 - Reverse the array
			$number = array_reverse($number);
			// 4 - Loop over the $number array
			$j = 0;
			// print($number);
			for( $i = 0 ; $i < count($number) ; $i++ ){
				// 5 - Add the value to the empty array
				if( $i != 0 && $i % 3 == 0 ){
					$numbers[] = ' ';
				}
				$numbers[] = $number[$i];
			} 
			// 7 - reverse the new array of numbers
			$numbers = array_reverse($numbers);
			// 8 - convert it to a number
			$numbers = implode($numbers);
			// 9 - remove all space trailling and ending
			$numbers = trim($numbers , "\s");
			// 10 - Return a clean number
			return $numbers;
		}
	}

	if( !function_exists('isValidNumber') ){
		function isValidNumber( $number ){
			// Inona ny regex ako
			// Anontaniana hoe inona ilay raha misy caractere de adaboy

			$regex = '/[^1-9,\s,\+,\-]/';
			$str = strval($number);
			$matches = preg_match($regex, $str);
			return ($matches == 0);
		}
	}

?>