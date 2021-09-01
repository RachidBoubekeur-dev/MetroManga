<?php session_start(); ?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<link rel="stylesheet" href="administration.css" />
		<script src="//cdn.ckeditor.com/4.5.2/full/ckeditor.js"></script>
		<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css" />
		<link href='../css/Racing.css' rel='stylesheet' type='text/css'>
		<link href='../css/Cookie.css' rel='stylesheet' type='text/css'>
		<link href='../css/Raleway.css' rel='stylesheet' type='text/css'>
		<script src="../js/jquery.min.js"></script>
		<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script>
			(function($){
				$(window).on("load",function(){
					$("body").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".blockmodifieradmin").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".contenumodifieradmin").mCustomScrollbar({
						theme:"inset-3"
					});
				});
			})(jQuery);
		</script>
		<title>Administration - Metro Manga </title>
	</head>
	<body id="body">
		<?php include("includes/loading.php"); ?>
		<?php include("includes/header.php"); ?>
		<div id="contenuloading">
		<?php
		if(isset($_SESSION['ID']))
		{
			if($_SESSION['ID'] == '1')
			{
			?>
			<div class="contenuadmin">
				<hr class="hradmin" />
				<?php
				if(isset($_POST['adminvalider']))
				{
					if($_POST['identifiantadmin'] == ' ')
					{
						if($_POST['mdpadmin'] == ' ')
						{
						?>
							<style>
								.blockidentifiantadmin
								{
									display: none;
								}
								
								.hradmin
								{
									display: none;
								}
								
								#contenuadministration
								{
									display: block;
								}
							</style>
						<?php
						}
						else
						{
							$erreur = "<span class=\"blockidentifiantadminerreur\">Identifiant ou mot de passe incorrecte.</span>";
						}
					}
					else
					{
						$erreur = "<span class=\"blockidentifiantadminerreur\">Identifiant ou mot de passe incorrecte.</span>";
					}
				}
				?>
				<div class="blockidentifiantadmin">
					<img src="../images/administration.png" alt="" class="blockidentifiantadminimg" />
					<span class="blockidentifiantadmintitre">Administration</span>
					<img src="../images/administration.png" alt="" class="blockidentifiantadminimg" />
					<hr class="blockidentifianthradmin" />
					<?php
					if(isset($erreur))
					{
					?>
						<style>
							#body
							{
								padding-top: 109px;
								margin-top: 0px;
							}
							
							#header
							{
								height: 110px;
							}
							
							#contenuloading
							{
								opacity: 1;
							}
							
							#imgloading
							{
								width: 0px;
							}
							
							#imgloading2
							{
								width: 0px;
							}
							
							#imgloading3
							{
								width: 0px;
							}
							
							#imgloading4
							{
								width: 0px;
							}
							
							#spanloading
							{
								display: none;
							}
							
							#loading
							{
								width: 0px;
							}
						</style>	
					<?php
						echo $erreur;
					}
					?>
					<form method="post" action="">
						<input class="identifiantadmin" name="identifiantadmin" type="password" placeholder="Identifiant" required />
						<input class="mdpadmin" name="mdpadmin" type="password" placeholder="Mot de passe" required />
						<fieldset class="adminvaliderbarre">
							<legend><input type="submit" value="Valider" class="adminvalider" name="adminvalider" /></legend>
						</fieldset>
					</form>
				</div>
				<div id="contenuadministration">
				<?php
					if(isset($_POST['modifieradminanime1valider']))
					{
						$IDmembre = $_SESSION['ID'];
						$titre = htmlspecialchars($_POST['modifieradminanime1titre']);
						$searchtitreexist = $db->query('SELECT titre FROM animes WHERE titre=\'' . $titre . '\'');
						$titreexist = $searchtitreexist->rowCount();
						if($titreexist == 0)
						{
							$image = $_FILES['modifieradminanime1img']['size'];
							$lettre = htmlspecialchars($_POST['modifieradminanime1lettre']);
							$annee = htmlspecialchars($_POST['modifieradminanime1date']);
							$auteur = htmlspecialchars($_POST['modifieradminanime1auteur']);
							if(isset($_POST['modifieradminanime1genreaction']))
							{
								$genreaction = htmlspecialchars($_POST['modifieradminanime1genreaction']);
							}
							else
							{
								$genreaction = "null";
							}
							
							if(isset($_POST['modifieradminanime1genreaventure']))
							{
								$genreaventure = htmlspecialchars($_POST['modifieradminanime1genreaventure']);
							}
							else
							{
								$genreaventure = "null";
							}
							
							if(isset($_POST['modifieradminanime1genreamitier']))
							{
								$genreamitier = htmlspecialchars($_POST['modifieradminanime1genreamitier']);
							}
							else
							{
								$genreamitier = "null";
							}
							
							if(isset($_POST['modifieradminanime1genrecomedie']))
							{
								$genrecomedie = htmlspecialchars($_POST['modifieradminanime1genrecomedie']);
							}
							else
							{
								$genrecomedie = "null";
							}
							
							if(isset($_POST['modifieradminanime1genredrame']))
							{
								$genredrame = htmlspecialchars($_POST['modifieradminanime1genredrame']);
							}
							else
							{
								$genredrame = "null";
							}
							
							if(isset($_POST['modifieradminanime1genrefantastique']))
							{
								$genrefantastique = htmlspecialchars($_POST['modifieradminanime1genrefantastique']);
							}
							else
							{
								$genrefantastique = "null";
							}
							
							if(isset($_POST['modifieradminanime1genreguerre']))
							{
								$genreguerre = htmlspecialchars($_POST['modifieradminanime1genreguerre']);
							}
							else
							{
								$genreguerre = "null";
							}
							
							if(isset($_POST['modifieradminanime1genrecyber']))
							{
								$genrecyber = htmlspecialchars($_POST['modifieradminanime1genrecyber']);
							}
							else
							{
								$genrecyber = "null";
							}
							
							if(isset($_POST['modifieradminanime1genremecha']))
							{
								$genremecha = htmlspecialchars($_POST['modifieradminanime1genremecha']);
							}
							else
							{
								$genremecha = "null";
							}
							
							if(isset($_POST['modifieradminanime1genresport']))
							{
								$genresport = htmlspecialchars($_POST['modifieradminanime1genresport']);
							}
							else
							{
								$genresport = "null";
							}
							
							if(isset($_POST['modifieradminanime1genrehorreur']))
							{
								$genrehorreur = htmlspecialchars($_POST['modifieradminanime1genrehorreur']);
							}
							else
							{
								$genrehorreur = "null";
							}
							$synopsis = htmlspecialchars($_POST['modifieradminanime1synopsis']);
							$bandeannonce = htmlspecialchars($_POST['modifieradminanime1bandeannonce']);
							
							$extension = strtolower(substr(strrchr($_FILES['modifieradminanime1img']['name'], '.'),1));
							$perm_ext = array('jpg','jpeg','png');
							if(in_array($extension,$perm_ext))
							{
								$nomimage = $_FILES['modifieradminanime1img']['name'];
								$chemin = "../anime/".$_FILES['modifieradminanime1img']['name'];
								move_uploaded_file($_FILES['modifieradminanime1img']['tmp_name'],$chemin);
								$ajouteranime = $db->prepare('INSERT INTO animes(IDmembre,titre,image,lettre,annee,auteur,action,aventure,amitier,comedie,drame,fantastique,guerre,cyber,mecha,sport,horreur,synopsis,bandeannonce,note,date) VALUES (:IDmembre,:titre,:image,:lettre,:annee,:auteur,:action,:aventure,:amitier,:comedie,:drame,:fantastique,:guerre,:cyber,:mecha,:sport,:horreur,:synopsis,:bandeannonce,:note,NOW())');
								$ajouteranime->execute(array(
								'IDmembre' => $IDmembre,
								'titre' => $titre,
								'image' => $nomimage,
								'lettre' => $lettre,
								'annee' => $annee,
								'auteur' => $auteur,
								'action' => $genreaction,
								'aventure' => $genreaventure,
								'amitier' => $genreamitier,
								'comedie' => $genrecomedie,
								'drame' => $genredrame,
								'fantastique' => $genrefantastique,
								'guerre' => $genreguerre,
								'cyber' => $genrecyber,
								'mecha' => $genremecha,
								'sport' => $genresport,
								'horreur' => $genrehorreur,
								'synopsis' => $synopsis,
								'bandeannonce' => $bandeannonce,
								'note' => null
								));
								
								$erroranime1 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Animé ajouter.\" />";
								
								?>	
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime1
									{
										right: 35.6%;
									}
								</style>
								<?php
							}
							else
							{
								$erroranime1 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime1
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
							$erroranime1 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce titre n'est pas disponible.\" />";
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime1
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime2validermodifiertitre']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime2titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							if($_POST['modifieradminanime2modifiertitre'] !== "")
							{
								$modifiertitre = htmlspecialchars($_POST['modifieradminanime2modifiertitre']);
								
								$modifierfilm = $db->prepare('UPDATE animes SET titre = :modifiertitre WHERE titre = :titre');
								$modifierfilm->execute(array(
								'modifiertitre' => $modifiertitre,
								'titre' => $titre
								));
								
								$erroranime2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Titre modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le titre.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime2validerlettre']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime2titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							if($_POST['modifieradminanime2lettre'] !== "")
							{
								$lettre = htmlspecialchars($_POST['modifieradminanime2lettre']);
								
								$modifieranime = $db->prepare('UPDATE animes SET lettre = :lettre WHERE titre = :titre');
								$modifieranime->execute(array(
								'lettre' => $lettre,
								'titre' => $titre
								));
								
								$erroranime2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Premier caractère modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le premier caractère.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime2validerimg']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime2titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{	
							$taille = $_FILES['modifieradminanime2img']['size'];
							if($taille >= 1)
							{
								$extension = strtolower(substr(strrchr($_FILES['modifieradminanime2img']['name'], '.'),1));
								$perm_ext = array('jpg','jpeg','png');
								if(in_array($extension,$perm_ext))
								{
									$selectimg = $db->query('SELECT * FROM animes WHERE titre =\'' . $titre . '\'');
									$imganime = $selectimg->fetch();
									
									@unlink("../anime/" . $imganime['image']);
									
									$image = $_FILES['modifieradminanime2img']['size'];
									$nomimage = $_FILES['modifieradminanime2img']['name'];
									$chemin = "../anime/".$_FILES['modifieradminanime2img']['name'];
									move_uploaded_file($_FILES['modifieradminanime2img']['tmp_name'],$chemin);
									
									$modifieranime = $db->prepare('UPDATE animes SET image = :image WHERE titre = :titre');
									$modifieranime->execute(array(
									'image' => $nomimage,
									'titre' => $titre
									));
									
									$erroranime2 = "<img src=\"../images/validate.png\" alt=\"error\" class=\"resultatmodificationimg2\" title=\"Image modifier.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime2
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
									
									$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime2
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
								
								$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas sélectionner d\'image.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
							
							$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime2validerdate']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime2titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							if($_POST['modifieradminanime2date'] !== "")
							{
								$annee = htmlspecialchars($_POST['modifieradminanime2date']);
								
								$modifieranime = $db->prepare('UPDATE animes SET annee = :annee WHERE titre = :titre');
								$modifieranime->execute(array(
								'annee' => $annee,
								'titre' => $titre
								));
								
									$erroranime2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Année modifier.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier l\'année.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime2validerauteur']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime2titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							if($_POST['modifieradminanime2auteur'] !== "")
							{
								$auteur = htmlspecialchars($_POST['modifieradminanime2auteur']);
								
								$modifieranime = $db->prepare('UPDATE animes SET auteur = :auteur WHERE titre = :titre');
								$modifieranime->execute(array(
								'auteur' => $auteur,
								'titre' => $titre
								));
								
								$erroranime2 = "<img src=\"../images/validate.png\" alt=\"vallider\" class=\"resultatmodificationimg2\" title=\"Auteur modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier l\'auteur.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime2validergenre']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime2titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							if(isset($_POST['modifieradminanime2genreaction']))
							{
								$genreaction = htmlspecialchars($_POST['modifieradminanime2genreaction']);
							}
							else
							{
								$genreaction = "null";
							}
							
							if(isset($_POST['modifieradminanime2genreaventure']))
							{
								$genreaventure = htmlspecialchars($_POST['modifieradminanime2genreaventure']);
							}
							else
							{
								$genreaventure = "null";
							}
							
							if(isset($_POST['modifieradminanime2genreamitier']))
							{
								$genreamitier = htmlspecialchars($_POST['modifieradminanime2genreamitier']);
							}
							else
							{
								$genreamitier = "null";
							}
							
							if(isset($_POST['modifieradminanime2genrecomedie']))
							{
								$genrecomedie = htmlspecialchars($_POST['modifieradminanime2genrecomedie']);
							}
							else
							{
								$genrecomedie = "null";
							}
							
							if(isset($_POST['modifieradminanime2genredrame']))
							{
								$genredrame = htmlspecialchars($_POST['modifieradminanime2genredrame']);
							}
							else
							{
								$genredrame = "null";
							}
							
							if(isset($_POST['modifieradminanime2genrefantastique']))
							{
								$genrefantastique = htmlspecialchars($_POST['modifieradminanime2genrefantastique']);
							}
							else
							{
								$genrefantastique = "null";
							}
							
							if(isset($_POST['modifieradminanime2genreguerre']))
							{
								$genreguerre = htmlspecialchars($_POST['modifieradminanime2genreguerre']);
							}
							else
							{
								$genreguerre = "null";
							}
							
							if(isset($_POST['modifieradminanime2genrecyber']))
							{
								$genrecyber = htmlspecialchars($_POST['modifieradminanime2genrecyber']);
							}
							else
							{
								$genrecyber = "null";
							}
							
							if(isset($_POST['modifieradminanime2genremecha']))
							{
								$genremecha = htmlspecialchars($_POST['modifieradminanime2genremecha']);
							}
							else
							{
								$genremecha = "null";
							}
							
							if(isset($_POST['modifieradminanime2genresport']))
							{
								$genresport = htmlspecialchars($_POST['modifieradminanime2genresport']);
							}
							else
							{
								$genresport = "null";
							}
							
							if(isset($_POST['modifieradminanime2genrehorreur']))
							{
								$genrehorreur = htmlspecialchars($_POST['modifieradminanime2genrehorreur']);
							}
							else
							{
								$genrehorreur = "null";
							}
							
							$modifieranime = $db->prepare('UPDATE animes SET action = :action, aventure = :aventure, amitier = :amitier, comedie = :comedie, drame = :drame, fantastique = :fantastique, guerre = :guerre, cyber = :cyber, mecha = :mecha, sport = :sport, horreur = :horreur WHERE titre = :titre');
							$modifieranime->execute(array(
							'action' => $genreaction,
							'aventure' => $genreaventure,
							'amitier' => $genreamitier,
							'comedie' => $genrecomedie,
							'drame' => $genredrame,
							'fantastique' => $genrefantastique,
							'guerre' => $genreguerre,
							'cyber' => $genrecyber,
							'mecha' => $genremecha,
							'sport' => $genresport,
							'horreur' => $genrehorreur,
							'titre' => $titre
							));
							
								
								$erroranime2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Genre modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						else
						{
							
							$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime2validersynopsis']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime2titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							if($_POST['modifieradminanime2synopsis'] !== "")
							{
								$synopsis = htmlspecialchars($_POST['modifieradminanime2synopsis']);
								
								$modifieranime = $db->prepare('UPDATE animes SET synopsis = :synopsis WHERE titre = :titre');
								$modifieranime->execute(array(
								'synopsis' => $synopsis,
								'titre' => $titre
								));
								
								$erroranime2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Synopsis modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier synopsis.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime2validerbandeannonce']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime2titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							if($_POST['modifieradminanime2bandeannonce'] !== "")
							{
								$bandeannonce = htmlspecialchars($_POST['modifieradminanime2bandeannonce']);
								
								$modifieranime = $db->prepare('UPDATE animes SET bandeannonce = :bandeannonce WHERE titre = :titre');
								$modifieranime->execute(array(
								'bandeannonce' => $bandeannonce,
								'titre' => $titre
								));
								
									$erroranime2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Bande annonce modifier.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la bande annonce.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$erroranime2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime3validerajouterepisode']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime3titre']);
						$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidanimeexist->execute(array($titre));
						$idanimeexist = $searchidanimeexist->fetch();
						$idanime = $idanimeexist['ID'];
						$numeroepisode = htmlspecialchars($_POST['modifieradminanime3numeroepisode']);
						$searchnumeroepisodeexist = $db->prepare('SELECT numero FROM episodes WHERE IDanime = ? AND numero = ?');
						$searchnumeroepisodeexist->execute(array($idanime,$numeroepisode));
						$numeroepisodeexist = $searchnumeroepisodeexist->rowCount();
						if($numeroepisodeexist >= 1)
						{
							
							$erroranime3 = '<img src=\'../images/supprimerrecherche.png\' alt=\'error\' class=\'resultatmodificationimg\' title=\'Cette épisode existe déjà dans l\'animé ' . $titre . '.\' />';
							
						?>
						<style>
							#body
							{
								padding-top: 109px;
								margin-top: 0px;
							}
							#header
							{
								height: 110px;
							}
							#contenuloading
							{
								opacity: 1;
							}
							#imgloading
							{
								width: 0px;
							}
							#imgloading2
							{
								width: 0px;
							}
							#imgloading3
							{
								width: 0px;
							}
							#imgloading4
							{
								width: 0px;
							}
							#spanloading
							{
								display: none;
							}
							#loading
							{
								width: 0px;
							}
							.contenuadmin
							{
								background: rgb(30,30,30);
							}
							.blockidentifiantadmin
							{
								display: none;
							}
							.hradmin
							{
								display: none;
							}
							#contenuadministration
							{
								display: block;
							}
							#blockadmin
							{
								display: none;
							}
							#contenublockadminanime
							{
								display: block;
							}
							#contenumodifieradminanime3
							{
								right: 35.6%;
							}
						</style>
						<?php
						}
						else
						{
							$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
							$searchanimeexist->execute(array($titre));
							$animeexist = $searchanimeexist->rowCount();
							if($animeexist == 1)
							{
								$saison = htmlspecialchars($_POST['modifieradminanime3saison']);
								$IDmembre = $_SESSION['ID'];
								$titreepisode = htmlspecialchars($_POST['modifieradminanime3titreepisode']);
								$videovostfr = htmlspecialchars($_POST['modifieradminanime3videovostfr']);
								if(isset($_POST['modifieradminanime3videovf']))
								{
									$videovf = htmlspecialchars($_POST['modifieradminanime3videovf']);
								}
								else
								{
									$videovf = "";
								}
								
								$ajouterepisode = $db->prepare('INSERT INTO episodes(IDanime,IDsaison,IDmembre,numero,titre,videovf,videovostfr,date) VALUES (:IDanime,:IDsaison,:IDmembre,:numero,:titre,:videovf,:videovostfr,NOW())');
								$ajouterepisode->execute(array(
								'IDanime' => $idanime,
								'IDsaison' => $saison,
								'IDmembre' => $IDmembre,
								'numero' => $numeroepisode,
								'titre' => $titreepisode,
								'videovf' => $videovf,
								'videovostfr' => $videovostfr
								));
								
									$erroranime3 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Épisode ajouter.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime3
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime3 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime3
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
					}
					
					if(isset($_POST['modifieradminanime4inputmodifiersaison']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime4titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
							$searchidanimeexist->execute(array($titre));
							$idanimeexist = $searchidanimeexist->fetch();
							$IDanime = $idanimeexist['ID'];
							$saison =  htmlspecialchars($_POST['modifieradminanime4saison']);
							$searchsaisonexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND IDsaison = ?');
							$searchsaisonexist->execute(array($IDanime,$saison));
							$saisonexist = $searchsaisonexist->rowCount();
							if($saisonexist >= 1)
							{
								$numeroepisode =  htmlspecialchars($_POST['modifieradminanime4numeroepisode']);
								$searchnumeroepisodeexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND numero = ?');
								$searchnumeroepisodeexist->execute(array($IDanime,$numeroepisode));
								$numeroepisodeexist = $searchnumeroepisodeexist->rowCount();
								if($numeroepisodeexist == 1)
								{
								
									if($_POST['modifieradminanime4modifiersaison'] !== "")
									{
										$IDanime = $idanimeexist['ID'];
										$modifiersaison = htmlspecialchars($_POST['modifieradminanime4modifiersaison']);
										$searchsaisonexist2 = $db->prepare('SELECT * FROM saison WHERE IDanime = ? AND IDsaison = ?');
										$searchsaisonexist2->execute(array($IDanime,$modifiersaison));
										$saisonexist = $searchsaisonexist->rowCount();
										if($saisonexist >= 1)
										{
											$modifierepisode = $db->prepare('UPDATE episodes SET IDsaison = :modifiersaison WHERE IDanime = :IDanime AND numero = :numeroepisode');
											$modifierepisode->execute(array(
											'modifiersaison' => $modifiersaison,
											'IDanime' => $IDanime,
											'numeroepisode' => $numeroepisode
											));
										
											$erroranime4 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Saison modifier.\" />";
							
										?>
											<style>
												#body
												{
													padding-top: 109px;
													margin-top: 0px;
												}
												#header
												{
													height: 110px;
												}
												#contenuloading
												{
													opacity: 1;
												}
												#imgloading
												{
													width: 0px;
												}
												#imgloading2
												{
													width: 0px;
												}
												#imgloading3
												{
													width: 0px;
												}
												#imgloading4
												{
													width: 0px;
												}
												#spanloading
												{
													display: none;
												}
												#loading
												{
													width: 0px;
												}
												.contenuadmin
												{
													background: rgb(30,30,30);
												}
												.blockidentifiantadmin
												{
													display: none;
												}
												.hradmin
												{
													display: none;
												}
												#contenuadministration
												{
													display: block;
												}
												#blockadmin
												{
													display: none;
												}
												#contenublockadminanime
												{
													display: block;
												}
												#contenumodifieradminanime4
												{
													right: 35.6%;
												}
											</style>
										<?php
										}
										else
										{
										
											$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette saison n'existe pas.\" />";
							
										?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime4
											{
												right: 35.6%;
											}
										</style>
										<?php
										}
									}
									else
									{
									
										$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la saison.\" />";
							
									?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime4
										{
											right: 35.6%;
										}
									</style>
									<?php
									}
								}
								else
								{
								
									$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette épisode n'existe pas.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime4
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
							
								$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette saison n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime4
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime4
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime4inputmodifiernumero']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime4titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
							$searchidanimeexist->execute(array($titre));
							$idanimeexist = $searchidanimeexist->fetch();
							$IDanime = $idanimeexist['ID'];
							$saison =  htmlspecialchars($_POST['modifieradminanime4saison']);
							$searchsaisonexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND IDsaison = ?');
							$searchsaisonexist->execute(array($IDanime,$saison));
							$saisonexist = $searchsaisonexist->rowCount();
							if($saisonexist >= 1)
							{
								$numeroepisode =  htmlspecialchars($_POST['modifieradminanime4numeroepisode']);
								$searchnumeroepisodeexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND numero = ?');
								$searchnumeroepisodeexist->execute(array($IDanime,$numeroepisode));
								$numeroepisodeexist = $searchnumeroepisodeexist->rowCount();
								if($numeroepisodeexist == 1)
								{
								
									if($_POST['modifieradminanime4modifiernumeroepisode'] !== "")
									{
										$modifiernumeroepisode = htmlspecialchars($_POST['modifieradminanime4modifiernumeroepisode']);
										$modifiernumero = $db->prepare('UPDATE episodes SET numero = :modifiernumeroepisode WHERE IDanime = :IDanime AND numero = :numeroepisode');
										$modifiernumero->execute(array(
										'modifiernumeroepisode' => $modifiernumeroepisode,
										'IDanime' => $IDanime,
										'numeroepisode' => $numeroepisode
										));
									
											$erroranime4 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Numéro modifier.\" />";
							
										?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime4
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
									
										$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le numéro de l\'épisode.\" />";
							
									?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime4
										{
											right: 35.6%;
										}
									</style>
									<?php
									}
								}
								else
								{
								
									$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette épisode n'existe pas.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime4
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
							
								$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette saison n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime4
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime4
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime4inputmodifiertitreepisode']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime4titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
							$searchidanimeexist->execute(array($titre));
							$idanimeexist = $searchidanimeexist->fetch();
							$IDanime = $idanimeexist['ID'];
							$saison =  htmlspecialchars($_POST['modifieradminanime4saison']);
							$searchsaisonexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND IDsaison = ?');
							$searchsaisonexist->execute(array($IDanime,$saison));
							$saisonexist = $searchsaisonexist->rowCount();
							if($saisonexist >= 1)
							{
								$numeroepisode =  htmlspecialchars($_POST['modifieradminanime4numeroepisode']);
								$searchnumeroepisodeexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND numero = ?');
								$searchnumeroepisodeexist->execute(array($IDanime,$numeroepisode));
								$numeroepisodeexist = $searchnumeroepisodeexist->rowCount();
								if($numeroepisodeexist == 1)
								{
								
									if($_POST['modifieradminanime4modifiertitreepisode'] !== "")
									{
										$modifiertitreepisode = htmlspecialchars($_POST['modifieradminanime4modifiertitreepisode']);
										$modifiertitre = $db->prepare('UPDATE episodes SET titre = :modifiertitreepisode WHERE IDanime = :IDanime AND numero = :numeroepisode');
										$modifiertitre->execute(array(
										'modifiertitreepisode' => $modifiertitreepisode,
										'IDanime' => $IDanime,
										'numeroepisode' => $numeroepisode
										));
									
											$erroranime4 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Titre modifier.\" />";
							
										?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime4
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
									
										$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n{avez pas renseigner le champ modifier le titre de l\'épisode.\" />";
							
									?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime4
										{
											right: 35.6%;
										}
									</style>
									<?php
									}
								}
								else
								{
								
									$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette épisode n'existe pas.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime4
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
							
								$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette saison n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime4
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime4
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime4inputmodifiervideovostfr']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime4titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
							$searchidanimeexist->execute(array($titre));
							$idanimeexist = $searchidanimeexist->fetch();
							$IDanime = $idanimeexist['ID'];
							$saison =  htmlspecialchars($_POST['modifieradminanime4saison']);
							$searchsaisonexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND IDsaison = ?');
							$searchsaisonexist->execute(array($IDanime,$saison));
							$saisonexist = $searchsaisonexist->rowCount();
							if($saisonexist >= 1)
							{
								$numeroepisode =  htmlspecialchars($_POST['modifieradminanime4numeroepisode']);
								$searchnumeroepisodeexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND numero = ?');
								$searchnumeroepisodeexist->execute(array($IDanime,$numeroepisode));
								$numeroepisodeexist = $searchnumeroepisodeexist->rowCount();
								if($numeroepisodeexist == 1)
								{
								
									if($_POST['modifieradminanime4modifiervideovostfr'] !== "")
									{
										$modifiervideovostfrepisode = htmlspecialchars($_POST['modifieradminanime4modifiervideovostfr']);
										$modifiervideovostfr = $db->prepare('UPDATE episodes SET videovostfr = :modifiervideovostfrepisode WHERE IDanime = :IDanime AND numero = :numeroepisode');
										$modifiervideovostfr->execute(array(
										'modifiervideovostfrepisode' => $modifiervideovostfrepisode,
										'IDanime' => $IDanime,
										'numeroepisode' => $numeroepisode
										));
									
											$erroranime4 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video vostfr modifier.\" />";
							
										?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime4
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
									
										$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la video vostfr.\" />";
							
									?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime4
										{
											right: 35.6%;
										}
									</style>
									<?php
									}
								}
								else
								{
								
									$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette épisode n'existe pas.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime4
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
							
								$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette saison n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime4
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime4
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime4inputmodifiervideovf']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime4titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
							$searchidanimeexist->execute(array($titre));
							$idanimeexist = $searchidanimeexist->fetch();
							$IDanime = $idanimeexist['ID'];
							$saison =  htmlspecialchars($_POST['modifieradminanime4saison']);
							$searchsaisonexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND IDsaison = ?');
							$searchsaisonexist->execute(array($IDanime,$saison));
							$saisonexist = $searchsaisonexist->rowCount();
							if($saisonexist >= 1)
							{
								$numeroepisode =  htmlspecialchars($_POST['modifieradminanime4numeroepisode']);
								$searchnumeroepisodeexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND numero = ?');
								$searchnumeroepisodeexist->execute(array($IDanime,$numeroepisode));
								$numeroepisodeexist = $searchnumeroepisodeexist->rowCount();
								if($numeroepisodeexist == 1)
								{
								
									if($_POST['modifieradminanime4modifiervideovf'] !== "")
									{
										$modifiervideovfepisode = htmlspecialchars($_POST['modifieradminanime4modifiervideovf']);
										$modifiervideovf = $db->prepare('UPDATE episodes SET videovf = :modifiervideovfepisode WHERE IDanime = :IDanime AND numero = :numeroepisode');
										$modifiervideovf->execute(array(
										'modifiervideovfepisode' => $modifiervideovfepisode,
										'IDanime' => $IDanime,
										'numeroepisode' => $numeroepisode
										));
									
											$erroranime4 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video vf modifier.\" />";
							
										?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime4
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
									
										$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la video vf.\" />";
							
									?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime4
										{
											right: 35.6%;
										}
									</style>
									<?php
									}
								}
								else
								{
								
									$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette épisode n'existe pas.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime4
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
							
								$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette saison n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime4
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime4
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime5supprimer']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminanime5titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
							$searchidanimeexist->execute(array($titre));
							$idanimeexist = $searchidanimeexist->fetch();
							$IDanime = $idanimeexist['ID'];
							$saison =  htmlspecialchars($_POST['modifieradminanime5saison']);
							$searchsaisonexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND IDsaison = ?');
							$searchsaisonexist->execute(array($IDanime,$saison));
							$saisonexist = $searchsaisonexist->rowCount();
							if($saisonexist >= 1)
							{
								$numeroepisode =  htmlspecialchars($_POST['modifieradminanime5numeroepisode']);
								$searchnumeroepisodeexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND numero = ?');
								$searchnumeroepisodeexist->execute(array($IDanime,$numeroepisode));
								$numeroepisodeexist = $searchnumeroepisodeexist->rowCount();
								if($numeroepisodeexist == 1)
								{
									$selectIDepisode = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $IDanime . '\' AND numero =\'' . $numeroepisode . '\'');
									$IDepisode = $selectIDepisode->fetch();
									
									$selectLIENepisode = $db->query('SELECT * FROM signaleepisode WHERE IDepisode =\'' . IDepisode['ID'] . '\'');
									$LIENepisode = $selectLIENepisode->fetch();
									
									$supprimersignaleepisode = $db->query('DELETE FROM signaleepisode WHERE IDepisode=\'' . IDepisode['ID'] . '\'');				
									$supprimercommentairesepisodes = $db->query('DELETE FROM commentairesepisodes WHERE IDepisode=\'' . IDepisode['ID'] . '\' AND lien=\'' . $LIENepisode['lien'] . '\'');
									$supprimersignalecommentaire = $db->query('DELETE FROM signalecommentaire WHERE page = episode AND lien=\'' . $LIENepisode['lien'] . '\'');
									
									$supprimerepisode = $db->prepare('DELETE FROM episodes WHERE IDanime = :IDanime AND numero = :numeroepisode');
									$supprimerepisode->execute(array(
									'IDanime' => $IDanime,
									'numeroepisode' => $numeroepisode
									));
								
									$erroranime5 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Épisode supprimer.\" />";
							
								?>
								<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime5
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
								
									$erroranime5 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette épisode n'existe pas.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime5
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
							
								$erroranime5 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette saison n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime5
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime5 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
						<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime5
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime6ajoutersaison']))
					{
						$titre = htmlspecialchars($_POST['modifieradminanime6titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
							$searchidanimeexist->execute(array($titre));
							$idanimeexist = $searchidanimeexist->fetch();
							$IDanime = $idanimeexist['ID'];
							$IDsaison =  htmlspecialchars($_POST['modifieradminanime6saison']);
							$searchsaisonexist = $db->prepare('SELECT * FROM saison WHERE IDanime = ? AND IDsaison = ?');
							$searchsaisonexist->execute(array($IDanime,$IDsaison));
							$saisonexist = $searchsaisonexist->rowCount();
							if($saisonexist == 0)
							{
								$IDmembre = $_SESSION['ID'];
								$ajoutersaison = $db->prepare('INSERT INTO saison(IDanime,IDsaison,IDmembre) VALUES (:IDanime,:IDsaison,:IDmembre)');
								$ajoutersaison->execute(array(
								'IDanime' => $IDanime,
								'IDsaison' => $IDsaison,
								'IDmembre' => $IDmembre
								));
							
								$erroranime6 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Saison ajouter.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime6
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime6 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette saison existe déjà.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime6
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime6 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime6
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime7ajouterscan']))
					{
						$titre = htmlspecialchars($_POST['modifieradminanime7titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
							$searchidanimeexist->execute(array($titre));
							$idanimeexist = $searchidanimeexist->fetch();
							$IDanime = $idanimeexist['ID'];
							$numeroscan =  htmlspecialchars($_POST['modifieradminanime7numeroscan']);
							$numeropage =  htmlspecialchars($_POST['modifieradminanime7numeropage']);
							$extension = strtolower(substr(strrchr($_FILES['modifieradminanime7img']['name'], '.'),1));
							$perm_ext = array('jpg','jpeg','png');
							$image = $IDanime."_".$numeroscan."_".$numeropage.".".$extension;
							if(in_array($extension,$perm_ext))
							{	
								$nomimage = $IDanime."_".$numeroscan."_".$numeropage;
								$searchnomimageexist = $db->prepare('SELECT * FROM scans WHERE nomimage = ?');
								$searchnomimageexist->execute(array($nomimage));
								$nomimageexist = $searchnomimageexist->rowCount();
								if($nomimageexist == 0)
								{
								
									$chemin = "../scan/".$IDanime."_".$numeroscan."_".$numeropage.".".$extension;
									move_uploaded_file($_FILES['modifieradminanime7img']['tmp_name'],$chemin);
									$IDmembre = $_SESSION['ID'];
									$ajouterscan = $db->prepare('INSERT INTO scans(IDanime,IDmembre,numero,page,image,nomimage,date) VALUES (:IDanime,:IDmembre,:numero,:page,:image,:nomimage,NOW())');
									$ajouterscan->execute(array(
									'IDanime' => $IDanime,
									'IDmembre' => $IDmembre,
									'numero' => $numeroscan,
									'page' => $numeropage,
									'image' => $image,
									'nomimage' => $nomimage
									));
								
									$erroranime8 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Scan ajouter.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime7
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
								
									$erroranime8 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette page de scan existe déjà.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime7
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}	
							else
							{
							
								$erroranime8 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime7
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime8 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime7
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime8inputmodifiertitre']))
					{
						$titre = htmlspecialchars($_POST['modifieradminanime8titre']);
						$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidanimeexist->execute(array($titre));
						$idanimeexist = $searchidanimeexist->fetch();
						$IDanime = $idanimeexist['ID'];
						$numeroscan =  htmlspecialchars($_POST['modifieradminanime8numeroscan']);
						$numeropage =  htmlspecialchars($_POST['modifieradminanime8numeropage']);
						$nomimage = $IDanime."_".$numeroscan."_".$numeropage;
						$searchnomimageexist = $db->prepare('SELECT * FROM scans WHERE nomimage = ?');
						$searchnomimageexist->execute(array($nomimage));
						$nomimageexist = $searchnomimageexist->rowCount();
						if($nomimageexist == 1)
						{
							$modifiertitre = htmlspecialchars($_POST['modifieradminanime8modifiertitre']);
							$searchidanimemodifiertitreexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
							$searchidanimemodifiertitreexist->execute(array($modifiertitre));
							$idanimemodifiertitreexist = $searchidanimemodifiertitreexist->fetch();
							$modifierIDanime = $idanimemodifiertitreexist['ID'];
							$modifiernomimage = $modifierIDanime."_".$numeroscan."_".$numeropage;
							$extension = strtolower(substr(strrchr($_FILES['modifieradminanime8img']['name'], '.'),1));
							$perm_ext = array('jpg','jpeg','png');
							$image = $modifierIDanime."_".$numeroscan."_".$numeropage.".".$extension;
							if(in_array($extension,$perm_ext))
							{
								if($_POST['modifieradminanime8modifiertitre'] !== "")
								{
									$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
									$searchanimeexist->execute(array($modifiertitre));
									$animeexist = $searchanimeexist->rowCount();
									if($animeexist == 1)
									{
										$selectimagescan = $db->query('SELECT * FROM scans WHERE nomimage=\'' . $nomimage . '\'');
										$imagescan = $selectimagescan->fetch();
										
										@unlink("../scan/" . $imagescan['image']);
										
										$modifieridanimescan = $db->prepare('UPDATE scans SET IDanime = :modifierIDanime WHERE nomimage = :nomimage');
										$modifieridanimescan->execute(array(
										'modifierIDanime' => $modifierIDanime,
										'nomimage' => $nomimage
										));
										$chemin = "../scan/".$modifierIDanime."_".$numeroscan."_".$numeropage.".".$extension;
										move_uploaded_file($_FILES['modifieradminanime8img']['tmp_name'],$chemin);
										$modifierimagescan = $db->prepare('UPDATE scans SET image = :image WHERE nomimage = :nomimage');
										$modifierimagescan->execute(array(
										'image' => $image,
										'nomimage' => $nomimage
										));
										$modifiernomimagescan = $db->prepare('UPDATE scans SET nomimage = :modifiernomimage WHERE nomimage = :nomimage');
										$modifiernomimagescan->execute(array(
										'modifiernomimage' => $modifiernomimage,
										'nomimage' => $nomimage
										));
									
										$erroranime9 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Animé modifier.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime8
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
									
										$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
									?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime8
										{
											right: 35.6%;
										}
									</style>
									<?php
									}
								}
								else
								{
								
									$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier l\'animé du scan.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime8
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
							
								$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime8
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce scan n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime8
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime8inputmodifiernumeroscan']))
					{
						$titre = htmlspecialchars($_POST['modifieradminanime8titre']);
						$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidanimeexist->execute(array($titre));
						$idanimeexist = $searchidanimeexist->fetch();
						$IDanime = $idanimeexist['ID'];
						$numeroscan =  htmlspecialchars($_POST['modifieradminanime8numeroscan']);
						$numeropage =  htmlspecialchars($_POST['modifieradminanime8numeropage']);
						$nomimage = $IDanime."_".$numeroscan."_".$numeropage;
						$searchnomimageexist = $db->prepare('SELECT * FROM scans WHERE nomimage = ?');
						$searchnomimageexist->execute(array($nomimage));
						$nomimageexist = $searchnomimageexist->rowCount();
						if($nomimageexist == 1)
						{
							$modifiernumeroscan = htmlspecialchars($_POST['modifieradminanime8modifiernumeroscan']);
							$modifiernomimage = $IDanime."_".$modifiernumeroscan."_".$numeropage;
							$extension = strtolower(substr(strrchr($_FILES['modifieradminanime8img']['name'], '.'),1));
							$perm_ext = array('jpg','jpeg','png');
							$image = $IDanime."_".$modifiernumeroscan."_".$numeropage.".".$extension;
							if(in_array($extension,$perm_ext))
							{
								if($_POST['modifieradminanime8modifiernumeroscan'] !== "")
								{
									$searchscanexist = $db->prepare('SELECT * FROM scans WHERE IDanime = ? AND numero = ?');
									$searchscanexist->execute(array($IDanime,$modifiernumeroscan));
									$scanexist = $searchscanexist->rowCount();
									if($scanexist == 0)
									{
										$selectimagescan = $db->query('SELECT * FROM scans WHERE nomimage=\'' . $nomimage . '\'');
										$imagescan = $selectimagescan->fetch();
										
										@unlink("../scan/" . $imagescan['image']);
										
										$modifiernumero = $db->prepare('UPDATE scans SET numero = :numero WHERE nomimage = :nomimage');
										$modifiernumero->execute(array(
										'numero' => $modifiernumeroscan,
										'nomimage' => $nomimage
										));
										
										$chemin = "../scan/".$IDanime."_".$modifiernumeroscan."_".$numeropage.".".$extension;
										move_uploaded_file($_FILES['modifieradminanime8img']['tmp_name'],$chemin);
										$modifierimagescan = $db->prepare('UPDATE scans SET image = :image WHERE nomimage = :nomimage');
										$modifierimagescan->execute(array(
										'image' => $image,
										'nomimage' => $nomimage
										));
										
										$modifiernomimagescan = $db->prepare('UPDATE scans SET nomimage = :modifiernomimage WHERE nomimage = :nomimage');
										$modifiernomimagescan->execute(array(
										'modifiernomimage' => $modifiernomimage,
										'nomimage' => $nomimage
										));
									
										$erroranime9 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Numéro modifier.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime8
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
									
										$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
									?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime8
										{
											right: 35.6%;
										}
									</style>
									<?php
									}
								}
								else
								{
								
									$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le numéro du scan.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime8
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
							
								$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime8
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce scan n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime8
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime8inputmodifiernumeropage']))
					{
						$titre = htmlspecialchars($_POST['modifieradminanime8titre']);
						$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidanimeexist->execute(array($titre));
						$idanimeexist = $searchidanimeexist->fetch();
						$IDanime = $idanimeexist['ID'];
						$numeroscan =  htmlspecialchars($_POST['modifieradminanime8numeroscan']);
						$numeropage =  htmlspecialchars($_POST['modifieradminanime8numeropage']);
						$nomimage = $IDanime."_".$numeroscan."_".$numeropage;
						$searchnomimageexist = $db->prepare('SELECT * FROM scans WHERE nomimage = ?');
						$searchnomimageexist->execute(array($nomimage));
						$nomimageexist = $searchnomimageexist->rowCount();
						if($nomimageexist == 1)
						{
							$modifiernumeropagescan = htmlspecialchars($_POST['modifieradminanime8modifiernumeropage']);
							$modifiernomimage = $IDanime."_".$numeroscan."_".$modifiernumeropagescan;
							$extension = strtolower(substr(strrchr($_FILES['modifieradminanime8img']['name'], '.'),1));
							$perm_ext = array('jpg','jpeg','png');
							$image = $IDanime."_".$numeroscan."_".$modifiernumeropagescan.".".$extension;
							if(in_array($extension,$perm_ext))
							{
								if($_POST['modifieradminanime8modifiernumeropage'] !== "")
								{
									$searchscanexist = $db->prepare('SELECT * FROM scans WHERE nomimage = ?');
									$searchscanexist->execute(array($modifiernomimage));
									$scanexist = $searchscanexist->rowCount();
									if($scanexist == 0)
									{
										$selectimagescan = $db->query('SELECT * FROM scans WHERE nomimage=\'' . $nomimage . '\'');
										$imagescan = $selectimagescan->fetch();
										
										@unlink("../scan/" . $imagescan['image']);
										
										$modifiernumero = $db->prepare('UPDATE scans SET page = :page WHERE nomimage = :nomimage');
										$modifiernumero->execute(array(
										'page' => $modifiernumeropagescan,
										'nomimage' => $nomimage
										));
										
										$chemin = "../scan/".$IDanime."_".$numeroscan."_".$modifiernumeropagescan.".".$extension;
										move_uploaded_file($_FILES['modifieradminanime8img']['tmp_name'],$chemin);
										$modifierimagescan = $db->prepare('UPDATE scans SET image = :image WHERE nomimage = :nomimage');
										$modifierimagescan->execute(array(
										'image' => $image,
										'nomimage' => $nomimage
										));
										
										$modifiernomimagescan = $db->prepare('UPDATE scans SET nomimage = :modifiernomimage WHERE nomimage = :nomimage');
										$modifiernomimagescan->execute(array(
										'modifiernomimage' => $modifiernomimage,
										'nomimage' => $nomimage
										));
									
										$erroranime9 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Page modifier.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime8
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
									
										$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
									?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime8
										{
											right: 35.6%;
										}
									</style>
									<?php
									}
								}
								else
								{
								
									$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la page du scan.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime8
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
							
								$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime8
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce scan n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime8
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime8inputmodifierimg']))
					{
						$titre = htmlspecialchars($_POST['modifieradminanime8titre']);
						$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidanimeexist->execute(array($titre));
						$idanimeexist = $searchidanimeexist->fetch();
						$IDanime = $idanimeexist['ID'];
						$numeroscan =  htmlspecialchars($_POST['modifieradminanime8numeroscan']);
						$numeropage =  htmlspecialchars($_POST['modifieradminanime8numeropage']);
						$nomimage = $IDanime."_".$numeroscan."_".$numeropage;
						$searchnomimageexist = $db->prepare('SELECT * FROM scans WHERE nomimage = ?');
						$searchnomimageexist->execute(array($nomimage));
						$nomimageexist = $searchnomimageexist->rowCount();
						if($nomimageexist == 1)
						{
							$taille = $_FILES['modifieradminanime8modifierimg']['size'];
							if($taille >= 1)
							{
								$extension = strtolower(substr(strrchr($_FILES['modifieradminanime8modifierimg']['name'], '.'),1));
								$perm_ext = array('jpg','jpeg','png');
								$image = $IDanime."_".$numeroscan."_".$numeropage.".".$extension;
								if(in_array($extension,$perm_ext))
								{
									$selectimagescan = $db->query('SELECT * FROM scans WHERE nomimage=\'' . $nomimage . '\'');
									$imagescan = $selectimagescan->fetch();
										
									@unlink("../scan/" . $imagescan['image']);
									
									$chemin = "../scan/".$IDanime."_".$numeroscan."_".$numeropage.".".$extension;
									move_uploaded_file($_FILES['modifieradminanime8modifierimg']['tmp_name'],$chemin);
									$modifierimagescan = $db->prepare('UPDATE scans SET image = :image WHERE nomimage = :nomimage');
									$modifierimagescan->execute(array(
									'image' => $image,
									'nomimage' => $nomimage
									));
								
										$erroranime9 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Image modifier.\" />";
							
									?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime8
										{
											right: 35.6%;
										}
									
									</style>
								<?php
								}
								else
								{
								
									$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime8
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
							
								$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier l\image du scan.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime8
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime9 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce scan n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime8
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime9supprimerscan']))
					{
						$titre = htmlspecialchars($_POST['modifieradminanime9titre']);
						$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidanimeexist->execute(array($titre));
						$idanimeexist = $searchidanimeexist->fetch();
						$IDanime = $idanimeexist['ID'];
						$numeroscan =  htmlspecialchars($_POST['modifieradminanime9numeroscan']);
						$numeropage =  htmlspecialchars($_POST['modifieradminanime9numeropage']);
						$nomimage = $IDanime."_".$numeroscan."_".$numeropage;
						$searchnomimageexist = $db->prepare('SELECT * FROM scans WHERE nomimage = ?');
						$searchnomimageexist->execute(array($nomimage));
						$nomimageexist = $searchnomimageexist->rowCount();
						if($nomimageexist == 1)
						{
							$searchlastscan = $db->query('SELECT * FROM scans WHERE IDanime=\'' . $IDanime . '\' AND numero=\'' . $numeroscan . '\'');
							$lastscan = $searchlastscan->rowCount();
							if($lastscan == 1)
							{
								$selectLIENscan = $db->query('SELECT * FROM commentairesscans WHERE IDanime=\'' . $IDanime . '\' AND IDscan=\'' . $numeroscan . '\'');
								$LIENscan = $selectLIENscan->fetch();
									
								$supprimercommentairesepisodes = $db->query('DELETE FROM commentairesscans WHERE IDanime=\'' . $IDanime . '\' AND IDscan=\'' . $numeroscan . '\'');
								$supprimersignalecommentaire = $db->query('DELETE FROM signalecommentaire WHERE page = scan AND lien=\'' . $LIENscan['lien'] . '\'');
								
								$selectimagescan = $db->query('SELECT * FROM scans WHERE nomimage=\'' . $nomimage . '\'');
								$imagescan = $selectimagescan->fetch();
											
								@unlink("../scan/" . $imagescan['image']);
											
								$supprimerimagescan = $db->prepare('DELETE FROM scans WHERE nomimage = :nomimage');
								$supprimerimagescan->execute(array(
								'nomimage' => $nomimage
								));
							}
							else
							{
								$selectimagescan = $db->query('SELECT * FROM scans WHERE nomimage=\'' . $nomimage . '\'');
								$imagescan = $selectimagescan->fetch();
											
								@unlink("../scan/" . $imagescan['image']);
											
								$supprimerimagescan = $db->prepare('DELETE FROM scans WHERE nomimage = :nomimage');
								$supprimerimagescan->execute(array(
								'nomimage' => $nomimage
								));
							}
						
							$erroranime10 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Scan supprimer.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime9
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
						else
						{
						
							$erroranime10 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce scan n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime9
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime10valider']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime10titreanime']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$IDmembre = $_SESSION['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime10numero']);
						$titre = htmlspecialchars($_POST['modifieradminanime10titre']);
						$image = $_FILES['modifieradminanime10img']['size'];
						$date = htmlspecialchars($_POST['modifieradminanime10date']);
						$realisateur = htmlspecialchars($_POST['modifieradminanime10realisateur']);
						$synopsis = htmlspecialchars($_POST['modifieradminanime10synopsis']);
						$durer = htmlspecialchars($_POST['modifieradminanime10durer']);
						$bandeannonce =  htmlspecialchars($_POST['modifieradminanime10bandeannonce']);
						if(isset($_POST['modifieradminanime10videovf']))
						{
							$videovf =  htmlspecialchars($_POST['modifieradminanime10videovf']);
						}
						else
						{
							$videovf = "";
						}
						if(isset($_POST['modifieradminanime10videovostfr']))
						{
							$videovostfr =  htmlspecialchars($_POST['modifieradminanime10videovostfr']);
						}
						else
						{
							$videovostfr = "";
						}
						
						$extension = strtolower(substr(strrchr($_FILES['modifieradminanime10img']['name'], '.'),1));
						$perm_ext = array('jpg','jpeg','png');
						if(in_array($extension,$perm_ext))
						{
							$nomimage = $_FILES['modifieradminanime10img']['name'];
							$chemin = "../filmanime/".$_FILES['modifieradminanime10img']['name'];
							move_uploaded_file($_FILES['modifieradminanime10img']['tmp_name'],$chemin);
							$searchfilmanimeexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
							$searchfilmanimeexist->execute(array($IDanime,$numero));
							$filmanimeexist = $searchfilmanimeexist->rowCount();
							if($filmanimeexist == 0)
							{
								$ajouterfilmanime = $db->prepare('INSERT INTO filmsanimes(IDanime,IDmembre,numero,titre,image,date,realisateur,synopsis,durer,bandeannonce,videovf,videovostfr,date_ajout) VALUES (:IDanime,:IDmembre,:numero,:titre,:image,:date,:realisateur,:synopsis,:durer,:bandeannonce,:videovf,:videovostfr,NOW())');
								$ajouterfilmanime->execute(array(
								'IDanime' => $IDanime,
								'IDmembre' => $IDmembre,
								'numero' => $numero,
								'titre' => $titre,
								'image' => $nomimage,
								'date' => $date,
								'realisateur' => $realisateur,
								'synopsis' => $synopsis,
								'durer' => $durer,
								'bandeannonce' => $bandeannonce,
								'videovf' => $videovf,
								'videovostfr' => $videovostfr
								));
					
								$erroranime11= "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Film ajouter.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime10
									{
										right: 35.6%;
									}
								</style>
					<?php
							}
							else
							{
							
								$erroranime11 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film existe déjà.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime10
								{
									right: 35.6%;
								}
							</style>
						<?php
							}
						}
						else
						{
						
								$erroranime11 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime10
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime11validermodifiernumero']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime11titreanime']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime11numero']);
						$searchfilmanimeexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
						$searchfilmanimeexist->execute(array($IDanime,$numero));
						$filmanimeexist = $searchfilmanimeexist->rowCount();
						if($filmanimeexist == 1)
						{
							if($_POST['modifieradminanime11modifiernumero'] !== "")
							{
								$modifiernumero = htmlspecialchars($_POST['modifieradminanime11modifiernumero']);
								$searchfilmanimedispo = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
								$searchfilmanimedispo->execute(array($IDanime,$modifiernumero));
								$filmanimedispo = $searchfilmanimedispo->rowCount();
								if($filmanimedispo == 0)
								{
									$modifierfilmanime = $db->prepare('UPDATE filmsanimes SET numero = :modifiernumero WHERE IDanime = :IDanime AND numero = :numero');
									$modifierfilmanime->execute(array(
									'modifiernumero' => $modifiernumero,
									'IDanime' => $IDanime,
									'numero' => $numero
									));
								
									$erroranime12 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Numéro modifier.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime11
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
								
									$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce numéro est indisponible.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
								}
							}
							else
							{
							
								$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le numéro.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime11
								{
									right: 35.6%;
								}
							</style>
						<?php
							}
						}
						else
						{
						
							$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime11
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime11validermodifiertitre']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime11titreanime']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime11numero']);
						$searchfilmanimeexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
						$searchfilmanimeexist->execute(array($IDanime,$numero));
						$filmanimeexist = $searchfilmanimeexist->rowCount();
						if($filmanimeexist == 1)
						{
							if($_POST['modifieradminanime11modifiertitre'] !== "")
							{
								$modifiertitre = htmlspecialchars($_POST['modifieradminanime11modifiertitre']);
								
								$modifierfilmanime = $db->prepare('UPDATE filmsanimes SET titre = :modifiertitre WHERE IDanime = :IDanime AND numero = :numero');
								$modifierfilmanime->execute(array(
								'modifiertitre' => $modifiertitre,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
								$erroranime12 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Titre modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez renseigner le champ modifier le titre.\" />";
							
							?>
							<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
						
							$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime11
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime11validermodifierimg']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime11titreanime']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime11numero']);
						$searchfilmanimeexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
						$searchfilmanimeexist->execute(array($IDanime,$numero));
						$filmanimeexist = $searchfilmanimeexist->rowCount();
						if($filmanimeexist == 1)
						{
							$image = $_FILES['modifieradminanime11modifierimg']['size'];
							$taille = $_FILES['modifieradminanime11modifierimg']['size'];
							if($taille >= 1)
							{
								$extension = strtolower(substr(strrchr($_FILES['modifieradminanime11modifierimg']['name'], '.'),1));
								$perm_ext = array('jpg','jpeg','png');
								if(in_array($extension,$perm_ext))
								{
									$selectimagefilmanime = $db->query('SELECT * FROM filmsanimes WHERE IDanime=\'' . $IDanime . '\' AND numero=\'' . $numero . '\'');
									$imageimagefilmanime = $selectimageimagefilmanime->fetch();
												
									@unlink("../filmanime/" . $imageimagefilmanime['image']);
									
									$nomimage = $_FILES['modifieradminanime11modifierimg']['name'];
									$chemin = "../filmanime/".$_FILES['modifieradminanime11modifierimg']['name'];
									move_uploaded_file($_FILES['modifieradminanime11modifierimg']['tmp_name'],$chemin);
								
									$modifierfilmanime = $db->prepare('UPDATE filmsanimes SET image = :nomimage WHERE IDanime = :IDanime AND numero = :numero');
									$modifierfilmanime->execute(array(
									'nomimage' => $nomimage,
									'IDanime' => $IDanime,
									'numero' => $numero
									));
								
									$erroranime12 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Image modifier.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime11
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
								
									$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime11
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else
							{
							
								$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas séléctionner d\'image.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
						
							$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime11
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime11validermodifierdate']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime11titreanime']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime11numero']);
						$searchfilmanimeexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
						$searchfilmanimeexist->execute(array($IDanime,$numero));
						$filmanimeexist = $searchfilmanimeexist->rowCount();
						if($filmanimeexist == 1)
						{
							if($_POST['modifieradminanime11modifierdate'] !== "")
							{
								$modifierdate = htmlspecialchars($_POST['modifieradminanime11modifierdate']);
								
								$modifierfilmanime = $db->prepare('UPDATE filmsanimes SET date = :modifierdate WHERE IDanime = :IDanime AND numero = :numero');
								$modifierfilmanime->execute(array(
								'modifierdate' => $modifierdate,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
								$erroranime12 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Date modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime11
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
								
									$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la date.\" />";
								
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
						
							$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime11
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime11validermodifierrealisateur']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime11titreanime']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime11numero']);
						$searchfilmanimeexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
						$searchfilmanimeexist->execute(array($IDanime,$numero));
						$filmanimeexist = $searchfilmanimeexist->rowCount();
						if($filmanimeexist == 1)
						{
							if($_POST['modifieradminanime11modifierrealisateur'] !== "")
							{
								$modifierrealisateur = htmlspecialchars($_POST['modifieradminanime11modifierrealisateur']);
								
								$modifierfilmanime = $db->prepare('UPDATE filmsanimes SET realisateur = :modifierrealisateur WHERE IDanime = :IDanime AND numero = :numero');
								$modifierfilmanime->execute(array(
								'modifierrealisateur' => $modifierrealisateur,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
								$erroranime12 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Réalisateur modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le réalisateur.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
						
							$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime11
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime11validermodifiersynopsis']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime11titreanime']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime11numero']);
						$searchfilmanimeexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
						$searchfilmanimeexist->execute(array($IDanime,$numero));
						$filmanimeexist = $searchfilmanimeexist->rowCount();
						if($filmanimeexist == 1)
						{
							if($_POST['modifieradminanime11modifiersynopsis'] !== "")
							{
								$modifiersynopsis = htmlspecialchars($_POST['modifieradminanime11modifiersynopsis']);
								
								$modifierfilmanime = $db->prepare('UPDATE filmsanimes SET synopsis = :modifiersynopsis WHERE IDanime = :IDanime AND numero = :numero');
								$modifierfilmanime->execute(array(
								'modifiersynopsis' => $modifiersynopsis,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
								$erroranime12 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Synopsis modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le synopsis.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
						
							$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime11
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime11validermodifierdurer']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime11titreanime']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime11numero']);
						$searchfilmanimeexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
						$searchfilmanimeexist->execute(array($IDanime,$numero));
						$filmanimeexist = $searchfilmanimeexist->rowCount();
						if($filmanimeexist == 1)
						{
							if($_POST['modifieradminanime11modifierdurer'] !== "")
							{
								$modifierdurer = htmlspecialchars($_POST['modifieradminanime11modifierdurer']);
								
								$modifierfilmanime = $db->prepare('UPDATE filmsanimes SET durer = :modifierdurer WHERE IDanime = :IDanime AND numero = :numero');
								$modifierfilmanime->execute(array(
								'modifierdurer' => $modifierdurer,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
								$erroranime12 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Durée modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la durée.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
						
							$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime11
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime11validermodifierbandeannonce']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime11titreanime']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime11numero']);
						$searchfilmanimeexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
						$searchfilmanimeexist->execute(array($IDanime,$numero));
						$filmanimeexist = $searchfilmanimeexist->rowCount();
						if($filmanimeexist == 1)
						{
							if($_POST['modifieradminanime11modifierbandeannonce'] !== "")
							{
								$modifierbandeannonce = htmlspecialchars($_POST['modifieradminanime11modifierbandeannonce']);
								
								$modifierfilmanime = $db->prepare('UPDATE filmsanimes SET bandeannonce = :modifierbandeannonce WHERE IDanime = :IDanime AND numero = :numero');
								$modifierfilmanime->execute(array(
								'modifierbandeannonce' => $modifierbandeannonce,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
								$erroranime12 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Bande annonce modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la bande annonce.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
						
							$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime11
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime11validermodifiervostfr']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime11titreanime']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime11numero']);
						$searchfilmanimeexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
						$searchfilmanimeexist->execute(array($IDanime,$numero));
						$filmanimeexist = $searchfilmanimeexist->rowCount();
						if($filmanimeexist == 1)
						{
							if($_POST['modifieradminanime11modifiervideovostfr'] !== "")
							{
								$modifiervostfr = htmlspecialchars($_POST['modifieradminanime11modifiervideovostfr']);
								
								$modifierfilmanime = $db->prepare('UPDATE filmsanimes SET videovostfr = :modifiervostfr WHERE IDanime = :IDanime AND numero = :numero');
								$modifierfilmanime->execute(array(
								'modifiervostfr' => $modifiervostfr,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
								$erroranime12 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video vostfr modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la video vostfr.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
						
							$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime11
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime11validermodifiervf']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime11titreanime']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime11numero']);
						$searchfilmanimeexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
						$searchfilmanimeexist->execute(array($IDanime,$numero));
						$filmanimeexist = $searchfilmanimeexist->rowCount();
						if($filmanimeexist == 1)
						{
							if($_POST['modifieradminanime11modifiervideovf'] !== "")
							{
								$modifiervf = htmlspecialchars($_POST['modifieradminanime11modifiervideovf']);
								
								$modifierfilmanime = $db->prepare('UPDATE filmsanimes SET videovf = :modifiervf WHERE IDanime = :IDanime AND numero = :numero');
								$modifierfilmanime->execute(array(
								'modifiervf' => $modifiervf,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
								$erroranime12 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video vf modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la video vf.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime11
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
						
							$erroranime12 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime11
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime12']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime12titreanime']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime12numero']);
						$searchfilmanimeexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
						$searchfilmanimeexist->execute(array($IDanime,$numero));
						$filmanimeexist = $searchfilmanimeexist->rowCount();
						if($filmanimeexist == 1)
						{	
							$selectimagefilmanime = $db->query('SELECT * FROM filmsanimes WHERE IDanime=\'' . $IDanime . '\' AND numero=\'' . $numero . '\'');
							$imagefilmanime = $selectimagefilmanime->fetch();
										
							@unlink("../filmanime/" . $imagefilmanime['image']);
							
							$selectLIENfilmanime = $db->query('SELECT * FROM commentairesfilmanime WHERE IDfilmanime=\'' . $imagefilmanime['ID'] . '\'');
							$LIENfilmanime = $selectLIENfilmanime->fetch();
					
							$suppfilmanimenote = $db->query('DELETE FROM notesfilmanime WHERE IDfilmanime=\'' . $imagefilmanime['ID'] . '\'');
							$suppfilmanimesignal = $db->query('DELETE FROM signalefilmanime WHERE IDfilmanime=\'' . $imagefilmanime['ID'] . '\'');
							$suppfilmanimecommentaire = $db->query('DELETE FROM commentairesfilmanime WHERE IDfilmanime=\'' . $imagefilmanime['ID'] . '\'');
							$suppfilmanimecommentairesignal = $db->query('DELETE FROM signalecommentaire WHERE page = filmanime AND lien =\'' . $LIENfilmanime['lien'] . '\'');
							$modifierfilmanime = $db->prepare('DELETE FROM filmsanimes WHERE IDanime = :IDanime AND numero = :numero');
							$modifierfilmanime->execute(array(
							'IDanime' => $IDanime,
							'numero' => $numero
							));
						
							$erroranime13 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Film supprimer.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime12
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
						else
						{
						
							$erroranime13 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime12
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime13']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime13titre']);
						$IDmembre = $_SESSION['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime13numero']);
						$titreepisode = htmlspecialchars($_POST['modifieradminanime13titreepisode']);
						$videovf = htmlspecialchars($_POST['modifieradminanime13videovf']);
						$videovostfr = htmlspecialchars($_POST['modifieradminanime13videovostfr']);
						$searchidfilmspecialexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidfilmspecialexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidfilmspecialexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$searchfilmspecialexist = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
						$searchfilmspecialexist->execute(array($IDanime,$numero));
						$filmspecialexist = $searchfilmspecialexist->rowCount();
						if($filmspecialexist == 0)
						{		
							$ajouterfilmspecial = $db->prepare('INSERT INTO filmsspecial(IDanime,IDmembre,numero,titre,videovf,videovostfr,date) VALUES (:IDanime,:IDmembre,:numero,:titre,:videovf,:videovostfr,NOW())');
							$ajouterfilmspecial->execute(array(
							'IDanime' => $IDanime,
							'IDmembre' => $IDmembre,
							'numero' => $numero,
							'titre' => $titreepisode,
							'videovf' => $videovf,
							'videovostfr' => $videovostfr
							));
						
							$erroranime14 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Film spécial ajouter.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime13
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
						else
						{
						
							$erroranime14 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film existe déjà.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime13
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime14inputmodifiernumero']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime14titre']);
						$numero = htmlspecialchars($_POST['modifieradminanime14numero']);
						$searchidfilmspecialexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidfilmspecialexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidfilmspecialexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$searchfilmspecialexist = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
						$searchfilmspecialexist->execute(array($IDanime,$numero));
						$filmspecialexist = $searchfilmspecialexist->rowCount();
						if($filmspecialexist == 1)
						{
							if($_POST['modifieradminanime14modifiernumero'] !== "")
							{
								$modifiernumero = htmlspecialchars($_POST['modifieradminanime14modifiernumero']);
								$searchfilmspecialdispo = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
								$searchfilmspecialdispo->execute(array($IDanime,$modifiernumero));
								$filmspecialdispo = $searchfilmspecialdispo->rowCount();
								if($filmspecialdispo == 0)
								{
									$modifierfilmspecial = $db->prepare('UPDATE filmsspecial SET numero = :modifiernumero WHERE IDanime = :IDanime AND numero = :numero');
									$modifierfilmspecial->execute(array(
									'modifiernumero' => $modifiernumero,
									'IDanime' => $IDanime,
									'numero' => $numero
									));
								
									$erroranime15 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Film spécial modifier.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime14
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
								
									$erroranime15 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce numéro est indisponible.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime14
									{
										right: 35.6%;
									}
								</style>
							<?php
								}
							}
							else
							{
							
								$erroranime15 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le numéro.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime14
								{
									right: 35.6%;
								}
							</style>
						<?php
							}
						}
						else
						{
						
							$erroranime15 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime14
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime14inputmodifiertitreepisode']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime14titre']);
						$numero = htmlspecialchars($_POST['modifieradminanime14numero']);
						$searchidfilmspecialexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidfilmspecialexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidfilmspecialexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$searchfilmspecialexist = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
						$searchfilmspecialexist->execute(array($IDanime,$numero));
						$filmspecialexist = $searchfilmspecialexist->rowCount();
						if($filmspecialexist == 1)
						{
							if($_POST['modifieradminanime14modifiertitreepisode'] !== "")
							{
								$modifiertitre = htmlspecialchars($_POST['modifieradminanime14modifiertitreepisode']);
								$modifierfilmspecial = $db->prepare('UPDATE filmsspecial SET titre = :modifiertitre WHERE IDanime = :IDanime AND numero = :numero');
								$modifierfilmspecial->execute(array(
								'modifiertitre' => $modifiertitre,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
								$erroranime15 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Titre modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime14
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime15 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le titre.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime14
								{
									right: 35.6%;
								}
							</style>
						<?php
							}
						}
						else
						{
						
							$erroranime15 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime14
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime14inputmodifiervideovostfr']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime14titre']);
						$numero = htmlspecialchars($_POST['modifieradminanime14numero']);
						$searchidfilmspecialexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidfilmspecialexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidfilmspecialexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$searchfilmspecialexist = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
						$searchfilmspecialexist->execute(array($IDanime,$numero));
						$filmspecialexist = $searchfilmspecialexist->rowCount();
						if($filmspecialexist == 1)
						{
							if($_POST['modifieradminanime14modifiervideovostfr'] !== "")
							{
								$modifiervideovostfr = htmlspecialchars($_POST['modifieradminanime14modifiervideovostfr']);
								$modifierfilmspecial = $db->prepare('UPDATE filmsspecial SET videovostfr = :modifiervideovostfr WHERE IDanime = :IDanime AND numero = :numero');
								$modifierfilmspecial->execute(array(
								'modifiervideovostfr' => $modifiervideovostfr,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
									$erroranime15 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video vostfr modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime14
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime15 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la video vostfr.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime14
								{
									right: 35.6%;
								}
							</style>
						<?php
							}
						}
						else
						{
						
							$erroranime15 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime14
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime14inputmodifiervideovf']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime14titre']);
						$numero = htmlspecialchars($_POST['modifieradminanime14numero']);
						$searchidfilmspecialexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidfilmspecialexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidfilmspecialexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$searchfilmspecialexist = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
						$searchfilmspecialexist->execute(array($IDanime,$numero));
						$filmspecialexist = $searchfilmspecialexist->rowCount();
						if($filmspecialexist == 1)
						{
							if($_POST['modifieradminanime14modifiervideovf'] !== "")
							{
								$modifiervideovf = htmlspecialchars($_POST['modifieradminanime14modifiervideovf']);
								$modifierfilmspecial = $db->prepare('UPDATE filmsspecial SET videovf = :modifiervideovf WHERE IDanime = :IDanime AND numero = :numero');
								$modifierfilmspecial->execute(array(
								'modifiervideovf' => $modifiervideovf,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
								$erroranime15 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video vf modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime14
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime15 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la video vf.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime14
								{
									right: 35.6%;
								}
							</style>
						<?php
							}
						}
						else
						{
						
							$erroranime15 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime14
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime15']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime15titre']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime15numero']);
						$searchfilmspecialexist = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
						$searchfilmspecialexist->execute(array($IDanime,$numero));
						$filmspecialexist = $searchfilmspecialexist->rowCount();
						if($filmspecialexist == 1)
						{	
							$selectIDfilmspecial = $db->query('SELECT * FROM filmsspecial WHERE IDanime=\'' . $IDanime . '\' AND numero=\'' . $numero . '\'');
							$IDfilmspecial = $selectIDfilmspecial->fetch();
							
							$selectLIENfilmspecial = $db->query('SELECT * FROM commentairesspecial WHERE IDspecial=\'' . $IDfilmspecial['ID'] . '\'');
							$LIENfilmspecial = $selectLIENfilmspecial->fetch();
					
							$suppfilmspecialsignal = $db->query('DELETE FROM signalespecial WHERE IDspecial=\'' . $IDfilmspecial['ID'] . '\'');
							$suppfilmspecialcommentaire = $db->query('DELETE FROM commentairesspecial WHERE IDspecial=\'' . $IDfilmspecial['ID'] . '\'');
							$suppfilmspecialcommentairesignal = $db->query('DELETE FROM signalecommentaire WHERE page = filmspecial AND lien =\'' . $LIENfilmspecial['lien'] . '\'');
							$modifierfilmspecial = $db->prepare('DELETE FROM filmsspecial WHERE IDanime = :IDanime AND numero = :numero');
							$modifierfilmspecial->execute(array(
							'IDanime' => $IDanime,
							'numero' => $numero
							));
						
							$erroranime16 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Film spécial supprimer.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime15
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
						else
						{
						
							$erroranime16 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime15
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime16']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime16titre']);
						$IDmembre = $_SESSION['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime16numero']);
						$titreepisode = htmlspecialchars($_POST['modifieradminanime16titreepisode']);
						$videovf = htmlspecialchars($_POST['modifieradminanime16videovf']);
						$videovostfr = htmlspecialchars($_POST['modifieradminanime16videovostfr']);
						$searchidoavexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidoavexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidoavexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$searchoavexist = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
						$searchoavexist->execute(array($IDanime,$numero));
						$oavexist = $searchoavexist->rowCount();
						if($oavexist == 0)
						{		
							$ajouteroav = $db->prepare('INSERT INTO oavs(IDanime,IDmembre,numero,titre,videovf,videovostfr,date) VALUES (:IDanime,:IDmembre,:numero,:titre,:videovf,:videovostfr,NOW())');
							$ajouteroav->execute(array(
							'IDanime' => $IDanime,
							'IDmembre' => $IDmembre,
							'numero' => $numero,
							'titre' => $titreepisode,
							'videovf' => $videovf,
							'videovostfr' => $videovostfr
							));
						
							$erroranime17 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Oav ajouter.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime16
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
						else
						{
						
							$erroranime17 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette oav existe déjà.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime16
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime17inputmodifiernumero']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime17titre']);
						$numero = htmlspecialchars($_POST['modifieradminanime17numero']);
						$searchidoavexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidoavexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidoavexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$searchoavexist = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
						$searchoavexist->execute(array($IDanime,$numero));
						$oavexist = $searchoavexist->rowCount();
						if($oavexist == 1)
						{
							if($_POST['modifieradminanime17modifiernumero'] !== "")
							{
								$modifiernumero = htmlspecialchars($_POST['modifieradminanime17modifiernumero']);
								$searchoavdispo = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
								$searchoavdispo->execute(array($IDanime,$modifiernumero));
								$oavdispo = $searchoavdispo->rowCount();
								if($oavdispo == 0)
								{
									$modifieroav = $db->prepare('UPDATE oavs SET numero = :modifiernumero WHERE IDanime = :IDanime AND numero = :numero');
									$modifieroav->execute(array(
									'modifiernumero' => $modifiernumero,
									'IDanime' => $IDanime,
									'numero' => $numero
									));
								
									$erroranime18 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Numéro modifier.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime17
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
								
									$erroranime18 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce numéro est indisponible.\" />";
							
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime17
									{
										right: 35.6%;
									}
								</style>
							<?php
								}
							}
							else
							{
							
								$erroranime18 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le numéro.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime17
								{
									right: 35.6%;
								}
							</style>
						<?php
							}
						}
						else
						{
						
							$erroranime18 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette oav n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime17
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime17inputmodifiertitreepisode']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime17titre']);
						$numero = htmlspecialchars($_POST['modifieradminanime17numero']);
						$searchidoavexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidoavexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidoavexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$searchoavexist = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
						$searchoavexist->execute(array($IDanime,$numero));
						$oavexist = $searchoavexist->rowCount();
						if($oavexist == 1)
						{
							if($_POST['modifieradminanime17modifiertitreepisode'] !== "")
							{
								$modifiertitre = htmlspecialchars($_POST['modifieradminanime17modifiertitreepisode']);
								$modifieroav = $db->prepare('UPDATE oavs SET titre = :modifiertitre WHERE IDanime = :IDanime AND numero = :numero');
								$modifieroav->execute(array(
								'modifiertitre' => $modifiertitre,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
								$erroranime18 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Titre modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime17
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime18 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le titre.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime17
								{
									right: 35.6%;
								}
							</style>
						<?php
							}
						}
						else
						{
						
							$erroranime18 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce oav n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime17
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime17inputmodifiervideovostfr']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime17titre']);
						$numero = htmlspecialchars($_POST['modifieradminanime17numero']);
						$searchidoavexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidoavexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidoavexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$searchoavexist = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
						$searchoavexist->execute(array($IDanime,$numero));
						$oavexist = $searchoavexist->rowCount();
						if($oavexist == 1)
						{
							if($_POST['modifieradminanime17modifiervideovostfr'] !== "")
							{
								$modifiervideovostfr = htmlspecialchars($_POST['modifieradminanime17modifiervideovostfr']);
								$modifieroav = $db->prepare('UPDATE oavs SET videovostfr = :modifiervideovostfr WHERE IDanime = :IDanime AND numero = :numero');
								$modifieroav->execute(array(
								'modifiervideovostfr' => $modifiervideovostfr,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
							
								$erroranime18 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video vostfr modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime17
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
							
								$erroranime18 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la video vostfr.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime17
								{
									right: 35.6%;
								}
							</style>
						<?php
							}
						}
						else
						{
													
							$erroranime18 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette oav n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime17
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime17inputmodifiervideovf']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime17titre']);
						$numero = htmlspecialchars($_POST['modifieradminanime17numero']);
						$searchidoavexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidoavexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidoavexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$searchoavexist = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
						$searchoavexist->execute(array($IDanime,$numero));
						$oavexist = $searchoavexist->rowCount();
						if($oavexist == 1)
						{
							if($_POST['modifieradminanime17modifiervideovf'] !== "")
							{
								$modifiervideovf = htmlspecialchars($_POST['modifieradminanime17modifiervideovf']);
								$modifieroav = $db->prepare('UPDATE oavs SET videovf = :modifiervideovf WHERE IDanime = :IDanime AND numero = :numero');
								$modifieroav->execute(array(
								'modifiervideovf' => $modifiervideovf,
								'IDanime' => $IDanime,
								'numero' => $numero
								));
														
								$erroranime18 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video vf modifier.\" />";
							
							?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime17
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
														
								$erroranime18 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la video vf.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime17
								{
									right: 35.6%;
								}
							</style>
						<?php
							}
						}
						else
						{
													
							$erroranime18 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette oav n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime17
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime18']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime18titre']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$numero = htmlspecialchars($_POST['modifieradminanime18numero']);
						$searchoavexist = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
						$searchoavexist->execute(array($IDanime,$numero));
						$oavexist = $searchoavexist->rowCount();
						if($oavexist == 1)
						{	
							$selectIDoav = $db->query('SELECT * FROM oavs WHERE IDanime=\'' . $IDanime . '\' AND numero=\'' . $numero . '\'');
							$IDoav = $selectIDoav->fetch();
							
							$selectLIENoav = $db->query('SELECT * FROM commentairesoavs WHERE IDoav=\'' . $IDoav['ID'] . '\'');
							$LIENoav = $selectLIENoav->fetch();
					
							$suppoavsignal = $db->query('DELETE FROM signaleoav WHERE IDoav=\'' . $IDoav['ID'] . '\'');
							$suppoavcommentaire = $db->query('DELETE FROM commentairesoavs WHERE IDoav=\'' . $IDoav['ID'] . '\'');
							$suppoavcommentairesignal = $db->query('DELETE FROM signalecommentaire WHERE page = oav AND lien =\'' . $LIENoav['lien'] . '\'');
							
							$modifieroav = $db->prepare('DELETE FROM oavs WHERE IDanime = :IDanime AND numero = :numero');
							$modifieroav->execute(array(
							'IDanime' => $IDanime,
							'numero' => $numero
							));
													
							$erroranime19 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Oav supprimer.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime18
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
						else
						{
													
							$erroranime19 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette oav n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime18
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime19']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime19titre']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$generique = htmlspecialchars($_POST['modifieradminanime19generique']);
						$video = htmlspecialchars($_POST['modifieradminanime19video']);
						$IDmembre = $_SESSION['ID'];
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titreanime));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{	
							if($generique == 'OPENING')
							{
								$searchopeningexist = $db->prepare('SELECT * FROM opening WHERE IDanime = ?');
								$searchopeningexist->execute(array($IDanime));
								$openingexist = $searchopeningexist->rowCount();
								if($openingexist == 0)
								{		
									$modifieropening = $db->prepare('INSERT INTO opening(IDanime,video,IDmembre,date) VALUES (:IDanime,:video,:IDmembre,NOW())');
									$modifieropening->execute(array(
									'IDanime' => $IDanime,
									'video' => $video,
									'IDmembre' => $IDmembre
									));
									
									$erroranime20 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Opening ajouter.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime19
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
									
									$erroranime20 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette opening existe déjà.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime19
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($generique == 'ENDING')
							{
								$searchendingexist = $db->prepare('SELECT * FROM ending WHERE IDanime = ?');
								$searchendingexist->execute(array($IDanime));
								$endingexist = $searchendingexist->rowCount();
								if($endingexist == 0)
								{		
									$modifierending = $db->prepare('INSERT INTO ending(IDanime,video,IDmembre,date) VALUES (:IDanime,:video,:IDmembre,NOW())');
									$modifierending->execute(array(
									'IDanime' => $IDanime,
									'video' => $video,
									'IDmembre' => $IDmembre
									));
									
									$erroranime20 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Ending ajouter.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime19
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
									
									$erroranime20 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette ending existe déjà.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime19
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($generique == 'AMV')
							{
								$searchamvexist = $db->prepare('SELECT * FROM amv WHERE IDanime = ?');
								$searchamvexist->execute(array($IDanime));
								$amvexist = $searchamvexist->rowCount();
								if($amvexist == 0)
								{		
									$modifieramv = $db->prepare('INSERT INTO amv(IDanime,video,IDmembre,date) VALUES (:IDanime,:video,:IDmembre,NOW())');
									$modifieramv->execute(array(
									'IDanime' => $IDanime,
									'video' => $video,
									'IDmembre' => $IDmembre
									));
									
									$erroranime20 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Amv ajouter.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime19
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
									
									$erroranime20 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette amv existe déjà.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime19
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
						}
						else
						{
							
							$erroranime20 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime19
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime20']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime20titre']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$generique = htmlspecialchars($_POST['modifieradminanime20generique']);
						$video = htmlspecialchars($_POST['modifieradminanime20video']);
						$IDmembre = $_SESSION['ID'];
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titreanime));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{	
							if($generique == 'OPENING')
							{
								$searchopeningexist = $db->prepare('SELECT * FROM opening WHERE IDanime = ?');
								$searchopeningexist->execute(array($IDanime));
								$openingexist = $searchopeningexist->rowCount();
								if($openingexist == 1)
								{		
									$modifieropening = $db->prepare('UPDATE opening SET video = :video WHERE IDanime = :IDanime');
									$modifieropening->execute(array(
									'IDanime' => $IDanime,
									'video' => $video
									));
									
									$erroranime21 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Opening modifier.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime20
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
									
									$erroranime21 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette opening n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime20
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($generique == 'ENDING')
							{
								$searchendingexist = $db->prepare('SELECT * FROM ending WHERE IDanime = ?');
								$searchendingexist->execute(array($IDanime));
								$endingexist = $searchendingexist->rowCount();
								if($endingexist == 1)
								{		
									$modifierending = $db->prepare('UPDATE ending SET video = :video WHERE IDanime = :IDanime');
									$modifierending->execute(array(
									'IDanime' => $IDanime,
									'video' => $video
									));
									
									$erroranime21 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Ending modifier.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime20
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
									
									$erroranime21 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette ending n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime20
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($generique == 'AMV')
							{
								$searchamvexist = $db->prepare('SELECT * FROM amv WHERE IDanime = ?');
								$searchamvexist->execute(array($IDanime));
								$amvexist = $searchamvexist->rowCount();
								if($amvexist == 1)
								{		
									$modifieramv = $db->prepare('UPDATE amv SET video = :video WHERE IDanime = :IDanime');
									$modifieramv->execute(array(
									'IDanime' => $IDanime,
									'video' => $video
									));
									
									$erroranime21 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Amv modifier.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime20
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
									
									$erroranime21 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette amv n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime20
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
						}
						else
						{
							
							$erroranime21 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime20
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime21']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime21titre']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$zone = htmlspecialchars($_POST['modifieradminanime21zone']);
						$numero = htmlspecialchars($_POST['modifieradminanime21numero']);
						$IDmembre = $_SESSION['ID'];
						$lecteurvideo = htmlspecialchars($_POST['modifieradminanime21lecteurvideo']);
						$nomvideo = htmlspecialchars($_POST['modifieradminanime21nomvideo']);
						$video = htmlspecialchars($_POST['modifieradminanime21video']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titreanime));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{	
							if($zone == 'EPISODE')
							{
								$searchvideoepisodeexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND numero = ?');
								$searchvideoepisodeexist->execute(array($IDanime,$numero));
								$videoepisodeexist = $searchvideoepisodeexist->rowCount();
								if($videoepisodeexist == 1)
								{	
									$searchidepisodeexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND numero = ?');
									$searchidepisodeexist->execute(array($IDanime,$numero));
									$idepisodeexist = $searchidepisodeexist->fetch();
									$IDepisode = $idepisodeexist['ID'];
									
									$searchnomvideoepisodeexist = $db->prepare('SELECT * FROM videoepisodes WHERE IDepisode = ? AND nomvideo = ?');
									$searchnomvideoepisodeexist->execute(array($IDepisode,$nomvideo));
									$nomvideoepisodeexist = $searchnomvideoepisodeexist->rowCount();
									if($nomvideoepisodeexist == 0)
									{	
										$modifiervideoepisode = $db->prepare('INSERT INTO videoepisodes(IDepisode,IDmembre,lecteurvideo,nomvideo,video,date_ajout) VALUES (:IDepisode,:IDmembre,:lecteurvideo,:nomvideo,:video,NOW())');
										$modifiervideoepisode->execute(array(
										'IDepisode' => $IDepisode,
										'IDmembre' => $IDmembre,
										'lecteurvideo' => $lecteurvideo,
										'nomvideo' => $nomvideo,
										'video' => $video
										));
										
										$erroranime22 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video ajouter.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime21
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
										
										$erroranime22 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video est indisponible.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime21
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
								}
								else
								{
									
									$erroranime22 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette épisode n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime21
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($zone == 'FILM')
							{
								$searchvideofilmexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
								$searchvideofilmexist->execute(array($IDanime,$numero));
								$videofilmexist = $searchvideofilmexist->rowCount();
								if($videofilmexist == 1)
								{	
									$searchidfilmexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
									$searchidfilmexist->execute(array($IDanime,$numero));
									$idfilmexist = $searchidfilmexist->fetch();
									$IDfilmanime = $idfilmexist['ID'];
									
									$searchnomvideofilmexist = $db->prepare('SELECT * FROM videofilmanime WHERE IDfilmanime = ? AND nomvideo = ?');
									$searchnomvideofilmexist->execute(array($IDfilmanime,$nomvideo));
									$nomvideofilmexist = $searchnomvideofilmexist->rowCount();
									if($nomvideofilmexist == 0)
									{
										$modifiervideofilm = $db->prepare('INSERT INTO videofilmanime(IDfilmanime,IDmembre,lecteurvideo,nomvideo,video,date_ajout) VALUES (:IDfilmanime,:IDmembre,:lecteurvideo,:nomvideo,:video,NOW())');
										$modifiervideofilm->execute(array(
										'IDfilmanime' => $IDfilmanime,
										'IDmembre' => $IDmembre,
										'lecteurvideo' => $lecteurvideo,
										'nomvideo' => $nomvideo,
										'video' => $video
										));
										
										$erroranime22 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video ajouter.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime21
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
										
										$erroranime22 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video est indisponible.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime21
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
								}
								else
								{
											
									$erroranime22 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime21
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($zone == 'FILMSPECIAL')
							{
								$searchvideofilmspecialexist = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
								$searchvideofilmspecialexist->execute(array($IDanime,$numero));
								$videofilmspecialexist = $searchvideofilmspecialexist->rowCount();
								if($videofilmspecialexist == 1)
								{	
									$searchidfilmspecialexist = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
									$searchidfilmspecialexist->execute(array($IDanime,$numero));
									$idfilmspecialexist = $searchidfilmspecialexist->fetch();
									$IDfilmspecial = $idfilmspecialexist['ID'];
									
									$searchnomvideofilmspecialexist = $db->prepare('SELECT * FROM videofilmspecial WHERE IDfilmspecial = ? AND nomvideo = ?');
									$searchnomvideofilmspecialexist->execute(array($IDfilmspecial,$nomvideo));
									$nomvideofilmspecialexist = $searchnomvideofilmspecialexist->rowCount();
									if($nomvideofilmspecialexist == 0)
									{
										$modifiervideofilmspecial = $db->prepare('INSERT INTO videofilmspecial(IDfilmspecial,IDmembre,lecteurvideo,nomvideo,video,date_ajout) VALUES (:IDfilmspecial,:IDmembre,:lecteurvideo,:nomvideo,:video,NOW())');
										$modifiervideofilmspecial->execute(array(
										'IDfilmspecial' => $IDfilmspecial,
										'IDmembre' => $IDmembre,
										'lecteurvideo' => $lecteurvideo,
										'nomvideo' => $nomvideo,
										'video' => $video
										));
										
										$erroranime22 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video ajouter.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime21
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
										
										$erroranime22 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video est indisponible.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime21
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
								}
								else
								{
									
									$erroranime22 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film spécial n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime21
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($zone == 'OAV')
							{
								$searchvideooavexist = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
								$searchvideooavexist->execute(array($IDanime,$numero));
								$videooavexist = $searchvideooavexist->rowCount();
								if($videooavexist == 1)
								{	
									$searchidoavexist = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
									$searchidoavexist->execute(array($IDanime,$numero));
									$idoavexist = $searchidoavexist->fetch();
									$IDoav = $idoavexist['ID'];
									
									$searchnomvideooavexist = $db->prepare('SELECT * FROM videooav WHERE IDoav = ? AND nomvideo = ?');
									$searchnomvideooavexist->execute(array($IDoav,$nomvideo));
									$nomvideooavexist = $searchnomvideooavexist->rowCount();
									if($nomvideooavexist == 0)
									{
										$modifiervideooav = $db->prepare('INSERT INTO videooav(IDoav,IDmembre,lecteurvideo,nomvideo,video,date_ajout) VALUES (:IDoav,:IDmembre,:lecteurvideo,:nomvideo,:video,NOW())');
										$modifiervideooav->execute(array(
										'IDoav' => $IDoav,
										'IDmembre' => $IDmembre,
										'lecteurvideo' => $lecteurvideo,
										'nomvideo' => $nomvideo,
										'video' => $video
										));
										
										$erroranime22 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video ajouter.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime21
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
										
										$erroranime22 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video est indisponible.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime21
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
								}
								else
								{
									
									$erroranime22 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette oav n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime21
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
						}
						else
						{
							
							$erroranime22 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime21
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime22']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime22titre']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$zone = htmlspecialchars($_POST['modifieradminanime22zone']);
						$numero = htmlspecialchars($_POST['modifieradminanime22numero']);
						$IDmembre = $_SESSION['ID'];
						$nomvideo = htmlspecialchars($_POST['modifieradminanime22nomvideo']);
						$video = htmlspecialchars($_POST['modifieradminanime22video']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titreanime));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{	
							if($zone == 'EPISODE')
							{
								$searchvideoepisodeexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND numero = ?');
								$searchvideoepisodeexist->execute(array($IDanime,$numero));
								$videoepisodeexist = $searchvideoepisodeexist->rowCount();
								if($videoepisodeexist == 1)
								{	
									$searchidepisodeexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND numero = ?');
									$searchidepisodeexist->execute(array($IDanime,$numero));
									$idepisodeexist = $searchidepisodeexist->fetch();
									$IDepisode = $idepisodeexist['ID'];
									
									$searchnomvideoepisodeexist = $db->prepare('SELECT * FROM videoepisodes WHERE IDepisode = ? AND nomvideo = ?');
									$searchnomvideoepisodeexist->execute(array($IDepisode,$nomvideo));
									$nomvideoepisodeexist = $searchnomvideoepisodeexist->rowCount();
									if($nomvideoepisodeexist == 1)
									{	
										$modifiervideoepisode = $db->prepare('UPDATE videoepisodes SET video = :video WHERE IDepisode = :IDepisode AND nomvideo = :nomvideo');
										$modifiervideoepisode->execute(array(
										'video' => $video,
										'IDepisode' => $IDepisode,
										'nomvideo' => $nomvideo
										));
										
										$erroranime23 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video modifier.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime22
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
										
										$erroranime23 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video n'existe pas.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime22
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
								}
								else
								{
									
									$erroranime23 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette épisode n\existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime22
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($zone == 'FILM')
							{
								$searchvideofilmexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
								$searchvideofilmexist->execute(array($IDanime,$numero));
								$videofilmexist = $searchvideofilmexist->rowCount();
								if($videofilmexist == 1)
								{	
									$searchidfilmexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
									$searchidfilmexist->execute(array($IDanime,$numero));
									$idfilmexist = $searchidfilmexist->fetch();
									$IDfilmanime = $idfilmexist['ID'];
									
									$searchnomvideofilmexist = $db->prepare('SELECT * FROM videofilmanime WHERE IDfilmanime = ? AND nomvideo = ?');
									$searchnomvideofilmexist->execute(array($IDfilmanime,$nomvideo));
									$nomvideofilmexist = $searchnomvideofilmexist->rowCount();
									if($nomvideofilmexist == 1)
									{
										$modifiervideofilm = $db->prepare('UPDATE videofilmanime SET video = :video WHERE IDfilmanime = :IDfilmanime AND nomvideo = :nomvideo');
										$modifiervideofilm->execute(array(
										'video' => $video,
										'IDfilmanime' => $IDfilmanime,
										'nomvideo' => $nomvideo
										));
										
										$erroranime23 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video modifier.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime22
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
										
										$erroranime23 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video n'existe pas.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime22
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
								}
								else
								{
									
									$erroranime23 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime22
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($zone == 'FILMSPECIAL')
							{
								$searchvideofilmspecialexist = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
								$searchvideofilmspecialexist->execute(array($IDanime,$numero));
								$videofilmspecialexist = $searchvideofilmspecialexist->rowCount();
								if($videofilmspecialexist == 1)
								{	
									$searchidfilmspecialexist = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
									$searchidfilmspecialexist->execute(array($IDanime,$numero));
									$idfilmspecialexist = $searchidfilmspecialexist->fetch();
									$IDfilmspecial = $idfilmspecialexist['ID'];
									
									$searchnomvideofilmspecialexist = $db->prepare('SELECT * FROM videofilmspecial WHERE IDfilmspecial = ? AND nomvideo = ?');
									$searchnomvideofilmspecialexist->execute(array($IDfilmspecial,$nomvideo));
									$nomvideofilmspecialexist = $searchnomvideofilmspecialexist->rowCount();
									if($nomvideofilmspecialexist == 1)
									{
										$modifiervideofilmspecial = $db->prepare('UPDATE videofilmspecial SET video = :video WHERE IDfilmspecial = :IDfilmspecial AND nomvideo = :nomvideo');
										$modifiervideofilmspecial->execute(array(
										'video' => $video,
										'IDfilmspecial' => $IDfilmspecial,
										'nomvideo' => $nomvideo
										));
										
										$erroranime23 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video modifier.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime22
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
										
										$erroranime23 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video n'existe pas.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime22
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
								}
								else
								{
									
									$erroranime23 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce fiml spécial n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime22
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($zone == 'OAV')
							{
								$searchvideooavexist = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
								$searchvideooavexist->execute(array($IDanime,$numero));
								$videooavexist = $searchvideooavexist->rowCount();
								if($videooavexist == 1)
								{	
									$searchidoavexist = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
									$searchidoavexist->execute(array($IDanime,$numero));
									$idoavexist = $searchidoavexist->fetch();
									$IDoav = $idoavexist['ID'];
									
									$searchnomvideooavexist = $db->prepare('SELECT * FROM videooav WHERE IDoav = ? AND nomvideo = ?');
									$searchnomvideooavexist->execute(array($IDoav,$nomvideo));
									$nomvideooavexist = $searchnomvideooavexist->rowCount();
									if($nomvideooavexist == 1)
									{
										$modifiervideooav = $db->prepare('UPDATE videooav SET video = :video WHERE IDoav = :IDoav AND nomvideo = :nomvideo');
										$modifiervideooav->execute(array(
										'video' => $video,
										'IDoav' => $IDoav,
										'nomvideo' => $nomvideo
										));
										
										$erroranime23 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video modifier.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime22
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
									?>
										<script>
											alert('Le nom de la vidéo n\'éxiste pas.');
										</script>
										
										<style>
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime22
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
								}
								else
								{
									
									$erroranime23 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette oav n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime22
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
						}
						else
						{
							
							$erroranime23 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime22
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminanime23']))
					{
						$titreanime = htmlspecialchars($_POST['modifieradminanime23titre']);
						$searchidtitreanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchidtitreanimeexist->execute(array($titreanime));
						$idtitreanimeexist = $searchidtitreanimeexist->fetch();
						$IDanime = $idtitreanimeexist['ID'];
						$zone = htmlspecialchars($_POST['modifieradminanime23zone']);
						$numero = htmlspecialchars($_POST['modifieradminanime23numero']);
						$nomvideo = htmlspecialchars($_POST['modifieradminanime23nomvideo']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titreanime));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{	
							if($zone == 'EPISODE')
							{
								$searchvideoepisodeexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND numero = ?');
								$searchvideoepisodeexist->execute(array($IDanime,$numero));
								$videoepisodeexist = $searchvideoepisodeexist->rowCount();
								if($videoepisodeexist == 1)
								{	
									$searchidepisodeexist = $db->prepare('SELECT * FROM episodes WHERE IDanime = ? AND numero = ?');
									$searchidepisodeexist->execute(array($IDanime,$numero));
									$idepisodeexist = $searchidepisodeexist->fetch();
									$IDepisode = $idepisodeexist['ID'];
									
									$searchnomvideoepisodeexist = $db->prepare('SELECT * FROM videoepisodes WHERE IDepisode = ? AND nomvideo = ?');
									$searchnomvideoepisodeexist->execute(array($IDepisode,$nomvideo));
									$nomvideoepisodeexist = $searchnomvideoepisodeexist->rowCount();
									if($nomvideoepisodeexist == 1)
									{	
										$suppvideoepisode = $db->prepare('DELETE FROM videoepisodes WHERE IDepisode = :IDepisode AND nomvideo = :nomvideo');
										$suppvideoepisode->execute(array(
										'IDepisode' => $IDepisode,
										'nomvideo' => $nomvideo
										));
										
										$erroranime24 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video supprimer.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime23
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
										
										$erroranime24 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video n'existe pas.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime23
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
								}
								else
								{
									
									$erroranime24 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette épisode n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime23
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($zone == 'FILM')
							{
								$searchvideofilmexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
								$searchvideofilmexist->execute(array($IDanime,$numero));
								$videofilmexist = $searchvideofilmexist->rowCount();
								if($videofilmexist == 1)
								{	
									$searchidfilmexist = $db->prepare('SELECT * FROM filmsanimes WHERE IDanime = ? AND numero = ?');
									$searchidfilmexist->execute(array($IDanime,$numero));
									$idfilmexist = $searchidfilmexist->fetch();
									$IDfilmanime = $idfilmexist['ID'];
									
									$searchnomvideofilmexist = $db->prepare('SELECT * FROM videofilmanime WHERE IDfilmanime = ? AND nomvideo = ?');
									$searchnomvideofilmexist->execute(array($IDfilmanime,$nomvideo));
									$nomvideofilmexist = $searchnomvideofilmexist->rowCount();
									if($nomvideofilmexist == 1)
									{
										$suppvideofilmanime = $db->prepare('DELETE FROM videofilmanime WHERE IDfilmanime = :IDfilmanime AND nomvideo = :nomvideo');
										$suppvideofilmanime->execute(array(
										'IDfilmanime' => $IDfilmanime,
										'nomvideo' => $nomvideo
										));
										
										$erroranime24 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video supprimer.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime23
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
										
										$erroranime24 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video n'existe pas.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime23
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
								}
								else
								{
									
									$erroranime24 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime23
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($zone == 'FILMSPECIAL')
							{
								$searchvideofilmspecialexist = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
								$searchvideofilmspecialexist->execute(array($IDanime,$numero));
								$videofilmspecialexist = $searchvideofilmspecialexist->rowCount();
								if($videofilmspecialexist == 1)
								{	
									$searchidfilmspecialexist = $db->prepare('SELECT * FROM filmsspecial WHERE IDanime = ? AND numero = ?');
									$searchidfilmspecialexist->execute(array($IDanime,$numero));
									$idfilmspecialexist = $searchidfilmspecialexist->fetch();
									$IDfilmspecial = $idfilmspecialexist['ID'];
									
									$searchnomvideofilmspecialexist = $db->prepare('SELECT * FROM videofilmspecial WHERE IDfilmspecial = ? AND nomvideo = ?');
									$searchnomvideofilmspecialexist->execute(array($IDfilmspecial,$nomvideo));
									$nomvideofilmspecialexist = $searchnomvideofilmspecialexist->rowCount();
									if($nomvideofilmspecialexist == 1)
									{
										$suppvideofilmspecial = $db->prepare('DELETE FROM videofilmspecial WHERE IDfilmspecial = :IDfilmspecial AND nomvideo = :nomvideo');
										$suppvideofilmspecial->execute(array(
										'IDfilmspecial' => $IDfilmspecial,
										'nomvideo' => $nomvideo
										));
										
										$erroranime24 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video supprimer.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime23
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
										
										$erroranime24 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video n'existe pas.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime23
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
								}
								else
								{
									
										$erroranime24 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film spécial n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime23
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
							else if($zone == 'OAV')
							{
								$searchvideooavexist = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
								$searchvideooavexist->execute(array($IDanime,$numero));
								$videooavexist = $searchvideooavexist->rowCount();
								if($videooavexist == 1)
								{	
									$searchidoavexist = $db->prepare('SELECT * FROM oavs WHERE IDanime = ? AND numero = ?');
									$searchidoavexist->execute(array($IDanime,$numero));
									$idoavexist = $searchidoavexist->fetch();
									$IDoav = $idoavexist['ID'];
									
									$searchnomvideooavexist = $db->prepare('SELECT * FROM videooav WHERE IDoav = ? AND nomvideo = ?');
									$searchnomvideooavexist->execute(array($IDoav,$nomvideo));
									$nomvideooavexist = $searchnomvideooavexist->rowCount();
									if($nomvideooavexist == 1)
									{
										$suppvideooav = $db->prepare('DELETE FROM videooav WHERE IDoav = :IDoav AND nomvideo = :nomvideo');
										$suppvideooav->execute(array(
										'IDoav' => $IDoav,
										'nomvideo' => $nomvideo
										));
										
										$erroranime24 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video supprimer.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime23
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
									else
									{
										
										$erroranime24 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video n'existe pas.\" />";
							
									?>
										<style>
											#body
											{
												padding-top: 109px;
												margin-top: 0px;
											}
											#header
											{
												height: 110px;
											}
											#contenuloading
											{
												opacity: 1;
											}
											#imgloading
											{
												width: 0px;
											}
											#imgloading2
											{
												width: 0px;
											}
											#imgloading3
											{
												width: 0px;
											}
											#imgloading4
											{
												width: 0px;
											}
											#spanloading
											{
												display: none;
											}
											#loading
											{
												width: 0px;
											}
											.contenuadmin
											{
												background: rgb(30,30,30);
											}
											.blockidentifiantadmin
											{
												display: none;
											}
											.hradmin
											{
												display: none;
											}
											#contenuadministration
											{
												display: block;
											}
											#blockadmin
											{
												display: none;
											}
											#contenublockadminanime
											{
												display: block;
											}
											#contenumodifieradminanime23
											{
												right: 35.6%;
											}
										</style>
									<?php
									}
								}
								else
								{
									
									$erroranime24 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette oav n'existe pas.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime23
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
							}
						}
						else
						{
							
							$erroranime24 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime23
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['blockadminanimeepisode24supprimer']))
					{
						$ID = $_POST['blockadminanimeepisode24idinfo'];
						
						$supprimersignalevideo = $db->prepare('DELETE FROM signaleepisode WHERE ID = :ID');
						$supprimersignalevideo->execute(array(
						'ID' => $ID
						));
						
							$erroranime25 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Signalement supprimer.\" />";
							
						?>
						<style>
							#body
							{
								padding-top: 109px;
								margin-top: 0px;
							}
							#header
							{
								height: 110px;
							}
							#contenuloading
							{
								opacity: 1;
							}
							#imgloading
							{
								width: 0px;
							}
							#imgloading2
							{
								width: 0px;
							}
							#imgloading3
							{
								width: 0px;
							}
							#imgloading4
							{
								width: 0px;
							}
							#spanloading
							{
								display: none;
							}
							#loading
							{
								width: 0px;
							}
							.contenuadmin
							{
								background: rgb(30,30,30);
							}
							.blockidentifiantadmin
							{
								display: none;
							}
							.hradmin
							{
								display: none;
							}
							#contenuadministration
							{
								display: block;
							}
							#blockadmin
							{
								display: none;
							}
							#contenublockadminanime
							{
								display: block;
							}
							#contenumodifieradminanime24
							{
								right: 35.6%;
							}
						</style>
					<?php
					}
					
					if(isset($_POST['blockadminanimefilmanime24supprimer']))
					{
						$ID = $_POST['blockadminanimefilmanime24idinfo'];
						
						$supprimersignalevideo = $db->prepare('DELETE FROM signalefilmanime WHERE ID = :ID');
						$supprimersignalevideo->execute(array(
						'ID' => $ID
						));
						
							$erroranime25 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Signalement supprimer.\" />";
							
						?>
						<style>
							#body
							{
								padding-top: 109px;
								margin-top: 0px;
							}
							#header
							{
								height: 110px;
							}
							#contenuloading
							{
								opacity: 1;
							}
							#imgloading
							{
								width: 0px;
							}
							#imgloading2
							{
								width: 0px;
							}
							#imgloading3
							{
								width: 0px;
							}
							#imgloading4
							{
								width: 0px;
							}
							#spanloading
							{
								display: none;
							}
							#loading
							{
								width: 0px;
							}
							.contenuadmin
							{
								background: rgb(30,30,30);
							}
							.blockidentifiantadmin
							{
								display: none;
							}
							.hradmin
							{
								display: none;
							}
							#contenuadministration
							{
								display: block;
							}
							#blockadmin
							{
								display: none;
							}
							#contenublockadminanime
							{
								display: block;
							}
							#contenumodifieradminanime24
							{
								right: 35.6%;
							}
						</style>
					<?php
					}
					
					if(isset($_POST['blockadminanimespecial24supprimer']))
					{
						$ID = $_POST['blockadminanimespecial24idinfo'];
						
						$supprimersignalevideo = $db->prepare('DELETE FROM signalespecial WHERE ID = :ID');
						$supprimersignalevideo->execute(array(
						'ID' => $ID
						));
						
							$erroranime25 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Signalement supprimer.\" />";
							
						?>
						<style>
							#body
							{
								padding-top: 109px;
								margin-top: 0px;
							}
							#header
							{
								height: 110px;
							}
							#contenuloading
							{
								opacity: 1;
							}
							#imgloading
							{
								width: 0px;
							}
							#imgloading2
							{
								width: 0px;
							}
							#imgloading3
							{
								width: 0px;
							}
							#imgloading4
							{
								width: 0px;
							}
							#spanloading
							{
								display: none;
							}
							#loading
							{
								width: 0px;
							}
							.contenuadmin
							{
								background: rgb(30,30,30);
							}
							.blockidentifiantadmin
							{
								display: none;
							}
							.hradmin
							{
								display: none;
							}
							#contenuadministration
							{
								display: block;
							}
							#blockadmin
							{
								display: none;
							}
							#contenublockadminanime
							{
								display: block;
							}
							#contenumodifieradminanime24
							{
								right: 35.6%;
							}
						</style>
					<?php
					}
					
					if(isset($_POST['blockadminanimeoav24supprimer']))
					{
						$ID = $_POST['blockadminanimeoav24idinfo'];
						
						$supprimersignalevideo = $db->prepare('DELETE FROM signaleoav WHERE ID = :ID');
						$supprimersignalevideo->execute(array(
						'ID' => $ID
						));
						
							$erroranime25 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Signalement supprimer.\" />";
							
						?>
						<style>
							#body
							{
								padding-top: 109px;
								margin-top: 0px;
							}
							#header
							{
								height: 110px;
							}
							#contenuloading
							{
								opacity: 1;
							}
							#imgloading
							{
								width: 0px;
							}
							#imgloading2
							{
								width: 0px;
							}
							#imgloading3
							{
								width: 0px;
							}
							#imgloading4
							{
								width: 0px;
							}
							#spanloading
							{
								display: none;
							}
							#loading
							{
								width: 0px;
							}
							.contenuadmin
							{
								background: rgb(30,30,30);
							}
							.blockidentifiantadmin
							{
								display: none;
							}
							.hradmin
							{
								display: none;
							}
							#contenuadministration
							{
								display: block;
							}
							#blockadmin
							{
								display: none;
							}
							#contenublockadminanime
							{
								display: block;
							}
							#contenumodifieradminanime24
							{
								right: 35.6%;
							}
						</style>
					<?php
					}
					
					if(isset($_POST['modifieradminanime25deletesaison']))
					{
						$titre = htmlspecialchars($_POST['modifieradminanime25titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1)
						{
							$searchidanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
							$searchidanimeexist->execute(array($titre));
							$idanimeexist = $searchidanimeexist->fetch();
							$IDanime = $idanimeexist['ID'];
							$IDsaison =  htmlspecialchars($_POST['modifieradminanime25saison']);
							$searchsaisonexist = $db->prepare('SELECT * FROM saison WHERE IDanime = ? AND IDsaison = ?');
							$searchsaisonexist->execute(array($IDanime,$IDsaison));
							$saisonexist = $searchsaisonexist->rowCount();
							if($saisonexist == 1)
							{
								
								$searchepisodeexistsaison = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $IDanime . '\' AND IDsaison =\'' . $IDsaison . '\'');
								$saisonexistepisode = $searchepisodeexistsaison->rowCount();
								if($saisonexistepisode == 0)
								{
									$deletesaison = $db->query('DELETE FROM saison WHERE IDanime=\'' . $IDanime . '\' AND IDsaison=\'' . $IDsaison . '\'');
									
									$erroranime25deletesaison = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Saison supprimer.\" />";
							
								?>
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminanime
										{
											display: block;
										}
										#contenumodifieradminanime25
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
								
									$erroranime25deletesaison = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette saison contient des épisode.\" />";
								
								?>
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminanime
									{
										display: block;
									}
									#contenumodifieradminanime25
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
							
								$erroranime25deletesaison = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette saison n'existe pas.\" />";
							
							?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime25
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
						
							$erroranime25deletesaison = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
							
						?>
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminanime
								{
									display: block;
								}
								#contenumodifieradminanime25
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['blockadmin26supprimer']))
					{
						$ID = $_POST['blockadmin26idcommentaireinfo'];
						$page = $_POST['blockadmin26pagecommentaireinfo'];
						
						$supprimersignalecommentaire = $db->prepare('DELETE FROM signalecommentaire WHERE ID = :ID AND page = :page');
						$supprimersignalecommentaire->execute(array(
						'ID' => $ID,
						'page' => $page
						));
						
							$erroranime26 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Signalement supprimer.\" />";
							
						?>
						<style>
							#body
							{
								padding-top: 109px;
								margin-top: 0px;
							}
							#header
							{
								height: 110px;
							}
							#contenuloading
							{
								opacity: 1;
							}
							#imgloading
							{
								width: 0px;
							}
							#imgloading2
							{
								width: 0px;
							}
							#imgloading3
							{
								width: 0px;
							}
							#imgloading4
							{
								width: 0px;
							}
							#spanloading
							{
								display: none;
							}
							#loading
							{
								width: 0px;
							}
							.contenuadmin
							{
								background: rgb(30,30,30);
							}
							.blockidentifiantadmin
							{
								display: none;
							}
							.hradmin
							{
								display: none;
							}
							#contenuadministration
							{
								display: block;
							}
							#blockadmin
							{
								display: none;
							}
							#contenublockadminanime
							{
								display: block;
							}
							#contenumodifieradminanime26
							{
								right: 35.6%;
							}
						</style>
					<?php
					}
					
					if(isset($_POST['modifieradminfilm1valider']))
					{
						$IDmembre = $_SESSION['ID'];
						$titre = htmlspecialchars($_POST['modifieradminfilm1titre']);
						$image = $_FILES['modifieradminfilm1img']['size'];
						$lettre = htmlspecialchars($_POST['modifieradminfilm1lettre']);
						$date = htmlspecialchars($_POST['modifieradminfilm1date']);
						$realisateur = htmlspecialchars($_POST['modifieradminfilm1realisateur']);
						if(isset($_POST['modifieradminfilm1genreaction']))
						{
							$genreaction = htmlspecialchars($_POST['modifieradminfilm1genreaction']);
						}
						else
						{
							$genreaction = "null";
						}
						
						if(isset($_POST['modifieradminfilm1genreaventure']))
						{
							$genreaventure =  htmlspecialchars($_POST['modifieradminfilm1genreaventure']);
						}
						else
						{
							$genreaventure = "null";
						}
						
						if(isset($_POST['modifieradminfilm1genreamitier']))
						{
							$genreamitier =  htmlspecialchars($_POST['modifieradminfilm1genreamitier']);
						}
						else
						{
							$genreamitier = "null";
						}
						
						if(isset($_POST['modifieradminfilm1genrecomedie']))
						{
							$genrecomedie =  htmlspecialchars($_POST['modifieradminfilm1genrecomedie']);
						}
						else
						{
							$genrecomedie = "null";
						}
						
						if(isset($_POST['modifieradminfilm1genredrame']))
						{
							$genredrame =  htmlspecialchars($_POST['modifieradminfilm1genredrame']);
						}
						else
						{
							$genredrame = "null";
						}
						
						if(isset($_POST['modifieradminfilm1genrefantastique']))
						{
							$genrefantastique =  htmlspecialchars($_POST['modifieradminfilm1genrefantastique']);
						}
						else
						{
							$genrefantastique = "null";
						}
						
						if(isset($_POST['modifieradminfilm1genreguerre']))
						{
							$genreguerre =  htmlspecialchars($_POST['modifieradminfilm1genreguerre']);
						}
						else
						{
							$genreguerre = "null";
						}
						
						if(isset($_POST['modifieradminfilm1genrecyber']))
						{
							$genrecyber =  htmlspecialchars($_POST['modifieradminfilm1genrecyber']);
						}
						else
						{
							$genrecyber = "null";
						}
						
						if(isset($_POST['modifieradminfilm1genremecha']))
						{
							$genremecha =  htmlspecialchars($_POST['modifieradminfilm1genremecha']);
						}
						else
						{
							$genremecha = "null";
						}
						
						if(isset($_POST['modifieradminfilm1genresport']))
						{
							$genresport =  htmlspecialchars($_POST['modifieradminfilm1genresport']);
						}
						else
						{
							$genresport = "null";
						}
						
						if(isset($_POST['modifieradminfilm1genrehorreur']))
						{
							$genrehorreur =  htmlspecialchars($_POST['modifieradminfilm1genrehorreur']);
						}
						else
						{
							$genrehorreur = "null";
						}
						$synopsis = htmlspecialchars($_POST['modifieradminfilm1synopsis']);
						$durer = htmlspecialchars($_POST['modifieradminfilm1durer']);
						$bandeannonce =  htmlspecialchars($_POST['modifieradminfilm1bandeannonce']);
						if(isset($_POST['modifieradminfilm1videovf']))
						{
							$videovf =  htmlspecialchars($_POST['modifieradminfilm1videovf']);
						}
						else
						{
							$videovf = "";
						}
						if(isset($_POST['modifieradminfilm1videovostfr']))
						{
							$videovostfr =  htmlspecialchars($_POST['modifieradminfilm1videovostfr']);
						}
						else
						{
							$videovostfr = "";
						}
						
						$extension = strtolower(substr(strrchr($_FILES['modifieradminfilm1img']['name'], '.'),1));
						$perm_ext = array('jpg','jpeg','png');
						if(in_array($extension,$perm_ext))
						{
							$nomimage = $_FILES['modifieradminfilm1img']['name'];
							$chemin = "../film/".$_FILES['modifieradminfilm1img']['name'];
							move_uploaded_file($_FILES['modifieradminfilm1img']['tmp_name'],$chemin);
							$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
							$searchfilmexist->execute(array($titre));
							$filmexist = $searchfilmexist->rowCount();
							if($filmexist == 0)
							{
								$ajouterfilm = $db->prepare('INSERT INTO films(IDmembre,titre,image,lettre,date,realisateur,action,aventure,amitier,comedie,drame,fantastique,guerre,cyber,mecha,sport,horreur,synopsis,durer,bandeannonce,videovf,videovostfr,note,date_ajout) VALUES (:IDmembre,:titre,:image,:lettre,:date,:realisateur,:action,:aventure,:amitier,:comedie,:drame,:fantastique,:guerre,:cyber,:mecha,:sport,:horreur,:synopsis,:durer,:bandeannonce,:videovf,:videovostfr,:note,NOW())');
								$ajouterfilm->execute(array(
								'IDmembre' => $IDmembre,
								'titre' => $titre,
								'image' => $nomimage,
								'lettre' => $lettre,
								'date' => $date,
								'realisateur' => $realisateur,
								'action' => $genreaction,
								'aventure' => $genreaventure,
								'amitier' => $genreamitier,
								'comedie' => $genrecomedie,
								'drame' => $genredrame,
								'fantastique' => $genrefantastique,
								'guerre' => $genreguerre,
								'cyber' => $genrecyber,
								'mecha' => $genremecha,
								'sport' => $genresport,
								'horreur' => $genrehorreur,
								'synopsis' => $synopsis,
								'durer' => $durer,
								'bandeannonce' => $bandeannonce,
								'videovf' => $videovf,
								'videovostfr' => $videovostfr,
								'note' => null
								));
								
								$errorfilm1 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Film ajouter.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm1
									{
										right: 35.6%;
									}
								</style>
					<?php
							}
							else
							{
								
								$errorfilm1 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film existe déjà.\" />";
					
							?>		
								<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm1
								{
									right: 35.6%;
								}
							</style>
						<?php
							}
						}
						else
						{
							
							$errorfilm1 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm1
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm2validermodifiertitre']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminfilm2titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{
							if($_POST['modifieradminfilm2modifiertitre'] !== "")
							{
								$modifiertitre = htmlspecialchars($_POST['modifieradminfilm2modifiertitre']);
								
								$modifierfilm = $db->prepare('UPDATE films SET titre = :modifiertitre WHERE titre = :titre');
								$modifierfilm->execute(array(
								'modifiertitre' => $modifiertitre,
								'titre' => $titre
								));
								
								$errorfilm2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Titre modifier.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le titre.\" />";
					
							?>		
								<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#cont	nuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm2validerlettre']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminfilm2titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{
							if($_POST['modifieradminfilm2lettre'] !== "")
							{
								$lettre = htmlspecialchars($_POST['modifieradminfilm2lettre']);
								
								$modifierfilm = $db->prepare('UPDATE films SET lettre = :lettre WHERE titre = :titre');
								$modifierfilm->execute(array(
								'lettre' => $lettre,
								'titre' => $titre
								));
								
								$errorfilm2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Lettre modifier.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le premier caractère.\" />";
					
							?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm2validerimg']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminfilm2titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{	
							$taille = $_FILES['modifieradminfilm2img']['size'];
							if($taille >= 1)
							{
								$extension = strtolower(substr(strrchr($_FILES['modifieradminfilm2img']['name'], '.'),1));
								$perm_ext = array('jpg','jpeg','png');
								if(in_array($extension,$perm_ext))
								{
									$selectimagefilm = $db->query('SELECT * FROM films WHERE titre=\'' . $titre . '\'');
									$imagefilm = $selectimagefilm->fetch();
									
									@unlink("../film/" . $imagefilm['image']);
									
									$image = $_FILES['modifieradminfilm2img']['size'];
									$nomimage = $_FILES['modifieradminfilm2img']['name'];
									$chemin = "../film/".$_FILES['modifieradminfilm2img']['name'];
									move_uploaded_file($_FILES['modifieradminfilm2img']['tmp_name'],$chemin);
									
									$modifierfilm = $db->prepare('UPDATE films SET image = :image WHERE titre = :titre');
									$modifierfilm->execute(array(
									'image' => $nomimage,
									'titre' => $titre
									));
									
									$errorfilm2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Image modifier.\" />";
					
								?>		
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminfilm
										{
											display: block;
										}
										#contenumodifieradminfilm2
										{
											right: 35.6%;
										}
									</style>
								<?php
								}
								else
								{
									
									$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
					
								?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
								<?php
								}
							}
							else
							{
								
								$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier l'image.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm2validerdate']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminfilm2titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{
							if($_POST['modifieradminfilm2date'] !== "")
							{
								$date = htmlspecialchars($_POST['modifieradminfilm2date']);
								
								$modifierfilm = $db->prepare('UPDATE films SET date = :date WHERE titre = :titre');
								$modifierfilm->execute(array(
								'date' => $date,
								'titre' => $titre
								));
								
								$errorfilm2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Date modifier.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la date.\" />";
					
							?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm2validerrealisateur']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminfilm2titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{
							if($_POST['modifieradminfilm2realisateur'] !== "")
							{
								$realisateur = htmlspecialchars($_POST['modifieradminfilm2realisateur']);
								
								$modifierfilm = $db->prepare('UPDATE films SET realisateur = :realisateur WHERE titre = :titre');
								$modifierfilm->execute(array(
								'realisateur' => $realisateur,
								'titre' => $titre
								));
								
								$errorfilm2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Réalisateur modifier.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le réalisateur.\" />";
					
							?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm2validergenre']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminfilm2titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{
							if(isset($_POST['modifieradminfilm2genreaction']))
							{
								$genreaction = htmlspecialchars($_POST['modifieradminfilm2genreaction']);
							}
							else
							{
								$genreaction = "null";
							}
							
							if(isset($_POST['modifieradminfilm2genreaventure']))
							{
								$genreaventure = htmlspecialchars($_POST['modifieradminfilm2genreaventure']);
							}
							else
							{
								$genreaventure = "null";
							}
							
							if(isset($_POST['modifieradminfilm2genreamitier']))
							{
								$genreamitier = htmlspecialchars($_POST['modifieradminfilm2genreamitier']);
							}
							else
							{
								$genreamitier = "null";
							}
							
							if(isset($_POST['modifieradminfilm2genrecomedie']))
							{
								$genrecomedie = htmlspecialchars($_POST['modifieradminfilm2genrecomedie']);
							}
							else
							{
								$genrecomedie = "null";
							}
							
							if(isset($_POST['modifieradminfilm2genredrame']))
							{
								$genredrame = htmlspecialchars($_POST['modifieradminfilm2genredrame']);
							}
							else
							{
								$genredrame = "null";
							}
							
							if(isset($_POST['modifieradminfilm2genrefantastique']))
							{
								$genrefantastique = htmlspecialchars($_POST['modifieradminfilm2genrefantastique']);
							}
							else
							{
								$genrefantastique = "null";
							}
							
							if(isset($_POST['modifieradminfilm2genreguerre']))
							{
								$genreguerre = htmlspecialchars($_POST['modifieradminfilm2genreguerre']);
							}
							else
							{
								$genreguerre = "null";
							}
							
							if(isset($_POST['modifieradminfilm2genrecyber']))
							{
								$genrecyber = htmlspecialchars($_POST['modifieradminfilm2genrecyber']);
							}
							else
							{
								$genrecyber = "null";
							}
							
							if(isset($_POST['modifieradminfilm2genremecha']))
							{
								$genremecha = htmlspecialchars($_POST['modifieradminfilm2genremecha']);
							}
							else
							{
								$genremecha = "null";
							}
							
							if(isset($_POST['modifieradminfilm2genresport']))
							{
								$genresport = htmlspecialchars($_POST['modifieradminfilm2genresport']);
							}
							else
							{
								$genresport = "null";
							}
							
							if(isset($_POST['modifieradminfilm2genrehorreur']))
							{
								$genrehorreur = htmlspecialchars($_POST['modifieradminfilm2genrehorreur']);
							}
							else
							{
								$genrehorreur = "null";
							}
							
							$modifierfilm = $db->prepare('UPDATE films SET action = :action, aventure = :aventure, amitier = :amitier, comedie = :comedie, drame = :drame, fantastique = :fantastique, guerre = :guerre, cyber = :cyber, mecha = :mecha, sport = :sport, horreur = :horreur WHERE titre = :titre');
							$modifierfilm->execute(array(
							'action' => $genreaction,
							'aventure' => $genreaventure,
							'amitier' => $genreamitier,
							'comedie' => $genrecomedie,
							'drame' => $genredrame,
							'fantastique' => $genrefantastique,
							'guerre' => $genreguerre,
							'cyber' => $genrecyber,
							'mecha' => $genremecha,
							'sport' => $genresport,
							'horreur' => $genrehorreur,
							'titre' => $titre
							));
							
								
							$errorfilm2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Genre modifier.\" />";
					
						?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						else
						{
							
							$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm2validersynopsis']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminfilm2titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{
							if($_POST['modifieradminfilm2synopsis'] !== "")
							{
								$synopsis = htmlspecialchars($_POST['modifieradminfilm2synopsis']);
								
								$modifierfilm = $db->prepare('UPDATE films SET synopsis = :synopsis WHERE titre = :titre');
								$modifierfilm->execute(array(
								'synopsis' => $synopsis,
								'titre' => $titre
								));
								
								$errorfilm2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Synopsis modifier.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier le synopsis.\" />";
					
							?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm2validerdurer']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminfilm2titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{
							if($_POST['modifieradminfilm2durer'] !== "")
							{
								$durer = htmlspecialchars($_POST['modifieradminfilm2durer']);
								
								$modifierfilm = $db->prepare('UPDATE films SET durer = :durer WHERE titre = :titre');
								$modifierfilm->execute(array(
								'durer' => $durer,
								'titre' => $titre
								));
								
								$errorfilm2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Durée modifier.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la durée.\" />";
					
							?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm2validerbandeannonce']))
					{	
						$titre = htmlspecialchars($_POST['modifieradminfilm2titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{
							if($_POST['modifieradminfilm2bandeannonce'] !== "")
							{
								$bandeannonce = htmlspecialchars($_POST['modifieradminfilm2bandeannonce']);
								
								$modifierfilm = $db->prepare('UPDATE films SET bandeannonce = :bandeannonce WHERE titre = :titre');
								$modifierfilm->execute(array(
								'bandeannonce' => $bandeannonce,
								'titre' => $titre
								));
								
								$errorfilm2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Bande annonce modifier.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la bande annonce.\" />";
					
							?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm2validervostfr']))
					{
						$titre = htmlspecialchars($_POST['modifieradminfilm2titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{
							if($_POST['modifieradminfilm2videovostfr'] !== "")
							{
								$videovostfr =  htmlspecialchars($_POST['modifieradminfilm2videovostfr']);
								
								$modifierfilm = $db->prepare('UPDATE films SET videovostfr = :videovostfr WHERE titre = :titre');
								$modifierfilm->execute(array(
								'videovostfr' => $videovostfr,
								'titre' => $titre
								));
								
								$errorfilm2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video vostfr modifier.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la video vostfr.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm2validervf']))
					{
						$titre = htmlspecialchars($_POST['modifieradminfilm2titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{
							if($_POST['modifieradminfilm2videovf'] !== "")
							{
								$videovf =  htmlspecialchars($_POST['modifieradminfilm2videovf']);
								
								$modifierfilm = $db->prepare('UPDATE films SET videovf = :videovf WHERE titre = :titre');
								$modifierfilm->execute(array(
								'videovf' => $videovf,
								'titre' => $titre
								));
								
								$errorfilm2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video vf modifier.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
							else
							{
								
								$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Vous n'avez pas renseigner le champ modifier la video vf.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm2
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm2 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm2
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm3valider']))
					{
						$titre = htmlspecialchars($_POST['modifieradminfilm3titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{					
							$searchidfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
							$searchidfilmexist->execute(array($titre));
							$idfilmexist = $searchidfilmexist->fetch();
							
							$IDfilm = $idfilmexist['ID'];
							$IDmembre = $_SESSION['ID'];
							$lecteurvideo = htmlspecialchars($_POST['modifieradminfilm3lecteurvideo']);
							$nomlectreurvideo = htmlspecialchars($_POST['modifieradminfilm3nomvideo']);
							$nomvideo = '' . $lecteurvideo . $nomlectreurvideo . '';
							$searchnomvideoexist = $db->prepare('SELECT * FROM videofilms WHERE IDfilm = ? AND nomvideo = ?');
							$searchnomvideoexist->execute(array($IDfilm,$nomvideo));
							$nomvideoexist = $searchnomvideoexist->rowCount();
							if($nomvideoexist == 0)
							{
								$video = htmlspecialchars($_POST['modifieradminfilm3video']);
								$ajoutervideo = $db->prepare('INSERT INTO videofilms(IDfilm,IDmembre,lecteurvideo,nomvideo,video,date_ajout) VALUES (:IDfilm,:IDmembre,:lecteurvideo,:nomvideo,:video,NOW())');
								$ajoutervideo->execute(array(
								'IDfilm' => $IDfilm,
								'IDmembre' => $IDmembre,
								'lecteurvideo' => $lecteurvideo,
								'nomvideo' => $nomvideo,
								'video' => $video
								));
									
								$errorfilm3 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video ajouter.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm3
									{
										right: 35.6%;
									}
								</style>
								<?php
							}
							else
							{
								
								$errorfilm3 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video est indisponible.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm3
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm3 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm3
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm4valider']))
					{
						$titre = htmlspecialchars($_POST['modifieradminfilm4titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{	
							$searchidfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
							$searchidfilmexist->execute(array($titre));
							$idfilmexist = $searchidfilmexist->fetch();
							
							$IDfilm = $idfilmexist['ID'];
							$lecteurvideo = htmlspecialchars($_POST['modifieradminfilm4lecteurvideo']);
							$nomlectreurvideo = htmlspecialchars($_POST['modifieradminfilm4nomvideo']);
							$nomvideo = '' . $lecteurvideo . $nomlectreurvideo . '';
							$searchnomvideoexist = $db->prepare('SELECT * FROM videofilms WHERE IDfilm = ? AND nomvideo = ?');
							$searchnomvideoexist->execute(array($IDfilm,$nomvideo));
							$nomvideoexist = $searchnomvideoexist->rowCount();
							if($nomvideoexist == 1)
							{
								$video = htmlspecialchars($_POST['modifieradminfilm4video']);
								$searchidvideofilm = $db->prepare('SELECT * FROM videofilms WHERE IDfilm = ? AND nomvideo = ?');
								$searchidvideofilm->execute(array($IDfilm,$nomvideo));
								$idvideofilm = $searchidvideofilm->fetch();
								
								$ID = $idvideofilm['ID'];
								
								$modifiervideofilmvideo = $db->prepare('UPDATE videofilms SET video = :video WHERE ID = :ID');
								$modifiervideofilmvideo->execute(array(
								'video' => $video,
								'ID' => $ID
								));
									
								$errorfilm4 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video modifier.\" />";
					
							?>		
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminfilm
										{
											display: block;
										}
										#contenumodifieradminfilm4
										{
											right: 35.6%;
										}
									</style>
								<?php
							}
							else
							{
								
								$errorfilm4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video est indisponible.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm4
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm4 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm4
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['modifieradminfilm5valider']))
					{
						$titre = htmlspecialchars($_POST['modifieradminfilm5titre']);
						$searchfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
						$searchfilmexist->execute(array($titre));
						$filmexist = $searchfilmexist->rowCount();
						if($filmexist == 1)
						{	
							$searchidfilmexist = $db->prepare('SELECT * FROM films WHERE titre = ?');
							$searchidfilmexist->execute(array($titre));
							$idfilmexist = $searchidfilmexist->fetch();
							
							$IDfilm = $idfilmexist['ID'];
							$lecteurvideo = htmlspecialchars($_POST['modifieradminfilm5lecteurvideo']);
							$nomlectreurvideo = htmlspecialchars($_POST['modifieradminfilm5nomvideo']);
							$nomvideo = '' . $lecteurvideo . $nomlectreurvideo . '';
							$searchnomvideoexist = $db->prepare('SELECT * FROM videofilms WHERE IDfilm = ? AND nomvideo = ?');
							$searchnomvideoexist->execute(array($IDfilm,$nomvideo));
							$nomvideoexist = $searchnomvideoexist->rowCount();
							if($nomvideoexist == 1)
							{
								$searchidvideofilm = $db->prepare('SELECT * FROM videofilms WHERE IDfilm = ? AND nomvideo = ?');
								$searchidvideofilm->execute(array($IDfilm,$nomvideo));
								$idvideofilm = $searchidvideofilm->fetch();
								
								$ID = $idvideofilm['ID'];
								
								$supprimervideofilm = $db->prepare('DELETE FROM videofilms WHERE ID = :ID');
								$supprimervideofilm->execute(array(
								'ID' => $ID
								));
									
								$errorfilm5 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Video supprimer.\" />";
					
							?>		
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminfilm
										{
											display: block;
										}
										#contenumodifieradminfilm5
										{
											right: 35.6%;
										}
									</style>
								<?php
							}
							else
							{
								
								$errorfilm5 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le nom de la video n'existe pas.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminfilm
									{
										display: block;
									}
									#contenumodifieradminfilm5
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
							
							$errorfilm5 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Ce film n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminfilm
								{
									display: block;
								}
								#contenumodifieradminfilm5
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
					
					if(isset($_POST['blockadminfilm6supprimer']))
					{
						$ID = $_POST['blockadminfilm6idinfo'];
						
						$supprimersignalevideo = $db->prepare('DELETE FROM signalefilm WHERE ID = :ID');
						$supprimersignalevideo->execute(array(
						'ID' => $ID
						));
						
							$errorfilm6 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Signalement supprimer.\" />";
					
						?>		
						<style>
							#body
							{
								padding-top: 109px;
								margin-top: 0px;
							}
							#header
							{
								height: 110px;
							}
							#contenuloading
							{
								opacity: 1;
							}
							#imgloading
							{
								width: 0px;
							}
							#imgloading2
							{
								width: 0px;
							}
							#imgloading3
							{
								width: 0px;
							}
							#imgloading4
							{
								width: 0px;
							}
							#spanloading
							{
								display: none;
							}
							#loading
							{
								width: 0px;
							}
							.contenuadmin
							{
								background: rgb(30,30,30);
							}
							.blockidentifiantadmin
							{
								display: none;
							}
							.hradmin
							{
								display: none;
							}
							#contenuadministration
							{
								display: block;
							}
							#blockadmin
							{
								display: none;
							}
							#contenublockadminfilm
							{
								display: block;
							}
							#contenumodifieradminfilm6
							{
								right: 35.6%;
							}
						</style>
					<?php
					}
					
					if(isset($_POST['blockadminfilm7supprimer']))
					{
						$ID = htmlspecialchars($_POST['blockadminfilm7idcommentaireinfo']);
						
						$supprimersignalecommentaire = $db->prepare('DELETE FROM signalecommentaire WHERE ID = :ID');
						$supprimersignalecommentaire->execute(array(
						'ID' => $ID
						));
						
							$errorfilm6 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Signalement supprimer.\" />";
					
						?>		
						<style>
							#body
							{
								padding-top: 109px;
								margin-top: 0px;
							}
							#header
							{
								height: 110px;
							}
							#contenuloading
							{
								opacity: 1;
							}
							#imgloading
							{
								width: 0px;
							}
							#imgloading2
							{
								width: 0px;
							}
							#imgloading3
							{
								width: 0px;
							}
							#imgloading4
							{
								width: 0px;
							}
							#spanloading
							{
								display: none;
							}
							#loading
							{
								width: 0px;
							}
							.contenuadmin
							{
								background: rgb(30,30,30);
							}
							.blockidentifiantadmin
							{
								display: none;
							}
							.hradmin
							{
								display: none;
							}
							#contenuadministration
							{
								display: block;
							}
							#blockadmin
							{
								display: none;
							}
							#contenublockadminfilm
							{
								display: block;
							}
							#contenumodifieradminfilm7
							{
								right: 35.6%;
							}
						</style>
					<?php
					}
					
					if(isset($_POST['blockadminforum1supprimer']))
					{
						$ID = htmlspecialchars($_POST['blockadminforum1titreinfo']);
						
						$supprimersignalesujet = $db->prepare('DELETE FROM signalesujet WHERE ID = :ID');
						$supprimersignalesujet->execute(array(
						'ID' => $ID
						));		
					
							$errorforum1 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Signalement supprimer.\" />";
					
						?>		
						<style>
							#body
							{
								padding-top: 109px;
								margin-top: 0px;
							}
							#header
							{
								height: 110px;
							}
							#contenuloading
							{
								opacity: 1;
							}
							#imgloading
							{
								width: 0px;
							}
							#imgloading2
							{
								width: 0px;
							}
							#imgloading3
							{
								width: 0px;
							}
							#imgloading4
							{
								width: 0px;
							}
							#spanloading
							{
								display: none;
							}
							#loading
							{
								width: 0px;
							}
							.contenuadmin
							{
								background: rgb(30,30,30);
							}
							.blockidentifiantadmin
							{
								display: none;
							}
							.hradmin
							{
								display: none;
							}
							#contenuadministration
							{
								display: block;
							}
							#blockadmin
							{
								display: none;
							}
							#contenublockadminforum
							{
								display: block;
							}
							#contenumodifieradminforum1
							{
								right: 35.6%;
							}
						</style>
					<?php
					}
					
					if(isset($_POST['blockadminforum2supprimer']))
					{
						$ID = htmlspecialchars($_POST['blockadminforum2idcommentaireinfo']);
						
						$supprimersignalecommentaire = $db->prepare('DELETE FROM signalecommentaire WHERE ID = :ID');
						$supprimersignalecommentaire->execute(array(
						'ID' => $ID
						));
					
							$errorforum2 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Signalement supprimer.\" />";
					
						?>		
						<style>
							#body
							{
								padding-top: 109px;
								margin-top: 0px;
							}
							#header
							{
								height: 110px;
							}
							#contenuloading
							{
								opacity: 1;
							}
							#imgloading
							{
								width: 0px;
							}
							#imgloading2
							{
								width: 0px;
							}
							#imgloading3
							{
								width: 0px;
							}
							#imgloading4
							{
								width: 0px;
							}
							#spanloading
							{
								display: none;
							}
							#loading
							{
								width: 0px;
							}
							.contenuadmin
							{
								background: rgb(30,30,30);
							}
							.blockidentifiantadmin
							{
								display: none;
							}
							.hradmin
							{
								display: none;
							}
							#contenuadministration
							{
								display: block;
							}
							#blockadmin
							{
								display: none;
							}
							#contenublockadminforum
							{
								display: block;
							}
							#contenumodifieradminforum2
							{
								right: 35.6%;
							}
						</style>
					<?php
					}
					
					if(isset($_POST['blockadmingallery1supprimer']))
					{
						$ID = htmlspecialchars($_POST['blockadmingallery1idimageinfo']);
						
						$supprimersignaleimage = $db->prepare('DELETE FROM signalegallery WHERE ID = :ID');
						$supprimersignaleimage->execute(array(
						'ID' => $ID
						));
					
						$errorgallery1 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"Signalement supprimer.\" />";
					
					?>		
						<style>
							#body
							{
								padding-top: 109px;
								margin-top: 0px;
							}
							#header
							{
								height: 110px;
							}
							#contenuloading
							{
								opacity: 1;
							}
							#imgloading
							{
								width: 0px;
							}
							#imgloading2
							{
								width: 0px;
							}
							#imgloading3
							{
								width: 0px;
							}
							#imgloading4
							{
								width: 0px;
							}
							#spanloading
							{
								display: none;
							}
							#loading
							{
								width: 0px;
							}
							.contenuadmin
							{
								background: rgb(30,30,30);
							}
							.blockidentifiantadmin
							{
								display: none;
							}
							.hradmin
							{
								display: none;
							}
							#contenuadministration
							{
								display: block;
							}
							#blockadmin
							{
								display: none;
							}
							#contenublockadmingallery
							{
								display: block;
							}
							#contenumodifieradmingallery1
							{
								right: 35.6%;
							}
						</style>
					<?php
					}
					
					if(isset($_POST['modifieradminjournal1valider']))
					{
						$titre = htmlspecialchars($_POST['modifieradminjournal1titre']);
						$searchanimeexist = $db->prepare('SELECT * FROM animes WHERE titre = ?');
						$searchanimeexist->execute(array($titre));
						$animeexist = $searchanimeexist->rowCount();
						if($animeexist == 1 OR $titre == 'Metro Manga')
						{	
							$contenu = html_entity_decode($_POST['modifieradminjournal1contenu']);
							$contenu = preg_replace('/<script(.*)>(.*)<\/script>/isU', null, $contenu);
							$contenu = preg_replace('/onload/isU', null, $contenu);
							if(mb_strlen($contenu, 'utf8') >= 10)
							{
								if($titre == 'Metro Manga')
								{
									$IDanime = 0;
								}
								else
								{
									$selectIDanime = $db->query('SELECT * FROM animes WHERE titre=\'' . $titre . '\'');
									$IDanime = $selectIDanime->fetch();
									
									$IDanime = $IDanime['ID'];
								}
								
								$contenu = htmlspecialchars($contenu);
								$date_delete = htmlspecialchars($_POST['modifieradminjournal1datedelete']);
								
								$insertnewsanime = $db->prepare('INSERT INTO articlepageanime(IDanime,IDmembre,contenu,date_creation,date_delete) VALUES(:IDanime,:IDmembre,:contenu,NOW(),:date_delete)');
								$insertnewsanime->execute(array(
								'IDanime' => $IDanime,
								'IDmembre' => $_SESSION['ID'],
								'contenu' => $contenu,
								'date_delete' => $date_delete
								));
								
								$errorjournal1 = "<img src=\"../images/validate.png\" alt=\"valider\" class=\"resultatmodificationimg2\" title=\"News ajouter.\" />";
					
							?>		
									<style>
										#body
										{
											padding-top: 109px;
											margin-top: 0px;
										}
										#header
										{
											height: 110px;
										}
										#contenuloading
										{
											opacity: 1;
										}
										#imgloading
										{
											width: 0px;
										}
										#imgloading2
										{
											width: 0px;
										}
										#imgloading3
										{
											width: 0px;
										}
										#imgloading4
										{
											width: 0px;
										}
										#spanloading
										{
											display: none;
										}
										#loading
										{
											width: 0px;
										}
										.contenuadmin
										{
											background: rgb(30,30,30);
										}
										.blockidentifiantadmin
										{
											display: none;
										}
										.hradmin
										{
											display: none;
										}
										#contenuadministration
										{
											display: block;
										}
										#blockadmin
										{
											display: none;
										}
										#contenublockadminjournal
										{
											display: block;
										}
										#contenumodifieradminjournal1
										{
											right: 35.6%;
										}
									</style>
								<?php
							}
							else
							{
								
								$errorjournal1 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Votre news doit être supérieur a 9 caractères.\" />";
					
							?>		
								<style>
									#body
									{
										padding-top: 109px;
										margin-top: 0px;
									}
									#header
									{
										height: 110px;
									}
									#contenuloading
									{
										opacity: 1;
									}
									#imgloading
									{
										width: 0px;
									}
									#imgloading2
									{
										width: 0px;
									}
									#imgloading3
									{
										width: 0px;
									}
									#imgloading4
									{
										width: 0px;
									}
									#spanloading
									{
										display: none;
									}
									#loading
									{
										width: 0px;
									}
									.contenuadmin
									{
										background: rgb(30,30,30);
									}
									.blockidentifiantadmin
									{
										display: none;
									}
									.hradmin
									{
										display: none;
									}
									#contenuadministration
									{
										display: block;
									}
									#blockadmin
									{
										display: none;
									}
									#contenublockadminjournal
									{
										display: block;
									}
									#contenumodifieradminjournal1
									{
										right: 35.6%;
									}
								</style>
							<?php
							}
						}
						else
						{
							
							$errorjournal1 = "<img src=\"../images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Cette animé n'existe pas.\" />";
					
						?>		
							<style>
								#body
								{
									padding-top: 109px;
									margin-top: 0px;
								}
								#header
								{
									height: 110px;
								}
								#contenuloading
								{
									opacity: 1;
								}
								#imgloading
								{
									width: 0px;
								}
								#imgloading2
								{
									width: 0px;
								}
								#imgloading3
								{
									width: 0px;
								}
								#imgloading4
								{
									width: 0px;
								}
								#spanloading
								{
									display: none;
								}
								#loading
								{
									width: 0px;
								}
								.contenuadmin
								{
									background: rgb(30,30,30);
								}
								.blockidentifiantadmin
								{
									display: none;
								}
								.hradmin
								{
									display: none;
								}
								#contenuadministration
								{
									display: block;
								}
								#blockadmin
								{
									display: none;
								}
								#contenublockadminjournal
								{
									display: block;
								}
								#contenumodifieradminjournal1
								{
									right: 35.6%;
								}
							</style>
						<?php
						}
					}
				?>
					<div id="blockadmin">
						<div class="blockadmin1">
							<div class="blockadmin" id="blockadminanime">
								<span class="blockadmintitre">Anime</span>
								<img src="../images/administration.png" alt="" class="blockadminimganime" />
							</div>
							<div class="blockadmin" id="blockadminfilm">
								<span class="blockadmintitre">Film</span>
								<img src="../images/administration.png" alt="" class="blockadminimgfilm" />
							</div>
							<div class="blockadmin" id="blockadminforum">
								<span class="blockadmintitre">Forum</span>
								<img src="../images/administration.png" alt="" class="blockadminimgforum" />
							</div>
						</div>
						<div class="blockadmin2">
							<div class="blockadmin" id="blockadmingallery">
								<span class="blockadmintitre">Gallery</span>
								<img src="../images/administration.png" alt="" class="blockadminimggallery" />
							</div>
							<div class="blockadmin" id="blockadminjournal">
								<span class="blockadmintitre">Journal</span>
								<img src="../images/administration.png" alt="" class="blockadminimgjournal" />
							</div>
							<div class="blockadmin" id="blockadmincontact">
								<span class="blockadmintitre">Contact</span>
								<img src="../images/administration.png" alt="" class="blockadminimgcontact" />
							</div>
						</div>
						<div class="blockadmin3">
							<div class="blockadmin" id="blockadmincalendrier">
								<span class="blockadmintitre">Calendrier</span>
								<img src="../images/administration.png" alt="" class="blockadminimgcalendrier" />
							</div>
							<div class="blockadmin" id="blockadminmembre">
								<span class="blockadmintitre">Membre</span>
								<img src="../images/administration.png" alt="" class="blockadminimgmembre" />
							</div>
							<div class="blockadmin" id="blockadminmetromanga">
								<span class="blockadmintitre">Metro Manga</span>
								<img src="../images/administration.png" alt="" class="blockadminimgmetromanga" />
							</div>
						</div>
					</div>
					
					<div class="contenublockadmin" id="contenublockadminanime">
						<span><img src="../images/retour.png" alt="Retour" class="retour" id="retouranime" /></span>
						<span><img src="../images/administration.png" alt="" class="contenublockadminimg" /></span>
						<div class="blockmodifieradmin">
							<div class="modifieradmin" id="modifieradminanime1">
								<p class="modifieradmintitre">Ajouter un animé</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime2">
								<p class="modifieradmintitre">Modifier un animé</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime3">
								<p class="modifieradmintitre">Ajouter un épisode</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime4">
								<p class="modifieradmintitre">Modifier un épisode</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime5">
								<p class="modifieradmintitre">Supprimer un épisode</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime6">
								<p class="modifieradmintitre">Ajouter une saison</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime7">
								<p class="modifieradmintitre">Ajouter un scan</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime8">
								<p class="modifieradmintitre">Modifier un scan</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime9">
								<p class="modifieradmintitre">Supprimer un scan</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime10">
								<p class="modifieradmintitre">Ajouter un film</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime11">
								<p class="modifieradmintitre">Modifier un film</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime12">
								<p class="modifieradmintitre">Supprimer un film</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime13">
								<p class="modifieradmintitre">Ajouter un film spécial</p>
							</div>	
							<div class="modifieradmin" id="modifieradminanime14">
								<p class="modifieradmintitre">Modifier un film spécial</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime15">
								<p class="modifieradmintitre">Supprimer un film spécial</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime16">
								<p class="modifieradmintitre">Ajouter un oav</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime17">
								<p class="modifieradmintitre">Modifier un oav</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime18">
								<p class="modifieradmintitre">Supprimer un oav</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime19">
								<p class="modifieradmintitre">Ajouter un générique</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime20">
								<p class="modifieradmintitre">Modifier un générique</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime21">
								<p class="modifieradmintitre">Ajouter une video</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime22">
								<p class="modifieradmintitre">Modifier une video</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime23">
								<p class="modifieradmintitre">Supprimer une video</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime24">
								<p class="modifieradmintitre">Lien mort</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime25">
								<p class="modifieradmintitre">Supprimer une saison</p>
							</div>
							<div class="modifieradmin" id="modifieradminanime26">
								<p class="modifieradmintitre">Commentaire signaler</p>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime1">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Ajouter un animé</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($erroranime1))
										{
											echo $erroranime1;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<div class="contenumodifieradmininfo">
									<span>L'ajout d'un animé doit être décidé par tout le staff.</span><br />
									<span class="contenumodifieradmininfoimg" id="contenumodifieradminanime1infoimg">- L'image doit avoir le nom de l'animé sans majuscule, sans espace ni de caractère spéciaux.</span>
									<span class="contenumodifieradmininfoimg" id="contenumodifieradminanime1lettre" style="display:none;">- Insérer le premier caractère du titre en majuscules.</span>
								</div>
								<form method="post" action="" enctype="multipart/form-data">
									<input type="text" name="modifieradminanime1titre" id="modifieradminanime1titre" placeholder="Titre" autocomplete="off" maxlength="40" required />
									<div class="input-file-container" id="modifieradminanime1imgblock">
										<input class="input-file" id="modifieradminanime1img" name="modifieradminanime1img" type="file" required />
										<label for="modifieradminanime1img" class="input-file-trigger" tabindex="0">Image</label>
									</div>
									<p class="file-return"></p>
									<input type="text" name="modifieradminanime1lettre" id="modifieradminanime1lettre" placeholder="Première lettre" autocomplete="off" maxlength="1" required /><br />
									<input type="number" name="modifieradminanime1date" id="modifieradminanime1date" placeholder="Année" min="1900" max="2100" required />
									<input type="text" name="modifieradminanime1auteur" id="modifieradminanime1auteur" placeholder="Auteur" autocomplete="off" maxlength="18" required />
									<p class="modifieradminanime1titregenre">Genre</p>
									<div class="genre">
										<input type="checkbox" name="modifieradminanime1genreaction" value="Action" id="modifieradminanime1genreaction" class="modifieradminanime1genreboite" /><label for="modifieradminanime1genreaction" class="modifieradminanime1genre">Action</label>
										<input type="checkbox" name="modifieradminanime1genreaventure" value="Aventure" id="modifieradminanime1genreaventure" class="modifieradminanime1genreboite" /><label for="modifieradminanime1genreaventure" class="modifieradminanime1genre">Aventure</label>
										<input type="checkbox" name="modifieradminanime1genreamitier" value="Amitié" id="modifieradminanime1genreamitier" class="modifieradminanime1genreboite" /><label for="modifieradminanime1genreamitier" class="modifieradminanime1genre">Amitié</label>
										<input type="checkbox" name="modifieradminanime1genrecomedie" value="Comédie" id="modifieradminanime1genrecomedie" class="modifieradminanime1genreboite" /><label for="modifieradminanime1genrecomedie" class="modifieradminanime1genre">Comédie</label>
										<input type="checkbox" name="modifieradminanime1genredrame" value="Drame" id="modifieradminanime1genredrame" class="modifieradminanime1genreboite" /><label for="modifieradminanime1genredrame" class="modifieradminanime1genre">Drame</label>
										<input type="checkbox" name="modifieradminanime1genrefantastique" value="Fantastique" id="modifieradminanime1genrefantastique" class="modifieradminanime1genreboite" /><label for="modifieradminanime1genrefantastique" class="modifieradminanime1genre">Fantastique</label>
										<input type="checkbox" name="modifieradminanime1genreguerre" value="Guerre" id="modifieradminanime1genreguerre" class="modifieradminanime1genreboite" /><label for="modifieradminanime1genreguerre" class="modifieradminanime1genre">Guerre</label>
										<input type="checkbox" name="modifieradminanime1genrecyber" value="Cyber" id="modifieradminanime1genrecyber" class="modifieradminanime1genreboite" /><label for="modifieradminanime1genrecyber" class="modifieradminanime1genre">Cyber</label>
										<input type="checkbox" name="modifieradminanime1genremecha" value="Mecha" id="modifieradminanime1genremecha" class="modifieradminanime1genreboite" /><label for="modifieradminanime1genremecha" class="modifieradminanime1genre">Mecha</label>
										<input type="checkbox" name="modifieradminanime1genresport" value="Sport" id="modifieradminanime1genresport" class="modifieradminanime1genreboite" /><label for="modifieradminanime1genresport" class="modifieradminanime1genre">Sport</label>
										<input type="checkbox" name="modifieradminanime1genrehorreur" value="Horreur" id="modifieradminanime1genrehorreur" class="modifieradminanime1genreboite" /><label for="modifieradminanime1genrehorreur" class="modifieradminanime1genre">Horreur</label>
									</div>
									<p class="modifieradminanime1titresynopsis">Synopsis</p>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime1synopsis" placeholder="Synopsis" autocomplete="off" maxlength="200" required></textarea><br />
									<p class="modifieradminanime1titrebandeannonce">Bande annonce</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" style="margin-bottom:130px;" name="modifieradminanime1bandeannonce" autocomplete="off" minlength="10" placeholder="Lien bande annonce" required ></textarea><br />
									<fieldset class="modifieradminanime1validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime1valider" name="modifieradminanime1valider" /></legend>
									</fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime2">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Modifier un animé</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($erroranime2))
										{
											echo $erroranime2;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" enctype="multipart/form-data">
									<input type="text" name="modifieradminanime2titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required />
									<p class="modifieradminanime1titrebandeannonce">Modifier le titre</p>
									<div class="contenumodifieradmininfo">
										<span class="contenumodifieradmininfoimg" id="contenumodifieradminanime2infoimg">- Vous devrez uploader à nouveau l'image si vous modifiez le titre.</span>
									</div>
									<input type="text" name="modifieradminanime2modifiertitre" id="modifieradminanime2titre" placeholder="Titre" autocomplete="off" maxlength="40" />
									<fieldset class="modifieradminanime2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime2valider" name="modifieradminanime2validermodifiertitre" /></legend>
									 </fieldset>
									 <p class="modifieradminanime1titrebandeannonce">Modifier le premier caractère</p>
									 <div class="contenumodifieradmininfo">
										<span class="contenumodifieradmininfoimg" id="contenumodifieradminanime2infolettre">- Insérer le premier caractère du titre en majuscules.</span>
									</div>
									 <input type="text" name="modifieradminanime2lettre" id="modifieradminanime1lettre" placeholder="Première lettre" autocomplete="off" maxlength="1" style="margin-left:29%;margin-top:40px;" /><br />
									 <fieldset class="modifieradminanime2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime2valider" name="modifieradminanime2validerlettre" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier l'image</p>
									<div class="contenumodifieradmininfo" style="margin-bottom:100px;">
										<span class="contenumodifieradmininfoimg" id="contenumodifieradminanime2infoimg">- L'image doit avoir le nom de l'animé sans majuscules, sans espace ni de caractère spéciaux.</span>
									</div>
									<div class="input-file-container2" id="modifieradminanime2imgblock"  style="margin-left:29%;margin-top:-65px;">
										<input class="input-file2" id="modifieradminanime2img" name="modifieradminanime2img" type="file" />
										<label for="modifieradminanime2img" class="input-file-trigger2" tabindex="0">Image</label>
									</div>
									<p class="file-return2"></p>
									<fieldset class="modifieradminanime2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime2valider" name="modifieradminanime2validerimg" /></legend>
									 </fieldset>
									 <p class="modifieradminanime1titrebandeannonce">Modifier l'année</p>
									 <input type="number" name="modifieradminanime2date" id="modifieradminanime1date" placeholder="Année" autocomplete="off" min="1900" max="2100" style="margin-left:29%;" />
									 <fieldset class="modifieradminanime2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime2valider" name="modifieradminanime2validerdate" /></legend>
									 </fieldset>
									 <p class="modifieradminanime1titrebandeannonce">Modifier l'auteur</p>
									 <input type="text" name="modifieradminanime2auteur" id="modifieradminanime1auteur" placeholder="Auteur" autocomplete="off" maxlength="18" style="margin-left:29%;" />
									 <fieldset class="modifieradminanime2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime2valider" name="modifieradminanime2validerauteur" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titregenre"> Modifier le genre</p>
									<div class="genre">
										<input type="checkbox" name="modifieradminanime2genreaction" value="Action" id="modifieradminanime2genreaction" class="modifieradminanime1genreboite" /><label for="modifieradminanime2genreaction" class="modifieradminanime1genre">Action</label>
										<input type="checkbox" name="modifieradminanime2genreaventure" value="Aventure" id="modifieradminanime2genreaventure" class="modifieradminanime1genreboite" /><label for="modifieradminanime2genreaventure" class="modifieradminanime1genre">Aventure</label>
										<input type="checkbox" name="modifieradminanime2genreamitier" value="Amitié" id="modifieradminanime2genreamitier" class="modifieradminanime1genreboite" /><label for="modifieradminanime2genreamitier" class="modifieradminanime1genre">Amitié</label>
										<input type="checkbox" name="modifieradminanime2genrecomedie" value="Comédie" id="modifieradminanime2genrecomedie" class="modifieradminanime1genreboite" /><label for="modifieradminanime2genrecomedie" class="modifieradminanime1genre">Comédie</label>
										<input type="checkbox" name="modifieradminanime2genredrame" value="Drame" id="modifieradminanime2genredrame" class="modifieradminanime1genreboite" /><label for="modifieradminanime2genredrame" class="modifieradminanime1genre">Drame</label>
										<input type="checkbox" name="modifieradminanime2genrefantastique" value="Fantastique" id="modifieradminanime2genrefantastique" class="modifieradminanime1genreboite" /><label for="modifieradminanime2genrefantastique" class="modifieradminanime1genre">Fantastique</label>
										<input type="checkbox" name="modifieradminanime2genreguerre" value="Guerre" id="modifieradminanime2genreguerre" class="modifieradminanime1genreboite" /><label for="modifieradminanime2genreguerre" class="modifieradminanime1genre">Guerre</label>
										<input type="checkbox" name="modifieradminanime2genrecyber" value="Cyber" id="modifieradminanime2genrecyber" class="modifieradminanime1genreboite" /><label for="modifieradminanime2genrecyber" class="modifieradminanime1genre">Cyber</label>
										<input type="checkbox" name="modifieradminanime2genremecha" value="Mecha" id="modifieradminanime2genremecha" class="modifieradminanime1genreboite" /><label for="modifieradminanime2genremecha" class="modifieradminanime1genre">Mecha</label>
										<input type="checkbox" name="modifieradminanime2genresport" value="Sport" id="modifieradminanime2genresport" class="modifieradminanime1genreboite" /><label for="modifieradminanime2genresport" class="modifieradminanime1genre">Sport</label>
										<input type="checkbox" name="modifieradminanime2genrehorreur" value="Horreur" id="modifieradminanime2genrehorreur" class="modifieradminanime1genreboite" /><label for="modifieradminanime2genrehorreur" class="modifieradminanime1genre">Horreur</label>
									</div>
									<fieldset class="modifieradminanime2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime2valider" name="modifieradminanime2validergenre" /></legend>
									 </fieldset>
									 
									 <p class="modifieradminanime1titresynopsis">Modifier le synopsis</p>
									<textarea id="modifieradminanime1synopsis" name="modifieradminanime2synopsis" placeholder="Synopsis" autocomplete="off" minlength="20" maxlength="200"></textarea><br />
									 <fieldset class="modifieradminanime2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime2valider" name="modifieradminanime2validersynopsis" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier la bande annonce</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime2bandeannonce" autocomplete="off" minlength="10" placeholder="Lien bande annonce" ></textarea><br />
									 <fieldset class="modifieradminanime2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime2valider" name="modifieradminanime2validerbandeannonce" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime3">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Ajouter un épisode</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($erroranime3))
										{
											echo $erroranime3;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="">
									<input type="text" name="modifieradminanime3titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime3saison" id="modifieradminanime2titre" placeholder="Saison" autocomplete="off" min="0" required /><br />
									<input type="number" name="modifieradminanime3numeroepisode" id="modifieradminanime2titre" placeholder="Épisode" autocomplete="off" min="0" required /><br />
									<p class="modifieradminanime1titrebandeannonce">Titre de l'épisode</p>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime3titreepisode" placeholder="Titre épisode" autocomplete="off" maxlength="65" required ></textarea><br />
									<p class="modifieradminanime1titrebandeannonce">Video vostfr</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime3videovostfr" placeholder="Lien vostfr" autocomplete="off" required ></textarea><br />
									<p class="modifieradminanime1titrebandeannonce">Video vf</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime3videovf" placeholder="Lien vf" autocomplete="off" minlength="10" ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime3validerajouterepisode" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime4">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Modifier un épisode</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($erroranime4))
										{
											echo $erroranime4;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime4titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime4saison" id="modifieradminanime2titre" placeholder="Saison" autocomplete="off" min="0" required /><br />
									<input type="number" name="modifieradminanime4numeroepisode" id="modifieradminanime2titre" placeholder="Épisode" autocomplete="off" min="0" required /><br />
									<p class="modifieradminanime1titrebandeannonce">Modifier la saison</p>
									<input type="number" name="modifieradminanime4modifiersaison" id="modifieradminanime2titre" placeholder="Saison" autocomplete="off" min="0" /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime4inputmodifiersaison" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier le numéro de l'épisode</p>
									<input type="number" name="modifieradminanime4modifiernumeroepisode" id="modifieradminanime2titre" placeholder="Épisode" autocomplete="off" min="0" /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime4inputmodifiernumero" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier le titre de l'épisode</p>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime4modifiertitreepisode" placeholder="Titre épisode" autocomplete="off" minlength="2" maxlength="65" ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime4inputmodifiertitreepisode" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier la video vostfr</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime4modifiervideovostfr" placeholder="Lien vostfr" autocomplete="off" minlength="10" ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime4inputmodifiervideovostfr" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier la video vf</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime4modifiervideovf" placeholder="Lien vf" autocomplete="off" minlength="10" ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime4inputmodifiervideovf" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime5">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Supprimer un épisode</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($erroranime5))
										{
											echo $erroranime5;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime5titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime5saison" id="modifieradminanime2titre" placeholder="Saison" autocomplete="off" min="0" required /><br />
									<input type="number" name="modifieradminanime5numeroepisode" id="modifieradminanime2titre" placeholder="Épisode" autocomplete="off" min="0" required /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime5supprimer" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime6">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Ajouter une saison</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($erroranime6))
										{
											echo $erroranime6;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime6titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime6saison" id="modifieradminanime2titre" placeholder="Saison" autocomplete="off" min="0" required /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime6ajoutersaison" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime7">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Ajouter un scan</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($erroranime8))
										{
											echo $erroranime8;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" enctype="multipart/form-data">
									<input type="text" name="modifieradminanime7titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime7numeroscan" id="modifieradminanime2titre" placeholder="Scan" autocomplete="off" min="0" required /><br />
									<input type="number" name="modifieradminanime7numeropage" id="modifieradminanime2titre" placeholder="Page" autocomplete="off" min="0" required /><br />
									<div class="input-file-container5" id="modifieradminanime2imgblock"  style="margin-left:30.5%;margin-top:35px;">
										<input class="input-file5" id="modifieradminanime2img" name="modifieradminanime7img" type="file" required />
										<label for="modifieradminanime7img" class="input-file-trigger5" tabindex="0">Image</label>
									</div>
									<p class="file-return5"></p>
									<fieldset class="modifieradminanime3validerbarre" style="margin-top:55px;">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime7ajouterscan" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime8">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Modifier un scan</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($erroranime9))
										{
											echo $erroranime9;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" enctype="multipart/form-data">
									<input type="text" name="modifieradminanime8titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime8numeroscan" id="modifieradminanime2titre" placeholder="Scan" autocomplete="off" min="0" required /><br />
									<input type="number" name="modifieradminanime8numeropage" id="modifieradminanime2titre" placeholder="Page" autocomplete="off" min="0" required /><br />
									<div class="input-file-container6" id="modifieradminanime2imgblock" style="margin-left:30.5%;margin-top:35px;">
										<input class="input-file6" id="modifieradminanime2img" name="modifieradminanime8img" type="file" required />
										<label for="modifieradminanime8img" class="input-file-trigger6" tabindex="0">Image</label>
									</div>
									<p class="file-return6"></p><br />
									<p class="modifieradminanime1titrebandeannonce" style="margin-top:60px;">Modifier l'animé du scan</p>
									<input type="text" name="modifieradminanime8modifiertitre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime8inputmodifiertitre" /></legend>
									</fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier le numéro du scan</p>
									<input type="number" name="modifieradminanime8modifiernumeroscan" id="modifieradminanime2titre" placeholder="Scan" autocomplete="off" min="0" /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime8inputmodifiernumeroscan" /></legend>
									</fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier la page du scan</p>
									<input type="number" name="modifieradminanime8modifiernumeropage" id="modifieradminanime2titre" placeholder="Page" autocomplete="off" min="0" /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime8inputmodifiernumeropage" /></legend>
									</fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier l'image du scan</p>
									<div class="input-file-container7" id="modifieradminanime2imgblock"  style="margin-left:30.5%;margin-top:35px;">
										<input class="input-file7" id="modifieradminanime2img" name="modifieradminanime8modifierimg" type="file" />
										<label for="modifieradminanime8modifierimg" class="input-file-trigger7" tabindex="0">Image</label>
									</div>
									<p class="file-return7"></p>
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime8inputmodifierimg" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime9">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Supprimer un scan</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime10))
									{
										echo $erroranime10;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime9titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime9numeroscan" id="modifieradminanime2titre" placeholder="Scan" autocomplete="off" min="0" required /><br />
									<input type="number" name="modifieradminanime9numeropage" id="modifieradminanime2titre" placeholder="Page" autocomplete="off" min="0" required /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime9supprimerscan" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime10">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Ajouter un film</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime11))
									{
										echo $erroranime11;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<div class="contenumodifieradmininfo">
									<span class="contenumodifieradmininfoimg">- L'image doit avoir le nom de l'animé suivi de son numéro sans majuscule, sans espace ni de caractère spéciaux.</span>
								</div>
								<form method="post" action="" enctype="multipart/form-data">
									<input type="text" name="modifieradminanime10titreanime" id="modifieradminanime2titre" style="margin-left:8.5%;" placeholder="Anime" autocomplete="off" maxlength="40" required />
									<input type="number" name="modifieradminanime10numero" id="modifieradminfilm1realisateur" placeholder="Numéro" autocomplete="off" min="0" required />
									<input type="text" name="modifieradminanime10titre" id="modifieradminanime2titre" style="margin-left:8.5%;margin-top:10px;margin-bottom:-1px;" autocomplete="off" placeholder="Titre" maxlength="40" required />
									<div class="input-file-container8" id="modifieradminanime2imgblock" style="margin-left:51.9%;margin-top:-50px;">
										<input class="input-file8" id="modifieradminanime2img" name="modifieradminanime10img" type="file" required />
										<label for="modifieradminanime2img" class="input-file-trigger8" tabindex="0">Image</label>
									</div>
									<p class="file-return8"></p>
									<input type="date" name="modifieradminanime10date" id="modifieradminfilm1date" style="margin-left:8.5%;" autocomplete="off" required />
									<input type="text" name="modifieradminanime10realisateur" id="modifieradminfilm1realisateur" placeholder="Réalisateur" autocomplete="off" maxlength="25" required /><br />
									<br />
									<p class="modifieradminfilm1titresynopsis">Synopsis</p>
									<textarea id="modifieradminfilm1synopsis" name="modifieradminanime10synopsis" placeholder="Synopsis" autocomplete="off" minlength="20" maxlength="255" required></textarea><br />
									<p class="modifieradminfilm1titredurer">Durée</p>
									<input type="time" id="modifieradminfilm1durer" name="modifieradminanime10durer" placeholder="Durée" autocomplete="off" required /><br />
									<p class="modifieradminfilm1titrebandeannonce">Bande annonce</p>
									<span class="modifieradminfilm1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm1bandeannonce" name="modifieradminanime10bandeannonce" autocomplete="off" minlength="10" placeholder="Lien bande annonce" required ></textarea><br />
									<p class="modifieradminfilm1titrevideovostfr">Video vostfr</p>
									<span class="modifieradminfilm1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm1videovostfr" name="modifieradminanime10videovostfr" autocomplete="off" minlength="10" placeholder="Lien vostfr" required ></textarea><br />
									<p class="modifieradminfilm1titrevideovf">Video vf</p>
									<span class="modifieradminfilm1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm1videovf" name="modifieradminanime10videovf" autocomplete="off" minlength="10" placeholder="Lien vf"></textarea><br />
									<fieldset class="modifieradminfilm1validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm1valider" name="modifieradminanime10valider" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime11">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Modifier un film</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime12))
									{
										echo $erroranime12;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" enctype="multipart/form-data">
									<input type="text" name="modifieradminanime11titreanime" id="modifieradminfilm2titre" placeholder="Anime" autocomplete="off" maxlength="40" required />
									<input type="number" name="modifieradminanime11numero" id="modifieradminfilm2titre" placeholder="Numéro" autocomplete="off" min="0" required />
									<p class="modifieradminfilm1titrebandeannonce">Modifier le numéro</p>
									<span class="modifieradminfilm2textvideo" style="margin-left:19%;">- Vous devrez uploader à nouveau l'image si vous modifiez le numéro.</span>
									<input type="number" name="modifieradminanime11modifiernumero" id="modifieradminfilm2titre" placeholder="Numéro" autocomplete="off" min="0" />
									<fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminanime11validermodifiernumero" /></legend>
									</fieldset>
									<p class="modifieradminfilm1titrebandeannonce">Modifier le titre</p>
									<input type="text" name="modifieradminanime11modifiertitre" id="modifieradminfilm2titre" placeholder="Titre" autocomplete="off" maxlength="40" />
									<fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminanime11validermodifiertitre" /></legend>
									</fieldset>
									<p class="modifieradminfilm1titrebandeannonce">Modifier l'image</p>
									<div class="contenumodifieradmininfo" style="margin-bottom:100px;">
										<span class="contenumodifieradmininfoimg" id="contenumodifieradminfilm2infoimg">- L'image doit avoir le nom de l'animé suivi de son numéro sans majuscules, sans espace ni de caractère spécieux.</span>
									</div>
									<div class="input-file-container9" id="modifieradminfilm2imgblock">
										<input class="input-file9" id="modifieradminfilm2img" name="modifieradminanime11modifierimg" type="file" />
										<label for="modifieradminfilm2img" class="input-file-trigger9" tabindex="0">Image</label>
									</div>
									<p class="file-return9"></p>
									<fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminanime11validermodifierimg" /></legend>
									 </fieldset>
									 <p class="modifieradminfilm1titrebandeannonce">Modifier la date</p>
									 <input type="date" name="modifieradminanime11modifierdate" id="modifieradminfilm2date" autocomplete="off" />
									 <fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminanime11validermodifierdate" /></legend>
									 </fieldset>
									 <p class="modifieradminfilm1titrebandeannonce">Modifier le réalisateur</p>
									 <input type="text" name="modifieradminanime11modifierrealisateur" id="modifieradminfilm2realisateur" placeholder="Réalisateur" autocomplete="off" maxlength="25" />
									 <fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminanime11validermodifierrealisateur" /></legend>
									 </fieldset>
									 <p class="modifieradminfilm1titresynopsis">Modifier le synopsis</p>
									<textarea id="modifieradminfilm1synopsis" name="modifieradminanime11modifiersynopsis" placeholder="Synopsis" minlength="20" maxlength="255"></textarea><br />
									 <fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminanime11validermodifiersynopsis" /></legend>
									 </fieldset>
									 <p class="modifieradminfilm1titredurer">Modifier la durée</p>
									<input type="time" id="modifieradminfilm1durer" name="modifieradminanime11modifierdurer" placeholder="Durée" autocomplete="off" /><br />
									 <fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminanime11validermodifierdurer" /></legend>
									 </fieldset> 
									<p class="modifieradminfilm1titrebandeannonce">Modifier la bande annonce</p>
									<span class="modifieradminfilm2textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm1bandeannonce" name="modifieradminanime11modifierbandeannonce" autocomplete="off" minlength="10" placeholder="Lien bande annonce" ></textarea><br />
									 <fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminanime11validermodifierbandeannonce" /></legend>
									 </fieldset>
									<p class="modifieradminfilm2titrevideovostfr">Modifier la video vostfr</p>
									<span class="modifieradminfilm2textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm2videovostfr" name="modifieradminanime11modifiervideovostfr" autocomplete="off" minlength="10" placeholder="Lien vostfr" ></textarea><br />
									<fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminanime11validermodifiervostfr" /></legend>
									 </fieldset>
									<p class="modifieradminfilm2titrevideovf">Modifier la video vf</p>
									<span class="modifieradminfilm2textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm2videovf" name="modifieradminanime11modifiervideovf" autocomplete="off" minlength="10" placeholder="Lien vf" ></textarea><br />
									<fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminanime11validermodifiervf" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime12">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Supprimer un film</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime13))
									{
										echo $erroranime13;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime12titreanime" id="modifieradminfilm2titre" style="margin-top:50px;" placeholder="Anime" autocomplete="off" maxlength="40" required />
									<input type="number" name="modifieradminanime12numero" id="modifieradminfilm2titre" placeholder="Numéro" autocomplete="off" min="0" required />
									<fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminanime12" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime13">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Ajouter un film spécial</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime14))
									{
										echo $erroranime14;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime13titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime13numero" id="modifieradminanime2titre" placeholder="Numéro" autocomplete="off" min="0" required /><br />
									<p class="modifieradminanime1titrebandeannonce">Titre du film spécial</p>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime13titreepisode" placeholder="Titre épisode" autocomplete="off" maxlength="65" required ></textarea><br />
									<p class="modifieradminanime1titrebandeannonce">Video vostfr</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime13videovostfr" placeholder="Lien vostfr" autocomplete="off" required ></textarea><br />
									<p class="modifieradminanime1titrebandeannonce">Video vf</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime13videovf" placeholder="Lien vf" autocomplete="off" minlength="10" ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime13" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime14">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Modifier un film spécial</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime15))
									{
										echo $erroranime15;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime14titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime14numero" id="modifieradminanime2titre" placeholder="Numéro" autocomplete="off" min="0" required /><br />
									<p class="modifieradminanime1titrebandeannonce">Modifier le numéro</p>
									<input type="number" name="modifieradminanime14modifiernumero" id="modifieradminanime2titre" placeholder="Numéro" autocomplete="off" min="0" /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime14inputmodifiernumero" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier le titre</p>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime14modifiertitreepisode" placeholder="Titre épisode" autocomplete="off" minlength="4" maxlength="65" ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime14inputmodifiertitreepisode" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier la video vostfr</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime14modifiervideovostfr" placeholder="Lien vostfr" autocomplete="off" minlength="10" ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime14inputmodifiervideovostfr" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier la video vf</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime14modifiervideovf" placeholder="Lien vf" autocomplete="off" minlength="10" ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime14inputmodifiervideovf" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime15">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Supprimer un film spécial</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime16))
									{
										echo $erroranime16;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime15titre" id="modifieradminanime2titre" style="margin-top:50px;" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime15numero" id="modifieradminanime2titre" placeholder="Numéro" autocomplete="off" min="0" required /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime15" /></legend>
									</fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime16">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Ajouter un oav</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime17))
									{
										echo $erroranime17;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime16titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime16numero" id="modifieradminanime2titre" placeholder="Numéro" autocomplete="off" min="0" required /><br />
									<p class="modifieradminanime1titrebandeannonce">Titre de l'oav</p>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime16titreepisode" placeholder="Titre oav" autocomplete="off" maxlength="65" required ></textarea><br />
									<p class="modifieradminanime1titrebandeannonce">Video vostfr</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime16videovostfr" placeholder="Lien vostfr" autocomplete="off" required ></textarea><br />
									<p class="modifieradminanime1titrebandeannonce">Video vf</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime16videovf" placeholder="Lien vf" autocomplete="off" minlength="10" ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime16" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime17">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Modifier un oav</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime18))
									{
										echo $erroranime18;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime17titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime17numero" id="modifieradminanime2titre" placeholder="Numéro" autocomplete="off" min="0" required /><br />
									<p class="modifieradminanime1titrebandeannonce">Modifier le numéro</p>
									<input type="number" name="modifieradminanime17modifiernumero" id="modifieradminanime2titre" placeholder="Numéro" autocomplete="off" min="0" /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime17inputmodifiernumero" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier le titre</p>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime17modifiertitreepisode" placeholder="Titre oav" autocomplete="off" minlength="3" maxlength="65" ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime17inputmodifiertitreepisode" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier la video vostfr</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime17modifiervideovostfr" placeholder="Lien vostfr" autocomplete="off" minlength="10" ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime17inputmodifiervideovostfr" /></legend>
									 </fieldset>
									<p class="modifieradminanime1titrebandeannonce">Modifier la video vf</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime17modifiervideovf" placeholder="Lien vf" autocomplete="off" minlength="10" ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime17inputmodifiervideovf" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime18">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Supprimer un oav</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime19))
									{
										echo $erroranime19;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime18titre" id="modifieradminanime2titre" style="margin-top:50px;" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime18numero" id="modifieradminanime2titre" placeholder="Numéro" autocomplete="off" min="0" required /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime18" /></legend>
									</fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime19">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Ajouter un générique</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime20))
									{
										echo $erroranime20;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime19titre" id="modifieradminanime2titre" style="margin-top:50px;" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<select name="modifieradminanime19generique" id="modifieradminanime2titre">
										<option value="OPENING">OPENING</option>
										<option value="ENDING">ENDING</option>
										<option value="AMV">AMV</option>
									</select><br />
									<p class="modifieradminanime1titrebandeannonce">Video</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime19video" placeholder="Lien video" autocomplete="off" minlength="10" required ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime19" /></legend>
									</fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime20">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Modifier un générique</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime21))
									{
										echo $erroranime21;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime20titre" id="modifieradminanime2titre" style="margin-top:50px;" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<select name="modifieradminanime20generique" id="modifieradminanime2titre">
										<option value="OPENING">OPENING</option>
										<option value="ENDING">ENDING</option>
										<option value="AMV">AMV</option>
									</select><br />
									<p class="modifieradminanime1titrebandeannonce">Modifier la video</p>
									<span class="modifieradminanime1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminanime1synopsis" name="modifieradminanime20video" placeholder="Lien video" autocomplete="off" minlength="10" required ></textarea><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime20" /></legend>
									</fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime21">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Ajouter une video</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime22))
									{
										echo $erroranime22;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime21titre" id="modifieradminfilm3titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<select name="modifieradminanime21zone" id="modifieradminfilm3titre">
										<option value="EPISODE">EPISODE</option>
										<option value="FILM">FILM</option>
										<option value="FILMSPECIAL">FILMSPECIAL</option>
										<option value="OAV">OAV</option>
									</select><br />
									<input type="number" name="modifieradminanime21numero" id="modifieradminfilm3titre" placeholder="Numéro" autocomplete="off" min="0" required /><br />
									<select name="modifieradminanime21lecteurvideo" id="modifieradminfilm3titre">
										<option value="VF">VF</option>
										<option value="VOSTFR">VOSTFR</option>
									</select><br />
									<input type="text" name="modifieradminanime21nomvideo" id="modifieradminfilm3titre" placeholder="Nom video" autocomplete="off" style="margin-bottom:20px;" required /><br />
									<p class="modifieradminfilm2titrevideovf">video</p>
									<span class="modifieradminfilm2textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm2videovf" name="modifieradminanime21video" minlength="10" placeholder="Lien video" autocomplete="off" required ></textarea><br />
									<fieldset class="modifieradminfilm3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm3valider" name="modifieradminanime21" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime22">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Modifier une video</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime23))
									{
										echo $erroranime23;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime22titre" id="modifieradminfilm3titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<select name="modifieradminanime22zone" id="modifieradminfilm3titre">
										<option value="EPISODE">EPISODE</option>
										<option value="FILM">FILM</option>
										<option value="FILMSPECIAL">FILM SPECIAL</option>
										<option value="OAV">OAV</option>
									</select><br />
									<input type="number" name="modifieradminanime22numero" id="modifieradminfilm3titre" placeholder="Numéro" autocomplete="off" min="0" required /><br />
									<input type="text" name="modifieradminanime22nomvideo" id="modifieradminfilm3titre" placeholder="Nom video" autocomplete="off" style="margin-bottom:20px;" required /><br />
									<p class="modifieradminfilm2titrevideovf">Modifier la video</p>
									<span class="modifieradminfilm2textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm2videovf" name="modifieradminanime22video" minlength="10" placeholder="Lien video" autocomplete="off" required ></textarea><br />
									<fieldset class="modifieradminfilm3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm3valider" name="modifieradminanime22" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime23">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Supprimer une video</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime24))
									{
										echo $erroranime24;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime23titre" id="modifieradminfilm3titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<select name="modifieradminanime23zone" id="modifieradminfilm3titre">
										<option value="EPISODE">EPISODE</option>
										<option value="FILM">FILM</option>
										<option value="FILMSPECIAL">FILM SPECIAL</option>
										<option value="OAV">OAV</option>
									</select><br />
									<input type="number" name="modifieradminanime23numero" id="modifieradminfilm3titre" placeholder="Numéro" autocomplete="off" min="0" required /><br />
									<input type="text" name="modifieradminanime23nomvideo" id="modifieradminfilm3titre" placeholder="Nom video" autocomplete="off" style="margin-bottom:20px;" required /><br />
									<fieldset class="modifieradminfilm3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm3valider" name="modifieradminanime23" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime24">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Lien mort</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime25))
									{
										echo $erroranime25;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<div class="blockadminfilm6">
									<span class="blockadminfilm6video">video</span>
									<span class="blockadminfilm6id">IDmembre</span>
								</div>
								<?php
								$blockadminanimeepisode24info = $db->query('SELECT * FROM signaleepisode ORDER BY ID');
								$blockadminanimefilmanime24info = $db->query('SELECT * FROM signalefilmanime ORDER BY ID');
								$blockadminanimespecial24info = $db->query('SELECT * FROM signalespecial ORDER BY ID');
								$blockadminanimeoav24info = $db->query('SELECT * FROM signaleoav ORDER BY ID');
						
								while ($animeepisode24info = $blockadminanimeepisode24info->fetch())
								{
								?>
								<div class="blockadminfilm6info">
									<a href="<?php echo $animeepisode24info['lien']; ?>" target="_blank" style="color:white;text-decoration:none;">
									<div class="blockadminfilm6videoinfo">
										<span><?php echo $animeepisode24info['video']; ?></span>
									</div>
									<div class="blockadminfilm6idinfo">
										<span><?php echo $animeepisode24info['IDmembre']; ?></span>
									</div>
									<span><img src="../images/fermer.png" alt="Supprimer" class="blockadminfilm6img" /></span>
									<form method="post" action="">
										<input type="text" value="<?php echo $animeepisode24info['ID']; ?>" name="blockadminanimeepisode24idinfo" style="opacity:0;" />
										<input type="submit" value="+" class="blockadminfilm6supprimer" name="blockadminanimeepisode24supprimer" />
									</form>
									</a>
								</div>
								<?php
								}
								$blockadminanimeepisode24info->closeCursor();
								
								while ($animefilmanime24info = $blockadminanimefilmanime24info->fetch())
								{
								?>
								<div class="blockadminfilm6info">
									<a href="<?php echo $animefilmanime24info['lien']; ?>" target="_blank" style="color:white;text-decoration:none;">
									<div class="blockadminfilm6videoinfo">
										<span><?php echo $animefilmanime24info['video']; ?></span>
									</div>
									<div class="blockadminfilm6idinfo">
										<span><?php echo $animefilmanime24info['IDmembre']; ?></span>
									</div>
									<span><img src="../images/fermer.png" alt="Supprimer" class="blockadminfilm6img" /></span>
									<form method="post" action="" >
										<input type="text" value="<?php echo $animefilmanime24info['ID']; ?>" name="blockadminanimefilmanime24idinfo" style="opacity:0;" />
										<input type="submit" value="+" class="blockadminfilm6supprimer" name="blockadminanimefilmanime24supprimer" />
									</form>
									</a>
								</div>
								<?php
								}
								$blockadminanimefilmanime24info->closeCursor();
								
								while ($animespecial24info = $blockadminanimespecial24info->fetch())
								{
								?>
								<div class="blockadminfilm6info">
									<a href="<?php echo $animespecial24info['lien']; ?>" target="_blank" style="color:white;text-decoration:none;">
									<div class="blockadminfilm6videoinfo">
										<span><?php echo $animespecial24info['video']; ?></span>
									</div>
									<div class="blockadminfilm6idinfo">
										<span><?php echo $animespecial24info['IDmembre']; ?></span>
									</div>
									<span><img src="../images/fermer.png" alt="Supprimer" class="blockadminfilm6img" /></span>
									<form method="post" action="" >
										<input type="text" value="<?php echo $animespecial24info['ID']; ?>" name="blockadminanimespecial24idinfo" style="opacity:0;" />
										<input type="submit" value="+" class="blockadminfilm6supprimer" name="blockadminanimespecial24supprimer" />
									</form>
									</a>
								</div>
								<?php
								}
								$blockadminanimespecial24info->closeCursor();
								
								while ($animefilmoav24info = $blockadminanimeoav24info->fetch())
								{
								?>
								<div class="blockadminfilm6info">
									<a href="<?php echo $animefilmoav24info['lien']; ?>" target="_blank" style="color:white;text-decoration:none;">
									<div class="blockadminfilm6videoinfo">
										<span><?php echo $animefilmoav24info['video']; ?></span>
									</div>
									<div class="blockadminfilm6idinfo">
										<span><?php echo $animefilmoav24info['IDmembre']; ?></span>
									</div>
									<span><img src="../images/fermer.png" alt="Supprimer" class="blockadminfilm6img" /></span>
									<form method="post" action="" >
										<input type="text" value="<?php echo $animefilmoav24info['ID']; ?>" name="blockadminanimeoav24idinfo" style="opacity:0;" />
										<input type="submit" value="+" class="blockadminfilm6supprimer" name="blockadminanimeoav24supprimer" />
									</form>
									</a>
								</div>
								<?php
								}
								$blockadminanimeoav24info->closeCursor();
								?>
								<br />
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime25">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Supprimer une saison</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime25deletesaison))
									{
										echo $erroranime25deletesaison;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminanime25titre" id="modifieradminanime2titre" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<input type="number" name="modifieradminanime25saison" id="modifieradminanime2titre" placeholder="Saison" autocomplete="off" min="0" required /><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminanime3valider" name="modifieradminanime25deletesaison" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminanime26">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Commentaire signaler</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($erroranime26))
									{
										echo $erroranime26;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<div class="blockadminfilm7">
									<span class="blockadminfilm7id">ID membre</span>
								</div>
								<?php
								$blockadmin26info = $db->query('SELECT * FROM signalecommentaire WHERE page !=\'' . 'film' . '\' AND page !=\'' . 'forum' . '\' ORDER BY ID');
						
								while ($admin26info = $blockadmin26info->fetch())
								{
								?>
								<div class="blockadminfilm7info">
									<a href="<?php echo $admin26info['lien']; ?>" target="_blank" style="color:white;text-decoration:none;">
									<div class="blockadminfilm7idinfo">
										<span><?php echo $admin26info['IDmembre']; ?></span>
									</div>
									<span><img src="../images/fermer.png" alt="Supprimer" class="blockadminfilm7img" /></span>
									<form method="post" action="" >
										<input type="text" value="<?php echo $admin26info['ID']; ?>" name="blockadmin26idcommentaireinfo" style="opacity:0;" />
										<input type="text" value="<?php echo $admin26info['page']; ?>" name="blockadmin26pagecommentaireinfo" style="opacity:0;display:none;" />
										<input type="submit" value="+" class="blockadminfilm7supprimer" name="blockadmin26supprimer" />
									</form>
									</a>
								</div>
								<?php
								}
								$blockadmin26info->closeCursor();
								?>
								<br />
							</div>
						</div>
					</div>	
					
					<div class="contenublockadmin" id="contenublockadminfilm">
						<span><img src="../images/retour.png" alt="Retour" class="retour" id="retourfilm" /></span>
						<span><img src="../images/administration.png" alt="" class="contenublockadminimg" /></span>
						<div class="blockmodifieradmin">
							<div class="modifieradmin" id="modifieradminfilm1">
								<p class="modifieradmintitre">Ajouter un film</p>
							</div>
							<div class="modifieradmin" id="modifieradminfilm2">
								<p class="modifieradmintitre">Modifier un film</p>
							</div>
							<div class="modifieradmin" id="modifieradminfilm3">
								<p class="modifieradmintitre">Ajouter une video</p>
							</div>
							<div class="modifieradmin" id="modifieradminfilm4">
								<p class="modifieradmintitre">Modifier une video</p>
							</div>
							<div class="modifieradmin" id="modifieradminfilm5">
								<p class="modifieradmintitre">Supprimer une video</p>
							</div>
							<div class="modifieradmin" id="modifieradminfilm6">
								<p class="modifieradmintitre">Lien mort</p>
							</div>
							<div class="modifieradmin" id="modifieradminfilm7">
								<p class="modifieradmintitre">Commentaire signaler</p>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminfilm1">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Ajouter un film</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($errorfilm1))
										{
											echo $errorfilm1;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<div class="contenumodifieradmininfo">
									<span>L'ajout d'un film doit être décidé par tout le staff.</span><br />
									<span class="contenumodifieradmininfoimg" id="contenumodifieradminfilm1infoimg">- L'image doit avoir le nom du film sans majuscules, sans espace ni de caractère spéciaux.</span>
									<span class="contenumodifieradmininfoimg" id="contenumodifieradminfilm1lettre" style="display:none;">- Insérer le premier caractère du titre en majuscule.</span>
								</div>
								<form method="post" action="" enctype="multipart/form-data">
									<input type="text" name="modifieradminfilm1titre" id="modifieradminfilm1titre" placeholder="Titre" autocomplete="off" maxlength="40" required />
									<div class="input-file-container3" id="modifieradminfilm1imgblock">
										<input class="input-file3" id="modifieradminfilm1img" name="modifieradminfilm1img" type="file" required />
										<label for="modifieradminfilm1img" class="input-file-trigger3" tabindex="0">Image</label>
									</div>
									<p class="file-return3"></p>
									<input type="text" name="modifieradminfilm1lettre" id="modifieradminfilm1lettre" placeholder="Première lettre" autocomplete="off" maxlength="1" required /><br />
									<input type="date" name="modifieradminfilm1date" id="modifieradminfilm1date" autocomplete="off" required />
									<input type="text" name="modifieradminfilm1realisateur" id="modifieradminfilm1realisateur" placeholder="Réalisateur" autocomplete="off" maxlength="25" required />
									<p class="modifieradminanime1titregenre">Genre</p>
									<div class="genre">
										<input type="checkbox" name="modifieradminfilm1genreaction" value="Action" id="modifieradminfilm1genreaction" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm1genreaction" class="modifieradminfilm1genre">Action</label>
										<input type="checkbox" name="modifieradminfilm1genreaventure" value="Aventure" id="modifieradminfilm1genreaventure" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm1genreaventure" class="modifieradminfilm1genre">Aventure</label>
										<input type="checkbox" name="modifieradminfilm1genreamitier" value="Amitié" id="modifieradminfilm1genreamitier" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm1genreamitier" class="modifieradminfilm1genre">Amitié</label>
										<input type="checkbox" name="modifieradminfilm1genrecomedie" value="Comédie" id="modifieradminfilm1genrecomedie" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm1genrecomedie" class="modifieradminfilm1genre">Comédie</label>
										<input type="checkbox" name="modifieradminfilm1genredrame" value="Drame" id="modifieradminfilm1genredrame" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm1genredrame" class="modifieradminfilm1genre">Drame</label>
										<input type="checkbox" name="modifieradminfilm1genrefantastique" value="Fantastique" id="modifieradminfilm1genrefantastique" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm1genrefantastique" class="modifieradminfilm1genre">Fantastique</label>
										<input type="checkbox" name="modifieradminfilm1genreguerre" value="Guerre" id="modifieradminfilm1genreguerre" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm1genreguerre" class="modifieradminfilm1genre">Guerre</label>
										<input type="checkbox" name="modifieradminfilm1genrecyber" value="Cyber" id="modifieradminfilm1genrecyber" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm1genrecyber" class="modifieradminfilm1genre">Cyber</label>
										<input type="checkbox" name="modifieradminfilm1genremecha" value="Mecha" id="modifieradminfilm1genremecha" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm1genremecha" class="modifieradminfilm1genre">Mecha</label>
										<input type="checkbox" name="modifieradminfilm1genresport" value="Sport" id="modifieradminfilm1genresport" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm1genresport" class="modifieradminfilm1genre">Sport</label>
										<input type="checkbox" name="modifieradminfilm1genrehorreur" value="Horreur" id="modifieradminfilm1genrehorreur" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm1genrehorreur" class="modifieradminfilm1genre">Horreur</label><br /> 
									</div>
									<p class="modifieradminfilm1titresynopsis">Synopsis</p>
									<textarea id="modifieradminfilm1synopsis" name="modifieradminfilm1synopsis" placeholder="Synopsis" autocomplete="off" minlength="20" maxlength="255" required></textarea><br />
									<p class="modifieradminfilm1titredurer">Durée</p>
									<input type="time" id="modifieradminfilm1durer" name="modifieradminfilm1durer" placeholder="Durée" autocomplete="off" required /><br />
									<p class="modifieradminfilm1titrebandeannonce">Bande annonce</p>
									<span class="modifieradminfilm1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm1bandeannonce" name="modifieradminfilm1bandeannonce" autocomplete="off" minlength="10" placeholder="Lien bande annonce" required ></textarea><br />
									<p class="modifieradminfilm1titrevideovostfr">Video vostfr</p>
									<span class="modifieradminfilm1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm1videovostfr" name="modifieradminfilm1videovostfr" autocomplete="off" minlength="10" placeholder="Lien vostfr" required ></textarea><br />
									<p class="modifieradminfilm1titrevideovf">Video vf</p>
									<span class="modifieradminfilm1textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm1videovf" name="modifieradminfilm1videovf" autocomplete="off" minlength="10" placeholder="Lien vf"></textarea><br />
									<fieldset class="modifieradminfilm1validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm1valider" name="modifieradminfilm1valider" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminfilm2">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Modifier un film</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($errorfilm2))
										{
											echo $errorfilm2;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" enctype="multipart/form-data">
									<input type="text" name="modifieradminfilm2titre" id="modifieradminfilm2titre" placeholder="Film" autocomplete="off" maxlength="40" required />
									<p class="modifieradminfilm1titrebandeannonce">Modifier le titre</p>
									<div class="contenumodifieradmininfo">
										<span class="contenumodifieradmininfoimg" id="contenumodifieradminfilm2infolettre">- Vous devrez uploader à nouveau l'image si vous modifiez le titre.</span>
									</div>
									<input type="text" name="modifieradminfilm2modifiertitre" id="modifieradminfilm2titre" placeholder="Titre" autocomplete="off" maxlength="40" />
									<fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminfilm2validermodifiertitre" /></legend>
									 </fieldset>
									 <p class="modifieradminfilm1titrebandeannonce">Modifier le premier caractère</p>
									 <div class="contenumodifieradmininfo">
										<span class="contenumodifieradmininfoimg" id="contenumodifieradminfilm2infolettre">- Insérer le premier caractère du titre en majuscule.</span>
									</div>
									 <input type="text" name="modifieradminfilm2lettre" id="modifieradminfilm1lettre" placeholder="Première lettre" autocomplete="off" maxlength="1" style="margin-left:29%;" /><br />
									 <fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminfilm2validerlettre" /></legend>
									 </fieldset>
									<p class="modifieradminfilm1titrebandeannonce">Modifier l'image</p>
									<div class="contenumodifieradmininfo" style="margin-bottom:100px;">
										<span class="contenumodifieradmininfoimg" id="contenumodifieradminfilm2infoimg">- L'image doit avoir le nom du film sans majuscules, sans espace ni de caractère spéciaux.</span>
									</div>
									<div class="input-file-container4" id="modifieradminfilm2imgblock">
										<input class="input-file4" id="modifieradminfilm2img" name="modifieradminfilm2img" type="file" />
										<label for="modifieradminfilm2img" class="input-file-trigger4" tabindex="0">Image</label>
									</div>
									<p class="file-return4"></p>
									<fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminfilm2validerimg" /></legend>
									 </fieldset>
									 <p class="modifieradminfilm1titrebandeannonce">Modifier la date</p>
									 <input type="date" name="modifieradminfilm2date" id="modifieradminfilm2date" autocomplete="off" />
									 <fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminfilm2validerdate" /></legend>
									 </fieldset>
									 <p class="modifieradminfilm1titrebandeannonce">Modifier le réalisateur</p>
									 <input type="text" name="modifieradminfilm2realisateur" id="modifieradminfilm2realisateur" placeholder="Réalisateur" autocomplete="off" maxlength="25" />
									 <fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminfilm2validerrealisateur" /></legend>
									 </fieldset>
									 <p class="modifieradminanime1titregenre">Modifier le genre</p>
									<div class="genre">
										<input type="checkbox" name="modifieradminfilm2genreaction" value="Action" id="modifieradminfilm2genreaction" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm2genreaction" class="modifieradminfilm1genre">Action</label>
										<input type="checkbox" name="modifieradminfilm2genreaventure" value="Aventure" id="modifieradminfilm2genreaventure" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm2genreaventure" class="modifieradminfilm1genre">Aventure</label>
										<input type="checkbox" name="modifieradminfilm2genreamitier" value="Amitié" id="modifieradminfilm2genreamitier" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm2genreamitier" class="modifieradminfilm1genre">Amitié</label>
										<input type="checkbox" name="modifieradminfilm2genrecomedie" value="Comédie" id="modifieradminfilm2genrecomedie" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm2genrecomedie" class="modifieradminfilm1genre">Comédie</label>
										<input type="checkbox" name="modifieradminfilm2genredrame" value="Drame" id="modifieradminfilm2genredrame" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm2genredrame" class="modifieradminfilm1genre">Drame</label>
										<input type="checkbox" name="modifieradminfilm2genrefantastique" value="Fantastique" id="modifieradminfilm2genrefantastique" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm2genrefantastique" class="modifieradminfilm1genre">Fantastique</label>
										<input type="checkbox" name="modifieradminfilm2genreguerre" value="Guerre" id="modifieradminfilm2genreguerre" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm2genreguerre" class="modifieradminfilm1genre">Guerre</label>
										<input type="checkbox" name="modifieradminfilm2genrecyber" value="Cyber" id="modifieradminfilm2genrecyber" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm2genrecyber" class="modifieradminfilm1genre">Cyber</label>
										<input type="checkbox" name="modifieradminfilm2genremecha" value="Mecha" id="modifieradminfilm2genremecha" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm2genremecha" class="modifieradminfilm1genre">Mecha</label>
										<input type="checkbox" name="modifieradminfilm2genresport" value="Sport" id="modifieradminfilm2genresport" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm2genresport" class="modifieradminfilm1genre">Sport</label>
										<input type="checkbox" name="modifieradminfilm2genrehorreur" value="Horreur" id="modifieradminfilm2genrehorreur" class="modifieradminfilm1genreboite" /><label for="modifieradminfilm2genrehorreur" class="modifieradminfilm1genre">Horreur</label>
									</div>
									<fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminfilm2validergenre" /></legend>
									 </fieldset>
									 <p class="modifieradminfilm1titresynopsis">Modifier le synopsis</p>
									<textarea id="modifieradminfilm1synopsis" name="modifieradminfilm2synopsis" placeholder="Synopsis" autocomplete="off" minlength="20" maxlength="255"></textarea><br />
									 <fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminfilm2validersynopsis" /></legend>
									 </fieldset>
									 <p class="modifieradminfilm1titredurer">Modifier la durée</p>
									<input type="time" id="modifieradminfilm1durer" name="modifieradminfilm2durer" placeholder="Durée" autocomplete="off" /><br />
									 <fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminfilm2validerdurer" /></legend>
									 </fieldset> 
									<p class="modifieradminfilm1titrebandeannonce">Modifier la bande annonce</p>
									<span class="modifieradminfilm2textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm1bandeannonce" name="modifieradminfilm2bandeannonce" autocomplete="off" minlength="10" placeholder="Lien bande annonce" ></textarea><br />
									 <fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminfilm2validerbandeannonce" /></legend>
									 </fieldset>
									<p class="modifieradminfilm2titrevideovostfr">Modifier la video vostfr</p>
									<span class="modifieradminfilm2textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm2videovostfr" name="modifieradminfilm2videovostfr" autocomplete="off" minlength="10" placeholder="Lien vostfr" ></textarea><br />
									<fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminfilm2validervostfr" /></legend>
									 </fieldset>
									<p class="modifieradminfilm2titrevideovf">Modifier la video vf</p>
									<span class="modifieradminfilm2textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm2videovf" name="modifieradminfilm2videovf" autocomplete="off" minlength="10" placeholder="Lien vf" ></textarea><br />
									<fieldset class="modifieradminfilm2validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm2valider" name="modifieradminfilm2validervf" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminfilm3">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Ajouter une video</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($errorfilm3))
										{
											echo $errorfilm3;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminfilm3titre" id="modifieradminfilm3titre" placeholder="Film" autocomplete="off" maxlength="40" required /><br />
									<select name="modifieradminfilm3lecteurvideo" id="modifieradminfilm3titre">
										<option value="VF">VF</option>
										<option value="VOSTFR">VOSTFR</option>
									</select><br />
									<input type="text" name="modifieradminfilm3nomvideo" id="modifieradminfilm3titre" placeholder="Nom video" autocomplete="off" style="margin-bottom:20px;" required /><br />
									<p class="modifieradminfilm2titrevideovf">Video</p>
									<span class="modifieradminfilm2textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm2videovf" name="modifieradminfilm3video" minlength="10" placeholder="Lien video" autocomplete="off" required ></textarea><br />
									<fieldset class="modifieradminfilm3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm3valider" name="modifieradminfilm3valider" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminfilm4">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Modifier une video</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($errorfilm4))
										{
											echo $errorfilm4;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminfilm4titre" id="modifieradminfilm3titre" placeholder="Film" autocomplete="off" maxlength="40" required /><br />
									<select name="modifieradminfilm4lecteurvideo" id="modifieradminfilm3titre">
										<option value="VF">VF</option>
										<option value="VOSTFR">VOSTFR</option>
									</select><br />
									<input type="text" name="modifieradminfilm4nomvideo" id="modifieradminfilm3titre" placeholder="Nom video" autocomplete="off" style="margin-bottom:20px;" required /><br />
									<p class="modifieradminfilm2titrevideovf">Modifier la video</p>
									<span class="modifieradminfilm2textvideo">- Insérer seulement le lien entre l'attribut src du code iframe.</span>
									<textarea type="text" id="modifieradminfilm2videovf" name="modifieradminfilm4video" minlength="10" placeholder="Lien video" autocomplete="off" required ></textarea><br />
									<fieldset class="modifieradminfilm3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm3valider" name="modifieradminfilm4valider" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminfilm5">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Supprimer une video</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($errorfilm5))
										{
											echo $errorfilm5;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminfilm5titre" id="modifieradminfilm3titre" placeholder="Film" autocomplete="off" maxlength="40" required /><br />
									<select name="modifieradminfilm5lecteurvideo" id="modifieradminfilm3titre">
										<option value="VF">VF</option>
										<option value="VOSTFR">VOSTFR</option>
									</select><br />
									<input type="text" name="modifieradminfilm5nomvideo" id="modifieradminfilm3titre" placeholder="Nom video" autocomplete="off" style="margin-bottom:20px;" required /><br />
									<fieldset class="modifieradminfilm3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm3valider" name="modifieradminfilm5valider" /></legend>
									 </fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminfilm6">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Lien mort</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($errorfilm6))
										{
											echo $errorfilm6;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<div class="blockadminfilm6">
									<span class="blockadminfilm6video">Video</span>
									<span class="blockadminfilm6id">IDmembre</span>
								</div>
								<?php
								$blockadminfilm6info = $db->query('SELECT * FROM signalefilm ORDER BY ID');
						
								while ($film6info = $blockadminfilm6info->fetch())
								{
								?>
								<div class="blockadminfilm6info">
									<a href="<?php echo $film6info['lien']; ?>" target="_blank" style="color:white;text-decoration:none;">
									<div class="blockadminfilm6videoinfo">
										<span><?php echo $film6info['video']; ?></span>
									</div>
									<div class="blockadminfilm6idinfo">
										<span><?php echo $film6info['IDmembre']; ?></span>
									</div>
									<span><img src="../images/fermer.png" alt="Supprimer" class="blockadminfilm6img" /></span>
									<form method="post" action="" >
										<input type="text" value="<?php echo $film6info['ID']; ?>" name="blockadminfilm6idinfo" style="opacity:0;" />
										<input type="submit" value="+" class="blockadminfilm6supprimer" name="blockadminfilm6supprimer" />
									</form>
									</a>
								</div>
								<?php
								}
								$blockadminfilm6info->closeCursor();
								?>
								<br />
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminfilm7">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Commentaire signaler</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($errorfilm7))
										{
											echo $errorfilm7;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<div class="blockadminfilm7">
									<span class="blockadminfilm7id">ID membre</span>
								</div>
								<?php
								$blockadminfilm7info = $db->query('SELECT * FROM signalecommentaire WHERE page =\'' . 'film' . '\' ORDER BY ID');
						
								while ($film7info = $blockadminfilm7info->fetch())
								{
								?>
								<div class="blockadminfilm7info">
									<a href="<?php echo $film7info['lien']; ?>" target="_blank" style="color:white;text-decoration:none;">
									<div class="blockadminfilm7idinfo">
										<span><?php echo $film7info['IDmembre']; ?></span>
									</div>
									<span><img src="../images/fermer.png" alt="Supprimer" class="blockadminfilm7img" /></span>
									<form method="post" action="" >
										<input type="text" value="<?php echo $film7info['ID']; ?>" name="blockadminfilm7idcommentaireinfo" style="opacity:0;" />
										<input type="submit" value="+" class="blockadminfilm7supprimer" name="blockadminfilm7supprimer" />
									</form>
									</a>
								</div>
								<?php
								}
								$blockadminfilm7info->closeCursor();
								?>
								<br />
							</div>
						</div>
					</div>
					
					<div class="contenublockadmin" id="contenublockadminforum">
						<span><img src="../images/retour.png" alt="Retour" class="retour" id="retourforum" /></span>
						<span><img src="../images/administration.png" alt="" class="contenublockadminimg" /></span>
						<div class="blockmodifieradmin">
							<div class="modifieradmin" id="modifieradminforum1">
								<p class="modifieradmintitre">Sujet signaler</p>
							</div>
							<div class="modifieradmin" id="modifieradminforum2">
								<p class="modifieradmintitre">Commentaire signaler</p>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminforum1">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Sujet signaler</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($errorforum1))
										{
											echo $errorforum1;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<div class="blockadminforum1">
									<span class="blockadminforum1titre">Titre</span>
									<span class="blockadminforum1theme">Thème</span>
									<span class="blockadminforum1id">ID membre</span>
								</div>
								<?php
								$blockadminforum1info = $db->query('SELECT * FROM signalesujet ORDER BY ID');
						
								while ($forum1info = $blockadminforum1info->fetch())
								{
									$searchforum1couleur = $db->query('SELECT couleur FROM forumsujets WHERE ID =\'' . $forum1info['IDsujet'] . '\'');
									$forum1couleur = $searchforum1couleur->fetch();
								?>
								<div class="blockadminforum1info" style="border-left: 15px solid <?php echo $forum1couleur['couleur']; ?>;">
									<a href="../forum.php?id=<?php echo $forum1info['IDsujet']; ?>" target="_blank" style="color:white;text-decoration:none;">
									<div class="blockadminforum1titreinfo">
										<span><?php echo htmlspecialchars($forum1info['titre']); ?></span>
									</div>
									<div class="blockadminforum1themeinfo">
										<span><?php echo $forum1info['theme']; ?></span>
									</div>
									<div class="blockadminforum1idinfo">
										<span><?php echo $forum1info['IDmembre']; ?></span>
									</div>
									<span><img src="../images/fermer.png" alt="Supprimer" class="blockadminforum1img" /></span>
									<form method="post" action="" >
										<input type="text" value="<?php echo $forum1info['ID']; ?>" name="blockadminforum1titreinfo" style="opacity:0;" />
										<input type="submit" value="+" class="blockadminforum1supprimer" name="blockadminforum1supprimer" />
									</form>
									</a>
								</div>
								<?php
								}
								$blockadminforum1info->closeCursor();
								?>
								<br />
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminforum2">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Commentaire signaler</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($errorforum2))
										{
											echo $errorforum2;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<div class="blockadminforum2">
									<span class="blockadminforum2id">ID membre</span>
								</div>
								<?php
								$blockadminforum2info = $db->query('SELECT * FROM signalecommentaire WHERE page=\'' . 'forum' . '\' ORDER BY ID');
						
								while ($forum2info = $blockadminforum2info->fetch())
								{
								?>
								<div class="blockadminforum2info">
									<a href="<?php echo $forum2info['lien']; ?>" target="_blank" style="color:white;text-decoration:none;">
									<div class="blockadminforum2idinfo">
										<span><?php echo $forum2info['IDmembre']; ?></span>
									</div>
									<span><img src="../images/fermer.png" alt="Supprimer" class="blockadminforum2img" /></span>
									<form method="post" action="" >
										<input type="text" value="<?php echo $forum2info['ID']; ?>" name="blockadminforum2idcommentaireinfo" style="opacity:0;" />
										<input type="submit" value="+" class="blockadminforum2supprimer" name="blockadminforum2supprimer" />
									</form>
									</a>
								</div>
								<?php
								}
								$blockadminforum2info->closeCursor();
								?>
								<br />
							</div>
						</div>
					</div>
					
					<div class="contenublockadmin" id="contenublockadmingallery">
						<span><img src="../images/retour.png" alt="Retour" class="retour" id="retourgallery" /></span>
						<span><img src="../images/administration.png" alt="" class="contenublockadminimg" /></span>
						<div class="blockmodifieradmin">
							<div class="modifieradmin" id="modifieradmingallery1">
								<p class="modifieradmintitre">Image signaler</p>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradmingallery1">
							<div class="contenumodifieradmin">
								<p class="contenumodifieradmintitre">Image signaler</p>
								<div id="resultatmodificationavatar" class="resultatmodification">
									<?php
										if(isset($errorgallery1))
										{
											echo $errorgallery1;
										}
									?>
								</div>
								<hr class="hrcontenuadmin" />
								<div class="blockadminforum2">
									<span class="blockadminforum2id">ID membre</span>
								</div>
								<?php
								$blockadmingallery1info = $db->query('SELECT * FROM signalegallery ORDER BY ID');
						
								while ($gallery1info = $blockadmingallery1info->fetch())
								{
								?>
								<div class="blockadminforum2info">
									<a href="../gallery.php?administration=<?php echo $gallery1info['IDgallery']; ?>" target="_blank" style="color:white;text-decoration:none;">
									<div class="blockadminforum2idinfo">
										<span><?php echo $gallery1info['IDmembre']; ?></span>
									</div>
									<span><img src="../images/fermer.png" alt="Supprimer" class="blockadminforum2img" /></span>
									<form method="post" action="" >
										<input type="text" value="<?php echo $gallery1info['ID']; ?>" name="blockadmingallery1idimageinfo" style="opacity:0;" />
										<input type="submit" value="+" class="blockadminforum2supprimer" name="blockadmingallery1supprimer" />
									</form>
									</a>
								</div>
								<?php
								}
								$blockadmingallery1info->closeCursor();
								?>
								<br />
							</div>
						</div>
					</div>
					
					<div class="contenublockadmin" id="contenublockadminmembre">
						<span><img src="../images/retour.png" alt="Retour" title="Retour" class="retour" id="retourmembre" /></span>
						<span><img src="../images/administration.png" alt="" class="contenublockadminimg" /></span>
						<div class="blockmodifieradmin">
							<div class="modifieradmin" id="modifieradminmembre1">
								<p class="modifieradmintitre">Information</p>
							</div>
							<div class="modifieradmin" id="modifieradminmembre2">
								<p class="modifieradmintitre">Membre banni</p>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminmembre1">
							<div class="contenumodifieradmin">
							
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminmembre2">
							<div class="contenumodifieradmin">
							
							</div>
						</div>
					</div>
					
					<div class="contenublockadmin" id="contenublockadmincontact">
						<span><img src="../images/retour.png" alt="Retour" title="Retour" class="retour" id="retourcontact" /></span>
						<span><img src="../images/administration.png" alt="" class="contenublockadminimg" /></span>
						<div class="blockmodifieradmin">
							<div class="modifieradmin" id="modifieradmincontact1">
								<p class="modifieradmintitre">Demande d'ajout</p>
							</div>
							<div class="modifieradmin" id="modifieradmincontact2">
								<p class="modifieradmintitre">Autres</p>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradmincontact1">
							<div class="contenumodifieradmin">
							
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradmincontact2">
							<div class="contenumodifieradmin">
							
							</div>
						</div>
					</div>
					
					<div class="contenublockadmin" id="contenublockadmincalendrier">
						<span><img src="../images/retour.png" alt="Retour" title="Retour" class="retour" id="retourcalendrier" /></span>
						<span><img src="../images/administration.png" alt="" class="contenublockadminimg" /></span>
						<div class="blockmodifieradmin">
							<div class="modifieradmin" id="modifieradmincalendrier1">
								<p class="modifieradmintitre">Ajouter une news</p>
							</div>
							<div class="modifieradmin" id="modifieradmincalendrier2">
								<p class="modifieradmintitre">Modifier une news</p>
							</div>
							<div class="modifieradmin" id="modifieradmincalendrier3">
								<p class="modifieradmintitre">Supprimer une news</p>
							</div>
							<div class="modifieradmin" id="modifieradmincalendrier4">
								<p class="modifieradmintitre">Commentaire signaler</p>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradmincalendrier1">
							<div class="contenumodifieradmin">
							
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradmincalendrier2">
							<div class="contenumodifieradmin">
							
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradmincalendrier3">
							<div class="contenumodifieradmin">
							
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradmincalendrier4">
							<div class="contenumodifieradmin">
							
							</div>
						</div>
					</div>
					
					<div class="contenublockadmin" id="contenublockadminjournal">
						<span><img src="../images/retour.png" alt="Retour" class="retour" id="retourjournal" /></span>
						<span><img src="../images/administration.png" alt="" class="contenublockadminimg" /></span>
						<div class="blockmodifieradmin">
							<div class="modifieradmin" id="modifieradminjournal1">
								<p class="modifieradmintitre">Ajouter une news</p>
							</div>
							<div class="modifieradmin" id="modifieradminjournal2">
								<p class="modifieradmintitre">Demande</p>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminjournal1">
							<div class="contenumodifieradmin">
							<p class="contenumodifieradmintitre">Ajouter une news</p>
							<div id="resultatmodificationavatar" class="resultatmodification">
								<?php
									if(isset($errorjournal1))
									{
										echo $errorjournal1;
									}
								?>
							</div>
								<hr class="hrcontenuadmin" />
								<form method="post" action="" >
									<input type="text" name="modifieradminjournal1titre" id="modifieradminanime2titre" style="margin-top:50px;" placeholder="Anime" autocomplete="off" maxlength="40" required /><br />
									<p class="modifieradminanime1titresynopsis" style="margin-top:20px;">Contenu</p>
									<div class="contenumodifieradmininfo">
										<span class="contenumodifieradmininfoimg">- Aucune mise en forme du texte n'est tolérée, les caractères seront affiché en blanc dans la police de Metro Manga.</span><br />
										<span class="contenumodifieradmininfoimg">- Veillez à ne pas dépasser la largeur du bloc ci-dessous.</span>
									</div>
									<div class="modifieradminjournal1contenu">
										<textarea name="modifieradminjournal1contenu" >
										</textarea>
										<script>
											CKEDITOR.replace( 'modifieradminjournal1contenu' );
										</script>
									</div>
									<p class="modifieradminanime1titresynopsis">Durée de la publication</p>
									<select name="modifieradminjournal1datedelete" id="modifieradminfilm3titre">
										<option value="toujours">toujours</option>
										<option value="2semaines">2 semaines</option>
										<option value="1mois">1 mois</option>
										<option value="6mois">6 mois</option>
										<option value="1an">1 an</option>
									</select><br />
									<fieldset class="modifieradminanime3validerbarre">
										 <legend><input type="submit" value="Valider" id="modifieradminfilm3valider" name="modifieradminjournal1valider" /></legend>
									</fieldset>
								</form>
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminjournal2">
							<div class="contenumodifieradmin">
							
							</div>
						</div>
					</div>
					
					<div class="contenublockadmin" id="contenublockadminmetromanga">
						<span><img src="../images/retour.png" alt="Retour" title="Retour" class="retour" id="retourmetromanga" /></span>
						<span><img src="../images/administration.png" alt="" class="contenublockadminimg" /></span>
						<div class="blockmodifieradmin">
							<div class="modifieradmin" id="modifieradminmetromanga1">
								<p class="modifieradmintitre">Mur</p>
							</div>
							<div class="modifieradmin" id="modifieradminmetromanga2">
								<p class="modifieradmintitre">Demande</p>
							</div>
							<div class="modifieradmin" id="modifieradminmetromanga3">
								<p class="modifieradmintitre">Règlement</p>
							</div>
						</div>
						
						<div class="blockcontenumodifieradmin" id="contenumodifieradminmetromanga1">
							<div class="contenumodifieradmin">
							
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminmetromanga2">
							<div class="contenumodifieradmin">
							
							</div>
						</div>
						<div class="blockcontenumodifieradmin" id="contenumodifieradminmetromanga3">
							<div class="contenumodifieradmin">
							
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			}
			else
			{
			?>
				<img src="../images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
				<script>
					window.setTimeout("location=('../index.php');",0);
				</script>
			<?php
			}
		}
		else
		{
		?>
			<img src="../images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
			<script>
				window.setTimeout("location=('../index.php');",0);
			</script>
		<?php
		}
		?>
		</div>
		<script src="administration.js"></script>
	</body>
</html>