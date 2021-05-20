<?php

	$bdd = new PDO('mysql:host=localhost;dbname=membre_ppe', 'root', 'root');

	if(isset($_POST['forminscription']))
	{
		if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['nomdesociete']) AND !empty($_POST['email1']) AND !empty($_POST['email2']) AND !empty($_POST['numero1']) AND !empty($_POST['mdp1']) AND !empty($_POST['mdp2']))
		{
			$prenom = htmlspecialchars($_POST['prenom']);
			$nom = htmlspecialchars($_POST['nom']);
			$nomdesociete = htmlspecialchars($_POST['nomdesociete']);
			$email1 = htmlspecialchars($_POST['email1']);
			$email2 = htmlspecialchars($_POST['email2']);
			$numero1 = htmlspecialchars($_POST['numero1']);
			$numero2 = htmlspecialchars($_POST['numero2']);
			$mdp1 = sha1($_POST['mdp1']);
			$mdp2 = sha1($_POST['mdp2']);
		
			$prenomlength = strlen($prenom);
			$nomlength = strlen($nom);
			if($prenomlength <= 255 AND $nomlength <= 255)
			{
				if($email1 == $email2)
				{
					if($mdp1 == $mdp2)
					{
						$reqmail = $bdd->prepare("SELECT * FROM membres WHERE email = ?");
						$reqmail->execute(array($email1));
						$mailexist = $reqmail ->rowCount();
						if($mailexist == 0)
						{
							$reqnumero1 = $bdd->prepare("SELECT * FROM membres WHERE numero1 = ?");
							$reqnumero1->execute(array($numero1));
							$numero1exist = $reqnumero1 ->rowCount();
							if($numero1exist == 0)
							{
								$insertmbr = $bdd->prepare("INSERT INTO membres(prenom, nom, nomdesociete, email, numero1, numero2, motdepasse) VALUES(?,?,?,?,?,?,?)");
								$insertmbr->execute(array($prenom, $nom, $nomdesociete, $email1, $numero1, $numero2, $mdp1));
								$erreur = "votre compte a bien été créé! <a href =\"connexion.php\">Me connecter</a>";
							}
							else
							{
								$erreur = "numéro déja utilisée déjà utilisée.";
							}
						}
						else
						{
							$erreur = "Adresse mail déjà utilisée.";
						}
					}
					else
					{
						$erreur = "Vos mot de passe ne sont pas identique.";
					}
				}
				else
				{
					$erreur = "Vos adresses ne sont pas identique.";
				}
			}
			else
			{
				$erreur = "Votre nom et prenom ne doivent pas dépasser 255 caractères.";
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
		<title>Inscription</title>
		<link rel="stylesheet" href="..\..\styles\cssbase.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Catamaran&display=swap" rel="stylesheet">
	</head>
	<body>
		<div class="ecriture3">
			<div align="center">
				<h2>Inscription</h2>
				<br/><br/>
				<form method="POST" action="">
					<table>
						<!-- ------------ PRENOM ------------ -->
						<tr>
							<td align="right" class="ecriture3">
								<label for="prenom">Prenom* :</label>
							</td>
							<td>
								<input type="text" placeholder="Prenom" id="prenom" name="prenom" value ="<?php if(isset($prenom)) {echo $prenom;} ?>"
							</td>
						</tr>
						<!-- ------------ NOM ------------ -->
						<tr>
							<td align="right" class="ecriture3">
								<label for="nom">Nom* :</label>
							</td>
							<td>
								<input type="text" placeholder="Nom" id="nom" name="nom" value ="<?php if(isset($nom)) {echo $nom;} ?>"
							</td>
						</tr>
						<!-- ------------ NOM ------------ -->
						<tr>
							<td align="right" class="ecriture3">
								<label for="nomdesociete">Nom de Société* :</label>
							</td>
							<td>
								<input type="text" placeholder="Nom de Société" id="nomdesociete" name="nomdesociete" value ="<?php if(isset($nomdesociete)) {echo $nomdesociete;} ?>"
							</td>
						</tr>
						<!-- ------------ MAIL ------------ -->
						<tr>
							<td align="right" class="ecriture3"
								<label for="email1">Mail* :</label>
							</td>
							<td>
								<input type="email" placeholder="Mail" id="email1" name="email1" value ="<?php if(isset($email1)) {echo $email1;} ?>"
							</td>
						</tr>
						<!-- ------------ CONFIRMATION MAIL ------------ -->
						<tr>
							<td align="right" class="ecriture3">
								<label for="email2">Confirmation du Mail* :</label>
							</td>
							<td>
								<input type="email" placeholder="Confirmation du Mail" id="email2" name="email2" value ="<?php if(isset($email2)) {echo $email2;} ?>"
							</td>
						</tr>
						<!-- ------------ NUM1 ------------ -->
						<tr>
							<td align="right" class="ecriture3">
								<label for="numero1">Numéro de téléphone* :</label>
							</td>
							<td>
								<input type="tel" placeholder="Numéro de téléphone" id="numero1" name="numero1" value ="<?php if(isset($numero1)) {echo $numero1;} ?>"
							</td>
						</tr>
						<!-- ------------ NUM2 ------------ -->
						<tr>
							<td align="right" class="ecriture3">
								<label for="numero2">Numéro supplémentaire :</label>
							</td>
							<td>
								<input type="tel" placeholder="Numéro de téléphone" id="numero2" name="numero2" value ="<?php if(isset($numero2)) {echo $numero2;} ?>"
							</td>
						</tr>
							<!-- ------------ MOT DE PASSE ------------ -->
						<tr>
							<td align="right" class="ecriture3">
								<label for="mdp1">Mot de passe* :</label>
							</td>
							<td>
								<input type="password" placeholder="Mot de passe" id="mdp1" name="mdp1"
							</td>
						</tr>
						<!-- ------------ CONFIRMATION MOT DE PASSE ------------ -->
						<tr>
							<td align="right" class="ecriture3">
								<label for="mdp2">Mot de passe* :</label>
							</td>
							<td>
								<input type="password" placeholder="Confirmation du Mot de passe" id="mdp2" name="mdp2"
							</td>
						</tr>
					</table>
					<br/>
					<input type="submit" name="forminscription" value="Inscription"/>
				</form>
				<br/>
				<a href="..\..\Index.php" class="ecriture3"> Retour</a>
				<a class="barre"></a>
				<a href="Connexion.php" class="ecriture3"> Connexion</a>
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