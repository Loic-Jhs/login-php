<?php

// Démarrage de la session
session_start();

// On inclut la connexion à la base de données
require_once '../../config.php';

// Si il existe les champs email, password et qu'ils sont pas vide
if(isset($_POST['email']) && isset($_POST['password'])) {

  // Patch XSS
  $email = htmlspecialchars($_POST['email']);
  $password = $_POST['password'];

  // email transformé en minuscule
  $email = strtolower($email);

  // On regarde si l'utilisateur est inscrit dans la table utilisateur
  $check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateur WHERE email = :email');
  $vars = [':email' => $email];
  $check->execute($vars);
  //PDO::FETCH_OBJ permet de récupéré les valeures de la bdd sous forme d'objet
  $data = $check->fetch(PDO::FETCH_OBJ);
  $row = $check->rowCount();
  // Si la requete renvoie un 1 alors l'utilisateur existe
  if($row > 0) {

    // Si le mail est bon niveau format
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
      // Si le mot de passe est le bon
      if(password_verify($password,$data->password)) {

        // On créer la session et on redirige sur landing.php
        $_SESSION['user']['pseudo'] = $data->pseudo;
        $_SESSION['user']['email'] = $data->email;
        header('Location: ../../landing.php');

      } else header('Location: ../../index.php?login_err=password');

    } else header('Location: ../../index.php?login_err=email');

  } else header('Location: ../../index.php?login_err=already');
 
} else header('Location: ../../index.php');