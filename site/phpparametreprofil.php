<?php
	header("Content-Type: text/javascript");
	
	session_start();
	
	$db = new PDO('mysql:host=localhost;dbname=metromanga', 'root', '');
	
	if(isset($_GET['validermodifierpseudo']) AND isset($_SESSION['ID']))
	{
		$pseudo = htmlspecialchars($_GET['validermodifierpseudo']);
		$ID = $_SESSION['ID'];
		
		if(mb_strlen($pseudo, 'utf8') <= 30 AND mb_strlen($pseudo, 'utf8') >= 3)
		{
			$search = $db->prepare('SELECT * FROM membres WHERE pseudo = ?');
			$search->execute(array($pseudo));
			$pseudoexist = $search->rowCount();
			if($pseudoexist == 0)
			{
				$new = $db->prepare('UPDATE membres SET pseudo = :pseudo WHERE ID = :ID');
				$new->execute(array(
				'pseudo' => $pseudo,
				'ID' => $ID
				));
			}
			else
			{
				echo
				'<img src="images/supprimerrecherche.png" alt="error" class="resultatmodificationimg" title="Ce pseudo est déjà utilisé." />';
			}
		}
		else
		{
			echo
			'<img src="images/supprimerrecherche.png" alt="error" class="resultatmodificationimg" title="Votre pseudo doit obligatoirement contenir entre 3 et 30 caractères." />';
		}
	}
	else if(isset($_GET['validermodifieremail']) AND isset($_SESSION['ID']))
	{
		$email = htmlspecialchars($_GET['validermodifieremail']);
		$ID = $_SESSION['ID'];
		
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$search = $db->prepare('SELECT * FROM membres WHERE email = ?');
			$search->execute(array($email));
			$emailexist = $search->rowCount();
			if($emailexist == 0)
			{
				$new = $db->prepare('UPDATE membres SET email = :email WHERE ID = :ID');
				$new->execute(array(
				'email' => $email,
				'ID' => $ID
				));
			}
			else
			{
				echo
				'<img src="images/supprimerrecherche.png" alt="error" class="resultatmodificationimg" title="Cette adresse mail est déjà utilisé." />';
			}
		}
		else
		{
			echo
			'<img src="images/supprimerrecherche.png" alt="error" class="resultatmodificationimg" title="Votre adresse mail n\'est pas valide." />';
		}
	}
	else if(isset($_GET['validermodifierdatenaissance']) AND isset($_SESSION['ID']))
	{
		$datenaissance = htmlspecialchars($_GET['validermodifierdatenaissance']);
		$ID = $_SESSION['ID'];

		$new = $db->prepare('UPDATE membres SET date_naissance = :date_naissance WHERE ID = :ID');
		$new->execute(array(
		'date_naissance' => $datenaissance,
		'ID' => $ID
		));
	}
	else if(isset($_GET['validermodifiergenre']) AND isset($_SESSION['ID']))
	{
		$genre = htmlspecialchars($_GET['validermodifiergenre']);
		$ID = $_SESSION['ID'];
		
		if(($genre == 'Homme') OR ($genre == 'Femme'))
		{
			$new = $db->prepare('UPDATE membres SET genre = :genre WHERE ID = :ID');
			$new->execute(array(
			'genre' => $genre,
			'ID' => $ID
			));
		}
		else
		{
			echo
			'<img src="images/supprimerrecherche.png" alt="error" class="resultatmodificationimg" />';
		}
	}
	else if(isset($_GET['validermodifiermdp']) AND isset($_GET['newmdp']) AND isset($_GET['confirmmdp']) AND isset($_SESSION['ID']))
	{
		$mdp = sha1($_GET['validermodifiermdp']);
		$pass = $_SESSION['pass'];
		$newmdp = $_GET['newmdp'];
		$confirmmdp = $_GET['confirmmdp'];
		$ID = $_SESSION['ID'];
		
		if($mdp == $pass)
		{
			if(mb_strlen($newmdp, 'utf8') >= 5)
			{
				if($newmdp == $confirmmdp)
				{
					$newmdph = sha1($_GET['newmdp']);
					
					$new = $db->prepare('UPDATE membres SET pass = :pass WHERE ID = :ID');
					$new->execute(array(
					'pass' => $newmdph,
					'ID' => $ID
					));
				}
				else
				{
					echo
					'<img src="images/supprimerrecherche.png" alt="error" class="resultatmodificationimg" title="Vos mots de passes ne sont pas identiques." />';
				}
			}
			else
			{
				echo
				'<img src="images/supprimerrecherche.png" alt="error" class="resultatmodificationimg" title="Ce mot de passe est trop court." />';
			}
		}
		else
		{
			echo
			'<img src="images/supprimerrecherche.png" alt="error" class="resultatmodificationimg" title="Mot de passe incorrecte." />';
		}
	}
	else if(isset($_GET['IDnotification']) AND isset($_SESSION['ID']))
	{
		
		$updateverifnotif = $db->query('UPDATE notification SET verif =\'YES\' WHERE ID=\'' . $_GET['IDnotification'] . '\'');
		
	}
	else
	{
		header("Location: ../index.php");
	}
?>