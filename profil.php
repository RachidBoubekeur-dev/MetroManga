<?php 
	session_start();
	$db = new PDO('mysql:host=localhost;dbname=metromanga', 'root', '');
							
	if(isset($_FILES['modifieravatar']) AND !empty($_FILES['modifieravatar']['name']))
	{
		$taille = $_FILES['modifieravatar']['size'];
		if($taille <= 5097152)
		{
			$extension = strtolower(substr(strrchr($_FILES['modifieravatar']['name'], '.'),1));
			$perm_ext = array('jpg','jpeg','png');
			$nomavatar = "avatar".$_SESSION['ID'].".".$extension;
			if(in_array($extension,$perm_ext))
			{
				@unlink("membre/avatar/" . $_SESSION['avatar']);
				
				$chemin = "membre/avatar/avatar".$_SESSION['ID'].".".$extension;
				move_uploaded_file($_FILES['modifieravatar']['tmp_name'],$chemin);
				$actuavatar = $db->prepare('UPDATE membres SET avatar = :avatar WHERE ID = :ID');
				$actuavatar->execute(array(
					'avatar' => $nomavatar,
					'ID' => $_SESSION['ID']
					));
				header("Location: site/deconnexion.php");
			}
			else
			{
				$msgavatar = "<img src=\"images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
			}
		}
		else
		{
			$msgavatar = "<img src=\"images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le poids de l'image ne doit pas dépasser 5 Mo.\" />";
		}
	}
	
	if(isset($_FILES['modifierplandefond']) AND !empty($_FILES['modifierplandefond']['name']))
	{
		$taille = $_FILES['modifierplandefond']['size'];
		if($taille <= 10437184)
		{
			$extension = strtolower(substr(strrchr($_FILES['modifierplandefond']['name'], '.'),1));
			$perm_ext = array('jpg','jpeg','png');
			$nompdf = "pdf".$_SESSION['ID'].".".$extension;
			if(in_array($extension,$perm_ext))
			{
				@unlink("membre/plandefond/" . $_SESSION['plandefond']);
				
				$chemin = "membre/plandefond/pdf".$_SESSION['ID'].".".$extension;
				move_uploaded_file($_FILES['modifierplandefond']['tmp_name'],$chemin);
				$actupdf = $db->prepare('UPDATE membres SET plandefond = :plandefond WHERE ID = :ID');
				$actupdf->execute(array(
					'plandefond' => $nompdf,
					'ID' => $_SESSION['ID']
					));
				header("Location: site/deconnexion.php");
			}
			else
			{
				$msgpdf = "<img src=\"images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"L'extension du fichier envoyé n'est pas valide.\" />";
			}
		}
		else
		{
			$msgpdf = "<img src=\"images/supprimerrecherche.png\" alt=\"error\" class=\"resultatmodificationimg\" title=\"Le poids de l'image ne doit pas dépasser 10 Mo.\" />";
		}
	}
?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<link rel="stylesheet" href="profil.css" />
		<script src="//cdn.ckeditor.com/4.5.2/full/ckeditor.js"></script>
		<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
		<link href='css/Racing.css' rel='stylesheet' type='text/css'>
		<link href='css/Cookie.css' rel='stylesheet' type='text/css'>
		<link href='css/Raleway.css' rel='stylesheet' type='text/css'>
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script>
			(function($){
				$(window).on("load",function(){
					$("#body2").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".blockprofilmembrecontenu1").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".blockprofilmembrecontenu2").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".blockprofilmembrecontenu3").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".blockprofilmembrecontenu4").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".divsuggestionmembre").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".divabonnementforummodification2").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".divjournalotherliendiv1").mCustomScrollbar({
						theme:"inset-3"
					});
					$("#blockactualiteanimecontenu").mCustomScrollbar({
						theme:"inset-3"
					});
					$("#blockactualitemembrecontenu").mCustomScrollbar({
						theme:"inset-3"
					});
					$("#blockactualiteanimecontenu2").mCustomScrollbar({
						theme:"inset-3"
					});
					$("#blockactualitemembrecontenu2").mCustomScrollbar({
						theme:"inset-3"
					});
					$("#blockparametrenavigation2").mCustomScrollbar({
						theme:"inset-3"
					});
					$("#blocknotificationnavigation2").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".informationnotification").mCustomScrollbar({
						theme:"inset-1"
					});
				});
			})(jQuery);
		</script>
		<title>Profil - Metro Manga </title>
	</head>
	<body>
	<div id="body2">
	<div id="body" style="display:none;">
	</div>
		<?php include("includes/loading.php"); ?>
		<?php include("includes/header.php"); ?>
		<div id="contenuloading">
		<?php
			if(isset($_SESSION['ID']))
			{
			if(isset($_GET['id']))
			{
				$searchmembreexist = $db->query('SELECT * FROM membres WHERE ID =\'' . $_GET['id'] . '\'');
				$membreexist = $searchmembreexist->rowCount();
				if($membreexist == 1)
				{
					$searchinfomembre = $db->query('SELECT * FROM membres WHERE ID =\'' . $_GET['id'] . '\'');
					$infomembre = $searchinfomembre->fetch();
				?>
				<div class="blockprofilmembre">
				<style>
					body
					{
						margin-top:109px;
					}
				</style>
					<div class="blockprofilvisiteur">
					<div class="plandefondprofil" style="top:110px;"><img src="membre/plandefond/<?php echo $infomembre['plandefond']; ?>" alt="Plan de fond" class="plandefondprofilimg" /></div>
						<div style="background:rgb(32,32,32);position:relative;z-index:1;">
						<span><img src="membre/avatar/<?php echo $infomembre['avatar']; ?>" alt="Avatar" class="avatarprofil" /></span>
					<?php
						$selectnbabonnermembre = $db->query('SELECT COUNT(*) AS nbabonnermembre FROM abonnermembre WHERE IDpagemembre=\'' . $infomembre['ID'] .  '\'');
						$nbabonnermembre = $selectnbabonnermembre->fetch();
						
						$selectnbabonnementmembre = $db->query('SELECT COUNT(*) AS selectnbabonnementmembre FROM abonnermembre WHERE IDmembre=\'' . $infomembre['ID'] .  '\'');
						$nbabonnementmembre = $selectnbabonnementmembre->fetch();
						
						$selectifmembreabonner = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $_GET['id'] .  '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
						$ifmembreabonner = $selectifmembreabonner->rowCount();
					?>
						<div class="menuprofil">
							<div id="divabonnemenu">
								<span class="divabonnemenunb"><?php echo $nbabonnermembre['nbabonnermembre']; ?></span>
								<span class="divabonnemenutitre">Abonnés</span>
							</div>
							<div id="divabonnementmenu">
								<span class="divabonnementmenunb" id="divabonnementmenunb"><?php echo $nbabonnementmembre['selectnbabonnementmembre']; ?></span>
								<span class="divabonnementmenutitre">Abonnements</span>
							</div>
							<?php
								if($ifmembreabonner == 0 AND $infomembre['ID'] != $_SESSION['ID'])
								{
								?>
									<div id="divsuivremenu" class="divsuivremenumembre<?php echo $infomembre['ID']; ?>" onclick="divsuivremenumembre<?php echo $infomembre['ID']; ?>()">
										<span class="divsuivremenutitre">Suivre</span>
									</div>
									
									<div id="divsuivremenu" style="display:none;color:rgb(37,37,37);" class="divsuivremenunomembre<?php echo $infomembre['ID']; ?>" onclick="divsuivremenunomembre<?php echo $infomembre['ID']; ?>()">
										<span class="divsuivremenutitre">Suivre</span>
									</div>
								<?php
								}
								else if($infomembre['ID'] == $_SESSION['ID'])
								{
								?>
									<div id="divsuivremenu" style="color:rgb(37,37,37);cursor:default;">
										<span class="divsuivremenutitre">Suivre</span>
									</div>
								<?php
								}
								else
								{
								?>
									<div id="divsuivremenu" style="color:rgb(37,37,37);" class="divsuivremenunomembre<?php echo $infomembre['ID']; ?>" onclick="divsuivremenunomembre<?php echo $infomembre['ID']; ?>()">
										<span class="divsuivremenutitre">Suivre</span>
									</div>
									
									<div id="divsuivremenu" style="display:none;color:white;" class="divsuivremenumembre<?php echo $infomembre['ID']; ?>" onclick="divsuivremenumembre<?php echo $infomembre['ID']; ?>()">
										<span class="divsuivremenutitre">Suivre</span>
									</div>
								<?php
								}
							
								if($_GET['id'] == $_SESSION['ID'])
								{
								?>
									<div id="divautremenu" style="color:rgb(37,37,37);cursor:default;">
										<span class="divautremenupoint1">.</span>
										<span class="divautremenupoint2">.</span>
										<span class="divautremenupoint3">.</span>
									</div>
								<?php
								}
								else
								{
								?>
									<div id="divautremenu" class="divautremenujs">
										<span class="divautremenupoint1">.</span>
										<span class="divautremenupoint2">.</span>
										<span class="divautremenupoint3">.</span>
									</div>
								<?php
								}
							?>
						</div>
						<div id="divsignalemembre"  onclick="divsignalemembre<?php echo $infomembre['ID']; ?>()">
							<span class="spansignale">Signaler</span>
						</div>
						<div class="divabonnementbackground" style="margin-left:-200%;" id="divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>">
						</div>
						<div class="divabonnementforum" id="divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>">
							<fieldset class="barredeconnexion">
								<legend class="titredeconnexion">Confirmation</legend>
									<span>Êtes-vous sûr de ne plus vouloir suivre <?php echo $infomembre['pseudo']; ?> ?</span>
								</fieldset>
							<fieldset class="barreoui">
								<legend class="barrelegend" onclick="stopsuivre<?php echo $infomembre['ID']; ?>()">Oui</legend>
							</fieldset>
							<fieldset class="barreannuler">
								<legend class="barrelegend" id="annulersuivre<?php echo $infomembre['ID']; ?>">Annuler</legend>
							</fieldset>
						</div>
						<div class="divabonnementbackground" id="divabonnerbackground">
						</div>
						<div class="divabonnement" id="divabonner">
							<div class="divabonnementdivtitre">
								<span class="divabonnementtitre">Abonnés</span>
								<span><img src="images/supprimerrecherche2.png" alt="Close" class="divabonnementimgclose" id="divabonnerimgclose" /></span>
							</div>
							<div id="blockprofilmembrecontenu" class="blockprofilmembrecontenu1">
							<?php
								$selectIDmembreabonner = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $infomembre['ID'] . '\'');
								while($IDmembreabonner = $selectIDmembreabonner->fetch())
								{
									$selectmembreprofilabonner = $db->query('SELECT * FROM membres WHERE ID=\'' . $IDmembreabonner['IDmembre'] . '\'');
									$membreprofilabonner = $selectmembreprofilabonner->fetch();
								
									$membreprofilabonnervb = html_entity_decode($membreprofilabonner['pseudo']);
									
									if(mb_strlen($membreprofilabonnervb, 'utf8') <= 20)
									{
										$titremembreprofilabonnerarray[0] = $membreprofilabonnervb;
									}
									else
									{
										$titremembreprofilabonner = mb_substr($membreprofilabonnervb, 0, 17, 'utf8');
										
										$titremembreprofilabonnerarray[0] = $titremembreprofilabonner . "..."; 
									}
							?>
								<div class="animecontenu" id="membre2profilcontenu<?php echo $membreprofilabonner['ID'];?>">
									<a href="profil.php?id=<?php echo $membreprofilabonner['ID'];?>"><div class="animecontenudivimg" style="background: url(membre/avatar/<?php echo $membreprofilabonner['avatar']; ?>)no-repeat;background-size: cover;">
									</div></a>
									<?php
										if(mb_strlen($membreprofilabonnervb, 'utf8') <= 20)
										{
										?>
											<a href="profil.php?id=<?php echo $membreprofilabonner['ID'];?>"><span class="animecontenutitre"><?php echo htmlspecialchars($titremembreprofilabonnerarray[0]); ?></span></a><br />
										<?php
										}
										else
										{
										?>
											<a href="profil.php?id=<?php echo $membreprofilabonner['ID'];?>"><span class="animecontenutitre" title="<?php echo htmlspecialchars($membreprofilabonner['pseudo']); ?>"><?php echo htmlspecialchars($titremembreprofilabonnerarray[0]); ?></span></a><br />
										<?php
										}
									?>
									<span class="animecontenunbabonne" id="membreprofilcontenunbabonner<?php echo $membreprofilabonner['ID']; ?>"><?php echo $membreprofilabonner['nbabonner']; ?></span><br />
									<?php
										$searchabonnementmembreprofil = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $membreprofilabonner['ID'] .  '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
										$abonnementmembreprofil = $searchabonnementmembreprofil->rowCount();
										if($abonnementmembreprofil == 0)
										{
										?>
											<?php
												if($membreprofilabonner['ID'] != $_SESSION['ID'])
												{
												?>
													<span onclick="membre2profilcontenusuivrevisiteurimg2<?php echo $membreprofilabonner['ID']; ?>()"><img src="images/ajouteranime.png" alt="Suivre" class="animecontenusuivreimg" style="left:320px" id="membre2profilcontenusuivrevisiteurimg2<?php echo $membreprofilabonner['ID']; ?>" /></span>
												
													<span onclick="membreprofilcontenustopsuivreimg2<?php echo $membreprofilabonner['ID']; ?>()"><img src="images/stopsuivre.png" alt="Ne plus suivre" class="animecontenusuivreimg" style="display:none;left:320px" id="membreprofilcontenustopsuivreimg2<?php echo $membreprofilabonner['ID']; ?>" /></span>
												<?php
												}
											?>
										<?php
										}
										else
										{
										?>
											<?php
												if($membreprofilabonner['ID'] != $_SESSION['ID'])
												{
												?>
													<span onclick="membreprofilcontenustopsuivreimg2<?php echo $membreprofilabonner['ID']; ?>()"><img src="images/stopsuivre.png" alt="Ne plus suivre" class="animecontenusuivreimg" style="left:320px" id="membreprofilcontenustopsuivreimg2<?php echo $membreprofilabonner['ID']; ?>" /></span>
											
													<span onclick="membre2profilcontenusuivrevisiteurimg2<?php echo $membreprofilabonner['ID']; ?>()"><img src="images/ajouteranime.png" alt="Suivre" class="animecontenusuivreimg" style="display:none;left:320px" id="membre2profilcontenusuivrevisiteurimg2<?php echo $membreprofilabonner['ID']; ?>" /></span>
												<?php
												}
											?>
										<?php
										}
									?>
								</div>
							<?php
								}
								$selectIDmembreabonner->closeCursor();
							?>
							<script>
								<?php
									$selectIDmembreabonnerjs = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $infomembre['ID'] . '\'');
									while($IDmembreabonnerjs = $selectIDmembreabonnerjs->fetch())
									{
										$selectmembreprofilabonnerjs = $db->query('SELECT * FROM membres WHERE ID=\'' . $IDmembreabonnerjs['IDmembre'] . '\'');
										$membreprofilabonnerjs = $selectmembreprofilabonnerjs->fetch();
									?>
										function membreprofilcontenustopsuivreimg2<?php echo $membreprofilabonnerjs['ID']; ?>()
										{
											var xhr = new XMLHttpRequest();
										
											xhr.open('GET', 'site/phppageprofil.php?stopsuivremembre=<?php echo $membreprofilabonnerjs['ID']; ?>&visiteur=OK');
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.getElementById('membreprofilcontenustopsuivreimg2<?php echo $membreprofilabonnerjs['ID'];?>').style.display="none";
													document.getElementById('membre2profilcontenusuivrevisiteurimg2<?php echo $membreprofilabonnerjs['ID'];?>').style.display="inline-block";
													document.getElementById('membreprofilcontenunbabonner<?php echo $membreprofilabonnerjs['ID'];?>').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
									
										function membre2profilcontenusuivrevisiteurimg2<?php echo $membreprofilabonnerjs['ID']; ?>()
										{
											var xhr = new XMLHttpRequest();
										
											xhr.open('GET', 'site/phppageprofil.php?suivremembre=<?php echo $membreprofilabonnerjs['ID']; ?>');
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.getElementById('membre2profilcontenusuivrevisiteurimg2<?php echo $membreprofilabonnerjs['ID'];?>').style.display="none";
													document.getElementById('membreprofilcontenustopsuivreimg2<?php echo $membreprofilabonnerjs['ID'];?>').style.display="inline-block";
													document.getElementById('membreprofilcontenunbabonner<?php echo $membreprofilabonnerjs['ID'];?>').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
									<?php
									}
									$selectIDmembreabonnerjs->closeCursor();
								?>
							</script>
							</div>
						</div>
						<div class="divabonnementbackground" id="divabonnementbackground">
						</div>
						<div class="divabonnement" id="divabonnement">
							<div class="divabonnementdivtitre">
								<span class="divabonnementtitre">Abonnements</span>
								<span><img src="images/supprimerrecherche2.png" alt="Close" class="divabonnementimgclose" id="divabonnementimgclose" /></span>
							</div>
							<div id="blockprofilmembrecontenu" class="blockprofilmembrecontenu2">
							<?php
								$selectmembreprofilabonnement = $db->query('SELECT * FROM membres ORDER BY nbabonner DESC');
								while($membreprofilabonnement = $selectmembreprofilabonnement->fetch())
								{
								$searchabonnementexistmembreprofil = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $membreprofilabonnement['ID'] . '\' AND IDmembre=\'' . $infomembre['ID'] . '\'');
								$abonnementexistmembreprofil = $searchabonnementexistmembreprofil->rowCount();
								if($abonnementexistmembreprofil == 1)
								{
									$membreprofilabonnementvb = html_entity_decode($membreprofilabonnement['pseudo']);
									
									if(mb_strlen($membreprofilabonnementvb, 'utf8') <= 20)
									{
										$titremembreprofilabonnementarray[0] = $membreprofilabonnementvb;
									}
									else
									{
										$titremembreprofilabonnement = mb_substr($membreprofilabonnementvb, 0, 17, 'utf8');
										
										$titremembreprofilabonnementarray[0] = $titremembreprofilabonnement . "..."; 
									}
							?>
								<div class="animecontenu" id="membreprofilcontenu<?php echo $membreprofilabonnement['ID'];?>">
									<a href="profil.php?id=<?php echo $membreprofilabonnement['ID'];?>"><div class="animecontenudivimg" style="background: url(membre/avatar/<?php echo $membreprofilabonnement['avatar']; ?>)no-repeat;background-size: cover;">
									</div></a>
									<?php
										if(mb_strlen($membreprofilabonnementvb, 'utf8') <= 20)
										{
										?>
											<a href="profil.php?id=<?php echo $membreprofilabonnement['ID'];?>"><span class="animecontenutitre"><?php echo htmlspecialchars($titremembreprofilabonnementarray[0]); ?></span></a><br />
										<?php
										}
										else
										{
										?>
											<a href="profil.php?id=<?php echo $membreprofilabonnement['ID'];?>"><span class="animecontenutitre" title="<?php echo htmlspecialchars($membreprofilabonnement['pseudo']); ?>"><?php echo htmlspecialchars($titremembreprofilabonnementarray[0]); ?></span></a><br />
										<?php
										}
									?>
									<span class="animecontenunbabonne" id="membreprofilcontenunbabonnement<?php echo $membreprofilabonnement['ID']; ?>"><?php echo $membreprofilabonnement['nbabonner']; ?></span><br />
									
									<?php
										$searchabonnementmembreprofilvisiteur = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $membreprofilabonnement['ID'] .  '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
										$abonnementmembreprofilvisiteur = $searchabonnementmembreprofilvisiteur->rowCount();
										if($abonnementmembreprofilvisiteur == 0)
										{
											if($membreprofilabonnement['ID'] != $_SESSION['ID'])
											{
											?>
												<span onclick="membre2profilcontenusuivrevisiteurimg<?php echo $membreprofilabonnement['ID']; ?>()"><img src="images/ajouteranime.png" alt="Suivre" class="animecontenusuivreimg" style="left:320px" id="membre2profilcontenusuivrevisiteurimg<?php echo $membreprofilabonnement['ID']; ?>" /></span>
												
												<span onclick="membreprofilcontenustopsuivreimg<?php echo $membreprofilabonnement['ID']; ?>()"><img src="images/stopsuivre.png" alt="Ne plus suivre" class="animecontenusuivreimg" style="display:none;left:320px" id="membreprofilcontenustopsuivreimg<?php echo $membreprofilabonnement['ID']; ?>" /></span>
											<?php
											}
										}
										else
										{
											if($membreprofilabonnement['ID'] != $_SESSION['ID'])
											{
											?>
												<span onclick="membreprofilcontenustopsuivreimg<?php echo $membreprofilabonnement['ID']; ?>()"><img src="images/stopsuivre.png" alt="Ne plus suivre" class="animecontenusuivreimg" style="left:320px" id="membreprofilcontenustopsuivreimg<?php echo $membreprofilabonnement['ID']; ?>" /></span>
											
												<span onclick="membre2profilcontenusuivrevisiteurimg<?php echo $membreprofilabonnement['ID']; ?>()"><img src="images/ajouteranime.png" alt="Suivre" class="animecontenusuivreimg" style="display:none;left:320px" id="membre2profilcontenusuivrevisiteurimg<?php echo $membreprofilabonnement['ID']; ?>" /></span>
											<?php
											}
										}
									?>
								</div>
							<?php
								}
								}
								$selectmembreprofilabonnement->closeCursor();
							?>
								<script>
							<?php
								$selectmembreprofilabonnementjs = $db->query('SELECT * FROM membres ORDER BY nbabonner DESC');
								while($membreprofilabonnementjs = $selectmembreprofilabonnementjs->fetch())
								{
								$searchabonnementexistmembreprofil = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $membreprofilabonnementjs['ID'] . '\' AND IDmembre=\'' . $infomembre['ID'] . '\'');
								$abonnementexistmembreprofil = $searchabonnementexistmembreprofil->rowCount();
								if($abonnementexistmembreprofil == 1)
								{
								?>
									function membreprofilcontenustopsuivreimg<?php echo $membreprofilabonnementjs['ID']; ?>()
									{
										var xhr = new XMLHttpRequest();
									
										xhr.open('GET', 'site/phppageprofil.php?stopsuivremembre=<?php echo $membreprofilabonnementjs['ID']; ?>&visiteur=OK');
										
										xhr.onreadystatechange = function()
										{
											if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.getElementById('membreprofilcontenustopsuivreimg<?php echo $membreprofilabonnementjs['ID'];?>').style.display="none";
												document.getElementById('membre2profilcontenusuivrevisiteurimg<?php echo $membreprofilabonnementjs['ID'];?>').style.display="inline-block";
												document.getElementById('membreprofilcontenunbabonnement<?php echo $membreprofilabonnementjs['ID'];?>').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
								
									function membre2profilcontenusuivrevisiteurimg<?php echo $membreprofilabonnementjs['ID']; ?>()
									{
										var xhr = new XMLHttpRequest();
									
										xhr.open('GET', 'site/phppageprofil.php?suivremembre=<?php echo $membreprofilabonnementjs['ID']; ?>');
										
										xhr.onreadystatechange = function()
										{
											if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.getElementById('membre2profilcontenusuivrevisiteurimg<?php echo $membreprofilabonnementjs['ID'];?>').style.display="none";
												document.getElementById('membreprofilcontenustopsuivreimg<?php echo $membreprofilabonnementjs['ID'];?>').style.display="inline-block";
												document.getElementById('membreprofilcontenunbabonnement<?php echo $membreprofilabonnementjs['ID'];?>').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
								<?php
								}
								}
								$selectmembreprofilabonnementjs->closeCursor();
							?>
								</script>
							</div>
						</div>
						<script>
							
							function divsuivremenunomembre<?php echo $infomembre['ID']; ?>()
							{
								if(window.getComputedStyle(document.querySelector('#divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>')).display=='none')
								{
									setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.display="block";},100 )
									setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.opacity="0.35";}, 200 )
									setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.display="block";},100 )
									setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.opacity="1";},200 )
								}
								else
								{
									setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.display="block";},100 )
									setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.opacity="0.35";}, 200 )
									setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.display="block";},100 )
									setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.opacity="1";},200 )
								}
							}
							
							document.querySelector("#divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").onclick = function() 
							{ 
								if (window.getComputedStyle(document.querySelector('#divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>')).display=='block')
								{
									setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.display="none";},500 )
									setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.opacity="0";}, 100 )
									setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.display="none";},500 )
									setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.opacity="0";},100 )
								}
								else
								{
									setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.display="none";},500 )
									setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.opacity="0";}, 100 )
									setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.display="none";},500 )
									setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.opacity="0";},100 )
								}
							}
							
							document.querySelector("#annulersuivre<?php echo $infomembre['ID']; ?>").onclick = function() 
							{ 
								if (window.getComputedStyle(document.querySelector('#divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>')).display=='block')
								{
									setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.display="none";},500 )
									setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.opacity="0";}, 100 )
									setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.display="none";},500 )
									setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.opacity="0";},100 )
								}
								else
								{
									setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.display="none";},500 )
									setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.opacity="0";}, 100 )
									setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.display="none";},500 )
									setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.opacity="0";},100 )
								}
							}
							
							function stopsuivre<?php echo $infomembre['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
							
								xhr.open('GET', 'site/phppageprofil.php?stopsuivremembre=<?php echo $infomembre['ID']; ?>&visiteur=OK');
								
								xhr.onreadystatechange = function()
								{
									if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.display="none";},500 )
										setTimeout(function(){document.getElementById("divdeletebackgroundvisiteur<?php echo $infomembre['ID']; ?>").style.opacity="0";}, 100 )
										setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.display="none";},500 )
										setTimeout(function(){document.getElementById("divdeletearticlevisiteur<?php echo $infomembre['ID']; ?>").style.opacity="0";},100 )
										document.querySelector('.divabonnemenunb').innerHTML = xhr.responseText;
										document.querySelector(".divsuivremenunomembre<?php echo $infomembre['ID'];?>").style.display="none";
										document.querySelector(".divsuivremenumembre<?php echo $infomembre['ID'];?>").style.display="inline-block";
										document.querySelector(".divsuivremenumembre<?php echo $infomembre['ID'];?>").style.color="white";
									}
								};
								
								xhr.send(null);
							}
							
							function divsuivremenumembre<?php echo $infomembre['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
							
								xhr.open('GET', 'site/phppageprofil.php?suivremembre=<?php echo $infomembre['ID']; ?>');
								
								xhr.onreadystatechange = function()
								{
									if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('.divabonnemenunb').innerHTML = xhr.responseText;
										document.querySelector(".divsuivremenunomembre<?php echo $infomembre['ID'];?>").style.display="inline-block";
										document.querySelector(".divsuivremenunomembre<?php echo $infomembre['ID'];?>").style.color="rgb(37,37,37)";
										document.querySelector(".divsuivremenumembre<?php echo $infomembre['ID'];?>").style.display="none";
									}
								};
								
								xhr.send(null);
							}
							
							document.querySelector(".divautremenujs").onclick = function() 
							{ 
								if (window.getComputedStyle(document.querySelector('#divsignalemembre')).display=='none')
								{
									setTimeout(function(){document.getElementById("divsignalemembre").style.display="inline-block";},100 )
									setTimeout(function(){document.getElementById("divsignalemembre").style.opacity="1";}, 200 )
								}
								else
								{
									setTimeout(function(){document.getElementById("divsignalemembre").style.display="none";},500 )
									setTimeout(function(){document.getElementById("divsignalemembre").style.opacity="0";}, 100 )
								}
							}
							
							function divsignalemembre<?php echo $infomembre['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
							
								xhr.open('GET', 'site/phppageprofil.php?signalemembre=<?php echo $infomembre['ID']; ?>');
								
								xhr.onreadystatechange = function()
								{
									if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										setTimeout(function(){document.getElementById("divsignalemembre").style.display="none";},500 )
										setTimeout(function(){document.getElementById("divsignalemembre").style.opacity="0";}, 100 )
									}
								};
								
								xhr.send(null);
							}
							
						</script>
							<div id="blockjournalmenu">
								<div id="divjournalsuggestion">
									<div class="divsuggestion">
									<img src="images/bulb.png" alt="Bulb" class="imgsuggestion1"/>
										<span class="spansuggestion">Suggestions</span>
										<img src="images/bulb.png" alt="Bulb" class="imgsuggestion2"/>
									</div>
									<div class="divsuggestionmembre">
									<?php
									$selectmembreprofilsuggestion = $db->query('SELECT * FROM membres ORDER BY nbabonner DESC');
									while($membreprofilsuggestion = $selectmembreprofilsuggestion->fetch())
									{
									$membreprofilsearchsuggestionexist = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $membreprofilsuggestion['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\' ');
									$membreprofilsuggestionexist = $membreprofilsearchsuggestionexist->rowCount();
									if($membreprofilsuggestionexist >= 1)
									{
										$membreprofilsuggestionfetch = $membreprofilsearchsuggestionexist->fetch();
										
										$searchmembresuggestion = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre!=\'' . $_SESSION['ID'] . '\' AND IDpagemembre!=\'' . $infomembre['ID'] . '\' AND IDmembre=\'' . $membreprofilsuggestionfetch['IDpagemembre'] . '\'');
										$infomembresuggestionexist = $searchmembresuggestion->rowCount();
										$infomembresuggestionID = $searchmembresuggestion->fetch();
										$selectmembreprofilinfo = $db->query('SELECT * FROM membres WHERE ID =\'' . $infomembresuggestionID['IDpagemembre'] . '\'');
										$infomembresuggestion = $selectmembreprofilinfo->fetch();
										$searchmembresuggestionexit = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $infomembresuggestionID['IDpagemembre'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
										$infomembresuggestionexist2 = $searchmembresuggestionexit->rowCount();
										if($infomembresuggestionexist >= 1 AND $infomembresuggestionexist2 == 0)
										{
											
											$infomembresuggestionvb = html_entity_decode($infomembresuggestion['pseudo']);
											
											if(mb_strlen($infomembresuggestionvb, 'utf8') <= 15)
											{
												$titremembresuggestion[0] = $infomembresuggestionvb;
											}
											else
											{
												$titremembresugg = mb_substr($infomembresuggestionvb, 0, 12, 'utf8');
												
												$titremembresuggestion[0] = $titremembresugg . "..."; 
											}
									?>
										<div class="animecontenu">
											<a href="profil.php?id=<?php echo $infomembresuggestion['ID'];?>"><div class="animecontenudivimg" style="background: url(membre/avatar/<?php echo $infomembresuggestion['avatar']; ?>)no-repeat;background-size: cover;">
											</div></a>
											<?php
												if(mb_strlen($infomembresuggestion['pseudo'], 'utf8') <= 17)
												{
												?>
													<a href="profil.php?id=<?php echo $infomembresuggestion['ID'];?>"><span class="animecontenutitre"><?php echo htmlspecialchars($titremembresuggestion[0]); ?></span></a><br />
												<?php
												}
												else
												{
												?>
													<a href="profil.php?id=<?php echo $infomembresuggestion['ID'];?>"><span class="animecontenutitre" title="<?php echo htmlspecialchars($infomembresuggestion['pseudo']); ?>"><?php echo htmlspecialchars($titremembresuggestion[0]); ?></span></a><br />
												<?php
												}
											?>
											<span class="animecontenunbabonne" id="animecontenunbabonne<?php echo $infomembresuggestion['ID']; ?>"><?php echo $infomembresuggestion['nbabonner']; ?></span><br />
											
											<span onclick="membrecontenusuivreimgsuggestion<?php echo $infomembresuggestion['ID']; ?>()"><img src="images/ajouteranime.png" alt="Suivre" class="animecontenusuivreimg" id="membrecontenusuivreimgsuggestion<?php echo $infomembresuggestion['ID']; ?>" style="left:255px;" /></span>
		
											<img src="images/validerajouteranime.png" alt="Suivre" class="animecontenusuivreimg" id="suivreimgdisplaymembresuggestion<?php echo $infomembresuggestion['ID']; ?>" style="display:none;left:255px;" />
		
											
										</div>
										
										<style>
										
											#divjournalsuggestion
											{
												opacity: 1;
											}
											
											.divsuggestionmembre
											{
												padding-bottom: 5px;
											}
											
										</style>
									<?php
										}
									}
									}
									$selectmembreprofilsuggestion->closeCursor();
									?>
									<script>
									<?php
										$selectmembreprofilsuggestionjs = $db->query('SELECT * FROM membres ORDER BY nbabonner DESC');
										while($membreprofilsuggestionjs = $selectmembreprofilsuggestionjs->fetch())
										{
										?>
											function membrecontenusuivreimgsuggestion<?php echo $membreprofilsuggestionjs['ID']; ?>()
											{
												var xhr = new XMLHttpRequest();
											
												xhr.open('GET', 'site/phpparametreactualite.php?suivremembre=<?php echo $membreprofilsuggestionjs['ID']; ?>');
												
												xhr.onreadystatechange = function()
												{
													if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
													{
														document.getElementById('membrecontenusuivreimgsuggestion<?php echo $membreprofilsuggestionjs['ID'];?>').style.display="none";
														document.getElementById('suivreimgdisplaymembresuggestion<?php echo $membreprofilsuggestionjs['ID'];?>').style.display="inline-block";
														document.getElementById('animecontenunbabonne<?php echo $membreprofilsuggestionjs['ID'];?>').innerHTML = xhr.responseText;
													}
												};
												
												xhr.send(null);
											}
										<?php
										}
										$selectmembreprofilsuggestionjs->closeCursor();
									?>
								</script>
									</div>
								</div>
								<script>
								
									document.querySelector("#divabonnemenu").onclick = function() 
									{ 
										if (window.getComputedStyle(document.querySelector('#divabonnerbackground')).display=='none')
										{
											document.getElementById("divabonnemenu").style.color="rgb(37,37,37)";
											setTimeout(function(){document.getElementById("divabonnerbackground").style.display="block";},100 )
											setTimeout(function(){document.getElementById("divabonnerbackground").style.opacity="0.35";},200 )
											setTimeout(function(){document.getElementById("divabonner").style.display="block";},100 )
											setTimeout(function(){document.getElementById("divabonner").style.opacity="1";},200 )
										}
										else
										{
											document.getElementById("divabonnemenu").style.color="rgb(37,37,37)";
											setTimeout(function(){document.getElementById("divabonnerbackground").style.display="block";},100 )
											setTimeout(function(){document.getElementById("divabonnerbackground").style.opacity="0.35";},200 )
											setTimeout(function(){document.getElementById("divabonner").style.display="block";},100 )
											setTimeout(function(){document.getElementById("divabonner").style.opacity="1";},200 )
										}
									}
									
									document.querySelector("#divabonnerbackground").onclick = function() 
									{ 
										if (window.getComputedStyle(document.querySelector('#divabonnerbackground')).display=='block')
										{
											setTimeout(function(){document.getElementById("divabonnerbackground").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonnerbackground").style.opacity="0";}, 100 )
											setTimeout(function(){document.getElementById("divabonner").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonner").style.opacity="0";},100 )
											document.getElementById("divabonnemenu").style.color="white";
										}
										else
										{
											setTimeout(function(){document.getElementById("divabonnerbackground").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonnerbackground").style.opacity="0";}, 100 )
											setTimeout(function(){document.getElementById("divabonner").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonner").style.opacity="0";},100 )
											document.getElementById("divabonnemenu").style.color="white";
										}
									}
									
									document.querySelector("#divabonnerimgclose").onclick = function() 
									{ 
										if (window.getComputedStyle(document.querySelector('#divabonnerbackground')).display=='block')
										{
											setTimeout(function(){document.getElementById("divabonnerbackground").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonnerbackground").style.opacity="0";}, 100 )
											setTimeout(function(){document.getElementById("divabonner").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonner").style.opacity="0";},100 )
											document.getElementById("divabonnemenu").style.color="white";
										}
										else
										{
											setTimeout(function(){document.getElementById("divabonnerbackground").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonnerbackground").style.opacity="0";}, 100 )
											setTimeout(function(){document.getElementById("divabonner").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonner").style.opacity="0";},100 )
											document.getElementById("divabonnemenu").style.color="white";
										}
									}
									
									document.querySelector("#divabonnementmenu").onclick = function() 
									{ 
										if (window.getComputedStyle(document.querySelector('#divabonnementbackground')).display=='none')
										{
											document.getElementById("divabonnementmenu").style.color="rgb(37,37,37)";
											setTimeout(function(){document.getElementById("divabonnementbackground").style.display="block";},100 )
											setTimeout(function(){document.getElementById("divabonnementbackground").style.opacity="0.35";},200 )
											setTimeout(function(){document.getElementById("divabonnement").style.display="block";},100 )
											setTimeout(function(){document.getElementById("divabonnement").style.opacity="1";},200 )
										}
										else
										{
											document.getElementById("divabonnementmenu").style.color="rgb(37,37,37)";
											setTimeout(function(){document.getElementById("divabonnementbackground").style.display="block";},100 )
											setTimeout(function(){document.getElementById("divabonnementbackground").style.opacity="0.35";},200 )
											setTimeout(function(){document.getElementById("divabonnement").style.display="block";},100 )
											setTimeout(function(){document.getElementById("divabonnement").style.opacity="1";},200 )
										}
									}
									
									document.querySelector("#divabonnementbackground").onclick = function() 
									{ 
										if (window.getComputedStyle(document.querySelector('#divabonnementbackground')).display=='block')
										{
											setTimeout(function(){document.getElementById("divabonnementbackground").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonnementbackground").style.opacity="0";}, 100 )
											setTimeout(function(){document.getElementById("divabonnement").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonnement").style.opacity="0";},100 )
											document.getElementById("divabonnementmenu").style.color="white";
										}
										else
										{
											setTimeout(function(){document.getElementById("divabonnementbackground").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonnementbackground").style.opacity="0";}, 100 )
											setTimeout(function(){document.getElementById("divabonnement").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonnement").style.opacity="0";},100 )
											document.getElementById("divabonnementmenu").style.color="white";
										}
									}
									
									document.querySelector("#divabonnementimgclose").onclick = function() 
									{ 
										if (window.getComputedStyle(document.querySelector('#divabonnementbackground')).display=='block')
										{
											setTimeout(function(){document.getElementById("divabonnementbackground").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonnementbackground").style.opacity="0";}, 100 )
											setTimeout(function(){document.getElementById("divabonnement").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonnement").style.opacity="0";},100 )
											document.getElementById("divabonnementmenu").style.color="white";
										}
										else
										{
											setTimeout(function(){document.getElementById("divabonnementbackground").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonnementbackground").style.opacity="0";}, 100 )
											setTimeout(function(){document.getElementById("divabonnement").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divabonnement").style.opacity="0";},100 )
											document.getElementById("divabonnementmenu").style.color="white";
										}
									}
									
								</script>
								<div id="divjournalactu">
									<div id="divjournalactufiltre">
										<span class="actufiltrespan" id="actufiltrespan1">Forum</span>
										<span class="actufiltrespan" id="actufiltrespan2">Gallery</span>
									</div>
									<div id="actufiltrecontenue1">
									<?php
									$selectcountforumsujets = $db->query('SELECT COUNT(*) AS countforumsujets FROM forumsujets WHERE IDmembres=\'' . $infomembre['ID'] . '\'');
									$countforumsujets = $selectcountforumsujets->fetch();
									
									if($countforumsujets['countforumsujets'] == 0)
									{
									?>
										<p class="nopost">Aucune publication</p>
									<?php
									}
									
									$selectinfoforumsujets = $db->query('SELECT * FROM forumsujets WHERE IDmembres=\'' . $infomembre['ID'] . '\' ORDER BY date_creation DESC');
									while($infoforumsujets = $selectinfoforumsujets->fetch())
									{
										$searchnbdecommentairesforumsujets = $db->query('SELECT COUNT(*) AS nbdecommentairesforumsujets FROM commentairesforum WHERE IDsujet =\'' . $infoforumsujets['ID'] . '\'');
										$nbdecommentairesforumsujets = $searchnbdecommentairesforumsujets->fetch();
										
										$infoforumsujetstitre = html_entity_decode($infoforumsujets['titre']);
						
										if(mb_strlen($infoforumsujetstitre, 'utf8') <= 15)
										{
											$arrayinfoforumsujets[0] = $infoforumsujetstitre;
										}
										else
										{
											$forumsujetstitre = mb_substr($infoforumsujetstitre, 0, 12, 'utf8');
											
											$arrayinfoforumsujets[0] = $forumsujetstitre . "..."; 
										}
									?>
									<div class="divabonnementbackground" style="margin-left:-200%;" id="divdeletebackground<?php echo $infoforumsujets['ID']; ?>">
									</div>
									<div class="blockfilactualitearticle" id="blockfilactualitearticleforum<?php echo $infoforumsujets['ID']; ?>">
										<img src="membre/avatar/<?php echo $infomembre['avatar']; ?>" alt="Avatar" class="articleavatar"/>
										<span class="articlepseudo"><?php echo $infomembre['pseudo']; ?></span><br />
										<?php
											$dateanimgforum = date("Y", strtotime($infoforumsujets['date_creation']));
											$datemoisimgforum = date("m", strtotime($infoforumsujets['date_creation']));
											$datedayimgforum = date("d", strtotime($infoforumsujets['date_creation']));
											$dateheureimgforum = date("H", strtotime($infoforumsujets['date_creation']));
											$dateminimgforum = date("i", strtotime($infoforumsujets['date_creation']));
											
											$dateannowforum = date('Y');
											$datemoisnowforum = date('m');
											$datedaynowforum = date('d');
											$dateheurenowforum = date('H');
											$dateminnowforum = date('i');
											
											$dateanforum =  $dateannowforum - $dateanimgforum;
											$datemoisforum = $datemoisnowforum - $datemoisimgforum;
											$datemois2forum = $datemoisimgforum - $datemoisnowforum;
											$datedayforum = $datedaynowforum - $datedayimgforum;
											$dateheureforum = $dateheurenowforum - $dateheureimgforum;
											$dateminforum = $dateminnowforum - $dateminimgforum;
											
											$datemois3forum = 12 - $datemois2forum;
											
											if($dateanforum == 1 AND $datemois3forum == 1 AND $datedayforum != 0)
											{
												$dateday2forum = 31 - $datedayimgforum;
												$dateday3forum = $dateday2forum + $datedaynowforum;
												if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
												{
													$dateheure2forum = 24 - $dateheureimgforum;
													$dateheure3forum = $dateheure2forum + $dateheurenowforum;
													if($dateheure3forum >= 2)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
													<?php
													}
													else if($dateheure3forum == 1 AND $dateminforum >= 0)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
													<?php
													}
													else if($dateheure3forum == 1 AND $dateminforum < 0)
													{
														$datemin2forum = 60 + $dateminforum;
													?>
														<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
													<?php
													}
													else if($dateheure3forum == 1 AND $dateminforum == 1)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
													<?php
													}
												}
												else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
												<?php
												}
												else if($dateday3forum >= 31)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemois3forum; ?> mois</span>
												<?php
												}else
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
												<?php
												}
											}
											else if($dateanforum == 0 AND $datemoisforum == 0 AND $datedayforum == 0 AND $dateheureforum == 0 AND $dateminforum == 0)
											{
												?>
													<span class="articletemps">À l'instant</span>
												<?php
											}
											else if($dateanforum == 1 AND $datemois2forum >= 2)
											{
												$datemois4forum = 12 - $datemois2forum;
												?>
													<span class="articletemps">Il y a <?php echo $datemois4forum; ?> mois</span>
												<?php
											}
											else if($dateanforum == 1 AND ($datemoisforum >= 1 OR $datemoisforum <= 1))
											{
												?>
													<span class="articletemps">Il y a <?php echo $dateanforum; ?> an</span>
												<?php
											}
											else if($dateanforum >= 2)
											{
												?>
													<span class="articletemps">Il y a <?php echo $dateanforum; ?> ans</span>
												<?php
											}
											else if($datemoisforum == 0 AND $dateanforum >= 1)
											{
												if($dateanforum == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateanforum; ?> an</span>
												<?php
												}
												else if($dateanforum >= 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateanforum; ?> ans</span>
												<?php
												}
											}
											else if($dateanforum == 0 AND $datemoisforum >= 2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
											<?php
											}
											else if($dateanforum == 0 AND $datemoisforum == 1 AND $datedayforum == 0)
											{
											?>
												<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
											<?php
											}
											else if($dateanforum == 0 AND $datemoisforum == 0 AND $datedayforum >= 1)
											{
												if($datedayforum >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datedayforum; ?> jours</span>
												<?php
												}
												else if($datedayforum == 1 AND $dateheureimgforum > $dateheurenowforum)
												{
													$dateheure2forum = 24 - $dateheureimgforum;
													$dateheure3forum = $dateheure2forum + $dateheurenowforum;
													if($dateheure3forum >= 2)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
													<?php
													}
													else if($dateheure3forum == 1 AND $dateminforum >= 0)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
													<?php
													}
													else if($dateheure3forum == 1 AND $dateminforum < 0)
													{
														$datemin2forum = 60 + $dateminforum;
													?>
														<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
													<?php
													}
													else if($dateheure3forum == 1 AND $dateminforum == 1)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
													<?php
													}
												}
												else if($datedayforum == 1 AND $dateheureimgforum <= $dateheurenowforum)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datedayforum; ?> jour</span>
												<?php
												}
											}
											else if($dateanforum == 0 AND $datemoisforum == 1 AND $datedayforum != 0)
											{
												if($datemoisimgforum == 1)
												{
													$dateday2forum = 31 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimgforum == 2)
												{
													$dateday2forum = 28 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 28)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimgforum == 3)
												{
													$dateday2forum = 31 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimgforum == 4)
												{
													$dateday2forum = 30 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 30)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimgforum == 5)
												{
													$dateday2forum = 31 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimgforum == 6)
												{
													$dateday2forum = 30 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 30)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimgforum == 7)
												{
													$dateday2forum = 31 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimgforum == 8)
												{
													$dateday2forum = 31 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimgforum == 9)
												{
													$dateday2forum = 30 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 30)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimgforum == 10)
												{
													$dateday2forum = 31 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimgforum == 11)
												{
													$dateday2forum = 30 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 30)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimgforum == 12)
												{
													$dateday2forum = 31 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
											}
											else if($dateanforum == 0 AND $datemoisforum == 0 AND $datedayforum == 0 AND $dateminforum == 1)
											{
												if($dateheureforum == 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
												<?php
												}
												else if($dateheureforum == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
												<?php
												}
											}
											else if($dateanforum == 0 AND $datemoisforum == 0 AND $datedayforum == 0 AND $dateheureforum == 0)
											{
												if($dateminforum >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminforum; ?> minutes</span>
												<?php
												}
											}
											else if($dateanforum == 0 AND $datemoisforum == 0 AND $datedayforum == 0 AND $dateheureforum == 1 AND $dateminforum < 0 )
											{
												$datemin2forum = 60 + $dateminforum;
											?>
												<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
											<?php
											}
											else if($dateanforum == 0 AND $datemoisforum == 0 AND $datedayforum == 0 AND $dateheureforum == 1 AND $dateminforum >= 0 )
											{
												$datemin2forum = 60 + $dateminforum;
											?>
												<span class="articletemps">Il y a <?php echo $dateheureforum; ?> heure</span>
											<?php
											}
											else if($dateheureforum >= 2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateheureforum; ?> heures</span>
											<?php
											}
										?>
										<br />
										<a href="forum.php?id=<?php echo $infoforumsujets['ID']; ?>" style="text-decoration:none;" >
											<div class="cubesujets" style="background:url(<?php echo htmlspecialchars($infoforumsujets['image']); ?>)no-repeat;background-size: cover;color: <?php echo $infoforumsujets['couleur']; ?>;">
											<span class="cubesujetsmessages"><?php echo $nbdecommentairesforumsujets['nbdecommentairesforumsujets']; ?></span><br />
												<?php
													if(mb_strlen($infoforumsujetstitre, 'utf8') <= 15)
													{
													?>
														<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfoforumsujets[0]); ?></span></div>
													<?php
													}
													else
													{
													?>
														<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infoforumsujetstitre); ?>"><span><?php echo htmlspecialchars($arrayinfoforumsujets[0]); ?></span></div>
													<?php	
													}
												
												$searchmoynoteforumsujets = $db->query('SELECT AVG(note) AS notemoyforumsujets FROM notesforum WHERE IDsujet =\'' . $infoforumsujets['ID'] . '\'');
												$notemoyforumsujets = $searchmoynoteforumsujets->fetch();	
												if($notemoyforumsujets['notemoyforumsujets'] == 0)
												{
												?>
													<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
												<?php
												}
												else if($notemoyforumsujets['notemoyforumsujets'] > 0 && $notemoyforumsujets['notemoyforumsujets'] < 2)
												{
												?>
													<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
												<?php
												}
												else if($notemoyforumsujets['notemoyforumsujets'] >= 2 && $notemoyforumsujets['notemoyforumsujets'] < 3)
												{
												?>
													<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
												<?php
												}
												else if($notemoyforumsujets['notemoyforumsujets'] >= 3 && $notemoyforumsujets['notemoyforumsujets'] < 4)
												{
												?>
													<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
												<?php
												}
												else if($notemoyforumsujets['notemoyforumsujets'] >= 4 && $notemoyforumsujets['notemoyforumsujets'] < 5)
												{
												?>
													<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
												<?php
												}
												else if($notemoyforumsujets['notemoyforumsujets'] >= 5)
												{
												?>
													<span class="cubesujetsetoile">★★★★★</span>
												<?php
												}
											?>
											</div>
										</a>
									</div>
									<?php
									}
									$selectinfoforumsujets->closeCursor();
									?>
									</div>
									<div id="actufiltrecontenue2">
									<?php
									$selectcountgallery = $db->query('SELECT COUNT(*) AS countgallery FROM gallery WHERE IDmembre=\'' . $infomembre['ID'] . '\'');
									$countgallery = $selectcountgallery->fetch();
									
									if($countgallery['countgallery'] == 0)
									{
									?>
										<p class="nopost">Aucune publication</p>
									<?php
									}
									
									$selectinfogalleryimg = $db->query('SELECT * FROM gallery WHERE IDmembre=\'' . $infomembre['ID'] . '\' ORDER BY date DESC');
									while($infogalleryimg = $selectinfogalleryimg->fetch())
									{
									?>
									<div class="divabonnementbackground" style="margin-left:-200%;" id="divdeletebackgroundgallery<?php echo $infogalleryimg['ID']; ?>">
									</div>
									<div class="blockfilactualitearticle" id="blockfilactualitearticlegallery<?php echo $infogalleryimg['ID']; ?>">
										<img src="membre/avatar/<?php echo $infomembre['avatar']; ?>" alt="Avatar" class="articleavatar" />
										<span class="articlepseudo" ><?php echo $infomembre['pseudo']; ?></span><br />
										<?php
											$dateanimggallery = date("Y", strtotime($infogalleryimg['date']));
											$datemoisimggallery = date("m", strtotime($infogalleryimg['date']));
											$datedayimggallery = date("d", strtotime($infogalleryimg['date']));
											$dateheureimggallery = date("H", strtotime($infogalleryimg['date']));
											$dateminimggallery = date("i", strtotime($infogalleryimg['date']));
											
											$dateannowgallery = date('Y');
											$datemoisnowgallery = date('m');
											$datedaynowgallery = date('d');
											$dateheurenowgallery = date('H');
											$dateminnowgallery = date('i');
											
											$dateangallery =  $dateannowgallery - $dateanimggallery;
											$datemoisgallery = $datemoisnowgallery - $datemoisimggallery;
											$datemois2gallery = $datemoisimggallery - $datemoisnowgallery;
											$datedaygallery = $datedaynowgallery - $datedayimggallery;
											$dateheuregallery = $dateheurenowgallery - $dateheureimggallery;
											$datemingallery = $dateminnowgallery - $dateminimggallery;
											
											$datemois3gallery = 12 - $datemois2gallery;
											
											if($dateangallery == 1 AND $datemois3gallery == 1 AND $datedaygallery != 0)
											{
												$dateday2gallery = 31 - $datedayimggallery;
												$dateday3gallery = $dateday2gallery + $datedaynowgallery;
												if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
												{
													$dateheure2gallery = 24 - $dateheureimggallery;
													$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
													if($dateheure3gallery >= 2)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
													<?php
													}
													else if($dateheure3gallery == 1 AND $datemingallery >= 0)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
													<?php
													}
													else if($dateheure3gallery == 1 AND $datemingallery < 0)
													{
														$datemin2gallery = 60 + $datemingallery;
													?>
														<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
													<?php
													}
													else if($dateheure3gallery == 1 AND $datemingallery == 1)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
													<?php
													}
												}
												else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
												<?php
												}
												else if($dateday3gallery >= 31)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemois3gallery; ?> mois</span>
												<?php
												}else
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
												<?php
												}
											}
											else if($dateangallery == 0 AND $datemoisgallery == 0 AND $datedaygallery == 0 AND $dateheuregallery == 0 AND $datemingallery == 0)
											{
												?>
													<span class="articletemps">À l'instant</span>
												<?php
											}
											else if($dateangallery == 1 AND $datemois2gallery >= 2)
											{
												$datemois4gallery = 12 - $datemois2gallery;
												?>
													<span class="articletemps">Il y a <?php echo $datemois4gallery; ?> mois</span>
												<?php
											}
											else if($dateangallery == 1 AND ($datemoisgallery >= 1 OR $datemoisgallery <= 1))
											{
												?>
													<span class="articletemps">Il y a <?php echo $dateangallery; ?> an</span>
												<?php
											}
											else if($dateangallery >= 2)
											{
												?>
													<span class="articletemps">Il y a <?php echo $dateangallery; ?> ans</span>
												<?php
											}
											else if($datemoisgallery == 0 AND $dateangallery >= 1)
											{
												if($dateangallery == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateangallery; ?> an</span>
												<?php
												}
												else if($dateangallery >= 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateangallery; ?> ans</span>
												<?php
												}
											}
											else if($dateangallery == 0 AND $datemoisgallery >= 2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
											<?php
											}
											else if($dateangallery == 0 AND $datemoisgallery == 1 AND $datedaygallery == 0)
											{
											?>
												<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
											<?php
											}
											else if($dateangallery == 0 AND $datemoisgallery == 0 AND $datedaygallery >= 1)
											{
												if($datedaygallery >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datedaygallery; ?> jours</span>
												<?php
												}
												else if($datedaygallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
												{
													$dateheure2gallery = 24 - $dateheureimggallery;
													$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
													if($dateheure3gallery >= 2)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
													<?php
													}
													else if($dateheure3gallery == 1 AND $datemingallery >= 0)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
													<?php
													}
													else if($dateheure3gallery == 1 AND $datemingallery < 0)
													{
														$datemin2gallery = 60 + $datemingallery;
													?>
														<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
													<?php
													}
													else if($dateheure3gallery == 1 AND $datemingallery == 1)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
													<?php
													}
												}
												else if($datedaygallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datedaygallery; ?> jour</span>
												<?php
												}
											}
											else if($dateangallery == 0 AND $datemoisgallery == 1 AND $datedaygallery != 0)
											{
												if($datemoisimggallery == 1)
												{
													$dateday2gallery = 31 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimggallery == 2)
												{
													$dateday2gallery = 28 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 28)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimggallery == 3)
												{
													$dateday2gallery = 31 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimggallery == 4)
												{
													$dateday2gallery = 30 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 30)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimggallery == 5)
												{
													$dateday2gallery = 31 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimggallery == 6)
												{
													$dateday2gallery = 30 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 30)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimggallery == 7)
												{
													$dateday2gallery = 31 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimggallery == 8)
												{
													$dateday2gallery = 31 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimggallery == 9)
												{
													$dateday2gallery = 30 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 30)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimggallery == 10)
												{
													$dateday2gallery = 31 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimggallery == 11)
												{
													$dateday2gallery = 30 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 30)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
												else if($datemoisimggallery == 12)
												{
													$dateday2gallery = 31 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
													<?php
													}
													else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
											}
											else if($dateangallery == 0 AND $datemoisgallery == 0 AND $datedaygallery == 0 AND $datemingallery == 1)
											{
												if($dateheuregallery == 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
												<?php
												}
												else if($dateheuregallery == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
												<?php
												}
											}
											else if($dateangallery == 0 AND $datemoisgallery == 0 AND $datedaygallery == 0 AND $dateheuregallery == 0)
											{
												if($datemingallery >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemingallery; ?> minutes</span>
												<?php
												}
											}
											else if($dateangallery == 0 AND $datemoisgallery == 0 AND $datedaygallery == 0 AND $dateheuregallery == 1 AND $datemingallery < 0 )
											{
												$datemin2gallery = 60 + $datemingallery;
											?>
												<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
											<?php
											}
											else if($dateangallery == 0 AND $datemoisgallery == 0 AND $datedaygallery == 0 AND $dateheuregallery == 1 AND $datemingallery >= 0 )
											{
												$datemin2gallery = 60 + $datemingallery;
											?>
												<span class="articletemps">Il y a <?php echo $dateheuregallery; ?> heure</span>
											<?php
											}
											else if($dateheuregallery >= 2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateheuregallery; ?> heures</span>
											<?php
											}
										?>
										<br />
										<div class="divcontenueimagegallery"><a href="gallery.php?image=<?php echo $infogalleryimg['ID']; ?>"><img src="gallery/<?php echo $infogalleryimg['image']; ?>" alt="Image" class="contenueimagegallery" /></a></div>
										<br />
										<div class="articleblockaime2">
										<?php 
											$searchnoteexistgallery = $db->query('SELECT * FROM notesgallery WHERE IDgallery=\'' . $infogalleryimg['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
											$noteexistgallery = $searchnoteexistgallery->rowCount();
											if($noteexistgallery == 1)
											{
											?>
												<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimegallerypas<?php echo $infogalleryimg['ID']; ?>" onclick="articleimgaimegallerypas<?php echo $infogalleryimg['ID']; ?>()" />
												
												<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaimegallery<?php echo $infogalleryimg['ID']; ?>" onclick="articleimgaimegallery<?php echo $infogalleryimg['ID']; ?>()" style="opacity:0.65;display:none;" />
											<?php
											}
											else
											{
											?>
												<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaimegallery<?php echo $infogalleryimg['ID']; ?>" onclick="articleimgaimegallery<?php echo $infogalleryimg['ID']; ?>()" style="opacity:0.65;" />
											
												<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimegallerypas<?php echo $infogalleryimg['ID']; ?>" onclick="articleimgaimegallerypas<?php echo $infogalleryimg['ID']; ?>()" style="display:none;" />
											<?php
											}
										?>
										<span class="articlenbaime" id="articlenbaimegallery<?php echo $infogalleryimg['ID']; ?>"><?php echo htmlspecialchars($infogalleryimg['note']); ?></span>
										</div>
									</div>
									<?php
									}
									$selectinfogalleryimg->closeCursor();
									?>
									</div>
									<script>
										
										document.querySelector("#actufiltrespan1").onclick = function() 
										{ 
											if (window.getComputedStyle(document.querySelector('#actufiltrecontenue1')).display=='none')
											{
												document.getElementById("actufiltrecontenue2").style.display="none";
												document.getElementById("actufiltrespan2").style.color="white";
												document.getElementById("actufiltrespan2").style.cursor="pointer";
												document.getElementById("actufiltrespan1").style.color="rgb(40,40,40)";
												document.getElementById("actufiltrespan1").style.cursor="default";
												document.getElementById("actufiltrecontenue1").style.display="block";
											}
											else
											{
												document.getElementById("actufiltrecontenue2").style.display="none";
												document.getElementById("actufiltrespan2").style.color="white";
												document.getElementById("actufiltrespan2").style.cursor="pointer";
												document.getElementById("actufiltrespan1").style.color="rgb(40,40,40)";
												document.getElementById("actufiltrespan1").style.cursor="default";
												document.getElementById("actufiltrecontenue1").style.display="block";
											}
										}
										
										document.querySelector("#actufiltrespan2").onclick = function() 
										{ 
											if (window.getComputedStyle(document.querySelector('#actufiltrecontenue2')).display=='none')
											{
												document.getElementById("actufiltrecontenue1").style.display="none";
												document.getElementById("actufiltrespan1").style.color="white";
												document.getElementById("actufiltrespan1").style.cursor="pointer";
												document.getElementById("actufiltrespan2").style.color="rgb(40,40,40)";
												document.getElementById("actufiltrespan2").style.cursor="default";
												document.getElementById("actufiltrecontenue2").style.display="block";
											}
											else
											{
												document.getElementById("actufiltrecontenue1").style.display="none";
												document.getElementById("actufiltrespan1").style.color="white";
												document.getElementById("actufiltrespan1").style.cursor="pointer";
												document.getElementById("actufiltrespan2").style.color="rgb(40,40,40)";
												document.getElementById("actufiltrespan2").style.cursor="default";
												document.getElementById("actufiltrecontenue2").style.display="block";
											}
										}
										
									<?php
									$selectinfogalleryimgjs = $db->query('SELECT * FROM gallery WHERE IDmembre=\'' . $infomembre['ID'] . '\' ORDER BY date DESC');
									while($infogalleryimgjs = $selectinfogalleryimgjs->fetch())
									{
									?>
										
										function articleimgaimegallery<?php echo $infogalleryimgjs['ID']; ?>()
										{
											var xhr = new XMLHttpRequest();
											
											xhr.open('GET', 'site/phppageprofil.php?articlegallerynoteaime=<?php echo $infogalleryimgjs['ID']; ?>');
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.getElementById('articleimgaimegallery<?php echo $infogalleryimgjs['ID'];?>').style.display="none";
													document.getElementById('articleimgaimegallerypas<?php echo $infogalleryimgjs['ID'];?>').style.display="inline-block";
													document.getElementById('articlenbaimegallery<?php echo $infogalleryimgjs['ID'];?>').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
										
										function articleimgaimegallerypas<?php echo $infogalleryimgjs['ID']; ?>()
										{
											var xhr = new XMLHttpRequest();
											
											xhr.open('GET', 'site/phppageprofil.php?articlegallerynoteaimepas=<?php echo $infogalleryimgjs['ID']; ?>');
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.getElementById('articleimgaimegallerypas<?php echo $infogalleryimgjs['ID'];?>').style.display="none";
													document.getElementById('articleimgaimegallery<?php echo $infogalleryimgjs['ID'];?>').style.display="inline-block";
													document.getElementById('articlenbaimegallery<?php echo $infogalleryimgjs['ID'];?>').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
										
									<?php
									}
									$selectinfogalleryimgjs->closeCursor();
									?>
									</script>
								</div>
								
								<?php
									
									$selectinfobio = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $infomembre['ID'] . '\'');
									$infobio = $selectinfobio->fetch();
									
									if(mb_strlen($infomembre['pseudo'], 'utf8') <= 17)
									{
										$pseudojournalinfo[0] = $infomembre['pseudo'];
									}
									else
									{
										$pseudojournal = mb_substr($infomembre['pseudo'], 0, 14, 'utf8');
										
										$pseudojournalinfo[0] = $pseudojournal . "..."; 
									}
								?>
								<div class="divabonnementbackground" style="margin-left:-200%;" id="divjournalinfobackground">
								</div>
								<div id="divjournalinfo">
									<div class="infodivmembre">
										<img src="membre/avatar/<?php echo $infomembre['avatar']; ?>" alt="Avatar" style="width:45px;height:45px;margin-top:12px;" class="articleavatar"/>
									<?php
										if(mb_strlen($infomembre['pseudo'], 'utf8') <= 17)
										{
										?>
											<span style="font-size:27px;top:-10px;margin-left:6px;" class="articlepseudo"><?php echo $pseudojournalinfo[0]; ?></span><br />
										<?php
										}
										else
										{
										?>
											<span style="font-size:27px;top:-10px;margin-left:6px;" class="articlepseudo" title="<?php echo $infomembre['pseudo']; ?>"><?php echo $pseudojournalinfo[0]; ?></span><br />
										<?php
										}
									?>
									</div>
									<div class="infodivbio">
									<?php
										if(isset($infobio['bio']) AND $infobio['bio'] != 'NULL' AND $infobio['bio'] != '')
										{
										?>
											<span class="infodivmembre1" style="cursor:default;"><?php echo htmlspecialchars($infobio['bio']); ?></span>
										<?php
										}
										else
										{
										?>
											<p class="infodivmembre1nobiovisiteur" >Aucune bio</p>
										<?php
										}
									?>
									</div>
									<div class="infodivmembre2">
										<span class="infodivmembre2lien">
										<?php
											if(isset($infobio['instagram']) AND $infobio['instagram'] != 'NULL' AND $infobio['instagram'] != '')
											{
											?>
												<div id="infodivmembre2lienxhrupdateinstagram" style="display:inline-block;">
													<a href="<?php echo $infobio['instagram']; ?>" id="infodivmembre2lienxhrupdateinstagramurl" target="_blank"><img src="images/logoinsta.png" alt="Instagram" title="Instagram" class="infodivmembre2img"/></a>
												</div>
											<?php
											}
											
											if(isset($infobio['twitter']) AND $infobio['twitter'] != 'NULL' AND $infobio['twitter'] != '')
											{
											?>
												<div id="infodivmembre2lienxhrupdatetwitter" style="display:inline-block;">
													<a href="<?php echo $infobio['twitter']; ?>" id="infodivmembre2lienxhrupdatetwitterurl" target="_blank"><img src="images/logotwitter.png" alt="Twitter" title="Twitter" class="infodivmembre2img"/></a>
												</div>
											<?php
											}
											
											if(isset($infobio['youtube']) AND $infobio['youtube'] != 'NULL' AND $infobio['youtube'] != '')
											{
											?>
												<div id="infodivmembre2lienxhrupdateyoutube" style="display:inline-block;">
													<a href="<?php echo $infobio['youtube']; ?>" id="infodivmembre2lienxhrupdateyoutubeurl" target="_blank"><img src="images/logoyoutube.png" alt="Youtube" title="Youtube" class="infodivmembre2img"/></a>
												</div>
											<?php
											}
											
											if(isset($infobio['snapchat']) AND $infobio['snapchat'] != 'NULL' AND $infobio['snapchat'] != '')
											{
											?>
												<div id="infodivmembre2lienxhrupdatesnapchat" style="display:inline-block;">
													<a href="<?php echo $infobio['snapchat']; ?>" id="infodivmembre2lienxhrupdatesnapchaturl" target="_blank"><img src="images/logosnap.png" alt="Snapchat" title="Snapchat" class="infodivmembre2img"/></a>
												</div>
											<?php
											}
											
											if(isset($infobio['twitch']) AND $infobio['twitch'] != 'NULL' AND $infobio['twitch'] != '')
											{
											?>
												<div id="infodivmembre2lienxhrupdatetwitch" style="display:inline-block;">
													<a href="<?php echo $infobio['twitch']; ?>" id="infodivmembre2lienxhrupdatetwitchurl" target="_blank"><img src="images/logotwitch.png" alt="Twitch" title="Twitch" class="infodivmembre2img"/></a>
												</div>
											<?php
											}
											
											if(isset($infobio['facebook']) AND $infobio['facebook'] != 'NULL' AND $infobio['facebook'] != '')
											{
											?>
												<div id="infodivmembre2lienxhrupdatefacebook" style="display:inline-block;">
													<a href="<?php echo $infobio['facebook']; ?>" id="infodivmembre2lienxhrupdatefacebookurl" target="_blank"><img src="images/logofb.png" alt="Facebook" title="Facebook" class="infodivmembre2img"/></a>
												</div>
											<?php
											}
										?>
										</span>
										<span style="margin-right:10px;"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script>
					document.querySelector("#journalmenumembre").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blockjournalmenumembre')).display=='none')
						{
							document.querySelector("#blockjournalmenumembre").style.display="block";
							document.querySelector("#journalmenumembre").style.cursor="default";
							document.querySelector("#blockimagesmenumembre").style.display="none";
							document.querySelector("#imagesmenumembre").style.cursor="pointer";
							document.querySelector("#blockinformationsmenumembre").style.display="none";
							document.querySelector("#informationsmenumembre").style.cursor="pointer";
						}
						else
						{
							document.querySelector("#blockjournalmenumembre").style.display="block";
							document.querySelector("#journalmenumembre").style.cursor="default";
							document.querySelector("#blockimagesmenumembre").style.display="none";
							document.querySelector("#imagesmenumembre").style.cursor="pointer";
							document.querySelector("#blockinformationsmenumembre").style.display="none";
							document.querySelector("#informationsmenumembre").style.cursor="pointer";
						}
					}
					
					document.querySelector("#imagesmenumembre").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blockimagesmenumembre')).display=='none')
						{
							document.querySelector("#blockjournalmenumembre").style.display="none";
							document.querySelector("#journalmenumembre").style.cursor="pointer";
							document.querySelector("#blockimagesmenumembre").style.display="block";
							document.querySelector("#imagesmenumembre").style.cursor="default";
							document.querySelector("#blockinformationsmenumembre").style.display="none";
							document.querySelector("#informationsmenumembre").style.cursor="pointer";
						}
						else
						{
							document.querySelector("#blockjournalmenumembre").style.display="none";
							document.querySelector("#journalmenumembre").style.cursor="pointer";
							document.querySelector("#blockimagesmenumembre").style.display="block";
							document.querySelector("#imagesmenumembre").style.cursor="default";
							document.querySelector("#blockinformationsmenumembre").style.display="none";
							document.querySelector("#informationsmenumembre").style.cursor="pointer";
						}
					}
					
					document.querySelector("#informationsmenumembre").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blockinformationsmenumembre')).display=='none')
						{
							document.querySelector("#blockjournalmenumembre").style.display="none";
							document.querySelector("#journalmenumembre").style.cursor="pointer";
							document.querySelector("#blockimagesmenumembre").style.display="none";
							document.querySelector("#imagesmenumembre").style.cursor="pointer";
							document.querySelector("#blockinformationsmenumembre").style.display="block";
							document.querySelector("#informationsmenumembre").style.cursor="default";
						}
						else
						{
							document.querySelector("#blockjournalmenumembre").style.display="none";
							document.querySelector("#journalmenumembre").style.cursor="pointer";
							document.querySelector("#blockimagesmenumembre").style.display="none";
							document.querySelector("#imagesmenumembre").style.cursor="pointer";
							document.querySelector("#blockinformationsmenumembre").style.display="block";
							document.querySelector("#informationsmenumembre").style.cursor="default";
						}
					}
				</script>
				<?php
				}
				else
				{
				?>
					<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
					<script>
						window.setTimeout("location=('profil.php');",0);
					</script>
				<?php
				}
			}
			else
			{
		?>
			<section id="contenu">
				<div id="espacemembre">
					<div class="navigation">
						<span id="pseudonavigation"><?php echo htmlspecialchars($_SESSION['pseudo']); ?></span>
						<div class="actualiteabonnementnavigation">
							<span><img src="images/actualitemembre.png" alt="Actualité" id="actualitenavigation" /></span>
							<span><img src="images/abonnement.png" alt="Abonnement" id="abonnementnavigation" /></span>
						</div>
						<?php
						if($_SESSION['ID'] == '1')
						{
						?>
							<span><a href="admin/administration.php"><img src="images/administration.png" alt="Administration" id="administrationnavigation" /></a></span>
						<?php
						}
						?>
						<span><img src="images/notification.png" alt="Notification" id="notificationnavigation" /></span>
						<span><img src="images/parametre.png" alt="Paramètre" id="parametrenavigation" /></span>
						<span><img src="images/deconnexion.png" alt="Déconnexion" id="deconnexionnavigation" /></span>
					</div>
						<div id="blockprofil">
							<div class="plandefondprofil"><img src="membre/plandefond/<?php echo $_SESSION['plandefond']; ?>" alt="Plan de fond" class="plandefondprofilimg" /></div>
							<div style="background:rgb(32,32,32);position:relative;z-index:1;">
							<span><img src="membre/avatar/<?php echo $_SESSION['avatar']; ?>" alt="Avatar" class="avatarprofil" /></span>
						<?php
							$selectnbabonnermembre = $db->query('SELECT COUNT(*) AS nbabonnermembre FROM abonnermembre WHERE IDpagemembre=\'' . $_SESSION['ID'] .  '\'');
							$nbabonnermembre = $selectnbabonnermembre->fetch();
							
							$selectnbabonnementmembre = $db->query('SELECT COUNT(*) AS selectnbabonnementmembre FROM abonnermembre WHERE IDmembre=\'' . $_SESSION['ID'] .  '\'');
							$nbabonnementmembre = $selectnbabonnementmembre->fetch();
						?>
							<div class="menuprofil">
								<div id="divabonnemenu">
									<span class="divabonnemenunb"><?php echo $nbabonnermembre['nbabonnermembre']; ?></span>
									<span class="divabonnemenutitre">Abonnés</span>
								</div>
								<div id="divabonnementmenu">
									<span class="divabonnementmenunb" id="divabonnementmenunb"><?php echo $nbabonnementmembre['selectnbabonnementmembre']; ?></span>
									<span class="divabonnementmenutitre">Abonnements</span>
								</div>
								<div id="divsuivremenu" style="color: rgb(37,37,37);cursor:default;">
									<span class="divsuivremenutitre">Suivre</span>
								</div>
								<div id="divautremenu" style="color: rgb(37,37,37);cursor:default;">
									<span class="divautremenupoint1">.</span>
									<span class="divautremenupoint2">.</span>
									<span class="divautremenupoint3">.</span>
								</div>
							</div>
							<div class="divabonnementbackground" id="divabonnerbackground">
							</div>
							<div class="divabonnement" id="divabonner">
								<div class="divabonnementdivtitre">
									<span class="divabonnementtitre">Abonnés</span>
									<span><img src="images/supprimerrecherche2.png" alt="Close" class="divabonnementimgclose" id="divabonnerimgclose" /></span>
								</div>
								<div id="blockprofilmembrecontenu" class="blockprofilmembrecontenu3">
								<?php
									$selectIDmembreabonner = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $_SESSION['ID'] . '\'');
									while($IDmembreabonner = $selectIDmembreabonner->fetch())
									{
										$selectmembreprofilabonner = $db->query('SELECT * FROM membres WHERE ID=\'' . $IDmembreabonner['IDmembre'] . '\'');
										$membreprofilabonner = $selectmembreprofilabonner->fetch();
										
										$membreprofilabonnervb = html_entity_decode($membreprofilabonner['pseudo']);
										
										if(mb_strlen($membreprofilabonnervb, 'utf8') <= 20)
										{
											$titremembreprofilabonnerarray[0] = $membreprofilabonnervb;
										}
										else
										{
											$titremembreprofilabonner = mb_substr($membreprofilabonnervb, 0, 17, 'utf8');
											
											$titremembreprofilabonnerarray[0] = $titremembreprofilabonner . "..."; 
										}
								?>
									<div class="animecontenu" id="membre2profilcontenu<?php echo $membreprofilabonner['ID'];?>">
										<a href="profil.php?id=<?php echo $membreprofilabonner['ID'];?>"><div class="animecontenudivimg" style="background: url(membre/avatar/<?php echo $membreprofilabonner['avatar']; ?>)no-repeat;background-size: cover;">
										</div></a>
										<?php
											if(mb_strlen($membreprofilabonnervb, 'utf8') <= 20)
											{
											?>
												<a href="profil.php?id=<?php echo $membreprofilabonner['ID'];?>"><span class="animecontenutitre"><?php echo htmlspecialchars($titremembreprofilabonnerarray[0]); ?></span></a><br />
											<?php
											}
											else
											{
											?>
												<a href="profil.php?id=<?php echo $membreprofilabonner['ID'];?>"><span class="animecontenutitre" title="<?php echo htmlspecialchars($membreprofilabonner['pseudo']); ?>"><?php echo htmlspecialchars($titremembreprofilabonnerarray[0]); ?></span></a><br />
											<?php
											}
										?>
										<span class="animecontenunbabonne" id="membreprofilcontenunbabonner<?php echo $membreprofilabonner['ID']; ?>"><?php echo $membreprofilabonner['nbabonner']; ?></span><br />
										<?php
											$searchabonnementmembreprofil = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $membreprofilabonner['ID'] .  '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
											$abonnementmembreprofil = $searchabonnementmembreprofil->rowCount();
											if($abonnementmembreprofil == 0)
											{
											?>
												<span onclick="membre2profilcontenusuivreimg<?php echo $membreprofilabonner['ID']; ?>()"><img src="images/ajouteranime.png" alt="Suivre" class="animecontenusuivreimg" style="left:320px" id="membre2profilcontenusuivreimg<?php echo $membreprofilabonner['ID']; ?>" /></span>
												
												<img src="images/validerajouteranime.png" alt="Abonner" class="animecontenusuivreimg" id="suivreimgdisplaymembreprofil<?php echo $membreprofilabonner['ID']; ?>" style="display:none;left:320px" />
											<?php
											}
											else
											{
											?>
												<img src="images/validerajouteranime.png" alt="Abonner" class="animecontenusuivreimg" style="left:320px" />
											<?php
											}
										?>
									</div>
								<?php
									}
									$selectIDmembreabonner->closeCursor();
								?>
									<script>
								<?php
									$selectIDmembreabonnerjs = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $_SESSION['ID'] . '\'');
									while($IDmembreabonnerjs = $selectIDmembreabonnerjs->fetch())
									{
										$selectmembreprofilabonnerjs = $db->query('SELECT * FROM membres WHERE ID=\'' . $IDmembreabonnerjs['IDmembre'] . '\'');
										$membreprofilabonnerjs = $selectmembreprofilabonnerjs->fetch();
									?>
										function membre2profilcontenusuivreimg<?php echo $membreprofilabonnerjs['ID']; ?>()
										{
											var xhr = new XMLHttpRequest();
										
											xhr.open('GET', 'site/phppageprofil.php?suivremembre=<?php echo $membreprofilabonnerjs['ID']; ?>');
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.getElementById('membre2profilcontenusuivreimg<?php echo $membreprofilabonnerjs['ID'];?>').style.display="none";
													document.getElementById('suivreimgdisplaymembreprofil<?php echo $membreprofilabonnerjs['ID'];?>').style.display="inline-block";
													document.getElementById('membreprofilcontenunbabonner<?php echo $membreprofilabonnerjs['ID'];?>').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
									<?php
									}
									$selectIDmembreabonnerjs->closeCursor();
								?>
									</script>
								</div>
							</div>
							<div class="divabonnementbackground" id="divabonnementbackground">
							</div>
							<div class="divabonnement" id="divabonnement">
								<div class="divabonnementdivtitre">
									<span class="divabonnementtitre">Abonnements</span>
									<span><img src="images/supprimerrecherche2.png" alt="Close" class="divabonnementimgclose" id="divabonnementimgclose" /></span>
								</div>
								<div id="blockprofilmembrecontenu" class="blockprofilmembrecontenu4">
								<?php
									$selectmembreprofilabonnement = $db->query('SELECT * FROM membres ORDER BY nbabonner DESC');
									while($membreprofilabonnement = $selectmembreprofilabonnement->fetch())
									{
									$searchabonnementexistmembreprofil = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $membreprofilabonnement['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
									$abonnementexistmembreprofil = $searchabonnementexistmembreprofil->rowCount();
									if($abonnementexistmembreprofil == 1)
									{
										
										$membreprofilabonnementvb = html_entity_decode($membreprofilabonnement['pseudo']);
										
										if(mb_strlen($membreprofilabonnementvb, 'utf8') <= 20)
										{
											$titremembreprofilabonnementarray[0] = $membreprofilabonnementvb;
										}
										else
										{
											$titremembreprofilabonnement = mb_substr($membreprofilabonnementvb, 0, 17, 'utf8');
											
											$titremembreprofilabonnementarray[0] = $titremembreprofilabonnement . "..."; 
										}
								?>
									<div class="animecontenu" id="membreprofilcontenu<?php echo $membreprofilabonnement['ID'];?>">
										<a href="profil.php?id=<?php echo $membreprofilabonnement['ID'];?>"><div class="animecontenudivimg" style="background: url(membre/avatar/<?php echo $membreprofilabonnement['avatar']; ?>)no-repeat;background-size: cover;">
										</div></a>
										<?php
											if(mb_strlen($membreprofilabonnementvb, 'utf8') <= 20)
											{
											?>
												<a href="profil.php?id=<?php echo $membreprofilabonnement['ID'];?>"><span class="animecontenutitre"><?php echo htmlspecialchars($titremembreprofilabonnementarray[0]); ?></span></a><br />
											<?php
											}
											else
											{
											?>
												<a href="profil.php?id=<?php echo $membreprofilabonnement['ID'];?>"><span class="animecontenutitre" title="<?php echo htmlspecialchars($membreprofilabonnement['pseudo']); ?>"><?php echo htmlspecialchars($titremembreprofilabonnementarray[0]); ?></span></a><br />
											<?php
											}
										?>
										<span class="animecontenunbabonne" id="membreprofilcontenunbabonnement<?php echo $membreprofilabonnement['ID']; ?>"><?php echo $membreprofilabonnement['nbabonner']; ?></span><br />
										
										<span onclick="membreprofilcontenustopsuivreimg<?php echo $membreprofilabonnement['ID']; ?>()"><img src="images/stopsuivre.png" alt="Ne plus suivre" class="animecontenusuivreimg" style="left:320px" id="membreprofilcontenustopsuivreimg<?php echo $membreprofilabonnement['ID']; ?>" /></span>
									</div>
								<?php
									}
									}
									$selectmembreprofilabonnement->closeCursor();
								?>
									<script>
								<?php
									$selectmembreprofilabonnementjs = $db->query('SELECT * FROM membres ORDER BY nbabonner DESC');
									while($membreprofilabonnementjs = $selectmembreprofilabonnementjs->fetch())
									{
									$membreprofilsearchabonnementexistjs = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $membreprofilabonnementjs['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\' ');
									$membreprofilabonnementexistjs = $membreprofilsearchabonnementexistjs->rowCount();
									if($membreprofilabonnementexistjs == 1)
									{
									?>
										function membreprofilcontenustopsuivreimg<?php echo $membreprofilabonnementjs['ID']; ?>()
										{
											var xhr = new XMLHttpRequest();
										
											xhr.open('GET', 'site/phppageprofil.php?stopsuivremembre=<?php echo $membreprofilabonnementjs['ID']; ?>');
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.getElementById('membreprofilcontenu<?php echo $membreprofilabonnementjs['ID'];?>').style.transition="all 0.4s";
													document.getElementById('membreprofilcontenu<?php echo $membreprofilabonnementjs['ID'];?>').style.opacity="1";
													setTimeout(function(){document.getElementById("membreprofilcontenu<?php echo $membreprofilabonnementjs['ID'];?>").style.display="none";},200 )
													setTimeout(function(){document.getElementById("membreprofilcontenu<?php echo $membreprofilabonnementjs['ID'];?>").style.opacity="0";},100 )
													document.getElementById("divabonnementmenunb").innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
									<?php
									}
									}
									$selectmembreprofilabonnementjs->closeCursor();
								?>
									</script>
								</div>
							</div>
								<div id="blockjournalmenu">
									<div id="divjournalsuggestion">
										<div class="divsuggestion">
										<img src="images/bulb.png" alt="Bulb" class="imgsuggestion1"/>
											<span class="spansuggestion">Suggestions</span>
											<img src="images/bulb.png" alt="Bulb" class="imgsuggestion2"/>
										</div>
										<div class="divsuggestionmembre">
										<?php
										$selectmembreprofilsuggestion = $db->query('SELECT * FROM membres ORDER BY nbabonner DESC');
										while($membreprofilsuggestion = $selectmembreprofilsuggestion->fetch())
										{
										$membreprofilsearchsuggestionexist = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $membreprofilsuggestion['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\' ');
										$membreprofilsuggestionexist = $membreprofilsearchsuggestionexist->rowCount();
										if($membreprofilsuggestionexist >= 1)
										{
											$membreprofilsuggestionfetch = $membreprofilsearchsuggestionexist->fetch();
										
											$searchmembresuggestion = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre!=\'' . $_SESSION['ID'] . '\' AND IDmembre=\'' . $membreprofilsuggestionfetch['IDpagemembre'] . '\'');
											$infomembresuggestionexist = $searchmembresuggestion->rowCount();
											$infomembresuggestionID = $searchmembresuggestion->fetch();
											$selectmembreprofilinfo = $db->query('SELECT * FROM membres WHERE ID =\'' . $infomembresuggestionID['IDpagemembre'] . '\'');
											$infomembresuggestion = $selectmembreprofilinfo->fetch();
											$searchmembresuggestionexit = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $infomembresuggestionID['IDpagemembre'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
											$infomembresuggestionexist2 = $searchmembresuggestionexit->rowCount();
											if($infomembresuggestionexist >= 1 AND $infomembresuggestionexist2 == 0)
											{
												
												$infomembresuggestionvb = html_entity_decode($infomembresuggestion['pseudo']);
												
												if(mb_strlen($infomembresuggestionvb, 'utf8') <= 15)
												{
													$titremembresuggestion[0] = $infomembresuggestionvb;
												}
												else
												{
													$titremembresugg = mb_substr($infomembresuggestionvb, 0, 12, 'utf8');
													
													$titremembresuggestion[0] = $titremembresugg . "..."; 
												}
										?>
											<div class="animecontenu">
												<a href="profil.php?id=<?php echo $infomembresuggestion['ID'];?>"><div class="animecontenudivimg" style="background: url(membre/avatar/<?php echo $infomembresuggestion['avatar']; ?>)no-repeat;background-size: cover;">
												</div></a>
												<?php
													if(mb_strlen($infomembresuggestionvb, 'utf8') <= 17)
													{
													?>
														<a href="profil.php?id=<?php echo $infomembresuggestion['ID'];?>"><span class="animecontenutitre"><?php echo htmlspecialchars($titremembresuggestion[0]); ?></span></a><br />
													<?php
													}
													else
													{
													?>
														<a href="profil.php?id=<?php echo $infomembresuggestion['ID'];?>"><span class="animecontenutitre" title="<?php echo htmlspecialchars($infomembresuggestion['pseudo']); ?>"><?php echo htmlspecialchars($titremembresuggestion[0]); ?></span></a><br />
													<?php
													}
												?>
												<span class="animecontenunbabonne" id="animecontenunbabonne<?php echo $infomembresuggestion['ID']; ?>"><?php echo $infomembresuggestion['nbabonner']; ?></span><br />
												
												<span onclick="membrecontenusuivreimgsuggestion<?php echo $infomembresuggestion['ID']; ?>()"><img src="images/ajouteranime.png" alt="Suivre" class="animecontenusuivreimg" id="membrecontenusuivreimgsuggestion<?php echo $infomembresuggestion['ID']; ?>" style="left:255px;" /></span>
		
												<img src="images/validerajouteranime.png" alt="Suivre" class="animecontenusuivreimg" id="suivreimgdisplaymembresuggestion<?php echo $infomembresuggestion['ID']; ?>" style="display:none;left:255px;" />
		
												
											</div>
											
											<style>
											
												#divjournalsuggestion
												{
													opacity: 1;
												}
												
												.divsuggestionmembre
												{
													padding-bottom: 5px;
												}
												
											</style>
										<?php
											}
										}
										}
										$selectmembreprofilsuggestion->closeCursor();
										?>
										<script>
										<?php
											$selectmembreprofilsuggestionjs = $db->query('SELECT * FROM membres ORDER BY nbabonner DESC');
											while($membreprofilsuggestionjs = $selectmembreprofilsuggestionjs->fetch())
											{
											?>
												function membrecontenusuivreimgsuggestion<?php echo $membreprofilsuggestionjs['ID']; ?>()
												{
													var xhr = new XMLHttpRequest();
												
													xhr.open('GET', 'site/phpparametreactualite.php?suivremembre=<?php echo $membreprofilsuggestionjs['ID']; ?>');
													
													xhr.onreadystatechange = function()
													{
														if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
														{
															document.getElementById('membrecontenusuivreimgsuggestion<?php echo $membreprofilsuggestionjs['ID'];?>').style.display="none";
															document.getElementById('suivreimgdisplaymembresuggestion<?php echo $membreprofilsuggestionjs['ID'];?>').style.display="inline-block";
															document.getElementById('animecontenunbabonne<?php echo $membreprofilsuggestionjs['ID'];?>').innerHTML = xhr.responseText;
														}
													};
													
													xhr.send(null);
												}
											<?php
											}
											$selectmembreprofilsuggestionjs->closeCursor();
										?>
									</script>
										</div>
									</div>
									<script>
									
										document.querySelector("#divabonnemenu").onclick = function() 
										{ 
											if (window.getComputedStyle(document.querySelector('#divabonnerbackground')).display=='none')
											{
												document.getElementById("divabonnemenu").style.color="rgb(37,37,37)";
												setTimeout(function(){document.getElementById("divabonnerbackground").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divabonnerbackground").style.opacity="0.35";},200 )
												setTimeout(function(){document.getElementById("divabonner").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divabonner").style.opacity="1";},200 )
											}
											else
											{
												document.getElementById("divabonnemenu").style.color="rgb(37,37,37)";
												setTimeout(function(){document.getElementById("divabonnerbackground").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divabonnerbackground").style.opacity="0.35";},200 )
												setTimeout(function(){document.getElementById("divabonner").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divabonner").style.opacity="1";},200 )
											}
										}
										
										document.querySelector("#divabonnerbackground").onclick = function() 
										{ 
											if (window.getComputedStyle(document.querySelector('#divabonnerbackground')).display=='block')
											{
												setTimeout(function(){document.getElementById("divabonnerbackground").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonnerbackground").style.opacity="0";}, 100 )
												setTimeout(function(){document.getElementById("divabonner").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonner").style.opacity="0";},100 )
												document.getElementById("divabonnemenu").style.color="white";
											}
											else
											{
												setTimeout(function(){document.getElementById("divabonnerbackground").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonnerbackground").style.opacity="0";}, 100 )
												setTimeout(function(){document.getElementById("divabonner").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonner").style.opacity="0";},100 )
												document.getElementById("divabonnemenu").style.color="white";
											}
										}
										
										document.querySelector("#divabonnerimgclose").onclick = function() 
										{ 
											if (window.getComputedStyle(document.querySelector('#divabonnerbackground')).display=='block')
											{
												setTimeout(function(){document.getElementById("divabonnerbackground").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonnerbackground").style.opacity="0";}, 100 )
												setTimeout(function(){document.getElementById("divabonner").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonner").style.opacity="0";},100 )
												document.getElementById("divabonnemenu").style.color="white";
											}
											else
											{
												setTimeout(function(){document.getElementById("divabonnerbackground").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonnerbackground").style.opacity="0";}, 100 )
												setTimeout(function(){document.getElementById("divabonner").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonner").style.opacity="0";},100 )
												document.getElementById("divabonnemenu").style.color="white";
											}
										}
										
										document.querySelector("#divabonnementmenu").onclick = function() 
										{ 
											if (window.getComputedStyle(document.querySelector('#divabonnementbackground')).display=='none')
											{
												document.getElementById("divabonnementmenu").style.color="rgb(37,37,37)";
												setTimeout(function(){document.getElementById("divabonnementbackground").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divabonnementbackground").style.opacity="0.35";},200 )
												setTimeout(function(){document.getElementById("divabonnement").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divabonnement").style.opacity="1";},200 )
											}
											else
											{
												document.getElementById("divabonnementmenu").style.color="rgb(37,37,37)";
												setTimeout(function(){document.getElementById("divabonnementbackground").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divabonnementbackground").style.opacity="0.35";},200 )
												setTimeout(function(){document.getElementById("divabonnement").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divabonnement").style.opacity="1";},200 )
											}
										}
										
										document.querySelector("#divabonnementbackground").onclick = function() 
										{ 
											if (window.getComputedStyle(document.querySelector('#divabonnementbackground')).display=='block')
											{
												setTimeout(function(){document.getElementById("divabonnementbackground").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonnementbackground").style.opacity="0";}, 100 )
												setTimeout(function(){document.getElementById("divabonnement").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonnement").style.opacity="0";},100 )
												document.getElementById("divabonnementmenu").style.color="white";
											}
											else
											{
												setTimeout(function(){document.getElementById("divabonnementbackground").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonnementbackground").style.opacity="0";}, 100 )
												setTimeout(function(){document.getElementById("divabonnement").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonnement").style.opacity="0";},100 )
												document.getElementById("divabonnementmenu").style.color="white";
											}
										}
										
										document.querySelector("#divabonnementimgclose").onclick = function() 
										{ 
											if (window.getComputedStyle(document.querySelector('#divabonnementbackground')).display=='block')
											{
												setTimeout(function(){document.getElementById("divabonnementbackground").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonnementbackground").style.opacity="0";}, 100 )
												setTimeout(function(){document.getElementById("divabonnement").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonnement").style.opacity="0";},100 )
												document.getElementById("divabonnementmenu").style.color="white";
											}
											else
											{
												setTimeout(function(){document.getElementById("divabonnementbackground").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonnementbackground").style.opacity="0";}, 100 )
												setTimeout(function(){document.getElementById("divabonnement").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divabonnement").style.opacity="0";},100 )
												document.getElementById("divabonnementmenu").style.color="white";
											}
										}
										
									</script>
									<div id="divjournalactu">
										<div id="divjournalactufiltre">
											<span class="actufiltrespan" id="actufiltrespan1">Forum</span>
											<span class="actufiltrespan" id="actufiltrespan2">Gallery</span>
										</div>
										<div id="actufiltrecontenue1">
										<?php
										$selectcountforumsujets = $db->query('SELECT COUNT(*) AS countforumsujets FROM forumsujets WHERE IDmembres=\'' . $_SESSION['ID'] . '\'');
										$countforumsujets = $selectcountforumsujets->fetch();
										
										if($countforumsujets['countforumsujets'] == 0)
										{
										?>
											<p class="nopost">Aucune publication</p>
										<?php
										}
										
										$selectinfoforumsujets = $db->query('SELECT * FROM forumsujets WHERE IDmembres=\'' . $_SESSION['ID'] . '\' ORDER BY date_creation DESC');
										while($infoforumsujets = $selectinfoforumsujets->fetch())
										{
											$searchnbdecommentairesforumsujets = $db->query('SELECT COUNT(*) AS nbdecommentairesforumsujets FROM commentairesforum WHERE IDsujet =\'' . $infoforumsujets['ID'] . '\'');
											$nbdecommentairesforumsujets = $searchnbdecommentairesforumsujets->fetch();
											
											$infoforumsujetstitre = html_entity_decode($infoforumsujets['titre']);
							
											if(mb_strlen($infoforumsujetstitre, 'utf8') <= 15)
											{
												$arrayinfoforumsujets[0] = $infoforumsujetstitre;
											}
											else
											{
												$forumsujetstitre = mb_substr($infoforumsujetstitre, 0, 12, 'utf8');
												
												$arrayinfoforumsujets[0] = $forumsujetstitre . "..."; 
											}
										?>
										<div class="divabonnementbackground" style="margin-left:-200%;" id="divdeletebackground<?php echo $infoforumsujets['ID']; ?>">
										</div>
										<div class="divabonnementforum" id="divdeletearticle<?php echo $infoforumsujets['ID']; ?>">
											<fieldset class="barredeconnexion">
												<legend class="titredeconnexion">Confirmation</legend>
													<span>Êtes-vous sûr de vouloir supprimer cette publication ?</span>
												</fieldset>
											<fieldset class="barreoui">
												<legend class="barrelegend" onclick="ouidelete<?php echo $infoforumsujets['ID']; ?>()">Oui</legend>
											</fieldset>
											<fieldset class="barreannuler">
												<legend class="barrelegend" id="annulerdelete<?php echo $infoforumsujets['ID']; ?>">Annuler</legend>
											</fieldset>
										</div>
										<div class="blockfilactualitearticle" id="blockfilactualitearticleforum<?php echo $infoforumsujets['ID']; ?>">
											<a href="forum.php?update=<?php echo $infoforumsujets['ID']; ?>"><img src="images/edit.png" alt="modifier" class="deleteactualitearticle2" style="margin-right:26px;"></a>
											<img src="images/supprimerrecherche2.png" alt="supprimer" class="deleteactualitearticle2" id="deleteactualitearticleforum<?php echo $infoforumsujets['ID']; ?>">
											<img src="membre/avatar/<?php echo $_SESSION['avatar']; ?>" alt="Avatar" class="articleavatar"/>
											<span class="articlepseudo"><?php echo $_SESSION['pseudo']; ?></span><br />
											<?php
												$dateanimgforum = date("Y", strtotime($infoforumsujets['date_creation']));
												$datemoisimgforum = date("m", strtotime($infoforumsujets['date_creation']));
												$datedayimgforum = date("d", strtotime($infoforumsujets['date_creation']));
												$dateheureimgforum = date("H", strtotime($infoforumsujets['date_creation']));
												$dateminimgforum = date("i", strtotime($infoforumsujets['date_creation']));
												
												$dateannowforum = date('Y');
												$datemoisnowforum = date('m');
												$datedaynowforum = date('d');
												$dateheurenowforum = date('H');
												$dateminnowforum = date('i');
												
												$dateanforum =  $dateannowforum - $dateanimgforum;
												$datemoisforum = $datemoisnowforum - $datemoisimgforum;
												$datemois2forum = $datemoisimgforum - $datemoisnowforum;
												$datedayforum = $datedaynowforum - $datedayimgforum;
												$dateheureforum = $dateheurenowforum - $dateheureimgforum;
												$dateminforum = $dateminnowforum - $dateminimgforum;
												
												$datemois3forum = 12 - $datemois2forum;
												
												if($dateanforum == 1 AND $datemois3forum == 1 AND $datedayforum != 0)
												{
													$dateday2forum = 31 - $datedayimgforum;
													$dateday3forum = $dateday2forum + $datedaynowforum;
													if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
													<?php
													}
													else if($dateday3forum >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemois3forum; ?> mois</span>
													<?php
													}else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
													<?php
													}
												}
												else if($dateanforum == 0 AND $datemoisforum == 0 AND $datedayforum == 0 AND $dateheureforum == 0 AND $dateminforum == 0)
												{
													?>
														<span class="articletemps">À l'instant</span>
													<?php
												}
												else if($dateanforum == 1 AND $datemois2forum >= 2)
												{
													$datemois4forum = 12 - $datemois2forum;
													?>
														<span class="articletemps">Il y a <?php echo $datemois4forum; ?> mois</span>
													<?php
												}
												else if($dateanforum == 1 AND ($datemoisforum >= 1 OR $datemoisforum <= 1))
												{
													?>
														<span class="articletemps">Il y a <?php echo $dateanforum; ?> an</span>
													<?php
												}
												else if($dateanforum >= 2)
												{
													?>
														<span class="articletemps">Il y a <?php echo $dateanforum; ?> ans</span>
													<?php
												}
												else if($datemoisforum == 0 AND $dateanforum >= 1)
												{
													if($dateanforum == 1)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateanforum; ?> an</span>
													<?php
													}
													else if($dateanforum >= 1)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateanforum; ?> ans</span>
													<?php
													}
												}
												else if($dateanforum == 0 AND $datemoisforum >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
												<?php
												}
												else if($dateanforum == 0 AND $datemoisforum == 1 AND $datedayforum == 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
												<?php
												}
												else if($dateanforum == 0 AND $datemoisforum == 0 AND $datedayforum >= 1)
												{
													if($datedayforum >= 2)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datedayforum; ?> jours</span>
													<?php
													}
													else if($datedayforum == 1 AND $dateheureimgforum > $dateheurenowforum)
													{
														$dateheure2forum = 24 - $dateheureimgforum;
														$dateheure3forum = $dateheure2forum + $dateheurenowforum;
														if($dateheure3forum >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum < 0)
														{
															$datemin2forum = 60 + $dateminforum;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
														<?php
														}
														else if($dateheure3forum == 1 AND $dateminforum == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
														<?php
														}
													}
													else if($datedayforum == 1 AND $dateheureimgforum <= $dateheurenowforum)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datedayforum; ?> jour</span>
													<?php
													}
												}
												else if($dateanforum == 0 AND $datemoisforum == 1 AND $datedayforum != 0)
												{
													if($datemoisimgforum == 1)
													{
														$dateday2forum = 31 - $datedayimgforum;
														$dateday3forum = $dateday2forum + $datedaynowforum;
														if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
														{
															$dateheure2forum = 24 - $dateheureimgforum;
															$dateheure3forum = $dateheure2forum + $dateheurenowforum;
															if($dateheure3forum >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum < 0)
															{
																$datemin2forum = 60 + $dateminforum;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
															<?php
															}
														}
														else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
														<?php
														}
														else if($dateday3forum >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimgforum == 2)
													{
														$dateday2forum = 28 - $datedayimgforum;
														$dateday3forum = $dateday2forum + $datedaynowforum;
														if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
														{
															$dateheure2forum = 24 - $dateheureimgforum;
															$dateheure3forum = $dateheure2forum + $dateheurenowforum;
															if($dateheure3forum >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum < 0)
															{
																$datemin2forum = 60 + $dateminforum;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
															<?php
															}
														}
														else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
														<?php
														}
														else if($dateday3forum >= 28)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimgforum == 3)
													{
														$dateday2forum = 31 - $datedayimgforum;
														$dateday3forum = $dateday2forum + $datedaynowforum;
														if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
														{
															$dateheure2forum = 24 - $dateheureimgforum;
															$dateheure3forum = $dateheure2forum + $dateheurenowforum;
															if($dateheure3forum >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum < 0)
															{
																$datemin2forum = 60 + $dateminforum;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
															<?php
															}
														}
														else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
														<?php
														}
														else if($dateday3forum >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimgforum == 4)
													{
														$dateday2forum = 30 - $datedayimgforum;
														$dateday3forum = $dateday2forum + $datedaynowforum;
														if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
														{
															$dateheure2forum = 24 - $dateheureimgforum;
															$dateheure3forum = $dateheure2forum + $dateheurenowforum;
															if($dateheure3forum >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum < 0)
															{
																$datemin2forum = 60 + $dateminforum;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
															<?php
															}
														}
														else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
														<?php
														}
														else if($dateday3forum >= 30)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimgforum == 5)
													{
														$dateday2forum = 31 - $datedayimgforum;
														$dateday3forum = $dateday2forum + $datedaynowforum;
														if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
														{
															$dateheure2forum = 24 - $dateheureimgforum;
															$dateheure3forum = $dateheure2forum + $dateheurenowforum;
															if($dateheure3forum >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum < 0)
															{
																$datemin2forum = 60 + $dateminforum;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
															<?php
															}
														}
														else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
														<?php
														}
														else if($dateday3forum >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimgforum == 6)
													{
														$dateday2forum = 30 - $datedayimgforum;
														$dateday3forum = $dateday2forum + $datedaynowforum;
														if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
														{
															$dateheure2forum = 24 - $dateheureimgforum;
															$dateheure3forum = $dateheure2forum + $dateheurenowforum;
															if($dateheure3forum >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum < 0)
															{
																$datemin2forum = 60 + $dateminforum;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
															<?php
															}
														}
														else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
														<?php
														}
														else if($dateday3forum >= 30)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimgforum == 7)
													{
														$dateday2forum = 31 - $datedayimgforum;
														$dateday3forum = $dateday2forum + $datedaynowforum;
														if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
														{
															$dateheure2forum = 24 - $dateheureimgforum;
															$dateheure3forum = $dateheure2forum + $dateheurenowforum;
															if($dateheure3forum >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum < 0)
															{
																$datemin2forum = 60 + $dateminforum;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
															<?php
															}
														}
														else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
														<?php
														}
														else if($dateday3forum >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimgforum == 8)
													{
														$dateday2forum = 31 - $datedayimgforum;
														$dateday3forum = $dateday2forum + $datedaynowforum;
														if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
														{
															$dateheure2forum = 24 - $dateheureimgforum;
															$dateheure3forum = $dateheure2forum + $dateheurenowforum;
															if($dateheure3forum >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum < 0)
															{
																$datemin2forum = 60 + $dateminforum;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
															<?php
															}
														}
														else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
														<?php
														}
														else if($dateday3forum >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimgforum == 9)
													{
														$dateday2forum = 30 - $datedayimgforum;
														$dateday3forum = $dateday2forum + $datedaynowforum;
														if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
														{
															$dateheure2forum = 24 - $dateheureimgforum;
															$dateheure3forum = $dateheure2forum + $dateheurenowforum;
															if($dateheure3forum >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum < 0)
															{
																$datemin2forum = 60 + $dateminforum;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
															<?php
															}
														}
														else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
														<?php
														}
														else if($dateday3forum >= 30)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimgforum == 10)
													{
														$dateday2forum = 31 - $datedayimgforum;
														$dateday3forum = $dateday2forum + $datedaynowforum;
														if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
														{
															$dateheure2forum = 24 - $dateheureimgforum;
															$dateheure3forum = $dateheure2forum + $dateheurenowforum;
															if($dateheure3forum >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum < 0)
															{
																$datemin2forum = 60 + $dateminforum;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
															<?php
															}
														}
														else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
														<?php
														}
														else if($dateday3forum >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimgforum == 11)
													{
														$dateday2forum = 30 - $datedayimgforum;
														$dateday3forum = $dateday2forum + $datedaynowforum;
														if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
														{
															$dateheure2forum = 24 - $dateheureimgforum;
															$dateheure3forum = $dateheure2forum + $dateheurenowforum;
															if($dateheure3forum >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum < 0)
															{
																$datemin2forum = 60 + $dateminforum;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
															<?php
															}
														}
														else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
														<?php
														}
														else if($dateday3forum >= 30)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimgforum == 12)
													{
														$dateday2forum = 31 - $datedayimgforum;
														$dateday3forum = $dateday2forum + $datedaynowforum;
														if($dateday3forum == 1 AND $dateheureimgforum > $dateheurenowforum)
														{
															$dateheure2forum = 24 - $dateheureimgforum;
															$dateheure3forum = $dateheure2forum + $dateheurenowforum;
															if($dateheure3forum >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heures</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3forum; ?> heure</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum < 0)
															{
																$datemin2forum = 60 + $dateminforum;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
															<?php
															}
															else if($dateheure3forum == 1 AND $dateminforum == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
															<?php
															}
														}
														else if($dateday3forum == 1 AND $dateheureimgforum <= $dateheurenowforum)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jour</span>
														<?php
														}
														else if($dateday3forum >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisforum; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3forum; ?> jours</span>
														<?php
														}
													}
												}
												else if($dateanforum == 0 AND $datemoisforum == 0 AND $datedayforum == 0 AND $dateminforum == 1)
												{
													if($dateheureforum == 0)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
													<?php
													}
													else if($dateheureforum == 1)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateminforum; ?> minute</span>
													<?php
													}
												}
												else if($dateanforum == 0 AND $datemoisforum == 0 AND $datedayforum == 0 AND $dateheureforum == 0)
												{
													if($dateminforum >= 2)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateminforum; ?> minutes</span>
													<?php
													}
												}
												else if($dateanforum == 0 AND $datemoisforum == 0 AND $datedayforum == 0 AND $dateheureforum == 1 AND $dateminforum < 0 )
												{
													$datemin2forum = 60 + $dateminforum;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2forum; ?> minutes</span>
												<?php
												}
												else if($dateanforum == 0 AND $datemoisforum == 0 AND $datedayforum == 0 AND $dateheureforum == 1 AND $dateminforum >= 0 )
												{
													$datemin2forum = 60 + $dateminforum;
												?>
													<span class="articletemps">Il y a <?php echo $dateheureforum; ?> heure</span>
												<?php
												}
												else if($dateheureforum >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheureforum; ?> heures</span>
												<?php
												}
											?>
											<br />
											<a href="forum.php?id=<?php echo $infoforumsujets['ID']; ?>" style="text-decoration:none;" >
												<div class="cubesujets" style="background:url(<?php echo htmlspecialchars($infoforumsujets['image']); ?>)no-repeat;background-size: cover;color: <?php echo $infoforumsujets['couleur']; ?>;">
												<span class="cubesujetsmessages"><?php echo $nbdecommentairesforumsujets['nbdecommentairesforumsujets']; ?></span><br />
													<?php
														if(mb_strlen($infoforumsujetstitre, 'utf8') <= 15)
														{
														?>
															<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfoforumsujets[0]); ?></span></div>
														<?php
														}
														else
														{
														?>
															<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infoforumsujetstitre); ?>"><span><?php echo htmlspecialchars($arrayinfoforumsujets[0]); ?></span></div>
														<?php	
														}
													
													$searchmoynoteforumsujets = $db->query('SELECT AVG(note) AS notemoyforumsujets FROM notesforum WHERE IDsujet =\'' . $infoforumsujets['ID'] . '\'');
													$notemoyforumsujets = $searchmoynoteforumsujets->fetch();	
													if($notemoyforumsujets['notemoyforumsujets'] == 0)
													{
													?>
														<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
													<?php
													}
													else if($notemoyforumsujets['notemoyforumsujets'] > 0 && $notemoyforumsujets['notemoyforumsujets'] < 2)
													{
													?>
														<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
													<?php
													}
													else if($notemoyforumsujets['notemoyforumsujets'] >= 2 && $notemoyforumsujets['notemoyforumsujets'] < 3)
													{
													?>
														<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
													<?php
													}
													else if($notemoyforumsujets['notemoyforumsujets'] >= 3 && $notemoyforumsujets['notemoyforumsujets'] < 4)
													{
													?>
														<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
													<?php
													}
													else if($notemoyforumsujets['notemoyforumsujets'] >= 4 && $notemoyforumsujets['notemoyforumsujets'] < 5)
													{
													?>
														<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
													<?php
													}
													else if($notemoyforumsujets['notemoyforumsujets'] >= 5)
													{
													?>
														<span class="cubesujetsetoile">★★★★★</span>
													<?php
													}
												?>
												</div>
											</a>
										</div>
										<?php
										}
										$selectinfoforumsujets->closeCursor();
										?>
										</div>
										<div id="actufiltrecontenue2">
										<?php
										$selectcountgallery = $db->query('SELECT COUNT(*) AS countgallery FROM gallery WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
										$countgallery = $selectcountgallery->fetch();
										
										if($countgallery['countgallery'] == 0)
										{
										?>
											<p class="nopost">Aucune publication</p>
										<?php
										}
										
										$selectinfogalleryimg = $db->query('SELECT * FROM gallery WHERE IDmembre=\'' . $_SESSION['ID'] . '\' ORDER BY date DESC');
										while($infogalleryimg = $selectinfogalleryimg->fetch())
										{
										?>
										<div class="divabonnementbackground" style="margin-left:-200%;" id="divdeletebackgroundgallery<?php echo $infogalleryimg['ID']; ?>">
										</div>
										<div class="divabonnementforum" id="divdeletearticlegallery<?php echo $infogalleryimg['ID']; ?>">
											<fieldset class="barredeconnexion">
												<legend class="titredeconnexion">Confirmation</legend>
													<span>Êtes-vous sûr de vouloir supprimer cette publication ?</span>
												</fieldset>
											<fieldset class="barreoui">
												<legend class="barrelegend" onclick="ouideletegallery<?php echo $infogalleryimg['ID']; ?>()">Oui</legend>
											</fieldset>
											<fieldset class="barreannuler">
												<legend class="barrelegend" id="annulerdeletegallery<?php echo $infogalleryimg['ID']; ?>">Annuler</legend>
											</fieldset>
										</div>
										<div class="blockfilactualitearticle" id="blockfilactualitearticlegallery<?php echo $infogalleryimg['ID']; ?>">
											<a href="gallery.php?update=<?php echo $infogalleryimg['ID']; ?>"><img src="images/edit.png" alt="modifier" class="deleteactualitearticle2" style="margin-right:26px;"></a>
											<img src="images/supprimerrecherche2.png" alt="supprimer" class="deleteactualitearticle2" id="deleteactualitearticlegallery<?php echo $infogalleryimg['ID']; ?>">
											<img src="membre/avatar/<?php echo $_SESSION['avatar']; ?>" alt="Avatar" class="articleavatar" />
											<span class="articlepseudo" ><?php echo $_SESSION['pseudo']; ?></span><br />
											<?php
												$dateanimggallery = date("Y", strtotime($infogalleryimg['date']));
												$datemoisimggallery = date("m", strtotime($infogalleryimg['date']));
												$datedayimggallery = date("d", strtotime($infogalleryimg['date']));
												$dateheureimggallery = date("H", strtotime($infogalleryimg['date']));
												$dateminimggallery = date("i", strtotime($infogalleryimg['date']));
												
												$dateannowgallery = date('Y');
												$datemoisnowgallery = date('m');
												$datedaynowgallery = date('d');
												$dateheurenowgallery = date('H');
												$dateminnowgallery = date('i');
												
												$dateangallery =  $dateannowgallery - $dateanimggallery;
												$datemoisgallery = $datemoisnowgallery - $datemoisimggallery;
												$datemois2gallery = $datemoisimggallery - $datemoisnowgallery;
												$datedaygallery = $datedaynowgallery - $datedayimggallery;
												$dateheuregallery = $dateheurenowgallery - $dateheureimggallery;
												$datemingallery = $dateminnowgallery - $dateminimggallery;
												
												$datemois3gallery = 12 - $datemois2gallery;
												
												if($dateangallery == 1 AND $datemois3gallery == 1 AND $datedaygallery != 0)
												{
													$dateday2gallery = 31 - $datedayimggallery;
													$dateday3gallery = $dateday2gallery + $datedaynowgallery;
													if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
													<?php
													}
													else if($dateday3gallery >= 31)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemois3gallery; ?> mois</span>
													<?php
													}else
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
													<?php
													}
												}
												else if($dateangallery == 0 AND $datemoisgallery == 0 AND $datedaygallery == 0 AND $dateheuregallery == 0 AND $datemingallery == 0)
												{
													?>
														<span class="articletemps">À l'instant</span>
													<?php
												}
												else if($dateangallery == 1 AND $datemois2gallery >= 2)
												{
													$datemois4gallery = 12 - $datemois2gallery;
													?>
														<span class="articletemps">Il y a <?php echo $datemois4gallery; ?> mois</span>
													<?php
												}
												else if($dateangallery == 1 AND ($datemoisgallery >= 1 OR $datemoisgallery <= 1))
												{
													?>
														<span class="articletemps">Il y a <?php echo $dateangallery; ?> an</span>
													<?php
												}
												else if($dateangallery >= 2)
												{
													?>
														<span class="articletemps">Il y a <?php echo $dateangallery; ?> ans</span>
													<?php
												}
												else if($datemoisgallery == 0 AND $dateangallery >= 1)
												{
													if($dateangallery == 1)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateangallery; ?> an</span>
													<?php
													}
													else if($dateangallery >= 1)
													{
													?>
														<span class="articletemps">Il y a <?php echo $dateangallery; ?> ans</span>
													<?php
													}
												}
												else if($dateangallery == 0 AND $datemoisgallery >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
												<?php
												}
												else if($dateangallery == 0 AND $datemoisgallery == 1 AND $datedaygallery == 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
												<?php
												}
												else if($dateangallery == 0 AND $datemoisgallery == 0 AND $datedaygallery >= 1)
												{
													if($datedaygallery >= 2)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datedaygallery; ?> jours</span>
													<?php
													}
													else if($datedaygallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
													{
														$dateheure2gallery = 24 - $dateheureimggallery;
														$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
														if($dateheure3gallery >= 2)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery >= 0)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery < 0)
														{
															$datemin2gallery = 60 + $datemingallery;
														?>
															<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
														<?php
														}
														else if($dateheure3gallery == 1 AND $datemingallery == 1)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
														<?php
														}
													}
													else if($datedaygallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datedaygallery; ?> jour</span>
													<?php
													}
												}
												else if($dateangallery == 0 AND $datemoisgallery == 1 AND $datedaygallery != 0)
												{
													if($datemoisimggallery == 1)
													{
														$dateday2gallery = 31 - $datedayimggallery;
														$dateday3gallery = $dateday2gallery + $datedaynowgallery;
														if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
														{
															$dateheure2gallery = 24 - $dateheureimggallery;
															$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
															if($dateheure3gallery >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery < 0)
															{
																$datemin2gallery = 60 + $datemingallery;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
															<?php
															}
														}
														else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
														<?php
														}
														else if($dateday3gallery >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimggallery == 2)
													{
														$dateday2gallery = 28 - $datedayimggallery;
														$dateday3gallery = $dateday2gallery + $datedaynowgallery;
														if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
														{
															$dateheure2gallery = 24 - $dateheureimggallery;
															$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
															if($dateheure3gallery >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery < 0)
															{
																$datemin2gallery = 60 + $datemingallery;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
															<?php
															}
														}
														else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
														<?php
														}
														else if($dateday3gallery >= 28)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimggallery == 3)
													{
														$dateday2gallery = 31 - $datedayimggallery;
														$dateday3gallery = $dateday2gallery + $datedaynowgallery;
														if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
														{
															$dateheure2gallery = 24 - $dateheureimggallery;
															$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
															if($dateheure3gallery >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery < 0)
															{
																$datemin2gallery = 60 + $datemingallery;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
															<?php
															}
														}
														else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
														<?php
														}
														else if($dateday3gallery >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimggallery == 4)
													{
														$dateday2gallery = 30 - $datedayimggallery;
														$dateday3gallery = $dateday2gallery + $datedaynowgallery;
														if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
														{
															$dateheure2gallery = 24 - $dateheureimggallery;
															$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
															if($dateheure3gallery >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery < 0)
															{
																$datemin2gallery = 60 + $datemingallery;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
															<?php
															}
														}
														else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
														<?php
														}
														else if($dateday3gallery >= 30)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimggallery == 5)
													{
														$dateday2gallery = 31 - $datedayimggallery;
														$dateday3gallery = $dateday2gallery + $datedaynowgallery;
														if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
														{
															$dateheure2gallery = 24 - $dateheureimggallery;
															$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
															if($dateheure3gallery >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery < 0)
															{
																$datemin2gallery = 60 + $datemingallery;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
															<?php
															}
														}
														else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
														<?php
														}
														else if($dateday3gallery >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimggallery == 6)
													{
														$dateday2gallery = 30 - $datedayimggallery;
														$dateday3gallery = $dateday2gallery + $datedaynowgallery;
														if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
														{
															$dateheure2gallery = 24 - $dateheureimggallery;
															$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
															if($dateheure3gallery >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery < 0)
															{
																$datemin2gallery = 60 + $datemingallery;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
															<?php
															}
														}
														else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
														<?php
														}
														else if($dateday3gallery >= 30)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimggallery == 7)
													{
														$dateday2gallery = 31 - $datedayimggallery;
														$dateday3gallery = $dateday2gallery + $datedaynowgallery;
														if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
														{
															$dateheure2gallery = 24 - $dateheureimggallery;
															$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
															if($dateheure3gallery >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery < 0)
															{
																$datemin2gallery = 60 + $datemingallery;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
															<?php
															}
														}
														else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
														<?php
														}
														else if($dateday3gallery >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimggallery == 8)
													{
														$dateday2gallery = 31 - $datedayimggallery;
														$dateday3gallery = $dateday2gallery + $datedaynowgallery;
														if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
														{
															$dateheure2gallery = 24 - $dateheureimggallery;
															$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
															if($dateheure3gallery >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery < 0)
															{
																$datemin2gallery = 60 + $datemingallery;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
															<?php
															}
														}
														else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
														<?php
														}
														else if($dateday3gallery >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimggallery == 9)
													{
														$dateday2gallery = 30 - $datedayimggallery;
														$dateday3gallery = $dateday2gallery + $datedaynowgallery;
														if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
														{
															$dateheure2gallery = 24 - $dateheureimggallery;
															$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
															if($dateheure3gallery >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery < 0)
															{
																$datemin2gallery = 60 + $datemingallery;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
															<?php
															}
														}
														else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
														<?php
														}
														else if($dateday3gallery >= 30)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimggallery == 10)
													{
														$dateday2gallery = 31 - $datedayimggallery;
														$dateday3gallery = $dateday2gallery + $datedaynowgallery;
														if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
														{
															$dateheure2gallery = 24 - $dateheureimggallery;
															$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
															if($dateheure3gallery >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery < 0)
															{
																$datemin2gallery = 60 + $datemingallery;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
															<?php
															}
														}
														else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
														<?php
														}
														else if($dateday3gallery >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimggallery == 11)
													{
														$dateday2gallery = 30 - $datedayimggallery;
														$dateday3gallery = $dateday2gallery + $datedaynowgallery;
														if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
														{
															$dateheure2gallery = 24 - $dateheureimggallery;
															$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
															if($dateheure3gallery >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery < 0)
															{
																$datemin2gallery = 60 + $datemingallery;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
															<?php
															}
														}
														else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
														<?php
														}
														else if($dateday3gallery >= 30)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
														<?php
														}
													}
													else if($datemoisimggallery == 12)
													{
														$dateday2gallery = 31 - $datedayimggallery;
														$dateday3gallery = $dateday2gallery + $datedaynowgallery;
														if($dateday3gallery == 1 AND $dateheureimggallery > $dateheurenowgallery)
														{
															$dateheure2gallery = 24 - $dateheureimggallery;
															$dateheure3gallery = $dateheure2gallery + $dateheurenowgallery;
															if($dateheure3gallery >= 2)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heures</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery >= 0)
															{
															?>
																<span class="articletemps">Il y a <?php echo $dateheure3gallery; ?> heure</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery < 0)
															{
																$datemin2gallery = 60 + $datemingallery;
															?>
																<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
															<?php
															}
															else if($dateheure3gallery == 1 AND $datemingallery == 1)
															{
															?>
																<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
															<?php
															}
														}
														else if($dateday3gallery == 1 AND $dateheureimggallery <= $dateheurenowgallery)
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jour</span>
														<?php
														}
														else if($dateday3gallery >= 31)
														{
														?>
															<span class="articletemps">Il y a <?php echo $datemoisgallery; ?> mois</span>
														<?php
														}
														else
														{
														?>
															<span class="articletemps">Il y a <?php echo $dateday3gallery; ?> jours</span>
														<?php
														}
													}
												}
												else if($dateangallery == 0 AND $datemoisgallery == 0 AND $datedaygallery == 0 AND $datemingallery == 1)
												{
													if($dateheuregallery == 0)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
													<?php
													}
													else if($dateheuregallery == 1)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemingallery; ?> minute</span>
													<?php
													}
												}
												else if($dateangallery == 0 AND $datemoisgallery == 0 AND $datedaygallery == 0 AND $dateheuregallery == 0)
												{
													if($datemingallery >= 2)
													{
													?>
														<span class="articletemps">Il y a <?php echo $datemingallery; ?> minutes</span>
													<?php
													}
												}
												else if($dateangallery == 0 AND $datemoisgallery == 0 AND $datedaygallery == 0 AND $dateheuregallery == 1 AND $datemingallery < 0 )
												{
													$datemin2gallery = 60 + $datemingallery;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2gallery; ?> minutes</span>
												<?php
												}
												else if($dateangallery == 0 AND $datemoisgallery == 0 AND $datedaygallery == 0 AND $dateheuregallery == 1 AND $datemingallery >= 0 )
												{
													$datemin2gallery = 60 + $datemingallery;
												?>
													<span class="articletemps">Il y a <?php echo $dateheuregallery; ?> heure</span>
												<?php
												}
												else if($dateheuregallery >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheuregallery; ?> heures</span>
												<?php
												}
											?>
											<br />
											<div class="divcontenueimagegallery"><a href="gallery.php?image=<?php echo $infogalleryimg['ID']; ?>"><img src="gallery/<?php echo $infogalleryimg['image']; ?>" alt="Image" class="contenueimagegallery" /></a></div>
											<br />
											<div class="articleblockaime2">
											<?php 
												$searchnoteexistgallery = $db->query('SELECT * FROM notesgallery WHERE IDgallery=\'' . $infogalleryimg['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
												$noteexistgallery = $searchnoteexistgallery->rowCount();
												if($noteexistgallery == 1)
												{
												?>
													<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimegallerypas<?php echo $infogalleryimg['ID']; ?>" onclick="articleimgaimegallerypas<?php echo $infogalleryimg['ID']; ?>()" />
													
													<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaimegallery<?php echo $infogalleryimg['ID']; ?>" onclick="articleimgaimegallery<?php echo $infogalleryimg['ID']; ?>()" style="opacity:0.65;display:none;" />
												<?php
												}
												else
												{
												?>
													<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaimegallery<?php echo $infogalleryimg['ID']; ?>" onclick="articleimgaimegallery<?php echo $infogalleryimg['ID']; ?>()" style="opacity:0.65;" />
												
													<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimegallerypas<?php echo $infogalleryimg['ID']; ?>" onclick="articleimgaimegallerypas<?php echo $infogalleryimg['ID']; ?>()" style="display:none;" />
												<?php
												}
											?>
											<span class="articlenbaime" id="articlenbaimegallery<?php echo $infogalleryimg['ID']; ?>"><?php echo htmlspecialchars($infogalleryimg['note']); ?></span>
											</div>
										</div>
										<?php
										}
										$selectinfogalleryimg->closeCursor();
										?>
										</div>
										<script>
											
											document.querySelector("#actufiltrespan1").onclick = function() 
											{ 
												if (window.getComputedStyle(document.querySelector('#actufiltrecontenue1')).display=='none')
												{
													document.getElementById("actufiltrecontenue2").style.display="none";
													document.getElementById("actufiltrespan2").style.color="white";
													document.getElementById("actufiltrespan2").style.cursor="pointer";
													document.getElementById("actufiltrespan1").style.color="rgb(40,40,40)";
													document.getElementById("actufiltrespan1").style.cursor="default";
													document.getElementById("actufiltrecontenue1").style.display="block";
												}
												else
												{
													document.getElementById("actufiltrecontenue2").style.display="none";
													document.getElementById("actufiltrespan2").style.color="white";
													document.getElementById("actufiltrespan2").style.cursor="pointer";
													document.getElementById("actufiltrespan1").style.color="rgb(40,40,40)";
													document.getElementById("actufiltrespan1").style.cursor="default";
													document.getElementById("actufiltrecontenue1").style.display="block";
												}
											}
											
											document.querySelector("#actufiltrespan2").onclick = function() 
											{ 
												if (window.getComputedStyle(document.querySelector('#actufiltrecontenue2')).display=='none')
												{
													document.getElementById("actufiltrecontenue1").style.display="none";
													document.getElementById("actufiltrespan1").style.color="white";
													document.getElementById("actufiltrespan1").style.cursor="pointer";
													document.getElementById("actufiltrespan2").style.color="rgb(40,40,40)";
													document.getElementById("actufiltrespan2").style.cursor="default";
													document.getElementById("actufiltrecontenue2").style.display="block";
												}
												else
												{
													document.getElementById("actufiltrecontenue1").style.display="none";
													document.getElementById("actufiltrespan1").style.color="white";
													document.getElementById("actufiltrespan1").style.cursor="pointer";
													document.getElementById("actufiltrespan2").style.color="rgb(40,40,40)";
													document.getElementById("actufiltrespan2").style.cursor="default";
													document.getElementById("actufiltrecontenue2").style.display="block";
												}
											}
											
										<?php
										$selectinfogalleryimgjs = $db->query('SELECT * FROM gallery WHERE IDmembre=\'' . $_SESSION['ID'] . '\' ORDER BY date DESC');
										while($infogalleryimgjs = $selectinfogalleryimgjs->fetch())
										{
										?>
											document.querySelector("#deleteactualitearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").onclick = function() 
											{ 
												if (window.getComputedStyle(document.querySelector('#divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>')).display=='none')
												{
													setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0.35";},200 )
													setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="1";},200 )
												}
												else
												{
													setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0.35";},200 )
													setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="1";},200 )
												}
											}
											
											document.querySelector("#divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").onclick = function() 
											{ 
												if (window.getComputedStyle(document.querySelector('#divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>')).display=='block')
												{
													setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0";}, 100 )
													setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0";},100 )
												}
												else
												{
													setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0";}, 100 )
													setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0";},100 )
												}
											}
											
											document.querySelector("#annulerdeletegallery<?php echo $infogalleryimgjs['ID']; ?>").onclick = function() 
											{ 
												if (window.getComputedStyle(document.querySelector('#divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>')).display=='block')
												{
													setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0";}, 100 )
													setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0";},100 )
												}
												else
												{
													setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0";}, 100 )
													setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0";},100 )
												}
											}
											
											function ouideletegallery<?php echo $infogalleryimgjs['ID']; ?>()
											{
												var xhr = new XMLHttpRequest();
											
												xhr.open('GET', 'site/phppageprofil.php?deletepublicationgallery=<?php echo $infogalleryimgjs['ID']; ?>');
												
												xhr.onreadystatechange = function()
												{
													if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
													{
														setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="none";},500 )
														setTimeout(function(){document.getElementById("divdeletebackgroundgallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0";}, 100 )
														setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="none";},500 )
														setTimeout(function(){document.getElementById("divdeletearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0";},100 )
														setTimeout(function(){document.getElementById("blockfilactualitearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.display="none";},200 )
														setTimeout(function(){document.getElementById("blockfilactualitearticlegallery<?php echo $infogalleryimgjs['ID']; ?>").style.opacity="0";},100 )
													}
												};
												
												xhr.send(null);
											}
											
											function articleimgaimegallery<?php echo $infogalleryimgjs['ID']; ?>()
											{
												var xhr = new XMLHttpRequest();
												
												xhr.open('GET', 'site/phppageprofil.php?articlegallerynoteaime=<?php echo $infogalleryimgjs['ID']; ?>');
												
												xhr.onreadystatechange = function()
												{
													if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
													{
														document.getElementById('articleimgaimegallery<?php echo $infogalleryimgjs['ID'];?>').style.display="none";
														document.getElementById('articleimgaimegallerypas<?php echo $infogalleryimgjs['ID'];?>').style.display="inline-block";
														document.getElementById('articlenbaimegallery<?php echo $infogalleryimgjs['ID'];?>').innerHTML = xhr.responseText;
													}
												};
												
												xhr.send(null);
											}
											
											function articleimgaimegallerypas<?php echo $infogalleryimgjs['ID']; ?>()
											{
												var xhr = new XMLHttpRequest();
												
												xhr.open('GET', 'site/phppageprofil.php?articlegallerynoteaimepas=<?php echo $infogalleryimgjs['ID']; ?>');
												
												xhr.onreadystatechange = function()
												{
													if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
													{
														document.getElementById('articleimgaimegallerypas<?php echo $infogalleryimgjs['ID'];?>').style.display="none";
														document.getElementById('articleimgaimegallery<?php echo $infogalleryimgjs['ID'];?>').style.display="inline-block";
														document.getElementById('articlenbaimegallery<?php echo $infogalleryimgjs['ID'];?>').innerHTML = xhr.responseText;
													}
												};
												
												xhr.send(null);
											}
											
										<?php
										}
										$selectinfogalleryimgjs->closeCursor();
										
										$selectinfoforumsujetsjs = $db->query('SELECT * FROM forumsujets WHERE IDmembres=\'' . $_SESSION['ID'] . '\' ORDER BY date_creation DESC');
										while($infoforumsujetsjs = $selectinfoforumsujetsjs->fetch())
										{
										?>
											document.querySelector("#deleteactualitearticleforum<?php echo $infoforumsujetsjs['ID']; ?>").onclick = function() 
											{ 
												if (window.getComputedStyle(document.querySelector('#divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>')).display=='none')
												{
													setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0.35";},200 )
													setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="1";},200 )
												}
												else
												{
													setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0.35";},200 )
													setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="1";},200 )
												}
											}
											
											document.querySelector("#divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").onclick = function() 
											{ 
												if (window.getComputedStyle(document.querySelector('#divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>')).display=='block')
												{
													setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0";}, 100 )
													setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0";},100 )
												}
												else
												{
													setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0";}, 100 )
													setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0";},100 )
												}
											}
											
											document.querySelector("#annulerdelete<?php echo $infoforumsujetsjs['ID']; ?>").onclick = function() 
											{ 
												if (window.getComputedStyle(document.querySelector('#divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>')).display=='block')
												{
													setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0";}, 100 )
													setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0";},100 )
												}
												else
												{
													setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0";}, 100 )
													setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0";},100 )
												}
											}
											
											function ouidelete<?php echo $infoforumsujetsjs['ID']; ?>()
											{
												var xhr = new XMLHttpRequest();
											
												xhr.open('GET', 'site/phppageprofil.php?deletepublicationforum=<?php echo $infoforumsujetsjs['ID']; ?>');
												
												xhr.onreadystatechange = function()
												{
													if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
													{
														setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.display="none";},500 )
														setTimeout(function(){document.getElementById("divdeletebackground<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0";}, 100 )
														setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.display="none";},500 )
														setTimeout(function(){document.getElementById("divdeletearticle<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0";},100 )
														setTimeout(function(){document.getElementById("blockfilactualitearticleforum<?php echo $infoforumsujetsjs['ID']; ?>").style.display="none";},200 )
														setTimeout(function(){document.getElementById("blockfilactualitearticleforum<?php echo $infoforumsujetsjs['ID']; ?>").style.opacity="0";},100 )
													}
												};
												
												xhr.send(null);
											}
											
										<?php
										}
										$selectinfoforumsujetsjs->closeCursor();
										?>
										</script>
									</div>
									
									<?php
										
										$selectinfobio = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
										$infobio = $selectinfobio->fetch();
										
										if(mb_strlen($_SESSION['pseudo'], 'utf8') <= 17)
										{
											$pseudojournalinfo[0] = $_SESSION['pseudo'];
										}
										else
										{
											$pseudojournal = mb_substr($_SESSION['pseudo'], 0, 14, 'utf8');
											
											$pseudojournalinfo[0] = $pseudojournal . "..."; 
										}
									?>
									<div class="divabonnementbackground" style="margin-left:-200%;" id="divjournalinfobackground">
									</div>
									<div class="divjournalinfobio" id="divjournalinfodeletearticle">
									<?php
										if(isset($infobio['bio']) AND $infobio['bio'] != 'NULL' AND $infobio['bio'] != '')
										{
										?>
											<textarea class="journalinfobiotextarea" type="text" placeholder="Modifier votre bio" autocomplete="off" maxlength="300"><?php echo htmlspecialchars($infobio['bio']); ?></textarea>
											<span class="journalinfobiospan" style="margin-left:90px;" onclick="journalinfobiospanmodifier()">Modifier</span>
											<span class="journalinfobiospan" onclick="journalinfobiospanannuler()">Annuler</span>
										<?php
										}
										else
										{
										?>
											<textarea class="journalinfobiotextarea" type="text" placeholder="Ajouter votre bio" autocomplete="off" maxlength="300"></textarea>
											<span class="journalinfobiospan" style="margin-left:97px;" onclick="journalinfobiospanajouter()">Ajouter</span>
											<span class="journalinfobiospan" onclick="journalinfobiospanannuler()">Annuler</span>
										<?php
										}
									?>
									</div>
									<div class="divjournalinfobio" id="divjournalinfodeletearticlexhrajouter" style="display:none;">
										<textarea class="journalinfobiotextarea" id="journalinfobiotextareaajouterxhr" type="text" placeholder="Ajouter votre bio" autocomplete="off" maxlength="300"></textarea>
										<span class="journalinfobiospan" style="margin-left:97px;" onclick="journalinfobiospanajouterxhr()">Ajouter</span>
										<span class="journalinfobiospan" onclick="journalinfobiospanannulerxhrajouter()">Annuler</span>
									</div>
									<div class="divjournalinfobio" id="divjournalinfodeletearticlexhrmodifier" style="display:none;">
										<textarea class="journalinfobiotextarea" id="journalinfobiotextareamodifierxhr" type="text" placeholder="Modifier votre bio" autocomplete="off" maxlength="300"></textarea>
										<span class="journalinfobiospan" style="margin-left:90px;" onclick="journalinfobiospanmodifierxhr()">Modifier</span>
										<span class="journalinfobiospan" onclick="journalinfobiospanannulerxhrmodifier()">Annuler</span>
									</div>
									<div class="divjournalotherlien" id="divjournalotherlien">
										<img src="images/closegallery.png" alt="Close" class="divjournalotherlienimgclose" />
										<div class="divjournalotherlienspan1">Ajouter lien</div>
										<div class="divjournalotherlienspan2">Modifier lien</div>
										<div class="divjournalotherliendiv1" id="divjournalotherliendiv1">
										<?php
											if(!isset($infobio['instagram']) OR $infobio['instagram'] == 'NULL' OR $infobio['instagram'] == '')
											{
											?>
												<div id="divurlinstagram" style="display;block;opacity:none;height:110px;transition: all 0.4s;">
													<span class="infodivmembre2imgspan"><img src="images/logoinsta.png" alt="Instagram" class="infodivmembre2img" style="width:35px;max-height:35px;margin-left:30px;margin-bottom:-7px;"/>Instagram</span><br />
													<input type="url" placeholder="https://www.instagram.com/metro_manga/" maxlength="300" class="infodivmembre2imgform" id="urlinstagram" />
													<img src="images/validerotherlien.png" alt="Valider" onclick="addinstagram()" class="infodivmembre2imgformimgvalider" />
												</div>
												
												<p class="xhrlienajouter" id="xhrlienajouterintagram"></p>
												
												<script>
													
													function addinstagram()
													{
														var xhr = new XMLHttpRequest();
														var url = document.querySelector('#urlinstagram').value;
														
														xhr.open('GET', 'site/phppageprofil.php?addinstagram=' + url);
														
														xhr.onreadystatechange = function()
														{
															if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
															{
																document.getElementById("xhrlienajouterintagram").innerHTML = xhr.responseText;
																lienajouterinstagram(url)
															}
														};
														
														xhr.send(null);
													}
													
													function lienajouterinstagram(url)
													{
														if(document.getElementById("xhrlienajouterintagram").innerHTML == "Lien ajouter")
														{
															setTimeout(function(){document.getElementById("divurlinstagram").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlinstagram").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlinstagram").style.opacity="0";},100 )
															setTimeout(function(){document.getElementById("infodivmembre2lienxhrinstagram").style.display="inline-block";},500 )
															document.getElementById("infodivmembre2lienxhrinstagramurl").href = url;
															setTimeout(function(){document.getElementById("xhrlienajouterintagram").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienajouterintagram").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienajouterintagram").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienajouterintagram").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienajouterintagram").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienajouterintagram").style.display="none";},13000 )
														}
													}
													
												</script>
											<?php
											}
											
											if(!isset($infobio['twitter']) OR $infobio['twitter'] == 'NULL' OR $infobio['twitter'] == '')
											{
											?>
												<div id="divurltwitter" style="display;block;opacity:none;height:110px;transition: all 0.4s;">
													<span class="infodivmembre2imgspan"><img src="images/logotwitter.png" alt="Twitter" class="infodivmembre2img" style="width:35px;max-height:35px;margin-left:30px;margin-bottom:-7px;"/>Twitter</span><br />
													<input type="url" placeholder="https://twitter.com/MetroManga" maxlength="300" class="infodivmembre2imgform" id="urltwitter" />
													<img src="images/validerotherlien.png" alt="Valider" onclick="addtwitter()" class="infodivmembre2imgformimgvalider" />
												</div>
												
												<p class="xhrlienajouter" id="xhrlienajoutertwitter"></p>
												
												<script>
													
													function addtwitter()
													{
														var xhr = new XMLHttpRequest();
														var url = document.querySelector('#urltwitter').value;
														
														xhr.open('GET', 'site/phppageprofil.php?addtwitter=' + url);
														
														xhr.onreadystatechange = function()
														{
															if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
															{
																document.getElementById("xhrlienajoutertwitter").innerHTML = xhr.responseText;
																lienajoutertwitter(url)
															}
														};
														
														xhr.send(null);
													}
													
													function lienajoutertwitter(url)
													{
														if(document.getElementById("xhrlienajoutertwitter").innerHTML == "Lien ajouter")
														{
															setTimeout(function(){document.getElementById("divurltwitter").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurltwitter").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurltwitter").style.opacity="0";},100 )
															setTimeout(function(){document.getElementById("infodivmembre2lienxhrtwitter").style.display="inline-block";},500 )
															document.getElementById("infodivmembre2lienxhrtwitterurl").href = url;
															setTimeout(function(){document.getElementById("xhrlienajoutertwitter").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienajoutertwitter").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienajoutertwitter").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienajoutertwitter").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienajoutertwitter").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienajoutertwitter").style.display="none";},13000 )
														}
													}
													
												</script>
											<?php
											}
											
											if(!isset($infobio['youtube']) OR $infobio['youtube'] == 'NULL' OR $infobio['youtube'] == '')
											{
											?>
												<div id="divurlyoutube" style="display;block;opacity:none;height:110px;transition: all 0.4s;">
													<span class="infodivmembre2imgspan"><img src="images/logoyoutube.png" alt="Youtube" class="infodivmembre2img" style="width:35px;max-height:35px;margin-left:30px;margin-bottom:-7px;"/>Youtube</span><br />
													<input type="url" placeholder="https://www.youtube.com/user/MetroManga" maxlength="300" class="infodivmembre2imgform" id="urlyoutube" />
													<img src="images/validerotherlien.png" alt="Valider" onclick="addyoutube()" class="infodivmembre2imgformimgvalider" />
												</div>
												
												<p class="xhrlienajouter" id="xhrlienajouteryoutube"></p>
												
												<script>
													
													function addyoutube()
													{
														var xhr = new XMLHttpRequest();
														var url = document.querySelector('#urlyoutube').value;
														
														xhr.open('GET', 'site/phppageprofil.php?addyoutube=' + url);
														
														xhr.onreadystatechange = function()
														{
															if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
															{
																document.getElementById("xhrlienajouteryoutube").innerHTML = xhr.responseText;
																lienajouteryoutube(url)
															}
														};
														
														xhr.send(null);
													}
													
													function lienajouteryoutube(url)
													{
														if(document.getElementById("xhrlienajouteryoutube").innerHTML == "Lien ajouter")
														{
															setTimeout(function(){document.getElementById("divurlyoutube").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlyoutube").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlyoutube").style.opacity="0";},100 )
															setTimeout(function(){document.getElementById("infodivmembre2lienxhryoutube").style.display="inline-block";},500 )
															document.getElementById("infodivmembre2lienxhryoutubeurl").href = url;
															setTimeout(function(){document.getElementById("xhrlienajouteryoutube").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienajouteryoutube").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienajouteryoutube").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienajouteryoutube").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienajouteryoutube").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienajouteryoutube").style.display="none";},13000 )
														}
													}
													
												</script>
											<?php
											}
											
											if(!isset($infobio['snapchat']) OR $infobio['snapchat'] == 'NULL' OR $infobio['snapchat'] == '')
											{
											?>
												<div id="divurlsnapchat" style="display;block;opacity:none;height:110px;transition: all 0.4s;">
													<span class="infodivmembre2imgspan"><img src="images/logosnap.png" alt="Snapchat" class="infodivmembre2img" style="width:35px;max-height:35px;margin-left:30px;margin-right:3px;margin-bottom:-7px;"/>Snapchat</span><br />
													<input type="url" placeholder="https://www.snapchat.com/add/metromanga" maxlength="300" class="infodivmembre2imgform" id="urlsnapchat" />
													<img src="images/validerotherlien.png" alt="Valider" onclick="addsnapchat()" class="infodivmembre2imgformimgvalider" />
												</div>
												
												<p class="xhrlienajouter" id="xhrlienajoutersnapchat"></p>
												
												<script>
													
													function addsnapchat()
													{
														var xhr = new XMLHttpRequest();
														var url = document.querySelector('#urlsnapchat').value;
														
														xhr.open('GET', 'site/phppageprofil.php?addsnapchat=' + url);
														
														xhr.onreadystatechange = function()
														{
															if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
															{
																document.getElementById("xhrlienajoutersnapchat").innerHTML = xhr.responseText;
																lienajoutersnapchat(url)
															}
														};
														
														xhr.send(null);
													}
													
													function lienajoutersnapchat(url)
													{
														if(document.getElementById("xhrlienajoutersnapchat").innerHTML == "Lien ajouter")
														{
															setTimeout(function(){document.getElementById("divurlsnapchat").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlsnapchat").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlsnapchat").style.opacity="0";},100 )
															setTimeout(function(){document.getElementById("infodivmembre2lienxhrsnapchat").style.display="inline-block";},500 )
															document.getElementById("infodivmembre2lienxhrsnapchaturl").href = url;
															setTimeout(function(){document.getElementById("xhrlienajoutersnapchat").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienajoutersnapchat").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienajoutersnapchat").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienajoutersnapchat").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienajoutersnapchat").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienajoutersnapchat").style.display="none";},13000 )
														}
													}
													
												</script>
											<?php
											}
											
											if(!isset($infobio['twitch']) OR $infobio['twitch'] == 'NULL' OR $infobio['twitch'] == '')
											{
											?>
												<div id="divurltwitch" style="display;block;opacity:none;height:110px;transition: all 0.4s;">
													<span class="infodivmembre2imgspan"><img src="images/logotwitch.png" alt="Twitch" class="infodivmembre2img" style="width:35px;max-height:35px;margin-left:30px;margin-right:5px;margin-bottom:-7px;"/>Twitch</span><br />
													<input type="url" placeholder="https://www.twitch.tv/metromanga" maxlength="300" class="infodivmembre2imgform" id="urltwitch" />
													<img src="images/validerotherlien.png" alt="Valider" onclick="addtwitch()" class="infodivmembre2imgformimgvalider" />
												</div>
												
												<p class="xhrlienajouter" id="xhrlienajoutertwitch"></p>
												
												<script>
													
													function addtwitch()
													{
														var xhr = new XMLHttpRequest();
														var url = document.querySelector('#urltwitch').value;
														
														xhr.open('GET', 'site/phppageprofil.php?addtwitch=' + url);
														
														xhr.onreadystatechange = function()
														{
															if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
															{
																document.getElementById("xhrlienajoutertwitch").innerHTML = xhr.responseText;
																lienajoutertwitch(url)
															}
														};
														
														xhr.send(null);
													}
													
													function lienajoutertwitch(url)
													{
														if(document.getElementById("xhrlienajoutertwitch").innerHTML == "Lien ajouter")
														{
															setTimeout(function(){document.getElementById("divurltwitch").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurltwitch").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurltwitch").style.opacity="0";},100 )
															setTimeout(function(){document.getElementById("infodivmembre2lienxhrtwitch").style.display="inline-block";},500 )
															document.getElementById("infodivmembre2lienxhrtwitchurl").href = url;
															setTimeout(function(){document.getElementById("xhrlienajoutertwitch").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienajoutertwitch").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienajoutertwitch").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienajoutertwitch").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienajoutertwitch").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienajoutertwitch").style.display="none";},13000 )
														}
													}
													
												</script>
											<?php
											}
											
											if(!isset($infobio['facebook']) OR $infobio['facebook'] == 'NULL' OR $infobio['facebook'] == '')
											{
											?>
												<div id="divurlfacebook" style="display;block;opacity:none;height:110px;transition: all 0.4s;">
													<span class="infodivmembre2imgspan"><img src="images/logofb.png" alt="Facebook" class="infodivmembre2img" style="width:35px;max-height:35px;margin-left:30px;margin-right:5px;margin-bottom:-7px;"/>Facebook</span><br />
													<input type="url" placeholder="https://www.facebook.com/MetroManga/" maxlength="300" class="infodivmembre2imgform" id="urlfacebook" />
													<img src="images/validerotherlien.png" alt="Valider" onclick="addfacebook()" class="infodivmembre2imgformimgvalider" />
												</div>
												
												<p class="xhrlienajouter" id="xhrlienajouterfacebook"></p>
												
												<script>
													
													function addfacebook()
													{
														var xhr = new XMLHttpRequest();
														var url = document.querySelector('#urlfacebook').value;
														
														xhr.open('GET', 'site/phppageprofil.php?addfacebook=' + url);
														
														xhr.onreadystatechange = function()
														{
															if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
															{
																document.getElementById("xhrlienajouterfacebook").innerHTML = xhr.responseText;
																lienajouterfacebook(url)
															}
														};
														
														xhr.send(null);
													}
													
													function lienajouterfacebook(url)
													{
														if(document.getElementById("xhrlienajouterfacebook").innerHTML == "Lien ajouter")
														{
															setTimeout(function(){document.getElementById("divurlfacebook").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlfacebook").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlfacebook").style.opacity="0";},100 )
															setTimeout(function(){document.getElementById("infodivmembre2lienxhrfacebook").style.display="inline-block";},500 )
															document.getElementById("infodivmembre2lienxhrfacebookurl").href = url;
															setTimeout(function(){document.getElementById("xhrlienajouterfacebook").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienajouterfacebook").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienajouterfacebook").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienajouterfacebook").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienajouterfacebook").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienajouterfacebook").style.display="none";},13000 )
														}
													}
													
												</script>
											<?php
											}
											
											if(isset($infobio['instagram']) AND $infobio['instagram'] !== 'NULL' AND isset($infobio['twitter']) AND $infobio['twitter'] !== 'NULL' AND isset($infobio['youtube']) AND $infobio['youtube'] !== 'NULL' AND isset($infobio['snapchat']) AND $infobio['snapchat'] !== 'NULL' AND isset($infobio['twitch']) AND $infobio['twitch'] !== 'NULL' AND isset($infobio['facebook']) AND $infobio['facebook'] !== 'NULL')
											{
											?>
												<p class="xhrlienajouter" style="display:block;opacity:1;margin-top:65px;" >Aucun lien a ajouter</p>
											<?php
											}
										?>
											<div style="height:60px;"></div>
										</div>
										<div class="divjournalotherliendiv1" style="display:none;" id="divjournalotherliendiv2">
											<?php
											if(isset($infobio['instagram']) AND $infobio['instagram'] != 'NULL')
											{
											?>
												<div id="divurlupdateinstagram" style="display;block;opacity:none;height:110px;transition: all 0.4s;">
													<span class="infodivmembre2imgspan"><img src="images/logoinsta.png" alt="Instagram" class="infodivmembre2img" style="width:35px;max-height:35px;margin-left:30px;margin-right:5px;margin-bottom:-7px;"/>Instagram</span><br />
													<input type="url" value="<?php echo $infobio['instagram']; ?>" maxlength="300" class="infodivmembre2imgform" id="urlupdateinstagram" />
													<img src="images/validerotherlien.png" alt="Modifier" onclick="updateinstagram()" class="infodivmembre2imgformimgvalider" />
												</div>
												
												<p class="xhrlienajouter" id="xhrlienmodifierinstagram"></p>
												
												<script>
													
													function updateinstagram()
													{
														var xhr = new XMLHttpRequest();
														var url = document.querySelector('#urlupdateinstagram').value;
														
														xhr.open('GET', 'site/phppageprofil.php?updateinstagram=' + url);
														
														xhr.onreadystatechange = function()
														{
															if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
															{
																document.getElementById("xhrlienmodifierinstagram").innerHTML = xhr.responseText;
																lienmodifierinstagram(url)
															}
														};
														
														xhr.send(null);
													}
													
													function lienmodifierinstagram(url)
													{
														if(document.getElementById("xhrlienmodifierinstagram").innerHTML == "Lien modifier")
														{
															setTimeout(function(){document.getElementById("divurlupdateinstagram").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlupdateinstagram").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlupdateinstagram").style.opacity="0";},100 )
															document.getElementById("infodivmembre2lienxhrupdateinstagramurl").href = url;
															setTimeout(function(){document.getElementById("xhrlienmodifierinstagram").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifierinstagram").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifierinstagram").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienmodifierinstagram").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienmodifierinstagram").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienmodifierinstagram").style.display="none";},13000 )
															document.getElementById("urlupdateinstagram").href = url;
															setTimeout(function(){document.getElementById("divurlupdateinstagram").style.height="110px";},13300 )
															setTimeout(function(){document.getElementById("divurlupdateinstagram").style.display="block";},13000 )
															setTimeout(function(){document.getElementById("divurlupdateinstagram").style.opacity="1";},13400 )
														}
														else if(document.getElementById("xhrlienmodifierinstagram").innerHTML == "Lien supprimer")
														{
															setTimeout(function(){document.getElementById("divurlupdateinstagram").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlupdateinstagram").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlupdateinstagram").style.opacity="0";},100 )
															setTimeout(function(){document.getElementById("infodivmembre2lienxhrupdateinstagram").style.display="none";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifierinstagram").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifierinstagram").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifierinstagram").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienmodifierinstagram").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienmodifierinstagram").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienmodifierinstagram").style.display="none";},13000 )
														}
													}
													
												</script>
											<?php
											}
											
											if(isset($infobio['twitter']) AND $infobio['twitter'] != 'NULL')
											{
											?>
												<div id="divurlupdatetwitter" style="display;block;opacity:none;height:110px;transition: all 0.4s;">
													<span class="infodivmembre2imgspan"><img src="images/logotwitter.png" alt="Twitter" class="infodivmembre2img" style="width:35px;max-height:35px;margin-left:30px;margin-right:5px;margin-bottom:-7px;"/>Twitter</span><br />
													<input type="url" value="<?php echo $infobio['twitter']; ?>" maxlength="300" class="infodivmembre2imgform" id="urlupdatetwitter" />
													<img src="images/validerotherlien.png" alt="Modifier" onclick="updatetwitter()" class="infodivmembre2imgformimgvalider" />
												</div>
												
												<p class="xhrlienajouter" id="xhrlienmodifiertwitter"></p>
												
												<script>
													
													function updatetwitter()
													{
														var xhr = new XMLHttpRequest();
														var url = document.querySelector('#urlupdatetwitter').value;
														
														xhr.open('GET', 'site/phppageprofil.php?updatetwitter=' + url);
														
														xhr.onreadystatechange = function()
														{
															if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
															{
																document.getElementById("xhrlienmodifiertwitter").innerHTML = xhr.responseText;
																lienmodifiertwitter(url)
															}
														};
														
														xhr.send(null);
													}
													
													function lienmodifiertwitter(url)
													{
														if(document.getElementById("xhrlienmodifiertwitter").innerHTML == "Lien modifier")
														{
															setTimeout(function(){document.getElementById("divurlupdatetwitter").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlupdatetwitter").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlupdatetwitter").style.opacity="0";},100 )
															document.getElementById("infodivmembre2lienxhrupdatetwitterurl").href = url;
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitter").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitter").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitter").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitter").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitter").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitter").style.display="none";},13000 )
															document.getElementById("urlupdatetwitter").href = url;
															setTimeout(function(){document.getElementById("divurlupdatetwitter").style.height="110px";},13300 )
															setTimeout(function(){document.getElementById("divurlupdatetwitter").style.display="block";},13000 )
															setTimeout(function(){document.getElementById("divurlupdatetwitter").style.opacity="1";},13400 )
														}
														else if(document.getElementById("xhrlienmodifiertwitter").innerHTML == "Lien supprimer")
														{
															setTimeout(function(){document.getElementById("divurlupdatetwitter").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlupdatetwitter").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlupdatetwitter").style.opacity="0";},100 )
															setTimeout(function(){document.getElementById("infodivmembre2lienxhrupdatetwitter").style.display="none";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitter").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitter").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitter").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitter").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitter").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitter").style.display="none";},13000 )
														}
													}
													
												</script>
											<?php
											}
											
											if(isset($infobio['youtube']) AND $infobio['youtube'] != 'NULL')
											{
											?>
												<div id="divurlupdateyoutube" style="display;block;opacity:none;height:110px;transition: all 0.4s;">
													<span class="infodivmembre2imgspan"><img src="images/logoyoutube.png" alt="Youtube" class="infodivmembre2img" style="width:35px;max-height:35px;margin-left:30px;margin-right:5px;margin-bottom:-7px;"/>Youtube</span><br />
													<input type="url" value="<?php echo $infobio['youtube']; ?>" maxlength="300" class="infodivmembre2imgform" id="urlupdateyoutube" />
													<img src="images/validerotherlien.png" alt="Modifier" onclick="updateyoutube()" class="infodivmembre2imgformimgvalider" />
												</div>
												
												<p class="xhrlienajouter" id="xhrlienmodifieryoutube"></p>
												
												<script>
													
													function updateyoutube()
													{
														var xhr = new XMLHttpRequest();
														var url = document.querySelector('#urlupdateyoutube').value;
														
														xhr.open('GET', 'site/phppageprofil.php?updateyoutube=' + url);
														
														xhr.onreadystatechange = function()
														{
															if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
															{
																document.getElementById("xhrlienmodifieryoutube").innerHTML = xhr.responseText;
																lienmodifieryoutube(url)
															}
														};
														
														xhr.send(null);
													}
													
													function lienmodifieryoutube(url)
													{
														if(document.getElementById("xhrlienmodifieryoutube").innerHTML == "Lien modifier")
														{
															setTimeout(function(){document.getElementById("divurlupdateyoutube").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlupdateyoutube").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlupdateyoutube").style.opacity="0";},100 )
															document.getElementById("infodivmembre2lienxhrupdateyoutubeurl").href = url;
															setTimeout(function(){document.getElementById("xhrlienmodifieryoutube").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifieryoutube").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifieryoutube").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienmodifieryoutube").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienmodifieryoutube").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienmodifieryoutube").style.display="none";},13000 )
															document.getElementById("urlupdateyoutube").href = url;
															setTimeout(function(){document.getElementById("divurlupdateyoutube").style.height="110px";},13300 )
															setTimeout(function(){document.getElementById("divurlupdateyoutube").style.display="block";},13000 )
															setTimeout(function(){document.getElementById("divurlupdateyoutube").style.opacity="1";},13400 )
														}
														else if(document.getElementById("xhrlienmodifieryoutube").innerHTML == "Lien supprimer")
														{
															setTimeout(function(){document.getElementById("divurlupdateyoutube").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlupdateyoutube").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlupdateyoutube").style.opacity="0";},100 )
															setTimeout(function(){document.getElementById("infodivmembre2lienxhrupdateyoutube").style.display="none";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifieryoutube").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifieryoutube").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifieryoutube").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienmodifieryoutube").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienmodifieryoutube").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienmodifieryoutube").style.display="none";},13000 )
														}
													}
													
												</script>
											<?php
											}
											
											if(isset($infobio['snapchat']) AND $infobio['snapchat'] != 'NULL')
											{
											?>
												<div id="divurlupdatesnapchat" style="display;block;opacity:none;height:110px;transition: all 0.4s;">
													<span class="infodivmembre2imgspan"><img src="images/logosnap.png" alt="Snapchat" class="infodivmembre2img" style="width:35px;max-height:35px;margin-left:30px;margin-right:5px;margin-bottom:-7px;"/>Snapchat</span><br />
													<input type="url" value="<?php echo $infobio['snapchat']; ?>" maxlength="300" class="infodivmembre2imgform" id="urlupdatesnapchat" />
													<img src="images/validerotherlien.png" alt="Modifier" onclick="updatesnapchat()" class="infodivmembre2imgformimgvalider" />
												</div>
												
												<p class="xhrlienajouter" id="xhrlienmodifiersnapchat"></p>
												
												<script>
													
													function updatesnapchat()
													{
														var xhr = new XMLHttpRequest();
														var url = document.querySelector('#urlupdatesnapchat').value;
														
														xhr.open('GET', 'site/phppageprofil.php?updatesnapchat=' + url);
														
														xhr.onreadystatechange = function()
														{
															if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
															{
																document.getElementById("xhrlienmodifiersnapchat").innerHTML = xhr.responseText;
																lienmodifiersnapchat(url)
															}
														};
														
														xhr.send(null);
													}
													
													function lienmodifiersnapchat(url)
													{
														if(document.getElementById("xhrlienmodifiersnapchat").innerHTML == "Lien modifier")
														{
															setTimeout(function(){document.getElementById("divurlupdatesnapchat").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlupdatesnapchat").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlupdatesnapchat").style.opacity="0";},100 )
															document.getElementById("infodivmembre2lienxhrupdatesnapchaturl").href = url;
															setTimeout(function(){document.getElementById("xhrlienmodifiersnapchat").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiersnapchat").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiersnapchat").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienmodifiersnapchat").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienmodifiersnapchat").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienmodifiersnapchat").style.display="none";},13000 )
															document.getElementById("urlupdatesnapchat").href = url;
															setTimeout(function(){document.getElementById("divurlupdatesnapchat").style.height="110px";},13300 )
															setTimeout(function(){document.getElementById("divurlupdatesnapchat").style.display="block";},13000 )
															setTimeout(function(){document.getElementById("divurlupdatesnapchat").style.opacity="1";},13400 )
														}
														else if(document.getElementById("xhrlienmodifiersnapchat").innerHTML == "Lien supprimer")
														{
															setTimeout(function(){document.getElementById("divurlupdatesnapchat").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlupdatesnapchat").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlupdatesnapchat").style.opacity="0";},100 )
															setTimeout(function(){document.getElementById("infodivmembre2lienxhrupdatesnapchat").style.display="none";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiersnapchat").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiersnapchat").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiersnapchat").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienmodifiersnapchat").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienmodifiersnapchat").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienmodifiersnapchat").style.display="none";},13000 )
														}
													}
													
												</script>
											<?php
											}
											
											if(isset($infobio['twitch']) AND $infobio['twitch'] != 'NULL')
											{
											?>
												<div id="divurlupdatetwitch" style="display;block;opacity:none;height:110px;transition: all 0.4s;">
													<span class="infodivmembre2imgspan"><img src="images/logotwitch.png" alt="Twitch" class="infodivmembre2img" style="width:35px;max-height:35px;margin-left:30px;margin-right:5px;margin-bottom:-7px;"/>Twitch</span><br />
													<input type="url" value="<?php echo $infobio['twitch']; ?>" maxlength="300" class="infodivmembre2imgform" id="urlupdatetwitch" />
													<img src="images/validerotherlien.png" alt="Modifier" onclick="updatetwitch()" class="infodivmembre2imgformimgvalider" />
												</div>
												
												<p class="xhrlienajouter" id="xhrlienmodifiertwitch"></p>
												
												<script>
													
													function updatetwitch()
													{
														var xhr = new XMLHttpRequest();
														var url = document.querySelector('#urlupdatetwitch').value;
														
														xhr.open('GET', 'site/phppageprofil.php?updatetwitch=' + url);
														
														xhr.onreadystatechange = function()
														{
															if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
															{
																document.getElementById("xhrlienmodifiertwitch").innerHTML = xhr.responseText;
																lienmodifiertwitch(url)
															}
														};
														
														xhr.send(null);
													}
													
													function lienmodifiertwitch(url)
													{
														if(document.getElementById("xhrlienmodifiertwitch").innerHTML == "Lien modifier")
														{
															setTimeout(function(){document.getElementById("divurlupdatetwitch").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlupdatetwitch").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlupdatetwitch").style.opacity="0";},100 )
															document.getElementById("infodivmembre2lienxhrupdatetwitchurl").href = url;
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitch").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitch").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitch").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitch").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitch").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitch").style.display="none";},13000 )
															document.getElementById("urlupdatetwitch").href = url;
															setTimeout(function(){document.getElementById("divurlupdatetwitch").style.height="110px";},13300 )
															setTimeout(function(){document.getElementById("divurlupdatetwitch").style.display="block";},13000 )
															setTimeout(function(){document.getElementById("divurlupdatetwitch").style.opacity="1";},13400 )
														}
														else if(document.getElementById("xhrlienmodifiertwitch").innerHTML == "Lien supprimer")
														{
															setTimeout(function(){document.getElementById("divurlupdatetwitch").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlupdatetwitch").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlupdatetwitch").style.opacity="0";},100 )
															setTimeout(function(){document.getElementById("infodivmembre2lienxhrupdatetwitch").style.display="none";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitch").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitch").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitch").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitch").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitch").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienmodifiertwitch").style.display="none";},13000 )
														}
													}
													
												</script>
											<?php
											}
											
											if(isset($infobio['facebook']) AND $infobio['facebook'] != 'NULL')
											{
											?>
												<div id="divurlupdatefacebook" style="display;block;opacity:none;height:110px;transition: all 0.4s;">
													<span class="infodivmembre2imgspan"><img src="images/logofb.png" alt="Facebook" class="infodivmembre2img" style="width:35px;max-height:35px;margin-left:30px;margin-right:5px;margin-bottom:-7px;"/>Facebook</span><br />
													<input type="url" value="<?php echo $infobio['facebook']; ?>" maxlength="300" class="infodivmembre2imgform" id="urlupdatefacebook" />
													<img src="images/validerotherlien.png" alt="Modifier" onclick="updatefacebook()" class="infodivmembre2imgformimgvalider" />
												</div>
												
												<p class="xhrlienajouter" id="xhrlienmodifierfacebook"></p>
												
												<script>
													
													function updatefacebook()
													{
														var xhr = new XMLHttpRequest();
														var url = document.querySelector('#urlupdatefacebook').value;
														
														xhr.open('GET', 'site/phppageprofil.php?updatefacebook=' + url);
														
														xhr.onreadystatechange = function()
														{
															if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
															{
																document.getElementById("xhrlienmodifierfacebook").innerHTML = xhr.responseText;
																lienmodifierfacebook(url)
															}
														};
														
														xhr.send(null);
													}
													
													function lienmodifierfacebook(url)
													{
														if(document.getElementById("xhrlienmodifierfacebook").innerHTML == "Lien modifier")
														{
															setTimeout(function(){document.getElementById("divurlupdatefacebook").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlupdatefacebook").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlupdatefacebook").style.opacity="0";},100 )
															document.getElementById("infodivmembre2lienxhrupdatefacebookurl").href = url;
															setTimeout(function(){document.getElementById("xhrlienmodifierfacebook").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifierfacebook").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifierfacebook").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienmodifierfacebook").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienmodifierfacebook").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienmodifierfacebook").style.display="none";},13000 )
															document.getElementById("urlupdatefacebook").href = url;
															setTimeout(function(){document.getElementById("divurlupdatefacebook").style.height="110px";},13300 )
															setTimeout(function(){document.getElementById("divurlupdatefacebook").style.display="block";},13000 )
															setTimeout(function(){document.getElementById("divurlupdatefacebook").style.opacity="1";},13400 )
														}
														else if(document.getElementById("xhrlienmodifierfacebook").innerHTML == "Lien supprimer")
														{
															setTimeout(function(){document.getElementById("divurlupdatefacebook").style.height="0px";},200 )
															setTimeout(function(){document.getElementById("divurlupdatefacebook").style.display="none";},500 )
															setTimeout(function(){document.getElementById("divurlupdatefacebook").style.opacity="0";},100 )
															setTimeout(function(){document.getElementById("infodivmembre2lienxhrupdatefacebook").style.display="none";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifierfacebook").style.display="block";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifierfacebook").style.marginTop="40px";},500 )
															setTimeout(function(){document.getElementById("xhrlienmodifierfacebook").style.opacity="1";},600 )
															setTimeout(function(){document.getElementById("xhrlienmodifierfacebook").style.opacity="0";},12000 )
															setTimeout(function(){document.getElementById("xhrlienmodifierfacebook").style.marginTop="0px";},12200 )
															setTimeout(function(){document.getElementById("xhrlienmodifierfacebook").style.display="none";},13000 )
														}
													}
													
												</script>
											<?php
											}
											
											if((!isset($infobio['instagram']) OR $infobio['instagram'] == 'NULL' OR $infobio['instagram'] == '') AND (!isset($infobio['twitter']) OR $infobio['twitter'] == 'NULL' OR $infobio['twitter'] == '') AND (!isset($infobio['youtube']) OR $infobio['youtube'] == 'NULL' OR $infobio['youtube'] == '') AND (!isset($infobio['snapchat']) OR $infobio['snapchat'] == 'NULL' OR $infobio['snapchat'] == '') AND (!isset($infobio['twitch']) OR $infobio['twitch'] == 'NULL' OR $infobio['twitch'] == '') AND (!isset($infobio['facebook']) OR $infobio['facebook'] == 'NULL' OR $infobio['facebook'] == ''))
											{
											?>
												<p class="xhrlienajouter" style="display:block;opacity:1;margin-top:65px;" >Aucun lien a modifier</p>
											<?php
											}
											?>
											<div style="height:60px;"></div>
										</div>
									</div>
									<div id="divjournalinfo">
										<div class="infodivmembre">
											<img src="membre/avatar/<?php echo $_SESSION['avatar']; ?>" alt="Avatar" style="width:45px;height:45px;margin-top:12px;" class="articleavatar"/>
										<?php
											if(mb_strlen($_SESSION['pseudo'], 'utf8') <= 17)
											{
											?>
												<span style="font-size:27px;top:-10px;margin-left:6px;" class="articlepseudo"><?php echo $pseudojournalinfo[0]; ?></span><br />
											<?php
											}
											else
											{
											?>
												<span style="font-size:27px;top:-10px;margin-left:6px;" class="articlepseudo" title="<?php echo $_SESSION['pseudo']; ?>"><?php echo $pseudojournalinfo[0]; ?></span><br />
											<?php
											}
										?>
										</div>
										<div class="infodivbio">
										<?php
											if(isset($infobio['bio']) AND $infobio['bio'] != 'NULL' AND $infobio['bio'] != '')
											{
											?>
												<span class="infodivmembre1" id="infodivmembre1" onclick="infodivmembre1()"><?php echo htmlspecialchars($infobio['bio']); ?></span>
												
												<script>
												
													document.querySelector("#infodivmembre1").onclick = function() 
													{ 
														if (window.getComputedStyle(document.querySelector('#divjournalinfobackground')).display=='none')
														{
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="1";},200 )
														}
														else
														{
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="1";},200 )
														}
													}
													
													document.querySelector("#infodivmembre1xhr").onclick = function() 
													{ 
														if (window.getComputedStyle(document.querySelector('#divjournalinfobackground')).display=='none')
														{
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.opacity="1";},200 )
															document.getElementById("journalinfobiotextareamodifierxhr").innerHTML = "<?php echo $infobio['bio']; ?>";
														}
														else
														{
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.opacity="1";},200 )
															document.getElementById("journalinfobiotextareamodifierxhr").innerHTML = "<?php echo $infobio['bio']; ?>";
														}
													}
													
												</script>
											<?php
											}
											else
											{
											?>
												<p class="infodivmembre1nobio" id="infodivmembre1nobio" onclick="infodivmembre1nobio()" >Ajouter une bio</p>
												
												<script>
												
													document.querySelector("#infodivmembre1nobio").onclick = function() 
													{ 
														if (window.getComputedStyle(document.querySelector('#divjournalinfobackground')).display=='none')
														{
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="1";},200 )
														}
														else
														{
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="1";},200 )
														}
													}
													
													document.querySelector("#infodivmembre1nobioxhr").onclick = function() 
													{ 
														if (window.getComputedStyle(document.querySelector('#divjournalinfobackground')).display=='none')
														{
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.opacity="1";},200 )
														}
														else
														{
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.display="block";},100 )
															setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.opacity="1";},200 )
														}
													}
													
												</script>
											<?php
											}
										?>
										</div>
										<div class="infodivmembre2">
											<img src="images/otherlien.png" alt="" class="infodivmembre2img" id="otherlien" style="cursor:pointer;position:absolute;left:4px;"/>
											<span class="infodivmembre2lien">
											<?php
												if(isset($infobio['instagram']) AND $infobio['instagram'] != 'NULL' AND $infobio['instagram'] != '')
												{
												?>
													<div id="infodivmembre2lienxhrupdateinstagram" style="display:inline-block;">
														<a href="<?php echo $infobio['instagram']; ?>" id="infodivmembre2lienxhrupdateinstagramurl" target="_blank"><img src="images/logoinsta.png" alt="Instagram" title="Instagram" class="infodivmembre2img"/></a>
													</div>
												<?php
												}
												?>
												<div id="infodivmembre2lienxhrinstagram" style="display:none;">
													<a href="instagram" target="_blank" id="infodivmembre2lienxhrinstagramurl"><img src="images/logoinsta.png" alt="Instagram" title="Instagram" class="infodivmembre2img"/></a>
												</div>
												<?php
												if(isset($infobio['twitter']) AND $infobio['twitter'] != 'NULL' AND $infobio['twitter'] != '')
												{
												?>
													<div id="infodivmembre2lienxhrupdatetwitter" style="display:inline-block;">
														<a href="<?php echo $infobio['twitter']; ?>" id="infodivmembre2lienxhrupdatetwitterurl" target="_blank"><img src="images/logotwitter.png" alt="Twitter" title="Twitter" class="infodivmembre2img"/></a>
													</div>
												<?php
												}
												?>
												<div id="infodivmembre2lienxhrtwitter" style="display:none;">
													<a href="twitter" target="_blank" id="infodivmembre2lienxhrtwitterurl"><img src="images/logotwitter.png" alt="Twitter" title="Twitter" class="infodivmembre2img"/></a>
												</div>
												<?php
												if(isset($infobio['youtube']) AND $infobio['youtube'] != 'NULL' AND $infobio['youtube'] != '')
												{
												?>
													<div id="infodivmembre2lienxhrupdateyoutube" style="display:inline-block;">
														<a href="<?php echo $infobio['youtube']; ?>" id="infodivmembre2lienxhrupdateyoutubeurl" target="_blank"><img src="images/logoyoutube.png" alt="Youtube" title="Youtube" class="infodivmembre2img"/></a>
													</div>
												<?php
												}
												?>
												<div id="infodivmembre2lienxhryoutube" style="display:none;">
													<a href="youtube" target="_blank" id="infodivmembre2lienxhryoutubeurl"><img src="images/logoyoutube.png" alt="Youtube" title="Youtube" class="infodivmembre2img"/></a>
												</div>
												<?php
												if(isset($infobio['snapchat']) AND $infobio['snapchat'] != 'NULL' AND $infobio['snapchat'] != '')
												{
												?>
													<div id="infodivmembre2lienxhrupdatesnapchat" style="display:inline-block;">
														<a href="<?php echo $infobio['snapchat']; ?>" id="infodivmembre2lienxhrupdatesnapchaturl" target="_blank"><img src="images/logosnap.png" alt="Snapchat" title="Snapchat" class="infodivmembre2img"/></a>
													</div>
												<?php
												}
												?>
												<div id="infodivmembre2lienxhrsnapchat" style="display:none;">
													<a href="snapchat" target="_blank" id="infodivmembre2lienxhrsnapchaturl"><img src="images/logosnap.png" alt="Snapchat" title="Snapchat" class="infodivmembre2img"/></a>
												</div>
												<?php
												if(isset($infobio['twitch']) AND $infobio['twitch'] != 'NULL' AND $infobio['twitch'] != '')
												{
												?>
													<div id="infodivmembre2lienxhrupdatetwitch" style="display:inline-block;">
														<a href="<?php echo $infobio['twitch']; ?>" id="infodivmembre2lienxhrupdatetwitchurl" target="_blank"><img src="images/logotwitch.png" alt="Twitch" title="Twitch" class="infodivmembre2img"/></a>
													</div>
												<?php
												}
												?>
												<div id="infodivmembre2lienxhrtwitch" style="display:none;">
													<a href="twitch" target="_blank" id="infodivmembre2lienxhrtwitchurl"><img src="images/logotwitch.png" alt="Twitch" title="Twitch" class="infodivmembre2img"/></a>
												</div>
												<?php
												if(isset($infobio['facebook']) AND $infobio['facebook'] != 'NULL' AND $infobio['facebook'] != '')
												{
												?>
													<div id="infodivmembre2lienxhrupdatefacebook" style="display:inline-block;">
														<a href="<?php echo $infobio['facebook']; ?>" id="infodivmembre2lienxhrupdatefacebookurl" target="_blank"><img src="images/logofb.png" alt="Facebook" title="Facebook" class="infodivmembre2img"/></a>
													</div>
												<?php
												}
												?>
												<div id="infodivmembre2lienxhrfacebook" style="display:none;">
													<a href="facebook" target="_blank" id="infodivmembre2lienxhrfacebookurl"><img src="images/logofb.png" alt="Facebook" title="Facebook" class="infodivmembre2img"/></a>
												</div>
												<?php
											?>
											</span>
											<span style="margin-right:10px;"></span>
										</div>
									</div>
									<script>
									
										function journalinfobiospanmodifier()
										{
											var xhr = new XMLHttpRequest();
											var modifierbio = document.querySelector('.journalinfobiotextarea').value;
											
											var modifierbio = encodeURIComponent(modifierbio);
											
											xhr.open('GET', 'site/phppageprofil.php?modifierbio=' + modifierbio);
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0";},100 )
													setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="0";},100 )
													document.querySelector('.infodivbio').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
										
										function journalinfobiospanmodifierxhr()
										{
											var xhr = new XMLHttpRequest();
											var modifierbio = document.querySelector('#journalinfobiotextareamodifierxhr').value;
											
											var modifierbio = encodeURIComponent(modifierbio);
											
											xhr.open('GET', 'site/phppageprofil.php?modifierbio=' + modifierbio);
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0";},100 )
													setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.opacity="0";},100 )
													document.querySelector('.infodivbio').innerHTML = xhr.responseText;
													
													var value = document.getElementById("infodivmembre1xhr").value;
													document.getElementById("journalinfobiotextareamodifierxhr").innerHTML = value;
												}
											};
											
											xhr.send(null);
										}
										
										function journalinfobiospanajouter()
										{
											var xhr = new XMLHttpRequest();
											var bio = document.querySelector('.journalinfobiotextarea').value;
											
											var bio = encodeURIComponent(bio);
											
											xhr.open('GET', 'site/phppageprofil.php?ajouterbio=' + bio);
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0";},100 )
													setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="0";},100 )
													document.querySelector('.infodivbio').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
										
										function journalinfobiospanajouterxhr()
										{
											var xhr = new XMLHttpRequest();
											var bio = document.querySelector('#journalinfobiotextareaajouterxhr').value;
											
											var bio = encodeURIComponent(bio);
											
											xhr.open('GET', 'site/phppageprofil.php?ajouterbio=' + bio);
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0";},100 )
													setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.display="none";},500 )
													setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.opacity="0";},100 )
													document.querySelector('.infodivbio').innerHTML = xhr.responseText;
													document.getElementById("journalinfobiotextareamodifierxhr").innerHTML = "<?php echo $infobio['bio']; ?>";
												}
											};
											
											xhr.send(null);
										}
										
										function infodivmembre1()
										{
											if (window.getComputedStyle(document.querySelector('#divjournalinfobackground')).display=='none')
											{
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="1";},200 )
											}
											else
											{
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="1";},200 )
											}
										}
										
										function infodivmembre1xhr()
										{
											if (window.getComputedStyle(document.querySelector('#divjournalinfobackground')).display=='none')
											{
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.opacity="1";},200 )
												document.getElementById("journalinfobiotextareamodifierxhr").innerHTML = "<?php echo $infobio['bio']; ?>";
											}
											else
											{
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.opacity="1";},200 )
												document.getElementById("journalinfobiotextareamodifierxhr").innerHTML = "<?php echo $infobio['bio']; ?>";
											}
										}
										
										function infodivmembre1nobio()
										{
											if (window.getComputedStyle(document.querySelector('#divjournalinfobackground')).display=='none')
											{
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="1";},200 )
											}
											else
											{
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="1";},200 )
											}
										}
										
										function infodivmembre1nobioxhr()
										{
											if (window.getComputedStyle(document.querySelector('#divjournalinfobackground')).display=='none')
											{
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.opacity="1";},200 )
											}
											else
											{
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.display="block";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.opacity="1";},200 )
											}
										}
										
										document.querySelector("#divjournalinfobackground").onclick = function() 
										{ 
											if (window.getComputedStyle(document.querySelector('#divjournalinfobackground')).display=='block')
											{
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="0";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.opacity="0";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.opacity="0";},100 )
												setTimeout(function(){document.getElementById("divjournalotherlien").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalotherlien").style.opacity="0";},100 )
											}
											else
											{
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="0";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.opacity="0";},100 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.opacity="0";},100 )
												setTimeout(function(){document.getElementById("divjournalotherlien").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalotherlien").style.opacity="0";},100 )
											}
										}
										
										function journalinfobiospanannuler()
										{
											setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0";},100 )
											setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divjournalinfodeletearticle").style.opacity="0";},100 )
										}
										
										function journalinfobiospanannulerxhrajouter()
										{
											setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0";},100 )
											setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrajouter").style.opacity="0";},100 )
										}
										
										function journalinfobiospanannulerxhrmodifier()
										{
											setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0";},100 )
											setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.display="none";},500 )
											setTimeout(function(){document.getElementById("divjournalinfodeletearticlexhrmodifier").style.opacity="0";},100 )
										}
										
										<?php
										if(isset($infobio['instagram']) AND $infobio['instagram'] !== 'NULL' AND isset($infobio['twitter']) AND $infobio['twitter'] !== 'NULL' AND isset($infobio['youtube']) AND $infobio['youtube'] !== 'NULL' AND isset($infobio['snapchat']) AND $infobio['snapchat'] !== 'NULL' AND isset($infobio['twitch']) AND $infobio['twitch'] !== 'NULL' AND isset($infobio['facebook']) AND $infobio['facebook'] !== 'NULL')
										{
										?>
											document.querySelector("#otherlien").onclick = function() 
											{ 
												if (window.getComputedStyle(document.querySelector('#divjournalotherlien')).display=='none')
												{
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
													setTimeout(function(){document.getElementById("divjournalotherlien").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divjournalotherlien").style.opacity="1";},200 )
													document.getElementById("divjournalotherliendiv1").style.display="none";
													document.getElementById("divjournalotherliendiv2").style.display="block";
													document.querySelector(".divjournalotherlienspan2").style.color="rgba(0,0,0,0.88)";
													document.querySelector(".divjournalotherlienspan1").style.color="rgba(0,0,0,0.35)";
												}
												else
												{
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
													setTimeout(function(){document.getElementById("divjournalotherlien").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divjournalotherlien").style.opacity="1";},200 )
													document.getElementById("divjournalotherliendiv1").style.display="none";
													document.getElementById("divjournalotherliendiv2").style.display="block";
													document.querySelector(".divjournalotherlienspan2").style.color="rgba(0,0,0,0.88)";
													document.querySelector(".divjournalotherlienspan1").style.color="rgba(0,0,0,0.35)";
												}
											}
										<?php
										}
										else
										{
										?>
											document.querySelector("#otherlien").onclick = function() 
											{ 
												if (window.getComputedStyle(document.querySelector('#divjournalotherlien')).display=='none')
												{
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
													setTimeout(function(){document.getElementById("divjournalotherlien").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divjournalotherlien").style.opacity="1";},200 )
													document.getElementById("divjournalotherliendiv1").style.display="block";
													document.getElementById("divjournalotherliendiv2").style.display="none";
													document.querySelector(".divjournalotherlienspan1").style.color="rgba(0,0,0,0.88)";
													document.querySelector(".divjournalotherlienspan2").style.color="rgba(0,0,0,0.35)";
												}
												else
												{
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0.35";},200 )
													setTimeout(function(){document.getElementById("divjournalotherlien").style.display="block";},100 )
													setTimeout(function(){document.getElementById("divjournalotherlien").style.opacity="1";},200 )
													document.getElementById("divjournalotherliendiv1").style.display="block";
													document.getElementById("divjournalotherliendiv2").style.display="none";
													document.querySelector("divjournalotherlienspan1").style.color="rgba(0,0,0,0.88)";
													document.querySelector("divjournalotherlienspan2").style.color="rgba(0,0,0,0.35)";
												}
											}
										<?php
										}
										?>
										
										document.querySelector(".divjournalotherlienimgclose").onclick = function() 
										{ 
											if (window.getComputedStyle(document.querySelector('#divjournalotherlien')).display=='block')
											{
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0";},100 )
												setTimeout(function(){document.getElementById("divjournalotherlien").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalotherlien").style.opacity="0";},100 )
											}
											else
											{
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalinfobackground").style.opacity="0";},100 )
												setTimeout(function(){document.getElementById("divjournalotherlien").style.display="none";},500 )
												setTimeout(function(){document.getElementById("divjournalotherlien").style.opacity="0";},100 )
											}
										}
										
										document.querySelector(".divjournalotherlienspan1").onclick = function() 
										{ 
											if (window.getComputedStyle(document.querySelector('#divjournalotherliendiv1')).display=='none')
											{
												document.getElementById("divjournalotherliendiv1").style.display="block";
												document.querySelector(".divjournalotherlienspan1").style.color="rgba(0,0,0,0.88)";
												document.querySelector(".divjournalotherlienspan2").style.color="rgba(0,0,0,0.35)";
												document.getElementById("divjournalotherliendiv2").style.display="none";
											}
											else
											{
												document.getElementById("divjournalotherliendiv1").style.display="block";
												document.querySelector(".divjournalotherlienspan1").style.color="rgba(0,0,0,0.88)";
												document.querySelector(".divjournalotherlienspan2").style.color="rgba(0,0,0,0.35)";
												document.getElementById("divjournalotherliendiv2").style.display="none";
											}
										}
										
										document.querySelector(".divjournalotherlienspan2").onclick = function() 
										{ 
											if (window.getComputedStyle(document.querySelector('#divjournalotherliendiv2')).display=='none')
											{
												document.getElementById("divjournalotherliendiv2").style.display="block";
												document.querySelector(".divjournalotherlienspan2").style.color="rgba(0,0,0,0.88)";
												document.querySelector(".divjournalotherlienspan1").style.color="rgba(0,0,0,0.35)";
												document.getElementById("divjournalotherliendiv1").style.display="none";
											}
											else
											{
												document.getElementById("divjournalotherliendiv2").style.display="block";
												document.querySelector(".divjournalotherlienspan2").style.color="rgba(0,0,0,0.88)";
												document.querySelector(".divjournalotherlienspan1").style.color="rgba(0,0,0,0.35)";
												document.getElementById("divjournalotherliendiv1").style.display="none";
											}
										}
										
									</script>
								</div>
							</div>
						</div>
						<div id="blockactualitenavigation">
						
							<div id="blockactualiteleft">
								<div class="selectiontrier">
									<span class="trierpar">Trier par :</span>
									<span class="recent">Récent</span>
									<span class="alaune">À la une</span>
									<span class="chevron">></span>
								</div>
								<div class="propositiontrier">
									<a href="#body" style="text-decoration:none;"><span id="trierparrecent" class="propositiontrierrecent">Récent</span></a>
									<a href="#body" style="text-decoration:none;"><span id="trierparalaune" class="propositiontrieralaune">À la une</span></a>
								</div>
								
								<?php
									
									$countnbanime = $db->query('SELECT COUNT(*) AS nbanime FROM animes');
									$nbanime = $countnbanime->fetch();
									
								?>
								
								<div class="blockactualiteanime" id="blockactualiteanime">
									<img src="images/iconeanimes.png" alt="Image" class="animeimg" />
									<span class="animespan">Animes</span>
									<span class="animespannb"><?php echo $nbanime['nbanime']; ?></span>
								</div>
								<div class="blockactualiteanimecontenu" id="blockactualiteanimecontenu">
								<?php
									$selectanimeabonner = $db->query('SELECT * FROM animes ORDER BY nbabonner DESC');
									while($animeabonner = $selectanimeabonner->fetch())
									{
										if(mb_strlen($animeabonner['titre'], 'utf8') <= 17)
										{
											$titreanimeabonner[0] = $animeabonner['titre'];
										}
										else
										{
											$titreanime = mb_substr($animeabonner['titre'], 0, 14, 'utf8');
											
											$titreanimeabonner[0] = $titreanime . "..."; 
										}
								?>
									<div class="animecontenu">
										<div class="animecontenudivimg" style="background: url(anime/<?php echo $animeabonner['image']; ?>)no-repeat;background-size: cover;">
										</div>
										<?php
											if(mb_strlen($animeabonner['titre'], 'utf8') <= 17)
											{
											?>
												<span class="animecontenutitre"><?php echo $titreanimeabonner[0]; ?></span><br />
											<?php
											}
											else
											{
											?>
												<span class="animecontenutitre" title="<?php echo $animeabonner['titre']; ?>"><?php echo $titreanimeabonner[0]; ?></span><br />
											<?php
											}
										?>
										<span class="animecontenunbabonne" id="animecontenunbabonne<?php echo $animeabonner['ID']; ?>"><?php echo $animeabonner['nbabonner']; ?></span><br />
										<?php
											$searchabonnement = $db->query('SELECT * FROM abonneranime WHERE IDanime=\'' . $animeabonner['ID'] .  '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
											$abonnement = $searchabonnement->rowCount();
											if($abonnement == 0)
											{
											?>
												<span onclick="animecontenusuivreimg<?php echo $animeabonner['ID']; ?>()"><img src="images/ajouteranime.png" alt="Suivre" class="animecontenusuivreimg" id="animecontenusuivreimg<?php echo $animeabonner['ID']; ?>" /></span>
												
												<img src="images/validerajouteranime.png" alt="Abonner" class="animecontenusuivreimg" id="suivreimgdisplay<?php echo $animeabonner['ID']; ?>" style="display:none;" />
											<?php
											}
											else
											{
											?>
												<img src="images/validerajouteranime.png" alt="Abonner" class="animecontenusuivreimg" />
											<?php
											}
										?>
									</div>
								<?php
									}
									$selectanimeabonner->closeCursor();
								?>
									<script>
								<?php
									$selectanimeabonnerjs = $db->query('SELECT * FROM animes ORDER BY nbabonner DESC');
									while($animeabonnerjs = $selectanimeabonnerjs->fetch())
									{
									?>
										function animecontenusuivreimg<?php echo $animeabonnerjs['ID']; ?>()
										{
											var xhr = new XMLHttpRequest();
										
											xhr.open('GET', 'site/phpparametreactualite.php?suivreanime=<?php echo $animeabonnerjs['ID']; ?>');
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.getElementById('animecontenusuivreimg<?php echo $animeabonnerjs['ID'];?>').style.display="none";
													document.getElementById('suivreimgdisplay<?php echo $animeabonnerjs['ID'];?>').style.display="inline-block";
													document.getElementById('animecontenunbabonne<?php echo $animeabonnerjs['ID'];?>').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
									<?php
									}
									$selectanimeabonnerjs->closeCursor();
								?>
									</script>
								</div>
								<?php 
									$searchnbmembre = $db->query('SELECT COUNT(*) AS nbmembre FROM membres');
									$nbmembre = $searchnbmembre->fetch();
								?>
								<div class="blockactualitemembre" id="blockactualitemembre">
									<img src="images/iconemembres.png" alt="Image" class="animeimg" />
									<span class="animespan">Membres</span>
									<span class="animespannb"><?php echo $nbmembre['nbmembre']; ?></span>
								</div>
								<div class="blockactualitemembrecontenu" id="blockactualitemembrecontenu">
									<?php
									$selectmembreabonner = $db->query('SELECT * FROM membres ORDER BY nbabonner DESC');
									while($membreabonner = $selectmembreabonner->fetch())
									{
										$membreabonnervb = html_entity_decode($membreabonner['pseudo']);
										
										if(mb_strlen($membreabonnervb, 'utf8') <= 15)
										{
											$titremembreabonner[0] = $membreabonnervb;
										}
										else
										{
											$titremembre = mb_substr($membreabonnervb, 0, 12, 'utf8');
											
											$titremembreabonner[0] = $titremembre . "..."; 
										}
								?>
									<div class="animecontenu">
										<a href="profil.php?id=<?php echo $membreabonner['ID']; ?>"><div class="animecontenudivimg" style="background: url(membre/avatar/<?php echo $membreabonner['avatar']; ?>)no-repeat;background-size: cover;">
										</div></a>
										<?php
											if(mb_strlen($membreabonnervb, 'utf8') <= 15)
											{
											?>
												<a href="profil.php?id=<?php echo $membreabonner['ID']; ?>"><span class="animecontenutitre"><?php echo htmlspecialchars($titremembreabonner[0]); ?></span></a><br />
											<?php
											}
											else
											{
											?>
												<a href="profil.php?id=<?php echo $membreabonner['ID']; ?>"><span class="animecontenutitre" title="<?php echo htmlspecialchars($membreabonner['pseudo']); ?>"><?php echo htmlspecialchars($titremembreabonner[0]); ?></span></a><br />
											<?php
											}
										?>
										<span class="animecontenunbabonne" id="membrecontenunbabonne<?php echo $membreabonner['ID']; ?>"><?php echo $membreabonner['nbabonner']; ?></span><br />
										<?php
											$searchabonnementmembre = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $membreabonner['ID'] .  '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
											$abonnementmembre = $searchabonnementmembre->rowCount();
											if($abonnementmembre == 0 AND $membreabonner['ID'] != $_SESSION['ID'])
											{
											?>
												<span onclick="membrecontenusuivreimg<?php echo $membreabonner['ID']; ?>()"><img src="images/ajouteranime.png" alt="Suivre" class="animecontenusuivreimg" id="membrecontenusuivreimg<?php echo $membreabonner['ID']; ?>" /></span>
												
												<img src="images/validerajouteranime.png" alt="Abonner" class="animecontenusuivreimg" id="suivreimgdisplaymembre<?php echo $membreabonner['ID']; ?>" style="display:none;" />
											<?php
											}
											else if($abonnementmembre == 1 AND $membreabonner['ID'] != $_SESSION['ID'])
											{
											?>
												<img src="images/validerajouteranime.png" alt="Abonner" class="animecontenusuivreimg" />
											<?php
											}
										?>
									</div>
								<?php
									}
									$selectmembreabonner->closeCursor();
								?>
									<script>
								<?php
									$selectmembreabonnerjs = $db->query('SELECT * FROM membres ORDER BY nbabonner DESC');
									while($membreabonnerjs = $selectmembreabonnerjs->fetch())
									{
									?>
										function membrecontenusuivreimg<?php echo $membreabonnerjs['ID']; ?>()
										{
											var xhr = new XMLHttpRequest();
										
											xhr.open('GET', 'site/phpparametreactualite.php?suivremembre=<?php echo $membreabonnerjs['ID']; ?>');
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.getElementById('membrecontenusuivreimg<?php echo $membreabonnerjs['ID'];?>').style.display="none";
													document.getElementById('suivreimgdisplaymembre<?php echo $membreabonnerjs['ID'];?>').style.display="inline-block";
													document.getElementById('membrecontenunbabonne<?php echo $membreabonnerjs['ID'];?>').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
									<?php
									}
									$selectmembreabonnerjs->closeCursor();
								?>
									</script>
								</div>
								
								<script>
									document.querySelector(".selectiontrier").onclick = function() 
									{ 
										if (window.getComputedStyle(document.querySelector('.propositiontrier')).display=='none')
										{
											document.querySelector(".propositiontrier").style.display="block";
											document.querySelector(".chevron").style.transform="rotate(80deg)";
										}
										else
										{
											document.querySelector(".propositiontrier").style.display="none";
											document.querySelector(".chevron").style.transform="rotate(0deg)";
										}
									}
									
									$('a[href^="#"]').click(function(){
									var the_id = $(this).attr("href");
									$("body").mCustomScrollbar("scrollTo",$(the_id).offset().top -0, { scrollInertia: 1000 }); return false;});
									
									document.querySelector("#trierparalaune").onclick = function() 
									{
										var xhr = new XMLHttpRequest();
					
										xhr.open('GET', 'site/phpparametreactualite.php?trierparalaune=ok');
										
										xhr.onreadystatechange = function() 
										{
											if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.querySelector('.propositiontrier').style.marginTop="51px";
												document.querySelector('.propositiontrier').style.left="12px";
												document.querySelector('.propositiontrierrecent').style.width="60px";
												document.querySelector('.propositiontrierrecent').style.height="23px";
												document.querySelector(".propositiontrier").style.display="none";
												document.querySelector(".chevron").style.transform="rotate(0deg)";
												document.querySelector('.alaune').style.display="inline-block";
												document.querySelector('.recent').style.display="none";
												document.querySelector('.propositiontrieralaune').style.display="none";
												document.querySelector('.propositiontrierrecent').style.display="block";
												document.querySelector('#xhrresponsetext').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
									
									document.querySelector("#trierparrecent").onclick = function() 
									{
										var xhr = new XMLHttpRequest();
					
										xhr.open('GET', 'site/phpparametreactualite.php?trierparrecent=ok');
										
										xhr.onreadystatechange = function() 
										{
											if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.querySelector('.propositiontrier').style.marginTop="55px";
												document.querySelector('.propositiontrier').style.left="12px";
												document.querySelector('.propositiontrieralaune').style.width="65px";
												document.querySelector('.propositiontrieralaune').style.height="28px";
												document.querySelector(".propositiontrier").style.display="none";
												document.querySelector(".chevron").style.transform="rotate(0deg)";
												document.querySelector('.alaune').style.display="none";
												document.querySelector('.recent').style.display="inline-block";
												document.querySelector('.propositiontrieralaune').style.display="block";
												document.querySelector('.propositiontrierrecent').style.display="none";
												document.querySelector('#xhrresponsetext').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
									
									document.querySelector("#blockactualiteanime").onclick = function() 
									{ 
										if (window.getComputedStyle(document.querySelector('#blockactualiteanimecontenu')).height=='0px')
										{
											document.querySelector("#blockactualitemembrecontenu").style.height="0px";
											document.querySelector("#blockactualiteanimecontenu").style.height="422px";
										}
										else
										{
											document.querySelector("#blockactualitemembrecontenu").style.height="0px";
											document.querySelector("#blockactualiteanimecontenu").style.height="0px";
										}
									}
									
									document.querySelector("#blockactualitemembre").onclick = function() 
									{ 
										if (window.getComputedStyle(document.querySelector('#blockactualitemembrecontenu')).height=='0px')
										{
											document.querySelector("#blockactualiteanimecontenu").style.height="0px";
											document.querySelector("#blockactualitemembrecontenu").style.height="422px";
										}
										else
										{
											document.querySelector("#blockactualiteanimecontenu").style.height="0px";
											document.querySelector("#blockactualitemembrecontenu").style.height="0px";
										}
									}
									
								</script>
							</div>
							
							<div id="blockfilactualite">
							<div id="xhrresponsetext">
							<?php 
								
								$selectarcticleactualite = $db->query('SELECT * FROM articlepageanime ORDER BY ID DESC');
								
								while($articleactualite = $selectarcticleactualite->fetch())
								{
									if($articleactualite['IDanime'] == '0')
									{
										$imageanimearticle = 'images/avatarmetromanga.png';
										$titreanimearticle = 'Metro Manga';
									}
									else
									{
										$selectinfoanimearticle = $db->query('SELECT * FROM animes WHERE ID=\'' . $articleactualite['IDanime'] .  '\'');
										$infoanimearticle = $selectinfoanimearticle->fetch();
										
										$imageanimearticle = 'anime/' . htmlspecialchars($infoanimearticle['image']);
										$titreanimearticle = htmlspecialchars($infoanimearticle['titre']);
									}
									
								?>
								<div class="blockfilactualitearticle" id="blockfilactualitearticle<?php echo $articleactualite['ID']; ?>">
								<?php
									if($_SESSION['ID'] == '1')
									{
									?>
										<img src="images/supprimerrecherche2.png" alt="supprimer" class="deleteactualitearticle" id="deleteactualitearticle<?php echo $articleactualite['ID']; ?>" onclick="deleteactualitearticle<?php echo $articleactualite['ID']; ?>()" />								
									<?php
									}
								?>
									<div style="background: url(<?php echo $imageanimearticle; ?>)no-repeat;background-size: cover;" class="articleavatar"/></div>
									<span class="articlepseudo"><?php echo $titreanimearticle; ?></span><br />
									<?php
									$dateanimg = date("Y", strtotime($articleactualite['date_creation']));
									$datemoisimg = date("m", strtotime($articleactualite['date_creation']));
									$datedayimg = date("d", strtotime($articleactualite['date_creation']));
									$dateheureimg = date("H", strtotime($articleactualite['date_creation']));
									$dateminimg = date("i", strtotime($articleactualite['date_creation']));
									
									$dateannow = date('Y');
									$datemoisnow = date('m');
									$datedaynow = date('d');
									$dateheurenow = date('H');
									$dateminnow = date('i');
									
									$datean =  $dateannow - $dateanimg;
									$datemois = $datemoisnow - $datemoisimg;
									$datemois2 = $datemoisimg - $datemoisnow;
									$dateday = $datedaynow - $datedayimg;
									$dateheure = $dateheurenow - $dateheureimg;
									$datemin = $dateminnow - $dateminimg;
									
									$datemois3 = 12 - $datemois2;
									
									if($datean == 1 AND $datemois3 == 1 AND $dateday != 0)
									{
										$dateday2 = 31 - $datedayimg;
										$dateday3 = $dateday2 + $datedaynow;
										if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
										{
											$dateheure2 = 24 - $dateheureimg;
											$dateheure3 = $dateheure2 + $dateheurenow;
											if($dateheure3 >= 2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
											<?php
											}
											else if($dateheure3 == 1 AND $datemin >= 0)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
											<?php
											}
											else if($dateheure3 == 1 AND $datemin < 0)
											{
												$datemin2 = 60 + $datemin;
											?>
												<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
											<?php
											}
											else if($dateheure3 == 1 AND $datemin == 1)
											{
											?>
												<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
											<?php
											}
										}
										else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
										{
										?>
											<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
										<?php
										}
										else if($dateday3 >= 31)
										{
											if($articleactualite['date_delete'] == "1mois")
											{
												if($datemois3 == 1)
												{
													$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
													$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
													?>
													<script>
														autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
													</script>
													<?php
												}
											}
										?>
											<span class="articletemps">Il y a <?php echo $datemois3; ?> mois</span>
										<?php
										}else
										{
											if($articleactualite['date_delete'] == "2semaines")
											{
												if($dateday3 >= 14)
												{
													$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
													$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
													?>
													<script>
														autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
													</script>
													<?php
												}
											}
										?>
											<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
										<?php
										}
									}
									else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 0 AND $datemin == 0)
									{
										?>
											<span class="articletemps">À l'instant</span>
										<?php
									}
									else if($datean == 1 AND $datemois2 >= 2)
									{
										$datemois4 = 12 - $datemois2;
										
										if($articleactualite['date_delete'] == "6mois")
										{
											if($datemois4 == 6)
											{
												$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
												$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
												?>
												<script>
													autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
												</script>
												<?php
											}
										}
										?>
											<span class="articletemps">Il y a <?php echo $datemois4; ?> mois</span>
										<?php
									}
									else if($datean == 1 AND ($datemois >= 1 OR $datemois <= 1))
									{	
										if($articleactualite['date_delete'] == "1an")
										{
											if($datean == 1)
											{
												$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
												$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
												?>
												<script>
													autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
												</script>
												<?php
											}
										}
										?>
											<span class="articletemps">Il y a <?php echo $datean; ?> an</span>
										<?php
									}
									else if($datean >= 2)
									{
										?>
											<span class="articletemps">Il y a <?php echo $datean; ?> ans</span>
										<?php
									}
									else if($datemois == 0 AND $datean >= 1)
									{
										if($datean == 1)
										{
											if($articleactualite['date_delete'] == "1an")
											{
												if($datean == 1)
												{
													$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
													$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
													?>
													<script>
														autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
													</script>
													<?php
												}
											}
										?>
											<span class="articletemps">Il y a <?php echo $datean; ?> an</span>
										<?php
										}
										else if($datean >= 1)
										{
										?>
											<span class="articletemps">Il y a <?php echo $datean; ?> ans</span>
										<?php
										}
									}
									else if($datean == 0 AND $datemois >= 2)
									{
										if($articleactualite['date_delete'] == "6mois")
										{
											if($datemois == 6)
											{
												$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
												$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
												?>
												<script>
													autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
												</script>
												<?php
											}
										}
									?>
										<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
									<?php
									}
									else if($datean == 0 AND $datemois == 1 AND $dateday == 0)
									{
										if($articleactualite['date_delete'] == "1mois")
										{
											if($datemois == 1)
											{
												$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
												$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
												?>
												<script>
													autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
												</script>
												<?php
											}
										}
									?>
										<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
									<?php
									}
									else if($datean == 0 AND $datemois == 0 AND $dateday >= 1)
									{
										if($dateday >= 2)
										{
											if($articleactualite['date_delete'] == "2semaines")
											{
												if($dateday >= 14)
												{
													$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
													$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
													?>
													<script>
														autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
													</script>
													<?php
												}
											}
										?>
											<span class="articletemps">Il y a <?php echo $dateday; ?> jours</span>
										<?php
										}
										else if($dateday == 1 AND $dateheureimg > $dateheurenow)
										{
											$dateheure2 = 24 - $dateheureimg;
											$dateheure3 = $dateheure2 + $dateheurenow;
											if($dateheure3 >= 2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
											<?php
											}
											else if($dateheure3 == 1 AND $datemin >= 0)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
											<?php
											}
											else if($dateheure3 == 1 AND $datemin < 0)
											{
												$datemin2 = 60 + $datemin;
											?>
												<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
											<?php
											}
											else if($dateheure3 == 1 AND $datemin == 1)
											{
											?>
												<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
											<?php
											}
										}
										else if($dateday == 1 AND $dateheureimg <= $dateheurenow)
										{
										?>
											<span class="articletemps">Il y a <?php echo $dateday; ?> jour</span>
										<?php
										}
									}
									else if($datean == 0 AND $datemois == 1 AND $dateday != 0)
									{
										if($datemoisimg == 1)
										{
											$dateday2 = 31 - $datedayimg;
											$dateday3 = $dateday2 + $datedaynow;
											if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
											{
												$dateheure2 = 24 - $dateheureimg;
												$dateheure3 = $dateheure2 + $dateheurenow;
												if($dateheure3 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
												if($articleactualite['date_delete'] == "1mois")
												{
													if($datemois == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
												if($articleactualite['date_delete'] == "2semaines")
												{
													if($dateday3 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimg == 2)
										{
											$dateday2 = 28 - $datedayimg;
											$dateday3 = $dateday2 + $datedaynow;
											if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
											{
												$dateheure2 = 24 - $dateheureimg;
												$dateheure3 = $dateheure2 + $dateheurenow;
												if($dateheure3 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 28)
											{
												if($articleactualite['date_delete'] == "1mois")
												{
													if($datemois == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
												if($articleactualite['date_delete'] == "2semaines")
												{
													if($dateday3 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimg == 3)
										{
											$dateday2 = 31 - $datedayimg;
											$dateday3 = $dateday2 + $datedaynow;
											if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
											{
												$dateheure2 = 24 - $dateheureimg;
												$dateheure3 = $dateheure2 + $dateheurenow;
												if($dateheure3 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
												if($articleactualite['date_delete'] == "1mois")
												{
													if($datemois == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
												if($articleactualite['date_delete'] == "2semaines")
												{
													if($dateday3 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimg == 4)
										{
											$dateday2 = 30 - $datedayimg;
											$dateday3 = $dateday2 + $datedaynow;
											if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
											{
												$dateheure2 = 24 - $dateheureimg;
												$dateheure3 = $dateheure2 + $dateheurenow;
												if($dateheure3 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 30)
											{
												if($articleactualite['date_delete'] == "1mois")
												{
													if($datemois == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
												if($articleactualite['date_delete'] == "2semaines")
												{
													if($dateday3 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimg == 5)
										{
											$dateday2 = 31 - $datedayimg;
											$dateday3 = $dateday2 + $datedaynow;
											if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
											{
												$dateheure2 = 24 - $dateheureimg;
												$dateheure3 = $dateheure2 + $dateheurenow;
												if($dateheure3 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
												if($articleactualite['date_delete'] == "1mois")
												{
													if($datemois == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
												if($articleactualite['date_delete'] == "2semaines")
												{
													if($dateday3 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimg == 6)
										{
											$dateday2 = 30 - $datedayimg;
											$dateday3 = $dateday2 + $datedaynow;
											if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
											{
												$dateheure2 = 24 - $dateheureimg;
												$dateheure3 = $dateheure2 + $dateheurenow;
												if($dateheure3 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 30)
											{
												if($articleactualite['date_delete'] == "1mois")
												{
													if($datemois == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
												if($articleactualite['date_delete'] == "2semaines")
												{
													if($dateday3 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimg == 7)
										{
											$dateday2 = 31 - $datedayimg;
											$dateday3 = $dateday2 + $datedaynow;
											if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
											{
												$dateheure2 = 24 - $dateheureimg;
												$dateheure3 = $dateheure2 + $dateheurenow;
												if($dateheure3 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
												if($articleactualite['date_delete'] == "1mois")
												{
													if($datemois == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
												if($articleactualite['date_delete'] == "2semaines")
												{
													if($dateday3 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimg == 8)
										{
											$dateday2 = 31 - $datedayimg;
											$dateday3 = $dateday2 + $datedaynow;
											if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
											{
												$dateheure2 = 24 - $dateheureimg;
												$dateheure3 = $dateheure2 + $dateheurenow;
												if($dateheure3 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
												if($articleactualite['date_delete'] == "1mois")
												{
													if($datemois == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
												
												if($articleactualite['date_delete'] == "2semaines")
												{
													if($dateday3 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimg == 9)
										{
											$dateday2 = 30 - $datedayimg;
											$dateday3 = $dateday2 + $datedaynow;
											if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
											{
												$dateheure2 = 24 - $dateheureimg;
												$dateheure3 = $dateheure2 + $dateheurenow;
												if($dateheure3 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 30)
											{
												if($articleactualite['date_delete'] == "1mois")
												{
													if($datemois == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
												if($articleactualite['date_delete'] == "2semaines")
												{
													if($dateday3 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimg == 10)
										{
											$dateday2 = 31 - $datedayimg;
											$dateday3 = $dateday2 + $datedaynow;
											if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
											{
												$dateheure2 = 24 - $dateheureimg;
												$dateheure3 = $dateheure2 + $dateheurenow;
												if($dateheure3 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
												if($articleactualite['date_delete'] == "1mois")
												{
													if($datemois == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
												if($articleactualite['date_delete'] == "2semaines")
												{
													if($dateday3 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimg == 11)
										{
											$dateday2 = 30 - $datedayimg;
											$dateday3 = $dateday2 + $datedaynow;
											if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
											{
												$dateheure2 = 24 - $dateheureimg;
												$dateheure3 = $dateheure2 + $dateheurenow;
												if($dateheure3 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 30)
											{
												if($articleactualite['date_delete'] == "1mois")
												{
													if($datemois == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
												if($articleactualite['date_delete'] == "2semaines")
												{
													if($dateday3 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimg == 12)
										{
											$dateday2 = 31 - $datedayimg;
											$dateday3 = $dateday2 + $datedaynow;
											if($dateday3 == 1 AND $dateheureimg > $dateheurenow)
											{
												$dateheure2 = 24 - $dateheureimg;
												$dateheure3 = $dateheure2 + $dateheurenow;
												if($dateheure3 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
												if($articleactualite['date_delete'] == "1mois")
												{
													if($datemois == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
												if($articleactualite['date_delete'] == "2semaines")
												{
													if($dateday3 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
														?>
														<script>
															autodeletearticle<?php echo $articleactualite['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
									}
									else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $datemin == 1)
									{
										if($dateheure == 0)
										{
										?>
											<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
										<?php
										}
										else if($dateheure == 1)
										{
										?>
											<span class="articletemps">Il y a <?php echo $datemin; ?> minute</span>
										<?php
										}
									}
									else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 0)
									{
										if($datemin >= 2)
										{
										?>
											<span class="articletemps">Il y a <?php echo $datemin; ?> minutes</span>
										<?php
										}
									}
									else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 1 AND $datemin < 0 )
									{
										$datemin2 = 60 + $datemin;
									?>
										<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
									<?php
									}
									else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 1 AND $datemin >= 0 )
									{
										$datemin2 = 60 + $datemin;
									?>
										<span class="articletemps">Il y a <?php echo $dateheure; ?> heure</span>
									<?php
									}
									else if($dateheure >= 2)
									{
									?>
										<span class="articletemps">Il y a <?php echo $dateheure; ?> heures</span>
									<?php
									}
								?>
									<div class="articlesujet"><?php echo html_entity_decode($articleactualite['contenu']); ?></div><br />
									<div class="articleblockaime">
									<?php 
										$searchnoteexist = $db->query('SELECT * FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
										$noteexist = $searchnoteexist->rowCount();
										if($noteexist == 1)
										{
										?>
											<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimepas<?php echo $articleactualite['ID']; ?>" onclick="articleimgaimepas<?php echo $articleactualite['ID']; ?>()" />
											
											<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaime<?php echo $articleactualite['ID']; ?>" onclick="articleimgaime<?php echo $articleactualite['ID']; ?>()" style="opacity:0.65;display:none;" />
										<?php
										}
										else
										{
										?>
											<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaime<?php echo $articleactualite['ID']; ?>" onclick="articleimgaime<?php echo $articleactualite['ID']; ?>()" style="opacity:0.65;" />
										
											<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimepas<?php echo $articleactualite['ID']; ?>" onclick="articleimgaimepas<?php echo $articleactualite['ID']; ?>()" style="display:none;" />
										<?php
										}
									?>
										<span class="articlenbaime" id="articlenbaime<?php echo $articleactualite['ID']; ?>"><?php echo htmlspecialchars($articleactualite['note']); ?></span>
									</div>
								</div>
								<?php
								}
								$selectarcticleactualite->closeCursor();
							?>
							
							<script>
							<?php
								$selectarcticleactualitejs = $db->query('SELECT * FROM articlepageanime ORDER BY ID DESC');
								while($articleactualitejs = $selectarcticleactualitejs->fetch())
								{
								
									if($_SESSION['ID'] == '1')
									{
								?>
								
									function deleteactualitearticle<?php echo $articleactualitejs['ID']; ?>()
									{
										var xhr = new XMLHttpRequest();
										
										xhr.open('GET', 'site/phpparametreactualite.php?deletearticle=<?php echo $articleactualitejs['ID']; ?>');
										
										xhr.onreadystatechange = function()
										{
											if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.getElementById('blockfilactualitearticle<?php echo $articleactualitejs['ID'];?>').style.transition="all 0.4s";
												document.getElementById('blockfilactualitearticle<?php echo $articleactualitejs['ID'];?>').style.opacity="1";
												setTimeout(function(){document.getElementById("blockfilactualitearticle<?php echo $articleactualitejs['ID'];?>").style.display="none";},200 )
												setTimeout(function(){document.getElementById("blockfilactualitearticle<?php echo $articleactualitejs['ID'];?>").style.opacity="0";},100 )
											}
										};
										
										xhr.send(null);
									}
								
								<?php
									}
								?>
								
									function articleimgaime<?php echo $articleactualitejs['ID']; ?>()
									{
										var xhr = new XMLHttpRequest();
										
										xhr.open('GET', 'site/phpparametreactualite.php?articlenoteaime=<?php echo $articleactualitejs['ID']; ?>');
										
										xhr.onreadystatechange = function()
										{
											if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.getElementById('articleimgaime<?php echo $articleactualitejs['ID'];?>').style.display="none";
												document.getElementById('articleimgaimepas<?php echo $articleactualitejs['ID'];?>').style.display="inline-block";
												document.getElementById('articlenbaime<?php echo $articleactualitejs['ID'];?>').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
									
									function articleimgaimepas<?php echo $articleactualitejs['ID']; ?>()
									{
										var xhr = new XMLHttpRequest();
										
										xhr.open('GET', 'site/phpparametreactualite.php?articlenoteaimepas=<?php echo $articleactualitejs['ID']; ?>');
										
										xhr.onreadystatechange = function()
										{
											if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.getElementById('articleimgaimepas<?php echo $articleactualitejs['ID'];?>').style.display="none";
												document.getElementById('articleimgaime<?php echo $articleactualitejs['ID'];?>').style.display="inline-block";
												document.getElementById('articlenbaime<?php echo $articleactualitejs['ID'];?>').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
									
									function autodeletearticle<?php echo $articleactualitejs['ID']; ?>()
									{
										document.getElementById('blockfilactualitearticle<?php echo $articleactualitejs['ID'];?>').style.display="none";
									}
									
								<?php	
								}
								$selectarcticleactualitejs->closeCursor();
								?>
							</script>
							</div>
							</div>
							
						</div>
						
						<div id="blockabonnementnavigation">
							
							<div id="blockactualiteleft">
								<div class="selectiontrier2">
									<span class="trierpar2">Trier par :</span>
									<span class="alaune2">À la une</span>
									<span class="recent2">Récent</span>
									<span class="chevron2">></span>
								</div>
								<div class="propositiontrier2">
									<a href="#body" style="text-decoration:none;"><span id="trierparalaune2" class="propositiontrieralaune2">À la une</span></a>
									<a href="#body" style="text-decoration:none;"><span id="trierparrecent2" class="propositiontrierrecent2">Récent</span></a>
								</div>
								<?php 
									$countnbanimeabonnement = $db->query('SELECT COUNT(*) AS nbanimeabonnement FROM abonneranime WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
									$nbanimeabonnement = $countnbanimeabonnement->fetch();
								?>
								<div class="blockactualiteanime" id="blockactualiteanime2">
									<img src="images/iconeanimes.png" alt="Image" class="animeimg" />
									<span class="animespan">Animes</span>
									<span class="animespannb" id="animespannbabonnement"><?php echo $nbanimeabonnement['nbanimeabonnement']; ?></span>
								</div>
								<div class="blockactualiteanimecontenu" id="blockactualiteanimecontenu2">
								<?php
									$selectanimeabonnement = $db->query('SELECT * FROM animes ORDER BY nbabonner DESC');
									while($animeabonnement = $selectanimeabonnement->fetch())
									{
									$searchabonnementexist = $db->query('SELECT * FROM abonneranime WHERE IDanime=\'' . $animeabonnement['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\' ');
									$abonnementexist = $searchabonnementexist->rowCount();
									if($abonnementexist == 1)
									{
										if(mb_strlen($animeabonnement['titre'], 'utf8') <= 17)
										{
											$titreanimeabonnement[0] = $animeabonnement['titre'];
										}
										else
										{
											$titreanimeabonnement1 = mb_substr($animeabonnement['titre'], 0, 14, 'utf8');
											
											$titreanimeabonnement[0] = $titreanimeabonnement1 . "..."; 
										}
								?>
									<div class="animecontenu" id="animecontenu<?php echo $animeabonnement['ID'];?>">
										<div class="animecontenudivimg" style="background: url(anime/<?php echo $animeabonnement['image']; ?>)no-repeat;background-size: cover;">
										</div>
										<?php
											if(mb_strlen($animeabonnement['titre'], 'utf8') <= 17)
											{
											?>
												<span class="animecontenutitre"><?php echo $titreanimeabonnement[0]; ?></span><br />
											<?php
											}
											else
											{
											?>
												<span class="animecontenutitre" title="<?php echo $animeabonnement['titre']; ?>"><?php echo $titreanimeabonnement[0]; ?></span><br />
											<?php
											}
										?>
										<span class="animecontenunbabonne" id="animecontenunbabonne<?php echo $animeabonnement['ID']; ?>"><?php echo $animeabonnement['nbabonner']; ?></span><br />
										
										<span onclick="animecontenustopsuivreimg<?php echo $animeabonnement['ID']; ?>()"><img src="images/stopsuivre.png" alt="Ne plus suivre" class="animecontenusuivreimg" id="animecontenustopsuivreimg<?php echo $animeabonnement['ID']; ?>" /></span>
									</div>
								<?php
									}
									}
									$selectanimeabonnement->closeCursor();
								?>
									<script>
								<?php
									$selectanimeabonnementjs = $db->query('SELECT * FROM animes ORDER BY nbabonner DESC');
									while($animeabonnementjs = $selectanimeabonnementjs->fetch())
									{
									$searchabonnementexistjs = $db->query('SELECT * FROM abonneranime WHERE IDanime=\'' . $animeabonnementjs['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\' ');
									$abonnementexistjs = $searchabonnementexistjs->rowCount();
									if($abonnementexistjs == 1)
									{
									?>
										function animecontenustopsuivreimg<?php echo $animeabonnementjs['ID']; ?>()
										{
											var xhr = new XMLHttpRequest();
										
											xhr.open('GET', 'site/phpparametreabonnement.php?stopsuivreanime=<?php echo $animeabonnementjs['ID']; ?>');
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.getElementById('animecontenu<?php echo $animeabonnementjs['ID'];?>').style.transition="all 0.4s";
													document.getElementById('animecontenu<?php echo $animeabonnementjs['ID'];?>').style.opacity="1";
													setTimeout(function(){document.getElementById("animecontenu<?php echo $animeabonnementjs['ID'];?>").style.display="none";},200 )
													setTimeout(function(){document.getElementById("animecontenu<?php echo $animeabonnementjs['ID'];?>").style.opacity="0";},100 )
													document.getElementById("animespannbabonnement").innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
									<?php
									}
									}
									$selectanimeabonnementjs->closeCursor();
								?>
									</script>
								</div>
								<?php 
									$searchnbmembreabonnement = $db->query('SELECT COUNT(*) AS nbmembreabonnement FROM abonnermembre WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
									$nbmembreabonnement = $searchnbmembreabonnement->fetch();
								?>
								<div class="blockactualitemembre" id="blockactualitemembre2">
									<img src="images/iconemembres.png" alt="Image" class="animeimg" />
									<span class="animespan">Membres</span>
									<span class="animespannb" id="membrepannbabonnement"><?php echo $nbmembreabonnement['nbmembreabonnement']; ?></span>
								</div>
								<div class="blockactualitemembrecontenu" id="blockactualitemembrecontenu2">
								<?php
									$selectmembreabonnement = $db->query('SELECT * FROM membres ORDER BY nbabonner DESC');
									while($membreabonnement = $selectmembreabonnement->fetch())
									{
									$searchabonnementexistmembre = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $membreabonnement['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
									$abonnementexistmembre = $searchabonnementexistmembre->rowCount();
									if($abonnementexistmembre == 1)
									{
										$membreabonnementvb = html_entity_decode($membreabonnement['pseudo']);
										
										if(mb_strlen($membreabonnementvb, 'utf8') <= 15)
										{
											$titremembreabonnementarray[0] = $membreabonnementvb;
										}
										else
										{
											$titremembreabonnement = mb_substr($membreabonnementvb, 0, 12, 'utf8');
											
											$titremembreabonnementarray[0] = $titremembreabonnement . "..."; 
										}
								?>
									<div class="animecontenu" id="membrecontenu<?php echo $membreabonnement['ID'];?>">
										<a href="profil.php?id=<?php echo $membreabonnement['ID']; ?>"><div class="animecontenudivimg" style="background: url(membre/avatar/<?php echo $membreabonnement['avatar']; ?>)no-repeat;background-size: cover;">
										</div></a>
										<?php
											if(mb_strlen($membreabonnementvb, 'utf8') <= 15)
											{
											?>
												<a href="profil.php?id=<?php echo $membreabonnement['ID']; ?>"><span class="animecontenutitre"><?php echo htmlspecialchars($titremembreabonnementarray[0]); ?></span></a><br />
											<?php
											}
											else
											{
											?>
												<a href="profil.php?id=<?php echo $membreabonnement['ID']; ?>"><span class="animecontenutitre" title="<?php echo htmlspecialchars($membreabonnement['pseudo']); ?>"><?php echo htmlspecialchars($titremembreabonnementarray[0]); ?></span></a><br />
											<?php
											}
										?>
										<span class="animecontenunbabonne" id="membrecontenunbabonnement<?php echo $membreabonnement['ID']; ?>"><?php echo $membreabonnement['nbabonner']; ?></span><br />
										
										<span onclick="membrecontenustopsuivreimg<?php echo $membreabonnement['ID']; ?>()"><img src="images/stopsuivre.png" alt="Ne plus suivre" class="animecontenusuivreimg" id="membrecontenustopsuivreimg<?php echo $membreabonnement['ID']; ?>" /></span>
										?>
									</div>
								<?php
									}
									}
									$selectmembreabonnement->closeCursor();
								?>
									<script>
								<?php
									$selectmembreabonnementjs = $db->query('SELECT * FROM membres ORDER BY nbabonner DESC');
									while($membreabonnementjs = $selectmembreabonnementjs->fetch())
									{
									$membresearchabonnementexistjs = $db->query('SELECT * FROM abonnermembre WHERE IDpagemembre=\'' . $membreabonnementjs['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\' ');
									$membreabonnementexistjs = $membresearchabonnementexistjs->rowCount();
									if($membreabonnementexistjs == 1)
									{
									?>
										function membrecontenustopsuivreimg<?php echo $membreabonnementjs['ID']; ?>()
										{
											var xhr = new XMLHttpRequest();
										
											xhr.open('GET', 'site/phpparametreabonnement.php?stopsuivremembre=<?php echo $membreabonnementjs['ID']; ?>');
											
											xhr.onreadystatechange = function()
											{
												if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.getElementById('membrecontenu<?php echo $membreabonnementjs['ID'];?>').style.transition="all 0.4s";
													document.getElementById('membrecontenu<?php echo $membreabonnementjs['ID'];?>').style.opacity="1";
													setTimeout(function(){document.getElementById("membrecontenu<?php echo $membreabonnementjs['ID'];?>").style.display="none";},200 )
													setTimeout(function(){document.getElementById("membrecontenu<?php echo $membreabonnementjs['ID'];?>").style.opacity="0";},100 )
													document.getElementById("membrepannbabonnement").innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
									<?php
									}
									}
									$selectmembreabonnementjs->closeCursor();
								?>
									</script>
								</div>
								
								<script>
									document.querySelector(".selectiontrier2").onclick = function() 
									{ 
										if (window.getComputedStyle(document.querySelector('.propositiontrier2')).display=='none')
										{
											document.querySelector(".propositiontrier2").style.display="block";
											document.querySelector(".chevron2").style.transform="rotate(80deg)";
										}
										else
										{
											document.querySelector(".propositiontrier2").style.display="none";
											document.querySelector(".chevron2").style.transform="rotate(0deg)";
										}
									}
									
									$('a[href^="#"]').click(function(){
									var the_id = $(this).attr("href");
									$("body").mCustomScrollbar("scrollTo",$(the_id).offset().top -0, { scrollInertia: 1000 }); return false;});
									
									document.querySelector("#trierparalaune2").onclick = function() 
									{
										var xhr = new XMLHttpRequest();
					
										xhr.open('GET', 'site/phpparametreabonnement.php?trierparalaune=ok');
										
										xhr.onreadystatechange = function() 
										{
											if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.querySelector('.propositiontrier2').style.marginTop="51px";
												document.querySelector('.propositiontrier2').style.left="12px";
												document.querySelector('.propositiontrierrecent2').style.width="60px";
												document.querySelector('.propositiontrierrecent2').style.height="23px";
												document.querySelector(".propositiontrier2").style.display="none";
												document.querySelector(".chevron2").style.transform="rotate(0deg)";
												document.querySelector('.alaune2').style.display="inline-block";
												document.querySelector('.recent2').style.display="none";
												document.querySelector('.propositiontrieralaune2').style.display="none";
												document.querySelector('.propositiontrierrecent2').style.display="block";
												document.querySelector('#xhrresponsetext2').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
									
									document.querySelector("#trierparrecent2").onclick = function() 
									{
										var xhr = new XMLHttpRequest();
					
										xhr.open('GET', 'site/phpparametreabonnement.php?trierparrecent=ok');
										
										xhr.onreadystatechange = function() 
										{
											if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.querySelector('.propositiontrier2').style.marginTop="55px";
												document.querySelector('.propositiontrier2').style.left="12px";
												document.querySelector('.propositiontrieralaune2').style.width="65px";
												document.querySelector('.propositiontrieralaune2').style.height="28px";
												document.querySelector(".propositiontrier2").style.display="none";
												document.querySelector(".chevron2").style.transform="rotate(0deg)";
												document.querySelector('.alaune2').style.display="none";
												document.querySelector('.recent2').style.display="inline-block";
												document.querySelector('.propositiontrieralaune2').style.display="block";
												document.querySelector('.propositiontrierrecent2').style.display="none";
												document.querySelector('#xhrresponsetext2').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
									
									document.querySelector("#blockactualiteanime2").onclick = function() 
									{ 
										if (window.getComputedStyle(document.querySelector('#blockactualiteanimecontenu2')).height=='0px')
										{
											document.querySelector("#blockactualitemembrecontenu2").style.height="0px";
											document.querySelector("#blockactualiteanimecontenu2").style.height="423px";
										}
										else
										{
											document.querySelector("#blockactualitemembrecontenu2").style.height="0px";
											document.querySelector("#blockactualiteanimecontenu2").style.height="0px";
										}
									}
									
									document.querySelector("#blockactualitemembre2").onclick = function() 
									{ 
										if (window.getComputedStyle(document.querySelector('#blockactualitemembrecontenu2')).height=='0px')
										{
											document.querySelector("#blockactualiteanimecontenu2").style.height="0px";
											document.querySelector("#blockactualitemembrecontenu2").style.height="423px";
										}
										else
										{
											document.querySelector("#blockactualiteanimecontenu2").style.height="0px";
											document.querySelector("#blockactualitemembrecontenu2").style.height="0px";
										}
									}
									
								</script>
							</div>
							
							<div id="blockfilactualite">
							<?php
							
								$searchifmembreabonnementexist = $db->query('SELECT * FROM abonneranime WHERE IDmembre=\'' . $_SESSION['ID'] .  '\'');
								$ifmembreabonnementexist = $searchifmembreabonnementexist->rowCount();
								if($ifmembreabonnementexist == 0)
								{
								?>
									<div class="divhappy">
										<img src="images/happy.png" alt="Happy" class="happy" /><br />
										<span class="spanhappy">Abonnés vous a vos animé préféré pour suivre leur actualité.<span>
									</div>
								<?php
								}
							?>
							<div id="xhrresponsetext2">
							<?php 
								
								$selectarticleabonnement = $db->query('SELECT * FROM articlepageanime ORDER BY ID DESC');
								
								while($articleabonnement = $selectarticleabonnement->fetch())
								{
								$selectIDanimeabonnement = $db->query('SELECT * FROM abonneranime WHERE IDanime=\'' . $articleabonnement['IDanime'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
								$IDanimeabonnement = $selectIDanimeabonnement->rowCount();
								if($IDanimeabonnement == 1)
								{
									$selectinfoanimeabonnement = $db->query('SELECT * FROM animes WHERE ID=\'' . $articleabonnement['IDanime'] .  '\'');
									$infoanimeabonnement = $selectinfoanimeabonnement->fetch();
									
									$imageanimeabonnement = 'anime/' . htmlspecialchars($infoanimeabonnement['image']);
									$titreanimeabonnement = htmlspecialchars($infoanimeabonnement['titre']);
									
									
								?>
								<div class="blockfilactualitearticle" id="blockfilabonnementarticle<?php echo $articleabonnement['ID']; ?>">
								<?php
									if($_SESSION['ID'] == '1')
									{
									?>
										<img src="images/supprimerrecherche2.png" alt="supprimer" class="deleteactualitearticle" id="deleteabonnementarticle<?php echo $articleabonnement['ID']; ?>" onclick="deleteabonnementarticle<?php echo $articleabonnement['ID']; ?>()" />								
									<?php
									}
								?>
									<div style="background: url(<?php echo $imageanimeabonnement; ?>)no-repeat;background-size: cover;" class="articleavatar"/></div>
									<span class="articlepseudo"><?php echo $titreanimeabonnement; ?></span><br />
									<?php
									$dateanimgN2 = date("Y", strtotime($articleabonnement['date_creation']));
									$datemoisimgN2 = date("m", strtotime($articleabonnement['date_creation']));
									$datedayimgN2 = date("d", strtotime($articleabonnement['date_creation']));
									$dateheureimgN2 = date("H", strtotime($articleabonnement['date_creation']));
									$dateminimgN2 = date("i", strtotime($articleabonnement['date_creation']));
									
									$dateannowN2 = date('Y');
									$datemoisnowN2 = date('m');
									$datedaynowN2 = date('d');
									$dateheurenowN2 = date('H');
									$dateminnowN2 = date('i');
									
									$dateanN2 =  $dateannowN2 - $dateanimgN2;
									$datemoisN2 = $datemoisnowN2 - $datemoisimgN2;
									$datemois2N2 = $datemoisimgN2 - $datemoisnowN2;
									$datedayN2 = $datedaynowN2 - $datedayimgN2;
									$dateheureN2 = $dateheurenowN2 - $dateheureimgN2;
									$dateminN2 = $dateminnowN2 - $dateminimgN2;
									
									$datemois3N2 = 12 - $datemois2N2;
									
									if($dateanN2 == 1 AND $datemois3N2 == 1 AND $datedayN2 != 0)
									{
										$dateday2N2 = 31 - $datedayimgN2;
										$dateday3N2 = $dateday2N2 + $datedaynowN2;
										if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
										{
											$dateheure2N2 = 24 - $dateheureimgN2;
											$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
											if($dateheure3N2 >= 2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
											<?php
											}
											else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
											<?php
											}
											else if($dateheure3N2 == 1 AND $dateminN2 < 0)
											{
												$datemin2 = 60 + $dateminN2;
											?>
												<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
											<?php
											}
											else if($dateheure3N2 == 1 AND $dateminN2 == 1)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
											<?php
											}
										}
										else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
										{
										?>
											<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
										<?php
										}
										else if($dateday3N2 >= 31)
										{
											if($articleabonnement['date_delete'] == "1mois")
											{
												if($datemois3N2 == 1)
												{
													$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
													$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
													?>
													<script>
														autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
													</script>
													<?php
												}
											}
										?>
											<span class="articletemps">Il y a <?php echo $datemois3N2; ?> mois</span>
										<?php
										}else
										{
											if($articleabonnement['date_delete'] == "2semaines")
											{
												if($dateday3N2 >= 14)
												{
													$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
													$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
													?>
													<script>
														autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
													</script>
													<?php
												}
											}
										?>
											<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
										<?php
										}
									}
									else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateheureN2 == 0 AND $dateminN2 == 0)
									{
										?>
											<span class="articletemps">À l'instant</span>
										<?php
									}
									else if($dateanN2 == 1 AND $datemois2N2 >= 2)
									{
										$datemois4N2 = 12 - $datemois2N2;
										
										if($articleabonnement['date_delete'] == "6mois")
										{
											if($datemois4N2 == 6)
											{
												$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
												$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
												?>
												<script>
													autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
												</script>
												<?php
											}
										}
										?>
											<span class="articletemps">Il y a <?php echo $datemois4N2; ?> mois</span>
										<?php
									}
									else if($dateanN2 == 1 AND ($datemoisN2 >= 1 OR $datemoisN2 <= 1))
									{	
										if($articleabonnement['date_delete'] == "1an")
										{
											if($dateanN2 == 1)
											{
												$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
												$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
												?>
												<script>
													autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
												</script>
												<?php
											}
										}
										?>
											<span class="articletemps">Il y a <?php echo $dateanN2; ?> an</span>
										<?php
									}
									else if($dateanN2 >= 2)
									{
										?>
											<span class="articletemps">Il y a <?php echo $dateanN2; ?> ans</span>
										<?php
									}
									else if($datemoisN2 == 0 AND $dateanN2 >= 1)
									{
										if($dateanN2 == 1)
										{
											if($articleabonnement['date_delete'] == "1an")
											{
												if($dateanN2 == 1)
												{
													$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
													$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
													?>
													<script>
														autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
													</script>
													<?php
												}
											}
										?>
											<span class="articletemps">Il y a <?php echo $dateanN2; ?> an</span>
										<?php
										}
										else if($dateanN2 >= 1)
										{
										?>
											<span class="articletemps">Il y a <?php echo $dateanN2; ?> ans</span>
										<?php
										}
									}
									else if($dateanN2 == 0 AND $datemoisN2 >= 2)
									{
										if($articleabonnement['date_delete'] == "6mois")
										{
											if($datemoisN2 == 6)
											{
												$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
												$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
												?>
												<script>
													autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
												</script>
												<?php
											}
										}
									?>
										<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
									<?php
									}
									else if($dateanN2 == 0 AND $datemoisN2 == 1 AND $datedayN2 == 0)
									{
										if($articleabonnement['date_delete'] == "1mois")
										{
											if($datemoisN2 == 1)
											{
												$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
												$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
												?>
												<script>
													autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
												</script>
												<?php
											}
										}
									?>
										<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
									<?php
									}
									else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 >= 1)
									{
										if($datedayN2 >= 2)
										{
											if($articleabonnement['date_delete'] == "2semaines")
											{
												if($datedayN2 >= 14)
												{
													$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
													$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
													?>
													<script>
														autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
													</script>
													<?php
												}
											}
										?>
											<span class="articletemps">Il y a <?php echo $datedayN2; ?> jours</span>
										<?php
										}
										else if($datedayN2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
										{
											$dateheure2N2 = 24 - $dateheureimgN2;
											$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
											if($dateheure3N2 >= 2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
											<?php
											}
											else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
											<?php
											}
											else if($dateheure3N2 == 1 AND $dateminN2 < 0)
											{
												$datemin2 = 60 + $dateminN2;
											?>
												<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
											<?php
											}
											else if($dateheure3N2 == 1 AND $dateminN2 == 1)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
											<?php
											}
										}
										else if($datedayN2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
										{
										?>
											<span class="articletemps">Il y a <?php echo $datedayN2; ?> jour</span>
										<?php
										}
									}
									else if($dateanN2 == 0 AND $datemoisN2 == 1 AND $datedayN2 != 0)
									{
										if($datemoisimgN2 == 1)
										{
											$dateday2N2 = 31 - $datedayimgN2;
											$dateday3N2 = $dateday2N2 + $datedaynowN2;
											if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
											{
												$dateheure2N2 = 24 - $dateheureimgN2;
												$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
												if($dateheure3N2 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 < 0)
												{
													$datemin2 = 60 + $dateminN2;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
												<?php
												}
											}
											else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
											<?php
											}
											else if($dateday3N2 >= 31)
											{
												if($articleabonnement['date_delete'] == "1mois")
												{
													if($datemoisN2 == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
											<?php
											}
											else
											{
												if($articleabonnement['date_delete'] == "2semaines")
												{
													if($dateday3N2 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimgN2 == 2)
										{
											$dateday2N2 = 28 - $datedayimgN2;
											$dateday3N2 = $dateday2N2 + $datedaynowN2;
											if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
											{
												$dateheure2N2 = 24 - $dateheureimgN2;
												$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
												if($dateheure3N2 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 < 0)
												{
													$datemin2 = 60 + $dateminN2;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
												<?php
												}
											}
											else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
											<?php
											}
											else if($dateday3N2 >= 28)
											{
												if($articleabonnement['date_delete'] == "1mois")
												{
													if($datemoisN2 == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
											<?php
											}
											else
											{
												if($articleabonnement['date_delete'] == "2semaines")
												{
													if($dateday3N2 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimgN2 == 3)
										{
											$dateday2N2 = 31 - $datedayimgN2;
											$dateday3N2 = $dateday2N2 + $datedaynowN2;
											if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
											{
												$dateheure2N2 = 24 - $dateheureimgN2;
												$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
												if($dateheure3N2 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 < 0)
												{
													$datemin2 = 60 + $dateminN2;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
												<?php
												}
											}
											else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
											<?php
											}
											else if($dateday3N2 >= 31)
											{
												if($articleabonnement['date_delete'] == "1mois")
												{
													if($datemoisN2 == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
											<?php
											}
											else
											{
												if($articleabonnement['date_delete'] == "2semaines")
												{
													if($dateday3N2 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimgN2 == 4)
										{
											$dateday2N2 = 30 - $datedayimgN2;
											$dateday3N2 = $dateday2N2 + $datedaynowN2;
											if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
											{
												$dateheure2N2 = 24 - $dateheureimgN2;
												$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
												if($dateheure3N2 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 < 0)
												{
													$datemin2 = 60 + $dateminN2;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
												<?php
												}
											}
											else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
											<?php
											}
											else if($dateday3N2 >= 30)
											{
												if($articleabonnement['date_delete'] == "1mois")
												{
													if($datemoisN2 == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
											<?php
											}
											else
											{
												if($articleabonnement['date_delete'] == "2semaines")
												{
													if($dateday3N2 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimgN2 == 5)
										{
											$dateday2N2 = 31 - $datedayimgN2;
											$dateday3N2 = $dateday2N2 + $datedaynowN2;
											if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
											{
												$dateheure2N2 = 24 - $dateheureimgN2;
												$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
												if($dateheure3N2 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 < 0)
												{
													$datemin2 = 60 + $dateminN2;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
												<?php
												}
											}
											else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
											<?php
											}
											else if($dateday3N2 >= 31)
											{
												if($articleabonnement['date_delete'] == "1mois")
												{
													if($datemoisN2 == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
											<?php
											}
											else
											{
												if($articleabonnement['date_delete'] == "2semaines")
												{
													if($dateday3N2 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimgN2 == 6)
										{
											$dateday2N2 = 30 - $datedayimgN2;
											$dateday3N2 = $dateday2N2 + $datedaynowN2;
											if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
											{
												$dateheure2N2 = 24 - $dateheureimgN2;
												$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
												if($dateheure3N2 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 < 0)
												{
													$datemin2 = 60 + $dateminN2;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
												<?php
												}
											}
											else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
											<?php
											}
											else if($dateday3N2 >= 30)
											{
												if($articleabonnement['date_delete'] == "1mois")
												{
													if($datemoisN2 == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
											<?php
											}
											else
											{
												if($articleabonnement['date_delete'] == "2semaines")
												{
													if($dateday3N2 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimgN2 == 7)
										{
											$dateday2N2 = 31 - $datedayimgN2;
											$dateday3N2 = $dateday2N2 + $datedaynowN2;
											if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
											{
												$dateheure2N2 = 24 - $dateheureimgN2;
												$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
												if($dateheure3N2 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 < 0)
												{
													$datemin2 = 60 + $dateminN2;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
												<?php
												}
											}
											else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
											<?php
											}
											else if($dateday3N2 >= 31)
											{
												if($articleabonnement['date_delete'] == "1mois")
												{
													if($datemoisN2 == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
											<?php
											}
											else
											{
												if($articleabonnement['date_delete'] == "2semaines")
												{
													if($dateday3N2 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimgN2 == 8)
										{
											$dateday2N2 = 31 - $datedayimgN2;
											$dateday3N2 = $dateday2N2 + $datedaynowN2;
											if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
											{
												$dateheure2N2 = 24 - $dateheureimgN2;
												$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
												if($dateheure3N2 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 < 0)
												{
													$datemin2 = 60 + $dateminN2;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
												<?php
												}
											}
											else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
											<?php
											}
											else if($dateday3N2 >= 31)
											{
												if($articleabonnement['date_delete'] == "1mois")
												{
													if($datemoisN2 == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
											<?php
											}
											else
											{
												
												if($articleabonnement['date_delete'] == "2semaines")
												{
													if($dateday3N2 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimgN2 == 9)
										{
											$dateday2N2 = 30 - $datedayimgN2;
											$dateday3N2 = $dateday2N2 + $datedaynowN2;
											if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
											{
												$dateheure2N2 = 24 - $dateheureimgN2;
												$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
												if($dateheure3N2 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 < 0)
												{
													$datemin2 = 60 + $dateminN2;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
												<?php
												}
											}
											else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
											<?php
											}
											else if($dateday3N2 >= 30)
											{
												if($articleabonnement['date_delete'] == "1mois")
												{
													if($datemoisN2 == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
											<?php
											}
											else
											{
												if($articleabonnement['date_delete'] == "2semaines")
												{
													if($dateday3N2 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimgN2 == 10)
										{
											$dateday2N2 = 31 - $datedayimgN2;
											$dateday3N2 = $dateday2N2 + $datedaynowN2;
											if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
											{
												$dateheure2N2 = 24 - $dateheureimgN2;
												$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
												if($dateheure3N2 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 < 0)
												{
													$datemin2 = 60 + $dateminN2;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
												<?php
												}
											}
											else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
											<?php
											}
											else if($dateday3N2 >= 31)
											{
												if($articleabonnement['date_delete'] == "1mois")
												{
													if($datemoisN2 == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
											<?php
											}
											else
											{
												if($articleabonnement['date_delete'] == "2semaines")
												{
													if($dateday3N2 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimgN2 == 11)
										{
											$dateday2N2 = 30 - $datedayimgN2;
											$dateday3N2 = $dateday2N2 + $datedaynowN2;
											if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
											{
												$dateheure2N2 = 24 - $dateheureimgN2;
												$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
												if($dateheure3N2 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 < 0)
												{
													$datemin2 = 60 + $dateminN2;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
												<?php
												}
											}
											else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
											<?php
											}
											else if($dateday3N2 >= 30)
											{
												if($articleabonnement['date_delete'] == "1mois")
												{
													if($datemoisN2 == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
											<?php
											}
											else
											{
												if($articleabonnement['date_delete'] == "2semaines")
												{
													if($dateday3N2 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
											<?php
											}
										}
										else if($datemoisimgN2 == 12)
										{
											$dateday2N2 = 31 - $datedayimgN2;
											$dateday3N2 = $dateday2N2 + $datedaynowN2;
											if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
											{
												$dateheure2N2 = 24 - $dateheureimgN2;
												$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
												if($dateheure3N2 >= 2)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heures</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateheure3N2; ?> heure</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 < 0)
												{
													$datemin2 = 60 + $dateminN2;
												?>
													<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3N2 == 1 AND $dateminN2 == 1)
												{
												?>
													<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
												<?php
												}
											}
											else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
											{
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jour</span>
											<?php
											}
											else if($dateday3N2 >= 31)
											{
												if($articleabonnement['date_delete'] == "1mois")
												{
													if($datemoisN2 == 1)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $datemoisN2; ?> mois</span>
											<?php
											}
											else
											{
												if($articleabonnement['date_delete'] == "2semaines")
												{
													if($dateday3N2 >= 14)
													{
														$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
														$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
														?>
														<script>
															autodeletearticleabonnement<?php echo $articleabonnement['ID']; ?>(this.value);
														</script>
														<?php
													}
												}
											?>
												<span class="articletemps">Il y a <?php echo $dateday3N2; ?> jours</span>
											<?php
											}
										}
									}
									else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateminN2 == 1)
									{
										if($dateheureN2 == 0)
										{
										?>
											<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
										<?php
										}
										else if($dateheureN2 == 1)
										{
										?>
											<span class="articletemps">Il y a <?php echo $dateminN2; ?> minute</span>
										<?php
										}
									}
									else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateheureN2 == 0)
									{
										if($dateminN2 >= 2)
										{
										?>
											<span class="articletemps">Il y a <?php echo $dateminN2; ?> minutes</span>
										<?php
										}
									}
									else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateheureN2 == 1 AND $dateminN2 < 0 )
									{
										$datemin2 = 60 + $dateminN2;
									?>
										<span class="articletemps">Il y a <?php echo $datemin2; ?> minutes</span>
									<?php
									}
									else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateheureN2 == 1 AND $dateminN2 >= 0 )
									{
										$datemin2 = 60 + $dateminN2;
									?>
										<span class="articletemps">Il y a <?php echo $dateheureN2; ?> heure</span>
									<?php
									}
									else if($dateheureN2 >= 2)
									{
									?>
										<span class="articletemps">Il y a <?php echo $dateheureN2; ?> heures</span>
									<?php
									}
								?>
									<div class="articlesujet"><?php echo html_entity_decode($articleabonnement['contenu']); ?></div><br />
									<div class="articleblockaime">
									<?php 
										$searchnoteexistabonnement = $db->query('SELECT * FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
										$noteexistabonnement = $searchnoteexistabonnement->rowCount();
										if($noteexistabonnement == 1)
										{
										?>
											<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimeabonnementpas<?php echo $articleabonnement['ID']; ?>" onclick="articleimgaimeabonnementpas<?php echo $articleabonnement['ID']; ?>()" />
											
											<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaimeabonnement<?php echo $articleabonnement['ID']; ?>" onclick="articleimgaimeabonnement<?php echo $articleabonnement['ID']; ?>()" style="opacity:0.65;display:none;" />
										<?php
										}
										else
										{
										?>
											<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaimeabonnement<?php echo $articleabonnement['ID']; ?>" onclick="articleimgaimeabonnement<?php echo $articleabonnement['ID']; ?>()" style="opacity:0.65;" />
										
											<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimeabonnementpas<?php echo $articleabonnement['ID']; ?>" onclick="articleimgaimeabonnementpas<?php echo $articleabonnement['ID']; ?>()" style="display:none;" />
										<?php
										}
									?>
										<span class="articlenbaime" id="articlenbaimeabonnement<?php echo $articleabonnement['ID']; ?>"><?php echo htmlspecialchars($articleabonnement['note']); ?></span>
									</div>
								</div>
								<?php
								}
								}
								$selectarticleabonnement->closeCursor();
							?>
							
							<script>
							<?php
							
								$selectarticleabonnementjs = $db->query('SELECT * FROM articlepageanime ORDER BY ID DESC');
								while($articleabonnementjs = $selectarticleabonnementjs->fetch())
								{
								$selectIDanimeabonnementjs = $db->query('SELECT * FROM abonneranime WHERE IDanime=\'' . $articleabonnementjs['IDanime'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
								$IDanimeabonnementjs = $selectIDanimeabonnementjs->rowCount();
								if($IDanimeabonnementjs == 1)
								{
								
									if($_SESSION['ID'] == '1')
									{
								?>
								
									function deleteabonnementarticle<?php echo $articleabonnementjs['ID']; ?>()
									{
										var xhr = new XMLHttpRequest();
										
										xhr.open('GET', 'site/phpparametreabonnement.php?deletearticle=<?php echo $articleabonnementjs['ID']; ?>');
										
										xhr.onreadystatechange = function()
										{
											if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.getElementById('blockfilabonnementarticle<?php echo $articleabonnementjs['ID'];?>').style.transition="all 0.4s";
												document.getElementById('blockfilabonnementarticle<?php echo $articleabonnementjs['ID'];?>').style.opacity="1";
												setTimeout(function(){document.getElementById("blockfilabonnementarticle<?php echo $articleabonnementjs['ID'];?>").style.display="none";},200 )
												setTimeout(function(){document.getElementById("blockfilabonnementarticle<?php echo $articleabonnementjs['ID'];?>").style.opacity="0";},100 )
											}
										};
										
										xhr.send(null);
									}
								
								<?php
									}
								?>
								
									function articleimgaimeabonnement<?php echo $articleabonnementjs['ID']; ?>()
									{
										var xhr = new XMLHttpRequest();
										
										xhr.open('GET', 'site/phpparametreabonnement.php?articlenoteaime=<?php echo $articleabonnementjs['ID']; ?>');
										
										xhr.onreadystatechange = function()
										{
											if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.getElementById('articleimgaimeabonnement<?php echo $articleabonnementjs['ID'];?>').style.display="none";
												document.getElementById('articleimgaimeabonnementpas<?php echo $articleabonnementjs['ID'];?>').style.display="inline-block";
												document.getElementById('articlenbaimeabonnement<?php echo $articleabonnementjs['ID'];?>').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
									
									function articleimgaimeabonnementpas<?php echo $articleabonnementjs['ID']; ?>()
									{
										var xhr = new XMLHttpRequest();
										
										xhr.open('GET', 'site/phpparametreabonnement.php?articlenoteaimepas=<?php echo $articleabonnementjs['ID']; ?>');
										
										xhr.onreadystatechange = function()
										{
											if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.getElementById('articleimgaimeabonnementpas<?php echo $articleabonnementjs['ID'];?>').style.display="none";
												document.getElementById('articleimgaimeabonnement<?php echo $articleabonnementjs['ID'];?>').style.display="inline-block";
												document.getElementById('articlenbaimeabonnement<?php echo $articleabonnementjs['ID'];?>').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
									
									function autodeletearticleabonnement<?php echo $articleabonnementjs['ID']; ?>()
									{
										document.getElementById('blockfilabonnementarticle<?php echo $articleabonnementjs['ID'];?>').style.display="none";
									}
									
								<?php	
								}
								}
								$selectarticleabonnementjs->closeCursor();
								?>
							</script>
							</div>
							</div>
							
						</div>
						
						<div id="blocknotificationnavigation">
							<img src="images/notification.png" alt="Notification" class="blockparametrenavigationimgparametre" />
							<div id="blocknotificationnavigation2">
						<?php
						
							$dateanniv = date("m-d");
							
							$datemoismembreanniv = date("m", strtotime($_SESSION['date_naissance']));
							$datedaymembreanniv = date("d", strtotime($_SESSION['date_naissance']));
							
							$datemembreanniv = $datemoismembreanniv . '-' . $datedaymembreanniv;
							
							if($datemembreanniv == $dateanniv)
							{
								$searchnotifexist = $db->query('SELECT * FROM notification WHERE IDmembre=\'' . $_SESSION['ID'] . '\' AND sujet=\'Anniversaire\'');
								$notifexist = $searchnotifexist->rowCount();
								if($notifexist == 0)
								{
									$IDmembre = $_SESSION['ID'];
									$sujet = 'Anniversaire';
									$titre = 'Joyeux anniversaire';
									$text = 'Bonjour ' . $_SESSION['pseudo'] . ',<br />Les équipes de Metro Manga vous souhaitent un très bon anniversaire et une agréable journée (๑>◡<๑) .  <br /><br />À bientôt<br />Les équipes de Metro Manga';
									
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
									$selectlastnotif = $db->query('SELECT * FROM notification WHERE IDmembre=\'' . $_SESSION['ID'] . '\' AND sujet=\'Anniversaire\'');
									$lastnotif = $selectlastnotif->fetch();
									
									$dateyear = date("Y");
									$dateyearmembreanniv = date("Y", strtotime($lastnotif['date_time']));
									
									if($dateyear != $dateyearmembreanniv)
									{
										$deletelastnotif = $db->query('DELETE FROM notification WHERE ID=\'' . $lastnotif['ID'] . '\'');
										
										$IDmembre = $_SESSION['ID'];
										$sujet = 'Anniversaire';
										$titre = 'Bonne anniversaire';
										$text = 'Bonjour ' . $_SESSION['pseudo'] . ',<br />Les équipes de Metro Manga vous souhaitent un très bon anniversaire et une agréable journée (๑>◡<๑) . <br /><br />À bientôt<br />Les équipes de Metro Manga';
										
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
								}
							}
							
							$searchinfonotifsujet = $db->query('SELECT * FROM notification WHERE IDmembre=\'' . $_SESSION['ID'] . '\' ORDER BY ID DESC');
							while($infonotifsujet = $searchinfonotifsujet->fetch())
							{
							
								if($infonotifsujet['verif'] == 'YES')
								{
								?>
									<div class="blockparametremodifier" id="blocknotification<?php echo $infonotifsujet['ID']; ?>">
										<p class="blockparametremodifiervaleur" style="font-size: 2em;padding-top:35px;color:rgb(80,80,80);"><?php echo $infonotifsujet['sujet']; ?></p>
									</div>
								<?php
								}
								else
								{
								?>
									<div class="blockparametremodifier" id="blocknotification<?php echo $infonotifsujet['ID']; ?>" >
										<p class="blockparametremodifiervaleur" id="blockparametremodifiervaleur<?php echo $infonotifsujet['ID']; ?>" style="font-size: 2em;padding-top:35px;"><?php echo $infonotifsujet['sujet']; ?></p>
									</div>
								<?php
								}
							
							}
							$searchinfonotifsujet->closeCursor();
						?>
							</div>
						<?php
							$searchinfonotif = $db->query('SELECT * FROM notification WHERE IDmembre=\'' . $_SESSION['ID'] . '\' ORDER BY ID DESC');
							while($infonotif = $searchinfonotif->fetch())
							{
							?>
							<div id="contenuenotification<?php echo $infonotif['ID']; ?>" class="contenuenotification">
							<div class="blockcontenueparametremodifier">
								<p class="titreinfo_inscription" style="color:white;font-size:1.8em;"><?php echo $infonotif['titre']; ?></p>
								<div id="resultatmodificationpseudo" class="resultatmodification">
								</div>
								<hr />
								<br />
								<div class="informationnotification">
									<div class="informationnotificationspan">
										<?php echo html_entity_decode($infonotif['text']); ?>
									</div>
								</div>
							</div>
							</div>
						<?php
							}
							$searchinfonotif->closeCursor();
						?>
							<script>
							<?php
								$searchinfonotifjs = $db->query('SELECT * FROM notification WHERE IDmembre=\'' . $_SESSION['ID'] . '\'  ORDER BY ID DESC');
								while($infonotifjs = $searchinfonotifjs->fetch())
								{
							?>
								document.querySelector("#blocknotification<?php echo $infonotifjs['ID']; ?>").onclick = function() 
								{ 
									if (window.getComputedStyle(document.querySelector('#contenuenotification<?php echo $infonotifjs['ID']; ?>')).right=='100%')
									{
										document.querySelector("#contenuenotification<?php echo $infonotifjs['ID']; ?>").style.right="35.5%";
										<?php
											$searchinfonotifjs2 = $db->query('SELECT * FROM notification WHERE IDmembre=\'' . $_SESSION['ID'] . '\' AND ID!=\'' . $infonotifjs['ID'] . '\'');
											while($infonotifjs2 = $searchinfonotifjs2->fetch())
											{
										?>
											document.querySelector("#contenuenotification<?php echo $infonotifjs2['ID']; ?>").style.right="100%";
										<?php
											}
											$searchinfonotifjs2->closeCursor();
										?>
									}
									else
									{
										document.querySelector("#contenuenotification<?php echo $infonotifjs['ID']; ?>").style.right="35.5%";
										<?php
											$searchinfonotifjs3 = $db->query('SELECT * FROM notification WHERE IDmembre=\'' . $_SESSION['ID'] . '\' AND ID!=\'' . $infonotifjs['ID'] . '\'');
											while($infonotifjs3 = $searchinfonotifjs3->fetch())
											{
										?>
											document.querySelector("#contenuenotification<?php echo $infonotifjs3['ID']; ?>").style.right="100%";
										<?php
											}
											$searchinfonotifjs3->closeCursor();
										?>
									}
								<?php
									if($infonotifjs['verif'] == 'NO')
									{
									?>
										var xhr = new XMLHttpRequest();
										
										xhr.open('GET', 'site/phpparametreprofil.php?IDnotification=<?php echo $infonotifjs['ID']; ?>');
										
										xhr.onreadystatechange = function()
										{
											if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.getElementById('blockparametremodifiervaleur<?php echo $infonotifjs['ID']; ?>').style.color="rgb(80,80,80)";
											}
										};
										
										xhr.send(null);
									<?php
									}
								?>
								}
								<?php
								}
								$searchinfonotifjs->closeCursor();
							?>
							</script>
						</div>
						<div id="blockparametrenavigation">
						<?php
						
							$sessionpseudo = html_entity_decode($_SESSION['pseudo']);
									
							if(mb_strlen($sessionpseudo, 'utf8') <= 20)
							{
								$sessionpseudoarray[0] = $sessionpseudo;
							}
							else
							{
								$sessionpseudovb = mb_substr($sessionpseudo, 0, 17, 'utf8');
								
								$sessionpseudoarray[0] = $sessionpseudovb . "..."; 
							}
							
							$sessionemail = html_entity_decode($_SESSION['email']);
									
							if(mb_strlen($sessionemail, 'utf8') <= 20)
							{
								$sessionemailarray[0] = $sessionemail;
							}
							else
							{
								$sessionemailvb = mb_substr($sessionemail, 0, 17, 'utf8');
								
								$sessionemailarray[0] = $sessionemailvb . "..."; 
							}
						
						?>
							<img src="images/parametre.png" alt="Paramètre" class="blockparametrenavigationimgparametre" />
							<div id="blockparametrenavigation2">
								<div class="blockparametremodifier" id="blockparametremodifierpseudo">
								<span class="blockparametremodifiertitre">Pseudo</span>
							<?php
								if(mb_strlen($sessionpseudo, 'utf8') <= 20)
								{
								?>
									<p class="blockparametremodifiervaleur"><?php echo htmlspecialchars($sessionpseudoarray[0]); ?></p>
								<?php
								}
								else
								{
								?>
									<p class="blockparametremodifiervaleur" title="<?php echo htmlspecialchars($_SESSION['pseudo']); ?>"><?php echo htmlspecialchars($sessionpseudoarray[0]); ?></p>
								<?php
								}
							?>
								</div>
								<div class="blockparametremodifier" id="blockparametremodifieremail">
								<span class="blockparametremodifiertitre">Email</span>
							<?php
								if(mb_strlen($sessionemail, 'utf8') <= 20)
								{
								?>
									<p class="blockparametremodifiervaleur"><?php echo htmlspecialchars($sessionemailarray[0]); ?></p>
								<?php
								}
								else
								{
								?>
									<p class="blockparametremodifiervaleur" title="<?php echo htmlspecialchars($_SESSION['email']); ?>"><?php echo htmlspecialchars($sessionemailarray[0]); ?></p>
								<?php
								}
							?>
								</div>
								<div class="blockparametremodifier" id="blockparametremodifierdatenaissance">
								<span class="blockparametremodifiertitre">Date de naissance</span>
								<p class="blockparametremodifiervaleur"><?php echo date("d/m/Y", strtotime($_SESSION['date_naissance'])); ?></p>
								</div>
								<div class="blockparametremodifier" id="blockparametremodifiergenre">
								<span class="blockparametremodifiertitre">Genre</span>
								<p class="blockparametremodifiervaleur"><?php echo $_SESSION['genre']; ?></p>
								</div>
								<div class="blockparametremodifier" id="blockparametremodifieravatar">
								<span class="blockparametremodifiertitre">Avatar</span>
								<p class="blockparametremodifiervaleur"><img src="membre/avatar/<?php echo $_SESSION['avatar']; ?>" alt="avatar" width="50" height="50" /></p>
								</div>
								<div class="blockparametremodifier" id="blockparametremodifierplandefond">
								<span class="blockparametremodifiertitre">Plan de fond</span>
								<p class="blockparametremodifiervaleur"><img src="membre/plandefond/<?php echo $_SESSION['plandefond']; ?>" alt="avatar" width="125" height="50" /></p>
								</div>
								<div class="blockparametremodifier" id="blockparametremodifiermdp">
								<span class="blockparametremodifiertitre">Mot de passe</span>
								<p class="blockparametremodifiervaleur">. . . . . . . . . . . . . . . . . . . . .</p>
								</div>
							</div>
							<div id="contenueparametremodifierpseudo">
							<div class="blockcontenueparametremodifier">
								<p class="titreinfo_inscription" style="color:white;font-size:1.8em;">Informations</p>
								<div id="resultatmodificationpseudo" class="resultatmodification">
								</div>
								<hr />
								<br />
								<div class="informationparametremodifier" id="informationparametremodifierpseudo"><span>Votre pseudo vous permet de vous identifier sur le site.</span></div>
								<div id="critereparametremodifierpseudo"><span>Saisissez un pseudo de 3 à 30 caractères, il vous permettra de vous identifier sur le site.</span></div>
									<input id="modifierpseudo" type="text" autocomplete="off" placeholder="Pseudo" maxlength="30" minlength="3" required />
									<fieldset class="parametrebarreboutonvalider">
										<legend><input type="submit" value="Valider" id="parametreboutonvalider" onclick="validermodifierpseudo()" /></legend>
									</fieldset>
									
									<script>
							
										function validermodifierpseudo()
										{
											var xhr = new XMLHttpRequest();
											var modifierpseudo = document.querySelector('#modifierpseudo').value;
								
											var modifierpseudo = encodeURIComponent(modifierpseudo);
											
											xhr.open('GET', 'site/phpparametreprofil.php?validermodifierpseudo=' + modifierpseudo);
											
											xhr.onreadystatechange = function() 
											{
												if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.querySelector('#modifierpseudo').value = "";
													document.querySelector('#resultatmodificationpseudo').innerHTML = xhr.responseText;
													confirmresultatmodificationpseudo()
												}
											};
											
											xhr.send(null);
										}
										
										function confirmresultatmodificationpseudo()
										{
											if(document.querySelector('#resultatmodificationpseudo').innerHTML == "")
											{
												window.setTimeout("location=('site/deconnexion.php');",0);
											}
										}
										
									</script>
							</div>
							</div>
							<div id="contenueparametremodifieremail">
							<div class="blockcontenueparametremodifier">
								<p class="titreinfo_inscription" style="color:white;font-size:1.8em;">Informations</p>
								<div id="resultatmodificationemail" class="resultatmodification">
								</div>
								<hr />
								<br />
								<div class="informationparametremodifier" id="informationparametremodifieremail"><span>Votre adresse mail nous permet de certifier votre compte et de vous envoyer un mail en cas d'oubli de votre mot de passe.</span></div>
								<div id="critereparametremodifieremail"><span>Saisissez une adresse e-mail valide et accessible pour valider votre compte Metro Manga.</span></div>
									<input id="modifieremail" autocomplete="off" type="email" maxlength="255" placeholder="Email" required />
									<fieldset class="parametrebarreboutonvalider">
										<legend><input type="submit" value="Valider" id="parametreboutonvalider" onclick="validermodifieremail()" /></legend>
									</fieldset>
									
									<script>
							
										function validermodifieremail()
										{
											var xhr = new XMLHttpRequest();
											var modifieremail = document.querySelector('#modifieremail').value;
								
											var modifieremail = encodeURIComponent(modifieremail);
											
											xhr.open('GET', 'site/phpparametreprofil.php?validermodifieremail=' + modifieremail);
											
											xhr.onreadystatechange = function() 
											{
												if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.querySelector('#modifieremail').value = "";
													document.querySelector('#resultatmodificationemail').innerHTML = xhr.responseText;
													confirmresultatmodificationemail()
												}
											};
											
											xhr.send(null);
										}
										
										function confirmresultatmodificationemail()
										{
											if(document.querySelector('#resultatmodificationemail').innerHTML == "")
											{
												window.setTimeout("location=('site/deconnexion.php');",0);
											}
										}
										
									</script>
							</div>
							</div>
							<div id="contenueparametremodifierdatenaissance">
							<div class="blockcontenueparametremodifier">
								<p class="titreinfo_inscription" style="color:white;font-size:1.8em;">Informations</p>
								<div id="resultatmodificationdatenaissance" class="resultatmodification">
								</div>
								<hr />
								<br />
								<div class="informationparametremodifier" id="informationparametremodifierdatenaissance"><span>Saisissez votre date de naissance, vous recevrez une notification lors de votre anniversaire (๑>◡<๑).</span></div>
								<div id="critereparametremodifierdatenaissance"><span>Saisissez votre date de naissance, vous recevrez une notification lors de votre anniversaire (๑>◡<๑).</span></div>
									<input id="modifierdatenaissance" max="2018-01-01" min="1900-12-01" autocomplete="off" type="date" required />
									<fieldset class="parametrebarreboutonvalider">
										<legend><input type="submit" value="Valider" id="parametreboutonvalider" onclick="validermodifierdatenaissance()" /></legend>
									</fieldset>
									
									<script>
							
										function validermodifierdatenaissance()
										{
											var xhr = new XMLHttpRequest();
											var modifierdatenaissance = document.querySelector('#modifierdatenaissance').value;
								
											var modifierdatenaissance = encodeURIComponent(modifierdatenaissance);
											
											xhr.open('GET', 'site/phpparametreprofil.php?validermodifierdatenaissance=' + modifierdatenaissance);
											
											xhr.onreadystatechange = function()
											{
												if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.querySelector('#modifierdatenaissance').value = "";
													document.querySelector('#resultatmodificationdatenaissance').innerHTML = xhr.responseText;
													confirmresultatmodificationdatenaissance()
												}
											};
											
											xhr.send(null);
										}
										
										function confirmresultatmodificationdatenaissance()
										{
											if(document.querySelector('#resultatmodificationdatenaissance').innerHTML == "")
											{
												window.setTimeout("location=('site/deconnexion.php');",0);
											}
										}
										
									</script>
							</div>
							</div>
							<div id="contenueparametremodifiergenre">
							<div class="blockcontenueparametremodifier">
								<p class="titreinfo_inscription" style="color:white;font-size:1.8em;">Informations</p>
								<div id="resultatmodificationgenre" class="resultatmodification">
								</div>
								<hr />
								<br />
								<div class="informationparametremodifier" id="informationparametremodifiergenre"><span>Sélectionner le genre auquel vous appartenez.</span></div>
								<div id="critereparametremodifiergenre"><span>Sélectionner le genre auquel vous appartenez.</span></div>
								<select  id="modifiergenre" required >
									<option class="valuegenre" value="Homme" >Homme</option>
									<option class="valuegenre" value="Femme" >Femme</option>
								</select>
									<fieldset class="parametrebarreboutonvalider">
										<legend><input type="submit" value="Valider" id="parametreboutonvalider" onclick="validermodifiergenre()" /></legend>
									</fieldset>
									
									<script>
							
										function validermodifiergenre()
										{
											var xhr = new XMLHttpRequest();
											var modifiergenre = document.querySelector('#modifiergenre').value;
								
											var modifiergenre = encodeURIComponent(modifiergenre);
											
											xhr.open('GET', 'site/phpparametreprofil.php?validermodifiergenre=' + modifiergenre);
											
											xhr.onreadystatechange = function()
											{
												if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.querySelector('#modifiergenre').value = "";
													document.querySelector('#resultatmodificationgenre').innerHTML = xhr.responseText;
													confirmresultatmodificationgenre()
												}
											};
											
											xhr.send(null);
										}
										
										function confirmresultatmodificationgenre()
										{
											if(document.querySelector('#resultatmodificationgenre').innerHTML == "")
											{
												window.setTimeout("location=('site/deconnexion.php');",0);
											}
										}
										
									</script>
							</div>
							</div>
							<div id="contenueparametremodifieravatar">
							<div class="blockcontenueparametremodifier">
								<p class="titreinfo_inscription" style="color:white;font-size:1.8em;">Informations</p>
								<div class="resultatmodification">
									<?php 
									if(isset($msgavatar))
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
										
											#espacemembre
											{
												height: 100%;
											}
											
											#actualitenavigation
											{
												opacity: 0.1;
												cursor: pointer;
											}
											
											#parametrenavigation
											{
												opacity: 1;
												cursor: default;
											}
											
											#blockactualitenavigation
											{
												display: none;
											}
											
											#blockparametrenavigation
											{
												display: block;
											}
											
											#blockprofilpagenoir
											{
												display: block;
											}
											
											#contenueparametremodifieravatar
											{
												right: 35.5%;
											}
										</style>
										<?php echo $msgavatar; ?>
									<?php
									}
								?>
								</div>
								<hr />
								<br />
								<div class="informationparametremodifier" id="informationparametremodifieravatar"><span>Votre avatar vous permet de personnaliser votre profil.</span></div>
								<div id="critereparametremodifieravatar"><span>Sélectionner une image carrée de 5 Mo max.</span></div>
									<form method="post" action="" enctype="multipart/form-data">
										<div class="input-file-container">
										<input class="input-file" id="modifieravatar" name="modifieravatar" type="file" required />
										<label for="modifieravatar" class="input-file-trigger" tabindex="0">Avatar</label>
									</div>
									<p class="file-return"></p>
										<fieldset class="parametrebarreboutonvalider">
										<legend><input type="submit" value="Valider" id="parametreboutonvalider" onclick="validermodifieravatar()" /></legend>
										</fieldset>
									</form>
							</div>
							</div>
							<div id="contenueparametremodifierplandefond">
							<div class="blockcontenueparametremodifier">
								<p class="titreinfo_inscription" style="color:white;font-size:1.8em;">Informations</p>
								<div class="resultatmodification">
								<?php 
									if(isset($msgpdf))
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
										
											#espacemembre
											{
												height: 100%;
											}
											
											#actualitenavigation
											{
												opacity: 0.1;
												cursor: pointer;
											}
											
											#parametrenavigation
											{
												opacity: 1;
												cursor: default;
											}
											
											#blockactualitenavigation
											{
												display: none;
											}
											
											#blockparametrenavigation
											{
												display: block;
											}
											
											#blockprofilpagenoir
											{
												display: block;
											}
											
											#contenueparametremodifierplandefond
											{
												right: 35.5%;
											}
										</style>
										<?php echo $msgpdf; ?>
									<?php
									}
								?>
								</div>
								<hr />
								<br />
								<div class="informationparametremodifier" id="informationparametremodifierplandefond"><span>Votre plan de fond vous permet de personnaliser votre profil.</span></div>
								<div id="critereparametremodifierplandefond"><span>Sélectionner une image rectangulaire d'environ (1920x700) de 10 Mo max.</span></div>
								<form method="post" action="" enctype="multipart/form-data">
									<div class="input-file-container2">
										<input class="input-file2" id="modifierplandefond" name="modifierplandefond" type="file" required />
										<label for="modifierplandefond" class="input-file-trigger2" tabindex="0">Plan de fond</label>
									</div>
									<p class="file-return2"></p>
									<fieldset class="parametrebarreboutonvalider">
										<legend><input type="submit" value="Valider" id="parametreboutonvalider" name="modifierplandefond" /></legend>
									</fieldset>
								</form>
							</div>
							</div>
							<div id="contenueparametremodifiermdp">
							<div class="blockcontenueparametremodifier">
								<p class="titreinfo_inscription" style="color:white;font-size:1.8em;">Informations</p>
								<div id="resultatmodificationmdp" class="resultatmodification">
								</div>
								<hr />
								<br />
								<div class="informationparametremodifier" id="informationparametremodifiermdp"><span>Votre mot de passe vous permet d'accéder à votre compte.</span></div>
								<div id="critereparametremodifiermdp">Saisissez votre mot de passe actuel, pour des raisons de sécurité.<span></span></div>
								<div id="critereparametremodifiernewmdp"><span>Saisissez un mot de passe d'au minimum 5 caractères pour sécuriser votre compte.</span></div>
								<div id="critereparametremodifierconfirmmdp"><span>Saisissez à nouveau votre nouveau mot de passe à l'identique.</span></div>
									<input id="modifiermdp" type="password" placeholder="Mot de passe" required />
									<input id="modifiernewmdp" type="password" placeholder="Nouveau" required />
									<input id="modifierconfirmmdp" type="password" placeholder="Confirmer" required />
									<fieldset class="parametrebarreboutonvalider">
										<legend><input type="submit" value="Valider" id="parametreboutonvalider" onclick="validermodifiermdp()" /></legend>
									</fieldset>
									
									<script>
							
										function validermodifiermdp()
										{
											var xhr = new XMLHttpRequest();
											var modifiermdp = document.querySelector('#modifiermdp').value;
											var modifiernewmdp = document.querySelector('#modifiernewmdp').value;
											var modifierconfirmmdp = document.querySelector('#modifierconfirmmdp').value;
								
											var modifiermdp = encodeURIComponent(modifiermdp);
											var modifiernewmdp = encodeURIComponent(modifiernewmdp);
											var modifierconfirmmdp = encodeURIComponent(modifierconfirmmdp);
											
											xhr.open('GET', 'site/phpparametreprofil.php?validermodifiermdp=' + modifiermdp + '&newmdp=' + modifiernewmdp + '&confirmmdp=' + modifierconfirmmdp);
											
											xhr.onreadystatechange = function()
											{
												if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.querySelector('#modifiermdp').value = "";
													document.querySelector('#modifiernewmdp').value = "";
													document.querySelector('#modifierconfirmmdp').value = "";
													document.querySelector('#resultatmodificationmdp').innerHTML = xhr.responseText;
													confirmresultatmodificationmdp()
												}
											};
											
											xhr.send(null);
										}
										
										function confirmresultatmodificationmdp()
										{
											if(document.querySelector('#resultatmodificationmdp').innerHTML == "")
											{
												window.setTimeout("location=('site/deconnexion.php');",0);
											}
										}
										
									</script>
							</div>
							</div>
						</div>
							<div id="blockdeconnexionnavigation">
							<div class="deconnexionfonddiv">
								<img src="membre/plandefond/<?php echo $_SESSION['plandefond']; ?>" alt="Image" class="deconnexionfonddivimg" />
								<div class="deconnexionfonddiv2">
								</div>
							</div>
								<div id="blockdeconnexionnavigation2">
									<fieldset class="barredeconnexion">
										<legend class="titredeconnexion">Deconnexion</legend>
										<span>Êtes-vous sûr de vouloir vous déconnecter ?</span>
									</fieldset>
									<fieldset class="barreoui">
										<legend><a href="site/deconnexion.php" id="titreoui">Oui</a></legend>
									</fieldset>
									<fieldset class="barreannuler">
										<legend id="titreannuler">Annuler</legend>
									</fieldset>
								</div>
							</div>
						</div>
				</div>
			</section>
		<?php
			}
			}
			else
			{
		?>	
				<div class="blockprofilnonmembre">
					<p class="pprofilnonmembre">Cet espace est réserver exclusivement aux membres.</p>
				</div>
		<?php
			}
		?>
		<script id="cid0020000205644521856" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 251px;height: 426px;">{"handle":"metromanga1","arch":"js","styles":{"a":"cc0000","b":100,"c":"FFFFFF","d":"FFFFFF","k":"cc0000","l":"cc0000","m":"cc0000","n":"FFFFFF","p":"9.36","q":"cc0000","r":100,"pos":"br","cv":1,"cvbg":"CC0000","cvw":251,"cvh":30,"cnrs":"0.26","ticker":1,"fwtickm":1}}</script>
		<?php include("includes/footer.php"); ?>
		<script src="js/profil.js"></script>
	</div>
	</body>
</html>