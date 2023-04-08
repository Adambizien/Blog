<?php
	session_start();//on ouvre une session pour récupérer les données qui sont stockés dedans ou pour en stocker d'autre.
	//connexion à la base de données.
	$bsd = mysqli_connect('localhost','bizieada','123456789','blogbd');
	echo mysqli_connect_error();
	//on récupère les données du site avec get et on regarde s'il y a des erreurs .
	$id_ar =(int)trim($_GET['id_ar']);
	if(empty($id_ar)){
		header("location:page_daccueil.php");
		exit();
	}
	//on récupère les données de l'article .
	$req =mysqli_query($bsd,"SELECT *FROM article WHERE id = '$id_ar'");
	$article = mysqli_fetch_array($req);
?>

<!DOCTYPE html>
<html lang="fr">
<!-- entête de la page -->
<head>
	<meta charset="utf-8"/>
	<!--Titre lien-->
	<title>Néon BLOG</title>
    <!--feuille de style-->
	<link rel="stylesheet" href='../CSS/style_aff_article.css'/>
</head>
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
					<?php if(!isset($_SESSION['id'])){ ?>
					<li><a href="connexion.php">Connexion</a></li>
					<li><a href="inscription.php">Inscription</a></li>
					<li><a href="page_daccueil.php">Page d'accueil</a></li>
					<?php }else{ ?>
					<li><p>Bienvenu <?php echo $_SESSION['pseudo']; ?> </p></li>
					<li><a href="profil.php">Mon profil</a></li>
					<li><a href="deconnexion.php">Déconnexion</a></li>
					<li><a href="page_daccueil.php">Page d'accueil</a></li>
					<?php if($_SESSION['id']==60){?>
						<li><a href="page_decriture.php">Écrire un article</a></li>
						<?php 
						}  
					}
					?>  
				</ul>
			</div>
		</div>
		<main>
			<!--affichage des article -->
			<?php
				if($article['id_categorie'] ==1){
					echo"<h2 id='categorie'>Anime/Manga:</h2>";
				}elseif($article['id_categorie'] ==2){
					echo"<h2 id='categorie'>Jeux videos:</h2>";
				}elseif($article['id_categorie'] ==3){
					echo"<h2 id='categorie'>Sports:</h2>";
				}elseif($article['id_categorie'] ==4){
					echo"<h2 id='categorie'>Science:</h2>";
				}
				echo "<h3 class='titre_article'=>".$article['titre']."</h3>";
				echo "<p class='text'>".$article['text']."</p><br>";
				echo"<p class='date'>fait par ".$article['username']. " le " .$article['date']."</p>";
			?>
			<!--Formulaire du commentaire-->
			<?php 
				if(!isset($_SESSION['id'])){
					if(!empty($_POST)){
						extract($_POST);
						$valid = true;
						if (isset($_POST['commentaire'])){
							$name = trim($_POST['nom']);
							$text = mysqli_real_escape_string($bsd , $_POST['text']);
							if(isset($text)){
								if(empty($name)){
									$valid = false;
									$er="Le prenom d'utlisateur ne peut pas être vide";
								}
							}
								if ($valid){
									$date_com = date('Y-m-d H:i:s');
									$req_com =$requete="INSERT INTO commentaire VALUES (NULL,'$id_ar','$text','$date_com','$name')";
									mysqli_query($bsd,$requete);
									echo mysqli_error($bsd);
									mysqli_close($bsd);
									header("location:affichage_article.php");
									exit();
								}
						}
					} 
				}else{
					if(!empty($_POST)){
						extract($_POST);
						$valid = true;
						if (isset($_POST['commentaire'])){
							$text = mysqli_real_escape_string($bsd , $_POST['text']);
							if ($valid){
								$name = $_SESSION['pseudo'];
								$date_com = date('Y-m-d H:i:s');
								$req_com =$requete="INSERT INTO commentaire VALUES (NULL,'$id_ar','$text','$date_com','$name')";
								mysqli_query($bsd,$requete);
								echo mysqli_error($bsd);
								mysqli_close($bsd);
								header("location:affichage_article.php");
								exit();
							}
						}
					}
				} 
			?>
				<div class='com'>
					<?php
						$bsd = mysqli_connect('localhost','bizieada','123456789','blogbd');
						echo mysqli_connect_error(); 
						if(!isset($_SESSION['id'])){ 
					?>
					<label for="nom">Nom/Prénons ou pseudo:</label>
					<input type="text" name="nom" required><br>    
					<?php } ?>
					<label for="commentaire">Commentaire:</label>
					<textarea name="text" rows='5' cols="104" ></textarea><br>
					<button type="submit" name="commentaire" >valider</button>
					<!--affichage des commentaire -->
					<?php
						$req_aff_com =mysqli_query($bsd,"SELECT *FROM commentaire WHERE id_ar = '$id_ar'");
						if($req_aff_com){
							while($com = mysqli_fetch_array($req_aff_com)){
								echo"<br><br><br>";
								echo "<small>fait par ".$com['name']. " le " .$com['date']."</small>";
								echo "<p id='text'>".$com['text']."</p>";
								if(isset($_SESSION['id'])){
									if($_SESSION['id']==60){
										if (isset($_POST['supprimer'])){
											$id = $com['id'];
											$req_sup_com =mysqli_query($bsd,"DELETE FROM commentaire WHERE id = '$id'");	
										} 
										echo "<button type='submit' name='supprimer'> X </button>";
									}
								}
									
							}
						}
						if(isset($er)){
							echo "<div class='er'><img src='../images/erreur.png' alt='erreur!'whidth='50' height='32'/>".$er."</div>";
							mysqli_close($bsd);
						}
					?>   
				</div>
		</main>
		
	</div>
	</body>
</form>
</html>



            	



