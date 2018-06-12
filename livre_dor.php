<!DOCTYPE html>
<html>
<head>	
<meta charset="utf-8" />
	<link rel="stylesheet" href="Style/style.css" />
	<title>Livre d'or</title>
</head>
<body>
<?php include ('nav.php'); ?>		
<div class="conteneur">	
	<form method="post" action ="">
		<fieldset>
			<legend><h2>Message </h2></legend>
		<?php 
		if(empty($_SESSION['connection'])) {
			echo "<label for="."pseudo".">Votre pseudo</label> : <input type="."text"." name="."pseudo"." placeholder="."Ex : gnou22".  "maxlength="."30".">";
			echo "<label for="."pseudo".">Adresse mail</label> : <input type="."mail"." name="."mail"." maxlength="."30".">";
			
		}
		?>
		<label for="message"></label><br />
	    <textarea name="message" id="message" rows="10" cols="50">
	    </textarea> <br>
		
		
		
	
		<input type="submit" name="Envoyer">
		
		</fieldset>
	</form>

<?php
// traitement du message et affichage du livre d'or

// Si le type est deconnecter
if(empty($_SESSION['connection'])){
	if(empty($_POST['message']) && empty($_POST['pseudo'])) {  
		$pseudo = htmlspecialchars($_POST['pseudo'],ENT_IGNORE); // HtmlSpecialchar
		$mail = htmlspecialchars($_POST['mail'],ENT_IGNORE); // HtmlSpecialchar
		$message = htmlspecialchars($_POST['message'],ENT_IGNORE) ;
		$date = date('l jS \of F Y h:i:s A'); // Date du message
		$fichier = fopen('livre_dor.text','a');
		// test d'ouverture du fichier
		if($fichier == false) {
			echo 'Erreur de traitement ';
			fclose($fichier);
		}
		$res = fwrite($fichier,"$pseudo ; $message ; $mail ; $date \n") ;
		if($res != true) {
			echo 'Erreur de traitement <br>';
			fclose($fichier);
		}
	}
}
// Si l'utilisateur est connecter
else if ($_SESSION['connection'] == true){
	$pseudo = $_SESSION['prenom'];
	// traitement du message
	if(!empty($_POST['message'])){
		$message = htmlspecialchars($_POST['message'],ENT_IGNORE) ;
		$date = date('l jS \of F Y h:i:s A'); // Date du message
		$fichier = fopen('livre_dor.text','a');
		// test d'ouverture du fichier
		if($fichier == false) {
			echo 'Erreur de traitement ';
			fclose($fichier);
		}
		else {
			$res = fwrite($fichier,"$pseudo ; $message;  ; $date \n") ;
			if($res != true) {
				echo 'Erreur de traitement <br>';
				fclose($fichier);
			}
		}
	}

}		 		
echo "</div>";
?>

<div class="conteneur">
<h1> Livre d'or</h1>
	<div id="livre_dor"> 
<?php
	$fichier = fopen("livre_dor.text","r");
	while($ligne = fgets($fichier)) {
		$ligne = rtrim($ligne); // suppresion du char de fin de ligne
		$info = explode(";",$ligne); // On separe les données
		echo "<hr>";
		foreach($info as $data) {
				echo "<p> $data</p>";
		}		
	}
	fclose($fichier);
?>
	</div>
</div>
<?php include('footer.html'); ?>
</body>
</html>