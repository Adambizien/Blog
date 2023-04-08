<?php
	session_start();//on ouvre une session pour récupérer les données qui sont stockés dedans ou pour en stocker d'autre.
	//connexion à la base de données.
	$bsd = mysqli_connect('localhost','bizieada','123456789','blogbd');
	echo mysqli_connect_error();
	//si id n'est pas 60  alors on retourne à la page d'accueil.
	if($_SESSION['id']!=60){
		header("location:page_daccueil.php");
		exit();
	}
	//on récupère les données du site et on regarde s'il y a des erreurs .
	if(!empty($_POST)){
		extract($_POST);
		$valid = true;
		if (isset($_POST['valider'])){
			$titre = mysqli_real_escape_string($bsd , $_POST['titre']);
			$text = mysqli_real_escape_string($bsd , $_POST['text']);
			$username = $_POST['username'];
			if(empty($_POST['choix'])){
				$valid = false;
				$er="cocher la catégorie de l'article!";
			}
			if(empty($titre)){
				$valid = false;
				$er="Donner un titre à votre article!";
			}
			if(empty($text)){
				$valid = false;
				$er="l'article est vide!";
			}
			if(empty($username)){
				$valid = false;
				$er="vous n'avez pas mis votre nom.";
			}
			//s'il n'y a pas d'erreur on insert l'article dans la base de données.
			if($valid){
				$id_cate = $_POST['choix'];
				$date_creation_article = date('Y-m-d');
				$req = "INSERT INTO article VALUES (NULL,'$titre','$text','$date_creation_article',$id_cate,'$username')";
				mysqli_query($bsd,$req);
				echo mysqli_error($bsd);
				mysqli_close($bsd);
				header("location:page_daccueil.php");
				exit();
			}
				
		}
	}     
?>
<!DOCTYPE html>
<html lang="fr">
<!-- entête de la page -->
	<head>
		<meta charset="utf-8"/>
		<!--Titre-->
		<title>Néon BLOG</title>
		
		<!--feuille de style-->
		<link rel="stylesheet" href="../CSS/style_ecriture.css" />
	</head>
	<!--envoyer les données en post-->
	<form  method="post">
	<body class="img" >
	<div class="page">
		<header >
			<!--Titre-->
			<h1>Néon BLOG</h1>
		</header>
		<div id="nav-container">
		<div class="bg"></div>
		<div class="button" tabindex="0">
			<!--les icones du menu déroulant-->
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</div>
		<div id="nav-content" >
		<!--dans menu déroulant-->
		<ul>
			<li><p>Bienvenu <?php echo $_SESSION['pseudo']; ?> </p></li>
			<li><a href="profil.php">Mon profil</a></li>
			<li><a href="page_daccueil.php">Page d'accueil</a></li>
		</ul>
		</div>
		</div>
		<main>
			<section>
				<!--L'interface pour écrire l'article-->
				<h2> Écrire un article:</h2>
				<div class="interface">
					<div class = "categorie">
						<p>
							Anime/Manga <input type="radio" name="choix" value =1>
							Jeux videos<input type="radio" name="choix" value =2 >
							Sports<input type="radio" name="choix" value =3>
							Science<input type="radio" name="choix" value =4>
						</p>
					</div>
					<label for="titre">Titre de l'article:</label>
					<input type="text" name="titre" required>
					<br>
					<label for="nom-prénon">nom et prénom/pseudo:</label>
					<input type="text" name="username" required>
					<br>
					<textarea name="text" required></textarea>
					<br>
					<button type="submit" name="valider" >valider </button>
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
		</main>
	</div>
	</body>   
	</form>
</html>


		
