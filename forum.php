<?php session_start(); ?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<link rel="stylesheet" href="forum.css" />
		<script src="//cdn.ckeditor.com/4.5.2/full/ckeditor.js"></script>
		<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script>
			(function($)
			{
				$(window).on("load",function(){
					$("#body2").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".blockligne").mCustomScrollbar({
						theme:"inset-1"
					});
					$("#arcticlesujetsblocksujet").mCustomScrollbar({
						theme:"inset-1"
					});
					$("#arcticlesujetsblockcommentaires").mCustomScrollbar({
						theme:"inset-1"
					});
				});
			})(jQuery);		
		</script>
		<link href='css/Racing.css' rel='stylesheet' type='text/css'>
		<link href='css/Cookie.css' rel='stylesheet' type='text/css'>
		<link href='css/Raleway.css' rel='stylesheet' type='text/css'>
		<title>Forum - Metro Manga</title>
	</head>
	
	<body id="body">
	<div id="body2">
		<?php include("includes/loading.php"); ?>
		<?php include("includes/header.php"); ?>
		<div id="contenuloading">
			<?php
			if(isset($_GET['id']))
			{
			$searchsujetid = $db->query('SELECT ID FROM forumsujets WHERE ID =\'' . $_GET['id'] . '\'');
			$searchsujetidexist = $searchsujetid->rowCount();
			if($searchsujetidexist == 0)
			{
			?>
				<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
				<script>
					window.setTimeout("location=('forum.php');",0);
				</script>
			<?php
			}
			else
			{
				$searchinfosujet = $db->query('SELECT * FROM forumsujets WHERE ID =\'' . $_GET['id'] . '\'');
				$infosujet = $searchinfosujet->fetch();
				
				$infosujettitre = html_entity_decode($infosujet['titre']);
									
				if(mb_strlen($infosujettitre, 'utf8') <= 15)
				{
					$arrayinfosujet[0] = $infosujettitre;
				}
				else
				{
					$sujettitre = mb_substr($infosujettitre, 0, 12, 'utf8');
					
					$arrayinfosujet[0] = $sujettitre . "..."; 
				}
				
				$searchpseudosujet = $db->query('SELECT pseudo FROM membres WHERE ID =\'' . $infosujet['IDmembres'] . '\'');
				$pseudosujet = $searchpseudosujet->fetch();
				
				$infotitremembre = html_entity_decode($pseudosujet['pseudo']);
									
				if(mb_strlen($infotitremembre, 'utf8') <= 20)
				{
					$arrayinfotitremembre[0] = $infotitremembre;
				}
				else
				{
					$sujettitrepseudo = mb_substr($infotitremembre, 0, 17, 'utf8');
					
					$arrayinfotitremembre[0] = $sujettitrepseudo . "..."; 
				}
			?>
				<div id="forumarcticlesujets">
					<div id="arcticlesujetsmenu">
						<div style="background: url(<?php echo htmlspecialchars($infosujet['image']); ?>)no-repeat;background-size: cover;" class="arcticlesujetsmenuimage">
						</div>
						<?php
							if(mb_strlen($infosujettitre, 'utf8') <= 15)
							{
							?>
								<p id="arcticlesujetsmenutitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet[0]); ?></p>
							<?php
							}
							else
							{
							?>
								<p id="arcticlesujetsmenutitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre); ?>"><?php echo htmlspecialchars($arrayinfosujet[0]); ?></p>
							<?php	
							}
						?>
						<span id="arcticlesujetsmenuspantitre"></span>
						<div class="arcticlesujetsmenuespace"></div>
						<?php
							if(mb_strlen($infotitremembre, 'utf8') <= 20)
							{
							?>
								<a href="profil.php?id=<?php echo $infosujet['IDmembres'] ?>"  style="text-decoration:none;"><p class="arcticlesujetsmenupseudo"><?php echo htmlspecialchars($arrayinfotitremembre[0]); ?></p></a>
							<?php
							}
							else
							{
							?>
								<a href="profil.php?id=<?php echo $infosujet['IDmembres'] ?>"  style="text-decoration:none;"><p class="arcticlesujetsmenupseudo" title="<?php echo htmlspecialchars($infotitremembre); ?>"><?php echo htmlspecialchars($arrayinfotitremembre[0]); ?></p></a>
							<?php	
							}
						?>
						<p id="arcticlesujetsmenucommentaires">Commentaires</p>
						<span id="arcticlesujetsmenuspancommentaires"></span>
						<style>
							@media screen and (min-width: 1200px)
							{
								#arcticlesujetsmenutitre:hover
								{
									border-right: 7px solid <?php echo $infosujet['couleur']; ?>;
								}
								
								#arcticlesujetsmenuspantitre
								{
									background: <?php echo $infosujet['couleur']; ?>;
								}
								
								.arcticlesujetsmenupseudo:hover
								{
									border-right: 7px solid <?php echo $infosujet['couleur']; ?>;
									cursor: pointer;
								}
								
								#arcticlesujetsmenucommentaires:hover
								{
									border-right: 7px solid <?php echo $infosujet['couleur']; ?>;
									cursor: pointer;
								}
								
								#arcticlesujetsmenuspancommentaires
								{
									background: <?php echo $infosujet['couleur']; ?>;
								}
								
								#arcticlesujetsblocksujet
								{
									border-left: 20px solid <?php echo $infosujet['couleur']; ?>;
								}
								
								#arcticlesujetsblockcommentaires
								{
									border-left: 20px solid <?php echo $infosujet['couleur']; ?>;
								}
							}
						</style>
						<span class="blocknoteretoile">
						<?php
							$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesforum WHERE IDsujet =\'' . $_GET['id'] . '\'');
							$notemoy = $searchmoynote->fetch();	
							if($notemoy['notemoy'] == 0)
							{
							?>
								<span class="arcticlesujetsmenuetoile" style="color:black;">★★★★★</span>
							<?php
							}
							else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
							{
							?>
								<span class="arcticlesujetsmenuetoile">★<span style="color:black;">★★★★</span></span>
							<?php
							}
							else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
							{
							?>
								<span class="arcticlesujetsmenuetoile">★★<span style="color:black;">★★★</span></span>
							<?php
							}
							else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
							{
							?>
								<span class="arcticlesujetsmenuetoile">★★★<span style="color:black;">★★</span></span>
							<?php
							}
							else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
							{
							?>
								<span class="arcticlesujetsmenuetoile">★★★★<span style="color:black;">★</span></span>
							<?php
							}
							else if($notemoy['notemoy'] >= 5)
							{
							?>
								<span class="arcticlesujetsmenuetoile">★★★★★</span>
							<?php
							}
							
							if(isset($_SESSION['ID']))
							{
								$searchnote = $db->prepare('SELECT * FROM notesforum WHERE IDsujet = ? AND IDmembre = ?');
								$searchnote->execute(array($_GET['id'],$_SESSION['ID']));
								$noteexist = $searchnote->rowCount();
								if($noteexist == 0)
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
											
											xhr.open('GET', 'site/phpforum.php?blocknoteretoile1=ok&IDsujet=<?php echo $_GET['id']; ?>');
											
											xhr.onreadystatechange = function() 
											{
												if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.querySelector('.blocknoteretoile').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
										
										document.getElementById('blocknoteretoile2').onclick = function()
										{
											var xhr = new XMLHttpRequest();
											
											xhr.open('GET', 'site/phpforum.php?blocknoteretoile2=ok&IDsujet=<?php echo $_GET['id']; ?>');
											
											xhr.onreadystatechange = function() 
											{
												if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.querySelector('.blocknoteretoile').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
										
										document.getElementById('blocknoteretoile3').onclick = function()
										{
											var xhr = new XMLHttpRequest();
											
											xhr.open('GET', 'site/phpforum.php?blocknoteretoile3=ok&IDsujet=<?php echo $_GET['id']; ?>');
											
											xhr.onreadystatechange = function() 
											{
												if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.querySelector('.blocknoteretoile').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
										
										document.getElementById('blocknoteretoile4').onclick = function()
										{
											var xhr = new XMLHttpRequest();
											
											xhr.open('GET', 'site/phpforum.php?blocknoteretoile4=ok&IDsujet=<?php echo $_GET['id']; ?>');
											
											xhr.onreadystatechange = function() 
											{
												if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.querySelector('.blocknoteretoile').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
										
										document.getElementById('blocknoteretoile5').onclick = function()
										{
											var xhr = new XMLHttpRequest();
											
											xhr.open('GET', 'site/phpforum.php?blocknoteretoile5=ok&IDsujet=<?php echo $_GET['id']; ?>');
											
											xhr.onreadystatechange = function() 
											{
												if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
												{
													document.querySelector('.blocknoteretoile').innerHTML = xhr.responseText;
												}
											};
											
											xhr.send(null);
										}
							
									</script>
								<?php
								}
							}
						?>
						</span>
						<p class="arcticlesujetsmenudate"><?php echo date("d/m/Y", strtotime($infosujet['date_creation'])); ?></p>
					</div>
					
					<div id="arcticlesujetsblocksujet">
					<span id="signalersujetajax">
						<?php
						$searchsignalesujet = $db->prepare('SELECT * FROM signalesujet WHERE IDsujet = ?');
						$searchsignalesujet->execute(array($_GET['id']));
						$signalesujetexist = $searchsignalesujet->rowCount();
						if($signalesujetexist == 0)
						{
						?>
							<span id="signalersujet"><img src="images/signaler.png" alt="Signaler" class="infosujetssignaler"/></span>
						
							<script>
							
								document.getElementById('signalersujet').onclick = function()
								{
									var xhr = new XMLHttpRequest();
									
									xhr.open('GET', 'site/phpforum.php?signalersujet=ok&IDsujet=<?php echo $_GET['id']; ?>');
									
									xhr.onreadystatechange = function() 
									{
										if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
										{
											document.querySelector('#signalersujetajax').innerHTML = xhr.responseText;
										}
									};
									
									xhr.send(null);
								}
								
							</script>
						<?php
						}
						else
						{
							if(isset($_SESSION['ID']))
							{
								if($_SESSION['ID'] == '1')
								{
								?>
									<span onclick="supprimersujet()"><img src="images/fermer.png" alt="Supprimer" class="infosujetssupprimer" /></span>
								<?php
								}
							}
						?>
							<span><img src="images/signalerrouge.png" alt="Signaler" class="infosujetssignaler" style="cursor:default;"/></span>
						<?php
						}
						?>
					</span>
					
					<script>
					
						function supprimersujet()
						{
							var xhr = new XMLHttpRequest();
							
							xhr.open('GET', 'site/phpforum.php?supprimersujet=ok&IDsujet=<?php echo $_GET['id']; ?>');
							
							xhr.onreadystatechange = function() 
							{
								if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
								{
									window.setTimeout("location=('forum.php');",0);
								}
							};
							
							xhr.send(null);
						}
						
					</script>
					
						<div class="contenublocksujet"><?php echo html_entity_decode($infosujet['contenu']); ?></div>
					</div>
					
					<div id="arcticlesujetsblockcommentaires">
					<span id="commentaireajax">
						<div class="blockcommenter">
						<?php
						if(isset($_SESSION['ID']))
						{
							$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesforum WHERE IDsujet =\'' . $_GET['id'] . '\'');
							$nbdecommentaires = $searchnbdecommentaires->fetch();
						?>
							<span><img src="membre/avatar/<?php echo $_SESSION['avatar']; ?>" alt="Avatar" class="blockcommenteravatar" /></span>
								<textarea id="blockcommentertextarea" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
								<fieldset class="blockcommenterajouterbarre">
									<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaire()" style="outline:none;" /></legend>
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
						<?php				
							$searchinfocommentaire = $db->query('SELECT * FROM commentairesforum WHERE IDsujet =\'' . $_GET['id'] . '\' ORDER BY ID DESC LIMIT 0, 100');
							
							while ($infocommentaire = $searchinfocommentaire->fetch())
							{
							$searchinfocommentairemembre = $db->query('SELECT * FROM membres WHERE ID =\'' . $infocommentaire['IDmembre'] . '\'');
							$infocommentairemembre = $searchinfocommentairemembre->fetch();
						?>
							<div class="infocommentaire">
							<?php
							$searchsignale = $db->prepare('SELECT * FROM signalecommentaire WHERE IDcommentaire = ?  AND lien = ?');
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
					$searchinfocommentairejs = $db->query('SELECT * FROM commentairesforum WHERE IDsujet =\'' . $_GET['id'] . '\' ORDER BY ID DESC LIMIT 0, 100');
					while ($infocommentairejs = $searchinfocommentairejs->fetch())
					{
					?>							
							function signalecommentaire<?php echo $infocommentairejs['ID']; ?>()
							{
								var xhr = new XMLHttpRequest();
								
								xhr.open('GET', 'site/phpforum.php?signalecommentaire=ok&IDsujet=<?php echo $_GET['id']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>');
								
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
								
								xhr.open('GET', 'site/phpforum.php?supprimercommentaire=ok&IDsujet=<?php echo $_GET['id']; ?>&IDcommentaire=<?php echo $infocommentairejs['ID']; ?>&LIENcommentaire=<?php echo $infocommentairejs['lien']; ?>');
								
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
						
						xhr.open('GET', 'site/phpforum.php?ajoutercommentaire=' + valuecommentaire + '&IDsujet=<?php echo $_GET['id']; ?>');
						
						xhr.onreadystatechange = function() 
						{
							if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
							{
								document.querySelector('#commentaireajax').innerHTML = xhr.responseText;
							}
						};
						
						xhr.send(null);
					}
				
					document.querySelector("#arcticlesujetsmenutitre").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#arcticlesujetsblocksujet')).right=='-100%')
						{
							document.querySelector('#arcticlesujetsblocksujet').style.right="0%";
							document.querySelector('#arcticlesujetsmenutitre').style.cursor="default";
							document.querySelector('#arcticlesujetsmenutitre').style.background="rgb(25,25,25)";
							document.querySelector('#arcticlesujetsmenuspantitre').style.display="block";
							document.querySelector('#arcticlesujetsblockcommentaires').style.right="-100%";
							document.querySelector('#arcticlesujetsmenucommentaires').style.cursor="pointer";
							document.querySelector('#arcticlesujetsmenucommentaires').style.background="rgb(10,10,10)";
							document.querySelector('#arcticlesujetsmenuspancommentaires').style.display="none";
						}
						else
						{
							document.querySelector('#arcticlesujetsblocksujet').style.right="0%";
							document.querySelector('#arcticlesujetsmenutitre').style.cursor="default";
							document.querySelector('#arcticlesujetsmenutitre').style.background="rgb(25,25,25)";
							document.querySelector('#arcticlesujetsmenuspantitre').style.display="block";
							document.querySelector('#arcticlesujetsblockcommentaires').style.right="-100%";
							document.querySelector('#arcticlesujetsmenucommentaires').style.cursor="pointer";
							document.querySelector('#arcticlesujetsmenucommentaires').style.background="rgb(10,10,10)";
							document.querySelector('#arcticlesujetsmenuspancommentaires').style.display="none";
						}
					}
					
					document.querySelector("#arcticlesujetsmenucommentaires").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#arcticlesujetsblockcommentaires')).right=='-100%')
						{
							document.querySelector('#arcticlesujetsblocksujet').style.right="-100%";
							document.querySelector('#arcticlesujetsmenutitre').style.cursor="pointer";
							document.querySelector('#arcticlesujetsmenutitre').style.background="rgb(10,10,10)";
							document.querySelector('#arcticlesujetsmenuspantitre').style.display="none";
							document.querySelector('#arcticlesujetsblockcommentaires').style.right="0%";
							document.querySelector('#arcticlesujetsmenucommentaires').style.cursor="default";
							document.querySelector('#arcticlesujetsmenucommentaires').style.background="rgb(25,25,25)";
							document.querySelector('#arcticlesujetsmenuspancommentaires').style.display="block";
						}
						else
						{
							document.querySelector('#arcticlesujetsblocksujet').style.right="-100%";
							document.querySelector('#arcticlesujetsmenutitre').style.cursor="pointer";
							document.querySelector('#arcticlesujetsmenutitre').style.background="rgb(10,10,10)";
							document.querySelector('#arcticlesujetsmenuspantitre').style.display="none";
							document.querySelector('#arcticlesujetsblockcommentaires').style.right="0%";
							document.querySelector('#arcticlesujetsmenucommentaires').style.cursor="default";
							document.querySelector('#arcticlesujetsmenucommentaires').style.background="rgb(25,25,25)";
							document.querySelector('#arcticlesujetsmenuspancommentaires').style.display="block";
						}
					}
				</script>
			<?php
			}
			}
			else if(isset($_GET['update']))
			{
				$searchsujetid = $db->query('SELECT ID FROM forumsujets WHERE ID =\'' . $_GET['update'] . '\' AND IDmembres=\'' . $_SESSION['ID'] . '\'');
				$searchsujetidexist = $searchsujetid->rowCount();
				if($searchsujetidexist == 0 OR !isset($_SESSION['ID']))
				{
				?>
					<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
					<script>
						window.setTimeout("location=('forum.php');",0);
					</script>
				<?php
				}
				else
				{
				if(isset($_SESSION['ID']))
				{
					$selectinfoforumsujets = $db->query('SELECT * FROM forumsujets WHERE ID=\'' . $_GET['update'] . '\' AND IDmembres=\'' . $_SESSION['ID'] . '\'');
					$infoforumsujets = $selectinfoforumsujets->fetch();
				?>
					<div id="modifiersujet">
					<a href="profil.php"><img id="fermerajoutersujet" src="images/fermer.png" alt="Annuler" /></a>
						<div class="blockajoutersujet">
								<div class="contenuajoutersujet">
									<span class="titreajoutersujet2">Modification d'un sujet</span>
									<hr class="hrajoutersujet2" />
								</div>
									<label class="themeajoutersujet" for="themeajoutersujet">Thème</label>
									<?php
										if($_SESSION['ID'] == '1')
										{
										?>
											<select class="selectthemeajoutersujet" required>
											<?php
												if($infoforumsujets['theme'] == 'reglement')
												{
												?>
													<option value="reglement" selected >Règlement du Forum</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'newsmetromanga')
												{
												?>
													<option value="newsmetromanga" selected >Nouveautés sur Metro Manga</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'evenements')
												{
												?>
													<option value="evenements" selected >Évènements</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'bugs')
												{
												?>
													<option value="bugs" selected >Problèmes, Bugs et Suggestions</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'animes')
												{
												?>
													<option value="animes" selected >Animes</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'mangas')
												{
												?>
													<option value="mangas" selected >Mangas</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'scans')
												{
												?>
													<option value="scans" selected >Scans</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'japanimation')
												{
												?>
													<option value="japanimation" selected >Japanimation</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'queregarder')
												{
												?>
													<option value="queregarder" selected >Que regarder, que lire ?</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'actualite')
												{
												?>
													<option value="actualite" selected >Actualités</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'audiovisuel')
												{
												?>
													<option value="audiovisuel" selected >Audiovisuel</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'jeuxvideo')
												{
												?>
													<option value="jeuxvideo" selected >Jeux vidéo</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'musique')
												{
												?>
													<option value="musique" selected >Musiques</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'informatique')
												{
												?>
													<option value="informatique" selected >Informatique</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'japon')
												{
												?>
													<option value="japon" selected >Japon</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'rien')
												{
												?>
													<option value="rien" selected >Tout sur rien</option>
												<?php
												}
											?>
												<optgroup label="Metro Manga">
													<option value="reglement">Règlement du Forum</option>
													<option value="newsmetromanga">Nouveautés sur Metro Manga</option>
													<option value="evenements">Évènements</option>
													<option value="bugs">Problèmes, Bugs et Suggestions</option>
												</optgroup>
												<optgroup label="Animes & Mangas">
													<option value="animes">Animes</option>
													<option value="mangas">Mangas</option>
													<option value="scans">Scans</option>
													<option value="japanimation">Japanimation</option>
													<option value="queregarder">Que regarder, que lire ?</option>
												</optgroup>
												<optgroup label="Salon">
													<option value="actualite">Actualités</option>
													<option value="audiovisuel">Audiovisuel</option>
													<option value="jeuxvideo">Jeux vidéo</option>
													<option value="musique">Musiques</option>
													<option value="informatique">Informatique</option>
													<option value="japon">Japon</option>
													<option value="rien">Tout sur rien</option>
												</optgroup>
											</select>
										<?php
										}
										else
										{
										?>
											<select class="selectthemeajoutersujet" required>
											<?php
												if($infoforumsujets['theme'] == 'animes')
												{
												?>
													<option value="animes" selected >Animes</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'mangas')
												{
												?>
													<option value="mangas" selected >Mangas</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'scans')
												{
												?>
													<option value="scans" selected >Scans</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'japanimation')
												{
												?>
													<option value="japanimation" selected >Japanimation</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'queregarder')
												{
												?>
													<option value="queregarder" selected >Que regarder, que lire ?</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'actualite')
												{
												?>
													<option value="actualite" selected >Actualités</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'audiovisuel')
												{
												?>
													<option value="audiovisuel" selected >Audiovisuel</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'jeuxvideo')
												{
												?>
													<option value="jeuxvideo" selected >Jeux vidéo</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'musique')
												{
												?>
													<option value="musique" selected >Musiques</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'informatique')
												{
												?>
													<option value="informatique" selected >Informatique</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'japon')
												{
												?>
													<option value="japon" selected >Japon</option>
												<?php
												}
												else if($infoforumsujets['theme'] == 'rien')
												{
												?>
													<option value="rien" selected >Tout sur rien</option>
												<?php
												}
											?>
												<optgroup label="Animes & Mangas">
													<option value="animes">Animes</option>
													<option value="mangas">Mangas</option>
													<option value="scans">Scans</option>
													<option value="japanimation">Japanimation</option>
													<option value="queregarder">Que regarder, que lire ?</option>
												</optgroup>
												<optgroup label="Salon">
													<option value="actualite">Actualités</option>
													<option value="audiovisuel">Audiovisuel</option>
													<option value="jeuxvideo">Jeux vidéo</option>
													<option value="musique">Musiques</option>
													<option value="informatique">Informatique</option>
													<option value="japon">Japon</option>
													<option value="rien">Tout sur rien</option>
												</optgroup>
											</select>
										<?php
										}
									?>
									<label class="titresujetajoutersujet" for="titresujetajoutersujet">Titre</label><input type="text" autocomplete="off" class="contenutitreajoutersujet" placeholder="Metro Manga" value="<?php echo $infoforumsujets['titre']; ?>" style="text-transform:capitalize;" maxlength="100" minlength="1" required />
									
									<div id="errorajoutersujet">
									<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									</div>
									
									<br />
									<div class="contenusujetajoutersujet">
										<textarea class="contenuajoutersujettextarea" name="contenuajoutersujettextarea">
										<?php echo $infoforumsujets['contenu']; ?>
										</textarea>
										<script>
											CKEDITOR.replace( 'contenuajoutersujettextarea' );
										</script>
									</div>
									<p class="cubeajoutersujet">Cette partie est facultative elle est dédiée à la personnalisation de votre sujet.</p>
									<label class="titreimageajoutersujet" for="titreimageajoutersujet">Image</label><input type="url" autocomplete="off" class="contenuimageajoutersujet" placeholder="https://metromanga.com/images/1647x468/1647x468metromange.png" value="<?php echo $infoforumsujets['image']; ?>" />
									<label class="titrecolorajoutersujet" for="titrecolorajoutersujet">Couleur</label><input type="color" class="contenucolorajoutersujet" value="<?php echo $infoforumsujets['couleur']; ?>" /><br />
									<a href="#body" ><input type="submit" value="Valider" id="monBouton" class="validerajoutersujet" style="outline:none;" onclick="CKupdate();validermodifiersujet();" /></a>
								
								<script>
									
									$('a[href^="#"]').click(function(){
									var the_id = $(this).attr("href");
									$("#body2").mCustomScrollbar("scrollTo",$(the_id).offset().top -0, { scrollInertia: 1000 }); return false;});
									
									function CKupdate()
									{
										for ( instance in CKEDITOR.instances )
											CKEDITOR.instances[instance].updateElement();
									}
									
									function validermodifiersujet()
									{
										var xhr = new XMLHttpRequest();
										var valuetheme = document.querySelector('.selectthemeajoutersujet').value;
										var valuetitre = document.querySelector('.contenutitreajoutersujet').value;
										var valuesujet = document.querySelector('.contenuajoutersujettextarea').value;
										var valueimage = document.querySelector('.contenuimageajoutersujet').value;
										var valuecouleur = document.querySelector('.contenucolorajoutersujet').value;
										
										var valuetheme = encodeURIComponent(valuetheme);
										var valuetitre = encodeURIComponent(valuetitre);
										var valuesujet = encodeURIComponent(valuesujet);
										var valueimage = encodeURIComponent(valueimage);
										var valuecouleur = encodeURIComponent(valuecouleur);
										
										xhr.open('POST', 'site/phpforum.php');
										xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
										xhr.send('modifiersujet=' + valuetheme + '&titre=' + valuetitre + '&sujet=' + valuesujet + '&image=' + valueimage + '&couleur=' + valuecouleur 	+ '&idsujet=<?php echo $infoforumsujets['ID']; ?>');
										
										xhr.onreadystatechange = function() 
										{
											if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
											{
												document.querySelector('#errorajoutersujet').innerHTML = xhr.responseText;
												confirmvalidermodifiersujet();
											}
										};
										
										xhr.send(null);
									}
									
									function confirmvalidermodifiersujet()
									{
										if(document.querySelector('#confirmvaliderajoutersujet').innerHTML == "OK")
										{
											window.setTimeout("location=('forum.php?id=<?php echo $infoforumsujets['ID']; ?>');",0);
										}
									}
									
								</script>
						</div>
					</div>
				<?php
				}
				}
			}
			else
			{
			?>
				<section id="contenu">
				
					<div id="selectedformatligne"><hr class="selectedformat1ligne"/><hr class="selectedformat2ligne"/><hr class="selectedformat3ligne"/></div>
					<div id="selectedformatcube">
						<span class="cube" style="transition: all 0.25s;">*</span><span class="cube" style="transition: all 0.45s;">*</span><span class="cube" style="transition: all 0.55s;">*</span><hr class="separationcube" />
						<span class="cube" style="transition: all 0.45s;">*</span><span class="cube" style="transition: all 0.55s;">*</span><span class="cube" style="transition: all 0.65s;">*</span>
					</div>
				
			<div id="formatcube">
				<hr class="hrforum"/>
				<div id="selecteformatcube">
					<div class="menuselected">
						<span id="selectedanimemanga">Animes & Mangas</span>
						<span id="selectedmetromanga">Metro Manga</span>
						<span id="selectedsalon">Salon</span>
					</div>
					<div class="formatcubeforum">
						<div id="formatcubeanimemanga">
							<div id="cubeanimes">
							<?php
							$searchnbdesujetsanimes = $db->query('SELECT COUNT(*) AS nbdesujetsanimes FROM forumsujets WHERE theme =\'animes\'');
							$nbdesujetsanimes = $searchnbdesujetsanimes->fetch();
							
							$searchnbdecommentairesanimes = $db->query('SELECT COUNT(*) AS nbdecommentairesanimes FROM commentairesforum WHERE theme =\'animes\'');
							$nbdecommentairesanimes = $searchnbdecommentairesanimes->fetch();
							?>
								<span><img class="cubeanimesimage" src="images/animes.png" alt="" /></span>
								<span class="cubeanimestitre">Animes</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsanimes['nbdesujetsanimes']; ?></span>
							</div>
							<div id="cubemangas">
							<?php
							$searchnbdesujetsmangas = $db->query('SELECT COUNT(*) AS nbdesujetsmangas FROM forumsujets WHERE theme =\'mangas\'');
							$nbdesujetsmangas = $searchnbdesujetsmangas->fetch();
							
							$searchnbdecommentairesmangas = $db->query('SELECT COUNT(*) AS nbdecommentairesmangas FROM commentairesforum WHERE theme =\'mangas\'');
							$nbdecommentairesmangas = $searchnbdecommentairesmangas->fetch();
							?>
								<span><img class="cubemangasimage" src="images/mangas.png" alt="" /></span>
								<span class="cubemangastitre">Mangas</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsmangas['nbdesujetsmangas']; ?></span>
							</div>
							<div id="cubescans">
							<?php
							$searchnbdesujetsscans = $db->query('SELECT COUNT(*) AS nbdesujetsscans FROM forumsujets WHERE theme =\'scans\'');
							$nbdesujetsscans = $searchnbdesujetsscans->fetch();
							
							$searchnbdecommentairesscans = $db->query('SELECT COUNT(*) AS nbdecommentairesscans FROM commentairesforum WHERE theme =\'scans\'');
							$nbdecommentairesscans = $searchnbdecommentairesscans->fetch();
							?>
								<span><img class="cubescansimage" src="images/scans.png" alt="" /></span>
								<span class="cubescanstitre">Scans</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsscans['nbdesujetsscans']; ?></span>
							</div>
							<div id="cubejapanimation">
							<?php
							$searchnbdesujetsjapanimation = $db->query('SELECT COUNT(*) AS nbdesujetsjapanimation FROM forumsujets WHERE theme =\'japanimation\'');
							$nbdesujetsjapanimation = $searchnbdesujetsjapanimation->fetch();
							
							$searchnbdecommentairesjapanimation = $db->query('SELECT COUNT(*) AS nbdecommentairesjapanimation FROM commentairesforum WHERE theme =\'japanimation\'');
							$nbdecommentairesjapanimation = $searchnbdecommentairesjapanimation->fetch();
							?>
								<span><img class="cubejapanimationimage" src="images/japanimation.png" alt="" /></span>
								<span class="cubejapanimationtitre">Japanimation</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsjapanimation['nbdesujetsjapanimation']; ?></span>
							</div>
							<div id="cubequeregarder">
							<?php
							$searchnbdesujetsqueregarder = $db->query('SELECT COUNT(*) AS nbdesujetsqueregarder FROM forumsujets WHERE theme =\'queregarder\'');
							$nbdesujetsqueregarder = $searchnbdesujetsqueregarder->fetch();
							
							$searchnbdecommentairesqueregarder = $db->query('SELECT COUNT(*) AS nbdecommentairesqueregarder FROM commentairesforum WHERE theme =\'queregarder\'');
							$nbdecommentairesqueregarder = $searchnbdecommentairesqueregarder->fetch();
							?>
								<span><img class="cubequeregarderimage" src="images/queregarder.png" alt="" /></span>
								<span class="cubetitregrand">Que regarder, que lire ?</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsqueregarder['nbdesujetsqueregarder']; ?></span>
							</div>
						</div>
						<div id="formatcubemetromanga">
							<div id="cubereglement">
							<?php
							$searchnbdesujetsreglement = $db->query('SELECT COUNT(*) AS nbdesujetsreglement FROM forumsujets WHERE theme =\'reglement\'');
							$nbdesujetsreglement = $searchnbdesujetsreglement->fetch();
							
							$searchnbdecommentairesreglement = $db->query('SELECT COUNT(*) AS nbdecommentairesreglement FROM commentairesforum WHERE theme =\'reglement\'');
							$nbdecommentairesreglement = $searchnbdecommentairesreglement->fetch();
							?>
								<span><img class="cubereglementimage" src="images/reglement.png" alt="" /></span>
								<span class="cubetitregrand">Règlement du Forum</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsreglement['nbdesujetsreglement']; ?></span>
							</div>
							<div id="cubenewsmetromanga">
							<?php
							$searchnbdesujetsnews = $db->query('SELECT COUNT(*) AS nbdesujetsnews FROM forumsujets WHERE theme =\'newsmetromanga\'');
							$nbdesujetsnews = $searchnbdesujetsnews->fetch();
							
							$searchnbdecommentairesnews = $db->query('SELECT COUNT(*) AS nbdecommentairesnews FROM commentairesforum WHERE theme =\'newsmetromanga\'');
							$nbdecommentairesnews = $searchnbdecommentairesnews->fetch();
							?>
								<span><img class="cubenewsmetromangaimage" src="images/news.png" alt="" /></span>
								<span class="cubenewsmetromangatitre">Nouveautés sur Metro Manga</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsnews['nbdesujetsnews']; ?></span>
							</div>
							<div id="cubeevenements">
							<?php
							$searchnbdesujetsevenements = $db->query('SELECT COUNT(*) AS nbdesujetsevenements FROM forumsujets WHERE theme =\'evenements\'');
							$nbdesujetsevenements = $searchnbdesujetsevenements->fetch();
							
							$searchnbdecommentairesevenements = $db->query('SELECT COUNT(*) AS nbdecommentairesevenements FROM commentairesforum WHERE theme =\'evenements\'');
							$nbdecommentairesevenements = $searchnbdecommentairesevenements->fetch();
							?>
								<span><img class="cubeevenementsimage" src="images/evenements.png" alt="" /></span>
								<span class="cubeevenementstitre">Évènements</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsevenements['nbdesujetsevenements']; ?></span>
							</div>
							<div id="cubebugs">
							<?php
							$searchnbdesujetsbugs = $db->query('SELECT COUNT(*) AS nbdesujetsbugs FROM forumsujets WHERE theme =\'bugs\'');
							$nbdesujetsbugs = $searchnbdesujetsbugs->fetch();
							
							$searchnbdecommentairesbugs = $db->query('SELECT COUNT(*) AS nbdecommentairesbugs FROM commentairesforum WHERE theme =\'bugs\'');
							$nbdecommentairesbugs = $searchnbdecommentairesbugs->fetch();
							?>
								<span><img class="cubebugsimage" src="images/bugs.png" alt="" /></span>
								<span class="cubetitregrand">Problèmes, Bugs et Suggestions</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsbugs['nbdesujetsbugs']; ?></span>
							</div>
						</div>
						<div id="formatcubesalon">
							<div id="cubeactualite">
							<?php
							$searchnbdesujetsactualite = $db->query('SELECT COUNT(*) AS nbdesujetsactualite FROM forumsujets WHERE theme =\'actualite\'');
							$nbdesujetsactualite = $searchnbdesujetsactualite->fetch();
							
							$searchnbdecommentairesactualite = $db->query('SELECT COUNT(*) AS nbdecommentairesactualite FROM commentairesforum WHERE theme =\'actualite\'');
							$nbdecommentairesactualite = $searchnbdecommentairesactualite->fetch();
							?>
								<span><img class="cubeactualiteimage" src="images/actualite.png" alt="" /></span>
								<span class="cubeactualitetitre">Actualités</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsactualite['nbdesujetsactualite']; ?></span>
							</div>
							<div id="cubeaudiovisuel">
							<?php
							$searchnbdesujetsaudiovisuel = $db->query('SELECT COUNT(*) AS nbdesujetsaudiovisuel FROM forumsujets WHERE theme =\'audiovisuel\'');
							$nbdesujetsaudiovisuel = $searchnbdesujetsaudiovisuel->fetch();
							
							$searchnbdecommentairesaudiovisuel = $db->query('SELECT COUNT(*) AS nbdecommentairesaudiovisuel FROM commentairesforum WHERE theme =\'audiovisuel\'');
							$nbdecommentairesaudiovisuel = $searchnbdecommentairesaudiovisuel->fetch();
							?>
								<span><img class="cubeaudiovisuelimage" src="images/audiovisuel.png" alt="" /></span>
								<span class="cubeaudiovisueltitre">Audiovisuel</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsaudiovisuel['nbdesujetsaudiovisuel']; ?></span>
							</div>
							<div id="cubejeuxvideo">
							<?php
							$searchnbdesujetsjeuxvideo = $db->query('SELECT COUNT(*) AS nbdesujetsjeuxvideo FROM forumsujets WHERE theme =\'jeuxvideo\'');
							$nbdesujetsjeuxvideo = $searchnbdesujetsjeuxvideo->fetch();
							
							$searchnbdecommentairesjeuxvideo = $db->query('SELECT COUNT(*) AS nbdecommentairesjeuxvideo FROM commentairesforum WHERE theme =\'jeuxvideo\'');
							$nbdecommentairesjeuxvideo = $searchnbdecommentairesjeuxvideo->fetch();
							?>
								<span><img class="cubejeuxvideoimage" src="images/jeuxvideo.png" alt="" /></span>
								<span class="cubejeuxvideotitre">Jeux vidéo</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsjeuxvideo['nbdesujetsjeuxvideo']; ?></span>
							</div>
							<div id="cubemusique">
							<?php
							$searchnbdesujetsmusique = $db->query('SELECT COUNT(*) AS nbdesujetsmusique FROM forumsujets WHERE theme =\'musique\'');
							$nbdesujetsmusique = $searchnbdesujetsmusique->fetch();
							
							$searchnbdecommentairesmusique = $db->query('SELECT COUNT(*) AS nbdecommentairesmusique FROM commentairesforum WHERE theme =\'musique\'');
							$nbdecommentairesmusique = $searchnbdecommentairesmusique->fetch();
							?>
								<span><img class="cubemusiqueimage" src="images/musique.png" alt="" /></span>
								<span class="cubemusiquetitre">Musiques</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsmusique['nbdesujetsmusique']; ?></span>
							</div>
							<div id="cubeinformatique">
							<?php
							$searchnbdesujetsinformatique = $db->query('SELECT COUNT(*) AS nbdesujetsinformatique FROM forumsujets WHERE theme =\'informatique\'');
							$nbdesujetsinformatique = $searchnbdesujetsinformatique->fetch();
							
							$searchnbdecommentairesinformatique = $db->query('SELECT COUNT(*) AS nbdecommentairesinformatique FROM commentairesforum WHERE theme =\'informatique\'');
							$nbdecommentairesinformatique = $searchnbdecommentairesinformatique->fetch();
							?>
								<span><img class="cubeinformatiqueimage" src="images/informatique.png" alt="" /></span>
								<span class="cubeinformatiquetitre">Informatique</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsinformatique['nbdesujetsinformatique']; ?></span>
							</div>
							<div id="cubejapon">
							<?php
							$searchnbdesujetsjapon = $db->query('SELECT COUNT(*) AS nbdesujetsjapon FROM forumsujets WHERE theme =\'japon\'');
							$nbdesujetsjapon = $searchnbdesujetsjapon->fetch();
							
							$searchnbdecommentairesjapon = $db->query('SELECT COUNT(*) AS nbdecommentairesjapon FROM commentairesforum WHERE theme =\'japon\'');
							$nbdecommentairesjapon = $searchnbdecommentairesjapon->fetch();
							?>
								<span><img class="cubejaponimage" src="images/japon.png" alt="" /></span>
								<span class="cubejapontitre">Japon</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsjapon['nbdesujetsjapon']; ?></span>
							</div>
							<div id="cuberien">
							<?php
							$searchnbdesujetsrien = $db->query('SELECT COUNT(*) AS nbdesujetsrien FROM forumsujets WHERE theme =\'rien\'');
							$nbdesujetsrien = $searchnbdesujetsrien->fetch();
							
							$searchnbdecommentairesrien = $db->query('SELECT COUNT(*) AS nbdecommentairesrien FROM commentairesforum WHERE theme =\'rien\'');
							$nbdecommentairesrien = $searchnbdecommentairesrien->fetch();
							?>
								<span><img class="cuberienimage" src="images/rien.png" alt="" /></span>
								<span class="cuberientitre">Tout sur rien</span>
								<span class="cubenombresujets"><?php echo $nbdesujetsrien['nbdesujetsrien']; ?></span>
							</div>
						</div>
					</div>
				</div>
				<div>
					<img src="images/retour.png" alt="Retour" id="retour" />
					<img src="images/ajouter.png" alt="Ajouter" class="ajouter" />
				</div>
				<div id="contenucubeanimes">
					<?php
						$searchsujetsanimes = $db->query('SELECT * FROM forumsujets WHERE theme= \'animes\' ORDER BY ID DESC');
						
						while ($sujetsanimes = $searchsujetsanimes->fetch())
						{
							$infosujettitreanimes = html_entity_decode($sujetsanimes['titre']);
									
							if(mb_strlen($infosujettitreanimes, 'utf8') <= 15)
							{
								$arrayinfosujetanimes[0] = $infosujettitreanimes;
							}
							else
							{
								$sujettitreanimes = mb_substr($infosujettitreanimes, 0, 12, 'utf8');
								
								$arrayinfosujetanimes[0] = $sujettitreanimes . "..."; 
							}
							
							$searchnbdecommentairesanimes2 = $db->query('SELECT COUNT(*) AS nbdecommentairesanimes2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsanimes['ID'] . '\'');
							$nbdecommentairesanimes2 = $searchnbdecommentairesanimes2->fetch();
						?>	
							<a href="forum.php?id=<?php echo $sujetsanimes['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsanimes['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsanimes['couleur']; ?>;">	
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsanimes['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesanimes2['nbdecommentairesanimes2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitreanimes, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetanimes[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitreanimes); ?>"><span><?php echo htmlspecialchars($arrayinfosujetanimes[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynoteanimes = $db->query('SELECT AVG(note) AS notemoyanimes FROM notesforum WHERE IDsujet =\'' . $sujetsanimes['ID'] . '\'');
								$notemoyanimes = $searchmoynoteanimes->fetch();	
								if($notemoyanimes['notemoyanimes'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoyanimes['notemoyanimes'] > 0 && $notemoyanimes['notemoyanimes'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoyanimes['notemoyanimes'] >= 2 && $notemoyanimes['notemoyanimes'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoyanimes['notemoyanimes'] >= 3 && $notemoyanimes['notemoyanimes'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoyanimes['notemoyanimes'] >= 4 && $notemoyanimes['notemoyanimes'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoyanimes['notemoyanimes'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsanimes->closeCursor();
					?>
				</div>
				<div id="contenucubemangas">
					<?php
						$searchsujetsmangas = $db->query('SELECT * FROM forumsujets WHERE theme= \'mangas\' ORDER BY ID DESC');
						
						while ($sujetsmangas = $searchsujetsmangas->fetch())
						{
							$infosujettitremangas = html_entity_decode($sujetsmangas['titre']);
							
							if(mb_strlen($infosujettitremangas, 'utf8') <= 15)
							{
								$arrayinfosujetmangas[0] = $infosujettitremangas;
							}
							else
							{
								$sujettitremangas = mb_substr($infosujettitremangas, 0, 12, 'utf8');
								
								$arrayinfosujetmangas[0] = $sujettitremangas . "..."; 
							}
							
							$searchnbdecommentairesmangas2 = $db->query('SELECT COUNT(*) AS nbdecommentairesmangas2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsmangas['ID'] . '\'');
							$nbdecommentairesmangas2 = $searchnbdecommentairesmangas2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsmangas['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsmangas['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsmangas['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsmangas['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesmangas2['nbdecommentairesmangas2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitremangas, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetmangas[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitremangas); ?>"><span><?php echo htmlspecialchars($arrayinfosujetmangas[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynotemangas = $db->query('SELECT AVG(note) AS notemoymangas FROM notesforum WHERE IDsujet =\'' . $sujetsmangas['ID'] . '\'');
								$notemoymangas = $searchmoynotemangas->fetch();	
								if($notemoymangas['notemoymangas'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoymangas['notemoymangas'] > 0 && $notemoymangas['notemoymangas'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoymangas['notemoymangas'] >= 2 && $notemoymangas['notemoymangas'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoymangas['notemoymangas'] >= 3 && $notemoymangas['notemoymangas'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoymangas['notemoymangas'] >= 4 && $notemoymangas['notemoymangas'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoymangas['notemoymangas'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsmangas->closeCursor();
					?>
				</div>
				<div id="contenucubescans">
					<?php
						$searchsujetsscans = $db->query('SELECT * FROM forumsujets WHERE theme= \'scans\' ORDER BY ID DESC');
						
						while ($sujetsscans = $searchsujetsscans->fetch())
						{
							$infosujettitrescans = html_entity_decode($sujetsscans['titre']);
							
							if(mb_strlen($infosujettitrescans, 'utf8') <= 15)
							{
								$arrayinfosujetscans[0] = $infosujettitrescans;
							}
							else
							{
								$sujettitrescans = mb_substr($infosujettitrescans, 0, 12, 'utf8');
								
								$arrayinfosujetscans[0] = $sujettitrescans . "..."; 
							}
							
							$searchnbdecommentairesscans2 = $db->query('SELECT COUNT(*) AS nbdecommentairesscans2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsscans['ID'] . '\'');
							$nbdecommentairesscans2 = $searchnbdecommentairesscans2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsscans['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsscans['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsscans['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsscans['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesscans2['nbdecommentairesscans2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitrescans, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetscans[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitrescans); ?>"><span><?php echo htmlspecialchars($arrayinfosujetscans[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynotescans = $db->query('SELECT AVG(note) AS notemoyscans FROM notesforum WHERE IDsujet =\'' . $sujetsscans['ID'] . '\'');
								$notemoyscans = $searchmoynotescans->fetch();	
								if($notemoyscans['notemoyscans'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoyscans['notemoyscans'] > 0 && $notemoyscans['notemoyscans'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoyscans['notemoyscans'] >= 2 && $notemoyscans['notemoyscans'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoyscans['notemoyscans'] >= 3 && $notemoyscans['notemoyscans'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoyscans['notemoyscans'] >= 4 && $notemoyscans['notemoyscans'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoyscans['notemoyscans'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsscans->closeCursor();
					?>
				</div>
				<div id="contenucubejapanimation">
					<?php
						$searchsujetsjapanimation = $db->query('SELECT * FROM forumsujets WHERE theme= \'japanimation\' ORDER BY ID DESC');
						
						while ($sujetsjapanimation = $searchsujetsjapanimation->fetch())
						{
							$infosujettitrejapanimation = html_entity_decode($sujetsjapanimation['titre']);
							
							if(mb_strlen($infosujettitrejapanimation, 'utf8') <= 15)
							{
								$arrayinfosujetjapanimation[0] = $infosujettitrejapanimation;
							}
							else
							{
								$sujettitrejapanimation = mb_substr($infosujettitrejapanimation, 0, 12, 'utf8');
								
								$arrayinfosujetjapanimation[0] = $sujettitrejapanimation . "..."; 
							}
							
							$searchnbdecommentairesjapanimation2 = $db->query('SELECT COUNT(*) AS nbdecommentairesjapanimation2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsjapanimation['ID'] . '\'');
							$nbdecommentairesjapanimation2 = $searchnbdecommentairesjapanimation2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsjapanimation['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsjapanimation['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsjapanimation['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsjapanimation['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesjapanimation2['nbdecommentairesjapanimation2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitrejapanimation, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetjapanimation[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitrejapanimation); ?>"><span><?php echo htmlspecialchars($arrayinfosujetjapanimation[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynotejapanimation = $db->query('SELECT AVG(note) AS notemoyjapanimation FROM notesforum WHERE IDsujet =\'' . $sujetsjapanimation['ID'] . '\'');
								$notemoyjapanimation = $searchmoynotejapanimation->fetch();	
								if($notemoyjapanimation['notemoyjapanimation'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoyjapanimation['notemoyjapanimation'] > 0 && $notemoyjapanimation['notemoyjapanimation'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoyjapanimation['notemoyjapanimation'] >= 2 && $notemoyjapanimation['notemoyjapanimation'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoyjapanimation['notemoyjapanimation'] >= 3 && $notemoyjapanimation['notemoyjapanimation'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoyjapanimation['notemoyjapanimation'] >= 4 && $notemoyjapanimation['notemoyjapanimation'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoyjapanimation['notemoyjapanimation'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsjapanimation->closeCursor();
					?>
				</div>
				<div id="contenucubequeregarder">
					<?php
						$searchsujetsqueregarder = $db->query('SELECT * FROM forumsujets WHERE theme= \'queregarder\' ORDER BY ID DESC');
						
						while ($sujetsqueregarder = $searchsujetsqueregarder->fetch())
						{
							$infosujettitrequeregarder = html_entity_decode($sujetsqueregarder['titre']);
							
							if(mb_strlen($infosujettitrequeregarder, 'utf8') <= 15)
							{
								$arrayinfosujetqueregarder[0] = $infosujettitrequeregarder;
							}
							else
							{
								$sujettitrequeregarder = mb_substr($infosujettitrequeregarder, 0, 12, 'utf8');
								
								$arrayinfosujetqueregarder[0] = $sujettitrequeregarder . "..."; 
							}
							
							$searchnbdecommentairesqueregarder2 = $db->query('SELECT COUNT(*) AS nbdecommentairesqueregarder2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsqueregarder['ID'] . '\'');
							$nbdecommentairesqueregarder2 = $searchnbdecommentairesqueregarder2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsqueregarder['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsqueregarder['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsqueregarder['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsqueregarder['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesqueregarder2['nbdecommentairesqueregarder2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitrequeregarder, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetqueregarder[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitrequeregarder); ?>"><span><?php echo htmlspecialchars($arrayinfosujetqueregarder[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynotequeregarder = $db->query('SELECT AVG(note) AS notemoyqueregarder FROM notesforum WHERE IDsujet =\'' . $sujetsqueregarder['ID'] . '\'');
								$notemoyqueregarder = $searchmoynotequeregarder->fetch();	
								if($notemoyqueregarder['notemoyqueregarder'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoyqueregarder['notemoyqueregarder'] > 0 && $notemoyqueregarder['notemoyqueregarder'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoyqueregarder['notemoyqueregarder'] >= 2 && $notemoyqueregarder['notemoyqueregarder'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoyqueregarder['notemoyqueregarder'] >= 3 && $notemoyqueregarder['notemoyqueregarder'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoyqueregarder['notemoyqueregarder'] >= 4 && $notemoyqueregarder['notemoyqueregarder'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoyqueregarder['notemoyqueregarder'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsqueregarder->closeCursor();
					?>
				</div>
				<div id="contenucubereglement">
					<?php
						$searchsujetsreglement = $db->query('SELECT * FROM forumsujets WHERE theme= \'reglement\' ORDER BY ID DESC');
						
						while ($sujetsreglement = $searchsujetsreglement->fetch())
						{
							$infosujettitrereglement = html_entity_decode($sujetsreglement['titre']);
							
							if(mb_strlen($infosujettitrereglement, 'utf8') <= 15)
							{
								$arrayinfosujetreglement[0] = $infosujettitrereglement;
							}
							else
							{
								$sujettitrereglement = mb_substr($infosujettitrereglement, 0, 12, 'utf8');
								
								$arrayinfosujetreglement[0] = $sujettitrereglement . "..."; 
							}
							
							$searchnbdecommentairesreglement2 = $db->query('SELECT COUNT(*) AS nbdecommentairesreglement2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsreglement['ID'] . '\'');
							$nbdecommentairesreglement2 = $searchnbdecommentairesreglement2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsreglement['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsreglement['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsreglement['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsreglement['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesreglement2['nbdecommentairesreglement2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitrereglement, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetreglement[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitrereglement); ?>"><span><?php echo htmlspecialchars($arrayinfosujetreglement[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynotereglement = $db->query('SELECT AVG(note) AS notemoyreglement FROM notesforum WHERE IDsujet =\'' . $sujetsreglement['ID'] . '\'');
								$notemoyreglement = $searchmoynotereglement->fetch();	
								if($notemoyreglement['notemoyreglement'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoyreglement['notemoyreglement'] > 0 && $notemoyreglement['notemoyreglement'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoyreglement['notemoyreglement'] >= 2 && $notemoyreglement['notemoyreglement'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoyreglement['notemoyreglement'] >= 3 && $notemoyreglement['notemoyreglement'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoyreglement['notemoyreglement'] >= 4 && $notemoyreglement['notemoyreglement'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoyreglement['notemoyreglement'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsreglement->closeCursor();
					?>
				</div>
				<div id="contenucubenewsmetromanga">
					<?php
						$searchsujetsnewsmetromanga = $db->query('SELECT * FROM forumsujets WHERE theme= \'newsmetromanga\' ORDER BY ID DESC');
						
						while ($sujetsnewsmetromanga = $searchsujetsnewsmetromanga->fetch())
						{
							$infosujettitrenewsmetromanga = html_entity_decode($sujetsnewsmetromanga['titre']);
							
							if(mb_strlen($infosujettitrenewsmetromanga, 'utf8') <= 15)
							{
								$arrayinfosujetnewsmetromanga[0] = $infosujettitrenewsmetromanga;
							}
							else
							{
								$sujettitrenewsmetromanga = mb_substr($infosujettitrenewsmetromanga, 0, 12, 'utf8');
								
								$arrayinfosujetnewsmetromanga[0] = $sujettitrenewsmetromanga . "..."; 
							}
							
							$searchnbdecommentairesnews2 = $db->query('SELECT COUNT(*) AS nbdecommentairesnews2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsnewsmetromanga['ID'] . '\'');
							$nbdecommentairesnews2 = $searchnbdecommentairesnews2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsnewsmetromanga['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsnewsmetromanga['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsnewsmetromanga['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsnewsmetromanga['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesnews2['nbdecommentairesnews2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitrenewsmetromanga, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetnewsmetromanga[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitrenewsmetromanga); ?>"><span><?php echo htmlspecialchars($arrayinfosujetnewsmetromanga[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynotenews = $db->query('SELECT AVG(note) AS notemoynews FROM notesforum WHERE IDsujet =\'' . $sujetsnewsmetromanga['ID'] . '\'');
								$notemoynews = $searchmoynotenews->fetch();	
								if($notemoynews['notemoynews'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoynews['notemoynews'] > 0 && $notemoynews['notemoynews'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoynews['notemoynews'] >= 2 && $notemoynews['notemoynews'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoynews['notemoynews'] >= 3 && $notemoynews['notemoynews'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoynews['notemoynews'] >= 4 && $notemoynews['notemoynews'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoynews['notemoynews'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsnewsmetromanga->closeCursor();
					?>
				</div>
				<div id="contenucubeevenements">
					<?php
						$searchsujetsevenements = $db->query('SELECT * FROM forumsujets WHERE theme= \'evenements\' ORDER BY ID DESC');
						
						while ($sujetsevenements = $searchsujetsevenements->fetch())
						{
							$infosujettitreevenements = html_entity_decode($sujetsevenements['titre']);
							
							if(mb_strlen($infosujettitreevenements, 'utf8') <= 15)
							{
								$arrayinfosujetevenements[0] = $infosujettitreevenements;
							}
							else
							{
								$sujettitreevenements = mb_substr($infosujettitreevenements, 0, 12, 'utf8');
								
								$arrayinfosujetevenements[0] = $sujettitreevenements . "..."; 
							}
							
							$searchnbdecommentairesevenements2 = $db->query('SELECT COUNT(*) AS nbdecommentairesevenements2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsevenements['ID'] . '\'');
							$nbdecommentairesevenements2 = $searchnbdecommentairesevenements2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsevenements['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsevenements['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsevenements['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsevenements['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesevenements2['nbdecommentairesevenements2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitreevenements, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetevenements[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitreevenements); ?>"><span><?php echo htmlspecialchars($arrayinfosujetevenements[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynoteevenements = $db->query('SELECT AVG(note) AS notemoyevenements FROM notesforum WHERE IDsujet =\'' . $sujetsevenements['ID'] . '\'');
								$notemoyevenements = $searchmoynoteevenements->fetch();	
								if($notemoyevenements['notemoyevenements'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoyevenements['notemoyevenements'] > 0 && $notemoyevenements['notemoyevenements'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoyevenements['notemoyevenements'] >= 2 && $notemoyevenements['notemoyevenements'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoyevenements['notemoyevenements'] >= 3 && $notemoyevenements['notemoyevenements'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoyevenements['notemoyevenements'] >= 4 && $notemoyevenements['notemoyevenements'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoyevenements['notemoyevenements'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsevenements->closeCursor();
					?>
				</div>
				<div id="contenucubebugs">
					<?php
						$searchsujetsbugs = $db->query('SELECT * FROM forumsujets WHERE theme= \'bugs\' ORDER BY ID DESC');
						
						while ($sujetsbugs = $searchsujetsbugs->fetch())
						{
							$infosujettitrebugs = html_entity_decode($sujetsbugs['titre']);
							
							if(mb_strlen($infosujettitrebugs, 'utf8') <= 15)
							{
								$arrayinfosujetbugs[0] = $infosujettitrebugs;
							}
							else
							{
								$sujettitrebugs = mb_substr($infosujettitrebugs, 0, 12, 'utf8');
								
								$arrayinfosujetbugs[0] = $sujettitrebugs . "..."; 
							}
							
							$searchnbdecommentairesbugs2 = $db->query('SELECT COUNT(*) AS nbdecommentairesbugs2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsbugs['ID'] . '\'');
							$nbdecommentairesbugs2 = $searchnbdecommentairesbugs2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsbugs['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsbugs['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsbugs['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsbugs['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesbugs2['nbdecommentairesbugs2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitrebugs, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetbugs[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitrebugs); ?>"><span><?php echo htmlspecialchars($arrayinfosujetbugs[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynotebugs = $db->query('SELECT AVG(note) AS notemoybugs FROM notesforum WHERE IDsujet =\'' . $sujetsbugs['ID'] . '\'');
								$notemoybugs = $searchmoynotebugs->fetch();	
								if($notemoybugs['notemoybugs'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoybugs['notemoybugs'] > 0 && $notemoybugs['notemoybugs'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoybugs['notemoybugs'] >= 2 && $notemoybugs['notemoybugs'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoybugs['notemoybugs'] >= 3 && $notemoybugs['notemoybugs'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoybugs['notemoybugs'] >= 4 && $notemoybugs['notemoybugs'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoybugs['notemoybugs'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsbugs->closeCursor();
					?>
				</div>
				<div id="contenucubeactualite">
					<?php
						$searchsujetsactualite = $db->query('SELECT * FROM forumsujets WHERE theme= \'actualite\' ORDER BY ID DESC');
						
						while ($sujetsactualite = $searchsujetsactualite->fetch())
						{
							$infosujettitreactualite = html_entity_decode($sujetsactualite['titre']);
							
							if(mb_strlen($infosujettitreactualite, 'utf8') <= 15)
							{
								$arrayinfosujetactualite[0] = $infosujettitreactualite;
							}
							else
							{
								$sujettitreactualite = mb_substr($infosujettitreactualite, 0, 12, 'utf8');
								
								$arrayinfosujetactualite[0] = $sujettitreactualite . "..."; 
							}
							
							$searchnbdecommentairesactualite2 = $db->query('SELECT COUNT(*) AS nbdecommentairesactualite2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsactualite['ID'] . '\'');
							$nbdecommentairesactualite2 = $searchnbdecommentairesactualite2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsactualite['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsactualite['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsactualite['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsactualite['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesactualite2['nbdecommentairesactualite2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitreactualite, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetactualite[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitreactualite); ?>"><span><?php echo htmlspecialchars($arrayinfosujetactualite[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynoteactualite = $db->query('SELECT AVG(note) AS notemoyactualite FROM notesforum WHERE IDsujet =\'' . $sujetsactualite['ID'] . '\'');
								$notemoyactualite = $searchmoynoteactualite->fetch();	
								if($notemoyactualite['notemoyactualite'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoyactualite['notemoyactualite'] > 0 && $notemoyactualite['notemoyactualite'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoyactualite['notemoyactualite'] >= 2 && $notemoyactualite['notemoyactualite'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoyactualite['notemoyactualite'] >= 3 && $notemoyactualite['notemoyactualite'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoyactualite['notemoyactualite'] >= 4 && $notemoyactualite['notemoyactualite'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoyactualite['notemoyactualite'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsactualite->closeCursor();
					?>
				</div>
				<div id="contenucubeaudiovisuel">
					<?php
						$searchsujetsaudiovisuel = $db->query('SELECT * FROM forumsujets WHERE theme= \'audiovisuel\' ORDER BY ID DESC');
						
						while ($sujetsaudiovisuel = $searchsujetsaudiovisuel->fetch())
						{
							$infosujettitreaudiovisuel = html_entity_decode($sujetsaudiovisuel['titre']);
							
							if(mb_strlen($infosujettitreaudiovisuel, 'utf8') <= 15)
							{
								$arrayinfosujetaudiovisuel[0] = $infosujettitreaudiovisuel;
							}
							else
							{
								$sujettitreaudiovisuel = mb_substr($infosujettitreaudiovisuel, 0, 12, 'utf8');
								
								$arrayinfosujetaudiovisuel[0] = $sujettitreaudiovisuel . "..."; 
							}
							
							$searchnbdecommentairesaudiovisuel2 = $db->query('SELECT COUNT(*) AS nbdecommentairesaudiovisuel2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsaudiovisuel['ID'] . '\'');
							$nbdecommentairesaudiovisuel2 = $searchnbdecommentairesaudiovisuel2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsaudiovisuel['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsaudiovisuel['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsaudiovisuel['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsaudiovisuel['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesaudiovisuel2['nbdecommentairesaudiovisuel2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitreaudiovisuel, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetaudiovisuel[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitreaudiovisuel); ?>"><span><?php echo htmlspecialchars($arrayinfosujetaudiovisuel[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynoteaudiovisuel = $db->query('SELECT AVG(note) AS notemoyaudiovisuel FROM notesforum WHERE IDsujet =\'' . $sujetsaudiovisuel['ID'] . '\'');
								$notemoyaudiovisuel = $searchmoynoteaudiovisuel->fetch();	
								if($notemoyaudiovisuel['notemoyaudiovisuel'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoyaudiovisuel['notemoyaudiovisuel'] > 0 && $notemoyaudiovisuel['notemoyaudiovisuel'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoyaudiovisuel['notemoyaudiovisuel'] >= 2 && $notemoyaudiovisuel['notemoyaudiovisuel'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoyaudiovisuel['notemoyaudiovisuel'] >= 3 && $notemoyaudiovisuel['notemoyaudiovisuel'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoyaudiovisuel['notemoyaudiovisuel'] >= 4 && $notemoyaudiovisuel['notemoyaudiovisuel'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoyaudiovisuel['notemoyaudiovisuel'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsaudiovisuel->closeCursor();
					?>
				</div>
				<div id="contenucubejeuxvideo">
					<?php
						$searchsujetsjeuxvideo = $db->query('SELECT * FROM forumsujets WHERE theme= \'jeuxvideo\' ORDER BY ID DESC');
						
						while ($sujetsjeuxvideo = $searchsujetsjeuxvideo->fetch())
						{
							$infosujettitrejeuxvideo = html_entity_decode($sujetsjeuxvideo['titre']);
							
							if(mb_strlen($infosujettitrejeuxvideo, 'utf8') <= 15)
							{
								$arrayinfosujetjeuxvideo[0] = $infosujettitrejeuxvideo;
							}
							else
							{
								$sujettitrejeuxvideo = mb_substr($infosujettitrejeuxvideo, 0, 12, 'utf8');
								
								$arrayinfosujetjeuxvideo[0] = $sujettitrejeuxvideo . "..."; 
							}
							
							$searchnbdecommentairesjeuxvideo2 = $db->query('SELECT COUNT(*) AS nbdecommentairesjeuxvideo2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsjeuxvideo['ID'] . '\'');
							$nbdecommentairesjeuxvideo2 = $searchnbdecommentairesjeuxvideo2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsjeuxvideo['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsjeuxvideo['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsjeuxvideo['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsjeuxvideo['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesjeuxvideo2['nbdecommentairesjeuxvideo2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitrejeuxvideo, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetjeuxvideo[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitrejeuxvideo); ?>"><span><?php echo htmlspecialchars($arrayinfosujetjeuxvideo[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynotejeuxvideo = $db->query('SELECT AVG(note) AS notemoyjeuxvideo FROM notesforum WHERE IDsujet =\'' . $sujetsjeuxvideo['ID'] . '\'');
								$notemoyjeuxvideo = $searchmoynotejeuxvideo->fetch();	
								if($notemoyjeuxvideo['notemoyjeuxvideo'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoyjeuxvideo['notemoyjeuxvideo'] > 0 && $notemoyjeuxvideo['notemoyjeuxvideo'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoyjeuxvideo['notemoyjeuxvideo'] >= 2 && $notemoyjeuxvideo['notemoyjeuxvideo'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoyjeuxvideo['notemoyjeuxvideo'] >= 3 && $notemoyjeuxvideo['notemoyjeuxvideo'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoyjeuxvideo['notemoyjeuxvideo'] >= 4 && $notemoyjeuxvideo['notemoyjeuxvideo'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoyjeuxvideo['notemoyjeuxvideo'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsjeuxvideo->closeCursor();
					?>
				</div>
				<div id="contenucubemusique">
					<?php
						$searchsujetsmusique = $db->query('SELECT * FROM forumsujets WHERE theme= \'musique\' ORDER BY ID DESC');
						
						while ($sujetsmusique = $searchsujetsmusique->fetch())
						{
							$infosujettitremusique = html_entity_decode($sujetsmusique['titre']);
							
							if(mb_strlen($infosujettitremusique, 'utf8') <= 15)
							{
								$arrayinfosujetmusique[0] = $infosujettitremusique;
							}
							else
							{
								$sujettitremusique = mb_substr($infosujettitremusique, 0, 12, 'utf8');
								
								$arrayinfosujetmusique[0] = $sujettitremusique . "..."; 
							}
							
							$searchnbdecommentairesmusique2 = $db->query('SELECT COUNT(*) AS nbdecommentairesmusique2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsmusique['ID'] . '\'');
							$nbdecommentairesmusique2 = $searchnbdecommentairesmusique2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsmusique['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsmusique['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsmusique['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsmusique['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesmusique2['nbdecommentairesmusique2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitremusique, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetmusique[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitremusique); ?>"><span><?php echo htmlspecialchars($arrayinfosujetmusique[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynotemusique = $db->query('SELECT AVG(note) AS notemoymusique FROM notesforum WHERE IDsujet =\'' . $sujetsmusique['ID'] . '\'');
								$notemoymusique = $searchmoynotemusique->fetch();	
								if($notemoymusique['notemoymusique'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoymusique['notemoymusique'] > 0 && $notemoymusique['notemoymusique'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoymusique['notemoymusique'] >= 2 && $notemoymusique['notemoymusique'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoymusique['notemoymusique'] >= 3 && $notemoymusique['notemoymusique'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoymusique['notemoymusique'] >= 4 && $notemoymusique['notemoymusique'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoymusique['notemoymusique'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsmusique->closeCursor();
					?>
				</div>
				<div id="contenucubeinformatique">
					<?php
						$searchsujetsinformatique = $db->query('SELECT * FROM forumsujets WHERE theme= \'informatique\' ORDER BY ID DESC');
						
						while ($sujetsinformatique = $searchsujetsinformatique->fetch())
						{
							$infosujettitreinformatique = html_entity_decode($sujetsinformatique['titre']);
							
							if(mb_strlen($infosujettitreinformatique, 'utf8') <= 15)
							{
								$arrayinfosujetinformatique[0] = $infosujettitreinformatique;
							}
							else
							{
								$sujettitreinformatique = mb_substr($infosujettitreinformatique, 0, 12, 'utf8');
								
								$arrayinfosujetinformatique[0] = $sujettitreinformatique . "..."; 
							}
							
							$searchnbdecommentairesinformatique2 = $db->query('SELECT COUNT(*) AS nbdecommentairesinformatique2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsinformatique['ID'] . '\'');
							$nbdecommentairesinformatique2 = $searchnbdecommentairesinformatique2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsinformatique['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsinformatique['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsinformatique['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsinformatique['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesinformatique2['nbdecommentairesinformatique2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitreinformatique, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetinformatique[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitreinformatique); ?>"><span><?php echo htmlspecialchars($arrayinfosujetinformatique[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynoteinformatique = $db->query('SELECT AVG(note) AS notemoyinformatique FROM notesforum WHERE IDsujet =\'' . $sujetsinformatique['ID'] . '\'');
								$notemoyinformatique = $searchmoynoteinformatique->fetch();	
								if($notemoyinformatique['notemoyinformatique'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoyinformatique['notemoyinformatique'] > 0 && $notemoyinformatique['notemoyinformatique'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoyinformatique['notemoyinformatique'] >= 2 && $notemoyinformatique['notemoyinformatique'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoyinformatique['notemoyinformatique'] >= 3 && $notemoyinformatique['notemoyinformatique'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoyinformatique['notemoyinformatique'] >= 4 && $notemoyinformatique['notemoyinformatique'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoyinformatique['notemoyinformatique'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsinformatique->closeCursor();
					?>
				</div>
				<div id="contenucubejapon">
					<?php
						$searchsujetsjapon = $db->query('SELECT * FROM forumsujets WHERE theme= \'japon\' ORDER BY ID DESC');
						
						while ($sujetsjapon = $searchsujetsjapon->fetch())
						{
							$infosujettitrejapon = html_entity_decode($sujetsjapon['titre']);
							
							if(mb_strlen($infosujettitrejapon, 'utf8') <= 15)
							{
								$arrayinfosujetjapon[0] = $infosujettitrejapon;
							}
							else
							{
								$sujettitrejapon = mb_substr($infosujettitrejapon, 0, 12, 'utf8');
								
								$arrayinfosujetjapon[0] = $sujettitrejapon . "..."; 
							}
							
							$searchnbdecommentairesjapon2 = $db->query('SELECT COUNT(*) AS nbdecommentairesjapon2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsjapon['ID'] . '\'');
							$nbdecommentairesjapon2 = $searchnbdecommentairesjapon2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsjapon['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsjapon['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsjapon['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsjapon['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesjapon2['nbdecommentairesjapon2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitrejapon, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetjapon[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitrejapon); ?>"><span><?php echo htmlspecialchars($arrayinfosujetjapon[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynotejapon = $db->query('SELECT AVG(note) AS notemoyjapon FROM notesforum WHERE IDsujet =\'' . $sujetsjapon['ID'] . '\'');
								$notemoyjapon = $searchmoynotejapon->fetch();	
								if($notemoyjapon['notemoyjapon'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoyjapon['notemoyjapon'] > 0 && $notemoyjapon['notemoyjapon'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoyjapon['notemoyjapon'] >= 2 && $notemoyjapon['notemoyjapon'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoyjapon['notemoyjapon'] >= 3 && $notemoyjapon['notemoyjapon'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoyjapon['notemoyjapon'] >= 4 && $notemoyjapon['notemoyjapon'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoyjapon['notemoyjapon'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsjapon->closeCursor();
					?>
				</div>
				<div id="contenucuberien">
					<?php
						$searchsujetsrien = $db->query('SELECT * FROM forumsujets WHERE theme = \'rien\' ORDER BY ID DESC');
						
						while ($sujetsrien = $searchsujetsrien->fetch())
						{
							$infosujettitrerien = html_entity_decode($sujetsrien['titre']);
							
							if(mb_strlen($infosujettitrerien, 'utf8') <= 15)
							{
								$arrayinfosujetrien[0] = $infosujettitrerien;
							}
							else
							{
								$sujettitrerien = mb_substr($infosujettitrerien, 0, 12, 'utf8');
								
								$arrayinfosujetrien[0] = $sujettitrerien . "..."; 
							}
							
							$searchnbdecommentairesrien2 = $db->query('SELECT COUNT(*) AS nbdecommentairesrien2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsrien['ID'] . '\'');
							$nbdecommentairesrien2 = $searchnbdecommentairesrien2->fetch();
						?>
							<a href="forum.php?id=<?php echo $sujetsrien['ID'] ?>" style="text-decoration:none;" >
							<div id="cubesujets" style="background:url(<?php echo htmlspecialchars($sujetsrien['image']); ?>)no-repeat;background-size: cover;color: <?php echo $sujetsrien['couleur']; ?>;">
								<?php
								$dateforum = date("Y-m-d", strtotime($sujetsrien['date_creation']));
								$newcontenuimg = date('Y-m-d');
								
								if($dateforum >= $newcontenuimg)
								{
								?>
									<img src="images/new.png" alt="New" class="newcontenuimg" />
								<?php
								}
								?>
								<span class="cubesujetsmessages"><?php echo $nbdecommentairesrien2['nbdecommentairesrien2']; ?></span><br />
								<?php
									if(mb_strlen($infosujettitrerien, 'utf8') <= 15)
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;"><span><?php echo htmlspecialchars($arrayinfosujetrien[0]); ?></span></div>
									<?php
									}
									else
									{
									?>
										<div class="cubesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitrerien); ?>"><span><?php echo htmlspecialchars($arrayinfosujetrien[0]); ?></span></div>
									<?php	
									}
								?>
								<?php
								$searchmoynoterien = $db->query('SELECT AVG(note) AS notemoyrien FROM notesforum WHERE IDsujet =\'' . $sujetsrien['ID'] . '\'');
								$notemoyrien = $searchmoynoterien->fetch();	
								if($notemoyrien['notemoyrien'] == 0)
								{
								?>
									<span class="cubesujetsetoile" style="color:black;">★★★★★</span>
								<?php
								}
								else if($notemoyrien['notemoyrien'] > 0 && $notemoyrien['notemoyrien'] < 2)
								{
								?>
									<span class="cubesujetsetoile">★<span style="color:black;">★★★★</span></span>
								<?php
								}
								else if($notemoyrien['notemoyrien'] >= 2 && $notemoyrien['notemoyrien'] < 3)
								{
								?>
									<span class="cubesujetsetoile">★★<span style="color:black;">★★★</span></span>
								<?php
								}
								else if($notemoyrien['notemoyrien'] >= 3 && $notemoyrien['notemoyrien'] < 4)
								{
								?>
									<span class="cubesujetsetoile">★★★<span style="color:black;">★★</span></span>
								<?php
								}
								else if($notemoyrien['notemoyrien'] >= 4 && $notemoyrien['notemoyrien'] < 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★<span style="color:black;">★</span></span>
								<?php
								}
								else if($notemoyrien['notemoyrien'] >= 5)
								{
								?>
									<span class="cubesujetsetoile">★★★★★</span>
								<?php
								}
								?>
							</div>
							</a>
						<?php
						}
						$searchsujetsrien->closeCursor();
					?>
				</div>
			</div>
			<div id="ajoutersujet">
			<img id="fermerajoutersujet" src="images/fermer.png" alt="Fermer" />
				<div class="blockajoutersujet">
				<?php
					if(isset($_SESSION['ID']))
					{
					?>
						<div class="contenuajoutersujet">
							<span class="titreajoutersujet">Création d'un sujet</span>
							<hr class="hrajoutersujet" />
						</div>
							<label class="themeajoutersujet" for="themeajoutersujet">Thème</label>
							<?php
								if($_SESSION['ID'] == '1')
								{
								?>
									<select class="selectthemeajoutersujet" required>
										<optgroup label="Metro Manga">
											<option value="reglement">Règlement du Forum</option>
											<option value="newsmetromanga">Nouveautés sur Metro Manga</option>
											<option value="evenements">Évènements</option>
											<option value="bugs">Problèmes, Bugs et Suggestions</option>
										</optgroup>
										<optgroup label="Animes & Mangas">
											<option value="animes">Animes</option>
											<option value="mangas">Mangas</option>
											<option value="scans">Scans</option>
											<option value="japanimation">Japanimation</option>
											<option value="queregarder">Que regarder, que lire ?</option>
										</optgroup>
										<optgroup label="Salon">
											<option value="actualite">Actualités</option>
											<option value="audiovisuel">Audiovisuel</option>
											<option value="jeuxvideo">Jeux vidéo</option>
											<option value="musique">Musiques</option>
											<option value="informatique">Informatique</option>
											<option value="japon">Japon</option>
											<option value="rien">Tout sur rien</option>
										</optgroup>
									</select>
								<?php
								}
								else
								{
								?>
									<select class="selectthemeajoutersujet" required>
										<optgroup label="Animes & Mangas">
											<option value="animes">Animes</option>
											<option value="mangas">Mangas</option>
											<option value="scans">Scans</option>
											<option value="japanimation">Japanimation</option>
											<option value="queregarder">Que regarder, que lire ?</option>
										</optgroup>
										<optgroup label="Salon">
											<option value="actualite">Actualités</option>
											<option value="audiovisuel">Audiovisuel</option>
											<option value="jeuxvideo">Jeux vidéo</option>
											<option value="musique">Musiques</option>
											<option value="informatique">Informatique</option>
											<option value="japon">Japon</option>
											<option value="rien">Tout sur rien</option>
										</optgroup>
									</select>
								<?php
								}
							?>
							<label class="titresujetajoutersujet" for="titresujetajoutersujet">Titre</label><input type="text" autocomplete="off" class="contenutitreajoutersujet" placeholder="Metro Manga" style="text-transform:capitalize;" maxlength="100" minlength="1" required />
							
							<div id="errorajoutersujet">
							<br />
							<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
							</div>
							
							<br />
							<div class="contenusujetajoutersujet">
								<textarea class="contenuajoutersujettextarea" name="contenuajoutersujettextarea">
								</textarea>
								<script>
									CKEDITOR.replace( 'contenuajoutersujettextarea' );
								</script>
							</div>
							<p class="cubeajoutersujet">Cette partie est facultative elle est dédiée à la personnalisation de votre sujet.</p>
							<label class="titreimageajoutersujet" for="titreimageajoutersujet">Image</label><input type="url" autocomplete="off" class="contenuimageajoutersujet" placeholder="http://metromanga.com/gallery/679.png" />
							<label class="titrecolorajoutersujet" for="titrecolorajoutersujet">Couleur</label><input type="color" class="contenucolorajoutersujet" value="#FFFFFF" /><br />
							<a href="#body" ><input type="submit" value="Valider" id="monBouton" class="validerajoutersujet" style="outline:none;" onclick="CKupdate();validerajoutersujet();" /></a>
						
						<script>
							
							$('a[href^="#"]').click(function(){
							var the_id = $(this).attr("href");
							$("#body2").mCustomScrollbar("scrollTo",$(the_id).offset().top -0, { scrollInertia: 1000 }); return false;});
							
							function CKupdate()
							{
								for ( instance in CKEDITOR.instances )
									CKEDITOR.instances[instance].updateElement();
							}
							
							function validerajoutersujet()
							{
								var xhr = new XMLHttpRequest();
								var valuetheme = document.querySelector('.selectthemeajoutersujet').value;
								var valuetitre = document.querySelector('.contenutitreajoutersujet').value;
								var valuesujet = document.querySelector('.contenuajoutersujettextarea').value;
								var valueimage = document.querySelector('.contenuimageajoutersujet').value;
								var valuecouleur = document.querySelector('.contenucolorajoutersujet').value;
								
								var valuetheme = encodeURIComponent(valuetheme);
								var valuetitre = encodeURIComponent(valuetitre);
								var valuesujet = encodeURIComponent(valuesujet);
								var valueimage = encodeURIComponent(valueimage);
								var valuecouleur = encodeURIComponent(valuecouleur);
								
								xhr.open('POST', 'site/phpforum.php');
								xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
								xhr.send('ajoutersujet=' + valuetheme + '&titre=' + valuetitre + '&sujet=' + valuesujet + '&image=' + valueimage + '&couleur=' + valuecouleur);
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#errorajoutersujet').innerHTML = xhr.responseText;
										confirmvaliderajoutersujet();
									}
								};
								
								xhr.send(null);
							}
							
							function confirmvaliderajoutersujet()
							{
								if(document.querySelector('#confirmvaliderajoutersujet').innerHTML == "OK")
								{
									window.setTimeout("location=('forum.php');",0);
								}
							}
							
						</script>
					<?php
					}
					else
					{
					?>
						<div class="contenuajoutersujet">
							<span class="titreajoutersujet">Création d'un sujet</span>
							<hr class="hrajoutersujet" />
							<p class="nonmembreajoutersujet">La création d'un sujet est exclusivement réservée aux membres.</p>
						</div>			
					<?php
					}
				?>
				</div>
			</div>
				
				<div id="formatligne">
				<img src="images/ajouter.png" alt="Ajouter" class="ajouterligne" />
					<div class="block1">
						<div class="headerblock">
							<span class="titreblock">Metro Manga</span>
							<span class="sujetsblock">Sujets</span>
							<span class="messagesblock">Commentaires</span>
						</div><br />
						<div class="articleblock" id="lignereglement">
							<span class="imagearticle"><img src="images/reglement.png" alt="" width="29" height="25" /></span>
							<span class="titrearticle">Règlement du Forum</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsreglement['nbdesujetsreglement']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesreglement['nbdecommentairesreglement']; ?></span>
						</div><br />
						<div class="blockligne" id="blocklignereglement">
							<?php
								$searchsujetsreglement = $db->query('SELECT * FROM forumsujets WHERE theme= \'reglement\' ORDER BY ID DESC');
								
								while ($sujetsreglement = $searchsujetsreglement->fetch())
								{
									$infosujettitre2reglement = html_entity_decode($sujetsreglement['titre']);
									
									if(mb_strlen($infosujettitre2reglement, 'utf8') <= 25)
									{
										$arrayinfosujet2reglement[0] = $infosujettitre2reglement;
									}
									else
									{
										$sujettitre2reglement = mb_substr($infosujettitre2reglement, 0, 22, 'utf8');
										
										$arrayinfosujet2reglement[0] = $sujettitre2reglement . "..."; 
									}
									
									$searchnbdecommentairesreglement2 = $db->query('SELECT COUNT(*) AS nbdecommentairesreglement2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsreglement['ID'] . '\'');
									$nbdecommentairesreglement2 = $searchnbdecommentairesreglement2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsreglement['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
									<?php
										$dateforum = date("Y-m-d", strtotime($sujetsreglement['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2reglement, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2reglement[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2reglement); ?>"><?php echo htmlspecialchars($arrayinfosujet2reglement[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesreglement2['nbdecommentairesreglement2']; ?></span>
										<?php
										$searchmoynotereglement = $db->query('SELECT AVG(note) AS notemoyreglement FROM notesforum WHERE IDsujet =\'' . $sujetsreglement['ID'] . '\'');
										$notemoyreglement = $searchmoynotereglement->fetch();	
										if($notemoyreglement['notemoyreglement'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoyreglement['notemoyreglement'] > 0 && $notemoyreglement['notemoyreglement'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoyreglement['notemoyreglement'] >= 2 && $notemoyreglement['notemoyreglement'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoyreglement['notemoyreglement'] >= 3 && $notemoyreglement['notemoyreglement'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoyreglement['notemoyreglement'] >= 4 && $notemoyreglement['notemoyreglement'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoyreglement['notemoyreglement'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsreglement->closeCursor();
							?>
						</div>
						<div class="articleblock" id="lignenewsmetromanga">
							<span class="imagearticle"><img src="images/news.png" alt="" width="25" height="25" /></span>
							<span class="titrearticle">Nouveautés sur Metro Manga</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsnews['nbdesujetsnews']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesnews['nbdecommentairesnews']; ?></span>
						</div><br />
						<div class="blockligne" id="blocklignenewsmetromanga">
							<?php
								$searchsujetsnewsmetromanga = $db->query('SELECT * FROM forumsujets WHERE theme= \'newsmetromanga\' ORDER BY ID DESC');
								
								while ($sujetsnewsmetromanga = $searchsujetsnewsmetromanga->fetch())
								{
									$infosujettitre2newsmetromanga = html_entity_decode($sujetsnewsmetromanga['titre']);
									
									if(mb_strlen($infosujettitre2newsmetromanga, 'utf8') <= 25)
									{
										$arrayinfosujet2newsmetromanga[0] = $infosujettitre2newsmetromanga;
									}
									else
									{
										$sujettitre2newsmetromanga = mb_substr($infosujettitre2newsmetromanga, 0, 22, 'utf8');
										
										$arrayinfosujet2newsmetromanga[0] = $sujettitre2newsmetromanga . "..."; 
									}
									
									$searchnbdecommentairesnews2 = $db->query('SELECT COUNT(*) AS nbdecommentairesnews2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsnewsmetromanga['ID'] . '\'');
									$nbdecommentairesnews2 = $searchnbdecommentairesnews2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsnewsmetromanga['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsnewsmetromanga['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2newsmetromanga, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2newsmetromanga[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2newsmetromanga); ?>"><?php echo htmlspecialchars($arrayinfosujet2newsmetromanga[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesnews2['nbdecommentairesnews2']; ?></span>
										<?php
										$searchmoynotenews = $db->query('SELECT AVG(note) AS notemoynews FROM notesforum WHERE IDsujet =\'' . $sujetsnewsmetromanga['ID'] . '\'');
										$notemoynews = $searchmoynotenews->fetch();	
										if($notemoynews['notemoynews'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoynews['notemoynews'] > 0 && $notemoynews['notemoynews'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoynews['notemoynews'] >= 2 && $notemoynews['notemoynews'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoynews['notemoynews'] >= 3 && $notemoynews['notemoynews'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoynews['notemoynews'] >= 4 && $notemoynews['notemoynews'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoynews['notemoynews'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsnewsmetromanga->closeCursor();
							?>
						</div>
						<div class="articleblock" id="ligneevenements">
							<span class="imagearticle"><img src="images/evenements.png" alt="" width="25" height="30" /></span>
							<span class="titrearticle">Évènements</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsevenements['nbdesujetsevenements']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesevenements['nbdecommentairesevenements']; ?></span>
						</div><br />
						<div class="blockligne" id="blockligneevenements">
							<?php
								$searchsujetsevenements = $db->query('SELECT * FROM forumsujets WHERE theme= \'evenements\' ORDER BY ID DESC');
								
								while ($sujetsevenements = $searchsujetsevenements->fetch())
								{
									$infosujettitre2evenements = html_entity_decode($sujetsevenements['titre']);
									
									if(mb_strlen($infosujettitre2evenements, 'utf8') <= 25)
									{
										$arrayinfosujet2evenements[0] = $infosujettitre2evenements;
									}
									else
									{
										$sujettitre2evenements = mb_substr($infosujettitre2evenements, 0, 22, 'utf8');
										
										$arrayinfosujet2evenements[0] = $sujettitre2evenements . "..."; 
									}
									
									$searchnbdecommentairesevenements2 = $db->query('SELECT COUNT(*) AS nbdecommentairesevenements2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsevenements['ID'] . '\'');
									$nbdecommentairesevenements2 = $searchnbdecommentairesevenements2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsevenements['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsevenements['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2evenements, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2evenements[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2evenements); ?>"><?php echo htmlspecialchars($arrayinfosujet2evenements[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesevenements2['nbdecommentairesevenements2']; ?></span>
										<?php
										$searchmoynoteevenements = $db->query('SELECT AVG(note) AS notemoyevenements FROM notesforum WHERE IDsujet =\'' . $sujetsevenements['ID'] . '\'');
										$notemoyevenements = $searchmoynoteevenements->fetch();	
										if($notemoyevenements['notemoyevenements'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoyevenements['notemoyevenements'] > 0 && $notemoyevenements['notemoyevenements'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoyevenements['notemoyevenements'] >= 2 && $notemoyevenements['notemoyevenements'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoyevenements['notemoyevenements'] >= 3 && $notemoyevenements['notemoyevenements'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoyevenements['notemoyevenements'] >= 4 && $notemoyevenements['notemoyevenements'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoyevenements['notemoyevenements'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsevenements->closeCursor();
							?>
						</div>
						<div class="articleblock" id="lignebugs">
							<span class="imagearticle"><img src="images/bugs.png" alt="" width="25" height="25" /></span>
							<span class="titrearticle">Problèmes, Bugs et Suggestions</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsbugs['nbdesujetsbugs']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesbugs['nbdecommentairesbugs']; ?></span>
						</div><br />
						<div class="blockligne" id="blocklignebugs">
							<?php
								$searchsujetsbugs = $db->query('SELECT * FROM forumsujets WHERE theme= \'bugs\' ORDER BY ID DESC');
								
								while ($sujetsbugs = $searchsujetsbugs->fetch())
								{
									$infosujettitre2bugs = html_entity_decode($sujetsbugs['titre']);
									
									if(mb_strlen($infosujettitre2bugs, 'utf8') <= 25)
									{
										$arrayinfosujet2bugs[0] = $infosujettitre2bugs;
									}
									else
									{
										$sujettitre2bugs = mb_substr($infosujettitre2bugs, 0, 22, 'utf8');
										
										$arrayinfosujet2bugs[0] = $sujettitre2bugs . "..."; 
									}
									
									$searchnbdecommentairesbugs2 = $db->query('SELECT COUNT(*) AS nbdecommentairesbugs2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsbugs['ID'] . '\'');
									$nbdecommentairesbugs2 = $searchnbdecommentairesbugs2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsbugs['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsbugs['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2bugs, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2bugs[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2bugs); ?>"><?php echo htmlspecialchars($arrayinfosujet2bugs[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesbugs2['nbdecommentairesbugs2']; ?></span>
										<?php
										$searchmoynotebugs = $db->query('SELECT AVG(note) AS notemoybugs FROM notesforum WHERE IDsujet =\'' . $sujetsbugs['ID'] . '\'');
										$notemoybugs = $searchmoynotebugs->fetch();	
										if($notemoybugs['notemoybugs'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoybugs['notemoybugs'] > 0 && $notemoybugs['notemoybugs'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoybugs['notemoybugs'] >= 2 && $notemoybugs['notemoybugs'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoybugs['notemoybugs'] >= 3 && $notemoybugs['notemoybugs'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoybugs['notemoybugs'] >= 4 && $notemoybugs['notemoybugs'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoybugs['notemoybugs'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsbugs->closeCursor();
							?>
						</div>
					</div>
					
					<div class="block2">
						<div class="headerblock">
							<span class="titreblock">Animes & Mangas</span>
							<span class="sujetsblock">Sujets</span>
							<span class="messagesblock">Commentaires</span>
						</div><br />
						<div class="articleblock" id="ligneanimes">
							<span class="imagearticle"><img src="images/animes.png" alt="" width="25" height="25" /></span>
							<span class="titrearticle">Animes</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsanimes['nbdesujetsanimes']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesanimes['nbdecommentairesanimes']; ?></span>
						</div><br />
						<div class="blockligne" id="blockligneanimes">
							<?php
								$searchsujetsanimes = $db->query('SELECT * FROM forumsujets WHERE theme= \'animes\' ORDER BY ID DESC');
								
								while ($sujetsanimes = $searchsujetsanimes->fetch())
								{
									$infosujettitre2animes = html_entity_decode($sujetsanimes['titre']);
									
									if(mb_strlen($infosujettitre2animes, 'utf8') <= 25)
									{
										$arrayinfosujet2animes[0] = $infosujettitre2animes;
									}
									else
									{
										$sujettitre2animes = mb_substr($infosujettitre2animes, 0, 22, 'utf8');
										
										$arrayinfosujet2animes[0] = $sujettitre2animes . "..."; 
									}
									
									$searchnbdecommentairesanimes2 = $db->query('SELECT COUNT(*) AS nbdecommentairesanimes2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsanimes['ID'] . '\'');
									$nbdecommentairesanimes2 = $searchnbdecommentairesanimes2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsanimes['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsanimes['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2animes, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2animes[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2animes); ?>"><?php echo htmlspecialchars($arrayinfosujet2animes[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesanimes2['nbdecommentairesanimes2']; ?></span>
										<?php
										$searchmoynoteanimes = $db->query('SELECT AVG(note) AS notemoyanimes FROM notesforum WHERE IDsujet =\'' . $sujetsanimes['ID'] . '\'');
										$notemoyanimes = $searchmoynoteanimes->fetch();	
										if($notemoyanimes['notemoyanimes'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoyanimes['notemoyanimes'] > 0 && $notemoyanimes['notemoyanimes'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoyanimes['notemoyanimes'] >= 2 && $notemoyanimes['notemoyanimes'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoyanimes['notemoyanimes'] >= 3 && $notemoyanimes['notemoyanimes'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoyanimes['notemoyanimes'] >= 4 && $notemoyanimes['notemoyanimes'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoyanimes['notemoyanimes'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsanimes->closeCursor();
							?>
						</div>
						<div class="articleblock" id="lignemangas">
							<span class="imagearticle"><img src="images/mangas.png" alt="" width="25" height="35" /></span>
							<span class="titrearticle">Mangas</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsmangas['nbdesujetsmangas']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesmangas['nbdecommentairesmangas']; ?></span>
						</div><br />
						<div class="blockligne" id="blocklignemangas">
							<?php
								$searchsujetsmangas = $db->query('SELECT * FROM forumsujets WHERE theme= \'mangas\' ORDER BY ID DESC');
								
								while ($sujetsmangas = $searchsujetsmangas->fetch())
								{
									$infosujettitre2mangas = html_entity_decode($sujetsmangas['titre']);
									
									if(mb_strlen($infosujettitre2mangas, 'utf8') <= 25)
									{
										$arrayinfosujet2mangas[0] = $infosujettitre2mangas;
									}
									else
									{
										$sujettitre2mangas = mb_substr($infosujettitre2mangas, 0, 22, 'utf8');
										
										$arrayinfosujet2mangas[0] = $sujettitre2mangas . "..."; 
									}
									
									$searchnbdecommentairesmangas2 = $db->query('SELECT COUNT(*) AS nbdecommentairesmangas2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsmangas['ID'] . '\'');
									$nbdecommentairesmangas2 = $searchnbdecommentairesmangas2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsmangas['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsmangas['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2mangas, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2mangas[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2mangas); ?>"><?php echo htmlspecialchars($arrayinfosujet2mangas[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesmangas2['nbdecommentairesmangas2']; ?></span>
										<?php
										$searchmoynotemangas = $db->query('SELECT AVG(note) AS notemoymangas FROM notesforum WHERE IDsujet =\'' . $sujetsmangas['ID'] . '\'');
										$notemoymangas = $searchmoynotemangas->fetch();	
										if($notemoymangas['notemoymangas'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoymangas['notemoymangas'] > 0 && $notemoymangas['notemoymangas'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoymangas['notemoymangas'] >= 2 && $notemoymangas['notemoymangas'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoymangas['notemoymangas'] >= 3 && $notemoymangas['notemoymangas'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoymangas['notemoymangas'] >= 4 && $notemoymangas['notemoymangas'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoymangas['notemoymangas'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsmangas->closeCursor();
							?>
						</div>
						<div class="articleblock" id="lignescans">
							<span class="imagearticle"><img src="images/scans.png" alt="" width="22" height="30" /></span>
							<span class="titrearticle">Scans</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsscans['nbdesujetsscans']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesscans['nbdecommentairesscans']; ?></span>
						</div><br />
						<div class="blockligne" id="blocklignescans">
							<?php
								$searchsujetsscans = $db->query('SELECT * FROM forumsujets WHERE theme= \'scans\' ORDER BY ID DESC');
								
								while ($sujetsscans = $searchsujetsscans->fetch())
								{
									$infosujettitre2scans = html_entity_decode($sujetsscans['titre']);
									
									if(mb_strlen($infosujettitre2scans, 'utf8') <= 25)
									{
										$arrayinfosujet2scans[0] = $infosujettitre2scans;
									}
									else
									{
										$sujettitre2scans = mb_substr($infosujettitre2scans, 0, 22, 'utf8');
										
										$arrayinfosujet2scans[0] = $sujettitre2scans . "..."; 
									}
									
									$searchnbdecommentairesscans2 = $db->query('SELECT COUNT(*) AS nbdecommentairesscans2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsscans['ID'] . '\'');
									$nbdecommentairesscans2 = $searchnbdecommentairesscans2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsscans['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsscans['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2scans, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2scans[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2scans); ?>"><?php echo htmlspecialchars($arrayinfosujet2scans[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesscans2['nbdecommentairesscans2']; ?></span>
										<?php
										$searchmoynotescans = $db->query('SELECT AVG(note) AS notemoyscans FROM notesforum WHERE IDsujet =\'' . $sujetsscans['ID'] . '\'');
										$notemoyscans = $searchmoynotescans->fetch();	
										if($notemoyscans['notemoyscans'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoyscans['notemoyscans'] > 0 && $notemoyscans['notemoyscans'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoyscans['notemoyscans'] >= 2 && $notemoyscans['notemoyscans'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoyscans['notemoyscans'] >= 3 && $notemoyscans['notemoyscans'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoyscans['notemoyscans'] >= 4 && $notemoyscans['notemoyscans'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoyscans['notemoyscans'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsscans->closeCursor();
							?>
						</div>
						<div class="articleblock" id="lignejapanimation">
							<span class="imagearticle"><img src="images/japanimation.png" alt="" width="25" height="30" /></span>
							<span class="titrearticle">Japanimation</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsjapanimation['nbdesujetsjapanimation']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesjapanimation['nbdecommentairesjapanimation']; ?></span>
						</div><br />
						<div class="blockligne" id="blocklignejapanimation">
							<?php
								$searchsujetsjapanimation = $db->query('SELECT * FROM forumsujets WHERE theme= \'japanimation\' ORDER BY ID DESC');
								
								while ($sujetsjapanimation = $searchsujetsjapanimation->fetch())
								{
									$infosujettitre2japanimation = html_entity_decode($sujetsjapanimation['titre']);
									
									if(mb_strlen($infosujettitre2japanimation, 'utf8') <= 25)
									{
										$arrayinfosujet2japanimation[0] = $infosujettitre2japanimation;
									}
									else
									{
										$sujettitre2japanimation = mb_substr($infosujettitre2japanimation, 0, 22, 'utf8');
										
										$arrayinfosujet2japanimation[0] = $sujettitre2japanimation . "..."; 
									}
									
									$searchnbdecommentairesjapanimation2 = $db->query('SELECT COUNT(*) AS nbdecommentairesjapanimation2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsjapanimation['ID'] . '\'');
									$nbdecommentairesjapanimation2 = $searchnbdecommentairesjapanimation2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsjapanimation['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsjapanimation['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2japanimation, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2japanimation[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2japanimation); ?>"><?php echo htmlspecialchars($arrayinfosujet2japanimation[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesjapanimation2['nbdecommentairesjapanimation2']; ?></span>
										<?php
										$searchmoynotejapanimation = $db->query('SELECT AVG(note) AS notemoyjapanimation FROM notesforum WHERE IDsujet =\'' . $sujetsjapanimation['ID'] . '\'');
										$notemoyjapanimation = $searchmoynotejapanimation->fetch();	
										if($notemoyjapanimation['notemoyjapanimation'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoyjapanimation['notemoyjapanimation'] > 0 && $notemoyjapanimation['notemoyjapanimation'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoyjapanimation['notemoyjapanimation'] >= 2 && $notemoyjapanimation['notemoyjapanimation'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoyjapanimation['notemoyjapanimation'] >= 3 && $notemoyjapanimation['notemoyjapanimation'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoyjapanimation['notemoyjapanimation'] >= 4 && $notemoyjapanimation['notemoyjapanimation'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoyjapanimation['notemoyjapanimation'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsjapanimation->closeCursor();
							?>
						</div>
						<div class="articleblock" id="lignequeregarder">
							<span class="imagearticle"><img src="images/queregarder.png" alt="" width="25" height="25" /></span>
							<span class="titrearticle">Que regarder, que lire ?</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsqueregarder['nbdesujetsqueregarder']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesqueregarder['nbdecommentairesqueregarder']; ?></span>
						</div><br />
						<div class="blockligne" id="blocklignequeregarder">
							<?php
								$searchsujetsqueregarder = $db->query('SELECT * FROM forumsujets WHERE theme= \'queregarder\' ORDER BY ID DESC');
								
								while ($sujetsqueregarder = $searchsujetsqueregarder->fetch())
								{
									$infosujettitre2queregarder = html_entity_decode($sujetsqueregarder['titre']);
									
									if(mb_strlen($infosujettitre2queregarder, 'utf8') <= 25)
									{
										$arrayinfosujet2queregarder[0] = $infosujettitre2queregarder;
									}
									else
									{
										$sujettitre2queregarder = mb_substr($infosujettitre2queregarder, 0, 22, 'utf8');
										
										$arrayinfosujet2queregarder[0] = $sujettitre2queregarder . "..."; 
									}
									
									$searchnbdecommentairesqueregarder2 = $db->query('SELECT COUNT(*) AS nbdecommentairesqueregarder2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsqueregarder['ID'] . '\'');
									$nbdecommentairesqueregarder2 = $searchnbdecommentairesqueregarder2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsqueregarder['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsqueregarder['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2queregarder, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2queregarder[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2queregarder); ?>"><?php echo htmlspecialchars($arrayinfosujet2queregarder[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesqueregarder2['nbdecommentairesqueregarder2']; ?></span>
										<?php
										$searchmoynotequeregarder = $db->query('SELECT AVG(note) AS notemoyqueregarder FROM notesforum WHERE IDsujet =\'' . $sujetsqueregarder['ID'] . '\'');
										$notemoyqueregarder = $searchmoynotequeregarder->fetch();	
										if($notemoyqueregarder['notemoyqueregarder'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoyqueregarder['notemoyqueregarder'] > 0 && $notemoyqueregarder['notemoyqueregarder'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoyqueregarder['notemoyqueregarder'] >= 2 && $notemoyqueregarder['notemoyqueregarder'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoyqueregarder['notemoyqueregarder'] >= 3 && $notemoyqueregarder['notemoyqueregarder'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoyqueregarder['notemoyqueregarder'] >= 4 && $notemoyqueregarder['notemoyqueregarder'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoyqueregarder['notemoyqueregarder'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsqueregarder->closeCursor();
							?>
						</div>
					</div>
					
					<div class="block3">
						<div class="headerblock">
							<span class="titreblock">Salon</span>
							<span class="sujetsblock">Sujets</span>
							<span class="messagesblock">Commentaires</span>
						</div><br />
						<div class="articleblock" id="ligneactualite">
							<span class="imagearticle"><img src="images/actualite.png" alt="" width="20" height="25" /></span>
							<span class="titrearticle">Actualités</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsactualite['nbdesujetsactualite']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesactualite['nbdecommentairesactualite']; ?></span>
						</div><br />
						<div class="blockligne" id="blockligneactualite">
							<?php
								$searchsujetsactualite = $db->query('SELECT * FROM forumsujets WHERE theme= \'actualite\' ORDER BY ID DESC');
								
								while ($sujetsactualite = $searchsujetsactualite->fetch())
								{
									$infosujettitre2actualite = html_entity_decode($sujetsactualite['titre']);
									
									if(mb_strlen($infosujettitre2actualite, 'utf8') <= 25)
									{
										$arrayinfosujet2actualite[0] = $infosujettitre2actualite;
									}
									else
									{
										$sujettitre2actualite = mb_substr($infosujettitre2actualite, 0, 22, 'utf8');
										
										$arrayinfosujet2actualite[0] = $sujettitre2actualite . "..."; 
									}
									
									$searchnbdecommentairesactualite2 = $db->query('SELECT COUNT(*) AS nbdecommentairesactualite2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsactualite['ID'] . '\'');
									$nbdecommentairesactualite2 = $searchnbdecommentairesactualite2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsactualite['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsactualite['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2actualite, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2actualite[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2actualite); ?>"><?php echo htmlspecialchars($arrayinfosujet2actualite[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesactualite2['nbdecommentairesactualite2']; ?></span>
										<?php
										$searchmoynoteactualite = $db->query('SELECT AVG(note) AS notemoyactualite FROM notesforum WHERE IDsujet =\'' . $sujetsactualite['ID'] . '\'');
										$notemoyactualite = $searchmoynoteactualite->fetch();	
										if($notemoyactualite['notemoyactualite'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoyactualite['notemoyactualite'] > 0 && $notemoyactualite['notemoyactualite'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoyactualite['notemoyactualite'] >= 2 && $notemoyactualite['notemoyactualite'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoyactualite['notemoyactualite'] >= 3 && $notemoyactualite['notemoyactualite'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoyactualite['notemoyactualite'] >= 4 && $notemoyactualite['notemoyactualite'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoyactualite['notemoyactualite'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsactualite->closeCursor();
							?>
						</div>
						<div class="articleblock" id="ligneaudiovisuel">
							<span class="imagearticle"><img src="images/audiovisuel.png" alt="" width="25" height="25" /></span>
							<span class="titrearticle">Audiovisuel</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsaudiovisuel['nbdesujetsaudiovisuel']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesaudiovisuel['nbdecommentairesaudiovisuel']; ?></span>
						</div><br />
						<div class="blockligne" id="blockligneaudiovisuel">
							<?php
								$searchsujetsaudiovisuel = $db->query('SELECT * FROM forumsujets WHERE theme= \'audiovisuel\' ORDER BY ID DESC');
								
								while ($sujetsaudiovisuel = $searchsujetsaudiovisuel->fetch())
								{
									$infosujettitre2audiovisuel = html_entity_decode($sujetsaudiovisuel['titre']);
									
									if(mb_strlen($infosujettitre2audiovisuel, 'utf8') <= 25)
									{
										$arrayinfosujet2audiovisuel[0] = $infosujettitre2audiovisuel;
									}
									else
									{
										$sujettitre2audiovisuel = mb_substr($infosujettitre2audiovisuel, 0, 22, 'utf8');
										
										$arrayinfosujet2audiovisuel[0] = $sujettitre2audiovisuel . "..."; 
									}
									
									$searchnbdecommentairesaudiovisuel2 = $db->query('SELECT COUNT(*) AS nbdecommentairesaudiovisuel2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsaudiovisuel['ID'] . '\'');
									$nbdecommentairesaudiovisuel2 = $searchnbdecommentairesaudiovisuel2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsaudiovisuel['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsaudiovisuel['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2audiovisuel, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2audiovisuel[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2audiovisuel); ?>"><?php echo htmlspecialchars($arrayinfosujet2audiovisuel[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesaudiovisuel2['nbdecommentairesaudiovisuel2']; ?></span>
										<?php
										$searchmoynoteaudiovisuel = $db->query('SELECT AVG(note) AS notemoyaudiovisuel FROM notesforum WHERE IDsujet =\'' . $sujetsaudiovisuel['ID'] . '\'');
										$notemoyaudiovisuel = $searchmoynoteaudiovisuel->fetch();	
										if($notemoyaudiovisuel['notemoyaudiovisuel'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoyaudiovisuel['notemoyaudiovisuel'] > 0 && $notemoyaudiovisuel['notemoyaudiovisuel'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoyaudiovisuel['notemoyaudiovisuel'] >= 2 && $notemoyaudiovisuel['notemoyaudiovisuel'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoyaudiovisuel['notemoyaudiovisuel'] >= 3 && $notemoyaudiovisuel['notemoyaudiovisuel'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoyaudiovisuel['notemoyaudiovisuel'] >= 4 && $notemoyaudiovisuel['notemoyaudiovisuel'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoyaudiovisuel['notemoyaudiovisuel'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsaudiovisuel->closeCursor();
							?>
						</div>
						<div class="articleblock" id="lignejeuxvideo">
							<span class="imagearticle"><img src="images/jeuxvideo.png" alt="" width="25" height="25" /></span>
							<span class="titrearticle">Jeux vidéo</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsjeuxvideo['nbdesujetsjeuxvideo']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesjeuxvideo['nbdecommentairesjeuxvideo']; ?></span>
						</div><br />
						<div class="blockligne" id="blocklignejeuxvideo">
							<?php
								$searchsujetsjeuxvideo = $db->query('SELECT * FROM forumsujets WHERE theme= \'jeuxvideo\' ORDER BY ID DESC');
								
								while ($sujetsjeuxvideo = $searchsujetsjeuxvideo->fetch())
								{
									$infosujettitre2jeuxvideo = html_entity_decode($sujetsjeuxvideo['titre']);
									
									if(mb_strlen($infosujettitre2jeuxvideo, 'utf8') <= 25)
									{
										$arrayinfosujet2jeuxvideo[0] = $infosujettitre2jeuxvideo;
									}
									else
									{
										$sujettitre2jeuxvideo = mb_substr($infosujettitre2jeuxvideo, 0, 22, 'utf8');
										
										$arrayinfosujet2jeuxvideo[0] = $sujettitre2jeuxvideo . "..."; 
									}
									
									$searchnbdecommentairesjeuxvideo2 = $db->query('SELECT COUNT(*) AS nbdecommentairesjeuxvideo2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsjeuxvideo['ID'] . '\'');
									$nbdecommentairesjeuxvideo2 = $searchnbdecommentairesjeuxvideo2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsjeuxvideo['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsjeuxvideo['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2jeuxvideo, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2jeuxvideo[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2jeuxvideo); ?>"><?php echo htmlspecialchars($arrayinfosujet2jeuxvideo[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesjeuxvideo2['nbdecommentairesjeuxvideo2']; ?></span>
										<?php
										$searchmoynotejeuxvideo = $db->query('SELECT AVG(note) AS notemoyjeuxvideo FROM notesforum WHERE IDsujet =\'' . $sujetsjeuxvideo['ID'] . '\'');
										$notemoyjeuxvideo = $searchmoynotejeuxvideo->fetch();	
										if($notemoyjeuxvideo['notemoyjeuxvideo'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoyjeuxvideo['notemoyjeuxvideo'] > 0 && $notemoyjeuxvideo['notemoyjeuxvideo'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoyjeuxvideo['notemoyjeuxvideo'] >= 2 && $notemoyjeuxvideo['notemoyjeuxvideo'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoyjeuxvideo['notemoyjeuxvideo'] >= 3 && $notemoyjeuxvideo['notemoyjeuxvideo'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoyjeuxvideo['notemoyjeuxvideo'] >= 4 && $notemoyjeuxvideo['notemoyjeuxvideo'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoyjeuxvideo['notemoyjeuxvideo'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsjeuxvideo->closeCursor();
							?>
						</div>
						<div class="articleblock" id="lignemusique">
							<span class="imagearticle"><img src="images/musique.png" alt="" width="25" height="25" /></span>
							<span class="titrearticle">Musiques</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsmusique['nbdesujetsmusique']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesmusique['nbdecommentairesmusique']; ?></span>
						</div><br />
						<div class="blockligne" id="blocklignemusique">
							<?php
								$searchsujetsmusique = $db->query('SELECT * FROM forumsujets WHERE theme= \'musique\' ORDER BY ID DESC');
								
								while ($sujetsmusique = $searchsujetsmusique->fetch())
								{
									$infosujettitre2musique = html_entity_decode($sujetsmusique['titre']);
									
									if(mb_strlen($infosujettitre2musique, 'utf8') <= 25)
									{
										$arrayinfosujet2musique[0] = $infosujettitre2musique;
									}
									else
									{
										$sujettitre2musique = mb_substr($infosujettitre2musique, 0, 22, 'utf8');
										
										$arrayinfosujet2musique[0] = $sujettitre2musique . "..."; 
									}
									
									$searchnbdecommentairesmusique2 = $db->query('SELECT COUNT(*) AS nbdecommentairesmusique2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsmusique['ID'] . '\'');
									$nbdecommentairesmusique2 = $searchnbdecommentairesmusique2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsmusique['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsmusique['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2musique, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2musique[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2musique); ?>"><?php echo htmlspecialchars($arrayinfosujet2musique[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesmusique2['nbdecommentairesmusique2']; ?></span>
										<?php
										$searchmoynotemusique = $db->query('SELECT AVG(note) AS notemoymusique FROM notesforum WHERE IDsujet =\'' . $sujetsmusique['ID'] . '\'');
										$notemoymusique = $searchmoynotemusique->fetch();	
										if($notemoymusique['notemoymusique'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoymusique['notemoymusique'] > 0 && $notemoymusique['notemoymusique'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoymusique['notemoymusique'] >= 2 && $notemoymusique['notemoymusique'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoymusique['notemoymusique'] >= 3 && $notemoymusique['notemoymusique'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoymusique['notemoymusique'] >= 4 && $notemoymusique['notemoymusique'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoymusique['notemoymusique'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsmusique->closeCursor();
							?>
						</div>
						<div class="articleblock" id="ligneinformatique">
							<span class="imagearticle"><img src="images/informatique.png" alt="" width="25" height="25" /></span>
							<span class="titrearticle">Informatique</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsinformatique['nbdesujetsinformatique']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesinformatique['nbdecommentairesinformatique']; ?></span>
						</div><br />
						<div class="blockligne" id="blockligneinformatique">
							<?php
								$searchsujetsinformatique = $db->query('SELECT * FROM forumsujets WHERE theme= \'informatique\' ORDER BY ID DESC');
								
								while ($sujetsinformatique = $searchsujetsinformatique->fetch())
								{
									$infosujettitre2informatique = html_entity_decode($sujetsinformatique['titre']);
									
									if(mb_strlen($infosujettitre2informatique, 'utf8') <= 25)
									{
										$arrayinfosujet2informatique[0] = $infosujettitre2informatique;
									}
									else
									{
										$sujettitre2informatique = mb_substr($infosujettitre2informatique, 0, 22, 'utf8');
										
										$arrayinfosujet2informatique[0] = $sujettitre2informatique . "..."; 
									}
									
									$searchnbdecommentairesinformatique2 = $db->query('SELECT COUNT(*) AS nbdecommentairesinformatique2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsinformatique['ID'] . '\'');
									$nbdecommentairesinformatique2 = $searchnbdecommentairesinformatique2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsinformatique['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsinformatique['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2informatique, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2informatique[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2informatique); ?>"><?php echo htmlspecialchars($arrayinfosujet2informatique[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesinformatique2['nbdecommentairesinformatique2']; ?></span>
										<?php
										$searchmoynoteinformatique = $db->query('SELECT AVG(note) AS notemoyinformatique FROM notesforum WHERE IDsujet =\'' . $sujetsinformatique['ID'] . '\'');
										$notemoyinformatique = $searchmoynoteinformatique->fetch();	
										if($notemoyinformatique['notemoyinformatique'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoyinformatique['notemoyinformatique'] > 0 && $notemoyinformatique['notemoyinformatique'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoyinformatique['notemoyinformatique'] >= 2 && $notemoyinformatique['notemoyinformatique'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoyinformatique['notemoyinformatique'] >= 3 && $notemoyinformatique['notemoyinformatique'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoyinformatique['notemoyinformatique'] >= 4 && $notemoyinformatique['notemoyinformatique'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoyinformatique['notemoyinformatique'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsinformatique->closeCursor();
							?>
						</div>
						<div class="articleblock" id="lignejapon">
							<span class="imagearticle"><img src="images/japon.png" alt="" width="25" height="25" /></span>
							<span class="titrearticle">Japon</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsjapon['nbdesujetsjapon']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesjapon['nbdecommentairesjapon']; ?></span>
						</div><br />
						<div class="blockligne" id="blocklignejapon">
							<?php
								$searchsujetsjapon = $db->query('SELECT * FROM forumsujets WHERE theme= \'japon\' ORDER BY ID DESC');
								
								while ($sujetsjapon = $searchsujetsjapon->fetch())
								{
									$infosujettitre2japon = html_entity_decode($sujetsjapon['titre']);
									
									if(mb_strlen($infosujettitre2japon, 'utf8') <= 25)
									{
										$arrayinfosujet2japon[0] = $infosujettitre2japon;
									}
									else
									{
										$sujettitre2japon = mb_substr($infosujettitre2japon, 0, 22, 'utf8');
										
										$arrayinfosujet2japon[0] = $sujettitre2japon . "..."; 
									}
									
									$searchnbdecommentairesjapon2 = $db->query('SELECT COUNT(*) AS nbdecommentairesjapon2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsjapon['ID'] . '\'');
									$nbdecommentairesjapon2 = $searchnbdecommentairesjapon2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsjapon['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsjapon['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2japon, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2japon[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2japon); ?>"><?php echo htmlspecialchars($arrayinfosujet2japon[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesjapon2['nbdecommentairesjapon2']; ?></span>
										<?php
										$searchmoynotejapon = $db->query('SELECT AVG(note) AS notemoyjapon FROM notesforum WHERE IDsujet =\'' . $sujetsjapon['ID'] . '\'');
										$notemoyjapon = $searchmoynotejapon->fetch();	
										if($notemoyjapon['notemoyjapon'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoyjapon['notemoyjapon'] > 0 && $notemoyjapon['notemoyjapon'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoyjapon['notemoyjapon'] >= 2 && $notemoyjapon['notemoyjapon'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoyjapon['notemoyjapon'] >= 3 && $notemoyjapon['notemoyjapon'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoyjapon['notemoyjapon'] >= 4 && $notemoyjapon['notemoyjapon'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoyjapon['notemoyjapon'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsjapon->closeCursor();
							?>
						</div>
						<div class="articleblock" id="lignerien">
							<span class="imagearticle"><img src="images/rien.png" alt="" width="25" height="25" /></span>
							<span class="titrearticle">Tout sur rien</span>
							<span class="sujetsarticle"><?php echo $nbdesujetsrien['nbdesujetsrien']; ?></span>
							<span class="messagesarticle"><?php echo $nbdecommentairesrien['nbdecommentairesrien']; ?></span>
						</div><br />
						<div class="blockligne" id="blocklignerien">
							<?php
								$searchsujetsrien = $db->query('SELECT * FROM forumsujets WHERE theme= \'rien\' ORDER BY ID DESC');
								
								while ($sujetsrien = $searchsujetsrien->fetch())
								{
									$infosujettitre2rien = html_entity_decode($sujetsrien['titre']);
									
									if(mb_strlen($infosujettitre2rien, 'utf8') <= 25)
									{
										$arrayinfosujet2rien[0] = $infosujettitre2rien;
									}
									else
									{
										$sujettitre2rien = mb_substr($infosujettitre2rien, 0, 22, 'utf8');
										
										$arrayinfosujet2rien[0] = $sujettitre2rien . "..."; 
									}
									
									$searchnbdecommentairesrien2 = $db->query('SELECT COUNT(*) AS nbdecommentairesrien2 FROM commentairesforum WHERE IDsujet =\'' . $sujetsrien['ID'] . '\'');
									$nbdecommentairesrien2 = $searchnbdecommentairesrien2->fetch();
								?>
									<a href="forum.php?id=<?php echo $sujetsrien['ID'] ?>" style="text-decoration:none;" >
									<div id="lignesujets">
										<?php
										$dateforum = date("Y-m-d", strtotime($sujetsrien['date_creation']));
										$newcontenuimg = date('Y-m-d');
										
										if($dateforum >= $newcontenuimg)
										{
										?>
											<img src="images/new.png" alt="New" class="newcontenuimg2" />
										<?php
										}
										?>
										<?php
											if(mb_strlen($infosujettitre2rien, 'utf8') <= 25)
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;"><?php echo htmlspecialchars($arrayinfosujet2rien[0]); ?></span>
											<?php
											}
											else
											{
											?>
												<span class="lignesujetstitre" style="text-transform:capitalize;" title="<?php echo htmlspecialchars($infosujettitre2rien); ?>"><?php echo htmlspecialchars($arrayinfosujet2rien[0]); ?></span>
											<?php	
											}
										?>
										<span class="lignesujetsmessages"><?php echo $nbdecommentairesrien2['nbdecommentairesrien2']; ?></span>
										<?php
										$searchmoynoterien = $db->query('SELECT AVG(note) AS notemoyrien FROM notesforum WHERE IDsujet =\'' . $sujetsrien['ID'] . '\'');
										$notemoyrien = $searchmoynoterien->fetch();	
										if($notemoyrien['notemoyrien'] == 0)
										{
										?>
											<span class="lignesujetsetoile" style="color:black">★★★★★</span>
										<?php
										}
										else if($notemoyrien['notemoyrien'] > 0 && $notemoyrien['notemoyrien'] < 2)
										{
										?>
											<span class="lignesujetsetoile">★<span style="color:black;">★★★★</span></span>
										<?php
										}
										else if($notemoyrien['notemoyrien'] >= 2 && $notemoyrien['notemoyrien'] < 3)
										{
										?>
											<span class="lignesujetsetoile">★★<span style="color:black;">★★★</span></span>
										<?php
										}
										else if($notemoyrien['notemoyrien'] >= 3 && $notemoyrien['notemoyrien'] < 4)
										{
										?>
											<span class="lignesujetsetoile">★★★<span style="color:black;">★★</span></span>
										<?php
										}
										else if($notemoyrien['notemoyrien'] >= 4 && $notemoyrien['notemoyrien'] < 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★<span style="color:black;">★</span></span>
										<?php
										}
										else if($notemoyrien['notemoyrien'] >= 5)
										{
										?>
											<span class="lignesujetsetoile">★★★★★</span>
										<?php
										}
										?>
									</div><br />
									</a>
								<?php
								}
								$searchsujetsrien->closeCursor();
							?>
						</div>
					</div>
				</div>
				</section>
				
				<script>
					document.querySelector("#selectedformatligne").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#formatligne')).display=='none')
						{
							document.querySelector('#formatcube').style.display="none";
							document.querySelector('#contenu').style.background="white";
							document.querySelector('#formatligne').style.display="block";
							document.querySelector('#selectedformatligne').style.display="none";
							document.querySelector('#selectedformatcube').style.display="block";
						}
						else
						{
							document.querySelector('#contenu').style.background="rgb(40,40,40)";
							document.querySelector('#formatcube').style.display="block";
							document.querySelector('#formatligne').style.display="none";
							document.querySelector('#selectedformatligne').style.display="block";
							document.querySelector('#selectedformatcube').style.display="none";
						}
					}

					document.querySelector("#selectedformatcube").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#formatcube')).display=='none')
						{
							document.querySelector('#formatligne').style.display="none";
							document.querySelector('#contenu').style.background="rgb(40,40,40)";
							document.querySelector('#formatcube').style.display="block";
							document.querySelector('#selectedformatcube').style.display="none";
							document.querySelector('#selectedformatligne').style.display="block";
						}
						else
						{
							document.querySelector('#contenu').style.background="white";
							document.querySelector('#formatligne').style.display="block";
							document.querySelector('#formatcube').style.display="none";
							document.querySelector('#selectedformatcube').style.display="block";
							document.querySelector('#selectedformatligne').style.display="none";
						}
					}

					document.querySelector("#selectedanimemanga").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#formatcubeanimemanga')).display=='none')
						{
							document.querySelector('#formatcubemetromanga').style.display="none";
							document.querySelector('#selectedmetromanga').style.transform="none";
							document.querySelector('#selectedmetromanga').style.cursor="pointer";
							document.querySelector('#formatcubesalon').style.display="none";
							document.querySelector('#selectedsalon').style.transform="none";
							document.querySelector('#selectedsalon').style.cursor="pointer";
							document.querySelector('#formatcubeanimemanga').style.display="block";
							document.querySelector('#selectedanimemanga').style.transform="scale(1.3)";
							document.querySelector('#selectedanimemanga').style.cursor="default";
						}
						else
						{
							document.querySelector('#formatcubeanimemanga').style.display="block";
							document.querySelector('#selectedanimemanga').style.transform="scale(1.3)";
							document.querySelector('#selectedanimemanga').style.cursor="default";
							document.querySelector('#formatcubesalon').style.display="none";
							document.querySelector('#selectedsalon').style.transform="none";
							document.querySelector('#selectedsalon').style.cursor="pointer";
							document.querySelector('#formatcubemetromanga').style.display="none";
							document.querySelector('#selectedmetromanga').style.transform="none";
							document.querySelector('#selectedmetromanga').style.cursor="pointer";
						}
					}

					document.querySelector("#selectedmetromanga").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#formatcubemetromanga')).display=='none')
						{
							document.querySelector('#formatcubeanimemanga').style.display="none";
							document.querySelector('#selectedanimemanga').style.transform="none";
							document.querySelector('#selectedanimemanga').style.cursor="pointer";
							document.querySelector('#formatcubesalon').style.display="none";
							document.querySelector('#selectedsalon').style.transform="none";
							document.querySelector('#selectedsalon').style.cursor="pointer";
							document.querySelector('#formatcubemetromanga').style.display="block";
							document.querySelector('#selectedmetromanga').style.transform="scale(1.3)";
							document.querySelector('#selectedmetromanga').style.cursor="default";
						}
						else
						{
							document.querySelector('#formatcubemetromanga').style.display="block";
							document.querySelector('#selectedmetromanga').style.transform="scale(1.3)";
							document.querySelector('#selectedmetromanga').style.cursor="default";
							document.querySelector('#formatcubesalon').style.display="none";
							document.querySelector('#selectedsalon').style.transform="none";
							document.querySelector('#selectedsalon').style.cursor="pointer";
							document.querySelector('#formatcubeanimemanga').style.display="none";
							document.querySelector('#selectedanimemanga').style.transform="none";
							document.querySelector('#selectedanimemanga').style.cursor="pointer";
						}
					}

					document.querySelector("#selectedsalon").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#formatcubesalon')).display=='none')
						{
							document.querySelector('#formatcubeanimemanga').style.display="none";
							document.querySelector('#selectedanimemanga').style.transform="none";
							document.querySelector('#selectedanimemanga').style.cursor="pointer";
							document.querySelector('#formatcubemetromanga').style.display="none";
							document.querySelector('#selectedmetromanga').style.transform="none";
							document.querySelector('#selectedmetromanga').style.cursor="pointer";
							document.querySelector('#formatcubesalon').style.display="block";
							document.querySelector('#selectedsalon').style.transform="scale(1.3)";
							document.querySelector('#selectedsalon').style.cursor="default";
						}
						else
						{
							document.querySelector('#formatcubeanimemanga').style.display="none";
							document.querySelector('#selectedanimemanga').style.transform="none";
							document.querySelector('#selectedanimemanga').style.cursor="pointer";
							document.querySelector('#formatcubemetromanga').style.display="none";
							document.querySelector('#selectedmetromanga').style.transform="none";
							document.querySelector('#selectedmetromanga').style.cursor="pointer";
							document.querySelector('#formatcubesalon').style.display="block";
							document.querySelector('#selectedsalon').style.transform="scale(1.3)";
							document.querySelector('#selectedsalon').style.cursor="default";
						}
					}
					
					document.querySelector("#retour").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#retour')).display=='block')
						{
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
						}
						else
						{
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
						}
					}
					
					document.querySelector(".ajouterligne").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#ajoutersujet')).display=='none')
						{
							document.querySelector('#ajoutersujet').style.display="block";
							document.querySelector('#formatcube').style.display="none";
							document.querySelector('#formatligne').style.display="none";
							document.querySelector('#selectedformatcube').style.display="none";
							document.querySelector('#selectedformatligne').style.display="none";
						}
						else
						{
							document.querySelector('#ajoutersujet').style.display="block";
							document.querySelector('#formatcube').style.display="none";
							document.querySelector('#formatligne').style.display="none";
							document.querySelector('#selectedformatcube').style.display="none";
							document.querySelector('#selectedformatligne').style.display="none";
						}
					}
					
					document.querySelector(".ajouter").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#ajoutersujet')).display=='none')
						{
							document.querySelector('#ajoutersujet').style.display="block";
							document.querySelector('#formatcube').style.display="none";
							document.querySelector('#formatligne').style.display="none";
							document.querySelector('#selectedformatcube').style.display="none";
							document.querySelector('#selectedformatligne').style.display="none";
						}
						else
						{
							document.querySelector('#ajoutersujet').style.display="block";
							document.querySelector('#formatcube').style.display="none";
							document.querySelector('#formatligne').style.display="none";
							document.querySelector('#selectedformatcube').style.display="none";
							document.querySelector('#selectedformatligne').style.display="none";
						}
					}
					
					document.querySelector("#fermerajoutersujet").onclick = function() 
					{
						if (window.matchMedia("(max-width: 1400px) and (max-height: 899px)").matches)
						{
							if (window.getComputedStyle(document.querySelector('#ajoutersujet')).display=='block')
							{
								document.querySelector('#ajoutersujet').style.display="none";
								document.querySelector('#contenu').style.background="white";
								document.querySelector('#formatligne').style.display="block";
							}
							else
							{
								document.querySelector('#ajoutersujet').style.display="none";
								document.querySelector('#contenu').style.background="white";
								document.querySelector('#formatligne').style.display="block";
							}
						}
						else
						{
							if (window.getComputedStyle(document.querySelector('#ajoutersujet')).display=='block')
							{
								document.querySelector('#ajoutersujet').style.display="none";
								document.querySelector('#formatcube').style.display="block";
								document.querySelector('#contenu').style.background="rgb(40,40,40)";
								document.querySelector('#selectedformatligne').style.display="block";
								document.querySelector('#formatligne').style.display="none";
								document.querySelector('#selectedformatcube').style.display="none";
							}
							else
							{
								document.querySelector('#ajoutersujet').style.display="none";
								document.querySelector('#formatcube').style.display="block";
								document.querySelector('#contenu').style.background="rgb(40,40,40)";
								document.querySelector('#selectedformatligne').style.display="block";
								document.querySelector('#formatligne').style.display="none";
								document.querySelector('#selectedformatcube').style.display="none";
							}
						}
					}
					
					document.querySelector("#cubeanimes").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubeanimes')).display=='none')
						{
							document.querySelector('#contenucubeanimes').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blockligneanimes').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubeanimes').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('#ajouter').style.display="block";
							document.querySelector('#blockligneanimes').style.height="200px";
						}
					}
					
					document.querySelector("#cubemangas").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubemangas')).display=='none')
						{
							document.querySelector('#contenucubemangas').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignemangas').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubemangas').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignemangas').style.height="200px";
						}
					}
					
					document.querySelector("#cubescans").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubescans')).display=='none')
						{
							document.querySelector('#contenucubescans').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignescans').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubescans').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignescans').style.height="200px";
						}
					}
					
					document.querySelector("#cubejapanimation").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubejapanimation')).display=='none')
						{
							document.querySelector('#contenucubejapanimation').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignejapanimation').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubejapanimation').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignejapanimation').style.height="200px";
						}
					}
					
					document.querySelector("#cubequeregarder").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubequeregarder')).display=='none')
						{
							document.querySelector('#contenucubequeregarder').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignequeregarder').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubequeregarder').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignequeregarder').style.height="200px";
						}
					}
					
					document.querySelector("#cubereglement").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubereglement')).display=='none')
						{
							document.querySelector('#contenucubereglement').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignereglement').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubereglement').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignereglement').style.height="200px";
						}
					}
					
					document.querySelector("#cubenewsmetromanga").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubenewsmetromanga')).display=='none')
						{
							document.querySelector('#contenucubenewsmetromanga').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignenewsmetromanga').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubenewsmetromanga').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignenewsmetromanga').style.height="200px";
						}
					}
					
					document.querySelector("#cubeevenements").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubeevenements')).display=='none')
						{
							document.querySelector('#contenucubeevenements').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blockligneevenements').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubeevenements').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blockligneevenements').style.height="200px";
						}
					}
					
					document.querySelector("#cubebugs").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubebugs')).display=='none')
						{
							document.querySelector('#contenucubebugs').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignebugs').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubebugs').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignebugs').style.height="200px";
						}
					}
					
					document.querySelector("#cubeactualite").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubeactualite')).display=='none')
						{
							document.querySelector('#contenucubeactualite').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blockligneactualite').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubeactualite').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blockligneactualite').style.height="200px";
						}
					}
					
					document.querySelector("#cubeaudiovisuel").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubeaudiovisuel')).display=='none')
						{
							document.querySelector('#contenucubeaudiovisuel').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blockligneaudiovisuel').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubeaudiovisuel').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blockligneaudiovisuel').style.height="200px";
						}
					}
					
					document.querySelector("#cubejeuxvideo").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubejeuxvideo')).display=='none')
						{
							document.querySelector('#contenucubejeuxvideo').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignejeuxvideo').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubejeuxvideo').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignejeuxvideo').style.height="200px";
						}
					}
					
					document.querySelector("#cubemusique").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubemusique')).display=='none')
						{
							document.querySelector('#contenucubemusique').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignemusique').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubemusique').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignemusique').style.height="200px";
						}
					}
					
					document.querySelector("#cubeinformatique").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubeinformatique')).display=='none')
						{
							document.querySelector('#contenucubeinformatique').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blockligneinformatique').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubeinformatique').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blockligneinformatique').style.height="200px";
						}
					}
					
					document.querySelector("#cubejapon").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucubejapon')).display=='none')
						{
							document.querySelector('#contenucubejapon').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignejapon').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucubejapon').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignejapon').style.height="200px";
						}
					}
					
					document.querySelector("#cuberien").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#contenucuberien')).display=='none')
						{
							document.querySelector('#contenucuberien').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignerien').style.height="200px";
						}
						else
						{
							document.querySelector('#contenucuberien').style.display="block";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#blocklignerien').style.height="200px";
						}
					}
					
					document.querySelector("#lignereglement").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blocklignereglement')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="200px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="block";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#lignenewsmetromanga").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blocklignenewsmetromanga')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="200px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="block";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#ligneevenements").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blockligneevenements')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="200px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="block";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}	
					
					document.querySelector("#lignebugs").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blocklignebugs')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="200px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="block";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#ligneanimes").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blockligneanimes')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="200px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="block";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#lignemangas").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blocklignemangas')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="200px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="block";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#lignescans").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blocklignescans')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="200px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="block";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#lignejapanimation").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blocklignejapanimation')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="200px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="block";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#lignequeregarder").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blocklignequeregarder')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="200px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="block";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#ligneactualite").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blockligneactualite')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="200px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="block";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#ligneaudiovisuel").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blockligneaudiovisuel')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="200px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="block";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#lignejeuxvideo").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blocklignejeuxvideo')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="200px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="block";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#lignemusique").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blocklignemusique')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="200px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="block";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#ligneinformatique").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blockligneinformatique')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="200px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="block";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#lignejapon").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blocklignejapon')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="200px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="block";
							document.querySelector('#contenucuberien').style.display="none";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
					document.querySelector("#lignerien").onclick = function() 
					{ 
						if (window.getComputedStyle(document.querySelector('#blocklignerien')).height=='0px')
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="200px";
							document.querySelector('#selecteformatcube').style.display="none";
							document.querySelector('#retour').style.display="block";
							document.querySelector('.ajouter').style.display="block";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="block";
						}
						else
						{
							document.querySelector('#blocklignereglement').style.height="0px";
							document.querySelector('#blocklignenewsmetromanga').style.height="0px";
							document.querySelector('#blockligneevenements').style.height="0px";
							document.querySelector('#blocklignebugs').style.height="0px";
							document.querySelector('#blockligneanimes').style.height="0px";
							document.querySelector('#blocklignemangas').style.height="0px";
							document.querySelector('#blocklignescans').style.height="0px";
							document.querySelector('#blocklignejapanimation').style.height="0px";
							document.querySelector('#blocklignequeregarder').style.height="0px";
							document.querySelector('#blockligneactualite').style.height="0px";
							document.querySelector('#blockligneaudiovisuel').style.height="0px";
							document.querySelector('#blocklignejeuxvideo').style.height="0px";
							document.querySelector('#blocklignemusique').style.height="0px";
							document.querySelector('#blockligneinformatique').style.height="0px";
							document.querySelector('#blocklignejapon').style.height="0px";
							document.querySelector('#blocklignerien').style.height="0px";
							document.querySelector('#selecteformatcube').style.display="block";
							document.querySelector('#retour').style.display="none";
							document.querySelector('.ajouter').style.display="none";
							document.querySelector('#contenucubeanimes').style.display="none";
							document.querySelector('#contenucubemangas').style.display="none";
							document.querySelector('#contenucubescans').style.display="none";
							document.querySelector('#contenucubejapanimation').style.display="none";
							document.querySelector('#contenucubequeregarder').style.display="none";
							document.querySelector('#contenucubereglement').style.display="none";
							document.querySelector('#contenucubenewsmetromanga').style.display="none";
							document.querySelector('#contenucubeevenements').style.display="none";
							document.querySelector('#contenucubebugs').style.display="none";
							document.querySelector('#contenucubeactualite').style.display="none";
							document.querySelector('#contenucubeaudiovisuel').style.display="none";
							document.querySelector('#contenucubejeuxvideo').style.display="none";
							document.querySelector('#contenucubemusique').style.display="none";
							document.querySelector('#contenucubeinformatique').style.display="none";
							document.querySelector('#contenucubejapon').style.display="none";
							document.querySelector('#contenucuberien').style.display="none";
						}
					}
					
				</script>
			<?php
			}
			?>
		</div>
		<?php include("includes/footer.php"); ?>
	</div>
	</body>
</html>