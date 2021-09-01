<?php session_start(); ?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<link rel="stylesheet" href="index.css" />
		<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
		<link rel="stylesheet" href="css/flickity.min.css" media="screen">
		<link rel="stylesheet" href="css/glisse.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="css/app.css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="js/flickity.pkgd.min.js"></script>
		<script>
			(function($){
				$(window).on("load",function(){
					$("#body2").mCustomScrollbar({
						theme:"inset-3"
					});
					$("#blockanime").mCustomScrollbar({
						theme:"inset-3"
					});
				});
			})(jQuery);
		</script>
		<link href='css/Racing.css' rel='stylesheet' type='text/css'>
		<link href='css/Cookie.css' rel='stylesheet' type='text/css'>
		<link href='css/Raleway.css' rel='stylesheet' type='text/css'>
		<title>Metro Manga</title>
	</head>
	
	<body id="body">
		<div id="body2">
		<?php include("includes/loading.php"); ?>
		<?php include("includes/header.php"); ?>
		<div id="contenuloading">
			<div class="carousel" data-flickity='{ "autoPlay": 15000 }'>
			<?php
				$searchnbepisodeexist = $db->query('SELECT COUNT(*) AS nbepisodeexist FROM episodes');
				$nbepisodeexist = $searchnbepisodeexist->fetch();
				
				$searchnbscanexist = $db->query('SELECT COUNT(*) AS nbscanexist FROM scans');
				$nbscanexist = $searchnbscanexist->fetch();
				
				$searchnbfilmexist = $db->query('SELECT COUNT(*) AS nbfilmexist FROM films');
				$nbfilmexist = $searchnbfilmexist->fetch();
				
				$searchnbfilmanimeexist = $db->query('SELECT COUNT(*) AS nbfilmanimeexist FROM filmsanimes');
				$nbfilmanimeexist = $searchnbfilmanimeexist->fetch();
				
				$searchnbfilmspecialexist = $db->query('SELECT COUNT(*) AS nbfilmspecialexist FROM filmsspecial');
				$nbfilmspecialexist = $searchnbfilmspecialexist->fetch();
				
				$searchnboavexist = $db->query('SELECT COUNT(*) AS nboavexist FROM oavs');
				$nboavexist = $searchnboavexist->fetch();
				
				if($nbepisodeexist['nbepisodeexist'] >= 10)
				{
				?>
					<div id="lienimagecarousel">
					<?php
					$selectnewepisode = $db->query('SELECT * FROM episodes ORDER BY ID DESC LIMIT 0,10');
					while($newepisode = $selectnewepisode->fetch())
					{
						$searchinfoanime = $db->query('SELECT * FROM animes WHERE ID=\'' . $newepisode['IDanime'] .  '\'');
						$infoanime = $searchinfoanime->fetch();
					?>
						<a href="anime.php?anime=<?php echo $newepisode['IDanime']; ?>&episode=<?php echo $newepisode['numero']; ?>" class="divblockcarousel" id="divblockcarouselepisode<?php echo $newepisode['ID']; ?>" style="background:url('anime/<?php echo $infoanime['image']; ?>') no-repeat;background-size:120%;background-position:right 0px bottom 0px;">
						<div class="headerblockcarousel" id="headerblockcarouselepisode<?php echo $newepisode['ID']; ?>">
							<span class="headerblockcarouselspan">Épisode <?php echo $newepisode['numero']; ?></span>
							<span class="headerblockcarouselspan2"><?php echo $infoanime['titre']; ?></span>
						<?php
							if(strlen($newepisode['videovf']) >= 7 AND $newepisode['videovf'] != 'NULL')
							{
							?>
								<span class="headerblockcarouselspan3">VF/VOSTFR</span>
							<?php
							}
							else
							{
							?>
								<span class="headerblockcarouselspan3">VOSTFR</span>
							<?php
							}
						?>
						</div>
						</a>
						<script>
							document.querySelector("#divblockcarouselepisode<?php echo $newepisode['ID']; ?>").onmouseover = function()
							{ 
								if (window.getComputedStyle(document.querySelector('#headerblockcarouselepisode<?php echo $newepisode['ID']; ?>')).background=='rgba(0,0,0,0.66)')
								{
									document.querySelector("#headerblockcarouselepisode<?php echo $newepisode['ID']; ?>").style.background="rgba(0,0,0,0.94)";
									document.querySelector("#divblockcarouselepisode<?php echo $newepisode['ID']; ?>").style.backgroundPosition="left 0px top 0px";
								}
								else
								{
									document.querySelector("#headerblockcarouselepisode<?php echo $newepisode['ID']; ?>").style.background="rgba(0,0,0,0.94)";
									document.querySelector("#divblockcarouselepisode<?php echo $newepisode['ID']; ?>").style.backgroundPosition="left 0px top 0px";
								}
							}
							
							document.querySelector("#divblockcarouselepisode<?php echo $newepisode['ID']; ?>").onmouseout = function()
							{ 
								if (window.getComputedStyle(document.querySelector('#headerblockcarouselepisode<?php echo $newepisode['ID']; ?>')).background=='rgba(0,0,0,0.94)')
								{
									document.querySelector("#headerblockcarouselepisode<?php echo $newepisode['ID']; ?>").style.background="rgba(0,0,0,0.66)";
									document.querySelector("#divblockcarouselepisode<?php echo $newepisode['ID']; ?>").style.backgroundPosition="right 0px bottom 0px";
								}
								else
								{
									document.querySelector("#headerblockcarouselepisode<?php echo $newepisode['ID']; ?>").style.background="rgba(0,0,0,0.66)";
									document.querySelector("#divblockcarouselepisode<?php echo $newepisode['ID']; ?>").style.backgroundPosition="right 0px bottom 0px";
								}
							}
						</script>
					<?php
					}
					$selectnewepisode->closeCursor();
					?>
					</div>
				<?php
				}
				
				if($nbscanexist['nbscanexist'] >= 10)
				{
				?>
					<div id="lienimagecarousel">
					<?php
					$selectnewscan = $db->query('SELECT * FROM scans WHERE page = 1 ORDER BY ID DESC LIMIT 0,11');
					while($newscan = $selectnewscan->fetch())
					{
						$searchcountscan = $db->query('SELECT COUNT(*) AS countscan FROM scans WHERE IDanime=\'' . $newscan['IDanime'] .  '\' AND numero=\'' . $newscan['numero'] .  '\'');
						$countscan = $searchcountscan->fetch();
						
						$searchinfoanimescan = $db->query('SELECT * FROM animes WHERE ID=\'' . $newscan['IDanime'] .  '\'');
						$infoanimescan = $searchinfoanimescan->fetch();
					?>
						<a href="anime.php?anime=<?php echo $newscan['IDanime']; ?>&scan=<?php echo $newscan['numero']; ?>" class="divblockcarousel" id="divblockcarouselscan<?php echo $newscan['ID']; ?>" style="transition: all 0.9s;background:url('scan/<?php echo $newscan['image']; ?>') no-repeat;background-size:120%;background-position:center;">
						<div class="headerblockcarousel" style="background:rgba(0,0,0,0.74);" id="headerblockcarouselscan<?php echo $newscan['ID']; ?>">
							<span class="headerblockcarouselspan">Scan <?php echo $newscan['numero']; ?></span>
							<span class="headerblockcarouselspan2"><?php echo $infoanimescan['titre']; ?></span>
							<span class="headerblockcarouselspan3"><?php echo $countscan['countscan']; ?></span>
						</div>
						</a>
						<script>
							document.querySelector("#divblockcarouselscan<?php echo $newscan['ID']; ?>").onmouseover = function()
							{ 
								if (window.getComputedStyle(document.querySelector('#headerblockcarouselscan<?php echo $newscan['ID']; ?>')).background=='rgba(0,0,0,0.74)')
								{
									document.querySelector("#headerblockcarouselscan<?php echo $newscan['ID']; ?>").style.background="rgba(0,0,0,0.97)";
									document.querySelector("#divblockcarouselscan<?php echo $newscan['ID']; ?>").style.backgroundPosition="left 0px top 0px";
								}
								else
								{
									document.querySelector("#headerblockcarouselscan<?php echo $newscan['ID']; ?>").style.background="rgba(0,0,0,0.97)";
									document.querySelector("#divblockcarouselscan<?php echo $newscan['ID']; ?>").style.backgroundPosition="left 0px top 0px";
								}
							}
							
							document.querySelector("#divblockcarouselscan<?php echo $newscan['ID']; ?>").onmouseout = function()
							{ 
								if (window.getComputedStyle(document.querySelector('#headerblockcarouselscan<?php echo $newscan['ID']; ?>')).background=='rgba(0,0,0,0.97)')
								{
									document.querySelector("#headerblockcarouselscan<?php echo $newscan['ID']; ?>").style.background="rgba(0,0,0,0.74)";
									document.querySelector("#divblockcarouselscan<?php echo $newscan['ID']; ?>").style.backgroundPosition="center";
								}
								else
								{
									document.querySelector("#headerblockcarouselscan<?php echo $newscan['ID']; ?>").style.background="rgba(0,0,0,0.74)";
									document.querySelector("#divblockcarouselscan<?php echo $newscan['ID']; ?>").style.backgroundPosition="center";
								}
							}
						</script>
					<?php
					}
					$selectnewscan->closeCursor();
					?>
					</div>
				<?php
				}
				
				if($nbfilmexist['nbfilmexist'] >= 5 AND $nbfilmanimeexist['nbfilmanimeexist'] >= 5)
				{
				?>
					<div id="lienimagecarousel">
					<?php
					$selectnewfilm = $db->query('SELECT * FROM films ORDER BY ID DESC LIMIT 0,6');
					while($newfilm = $selectnewfilm->fetch())
					{
					?>
						<a href="film.php?id=<?php echo $newfilm['ID']; ?>" class="divblockcarousel" id="divblockcarouselfilm<?php echo $newfilm['ID']; ?>" style="transition: all 0.9s;background:url('film/<?php echo $newfilm['image']; ?>') no-repeat;background-size:120%;background-position:right 0px bottom 0px;">
						<div class="headerblockcarousel" id="headerblockcarouselfilm<?php echo $newfilm['ID']; ?>">
							<span class="headerblockcarouselspan2"><?php echo $newfilm['titre']; ?></span>
						<?php
							if(strlen($newfilm['videovf']) >= 7 AND $newfilm['videovf'] != 'NULL')
							{
							?>
								<span class="headerblockcarouselspan3">VF/VOSTFR</span>
							<?php
							}
							else
							{
							?>
								<span class="headerblockcarouselspan3">VOSTFR</span>
							<?php
							}
						?>
						</div>
						</a>
						<script>
							document.querySelector("#divblockcarouselfilm<?php echo $newfilm['ID']; ?>").onmouseover = function()
							{ 
								if (window.getComputedStyle(document.querySelector('#headerblockcarouselfilm<?php echo $newfilm['ID']; ?>')).background=='rgba(0,0,0,0.66)')
								{
									document.querySelector("#headerblockcarouselfilm<?php echo $newfilm['ID']; ?>").style.background="rgba(0,0,0,0.94)";
									document.querySelector("#divblockcarouselfilm<?php echo $newfilm['ID']; ?>").style.backgroundPosition="left 0px top 0px";
								}
								else
								{
									document.querySelector("#headerblockcarouselfilm<?php echo $newfilm['ID']; ?>").style.background="rgba(0,0,0,0.94)";
									document.querySelector("#divblockcarouselfilm<?php echo $newfilm['ID']; ?>").style.backgroundPosition="left 0px top 0px";
								}
							}
							
							document.querySelector("#divblockcarouselfilm<?php echo $newfilm['ID']; ?>").onmouseout = function()
							{ 
								if (window.getComputedStyle(document.querySelector('#headerblockcarouselfilm<?php echo $newfilm['ID']; ?>')).background=='rgba(0,0,0,0.94)')
								{
									document.querySelector("#headerblockcarouselfilm<?php echo $newfilm['ID']; ?>").style.background="rgba(0,0,0,0.66)";
									document.querySelector("#divblockcarouselfilm<?php echo $newfilm['ID']; ?>").style.backgroundPosition="right 0px bottom 0px";
								}
								else
								{
									document.querySelector("#headerblockcarouselfilm<?php echo $newfilm['ID']; ?>").style.background="rgba(0,0,0,0.66)";
									document.querySelector("#divblockcarouselfilm<?php echo $newfilm['ID']; ?>").style.backgroundPosition="right 0px bottom 0px";
								}
							}
						</script>
					<?php
					}
					$selectnewfilm->closeCursor();
					
					$selectnewfilmanime = $db->query('SELECT * FROM filmsanimes ORDER BY ID DESC LIMIT 0,6');
					while($newfilmanime = $selectnewfilmanime->fetch())
					{
					?>
						<a href="anime.php?anime=<?php echo $newfilmanime['IDanime']; ?>&filmanime=<?php echo $newfilmanime['numero']; ?>" class="divblockcarousel" id="divblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>" style="background:url('filmanime/<?php echo $newfilmanime['image']; ?>') no-repeat;background-size:120%;background-position:right 0px bottom 0px;">
						<div class="headerblockcarousel" id="headerblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>">
							<span class="headerblockcarouselspan">Film <?php echo $newfilmanime['numero']; ?></span>
							<span class="headerblockcarouselspan2"><?php echo $newfilmanime['titre']; ?></span>
						<?php
							if(strlen($newfilmanime['videovf']) >= 7 AND $newfilmanime['videovf'] != 'NULL')
							{
							?>
								<span class="headerblockcarouselspan3">VF/VOSTFR</span>
							<?php
							}
							else
							{
							?>
								<span class="headerblockcarouselspan3">VOSTFR</span>
							<?php
							}
						?>
						</div>
						</a>
						<script>
							document.querySelector("#divblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>").onmouseover = function()
							{ 
								if (window.getComputedStyle(document.querySelector('#headerblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>')).background=='rgba(0,0,0,0.66)')
								{
									document.querySelector("#headerblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>").style.background="rgba(0,0,0,0.94)";
									document.querySelector("#divblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>").style.backgroundPosition="left 0px top 0px";
								}
								else
								{
									document.querySelector("#headerblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>").style.background="rgba(0,0,0,0.94)";
									document.querySelector("#divblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>").style.backgroundPosition="left 0px top 0px";
								}
							}
							
							document.querySelector("#divblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>").onmouseout = function()
							{ 
								if (window.getComputedStyle(document.querySelector('#headerblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>')).background=='rgba(0,0,0,0.94)')
								{
									document.querySelector("#headerblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>").style.background="rgba(0,0,0,0.66)";
									document.querySelector("#divblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>").style.backgroundPosition="right 0px bottom 0px";
								}
								else
								{
									document.querySelector("#headerblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>").style.background="rgba(0,0,0,0.66)";
									document.querySelector("#divblockcarouselfilmanime<?php echo $newfilmanime['ID']; ?>").style.backgroundPosition="right 0px bottom 0px";
								}
							}
						</script>
					<?php
					}
					$selectnewfilmanime->closeCursor();
					?>
					</div>
				<?php
				}
				
				if($nbfilmspecialexist['nbfilmspecialexist'] >= 5 AND $nboavexist['nboavexist'] >= 5)
				{
				?>
					<div id="lienimagecarousel">
					<?php
					$selectnewfilmspecial = $db->query('SELECT * FROM filmsspecial ORDER BY ID DESC LIMIT 0,5');
					while($newfilmspecial = $selectnewfilmspecial->fetch())
					{
						$searchinfoanimespecial = $db->query('SELECT * FROM animes WHERE ID=\'' . $newfilmspecial['IDanime'] .  '\'');
						$infoanimespecial = $searchinfoanimespecial->fetch();
					?>
						<a href="anime.php?anime=<?php echo $newfilmspecial['IDanime']; ?>&filmspecial=<?php echo $newfilmspecial['numero']; ?>" class="divblockcarousel" id="divblockcarouselfilmspecial<?php echo $newfilmspecial['ID']; ?>" style="transition: all 0.9s;background:url('anime/<?php echo $infoanimespecial['image']; ?>') no-repeat;background-size:120%;background-position:right 0px bottom 0px;">
						<div class="headerblockcarousel" id="headerblockcarouselfilmspecial<?php echo $newfilmspecial['ID']; ?>">
							<span class="headerblockcarouselspan">Film Spécial <?php echo $newfilmspecial['numero']; ?></span>
							<span class="headerblockcarouselspan2"><?php echo $infoanimespecial['titre']; ?></span>
						<?php
							if(strlen($newfilmspecial['videovf']) >= 7 AND $newfilmspecial['videovf'] != 'NULL')
							{
							?>
								<span class="headerblockcarouselspan3">VF/VOSTFR</span>
							<?php
							}
							else
							{
							?>
								<span class="headerblockcarouselspan3">VOSTFR</span>
							<?php
							}
						?>
						</div>
						</a>
						<script>
							document.querySelector("#divblockcarouselfilmspecial<?php echo $newfilmspecial['ID']; ?>").onmouseover = function()
							{ 
								if (window.getComputedStyle(document.querySelector('#headerblockcarouselfilmspecial<?php echo $newfilmspecial['ID']; ?>')).background=='rgba(0,0,0,0.66)')
								{
									document.querySelector("#headerblockcarouselfilm<?php echo $newfilmspecial['ID']; ?>").style.background="rgba(0,0,0,0.94)";
									document.querySelector("#divblockcarouselfilm<?php echo $newfilmspecial['ID']; ?>").style.backgroundPosition="left 0px top 0px";
								}
								else
								{
									document.querySelector("#headerblockcarouselfilmspecial<?php echo $newfilmspecial['ID']; ?>").style.background="rgba(0,0,0,0.94)";
									document.querySelector("#divblockcarouselfilmspecial<?php echo $newfilmspecial['ID']; ?>").style.backgroundPosition="left 0px top 0px";
								}
							}
							
							document.querySelector("#divblockcarouselfilmspecial<?php echo $newfilmspecial['ID']; ?>").onmouseout = function()
							{ 
								if (window.getComputedStyle(document.querySelector('#headerblockcarouselfilmspecial<?php echo $newfilmspecial['ID']; ?>')).background=='rgba(0,0,0,0.94)')
								{
									document.querySelector("#headerblockcarouselfilmspecial<?php echo $newfilmspecial['ID']; ?>").style.background="rgba(0,0,0,0.66)";
									document.querySelector("#divblockcarouselfilmspecial<?php echo $newfilmspecial['ID']; ?>").style.backgroundPosition="right 0px bottom 0px";
								}
								else
								{
									document.querySelector("#headerblockcarouselfilmspecial<?php echo $newfilmspecial['ID']; ?>").style.background="rgba(0,0,0,0.66)";
									document.querySelector("#divblockcarouselfilmspecial<?php echo $newfilmspecial['ID']; ?>").style.backgroundPosition="right 0px bottom 0px";
								}
							}
						</script>
					<?php
					}
					$selectnewfilmspecial->closeCursor();
					
					$selectnewoav = $db->query('SELECT * FROM oavs ORDER BY ID DESC LIMIT 0,5');
					while($newoav = $selectnewoav->fetch())
					{
						$searchinfoanimeoav = $db->query('SELECT * FROM animes WHERE ID=\'' . $newoav['IDanime'] .  '\'');
						$infoanimeoav = $searchinfoanimeoav->fetch();
					?>
						<a href="anime.php?anime=<?php echo $newoav['IDanime']; ?>&oav=<?php echo $newoav['numero']; ?>" class="divblockcarousel" id="divblockcarouseloav<?php echo $newoav['ID']; ?>" style="background:url('anime/<?php echo $infoanimeoav['image']; ?>') no-repeat;background-size:120%;background-position:right 0px bottom 0px;">
						<div class="headerblockcarousel" id="headerblockcarouseloav<?php echo $newoav['ID']; ?>">
							<span class="headerblockcarouselspan">Oav <?php echo $newoav['numero']; ?></span>
							<span class="headerblockcarouselspan2"><?php echo $infoanimeoav['titre']; ?></span>
						<?php
							if(strlen($newoav['videovf']) >= 7 AND $newoav['videovf'] != 'NULL')
							{
							?>
								<span class="headerblockcarouselspan3">VF/VOSTFR</span>
							<?php
							}
							else
							{
							?>
								<span class="headerblockcarouselspan3">VOSTFR</span>
							<?php
							}
						?>
						</div>
						</a>
						<script>
							document.querySelector("#divblockcarouseloav<?php echo $newoav['ID']; ?>").onmouseover = function()
							{ 
								if (window.getComputedStyle(document.querySelector('#headerblockcarouseloav<?php echo $newoav['ID']; ?>')).background=='rgba(0,0,0,0.66)')
								{
									document.querySelector("#headerblockcarouseloav<?php echo $newoav['ID']; ?>").style.background="rgba(0,0,0,0.94)";
									document.querySelector("#divblockcarouseloav<?php echo $newoav['ID']; ?>").style.backgroundPosition="left 0px top 0px";
								}
								else
								{
									document.querySelector("#headerblockcarouseloav<?php echo $newoav['ID']; ?>").style.background="rgba(0,0,0,0.94)";
									document.querySelector("#divblockcarouseloav<?php echo $newoav['ID']; ?>").style.backgroundPosition="left 0px top 0px";
								}
							}
							
							document.querySelector("#divblockcarouseloav<?php echo $newoav['ID']; ?>").onmouseout = function()
							{ 
								if (window.getComputedStyle(document.querySelector('#headerblockcarouseloav<?php echo $newoav['ID']; ?>')).background=='rgba(0,0,0,0.94)')
								{
									document.querySelector("#headerblockcarouseloav<?php echo $newoav['ID']; ?>").style.background="rgba(0,0,0,0.66)";
									document.querySelector("#divblockcarouseloav<?php echo $newoav['ID']; ?>").style.backgroundPosition="right 0px bottom 0px";
								}
								else
								{
									document.querySelector("#headerblockcarouseloav<?php echo $newoav['ID']; ?>").style.background="rgba(0,0,0,0.66)";
									document.querySelector("#divblockcarouseloav<?php echo $newoav['ID']; ?>").style.backgroundPosition="right 0px bottom 0px";
								}
							}
						</script>
					<?php
					}
					$selectnewoav->closeCursor();
					?>
					</div>
				<?php
				}
			?>
			</div><br />
			<section id="n1">
				<article id="reseaux">
					<script>(function (win, doc, script, source, objectName) { (win.RadionomyPlayerObject = win.RadionomyPlayerObject || []).push(objectName); win[objectName] = win[objectName] || function (k, v) { (win[objectName].parameters = win[objectName].parameters || { src: source, version: '1.1' })[k] = v; }; var js, rjs = doc.getElementsByTagName(script)[0]; js = doc.createElement(script); js.async = 1; js.src = source; rjs.parentNode.insertBefore(js, rjs); }(window, document, 'script', 'https://www.radionomy.com/js/radionomy.player.js', 'radplayer'));
						radplayer('url', 'subarashii');
						radplayer('type', 'medium');
						radplayer('autoplay', '0');
						radplayer('volume', '50');
						radplayer('color1', 'rgba(255,255,255,0)');
						radplayer('color2', 'rgba(0,0,0,1)');
					</script>
					<div class="radionomy-player"></div>
				</article>
				<div id="youtube"><iframe width="750" height="405" src="https://www.youtube.com/embed/videoseries?list=PLvOh8RyCrRKpGzVl9SGIQayqpjRlwxMS8" frameborder="0" allowfullscreen ></iframe></div>
			</section>
				<article id="radio">
					
				</article>
			<section id="n2">
				<ul id="tableauanime">
					<h4 id="titretableau"><span class="topanimeimgG"><img src="images/topg.png" alt="" width="45" height="43" /></span>Top Anime Metro Manga<span class="topanimeimgD"><img src="images/topd.png" alt="" width="45" height="43" /></span></h4>
					<div id="blockanime">
					<?php 
						$selecttopanime = $db->query('SELECT * FROM animes ORDER BY note DESC LIMIT 0,10');
						while($topanime = $selecttopanime->fetch())
						{
						?>
							<li id="titreanime"><a href="anime.php?anime=<?php echo $topanime['ID']; ?>"><?php echo $topanime['titre']; ?><span style="color:white;position:absolute;left:88%;"><?php echo round($topanime['note'], 2); ?></span></a></li>
						<?php
						}
						$selecttopanime->closeCursor();
					?>
					</div>
				</ul>
				<article id="blockcalendrier" title="Non disponible">
					<img src="images/calendrier.png" alt="calendrier" />
					<h3>Calendrier MetroManga</h3>
				</article>	
			</section>
			
			<script id="cid0020000205644521856" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 251px;height: 426px;">{"handle":"metromanga1","arch":"js","styles":{"a":"cc0000","b":100,"c":"FFFFFF","d":"FFFFFF","k":"cc0000","l":"cc0000","m":"cc0000","n":"FFFFFF","p":"9.36","q":"cc0000","r":100,"pos":"br","cv":1,"cvbg":"CC0000","cvw":251,"cvh":30,"cnrs":"0.26","ticker":1,"fwtickm":1}}</script>
		
		</div>
		<?php include("includes/footer.php"); ?>
	</div>
	</body>
</html>