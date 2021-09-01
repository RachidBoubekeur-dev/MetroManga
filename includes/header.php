<?php	
	$db = new PDO('mysql:host=localhost;dbname=metromanga', 'root', '');
	
	if(isset($_POST['inscrire']))
	{
		$pseudo = htmlspecialchars($_POST['nom']);
		$pass = $_POST['pass'];
		$pass2 = $_POST['pass2'];
		$mail = htmlspecialchars($_POST['mail']);
		$adress_ip = $_SERVER['REMOTE_ADDR'];
		
		if(isset($pseudo))
		{
			if(mb_strlen($pseudo, 'utf8') <= 30 AND mb_strlen($pseudo, 'utf8') >= 3)
			{
				$search = $db->prepare('SELECT * FROM membres WHERE pseudo = ?');
				$search->execute(array($pseudo));
				$pseudoexist = $search->rowCount();
				if($pseudoexist == 0)
				{
					if(mb_strlen($pass, 'utf8') >= 5)
					{
						if($pass == $pass2)
						{
							$passh = sha1($_POST['pass']);
							if(filter_var($mail, FILTER_VALIDATE_EMAIL))
							{
								$searchemail = $db->prepare('SELECT * FROM membres WHERE email = ?');
								$searchemail->execute(array($mail));
								$emailexist = $search->rowCount();
								if($emailexist == 0)
								{
									$new = $db->prepare('INSERT INTO membres(pseudo,pass,email,date_naissance,genre,avatar,plandefond,date_inscription,adress_ip,last_connexion) VALUES (:pseudo,:pass,:mail,:naissance,:genre,:avatar,:plandefond,NOW(),:adress_ip,NOW())');
									$new->execute(array(
									'pseudo' => $pseudo,
									'pass' => $passh,
									'mail' => $mail,
									'naissance' => null,
									'genre' => null,
									'avatar' => "defaut.png",
									'plandefond' => "defaut.jpg",
									'adress_ip' => $adress_ip
									));
									
									$connect = $db->prepare('SELECT * FROM membres WHERE pseudo = ? AND pass = ?');
									$connect->execute(array($pseudo,$passh));
									$userinfo = $connect->fetch();
									
									$_SESSION['ID'] = $userinfo['ID'];
									$_SESSION['pseudo'] = $userinfo['pseudo'];
									$_SESSION['pass'] = $userinfo['pass'];
									$_SESSION['email'] = $userinfo['email'];
									$_SESSION['date_naissance'] = $userinfo['date_naissance'];
									$_SESSION['genre'] = $userinfo['genre'];
									$_SESSION['avatar'] = $userinfo['avatar'];
									$_SESSION['plandefond'] = $userinfo['plandefond'];
									$_SESSION['date_inscription'] = $userinfo['date_inscription'];
									$_SESSION['last_connexion'] = $userinfo['last_connexion'];
									
									$IDmembre = $_SESSION['ID'];
									$sujet = 'Inscription';
									$titre = 'Bienvenue sur Metro Manga';
									$text = 'Bonjour ' . $_SESSION['pseudo'] . ',<br />Nos équipes sont ravies de vous accueillir et vous souhaite la bienvenue dans la communauté de Metro Manga !<br />Nous vous invitons à compléter votre profil et à profiter des divertissements disponibles sur Metro Manga.<br /><br />À bientôt<br />Les équipes de Metro Manga';
									
									$sujet = htmlspecialchars($sujet);
									$titre = htmlspecialchars($titre);
									$text = htmlspecialchars($text);
									
									$insertnotif = $db->prepare('INSERT INTO notification(IDmembre, sujet, titre, text, date_time) VALUES(:IDmembre, :sujet, :titre, :text, NOW())');
									$insertnotif->execute(array(
									'IDmembre' => $IDmembre,
									'sujet' => $sujet,
									'titre' => $titre,
									'text' => $text
									));
									
								}
								else
								{
									$imageerreur4 = '<img id="imageerreur4" src="images/erreur.png" alt="ERROR" title="Cette adresse mail est déjà utilisé." />';
								}
							}
							else
							{
								$imageerreur4 = '<img id="imageerreur4" src="images/erreur.png" alt="ERROR" title="Votre adresse mail n\'est pas valide." />';
							}
						}
						else
						{
							$imageerreur3 = '<img id="imageerreur3" src="images/erreur.png" alt="ERROR" title="Vos mots de passes ne sont pas identiques." />';
						}
					}
					else
					{
						$imageerreur2 = '<img id="imageerreur2" src="images/erreur.png" alt="ERROR" title="Ce mot de passe est trop court." />';
					}
				}
				else
				{
					$imageerreur1 = '<img id="imageerreur1" src="images/erreur.png" alt="ERROR" title="Ce pseudo est déjà utilisé." />';
				}
			}	
			else
			{
				$imageerreur1 = '<img id="imageerreur1" src="images/erreur.png" alt="ERROR" title="Votre pseudo doit obligatoirement contenir entre 3 et 30 caractères" />';
			}
		}
	}
	
	if(isset($_POST['boutonconnexion']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mdp = sha1($_POST['mdp']);
		if(isset($pseudo) AND isset($mdp))
		{
			$connect = $db->prepare('SELECT * FROM membres WHERE pseudo = ? AND pass = ?');
			$connect->execute(array($pseudo,$mdp));
			$connection = $connect->rowCount();
			
			if($connection == 1)
			{
				$userinfo = $connect->fetch();
				$_SESSION['ID'] = $userinfo['ID'];
				$_SESSION['pseudo'] = $userinfo['pseudo'];
				$_SESSION['pass'] = $userinfo['pass'];
				$_SESSION['email'] = $userinfo['email'];
				$_SESSION['date_naissance'] = $userinfo['date_naissance'];
				$_SESSION['genre'] = $userinfo['genre'];
				$_SESSION['avatar'] = $userinfo['avatar'];
				$_SESSION['plandefond'] = $userinfo['plandefond'];
				$_SESSION['date_inscription'] = $userinfo['date_inscription'];
				$_SESSION['last_connexion'] = $userinfo['last_connexion'];
				$last_connexion = $db->prepare('UPDATE membres SET last_connexion = NOW(), adress_ip = ? WHERE ID = ?');
				$last_connexion->execute(array($_SERVER['REMOTE_ADDR'],$_SESSION['ID']));
				
			}
			else
			{
				$imageerreur = '<img id="imageerreur" src="images/erreur.png" alt="" title="Identifiant Incorrect" />';		
			}
		}
	}
?>
<style>
@media screen and (max-width: 1200px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 10px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -23%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 6.2%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 17.2%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 28%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 38.9%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1300px) and (max-height: 700px) and (min-width: 1200px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 10px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 4%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -23%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 10.1%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 28.1%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 46%;
		left: 35.6%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 63.9%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1300px) and (max-height: 800px) and (min-width: 1200px) and (min-height: 700px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 10px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -23%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 8.9%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 24.4%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 39.6%;
		left: 35.6%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 55%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1300px) and (max-height: 900px) and (min-width: 1200px) and (min-height: 800px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 10px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -23%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 7.8%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 21.8%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 31%;
		left: 35.6%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 49.6%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1300px) and (max-height: 1000px) and (min-width: 1200px) and (min-height: 900px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 10px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -23%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 6.9%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 19%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 31%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 43%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1300px) and (min-width: 1200px) and (min-height: 1000px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 10px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -23%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 6.2%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 17.2%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 28%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 38.9%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1400px) and (max-height: 800px) and (min-width: 1300px) and (min-height: 700px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 65px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 8.8%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 23.7%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 38.7%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 53.7%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1400px) and (max-height: 1000px) and (min-width: 1300px) and (min-height: 800px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 65px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 8%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 21.1%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 34.2%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 47.1%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1400px) and (max-height: 1100px) and (min-width: 1300px) and (min-height: 1000px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 65px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 6.5%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 17.8%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 29.1%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 40.3%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1500px) and (max-height: 1000px) and (min-width: 1400px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 100px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 8%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 20.8%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 34%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 47.2%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1500px) and (max-height: 1100px) and (min-width: 1400px) and (min-height: 1000px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 100px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 6.8%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 18.4%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 29.9%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 41.4%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1600px) and (max-height: 740px) and (min-width: 1500px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 140px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 10.3%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 27%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 43.5%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 60.3%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1600px) and (max-height: 850px) and (min-width: 1500px) and (min-height: 740px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 180px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 9.3%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 24.9%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 40.5%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 56%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1600px) and (min-width: 1500px) and (min-height: 850px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 190px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 8.4%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 22.4%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 36.4%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 50.3%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1700px) and (max-height: 1000px) and (min-width: 1600px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: 40px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 50px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 50px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 190px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 8.4%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 22.4%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 36.4%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 50.3%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1700px) and (max-height: 1100px) and (min-width: 1600px) and (min-height: 1000px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: -20px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 55px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 55px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 170px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 170px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 200px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 7.7%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 20%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 32.2%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 44.6%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 1850px) and (min-width: 1700px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: -20px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 55px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 55px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 170px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 170px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 250px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 8.1%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 21.2%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 34.2%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 47.1%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 2000px) and (max-height: 1100px) and (min-width: 1850px) and (min-height: 1000px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: -20px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 55px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 55px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 170px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 170px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 330px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 8.1%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 21.2%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 34.2%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 47.1%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (max-width: 2000px) and (max-height: 1200px) and (min-width: 1850px) and (min-height: 1100px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: -20px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 55px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 55px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 170px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 170px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 330px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 7.9%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 20.8%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 33.6%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 46.1%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}

@media screen and (min-width: 2000px) and (min-height: 1200px)
{
	#header
	{
		height: 0px;
		background-color: rgb(40,40,40);
		padding-left: 8px;
		padding-right: 8px;
		position: fixed;
		top: 0px;
		width: 100%;
		min-width: 1010px;
		margin: 0%;
		z-index: 10005;
		overflow: hidden;
	}
	
	nav
	{
		position: absolute;
		top: 0px;
		right: -20px;
		height: 120px;
		width: 62%;
		text-align: center;
	}
	
	nav ul
	{
		list-style-type: none;
		height: 120px;
		line-height: 90px;
		white-space: nowrap;
	}
	
	nav ul li
	{
		color: white;
		display: inline-block;
		width: 70px;
		height: 70px;
		line-height: 70px;
		text-align: center;
		font-weight: bold;
		font-size: 1.1em;
		font-family: Arial Black;
		margin-right: 5%;
		border: 2px solid transparent;
		
	}
	
	nav ul li:hover
	{
		border-radius: 50px;
		border: 2px solid white;
		background: white;
		color: black;
	}
	
	#icone_membre
	{
		position: absolute;
		top: 25px;
		right: 55px;
		cursor: pointer;
		width:50px;
		height:62px;
	}
	
	#icone_membre2
	{
		position: absolute;
		top: 22px;
		right: 55px;
		width: 75px;
		height: 75px;
		border-radius: 100px 100px 100px 100px;
		border: 2px solid white;
	}
	
	#connexion
	{
		height: 0px;
		overflow: hidden;
		width: 100%;
		position: fixed;
		top: 110px;
		background-color: rgb(40,40,40);
		z-index: 10000;
	}
	
	section hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
		background: rgb(30,30,30);
	}
	
	#imageerreur
	{
		position: absolute;
		top: 30%;
		left: 3%;
		width: 50px;
		height: 50px;
	}
	
	#pseudo
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 170px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#pseudoforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 170px;
		margin-top: 28px;
		margin-bottom: 31px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#mdp
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		display: inline-block;
		text-align: center;
		outline: none;
	}
	
	#mailforget
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 50px;
		width: 22%;
		margin-left: 130px;
		margin-right: 100px;
		font-size: 2.1em;
		font-family: 'Racing Sans One';
		color: rgb(20,20,20);
		text-align: center;
		outline: none;
		display: none;
	}
	
	#connexion form #boutonconnexion
	{
		color: white;
		cursor: pointer;
		background-color: rgb(40,40,40);
		border: 0px solid rgb(40,40,40);
		margin-right: 10px;
		font-size: 1.4em;
		font-family: Arial Black;
		display: inline-block;
		transition: all 0.6s;
		outline: none;
	}
	
	#inscription
	{
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	#boutonconnexionforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		margin-left: 330px;
		margin-right: 25px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#annulerforget
	{
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 13px;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
		display: none;
	}
	
	#mdpoublier
	{
		position: absolute;
		right: 104px;
		top: 58px;
		color: white;
		font-size: 1.4em;
		font-family: Arial Black;
		text-decoration: none;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
		transition: all 0.6s;
		outline: none;
		cursor: pointer;
	}
	
	.xhrforgetmdpspan
	{
		position: absolute;
		left: 355px;
		top: 38px;
		color: white;
		font-size: 1.5em;
		font-family: Arial Black;
		margin-bottom: 1px;
		margin-top: 1px;
		text-align: center;
	}
	
	#boutonconnexioninscrire
	{
		position: absolute;
		right: 90px;
		top: 20px;
	}
	
	#connexion #boutonconnexion:hover, #connexion #inscription:hover, #connexion #mdpoublier:hover
	{
		color: #656C80;
	}
	
	#boutonconnexionforget:hover, #annulerforget:hover
	{
		color: #656C80;
	}
	
	#inscrire
	{
		position: fixed;
		top: 110px;
		z-index: 10000;
		width: 100%;
		height: 0px;
		background-color: rgb(40,40,40);
		color: white;
		font-size: 1.4em;
		text-decoration: none;
		overflow: hidden;
	}
	
	#inscrire form
	{
		display: inline-block;
		margin-left: 7%;
		height: 95%;
		vertical-align: top;
		position: relative;
		width: 30%;
	}

	#nom
	{
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		margin-top: 15%;
		outline: none;
	}
	
	#pass, #pass2, #mail
	{
		margin-top: 15%;
		border: 2px solid rgb(37,37,37);
		border-radius: 3px;
		height: 53px;
		width: 90%;
		font-family: 'Racing Sans One';
		font-size: 1.6em;
		text-align: center;
		color: rgb(20,20,20);
		padding: 3px;
		outline: none;
	}
	
	#inscrire form div
	{
		white-space: nowrap;
		margin-top: 10%;
	}
	
	#condition
	{
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	#inscrire form label
	{
		display: inline-block;
		white-space: nowrap;
		font-size: 1.1em;
		vertical-align: 4px;
		cursor: pointer;
		font-family: 'Racing Sans One';
	}
	
	.barreboutonvalider
	{
		display: inline-block;
		width: 30%;
		border: 6px solid white;
		border-left: none;
		border-right: none;
		border-bottom: none;
		margin-left: 253%;
		margin-right: 0%;
		margin-top: -19%;
		padding-right: 30%;
		padding-left: 5%;
		transition: all 0.4s;
	}
	
	.barreboutonvalider:hover
	{
		border: 6px solid rgb(30,30,30);
		border-left: none;
		border-right: none;
		border-bottom: none;
	}
	
	#boutonvalider
	{
		display: inline-block;
		background: none;
		border: none;
		font-family:'Racing Sans One';
		font-size: 1.7em;
		color: white;
		cursor: pointer;
	}
	
	#info_inscription
	{
		display: inline-block;
		height: 40%;
		width: 55%;
		margin-left: 1%;
	}
	
	#info_inscription div
	{
		height: 40%;
	}
	
	.titreinfo_inscription
	{
		text-align: center;
		font-family: 'Racing sans One';
		font-size: 1.3em;
		margin-bottom: 3px;
	}
	
	#askselect,#info_pseudo,#info_pass,#info_conf,#info_mail,#info_box
	{
		width: 90%;
		height: 90%;
		line-height: 100%;
		margin-left: 5%;
		font-size: 1.75em;
		font-family: Cookie;
		text-align: left;
	}
	
	#imageerreur1
	{
		position: absolute;
		top: 7.6%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur2
	{
		position: absolute;
		top: 19.4%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur3
	{
		position: absolute;
		top: 31%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
	
	#imageerreur4
	{
		position: absolute;
		top: 42.7%;
		left: 1.3%;
		width: 50px;
		height: 50px;
	}
}
</style>
<header id="header">
	<a href="index.php"><img src="images/logo.png" Alt="Metro Manga" width="198" height="95" style="margin-top:10px;" /></a>
	<nav style="cursor:default;">
		<ul>
			<a style="cursor:default;" href="index.php"><li style="cursor:pointer;">Home</li></a>
			<a style="cursor:default;" href="anime.php"><li style="cursor:pointer;">Anime</li></a>
			<a style="cursor:default;" href="film.php"><li style="cursor:pointer;">Film</li></a>
			<a style="cursor:default;" href="forum.php"><li style="cursor:pointer;">Forum</li></a>
			<a style="cursor:default;" href="gallery.php"><li style="cursor:pointer;">Gallery</li></a>
		</ul>
	</nav>
	<?php
		if(isset($_SESSION['ID']))
		{
		?>
			<p><a href="profil.php"><img src="membre/avatar/<?php echo $_SESSION['avatar']; ?>" Alt="Avatar" id="icone_membre2" /></a></p>
		<?php
		}
		else
		{
			echo '<p><img src="images/membre.png" alt="Membre" id="icone_membre" /></p>';
			?>
			<script>
				document.querySelector("#icone_membre").onclick = function() 
				{ 	
					if (window.getComputedStyle(document.querySelector('#inscrire')).height=='100%' || window.getComputedStyle(document.querySelector('#connexion')).height=='0px')
					{
						document.querySelector("#inscrire").style.height="0px";
						document.querySelector("#inscrire").style.transition="height 900ms ease-out";
						document.querySelector("#connexion").style.height="110px";
						document.querySelector("#connexion").style.transition="height 600ms ease-out";
					}
					else
					{
						document.querySelector("#connexion").style.height="0px";
						document.querySelector("#connexion").style.transition="height 600ms ease-out";
					}
				}
			</script>
			<?php
		}
	?>
</header>

	<section id="connexion">
	<hr />
		<form method="post" action="">
			<?php
				if(isset($imageerreur))
				{
				?>
					<style>
						#connexion
						{
							height: 110px;
						}
					</style>
				<?php
				echo $imageerreur;
				}
			?>
			<input id="pseudo" name="pseudo" type="text" placeholder="Pseudo" minlength="3" maxlength="30" required />
			<input id="mdp" name="mdp" placeholder="Mot de passe" type="password" minlength="5" required />
			<span id="xhrforgetmdp" ></span>
			<input id="pseudoforget" type="text" placeholder="Pseudo" title="Entrer votre pseudo pour récupérer votre mot de passe" autocomplete="off" maxlength="30"  />
			<input id="mailforget" placeholder="E-mail" type="mail" title="Entrer votre e-mail pour récupérer votre mot de passe"  />
			<div id="boutonconnexioninscrire">
				<input type="submit" value="Connexion" id="boutonconnexion" name="boutonconnexion" />
				<span id="inscription">Inscription</span>
			</div>
				<span id="mdpoublier">Mot de passe oublié</span>
				<span id="boutonconnexionforget" onclick="forgetmdp()">Valider</span>
				<span id="annulerforget">Annuler</span>
		</form>
	</section>
	<section id="inscrire">
		<hr />
		<?php
			if(isset($imageerreur1))
			{
				echo $imageerreur1;
			?>
				<style>
					#inscrire
					{
						height: 100%;
					}
				</style>
			<?php
			}
			else if(isset($imageerreur2))
			{
				echo $imageerreur2;
			?>
				<style>
					#inscrire
					{
						height: 100%;
					}
				</style>
			<?php
			}
			else if(isset($imageerreur3))
			{
				echo $imageerreur3;
			?>
				<style>
					#inscrire
					{
						height: 100%;
					}
				</style>
			<?php
			}
			else if(isset($imageerreur4))
			{
				echo $imageerreur4;
			?>
				<style>
					#inscrire
					{
						height: 100%;
					}
				</style>
			<?php
			}
		?>
		<form method="post" action="">
			<input id="nom" name="nom" type="text" placeholder="Pseudo" autocomplete="off" minlength="3" maxlength="30" required />
			<input id="pass" name="pass" placeholder="Mot de passe" type="password" minlength="5" required />
			<input id="pass2" name="pass2" placeholder="Confirmation" type="password" minlength="5" required />
			<input id="mail" type="email" name="mail" placeholder="Votre adresse mail" autocomplete="off" required />
			<div id="checkbox">
				<input id="condition" name="condition" type="checkbox" required />
				<label class="labelcondition" for="condition">En cochant cette case, je m'engage à respecter les conditions d'utilisation de <i>Metro Manga</i></label>
			</div>
			<fieldset class="barreboutonvalider">
				<legend><input type="submit" value="Valider" id="boutonvalider" name="inscrire" style="outline:0;" /></legend>
			</fieldset>
		</form>
		<article id="info_inscription">
			<p class="titreinfo_inscription">Informations</p>
			<hr />
			<div>
				<p id="askselect" style="text-align:center;">Veuillez remplir le formulaire d'inscription.</p>
				<p id="info_pseudo" style="display:none;">Saisissez un pseudo de 3 à 30 caractères, il permettra de vous identifier sur le site.</p>
				<p id="info_pass" style="display:none;">Saisissez un mot de passe d'au minimum 5 caractères pour sécuriser votre compte.</p>
				<p id="info_conf" style="display:none;text-align:center;">Saisissez à nouveau votre mot de passe à l'identique.</p>
				<p id="info_mail" style="display:none;">Saisissez une adresse e-mail valide et accessible pour recevoir un mail de la part de Metro Manga en cas d'oubli de votre mot de passe.</p>
				<p id="info_box" style="display:none;">Vous venez de cocher la case, ce qui signifie que vous vous engagez à avoir un comportement adéquat sur le site.<br/> En cas de non-respect des règles, votre compte sera suspendu en conséquence.</p>
			</div>
		</article>
	</section>
	<script>
	
		function forgetmdp()
		{
			var xhr = new XMLHttpRequest();
			var pseudo = document.getElementById('pseudoforget').value;
			var mail = document.getElementById('mailforget').value;
						
			var pseudo = encodeURIComponent(pseudo);
			var mail = encodeURIComponent(mail);
			
			xhr.open('GET', 'site/phpheader.php?forgetmdp=' +  pseudo + '&mail=' + mail);
			
			xhr.onreadystatechange = function() 
			{
				if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
				{
					document.querySelector('#xhrforgetmdp').innerHTML = xhr.responseText;
					verifxhrforgetmdp()
				}
			};
			
			xhr.send(null);
		}
		
		function verifxhrforgetmdp()
		{
			if(document.querySelector('#xhrforgetmdp').innerHTML=="<span class=\"xhrforgetmdpspan\">OK</span>")
			{
				document.querySelector("#boutonconnexionforget").style.display="none";
				document.querySelector("#annulerforget").style.display="none";
				document.querySelector("#pseudoforget").style.display="none";
				document.querySelector("#mailforget").style.display="none";
				document.querySelector('.xhrforgetmdpspan').innerHTML = "Un e-mail vous a été envoyé pour récupérer votre mot de passe";
				setTimeout(finishforgetmdp, 8000);
			}
		}
		
		function finishforgetmdp()
		{
			document.querySelector("#xhrforgetmdp").style.display="none";
			document.querySelector("#boutonconnexion").style.display="inline-block";
			document.querySelector("#inscription").style.display="inline-block";
			document.querySelector("#mdpoublier").style.display="block";
			document.querySelector("#pseudo").style.display="inline-block";
			document.querySelector("#mdp").style.display="inline-block";
		}
	
		document.querySelector("#mdpoublier").onclick = function() 
		{ 
			if (window.getComputedStyle(document.querySelector('#boutonconnexionforget')).display=='none')
			{
				document.querySelector("#boutonconnexion").style.display="none";
				document.querySelector("#inscription").style.display="none";
				document.querySelector("#mdpoublier").style.display="none";
				document.querySelector("#pseudo").style.display="none";
				document.querySelector("#mdp").style.display="none";
				document.querySelector("#boutonconnexionforget").style.display="inline-block";
				document.querySelector("#annulerforget").style.display="inline-block";
				document.querySelector("#pseudoforget").style.display="inline-block";
				document.querySelector("#mailforget").style.display="inline-block";
			}
			else
			{
				document.querySelector("#boutonconnexion").style.display="none";
				document.querySelector("#inscription").style.display="none";
				document.querySelector("#mdpoublier").style.display="none";
				document.querySelector("#pseudo").style.display="none";
				document.querySelector("#mdp").style.display="none";
				document.querySelector("#boutonconnexionforget").style.display="inline-block";
				document.querySelector("#annulerforget").style.display="inline-block";
				document.querySelector("#pseudoforget").style.display="inline-block";
				document.querySelector("#mailforget").style.display="inline-block";
			}
		}
		
		document.querySelector("#annulerforget").onclick = function() 
		{ 
			if (window.getComputedStyle(document.querySelector('#mdpoublier')).display=='none')
			{
				document.querySelector("#boutonconnexionforget").style.display="none";
				document.querySelector("#annulerforget").style.display="none";
				document.querySelector("#pseudoforget").style.display="none";
				document.querySelector("#mailforget").style.display="none";
				document.querySelector("#boutonconnexion").style.display="inline-block";
				document.querySelector("#inscription").style.display="inline-block";
				document.querySelector("#mdpoublier").style.display="block";
				document.querySelector("#pseudo").style.display="inline-block";
				document.querySelector("#mdp").style.display="inline-block";
			}
			else
			{
				document.querySelector("#boutonconnexionforget").style.display="none";
				document.querySelector("#annulerforget").style.display="none";
				document.querySelector("#pseudoforget").style.display="none";
				document.querySelector("#mailforget").style.display="none";
				document.querySelector("#boutonconnexion").style.display="inline-block";
				document.querySelector("#inscription").style.display="inline-block";
				document.querySelector("#mdpoublier").style.display="block";
				document.querySelector("#pseudo").style.display="inline-block";
				document.querySelector("#mdp").style.display="inline-block";
			}
		}
		
		document.querySelector("#inscription").onclick = function() 
		{ 
			if (window.getComputedStyle(document.querySelector('#inscrire')).height=='0px')
			{
				document.querySelector("#connexion").style.height="0px";
				document.querySelector("#connexion").style.transition="height 600ms ease-out";
				document.querySelector("#inscrire").style.height="100%";
				document.querySelector("#inscrire").style.transition="height 900ms ease-out";
			}
			else
			{
				document.querySelector("#connexion").style.height="110px";
				document.querySelector("#connexion").style.transition="height 600ms ease-out";
				document.querySelector("#inscrire").style.height="0px";
				document.querySelector("#inscrire").style.transition="height 900ms ease-out";
			}
		}
		
		document.querySelector("#nom").onfocus = function() 
		{ 
			if (window.getComputedStyle(document.querySelector('#info_pseudo')).display=='none')
			{
				document.querySelector("#info_pseudo").style.display="block";
				document.querySelector("#info_pass").style.display="none";
				document.querySelector("#info_conf").style.display="none";
				document.querySelector("#info_mail").style.display="none";
				document.querySelector("#askselect").style.display="none";
				document.querySelector("#info_box").style.display="none";
			}
			
		}
		
		document.querySelector("#pass").onfocus = function() 
		{ 
			if (window.getComputedStyle(document.querySelector('#info_pass')).display=='none')
			{
				document.querySelector("#info_pass").style.display="block";
				document.querySelector("#info_pseudo").style.display="none";
				document.querySelector("#info_conf").style.display="none";
				document.querySelector("#info_mail").style.display="none";
				document.querySelector("#askselect").style.display="none";
				document.querySelector("#info_box").style.display="none";
			}
		}
		
		document.querySelector("#pass2").onfocus = function() 
		{ 
			if (window.getComputedStyle(document.querySelector('#info_conf')).display=='none')
			{
				document.querySelector("#info_conf").style.display="block";
				document.querySelector("#info_pseudo").style.display="none";
				document.querySelector("#info_pass").style.display="none";
				document.querySelector("#info_mail").style.display="none";
				document.querySelector("#askselect").style.display="none";
				document.querySelector("#info_box").style.display="none";
			}
		}
		
		document.querySelector("#mail").onfocus = function() 
		{ 
			if (window.getComputedStyle(document.querySelector('#info_mail')).display=='none')
			{
				document.querySelector("#info_mail").style.display="block";
				document.querySelector("#info_pseudo").style.display="none";
				document.querySelector("#info_pass").style.display="none";
				document.querySelector("#info_conf").style.display="none";
				document.querySelector("#askselect").style.display="none";
				document.querySelector("#info_box").style.display="none";
			}
		}
		
		document.querySelector("#checkbox").onclick = function() 
		{ 
			if (document.getElementById('condition').checked)
			{
				document.querySelector("#info_box").style.display="block";
				document.querySelector("#info_mail").style.display="none";
				document.querySelector("#info_pseudo").style.display="none";
				document.querySelector("#info_pass").style.display="none";
				document.querySelector("#info_conf").style.display="none";
				document.querySelector("#askselect").style.display="none";
			}
			else
			{
				document.querySelector("#info_box").style.display="none";
				document.querySelector("#askselect").style.display="block";
			}
		}
	</script>