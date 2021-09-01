<?php
	header("Content-Type: text/javascript");
	
	session_start();
	
	$db = new PDO('mysql:host=localhost;dbname=metromanga', 'root', '');
	
	if(isset($_POST['contact']) AND isset($_POST['mail']) AND isset($_POST['sujet']) AND isset($_POST['message']))
	{
		$nom = htmlspecialchars($_POST['contact']);
		$mail = htmlspecialchars($_POST['mail']);
		$sujet = htmlspecialchars($_POST['sujet']);
		$message = htmlspecialchars($_POST['message']);
		
		if(strlen($nom) >= 2)
		{
			if(strlen($mail) >= 5)
			{
				if(filter_var($mail, FILTER_VALIDATE_EMAIL))
				{
					if(strlen($message) >= 10)
					{
						$insertcontact = $db->prepare('INSERT INTO contact(nom, mail, sujet, message) VALUES (:nom, :mail, :sujet, :message)');
						$insertcontact->execute(array(
						'nom' => $nom,
						'mail' => $mail,
						'sujet' => $sujet,
						'message' => $message
						));
						
						echo 'OK';
					}
					else
					{
						echo
						'<img src="images/fermer.png" alt="ERROR" class="imgerror" title="Votre message est obligatoire" />';
					}
				}
				else
				{
					echo
					'<img src="images/fermer.png" alt="ERROR" class="imgerror" title="Votre E-mail n\'est pas valide" />';
				}
			}
			else
			{
				echo
				'<img src="images/fermer.png" alt="ERROR" class="imgerror" title="Votre E-mail est obligatoire" />';
			}
		}
		else
		{
			echo
			'<img src="images/fermer.png" alt="ERROR" class="imgerror" title="Votre nom est obligatoire" />';
		}
	}
	else
	{
		header("Location: ../index.php");
	}
?>