<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="book.css">
    <title>LibrairieML</title>
</head>
<body>
    <h1>Veuillez vous connecter</h1>
    <form method="POST" action="accueil.php">
        <label for="email">eMail : </label>
        <input type="email" id="email" name="email">
        <br>
        <label for="mdp">Mot de passe : </label>
        <input type="password" id="mdp" name="mdp">
        <br />
        <input type="submit" name="login" value="Se connecter">
    </form>
<?php
try{
$conn = new PDO ('mysql:host=localhost;dbname=livres','root','');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->beginTransaction();
}catch(PDOException $e){
$conn->rollback();
echo "error : " . $e;
}

if(!empty($_POST['email']) && !empty($_POST['mdp'])){
  $email = $_POST['email'];
  $password = $_POST['mdp'];

  $req = $conn->prepare("SELECT mdp, email FROM membres WHERE email = :email");
  $req->bindParam(':email', $email);
  $req->execute();
  $resultat = $req->fetch(PDO::FETCH_ASSOC);
  var_dump($resultat);
// $resultat = $resultat[0];
 
    $isPasswordCorrect = password_verify($_POST['mdp'], $resultat['mdp']);
 
    if($isPasswordCorrect){
        session_start();
        echo 'Vous êtes connecté !';
        header('Location: accueil.php');

    }
 
    else {
        echo 'Mauvais identifiant ou mot de passe';

    }




}

 
    ?>
</body>
</html>