<?php

function cifrar($string) {
        $output = false;

       $password = hash('sha512', $string);	   
	   $output=$password;
   
    return $output;	
}
	
	
function decifrar($string) {
    $output = false;
		
	$verify = hash('sha512', $string);
	$output = password_verify($verify, $password);
 
    return $output;	
}	
	
	
?>