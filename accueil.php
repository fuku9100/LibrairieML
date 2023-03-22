<!DOCTYPE html>
<html>
<head>
	<title>Catalogue de Livres</title>
	<link rel="stylesheet" type="text/css" href="book.css">
    <script src="java.js" defer></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
   
</head>
<body>
<?php 

// index.php file
include 'header.php';?>
  
    <img class="logo" src="Librairie ML.png" alt="">
	<br>
    <input type="text" placeholder="Rechercher" class="search">
    <button class="submit" type="submit">OK</button>
    <div class="books"></div>

</body>
</html>