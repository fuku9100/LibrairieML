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
    if(empty($_POST['pseudo'])){//le champ pseudo est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "Le champ Pseudo est vide.";
    } elseif(!preg_match("#^[a-z0-9]+$#",$_POST['pseudo'])){//le champ pseudo est renseigné mais ne convient pas au format qu'on souhaite qu'il soit, soit: que des lettres minuscule + des chiffres (je préfère personnellement enregistrer le pseudo de mes membres en minuscule afin de ne pas avoir deux pseudo identique mais différents comme par exemple: Admin et admin)
        echo "Le Pseudo doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
    } elseif(strlen($_POST['pseudo'])>25){//le pseudo est trop long, il dépasse 25 caractères
        echo "Le pseudo est trop long, il dépasse 25 caractères.";
    } elseif(empty($_POST['mdp'])){//le champ mot de passe est vide
        echo "Le champ Mot de passe est vide.";
    } elseif(empty($_POST['email'])){
        echo "Le champ e-mail est vide.";
    } elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo='".$_POST['pseudo']."'"))==1){//on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
        echo "Ce pseudo est déjà utilisé.";
    } else {
        //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
        //Bien évidement il s'agit là d'un script simplifié au maximum, libre à vous de rajouter des conditions avant l'enregistrement comme la longueur minimum du mot de passe par exemple
        if(!mysqli_query($mysqli,"INSERT INTO membres SET pseudo='".$_POST['pseudo']."',email='".$_POST['email']."', mdp='".md5($_POST['mdp'])."'")){//on crypte le mot de passe avec la fonction propre à PHP: md5()
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
