
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="Style/style.css" />
	<title>Connexion</title>
</head>
<body>
<?php include('nav.php') ?>
	<div class="conteneur">
		<div class="elementAligner">
			
				<form method="post" action="">
					<label>Pseudo : </label> <input type="text" name="pseudo"> <br/>
					<label>Mot de passe : </label> <input type="password" name="mdp"> <br/>
					<input type="submit" name="Connexion">
				</form>
			
		</div>
<?php
$connexion = mysqli_connect("localhost","root","","hardware");
	if(mysqli_connect_error() ) {
		printf("Echec de la connection : %s \n",mysqli_connect_error());
		exit(); 
	}
	else {
		if((!empty($_POST['pseudo'])) && (!empty($_POST['mdp']))) {
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$mdp = htmlspecialchars($_POST['mdp']);
			$res = "SELECT pseudo FROM user WHERE pseudo ='".$pseudo."' AND password ='".$mdp."' ";
			$result = mysqli_query($connexion,$res);
			//var_dump($result);
			if($result->num_rows == 1){
				$_SESSION['delete'] = false; 
				$_SESSION['connection'] = true;
				$_SESSION['prenom'] = $_POST['pseudo'];
	 			//$res = "SELECT mail FROM user WHERE pseudo ='".$pseudo."' AND password ='".$mdp."' ";	 			
	 			//$result = mysqli_query($connexion,$res);

				//$tab = mysqli_fetch_array($res);
				//var_dump($lol);
				//$mail = mysqli_fetch_row($result);
				//var_dump($mail);
				//$_SESSION['mail'] = $mail['mail'];
				//echo "$mail";
				header('Location:http://localhost/HardWare/acceuil.php');
			}		
			else {
				$_SESSION['connection'] = false;
		 		echo "<p class="."alert"."> Identifiant ou mot de passse incorrect !</p>";
			}
		}
	}

mysqli_close($connexion);
?>
</div>
</body>
</html>