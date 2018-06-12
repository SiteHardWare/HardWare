<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="Style/style.css" />
	<title>Hard...Where ? </title>
</head>
<body>
<!--<img src="Style/img/GIFhumour.gif" alt="img_Minitel" id="logo">-->
<?php include ('nav.php'); ?>	

<div class="conteneur">
<?php 
if(!empty($_SESSION['connection'])){
	$prenom = $_SESSION['prenom'];
	echo "<h2> Heureux de vous revoir $prenom</h2>";
}
else{
	echo "<h2> Bienvenue ... </h2>";
}
?>
L'informatique est d'une complexité infinie c'est ce qui en fait une chose passionnante <br/>
Ce site est une (modeste) aide aux esprit curieux en quéte d'information, de conseil ,matériel
Ou voulant monter eux même le PC 
	<hr>
	<img src="Style/img/intro.jpg" alt="pc">
<h2>Pourquoi vouloir monter son PC</h2>
	
		C'est vrai ca, pourquoi s'embeter à créer soit même son ordinateur alors que l'on peut en acheter deja tout fait ? <br>
		A cela je répondrais en plusieur points : 
		<p>
		1) <em>Le cout </em>: en effet acheter les composants séparement d'un ordinateur permet de faire une sacré économie, car le montage
		est réaliser soit même. De plus vous pourrez ainsi choisir vous mêmes votre systéme d'exploitation pourquoi pas
		 <!--<a href="https://fr.wikipedia.org/wiki/Open_source">open source </a> -->
		gratuit et qui ne collecte pas vos information personnelle, mais c'est un autre débat  </p>
		<p>
		2) <em>La personnalisation</em> : vous avez un usage de l'ordinateur limité ? Créer une une configuration légére. Ou inversement
		vous êtes un fan des dernier jeux avec des graphisme 4K et des simulation physique ultra-réaliste ? Prenez une puissante carte graphique .
		Une vrai liberté s'offre a vous, dans la limite du raisonnable (voir la page <a href="conseil.php">Conseil</a> pour plus de précision</p>
		<p>
		3) <em>L'apprentissage </em> : Si pour vous une bonne alimentation est le fait de manger de maniére saine et équilibrer. Ou que vous ignorer
		ce qu'est une carte mére, un processeur, ou le watercooling. Voilas une bonne occasion d'apprendre pleins de chose passionante </p>
		<p>
		4) <em>La fiérte </em> C'est tout de même satifaisant de réaliser les choses par soit-même non ? De pouvoir craner devant la machine a café
		en disant aux collégue : "C'est moi qui l'ai fait ". Voilas une bonne entrer en matiére pour le <a href="https://fr.wikipedia.org/wiki/Do_it_yourself"> DIY </a></p>

		<p> Convaincu ? Alors n'hésitait plus et foncer ! </p>
	
<h2>Dernier produit ajoute </h2>
<?php
	$connexion = mysqli_connect("localhost","root","","hardware");
		if(mysqli_connect_error()){
			printf("Echec de la connection : %s \n",mysqli_connect_error());
			exit(); 
		}

	$fichier = fopen('id.txt', 'r');
	fseek($fichier, 0);
	$id = fgets($fichier);
	fclose($fichier);
	
	$id = $id - 3;	
	$requete = "SELECT * FROM produit WHERE id > $id";
	$res = mysqli_query($connexion,$requete);
	while($produit = mysqli_fetch_array($res,MYSQLI_BOTH)){
		//echo"{$produit['id']} <br>";
		echo "<hr/>";
		//echo"{$produit['name']} <br>";
		if($_SESSION['connection'] == true) {
		?>
		<a href="annonce.php?id=<?php echo $produit['id']?> "><?php echo $produit['titre']?></a> 
		 
		<?php
		}
		
		else {
		echo "{$produit['titre']}";	
		}
		//echo"{$produit['description']} <br>";
		echo"{$produit['prix']}$ <br>";
	}
	//mysqli_close();
?>
<script type="text/javascript">
	if ( window.addEventListener ) {
var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
window.addEventListener("keydown", function(e){
kkeys.push( e.keyCode );
if ( kkeys.toString().indexOf( konami ) >= 0 ) {
//alert('it\'s a trap');
window.location = "./star_wars.html";
}
}, true);
}
</script>
</div>

<?php include('footer.html'); ?>

</body>
</html>