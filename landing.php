<?php
  // Une fois connecté nous trouvons sur cette page
  require_once 'config.php';
  session_start();
  if(!isset($_SESSION['user'])) {
    header('Location: index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <title>Bonjour !</title>
</head>
<body>
  <h1>Bonjour <?php echo $_SESSION['user']['pseudo']; ?></h1>

  <a href="utilisateur/deconnexion.php" class="btn btn-danger btn-lg"> Déconnexion</a>
</body>
</html>