<?php
$host = 'localhost';
$user = '';
$passwd = '';
$db = '';
  try {
    $bdd = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $passwd);
  } catch(Exception $error)  {
    die('Erreur'.$error->getMessage());
  }
