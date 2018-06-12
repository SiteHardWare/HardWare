<?php

include('nav.php');
echo "<div class="."conteneur".">";
	$connexion = mysqli_connect("localhost","root","","hardware");
	if(mysqli_connect_error() ) {
		printf("Echec de la connection : %s \n",mysqli_connect_error());
		exit(); 
	}
	$id = $_GET['id'];
	$requete = "UPDATE produit SET existe= 1 WHERE id = '$id'";
	$res = mysqli_query($connexion,$requete);
	if($res){
	$_SESSION['delete'] = true;	
	header('Location:http://localhost/HardWare/mes_annonce.php');
}
	

	
	//while($produit = mysqli_fetch_array($res,MYSQLI_BOTH)){
		//echo"{$produit['id']} <br>";
		//echo "<hr/>";
		//echo"Vendeur : {$produit['name']} <br>";
		//echo "{$produit['titre']} <br>";
		//echo"{$produit['description']} <br>";
		//echo"{$produit['prix']}$ <br>";
	//}
?>