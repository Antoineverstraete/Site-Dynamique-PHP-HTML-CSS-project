<?php
	session_start();

	$bdd = new PDO('mysql:host=localhost;dbname=membre_ppe', 'root', 'root');

	if(isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getid = intval($_GET['id']);
		$requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
		$requser->execute(array($getid));
		$userinfo = $requser->fetch();
		?>
		<html>
			<head>
				<title>Profil</title>
				<link rel="stylesheet" href="..\..\styles\cssbase.css">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link href="https://fonts.googleapis.com/css?family=Catamaran&display=swap" rel="stylesheet">
			</head>
			<body>
				<div align="center">
					<div class="ecriture3">
						<h2>Profil de <?php echo $userinfo['prenom'] ?> </h2>
						<br/><br/>
						<table>
							<tr>
								<td>
								<?php
								if(!empty($userinfo['avatar']))
								{
									?>
									<img src="../../images/<?php echo $userinfo['avatar']  ?>" width="200" />
									<?php
								}
								else
								{
									?>
									<img src="../../images/default.png" width="200" />
									<?php
								}
								?>
								</td>
								<td class="ecriture3">
									Nom = <?php echo $userinfo['nom']?>
									</br>
									Prenom = <?php echo $userinfo['prenom'] ?>
									</br>
									Mail = <?php echo $userinfo['email'] ?>
									</br>
									Nom de société = <?php echo $userinfo['nomdesociete'] ?>
									</br>
									Numéro de téléphone 1 = <?php echo $userinfo['numero1'] ?>
									</br>
									Numéro de téléphone 2 = <?php if($userinfo['numero2'] != 0){echo $userinfo['numero2'];} else { echo "Non renseigé";} ?>
								</td>
							</tr>
						</table>
						<?php
						if($getid == 1 AND isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
						{
							?></br><?php
							echo "bienvenue sur le compte administrateur";
							$nbruser = $bdd->prepare("SELECT id FROM membres");
							$nbruser->execute();
							$nbruserexist = $nbruser ->rowCount();
							?> <br/><br/> <?php
							echo 'il y a '.$nbruserexist.' compte(s) enregistrer dans la base de données';
							?> <br/><br/>
							<?php
							$requete = $bdd->prepare("SELECT * FROM membres ORDER BY id");
							$requete->execute(array());
							?>
							<table border ="1" class="ecriture3">
								<?php
								while($resultat = $requete->fetch())
								{
									?>
									<tr>
										<td><?php echo $resultat['id']; ?></td>
										<td><?php echo $resultat['nom']; ?></td>
										<td><?php echo $resultat['prenom']; ?></td>
										<td><?php echo $resultat['nomdesociete']; ?></td>
										<td><?php echo $resultat['email']; ?></td>
										<td><?php echo $resultat['numero1']; ?></td>
										<td><?php if($resultat['numero2'] != 0){echo $resultat['numero2'];} else { echo "Indéfini";} ?></td>
									</tr>
									<?php
								}
								?>
							</table>					
							<?php
						}
						?>
						<br/><br/>						
						<?php
						if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
						{
							?>
							<a href="Editionprofil.php" class="ecriture3">Editer mon profil</a>
							<a class="barre"></a>
							<a href="deconnexion.php" class="ecriture3">Se déconnecter</a>
							<?php
						}
						else if (isset($_SESSION['id']) AND $userinfo['id'] != $_SESSION['id'])
						{
						?>
							<a href='Profil.php?id=<?php echo $_SESSION['id'];?>' class="ecriture3">Retour à mon profil</a>
						<?php
						}
						?>
					</div>
				</div>
			</body>
		<html>
		<?php
	}
?>