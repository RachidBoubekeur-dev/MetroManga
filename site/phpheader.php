<?php
	header("Content-Type: text/javascript");
	
	session_start();
	
	$db = new PDO('mysql:host=localhost;dbname=metromanga', 'root', '');
	
	if(isset($_GET['forgetmdp']) AND isset($_GET['mail']))
	{
		$pseudo = $_GET['forgetmdp'];
		$mail = $_GET['mail'];
		
		if(strlen($pseudo) >= 3 AND strlen($mail) >= 4)
		{
			$searchidentifiantexist = $db->query('SELECT * FROM membres WHERE pseudo =\'' . $pseudo . '\' AND email=\'' . $mail .  '\'');
			$countidentifiantexist = $searchidentifiantexist->rowCount();
			if($countidentifiantexist == 1)
			{
				$infomembreforget = $searchidentifiantexist->fetch();
				
				$mail = 'rachidboubekeur42100@gmail.com'; // Déclaration de l'adresse de destination.
				if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
				{
					$passage_ligne = "\r\n";
				}
				else
				{
					$passage_ligne = "\n";
				}
				//=====Déclaration des messages au format texte et au format HTML.
				$message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
				//==========
				
				//=====Création de la boundary
				$boundary = "-----=".md5(rand());
				//==========
				
				//=====Définition du sujet.
				$sujet = "Hey mon ami !";
				//=========
				
				//=====Création du header de l'e-mail.
				$header = "From: \"Metro\"<rachidboubekeur42100@gmail.com>".$passage_ligne;
				$header = "Reply-to: \"Metro\" <rachidboubekeur42100@gmail.com>".$passage_ligne;
				$header = "MIME-Version: 1.0".$passage_ligne;
				$header = "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
				//==========
				
				$message = $passage_ligne."--".$boundary.$passage_ligne;
				//=====A out du message au format HTML
				$message = "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
				$message = "Content-Transfer-Encoding: 8bit".$passage_ligne;
				$message = $passage_ligne.$message_html.$passage_ligne;
				//====== ===
				$message = $passage_ligne."--".$boundary."--".$passage_ligne;
				$message = $passage_ligne."--".$boundary."--".$passage_ligne;
				//==========
				
				//=====Envoi de l'e-mail.
				// mail($mail,$sujet,$message,$header);
				//==========

				
				echo '<span class="xhrforgetmdpspan">OK</span>';
			}
			else
			{
				echo
				'<img id="imageerreur" src="images/erreur.png" alt="ERROR" title="Identifiant Incorrect" />';
			}
		}
	}
	else
	{
		header("Location: ../index.php");
	}
?>