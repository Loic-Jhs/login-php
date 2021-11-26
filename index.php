<?php
// Si je n'ai pas de session je redirige vers le form de connexion
if(!isset($_SESSION['user'])) {
  header('Location: utilisateur/connexion.php');
} 
// Sinon je redirige sur le page de l'utilisateur connecté
else {
  header('Location: landing.php');
}