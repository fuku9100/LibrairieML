<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>LibrairieML</title>
   <?php include 'header.php';?>
</head>

<body>
    <h1>Veuillez vous connectez</h1>
    <input type="email" name="mdp" placeholder="Adresse E-mail"></li> 
    <br>
   <input type="password" name="mail" placeholder="Mot de Passe"></li>
    <br>
   <?php if(isset($_POST['users'])) {
  $email = $_POST['email'];
  $mot_de_passe = $_POST['mot_de_passe'];

  // Vérifier si l'utilisateur existe dans la base de données
  $query = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);

  if($count == 1) {
    $row = mysqli_fetch_assoc($result);
    if(password_verify($mot_de_passe, $row['mot_de_passe'])) {
      // Démarrer la session pour l'utilisateur connecté
      session_start();
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['nom'] = $row['nom'];
      header("Location: accueil.php");
    } else {
      echo "Le mot de passe est incorrect.";
    }
  } else {
    echo "L'utilisateur n'existe pas.";
  }
} ?>

    
</body>
</html>