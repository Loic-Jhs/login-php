<?php
session_start();

// On inclu la connexion à la bdd
require_once '../../config.php';

// Si les variables existent et qu'elles ne sont pas vides
if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_retype'])) {

  // Patch XSS
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $email = htmlspecialchars($_POST['email']);
  
  // On vérifie si l'utilisateur existe
  $check = $bdd->prepare('SELECT email,pseudo FROM utilisateur WHERE email= :email OR pseudo= :pseudo');
  $vars = [
    ':pseudo' => $pseudo,
    ':email' => $email,
  ];
  $check->execute($vars);
  $data = $check->fetch();
  $row = $check->rowCount();

  // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..
  $email = strtolower($email);

  // Si la requete renvoie un 0 alors l'utilisateur n'existe pas && le pseudo n'existe pas non plus
  if($row == 0) {

    // On verifie que la longueur du pseudo <= 100 && On verifie que la longueur du mail <= 100
    if(strlen($pseudo <= 100) && strlen($email <= 100) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
      // si les deux mdp saisis sont bon
      if($_POST['password'] == $_POST['password_retype']) {
        // On hash le mot de passe
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // On stock l'adresse IP
        $ip = $_SERVER['REMOTE_ADDR'];

        // On insère dans la base de données
        $insert = $bdd->prepare("INSERT INTO utilisateur (pseudo, email, password, ip, date_inscription) VALUES (:pseudo, :email, :password, :ip, :date_inscription)");

        $vars = [
          ':pseudo' => $pseudo,
          ':email' => $email,
          ':password' => $password,
          ':ip' => $ip,
          ':date_inscription' => date('Y-m-d')
        ];

        $insert->execute($vars);
        
        // On redirige avec le message de succès
        $_SESSION['success'] = "Inscription réussi";
        header('Location: ../../index.php');
      } else { // Ou on reste sur l'inscription avec le message d'erreur
        $_SESSION['error'] = "Les deux mots de passe ne correspondent pas";
        header('Location: ../inscription.php');
      }

    } else {
      if(strlen($pseudo > 100)) {
        $_SESSION['error'] = "Pseudo trop long";
      } else {
        $_SESSION['error'] = "Mauvais format d'email";
      }
        header('Location: ../inscription.php');
    }
  } else {
    $_SESSION['error'] = "Adresse email déjà utilisée";
    header('Location: ../inscription.php');
  }
}