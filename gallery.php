<?php session_start(); ?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<link rel="stylesheet" href="gallery.css" />
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
					$(".divajoutergallery").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".divmodifiergallery").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".divfiltrer").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".contenueimage").mCustomScrollbar({
						theme:"inset-3"
					});
					$(".contenuetextepublicationtexte").mCustomScrollbar({
						theme:"inset-3"
					});
				});
			})(jQuery);
		</script>
		
		<title>Gallery - Metro Manga </title>
	</head>
	<body id="body">
	<div id="body2">
		<?php include("includes/loading.php"); ?>
		<?php include("includes/header.php"); ?>
		<div id="contenuloading">
		<div class="divajoutergallery">
			<?php
			if(isset($_GET['update']))
			{
				$searchgalleryid = $db->query('SELECT ID FROM gallery WHERE ID =\'' . $_GET['update'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
				$searchgalleryidexist = $searchgalleryid->rowCount();
				if($searchgalleryidexist == 0 OR !isset($_SESSION['ID']))
				{
				?>
					<img src="images/fontmetromanga.png" alt="ERROR 404" title="ERROR 404" width="100%" height="100%" />
					<script>
						window.setTimeout("location=('gallery.php');",0);
					</script>
				<?php
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						$selectinfogallery = $db->query('SELECT * FROM gallery WHERE ID=\'' . $_GET['update'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
						$infogallery = $selectinfogallery->fetch();
					?>
					<div class="divmodifiergallery">
						<style>
							.divajoutergallery
							{
								display: block;
								opacity: 1;
							}
							.divfiltrer
							{
								display: none;
								height: 0px;
							}
						</style>
						<a href="profil.php"><img src="images/fermer.png" alt="Annuler" class="closeajoutergallery" /></a>
						<div class="contenuajouterimage">
							<span class="titreajouterimage" >Modification d'une image</span>
							<hr class="hrajouterimage" />
						</div>
						
						<label class="titresujetajoutersujet">Thème</label>
						<input type="text" autocomplete="off" class="contenutitreajoutersujet" id="modifierimagetheme" placeholder="Anime,Art..." value="<?php echo $infogallery['theme']; ?>" style="text-transform:capitalize;" maxlength="100" minlength="1" required />
						<br />
						<?php
							if($infogallery['tag1'] != NULL OR $infogallery['tag1'] != "NULL")
							{
							?>
								<label class="titresujetajoutersujet" id="ajouterimagetag1" >Tag 1</label>
								<input type="text" autocomplete="off" class="contenutitreajoutersujet" id="modifierimagetag1" placeholder="Tag 1" value="<?php echo $infogallery['tag1']; ?>" style="text-transform:capitalize;" maxlength="100" minlength="1" />
								<br />
							<?php
							}
							else
							{
							?>
								<label class="titresujetajoutersujet"  id="ajouterimagetag1" >Tag 1</label>
								<input type="text" autocomplete="off" class="contenutitreajoutersujet" id="modifierimagetag1" placeholder="Tag 1" style="text-transform:capitalize;" maxlength="100" minlength="1" />
								<br />
							<?php
							}
							
							if($infogallery['tag2'] != NULL OR $infogallery['tag2'] != "NULL")
							{
							?>
								<div id="divajoutertag2" style="margin-left:0.4%;">
									<label class="titresujetajoutersujet">Tag 2</label>
									<input type="text" autocomplete="off" class="contenutitreajoutersujet" id="modifierimagetag2" placeholder="Tag 2" style="text-transform:capitalize;" value="<?php echo $infogallery['tag2']; ?>" maxlength="100" minlength="1" />
									<br />
								</div>
							<?php
							}
							else
							{
							?>
								<div id="divajoutertag2" style="margin-left:0.4%;">
									<label class="titresujetajoutersujet">Tag 2</label>
									<input type="text" autocomplete="off" class="contenutitreajoutersujet" id="modifierimagetag2" placeholder="Tag 2" style="text-transform:capitalize;" maxlength="100" minlength="1" />
									<br />
								</div>
							<?php
							}
							
							if($infogallery['tag3'] != NULL OR $infogallery['tag3'] != "NULL")
							{
							?>
								<div id="divajoutertag3" style="margin-left:0.4%;">
									<label class="titresujetajoutersujet">Tag 3</label>
									<input type="text" autocomplete="off" class="contenutitreajoutersujet" id="modifierimagetag3" placeholder="Tag 3" style="text-transform:capitalize;" value="<?php echo $infogallery['tag3']; ?>" maxlength="100" minlength="1" />
									<br />
								</div>
							<?php
							}
							else
							{
							?>
								<div id="divajoutertag3" style="margin-left:0.4%;">
									<label class="titresujetajoutersujet">Tag 3</label>
									<input type="text" autocomplete="off" class="contenutitreajoutersujet" id="modifierimagetag3" placeholder="Tag 3" style="text-transform:capitalize;" maxlength="100" minlength="1" />
									<br />
								</div>
							<?php
							}
							
							if($infogallery['tag4'] != NULL OR $infogallery['tag4'] != "NULL")
							{
							?>
								<div id="divajoutertag4" style="margin-left:0.4%;">
									<label class="titresujetajoutersujet">Tag 4</label>
									<input type="text" autocomplete="off" class="contenutitreajoutersujet" id="modifierimagetag4" placeholder="Tag 4" style="text-transform:capitalize;" value="<?php echo $infogallery['tag4']; ?>" maxlength="100" minlength="1" />
								</div>
							<?php
							}
							else
							{
							?>
								<div id="divajoutertag4" style="margin-left:0.4%;">
									<label class="titresujetajoutersujet">Tag 4</label>
									<input type="text" autocomplete="off" class="contenutitreajoutersujet" id="modifierimagetag4" placeholder="Tag 4" style="text-transform:capitalize;" maxlength="100" minlength="1" />
								</div>
							<?php
							}
							
							if($infogallery['contenu'] != NULL OR $infogallery['contenu'] != "NULL")
							{
							?>
								<textarea type="text" class="ajouterimagetext" id="modifierimagetext" maxlength="5000" minlength="1" placeholder="Ajouter une légende..." ><?php echo $infogallery['contenu']; ?></textarea>
							<?php
							}
							else
							{
							?>
								<textarea type="text" class="ajouterimagetext" id="modifierimagetext" maxlength="5000" minlength="1" placeholder="Ajouter une légende..." ></textarea>
							<?php
							}
							
						?>
						<p style="opacity:0;">none</p>
						<p style="opacity:0;">none</p>
						<p style="opacity:0;">none</p>
						<p style="opacity:0;">none</p>
						<p style="opacity:0;">none</p>
						<p id="confirmvaliderajoutergallery" style="opacity:0;">none</p>
						<input type="submit" value="Valider" class="validerajoutersujet" id="validermodifiergallery" onclick="validermodifiergallery()" style="outline:none;margin-top: 37.5%;" />
					</div>
						
						<script>
						
							function validermodifiergallery()
							{
								var xhr = new XMLHttpRequest();
								var theme = document.querySelector('#modifierimagetheme').value;
								var tag1 = document.querySelector('#modifierimagetag1').value;
								var tag2 = document.querySelector('#modifierimagetag2').value;
								var tag3 = document.querySelector('#modifierimagetag3').value;
								var tag4 = document.querySelector('#modifierimagetag4').value;
								var contenu = document.querySelector('#modifierimagetext').value;
								
								var theme = encodeURIComponent(theme);
								var tag1 = encodeURIComponent(tag1);
								var tag2 = encodeURIComponent(tag2);
								var tag3 = encodeURIComponent(tag3);
								var tag4 = encodeURIComponent(tag4);
								var contenu = encodeURIComponent(contenu);
								
								xhr.open('POST', 'site/phpgallery.php');
								xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
								xhr.send('IDimggallery=<?php echo $_GET['update']; ?>&theme=' + theme + '&tag1=' + tag1 + '&tag2=' + tag2 + '&tag3=' + tag3 + '&tag4=' + tag4 	+ '&contenu=' + contenu);
								
								xhr.onreadystatechange = function() 
								{
									if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
									{
										document.querySelector('#confirmvaliderajoutergallery').innerHTML = xhr.responseText;
										confirmvalidermodifiergallery();
									}
								};
								
								xhr.send(null);
							}
							
							function confirmvalidermodifiergallery()
							{
								if(document.querySelector('#confirmvaliderajoutergallery').innerHTML == "OK")
								{
									window.setTimeout("location=('gallery.php?image=<?php echo $_GET['update']; ?>');",0);
								}
							}
							
						</script>

					<?php
					}
				}
			}
			else if(isset($_SESSION['ID']))
			{
				if(isset($_POST['validerajoutersujet']))
				{
					$IDmembre = $_SESSION['ID'];
					$theme = htmlspecialchars($_POST['ajouterimagetheme']);
					$theme = ucwords($theme);
					$tag1 = htmlspecialchars($_POST['ajouterimagetag1']);
					$tag1 = ucwords($tag1);
					$tag2 = htmlspecialchars($_POST['ajouterimagetag2']);
					$tag2 = ucwords($tag2);
					$tag3 = htmlspecialchars($_POST['ajouterimagetag3']);
					$tag3 = ucwords($tag3);
					$tag4 = htmlspecialchars($_POST['ajouterimagetag4']);
					$tag4 = ucwords($tag4);
					$legende = htmlspecialchars($_POST['ajouterimagetext']);
					
					if(strlen($theme) >= 1 AND strlen($theme) <= 100)
					{
						if(strlen($tag1) >= 1 AND strlen($tag1) <= 100)
						{
							if(strlen($tag2) >= 1 AND strlen($tag2) <= 100)
							{
								if(strlen($tag3) >= 1 AND strlen($tag3) <= 100)
								{				
									if(strlen($tag4) >= 1 AND strlen($tag4) <= 100)
									{	
										if(strlen($legende) >= 1 AND strlen($legende) <= 5000)
										{
											if(($theme != $tag1) AND ($theme != $tag2) AND ($theme != $tag3) AND ($theme != $tag4))
											{
												if(($tag1 != $tag2) AND ($tag1 != $tag3) AND ($tag1 != $tag4))
												{
													if(($tag2 != $tag3) AND ($tag2 != $tag4))
													{
														if($tag3 != $tag4)
														{
															if(isset($_FILES['ajouterimage']) AND !empty($_FILES['ajouterimage']['name']))
															{
																$taille = $_FILES['ajouterimage']['size'];
																if($taille <= 5097152)
																{
																	$selectlastID = $db->query('SELECT ID FROM gallery ORDER BY ID DESC LIMIT 1');
																	$lastID = $selectlastID->fetch();
																	
																	$extension = strtolower(substr(strrchr($_FILES['ajouterimage']['name'], '.'),1));
																	$perm_ext = array('jpg','jpeg','png');
																	$nomimage = $lastID['ID'].$_SESSION['ID'].".".$extension;
																	if(in_array($extension,$perm_ext))
																	{
																		$chemin = "gallery/".$lastID['ID'].$_SESSION['ID'].".".$extension;
																		move_uploaded_file($_FILES['ajouterimage']['tmp_name'],$chemin);
																		
																		$newimage = $db->prepare('INSERT INTO gallery(IDmembre,image,theme,tag1,tag2,tag3,tag4,contenu,date) VALUES (:IDmembre,:image,:theme,:tag1,:tag2,:tag3,:tag4,:contenu,NOW())');
																		$newimage->execute(array(
																		'IDmembre' => $IDmembre,
																		'image' => $nomimage,
																		'theme' => $theme,
																		'tag1' => $tag1,
																		'tag2' => $tag2,
																		'tag3' => $tag3,
																		'tag4' => $tag4,
																		'contenu' => $legende
																		));
																	}
																	else
																	{
																	?>
																		<style>
																			.divajoutergallery
																			{
																				display: block;
																				opacity: 1;
																			}
																			.divfiltrer
																			{
																				display: none;
																				height: 0px;
																			}
																		</style>
																	<?php
																	}
																}
																else
																{
																?>
																	<style>
																		.divajoutergallery
																		{
																			display: block;
																			opacity: 1;
																		}
																		.divfiltrer
																		{
																			display: none;
																			height: 0px;
																		}
																	</style>
																<?php
																}
															}
															else
															{
															?>
																<style>
																	.divajoutergallery
																	{
																		display: block;
																		opacity: 1;
																	}
																	.divfiltrer
																	{
																		display: none;
																		height: 0px;
																	}
																</style>
															<?php
															}
														}
														else
														{
														?>
															<style>
																.divajoutergallery
																{
																	display: block;
																	opacity: 1;
																}
																.divfiltrer
																{
																	display: none;
																	height: 0px;
																}
															</style>
														<?php
														}
													}
													else
													{
													?>
														<style>
															.divajoutergallery
															{
																display: block;
																opacity: 1;
															}
															.divfiltrer
															{
																display: none;
																height: 0px;
															}
														</style>
													<?php
													}
												}
												else
												{
												?>
													<style>
														.divajoutergallery
														{
															display: block;
															opacity: 1;
														}
														.divfiltrer
														{
															display: none;
															height: 0px;
														}
													</style>
												<?php
												}
											}
											else
											{
											?>
												<style>
													.divajoutergallery
													{
														display: block;
														opacity: 1;
													}
													.divfiltrer
													{
														display: none;
														height: 0px;
													}
												</style>
											<?php
											}
										}
										else
										{
											if(($theme != $tag1) AND ($theme != $tag2) AND ($theme != $tag3) AND ($theme != $tag4))
											{
												if(($tag1 != $tag2) AND ($tag1 != $tag3) AND ($tag1 != $tag4))
												{
													if(($tag2 != $tag3) AND ($tag2 != $tag4))
													{
														if($tag3 != $tag4)
														{
															if(isset($_FILES['ajouterimage']) AND !empty($_FILES['ajouterimage']['name']))
															{
																$taille = $_FILES['ajouterimage']['size'];
																if($taille <= 5097152)
																{
																	$selectlastID = $db->query('SELECT ID FROM gallery ORDER BY ID DESC LIMIT 1');
																	$lastID = $selectlastID->fetch();
																	
																	$extension = strtolower(substr(strrchr($_FILES['ajouterimage']['name'], '.'),1));
																	$perm_ext = array('jpg','jpeg','png');
																	$nomimage = $lastID['ID'].$_SESSION['ID'].".".$extension;
																	if(in_array($extension,$perm_ext))
																	{
																		$chemin = "gallery/".$lastID['ID'].$_SESSION['ID'].".".$extension;
																		move_uploaded_file($_FILES['ajouterimage']['tmp_name'],$chemin);
																		
																		$newimage = $db->prepare('INSERT INTO gallery(IDmembre,image,theme,tag1,tag2,tag3,tag4,date) VALUES (:IDmembre,:image,:theme,:tag1,:tag2,:tag3,:tag4,NOW())');
																		$newimage->execute(array(
																		'IDmembre' => $IDmembre,
																		'image' => $nomimage,
																		'theme' => $theme,
																		'tag1' => $tag1,
																		'tag2' => $tag2,
																		'tag3' => $tag3,
																		'tag4' => $tag4
																		));
																	}
																	else
																	{
																	?>
																		<style>
																			.divajoutergallery
																			{
																				display: block;
																				opacity: 1;
																			}
																			.divfiltrer
																			{
																				display: none;
																				height: 0px;
																			}
																		</style>
																	<?php
																	}
																}
																else
																{
																?>
																	<style>
																		.divajoutergallery
																		{
																			display: block;
																			opacity: 1;
																		}
																		.divfiltrer
																		{
																			display: none;
																			height: 0px;
																		}
																	</style>
																<?php
																}
															}
															else
															{
															?>
																<style>
																	.divajoutergallery
																	{
																		display: block;
																		opacity: 1;
																	}
																	.divfiltrer
																	{
																		display: none;
																		height: 0px;
																	}
																</style>
															<?php
															}
														}
														else
														{
														?>
															<style>
																.divajoutergallery
																{
																	display: block;
																	opacity: 1;
																}
																.divfiltrer
																{
																	display: none;
																	height: 0px;
																}
															</style>
														<?php
														}
													}
													else
													{
													?>
														<style>
															.divajoutergallery
															{
																display: block;
																opacity: 1;
															}
															.divfiltrer
															{
																display: none;
																height: 0px;
															}
														</style>
													<?php
													}
												}
												else
												{
												?>
													<style>
														.divajoutergallery
														{
															display: block;
															opacity: 1;
														}
														.divfiltrer
														{
															display: none;
															height: 0px;
														}
													</style>
												<?php
												}
											}
											else
											{
											?>
												<style>
													.divajoutergallery
													{
														display: block;
														opacity: 1;
													}
													.divfiltrer
													{
														display: none;
														height: 0px;
													}
												</style>
											<?php
											}
										}
									}
									else
									{
										if(strlen($legende) >= 1 AND strlen($legende) <= 5000)
										{
											if(($theme != $tag1) AND ($theme != $tag2) AND ($theme != $tag3))
											{
												if(($tag1 != $tag2) AND ($tag1 != $tag3))
												{	
													if($tag2 != $tag3)
													{
														if(isset($_FILES['ajouterimage']) AND !empty($_FILES['ajouterimage']['name']))
														{
															$taille = $_FILES['ajouterimage']['size'];
															if($taille <= 5097152)
															{
																$selectlastID = $db->query('SELECT ID FROM gallery ORDER BY ID DESC LIMIT 1');
																$lastID = $selectlastID->fetch();
																
																$extension = strtolower(substr(strrchr($_FILES['ajouterimage']['name'], '.'),1));
																$perm_ext = array('jpg','jpeg','png');
																$nomimage = $lastID['ID'].$_SESSION['ID'].".".$extension;
																if(in_array($extension,$perm_ext))
																{
																	$chemin = "gallery/".$lastID['ID'].$_SESSION['ID'].".".$extension;
																	move_uploaded_file($_FILES['ajouterimage']['tmp_name'],$chemin);
																	
																	$newimage = $db->prepare('INSERT INTO gallery(IDmembre,image,theme,tag1,tag2,tag3,contenu,date) VALUES (:IDmembre,:image,:theme,:tag1,:tag2,:tag3,:contenu,NOW())');
																	$newimage->execute(array(
																	'IDmembre' => $IDmembre,
																	'image' => $nomimage,
																	'theme' => $theme,
																	'tag1' => $tag1,
																	'tag2' => $tag2,
																	'tag3' => $tag3,
																	'contenu' => $legende
																	));
																}
																else
																{
																?>
																	<style>
																		.divajoutergallery
																		{
																			display: block;
																			opacity: 1;
																		}
																		.divfiltrer
																		{
																			display: none;
																			height: 0px;
																		}
																	</style>
																<?php
																}
															}
															else
															{
															?>
																<style>
																	.divajoutergallery
																	{
																		display: block;
																		opacity: 1;
																	}
																	.divfiltrer
																	{
																		display: none;
																		height: 0px;
																	}
																</style>
															<?php
															}
														}
														else
														{
														?>
															<style>
																.divajoutergallery
																{
																	display: block;
																	opacity: 1;
																}
																.divfiltrer
																{
																	display: none;
																	height: 0px;
																}
															</style>
														<?php
														}
													}
													else
													{
													?>
														<style>
															.divajoutergallery
															{
																display: block;
																opacity: 1;
															}
															.divfiltrer
															{
																display: none;
																height: 0px;
															}
														</style>
													<?php
													}
												}
												else
												{
												?>
													<style>
														.divajoutergallery
														{
															display: block;
															opacity: 1;
														}
														.divfiltrer
														{
															display: none;
															height: 0px;
														}
													</style>
												<?php
												}
											}
											else
											{
											?>
												<style>
													.divajoutergallery
													{
														display: block;
														opacity: 1;
													}
													.divfiltrer
													{
														display: none;
														height: 0px;
													}
												</style>
											<?php
											}
										}
										else
										{
											if(($theme != $tag1) AND ($theme != $tag2) AND ($theme != $tag3))
											{
												if(($tag1 != $tag2) AND ($tag1 != $tag3))
												{	
													if($tag2 != $tag3)
													{
														if(isset($_FILES['ajouterimage']) AND !empty($_FILES['ajouterimage']['name']))
														{
															$taille = $_FILES['ajouterimage']['size'];
															if($taille <= 5097152)
															{
																$selectlastID = $db->query('SELECT ID FROM gallery ORDER BY ID DESC LIMIT 1');
																$lastID = $selectlastID->fetch();
																
																$extension = strtolower(substr(strrchr($_FILES['ajouterimage']['name'], '.'),1));
																$perm_ext = array('jpg','jpeg','png');
																$nomimage = $lastID['ID'].$_SESSION['ID'].".".$extension;
																if(in_array($extension,$perm_ext))
																{
																	$chemin = "gallery/".$lastID['ID'].$_SESSION['ID'].".".$extension;
																	move_uploaded_file($_FILES['ajouterimage']['tmp_name'],$chemin);
																	
																	$newimage = $db->prepare('INSERT INTO gallery(IDmembre,image,theme,tag1,tag2,tag3,date) VALUES (:IDmembre,:image,:theme,:tag1,:tag2,:tag3,NOW())');
																	$newimage->execute(array(
																	'IDmembre' => $IDmembre,
																	'image' => $nomimage,
																	'theme' => $theme,
																	'tag1' => $tag1,
																	'tag2' => $tag2,
																	'tag3' => $tag3
																	));
																}
																else
																{
																?>
																	<style>
																		.divajoutergallery
																		{
																			display: block;
																			opacity: 1;
																		}
																		.divfiltrer
																		{
																			display: none;
																			height: 0px;
																		}
																	</style>
																<?php
																}
															}
															else
															{
															?>
																<style>
																	.divajoutergallery
																	{
																		display: block;
																		opacity: 1;
																	}
																	.divfiltrer
																	{
																		display: none;
																		height: 0px;
																	}
																</style>
															<?php
															}
														}
														else
														{
														?>
															<style>
																.divajoutergallery
																{
																	display: block;
																	opacity: 1;
																}
																.divfiltrer
																{
																	display: none;
																	height: 0px;
																}
															</style>
														<?php
														}
													}
													else
													{
													?>
														<style>
															.divajoutergallery
															{
																display: block;
																opacity: 1;
															}
															.divfiltrer
															{
																display: none;
																height: 0px;
															}
														</style>
													<?php
													}
												}
												else
												{
												?>
													<style>
														.divajoutergallery
														{
															display: block;
															opacity: 1;
														}
														.divfiltrer
														{
															display: none;
															height: 0px;
														}
													</style>
												<?php
												}
											}
											else
											{
											?>
												<style>
													.divajoutergallery
													{
														display: block;
														opacity: 1;
													}
													.divfiltrer
													{
														display: none;
														height: 0px;
													}
												</style>
											<?php
											}
										}
									}
								}
								else
								{
									if(strlen($legende) >= 1 AND strlen($legende) <= 5000)
									{
										if(($theme != $tag1) AND ($theme != $tag2))
										{
											if($tag1 != $tag2)
											{
												if(isset($_FILES['ajouterimage']) AND !empty($_FILES['ajouterimage']['name']))
												{
													$taille = $_FILES['ajouterimage']['size'];
													if($taille <= 5097152)
													{
														$selectlastID = $db->query('SELECT ID FROM gallery ORDER BY ID DESC LIMIT 1');
														$lastID = $selectlastID->fetch();
														
														$extension = strtolower(substr(strrchr($_FILES['ajouterimage']['name'], '.'),1));
														$perm_ext = array('jpg','jpeg','png');
														$nomimage = $lastID['ID'].$_SESSION['ID'].".".$extension;
														if(in_array($extension,$perm_ext))
														{
															$chemin = "gallery/".$lastID['ID'].$_SESSION['ID'].".".$extension;
															move_uploaded_file($_FILES['ajouterimage']['tmp_name'],$chemin);
															
															$newimage = $db->prepare('INSERT INTO gallery(IDmembre,image,theme,tag1,tag2,contenu,date) VALUES (:IDmembre,:image,:theme,:tag1,:tag2,:contenu,NOW())');
															$newimage->execute(array(
															'IDmembre' => $IDmembre,
															'image' => $nomimage,
															'theme' => $theme,
															'tag1' => $tag1,
															'tag2' => $tag2,
															'contenu' => $legende
															));
														}
														else
														{
														?>
															<style>
																.divajoutergallery
																{
																	display: block;
																	opacity: 1;
																}
																.divfiltrer
																{
																	display: none;
																	height: 0px;
																}
															</style>
														<?php
														}
													}
													else
													{
													?>
														<style>
															.divajoutergallery
															{
																display: block;
																opacity: 1;
															}
															.divfiltrer
															{
																display: none;
																height: 0px;
															}
														</style>
													<?php
													}
												}
												else
												{
												?>
													<style>
														.divajoutergallery
														{
															display: block;
															opacity: 1;
														}
														.divfiltrer
														{
															display: none;
															height: 0px;
														}
													</style>
												<?php
												}
											}
											else
											{
											?>
												<style>
													.divajoutergallery
													{
														display: block;
														opacity: 1;
													}
													.divfiltrer
													{
														display: none;
														height: 0px;
													}
												</style>
											<?php
											}
										}
									}
									else
									{
										if(($theme != $tag1) AND ($theme != $tag2))
										{
											if($tag1 != $tag2)
											{
												if(isset($_FILES['ajouterimage']) AND !empty($_FILES['ajouterimage']['name']))
												{
													$taille = $_FILES['ajouterimage']['size'];
													if($taille <= 5097152)
													{
														$selectlastID = $db->query('SELECT ID FROM gallery ORDER BY ID DESC LIMIT 1');
														$lastID = $selectlastID->fetch();
														
														$extension = strtolower(substr(strrchr($_FILES['ajouterimage']['name'], '.'),1));
														$perm_ext = array('jpg','jpeg','png');
														$nomimage = $lastID['ID'].$_SESSION['ID'].".".$extension;
														if(in_array($extension,$perm_ext))
														{
															$chemin = "gallery/".$lastID['ID'].$_SESSION['ID'].".".$extension;
															move_uploaded_file($_FILES['ajouterimage']['tmp_name'],$chemin);
															
															$newimage = $db->prepare('INSERT INTO gallery(IDmembre,image,theme,tag1,tag2,date) VALUES (:IDmembre,:image,:theme,:tag1,:tag2,NOW())');
															$newimage->execute(array(
															'IDmembre' => $IDmembre,
															'image' => $nomimage,
															'theme' => $theme,
															'tag1' => $tag1,
															'tag2' => $tag2
															));
														}
														else
														{
														?>
															<style>
																.divajoutergallery
																{
																	display: block;
																	opacity: 1;
																}
																.divfiltrer
																{
																	display: none;
																	height: 0px;
																}
															</style>
														<?php
														}
													}
													else
													{
													?>
														<style>
															.divajoutergallery
															{
																display: block;
																opacity: 1;
															}
															.divfiltrer
															{
																display: none;
																height: 0px;
															}
														</style>
													<?php
													}
												}
												else
												{
												?>
													<style>
														.divajoutergallery
														{
															display: block;
															opacity: 1;
														}
														.divfiltrer
														{
															display: none;
															height: 0px;
														}
													</style>
												<?php
												}
											}
											else
											{
											?>
												<style>
													.divajoutergallery
													{
														display: block;
														opacity: 1;
													}
													.divfiltrer
													{
														display: none;
														height: 0px;
													}
												</style>
											<?php
											}
										}
									}
								}
							}
							else
							{
								if(strlen($legende) >= 1 AND strlen($legende) <= 5000)
								{
									if($theme != $tag1)
									{
										if(isset($_FILES['ajouterimage']) AND !empty($_FILES['ajouterimage']['name']))
										{
											$taille = $_FILES['ajouterimage']['size'];
											if($taille <= 5097152)
											{
												$selectlastID = $db->query('SELECT ID FROM gallery ORDER BY ID DESC LIMIT 1');
												$lastID = $selectlastID->fetch();
												
												$extension = strtolower(substr(strrchr($_FILES['ajouterimage']['name'], '.'),1));
												$perm_ext = array('jpg','jpeg','png');
												$nomimage = $lastID['ID'].$_SESSION['ID'].".".$extension;
												if(in_array($extension,$perm_ext))
												{
													$chemin = "gallery/".$lastID['ID'].$_SESSION['ID'].".".$extension;
													move_uploaded_file($_FILES['ajouterimage']['tmp_name'],$chemin);
													
													$newimage = $db->prepare('INSERT INTO gallery(IDmembre,image,theme,tag1,contenu,date) VALUES (:IDmembre,:image,:theme,:tag1,:contenu,NOW())');
													$newimage->execute(array(
													'IDmembre' => $IDmembre,
													'image' => $nomimage,
													'theme' => $theme,
													'tag1' => $tag1,
													'contenu' => $legende
													));
												}
												else
												{
												?>
													<style>
														.divajoutergallery
														{
															display: block;
															opacity: 1;
														}
														.divfiltrer
														{
															display: none;
															height: 0px;
														}
													</style>
												<?php
												}
											}
											else
											{
											?>
												<style>
													.divajoutergallery
													{
														display: block;
														opacity: 1;
													}
													.divfiltrer
													{
														display: none;
														height: 0px;
													}
												</style>
											<?php
											}
										}
										else
										{
										?>
											<style>
												.divajoutergallery
												{
													display: block;
													opacity: 1;
												}
												.divfiltrer
												{
													display: none;
													height: 0px;
												}
											</style>
										<?php
										}
									}
									else
									{
									?>
										<style>
											.divajoutergallery
											{
												display: block;
												opacity: 1;
											}
											.divfiltrer
											{
												display: none;
												height: 0px;
											}
										</style>
									<?php
									}
								}
								else
								{
									if($theme != $tag1)
									{
										if(isset($_FILES['ajouterimage']) AND !empty($_FILES['ajouterimage']['name']))
										{
											$taille = $_FILES['ajouterimage']['size'];
											if($taille <= 5097152)
											{
												$selectlastID = $db->query('SELECT ID FROM gallery ORDER BY ID DESC LIMIT 1');
												$lastID = $selectlastID->fetch();
												
												$extension = strtolower(substr(strrchr($_FILES['ajouterimage']['name'], '.'),1));
												$perm_ext = array('jpg','jpeg','png');
												$nomimage = $lastID['ID'].$_SESSION['ID'].".".$extension;
												if(in_array($extension,$perm_ext))
												{
													$chemin = "gallery/".$lastID['ID'].$_SESSION['ID'].".".$extension;
													move_uploaded_file($_FILES['ajouterimage']['tmp_name'],$chemin);
													
													$newimage = $db->prepare('INSERT INTO gallery(IDmembre,image,theme,tag1,date) VALUES (:IDmembre,:image,:theme,:tag1,NOW())');
													$newimage->execute(array(
													'IDmembre' => $IDmembre,
													'image' => $nomimage,
													'theme' => $theme,
													'tag1' => $tag1
													));
												}
												else
												{
												?>
													<style>
														.divajoutergallery
														{
															display: block;
															opacity: 1;
														}
														.divfiltrer
														{
															display: none;
															height: 0px;
														}
													</style>
												<?php
												}
											}
											else
											{
											?>
												<style>
													.divajoutergallery
													{
														display: block;
														opacity: 1;
													}
													.divfiltrer
													{
														display: none;
														height: 0px;
													}
												</style>
											<?php
											}
										}
										else
										{
										?>
											<style>
												.divajoutergallery
												{
													display: block;
													opacity: 1;
												}
												.divfiltrer
												{
													display: none;
													height: 0px;
												}
											</style>
										<?php
										}
									}
									else
									{
									?>
										<style>
											.divajoutergallery
											{
												display: block;
												opacity: 1;
											}
											.divfiltrer
											{
												display: none;
												height: 0px;
											}
										</style>
									<?php
									}
								}
							}
						}
						else
						{
							if(strlen($legende) >= 1 AND strlen($legende) <= 5000)
							{
								if(isset($_FILES['ajouterimage']) AND !empty($_FILES['ajouterimage']['name']))
								{
									$taille = $_FILES['ajouterimage']['size'];
									if($taille <= 5097152)
									{
										$selectlastID = $db->query('SELECT ID FROM gallery ORDER BY ID DESC LIMIT 1');
										$lastID = $selectlastID->fetch();
										
										$extension = strtolower(substr(strrchr($_FILES['ajouterimage']['name'], '.'),1));
										$perm_ext = array('jpg','jpeg','png');
										$nomimage = $lastID['ID'].$_SESSION['ID'].".".$extension;
										if(in_array($extension,$perm_ext))
										{
											$chemin = "gallery/".$lastID['ID'].$_SESSION['ID'].".".$extension;
											move_uploaded_file($_FILES['ajouterimage']['tmp_name'],$chemin);
											
											$newimage = $db->prepare('INSERT INTO gallery(IDmembre,image,theme,contenu,date) VALUES (:IDmembre,:image,:theme,:contenu,NOW())');
											$newimage->execute(array(
											'IDmembre' => $IDmembre,
											'image' => $nomimage,
											'theme' => $theme,
											'contenu' => $legende
											));
										}
										else
										{
										?>
											<style>
												.divajoutergallery
												{
													display: block;
													opacity: 1;
												}
												.divfiltrer
												{
													display: none;
													height: 0px;
												}
											</style>
										<?php
										}
									}
									else
									{
									?>
										<style>
											.divajoutergallery
											{
												display: block;
												opacity: 1;
											}
											.divfiltrer
											{
												display: none;
												height: 0px;
											}
										</style>
									<?php
									}
								}
								else
								{
								?>
									<style>
										.divajoutergallery
										{
											display: block;
											opacity: 1;
										}
										.divfiltrer
										{
											display: none;
											height: 0px;
										}
									</style>
								<?php
								}
							}
							else
							{
								if(isset($_FILES['ajouterimage']) AND !empty($_FILES['ajouterimage']['name']))
								{
									$taille = $_FILES['ajouterimage']['size'];
									if($taille <= 5097152)
									{
										$selectlastID = $db->query('SELECT ID FROM gallery ORDER BY ID DESC LIMIT 1');
										$lastID = $selectlastID->fetch();
										
										$extension = strtolower(substr(strrchr($_FILES['ajouterimage']['name'], '.'),1));
										$perm_ext = array('jpg','jpeg','png');
										$nomimage = $lastID['ID'].$_SESSION['ID'].".".$extension;
										if(in_array($extension,$perm_ext))
										{
											$chemin = "gallery/".$lastID['ID'].$_SESSION['ID'].".".$extension;
											move_uploaded_file($_FILES['ajouterimage']['tmp_name'],$chemin);
											
											$newimage = $db->prepare('INSERT INTO gallery(IDmembre,image,theme,date) VALUES (:IDmembre,:image,:theme,NOW())');
											$newimage->execute(array(
											'IDmembre' => $IDmembre,
											'image' => $nomimage,
											'theme' => $theme
											));
										}
										else
										{
										?>
											<style>
												.divajoutergallery
												{
													display: block;
													opacity: 1;
												}
												.divfiltrer
												{
													display: none;
													height: 0px;
												}
											</style>
										<?php
										}
									}
									else
									{
									?>
										<style>
											.divajoutergallery
											{
												display: block;
												opacity: 1;
											}
											.divfiltrer
											{
												display: none;
												height: 0px;
											}
										</style>
									<?php
									}
								}
							}
						}
					}
				}
			?>
				<div class="contenuajouterimage">
					<span class="titreajouterimage">Ajouter une image</span>
					<hr class="hrajouterimage" />
				</div>
				<form method="post" action="" style="height:100%;" enctype="multipart/form-data">
				<img src="images/fermer.png" alt="Fermer" class="closeajoutergallery" />
				<div class="divajouterimage">
				<div title="5 Mo max" class="input-file-container">
					<input class="input-file" id="ajouterimage" name="ajouterimage" type="file" required />
					<label for="ajouterimage" class="input-file-trigger" tabindex="0">Image</label>
				</div>
				<p class="file-return"></p>
				</div>
				<label class="titresujetajoutersujet" for="ajouterimagetheme">Thème</label>
				<input type="text" autocomplete="off" class="contenutitreajoutersujet" name="ajouterimagetheme" placeholder="Anime,Art..." style="text-transform:capitalize;" maxlength="100" minlength="1" required />
				<br />
				<label class="titresujetajoutersujet" id="ajouterimagetag1" for="ajouterimagetag1" >Tag 1</label>
				<input type="text" autocomplete="off" class="contenutitreajoutersujet" name="ajouterimagetag1" placeholder="Tag 1" style="text-transform:capitalize;" maxlength="100" minlength="1" />
				<img src="images/ajoutergallery.png" alt="Plus" class="imgajoutertag" id="imgajoutertag1" title="Plus" />
				<br />
				<div id="divajoutertag2" style="margin-left:0.4%;display:none;">
					<label class="titresujetajoutersujet" for="ajouterimagetag2">Tag 2</label>
					<input type="text" autocomplete="off" class="contenutitreajoutersujet" name="ajouterimagetag2" placeholder="Tag 2" style="text-transform:capitalize;" maxlength="100" minlength="1" />
					<img src="images/ajoutergallery.png" alt="Plus" class="imgajoutertag" id="imgajoutertag2" title="Plus" />
					<br />
				</div>
				<div id="divajoutertag3" style="margin-left:0.4%;display:none;">
					<label class="titresujetajoutersujet" for="ajouterimagetag3">Tag 3</label>
					<input type="text" autocomplete="off" class="contenutitreajoutersujet" name="ajouterimagetag3" placeholder="Tag 3" style="text-transform:capitalize;" maxlength="100" minlength="1" />
					<img src="images/ajoutergallery.png" alt="Plus" class="imgajoutertag" id="imgajoutertag3" title="Plus" />
					<br />
				</div>
				<div id="divajoutertag4" style="margin-left:0.4%;display:none;">
					<label class="titresujetajoutersujet" for="ajouterimagetag4">Tag 4</label>
					<input type="text" autocomplete="off" class="contenutitreajoutersujet" name="ajouterimagetag4" placeholder="Tag 4" style="text-transform:capitalize;" maxlength="100" minlength="1" />
				</div>
				<textarea type="text" class="ajouterimagetext" name="ajouterimagetext" maxlength="5000" minlength="1" placeholder="Ajouter une légende..." ></textarea>
				
				<input type="submit" value="Valider" class="validerajoutersujet" name="validerajoutersujet" style="outline:none;" />
				</form>
			<?php
			}
			else
			{
			?>
				<img src="images/fermer.png" alt="Fermer" class="closeajoutergallery" />
				<div class="contenuajouterimage">
					<span class="titreajouterimage">Ajouter une image</span>
					<hr class="hrajouterimage" />
				</div>
				<p class="nonmembreajoutersujet">L'ajout d'image est exclusivement réservée aux membres.</p>
			<?php
			}
			?>
		</div>
		<script>
			document.querySelector(".closeajoutergallery").onclick = function()
			{ 
				if (window.getComputedStyle(document.querySelector('.divajoutergallery')).display=='block')
				{
					setTimeout(function(){document.querySelector(".divajoutergallery").style.display="none";},600)
					setTimeout(function(){document.querySelector(".divajoutergallery").style.opacity="0";},300)
				}
				else
				{
					setTimeout(function(){document.querySelector(".divajoutergallery").style.display="none";},600)
					setTimeout(function(){document.querySelector(".divajoutergallery").style.opacity="0";},300)
				}
			}
			
			document.querySelector("#imgajoutertag1").onclick = function()
			{ 
				if (window.getComputedStyle(document.querySelector('#divajoutertag2')).display=='none')
				{
					document.querySelector("#divajoutertag2").style.display="block";
					document.querySelector("#imgajoutertag1").style.display="none";
				}
				else
				{
					document.querySelector("#divajoutertag2").style.display="block";
					document.querySelector("#imgajoutertag1").style.display="none";
				}
			}
			
			document.querySelector("#imgajoutertag2").onclick = function()
			{ 
				if (window.getComputedStyle(document.querySelector('#divajoutertag3')).display=='none')
				{
					document.querySelector("#divajoutertag3").style.display="block";
					document.querySelector("#imgajoutertag2").style.display="none";
				}
				else
				{
					document.querySelector("#divajoutertag3").style.display="block";
					document.querySelector("#imgajoutertag2").style.display="none";
				}
			}
			
			document.querySelector("#imgajoutertag3").onclick = function()
			{ 
				if (window.getComputedStyle(document.querySelector('#divajoutertag4')).display=='none')
				{
					document.querySelector("#divajoutertag4").style.display="block";
					document.querySelector("#imgajoutertag3").style.display="none";
				}
				else
				{
					document.querySelector("#divajoutertag4").style.display="block";
					document.querySelector("#imgajoutertag3").style.display="none";
				}
			}
		</script>
		<div class="divgallery">
			<div class="divrecherche">
				<?php
					if(isset($_GET['administration']))
					{
					?>
						<style>
							#afficheblockimage<?php echo $_GET['administration'];?>
							{
								display: block;
								opacity: 1;
							}
						</style>
						
						<script>
							
							setTimeout(function()
							{
								var img = document.querySelector('#contenueimagegallery<?php echo $_GET['administration']; ?>'); 
								var height = img.clientHeight;
								
								if(height <= 651)
								{
									height = 651 - height;
									height = height / 6;
									
									if (window.matchMedia("(min-width: 900px)").matches)
									{
										document.getElementById("contenueimagediv<?php echo $_GET['administration']; ?>").style.marginTop=height+height+height;
									}
								}
							},150 )
							
						</script>
					<?php
					}
					else if(isset($_GET['image']))
					{
					?>
						<style>
							#afficheblockimage<?php echo $_GET['image'];?>
							{
								display: block;
								opacity: 1;
							}
						</style>
						
						<script>
							setTimeout(function()
							{
								var img = document.querySelector('#contenueimagegallery<?php echo $_GET['image']; ?>'); 
								var height = img.clientHeight;
								
								if(height <= 651)
								{
									height = 651 - height;
									height = height / 6;
									
									if (window.matchMedia("(min-width: 900px)").matches)
									{
										document.getElementById("contenueimagediv<?php echo $_GET['image']; ?>").style.marginTop=height+height+height;
									}
								}
							},150 )
						</script>
					<?php
					}
				?>
				
				<label class="labelbarrederecherche" for="rechercheimage">Recherche :</label><input type="text" autocomplete="off" onKeyPress="if (event.keyCode == 13) search()" name="search" class="barrederecherche" id="rechercheimage" style="text-transform:capitalize" title=" " maxlength="80" required />
				<label style="display:none;" class="labelbarrederechercheerror" for="rechercheimage">Recherche :</label><input type="text" autocomplete="off" onKeyPress="if (event.keyCode == 13) searcherror()" name="search" class="barrederechercheerror" id="rechercheimageerror" style="display:none;text-transform:capitalize" title=" " maxlength="80" required />
				
				<script>
				
					function search()
					{
						var xhr = new XMLHttpRequest();
						var search = document.querySelector('#rechercheimage').value;
						
						if(document.getElementById('infotrie').innerHTML == "recent")
						{
							xhr.open('GET', 'site/phpgallery.php?searchimagerecent=' + search + '');
						}
						else
						{
							xhr.open('GET', 'site/phpgallery.php?searchimagemieuxnotes=' + search + '');
						}
						
						document.querySelector('.ajoutergallery').style.display="none";
						document.querySelector('.errorrecherchediv').style.display="block";
						document.querySelector('.barrederecherche').style.display="inline-block";
						document.querySelector('.labelbarrederecherche').style.display="inline-block";
						document.querySelector('.barrederechercheerror').style.display="none";
						document.querySelector('.labelbarrederechercheerror').style.display="none";
						document.querySelector('#imgsupprimerrechercheerror').style.display="none";
						document.querySelector('.aucunresultaterror').style.display="none";
						document.querySelector('.aucunresultatdiverror').style.display="none";
						document.querySelector('.divfiltrererror').style.display="none";
						document.querySelector('#resultthememotderechercheerror').style.display="none";
						document.querySelector('.errorrecherche').style.display="none";
						document.querySelector(".divfiltrer").style.transition="all 1s;";
						document.querySelector(".divfiltrer").style.height="0px";
						
						xhr.onreadystatechange = function()
						{
							if (xhr.readyState == 4 && (xhr.status == 200))
							{
								document.querySelector("#resulttheme").style.display="none";
								document.querySelector("#resulttag1").style.display="none";
								document.querySelector("#resulttag2").style.display="none";
								document.querySelector("#resulttag3").style.display="none";
								document.querySelector("#resulttag4").style.display="none";
								document.querySelector("#resultthememotderecherche").innerHTML = "none";
								document.querySelector("#resulttag1motderecherche").innerHTML = "none";
								document.querySelector("#resulttag2motderecherche").innerHTML = "none";
								document.querySelector("#resulttag3motderecherche").innerHTML = "none";
								document.querySelector("#resulttag4motderecherche").innerHTML = "none";
								document.querySelector(".propositiontrier").style.display="none";
								document.querySelector(".chevron").style.transform="rotate(0deg)";
								document.querySelector(".Filtrer").style.marginTop="-5px";
								document.querySelector(".propositionderecherche").style.marginTop="0px";
								document.querySelector(".propositionderecherche").style.display="inline-block";
								document.querySelector('#rechercheimage').value = "";
								document.querySelector('#contenu').innerHTML = xhr.responseText;
								$(".contenueimage").mCustomScrollbar({
									theme:"inset-3"
								});
								$(".contenuetextepublicationtexte").mCustomScrollbar({
									theme:"inset-3"
								});
								
								var searchimageinfolevel = document.querySelector('#searchimageinfolevel').innerHTML;
								var searchimageinfotheme = document.querySelector('#searchimageinfotheme').innerHTML;
								
								if(searchimageinfolevel == "theme")
								{	
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherchediv').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.barrederecherche').style.display="inline-block";
									document.querySelector('.labelbarrederecherche').style.display="inline-block";
									document.querySelector('.barrederechercheerror').style.display="none";
									document.querySelector('.labelbarrederechercheerror').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector("#resultthememotderecherche").innerHTML = "" + searchimageinfotheme + "";
									document.querySelector("#resulttheme").style.display="inline-block";
									document.querySelector('#infolevel').innerHTML = "theme";
									document.querySelector('#infotitre').innerHTML = "" + searchimageinfotheme + "";
								}
								else if(searchimageinfolevel == "tag1")
								{	
									var searchimageinfotag1 = document.querySelector('#searchimageinfotag1').innerHTML;
									
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherchediv').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.barrederecherche').style.display="inline-block";
									document.querySelector('.labelbarrederecherche').style.display="inline-block";
									document.querySelector('.barrederechercheerror').style.display="none";
									document.querySelector('.labelbarrederechercheerror').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector("#resultthememotderecherche").innerHTML = "" + searchimageinfotheme + "";
									document.querySelector("#resulttheme").style.display="inline-block";
									document.querySelector("#resulttag1motderecherche").innerHTML = "" + searchimageinfotag1 + "";
									document.querySelector("#resulttag1").style.display="inline-block";
									document.querySelector('#infolevel').innerHTML = "tag1";
									document.querySelector('#infotitre').innerHTML = "" + searchimageinfotag1 + "";
								}
								else if(searchimageinfolevel == "tag2")
								{	
									var searchimageinfotag1 = document.querySelector('#searchimageinfotag1').innerHTML;
									var searchimageinfotag2 = document.querySelector('#searchimageinfotag2').innerHTML;
									
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherchediv').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.barrederecherche').style.display="inline-block";
									document.querySelector('.labelbarrederecherche').style.display="inline-block";
									document.querySelector('.barrederechercheerror').style.display="none";
									document.querySelector('.labelbarrederechercheerror').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector("#resultthememotderecherche").innerHTML = "" + searchimageinfotheme + "";
									document.querySelector("#resulttheme").style.display="inline-block";
									document.querySelector("#resulttag1motderecherche").innerHTML = "" + searchimageinfotag1 + "";
									document.querySelector("#resulttag1").style.display="inline-block";
									document.querySelector("#resulttag2motderecherche").innerHTML = "" + searchimageinfotag2 + "";
									document.querySelector("#resulttag2").style.display="inline-block";
									document.querySelector('#infolevel').innerHTML = "tag2";
									document.querySelector('#infotitre').innerHTML = "" + searchimageinfotag2 + "";
								}
								else if(searchimageinfolevel == "tag3")
								{	
									var searchimageinfotag1 = document.querySelector('#searchimageinfotag1').innerHTML;
									var searchimageinfotag2 = document.querySelector('#searchimageinfotag2').innerHTML;
									var searchimageinfotag3 = document.querySelector('#searchimageinfotag3').innerHTML;
									
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherchediv').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.barrederecherche').style.display="inline-block";
									document.querySelector('.labelbarrederecherche').style.display="inline-block";
									document.querySelector('.barrederechercheerror').style.display="none";
									document.querySelector('.labelbarrederechercheerror').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector("#resultthememotderecherche").innerHTML = "" + searchimageinfotheme + "";
									document.querySelector("#resulttheme").style.display="inline-block";
									document.querySelector("#resulttag1motderecherche").innerHTML = "" + searchimageinfotag1 + "";
									document.querySelector("#resulttag1").style.display="inline-block";
									document.querySelector("#resulttag2motderecherche").innerHTML = "" + searchimageinfotag2 + "";
									document.querySelector("#resulttag2").style.display="inline-block";
									document.querySelector("#resulttag3motderecherche").innerHTML = "" + searchimageinfotag3 + "";
									document.querySelector("#resulttag3").style.display="inline-block";
									document.querySelector('#infolevel').innerHTML = "tag3";
									document.querySelector('#infotitre').innerHTML = "" + searchimageinfotag3 + "";
								}
								else if(searchimageinfolevel == "tag4")
								{	
									var searchimageinfotag1 = document.querySelector('#searchimageinfotag1').innerHTML;
									var searchimageinfotag2 = document.querySelector('#searchimageinfotag2').innerHTML;
									var searchimageinfotag3 = document.querySelector('#searchimageinfotag3').innerHTML;
									var searchimageinfotag4 = document.querySelector('#searchimageinfotag4').innerHTML;
									
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherchediv').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.barrederecherche').style.display="inline-block";
									document.querySelector('.labelbarrederecherche').style.display="inline-block";
									document.querySelector('.barrederechercheerror').style.display="none";
									document.querySelector('.labelbarrederechercheerror').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector("#resultthememotderecherche").innerHTML = "" + searchimageinfotheme + "";
									document.querySelector("#resulttheme").style.display="inline-block";
									document.querySelector("#resulttag1motderecherche").innerHTML = "" + searchimageinfotag1 + "";
									document.querySelector("#resulttag1").style.display="inline-block";
									document.querySelector("#resulttag2motderecherche").innerHTML = "" + searchimageinfotag2 + "";
									document.querySelector("#resulttag2").style.display="inline-block";
									document.querySelector("#resulttag3motderecherche").innerHTML = "" + searchimageinfotag3 + "";
									document.querySelector("#resulttag3").style.display="inline-block";
									document.querySelector("#resulttag4motderecherche").innerHTML = "" + searchimageinfotag4 + "";
									document.querySelector("#resulttag4").style.display="inline-block";
									document.querySelector('#infolevel').innerHTML = "tag4";
									document.querySelector('#infotitre').innerHTML = "" + searchimageinfotag4 + "";
								}
							}
							else
							{
								document.querySelector('.barrederecherche').style.display="none";
								document.querySelector('.labelbarrederecherche').style.display="none";
								document.querySelector('.barrederechercheerror').style.display="inline-block";
								document.querySelector('.labelbarrederechercheerror').style.display="inline-block";
								document.querySelector('.Filtrer').style.display="none";
								document.querySelector(".Filtrererror").style.marginTop="-5px";
								document.querySelector('.Filtrererror').style.display="inline-block";
								document.querySelector("#resultthemeerror").style.display="inline-block";
								document.querySelector("#resulttag1").style.display="none";
								document.querySelector("#resulttag2").style.display="none";
								document.querySelector("#resulttag3").style.display="none";
								document.querySelector("#resulttag4").style.display="none";
								document.querySelector("#resultthememotderechercheerror").innerHTML = "" + search + "";
								document.querySelector("#resulttag1motderecherche").innerHTML = "none";
								document.querySelector("#resulttag2motderecherche").innerHTML = "none";
								document.querySelector("#resulttag3motderecherche").innerHTML = "none";
								document.querySelector("#resulttag4motderecherche").innerHTML = "none";
								document.querySelector(".propositiontrier").style.display="none";
								document.querySelector(".chevron").style.transform="rotate(0deg)";
								document.querySelector('#rechercheimage').value = "";
								document.querySelector('#imgsupprimerrechercheerror').style.display="block";
								document.querySelector('.aucunresultaterror').style.display="block";
								document.querySelector('.aucunresultatdiverror').style.display="block";
								document.querySelector('.divfiltrererror').style.display="none";
								document.querySelector('#resultthememotderechercheerror').style.display="block";
								document.querySelector('.errorrecherche').style.display="block";
								setTimeout(function(){document.querySelector('.errorrecherchediv').style.display="none";},50)
							}
						};
						
						xhr.send(null);
					
					}

					function searcherror()
					{
						var xhr = new XMLHttpRequest();
						var search = document.querySelector('#rechercheimageerror').value;
						
						if(document.getElementById('infotrie').innerHTML == "recent")
						{
							xhr.open('GET', 'site/phpgallery.php?searchimagerecent=' + search + '');
						}
						else
						{
							xhr.open('GET', 'site/phpgallery.php?searchimagemieuxnotes=' + search + '');
						}
						
						document.querySelector('.ajoutergallery').style.display="none";
						document.querySelector('.errorrecherchediv').style.display="block";
						document.querySelector('.barrederecherche').style.display="inline-block";
						document.querySelector('.labelbarrederecherche').style.display="inline-block";
						document.querySelector('.barrederechercheerror').style.display="none";
						document.querySelector('.labelbarrederechercheerror').style.display="none";
						document.querySelector('#imgsupprimerrechercheerror').style.display="none";
						document.querySelector('.aucunresultaterror').style.display="none";
						document.querySelector('.aucunresultatdiverror').style.display="none";
						document.querySelector('.divfiltrererror').style.display="none";
						document.querySelector('#resultthememotderechercheerror').style.display="none";
						document.querySelector('.errorrecherche').style.display="none";
						document.querySelector(".divfiltrererror").style.display="none";
						
						xhr.onreadystatechange = function() 
						{
							if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
							{
								document.querySelector("#resulttheme").style.display="none";
								document.querySelector("#resulttag1").style.display="none";
								document.querySelector("#resulttag2").style.display="none";
								document.querySelector("#resulttag3").style.display="none";
								document.querySelector("#resulttag4").style.display="none";
								document.querySelector("#resultthememotderecherche").innerHTML = "none";
								document.querySelector("#resulttag1motderecherche").innerHTML = "none";
								document.querySelector("#resulttag2motderecherche").innerHTML = "none";
								document.querySelector("#resulttag3motderecherche").innerHTML = "none";
								document.querySelector("#resulttag4motderecherche").innerHTML = "none";
								document.querySelector(".propositiontrier").style.display="none";
								document.querySelector(".chevron").style.transform="rotate(0deg)";
								document.querySelector(".Filtrer").style.marginTop="-5px";
								document.querySelector(".propositionderecherche").style.marginTop="0px";
								document.querySelector(".propositionderecherche").style.display="inline-block";
								document.querySelector('#rechercheimageerror').value = "";
								document.querySelector('#rechercheimage').value = "";
								document.querySelector('#contenu').innerHTML = xhr.responseText;
								$(".contenueimage").mCustomScrollbar({
									theme:"inset-3"
								});
								$(".contenuetextepublicationtexte").mCustomScrollbar({
									theme:"inset-3"
								});
								
								var searchimageinfolevel = document.querySelector('#searchimageinfolevel').innerHTML;
								var searchimageinfotheme = document.querySelector('#searchimageinfotheme').innerHTML;
								
								if(searchimageinfolevel == "theme")
								{	
									document.querySelector('.barrederecherche').style.display="inline-block";
									document.querySelector('.labelbarrederecherche').style.display="inline-block";
									document.querySelector('.barrederechercheerror').style.display="none";
									document.querySelector('.labelbarrederechercheerror').style.display="none";
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherchediv').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector("#resultthememotderecherche").innerHTML = "" + searchimageinfotheme + "";
									document.querySelector("#resulttheme").style.display="inline-block";
									document.querySelector('#infolevel').innerHTML = "theme";
									document.querySelector('#infotitre').innerHTML = "" + searchimageinfotheme + "";
								}
								else if(searchimageinfolevel == "tag1")
								{	
									var searchimageinfotag1 = document.querySelector('#searchimageinfotag1').innerHTML;
									
									document.querySelector('.barrederecherche').style.display="inline-block";
									document.querySelector('.labelbarrederecherche').style.display="inline-block";
									document.querySelector('.barrederechercheerror').style.display="none";
									document.querySelector('.labelbarrederechercheerror').style.display="none";
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherchediv').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector("#resultthememotderecherche").innerHTML = "" + searchimageinfotheme + "";
									document.querySelector("#resulttheme").style.display="inline-block";
									document.querySelector("#resulttag1motderecherche").innerHTML = "" + searchimageinfotag1 + "";
									document.querySelector("#resulttag1").style.display="inline-block";
									document.querySelector('#infolevel').innerHTML = "tag1";
									document.querySelector('#infotitre').innerHTML = "" + searchimageinfotag1 + "";
								}
								else if(searchimageinfolevel == "tag2")
								{	
									var searchimageinfotag1 = document.querySelector('#searchimageinfotag1').innerHTML;
									var searchimageinfotag2 = document.querySelector('#searchimageinfotag2').innerHTML;
									
									document.querySelector('.barrederecherche').style.display="inline-block";
									document.querySelector('.labelbarrederecherche').style.display="inline-block";
									document.querySelector('.barrederechercheerror').style.display="none";
									document.querySelector('.labelbarrederechercheerror').style.display="none";
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherchediv').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector("#resultthememotderecherche").innerHTML = "" + searchimageinfotheme + "";
									document.querySelector("#resulttheme").style.display="inline-block";
									document.querySelector("#resulttag1motderecherche").innerHTML = "" + searchimageinfotag1 + "";
									document.querySelector("#resulttag1").style.display="inline-block";
									document.querySelector("#resulttag2motderecherche").innerHTML = "" + searchimageinfotag2 + "";
									document.querySelector("#resulttag2").style.display="inline-block";
									document.querySelector('#infolevel').innerHTML = "tag2";
									document.querySelector('#infotitre').innerHTML = "" + searchimageinfotag2 + "";
								}
								else if(searchimageinfolevel == "tag3")
								{	
									var searchimageinfotag1 = document.querySelector('#searchimageinfotag1').innerHTML;
									var searchimageinfotag2 = document.querySelector('#searchimageinfotag2').innerHTML;
									var searchimageinfotag3 = document.querySelector('#searchimageinfotag3').innerHTML;
									
									document.querySelector('.barrederecherche').style.display="inline-block";
									document.querySelector('.labelbarrederecherche').style.display="inline-block";
									document.querySelector('.barrederechercheerror').style.display="none";
									document.querySelector('.labelbarrederechercheerror').style.display="none";
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherchediv').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector("#resultthememotderecherche").innerHTML = "" + searchimageinfotheme + "";
									document.querySelector("#resulttheme").style.display="inline-block";
									document.querySelector("#resulttag1motderecherche").innerHTML = "" + searchimageinfotag1 + "";
									document.querySelector("#resulttag1").style.display="inline-block";
									document.querySelector("#resulttag2motderecherche").innerHTML = "" + searchimageinfotag2 + "";
									document.querySelector("#resulttag2").style.display="inline-block";
									document.querySelector("#resulttag3motderecherche").innerHTML = "" + searchimageinfotag3 + "";
									document.querySelector("#resulttag3").style.display="inline-block";
									document.querySelector('#infolevel').innerHTML = "tag3";
									document.querySelector('#infotitre').innerHTML = "" + searchimageinfotag3 + "";
								}
								else if(searchimageinfolevel == "tag4")
								{	
									var searchimageinfotag1 = document.querySelector('#searchimageinfotag1').innerHTML;
									var searchimageinfotag2 = document.querySelector('#searchimageinfotag2').innerHTML;
									var searchimageinfotag3 = document.querySelector('#searchimageinfotag3').innerHTML;
									var searchimageinfotag4 = document.querySelector('#searchimageinfotag4').innerHTML;
									
									document.querySelector('.barrederecherche').style.display="inline-block";
									document.querySelector('.labelbarrederecherche').style.display="inline-block";
									document.querySelector('.barrederechercheerror').style.display="none";
									document.querySelector('.labelbarrederechercheerror').style.display="none";
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherchediv').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector("#resultthememotderecherche").innerHTML = "" + searchimageinfotheme + "";
									document.querySelector("#resulttheme").style.display="inline-block";
									document.querySelector("#resulttag1motderecherche").innerHTML = "" + searchimageinfotag1 + "";
									document.querySelector("#resulttag1").style.display="inline-block";
									document.querySelector("#resulttag2motderecherche").innerHTML = "" + searchimageinfotag2 + "";
									document.querySelector("#resulttag2").style.display="inline-block";
									document.querySelector("#resulttag3motderecherche").innerHTML = "" + searchimageinfotag3 + "";
									document.querySelector("#resulttag3").style.display="inline-block";
									document.querySelector("#resulttag4motderecherche").innerHTML = "" + searchimageinfotag4 + "";
									document.querySelector("#resulttag4").style.display="inline-block";
									document.querySelector('#infolevel').innerHTML = "tag4";
									document.querySelector('#infotitre').innerHTML = "" + searchimageinfotag4 + "";
								}
							}
							else
							{
								document.querySelector('.barrederecherche').style.display="none";
								document.querySelector('.labelbarrederecherche').style.display="none";
								document.querySelector('.barrederechercheerror').style.display="inline-block";
								document.querySelector('.labelbarrederechercheerror').style.display="inline-block";
								document.querySelector('.Filtrer').style.display="none";
								document.querySelector(".Filtrererror").style.marginTop="-5px";
								document.querySelector('.Filtrererror').style.display="inline-block";
								document.querySelector("#resultthemeerror").style.display="inline-block";
								document.querySelector("#resulttag1").style.display="none";
								document.querySelector("#resulttag2").style.display="none";
								document.querySelector("#resulttag3").style.display="none";
								document.querySelector("#resulttag4").style.display="none";
								document.querySelector("#resultthememotderechercheerror").innerHTML = "" + search + "";
								document.querySelector("#resulttag1motderecherche").innerHTML = "none";
								document.querySelector("#resulttag2motderecherche").innerHTML = "none";
								document.querySelector("#resulttag3motderecherche").innerHTML = "none";
								document.querySelector("#resulttag4motderecherche").innerHTML = "none";
								document.querySelector(".propositiontrier").style.display="none";
								document.querySelector(".chevron").style.transform="rotate(0deg)";
								document.querySelector('#rechercheimage').value = "";
								document.querySelector('#rechercheimageerror').value = "";
								document.querySelector('#imgsupprimerrechercheerror').style.display="block";
								document.querySelector('.aucunresultaterror').style.display="block";
								document.querySelector('.aucunresultatdiverror').style.display="block";
								document.querySelector('.divfiltrererror').style.display="none";
								document.querySelector('#resultthememotderechercheerror').style.display="block";
								document.querySelector('.errorrecherche').style.display="block";
								setTimeout(function(){document.querySelector('.errorrecherchediv').style.display="none";},50)
							}
						};
						
						xhr.send(null);
					
					}
				</script>
				
				<div class="selectiontrier">
					<span class="trierpar">Trier par :</span>
					<span class="recent">Récent</span>
					<span class="mieuxnotes">Mieux notés</span>
					<span class="chevron">></span>
				</div>
				<div class="propositiontrier">
					<span id="trierparrecent" class="propositiontrierrecent">Récent</span>
					<span id="trierparmieuxnotes" class="propositiontriermieuxnotes">Mieux notés</span>
				</div>
				
				<span id="infotrie" style="display:none;">recent</span>
				<span id="infolevel" style="display:none;">none</span>
				<span id="infotitre" style="display:none;">none</span>
				
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
					
					document.getElementById('trierparmieuxnotes').onclick = function()
					{
						var xhr = new XMLHttpRequest();
						var infotitre = document.querySelector('#infotitre').innerHTML;
						
						if(document.querySelector('#infolevel').innerHTML == "none")
						{
							xhr.open('GET', 'site/phpgallery.php?trierparmieuxnotes=ok');
						}
						else if(document.querySelector('#infolevel').innerHTML == "theme")
						{
							xhr.open('GET', 'site/phpgallery.php?searchmieuxnotes=' + infotitre + '');
						}
						else if(document.querySelector('#infolevel').innerHTML == "tag1")
						{
							var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
							
							xhr.open('GET', 'site/phpgallery.php?searchtag1mieuxnotes=' + infotitre + '&searchtheme=' + infotheme + '');
						}
						else if(document.querySelector('#infolevel').innerHTML == "tag2")
						{
							var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
							var infotag1 = document.querySelector('#resulttag1motderecherche').innerHTML;
							
							xhr.open('GET', 'site/phpgallery.php?searchtag2mieuxnotes=' + infotitre + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '');
						}
						else if(document.querySelector('#infolevel').innerHTML == "tag3")
						{
							var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
							var infotag1 = document.querySelector('#resulttag1motderecherche').innerHTML;
							var infotag2 = document.querySelector('#resulttag2motderecherche').innerHTML;
							
							xhr.open('GET', 'site/phpgallery.php?searchtag3mieuxnotes=' + infotitre + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '&searchtag2=' + infotag2 + '');
						}
						else if(document.querySelector('#infolevel').innerHTML == "tag4")
						{
							var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
							var infotag1 = document.querySelector('#resulttag1motderecherche').innerHTML;
							var infotag2 = document.querySelector('#resulttag2motderecherche').innerHTML;
							var infotag3 = document.querySelector('#resulttag3motderecherche').innerHTML;
							
							xhr.open('GET', 'site/phpgallery.php?searchtag4mieuxnotes=' + infotitre + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '&searchtag2=' + infotag2 + '&searchtag3=' + infotag3 + '');
						}
						
						document.querySelector(".divfiltrer").style.transition="all 1s;";
						document.querySelector(".divfiltrer").style.height="0px";
						
						xhr.onreadystatechange = function() 
						{
							if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
							{
								document.querySelector('.divfiltrererror').style.display="none";
								document.querySelector('.errorrecherche').style.display="none";
								document.querySelector('.Filtrer').style.display="inline-block";
								document.querySelector('.Filtrererror').style.display="none";
								document.querySelector("#resultthemeerror").style.display="none";
								document.querySelector('.propositiontrier').style.marginTop="55px";
								document.querySelector('.propositiontrier').style.right="25px";
								document.querySelector('.propositiontrierrecent').style.width="130px";
								document.querySelector('.propositiontrierrecent').style.height="28px";
								document.querySelector(".propositiontrier").style.display="none";
								document.querySelector(".chevron").style.transform="rotate(0deg)";
								document.querySelector('.recent').style.display="none";
								document.querySelector('.mieuxnotes').style.display="inline-block";
								document.querySelector('.propositiontrierrecent').style.display="block";
								document.querySelector('.propositiontriermieuxnotes').style.display="none";
								document.querySelector('#infotrie').innerHTML = "mieuxnotes";
								document.querySelector('#contenu').innerHTML = xhr.responseText;
								$(".contenueimage").mCustomScrollbar({
									theme:"inset-3"
								});
								$(".contenuetextepublicationtexte").mCustomScrollbar({
									theme:"inset-3"
								});
							}
						};
						
						xhr.send(null);
					}
					
					document.getElementById('trierparrecent').onclick = function()
					{
						var xhr = new XMLHttpRequest();
						var infotitre = document.querySelector('#infotitre').innerHTML;
						
						if(document.querySelector('#infolevel').innerHTML == "none")
						{
							xhr.open('GET', 'site/phpgallery.php?trierparrecent=ok');
						}
						else if(document.querySelector('#infolevel').innerHTML == "theme")
						{
							xhr.open('GET', 'site/phpgallery.php?searchrecent=' + infotitre + '');
						}
						else if(document.querySelector('#infolevel').innerHTML == "tag1")
						{
							var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
							
							xhr.open('GET', 'site/phpgallery.php?searchtag1recent=' + infotitre + '&searchtheme=' + infotheme + '');
						}
						else if(document.querySelector('#infolevel').innerHTML == "tag2")
						{
							var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
							var infotag1 = document.querySelector('#resulttag1motderecherche').innerHTML;
							
							xhr.open('GET', 'site/phpgallery.php?searchtag2recent=' + infotitre + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '');
						}
						else if(document.querySelector('#infolevel').innerHTML == "tag3")
						{
							var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
							var infotag1 = document.querySelector('#resulttag1motderecherche').innerHTML;
							var infotag2 = document.querySelector('#resulttag2motderecherche').innerHTML;
							
							xhr.open('GET', 'site/phpgallery.php?searchtag3recent=' + infotitre + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '&searchtag2=' + infotag2 + '');
						}
						else if(document.querySelector('#infolevel').innerHTML == "tag4")
						{
							var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
							var infotag1 = document.querySelector('#resulttag1motderecherche').innerHTML;
							var infotag2 = document.querySelector('#resulttag2motderecherche').innerHTML;
							var infotag3 = document.querySelector('#resulttag3motderecherche').innerHTML;
							
							xhr.open('GET', 'site/phpgallery.php?searchtag4recent=' + infotitre + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '&searchtag2=' + infotag2 + '&searchtag3=' + infotag3 + '');
						}
						
						document.querySelector(".divfiltrer").style.transition="all 1s;";
						document.querySelector(".divfiltrer").style.height="0px";
						
						xhr.onreadystatechange = function() 
						{
							if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
							{
								document.querySelector('.divfiltrererror').style.display="none";
								document.querySelector('.errorrecherche').style.display="none";
								document.querySelector('.Filtrer').style.display="inline-block";
								document.querySelector('.Filtrererror').style.display="none";
								document.querySelector("#resultthemeerror").style.display="none";
								document.querySelector('.propositiontrier').style.marginTop="51px";
								document.querySelector('.propositiontrier').style.right="25px";
								document.querySelector('.propositiontriermieuxnotes').style.width="100px";
								document.querySelector('.propositiontriermieuxnotes').style.height="23px";
								document.querySelector(".propositiontrier").style.display="none";
								document.querySelector(".chevron").style.transform="rotate(0deg)";
								document.querySelector('.recent').style.display="inline-block";
								document.querySelector('.mieuxnotes').style.display="none";
								document.querySelector('.propositiontrierrecent').style.display="none";
								document.querySelector('.propositiontriermieuxnotes').style.display="block";
								document.querySelector('#infotrie').innerHTML = "recent";
								document.querySelector('#contenu').innerHTML = xhr.responseText;
								$(".contenueimage").mCustomScrollbar({
									theme:"inset-3"
								});
								$(".contenuetextepublicationtexte").mCustomScrollbar({
									theme:"inset-3"
								});
							}
						};
						
						xhr.send(null);
					}
					
				</script>
			</div><br />
				<div class="propositionderecherche" style="margin-top:50px;">
					<div id="resulttheme" style="display:none;">
						<img src="images/supprimerrecherche.png" alt="Supprimer" class="imgsupprimerrecherche" id="resultthemeimgsupprimerrecherche" />
						<p class="motderecherche" id="resultthememotderecherche">none</p>
					</div>
					
					<div id="resulttag1" style="display:none;">
						<img src="images/supprimerrecherche.png" alt="Supprimer" class="imgsupprimerrecherche" id="resulttag1imgsupprimerrecherche" />
						<p class="motderecherche" id="resulttag1motderecherche">none</p>
					</div>
					
					<div id="resulttag2" style="display:none;">
						<img src="images/supprimerrecherche.png" alt="Supprimer" class="imgsupprimerrecherche" id="resulttag2imgsupprimerrecherche" />
						<p class="motderecherche" id="resulttag2motderecherche">none</p>
					</div>
					
					<div id="resulttag3" style="display:none;">
						<img src="images/supprimerrecherche.png" alt="Supprimer" class="imgsupprimerrecherche" id="resulttag3imgsupprimerrecherche" />
						<p class="motderecherche" id="resulttag3motderecherche">none</p>
					</div>
					
					<div id="resulttag4" style="display:none;">
						<img src="images/supprimerrecherche.png" alt="Supprimer" class="imgsupprimerrecherche" id="resulttag4imgsupprimerrecherche" />
						<p class="motderecherche" id="resulttag4motderecherche">none</p>
					</div>
					<script>
						
						function resultthemeimgsupprimerrechercheerror()
						{
							var xhr = new XMLHttpRequest();
	
							if(document.getElementById('infotrie').innerHTML == "recent")
							{
								xhr.open('GET', 'site/phpgallery.php?trierparrecent=ok');
							}
							else
							{
								xhr.open('GET', 'site/phpgallery.php?trierparmieuxnotes=ok');
							}
							
							document.querySelector('.divfiltrererror').style.display="none";
							
							xhr.onreadystatechange = function() 
							{
								if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
								{
									document.querySelector('.ajoutergallery').style.display="block";
									document.querySelector('.barrederechercheerror').style.display="none";
									document.querySelector('.labelbarrederechercheerror').style.display="none";
									document.querySelector('.barrederecherche').style.display="inline-block";
									document.querySelector('.labelbarrederecherche').style.display="inline-block";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector(".propositiontrier").style.display="none";
									document.querySelector(".chevron").style.transform="rotate(0deg)";
									document.querySelector(".Filtrer").style.marginTop="-55px";
									document.querySelector(".propositionderecherche").style.marginTop="50px";
									document.querySelector("#resulttag4motderecherche").innerHTML = "none";
									document.querySelector("#resulttag4").style.display="none";
									document.querySelector("#resulttag3motderecherche").innerHTML = "none";
									document.querySelector("#resulttag3").style.display="none";
									document.querySelector("#resulttag2motderecherche").innerHTML = "none";
									document.querySelector("#resulttag2").style.display="none";
									document.querySelector("#resulttag1motderecherche").innerHTML = "none";
									document.querySelector("#resulttag1").style.display="none";
									document.querySelector("#resultthememotderecherche").innerHTML = "none";
									document.querySelector("#resulttheme").style.display="none";
									document.querySelector('#infolevel').innerHTML = "none";
									document.querySelector('#infotitre').innerHTML = "none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector('#rechercheimageerror').value = "";
									document.querySelector('#rechercheimage').value = "";
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('#contenu').innerHTML = xhr.responseText;
									$(".contenueimage").mCustomScrollbar({
										theme:"inset-3"
									});
									$(".contenuetextepublicationtexte").mCustomScrollbar({
										theme:"inset-3"
									});
								}
							};
							
							xhr.send(null);
						}
						
						document.getElementById('resultthemeimgsupprimerrecherche').onclick = function()
						{
							var xhr = new XMLHttpRequest();

							if(document.getElementById('infotrie').innerHTML == "recent")
							{
								xhr.open('GET', 'site/phpgallery.php?trierparrecent=ok');
							}
							else
							{
								xhr.open('GET', 'site/phpgallery.php?trierparmieuxnotes=ok');
							}
							
							document.querySelector(".divfiltrer").style.transition="all 1s;";
							document.querySelector(".divfiltrer").style.height="0px";
							
							xhr.onreadystatechange = function() 
							{
								if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
								{
									document.querySelector('.ajoutergallery').style.display="block";
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector(".propositiontrier").style.display="none";
									document.querySelector(".chevron").style.transform="rotate(0deg)";
									document.querySelector(".Filtrer").style.marginTop="-55px";
									document.querySelector(".propositionderecherche").style.marginTop="50px";
									document.querySelector("#resulttag4motderecherche").innerHTML = "none";
									document.querySelector("#resulttag4").style.display="none";
									document.querySelector("#resulttag3motderecherche").innerHTML = "none";
									document.querySelector("#resulttag3").style.display="none";
									document.querySelector("#resulttag2motderecherche").innerHTML = "none";
									document.querySelector("#resulttag2").style.display="none";
									document.querySelector("#resulttag1motderecherche").innerHTML = "none";
									document.querySelector("#resulttag1").style.display="none";
									document.querySelector("#resultthememotderecherche").innerHTML = "none";
									document.querySelector("#resulttheme").style.display="none";
									document.querySelector('#infolevel').innerHTML = "none";
									document.querySelector('#infotitre').innerHTML = "none";
									document.querySelector('#rechercheimageerror').value = "";
									document.querySelector('#rechercheimage').value = "";
									document.querySelector('#contenu').innerHTML = xhr.responseText;
									$(".contenueimage").mCustomScrollbar({
										theme:"inset-3"
									});
									$(".contenuetextepublicationtexte").mCustomScrollbar({
										theme:"inset-3"
									});
								}
							};
							
							xhr.send(null);
						}
						
						document.getElementById('resulttag1imgsupprimerrecherche').onclick = function()
						{
							var xhr = new XMLHttpRequest();
							var infotheme = document.querySelector("#resultthememotderecherche").innerHTML;
							
							if(document.getElementById('infotrie').innerHTML == "recent")
							{
								xhr.open('GET', 'site/phpgallery.php?searchrecent=' + infotheme + '');
							}
							else
							{
								xhr.open('GET', 'site/phpgallery.php?searchmieuxnotes=' + infotheme + '');
							}
							
							document.querySelector(".divfiltrer").style.transition="all 1s;";
							document.querySelector(".divfiltrer").style.height="0px";
							
							xhr.onreadystatechange = function() 
							{
								if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
								{
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector(".propositiontrier").style.display="none";
									document.querySelector(".chevron").style.transform="rotate(0deg)";
									document.querySelector("#resulttag4motderecherche").innerHTML = "none";
									document.querySelector("#resulttag4").style.display="none";
									document.querySelector("#resulttag3motderecherche").innerHTML = "none";
									document.querySelector("#resulttag3").style.display="none";
									document.querySelector("#resulttag2motderecherche").innerHTML = "none";
									document.querySelector("#resulttag2").style.display="none";
									document.querySelector("#resulttag1motderecherche").innerHTML = "none";
									document.querySelector("#resulttag1").style.display="none";
									document.querySelector('#infolevel').innerHTML = "theme";
									document.querySelector('#infotitre').innerHTML = "" + infotheme + "";
									document.querySelector('#contenu').innerHTML = xhr.responseText;
									$(".contenueimage").mCustomScrollbar({
										theme:"inset-3"
									});
									$(".contenuetextepublicationtexte").mCustomScrollbar({
										theme:"inset-3"
									});
								}
							};
							
							xhr.send(null);
						}
						
						document.getElementById('resulttag2imgsupprimerrecherche').onclick = function()
						{
							var xhr = new XMLHttpRequest();
							var infotheme = document.querySelector("#resultthememotderecherche").innerHTML;
							var infotag1 = document.querySelector("#resulttag1motderecherche").innerHTML;
							
							if(document.getElementById('infotrie').innerHTML == "recent")
							{
								xhr.open('GET', 'site/phpgallery.php?searchtag1recent=' + infotag1 + '&searchtheme=' + infotheme + '');
							}
							else
							{
								xhr.open('GET', 'site/phpgallery.php?searchtag1mieuxnotes=' + infotag1 + '&searchtheme=' + infotheme + '');
							}
							
							document.querySelector(".divfiltrer").style.transition="all 1s;";
							document.querySelector(".divfiltrer").style.height="0px";
							
							xhr.onreadystatechange = function() 
							{
								if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
								{
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector(".propositiontrier").style.display="none";
									document.querySelector(".chevron").style.transform="rotate(0deg)";
									document.querySelector("#resulttag4motderecherche").innerHTML = "none";
									document.querySelector("#resulttag4").style.display="none";
									document.querySelector("#resulttag3motderecherche").innerHTML = "none";
									document.querySelector("#resulttag3").style.display="none";
									document.querySelector("#resulttag2motderecherche").innerHTML = "none";
									document.querySelector("#resulttag2").style.display="none";
									document.querySelector('#infolevel').innerHTML = "tag1";
									document.querySelector('#infotitre').innerHTML = "" + infotag1 + "";
									document.querySelector('#contenu').innerHTML = xhr.responseText;
									$(".contenueimage").mCustomScrollbar({
										theme:"inset-3"
									});
									$(".contenuetextepublicationtexte").mCustomScrollbar({
										theme:"inset-3"
									});
								}
							};
							
							xhr.send(null);
						}
						
						document.getElementById('resulttag3imgsupprimerrecherche').onclick = function()
						{
							var xhr = new XMLHttpRequest();
							var infotheme = document.querySelector("#resultthememotderecherche").innerHTML;
							var infotag1 = document.querySelector("#resulttag1motderecherche").innerHTML;
							var infotag2 = document.querySelector("#resulttag2motderecherche").innerHTML;
							
							if(document.getElementById('infotrie').innerHTML == "recent")
							{
								xhr.open('GET', 'site/phpgallery.php?searchtag2recent=' + infotag2 + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '');
							}
							else
							{
								xhr.open('GET', 'site/phpgallery.php?searchtag2mieuxnotes=' + infotag2 + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '');
							}
							
							document.querySelector(".divfiltrer").style.transition="all 1s;";
							document.querySelector(".divfiltrer").style.height="0px";
							
							xhr.onreadystatechange = function() 
							{
								if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
								{
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector(".propositiontrier").style.display="none";
									document.querySelector(".chevron").style.transform="rotate(0deg)";
									document.querySelector("#resulttag4motderecherche").innerHTML = "none";
									document.querySelector("#resulttag4").style.display="none";
									document.querySelector("#resulttag3motderecherche").innerHTML = "none";
									document.querySelector("#resulttag3").style.display="none";
									document.querySelector('#infolevel').innerHTML = "tag2";
									document.querySelector('#infotitre').innerHTML = "" + infotag2 + "";
									document.querySelector('#contenu').innerHTML = xhr.responseText;
									$(".contenueimage").mCustomScrollbar({
										theme:"inset-3"
									});
									$(".contenuetextepublicationtexte").mCustomScrollbar({
										theme:"inset-3"
									});
								}
							};
							
							xhr.send(null);
						}
						
						document.getElementById('resulttag4imgsupprimerrecherche').onclick = function()
						{
							var xhr = new XMLHttpRequest();
							var infotheme = document.querySelector("#resultthememotderecherche").innerHTML;
							var infotag1 = document.querySelector("#resulttag1motderecherche").innerHTML;
							var infotag2 = document.querySelector("#resulttag2motderecherche").innerHTML;
							var infotag3 = document.querySelector("#resulttag3motderecherche").innerHTML;
							
							if(document.getElementById('infotrie').innerHTML == "recent")
							{
								xhr.open('GET', 'site/phpgallery.php?searchtag3recent=' + infotag3 + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '&searchtag2=' + infotag2 + '');
							}
							else
							{
								xhr.open('GET', 'site/phpgallery.php?searchtag3mieuxnotes=' + infotag3 + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '&searchtag2=' + infotag2 + '');
							}
							
							document.querySelector(".divfiltrer").style.transition="all 1s;";
							document.querySelector(".divfiltrer").style.height="0px";
							
							xhr.onreadystatechange = function() 
							{
								if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
								{
									document.querySelector('#imgsupprimerrechercheerror').style.display="none";
									document.querySelector('.aucunresultaterror').style.display="none";
									document.querySelector('.aucunresultatdiverror').style.display="none";
									document.querySelector('.divfiltrererror').style.display="none";
									document.querySelector('#resultthememotderechercheerror').style.display="none";
									document.querySelector('.errorrecherche').style.display="none";
									document.querySelector('.Filtrer').style.display="inline-block";
									document.querySelector('.Filtrererror').style.display="none";
									document.querySelector("#resultthemeerror").style.display="none";
									document.querySelector(".propositiontrier").style.display="none";
									document.querySelector(".chevron").style.transform="rotate(0deg)";
									document.querySelector("#resulttag4motderecherche").innerHTML = "none";
									document.querySelector("#resulttag4").style.display="none";
									document.querySelector('#infolevel').innerHTML = "tag3";
									document.querySelector('#infotitre').innerHTML = "" + infotag3 + "";
									document.querySelector('#contenu').innerHTML = xhr.responseText;
									$(".contenueimage").mCustomScrollbar({
										theme:"inset-3"
									});
									$(".contenuetextepublicationtexte").mCustomScrollbar({
										theme:"inset-3"
									});
								}
							};
							
							xhr.send(null);
						}
					</script>
					<a href="#body2"><img src="images/ajoutergallery.png" alt="Ajouter image" class="ajoutergallery" /></a>
					<img src="images/filtrer.png" alt="Filtrer" class="Filtrer" style="display:inline-block;" />
					<img src="images/filtrer.png" alt="Filtrer" class="Filtrererror" style="display:none;" />
				</div>
			<script>
				
				$('a[href^="#"]').click(function(){
				var the_id = $(this).attr("href");
				$("#body2").mCustomScrollbar("scrollTo",$(the_id).offset().top -110, { scrollInertia: 0 }); return false;});
				
				document.querySelector(".ajoutergallery").onclick = function()
				{ 
					if (window.getComputedStyle(document.querySelector('.divajoutergallery')).display=='none')
					{
						document.querySelector(".divajoutergallery").style.display="block";
						setTimeout(function(){document.querySelector(".divajoutergallery").style.opacity="1";},300)
						setTimeout(function(){document.querySelector(".divfiltrer").style.display="none";},500 )
						document.querySelector(".divfiltrer").style.height="0px";
					}
					else
					{
						document.querySelector(".divajoutergallery").style.display="block";
						setTimeout(function(){document.querySelector(".divajoutergallery").style.opacity="1";},300)
						setTimeout(function(){document.querySelector(".divfiltrer").style.display="none";},500 )
						document.querySelector(".divfiltrer").style.height="0px";
					}
				}
				
				// ajout de la classe JS à HTML
				document.querySelector("html").classList.add('js');
				
				// initialisation des variables
				var fileInput  = document.querySelector( ".input-file" ),  
					button     = document.querySelector( ".input-file-trigger" ),
					the_return = document.querySelector(".file-return");
				
				// action lorsque la "barre d'espace" ou "Entrée" est pressée
				button.addEventListener( "keydown", function( event ) {
					if ( event.keyCode == 13 || event.keyCode == 32 ) {
						fileInput.focus();
					}
				});
				
				// action lorsque le label est cliqué
				button.addEventListener( "click", function( event ) {
				fileInput.focus();
				return false;
				});
				
				// affiche un retour visuel dès que input:file change
				fileInput.addEventListener( "change", function( event ) {  
					the_return.innerHTML = this.value;  
				});
				
				function motderechercheerror(theme)
				{
					var xhr = new XMLHttpRequest();

					if(document.getElementById('infotrie').innerHTML == "recent")
					{
						xhr.open('GET', 'site/phpgallery.php?searchrecent=' + theme + '');
					}
					else
					{
						xhr.open('GET', 'site/phpgallery.php?searchmieuxnotes=' + theme + '');
					}
					
					document.querySelector('.divfiltrererror').style.display="none";
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector('.ajoutergallery').style.display="none";
							document.querySelector('.barrederechercheerror').style.display="none";
							document.querySelector('.labelbarrederechercheerror').style.display="none";
							document.querySelector('.barrederecherche').style.display="inline-block";
							document.querySelector('.labelbarrederecherche').style.display="inline-block";
							document.querySelector('.Filtrer').style.display="inline-block";
							document.querySelector(".propositiontrier").style.display="none";
							document.querySelector(".chevron").style.transform="rotate(0deg)";
							document.querySelector(".Filtrer").style.marginTop="-5px";
							document.querySelector(".propositionderecherche").style.marginTop="0px";
							document.querySelector(".propositionderecherche").style.display="inline-block";
							document.querySelector("#resultthememotderecherche").innerHTML = "" + theme + "";
							document.querySelector("#resulttheme").style.display="inline-block";
							document.querySelector('#infolevel').innerHTML = "theme";
							document.querySelector('#infotitre').innerHTML = "" + theme + "";
							document.querySelector('#contenu').innerHTML = xhr.responseText;
							document.querySelector("#resultthemeerror").style.display="none";
							document.querySelector('.Filtrererror').style.display="none";
							document.querySelector('#rechercheimageerror').value = "";
							document.querySelector('#rechercheimage').value = "";
							document.querySelector('#imgsupprimerrechercheerror').style.display="none";
							document.querySelector('.aucunresultaterror').style.display="none";
							document.querySelector('.aucunresultatdiverror').style.display="none";
							document.querySelector('#resultthememotderechercheerror').style.display="none";
							document.querySelector('.errorrecherche').style.display="none";
							$(".contenueimage").mCustomScrollbar({
								theme:"inset-3"
							});
							$(".contenuetextepublicationtexte").mCustomScrollbar({
								theme:"inset-3"
							});
						}
					};
					
					xhr.send(null);
				}
				
				function motderecherche(theme)
				{
					var xhr = new XMLHttpRequest();

					if(document.getElementById('infotrie').innerHTML == "recent")
					{
						xhr.open('GET', 'site/phpgallery.php?searchrecent=' + theme + '');
					}
					else
					{
						xhr.open('GET', 'site/phpgallery.php?searchmieuxnotes=' + theme + '');
					}
					
					document.querySelector(".divfiltrer").style.transition="all 1s;";
					document.querySelector(".divfiltrer").style.height="0px";
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector('.ajoutergallery').style.display="none";
							document.querySelector('#imgsupprimerrechercheerror').style.display="none";
							document.querySelector('.aucunresultaterror').style.display="none";
							document.querySelector('.aucunresultatdiverror').style.display="none";
							document.querySelector('.divfiltrererror').style.display="none";
							document.querySelector('#resultthememotderechercheerror').style.display="none";
							document.querySelector('.errorrecherche').style.display="none";
							document.querySelector('.Filtrer').style.display="inline-block";
							document.querySelector('.Filtrererror').style.display="none";
							document.querySelector("#resultthemeerror").style.display="none";
							document.querySelector(".propositiontrier").style.display="none";
							document.querySelector(".chevron").style.transform="rotate(0deg)";
							document.querySelector(".Filtrer").style.marginTop="-5px";
							document.querySelector(".propositionderecherche").style.marginTop="0px";
							document.querySelector(".propositionderecherche").style.display="inline-block";
							document.querySelector("#resultthememotderecherche").innerHTML = "" + theme + "";
							document.querySelector("#resulttheme").style.display="inline-block";
							document.querySelector('#infolevel').innerHTML = "theme";
							document.querySelector('#infotitre').innerHTML = "" + theme + "";
							document.querySelector('#contenu').innerHTML = xhr.responseText;
							$(".contenueimage").mCustomScrollbar({
								theme:"inset-3"
							});
							$(".contenuetextepublicationtexte").mCustomScrollbar({
								theme:"inset-3"
							});
						}
					};
					
					xhr.send(null);
				}
				
				function motderecherchetheme(tag1)
				{
					var xhr = new XMLHttpRequest();
					var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
					
					if(document.getElementById('infotrie').innerHTML == "recent")
					{
						xhr.open('GET', 'site/phpgallery.php?searchtag1recent=' + tag1 + '&searchtheme=' + infotheme + '');
					}
					else
					{
						xhr.open('GET', 'site/phpgallery.php?searchtag1mieuxnotes=' + tag1 + '&searchtheme=' + infotheme + '');
					}
					
					document.querySelector(".divfiltrer").style.transition="all 1s;";
					document.querySelector(".divfiltrer").style.height="0px";
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector('.ajoutergallery').style.display="none";
							document.querySelector('#imgsupprimerrechercheerror').style.display="none";
							document.querySelector('.aucunresultaterror').style.display="none";
							document.querySelector('.aucunresultatdiverror').style.display="none";
							document.querySelector('.divfiltrererror').style.display="none";
							document.querySelector('#resultthememotderechercheerror').style.display="none";
							document.querySelector('.errorrecherche').style.display="none";
							document.querySelector('.Filtrer').style.display="inline-block";
							document.querySelector('.Filtrererror').style.display="none";
							document.querySelector("#resultthemeerror").style.display="none";
							document.querySelector(".propositiontrier").style.display="none";
							document.querySelector(".chevron").style.transform="rotate(0deg)";
							document.querySelector(".Filtrer").style.marginTop="-5px";
							document.querySelector(".propositionderecherche").style.marginTop="0px";
							document.querySelector(".propositionderecherche").style.display="inline-block";
							document.querySelector("#resulttag1motderecherche").innerHTML = "" + tag1 + "";
							document.querySelector("#resulttag1").style.display="inline-block";
							document.querySelector('#infolevel').innerHTML = "tag1";
							document.querySelector('#infotitre').innerHTML = "" + tag1 + "";
							document.querySelector('#contenu').innerHTML = xhr.responseText;
							$(".contenueimage").mCustomScrollbar({
								theme:"inset-3"
							});
							$(".contenuetextepublicationtexte").mCustomScrollbar({
								theme:"inset-3"
							});
						}
					};
					
					xhr.send(null);
				}
				
				function motderecherchetag1(tag2)
				{
					var xhr = new XMLHttpRequest();
					var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
					var infotag1 = document.querySelector('#resulttag1motderecherche').innerHTML;
					
					if(document.getElementById('infotrie').innerHTML == "recent")
					{
						xhr.open('GET', 'site/phpgallery.php?searchtag2recent=' + tag2 + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '');
					}
					else
					{
						xhr.open('GET', 'site/phpgallery.php?searchtag2mieuxnotes=' + tag2 + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '');
					}
					
					document.querySelector(".divfiltrer").style.transition="all 1s;";
					document.querySelector(".divfiltrer").style.height="0px";
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector('.ajoutergallery').style.display="none";
							document.querySelector('#imgsupprimerrechercheerror').style.display="none";
							document.querySelector('.aucunresultaterror').style.display="none";
							document.querySelector('.aucunresultatdiverror').style.display="none";
							document.querySelector('.divfiltrererror').style.display="none";
							document.querySelector('#resultthememotderechercheerror').style.display="none";
							document.querySelector('.errorrecherche').style.display="none";
							document.querySelector('.Filtrer').style.display="inline-block";
							document.querySelector('.Filtrererror').style.display="none";
							document.querySelector("#resultthemeerror").style.display="none";
							document.querySelector(".propositiontrier").style.display="none";
							document.querySelector(".chevron").style.transform="rotate(0deg)";
							document.querySelector(".Filtrer").style.marginTop="-5px";
							document.querySelector(".propositionderecherche").style.marginTop="0px";
							document.querySelector(".propositionderecherche").style.display="inline-block";
							document.querySelector("#resulttag2motderecherche").innerHTML = "" + tag2 + "";
							document.querySelector("#resulttag2").style.display="inline-block";
							document.querySelector('#infolevel').innerHTML = "tag2";
							document.querySelector('#infotitre').innerHTML = "" + tag2 + "";
							document.querySelector('#contenu').innerHTML = xhr.responseText;
							$(".contenueimage").mCustomScrollbar({
								theme:"inset-3"
							});
							$(".contenuetextepublicationtexte").mCustomScrollbar({
								theme:"inset-3"
							});
						}
					};
					
					xhr.send(null);
				}
				
				function motderecherchetag2(tag3)
				{
					var xhr = new XMLHttpRequest();
					var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
					var infotag1 = document.querySelector('#resulttag1motderecherche').innerHTML;
					var infotag2 = document.querySelector('#resulttag2motderecherche').innerHTML;
					
					if(document.getElementById('infotrie').innerHTML == "recent")
					{
						xhr.open('GET', 'site/phpgallery.php?searchtag3recent=' + tag3 + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '&searchtag2=' + infotag2 + '');
					}
					else
					{
						xhr.open('GET', 'site/phpgallery.php?searchtag3mieuxnotes=' + tag3 + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '&searchtag2=' + infotag2 + '');
					}
					
					document.querySelector(".divfiltrer").style.transition="all 1s;";
					document.querySelector(".divfiltrer").style.height="0px";
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector('.ajoutergallery').style.display="none";
							document.querySelector('#imgsupprimerrechercheerror').style.display="none";
							document.querySelector('.aucunresultaterror').style.display="none";
							document.querySelector('.aucunresultatdiverror').style.display="none";
							document.querySelector('.divfiltrererror').style.display="none";
							document.querySelector('#resultthememotderechercheerror').style.display="none";
							document.querySelector('.errorrecherche').style.display="none";
							document.querySelector('.Filtrer').style.display="inline-block";
							document.querySelector('.Filtrererror').style.display="none";
							document.querySelector("#resultthemeerror").style.display="none";
							document.querySelector(".propositiontrier").style.display="none";
							document.querySelector(".chevron").style.transform="rotate(0deg)";
							document.querySelector(".Filtrer").style.marginTop="-5px";
							document.querySelector(".propositionderecherche").style.marginTop="0px";
							document.querySelector(".propositionderecherche").style.display="inline-block";
							document.querySelector("#resulttag3motderecherche").innerHTML = "" + tag3 + "";
							document.querySelector("#resulttag3").style.display="inline-block";
							document.querySelector('#infolevel').innerHTML = "tag3";
							document.querySelector('#infotitre').innerHTML = "" + tag3 + "";
							document.querySelector('#contenu').innerHTML = xhr.responseText;
							$(".contenueimage").mCustomScrollbar({
								theme:"inset-3"
							});
							$(".contenuetextepublicationtexte").mCustomScrollbar({
								theme:"inset-3"
							});
						}
					};
					
					xhr.send(null);
				}
				
				function motderecherchetag3(tag4)
				{
					var xhr = new XMLHttpRequest();
					var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
					var infotag1 = document.querySelector('#resulttag1motderecherche').innerHTML;
					var infotag2 = document.querySelector('#resulttag2motderecherche').innerHTML;
					var infotag3 = document.querySelector('#resulttag3motderecherche').innerHTML;
					
					if(document.getElementById('infotrie').innerHTML == "recent")
					{
						xhr.open('GET', 'site/phpgallery.php?searchtag4recent=' + tag4 + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '&searchtag2=' + infotag2 + '&searchtag3=' + infotag3 + '');
					}
					else
					{
						xhr.open('GET', 'site/phpgallery.php?searchtag4mieuxnotes=' + tag4 + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '&searchtag2=' + infotag2 + '&searchtag3=' + infotag3 + '');
					}
					
					document.querySelector(".divfiltrer").style.transition="all 1s;";
					document.querySelector(".divfiltrer").style.height="0px";
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector('.ajoutergallery').style.display="none";
							document.querySelector('#imgsupprimerrechercheerror').style.display="none";
							document.querySelector('.aucunresultaterror').style.display="none";
							document.querySelector('.aucunresultatdiverror').style.display="none";
							document.querySelector('.divfiltrererror').style.display="none";
							document.querySelector('#resultthememotderechercheerror').style.display="none";
							document.querySelector('.errorrecherche').style.display="none";
							document.querySelector('.Filtrer').style.display="inline-block";
							document.querySelector('.Filtrererror').style.display="none";
							document.querySelector("#resultthemeerror").style.display="none";
							document.querySelector(".propositiontrier").style.display="none";
							document.querySelector(".chevron").style.transform="rotate(0deg)";
							document.querySelector(".Filtrer").style.marginTop="-5px";
							document.querySelector(".propositionderecherche").style.marginTop="0px";
							document.querySelector(".propositionderecherche").style.display="inline-block";
							document.querySelector("#resulttag4motderecherche").innerHTML = "" + tag4 + "";
							document.querySelector("#resulttag4").style.display="inline-block";
							document.querySelector('#infolevel').innerHTML = "tag4";
							document.querySelector('#infotitre').innerHTML = "" + tag4 + "";
							document.querySelector('#contenu').innerHTML = xhr.responseText;
							$(".contenueimage").mCustomScrollbar({
								theme:"inset-3"
							});
							$(".contenuetextepublicationtexte").mCustomScrollbar({
								theme:"inset-3"
							});
						}
					};
					
					xhr.send(null);
				}
				
				function motderecherchetag4(newtag4)
				{
					var xhr = new XMLHttpRequest();
					var infotheme = document.querySelector('#resultthememotderecherche').innerHTML;
					var infotag1 = document.querySelector('#resulttag1motderecherche').innerHTML;
					var infotag2 = document.querySelector('#resulttag2motderecherche').innerHTML;
					var infotag3 = document.querySelector('#resulttag3motderecherche').innerHTML;
					
					if(document.getElementById('infotrie').innerHTML == "recent")
					{
						xhr.open('GET', 'site/phpgallery.php?searchtag4recent=' + newtag4 + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '&searchtag2=' + infotag2 + '&searchtag3=' + infotag3 + '');
					}
					else
					{
						xhr.open('GET', 'site/phpgallery.php?searchtag4mieuxnotes=' + newtag4 + '&searchtheme=' + infotheme + '&searchtag1=' + infotag1 + '&searchtag2=' + infotag2 + '&searchtag3=' + infotag3 + '');
					}
					
					document.querySelector(".divfiltrer").style.transition="all 1s;";
					document.querySelector(".divfiltrer").style.height="0px";
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector('.ajoutergallery').style.display="none";
							document.querySelector('#imgsupprimerrechercheerror').style.display="none";
							document.querySelector('.aucunresultaterror').style.display="none";
							document.querySelector('.aucunresultatdiverror').style.display="none";
							document.querySelector('.divfiltrererror').style.display="none";
							document.querySelector('#resultthememotderechercheerror').style.display="none";
							document.querySelector('.errorrecherche').style.display="none";
							document.querySelector('.Filtrer').style.display="inline-block";
							document.querySelector('.Filtrererror').style.display="none";
							document.querySelector("#resultthemeerror").style.display="none";
							document.querySelector(".propositiontrier").style.display="none";
							document.querySelector(".chevron").style.transform="rotate(0deg)";
							document.querySelector(".Filtrer").style.marginTop="-5px";
							document.querySelector(".propositionderecherche").style.marginTop="0px";
							document.querySelector(".propositionderecherche").style.display="inline-block";
							document.querySelector("#resulttag4motderecherche").innerHTML = "" + newtag4 + "";
							document.querySelector("#resulttag4").style.display="inline-block";
							document.querySelector('#infolevel').innerHTML = "tag4";
							document.querySelector('#infotitre').innerHTML = "" + newtag4 + "";
							document.querySelector('#contenu').innerHTML = xhr.responseText;
							$(".contenueimage").mCustomScrollbar({
								theme:"inset-3"
							});
							$(".contenuetextepublicationtexte").mCustomScrollbar({
								theme:"inset-3"
							});
						}
					};
					
					xhr.send(null);
				}
				
				document.querySelector(".Filtrer").onclick = function() 
				{ 
					if (window.getComputedStyle(document.querySelector('.divfiltrer')).height=='0px')
					{
						setTimeout(function(){document.querySelector(".divfiltrer").style.display="block";},60)
						setTimeout(function(){document.querySelector(".divfiltrer").style.height="200px";},100)
					}
					else
					{
						setTimeout(function(){document.querySelector(".divfiltrer").style.display="none";},500 )
						document.querySelector(".divfiltrer").style.height="0px";
					}
				}
				
				document.querySelector(".Filtrererror").onclick = function() 
				{ 
					if(window.getComputedStyle(document.querySelector('.divfiltrererror')).height=='0px')
					{
						document.querySelector(".divfiltrererror").style.display="block";
						document.querySelector(".divfiltrererror").style.height="200px";
					}
					else
					{
						document.querySelector(".divfiltrererror").style.display="none";
						document.querySelector(".divfiltrererror").style.height="0px";
					}
				}
				
			</script>
			
			<div class="errorrecherchediv" style="display:none;">
			</div>
			<div class="errorrecherche" style="display:none;">
				<div id="resultthemeerror" style="display:none;">
					<img src="images/supprimerrecherche.png" alt="Supprimer" class="imgsupprimerrecherche" id="imgsupprimerrechercheerror" onclick="resultthemeimgsupprimerrechercheerror()" style="display:none;" />
					<p class="motderecherche" id="resultthememotderechercheerror" style="display:none;">none</p>
				</div>
				
				<div class="divfiltrererror" style="display:none;">
					<br />
					<?php
						$recherchetagserror = $db->query('SELECT theme, COUNT(*) AS nbtheme FROM gallery GROUP BY theme ORDER BY nbtheme DESC');
						While($tagserror = $recherchetagserror->fetch())
						{
						?>
							<p class="motderecherchefiltreerror" onclick="motderechercheerror('<?php echo $tagserror['theme']; ?>')" style="padding-left:7px;cursor:pointer;"><?php echo $tagserror['theme']; ?></p>						
						<?php
						}
						$recherchetagserror->CloseCursor();
					?>
				</div>
				
				<div class="aucunresultatdiverror" style="display:none;">
					<p class="aucunresultaterror" style="display:none;">Aucun résultat</p>
				</div>
			</div>
			
			<section id="contenu">	
				<div class="divfiltrer">
				<br />
				<?php
					$recherchetags = $db->query('SELECT theme, COUNT(*) AS nbtheme FROM gallery GROUP BY theme ORDER BY nbtheme DESC');
					While($tags = $recherchetags->fetch())
					{
					?>
						<p class="motderecherchefiltre" onclick="motderecherche('<?php echo $tags['theme']; ?>')" style="padding-left:7px;cursor:pointer;"><?php echo $tags['theme']; ?></p>						
					<?php
					}
					$recherchetags->CloseCursor();
				?>
				</div>
				<?php
					$nbafficheimggallery2 = $db->query('SELECT COUNT(*) AS nbimg2 FROM gallery');
					$nbafficheimg2 = $nbafficheimggallery2->fetch();
					
					if($nbafficheimg2['nbimg2'] <= 4)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,1');
					}
					else if($nbafficheimg2['nbimg2'] > 4 AND $nbafficheimg2['nbimg2'] <= 8)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,2');
					}
					else if($nbafficheimg2['nbimg2'] > 8 AND $nbafficheimg2['nbimg2'] <= 12)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,3');
					}
					else if($nbafficheimg2['nbimg2'] > 12 AND $nbafficheimg2['nbimg2'] <= 16)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,4');
					}
					else if($nbafficheimg2['nbimg2'] > 16 AND $nbafficheimg2['nbimg2'] <= 20)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,5');
					}
					else if($nbafficheimg2['nbimg2'] > 20 AND $nbafficheimg2['nbimg2'] <= 24)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,6');
					}
					else if($nbafficheimg2['nbimg2'] > 24 AND $nbafficheimg2['nbimg2'] <= 28)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,7');
					}
					else if($nbafficheimg2['nbimg2'] > 28 AND $nbafficheimg2['nbimg2'] <= 32)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,8');
					}
					else if($nbafficheimg2['nbimg2'] > 32 AND $nbafficheimg2['nbimg2'] <= 36)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,9');
					}
					else if($nbafficheimg2['nbimg2'] > 36 AND $nbafficheimg2['nbimg2'] <= 40)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,10');
					}
					else if($nbafficheimg2['nbimg2'] > 40 AND $nbafficheimg2['nbimg2'] <= 44)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,11');
					}
					else if($nbafficheimg2['nbimg2'] > 44 AND $nbafficheimg2['nbimg2'] <= 48)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,12');
					}
					else if($nbafficheimg2['nbimg2'] > 48 AND $nbafficheimg2['nbimg2'] <= 52)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,13');
					}
					else if($nbafficheimg2['nbimg2'] > 52 AND $nbafficheimg2['nbimg2'] <= 56)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,14');
					}
					else if($nbafficheimg2['nbimg2'] > 56 AND $nbafficheimg2['nbimg2'] <= 60)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,15');
					}
					else if($nbafficheimg2['nbimg2'] > 60 AND $nbafficheimg2['nbimg2'] <= 64)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,16');
					}
					else if($nbafficheimg2['nbimg2'] > 64 AND $nbafficheimg2['nbimg2'] <= 68)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,17');
					}
					else if($nbafficheimg2['nbimg2'] > 68 AND $nbafficheimg2['nbimg2'] <= 72)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,18');
					}
					else if($nbafficheimg2['nbimg2'] > 72 AND $nbafficheimg2['nbimg2'] <= 76)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,19');
					}
					else if($nbafficheimg2['nbimg2'] > 76 AND $nbafficheimg2['nbimg2'] <= 80)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,20');
					}
					else if($nbafficheimg2['nbimg2'] > 80 AND $nbafficheimg2['nbimg2'] <= 84)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,21');
					}
					else if($nbafficheimg2['nbimg2'] > 84 AND $nbafficheimg2['nbimg2'] <= 88)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,22');
					}
					else if($nbafficheimg2['nbimg2'] > 88 AND $nbafficheimg2['nbimg2'] <= 92)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,23');
					}
					else if($nbafficheimg2['nbimg2'] > 92 AND $nbafficheimg2['nbimg2'] <= 96)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,24');
					}
					else if($nbafficheimg2['nbimg2'] > 96 AND $nbafficheimg2['nbimg2'] <= 100)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,25');
					}
					else if($nbafficheimg2['nbimg2'] > 100 AND $nbafficheimg2['nbimg2'] <= 104)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,26');
					}
					else if($nbafficheimg2['nbimg2'] > 104 AND $nbafficheimg2['nbimg2'] <= 108)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,27');
					}
					else if($nbafficheimg2['nbimg2'] > 108 AND $nbafficheimg2['nbimg2'] <= 112)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,28');
					}
					else if($nbafficheimg2['nbimg2'] > 112 AND $nbafficheimg2['nbimg2'] <= 116)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,29');
					}
					else if($nbafficheimg2['nbimg2'] > 116 AND $nbafficheimg2['nbimg2'] <= 120)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,30');
					}
					else if($nbafficheimg2['nbimg2'] > 120 AND $nbafficheimg2['nbimg2'] <= 124)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,31');
					}
					else if($nbafficheimg2['nbimg2'] > 124 AND $nbafficheimg2['nbimg2'] <= 128)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,32');
					}
					else if($nbafficheimg2['nbimg2'] > 128 AND $nbafficheimg2['nbimg2'] <= 132)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,33');
					}
					else if($nbafficheimg2['nbimg2'] > 132 AND $nbafficheimg2['nbimg2'] <= 136)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,34');
					}
					else if($nbafficheimg2['nbimg2'] > 136 AND $nbafficheimg2['nbimg2'] <= 140)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,35');
					}
					else if($nbafficheimg2['nbimg2'] > 140 AND $nbafficheimg2['nbimg2'] <= 144)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,36');
					}
					else if($nbafficheimg2['nbimg2'] > 144 AND $nbafficheimg2['nbimg2'] <= 148)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,37');
					}
					else if($nbafficheimg2['nbimg2'] > 148 AND $nbafficheimg2['nbimg2'] <= 152)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,38');
					}
					else if($nbafficheimg2['nbimg2'] > 152 AND $nbafficheimg2['nbimg2'] <= 156)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,39');
					}
					else if($nbafficheimg2['nbimg2'] > 156 AND $nbafficheimg2['nbimg2'] <= 160)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,40');
					}
					else if($nbafficheimg2['nbimg2'] > 160 AND $nbafficheimg2['nbimg2'] <= 164)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,41');
					}
					else if($nbafficheimg2['nbimg2'] > 164 AND $nbafficheimg2['nbimg2'] <= 168)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,42');
					}
					else if($nbafficheimg2['nbimg2'] > 168 AND $nbafficheimg2['nbimg2'] <= 172)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,43');
					}
					else if($nbafficheimg2['nbimg2'] > 172 AND $nbafficheimg2['nbimg2'] <= 176)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,44');
					}
					else if($nbafficheimg2['nbimg2'] > 176 AND $nbafficheimg2['nbimg2'] <= 180)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,45');
					}
					else if($nbafficheimg2['nbimg2'] > 180 AND $nbafficheimg2['nbimg2'] <= 184)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,46');
					}
					else if($nbafficheimg2['nbimg2'] > 184 AND $nbafficheimg2['nbimg2'] <= 188)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,47');
					}
					else if($nbafficheimg2['nbimg2'] > 188 AND $nbafficheimg2['nbimg2'] <= 192)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,48');
					}
					else if($nbafficheimg2['nbimg2'] > 192 AND $nbafficheimg2['nbimg2'] <= 196)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,49');
					}
					else if($nbafficheimg2['nbimg2'] > 196 AND $nbafficheimg2['nbimg2'] <= 200)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,50');
					}
					else if($nbafficheimg2['nbimg2'] > 200 AND $nbafficheimg2['nbimg2'] <= 204)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,51');
					}
					else if($nbafficheimg2['nbimg2'] > 204 AND $nbafficheimg2['nbimg2'] <= 208)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,52');
					}
					else if($nbafficheimg2['nbimg2'] > 208 AND $nbafficheimg2['nbimg2'] <= 212)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,53');
					}
					else if($nbafficheimg2['nbimg2'] > 212 AND $nbafficheimg2['nbimg2'] <= 216)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,54');
					}
					else if($nbafficheimg2['nbimg2'] > 216 AND $nbafficheimg2['nbimg2'] <= 220)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,55');
					}
					else if($nbafficheimg2['nbimg2'] > 220 AND $nbafficheimg2['nbimg2'] <= 224)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,56');
					}
					else if($nbafficheimg2['nbimg2'] > 224 AND $nbafficheimg2['nbimg2'] <= 228)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,57');
					}
					else if($nbafficheimg2['nbimg2'] > 228 AND $nbafficheimg2['nbimg2'] <= 232)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,58');
					}
					else if($nbafficheimg2['nbimg2'] > 232 AND $nbafficheimg2['nbimg2'] <= 236)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,59');
					}
					else if($nbafficheimg2['nbimg2'] > 236 AND $nbafficheimg2['nbimg2'] <= 240)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,60');
					}
					else if($nbafficheimg2['nbimg2'] > 240 AND $nbafficheimg2['nbimg2'] <= 244)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,61');
					}
					else if($nbafficheimg2['nbimg2'] > 244 AND $nbafficheimg2['nbimg2'] <= 248)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,62');
					}
					else if($nbafficheimg2['nbimg2'] > 248 AND $nbafficheimg2['nbimg2'] <= 252)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,63');
					}
					else if($nbafficheimg2['nbimg2'] > 252 AND $nbafficheimg2['nbimg2'] <= 256)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,64');
					}
					else if($nbafficheimg2['nbimg2'] > 256 AND $nbafficheimg2['nbimg2'] <= 260)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,65');
					}
					else if($nbafficheimg2['nbimg2'] > 260 AND $nbafficheimg2['nbimg2'] <= 264)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,66');
					}
					else if($nbafficheimg2['nbimg2'] > 264 AND $nbafficheimg2['nbimg2'] <= 268)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,67');
					}
					else if($nbafficheimg2['nbimg2'] > 268 AND $nbafficheimg2['nbimg2'] <= 272)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,68');
					}
					else if($nbafficheimg2['nbimg2'] > 272 AND $nbafficheimg2['nbimg2'] <= 276)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,69');
					}
					else if($nbafficheimg2['nbimg2'] > 276 AND $nbafficheimg2['nbimg2'] <= 280)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,70');
					}
					else if($nbafficheimg2['nbimg2'] > 280 AND $nbafficheimg2['nbimg2'] <= 284)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,71');
					}
					else if($nbafficheimg2['nbimg2'] > 284 AND $nbafficheimg2['nbimg2'] <= 288)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,72');
					}
					else if($nbafficheimg2['nbimg2'] > 288 AND $nbafficheimg2['nbimg2'] <= 292)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,73');
					}
					else if($nbafficheimg2['nbimg2'] > 292 AND $nbafficheimg2['nbimg2'] <= 296)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,74');
					}
					else if($nbafficheimg2['nbimg2'] > 296 AND $nbafficheimg2['nbimg2'] <= 300)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,75');
					}
					else if($nbafficheimg2['nbimg2'] > 300 AND $nbafficheimg2['nbimg2'] <= 304)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,76');
					}
					else if($nbafficheimg2['nbimg2'] > 304 AND $nbafficheimg2['nbimg2'] <= 308)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,77');
					}
					else if($nbafficheimg2['nbimg2'] > 308 AND $nbafficheimg2['nbimg2'] <= 312)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,78');
					}
					else if($nbafficheimg2['nbimg2'] > 312 AND $nbafficheimg2['nbimg2'] <= 316)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,79');
					}
					else if($nbafficheimg2['nbimg2'] > 316 AND $nbafficheimg2['nbimg2'] <= 320)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,80');
					}
					else if($nbafficheimg2['nbimg2'] > 320 AND $nbafficheimg2['nbimg2'] <= 324)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,81');
					}
					else if($nbafficheimg2['nbimg2'] > 324 AND $nbafficheimg2['nbimg2'] <= 328)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,82');
					}
					else if($nbafficheimg2['nbimg2'] > 328 AND $nbafficheimg2['nbimg2'] <= 332)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,83');
					}
					else if($nbafficheimg2['nbimg2'] > 332 AND $nbafficheimg2['nbimg2'] <= 336)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,84');
					}
					else if($nbafficheimg2['nbimg2'] > 336 AND $nbafficheimg2['nbimg2'] <= 340)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,85');
					}
					else if($nbafficheimg2['nbimg2'] > 340 AND $nbafficheimg2['nbimg2'] <= 344)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,86');
					}
					else if($nbafficheimg2['nbimg2'] > 344 AND $nbafficheimg2['nbimg2'] <= 348)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,87');
					}
					else if($nbafficheimg2['nbimg2'] > 348 AND $nbafficheimg2['nbimg2'] <= 352)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,88');
					}
					else if($nbafficheimg2['nbimg2'] > 352 AND $nbafficheimg2['nbimg2'] <= 356)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,89');
					}
					else if($nbafficheimg2['nbimg2'] > 356 AND $nbafficheimg2['nbimg2'] <= 360)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,90');
					}
					else if($nbafficheimg2['nbimg2'] > 360 AND $nbafficheimg2['nbimg2'] <= 364)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,91');
					}
					else if($nbafficheimg2['nbimg2'] > 364 AND $nbafficheimg2['nbimg2'] <= 368)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,92');
					}
					else if($nbafficheimg2['nbimg2'] > 368 AND $nbafficheimg2['nbimg2'] <= 372)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,93');
					}
					else if($nbafficheimg2['nbimg2'] > 372 AND $nbafficheimg2['nbimg2'] <= 376)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,94');
					}
					else if($nbafficheimg2['nbimg2'] > 376 AND $nbafficheimg2['nbimg2'] <= 380)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,95');
					}
					else if($nbafficheimg2['nbimg2'] > 380 AND $nbafficheimg2['nbimg2'] <= 384)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,96');
					}
					else if($nbafficheimg2['nbimg2'] > 384 AND $nbafficheimg2['nbimg2'] <= 388)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,97');
					}
					else if($nbafficheimg2['nbimg2'] > 388 AND $nbafficheimg2['nbimg2'] <= 392)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,98');
					}
					else if($nbafficheimg2['nbimg2'] > 392 AND $nbafficheimg2['nbimg2'] <= 396)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,99');
					}
					else if($nbafficheimg2['nbimg2'] > 396 AND $nbafficheimg2['nbimg2'] <= 400)
					{
						$afficheimggallery1 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 0,100');
					}
				?>
				
				<div class="colonne" id="colonne1">
				<?php
					while($imggallery1 = $afficheimggallery1->fetch())
					{
				?>
					<div id="colonneimg<?php echo $imggallery1['ID']; ?>" onclick="colonneimg<?php echo $imggallery1['ID']; ?>()">
						<div class="filtrenoirimage"><img src="gallery/<?php echo htmlspecialchars($imggallery1['image']); ?>" class="filtrenoirimagebackground" /><img src="images/agrandir.png" alt="Agrandir" class="imageagrandir" /></div>
						<img src="gallery/<?php echo htmlspecialchars($imggallery1['image']); ?>" alt="Image" class="imagegallery" />
					</div>
				<?php
					}
					$afficheimggallery1->closeCursor();
				?>
				</div>
				
				<?php

					if($nbafficheimg2['nbimg2'] <= 4)
					{
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 1,1');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 4 AND $nbafficheimg2['nbimg2'] <= 8)            
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 2,2');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 8 AND $nbafficheimg2['nbimg2'] <= 12)           
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 3,3');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 12 AND $nbafficheimg2['nbimg2'] <= 16)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 4,4');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 16 AND $nbafficheimg2['nbimg2'] <= 20)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 5,5');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 20 AND $nbafficheimg2['nbimg2'] <= 24)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 6,6');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 24 AND $nbafficheimg2['nbimg2'] <= 28)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 7,7');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 28 AND $nbafficheimg2['nbimg2'] <= 32)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 8,8');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 32 AND $nbafficheimg2['nbimg2'] <= 36)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 9,9');
					}
					else if($nbafficheimg2['nbimg2'] > 36 AND $nbafficheimg2['nbimg2'] <= 40)
					{
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 10,10');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 40 AND $nbafficheimg2['nbimg2'] <= 44)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 11,11');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 44 AND $nbafficheimg2['nbimg2'] <= 48)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 12,12');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 48 AND $nbafficheimg2['nbimg2'] <= 52)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 13,13');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 52 AND $nbafficheimg2['nbimg2'] <= 56)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 14,14');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 56 AND $nbafficheimg2['nbimg2'] <= 60)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 15,15');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 60 AND $nbafficheimg2['nbimg2'] <= 64)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 16,16');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 64 AND $nbafficheimg2['nbimg2'] <= 68)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 17,17');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 68 AND $nbafficheimg2['nbimg2'] <= 72)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 18,18');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 72 AND $nbafficheimg2['nbimg2'] <= 76)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 19,19');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 76 AND $nbafficheimg2['nbimg2'] <= 80)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 20,20');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 80 AND $nbafficheimg2['nbimg2'] <= 84)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 21,21');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 84 AND $nbafficheimg2['nbimg2'] <= 88)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 22,22');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 88 AND $nbafficheimg2['nbimg2'] <= 92)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 23,23');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 92 AND $nbafficheimg2['nbimg2'] <= 96)          
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 24,24');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 96 AND $nbafficheimg2['nbimg2'] <= 100)         
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 25,25');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 100 AND $nbafficheimg2['nbimg2'] <= 104)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 26,26');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 104 AND $nbafficheimg2['nbimg2'] <= 108)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 27,27');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 108 AND $nbafficheimg2['nbimg2'] <= 112)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 28,28');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 112 AND $nbafficheimg2['nbimg2'] <= 116)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 29,29');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 116 AND $nbafficheimg2['nbimg2'] <= 120)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 30,30');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 120 AND $nbafficheimg2['nbimg2'] <= 124)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 31,31');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 124 AND $nbafficheimg2['nbimg2'] <= 128)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 32,32');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 128 AND $nbafficheimg2['nbimg2'] <= 132)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 33,33');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 132 AND $nbafficheimg2['nbimg2'] <= 136)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 34,34');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 136 AND $nbafficheimg2['nbimg2'] <= 140)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 35,35');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 140 AND $nbafficheimg2['nbimg2'] <= 144)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 36,36');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 144 AND $nbafficheimg2['nbimg2'] <= 148)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 37,37');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 148 AND $nbafficheimg2['nbimg2'] <= 152)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 38,38');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 152 AND $nbafficheimg2['nbimg2'] <= 156)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 39,39');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 156 AND $nbafficheimg2['nbimg2'] <= 160)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 40,40');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 160 AND $nbafficheimg2['nbimg2'] <= 164)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 41,41');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 164 AND $nbafficheimg2['nbimg2'] <= 168)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 42,42');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 168 AND $nbafficheimg2['nbimg2'] <= 172)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 43,43');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 172 AND $nbafficheimg2['nbimg2'] <= 176)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 44,44');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 176 AND $nbafficheimg2['nbimg2'] <= 180)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 45,45');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 180 AND $nbafficheimg2['nbimg2'] <= 184)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 46,46');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 184 AND $nbafficheimg2['nbimg2'] <= 188)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 47,47');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 188 AND $nbafficheimg2['nbimg2'] <= 192)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 48,48');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 192 AND $nbafficheimg2['nbimg2'] <= 196)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 49,49');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 196 AND $nbafficheimg2['nbimg2'] <= 200)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 50,50');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 200 AND $nbafficheimg2['nbimg2'] <= 204)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 51,51');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 204 AND $nbafficheimg2['nbimg2'] <= 208)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 52,52');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 208 AND $nbafficheimg2['nbimg2'] <= 212)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 53,53');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 212 AND $nbafficheimg2['nbimg2'] <= 216)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 54,54');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 216 AND $nbafficheimg2['nbimg2'] <= 220)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 55,55');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 220 AND $nbafficheimg2['nbimg2'] <= 224)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 56,56');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 224 AND $nbafficheimg2['nbimg2'] <= 228)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 57,57');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 228 AND $nbafficheimg2['nbimg2'] <= 232)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 58,58');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 232 AND $nbafficheimg2['nbimg2'] <= 236)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 59,59');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 236 AND $nbafficheimg2['nbimg2'] <= 240)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 60,60');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 240 AND $nbafficheimg2['nbimg2'] <= 244)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 61,61');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 244 AND $nbafficheimg2['nbimg2'] <= 248)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 62,62');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 248 AND $nbafficheimg2['nbimg2'] <= 252)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 63,63');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 252 AND $nbafficheimg2['nbimg2'] <= 256)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 64,64');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 256 AND $nbafficheimg2['nbimg2'] <= 260)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 65,65');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 260 AND $nbafficheimg2['nbimg2'] <= 264)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 66,66');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 264 AND $nbafficheimg2['nbimg2'] <= 268)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 67,67');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 268 AND $nbafficheimg2['nbimg2'] <= 272)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 68,68');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 272 AND $nbafficheimg2['nbimg2'] <= 276)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 69,69');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 276 AND $nbafficheimg2['nbimg2'] <= 280)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 70,70');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 280 AND $nbafficheimg2['nbimg2'] <= 284)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 71,71');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 284 AND $nbafficheimg2['nbimg2'] <= 288)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 72,72');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 288 AND $nbafficheimg2['nbimg2'] <= 292)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 73,73');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 292 AND $nbafficheimg2['nbimg2'] <= 296)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 74,74');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 296 AND $nbafficheimg2['nbimg2'] <= 300)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 75,75');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 300 AND $nbafficheimg2['nbimg2'] <= 304)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 76,76');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 304 AND $nbafficheimg2['nbimg2'] <= 308)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 77,77');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 308 AND $nbafficheimg2['nbimg2'] <= 312)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 78,78');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 312 AND $nbafficheimg2['nbimg2'] <= 316)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 79,79');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 316 AND $nbafficheimg2['nbimg2'] <= 320)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 80,80');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 320 AND $nbafficheimg2['nbimg2'] <= 324)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 81,81');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 324 AND $nbafficheimg2['nbimg2'] <= 328)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 82,82');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 328 AND $nbafficheimg2['nbimg2'] <= 332)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 83,83');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 332 AND $nbafficheimg2['nbimg2'] <= 336)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 84,84');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 336 AND $nbafficheimg2['nbimg2'] <= 340)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 85,85');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 340 AND $nbafficheimg2['nbimg2'] <= 344)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 86,86');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 344 AND $nbafficheimg2['nbimg2'] <= 348)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 87,87');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 348 AND $nbafficheimg2['nbimg2'] <= 352)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 88,88');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 352 AND $nbafficheimg2['nbimg2'] <= 356)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 89,89');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 356 AND $nbafficheimg2['nbimg2'] <= 360)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 90,90');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 360 AND $nbafficheimg2['nbimg2'] <= 364)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 91,91');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 364 AND $nbafficheimg2['nbimg2'] <= 368)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 92,92');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 368 AND $nbafficheimg2['nbimg2'] <= 372)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 93,93');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 372 AND $nbafficheimg2['nbimg2'] <= 376)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 94,94');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 376 AND $nbafficheimg2['nbimg2'] <= 380)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 95,95');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 380 AND $nbafficheimg2['nbimg2'] <= 384)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 96,96');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 384 AND $nbafficheimg2['nbimg2'] <= 388)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 97,97');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 388 AND $nbafficheimg2['nbimg2'] <= 392)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 98,98');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 392 AND $nbafficheimg2['nbimg2'] <= 396)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 99,99');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 396 AND $nbafficheimg2['nbimg2'] <= 400)        
					{                                                                                  
						$afficheimggallery2 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 100,100');
					}
				?>
				
				<div class="colonne" id="colonne2">
				<?php
					while($imggallery2 = $afficheimggallery2->fetch())
					{
				?>
					<div id="colonneimg<?php echo $imggallery2['ID']; ?>" onclick="colonneimg<?php echo $imggallery2['ID']; ?>()">
					<div class="filtrenoirimage" ><img src="gallery/<?php echo htmlspecialchars($imggallery2['image']); ?>" class="filtrenoirimagebackground" /><img src="images/agrandir.png" alt="Agrandir" class="imageagrandir" /></div>
					<img src="gallery/<?php echo htmlspecialchars($imggallery2['image']); ?>" alt="Image" class="imagegallery" />
					</div>
				<?php
					}
					$afficheimggallery2->closeCursor();
				?>
				</div>
				
				<?php
				
					if($nbafficheimg2['nbimg2'] <= 4)
					{
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 2,1');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 4 AND $nbafficheimg2['nbimg2'] <= 8)            
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 4,2');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 8 AND $nbafficheimg2['nbimg2'] <= 12)           
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 6,3');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 12 AND $nbafficheimg2['nbimg2'] <= 16)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 8,4');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 16 AND $nbafficheimg2['nbimg2'] <= 20)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 10,5');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 20 AND $nbafficheimg2['nbimg2'] <= 24)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 12,6');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 24 AND $nbafficheimg2['nbimg2'] <= 28)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 14,7');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 28 AND $nbafficheimg2['nbimg2'] <= 32)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 16,8');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 32 AND $nbafficheimg2['nbimg2'] <= 36)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 18,9');
					}
					else if($nbafficheimg2['nbimg2'] > 36 AND $nbafficheimg2['nbimg2'] <= 40)
					{
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 20,10');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 40 AND $nbafficheimg2['nbimg2'] <= 44)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 22,11');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 44 AND $nbafficheimg2['nbimg2'] <= 48)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 24,12');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 48 AND $nbafficheimg2['nbimg2'] <= 52)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 26,13');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 52 AND $nbafficheimg2['nbimg2'] <= 56)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 28,14');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 56 AND $nbafficheimg2['nbimg2'] <= 60)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 30,15');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 60 AND $nbafficheimg2['nbimg2'] <= 64)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 32,16');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 64 AND $nbafficheimg2['nbimg2'] <= 68)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 34,17');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 68 AND $nbafficheimg2['nbimg2'] <= 72)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 36,18');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 72 AND $nbafficheimg2['nbimg2'] <= 76)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 38,19');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 76 AND $nbafficheimg2['nbimg2'] <= 80)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 40,20');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 80 AND $nbafficheimg2['nbimg2'] <= 84)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 42,21');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 84 AND $nbafficheimg2['nbimg2'] <= 88)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 44,22');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 88 AND $nbafficheimg2['nbimg2'] <= 92)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 46,23');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 92 AND $nbafficheimg2['nbimg2'] <= 96)          
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 48,24');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 96 AND $nbafficheimg2['nbimg2'] <= 100)         
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 50,25');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 100 AND $nbafficheimg2['nbimg2'] <= 104)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 52,26');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 104 AND $nbafficheimg2['nbimg2'] <= 108)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 54,27');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 108 AND $nbafficheimg2['nbimg2'] <= 112)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 56,28');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 112 AND $nbafficheimg2['nbimg2'] <= 116)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 58,29');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 116 AND $nbafficheimg2['nbimg2'] <= 120)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 60,30');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 120 AND $nbafficheimg2['nbimg2'] <= 124)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 62,31');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 124 AND $nbafficheimg2['nbimg2'] <= 128)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 64,32');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 128 AND $nbafficheimg2['nbimg2'] <= 132)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 66,33');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 132 AND $nbafficheimg2['nbimg2'] <= 136)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 68,34');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 136 AND $nbafficheimg2['nbimg2'] <= 140)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 70,35');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 140 AND $nbafficheimg2['nbimg2'] <= 144)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 72,36');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 144 AND $nbafficheimg2['nbimg2'] <= 148)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 74,37');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 148 AND $nbafficheimg2['nbimg2'] <= 152)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 76,38');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 152 AND $nbafficheimg2['nbimg2'] <= 156)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 78,39');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 156 AND $nbafficheimg2['nbimg2'] <= 160)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 80,40');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 160 AND $nbafficheimg2['nbimg2'] <= 164)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 82,41');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 164 AND $nbafficheimg2['nbimg2'] <= 168)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 84,42');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 168 AND $nbafficheimg2['nbimg2'] <= 172)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 86,43');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 172 AND $nbafficheimg2['nbimg2'] <= 176)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 88,44');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 176 AND $nbafficheimg2['nbimg2'] <= 180)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 90,45');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 180 AND $nbafficheimg2['nbimg2'] <= 184)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 92,46');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 184 AND $nbafficheimg2['nbimg2'] <= 188)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 94,47');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 188 AND $nbafficheimg2['nbimg2'] <= 192)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 96,48');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 192 AND $nbafficheimg2['nbimg2'] <= 196)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 98,49');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 196 AND $nbafficheimg2['nbimg2'] <= 200)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 100,50');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 200 AND $nbafficheimg2['nbimg2'] <= 204)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 102,51');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 204 AND $nbafficheimg2['nbimg2'] <= 208)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 104,52');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 208 AND $nbafficheimg2['nbimg2'] <= 212)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 106,53');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 212 AND $nbafficheimg2['nbimg2'] <= 216)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 108,54');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 216 AND $nbafficheimg2['nbimg2'] <= 220)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 110,55');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 220 AND $nbafficheimg2['nbimg2'] <= 224)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 112,56');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 224 AND $nbafficheimg2['nbimg2'] <= 228)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 114,57');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 228 AND $nbafficheimg2['nbimg2'] <= 232)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 116,58');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 232 AND $nbafficheimg2['nbimg2'] <= 236)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 118,59');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 236 AND $nbafficheimg2['nbimg2'] <= 240)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 120,60');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 240 AND $nbafficheimg2['nbimg2'] <= 244)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 122,61');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 244 AND $nbafficheimg2['nbimg2'] <= 248)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 124,62');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 248 AND $nbafficheimg2['nbimg2'] <= 252)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 126,63');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 252 AND $nbafficheimg2['nbimg2'] <= 256)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 128,64');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 256 AND $nbafficheimg2['nbimg2'] <= 260)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 130,65');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 260 AND $nbafficheimg2['nbimg2'] <= 264)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 132,66');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 264 AND $nbafficheimg2['nbimg2'] <= 268)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 134,67');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 268 AND $nbafficheimg2['nbimg2'] <= 272)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 136,68');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 272 AND $nbafficheimg2['nbimg2'] <= 276)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 138,69');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 276 AND $nbafficheimg2['nbimg2'] <= 280)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 140,70');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 280 AND $nbafficheimg2['nbimg2'] <= 284)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 142,71');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 284 AND $nbafficheimg2['nbimg2'] <= 288)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 144,72');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 288 AND $nbafficheimg2['nbimg2'] <= 292)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 146,73');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 292 AND $nbafficheimg2['nbimg2'] <= 296)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 148,74');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 296 AND $nbafficheimg2['nbimg2'] <= 300)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 150,75');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 300 AND $nbafficheimg2['nbimg2'] <= 304)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 152,76');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 304 AND $nbafficheimg2['nbimg2'] <= 308)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 154,77');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 308 AND $nbafficheimg2['nbimg2'] <= 312)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 156,78');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 312 AND $nbafficheimg2['nbimg2'] <= 316)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 158,79');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 316 AND $nbafficheimg2['nbimg2'] <= 320)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 160,80');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 320 AND $nbafficheimg2['nbimg2'] <= 324)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 162,81');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 324 AND $nbafficheimg2['nbimg2'] <= 328)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 164,82');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 328 AND $nbafficheimg2['nbimg2'] <= 332)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 166,83');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 332 AND $nbafficheimg2['nbimg2'] <= 336)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 168,84');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 336 AND $nbafficheimg2['nbimg2'] <= 340)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 170,85');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 340 AND $nbafficheimg2['nbimg2'] <= 344)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 172,86');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 344 AND $nbafficheimg2['nbimg2'] <= 348)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 174,87');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 348 AND $nbafficheimg2['nbimg2'] <= 352)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 176,88');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 352 AND $nbafficheimg2['nbimg2'] <= 356)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 178,89');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 356 AND $nbafficheimg2['nbimg2'] <= 360)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 180,90');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 360 AND $nbafficheimg2['nbimg2'] <= 364)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 182,91');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 364 AND $nbafficheimg2['nbimg2'] <= 368)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 184,92');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 368 AND $nbafficheimg2['nbimg2'] <= 372)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 186,93');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 372 AND $nbafficheimg2['nbimg2'] <= 376)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 188,94');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 376 AND $nbafficheimg2['nbimg2'] <= 380)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 190,95');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 380 AND $nbafficheimg2['nbimg2'] <= 384)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 192,96');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 384 AND $nbafficheimg2['nbimg2'] <= 388)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 194,97');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 388 AND $nbafficheimg2['nbimg2'] <= 392)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 196,98');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 392 AND $nbafficheimg2['nbimg2'] <= 396)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 198,99');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 396 AND $nbafficheimg2['nbimg2'] <= 400)        
					{                                                                                  
						$afficheimggallery3 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 200,100');
					}				
				?>
				
				<div class="colonne" id="colonne3">
				<?php
					while($imggallery3 = $afficheimggallery3->fetch())
					{
				?>
					<div id="colonneimg<?php echo $imggallery3['ID']; ?>" onclick="colonneimg<?php echo $imggallery3['ID']; ?>()">
					<div class="filtrenoirimage" ><img src="gallery/<?php echo htmlspecialchars($imggallery3['image']); ?>" class="filtrenoirimagebackground" /><img src="images/agrandir.png" alt="Agrandir" class="imageagrandir" /></div>
					<img src="gallery/<?php echo htmlspecialchars($imggallery3['image']); ?>" alt="Image" class="imagegallery" />
					</div>
				<?php
					}
					$afficheimggallery3->closeCursor();
				?>
				</div>
				
				<?php
				
					if($nbafficheimg2['nbimg2'] <= 4)
					{
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 3,1');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 4 AND $nbafficheimg2['nbimg2'] <= 8)            
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 6,2');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 8 AND $nbafficheimg2['nbimg2'] <= 12)           
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 9,3');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 12 AND $nbafficheimg2['nbimg2'] <= 16)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 12,4');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 16 AND $nbafficheimg2['nbimg2'] <= 20)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 15,5');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 20 AND $nbafficheimg2['nbimg2'] <= 24)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 18,6');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 24 AND $nbafficheimg2['nbimg2'] <= 28)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 21,7');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 28 AND $nbafficheimg2['nbimg2'] <= 32)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 24,8');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 32 AND $nbafficheimg2['nbimg2'] <= 36)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 27,9');
					}
					else if($nbafficheimg2['nbimg2'] > 36 AND $nbafficheimg2['nbimg2'] <= 40)
					{
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 30,10');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 40 AND $nbafficheimg2['nbimg2'] <= 44)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 33,11');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 44 AND $nbafficheimg2['nbimg2'] <= 48)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 36,12');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 48 AND $nbafficheimg2['nbimg2'] <= 52)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 39,13');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 52 AND $nbafficheimg2['nbimg2'] <= 56)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 42,14');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 56 AND $nbafficheimg2['nbimg2'] <= 60)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 45,15');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 60 AND $nbafficheimg2['nbimg2'] <= 64)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 48,16');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 64 AND $nbafficheimg2['nbimg2'] <= 68)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 51,17');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 68 AND $nbafficheimg2['nbimg2'] <= 72)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 54,18');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 72 AND $nbafficheimg2['nbimg2'] <= 76)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 57,19');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 76 AND $nbafficheimg2['nbimg2'] <= 80)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 60,20');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 80 AND $nbafficheimg2['nbimg2'] <= 84)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 63,21');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 84 AND $nbafficheimg2['nbimg2'] <= 88)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 66,22');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 88 AND $nbafficheimg2['nbimg2'] <= 92)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 69,23');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 92 AND $nbafficheimg2['nbimg2'] <= 96)          
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 72,24');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 96 AND $nbafficheimg2['nbimg2'] <= 100)         
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 75,25');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 100 AND $nbafficheimg2['nbimg2'] <= 104)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 78,26');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 104 AND $nbafficheimg2['nbimg2'] <= 108)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 81,27');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 108 AND $nbafficheimg2['nbimg2'] <= 112)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 84,28');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 112 AND $nbafficheimg2['nbimg2'] <= 116)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 87,29');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 116 AND $nbafficheimg2['nbimg2'] <= 120)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 90,30');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 120 AND $nbafficheimg2['nbimg2'] <= 124)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 93,31');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 124 AND $nbafficheimg2['nbimg2'] <= 128)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 96,32');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 128 AND $nbafficheimg2['nbimg2'] <= 132)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 99,33');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 132 AND $nbafficheimg2['nbimg2'] <= 136)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 102,34');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 136 AND $nbafficheimg2['nbimg2'] <= 140)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 105,35');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 140 AND $nbafficheimg2['nbimg2'] <= 144)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 108,36');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 144 AND $nbafficheimg2['nbimg2'] <= 148)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 111,37');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 148 AND $nbafficheimg2['nbimg2'] <= 152)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 114,38');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 152 AND $nbafficheimg2['nbimg2'] <= 156)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 117,39');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 156 AND $nbafficheimg2['nbimg2'] <= 160)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 120,40');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 160 AND $nbafficheimg2['nbimg2'] <= 164)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 123,41');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 164 AND $nbafficheimg2['nbimg2'] <= 168)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 126,42');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 168 AND $nbafficheimg2['nbimg2'] <= 172)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 129,43');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 172 AND $nbafficheimg2['nbimg2'] <= 176)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 132,44');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 176 AND $nbafficheimg2['nbimg2'] <= 180)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 135,45');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 180 AND $nbafficheimg2['nbimg2'] <= 184)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 138,46');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 184 AND $nbafficheimg2['nbimg2'] <= 188)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 141,47');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 188 AND $nbafficheimg2['nbimg2'] <= 192)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 144,48');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 192 AND $nbafficheimg2['nbimg2'] <= 196)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 147,49');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 196 AND $nbafficheimg2['nbimg2'] <= 200)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 150,50');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 200 AND $nbafficheimg2['nbimg2'] <= 204)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 153,51');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 204 AND $nbafficheimg2['nbimg2'] <= 208)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 156,52');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 208 AND $nbafficheimg2['nbimg2'] <= 212)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 159,53');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 212 AND $nbafficheimg2['nbimg2'] <= 216)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 162,54');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 216 AND $nbafficheimg2['nbimg2'] <= 220)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 165,55');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 220 AND $nbafficheimg2['nbimg2'] <= 224)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 168,56');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 224 AND $nbafficheimg2['nbimg2'] <= 228)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 171,57');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 228 AND $nbafficheimg2['nbimg2'] <= 232)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 174,58');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 232 AND $nbafficheimg2['nbimg2'] <= 236)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 177,59');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 236 AND $nbafficheimg2['nbimg2'] <= 240)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 180,60');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 240 AND $nbafficheimg2['nbimg2'] <= 244)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 183,61');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 244 AND $nbafficheimg2['nbimg2'] <= 248)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 186,62');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 248 AND $nbafficheimg2['nbimg2'] <= 252)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 189,63');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 252 AND $nbafficheimg2['nbimg2'] <= 256)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 192,64');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 256 AND $nbafficheimg2['nbimg2'] <= 260)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 195,65');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 260 AND $nbafficheimg2['nbimg2'] <= 264)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 198,66');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 264 AND $nbafficheimg2['nbimg2'] <= 268)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 201,67');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 268 AND $nbafficheimg2['nbimg2'] <= 272)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 204,68');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 272 AND $nbafficheimg2['nbimg2'] <= 276)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 207,69');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 276 AND $nbafficheimg2['nbimg2'] <= 280)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 210,70');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 280 AND $nbafficheimg2['nbimg2'] <= 284)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 213,71');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 284 AND $nbafficheimg2['nbimg2'] <= 288)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 216,72');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 288 AND $nbafficheimg2['nbimg2'] <= 292)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 219,73');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 292 AND $nbafficheimg2['nbimg2'] <= 296)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 222,74');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 296 AND $nbafficheimg2['nbimg2'] <= 300)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 225,75');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 300 AND $nbafficheimg2['nbimg2'] <= 304)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 228,76');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 304 AND $nbafficheimg2['nbimg2'] <= 308)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 231,77');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 308 AND $nbafficheimg2['nbimg2'] <= 312)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 234,78');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 312 AND $nbafficheimg2['nbimg2'] <= 316)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 237,79');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 316 AND $nbafficheimg2['nbimg2'] <= 320)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 240,80');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 320 AND $nbafficheimg2['nbimg2'] <= 324)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 243,81');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 324 AND $nbafficheimg2['nbimg2'] <= 328)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 246,82');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 328 AND $nbafficheimg2['nbimg2'] <= 332)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 249,83');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 332 AND $nbafficheimg2['nbimg2'] <= 336)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 252,84');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 336 AND $nbafficheimg2['nbimg2'] <= 340)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 255,85');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 340 AND $nbafficheimg2['nbimg2'] <= 344)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 258,86');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 344 AND $nbafficheimg2['nbimg2'] <= 348)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 261,87');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 348 AND $nbafficheimg2['nbimg2'] <= 352)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 264,88');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 352 AND $nbafficheimg2['nbimg2'] <= 356)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 267,89');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 356 AND $nbafficheimg2['nbimg2'] <= 360)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 270,90');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 360 AND $nbafficheimg2['nbimg2'] <= 364)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 273,91');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 364 AND $nbafficheimg2['nbimg2'] <= 368)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 276,92');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 368 AND $nbafficheimg2['nbimg2'] <= 372)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 279,93');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 372 AND $nbafficheimg2['nbimg2'] <= 376)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 282,94');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 376 AND $nbafficheimg2['nbimg2'] <= 380)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 285,95');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 380 AND $nbafficheimg2['nbimg2'] <= 384)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 288,96');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 384 AND $nbafficheimg2['nbimg2'] <= 388)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 291,97');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 388 AND $nbafficheimg2['nbimg2'] <= 392)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 294,98');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 392 AND $nbafficheimg2['nbimg2'] <= 396)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 297,99');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 396 AND $nbafficheimg2['nbimg2'] <= 400)        
					{                                                                                  
						$afficheimggallery4 = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 300,100');
					}
				?>
				
				<div class="colonne" id="colonne4">
				<?php
					while($imggallery4 = $afficheimggallery4->fetch())
					{
				?>
					<div id="colonneimg<?php echo $imggallery4['ID']; ?>" onclick="colonneimg<?php echo $imggallery4['ID']; ?>()">
					<div class="filtrenoirimage"><img src="gallery/<?php echo htmlspecialchars($imggallery4['image']); ?>" class="filtrenoirimagebackground" /><img src="images/agrandir.png" alt="Agrandir" class="imageagrandir" /></div>
					<img src="gallery/<?php echo htmlspecialchars($imggallery4['image']); ?>" alt="Image" class="imagegallery" />
					</div>
				<?php
					}
					$afficheimggallery4->closeCursor();
				?>
				</div>
				
				<?php
				
					if($nbafficheimg2['nbimg2'] <= 4)
					{
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 4');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 4 AND $nbafficheimg2['nbimg2'] <= 8)            
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 8');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 8 AND $nbafficheimg2['nbimg2'] <= 12)           
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 12');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 12 AND $nbafficheimg2['nbimg2'] <= 16)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 16');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 16 AND $nbafficheimg2['nbimg2'] <= 20)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 20');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 20 AND $nbafficheimg2['nbimg2'] <= 24)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 24');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 24 AND $nbafficheimg2['nbimg2'] <= 28)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 28');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 28 AND $nbafficheimg2['nbimg2'] <= 32)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 32');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 32 AND $nbafficheimg2['nbimg2'] <= 36)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 36');
					}
					else if($nbafficheimg2['nbimg2'] > 36 AND $nbafficheimg2['nbimg2'] <= 40)
					{
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 40');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 40 AND $nbafficheimg2['nbimg2'] <= 44)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 44');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 44 AND $nbafficheimg2['nbimg2'] <= 48)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 48');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 48 AND $nbafficheimg2['nbimg2'] <= 52)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 52');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 52 AND $nbafficheimg2['nbimg2'] <= 56)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 56');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 56 AND $nbafficheimg2['nbimg2'] <= 60)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 60');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 60 AND $nbafficheimg2['nbimg2'] <= 64)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 64');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 64 AND $nbafficheimg2['nbimg2'] <= 68)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 68');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 68 AND $nbafficheimg2['nbimg2'] <= 72)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 72');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 72 AND $nbafficheimg2['nbimg2'] <= 76)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 76');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 76 AND $nbafficheimg2['nbimg2'] <= 80)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 80');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 80 AND $nbafficheimg2['nbimg2'] <= 84)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 84');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 84 AND $nbafficheimg2['nbimg2'] <= 88)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 88');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 88 AND $nbafficheimg2['nbimg2'] <= 92)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 92');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 92 AND $nbafficheimg2['nbimg2'] <= 96)          
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 96');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 96 AND $nbafficheimg2['nbimg2'] <= 100)         
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 100');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 100 AND $nbafficheimg2['nbimg2'] <= 104)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 104');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 104 AND $nbafficheimg2['nbimg2'] <= 108)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 108');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 108 AND $nbafficheimg2['nbimg2'] <= 112)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 112');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 112 AND $nbafficheimg2['nbimg2'] <= 116)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 116');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 116 AND $nbafficheimg2['nbimg2'] <= 120)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 120');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 120 AND $nbafficheimg2['nbimg2'] <= 124)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 124');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 124 AND $nbafficheimg2['nbimg2'] <= 128)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 128');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 128 AND $nbafficheimg2['nbimg2'] <= 132)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 132');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 132 AND $nbafficheimg2['nbimg2'] <= 136)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 136');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 136 AND $nbafficheimg2['nbimg2'] <= 140)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 140');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 140 AND $nbafficheimg2['nbimg2'] <= 144)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 144');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 144 AND $nbafficheimg2['nbimg2'] <= 148)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 148');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 148 AND $nbafficheimg2['nbimg2'] <= 152)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 152');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 152 AND $nbafficheimg2['nbimg2'] <= 156)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 156');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 156 AND $nbafficheimg2['nbimg2'] <= 160)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 160');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 160 AND $nbafficheimg2['nbimg2'] <= 164)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 164');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 164 AND $nbafficheimg2['nbimg2'] <= 168)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 168');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 168 AND $nbafficheimg2['nbimg2'] <= 172)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 172');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 172 AND $nbafficheimg2['nbimg2'] <= 176)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 176');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 176 AND $nbafficheimg2['nbimg2'] <= 180)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 180');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 180 AND $nbafficheimg2['nbimg2'] <= 184)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 184');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 184 AND $nbafficheimg2['nbimg2'] <= 188)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 188');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 188 AND $nbafficheimg2['nbimg2'] <= 192)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 192');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 192 AND $nbafficheimg2['nbimg2'] <= 196)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 196');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 196 AND $nbafficheimg2['nbimg2'] <= 200)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 200');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 200 AND $nbafficheimg2['nbimg2'] <= 204)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 204');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 204 AND $nbafficheimg2['nbimg2'] <= 208)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 208');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 208 AND $nbafficheimg2['nbimg2'] <= 212)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 212');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 212 AND $nbafficheimg2['nbimg2'] <= 216)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 216');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 216 AND $nbafficheimg2['nbimg2'] <= 220)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 220');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 220 AND $nbafficheimg2['nbimg2'] <= 224)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 224');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 224 AND $nbafficheimg2['nbimg2'] <= 228)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 228');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 228 AND $nbafficheimg2['nbimg2'] <= 232)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 232');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 232 AND $nbafficheimg2['nbimg2'] <= 236)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 236');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 236 AND $nbafficheimg2['nbimg2'] <= 240)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 240');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 240 AND $nbafficheimg2['nbimg2'] <= 244)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 244');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 244 AND $nbafficheimg2['nbimg2'] <= 248)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 248');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 248 AND $nbafficheimg2['nbimg2'] <= 252)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 252');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 252 AND $nbafficheimg2['nbimg2'] <= 256)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 256');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 256 AND $nbafficheimg2['nbimg2'] <= 260)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 260');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 260 AND $nbafficheimg2['nbimg2'] <= 264)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 264');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 264 AND $nbafficheimg2['nbimg2'] <= 268)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 268');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 268 AND $nbafficheimg2['nbimg2'] <= 272)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 272');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 272 AND $nbafficheimg2['nbimg2'] <= 276)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 276');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 276 AND $nbafficheimg2['nbimg2'] <= 280)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 280');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 280 AND $nbafficheimg2['nbimg2'] <= 284)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 284');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 284 AND $nbafficheimg2['nbimg2'] <= 288)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 288');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 288 AND $nbafficheimg2['nbimg2'] <= 292)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 292');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 292 AND $nbafficheimg2['nbimg2'] <= 296)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 296');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 296 AND $nbafficheimg2['nbimg2'] <= 300)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 300');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 300 AND $nbafficheimg2['nbimg2'] <= 304)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 304');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 304 AND $nbafficheimg2['nbimg2'] <= 308)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 308');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 308 AND $nbafficheimg2['nbimg2'] <= 312)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 312');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 312 AND $nbafficheimg2['nbimg2'] <= 316)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 316');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 316 AND $nbafficheimg2['nbimg2'] <= 320)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 320');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 320 AND $nbafficheimg2['nbimg2'] <= 324)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 324');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 324 AND $nbafficheimg2['nbimg2'] <= 328)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 328');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 328 AND $nbafficheimg2['nbimg2'] <= 332)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 332');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 332 AND $nbafficheimg2['nbimg2'] <= 336)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 336');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 336 AND $nbafficheimg2['nbimg2'] <= 340)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 340');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 340 AND $nbafficheimg2['nbimg2'] <= 344)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 344');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 344 AND $nbafficheimg2['nbimg2'] <= 348)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 348');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 348 AND $nbafficheimg2['nbimg2'] <= 352)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 352');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 352 AND $nbafficheimg2['nbimg2'] <= 356)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 356');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 356 AND $nbafficheimg2['nbimg2'] <= 360)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 360');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 360 AND $nbafficheimg2['nbimg2'] <= 364)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 364');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 364 AND $nbafficheimg2['nbimg2'] <= 368)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 368');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 368 AND $nbafficheimg2['nbimg2'] <= 372)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 372');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 372 AND $nbafficheimg2['nbimg2'] <= 376)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 376');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 376 AND $nbafficheimg2['nbimg2'] <= 380)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 380');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 380 AND $nbafficheimg2['nbimg2'] <= 384)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 384');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 384 AND $nbafficheimg2['nbimg2'] <= 388)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 388');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 388 AND $nbafficheimg2['nbimg2'] <= 392)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 392');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 392 AND $nbafficheimg2['nbimg2'] <= 396)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 396');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 396 AND $nbafficheimg2['nbimg2'] <= 400)        
					{                                                                                  
						$afficheblockimage = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 400');
					}
				
					while($afficheimage = $afficheblockimage->fetch())
					{
						$infoimgmembreID = $db->query('SELECT * FROM membres WHERE ID=\'' . $afficheimage['IDmembre'] . '\'');
						$infoimgmembre = $infoimgmembreID->fetch();
				?>
				<div class="afficheblockimage" id="afficheblockimage<?php echo $afficheimage['ID']; ?>">
				<div class="afficheblockimagefiltrenoirG" onclick="afficheblockimagefiltrenoirG<?php echo $afficheimage['ID']; ?>()"></div>
				<div class="afficheblockimagefiltrenoirD" onclick="afficheblockimagefiltrenoirD<?php echo $afficheimage['ID']; ?>()"></div>
					<div class="afficheimage">
						<div class="contenueimage">
							<div class="contenueimagediv" id="contenueimagediv<?php echo $afficheimage['ID']; ?>" ><img src="gallery/<?php echo htmlspecialchars($afficheimage['image']); ?>" class="contenueimagegallery" id="contenueimagegallery<?php echo $afficheimage['ID']; ?>" alt="Image" /></div>	
						</div>
						<div class="contenuetexte">
							<div class="contenuetextemembre">
								<img src="images/closegallery.png" alt="Fermer" class="contenuetextemembreclose" onclick="contenuetextemembreclose<?php echo $afficheimage['ID']; ?>()" />
								<a href="profil.php?id=<?php echo $infoimgmembre['ID']; ?>"><img src="membre/avatar/<?php echo $infoimgmembre['avatar']; ?>" alt="Avatar" class="contenuetextemembreavatar" /></a>
								<span><a href="profil.php?id=<?php echo $infoimgmembre['ID']; ?>" class="contenuetextemembrepseudo"><?php echo htmlspecialchars($infoimgmembre['pseudo']); ?></a></span>
								<?php
									$dateanimg = date("Y", strtotime($afficheimage['date']));
									$datemoisimg = date("m", strtotime($afficheimage['date']));
									$datedayimg = date("d", strtotime($afficheimage['date']));
									$dateheureimg = date("H", strtotime($afficheimage['date']));
									$dateminimg = date("i", strtotime($afficheimage['date']));
									
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
												<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
											<?php
											}
											else if($dateheure3 == 1 AND $datemin >= 0)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
											<?php
											}
											else if($dateheure3 == 1 AND $datemin < 0)
											{
												$datemin2 = 60 + $datemin;
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
											<?php
											}
											else if($dateheure3 == 1 AND $datemin == 1)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
											<?php
											}
										}
										else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
										{
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
										<?php
										}
										else if($dateday3 >= 31)
										{
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $datemois3; ?> mois</span>
										<?php
										}else
										{
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
										<?php
										}
									}
									else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 0 AND $datemin == 0)
									{
										?>
											<span class="contenuetextemembredate">À l'instant</span>
										<?php
									}
									else if($datean == 1 AND $datemois2 >= 2)
									{
										$datemois4 = 12 - $datemois2;
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $datemois4; ?> mois</span>
										<?php
									}
									else if($datean == 1 AND ($datemois >= 1 OR $datemois <= 1))
									{
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $datean; ?> an</span>
										<?php
									}
									else if($datean >= 2)
									{
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $datean; ?> ans</span>
										<?php
									}
									else if($datemois == 0 AND $datean >= 1)
									{
										if($datean == 1)
										{
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $datean; ?> an</span>
										<?php
										}
										else if($datean >= 1)
										{
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $datean; ?> ans</span>
										<?php
										}
									}
									else if($datean == 0 AND $datemois >= 2)
									{
									?>
										<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
									<?php
									}
									else if($datean == 0 AND $datemois == 1 AND $dateday == 0)
									{
									?>
										<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
									<?php
									}
									else if($datean == 0 AND $datemois == 0 AND $dateday >= 1)
									{
										if($dateday >= 2)
										{
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $dateday; ?> jours</span>
										<?php
										}
										else if($dateday == 1 AND $dateheureimg > $dateheurenow)
										{
											$dateheure2 = 24 - $dateheureimg;
											$dateheure3 = $dateheure2 + $dateheurenow;
											if($dateheure3 >= 2)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
											<?php
											}
											else if($dateheure3 == 1 AND $datemin >= 0)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
											<?php
											}
											else if($dateheure3 == 1 AND $datemin < 0)
											{
												$datemin2 = 60 + $datemin;
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
											<?php
											}
											else if($dateheure3 == 1 AND $datemin == 1)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
											<?php
											}
										}
										else if($dateday == 1 AND $dateheureimg <= $dateheurenow)
										{
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $dateday; ?> jour</span>
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
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
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
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 28)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
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
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
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
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 30)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
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
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
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
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 30)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
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
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
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
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
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
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 30)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
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
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
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
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 30)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
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
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heures</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin >= 0)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $dateheure3; ?> heure</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin < 0)
												{
													$datemin2 = 60 + $datemin;
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
												<?php
												}
												else if($dateheure3 == 1 AND $datemin == 1)
												{
												?>
													<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
												<?php
												}
											}
											else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jour</span>
											<?php
											}
											else if($dateday3 >= 31)
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $datemois; ?> mois</span>
											<?php
											}
											else
											{
											?>
												<span class="contenuetextemembredate">Il y a <?php echo $dateday3; ?> jours</span>
											<?php
											}
										}
									}
									else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $datemin == 1)
									{
										if($dateheure == 0)
										{
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
										<?php
										}
										else if($dateheure == 1)
										{
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minute</span>
										<?php
										}
									}
									else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 0)
									{
										if($datemin >= 2)
										{
										?>
											<span class="contenuetextemembredate">Il y a <?php echo $datemin; ?> minutes</span>
										<?php
										}
									}
									else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 1 AND $datemin < 0 )
									{
										$datemin2 = 60 + $datemin;
									?>
										<span class="contenuetextemembredate">Il y a <?php echo $datemin2; ?> minutes</span>
									<?php
									}
									else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 1 AND $datemin >= 0 )
									{
										$datemin2 = 60 + $datemin;
									?>
										<span class="contenuetextemembredate">Il y a <?php echo $dateheure; ?> heure</span>
									<?php
									}
									else if($dateheure >= 2)
									{
									?>
										<span class="contenuetextemembredate">Il y a <?php echo $dateheure; ?> heures</span>
									<?php
									}
								?>
							</div>
							<div class="contenuetexteaime">
							<?php
								
								if(isset($_SESSION['ID']))
								{
									$voteIDexist = $db->query('SELECT COUNT(*) AS voteID FROM notesgallery WHERE IDgallery=\'' . $afficheimage['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
									$voteID = $voteIDexist->fetch();
								}
								
								$nbvoteimggallery = $db->query('SELECT COUNT(*) AS nbvoteimg FROM notesgallery WHERE IDgallery=\'' . $afficheimage['ID'] . '\'');
								$nbvoteimg = $nbvoteimggallery->fetch();
								
								if(isset($_SESSION['ID']) AND $voteID['voteID'] >= 1)
								{
								?>
									<img src="images/aimerouge.png" alt="Aime" class="contenuetexteaimeimg" id="contenuetexteaimeimgexist<?php echo $afficheimage['ID']; ?>" />
									<img src="images/aime.png" alt="Aime" class="contenuetexteaimeimg" id="contenuetexteaimeimgnoexist<?php echo $afficheimage['ID']; ?>" style="display:none;" />
									
									<script>
										document.getElementById('contenuetexteaimeimgexist<?php echo $afficheimage['ID'];?>').onclick = function()
										{
											contenuetexteaimeimgexist<?php echo $afficheimage['ID'];?>(this.value);
										}
										
										document.getElementById('contenuetexteaimeimgnoexist<?php echo $afficheimage['ID'];?>').onclick = function()
										{
											contenuetexteaimeimgnoexist<?php echo $afficheimage['ID'];?>(this.value);
										}
									</script>
								<?php
								}
								else if(isset($_SESSION['ID']) AND $voteID['voteID'] == 0)
								{
								?>
									<img src="images/aime.png" alt="Aime" class="contenuetexteaimeimg" id="contenuetexteaimeimgnoexist<?php echo $afficheimage['ID']; ?>" />
									<img src="images/aimerouge.png" alt="Aime" class="contenuetexteaimeimg" id="contenuetexteaimeimgexist<?php echo $afficheimage['ID']; ?>" style="display:none;" />
								
									<script>
										document.getElementById('contenuetexteaimeimgnoexist<?php echo $afficheimage['ID'];?>').onclick = function()
										{
											contenuetexteaimeimgnoexist<?php echo $afficheimage['ID'];?>(this.value);
										}
										
										document.getElementById('contenuetexteaimeimgexist<?php echo $afficheimage['ID'];?>').onclick = function()
										{
											contenuetexteaimeimgexist<?php echo $afficheimage['ID'];?>(this.value);
										}
									</script>
								<?php
								}
								else
								{
								?>
									<img src="images/aime.png" alt="Aime" class="contenuetexteaimeimg" style="cursor:default;" />
								<?php
								}
							?>
							
							
								<span class="contenuetexteaimenombre" id="contenuetexteaimenombre<?php echo $afficheimage['ID']; ?>"><?php echo $nbvoteimg['nbvoteimg']; ?></span>
								<a href="http://localhost/MetroManga/gallery/<?php echo htmlspecialchars($afficheimage['image']); ?>" download="MetroManga<?php echo $afficheimage['ID']; ?>"><img src="images/download.png" alt="Télécharger" class="contenuetextedownloadimg" /></a>
								<a href="http://localhost/MetroManga/gallery/<?php echo htmlspecialchars($afficheimage['image']); ?>" download="MetroManga<?php echo $afficheimage['ID']; ?>"><span class="contenuetextedownload" >Download</span></a>
							</div>
							<div class="contenuetextepublicationtexte">
								<span style="padding-left:2px;"><?php echo htmlspecialchars($afficheimage['contenu']); ?></span>
							</div>
							<?php
								$signaleexist = $db->query('SELECT COUNT(*) AS signale FROM signalegallery WHERE IDgallery=\'' . $afficheimage['ID'] . '\'');
								$signale = $signaleexist->fetch();
								
								if($signale['signale'] >= 1)
								{
								?>
									<img src="images/signalergalleryrouge.png" alt="Signaler" class="contenuetextesignaler" style="cursor:default;" />
								<?php
									if(isset($_SESSION['ID']) AND $_SESSION['ID'] == 1)
									{
									?>
										<img alt="Supprimer l'image" src="images/fermer.png" class="contenuetextesupprimerimage" id="contenuetextesupprimerimg<?php echo $afficheimage['ID']; ?>" />
									
										<script>						
											document.getElementById('contenuetextesupprimerimg<?php echo $afficheimage['ID'];?>').onclick = function()
											{
												contenuetextesupprimerimg<?php echo $afficheimage['ID'];?>(this.value);
											}
										</script>
									<?php
									}
								}
								else
								{
								?>
									<img src="images/signalergallery.png" title="Signaler" alt="Signaler" class="contenuetextesignaler" id="signaleimggallerynoexist<?php echo $afficheimage['ID']; ?>" />
									<img src="images/signalergalleryrouge.png" alt="Signaler" class="contenuetextesignaler" id="signaleimggalleryexist<?php echo $afficheimage['ID']; ?>" style="display:none;cursor:default;" />
									
									<script>						
										document.getElementById('signaleimggallerynoexist<?php echo $afficheimage['ID'];?>').onclick = function()
										{
											signaleimggallerynoexist<?php echo $afficheimage['ID'];?>(this.value);
										}
									</script>
								<?php
									if(isset($_SESSION['ID']) AND $_SESSION['ID'] == 1)
									{
									?>
										<img alt="Supprimer l'image" src="images/fermer.png" class="contenuetextesupprimerimage" id="contenuetextesupprimerimg<?php echo $afficheimage['ID']; ?>" style="display:none;" />
										
										<script>
											document.getElementById('contenuetextesupprimerimg<?php echo $afficheimage['ID'];?>').onclick = function()
											{
												contenuetextesupprimerimg<?php echo $afficheimage['ID'];?>(this.value);
											}
										</script>
									<?php
									}
								}
							?>
						</div>
					</div>
				</div>
				<?php
					}
					$afficheblockimage->closeCursor();
				?>
				
				<script>
				<?php
		
					if($nbafficheimg2['nbimg2'] <= 4)
					{
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 4');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 4 AND $nbafficheimg2['nbimg2'] <= 8)            
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 8');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 8 AND $nbafficheimg2['nbimg2'] <= 12)           
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 12');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 12 AND $nbafficheimg2['nbimg2'] <= 16)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 16');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 16 AND $nbafficheimg2['nbimg2'] <= 20)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 20');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 20 AND $nbafficheimg2['nbimg2'] <= 24)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 24');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 24 AND $nbafficheimg2['nbimg2'] <= 28)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 28');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 28 AND $nbafficheimg2['nbimg2'] <= 32)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 32');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 32 AND $nbafficheimg2['nbimg2'] <= 36)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 36');
					}
					else if($nbafficheimg2['nbimg2'] > 36 AND $nbafficheimg2['nbimg2'] <= 40)
					{
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 40');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 40 AND $nbafficheimg2['nbimg2'] <= 44)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 44');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 44 AND $nbafficheimg2['nbimg2'] <= 48)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 48');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 48 AND $nbafficheimg2['nbimg2'] <= 52)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 52');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 52 AND $nbafficheimg2['nbimg2'] <= 56)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 56');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 56 AND $nbafficheimg2['nbimg2'] <= 60)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 60');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 60 AND $nbafficheimg2['nbimg2'] <= 64)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 64');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 64 AND $nbafficheimg2['nbimg2'] <= 68)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 68');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 68 AND $nbafficheimg2['nbimg2'] <= 72)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 72');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 72 AND $nbafficheimg2['nbimg2'] <= 76)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 76');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 76 AND $nbafficheimg2['nbimg2'] <= 80)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 80');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 80 AND $nbafficheimg2['nbimg2'] <= 84)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 84');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 84 AND $nbafficheimg2['nbimg2'] <= 88)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 88');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 88 AND $nbafficheimg2['nbimg2'] <= 92)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 92');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 92 AND $nbafficheimg2['nbimg2'] <= 96)          
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 96');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 96 AND $nbafficheimg2['nbimg2'] <= 100)         
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 100');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 100 AND $nbafficheimg2['nbimg2'] <= 104)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 104');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 104 AND $nbafficheimg2['nbimg2'] <= 108)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 108');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 108 AND $nbafficheimg2['nbimg2'] <= 112)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 112');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 112 AND $nbafficheimg2['nbimg2'] <= 116)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 116');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 116 AND $nbafficheimg2['nbimg2'] <= 120)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 120');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 120 AND $nbafficheimg2['nbimg2'] <= 124)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 124');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 124 AND $nbafficheimg2['nbimg2'] <= 128)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 128');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 128 AND $nbafficheimg2['nbimg2'] <= 132)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 132');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 132 AND $nbafficheimg2['nbimg2'] <= 136)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 136');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 136 AND $nbafficheimg2['nbimg2'] <= 140)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 140');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 140 AND $nbafficheimg2['nbimg2'] <= 144)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 144');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 144 AND $nbafficheimg2['nbimg2'] <= 148)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 148');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 148 AND $nbafficheimg2['nbimg2'] <= 152)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 152');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 152 AND $nbafficheimg2['nbimg2'] <= 156)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 156');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 156 AND $nbafficheimg2['nbimg2'] <= 160)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 160');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 160 AND $nbafficheimg2['nbimg2'] <= 164)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 164');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 164 AND $nbafficheimg2['nbimg2'] <= 168)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 168');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 168 AND $nbafficheimg2['nbimg2'] <= 172)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 172');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 172 AND $nbafficheimg2['nbimg2'] <= 176)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 176');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 176 AND $nbafficheimg2['nbimg2'] <= 180)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 180');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 180 AND $nbafficheimg2['nbimg2'] <= 184)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 184');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 184 AND $nbafficheimg2['nbimg2'] <= 188)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 188');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 188 AND $nbafficheimg2['nbimg2'] <= 192)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 192');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 192 AND $nbafficheimg2['nbimg2'] <= 196)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 196');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 196 AND $nbafficheimg2['nbimg2'] <= 200)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 200');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 200 AND $nbafficheimg2['nbimg2'] <= 204)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 204');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 204 AND $nbafficheimg2['nbimg2'] <= 208)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 208');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 208 AND $nbafficheimg2['nbimg2'] <= 212)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 212');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 212 AND $nbafficheimg2['nbimg2'] <= 216)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 216');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 216 AND $nbafficheimg2['nbimg2'] <= 220)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 220');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 220 AND $nbafficheimg2['nbimg2'] <= 224)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 224');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 224 AND $nbafficheimg2['nbimg2'] <= 228)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 228');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 228 AND $nbafficheimg2['nbimg2'] <= 232)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 232');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 232 AND $nbafficheimg2['nbimg2'] <= 236)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 236');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 236 AND $nbafficheimg2['nbimg2'] <= 240)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 240');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 240 AND $nbafficheimg2['nbimg2'] <= 244)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 244');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 244 AND $nbafficheimg2['nbimg2'] <= 248)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 248');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 248 AND $nbafficheimg2['nbimg2'] <= 252)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 252');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 252 AND $nbafficheimg2['nbimg2'] <= 256)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 256');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 256 AND $nbafficheimg2['nbimg2'] <= 260)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 260');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 260 AND $nbafficheimg2['nbimg2'] <= 264)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 264');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 264 AND $nbafficheimg2['nbimg2'] <= 268)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 268');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 268 AND $nbafficheimg2['nbimg2'] <= 272)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 272');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 272 AND $nbafficheimg2['nbimg2'] <= 276)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 276');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 276 AND $nbafficheimg2['nbimg2'] <= 280)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 280');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 280 AND $nbafficheimg2['nbimg2'] <= 284)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 284');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 284 AND $nbafficheimg2['nbimg2'] <= 288)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 288');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 288 AND $nbafficheimg2['nbimg2'] <= 292)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 292');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 292 AND $nbafficheimg2['nbimg2'] <= 296)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 296');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 296 AND $nbafficheimg2['nbimg2'] <= 300)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 300');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 300 AND $nbafficheimg2['nbimg2'] <= 304)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 304');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 304 AND $nbafficheimg2['nbimg2'] <= 308)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 308');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 308 AND $nbafficheimg2['nbimg2'] <= 312)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 312');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 312 AND $nbafficheimg2['nbimg2'] <= 316)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 316');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 316 AND $nbafficheimg2['nbimg2'] <= 320)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 320');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 320 AND $nbafficheimg2['nbimg2'] <= 324)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 324');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 324 AND $nbafficheimg2['nbimg2'] <= 328)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 328');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 328 AND $nbafficheimg2['nbimg2'] <= 332)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 332');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 332 AND $nbafficheimg2['nbimg2'] <= 336)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 336');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 336 AND $nbafficheimg2['nbimg2'] <= 340)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 340');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 340 AND $nbafficheimg2['nbimg2'] <= 344)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 344');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 344 AND $nbafficheimg2['nbimg2'] <= 348)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 348');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 348 AND $nbafficheimg2['nbimg2'] <= 352)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 352');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 352 AND $nbafficheimg2['nbimg2'] <= 356)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 356');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 356 AND $nbafficheimg2['nbimg2'] <= 360)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 360');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 360 AND $nbafficheimg2['nbimg2'] <= 364)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 364');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 364 AND $nbafficheimg2['nbimg2'] <= 368)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 368');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 368 AND $nbafficheimg2['nbimg2'] <= 372)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 372');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 372 AND $nbafficheimg2['nbimg2'] <= 376)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 376');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 376 AND $nbafficheimg2['nbimg2'] <= 380)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 380');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 380 AND $nbafficheimg2['nbimg2'] <= 384)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 384');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 384 AND $nbafficheimg2['nbimg2'] <= 388)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 388');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 388 AND $nbafficheimg2['nbimg2'] <= 392)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 392');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 392 AND $nbafficheimg2['nbimg2'] <= 396)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 396');
					}                                                                                  
					else if($nbafficheimg2['nbimg2'] > 396 AND $nbafficheimg2['nbimg2'] <= 400)        
					{                                                                                  
						$afficheblockimagejs = $db->query('SELECT * FROM gallery ORDER BY ID DESC LIMIT 400');
					}
		
					while($afficheimagejs = $afficheblockimagejs->fetch())
					{
				?>		
		
				<?php
				if(isset($_SESSION['ID']))
				{
				?>
					function contenuetexteaimeimgexist<?php echo $afficheimagejs['ID'];?>()
					{
						var xhr = new XMLHttpRequest();
						
						xhr.open('GET', 'site/phpgallery.php?contenuetexteaimeimgexist=ok&IDgallery=<?php echo $afficheimagejs['ID'];?>');
						
						xhr.onreadystatechange = function() 
						{
							if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) 
							{
								document.getElementById('contenuetexteaimeimgexist<?php echo $afficheimagejs['ID'];?>').style.display="none";
								document.getElementById('contenuetexteaimeimgnoexist<?php echo $afficheimagejs['ID'];?>').style.display="inline-block";
								document.getElementById('contenuetexteaimenombre<?php echo $afficheimagejs['ID'];?>').innerHTML = xhr.responseText;
							}
						};
						
						xhr.send(null);
					}
					
					function contenuetexteaimeimgnoexist<?php echo $afficheimagejs['ID'];?>()
					{
						var xhr = new XMLHttpRequest();
						
						xhr.open('GET', 'site/phpgallery.php?contenuetexteaimeimgnoexist=ok&IDgallery=<?php echo $afficheimagejs['ID'];?>');
						
						xhr.onreadystatechange = function() 
						{
							if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) 
							{
								document.getElementById('contenuetexteaimeimgnoexist<?php echo $afficheimagejs['ID'];?>').style.display="none";
								document.getElementById('contenuetexteaimeimgexist<?php echo $afficheimagejs['ID'];?>').style.display="inline-block";
								document.getElementById('contenuetexteaimenombre<?php echo $afficheimagejs['ID'];?>').innerHTML = xhr.responseText;
							}
						};
						
						xhr.send(null);
					}
				<?php
				}
				?>
					
					function signaleimggallerynoexist<?php echo $afficheimagejs['ID'];?>()
					{
						var xhr = new XMLHttpRequest();
						
						xhr.open('GET', 'site/phpgallery.php?signaleimggallerynoexist=ok&IDgallery=<?php echo $afficheimagejs['ID'];?>');
						
						xhr.onreadystatechange = function() 
						{
							if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) 
							{
								document.getElementById('signaleimggallerynoexist<?php echo $afficheimagejs['ID'];?>').style.display="none";
								document.getElementById('signaleimggalleryexist<?php echo $afficheimagejs['ID'];?>').style.display="inline-block";
								document.getElementById('contenuetextesupprimerimg<?php echo $afficheimagejs['ID'];?>').style.display="inline-block";
							}
						};
						
						xhr.send(null);
					}
					
				<?php
				if(isset($_SESSION['ID']) AND $_SESSION['ID'] == 1)
				{
				?>
					function contenuetextesupprimerimg<?php echo $afficheimagejs['ID'];?>()
					{
						var xhr = new XMLHttpRequest();
						
						xhr.open('GET', 'site/phpgallery.php?contenuetextesupprimerimg=ok&IDgallery=<?php echo $afficheimagejs['ID'];?>');
						
						xhr.onreadystatechange = function() 
						{
							if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
							{
								setTimeout(function(){document.getElementById("afficheblockimage<?php echo $afficheimagejs['ID'];?>").style.display="none";},100 )
								document.getElementById('afficheblockimage<?php echo $afficheimagejs['ID'];?>').style.opacity="0";
								document.getElementById('colonneimg<?php echo $afficheimagejs['ID'];?>').style.display="none";
							}
						};
						
						xhr.send(null);
					}
				<?php
				}
				?>
					function colonneimg<?php echo $afficheimagejs['ID']; ?>()
					{
						document.getElementById("afficheblockimage<?php echo $afficheimagejs['ID'];?>").style.display="block";
						setTimeout(function(){document.getElementById("afficheblockimage<?php echo $afficheimagejs['ID'];?>").style.opacity="1";},0 )
						var img = document.querySelector('#contenueimagegallery<?php echo $afficheimagejs['ID']; ?>'); 
						var height = img.clientHeight;
						
						if(height <= 651)
						{
							height = 651 - height;
							height = height / 6;
							
							if (window.matchMedia("(max-height: 700px)").matches)
							{
								
								document.getElementById("contenueimagediv<?php echo $afficheimagejs['ID']; ?>").style.marginTop=height;
							}
							else
							{
								document.getElementById("contenueimagediv<?php echo $afficheimagejs['ID']; ?>").style.marginTop=height+height+height;
							}
						}
					}
					
					function contenuetextemembreclose<?php echo $afficheimagejs['ID'];?>()
					{
						setTimeout(function(){document.getElementById("afficheblockimage<?php echo $afficheimagejs['ID'];?>").style.display="none";},100 )
						document.getElementById("afficheblockimage<?php echo $afficheimagejs['ID'];?>").style.opacity="0";
					}
					
					function afficheblockimagefiltrenoirG<?php echo $afficheimagejs['ID'];?>()
					{
						setTimeout(function(){document.getElementById("afficheblockimage<?php echo $afficheimagejs['ID'];?>").style.display="none";},100 )
						document.getElementById("afficheblockimage<?php echo $afficheimagejs['ID'];?>").style.opacity="0";
					}
					
					function afficheblockimagefiltrenoirD<?php echo $afficheimagejs['ID'];?>()
					{
						setTimeout(function(){document.getElementById("afficheblockimage<?php echo $afficheimagejs['ID'];?>").style.display="none";},100 )
						document.getElementById("afficheblockimage<?php echo $afficheimagejs['ID'];?>").style.opacity="0";
					}
					
				<?php
					}
					$afficheblockimagejs->closeCursor();
				?>
				</script>
				
			</section>
		</div>
		</div>
		<script id="cid0020000205644521856" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 251px;height: 426px;">{"handle":"metromanga1","arch":"js","styles":{"a":"cc0000","b":100,"c":"FFFFFF","d":"FFFFFF","k":"cc0000","l":"cc0000","m":"cc0000","n":"FFFFFF","p":"9.36","q":"cc0000","r":100,"pos":"br","cv":1,"cvbg":"CC0000","cvw":251,"cvh":30,"cnrs":"0.26","ticker":1,"fwtickm":1}}</script>
		<?php include("includes/footer.php"); ?>
	</div>
	</body>
</html>