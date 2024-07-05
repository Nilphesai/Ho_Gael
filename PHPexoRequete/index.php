<?php

$password = "monMotdePasse1234";
$password2 = "monMotdePasse1234";

$md5 =hash('md5', $password);
$md5_2 =hash('md5', $password2);
//echo $md5."<br>";
//echo $md5_2."<br>";

$sha256 = hash('sha256', $password);
$sha256_2 = hash('sha256', $password);
//echo $sha256."<br>";
//echo $sha256_2."<br>";

//hachage fort
$hash = password_hash($password, PASSWORD_DEFAULT);
$hash2 = password_hash($password2, PASSWORD_DEFAULT);
//echo $hash."<br>";
//echo $hash2."<br>";

$saisie = "monMotdePasse1234";

$check = password_verify($saisie, $hash);
$user = "Michael";
if (password_verify($saisie, $hash)){
    echo "Les mots de passe correspendent !";
    $_SESSION["user"] = $user;
    echo $user."est connecté !";
} else{
    echo "Les mots de passe sont différents !";
}