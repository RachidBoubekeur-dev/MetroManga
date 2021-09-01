<?php session_start(); ?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<link rel="stylesheet" href="staff.css" />
		<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script>
			(function($){
				$(window).on("load",function(){
					$("#body2").mCustomScrollbar({
						theme:"inset-3"
					});
				});
			})(jQuery);
		</script>
		<link href='css/Racing.css' rel='stylesheet' type='text/css'>
		<link href='css/Cookie.css' rel='stylesheet' type='text/css'>
		<link href='css/Raleway.css' rel='stylesheet' type='text/css'>
		<title>Staff - Metro Manga</title>
	</head>
	
	<body id="body">
		<div id="body2">
		<?php include("includes/loading.php"); ?>
		<?php include("includes/header.php"); ?>
		<div id="contenuloading">
			<div id="contenu">
				<div class="contenutitre">
					<span class="titrecontact">Staff</span>
					<hr class="hrcontact" />
				</div>
				<?php
				$searchinfostaff = $db->query('SELECT * FROM membres WHERE ID = 1');
				while($infostaff = $searchinfostaff->fetch())
				{
				?>
				
					<div class="staffdiv1">
						<a href="profil.php?id=<?php echo $infostaff['ID']; ?>"><img src="membre/avatar/<?php echo $infostaff['avatar']; ?>" alt="Avatar" class="staffimg" /></a><br />
						<span><a href="profil.php?id=<?php echo $infostaff['ID']; ?>" class="staffspan"><?php echo $infostaff['pseudo']; ?></a></span><br />
						<span class="staffspan2">Fondateur & Administrateur</span>
					</div>
					<br />
					<div class="staffdiv1">
						<div class="staffdiv2">
							<a href="profil.php?id=<?php echo $infostaff['ID']; ?>"><img src="membre/avatar/<?php echo $infostaff['avatar']; ?>" alt="Avatar" class="staffimg" /></a><br />
							<span><a href="profil.php?id=<?php echo $infostaff['ID']; ?>" class="staffspan">Florian</a></span><br />
							<span class="staffspan2">Administrateur</span>
						</div>
						<div class="staffdiv2">
							<a href="profil.php?id=<?php echo $infostaff['ID']; ?>"><img src="membre/avatar/<?php echo $infostaff['avatar']; ?>" alt="Avatar" class="staffimg" /></a><br />
							<span><a href="profil.php?id=<?php echo $infostaff['ID']; ?>" class="staffspan">Joris</a></span><br />
							<span class="staffspan2">Administrateur</span>
						</div>
						<div class="staffdiv2">
							<a href="profil.php?id=<?php echo $infostaff['ID']; ?>"><img src="membre/avatar/<?php echo $infostaff['avatar']; ?>" alt="Avatar" class="staffimg" /></a><br />
							<span><a href="profil.php?id=<?php echo $infostaff['ID']; ?>" class="staffspan">Clément</a></span><br />
							<span class="staffspan2">Administrateur</span>
						</div>
					</div>
					<div class="staffdiv1">
						<a href="profil.php?id=<?php echo $infostaff['ID']; ?>"><img src="membre/avatar/<?php echo $infostaff['avatar']; ?>" alt="Avatar" class="staffimg" /></a><br />
						<span><a href="profil.php?id=<?php echo $infostaff['ID']; ?>" class="staffspan">Damien</a></span><br />
						<span class="staffspan2">Administrateur</span>
					</div>
					
					
				<?php
				}
				$searchinfostaff->closeCursor();
				?>
				
			</div>
			<script id="cid0020000205644521856" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 251px;height: 426px;">{"handle":"metromanga1","arch":"js","styles":{"a":"cc0000","b":100,"c":"FFFFFF","d":"FFFFFF","k":"cc0000","l":"cc0000","m":"cc0000","n":"FFFFFF","p":"9.36","q":"cc0000","r":100,"pos":"br","cv":1,"cvbg":"CC0000","cvw":251,"cvh":30,"cnrs":"0.26","ticker":1,"fwtickm":1}}</script>
		
		</div>
		<?php include("includes/footer.php"); ?>
	</div>
	</body>
</html>