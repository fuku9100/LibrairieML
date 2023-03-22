<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="classes.css">
    <title>LibrairieLM</title>
</head>
<body>
<?php if(isset($_POST['register'])) {
  $nom = $_POST['nom'];
  $email = $_POST['email'];
  $mot_de_passe = $_POST['mot_de_passe'];

  // Vérifier si l'utilisateur existe déjà dans la base de données
  $query = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);

  if($count == 0) {
    // Ajouter l'utilisateur à la base de données
    $query = "INSERT INTO users (nom, email, mot_de_passe) VALUES ('$nom', '$email', '$mot_de_passe')";
    mysqli_query($conn, $query);

    // Rediriger l'utilisateur vers la page de connexion
    header("Location: connection.php");
  } else {
    echo "L'utilisateur existe déjà.";
  }
} ?>
<h1>Formulaire d'inscription</h1>
<a href="accueil.php">Accueil</a>
    
<form action="connection.php?" method="post">
        <input type="text" name="nom" placeholder="Nom">
        <input type="text" name="email" placeholder="E-mail">
        <input type="password" name="mot_de_passe" placeholder="Mot de Passe">
        <button type="submit">S'inscrire</button>
    </form>

<?php
    $conn = new mysqli("localhost","root","","livre");
    // requete pour afficher tous les animaux
    $req = "SELECT * FROM users";
    $resultats = $conn->query($req);
?>
</body>
</html>