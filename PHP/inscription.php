<?php
	session_start();//on ouvre une session pour récupérer les données qui sont stockés dedans ou pour en stocker d'autre.
	//connexion à la base de données.
	$bsd = mysqli_connect('localhost','bizieada','123456789','blogbd');
	echo mysqli_connect_error();
	//si id est rempli on retourne à la page d'accueil.
	if(isset($_SESSION['id'])){
		header("location:page_daccueil.php");
		exit();
	}
	if(!empty($_POST)){
		extract($_POST);
		$valid = true;
		if (isset($_POST['inscription'])){
			$nom = trim($nom);
			$prénom = trim($prénom);
			$email = strtolower(trim($email));
			$pseudo = trim($pseudo);
			$password = trim($password);
			$confmdp = trim($cpassword);
			if (empty($nom)) {
				$valid = false;
				$er="Le nom d'utilisateur ne peut pas être vide";
			}
			if(empty($prénom)){
				$valid = false;
				$er="Le prenom d'utlisateur ne peut pas être vide";
			}
				$res_email = mysqli_query($bsd, "SELECT * FROM personnes WHERE email = '".$email."'");
			if(empty($email)){
				$valid = false;
				$er = "Le mail ne peut pas être vide";
			}elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i",$email)){
				$valid = false;
				$er = "Le mail n'est pas valide";
			}elseif(mysqli_num_rows($res_email)) {
				$valid = false;
				$er ='Cette adresse email est déjà utilisé';
			}
			$res_pseudo = mysqli_query($bsd, "SELECT * FROM personnes WHERE pseudo = '".$_POST['pseudo']."'");
			if(empty($pseudo)){
				$valid = false;
				$er='Le pseudo ne peut pas être vide';
			}elseif(mysqli_num_rows($res_pseudo)) {
				$valid = false;
				$er = 'Ce pseudo est déjà utilisé';
			}
			if (empty($password)){
				$valid = false;
				$er = 'Le mot de passe ne peut pas être vide';
			}
			elseif($password != $confmdp){
				$valid = false;
				$er = 'La confirmation du mot de passe ne correspond pas';
			}
			//s'il n'y a pas d'erreur on insert la personne dans la base de données.
			if ($valid){
				$date_creation_compte = date('Y-m-d H:i:s');
				//$password = crypt($password,'$6$rounds=5000$zefbdifbidsbqfbsqdyfyqsdyofbyqou$');
				$requete="INSERT INTO personnes VALUES (NULL,'$nom','$prénom','$naissance','$email','$pseudo','$date_creation_compte','$password')";
				mysqli_query($bsd,$requete);
				echo mysqli_error($bsd);
				mysqli_close($bsd);
				header("location:connexion.php");
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
	<link rel="stylesheet" href="../CSS/style_inscription.css" />

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
				<pre>  <a href="page_daccueil.php">Page d'accueil</a>            <a href="connexion.php">Connexion</a>  </pre>
			</nav>
			<section>
				<div class="interface">
					<!--Formulaire d'inscription-->
					<h2>Formulaire d'inscription:</h2>
					<!--Pour le nom-->
					<label for="nom">Nom:</label>
					<input type="text"  name="nom" placeholder="Votre nom" value="<?php if(isset($nom)){ echo $nom; }?>"  required>
						
					<label for="prénom">Prénom:</label>
					<input type="text" name="prénom"  placeholder="Votre prénom" value="<?php if(isset($prénom)){ echo $prénom; }?>"  required><br>
						
					<label for="naissance">Date de naissance:</label>
					<input type="date" name="naissance"  ><br>
						
					<label for="email">Adresse mail:</label>
					<input type="email" name="email" placeholder="Votre adresse mail" value="<?php if(isset($email)){ echo $email; }?>" required><br>
						
					<label for="pseudo">pseudonyme:</label>
					<input type="text" name="pseudo" placeholder="Votre 'surnom' " value="<?php if(isset($pseudo)){ echo $pseudo; }?>" required><br>
						
					<label for="password">mot de passe:</label>
					<input type="password" name="password" placeholder="Votre mot de passe" required><br>
						
					<label for="password">Confirmer le mot de passe:</label>
					<input type="password" name="cpassword" placeholder="Confirmer le mot de passe" required><br>
						
					<button type="submit" name="inscription" >Envoyer</button>
					
					<small>Vous avez déjà un compte? <a href="connexion.php" class="color">Se connecter</a></small>
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

