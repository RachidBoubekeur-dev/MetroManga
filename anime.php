<?php session_start(); ?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<link rel="stylesheet" href="anime.css" />
		<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
		<link href='css/Racing.css' rel='stylesheet' type='text/css'>
		<link href='css/Cookie.css' rel='stylesheet' type='text/css'>
		<link href='css/Raleway.css' rel='stylesheet' type='text/css'>
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.mCustomScrollbar.concat.min.js" ></script>
		<script>
			(function(){
				$(window).on("load",function(){
					$("#body2").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".contenuanimeblockepisodesblock").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".blockepisodessaisoncontenu").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".contenuanimeblockvfblock").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".contenuanimeblockvostfrblock").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".contenuanimeblockcommentairesblock").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".contenuanimeblockscansblock").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".divpagescan").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".blockfilmstitre1contenu").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".blockfilmstitre2contenu").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".contenuanimeblockoavsblock").mCustomScrollbar({
						theme:"inset-1"
					});
					$(".contenuanimeblockgeneriquesblock").mCustomScrollbar({
						theme:"inset-1"
					});
				});
			})(jQuery);
		</script>
		<title>Anime - Metro Manga</title>
	</head>
	<body id="body">
	<div id="body2">
		<?php include("includes/loading.php"); ?>
		<?php include("includes/header.php"); ?>
		<div id="contenuloading">
		<?php
		if(isset($_GET['anime']) AND isset($_GET['episode']))
		{
		$searchanimeid = $db->query('SELECT ID FROM animes WHERE ID =\'' . $_GET['anime'] . '\'');
		$searchanimeidexist = $searchanimeid->rowCount();
		if($searchanimeidexist == 0)
		{
		?>
			<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
			<script>
				window.setTimeout("location=('anime.php');",0);
			</script>
			<style>
				.contenuanime
				{
					display: none;
				}
			</style>
		<?php
		}
		$searchepisodeid = $db->query('SELECT numero FROM episodes WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['episode'] . '\'');
		$searchepisodeidexist = $searchepisodeid->rowCount();
		if($searchepisodeidexist == 0)
		{
		?>
			<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
			<script>
				window.setTimeout("location=('anime.php?anime=<?php echo $_GET['anime'] ?>');",0);
			</script>
			<style>
				.contenuanime
				{
					display: none;
				}
			</style>
		<?php
		}
			$searchinfoanime = $db->query('SELECT * FROM animes WHERE ID =\'' . $_GET['anime'] . '\'');
			$infoanime = $searchinfoanime->fetch();
			
			$searchinfoepisode = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['episode'] . '\'');
			$infoepisode = $searchinfoepisode->fetch();
			
			$precedent = $_GET['episode'] - 1;
			
			$suivant = $_GET['episode'] + 1;
			
			$searchpremierepisode = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero LIMIT 0,1');
			$premierepisode = $searchpremierepisode->fetch();
			
			$searchdernierepisode = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero DESC LIMIT 0,1');
			$dernierepisode = $searchdernierepisode->fetch();
			
			if(isset($_POST['validerinsertnumeroepisode']))
			{
				$numeroepisode = $_POST['insertnumeroepisode'];
			?>
				<script>
					window.setTimeout("location=('anime.php?anime=<?php echo $_GET['anime'] ?>&episode=<?php echo $numeroepisode ?>');",0);
				</script>
			<?php
			}
		?>
		<div class="contenuanime">
			<div class="contenuanimenav">
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>"><img src="images/retour.png" alt="Retour" class="retour" /></a>
				<?php
				if($infoepisode['videovf'] != "")
				{
				?>
					<div class="contenuanimenavvf"><span>Lecteur VF</span></div>
					<style>
					@media screen and (min-width: 1200px)
					{
						.contenuanimenavvf
						{
							width: 100%;
							padding-top: 80px;
							color: white;
						}
						.contenuanimenavvf span
						{
							color: rgb(2,2,2);
							font-family: Racing Sans One;
							font-size: 31px;
							margin-left: 30px;
							cursor: default;
							display: block;
							width: 65%;
						}
						.contenuanimeblockvf
						{
							display: block;
						}
						.contenuanimenavvostfr
						{
							width: 100%;
							height: 45px;
							padding-top: 12px;
							color: white;
						}
						
						.contenuanimenavvostfr span
						{
							cursor: pointer;
						}
						
						.contenuanimeblockvostfr
						{
							left: 100%;
						}
					}
					</style>
				<?php
				}
				else
				{
				?>
					<div class="contenuanimenavvf"><span></span></div>
				<?php
				}
				?>
				<div class="contenuanimenavvostfr"><span>Lecteur VOSTFR</span></div>
				<div class="contenuanimenavcommentaires"><span>Commentaires</span></div>
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>&episode=<?php echo $precedent ?>" ><span class="episodeprecedent"><span>-</span>></span></a>
				<img src="images/valider.png" alt="Valider" class="validerinsertnumeroepisodeimg" />
				<form method="post" action="">
					<input type="number" name="insertnumeroepisode" class="insertnumeroepisode" title="Insérer le numéro de l'épisode" min="<?php echo htmlspecialchars($premierepisode['numero']); ?>" max="<?php echo htmlspecialchars($dernierepisode['numero']); ?>" style="outline:none;" required />
					<input type="submit" value="+" name="validerinsertnumeroepisode" class="validerinsertnumeroepisode" />
				</form>
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>&episode=<?php echo $suivant ?>" ><span class="episodesuivant"><span>-</span>></span></a>
			</div>
			<div class="contenuanimeblockvf">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockvfimg"/>
				<div class="contenuanimeblockvfblock"><br />
					<p class="contenuanimeblockepisodetitre">Épisode <?php echo htmlspecialchars($infoepisode['numero']); ?>: <?php echo htmlspecialchars($infoepisode['titre']); ?></p>
					<iframe src="<?php echo htmlspecialchars($infoepisode['videovf']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-top: -7px;margin-bottom: 50px;" allowfullscreen></iframe>
					
					<span id="signaleVFajax">
					<?php
					$videovf = "VF";
					
					$searchsignalelecteurvf = $db->prepare('SELECT * FROM signaleepisode WHERE IDepisode = ? AND video = ?');
					$searchsignalelecteurvf->execute(array($infoepisode['ID'],$videovf));
					$signaleexistlecteurvf = $searchsignalelecteurvf->rowCount();
					if($signaleexistlecteurvf == 0)
					{
					?>
						<span id="signaleVF"><img src="images/signaler.png" alt="Signaler" class="contenuanimeblockepisodesignaler" style="cursor:pointer;" /></span>
					
						<script>
						
							document.getElementById('signaleVF').onclick = function()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signaleranimelecteurvf=ok&IDanime=<?php echo $_GET['anime']; ?>&IDepisode=<?php echo $infoepisode['ID']; ?>&episode=<?php echo $infoepisode['numero']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#signaleVFajax').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
						</script>
					
					<?php
					}
					else
					{
					?>
						<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>
					<?php
					}
					?>
					</span>
					<?php
					$searchvideolecteurvf = $db->query('SELECT * FROM videoepisodes WHERE IDepisode =\'' . $infoepisode['ID'] . '\' AND lecteurvideo =\'' . 'VF' . '\'');
					while ($videolecteurvf = $searchvideolecteurvf->fetch())
					{
					?>
						<iframe src="<?php echo htmlspecialchars($videolecteurvf['video']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-bottom: 60px;" allowfullscreen></iframe>
					<?php
					}
					$searchvideolecteurvf->closeCursor();
					?>
				</div>
			</div>
			<div class="contenuanimeblockvostfr">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockvostfrimg"/>
				<div class="contenuanimeblockvostfrblock"><br />
					<p class="contenuanimeblockepisodetitre">Épisode <?php echo htmlspecialchars($infoepisode['numero']); ?>: <?php echo htmlspecialchars($infoepisode['titre']); ?></p>
					<iframe src="<?php echo htmlspecialchars($infoepisode['videovostfr']); ?>"  frameborder="0" class="contenuanimeblockepisodevideo" style="margin-top: -7px;margin-bottom:50px;" allowfullscreen></iframe>
					
					<span id="signaleVOSTFRajax">
					<?php
					$videovostfr = "VOSTFR";
					
					$searchsignalelecteurvostfr = $db->prepare('SELECT * FROM signaleepisode WHERE IDepisode = ? AND video = ?');
					$searchsignalelecteurvostfr->execute(array($infoepisode['ID'],$videovostfr));
					$signaleexistlecteurvostfr = $searchsignalelecteurvostfr->rowCount();
					if($signaleexistlecteurvostfr == 0)
					{
					?>
						<span id="signaleVOSTFR"><img src="images/signaler.png" alt="Signaler" class="contenuanimeblockepisodesignaler" style="cursor:pointer" /></span>
						
						<script>
						
							document.getElementById('signaleVOSTFR').onclick = function()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signaleranimelecteurvostfr=ok&IDanime=<?php echo $_GET['anime']; ?>&IDepisode=<?php echo $infoepisode['ID']; ?>&episode=<?php echo $infoepisode['numero']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#signaleVOSTFRajax').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
						</script>
						
					<?php
					}
					else
					{
					?>
						<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>
					<?php
					}
					?>
					</span>
					<?php
					$searchvideolecteurvostfr = $db->query('SELECT * FROM videoepisodes WHERE IDepisode =\'' . $infoepisode['ID'] . '\' AND lecteurvideo =\'' . 'VOSTFR' . '\'');
					while ($videolecteurvostfr = $searchvideolecteurvostfr->fetch())
					{
					?>
						<iframe src="<?php echo htmlspecialchars($videolecteurvostfr['video']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-bottom: 60px;" allowfullscreen></iframe>
					<?php
					}
					$searchvideolecteurvostfr->closeCursor();
					?>
				</div>
			</div>
			<div class="contenuanimeblockcommentaires">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockcommentairesimg"/>
				<div class="contenuanimeblockcommentairesblock"><br />
				<span id="commentaireajax">
					<div class="blockcommentairesblockcommenter">
					<?php
					if(isset($_SESSION['ID']))
					{
						$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesepisodes WHERE IDepisode =\'' . $infoepisode['ID'] . '\'');
						$nbdecommentaires = $searchnbdecommentaires->fetch();
					?>
						<span><img src="membre/avatar/<?php echo $_SESSION['avatar']; ?>" alt="Avatar" class="blockcommenteravatar" /></span>
							<textarea id="blockcommentertextarea" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
							<fieldset class="blockcommenterajouterbarre">
								<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaire()" /></legend>
							</fieldset>
						<span class="nbdecommentaires"><?php echo $nbdecommentaires['nbdecommentaires']; ?></span>
						<?php
						}
						else
						{
						?>
							<p class="blockcommenternonmembre">La création du commentaire est exclusivement réservée aux membres.</p>
						<?php
						}
						?>	
					</div>
					<br />
					<?php		
						$searchinfocommentaire = $db->query('SELECT * FROM commentairesepisodes WHERE IDepisode =\'' . $infoepisode['ID'] . '\' ORDER BY ID DESC LIMIT 0, 100');
						while ($infocommentaire = $searchinfocommentaire->fetch())
						{
						$searchinfocommentairemembre = $db->query('SELECT * FROM membres WHERE ID =\'' . $infocommentaire['IDmembre'] . '\'');
						$infocommentairemembre = $searchinfocommentairemembre->fetch();
					?>
					<div class="infocommentaire">
						<?php
						$searchsignale = $db->prepare('SELECT * FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
						$searchsignale->execute(array($infocommentaire['ID'],$infocommentaire['lien']));
						$signaleexist = $searchsignale->rowCount();
						if($signaleexist == 0)
						{
						?>
							<span onclick="signalecommentaire<?php echo $infocommentaire['ID']; ?>()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>
						<?php
						}
						else
						{
						if(isset($_SESSION['ID']))
						{
							if($_SESSION['ID'] == '1')
							{
							?>
								<span onclick="supprimercommentaire<?php echo $infocommentaire['ID']; ?>()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>
							<?php
							}
						}
						?>
							<span><img src="images/signalerrouge.png" alt="Signaler" class="infocommentairesignaler" style="cursor:default;"/></span>
						<?php
						}
						?>
							<span><a href="profil.php?id=<?php echo $infocommentairemembre['ID']; ?>"><img src="membre/avatar/<?php echo $infocommentairemembre['avatar']; ?>" alt="Avatar" class="infocommentaireavatar" /></a></span>
							<span class="infocommentairepseudo"><a href="profil.php?id=<?php echo $infocommentairemembre['ID']; ?>" style="color:white;text-decoration:none;"><?php echo $infocommentairemembre['pseudo']; ?></a></span>
							<div class="infocommentairecontenu">
								<span class="infocommentairecontenuspan"><?php echo $infocommentaire['commentaire']; ?></span>
							</div>
							<span class="infocommentairedate"><?php echo date("H:i", strtotime($infocommentaire['date_creation'])); ?><span style="opacity:0;">-</span><?php echo date("d/m/Y", strtotime($infocommentaire['date_creation'])); ?></span>
					</div>
					<?php
					}
					$searchinfocommentaire->closeCursor();
					?>
					<script>
					<?php
					$searchinfocommentairejs = $db->query('SELECT * FROM commentairesepisodes WHERE IDepisode =\'' . $infoepisode['ID'] . '\' ORDER BY ID DESC LIMIT 0, 100');
					while ($infocommentairejs = $searchinfocommentairejs->fetch())
					{
					?>							
							function signalecommentaire<?php echo $infocommentairejs['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signalecommentaire=ok&IDepisode=<?php echo $infoepisode['ID']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#commentaireajax').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
							function supprimercommentaire<?php echo $infocommentairejs['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?supprimercommentaire=ok&IDepisode=<?php echo $infoepisode['ID']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>&LIENcommentaire=<?php echo $infocommentairejs['lien']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#commentaireajax').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
					<?php
					}
					$searchinfocommentairejs->closeCursor();
					?>
					</script>
				</span>
				</div>
			</div>
			<script>
			
				function ajoutercommentaire()
				{
					var xhr = new XMLHttpRequest();
					var valuecommentaire = document.getElementById('blockcommentertextarea').value;
					
					var valuecommentaire = encodeURIComponent(valuecommentaire);
					
					xhr.open('GET', 'site/phpanime.php?ajoutercommentaire=' + valuecommentaire + '&IDanime=<?php echo $_GET['anime']; ?>&IDepisode=<?php echo $infoepisode['ID']; ?>&episode=<?php echo $infoepisode['numero']; ?>');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector('#commentaireajax').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				document.querySelector(".contenuanimenavvf").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockvf')).left=='100%')
					{
						document.querySelector(".contenuanimeblockvf").style.left="21%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvf span").style.cursor="default";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
					else
					{
						document.querySelector(".contenuanimeblockvf").style.left="21%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvf span").style.cursor="default";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
				}
				
				document.querySelector(".contenuanimenavvostfr").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockvostfr')).left=='100%')
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="21%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="default";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
					else
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="21%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="default";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
				}
				
				document.querySelector(".contenuanimenavcommentaires").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockcommentaires')).left=='100%')
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="21%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="default";
					}
					else
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="21%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="default";
					}
				}
			</script>
		</div>
		<?php
		}
		else if(isset($_GET['anime']) AND isset($_GET['scan']))
		{
		$searchanimeid = $db->query('SELECT ID FROM animes WHERE ID =\'' . $_GET['anime'] . '\'');
		$searchanimeidexist = $searchanimeid->rowCount();
		if($searchanimeidexist == 0)
		{
		?>
			<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
			<script>
				window.setTimeout("location=('anime.php');",0);
			</script>
			<style>
				.contenuanime
				{
					display: none;
				}
			</style>
		<?php
		}
		$searchscanid = $db->query('SELECT numero FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
		$searchscanidexist = $searchscanid->rowCount();
		if($searchscanidexist == 0)
		{
		?>
			<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
			<script>
				window.setTimeout("location=('anime.php?anime=<?php echo $_GET['anime'] ?>');",0);
			</script>
			<style>
				.contenuanime
				{
					display: none;
				}
			</style>
		<?php
		}
			$searchinfoanime = $db->query('SELECT * FROM animes WHERE ID =\'' . $_GET['anime'] . '\'');
			$infoanime = $searchinfoanime->fetch();
			
			$searchinfoscan = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
			$infoscan = $searchinfoscan->fetch();
			
			$precedent = $_GET['scan'] - 1;
			
			$suivant = $_GET['scan'] + 1;
			
			$searchpremierscan = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero LIMIT 0,1');
			$premierscan = $searchpremierscan->fetch();
			
			$searchdernierscan = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero DESC LIMIT 0,1');
			$dernierscan = $searchdernierscan->fetch();
			
			if(isset($_POST['validerinsertnumeroscan']))
			{
				$numeroscan = htmlspecialchars($_POST['insertnumeroscan']);
			?>
				<script>
					window.setTimeout("location=('anime.php?anime=<?php echo $_GET['anime'] ?>&scan=<?php echo $numeroscan ?>');",0);
				</script>
			<?php
			}
		?>
		<div class="contenuanime">
			<div class="contenuanimenav">
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>"><img src="images/retour.png" alt="Retour" class="retour" /></a>
				<div class="contenuanimenavvf"><span>Scan</span></div>
				<div class="contenuanimenavcommentaires" style="padding-top:0px;margin-top:29px;margin-bottom:20px;"><span>Commentaires</span></div>
				<div class="divpagescan">
				<?php
				$searchinfoimgscan = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
				while ($infoimgscan = $searchinfoimgscan->fetch())
				{
					$infoimgscansuivant = $infoimgscan['page'] + 1;
				?>
					<a href="#next" style="text-decoration:none;"><span id="pagescan<?php echo htmlspecialchars($infoimgscan['page']); ?>" class="pagescan"><?php echo htmlspecialchars($infoimgscan['page']); ?></span></a>
				<?php
				}
				$searchinfoimgscan->closeCursor();
				?>
				</div>
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>&scan=<?php echo $precedent ?>" ><span class="episodeprecedent"><span>-</span>></span></a>
				<img src="images/valider.png" alt="Valider" class="validerinsertnumeroepisodeimg" />
				<form method="post" action="">
					<input type="number" name="insertnumeroscan" class="insertnumeroepisode" title="Insérer le numéro du scan." min="<?php echo htmlspecialchars($premierscan['numero']); ?>" max="<?php echo htmlspecialchars($dernierscan['numero']); ?>" style="outline:none;" required />
					<input type="submit" value="+" name="validerinsertnumeroscan" class="validerinsertnumeroepisode" />
				</form>
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>&scan=<?php echo $suivant ?>" ><span class="episodesuivant"><span>-</span>></span></a>
			</div>
			<div class="contenuanimeblockvf">
			<style>
				@media screen and (min-width: 1200px)
				{
					.contenuanimenavvf
					{
						width: 100%;
						padding-top: 80px;
						color: white;
					}
					.contenuanimenavvf span
					{
						color: rgb(2,2,2);
						font-family: Racing Sans One;
						font-size: 31px;
						margin-left: 30px;
						cursor: default;
						display: block;
						width: 30%;
					}
					.contenuanimeblockvf
					{
						display: block;
					}
				}
			</style>
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockvfimg"/>
				<div class="contenuanimeblockvfblock" id="next"><br />
					<p class="contenuanimeblockepisodetitre" >Scan <?php echo htmlspecialchars($infoscan['numero']); ?></p>
					<div class="contenuanimeblockscan">
					<?php						
					$searchinfoimgscan = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
					while ($infoimgscan = $searchinfoimgscan->fetch())
					{
					?>
						<a href="#next"><span><img src="scan/<?php echo $infoimgscan['image']; ?>" alt="Scan <?php echo htmlspecialchars($infoimgscan['page']); ?>" id="contenuanimeblockscanimg<?php echo htmlspecialchars($infoimgscan['page']); ?>" class="contenuanimeblockscanimg" /></span></a>
					<?php
					}
					$searchinfoimgscan->closeCursor();
					?>
					</div>
				</div>
			</div>
			<div class="contenuanimeblockcommentaires">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockcommentairesimg"/>
				<div class="contenuanimeblockcommentairesblock"><br />
					<span id="commentaireajaxscan">
					<div class="blockcommentairesblockcommenter">
					<?php
					if(isset($_SESSION['ID']))
					{
						$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesscans WHERE IDanime =\'' . $_GET['anime'] . '\' AND IDscan =\'' . $infoscan['numero'] . '\'');
						$nbdecommentaires = $searchnbdecommentaires->fetch();
					?>
						<span><img src="membre/avatar/<?php echo $_SESSION['avatar']; ?>" alt="Avatar" class="blockcommenteravatar" /></span>
							<textarea id="blockcommentertextareascan" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
							<fieldset class="blockcommenterajouterbarre">
								<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairescan()" /></legend>
							</fieldset>
						<span class="nbdecommentaires"><?php echo $nbdecommentaires['nbdecommentaires']; ?></span>
						<?php
						}
						else
						{
						?>
							<p class="blockcommenternonmembre">La création du commentaire est exclusivement réservée aux membres.</p>
						<?php
						}
						?>	
					</div>
					<br />
					<?php		
					$searchinfocommentaire = $db->query('SELECT * FROM commentairesscans WHERE IDanime =\'' . $_GET['anime'] . '\' AND IDscan =\'' . $infoscan['numero'] . '\' ORDER BY ID DESC LIMIT 0, 100');
					while ($infocommentaire = $searchinfocommentaire->fetch())
					{
					$searchinfocommentairemembre = $db->query('SELECT * FROM membres WHERE ID =\'' . $infocommentaire['IDmembre'] . '\'');
					$infocommentairemembre = $searchinfocommentairemembre->fetch();
					?>
					<div class="infocommentaire">
						<?php
						$searchsignale = $db->prepare('SELECT * FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
						$searchsignale->execute(array($infocommentaire['ID'],$infocommentaire['lien']));
						$signaleexist = $searchsignale->rowCount();
						if($signaleexist == 0)
						{
						?>
							<span onclick="signalecommentairescan<?php echo $infocommentaire['ID']; ?>()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>
						<?php
						}
						else
						{
						if(isset($_SESSION['ID']))
						{
							if($_SESSION['ID'] == '1')
							{
							?>
								<span onclick="supprimercommentairescan<?php echo $infocommentaire['ID']; ?>()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>
							<?php
							}
						}
						?>
							<span><img src="images/signalerrouge.png" alt="Signaler" class="infocommentairesignaler" style="cursor:default;"/></span>
						<?php
						}
						?>
							<span><a href="profil.php?id=<?php echo $infocommentairemembre['ID']; ?>" target="_blank"><img src="membre/avatar/<?php echo $infocommentairemembre['avatar']; ?>" alt="Avatar" class="infocommentaireavatar" /></a></span>
							<span class="infocommentairepseudo"><a href="profil.php?id=<?php echo $infocommentairemembre['ID']; ?>" style="color:white;text-decoration:none;"><?php echo $infocommentairemembre['pseudo']; ?></a></span>
							<div class="infocommentairecontenu">
								<span class="infocommentairecontenuspan"><?php echo $infocommentaire['commentaire']; ?></span>
							</div>
							<span class="infocommentairedate"><?php echo date("H:i", strtotime($infocommentaire['date_creation'])); ?><span style="opacity:0;">-</span><?php echo date("d/m/Y", strtotime($infocommentaire['date_creation'])); ?></span>
					</div>
					<?php
					}
					$searchinfocommentaire->closeCursor();
					?>
				<script>
					<?php
					$searchinfocommentairejs = $db->query('SELECT * FROM commentairesscans WHERE IDanime =\'' . $_GET['anime'] . '\' AND IDscan =\'' . $infoscan['numero'] . '\' ORDER BY ID DESC LIMIT 0, 100');
					while ($infocommentairejs = $searchinfocommentairejs->fetch())
					{
					?>							
							function signalecommentairescan<?php echo $infocommentairejs['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signalecommentairescan=ok&IDanime=<?php echo $_GET['anime']; ?>&IDscan=<?php echo $infoscan['numero']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#commentaireajaxscan').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
							function supprimercommentairescan<?php echo $infocommentairejs['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?supprimercommentairescan=ok&IDanime=<?php echo $_GET['anime']; ?>&IDscan=<?php echo $infoscan['numero']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>&LIENcommentaire=<?php echo $infocommentairejs['lien']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#commentaireajaxscan').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
					<?php
					}
					$searchinfocommentairejs->closeCursor();
					?>
					</script>
				</span>
				</div>
			</div>
			<script>
				
				$('a[href^="#"]').click(function(){
				var the_id = $(this).attr("href");
				$("").mCustomScrollbar("scrollTo",$(the_id).offset().top -109, { scrollInertia: 0 }); return false;});
				
				function ajoutercommentairescan()
				{
					var xhr = new XMLHttpRequest();
					var valuecommentaire = document.getElementById('blockcommentertextareascan').value;
					
					var valuecommentaire = encodeURIComponent(valuecommentaire);
					
					xhr.open('GET', 'site/phpanime.php?ajoutercommentairescan=' + valuecommentaire + '&IDanime=<?php echo $_GET['anime']; ?>&IDscan=<?php echo $infoscan['numero']; ?>');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector('#commentaireajaxscan').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				document.querySelector(".contenuanimenavvf").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockvf')).left=='100%')
					{
						document.querySelector(".contenuanimeblockvf").style.left="21%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvf span").style.cursor="default";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
					else
					{
						document.querySelector(".contenuanimeblockvf").style.left="21%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvf span").style.cursor="default";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
				}
				
				document.querySelector(".contenuanimenavcommentaires").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockcommentaires')).left=='100%')
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="21%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="default";
					}
					else
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="21%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="default";
					}
				}
				
				<?php
				$searchinfoimgscan = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
				while ($infoimgscan = $searchinfoimgscan->fetch())
				{
					$searchnbimgscan = $db->query('SELECT COUNT(*) AS nbimgscan FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
					$nbimgscan = $searchnbimgscan->fetch();
					
					$nbimgscansuivant = $nbimgscan['nbimgscan'] + 1;
					
					$infoimgscansuivant = $infoimgscan['page'] + 1;
				?>
					document.querySelector("#contenuanimeblockscanimg<?php echo $infoimgscan['page']; ?>").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('#contenuanimeblockscanimg<?php echo $infoimgscan['page']; ?>')).display=='block')
						{
							document.querySelector("#contenuanimeblockscanimg<?php echo $infoimgscan['page']; ?>").style.display="none";
							<?php
							$searchinfoimgscan2 = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
							while ($infoimgscan2 = $searchinfoimgscan2->fetch())
							{
							?>
								document.querySelector("#pagescan<?php echo $infoimgscan2['page']; ?>").style.color="white";
								document.querySelector("#pagescan<?php echo $infoimgscan2['page']; ?>").style.cursor="pointer";
							<?php
							}
							$searchinfoimgscan2->closeCursor();
							?>
							<?php
							if($infoimgscansuivant == $nbimgscansuivant)
							{
							?>
								document.querySelector("#contenuanimeblockscanimg1").style.display="block";
								document.querySelector("#pagescan1").style.color="rgb(2,2,2)";
								document.querySelector("#pagescan1").style.cursor="default";
							<?php
							}
							else
							{
							?>
								document.querySelector("#contenuanimeblockscanimg<?php echo $infoimgscansuivant; ?>").style.display="block";
								document.querySelector("#pagescan<?php echo $infoimgscansuivant; ?>").style.color="rgb(2,2,2)";
								document.querySelector("#pagescan<?php echo $infoimgscansuivant; ?>").style.cursor="default";
							<?php
							}
							?>
						}
						else
						{
							document.querySelector("#contenuanimeblockscanimg<?php echo $infoimgscan['page']; ?>").style.display="none";
							<?php
							$searchinfoimgscan2 = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
							while ($infoimgscan2 = $searchinfoimgscan2->fetch())
							{
							?>
								document.querySelector("#pagescan<?php echo $infoimgscan2['page']; ?>").style.color="white";
								document.querySelector("#pagescan<?php echo $infoimgscan2['page']; ?>").style.cursor="pointer";
							<?php
							}
							$searchinfoimgscan2->closeCursor();
							?>
							<?php
							if($infoimgscansuivant == $nbimgscansuivant)
							{
							?>
								document.querySelector("#contenuanimeblockscanimg1").style.display="block";
								document.querySelector("#pagescan1").style.color="rgb(2,2,2)";
								document.querySelector("#pagescan1").style.cursor="default";
							<?php
							}
							else
							{
							?>
								document.querySelector("#contenuanimeblockscanimg<?php echo $infoimgscansuivant; ?>").style.display="block";
								document.querySelector("#pagescan<?php echo $infoimgscansuivant; ?>").style.color="rgb(2,2,2)";
								document.querySelector("#pagescan<?php echo $infoimgscansuivant; ?>").style.cursor="default";
							<?php
							}
							?>
						}
					}
				<?php
				}
				$searchinfoimgscan->closeCursor();
				?>
				
				document.querySelector("#pagescan1").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('#contenuanimeblockscanimg1')).display=='none')
					{
						<?php
						$searchinfoimgscan2 = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
						while ($infoimgscan2 = $searchinfoimgscan2->fetch())
						{
						?>
							document.querySelector("#contenuanimeblockscanimg<?php echo $infoimgscan2['page']; ?>").style.display="none";
							document.querySelector("#pagescan<?php echo $infoimgscan2['page']; ?>").style.color="white";
							document.querySelector("#pagescan<?php echo $infoimgscan2['page']; ?>").style.cursor="pointer";
						<?php
						}
						$searchinfoimgscan2->closeCursor();
						?>
						document.querySelector("#contenuanimeblockscanimg1").style.display="block";
						document.querySelector("#pagescan1").style.color="rgb(2,2,2)";
						document.querySelector("#pagescan1").style.cursor="default";
					}
					else
					{
						<?php
						$searchinfoimgscan2 = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
						while ($infoimgscan2 = $searchinfoimgscan2->fetch())
						{
						?>
							document.querySelector("#contenuanimeblockscanimg<?php echo $infoimgscan2['page']; ?>").style.display="none";
							document.querySelector("#pagescan<?php echo $infoimgscan2['page']; ?>").style.color="white";
							document.querySelector("#pagescan<?php echo $infoimgscan2['page']; ?>").style.cursor="pointer";
						<?php
						}
						$searchinfoimgscan2->closeCursor();
						?>
						document.querySelector("#contenuanimeblockscanimg1").style.display="block";
						document.querySelector("#pagescan1").style.color="rgb(2,2,2)";
						document.querySelector("#pagescan1").style.cursor="default";
					}
				}
				
				<?php
				$searchinfoimgscan = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
				while ($infoimgscan = $searchinfoimgscan->fetch())
				{				
					$infoimgscansuivant = $infoimgscan['page'] + 1;
				?>
					document.querySelector("#pagescan<?php echo $infoimgscansuivant; ?>").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('#contenuanimeblockscanimg<?php echo $infoimgscansuivant; ?>')).display=='none')
						{
							<?php
							$searchinfoimgscan2 = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
							while ($infoimgscan2 = $searchinfoimgscan2->fetch())
							{
							?>
								document.querySelector("#contenuanimeblockscanimg<?php echo $infoimgscan2['page']; ?>").style.display="none";
								document.querySelector("#pagescan<?php echo $infoimgscan2['page']; ?>").style.color="white";
								document.querySelector("#pagescan<?php echo $infoimgscan2['page']; ?>").style.cursor="pointer";
							<?php
							}
							$searchinfoimgscan2->closeCursor();
							?>
							document.querySelector("#contenuanimeblockscanimg<?php echo $infoimgscansuivant; ?>").style.display="block";
							document.querySelector("#pagescan<?php echo $infoimgscansuivant; ?>").style.color="rgb(2,2,2)";
							document.querySelector("#pagescan<?php echo $infoimgscansuivant; ?>").style.cursor="default";
						}
						else
						{
							<?php
							$searchinfoimgscan2 = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['scan'] . '\'');
							while ($infoimgscan2 = $searchinfoimgscan2->fetch())
							{
							?>
								document.querySelector("#contenuanimeblockscanimg<?php echo $infoimgscan2['page']; ?>").style.display="none";
								document.querySelector("#pagescan<?php echo $infoimgscan2['page']; ?>").style.color="white";
								document.querySelector("#pagescan<?php echo $infoimgscan2['page']; ?>").style.cursor="pointer";
							<?php
							}
							$searchinfoimgscan2->closeCursor();
							?>
							document.querySelector("#contenuanimeblockscanimg<?php echo $infoimgscansuivant; ?>").style.display="block";
							document.querySelector("#pagescan<?php echo $infoimgscansuivant; ?>").style.color="rgb(2,2,2)";
							document.querySelector("#pagescan<?php echo $infoimgscansuivant; ?>").style.cursor="default";
						}
					}
				<?php
				}
				$searchinfoimgscan->closeCursor();
				?>
			</script>
		</div>
		<?php
		}
		else if(isset($_GET['anime']) AND isset($_GET['filmanime']))
		{
		$searchanimeid = $db->query('SELECT ID FROM animes WHERE ID =\'' . $_GET['anime'] . '\'');
		$searchanimeidexist = $searchanimeid->rowCount();
		if($searchanimeidexist == 0)
		{
		?>
			<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
			<script>
				window.setTimeout("location=('anime.php');",0);
			</script>
			<style>
				.contenuanime
				{
					display: none;
				}
			</style>
		<?php
		}
		$searchfilmanimeid = $db->query('SELECT numero FROM filmsanimes WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['filmanime'] . '\'');
		$searchfilmanimeidexist = $searchfilmanimeid->rowCount();
		if($searchfilmanimeidexist == 0)
		{
		?>
			<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
			<script>
				window.setTimeout("location=('anime.php?anime=<?php echo $_GET['anime'] ?>');",0);
			</script>
			<style>
				.contenuanime
				{
					display: none;
				}
			</style>
		<?php
		}
			$searchinfoanime = $db->query('SELECT * FROM animes WHERE ID =\'' . $_GET['anime'] . '\'');
			$infoanime = $searchinfoanime->fetch();
			
			$searchinfofilmanime = $db->query('SELECT * FROM filmsanimes WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['filmanime'] . '\'');
			$infofilmanime = $searchinfofilmanime->fetch();
			
			$precedent = $_GET['filmanime'] - 1;
			
			$suivant = $_GET['filmanime'] + 1;
			
			$searchpremierfilmanime = $db->query('SELECT * FROM filmsanimes WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero LIMIT 0,1');
			$premierfilmanime = $searchpremierfilmanime->fetch();
			
			$searchdernierfilmanime = $db->query('SELECT * FROM filmsanimes WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero DESC LIMIT 0,1');
			$dernierfilmanime = $searchdernierfilmanime->fetch();
			
			if(isset($_POST['validerinsertnumerofilmanime']))
			{
				$numerofilmanime = $_POST['insertnumerofilmanime'];
			?>
				<script>
					window.setTimeout("location=('anime.php?anime=<?php echo $_GET['anime'] ?>&filmanime=<?php echo $numerofilmanime ?>');",0);
				</script>
			<?php
			}
		?>
		<div class="contenuanime">
			<div class="contenuanimenav">
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>"><img src="images/retour.png" alt="Retour" class="retour" /></a>
				<div class="contenuanimenavfilmanimeaffiche"><span>Affiche</span></div>
				<?php
				if($infofilmanime['videovf'] != "")
				{
				?>
					<div class="contenuanimenavfilmanimevf"><span>Lecteur VF</span></div>
					<style>
						@media screen and (min-width: 1200px)
						{
							.contenuanimenavfilmanimevf
							{
								width: 100%;
								margin-top: 12px;
								color: white;
							}
							.contenuanimenavfilmanimevf span
							{
								color: white;
								font-family: Racing Sans One;
								font-size: 31px;
								margin-left: 30px;
								cursor: pointer;
								display: block;
								width: 65%;
							}
							.contenuanimeblockvf
							{
								display: block;
							}
							.contenuanimenavvostfr
							{
								width: 100%;
								height: 45px;
								margin-top: 78px;
								padding-top: 0px;
								color: white;
							}
							.contenuanimenavvostfr span
							{
								cursor: pointer;
							}
							.contenuanimeblockvostfr
							{
								left: 100%;
							}
						}
					</style>
				<?php
				}
				else
				{
				?>
					<div class="contenuanimenavfilmanimevf"><span></span></div>
					
					<style>
					
						.contenuanimenavvostfr
						{
							color: white;
						}
						
					</style>
				<?php
				}
				?>
				<div class="contenuanimenavvostfr"><span>Lecteur VOSTFR</span></div>
				<div class="contenuanimenavcommentaires"><span>Commentaires</span></div>
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>&filmanime=<?php echo $precedent ?>" ><span class="episodeprecedent"><span>-</span>></span></a>
				<img src="images/valider.png" alt="Valider" class="validerinsertnumeroepisodeimg" />
				<form method="post" action="">
					<input type="number" name="insertnumerofilmanime" class="insertnumeroepisode" title="Insérer le numéro du film" min="<?php echo htmlspecialchars($premierfilmanime['numero']); ?>" max="<?php echo htmlspecialchars($dernierfilmanime['numero']); ?>" style="outline:none;" required />
					<input type="submit" value="+" name="validerinsertnumerofilmanime" class="validerinsertnumeroepisode" />
				</form>
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>&filmanime=<?php echo $suivant ?>" ><span class="episodesuivant"><span>-</span>></span></a>
			</div>
			<div class="contenuanimeblockaffiche">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockafficheimg"/>
				<div class="contenuanimeblockafficheblock"><br />
					<span><img src="filmanime/<?php echo $infofilmanime['image']; ?>" alt="<?php echo htmlspecialchars($infofilmanime['titre']); ?>" class="contenuanimeblockfilmanimeimg" /></span>
					<span class="contenuanimeblockfilmanimetitre"><?php echo htmlspecialchars($infofilmanime['titre']); ?></span>
					<div class="blocknoteretoilefilmanime">
					<?php
					$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesfilmanime WHERE IDfilmanime =\'' . $infofilmanime['ID'] . '\'');
					$notemoy = $searchmoynote->fetch();	
					if($notemoy['notemoy'] == 0)
					{
					?>
						<span class="contenuanimeblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>
					<?php
					}
					else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
					{
					?>
						<span class="contenuanimeblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>
					<?php
					}
					else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
					{
					?>
						<span class="contenuanimeblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>
					<?php
					}
					else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
					{
					?>
						<span class="contenuanimeblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>
					<?php
					}
					else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
					{
					?>
						<span class="contenuanimeblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>
					<?php
					}
					else if($notemoy['notemoy'] >= 5)
					{
					?>
						<span class="contenuanimeblockaffichenote">★★★★★</span>
					<?php
					}
					
						if(isset($_SESSION['ID']))
						{
							$searchnote = $db->prepare('SELECT * FROM notesfilmanime WHERE IDfilmanime = ? AND IDmembre = ?');
							$searchnote->execute(array($infofilmanime['ID'],$_SESSION['ID']));
							$noteexist = $searchnote->rowCount();
							if($noteexist == 0)
							{
							?>
									<input type="submit" value="★" id="blocknoteretoile1filmanime" class="blocknoteretoile1filmanime" />
									<input type="submit" value="★" id="blocknoteretoile2filmanime" class="blocknoteretoile2filmanime" />
									<input type="submit" value="★" id="blocknoteretoile3filmanime" class="blocknoteretoile3filmanime" />
									<input type="submit" value="★" id="blocknoteretoile4filmanime" class="blocknoteretoile4filmanime" />
									<input type="submit" value="★" id="blocknoteretoile5filmanime" class="blocknoteretoile5filmanime" />
									
								<script>
								
									document.getElementById('blocknoteretoile1filmanime').onclick = function()
									{
										var xhr = new XMLHttpRequest();
										
										xhr.open('GET', 'site/phpanime.php?blocknoteretoile1filmanime=ok&IDanime=<?php echo $_GET['anime']; ?>&IDfilmanime=<?php echo $infofilmanime['ID']; ?>');
										
										xhr.onreadystatechange = function() 
										{
											if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.querySelector('.blocknoteretoilefilmanime').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
									
									document.getElementById('blocknoteretoile2filmanime').onclick = function()
									{
										var xhr = new XMLHttpRequest();
										
										xhr.open('GET', 'site/phpanime.php?blocknoteretoile2filmanime=ok&IDanime=<?php echo $_GET['anime']; ?>&IDfilmanime=<?php echo $infofilmanime['ID']; ?>');
										
										xhr.onreadystatechange = function() 
										{
											if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.querySelector('.blocknoteretoilefilmanime').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
									
									document.getElementById('blocknoteretoile3filmanime').onclick = function()
									{
										var xhr = new XMLHttpRequest();
										
										xhr.open('GET', 'site/phpanime.php?blocknoteretoile3filmanime=ok&IDanime=<?php echo $_GET['anime']; ?>&IDfilmanime=<?php echo $infofilmanime['ID']; ?>');
										
										xhr.onreadystatechange = function() 
										{
											if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.querySelector('.blocknoteretoilefilmanime').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
									
									document.getElementById('blocknoteretoile4filmanime').onclick = function()
									{
										var xhr = new XMLHttpRequest();
										
										xhr.open('GET', 'site/phpanime.php?blocknoteretoile4filmanime=ok&IDanime=<?php echo $_GET['anime']; ?>&IDfilmanime=<?php echo $infofilmanime['ID']; ?>');
										
										xhr.onreadystatechange = function() 
										{
											if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.querySelector('.blocknoteretoilefilmanime').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
									
									document.getElementById('blocknoteretoile5filmanime').onclick = function()
									{
										var xhr = new XMLHttpRequest();
										
										xhr.open('GET', 'site/phpanime.php?blocknoteretoile5filmanime=ok&IDanime=<?php echo $_GET['anime']; ?>&IDfilmanime=<?php echo $infofilmanime['ID']; ?>');
										
										xhr.onreadystatechange = function() 
										{
											if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.querySelector('.blocknoteretoilefilmanime').innerHTML = xhr.responseText;
											}
										};
										
										xhr.send(null);
									}
						
								</script>
									
							<?php
							}
						}
						?>
					</div>
					<img src="images/bandeannonce.png" alt="Regarder la bande annonce" title="Regarder la bande annonce" class="contenuanimeblockaffichebandeannonce" />
					<div class="blockaffichebandeannoncecontenu" style="margin-top:-200px;">
						<img src="images/erreur.png" alt="Fermez" class="blockaffichebandeannoncefermez" />
						<iframe  width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
					</div>
					<span class="contenuanimeblockfilmanimedurer">Durée: <?php echo htmlspecialchars($infofilmanime['durer']); ?></span>
					<span class="contenuanimeblockfilmanimedate">Date: <?php echo htmlspecialchars($infofilmanime['date']); ?></span>
					<span class="contenuanimeblockfilmanimerealisateur">Réalisateur: <?php echo htmlspecialchars($infofilmanime['realisateur']); ?></span>
					<span class="contenuanimeblockfilmanimesynopsis"><?php echo htmlspecialchars($infofilmanime['synopsis']); ?></span>
				</div>
			</div>
			<div class="contenuanimeblockvf" style="left: 100%;z-index:1;">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockvfimg"/>
				<div class="contenuanimeblockvfblock"><br />
					<p class="contenuanimeblockepisodetitre">Film <?php echo htmlspecialchars($infofilmanime['numero']); ?>: <?php echo htmlspecialchars($infofilmanime['titre']); ?></p>
					<iframe src="<?php echo htmlspecialchars($infofilmanime['videovf']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-top: -7px;margin-bottom:50px;" allowfullscreen></iframe>
					<span id="signaleVFajaxfilmanime">
					<?php
					$videovf = "VF";
					
					$searchsignalelecteurvf = $db->prepare('SELECT * FROM signalefilmanime WHERE IDfilmanime = ? AND video = ?');
					$searchsignalelecteurvf->execute(array($infofilmanime['ID'],$videovf));
					$signaleexistlecteurvf = $searchsignalelecteurvf->rowCount();
					if($signaleexistlecteurvf == 0)
					{
					?>
						<span id="signaleVFfilmanime"><img src="images/signaler.png" alt="Signaler" class="contenuanimeblockepisodesignaler" style="cursor:pointer;" /></span>
					
						<script>
						
							document.getElementById('signaleVFfilmanime').onclick = function()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signaleranimelecteurvffilmanime=ok&IDanime=<?php echo $_GET['anime']; ?>&IDfilmanime=<?php echo $infofilmanime['ID']; ?>&filmanime=<?php echo $infofilmanime['numero']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#signaleVFajaxfilmanime').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
						</script>	
							
					<?php
					}
					else
					{
					?>
						<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>
					<?php
					}
					?>
					</span>
					<?php
					$searchvideolecteurvf = $db->query('SELECT * FROM videofilmanime WHERE IDfilmanime =\'' . $infofilmanime['ID'] . '\' AND lecteurvideo =\'' . 'VF' . '\'');
					while ($videolecteurvf = $searchvideolecteurvf->fetch())
					{
					?>
						<iframe src="<?php echo htmlspecialchars($videolecteurvf['video']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-bottom: 60px;" allowfullscreen></iframe>
					<?php
					}
					$searchvideolecteurvf->closeCursor();
					?>
				</div>
			</div>
			<div class="contenuanimeblockvostfr">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockvostfrimg"/>
				<div class="contenuanimeblockvostfrblock"><br />
					<p class="contenuanimeblockepisodetitre">Film <?php echo htmlspecialchars($infofilmanime['numero']); ?>: <?php echo htmlspecialchars($infofilmanime['titre']); ?></p>
					<iframe src="<?php echo htmlspecialchars($infofilmanime['videovostfr']); ?>"  frameborder="0" class="contenuanimeblockepisodevideo" style="margin-top: -7px;margin-bottom: 60px;" allowfullscreen></iframe>
					<span id="signaleVOSTFRajaxfilmanime">
					<?php
					$videovostfr = "VOSTFR";
					
					$searchsignalelecteurvostfr = $db->prepare('SELECT * FROM signalefilmanime WHERE IDfilmanime = ? AND video = ?');
					$searchsignalelecteurvostfr->execute(array($infofilmanime['ID'],$videovostfr));
					$signaleexistlecteurvostfr = $searchsignalelecteurvostfr->rowCount();
					if($signaleexistlecteurvostfr == 0)
					{
					?>
						<span id="signaleVOSTFRfilmanime"><img src="images/signaler.png" alt="Signaler" class="contenuanimeblockepisodesignaler" style="cursor:pointer;" /></span>
						
						<script>
						
							document.getElementById('signaleVOSTFRfilmanime').onclick = function()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signaleranimelecteurvostfrfilmanime=ok&IDanime=<?php echo $_GET['anime']; ?>&IDfilmanime=<?php echo $infofilmanime['ID']; ?>&filmanime=<?php echo $infofilmanime['numero']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#signaleVOSTFRajaxfilmanime').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
						</script>
						
					<?php
					}
					else
					{
					?>
						<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>
						
					<?php
					}
					?>
					</span>
					<?php
					$searchvideolecteurvostfr = $db->query('SELECT * FROM videofilmanime WHERE IDfilmanime =\'' . $infofilmanime['ID'] . '\' AND lecteurvideo =\'' . 'VOSTFR' . '\'');
					while ($videolecteurvostfr = $searchvideolecteurvostfr->fetch())
					{
					?>
						<iframe src="<?php echo htmlspecialchars($videolecteurvostfr['video']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-bottom: 60px;" allowfullscreen></iframe>
					<?php
					}
					$searchvideolecteurvostfr->closeCursor();
					?>
				</div>
			</div>
			<div class="contenuanimeblockcommentaires">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockcommentairesimg"/>
				<div class="contenuanimeblockcommentairesblock"><br />
					<span id="commentaireajaxfilmanime">
					<div class="blockcommentairesblockcommenter">
					<?php
					if(isset($_SESSION['ID']))
					{
						$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesfilmanime WHERE IDfilmanime =\'' . $infofilmanime['ID'] . '\'');
						$nbdecommentaires = $searchnbdecommentaires->fetch();
						
						if(isset($_POST['ajoutercommentaire']))
						{								
							$IDfilmanime = $infofilmanime['ID'];
							$lien = htmlspecialchars("http://".$_SERVER['REQUEST_URI']);
							$IDmembre = $_SESSION['ID'];
							$commentaire = htmlspecialchars($_POST['blockcommentertextarea']);
							
							$existajoutercommentaire = $db->query('SELECT COUNT(*) AS verifajoutercommentaire FROM commentairesfilmanime WHERE IDfilmanime=\'' . $IDfilmanime . '\' AND IDmembre=\'' . $IDmembre . '\' AND commentaire=\'' . $commentaire . '\'');
							$verifajoutercommentaire = $existajoutercommentaire->fetch();
							
							if($verifajoutercommentaire['verifajoutercommentaire'] == 0)
							{
								if(strlen($commentaire) >= 5 AND strlen($commentaire) <= 255)
								{
									$insertcommentaire = $db->prepare('INSERT INTO commentairesfilmanime(IDfilmanime,lien,IDmembre,commentaire,date_creation) VALUES (:IDfilmanime,:lien,:IDmembre,:commentaire,NOW())');
									$insertcommentaire->execute(array(
									'IDfilmanime' => $IDfilmanime,
									'lien' => $lien,
									'IDmembre' => $IDmembre,
									'commentaire' => $commentaire
									));
								}
							}
						}
					?>
						<span><img src="membre/avatar/<?php echo $_SESSION['avatar']; ?>" alt="Avatar" class="blockcommenteravatar" /></span>
						
							<textarea id="blockcommentertextareafilmanime" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
							<fieldset class="blockcommenterajouterbarre">
								<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairefilmanime()" /></legend>
							</fieldset>
						
						<span class="nbdecommentaires"><?php echo $nbdecommentaires['nbdecommentaires']; ?></span>
						<?php
						}
						else
						{
						?>
							<p class="blockcommenternonmembre">La création du commentaire est exclusivement réservée aux membres.</p>
						<?php
						}
						?>	
					</div>
					<br />
					<?php
						$searchinfocommentaire = $db->query('SELECT * FROM commentairesfilmanime WHERE IDfilmanime =\'' . $infofilmanime['ID'] . '\' ORDER BY ID DESC LIMIT 0, 100');
						while ($infocommentaire = $searchinfocommentaire->fetch())
						{
						$searchinfocommentairemembre = $db->query('SELECT * FROM membres WHERE ID =\'' . $infocommentaire['IDmembre'] . '\'');
						$infocommentairemembre = $searchinfocommentairemembre->fetch();
					?>
					<div class="infocommentaire">
						<?php
						$searchsignale = $db->prepare('SELECT * FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
						$searchsignale->execute(array($infocommentaire['ID'],$infocommentaire['lien']));
						$signaleexist = $searchsignale->rowCount();
						if($signaleexist == 0)
						{
						?>
							<span onclick="signalecommentairefilmanime<?php echo $infocommentaire['ID']; ?>()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>
						<?php
						}
						else
						{
						if(isset($_SESSION['ID']))
						{
							if($_SESSION['ID'] == '1')
							{
							?>
								<span onclick="supprimercommentairefilmanime<?php echo $infocommentaire['ID']; ?>()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>
							<?php
							}
						}
						?>
							<span><img src="images/signalerrouge.png" alt="Signaler" class="infocommentairesignaler" title="Ce commentaire a déjà été signaler." style="cursor:default;"/></span>
						<?php
						}
						?>
							<span><a href="profil.php?id=<?php echo $infocommentairemembre['ID']; ?>" target="_blank"><img src="membre/avatar/<?php echo $infocommentairemembre['avatar']; ?>" alt="Avatar" class="infocommentaireavatar" /></a></span>
							<span class="infocommentairepseudo"><a href="profil.php?id=<?php echo $infocommentairemembre['ID']; ?>" style="color:white;text-decoration:none;"><?php echo $infocommentairemembre['pseudo']; ?></a></span>
							<div class="infocommentairecontenu">
								<span class="infocommentairecontenuspan"><?php echo $infocommentaire['commentaire']; ?></span>
							</div>
							<span class="infocommentairedate"><?php echo date("H:i", strtotime($infocommentaire['date_creation'])); ?><span style="opacity:0;">-</span><?php echo date("d/m/Y", strtotime($infocommentaire['date_creation'])); ?></span>
					</div>
					<?php
					}
					$searchinfocommentaire->closeCursor();
					?>
					<script>
					<?php
					$searchinfocommentairejs = $db->query('SELECT * FROM commentairesfilmanime WHERE IDfilmanime =\'' . $infofilmanime['ID'] . '\' ORDER BY ID DESC LIMIT 0, 100');
					while ($infocommentairejs = $searchinfocommentairejs->fetch())
					{
					?>							
							function signalecommentairefilmanime<?php echo $infocommentairejs['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signalecommentairefilmanime=ok&IDfilmanime=<?php echo $infofilmanime['ID']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#commentaireajaxfilmanime').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
							function supprimercommentairefilmanime<?php echo $infocommentairejs['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?supprimercommentairefilmanime=ok&IDfilmanime=<?php echo $infofilmanime['ID']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>&LIENcommentaire=<?php echo $infocommentairejs['lien']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#commentaireajaxfilmanime').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
					<?php
					}
					$searchinfocommentairejs->closeCursor();
					?>
					</script>
					</span>
				</div>
			</div>
			<script>
			
				function ajoutercommentairefilmanime()
				{
					var xhr = new XMLHttpRequest();
					var valuecommentaire = document.getElementById('blockcommentertextareafilmanime').value;
					
					var valuecommentaire = encodeURIComponent(valuecommentaire);
					
					xhr.open('GET', 'site/phpanime.php?ajoutercommentairefilmanime=' + valuecommentaire + '&IDanime=<?php echo $_GET['anime']; ?>&IDfilmanime=<?php echo $infofilmanime['ID']; ?>&filmanime=<?php echo $infofilmanime['numero']; ?>');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector('#commentaireajaxfilmanime').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
			
				document.querySelector(".contenuanimenavfilmanimeaffiche").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockaffiche')).left=='100%')
					{
						document.querySelector(".contenuanimeblockaffiche").style.left="21%";
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.cursor="default";
						document.querySelector(".contenuanimenavfilmanimevf span").style.color="white";
						document.querySelector(".contenuanimenavfilmanimevf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
					else
					{
						document.querySelector(".contenuanimeblockaffiche").style.left="21%";
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.cursor="default";
						document.querySelector(".contenuanimenavfilmanimevf span").style.color="white";
						document.querySelector(".contenuanimenavfilmanimevf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
				}
				
				document.querySelector(".contenuanimeblockaffichebandeannonce").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.blockaffichebandeannoncecontenu')).left=='100%')
					{
						document.querySelector(".blockaffichebandeannoncecontenu").style.left="19.5%";
						document.querySelector(".contenuanimeblockaffichebandeannonce").style.cursor="default";
					}
					else
					{
						document.querySelector(".blockaffichebandeannoncecontenu").style.left="19.5%";
						document.querySelector(".contenuanimeblockaffichebandeannonce").style.cursor="default";
					}
				}
				
				document.querySelector(".blockaffichebandeannoncefermez").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.blockaffichebandeannoncecontenu')).left=='19.5%')
					{
						document.querySelector(".blockaffichebandeannoncecontenu").style.left="100%";
						document.querySelector(".contenuanimeblockaffichebandeannonce").style.cursor="pointer";
					}
					else
					{
						document.querySelector(".blockaffichebandeannoncecontenu").style.left="100%";
						document.querySelector(".contenuanimeblockaffichebandeannonce").style.cursor="pointer";
					}
				}
				
				document.querySelector(".contenuanimenavfilmanimevf").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockvf')).left=='100%')
					{
						document.querySelector(".contenuanimeblockaffiche").style.left="100%";
						document.querySelector(".contenuanimeblockvf").style.left="21%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.color="white";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.cursor="pointer";
						document.querySelector(".contenuanimenavfilmanimevf span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavfilmanimevf span").style.cursor="default";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
					else
					{
						document.querySelector(".contenuanimeblockaffiche").style.left="100%";
						document.querySelector(".contenuanimeblockvf").style.left="21%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.color="white";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.cursor="pointer";
						document.querySelector(".contenuanimenavfilmanimevf span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavfilmanimevf span").style.cursor="default";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
				}
				
				document.querySelector(".contenuanimenavvostfr").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockvostfr')).left=='100%')
					{
						document.querySelector(".contenuanimeblockaffiche").style.left="100%";
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="21%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.color="white";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.cursor="pointer";
						document.querySelector(".contenuanimenavfilmanimevf span").style.color="white";
						document.querySelector(".contenuanimenavfilmanimevf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="default";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
					else
					{
						document.querySelector(".contenuanimeblockaffiche").style.left="100%";
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="21%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.color="white";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.cursor="pointer";
						document.querySelector(".contenuanimenavfilmanimevf span").style.color="white";
						document.querySelector(".contenuanimenavfilmanimevf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="default";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
				}
				
				document.querySelector(".contenuanimenavcommentaires").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockcommentaires')).left=='100%')
					{
						document.querySelector(".contenuanimeblockaffiche").style.left="100%";
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="21%";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.color="white";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.cursor="pointer";
						document.querySelector(".contenuanimenavfilmanimevf span").style.color="white";
						document.querySelector(".contenuanimenavfilmanimevf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="default";
					}
					else
					{
						document.querySelector(".contenuanimeblockaffiche").style.left="100%";
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="21%";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.color="white";
						document.querySelector(".contenuanimenavfilmanimeaffiche span").style.cursor="pointer";
						document.querySelector(".contenuanimenavfilmanimevf span").style.color="white";
						document.querySelector(".contenuanimenavfilmanimevf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="default";
					}
				}
			</script>
		</div>
		<?php
		}
		else if(isset($_GET['anime']) AND isset($_GET['filmspecial']))
		{
		$searchanimeid = $db->query('SELECT ID FROM animes WHERE ID =\'' . $_GET['anime'] . '\'');
		$searchanimeidexist = $searchanimeid->rowCount();
		if($searchanimeidexist == 0)
		{
		?>
			<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
			<script>
				window.setTimeout("location=('anime.php');",0);
			</script>
			<style>
				.contenuanime
				{
					display: none;
				}
			</style>
		<?php
		}
		$searchspecialid = $db->query('SELECT numero FROM filmsspecial WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['filmspecial'] . '\'');
		$searchspecialidexist = $searchspecialid->rowCount();
		if($searchspecialidexist == 0)
		{
		?>
			<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
			<script>
				window.setTimeout("location=('anime.php?anime=<?php echo $_GET['anime'] ?>');",0);
			</script>
			<style>
				.contenuanime
				{
					display: none;
				}
			</style>
		<?php
		}
			$searchinfoanime = $db->query('SELECT * FROM animes WHERE ID =\'' . $_GET['anime'] . '\'');
			$infoanime = $searchinfoanime->fetch();
			
			$searchinfospecial = $db->query('SELECT * FROM filmsspecial WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['filmspecial'] . '\'');
			$infospecial = $searchinfospecial->fetch();
			
			$precedent = $_GET['filmspecial'] - 1;
			
			$suivant = $_GET['filmspecial'] + 1;
			
			$searchpremierspecial = $db->query('SELECT * FROM filmsspecial WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero LIMIT 0,1');
			$premierspecial = $searchpremierspecial->fetch();
			
			$searchdernierspecial = $db->query('SELECT * FROM filmsspecial WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero DESC LIMIT 0,1');
			$dernierspecial = $searchdernierspecial->fetch();
			
			if(isset($_POST['validerinsertnumerospecial']))
			{
				$numerospecial = $_POST['insertnumerospecial'];
			?>
				<script>
					window.setTimeout("location=('anime.php?anime=<?php echo $_GET['anime'] ?>&filmspecial=<?php echo $numerospecial ?>');",0);
				</script>
			<?php
			}
		?>
		<div class="contenuanime">
			<div class="contenuanimenav">
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>"><img src="images/retour.png" alt="Retour" class="retour" /></a>
				<?php
				if($infospecial['videovf'] != "")
				{
				?>
					<div class="contenuanimenavvf"><span>Lecteur VF</span></div>
					<style>
						@media screen and (min-width: 1200px)
						{
							.contenuanimenavvf
							{
								width: 100%;
								padding-top: 80px;
								color: white;
							}
							.contenuanimenavvf span
							{
								color: rgb(2,2,2);
								font-family: Racing Sans One;
								font-size: 31px;
								margin-left: 30px;
								cursor: default;
								display: block;
								width: 65%;
							}
							.contenuanimeblockvf
							{
								display: block;
							}
							.contenuanimenavvostfr
							{
								width: 100%;
								height: 45px;
								padding-top: 12px;
								color: white;
							}
							.contenuanimenavvostfr span
							{
								cursor: pointer;
							}
							.contenuanimeblockvostfr
							{
								left: 100%;
							}
						}
					</style>
				<?php
				}
				else
				{
				?>
					<div class="contenuanimenavvf"><span></span></div>
				<?php
				}
				?>
				<div class="contenuanimenavvostfr"><span>Lecteur VOSTFR</span></div>
				<div class="contenuanimenavcommentaires"><span>Commentaires</span></div>
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>&filmspecial=<?php echo $precedent ?>" ><span class="episodeprecedent"><span>-</span>></span></a>
				<img src="images/valider.png" alt="Valider" class="validerinsertnumeroepisodeimg" />
				<form method="post" action="">
					<input type="number" name="insertnumerospecial" class="insertnumeroepisode" title="Insérer le numéro du film." min="<?php echo htmlspecialchars($premierspecial['numero']); ?>" max="<?php echo htmlspecialchars($dernierspecial['numero']); ?>" style="outline:none;" required />
					<input type="submit" value="+" name="validerinsertnumerospecial" class="validerinsertnumeroepisode" />
				</form>
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>&filmspecial=<?php echo $suivant ?>" ><span class="episodesuivant"><span>-</span>></span></a>
			</div>
			<div class="contenuanimeblockvf">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockvfimg"/>
				<div class="contenuanimeblockvfblock"><br />
					<p class="contenuanimeblockepisodetitre">Spécial <?php echo htmlspecialchars($infospecial['numero']); ?>: <?php echo htmlspecialchars($infospecial['titre']); ?></p>
					<iframe src="<?php echo htmlspecialchars($infospecial['videovf']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-top: -7px;margin-bottom: 50px;" allowfullscreen></iframe>
					<span id="signaleVFajaxfilmspecial">
					<?php
					$videovf = "VF";
					
					$searchsignalelecteurvf = $db->prepare('SELECT * FROM signalespecial WHERE IDspecial = ? AND video = ?');
					$searchsignalelecteurvf->execute(array($infospecial['ID'],$videovf));
					$signaleexistlecteurvf = $searchsignalelecteurvf->rowCount();
					if($signaleexistlecteurvf == 0)
					{
					?>
						<span id="signaleVFfilmspecial"><img src="images/signaler.png" alt="Signaler" class="contenuanimeblockepisodesignaler" style="cursor:pointer;" /></span>
					
						<script>
						
							document.getElementById('signaleVFfilmspecial').onclick = function()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signaleranimelecteurvffilmspecial=ok&IDanime=<?php echo $_GET['anime']; ?>&IDfilmspecial=<?php echo $infospecial['ID']; ?>&filmspecial=<?php echo $infospecial['numero']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#signaleVFajaxfilmspecial').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
						</script>
						
					<?php
					}
					else
					{
					?>
						<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>
					<?php
					}
					?>
					</span>
					<?php
					$searchvideolecteurvf = $db->query('SELECT * FROM videofilmspecial WHERE IDfilmspecial =\'' . $infospecial['ID'] . '\' AND lecteurvideo =\'' . 'VF' . '\'');
					while ($videolecteurvf = $searchvideolecteurvf->fetch())
					{
					?>
						<iframe src="<?php echo htmlspecialchars($videolecteurvf['video']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-bottom: 60px;" allowfullscreen></iframe>
					<?php
					}
					$searchvideolecteurvf->closeCursor();
					?>
				</div>
			</div>
			<div class="contenuanimeblockvostfr">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockvostfrimg"/>
				<div class="contenuanimeblockvostfrblock"><br />
					<p class="contenuanimeblockepisodetitre">Spécial <?php echo htmlspecialchars($infospecial['numero']); ?>: <?php echo htmlspecialchars($infospecial['titre']); ?></p>
					<iframe src="<?php echo htmlspecialchars($infospecial['videovostfr']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-top: -7px;margin-bottom:50px;" allowfullscreen></iframe>
					<span id="signaleVOSTFRajaxfilmspecial">
					<?php
					$videovostfr = "VOSTFR";
					
					$searchsignalelecteurvostfr = $db->prepare('SELECT * FROM signalespecial WHERE IDspecial = ? AND video = ?');
					$searchsignalelecteurvostfr->execute(array($infospecial['ID'],$videovostfr));
					$signaleexistlecteurvostfr = $searchsignalelecteurvostfr->rowCount();
					if($signaleexistlecteurvostfr == 0)
					{
					?>
						<span id="signaleVOSTFRfilmspecial"><img src="images/signaler.png" alt="Signaler" class="contenuanimeblockepisodesignaler" style="cursor:pointer;" /></span>
						
						<script>
						
							document.getElementById('signaleVOSTFRfilmspecial').onclick = function()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signaleranimelecteurvostfrfilmspecial=ok&IDanime=<?php echo $_GET['anime']; ?>&IDfilmspecial=<?php echo $infospecial['ID']; ?>&filmspecial=<?php echo $infospecial['numero']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#signaleVOSTFRajaxfilmspecial').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
						</script>
						
					<?php
					}
					else
					{
					?>
						<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>
					<?php
					}
					?>
					</span>
					<?php
					$searchvideolecteurvostfr = $db->query('SELECT * FROM videofilmspecial WHERE IDfilmspecial =\'' . $infospecial['ID'] . '\' AND lecteurvideo =\'' . 'VOSTFR' . '\'');
					while ($videolecteurvostfr = $searchvideolecteurvostfr->fetch())
					{
					?>
						<iframe src="<?php echo htmlspecialchars($videolecteurvostfr['video']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-bottom: 60px;" allowfullscreen></iframe>
					<?php
					}
					$searchvideolecteurvostfr->closeCursor();
					?>
				</div>
			</div>
			<div class="contenuanimeblockcommentaires">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockcommentairesimg"/>
				<div class="contenuanimeblockcommentairesblock"><br />
				<span id="commentaireajaxfilmspecial">
					<div class="blockcommentairesblockcommenter">
					<?php
					if(isset($_SESSION['ID']))
					{
						$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesspecial WHERE IDspecial =\'' . $infospecial['ID'] . '\'');
						$nbdecommentaires = $searchnbdecommentaires->fetch();
					?>
						<span><img src="membre/avatar/<?php echo $_SESSION['avatar']; ?>" alt="Avatar" class="blockcommenteravatar" /></span>
							<textarea id="blockcommentertextareafilmspecial" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
							<fieldset class="blockcommenterajouterbarre">
								<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairefilmspecial()" /></legend>
							</fieldset>
						<span class="nbdecommentaires"><?php echo $nbdecommentaires['nbdecommentaires']; ?></span>
						<?php
						}
						else
						{
						?>
							<p class="blockcommenternonmembre">La création du commentaire est exclusivement réservée aux membres.</p>
						<?php
						}
						?>	
					</div>
					<br />
					<?php						
						$searchinfocommentaire = $db->query('SELECT * FROM commentairesspecial WHERE IDspecial =\'' . $infospecial['ID'] . '\' ORDER BY ID DESC LIMIT 0, 100');
						while ($infocommentaire = $searchinfocommentaire->fetch())
						{
						$searchinfocommentairemembre = $db->query('SELECT * FROM membres WHERE ID =\'' . $infocommentaire['IDmembre'] . '\'');
						$infocommentairemembre = $searchinfocommentairemembre->fetch();
					?>
					<div class="infocommentaire">
						<?php
						$searchsignale = $db->prepare('SELECT * FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
						$searchsignale->execute(array($infocommentaire['ID'],$infocommentaire['lien']));
						$signaleexist = $searchsignale->rowCount();
						if($signaleexist == 0)
						{
						?>
							<span onclick="signalecommentairefilmspecial<?php echo $infocommentaire['ID']; ?>()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>
						<?php
						}
						else
						{
						if(isset($_SESSION['ID']))
						{
							if($_SESSION['ID'] == '1')
							{
							?>
								<span onclick="supprimercommentairefilmspecial<?php echo $infocommentaire['ID']; ?>()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>
							<?php
							}
						}
						?>
							<span><img src="images/signalerrouge.png" alt="Signaler" class="infocommentairesignaler" style="cursor:default;"/></span>
						<?php
						}
						?>
							<span><a href="profil.php?id=<?php echo $infocommentairemembre['ID']; ?>" target="_blank"><img src="membre/avatar/<?php echo $infocommentairemembre['avatar']; ?>" alt="Avatar" class="infocommentaireavatar" /></a></span>
							<span class="infocommentairepseudo"><a href="profil.php?id=<?php echo $infocommentairemembre['ID']; ?>" style="color:white;text-decoration:none;"><?php echo $infocommentairemembre['pseudo']; ?></a></span>
							<div class="infocommentairecontenu">
								<span class="infocommentairecontenuspan"><?php echo $infocommentaire['commentaire']; ?></span>
							</div>
							<span class="infocommentairedate"><?php echo date("H:i", strtotime($infocommentaire['date_creation'])); ?><span style="opacity:0;">-</span><?php echo date("d/m/Y", strtotime($infocommentaire['date_creation'])); ?></span>
					</div>
					<?php
					}
					$searchinfocommentaire->closeCursor();
					?>
				<script>
					<?php
					$searchinfocommentairejs = $db->query('SELECT * FROM commentairesspecial WHERE IDspecial =\'' . $infospecial['ID'] . '\' ORDER BY ID DESC LIMIT 0, 100');
					while ($infocommentairejs = $searchinfocommentairejs->fetch())
					{
					?>							
							function signalecommentairefilmspecial<?php echo $infocommentairejs['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signalecommentairefilmspecial=ok&IDfilmspecial=<?php echo $infospecial['ID']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#commentaireajaxfilmspecial').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
							function supprimercommentairefilmspecial<?php echo $infocommentairejs['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?supprimercommentairefilmspecial=ok&IDfilmspecial=<?php echo $infospecial['ID']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>&LIENcommentaire=<?php echo $infocommentairejs['lien']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#commentaireajaxfilmspecial').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
					<?php
					}
					$searchinfocommentairejs->closeCursor();
					?>
					</script>
					</span>
				</div>
			</div>
			<script>
			
				function ajoutercommentairefilmspecial()
				{
					var xhr = new XMLHttpRequest();
					var valuecommentaire = document.getElementById('blockcommentertextareafilmspecial').value;
					
					var valuecommentaire = encodeURIComponent(valuecommentaire);
					
					xhr.open('GET', 'site/phpanime.php?ajoutercommentairefilmspecial=' + valuecommentaire + '&IDanime=<?php echo $_GET['anime']; ?>&IDfilmspecial=<?php echo $infospecial['ID']; ?>&filmspecial=<?php echo $infospecial['numero']; ?>');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector('#commentaireajaxfilmspecial').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				document.querySelector(".contenuanimenavvf").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockvf')).left=='100%')
					{
						document.querySelector(".contenuanimeblockvf").style.left="21%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvf span").style.cursor="default";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
					else
					{
						document.querySelector(".contenuanimeblockvf").style.left="21%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvf span").style.cursor="default";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
				}
				
				document.querySelector(".contenuanimenavvostfr").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockvostfr')).left=='100%')
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="21%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="default";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
					else
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="21%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="default";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
				}
				
				document.querySelector(".contenuanimenavcommentaires").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockcommentaires')).left=='100%')
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="21%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="default";
					}
					else
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="21%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="default";
					}
				}
			</script>
		</div>
		<?php
		}
		else if(isset($_GET['anime']) AND isset($_GET['oav']))
		{
		$searchanimeid = $db->query('SELECT ID FROM animes WHERE ID =\'' . $_GET['anime'] . '\'');
		$searchanimeidexist = $searchanimeid->rowCount();
		if($searchanimeidexist == 0)
		{
		?>
			<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
			<script>
				window.setTimeout("location=('anime.php');",0);
			</script>
			<style>
				.contenuanime
				{
					display: none;
				}
			</style>
		<?php
		}
		$searchoavid = $db->query('SELECT numero FROM oavs WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['oav'] . '\'');
		$searchoavidexist = $searchoavid->rowCount();
		if($searchoavidexist == 0)
		{
		?>
			<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
			<script>
				window.setTimeout("location=('anime.php?anime=<?php echo $_GET['anime'] ?>');",0);
			</script>
			<style>
				.contenuanime
				{
					display: none;
				}
			</style>
		<?php
		}
			$searchinfoanime = $db->query('SELECT * FROM animes WHERE ID =\'' . $_GET['anime'] . '\'');
			$infoanime = $searchinfoanime->fetch();
			
			$searchinfooav = $db->query('SELECT * FROM oavs WHERE IDanime =\'' . $_GET['anime'] . '\' AND numero =\'' . $_GET['oav'] . '\'');
			$infooav = $searchinfooav->fetch();
			
			$precedent = $_GET['oav'] - 1;
			
			$suivant = $_GET['oav'] + 1;
			
			$searchpremieroav = $db->query('SELECT * FROM oavs WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero LIMIT 0,1');
			$premieroav = $searchpremieroav->fetch();
			
			$searchdernieroav = $db->query('SELECT * FROM oavs WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero DESC LIMIT 0,1');
			$dernieroav = $searchdernieroav->fetch();
			
			if(isset($_POST['validerinsertnumerooav']))
			{
				$numerooav = $_POST['insertnumerooav'];
			?>
				<script>
					window.setTimeout("location=('anime.php?anime=<?php echo $_GET['anime'] ?>&oav=<?php echo $numerooav ?>');",0);
				</script>
			<?php
			}
		?>
		<div class="contenuanime">
			<div class="contenuanimenav">
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>"><img src="images/retour.png" alt="Retour" class="retour" /></a>
				<?php
				if($infooav['videovf'] != "")
				{
				?>
					<div class="contenuanimenavvf"><span>Lecteur VF</span></div>
					<style>
					@media screen and (min-width: 1200px)
					{
						.contenuanimenavvf
						{
							width: 100%;
							padding-top: 80px;
							color: white;
						}
						.contenuanimenavvf span
						{
							color: rgb(2,2,2);
							font-family: Racing Sans One;
							font-size: 31px;
							margin-left: 30px;
							cursor: default;
							display: block;
							width: 65%;
						}
						.contenuanimeblockvf
						{
							display: block;
						}
						.contenuanimenavvostfr
						{
							width: 100%;
							height: 45px;
							padding-top: 12px;
							color: white;
						}
						
						.contenuanimenavvostfr span
						{
							cursor: pointer;
						}
						
						.contenuanimeblockvostfr
						{
							left: 100%;
						}
					}
					</style>
				<?php
				}
				else
				{
				?>
					<div class="contenuanimenavvf"><span></span></div>
				<?php
				}
				?>
				<div class="contenuanimenavvostfr"><span>Lecteur VOSTFR</span></div>
				<div class="contenuanimenavcommentaires"><span>Commentaires</span></div>
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>&oav=<?php echo $precedent ?>" ><span class="episodeprecedent"><span>-</span>></span></a>
				<img src="images/valider.png" alt="Valider" class="validerinsertnumeroepisodeimg" />
				<form method="post" action="">
					<input type="number" name="insertnumerooav" class="insertnumeroepisode" title="Insérer le numéro de l'oav." min="<?php echo htmlspecialchars($premieroav['numero']); ?>" max="<?php echo htmlspecialchars($dernieroav['numero']); ?>" style="outline:none;" required />
					<input type="submit" value="+" name="validerinsertnumerooav" class="validerinsertnumeroepisode" />
				</form>
				<a href="anime.php?anime=<?php echo $_GET['anime'] ?>&oav=<?php echo $suivant ?>" ><span class="episodesuivant"><span>-</span>></span></a>
			</div>
			<div class="contenuanimeblockvf">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockvfimg"/>
				<div class="contenuanimeblockvfblock"><br />
					<p class="contenuanimeblockepisodetitre">Oav <?php echo htmlspecialchars($infooav['numero']); ?>: <?php echo htmlspecialchars($infooav['titre']); ?></p>
					<iframe src="<?php echo htmlspecialchars($infooav['videovf']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-top: -7px;margin-bottom:50px;" allowfullscreen></iframe>
					<span id="signaleVFajaxoav">
					<?php
					$videovf = "VF";
					
					$searchsignalelecteurvf = $db->prepare('SELECT * FROM signaleoav WHERE IDoav = ? AND video = ?');
					$searchsignalelecteurvf->execute(array($infooav['ID'],$videovf));
					$signaleexistlecteurvf = $searchsignalelecteurvf->rowCount();
					if($signaleexistlecteurvf == 0)
					{
					?>
						<span id="signaleVFoav"><img src="images/signaler.png" alt="Signaler" class="contenuanimeblockepisodesignaler" style="cursor:pointer;" /></span>
					
						<script>
						
							document.getElementById('signaleVFoav').onclick = function()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signaleranimelecteurvfoav=ok&IDanime=<?php echo $_GET['anime']; ?>&IDoav=<?php echo $infooav['ID']; ?>&oav=<?php echo $infooav['numero']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#signaleVFajaxoav').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
						</script>
						
					<?php
					}
					else
					{
					?>
						<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>
					<?php
					}
					?>
					</span>
					<?php
					$searchvideolecteurvf = $db->query('SELECT * FROM videooav WHERE IDoav =\'' . $infooav['ID'] . '\' AND lecteurvideo =\'' . 'VF' . '\'');
					while ($videolecteurvf = $searchvideolecteurvf->fetch())
					{
					?>
						<iframe src="<?php echo htmlspecialchars($videolecteurvf['video']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-bottom: 60px;" allowfullscreen></iframe>
					<?php
					}
					$searchvideolecteurvf->closeCursor();
					?>
				</div>
			</div>
			<div class="contenuanimeblockvostfr">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockvostfrimg"/>
				<div class="contenuanimeblockvostfrblock"><br />
					<p class="contenuanimeblockepisodetitre">Oav <?php echo htmlspecialchars($infooav['numero']); ?>: <?php echo htmlspecialchars($infooav['titre']); ?></p>
					<iframe src="<?php echo htmlspecialchars($infooav['videovostfr']); ?>"  frameborder="0" class="contenuanimeblockepisodevideo" style="margin-top: -7px;margin-bottom:50px;" allowfullscreen></iframe>
					<span id="signaleVOSTFRajaxoav">
					<?php
					$videovostfr = "VOSTFR";
					
					$searchsignalelecteurvostfr = $db->prepare('SELECT * FROM signaleoav WHERE IDoav = ? AND video = ?');
					$searchsignalelecteurvostfr->execute(array($infooav['ID'],$videovostfr));
					$signaleexistlecteurvostfr = $searchsignalelecteurvostfr->rowCount();
					if($signaleexistlecteurvostfr == 0)
					{
					?>
						<span id="signaleVOSTFRoav"><img src="images/signaler.png" alt="Signaler" class="contenuanimeblockepisodesignaler" style="cursor:pointer;" /></span>
						
						<script>
						
							document.getElementById('signaleVOSTFRoav').onclick = function()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signaleranimelecteurvostfroav=ok&IDanime=<?php echo $_GET['anime']; ?>&IDoav=<?php echo $infooav['ID']; ?>&oav=<?php echo $infooav['numero']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#signaleVOSTFRajaxoav').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
						</script>
					
					<?php
					}
					else
					{
					?>
						<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>
					<?php
					}
					?>
					</span>
					<?php
					$searchvideolecteurvostfr = $db->query('SELECT * FROM videooav WHERE IDoav =\'' . $infooav['ID'] . '\' AND lecteurvideo =\'' . 'VOSTFR' . '\'');
					while ($videolecteurvostfr = $searchvideolecteurvostfr->fetch())
					{
					?>
						<iframe src="<?php echo htmlspecialchars($videolecteurvostfr['video']); ?>" frameborder="0" class="contenuanimeblockepisodevideo" style="margin-bottom: 60px;" allowfullscreen></iframe>
					<?php
					}
					$searchvideolecteurvostfr->closeCursor();
					?>
				</div>
			</div>
			<div class="contenuanimeblockcommentaires">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockcommentairesimg"/>
				<div class="contenuanimeblockcommentairesblock"><br />
					<span id="commentaireajaxoav">
					<div class="blockcommentairesblockcommenter">
					<?php
					if(isset($_SESSION['ID']))
					{
						$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesoavs WHERE IDoav =\'' . $infooav['ID'] . '\'');
						$nbdecommentaires = $searchnbdecommentaires->fetch();
					?>
						<span><img src="membre/avatar/<?php echo $_SESSION['avatar']; ?>" alt="Avatar" class="blockcommenteravatar" /></span>
							<textarea id="blockcommentertextareaoav" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
							<fieldset class="blockcommenterajouterbarre">
								<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaireoav()" /></legend>
							</fieldset>
						<span class="nbdecommentaires"><?php echo $nbdecommentaires['nbdecommentaires']; ?></span>
						<?php
						}
						else
						{
						?>
							<p class="blockcommenternonmembre">La création du commentaire est exclusivement réservée aux membres.</p>
						<?php
						}
						?>	
					</div>
					<br />
					<?php		
						$searchinfocommentaire = $db->query('SELECT * FROM commentairesoavs WHERE IDoav =\'' . $infooav['ID'] . '\' ORDER BY ID DESC LIMIT 0, 100');
						while ($infocommentaire = $searchinfocommentaire->fetch())
						{
						$searchinfocommentairemembre = $db->query('SELECT * FROM membres WHERE ID =\'' . $infocommentaire['IDmembre'] . '\'');
						$infocommentairemembre = $searchinfocommentairemembre->fetch();
					?>
					<div class="infocommentaire">
						<?php
						$searchsignale = $db->prepare('SELECT * FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
						$searchsignale->execute(array($infocommentaire['ID'],$infocommentaire['lien']));
						$signaleexist = $searchsignale->rowCount();
						if($signaleexist == 0)
						{
						?>
							<span onclick="signalecommentaireoav<?php echo $infocommentaire['ID']; ?>()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>
						<?php
						}
						else
						{
						if(isset($_SESSION['ID']))
						{
							if($_SESSION['ID'] == '1')
							{
							?>
								<span onclick="supprimercommentaireoav<?php echo $infocomentaire['ID']; ?>()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>
							<?php
							}
						}
						?>
							<span><img src="images/signalerrouge.png" alt="Signaler" class="infocommentairesignaler" style="cursor:default;"/></span>
						<?php
						}
						?>
							<span><a href="profil.php?id=<?php echo $infocommentairemembre['ID']; ?>" target="_blank"><img src="membre/avatar/<?php echo $infocommentairemembre['avatar']; ?>" alt="Avatar" class="infocommentaireavatar" /></a></span>
							<span class="infocommentairepseudo"><a href="profil.php?id=<?php echo $infocommentairemembre['ID']; ?>" style="color:white;text-decoration:none;"><?php echo $infocommentairemembre['pseudo']; ?></a></span>
							<div class="infocommentairecontenu">
								<span class="infocommentairecontenuspan"><?php echo $infocommentaire['commentaire']; ?></span>
							</div>
							<span class="infocommentairedate"><?php echo date("H:i", strtotime($infocommentaire['date_creation'])); ?><span style="opacity:0;">-</span><?php echo date("d/m/Y", strtotime($infocommentaire['date_creation'])); ?></span>
					</div>
					<?php
					}
					$searchinfocommentaire->closeCursor();
					?>
				<script>
					<?php
					$searchinfocommentairejs = $db->query('SELECT * FROM commentairesoavs WHERE IDoav =\'' . $infooav['ID'] . '\' ORDER BY ID DESC LIMIT 0, 100');
					while ($infocommentairejs = $searchinfocommentairejs->fetch())
					{
					?>							
							function signalecommentaireoav<?php echo $infocommentairejs['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?signalecommentaireoav=ok&IDoav=<?php echo $infooav['ID']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#commentaireajaxoav').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
							
							function supprimercommentaireoav<?php echo $infocommentairejs['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpanime.php?supprimercommentaireoav=ok&IDoav=<?php echo $infooav['ID']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>&LIENcommentaire=<?php echo $infocommentairejs['lien']; ?>');
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#commentaireajaxoav').innerHTML = xhr.responseText;
									}
								};
								
								xhr.send(null);
							}
					<?php
					}
					$searchinfocommentairejs->closeCursor();
					?>
					</script>
					</span>
				</div>
			</div>
			<script>
			
				function ajoutercommentaireoav()
				{
					var xhr = new XMLHttpRequest();
					var valuecommentaire = document.getElementById('blockcommentertextareaoav').value;
					
					var valuecommentaire = encodeURIComponent(valuecommentaire);
					
					xhr.open('GET', 'site/phpanime.php?ajoutercommentaireoav=' + valuecommentaire + '&IDanime=<?php echo $_GET['anime']; ?>&IDoav=<?php echo $infooav['ID']; ?>&oav=<?php echo $infooav['numero']; ?>');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector('#commentaireajaxoav').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				document.querySelector(".contenuanimenavvf").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockvf')).left=='100%')
					{
						document.querySelector(".contenuanimeblockvf").style.left="21%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvf span").style.cursor="default";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
					else
					{
						document.querySelector(".contenuanimeblockvf").style.left="21%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvf span").style.cursor="default";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
				}
				
				document.querySelector(".contenuanimenavvostfr").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockvostfr')).left=='100%')
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="21%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="default";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
					else
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="21%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="100%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="default";
						document.querySelector(".contenuanimenavcommentaires span").style.color="white";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="pointer";
					}
				}
				
				document.querySelector(".contenuanimenavcommentaires").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.contenuanimeblockcommentaires')).left=='100%')
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="21%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="default";
					}
					else
					{
						document.querySelector(".contenuanimeblockvf").style.left="100%";
						document.querySelector(".contenuanimeblockvostfr").style.left="100%";
						document.querySelector(".contenuanimeblockcommentaires").style.left="21%";
						document.querySelector(".contenuanimenavvf span").style.color="white";
						document.querySelector(".contenuanimenavvf span").style.cursor="pointer";
						document.querySelector(".contenuanimenavvostfr span").style.color="white";
						document.querySelector(".contenuanimenavvostfr span").style.cursor="pointer";
						document.querySelector(".contenuanimenavcommentaires span").style.color="rgb(2,2,2)";
						document.querySelector(".contenuanimenavcommentaires span").style.cursor="default";
					}
				}
			</script>
		</div>
		<?php
		}
		else if(isset($_GET['anime']))
		{
		$searchanimeid = $db->query('SELECT ID FROM animes WHERE ID =\'' . $_GET['anime'] . '\'');
		$searchanimeidexist = $searchanimeid->rowCount();
		if($searchanimeidexist == 0)
		{
		?>
			<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
			<script>
				window.setTimeout("location=('anime.php');",0);
			</script>
			<style>
				.contenuanime
				{
					display: none;
				}
			</style>
		<?php
		}
			$searchinfoanime = $db->query('SELECT * FROM animes WHERE ID =\'' . $_GET['anime'] . '\'');
			$infoanime = $searchinfoanime->fetch();
			
			$searchopening = $db->query('SELECT * FROM opening WHERE IDanime =\'' . $_GET['anime'] . '\'');
			$opening = $searchopening->fetch();
			
			$searchending = $db->query('SELECT * FROM ending WHERE IDanime =\'' . $_GET['anime'] . '\'');
			$ending = $searchending->fetch();
			
			$searchamv = $db->query('SELECT * FROM amv WHERE IDanime =\'' . $_GET['anime'] . '\'');
			$amv = $searchamv->fetch();
		?>
		<div class="contenuanime">
			<div class="contenuanimenav">
				<div class="contenuanimenavaffiche"><span>Affiche</span></div>
				<div class="contenuanimenavepisodes"><span>Épisodes</span></div>
				<div class="contenuanimenavscans"><span>Scans</span></div>
				<div class="contenuanimenavfilms"><span>Films</span></div>
				<div class="contenuanimenavoavs"><span>Oavs</span></div>
				<div class="contenuanimenavgeneriques"><span>Génériques</span></div>
				<div class="contenuanimenavamv"><span>Amv</span></div>
			</div>
			<div class="contenuanimeblockaffiche">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockafficheimg"/>
				<div class="contenuanimeblockafficheblock"><br />
				<span class="contenuanimeblockaffichetitre"><?php echo htmlspecialchars($infoanime['titre']); ?></span>
				<div id="blocknoteretoileajax">
				<?php
					$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesanimes WHERE IDanime =\'' . $_GET['anime'] . '\'');
					$notemoy = $searchmoynote->fetch();	
					if($notemoy['notemoy'] == 0)
					{
					?>
						<span class="contenuanimeblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>
					<?php
					}
					else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
					{
					?>
						<span class="contenuanimeblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>
					<?php
					}
					else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
					{
					?>
						<span class="contenuanimeblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>
					<?php
					}
					else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
					{
					?>
						<span class="contenuanimeblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>
					<?php
					}
					else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
					{
					?>
						<span class="contenuanimeblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>
					<?php
					}
					else if($notemoy['notemoy'] >= 5)
					{
					?>
						<span class="contenuanimeblockaffichenote">★★★★★</span>
					<?php
					}
				?>
				</div>
				<div class="blocknoteretoile">
				<?php
					if(isset($_SESSION['ID']))
					{
					?>
						<input type="submit" value="★" class="blocknoteretoile1" id="blocknoteretoile1" />
						<input type="submit" value="★" class="blocknoteretoile2" id="blocknoteretoile2" />
						<input type="submit" value="★" class="blocknoteretoile3" id="blocknoteretoile3" />
						<input type="submit" value="★" class="blocknoteretoile4" id="blocknoteretoile4" />
						<input type="submit" value="★" class="blocknoteretoile5" id="blocknoteretoile5" />
						
						<script>
							
								document.getElementById('blocknoteretoile1').onclick = function()
								{
									var xhr = new XMLHttpRequest();
									
									xhr.open('GET', 'site/phpanime.php?blocknoteretoile1=ok&IDanime=<?php echo $_GET['anime']; ?>');
									
									xhr.onreadystatechange = function()
									{
										if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
										{
											document.querySelector('#blocknoteretoileajax').innerHTML = xhr.responseText;
										}
									};
									
									xhr.send(null);
								}
								
								document.getElementById('blocknoteretoile2').onclick = function()
								{
									var xhr = new XMLHttpRequest();
									
									xhr.open('GET', 'site/phpanime.php?blocknoteretoile2=ok&IDanime=<?php echo $_GET['anime']; ?>');
									
									xhr.onreadystatechange = function() 
									{
										if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
										{
											document.querySelector('#blocknoteretoileajax').innerHTML = xhr.responseText;
										}
									};
									
									xhr.send(null);
								}
								
								document.getElementById('blocknoteretoile3').onclick = function()
								{
									var xhr = new XMLHttpRequest();
									
									xhr.open('GET', 'site/phpanime.php?blocknoteretoile3=ok&IDanime=<?php echo $_GET['anime']; ?>');
									
									xhr.onreadystatechange = function() 
									{
										if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
										{
											document.querySelector('#blocknoteretoileajax').innerHTML = xhr.responseText;
										}
									};
									
									xhr.send(null);
								}
								
								document.getElementById('blocknoteretoile4').onclick = function()
								{
									var xhr = new XMLHttpRequest();
									
									xhr.open('GET', 'site/phpanime.php?blocknoteretoile4=ok&IDanime=<?php echo $_GET['anime']; ?>');
									
									xhr.onreadystatechange = function() 
									{
										if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
										{
											document.querySelector('#blocknoteretoileajax').innerHTML = xhr.responseText;
										}
									};
									
									xhr.send(null);
								}
								
								document.getElementById('blocknoteretoile5').onclick = function()
								{
									var xhr = new XMLHttpRequest();
									
									xhr.open('GET', 'site/phpanime.php?blocknoteretoile5=ok&IDanime=<?php echo $_GET['anime']; ?>');
									
									xhr.onreadystatechange = function() 
									{
										if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
										{
											document.querySelector('#blocknoteretoileajax').innerHTML = xhr.responseText;
										}
									};
									
									xhr.send(null);
								}
					
							</script>
					<?php
					}
				?>
				</div>
				<img src="images/bandeannonce.png" alt="Regarder la bande annonce" title="Regarder la bande annonce" class="contenuanimeblockaffichebandeannonce" />
				<div class="blockaffichebandeannoncecontenu">
					<img src="images/erreur.png" alt="Fermez" class="blockaffichebandeannoncefermez" />
					<iframe src="<?php echo htmlspecialchars($infoanime['bandeannonce']); ?>" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
				</div>
				<span class="contenuanimeblockafficheauteurannee">Auteur: <?php echo htmlspecialchars($infoanime['auteur']); ?><span></span>Année: <?php echo htmlspecialchars($infoanime['annee']); ?></span>
				<span class="contenuanimeblockaffichegenres">
				Genres:
				<?php
					if($infoanime['action'] == "Action")
					{
					?>
						<?php echo $infoanime['action']; ?>,
					<?php
					}
					if($infoanime['aventure'] == "Aventure")
					{
					?>
						<?php echo $infoanime['aventure']; ?>,
					<?php
					}
					if($infoanime['amitier'] == "Amitié")
					{
					?>
						<?php echo $infoanime['amitier']; ?>,
					<?php
					}
					if($infoanime['comedie'] == "Comédie")
					{
					?>
						<?php echo $infoanime['comedie']; ?>,
					<?php
					}
					if($infoanime['drame'] == "Drame")
					{
					?>
						<?php echo $infoanime['drame']; ?>,
					<?php
					}
					if($infoanime['fantastique'] == "Fantastique")
					{
					?>
						<?php echo $infoanime['fantastique']; ?>,
					<?php
					}
					if($infoanime['guerre'] == "Guerre")
					{
					?>
						<?php echo $infoanime['guerre']; ?>,
					<?php
					}
					if($infoanime['cyber'] == "Cyber")
					{
					?>
						<?php echo $infoanime['cyber']; ?>,
					<?php
					}
					if($infoanime['mecha'] == "Mecha")
					{
					?>
						<?php echo $infoanime['mecha']; ?>,
					<?php
					}
					if($infoanime['sport'] == "Sport")
					{
					?>
						<?php echo $infoanime['sport']; ?>,
					<?php
					}
					if($infoanime['horreur'] == "Horreur")
					{
					?>
						<?php echo $infoanime['horreur']; ?>,
					<?php
					}
					?>
				</span>
				<span class="contenuanimeblockaffichesynopsis"><?php echo htmlspecialchars($infoanime['synopsis']); ?></span>
				</div>
			</div>
			<div class="contenuanimeblockepisodes">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockepisodesimg"/>
				<div class="contenuanimeblockepisodesblock"><br />
					<p class="contenuanimeblockepisodestitre">EPISODES</p>
					<div class="blockepisodessaison">
					<?php
					$searchsaison = $db->query('SELECT * FROM saison WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY IDsaison');
					while($saison = $searchsaison->fetch())
					{
						$searchpremierepisode = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $_GET['anime'] . '\' AND IDsaison =\'' . $saison['IDsaison'] . '\' ORDER BY numero LIMIT 0,1');
						$premierepisode = $searchpremierepisode->fetch();
						
						$searchdernierepisode = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $_GET['anime'] . '\' AND IDsaison =\'' . $saison['IDsaison'] . '\' ORDER BY numero DESC LIMIT 0,1');
						$dernierepisode = $searchdernierepisode->fetch();
					?>
						<div style="width:235px;display:inline-block;"><p class="contenuanimeblockepisodessaison" id="contenuanimeblockepisodessaison<?php echo htmlspecialchars($saison['IDsaison']); ?>" title="<?php echo htmlspecialchars($premierepisode['numero']); ?> à <?php echo htmlspecialchars($dernierepisode['numero']); ?>">SAISON <?php echo htmlspecialchars($saison['IDsaison']); ?></p></div>
					<?php
					}
					$searchsaison->closeCursor();
					?>
					</div>
					<?php
					$searchsaison = $db->query('SELECT * FROM saison WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY IDsaison');
					while($saison = $searchsaison->fetch())
					{
					?>
						<div class="blockepisodessaisoncontenu" id="blockepisodescontenusaison<?php echo htmlspecialchars($saison['IDsaison']); ?>">
							<img src="images/retour.png" alt="Retour" class="retour" id="retoursaison<?php echo htmlspecialchars($saison['IDsaison']); ?>" />
							<p class="blockepisodessaisoncontenutitre">SAISON <?php echo htmlspecialchars($saison['IDsaison']); ?></p>
							<?php
							$searchepisodes = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $_GET['anime'] . '\' AND IDsaison =\'' . $saison['IDsaison'] . '\' ORDER BY numero');
							while($episodes = $searchepisodes->fetch())
							{
							?>
							<?php
							$dateanime = date("Y-m-d", strtotime($episodes['date']));
							$newcontenuimg = date('Y-m-d');
							
							if($dateanime >= $newcontenuimg)
							{
							?>
								<img src="images/new.png" alt="New" class="newcontenuimg" />
							<?php
							}
							?>
							<p class="blockepisodessaisoncontenuepisode"><a href="anime.php?anime=<?php echo $_GET['anime'] ?>&episode=<?php echo $episodes['numero'] ?>">Épisode <?php echo htmlspecialchars($episodes['numero']); ?>: <?php echo htmlspecialchars($episodes['titre']); ?></a></p>
							<?php
							}
							$searchepisodes->closeCursor();
							?>
						</div>
					<?php
					}
					$searchsaison->closeCursor();
					?>
				</div>
			</div>
			<div class="contenuanimeblockscans">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockscansimg"/>
				<div class="contenuanimeblockscansblock"><br />
					<p class="blockscanscontenutitre">SCANS</p>
					<div class="blockscanscontenublockimg">
						<?php
							$searchscansanimes = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $_GET['anime'] . '\' AND page = 1 ORDER BY numero DESC');
							while($scansanimes = $searchscansanimes->fetch())
							{
							?>
								<?php
								$dateanime = date("Y-m-d", strtotime($scansanimes['date']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateanime >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg2" />
								<?php
								}
								?>
								<span><a href="anime.php?anime=<?php echo $_GET['anime'] ?>&scan=<?php echo $scansanimes['numero'] ?>"><img src="scan/<?php echo $scansanimes['image']; ?>" alt="Scan <?php echo htmlspecialchars($scansanimes['numero']); ?>" title="Scan <?php echo htmlspecialchars($scansanimes['numero']); ?>" class="blockscanscontenuimg" /></a></span>
							<?php
							}
							$searchscansanimes->closeCursor();
						?>
					</div>
				</div>
			</div>
			<div class="contenuanimeblockfilms">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockfilmsimg"/>
				<div class="contenuanimeblockfilmsblock"><br />
					<p class="blockfilmscontenutitre">FILMS</p>
					<p class="blockfilmscontenutitre2" id="blockfilmscontenutitre1"><?php echo htmlspecialchars($infoanime['titre']); ?></p>
					<p class="blockfilmscontenutitre2" id="blockfilmscontenutitre2">Spécial</p>
					<div class="blockfilmstitre1contenu">
						<p class="blockfilmscontenutitre">Films <?php echo htmlspecialchars($infoanime['titre']); ?></p>
						<img src="images/retour.png" alt="Retour" class="retour" id="blockfilmstitre1contenuretour" />
						<div class="blockfilmstitre1contenublockimage" style="margin-top:-35px;">
							<?php
							$searchfilmsanimes = $db->query('SELECT * FROM filmsanimes WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero DESC');
							while($filmsanimes = $searchfilmsanimes->fetch())
							{
							?>
								<?php
								$dateanime = date("Y-m-d", strtotime($filmsanimes['date_ajout']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateanime >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg3" />
								<?php
								}
								?>
								<span><a href="anime.php?anime=<?php echo $_GET['anime'] ?>&filmanime=<?php echo $filmsanimes['numero'] ?>"><img src="filmanime/<?php echo $filmsanimes['image']; ?>" alt="<?php echo htmlspecialchars($filmsanimes['titre']); ?>" title="<?php echo htmlspecialchars($filmsanimes['titre']); ?>" class="blockfilmstitre1contenuimage" /></a></span>
							<?php
							}
							$searchfilmsanimes->closeCursor();
							?>
						</div>
					</div>
					<div class="blockfilmstitre2contenu">
						<p class="blockfilmscontenutitre" style="margin-bottom: 50px;">Films Spécial</p>
						<img src="images/retour.png" alt="Retour" class="retour" id="blockfilmstitre2contenuretour" />
						<?php
						$searchspecial = $db->query('SELECT * FROM filmsspecial WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero');
						while($special = $searchspecial->fetch())
						{
						?>
							<?php
							$dateanime = date("Y-m-d", strtotime($special['date']));
							$newcontenuimg = date('Y-m-d');
							
							if($dateanime >= $newcontenuimg)
							{
							?>
								<img src="images/new.png" alt="New" class="newcontenuimg" />
							<?php
							}
							?>
							<p class="blockfilmscontenuspecial"><a href="anime.php?anime=<?php echo $_GET['anime'] ?>&filmspecial=<?php echo $special['numero'] ?>">SPECIAL <?php echo htmlspecialchars($special['numero']); ?>: <?php echo htmlspecialchars($special['titre']); ?></a></p>
						<?php
						}
						$searchspecial->closeCursor();
						?>
					</div>
				</div>
			</div>
			<div class="contenuanimeblockoavs">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockoavsimg"/>
				<div class="contenuanimeblockoavsblock"><br />
					<p class="blockoavscontenutitre">OAVS</p>
					<?php
					$searchoavs = $db->query('SELECT * FROM oavs WHERE IDanime =\'' . $_GET['anime'] . '\' ORDER BY numero');
					while($oav = $searchoavs->fetch())
					{
					?>
						<?php
						$dateanime = date("Y-m-d", strtotime($oav['date']));
						$newcontenuimg = date('Y-m-d');
						
						if($dateanime >= $newcontenuimg)
						{
						?>
							<img src="images/new.png" alt="New" class="newcontenuimg" />
						<?php
						}
						?>
						<p class="blockoavscontenuoav"><a href="anime.php?anime=<?php echo $_GET['anime'] ?>&oav=<?php echo $oav['numero'] ?>">OAV <?php echo htmlspecialchars($oav['numero']); ?>: <?php echo htmlspecialchars($oav['titre']); ?></a></p>
					<?php
					}
					$searchoavs->closeCursor();
					?>
				</div>
			</div>
			<div class="contenuanimeblockgeneriques">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockgeneriquesimg"/>
				<div class="contenuanimeblockgeneriquesblock"><br />
					<p class="contenuanimeblockgeneriquestitre">OPENING</p>
					<iframe src="<?php echo htmlspecialchars($opening['video']); ?>" class="contenuanimeblockgeneriquesvideo" frameborder="0" allowfullscreen></iframe>
					<p class="contenuanimeblockgeneriquestitre">ENDING</p>
					<iframe src="<?php echo htmlspecialchars($ending['video']); ?>" class="contenuanimeblockgeneriquesvideo" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
			<div class="contenuanimeblockamv">
				<img src="anime/<?php echo $infoanime['image']; ?>" alt="Image <?php echo htmlspecialchars($infoanime['titre']); ?>" class="contenuanimeblockamvimg"/>
				<div class="contenuanimeblockamvblock"><br />
					<p class="contenuanimeblockamvtitre">AMV</p>
					<iframe src="<?php echo htmlspecialchars($amv['video']); ?>" class="contenuanimeblockamvvideo" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
		<script>
			document.querySelector(".contenuanimenavaffiche").onclick = function()
			{ 
				if (window.getComputedStyle(document.querySelector('.contenuanimeblockaffiche')).left=='100%')
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="21%";
					document.querySelector(".contenuanimeblockepisodes").style.left="100%";
					document.querySelector(".contenuanimeblockscans").style.left="100%";
					document.querySelector(".contenuanimeblockfilms").style.left="100%";
					document.querySelector(".contenuanimeblockoavs").style.left="100%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="100%";
					document.querySelector(".contenuanimeblockamv").style.left="100%";
					document.querySelector(".contenuanimenavaffiche span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="default";
					document.querySelector(".contenuanimenavepisodes span").style.color="white";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="pointer";
					document.querySelector(".contenuanimenavscans span").style.color="white";
					document.querySelector(".contenuanimenavscans span").style.cursor="pointer";
					document.querySelector(".contenuanimenavfilms span").style.color="white";
					document.querySelector(".contenuanimenavfilms span").style.cursor="pointer";
					document.querySelector(".contenuanimenavoavs span").style.color="white";
					document.querySelector(".contenuanimenavoavs span").style.cursor="pointer";
					document.querySelector(".contenuanimenavgeneriques span").style.color="white";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="pointer";
					document.querySelector(".contenuanimenavamv span").style.color="white";
					document.querySelector(".contenuanimenavamv span").style.cursor="pointer";
				}
				else
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="21%";
					document.querySelector(".contenuanimeblockepisodes").style.left="100%";
					document.querySelector(".contenuanimeblockscans").style.left="100%";
					document.querySelector(".contenuanimeblockfilms").style.left="100%";
					document.querySelector(".contenuanimeblockoavs").style.left="100%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="100%";
					document.querySelector(".contenuanimeblockamv").style.left="100%";
					document.querySelector(".contenuanimenavaffiche span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="default";
					document.querySelector(".contenuanimenavepisodes span").style.color="white";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="pointer";
					document.querySelector(".contenuanimenavscans span").style.color="white";
					document.querySelector(".contenuanimenavscans span").style.cursor="pointer";
					document.querySelector(".contenuanimenavfilms span").style.color="white";
					document.querySelector(".contenuanimenavfilms span").style.cursor="pointer";
					document.querySelector(".contenuanimenavoavs span").style.color="white";
					document.querySelector(".contenuanimenavoavs span").style.cursor="pointer";
					document.querySelector(".contenuanimenavgeneriques span").style.color="white";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="pointer";
					document.querySelector(".contenuanimenavamv span").style.color="white";
					document.querySelector(".contenuanimenavamv span").style.cursor="pointer";
				}
			}
			
			document.querySelector(".contenuanimeblockaffichebandeannonce").onclick = function()
			{ 
				if (window.getComputedStyle(document.querySelector('.blockaffichebandeannoncecontenu')).left=='100%')
				{
					document.querySelector(".blockaffichebandeannoncecontenu").style.left="19.5%";
					document.querySelector(".contenuanimeblockaffichebandeannonce").style.cursor="default";
				}
				else
				{
					document.querySelector(".blockaffichebandeannoncecontenu").style.left="19.5%";
					document.querySelector(".contenuanimeblockaffichebandeannonce").style.cursor="default";
				}
			}
			
			document.querySelector(".blockaffichebandeannoncefermez").onclick = function()
			{ 
				if (window.getComputedStyle(document.querySelector('.blockaffichebandeannoncecontenu')).left=='19.5%')
				{
					document.querySelector(".blockaffichebandeannoncecontenu").style.left="100%";
					document.querySelector(".contenuanimeblockaffichebandeannonce").style.cursor="pointer";
				}
				else
				{
					document.querySelector(".blockaffichebandeannoncecontenu").style.left="100%";
					document.querySelector(".contenuanimeblockaffichebandeannonce").style.cursor="pointer";
				}
			}
			
			document.querySelector(".contenuanimenavepisodes").onclick = function() 
			{ 
				if (window.getComputedStyle(document.querySelector('.contenuanimeblockepisodes')).left=='100%')
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="100%";
					document.querySelector(".contenuanimeblockepisodes").style.left="21%";
					document.querySelector(".contenuanimeblockscans").style.left="100%";
					document.querySelector(".contenuanimeblockfilms").style.left="100%";
					document.querySelector(".contenuanimeblockoavs").style.left="100%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="100%";
					document.querySelector(".contenuanimeblockamv").style.left="100%";
					document.querySelector(".contenuanimenavaffiche span").style.color="white";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="pointer";
					document.querySelector(".contenuanimenavepisodes span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="default";
					document.querySelector(".contenuanimenavscans span").style.color="white";
					document.querySelector(".contenuanimenavscans span").style.cursor="pointer";
					document.querySelector(".contenuanimenavfilms span").style.color="white";
					document.querySelector(".contenuanimenavfilms span").style.cursor="pointer";
					document.querySelector(".contenuanimenavoavs span").style.color="white";
					document.querySelector(".contenuanimenavoavs span").style.cursor="pointer";
					document.querySelector(".contenuanimenavgeneriques span").style.color="white";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="pointer";
					document.querySelector(".contenuanimenavamv span").style.color="white";
					document.querySelector(".contenuanimenavamv span").style.cursor="pointer";
				}
				else
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="100%";
					document.querySelector(".contenuanimeblockepisodes").style.left="21%";
					document.querySelector(".contenuanimeblockscans").style.left="100%";
					document.querySelector(".contenuanimeblockfilms").style.left="100%";
					document.querySelector(".contenuanimeblockoavs").style.left="100%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="100%";
					document.querySelector(".contenuanimeblockamv").style.left="100%";
					document.querySelector(".contenuanimenavaffiche span").style.color="white";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="pointer";
					document.querySelector(".contenuanimenavepisodes span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="default";
					document.querySelector(".contenuanimenavscans span").style.color="white";
					document.querySelector(".contenuanimenavscans span").style.cursor="pointer";
					document.querySelector(".contenuanimenavfilms span").style.color="white";
					document.querySelector(".contenuanimenavfilms span").style.cursor="pointer";
					document.querySelector(".contenuanimenavoavs span").style.color="white";
					document.querySelector(".contenuanimenavoavs span").style.cursor="pointer";
					document.querySelector(".contenuanimenavgeneriques span").style.color="white";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="pointer";
					document.querySelector(".contenuanimenavamv span").style.color="white";
					document.querySelector(".contenuanimenavamv span").style.cursor="pointer";
				}
			}
		<?php
		$searchsaison = $db->query('SELECT * FROM saison WHERE IDanime =\'' . $_GET['anime'] . '\'');
		while($saison = $searchsaison->fetch())
		{
		?>
			document.querySelector("#contenuanimeblockepisodessaison<?php echo $saison['IDsaison']; ?>").onclick = function() 
			{ 
				if (window.getComputedStyle(document.querySelector('#blockepisodescontenusaison<?php echo $saison['IDsaison']; ?>')).display=='none')
				{
					document.querySelector("#blockepisodescontenusaison<?php echo $saison['IDsaison']; ?>").style.display="block";
					document.querySelector(".contenuanimeblockepisodestitre").style.display="none";
					document.querySelector(".blockepisodessaison").style.display="none";
				}
				else
				{
					document.querySelector("#blockepisodescontenusaison<?php echo $saison['IDsaison']; ?>").style.display="block";
					document.querySelector(".contenuanimeblockepisodestitre").style.display="none";
					document.querySelector(".blockepisodessaison").style.display="none";
				}
			}
			
			document.querySelector("#retoursaison<?php echo $saison['IDsaison']; ?>").onclick = function() 
			{ 
				if (window.getComputedStyle(document.querySelector('#blockepisodescontenusaison<?php echo $saison['IDsaison']; ?>')).display=='block')
				{
					<?php
					$searchsaison2 = $db->query('SELECT * FROM saison WHERE IDanime =\'' . $_GET['anime'] . '\'');
					while($saison2 = $searchsaison2->fetch())
					{
					?>
					document.querySelector("#blockepisodescontenusaison<?php echo $saison2['IDsaison']; ?>").style.display="none";
					<?php
					}
					$searchsaison2->closeCursor();
					?>
					document.querySelector(".contenuanimeblockepisodestitre").style.display="block";
					document.querySelector(".blockepisodessaison").style.display="block";
				}
				else
				{
					<?php
					$searchsaison2 = $db->query('SELECT * FROM saison WHERE IDanime =\'' . $_GET['anime'] . '\'');
					while($saison2 = $searchsaison2->fetch())
					{
					?>
					document.querySelector("#blockepisodescontenusaison<?php echo $saison2['IDsaison']; ?>").style.display="none";
					<?php
					}
					$searchsaison2->closeCursor();
					?>
					document.querySelector(".contenuanimeblockepisodestitre").style.display="block";
					document.querySelector(".blockepisodessaison").style.display="block";
				}
			}
		<?php
		}
		$searchsaison->closeCursor();
		?>
			
			document.querySelector(".contenuanimenavscans").onclick = function() 
			{ 
				if (window.getComputedStyle(document.querySelector('.contenuanimeblockscans')).left=='100%')
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="100%";
					document.querySelector(".contenuanimeblockepisodes").style.left="100%";
					document.querySelector(".contenuanimeblockscans").style.left="21%";
					document.querySelector(".contenuanimeblockfilms").style.left="100%";
					document.querySelector(".contenuanimeblockoavs").style.left="100%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="100%";
					document.querySelector(".contenuanimeblockamv").style.left="100%";
					document.querySelector(".contenuanimenavaffiche span").style.color="white";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="pointer";
					document.querySelector(".contenuanimenavepisodes span").style.color="white";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="pointer";
					document.querySelector(".contenuanimenavscans span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavscans span").style.cursor="default";
					document.querySelector(".contenuanimenavfilms span").style.color="white";
					document.querySelector(".contenuanimenavfilms span").style.cursor="pointer";
					document.querySelector(".contenuanimenavoavs span").style.color="white";
					document.querySelector(".contenuanimenavoavs span").style.cursor="pointer";
					document.querySelector(".contenuanimenavgeneriques span").style.color="white";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="pointer";
					document.querySelector(".contenuanimenavamv span").style.color="white";
					document.querySelector(".contenuanimenavamv span").style.cursor="pointer";
				}
				else
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="100%";
					document.querySelector(".contenuanimeblockepisodes").style.left="100%";
					document.querySelector(".contenuanimeblockscans").style.left="21%";
					document.querySelector(".contenuanimeblockfilms").style.left="100%";
					document.querySelector(".contenuanimeblockoavs").style.left="100%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="100%";
					document.querySelector(".contenuanimeblockamv").style.left="100%";
					document.querySelector(".contenuanimenavaffiche span").style.color="white";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="pointer";
					document.querySelector(".contenuanimenavepisodes span").style.color="white";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="pointer";
					document.querySelector(".contenuanimenavscans span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavscans span").style.cursor="default";
					document.querySelector(".contenuanimenavfilms span").style.color="white";
					document.querySelector(".contenuanimenavfilms span").style.cursor="pointer";
					document.querySelector(".contenuanimenavoavs span").style.color="white";
					document.querySelector(".contenuanimenavoavs span").style.cursor="pointer";
					document.querySelector(".contenuanimenavgeneriques span").style.color="white";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="pointer";
					document.querySelector(".contenuanimenavamv span").style.color="white";
					document.querySelector(".contenuanimenavamv span").style.cursor="pointer";
				}
			}
			
			document.querySelector(".contenuanimenavfilms").onclick = function() 
			{ 
				if (window.getComputedStyle(document.querySelector('.contenuanimeblockfilms')).left=='100%')
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="100%";
					document.querySelector(".contenuanimeblockepisodes").style.left="100%";
					document.querySelector(".contenuanimeblockscans").style.left="100%";
					document.querySelector(".contenuanimeblockfilms").style.left="21%";
					document.querySelector(".contenuanimeblockoavs").style.left="100%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="100%";
					document.querySelector(".contenuanimeblockamv").style.left="100%";
					document.querySelector(".contenuanimenavaffiche span").style.color="white";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="pointer";
					document.querySelector(".contenuanimenavepisodes span").style.color="white";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="pointer";
					document.querySelector(".contenuanimenavscans span").style.color="white";
					document.querySelector(".contenuanimenavscans span").style.cursor="pointer";
					document.querySelector(".contenuanimenavfilms span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavfilms span").style.cursor="default";
					document.querySelector(".contenuanimenavoavs span").style.color="white";
					document.querySelector(".contenuanimenavoavs span").style.cursor="pointer";
					document.querySelector(".contenuanimenavgeneriques span").style.color="white";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="pointer";
					document.querySelector(".contenuanimenavamv span").style.color="white";
					document.querySelector(".contenuanimenavamv span").style.cursor="pointer";
				}
				else
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="100%";
					document.querySelector(".contenuanimeblockepisodes").style.left="100%";
					document.querySelector(".contenuanimeblockscans").style.left="100%";
					document.querySelector(".contenuanimeblockfilms").style.left="21%";
					document.querySelector(".contenuanimeblockoavs").style.left="100%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="100%";
					document.querySelector(".contenuanimeblockamv").style.left="100%";
					document.querySelector(".contenuanimenavaffiche span").style.color="white";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="pointer";
					document.querySelector(".contenuanimenavepisodes span").style.color="white";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="pointer";
					document.querySelector(".contenuanimenavscans span").style.color="white";
					document.querySelector(".contenuanimenavscans span").style.cursor="pointer";
					document.querySelector(".contenuanimenavfilms span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavfilms span").style.cursor="default";
					document.querySelector(".contenuanimenavoavs span").style.color="white";
					document.querySelector(".contenuanimenavoavs span").style.cursor="pointer";
					document.querySelector(".contenuanimenavgeneriques span").style.color="white";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="pointer";
					document.querySelector(".contenuanimenavamv span").style.color="white";
					document.querySelector(".contenuanimenavamv span").style.cursor="pointer";
				}
			}
			
			document.querySelector("#blockfilmscontenutitre1").onclick = function() 
			{ 
				if (window.getComputedStyle(document.querySelector('.blockfilmstitre1contenu')).display=='none')
				{
					document.querySelector(".blockfilmstitre1contenu").style.display="block";
					document.querySelector(".blockfilmstitre2contenu").style.display="none";
					document.querySelector(".blockfilmscontenutitre").style.display="none";
					document.querySelector("#blockfilmscontenutitre1").style.display="none";
					document.querySelector("#blockfilmscontenutitre2").style.display="none";
				}
				else
				{
					document.querySelector(".blockfilmstitre1contenu").style.display="block";
					document.querySelector(".blockfilmstitre2contenu").style.display="none";
					document.querySelector(".blockfilmscontenutitre").style.display="none";
					document.querySelector("#blockfilmscontenutitre1").style.display="none";
					document.querySelector("#blockfilmscontenutitre2").style.display="none";
				}
			}
			
			document.querySelector("#blockfilmscontenutitre2").onclick = function() 
			{ 
				if (window.getComputedStyle(document.querySelector('.blockfilmstitre1contenu')).display=='none')
				{
					document.querySelector(".blockfilmstitre1contenu").style.display="none";
					document.querySelector(".blockfilmstitre2contenu").style.display="block";
					document.querySelector(".blockfilmscontenutitre").style.display="none";
					document.querySelector("#blockfilmscontenutitre1").style.display="none";
					document.querySelector("#blockfilmscontenutitre2").style.display="none";
				}
				else
				{
					document.querySelector(".blockfilmstitre1contenu").style.display="none";
					document.querySelector(".blockfilmstitre2contenu").style.display="block";
					document.querySelector(".blockfilmscontenutitre").style.display="none";
					document.querySelector("#blockfilmscontenutitre1").style.display="none";
					document.querySelector("#blockfilmscontenutitre2").style.display="none";
				}
			}
			
			document.querySelector("#blockfilmstitre1contenuretour").onclick = function() 
			{ 
				if (window.getComputedStyle(document.querySelector('.blockfilmstitre1contenu')).display=='block')
				{
					document.querySelector(".blockfilmstitre1contenu").style.display="none";
					document.querySelector(".blockfilmstitre2contenu").style.display="none";
					document.querySelector(".blockfilmscontenutitre").style.display="block";
					document.querySelector("#blockfilmscontenutitre1").style.display="block";
					document.querySelector("#blockfilmscontenutitre2").style.display="block";
				}
				else
				{
					document.querySelector(".blockfilmstitre1contenu").style.display="none";
					document.querySelector(".blockfilmstitre2contenu").style.display="none";
					document.querySelector(".blockfilmscontenutitre").style.display="block";
					document.querySelector("#blockfilmscontenutitre1").style.display="block";
					document.querySelector("#blockfilmscontenutitre2").style.display="block";
				}
			}
			
			document.querySelector("#blockfilmstitre2contenuretour").onclick = function() 
			{ 
				if (window.getComputedStyle(document.querySelector('.blockfilmstitre2contenu')).display=='block')
				{
					document.querySelector(".blockfilmstitre1contenu").style.display="none";
					document.querySelector(".blockfilmstitre2contenu").style.display="none";
					document.querySelector(".blockfilmscontenutitre").style.display="block";
					document.querySelector("#blockfilmscontenutitre1").style.display="block";
					document.querySelector("#blockfilmscontenutitre2").style.display="block";
				}
				else
				{
					document.querySelector(".blockfilmstitre1contenu").style.display="none";
					document.querySelector(".blockfilmstitre2contenu").style.display="none";
					document.querySelector(".blockfilmscontenutitre").style.display="block";
					document.querySelector("#blockfilmscontenutitre1").style.display="block";
					document.querySelector("#blockfilmscontenutitre2").style.display="block";
				}
			}
			
			document.querySelector(".contenuanimenavoavs").onclick = function() 
			{ 
				if (window.getComputedStyle(document.querySelector('.contenuanimeblockoavs')).left=='100%')
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="100%";
					document.querySelector(".contenuanimeblockepisodes").style.left="100%";
					document.querySelector(".contenuanimeblockscans").style.left="100%";
					document.querySelector(".contenuanimeblockfilms").style.left="100%";
					document.querySelector(".contenuanimeblockoavs").style.left="21%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="100%";
					document.querySelector(".contenuanimeblockamv").style.left="100%";
					document.querySelector(".contenuanimenavaffiche span").style.color="white";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="pointer";
					document.querySelector(".contenuanimenavepisodes span").style.color="white";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="pointer";
					document.querySelector(".contenuanimenavscans span").style.color="white";
					document.querySelector(".contenuanimenavscans span").style.cursor="pointer";
					document.querySelector(".contenuanimenavfilms span").style.color="white";
					document.querySelector(".contenuanimenavfilms span").style.cursor="pointer";
					document.querySelector(".contenuanimenavoavs span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavoavs span").style.cursor="default";
					document.querySelector(".contenuanimenavgeneriques span").style.color="white";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="pointer";
					document.querySelector(".contenuanimenavamv span").style.color="white";
					document.querySelector(".contenuanimenavamv span").style.cursor="pointer";
				}
				else
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="100%";
					document.querySelector(".contenuanimeblockepisodes").style.left="100%";
					document.querySelector(".contenuanimeblockscans").style.left="100%";
					document.querySelector(".contenuanimeblockfilms").style.left="100%";
					document.querySelector(".contenuanimeblockoavs").style.left="21%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="100%";
					document.querySelector(".contenuanimeblockamv").style.left="100%";
					document.querySelector(".contenuanimenavaffiche span").style.color="white";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="pointer";
					document.querySelector(".contenuanimenavepisodes span").style.color="white";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="pointer";
					document.querySelector(".contenuanimenavscans span").style.color="white";
					document.querySelector(".contenuanimenavscans span").style.cursor="pointer";
					document.querySelector(".contenuanimenavfilms span").style.color="white";
					document.querySelector(".contenuanimenavfilms span").style.cursor="pointer";
					document.querySelector(".contenuanimenavoavs span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavoavs span").style.cursor="default";
					document.querySelector(".contenuanimenavgeneriques span").style.color="white";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="pointer";
					document.querySelector(".contenuanimenavamv span").style.color="white";
					document.querySelector(".contenuanimenavamv span").style.cursor="pointer";
				}
			}
			
			document.querySelector(".contenuanimenavgeneriques").onclick = function() 
			{ 
				if (window.getComputedStyle(document.querySelector('.contenuanimeblockgeneriques')).left=='100%')
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="100%";
					document.querySelector(".contenuanimeblockepisodes").style.left="100%";
					document.querySelector(".contenuanimeblockscans").style.left="100%";
					document.querySelector(".contenuanimeblockfilms").style.left="100%";
					document.querySelector(".contenuanimeblockoavs").style.left="100%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="21%";
					document.querySelector(".contenuanimeblockamv").style.left="100%";
					document.querySelector(".contenuanimenavaffiche span").style.color="white";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="pointer";
					document.querySelector(".contenuanimenavepisodes span").style.color="white";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="pointer";
					document.querySelector(".contenuanimenavscans span").style.color="white";
					document.querySelector(".contenuanimenavscans span").style.cursor="pointer";
					document.querySelector(".contenuanimenavfilms span").style.color="white";
					document.querySelector(".contenuanimenavfilms span").style.cursor="pointer";
					document.querySelector(".contenuanimenavoavs span").style.color="white";
					document.querySelector(".contenuanimenavoavs span").style.cursor="pointer";
					document.querySelector(".contenuanimenavgeneriques span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="default";
					document.querySelector(".contenuanimenavamv span").style.color="white";
					document.querySelector(".contenuanimenavamv span").style.cursor="pointer";
				}
				else
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="100%";
					document.querySelector(".contenuanimeblockepisodes").style.left="100%";
					document.querySelector(".contenuanimeblockscans").style.left="100%";
					document.querySelector(".contenuanimeblockfilms").style.left="100%";
					document.querySelector(".contenuanimeblockoavs").style.left="100%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="21%";
					document.querySelector(".contenuanimeblockamv").style.left="100%";
					document.querySelector(".contenuanimenavaffiche span").style.color="white";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="pointer";
					document.querySelector(".contenuanimenavepisodes span").style.color="white";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="pointer";
					document.querySelector(".contenuanimenavscans span").style.color="white";
					document.querySelector(".contenuanimenavscans span").style.cursor="pointer";
					document.querySelector(".contenuanimenavfilms span").style.color="white";
					document.querySelector(".contenuanimenavfilms span").style.cursor="pointer";
					document.querySelector(".contenuanimenavoavs span").style.color="white";
					document.querySelector(".contenuanimenavoavs span").style.cursor="pointer";
					document.querySelector(".contenuanimenavgeneriques span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="default";
					document.querySelector(".contenuanimenavamv span").style.color="white";
					document.querySelector(".contenuanimenavamv span").style.cursor="pointer";
				}
			}
			
			document.querySelector(".contenuanimenavamv").onclick = function() 
			{ 
				if (window.getComputedStyle(document.querySelector('.contenuanimeblockamv')).left=='100%')
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="100%";
					document.querySelector(".contenuanimeblockepisodes").style.left="100%";
					document.querySelector(".contenuanimeblockscans").style.left="100%";
					document.querySelector(".contenuanimeblockfilms").style.left="100%";
					document.querySelector(".contenuanimeblockoavs").style.left="100%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="100%";
					document.querySelector(".contenuanimeblockamv").style.left="21%";
					document.querySelector(".contenuanimenavaffiche span").style.color="white";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="pointer";
					document.querySelector(".contenuanimenavepisodes span").style.color="white";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="pointer";
					document.querySelector(".contenuanimenavscans span").style.color="white";
					document.querySelector(".contenuanimenavscans span").style.cursor="pointer";
					document.querySelector(".contenuanimenavfilms span").style.color="white";
					document.querySelector(".contenuanimenavfilms span").style.cursor="pointer";
					document.querySelector(".contenuanimenavoavs span").style.color="white";
					document.querySelector(".contenuanimenavoavs span").style.cursor="pointer";
					document.querySelector(".contenuanimenavgeneriques span").style.color="white";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="pointer";
					document.querySelector(".contenuanimenavamv span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavamv span").style.cursor="default";
				}
				else
				{
					document.querySelector(".contenuanimeblockaffiche").style.left="100%";
					document.querySelector(".contenuanimeblockepisodes").style.left="100%";
					document.querySelector(".contenuanimeblockscans").style.left="100%";
					document.querySelector(".contenuanimeblockfilms").style.left="100%";
					document.querySelector(".contenuanimeblockoavs").style.left="100%";
					document.querySelector(".contenuanimeblockgeneriques").style.left="100%";
					document.querySelector(".contenuanimeblockamv").style.left="21%";
					document.querySelector(".contenuanimenavaffiche span").style.color="white";
					document.querySelector(".contenuanimenavaffiche span").style.cursor="pointer";
					document.querySelector(".contenuanimenavepisodes span").style.color="white";
					document.querySelector(".contenuanimenavepisodes span").style.cursor="pointer";
					document.querySelector(".contenuanimenavscans span").style.color="white";
					document.querySelector(".contenuanimenavscans span").style.cursor="pointer";
					document.querySelector(".contenuanimenavfilms span").style.color="white";
					document.querySelector(".contenuanimenavfilms span").style.cursor="pointer";
					document.querySelector(".contenuanimenavoavs span").style.color="white";
					document.querySelector(".contenuanimenavoavs span").style.cursor="pointer";
					document.querySelector(".contenuanimenavgeneriques span").style.color="white";
					document.querySelector(".contenuanimenavgeneriques span").style.cursor="pointer";
					document.querySelector(".contenuanimenavamv span").style.color="rgb(2,2,2)";
					document.querySelector(".contenuanimenavamv span").style.cursor="default";
				}
			}
		</script>
		<?php
		}
		else
		{
		?>
			<section id="contenu">
				<hr class="hrfilm" />
				<h2 id="alphabet"><strong>
					<a id="lettre" href="#1">#</a>
					<a id="lettre" href="#A">A</a>
					<a id="lettre" href="#B">B</a>
					<a id="lettre" href="#C">C</a>
					<a id="lettre" href="#D">D</a>
					<a id="lettre" href="#E">E</a>
					<a id="lettre" href="#F">F</a>
					<a id="lettre" href="#G">G</a>
					<a id="lettre" href="#H">H</a>
					<a id="lettre" href="#I">I</a>
					<a id="lettre" href="#J">J</a>
					<a id="lettre" href="#K">K</a>
					<a id="lettre" href="#L">L</a>
					<a id="lettre" href="#M">M</a>
					<a id="lettre" href="#N">N</a>
					<a id="lettre" href="#O">O</a>
					<a id="lettre" href="#P">P</a>
					<a id="lettre" href="#Q">Q</a>
					<a id="lettre" href="#R">R</a>
					<a id="lettre" href="#S">S</a>
					<a id="lettre" href="#T">T</a>
					<a id="lettre" href="#U">U</a>
					<a id="lettre" href="#V">V</a>
					<a id="lettre" href="#W">W</a>
					<a id="lettre" href="#X">X</a>
					<a id="lettre" href="#Y">Y</a>
					<a id="lettre" href="#Z">Z</a>
				</strong></h2>
				<div class="backgroundselectiontrier">
					<div class="selectiontrier">
						<span class="trierpar">Trier par :</span>
						<span class="alphabetique">Alphabétique</span>
						<span class="recent">Récent</span>
						<span class="mieuxnotes">Mieux notés</span>
						<span class="chevron">></span>
					</div>
					<div class="propositiontrier">
						<span id="trierparalphabetique" class="propositiontrieralphabetique">Alphabétique</span>
						<span id="trierparrecent" class="propositiontrierrecent">Récent</span>
						<span id="trierparmieuxnotes" class="propositiontriermieuxnotes">Mieux notés</span>
					</div>
				</div>
				
				<div class="blocktrierpardefaut">
				<?php
				$searchanime = $db->query('SELECT * FROM animes ORDER BY titre');
				
				while ($infoanime = $searchanime->fetch())
				{
				?>
				<div id="<?php echo htmlspecialchars($infoanime['lettre']); ?>" class="blockanime">
					<div class="cadreanime">
						<a href="anime.php?anime=<?php echo $infoanime['ID']; ?>"><span class="titreanime"><strong>&nbsp;&nbsp;<?php echo htmlspecialchars($infoanime['titre']); ?></strong>
						<?php				
							$searchnbvf = $db->query('SELECT COUNT(*) AS nbvf FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\' AND videovf >\'' . 2 . '\'');
							$nbvf = $searchnbvf->fetch();
							
							$searchderniervf = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\' AND videovf >\'' . 2 . '\' ORDER BY numero DESC LIMIT 0, 1');
							$derniervf = $searchderniervf->fetch();	
							
							$searchnbvostfr = $db->query('SELECT COUNT(*) AS nbvostfr FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\'');
							$nbvostfr = $searchnbvostfr->fetch();
							
							$searchderniervostfr = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\' ORDER BY numero DESC LIMIT 0, 1');
							$derniervostfr = $searchderniervostfr->fetch();	
							
							$searchnbscan = $db->query('SELECT COUNT(*) AS nbscan FROM scans WHERE IDanime =\'' . $infoanime['ID'] . '\' AND page = 1');
							$nbscan = $searchnbscan->fetch();
							
							$searchdernierscan = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $infoanime['ID'] . '\' AND page = 1 ORDER BY numero DESC LIMIT 0, 1');
							$dernierscan = $searchdernierscan->fetch();
							
							$searchnbfilmanime = $db->query('SELECT COUNT(*) AS nbfilmanime FROM filmsanimes WHERE IDanime =\'' . $infoanime['ID'] . '\'');
							$nbfilmanime = $searchnbfilmanime->fetch();
							
							$searchnbfilmspecial = $db->query('SELECT COUNT(*) AS nbfilmspecial FROM filmsspecial WHERE IDanime =\'' . $infoanime['ID'] . '\'');
							$nbfilmspecial = $searchnbfilmspecial->fetch();
							
							$nbfilm = $nbfilmanime['nbfilmanime'] + $nbfilmspecial['nbfilmspecial'];
							
							$searchdernierfilmanime = $db->query('SELECT * FROM filmsanimes WHERE IDanime =\'' . $infoanime['ID'] . '\' ORDER BY numero DESC LIMIT 0, 1');
							$dernierfilmanime = $searchdernierfilmanime->fetch();
							
							$searchnboav = $db->query('SELECT COUNT(*) AS nboav FROM oavs WHERE IDanime =\'' . $infoanime['ID'] . '\'');
							$nboav = $searchnboav->fetch();
							
							$searchdernieroav = $db->query('SELECT * FROM oavs WHERE IDanime =\'' . $infoanime['ID'] . '\' ORDER BY numero DESC LIMIT 0, 1');
							$dernieroav = $searchdernieroav->fetch();
							
							$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesanimes WHERE IDanime =\'' . $infoanime['ID'] . '\'');
							$notemoy = $searchmoynote->fetch();	
							$notemoyenne = $notemoy['notemoy'];
							$ID = $infoanime['ID'];
							$updatenotemoy = $db->prepare('UPDATE animes SET note = :note WHERE ID = :ID');
							$updatenotemoy->execute(array('note' => $notemoyenne, 'ID' => $ID));
							if($notemoy['notemoy'] == 0)
							{
							?>
								<span class="etoile" style="color:rgb(10,10,10);">★★★★★</span>
							<?php
							}
							else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
							{
							?>
								<span class="etoile">★<span style="color:rgb(10,10,10);">★★★★</span></span>
							<?php
							}
							else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
							{
							?>
								<span class="etoile">★★<span style="color:rgb(10,10,10);">★★★</span></span>
							<?php
							}
							else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
							{
							?>
								<span class="etoile">★★★<span style="color:rgb(10,10,10);">★★</span></span>
							<?php
							}
							else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
							{
							?>
								<span class="etoile">★★★★<span style="color:rgb(10,10,10);">★</span></span>
							<?php
							}
							else if($notemoy['notemoy'] >= 5)
							{
							?>
								<span class="etoile">★★★★★</span>
							<?php
							}
						?>
						</a>
						<?php
						$dateanime = date("Y-m-d", strtotime($infoanime['date']));
						$newcontenuimg = date('Y-m-d');
						
						if($dateanime == $newcontenuimg)
						{
						?>
							<img src="images/new.png" alt="New" class="newcontenuimg" style="margin-top: -25px;" />
						<?php
						}
						?>
						<a href="anime.php?anime=<?php echo $infoanime['ID']; ?>"><img src="anime/<?php echo $infoanime['image']; ?>" alt="<?php echo htmlspecialchars($infoanime['titre']); ?>" class="imageanime" width="345" height="210" /></a>
						<span class="annee">Année : <?php echo htmlspecialchars($infoanime['annee']); ?></span>
						<span class="auteur">Auteur : <?php echo htmlspecialchars($infoanime['auteur']); ?></span>
						<span class="synopsis">Synopsis :</span>
						<span class="synopsis2">
							<?php echo htmlspecialchars($infoanime['synopsis']); ?>
						</span>
						<span class="genre">
						<?php
						if($infoanime['action'] == "Action")
						{
						?>
							<span style="font-size:9px;background:orange;color:orange;border:1px solid orange;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Action </span>
						<?php
						}
						if($infoanime['aventure'] == "Aventure")
						{
						?>
							<span style="font-size:9px;background:green;color:green;border:1px solid green;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Aventure </span>
						<?php
						}
						if($infoanime['amitier'] == "Amitié")
						{
						?>
							<span style="font-size:9px;background:pink;color:pink;border:1px solid pink;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Amitié </span>
						<?php
						}
						if($infoanime['comedie'] == "Comédie")
						{
						?>
							<span style="font-size:9px;background:yellow;color:yellow;border:1px solid yellow;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Comédie </span>
						<?php
						}
						if($infoanime['drame'] == "Drame")
						{
						?>
							<span style="font-size:9px;background:red;color:red;border:1px solid red;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Drame </span>
						<?php
						}
						if($infoanime['fantastique'] == "Fantastique")
						{
						?>
							<span style="font-size:9px;background:blue;color:blue;border:1px solid blue;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Fantastique </span>
						<?php
						}
						if($infoanime['guerre'] == "Guerre")
						{
						?>
							<span style="font-size:9px;background:darkred;color:darkred;border:1px solid darkred;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Guerre </span>
						<?php
						}
						if($infoanime['cyber'] == "Cyber")
						{
						?>
							<span style="font-size:9px;background:purple;color:purple;border:1px solid purple;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Cyber </span>
						<?php
						}
						if($infoanime['mecha'] == "Mecha")
						{
						?>
							<span style="font-size:9px;background:gray;color:gray;border:1px solid gray;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Mecha </span>
						<?php
						}
						if($infoanime['sport'] == "Sport")
						{
						?>
							<span style="font-size:9px;background:brown;color:brown;border:1px solid brown;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Sport </span>
						<?php
						}
						if($infoanime['horreur'] == "Horreur")
						{
						?>
							<span style="font-size:9px;background:black;color:black;border:1px solid black;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Horreur </span>
						<?php
						}
						?>
					
						</span>
						<ul class="menuanime">
							<li class="vf"><a href="anime.php?anime=<?php echo $infoanime['ID'] ?>&episode=<?php echo $derniervf['numero'] ?>"><?php echo $nbvf['nbvf']; ?> VF</a></li>
							<li class="vostfr"><a href="anime.php?anime=<?php echo $infoanime['ID'] ?>&episode=<?php echo $derniervostfr['numero'] ?>"><?php echo $nbvostfr['nbvostfr']; ?> VOSTFR</a></li>
							<li class="scan"><a href="anime.php?anime=<?php echo $infoanime['ID'] ?>&scan=<?php echo $dernierscan['numero'] ?>"><?php echo $nbscan['nbscan']; ?> SCANS</a></li>
							<li class="film"><a href="anime.php?anime=<?php echo $infoanime['ID'] ?>&filmanime=<?php echo $dernierfilmanime['numero'] ?>"><?php echo $nbfilm; ?> FILMS</a></li>
							<li class="oav"><a href="anime.php?anime=<?php echo $infoanime['ID'] ?>&oav=<?php echo $dernieroav['numero'] ?>"><?php echo $nboav['nboav']; ?> OAVS</a></li>
						</ul>
					</div>
				</div>
				<?php
				}
				$searchanime->closeCursor();
				?>
				</div>
			</section>
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
				
				document.getElementById('trierparalphabetique').onclick = function()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open('GET', 'site/phpanime.php?trierparalphabetique=ok');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(".propositiontrier").style.display="none";
							document.querySelector(".chevron").style.transform="rotate(0deg)";
							document.querySelector('.recent').style.display="none";
							document.querySelector('.mieuxnotes').style.display="none";
							document.querySelector('.alphabetique').style.display="inline-block";
							document.querySelector('.propositiontrierrecent').style.display="block";
							document.querySelector('.propositiontriermieuxnotes').style.display="block";
							document.querySelector('.propositiontrieralphabetique').style.display="none";
							document.querySelector('.blocktrierpardefaut').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				document.getElementById('trierparrecent').onclick = function()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open('GET', 'site/phpanime.php?trierparrecent=ok');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(".propositiontrier").style.display="none";
							document.querySelector(".chevron").style.transform="rotate(0deg)";
							document.querySelector('.recent').style.display="inline-block";
							document.querySelector('.mieuxnotes').style.display="none";
							document.querySelector('.alphabetique').style.display="none";
							document.querySelector('.propositiontrierrecent').style.display="none";
							document.querySelector('.propositiontriermieuxnotes').style.display="block";
							document.querySelector('.propositiontrieralphabetique').style.display="block";
							document.querySelector('.blocktrierpardefaut').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				document.getElementById('trierparmieuxnotes').onclick = function()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open('GET', 'site/phpanime.php?trierparmieuxnotes=ok');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(".propositiontrier").style.display="none";
							document.querySelector(".chevron").style.transform="rotate(0deg)";
							document.querySelector('.recent').style.display="none";
							document.querySelector('.mieuxnotes').style.display="inline-block";
							document.querySelector('.alphabetique').style.display="none";
							document.querySelector('.propositiontrierrecent').style.display="block";
							document.querySelector('.propositiontriermieuxnotes').style.display="none";
							document.querySelector('.propositiontrieralphabetique').style.display="block";
							document.querySelector('.blocktrierpardefaut').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				$('a[href^="#"]').click(function(){
					var the_id = $(this).attr("href");
				$("#body2").mCustomScrollbar("scrollTo",$(the_id).offset().top -110, { scrollInertia: 2000 }); return false;});
			</script>
		<?php
		}
		?>
		</div>	
		<script id="cid0020000205644521856" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 251px;height: 426px;">{"handle":"metromanga1","arch":"js","styles":{"a":"cc0000","b":100,"c":"FFFFFF","d":"FFFFFF","k":"cc0000","l":"cc0000","m":"cc0000","n":"FFFFFF","p":"9.36","q":"cc0000","r":100,"pos":"br","cv":1,"cvbg":"CC0000","cvw":251,"cvh":30,"cnrs":"0.26","ticker":1,"fwtickm":1}}</script>
		<?php include("includes/footer.php"); ?>
	</div>
	</body>
</html>