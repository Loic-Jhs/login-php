<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset-"UTF-8">
    <meta name="viewport" content="width device-width, initial-scale-1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <title>Connexion</title>
  </head>

  <body>
  <div class="login-form">
    <?php
    session_start();
    //var_dump($_SESSION);
      if(isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger">
            <span style="font-weight:bold"><?= htmlspecialchars($_SESSION['error']); ?></span>
        </div> <?php
        unset($_SESSION['error']);
      }
      
      if(isset($_SESSION['success'])) { ?>
        <div class="alert alert-success">
            <span style="font-weight:bold"><?= htmlspecialchars($_SESSION['success']); ?></span>
        </div> <?php
        unset($_SESSION['success']);
      }
    ?>
    <form action="traitement/connexion_traitement.php" method="post">
      <h2 class="text-center">Connexion</h2>

      <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
      </div>

      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Connexion</button>
      </div>
    </form>

    <p class="text center"><a href="inscription.php">Pas encore de compte ? Créez en un</a></p>
  </div>
</html>