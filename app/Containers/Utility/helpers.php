<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists(' stdClassToArray')) {

  function stdClassToArray(stdClass $object)
  {
    $array = json_decode(json_encode($object), true);
    return $array;
  }

}

if (!function_exists(' auth_user')) {

  function auth_user()
  {
      return $user = Auth::guard()->user();
  }

}

if (!function_exists(' fromCamelCase')) {

  function fromCamelCase($input) {
    $pattern = '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!';
    preg_match_all($pattern, $input, $matches);
    $ret = $matches[0];
    foreach ($ret as &$match) {
      $match = $match == strtoupper($match) ?
        strtolower($match) :
        lcfirst($match);
    }
    return implode('_', $ret);
  }

}

function defineUserType($user_type)
{
   return ($user_type == 0) ? 'Customer Role' : 'Petrocard Role';
}

function replace(&$array, $replaces) {
    foreach ($array as $k => $v) {
        $new_k = replace_word($k, $replaces);
        if (is_array($v)) {
            replace($v, $replaces);
        }
        else {
            $v = replace_word($v, $replaces);
        }
        $array[$new_k] = $v;
        if ($new_k != $k) {
            unset($array[$k]);
        }
    }
}

function replace_word($word, $replaces) {
    if (array_key_exists($word, $replaces)) {
        $word = str_replace($word, $replaces[$word], $word);
    }
    return $word;
}

function encrypted_str($string)
{
  $encrypt_method = "AES-256-CBC";
    $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
    $secret_iv = '5fgf5HJ5g27'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);

    return $output;
}

function decrypted_str($string)
{
  $encrypt_method = "AES-256-CBC";
    $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
    $secret_iv = '5fgf5HJ5g27'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    
    return $output;
}
