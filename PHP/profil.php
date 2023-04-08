<?php
	session_start();//on ouvre une session pour récupérer les données qui sont stockés dedans ou pour en stocker d'autre.
	//connexion à la base de données.
	$bsd = mysqli_connect('localhost','bizieada','123456789','blogbd');
	echo mysqli_connect_error();
	//si id est vide donc on retourne à la page d'accueil.
	if(!isset($_SESSION['id'])){
		header("location:page_daccueil.php");
		exit();
	}
	//on récupère les données de la personne .
	$id = $_SESSION['id'];
	$res = mysqli_query($bsd,"SELECT * FROM personnes WHERE id = '$id'");
	$login_view = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="fr">
<!-- entête de la page -->
	<head>
		<meta charset="utf-8"/>
		<!--Titre-->
		<title>Néon BLOG</title>
		
		<!--feuille de style-->
		<link rel="stylesheet" href="../CSS/style_profil.css" />
	</head>
    <div class="fondfloue">
    <body class="fond">
	  	<header>
		  <!--Titre-->
		  <h1>Néon BLOG</h1>
	  	</header>
	  	<nav>
			<!--les liens vers les autres page-->
			<pre>  <a href="page_daccueil.php">Page d'accueil</a>    </pre>
		</nav>
		<section>
			<div class="interface">
				<!--l'affichage de tout les données de la personne-->
				<h2>Mon profil:</h2>
				<p>Quelques informations sur vous:</p>
				<ul>
					<li>Votre nom est: <?php echo $login_view['nom']; ?> </li>
					<li>Votre prénom est:  <?php echo $login_view['prenom']; ?> </li>
					<small>Vous voulez changer de nom ou de prénom? <a href="modifier-profil-nom.php" class='color'>Modifier</a></small>
					<li>Votre pseudo est: <?php echo $login_view['pseudo']; ?> </li>
					<small>Vous voulez changer de pseudo? <a href="modifier-profil-pseudo.php" class='color'>Modifier le pseudo</a></small>
					<li>Votre date de naissance est:  <?php echo $login_view['naissance']; ?></li>
					<li>Votre email est:  <?php echo $login_view['email']; ?></li>
					<small>Vous voulez changer de email? <a href="modifier-profil-email.php" class='color'>Modifier l'email</a></small>
					<li>Votre id est:  <?php echo $login_view['id']; ?></li>
					<li>Votre compte a été crée le:  <?php echo $login_view['datedein']; ?></li>
				</ul>
			</div>
	    </section>
    </body>
    </div>
</html>
