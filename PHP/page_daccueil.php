<?php
	session_start();//on ouvre une session pour récupérer les données qui sont stockés dedans ou pour en stocker d'autre.
	//connexion à la base de données.
	$bsd = mysqli_connect('localhost','bizieada','123456789','blogbd');
	echo mysqli_connect_error();
?>

<!DOCTYPE html>
<html lang="fr">
<!-- entête de la page -->
<head>
	<meta charset="utf-8"/>
	
	<!--Titre-->
	<title>Néon BLOG</title>
	
	<!--feuille de style-->
	<link rel="stylesheet" href="../CSS/style_accueil.css"/>
</head>
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
				<?php }else{ ?>
				<li><p>Bienvenu <?php echo $_SESSION['pseudo']; ?> </p></li>
				<li><a href="profil.php">Mon profil</a></li>
				<li><a href="deconnexion.php">Déconnexion</a></li>
				<?php
				if($_SESSION['id']==60){ ?>
				<li><a href="page_decriture.php">Écrire un article</a></li>
				<?php }  
				}?>  
			</ul>
		</div>
	</div>
  	<main>
    	<div class="content">
	  	<!--L'interface des articles-->
	  	<section>
			<article>
				<?php
					$id = 1; 
					$req =mysqli_query($bsd,"SELECT *FROM article WHERE 	id_categorie = '$id'");
					if($req){
						echo "<div id='div_tout'>";
						echo"<h2 id='titre_cate'>Anime/Manga:</h2>";
						while($article = mysqli_fetch_array($req)){
							$id_ar=$article['id'];
							echo "<div id='div_cont'>";
							//on envoie l'id de l'article dans le lien de la page "affichage_article.php?id_ar=$id_ar"
							echo "<h3 id='titre_article'> <a href='affichage_article.php?id_ar=$id_ar' class='a-color'>".$article['titre']."</a></h3>";
							echo"<small><p id='date'>fait par ".$article['username']. " le " .$article['date']."</p></small>";
							echo "</div>";
						}
						echo "</div>";
					}
				?>
			</article>
			<article>
				<?php
					$id = 2; 
					$req =mysqli_query($bsd,"SELECT *FROM article WHERE id_categorie = '$id'");
					if($req){
						echo "<div id='div_tout'>";
						echo"<h2 id='titre_cate'>Jeux videos:</h2>";
						while($article = mysqli_fetch_array($req)){
							$id_ar=$article['id'];
							echo "<div id='div_cont'>";
							echo "<h3 id='titre_article'> <a href='affichage_article.php?id_ar=$id_ar' class='a-color'>".$article['titre']."</a></h3>";
							echo"<small><p id='date'>fait par: ".$article['username']. " le " .$article['date']."</p></small>";
							echo "</div>";
						}
					echo "</div>";
					}
				?>
			</article>
			<article>
				<?php
					$id = 3; 
					$req =mysqli_query($bsd,"SELECT *FROM article WHERE id_categorie = '$id'");
					if($req){
						echo "<div id='div_tout'>";
						echo"<h2 id='titre_cate'>Sports:</h2>";
						while($article = mysqli_fetch_array($req)){
							$id_ar=$article['id'];
							echo "<div id='div_cont'>";
							echo "<h3 id='titre_article'> <a href='affichage_article.php?id_ar=$id_ar' class='a-color'>".$article['titre']."</a></h3>";
							echo"<small><p id='date'>fait par: ".$article['username']. " le " .$article['date']."</p></small>";
							echo "</div>";
						}
					echo "</div>";
					}
				?>
			</article>
			<article>
				<?php
					$id = 4; 
					$req =mysqli_query($bsd,"SELECT *FROM article WHERE 	id_categorie = '$id'");
					if($req){
						echo "<div id='div_tout'>";
						echo"<h2 id='titre_cate'>Sciences:</h2>";
						while($article = mysqli_fetch_array($req)){
							$id_ar=$article['id'];
							echo "<div >";
							echo "<h3 id='titre_article'> <a href='affichage_article.php?id_ar=$id_ar' class='a-color'>".$article['titre']."</a></h3>";
							echo"<small><p id='date'>fait par: ".$article['username']. " le " .$article['date']."</p></small>";
							echo "</div>";
						}
						echo "</div>";
					}
				?>
			</article>
        </section>

    </div>
</main>
</div>
</body>
</html>
	
