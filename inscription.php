<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="test.css">
  <title>Document</title>
</head>
<body>
  
</body>
</html>

<?php
include 'header.php';
$BDD = array();
$BDD['host'] = "localhost";
$BDD['user'] = "root";
$BDD['pass'] = "";
$BDD['db'] = "livres";
$mysqli = mysqli_connect($BDD['host'], $BDD['user'], $BDD['pass'], $BDD['db']);
if(!$mysqli) {
    echo "Connexion non établie.";
    exit;
}


// index.php file


$AfficherFormulaire=1;
//traitement du formulaire:
if(isset($_POST['pseudo'],$_POST['email'],$_POST['mdp'])){
    if(empty($_POST['pseudo'])){
        echo "Le champ Pseudo est vide.";
    } elseif(!preg_match("#^[a-z0-9]+$#",$_POST['pseudo'])){
        echo "Le Pseudo doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
    } elseif(strlen($_POST['pseudo'])>25){
        echo "Le pseudo est trop long, il dépasse 25 caractères.";
    } elseif(empty($_POST['mdp'])){
        echo "Le champ Mot de passe est vide.";
    } elseif(empty($_POST['email'])){
        echo "Le champ e-mail est vide.";
    } elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo='".$_POST['pseudo']."'"))==1){//on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
        echo "Ce pseudo est déjà utilisé.";
    } else {
       
        if(!mysqli_query($mysqli,"INSERT INTO membres SET pseudo='".$_POST['pseudo']."',email='".$_POST['email']."', mdp='".md5($_POST['mdp'])."'")){
            echo "Une erreur s'est produite: ".mysqli_error($mysqli);
        } else {
            echo "Vous êtes inscrit avec succès!";
            //on affiche plus le formulaire
            $AfficherFormulaire=0;
            header("Location: accueil.php");
        }
    }
}
if($AfficherFormulaire==1){
    ?>
  
   <br />
    <form method="post" action="inscription.php">
        pseudo : <input type="text" name="pseudo">
        <br />
        e-mail : <input type="email" name="email">
        <br>
        Mot de passe : <input type="password" name="mdp">
        <br />
        <input type="submit" value="S'inscrire">
    </form>
  
    <?php
}
?>
