<?php
$host = 'localhost';
$user = 'loic';
$passwd = 'loic';
$db = 'login-php';
  try {
    $bdd = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $passwd);
  } catch(Exception $error)  {
    die('Erreur'.$error->getMessage());
  }