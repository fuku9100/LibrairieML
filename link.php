<?php
$host = "localhost"; // remplacer par le nom d'hôte de votre base de données
$user = "root"; // remplacer par le nom d'utilisateur de votre base de données
$password = ""; // remplacer par le mot de passe de votre base de données
$dbname = "users"; // remplacer par le nom de votre base de données

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
  die("Connexion échouée: " . mysqli_connect_error());
}