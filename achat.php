<?php include('nav.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Achat</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="Style/style.css" />
</head>
<body>
	<?php if($_SESSION['connection'] == false ) {
		header('Location:http://localhost/HardWare/acceuil.php');
	}
	var_dump($_SESSION['connection']);
	?>
	<div class="conteneur">
		<form method="POST" action="">	
		<h3> Paramétre de recherche </h3>	
		<label>Prix max : </label> <input type="number" name="prix">
		<label>Catégorie : </label>
		<SELECT name="categorie" >
					<option value="hdd">Disque Dur</option>
					<option value="carte_grpahique">Carte graphique</option>
					<option value="hdd">SSD</option>
					<option value="processeur">Processeur</option>
					<option value="ram">Barrette de RAM</option>
					<option value="alimentation">Alimentation</option>
					<option value="carte_mere">Carte mére</option>
					<option value="tour">tour</option>
					<option value="refroidissement">refroidissement</option>
					<option value="autre">Autre</option>
				</SELECT> <br>
			<input type="submit" name="recherche">	
		</form>
	</div>
	<div class="conteneur">
	<?php
	/*Verification de la connexion*/
	$connexion = mysqli_connect("localhost","root","","hardware");

	if(mysqli_connect_error()){
	printf("Echec de la connection : %s \n",mysqli_connect_error());
		exit(); 
	}
	if(!empty($_POST['prix'])){
		$prix = $_POST['prix'];
		$requete = "SELECT * FROM produit WHERE prix <= $prix AND existe = 0";
		if(!empty($_POST['categorie'])){
		$categorie = $_POST['categorie'];	
		$requete = "SELECT * FROM produit WHERE prix <= $prix AND categorie = '$categorie' AND existe = 0";	
		}
		echo "$requete";	
	}
	else {
	$requete = "SELECT * FROM produit WHERE existe = 0";	
	}
	
	$res = mysqli_query($connexion,$requete);
	//var_dump($res);
	while($produit = mysqli_fetch_array($res,MYSQLI_BOTH)){
		//echo"{$produit['id']} <br>";
		echo "<hr/>";
		//echo"{$produit['name']} <br>";
		?>
		<a href="annonce.php?id=<?php echo $produit['id'] ?>"><?php echo $produit['titre'] ?> </a> 
		<?php
		//echo"{$produit['description']} <br>";
		echo"{$produit['prix']}$ <br>";

	}
	mysqli_close($connexion);
	?>
	</div>
<?php include('footer.html'); ?>
</body>
</html>