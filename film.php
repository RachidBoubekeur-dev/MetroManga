<?php session_start(); ?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<link rel="stylesheet" href="film.css" />
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
					$(".contenufilmblockvf").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".contenufilmblockvostfr").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".contenufilmblockcommentaires").mCustomScrollbar({
						theme:"inset-3"
					});
				});
			})(jQuery);
		</script>
		
		<title>Film - Metro Manga </title>
	</head>
	<body id="body">
	<div id="body2">
		<?php include("includes/loading.php"); ?>
		<?php include("includes/header.php"); ?>
		<div id="contenuloading">
			<section id="contenu">
			<?php
			if(isset($_GET['id']))
			{
				$searchfilmid = $db->query('SELECT ID FROM films WHERE ID =\'' . $_GET['id'] . '\'');
				$searchfilmidexist = $searchfilmid->rowCount();
				if($searchfilmidexist == 0)
				{
				?>
					<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
					<script>
						window.setTimeout("location=('film.php');",0);
					</script>
					<style>
					.affichagefilm
					{
						display: none;
					}
					</style>
				<?php
				}
				
				$searchinfoaffichagefilm = $db->query('SELECT * FROM films WHERE ID =\'' . $_GET['id'] . '\'');
				$infoaffichagefilm = $searchinfoaffichagefilm->fetch();
			?>
				
			<div id="contenufilmaffichage">
				<div class="contenufilmnav">
					<div class="contenufilmnavaffiche"><span>Affiche</span></div>
					<?php
					if($infoaffichagefilm['videovf'] != "")
					{
					?>
						<div class="contenufilmnavvf"><span>Lecteur VF</span></div>
						<style>
							.contenufilmnavvf
							{
								width: 15%;
								margin-bottom: 0px;
							}
							.contenufilmnavvf span
							{
								display: block;
							}
							.contenufilmblockvf
							{
								display: block;
							}
						</style>
					<?php
					}
					else
					{
					?>
						<div class="contenufilmnavvf"><span></span></div>
					<?php
					}
					?>
					<div class="contenufilmnavvostfr"><span>Lecteur VOSTFR</span></div>
					<div class="contenufilmnavcommentaires"><span>Commentaires</span></div>
				</div>
				<div class="contenufilmblockaffiche"><br />
					<span><img src="film/<?php echo $infoaffichagefilm['image']; ?>" alt="<?php echo htmlspecialchars($infoaffichagefilm['titre']); ?>" class="contenufilmblockimg" /></span>
					<span class="contenufilmblocktitre"><?php echo htmlspecialchars($infoaffichagefilm['titre']); ?></span>
				<div class="blocknoteretoilefilm">
				<?php
					$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesfilms WHERE IDfilm =\'' . $infoaffichagefilm['ID'] . '\'');
					$notemoy = $searchmoynote->fetch();	
					if($notemoy['notemoy'] == 0)
					{
					?>
						<span class="contenufilmblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>
					<?php
					}
					else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
					{
					?>
						<span class="contenufilmblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>
					<?php
					}
					else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
					{
					?>
						<span class="contenufilmblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>
					<?php
					}
					else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
					{
					?>
						<span class="contenufilmblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>
					<?php
					}
					else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
					{
					?>
						<span class="contenufilmblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>
					<?php
					}
					else if($notemoy['notemoy'] >= 5)
					{
					?>
						<span class="contenufilmblockaffichenote">★★★★★</span>
					<?php
					}
					
					if(isset($_SESSION['ID']))
					{
						$searchnote = $db->prepare('SELECT * FROM notesfilms WHERE IDfilm = ? AND IDmembre = ?');
						$searchnote->execute(array($_GET['id'],$_SESSION['ID']));
						$noteexist = $searchnote->rowCount();
						if($noteexist == 0)
						{
						?>
							<input type="submit" value="★" class="blocknoteretoile1film" id="blocknoteretoile1film" />
							<input type="submit" value="★" class="blocknoteretoile2film" id="blocknoteretoile2film" />
							<input type="submit" value="★" class="blocknoteretoile3film" id="blocknoteretoile3film" />
							<input type="submit" value="★" class="blocknoteretoile4film" id="blocknoteretoile4film" />
							<input type="submit" value="★" class="blocknoteretoile5film" id="blocknoteretoile5film" />
							
							<script>
							
								document.getElementById('blocknoteretoile1film').onclick = function()
								{
									var xhr = new XMLHttpRequest();
									
									xhr.open('GET', 'site/phpfilm.php?blocknoteretoile1film=ok&IDfilm=<?php echo $_GET['id']; ?>');
									
									xhr.onreadystatechange = function() 
									{
										if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
										{
											document.querySelector('.blocknoteretoilefilm').innerHTML = xhr.responseText;
										}
									};
									
									xhr.send(null);
								}
								
								document.getElementById('blocknoteretoile2film').onclick = function()
								{
									var xhr = new XMLHttpRequest();
									
									xhr.open('GET', 'site/phpfilm.php?blocknoteretoile2film=ok&IDfilm=<?php echo $_GET['id']; ?>');
									
									xhr.onreadystatechange = function() 
									{
										if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
										{
											document.querySelector('.blocknoteretoilefilm').innerHTML = xhr.responseText;
										}
									};
									
									xhr.send(null);
								}
								
								document.getElementById('blocknoteretoile3film').onclick = function()
								{
									var xhr = new XMLHttpRequest();
									
									xhr.open('GET', 'site/phpfilm.php?blocknoteretoile3film=ok&IDfilm=<?php echo $_GET['id']; ?>');
									
									xhr.onreadystatechange = function() 
									{
										if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
										{
											document.querySelector('.blocknoteretoilefilm').innerHTML = xhr.responseText;
										}
									};
									
									xhr.send(null);
								}
								
								document.getElementById('blocknoteretoile4film').onclick = function()
								{
									var xhr = new XMLHttpRequest();
									
									xhr.open('GET', 'site/phpfilm.php?blocknoteretoile4film=ok&IDfilm=<?php echo $_GET['id']; ?>');
									
									xhr.onreadystatechange = function() 
									{
										if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
										{
											document.querySelector('.blocknoteretoilefilm').innerHTML = xhr.responseText;
										}
									};
									
									xhr.send(null);
								}
								
								document.getElementById('blocknoteretoile5film').onclick = function()
								{
									var xhr = new XMLHttpRequest();
									
									xhr.open('GET', 'site/phpfilm.php?blocknoteretoile5film=ok&IDfilm=<?php echo $_GET['id']; ?>');
									
									xhr.onreadystatechange = function() 
									{
										if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
										{
											document.querySelector('.blocknoteretoilefilm').innerHTML = xhr.responseText;
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
					<img src="images/bandeannoncenoir.png" alt="Regarder la bande annonce" title="Regarder la bande annonce" class="contenufilmblockaffichebandeannonce" />
					<div class="blockaffichebandeannoncecontenu" style="margin-top:-200px;">
						<img src="images/erreur.png" alt="Fermez" class="blockaffichebandeannoncefermez" />
						<iframe src="<?php echo htmlspecialchars($infoaffichagefilm['bandeannonce']); ?>" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
					</div>
					<span class="contenufilmblockdurer">Durée: <?php echo htmlspecialchars($infoaffichagefilm['durer']); ?></span>
					<span class="contenufilmblockdate">Date: <?php echo htmlspecialchars(date("d/m/Y", strtotime($infoaffichagefilm['date']))); ?></span>
					<span class="contenufilmblockrealisateur">Réalisateur: <?php echo htmlspecialchars($infoaffichagefilm['realisateur']); ?></span>
					<span class="contenufilmblockgenres">
						Genres: 
						<?php
						if($infoaffichagefilm['action'] == "Action")
						{
						?>
							<?php echo htmlspecialchars($infoaffichagefilm['action']); ?>,
						<?php
						}
						if($infoaffichagefilm['aventure'] == "Aventure")
						{
						?>
							<?php echo htmlspecialchars($infoaffichagefilm['aventure']); ?>,
						<?php
						}
						if($infoaffichagefilm['amitier'] == "Amitié")
						{
						?>
							<?php echo htmlspecialchars($infoaffichagefilm['amitier']); ?>,
						<?php
						}
						if($infoaffichagefilm['comedie'] == "Comédie")
						{
						?>
							<?php echo htmlspecialchars($infoaffichagefilm['comedie']); ?>,
						<?php
						}
						if($infoaffichagefilm['drame'] == "Drame")
						{
						?>
							<?php echo htmlspecialchars($infoaffichagefilm['drame']); ?>,
						<?php
						}
						if($infoaffichagefilm['fantastique'] == "Fantastique")
						{
						?>
							<?php echo htmlspecialchars($infoaffichagefilm['fantastique']); ?>,
						<?php
						}
						if($infoaffichagefilm['guerre'] == "Guerre")
						{
						?>
							<?php echo htmlspecialchars($infoaffichagefilm['guerre']); ?>,
						<?php
						}
						if($infoaffichagefilm['cyber'] == "Cyber")
						{
						?>
							<?php echo htmlspecialchars($infoaffichagefilm['cyber']); ?>,
						<?php
						}
						if($infoaffichagefilm['mecha'] == "Mecha")
						{
						?>
							<?php echo htmlspecialchars($infoaffichagefilm['mecha']); ?>,
						<?php
						}
						if($infoaffichagefilm['sport'] == "Sport")
						{
						?>
							<?php echo htmlspecialchars($infoaffichagefilm['sport']); ?>,
						<?php
						}
						if($infoaffichagefilm['horreur'] == "Horreur")
						{
						?>
							<?php echo htmlspecialchars($infoaffichagefilm['horreur']); ?>,
						<?php
						}
						?>
					</span>
					<span class="contenufilmblocksynopsis"><?php echo htmlspecialchars($infoaffichagefilm['synopsis']); ?></span>
				</div>
				<div class="contenufilmblockvf"><br />
					<p class="contenufilmblockfilmtitre"><?php echo htmlspecialchars($infoaffichagefilm['titre']); ?></p>
					<iframe src="<?php echo htmlspecialchars($infoaffichagefilm['videovf']); ?>" frameborder="0" class="contenufilmblockvideo" style="margin-top: -7px;margin-bottom:50px;" allowfullscreen></iframe>
					
					<span id="signaleVFajax">
					<?php
					$videovf = "VF";
					
					$searchsignalelecteurvf = $db->prepare('SELECT * FROM signalefilm WHERE IDfilm = ? AND video = ?');
					$searchsignalelecteurvf->execute(array($infoaffichagefilm['ID'],$videovf));
					$signaleexistlecteurvf = $searchsignalelecteurvf->rowCount();
					if($signaleexistlecteurvf == 0)
					{
					?>
						<span id="signaleVF"><img src="images/signalernoir.png" alt="Signaler" class="contenufilmblocksignaler" style="cursor:pointer;" /></span>
						
						<script>
						
							document.getElementById('signaleVF').onclick = function()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpfilm.php?signalerfilmlecteurvf=ok&IDfilm=<?php echo $_GET['id']; ?>');
								
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
						<span><img src="images/signalerrouge.png" alt="Signaler" class="contenufilmblocksignaler" /></span>
					<?php
					}
					?>
					</span>
					<?php
					$searchvideolecteurvf = $db->query('SELECT * FROM videofilms WHERE IDfilm =\'' . $_GET['id'] . '\' AND lecteurvideo =\'' . 'VF' . '\'');
					while ($videolecteurvf = $searchvideolecteurvf->fetch())
					{
					?>
						<iframe src="<?php echo htmlspecialchars($videolecteurvf['video']); ?>" frameborder="0" class="contenufilmblockvideo" style="margin-bottom: 60px;" allowfullscreen></iframe>
					<?php
					}
					$searchvideolecteurvf->closeCursor();
					?>
				</div>
				<div class="contenufilmblockvostfr"><br />
					<p class="contenufilmblockfilmtitre"><?php echo htmlspecialchars($infoaffichagefilm['titre']); ?></p>
					<iframe src="<?php echo htmlspecialchars($infoaffichagefilm['videovostfr']); ?>"  frameborder="0" class="contenufilmblockvideo" style="margin-top: -7px;margin-bottom:50px;" allowfullscreen></iframe>
					
					<span id="signaleVOSTFRajax">
					<?php
					$videovostfr = "VOSTFR";
					
					$searchsignalelecteurvostfr = $db->prepare('SELECT * FROM signalefilm WHERE IDfilm = ? AND video = ?');
					$searchsignalelecteurvostfr->execute(array($infoaffichagefilm['ID'],$videovostfr));
					$signaleexistlecteurvostfr = $searchsignalelecteurvostfr->rowCount();
					if($signaleexistlecteurvostfr == 0)
					{
					?>
						<span id="signaleVOSTFR"><img src="images/signalernoir.png" alt="Signaler" class="contenufilmblocksignaler" style="cursor:pointer;" /></span>
						
						<script>
						
							document.getElementById('signaleVOSTFR').onclick = function()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpfilm.php?signalerfilmlecteurvostfr=ok&IDfilm=<?php echo $_GET['id']; ?>');
								
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
						<span><img src="images/signalerrouge.png" alt="Signaler" class="contenufilmblocksignaler" /></span>
					<?php
					}
					?>
					</span>
					<?php
					$searchvideolecteurvostfr = $db->query('SELECT * FROM videofilms WHERE IDfilm =\'' . $_GET['id'] . '\' AND lecteurvideo =\'' . 'VOSTFR' . '\'');
					while ($videolecteurvostfr = $searchvideolecteurvostfr->fetch())
					{
					?>
						<iframe src="<?php echo htmlspecialchars($videolecteurvostfr['video']); ?>" frameborder="0" class="contenufilmblockvideo" style="margin-bottom: 60px;" allowfullscreen></iframe>
					<?php
					}
					$searchvideolecteurvostfr->closeCursor();
					?>
				</div>
				<div class="contenufilmblockcommentaires"><br />
				<span id="commentaireajax">
					<div class="blockcommentairesblockcommenter">
					<?php
					if(isset($_SESSION['ID']))
					{
						$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesfilms WHERE IDfilm =\'' . $infoaffichagefilm['ID'] . '\'');
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
						$searchinfocommentaire = $db->query('SELECT * FROM commentairesfilms WHERE IDfilm =\'' . $infoaffichagefilm['ID'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
							<span><a href="profil.php?id=<?php echo $infocommentairemembre['ID']; ?>" ><img src="membre/avatar/<?php echo $infocommentairemembre['avatar']; ?>" alt="Avatar" class="infocommentaireavatar" /></a></span>
							<span class="infocommentairepseudo"><a href="profil.php?id=<?php echo $infocommentairemembre['ID']; ?>"  style="color:white;text-decoration:none;"><?php echo $infocommentairemembre['pseudo']; ?></a></span>
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
					$searchinfocommentairejs = $db->query('SELECT * FROM commentairesfilms WHERE IDfilm =\'' . $infoaffichagefilm['ID'] . '\' ORDER BY ID DESC LIMIT 0, 100');
					while ($infocommentairejs = $searchinfocommentairejs->fetch())
					{
					?>							
							function signalecommentaire<?php echo $infocommentairejs['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpfilm.php?signalecommentaire=ok&IDfilm=<?php echo $_GET['id']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>');
								
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
								
								xhr.open('GET', 'site/phpfilm.php?supprimercommentaire=ok&IDfilm=<?php echo $_GET['id']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>&LIENcommentaire=<?php echo $infocommentairejs['lien']; ?>');
								
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
				<script>
					
					function ajoutercommentaire()
					{
						var xhr = new XMLHttpRequest();
						var valuecommentaire = document.getElementById('blockcommentertextarea').value;
						
						var valuecommentaire = encodeURIComponent(valuecommentaire);
						
						xhr.open('GET', 'site/phpfilm.php?ajoutercommentaire=' + valuecommentaire + '&IDfilm=<?php echo $_GET['id']; ?>');
						
						xhr.onreadystatechange = function() 
						{
							if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
							{
								document.querySelector('#commentaireajax').innerHTML = xhr.responseText;
							}
						};
						
						xhr.send(null);
					}
					
					document.querySelector(".contenufilmnavaffiche").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('.contenufilmblockaffiche')).left=='100%')
						{
							document.querySelector(".contenufilmblockaffiche").style.left="21%";
							document.querySelector(".contenufilmblockvf").style.left="100%";
							document.querySelector(".contenufilmblockvostfr").style.left="100%";
							document.querySelector(".contenufilmblockcommentaires").style.left="100%";
							document.querySelector(".contenufilmnavaffiche span").style.color="rgb(2,2,2)";
							document.querySelector(".contenufilmnavaffiche span").style.cursor="default";
							document.querySelector(".contenufilmnavvf span").style.color="white";
							document.querySelector(".contenufilmnavvf span").style.cursor="pointer";
							document.querySelector(".contenufilmnavvostfr span").style.color="white";
							document.querySelector(".contenufilmnavvostfr span").style.cursor="pointer";
							document.querySelector(".contenufilmnavcommentaires span").style.color="white";
							document.querySelector(".contenufilmnavcommentaires span").style.cursor="pointer";
						}
						else
						{
							document.querySelector(".contenufilmblockaffiche").style.left="21%";
							document.querySelector(".contenufilmblockvf").style.left="100%";
							document.querySelector(".contenufilmblockvostfr").style.left="100%";
							document.querySelector(".contenufilmblockcommentaires").style.left="100%";
							document.querySelector(".contenufilmnavaffiche span").style.color="rgb(2,2,2)";
							document.querySelector(".contenufilmnavaffiche span").style.cursor="default";
							document.querySelector(".contenufilmnavvf span").style.color="white";
							document.querySelector(".contenufilmnavvf span").style.cursor="pointer";
							document.querySelector(".contenufilmnavvostfr span").style.color="white";
							document.querySelector(".contenufilmnavvostfr span").style.cursor="pointer";
							document.querySelector(".contenufilmnavcommentaires span").style.color="white";
							document.querySelector(".contenufilmnavcommentaires span").style.cursor="pointer";
						}
					}
					
					document.querySelector(".contenufilmblockaffichebandeannonce").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('.blockaffichebandeannoncecontenu')).left=='100%')
						{
							document.querySelector(".blockaffichebandeannoncecontenu").style.left="19.5%";
							document.querySelector(".contenufilmblockaffichebandeannonce").style.cursor="default";
						}
						else
						{
							document.querySelector(".blockaffichebandeannoncecontenu").style.left="19.5%";
							document.querySelector(".contenufilmblockaffichebandeannonce").style.cursor="default";
						}
					}
					
					document.querySelector(".blockaffichebandeannoncefermez").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('.blockaffichebandeannoncecontenu')).left=='19.5%')
						{
							document.querySelector(".blockaffichebandeannoncecontenu").style.left="100%";
							document.querySelector(".contenufilmblockaffichebandeannonce").style.cursor="pointer";
						}
						else
						{
							document.querySelector(".blockaffichebandeannoncecontenu").style.left="100%";
							document.querySelector(".contenufilmblockaffichebandeannonce").style.cursor="pointer";
						}
					}
					
					document.querySelector(".contenufilmnavvf").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('.contenufilmblockvf')).left=='100%')
						{
							document.querySelector(".contenufilmblockaffiche").style.left="100%";
							document.querySelector(".contenufilmblockvf").style.left="21%";
							document.querySelector(".contenufilmblockvostfr").style.left="100%";
							document.querySelector(".contenufilmblockcommentaires").style.left="100%";
							document.querySelector(".contenufilmnavaffiche span").style.color="white";
							document.querySelector(".contenufilmnavaffiche span").style.cursor="pointer";
							document.querySelector(".contenufilmnavvf span").style.color="rgb(2,2,2)";
							document.querySelector(".contenufilmnavvf span").style.cursor="default";
							document.querySelector(".contenufilmnavvostfr span").style.color="white";
							document.querySelector(".contenufilmnavvostfr span").style.cursor="pointer";
							document.querySelector(".contenufilmnavcommentaires span").style.color="white";
							document.querySelector(".contenufilmnavcommentaires span").style.cursor="pointer";
						}
						else
						{
							document.querySelector(".contenufilmblockaffiche").style.left="100%";
							document.querySelector(".contenufilmblockvf").style.left="21%";
							document.querySelector(".contenufilmblockvostfr").style.left="100%";
							document.querySelector(".contenufilmblockcommentaires").style.left="100%";
							document.querySelector(".contenufilmnavaffiche span").style.color="white";
							document.querySelector(".contenufilmnavaffiche span").style.cursor="pointer";
							document.querySelector(".contenufilmnavvf span").style.color="rgb(2,2,2)";
							document.querySelector(".contenufilmnavvf span").style.cursor="default";
							document.querySelector(".contenufilmnavvostfr span").style.color="white";
							document.querySelector(".contenufilmnavvostfr span").style.cursor="pointer";
							document.querySelector(".contenufilmnavcommentaires span").style.color="white";
							document.querySelector(".contenufilmnavcommentaires span").style.cursor="pointer";
						}
					}
					
					document.querySelector(".contenufilmnavvostfr").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('.contenufilmblockvostfr')).left=='100%')
						{
							document.querySelector(".contenufilmblockaffiche").style.left="100%";
							document.querySelector(".contenufilmblockvf").style.left="100%";
							document.querySelector(".contenufilmblockvostfr").style.left="21%";
							document.querySelector(".contenufilmblockcommentaires").style.left="100%";
							document.querySelector(".contenufilmnavaffiche span").style.color="white";
							document.querySelector(".contenufilmnavaffiche span").style.cursor="pointer";
							document.querySelector(".contenufilmnavvf span").style.color="white";
							document.querySelector(".contenufilmnavvf span").style.cursor="pointer";
							document.querySelector(".contenufilmnavvostfr span").style.color="rgb(2,2,2)";
							document.querySelector(".contenufilmnavvostfr span").style.cursor="default";
							document.querySelector(".contenufilmnavcommentaires span").style.color="white";
							document.querySelector(".contenufilmnavcommentaires span").style.cursor="pointer";
						}
						else
						{
							document.querySelector(".contenufilmblockaffiche").style.left="100%";
							document.querySelector(".contenufilmblockvf").style.left="100%";
							document.querySelector(".contenufilmblockvostfr").style.left="21%";
							document.querySelector(".contenufilmblockcommentaires").style.left="100%";
							document.querySelector(".contenufilmnavaffiche span").style.color="white";
							document.querySelector(".contenufilmnavaffiche span").style.cursor="pointer";
							document.querySelector(".contenufilmnavvf span").style.color="white";
							document.querySelector(".contenufilmnavvf span").style.cursor="pointer";
							document.querySelector(".contenufilmnavvostfr span").style.color="rgb(2,2,2)";
							document.querySelector(".contenufilmnavvostfr span").style.cursor="default";
							document.querySelector(".contenufilmnavcommentaires span").style.color="white";
							document.querySelector(".contenufilmnavcommentaires span").style.cursor="pointer";
						}
					}
					
					document.querySelector(".contenufilmnavcommentaires").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('.contenufilmblockcommentaires')).left=='100%')
						{
							document.querySelector(".contenufilmblockaffiche").style.left="100%";
							document.querySelector(".contenufilmblockvf").style.left="100%";
							document.querySelector(".contenufilmblockvostfr").style.left="100%";
							document.querySelector(".contenufilmblockcommentaires").style.left="21%";
							document.querySelector(".contenufilmnavaffiche span").style.color="white";
							document.querySelector(".contenufilmnavaffiche span").style.cursor="pointer";
							document.querySelector(".contenufilmnavvf span").style.color="white";
							document.querySelector(".contenufilmnavvf span").style.cursor="pointer";
							document.querySelector(".contenufilmnavvostfr span").style.color="white";
							document.querySelector(".contenufilmnavvostfr span").style.cursor="pointer";
							document.querySelector(".contenufilmnavcommentaires span").style.color="rgb(2,2,2)";
							document.querySelector(".contenufilmnavcommentaires span").style.cursor="default";
						}
						else
						{
							document.querySelector(".contenufilmblockaffiche").style.left="100%";
							document.querySelector(".contenufilmblockvf").style.left="100%";
							document.querySelector(".contenufilmblockvostfr").style.left="100%";
							document.querySelector(".contenufilmblockcommentaires").style.left="21%";
							document.querySelector(".contenufilmnavaffiche span").style.color="white";
							document.querySelector(".contenufilmnavaffiche span").style.cursor="pointer";
							document.querySelector(".contenufilmnavvf span").style.color="white";
							document.querySelector(".contenufilmnavvf span").style.cursor="pointer";
							document.querySelector(".contenufilmnavvostfr span").style.color="white";
							document.querySelector(".contenufilmnavvostfr span").style.cursor="pointer";
							document.querySelector(".contenufilmnavcommentaires span").style.color="rgb(2,2,2)";
							document.querySelector(".contenufilmnavcommentaires span").style.cursor="default";
						}
					}
				</script>
			</div>
			<?php
			}
			else
			{
			?>
				<hr class="hrfilm" />
				<h2 id="alphabet"><strong>
					<a id="lettre" href="#AB">#</a>
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
				<div id="contenufilm">
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
				$searchinfofilm = $db->query('SELECT * FROM films ORDER BY titre');
				
				while($infofilm = $searchinfofilm->fetch())
				{
				?>
					<a href="film.php?id=<?php echo $infofilm['ID']; ?>" style="text-decoration:none;">
					<div class="blockfilm" id="<?php echo $infofilm['lettre']; ?>">
					<?php
					$datefilm = date("Y-m-d", strtotime($infofilm['date_ajout']));
					$newcontenuimg = date('Y-m-d');
					
					if($datefilm >= $newcontenuimg)
					{
					?>
						<img src="images/new.png" alt="New" class="newcontenuimg" />
					<?php
					}
					?>
						<span><img src="film/<?php echo $infofilm['image']; ?>" alt="Affiche du film" title="<?php echo htmlspecialchars($infofilm['titre']); ?>" class="blockfilmimg" /></span>
					</div>
					</a>
				<?php
				}
				$searchinfofilm->closeCursor();
				?>
				</div>
				</div>
			<?php
			}
			?>
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
					
					xhr.open('GET', 'site/phpfilm.php?trierparalphabetique=ok');
					
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
					
					xhr.open('GET', 'site/phpfilm.php?trierparrecent=ok');
					
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
					
					xhr.open('GET', 'site/phpfilm.php?trierparmieuxnotes=ok');
					
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
				$("body").mCustomScrollbar("scrollTo",$(the_id).offset().top -110, { scrollInertia: 2000 }); return false;});
			</script>
		</div>
		<script id="cid0020000205644521856" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 251px;height: 426px;">{"handle":"metromanga1","arch":"js","styles":{"a":"cc0000","b":100,"c":"FFFFFF","d":"FFFFFF","k":"cc0000","l":"cc0000","m":"cc0000","n":"FFFFFF","p":"9.36","q":"cc0000","r":100,"pos":"br","cv":1,"cvbg":"CC0000","cvw":251,"cvh":30,"cnrs":"0.26","ticker":1,"fwtickm":1}}</script>
		<?php include("includes/footer.php"); ?>
	</div>
	</body>
</html>