<?php
	session_start();

	$bdd = new PDO('mysql:host=localhost;dbname=membre_ppe', 'root', 'root');

	if(isset($_POST['formconnexion']))
	{
		$mailconnect = htmlspecialchars($_POST['mailconnect']);
		$mdpconnect = sha1($_POST['mdpconnect']);
		if(!empty($mailconnect) AND !empty($mdpconnect))
		{
			$requser = $bdd->prepare("SELECT * FROM membres WHERE email = ? AND motdepasse = ?");
			$requser->execute(array($mailconnect, $mdpconnect));
			$userexist = $requser->rowCount();
			if($userexist == 1)
			{
				$userinfo = $requser->fetch();
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['nom'] = $userinfo['nom'];
				$_SESSION['email'] = $userinfo['email'];
				header("Location: profil.php?id=".$_SESSION['id']);
			}
			else
			{
				$erreur = "Erreur de saisie dans le speudo ou le mot de passe";
			}
		}
		else
		{
			$erreur = "Tous les champs doivent être complétés.";
		}
	}
?>
<html>
	<head>
		<title>Connexion</title>
		<link rel="stylesheet" href="..\..\styles\cssbase.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Catamaran&display=swap" rel="stylesheet">
	</head>
	<body>
		<div class="ecriture3">
			<div align="center">
				<h2>Connexion</h2>
				<br/><br/>
			
				<form method="POST" action="">
					<input type="text" name="mailconnect" placeholder="Email"/>
					<input type="password" name="mdpconnect" placeholder="Mot de passe"/>
					<input type="submit" name="formconnexion" value="Se connecter"/>
				</form>
				<br/>
				<a href="..\..\Index.php" class="ecriture3"> Retour</a>
				<a class="barre"></a>
				<a href="register.php" class="ecriture3"> Inscription</a>
				<br/>
				<?php
					if(isset($erreur))
					{
						echo $erreur;
					}
				?>
			</div>
		</div>
	</body>
<html>