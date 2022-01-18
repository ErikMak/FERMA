<?php 
// CONFIG
require "Medoo.php";
use Medoo\Medoo;
$connection = new Medoo([
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'game',
    'username' => 'root',
    'password' => ''
]);



// PROTECTION SYSTEM
function decrypt($string, $key = "dfxg0068") {
    $result = '';
    $string = base64_decode($string);
    for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)-ord($keychar));
    $result.=$char;
    }
    return $result;
}

function encrypt($string, $key = "dfxg0068") {
    $result = '';
    for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)+ord($keychar));
    $result.=$char;
    }
    return base64_encode($result);
}
?>