<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="Style/style.css" />
	<title>Vente</title>
</head>
<body>
<?php
include('nav.php');	
?>
<div class="conteneur">
<?php if(!isset($_GET['id'])){ ?>
	<h1>Vendre</h1>
		<p> Vous avez acheter un nouveau pc et votre ancienne config ne vous est plus utile ? <br>
		vendez votre matériel composant ou setup complet ! </p>
		<p> Pour vendre sur notre site, il vous faut completer ce formulaire, merci d'y être le plus précis possible </p>
<?php 
}
else { ?>
	<h1>Modifier</h1>
	<?php 
	$connexion = mysqli_connect("localhost","root","","hardware");
	if(mysqli_connect_error() ) {
		printf("Echec de la connection : %s \n",mysqli_connect_error());
		exit(); 
	}
	$id = $_GET['id'];
	$requete = "SELECT * FROM produit WHERE id = '$id' ";
	$res = mysqli_query($connexion,$requete);
	$produit = mysqli_fetch_array($res,MYSQLI_BOTH); 
	$categorie =  $produit['categorie'];
?><?php }
?>
	<form method="post" action="">
		<fieldset>
				<legend> <h2>Poster une annonce </h2></legend>
					<div class="formulaire">							
						<label> Titre de votre annonce :</label> <input type="text" name="titreAnnonce" value="<?php echo isset($_GET['id']) ? $produit['titre'] : '' ?>"> <br>
				<label>Catégorie</label>
				<SELECT name="categorie" <?php echo isset($_GET['id']) ? $produit['categorie'] : '' ?> >
					<option value = "<?php echo isset($_GET['id']) ? $produit['categorie'] : '' ?>" selected > <?php  if(isset($_GET['id'])) {echo "$categorie";} else {echo "";} ?>		</option>
					<option>Disque Dur</option>
					<option>Carte graphique</option>					
					<option>SSD</option>
					<option>Processeur</option>
					<option>Barrette de RAM</option>
					<option>Alimentation</option>
					<option>Carte mére</option>
					<option>tour</option>
					<option>refroidissement</option>
					<option>Autre</option>
				</SELECT> <br>
					<label> Prix (euros) : </label> <input type="number" name="prix"
					value="<?php echo isset($_GET['id']) ? $produit['prix'] : '' ?>" > <br>
					<label>Description </label> <br>
					<textarea name="Description" id="description" rows="13"
					 autocomplete ="on"><?php echo isset($_GET['id']) ? $produit['description'] : '' ?> </textarea> <br>
						<!--<label for="profile_pic">Image</label>
    					<input type="file" id="profile_pic" name="profile_pic"
      					    accept=".jpg, .jpeg, .png"> <br>-->
						<input type="submit" Value="<?php echo isset($_GET['id']) ? 'modifier' : 'envoyer' ?>">
						<input type="reset" Value="Annuler">
			
		</fieldset>
	</form>
	<?php
if (empty($_SESSION['connection'])){
	echo "Vous devez être connecter pour pouvoir vous inscrire <a href="."http://localhost/HardWare/connexion.php"."> se connecter </a>";
}
else {
	if(!empty($_POST['titreAnnonce'])) {
		$connexion = mysqli_connect("localhost","root","","hardware");
		if(mysqli_connect_error()){
			printf("Echec de la connection : %s \n",mysqli_connect_error());
			exit(); 
		}
		//var_dump($_SESSION['connection']);
		//var_dump($connexion);
		$prenom = $_SESSION['prenom'];
		$titre = $_POST['titreAnnonce'];
		$prix = $_POST['prix'];
		$categorie = $_POST['categorie'];
		$description = $_POST['Description'];
		$date = date('Y-m-d');
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$requete = "UPDATE produit
			SET titre = '$titre',categorie = '$categorie',prix = '$prix',description = '$description'
			WHERE id = $id";
		}
		else {
		$requete ="INSERT INTO produit (name,titre,categorie,description,image,prix,lalala,existe) VALUES ('$prenom','$titre','$categorie','$description','','$prix','$date','0')";
			}
		var_dump($requete);
		$res = mysqli_query($connexion,$requete);
		var_dump($res);
		if($res){
			$fichier = fopen('id.txt','r+');
			$id = fgets($fichier);
			$id++;
			fseek($fichier, 0);
			fputs($fichier,$id);
			fclose($fichier);
				$message="Votre annonce à bien été enregistrer";
				echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
			
		}
	}
}
?>
</div>
<?php include('footer.html'); ?>

</body>
</html>