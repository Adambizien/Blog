<?php
	session_start();//on ouvre une session pour récupérer les données qui sont stockés dedans ou pour en stocker d'autre.
	//connexion à la base de données.
	$bsd = mysqli_connect('localhost','bizieada','123456789','blogbd');
	echo mysqli_connect_error();
	//si id est vide donc on retourne à la page d'accueil.
	if(isset($_SESSION['id'])){
		header("location:page_daccueil.php");
		exit();
	}
	//on récupère les données du site et on regarde s'il y a des erreurs .
	if(!empty($_POST)){
		extract($_POST);
		$valid = true;
		if (isset($_POST['connexion'])){
			$email = strtolower(trim($email));
			$password = trim($password);
			if(empty($email)){
				$valid = false;
				$er ="-Le mail ne peut pas être vide!";
			}elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i",$email)){
				$valid = false;
				$er = "-Le mail n'est pas valide!";
			}elseif (empty($password)){
				$valid = false;
				$er = "-Le mot de passe ne peut pas être vide!";
			}
			//$mdp = crypt($password,'$6$rounds=5000$zefbdifbidsbqfbsqdyfyqsdyofbyqou$');
			$res = mysqli_query($bsd,"SELECT * FROM personnes WHERE mdp = '$password' AND email = '$email'");
			$login = mysqli_fetch_array($res);
			if ($login['id'] == "" ){
				$valid = false;
				$er = "-Le mail ou le mot de passe est incorrecte!";
			}
			//s'il n'y a pas d'erreur récupére les données dans la base de données.
			if ($valid){  
				$_SESSION['id'] = $login['id'];
				$_SESSION['nom'] = $login['nom'];
				$_SESSION['prénom'] = $login['prenom'];
				$_SESSION['email'] = $login['email'];
				$_SESSION['pseudo'] = $login['pseudo'];
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
  
		<!--Pour mettre dans le code des caractères spéciaux-->
		<meta charset="utf-8"/>
  
		<!--Pour que ça fonctionne bien sur internet explorer-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  
		<!--Pour avoir le bon niveau de zoom dans le mobile -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  
		<!--Le nom de la page-->
		<title>Néon BLOG</title>
  
		<!--feuille de style-->
		<link rel="stylesheet" href='../CSS/style_connexion.css'/>
		
	</head>
	<div class="fondfloue">
		<body  class="fond">
			<form  method="post">
			<header>
				<!--Titre-->
				<h1>Néon BLOG</h1>
			</header>
			<nav>
				<!--les liens vers les autres page-->
				<pre>  <a href="page_daccueil.php">Page d'accueil</a>            <a href="inscription.php">Inscription</a>  </pre>
			</nav>
			<section>
				<div class="interface">
					<!--Formulaire de connexion-->
					<h2>Formulaire de connexion:</h2>
					
				
					<label for="email">Adresse mail:</label>
					<input type="email" name="email" placeholder="Votre adresse mail" value="<?php if(isset($email)){ echo $email; }?>" required><br>
					<br> 
					<label for="password">mot de passe:</label>
					<input type="password" name="password" placeholder="Votre mot de passe" required><br>
					<br>
					
					<button type="submit" name="connexion">connexion</button>
					<small>Vous n'avez pas de compte?<a href="inscription.php" class="color">S'inscrire</a></small>
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

