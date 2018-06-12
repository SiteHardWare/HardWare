<?php

include('nav.php');
	if($_SESSION['connection'] == false ) {
		header('Location:http://localhost/HardWare/acceuil.php');
	}
echo "<div class="."conteneur".">";
	var_dump($_SESSION['connection']);
	$connexion = mysqli_connect("localhost","root","","hardware");
	if(mysqli_connect_error() ) {
		printf("Echec de la connection : %s \n",mysqli_connect_error());
		exit(); 
	}
	$id = $_GET['id'];
	$requete = "SELECT * FROM produit WHERE id = '$id' ";
	$res = mysqli_query($connexion,$requete);
	while($produit = mysqli_fetch_array($res,MYSQLI_BOTH)){
		//echo"{$produit['id']} <br>";
		echo "<hr/>";
		echo"Vendeur : {$produit['name']} <br>";
		echo "{$produit['titre']} <br>";
		echo"<p>{$produit['description']} </p><br>";
		echo"<strong>{$produit['prix']}$ </strong><br>";
	}
?>