<?php
	session_start();

	$bdd = new PDO('mysql:host=localhost;dbname=membre_ppe', 'root', 'root');

	if(isset($_SESSION['id']))
	{
		$requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
		$requser->execute(array($_SESSION['id']));
		$user = $requser->fetch();
	
		if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom'])
		{
			$newnom = htmlspecialchars($_POST['newnom']);
			$insertnom = $bdd->prepare("UPDATE membres SET nom = ? WHERE id = ?");
			$insertnom->execute(array($newnom, $_SESSION['id']));
			header('Location: Profil.php?id='.$_SESSION['id']);
		}

		if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom'])
		{
			$newprenom = htmlspecialchars($_POST['newprenom']);
			$insertprenom = $bdd->prepare("UPDATE membres SET prenom = ? WHERE id = ?");
			$insertprenom->execute(array($newprenom, $_SESSION['id']));
			header('Location: Profil.php?id='.$_SESSION['id']);
		}

		if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email'])
		{
			$newmail = htmlspecialchars($_POST['newmail']);
			$insertmail = $bdd->prepare("UPDATE membres SET email = ? WHERE id = ?");
			$insertmail->execute(array($newmail, $_SESSION['id']));
			header('Location: Profil.php?id='.$_SESSION['id']);
		}

		if(isset($_POST['newnomdesociete']) AND !empty($_POST['newnomdesociete']) AND $_POST['newnomdesociete'] != $user['nomdesociete'])
		{
			$newnomdesociete = htmlspecialchars($_POST['newnomdesociete']);
			$insertnomdesociete = $bdd->prepare("UPDATE membres SET nomdesociete = ? WHERE id = ?");
			$insertnomdesociete->execute(array($newnomdesociete, $_SESSION['id']));
			header('Location: Profil.php?id='.$_SESSION['id']);
		}

		if(isset($_POST['newnumero1']) AND !empty($_POST['newnumero1']) AND $_POST['newnumero1'] != $user['numero1'])
		{
			$newnumero1 = htmlspecialchars($_POST['newnumero1']);
			$insertnumero1 = $bdd->prepare("UPDATE membres SET numero1 = ? WHERE id = ?");
			$insertnumero1->execute(array($newnumero1, $_SESSION['id']));
			header('Location: Profil.php?id='.$_SESSION['id']);
		}

		if(isset($_POST['newnumero2']) AND !empty($_POST['newnumero2']) AND $_POST['newnumero2'] != $user['numero2'])
		{
			$newnumero2 = htmlspecialchars($_POST['newnumero2']);
			$insertnumero2 = $bdd->prepare("UPDATE membres SET numero2 = ? WHERE id = ?");
			$insertnumero2->execute(array($newnumero2, $_SESSION['id']));
			header('Location: Profil.php?id='.$_SESSION['id']);
		}

		if(isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND ($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
		{
			$mdp1 = sha1($_POST['newmdp']);
			$mdp2 = sha1($_POST['newmdp2']);
	
			if($mdp1 == $mdp2)
			{
				$insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
				$insertmdp->execute(array($mdp1, $_SESSION['id']));
				header('Location: Profil.php?id='.$_SESSION['id']);
			}
			else
			{
				$msg = "Vos mots de passe ne correspondent pas";
			}
		}
		if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
		{
			$taillemax = 2097152;
			$extensionsvalides= array('jpg', 'jpeg', 'gif', 'png');
			if($_FILES['avatar']['size'] <= $taillemax)
			{
				$extensionupload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
				if(in_array($extensionupload, $extensionsvalides))
				{
					$chemin = "../../images/".$_SESSION['id'].".".$extensionupload;
					$deplacement = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
					if($deplacement)
					{
						$updtateavatar = $bdd->prepare('UPDATE membres SET avatar = :avatar WHERE id = :id');
						$updtateavatar->execute(array(
						'avatar' => $_SESSION['id'].".".$extensionupload,
						'id' => $_SESSION['id']
						));
						header('Location: Profil.php?id='.$_SESSION['id']);
					}
					else
					{
						$msg = "Erreur durant l'importation de votre photo de profil";
					}
				}
				else
				{
					$msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
				}
			}
			else
			{
				$msg = "Votre photo de profil ne doit pas dépasser 2 Mo";
			}
		}
		?>
		<html>
			<head>
				<title>Edition</title>
				<link rel="stylesheet" href="..\..\styles\cssbase.css">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link href="https://fonts.googleapis.com/css?family=Catamaran&display=swap" rel="stylesheet">
			</head>
			<body>
				<div align="center" class="ecriture3">
					<h2>Edition de mon profil</h2>
					<form method="POST" action="" enctype="multipart/form-data">
						<table>
							<tr>
								<td align="right" class="ecriture3">
									Nom :
								</td>
								<td>
									<input type="text" name="newnom" placeholder="Nom" value="<?php echo $user['nom']; ?>"
								</td>
							</tr>
							<tr>
								<td align="right" class="ecriture3">
									Prenom : 
								</td>
								<td>
									<input type="text" name="newprenom" placeholder="Prenom" value="<?php echo $user['prenom']; ?>" />
								</td>
							</tr>
							<tr>
								<td align="right" class="ecriture3">
									Email :
								</td>
								<td>						
									<input type="email" name="newmail" placeholder="Mail" value="<?php echo $user['email']; ?>" />
								</td>
							</tr>
							<tr>
								<td align="right" class="ecriture3">
									Nom de société : 
								</td>
								<td>
									<input type="text" name="newnomdesociete" placeholder="Nom de société" value="<?php echo $user['nomdesociete']; ?>" />
								</td>
							</tr>
							<tr>
								<td align="right" class="ecriture3">
									Num téléphone :
								</td>
								<td>
									<input type="text" name="newnumero1" placeholder="Numéro de téléphone" value="<?php echo $user['numero1']; ?>" />
								</td>
							</tr>
							<tr>
								<td align="right" class="ecriture3">
									Num téléphone 2 :
								</td>
								<td>
									<input type="text" name="newnumero2" placeholder="Numéro de téléphone" value="<?php echo $user['numero2']; ?>" />
								</td>
							</tr>
							<tr>
								<td align="right" class="ecriture3">
									Mot de passe :
								</td>
								<td>
								<input type="password" name="newmdp1" placeholder="Mot de passe" />
								</td>
							</tr>
							<tr>
								<td align="right" class="ecriture3">
									Mot de passe :
								</td>
								<td>
									<input type="password" name="newmdp2" placeholder="Confirmation"/>
								</td>
							</tr>
							<tr>
								<td align="right" class="ecriture3">
									Avatar :
								</td>
								<td>
									<input type="file" name="avatar"/>
								</td>
							</tr>
						</table>
						<input type="submit" value="Mettre à jour mon profil">
					</form>
					<?php if(isset($msg)) { echo $msg; } ?>
				</div>
			</body>
		<html>
		<?php
	}
	else
	{
		header("Location: connexion.php");
	}
?>