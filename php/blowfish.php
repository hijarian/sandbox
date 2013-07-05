<?php
$crypt_pass = makeHash('secret');

echo $crypt_pass."\n";

$valid = verifyHash('secret', $crypt_pass)."\n";

var_dump($valid);

function makeSalt() {
    static $seed = "./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $algo = '$2a';
    $strength = '$08';
    $salt = '$';
    for ($i = 0; $i < 22; $i++) {
        $salt .= substr($seed, mt_rand(0, 63), 1);
    }
    return $algo . $strength . $salt;
}

function makeHash($password) {
    return crypt($password, makeSalt());
}

function verifyHash($password, $hash) {
    return $hash == crypt($password, $hash);
}
