<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="Style/style.css" />
	<title>Mes annonces</title>
</head>
<body>
<?php include('nav.php'); 
if($_SESSION['connection'] == false ) {
		header('Location:http://localhost/HardWare/acceuil.php');
	}
?>
<div class="conteneur">
	<h2 align="center">Mes Annonces </h2>
	<?php
$connexion = mysqli_connect("localhost","root","","hardware");
if(!$connexion){
	echo "erreur de connexion";
}
else {
	
	if($_SESSION['delete'] == true){
		$message="Votre annonce a bien été supprimée";
		echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		$_SESSION['delete'] = false;
 	}
	//var_dump($_SESSION['prenom']);
	$pseudo = $_SESSION['prenom'];
	$requete = "SELECT * FROM produit WHERE name ='$pseudo' AND existe=0";
	//echo $requete;
	$res = mysqli_query($connexion,$requete);
	//var_dump($res);
	if($res->num_rows == 0){
		echo "<p class="."alert".">Vous n'avez poster aucune annonces </p>";
		echo "<a href=Vente.php> poster une annonce </a>";
	}
	else{
		while($produit = mysqli_fetch_array($res)) {
		//echo"{$produit['id']} <br>";
			echo "<hr/>";
			 
		//echo"{$produit['name']} <br>";
			echo"{$produit['titre']} ";
		//echo"{$produit['description']} <br>";
			echo"{$produit['prix']}$ ";
			?>
		<a href="delete.php?id=<?php echo $produit['id'] ?>">Supprimer</a> 
		&nbsp;
		<a href="Vente.php?id=<?php echo $produit['id'] ?>">Modifier</a>
		<?php
		}
	}	
}	
?>
</div>
<?php include('footer.html');?>	
</body>
</html>