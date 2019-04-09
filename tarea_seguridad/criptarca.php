<?php

/*
 * @param string $action: can be 'encrypt' or 'decrypt'
 * @param string $string: string to encrypt or decrypt
*/

function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "camellia-192-ofb";
    $secret_key = 'UASHbWkCb3jCcK5j';
    $secret_iv = '36rtXfPdDRadqYuK';
    // hash
    $key = hash('sha256', $secret_key);
    
  
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

?>