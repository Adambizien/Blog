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
		//on récupère les données du site et on regarde s'il y a des erreurs .
	$id = $_SESSION['id'];
	$res = mysqli_query($bsd,"SELECT * FROM personnes WHERE id = '$id'");
	$login_view = mysqli_fetch_array($res);
	if(!empty($_POST)){
		extract($_POST);
		$valid = true;
		if (isset($_POST['modification'])){
			$nom = trim($nom);
			$prénom = trim($prénom);
			if (empty($nom)) {
				$valid = false;
				$er = ("Le nom d'utilisateur ne peut pas être vide");
			}
			if(empty($prénom)){
				$valid = false;
				$er = ("Le prenom d'utlisateur ne peut pas être vide");
			}
			//s'il n'y a pas d'erreur on modifie la base de données.
			if ($valid){
				$requete="UPDATE personnes SET nom ='$nom' , prenom ='$prénom' WHERE id ='$id'";
				mysqli_query($bsd,$requete);
				echo mysqli_error($bsd);
				$_SESSION['nom'] = $login['nom'];
				$_SESSION['prénom'] = $login['prenom'];
				mysqli_close($bsd);
				header("location:profil.php");
				exit();
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="fr">
<!-- entête de la page -->
	<head>
		<!--Pour mettre dans le code des caractères spéciaux-->
		<meta charset="utf-8"/>
  
		<!--Pour que ça fonctionne bien sur internet explorer-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  
		<!--Pour avoir le bon niveau de zoom dans le mobile -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  
		<!--Le nom de la page-->
		<title>Néon BLOG</title>
  
		<!--feuille de style-->
		<link rel="stylesheet" href="../CSS/style_modif-nom.css" />
	</head>
	<div class="fondfloue">
	<body class="fond">
	<form  method="post">
		<header>
			<!--Titre-->
			<h1>Néon BLOG</h1>
		</header>
		<nav>
			<!--les liens vers les autres page-->
			<pre>  <a href="page_daccueil.php">Page d'accueil</a>            <a href="profil.php">Profil</a>  </pre>
		</nav>
		
		<section>
			<div class="interface">
				<!--Formulaire de modification nom/prénom-->
				<h2>Formulaire de modification profil:</h2>
				<label for="nom">Nom:</label>
				<input type="text"  name="nom" placeholder="Votre nom" value="<?php if(isset($nom)){ echo $nom; }else{ echo $login_view['nom'];}?>">
				<br>
				<label for="prénom">Prénom:</label>
				<input type="text" name="prénom"  placeholder="Votre prénom" value="<?php if(isset($prénom)){ echo $prénom; }else{ echo $login_view['prenom'];}?>"  ><br>
				 
				<button type="submit" name="modification">modification</button>
		        <br>
			    <br>
			     <!--affichage des erreurs -->
			    <?php
			    if(isset($er)){
					echo "<div class='er'><img src='../images/erreur.png' alt='erreur!'whidth='50' height='32'/>".$er."</div>";
					mysqli_close($bsd);
			    }
			    ?>
			</div>
		</section>
	</form>
	</body>
	</div>
</html>
