<?php session_start(); ?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<link rel="stylesheet" href="reglement.css" />
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
		<title>Règlements - Metro Manga</title>
	</head>
	
	<body id="body">
		<div id="body2">
		<?php include("includes/loading.php"); ?>
		<?php include("includes/header.php"); ?>
		<div id="contenuloading">
			<div id="contenu">
				<div class="contenutitre">
					<span class="titrecontact">Règlements</span>
					<hr class="hrcontact" />
				</div>
				
				<div class="spanreglement">
				- Le signalement sans raison et répétitif sont contraignants pour nos équipes,
				et est donc non-toléré si toutefois la personne malgré nos avertissements continue de signaler des contenus sans raison elle se verra dans l'impossibilité future de signaler des contenus.
				</div><br />                                                                                                                                                                                     
				<div class="spanreglement">
				- Les commentaires vous permet de faire part de votre avis, alors aucune insulte ni de publicité ou de spoil ne sont accepter.<br />MERCI D'ÉVITER D'ÉCRIRE LES COMMENTAIRES EN MAJUSCULE.
				</div><br /> 
				<div class="spanreglement">
				- La publication d'image à caractère raciste ou pornographique est sévèrement sanctionnée par proscription.
				</div><br />        
				
			</div>
			<script id="cid0020000205644521856" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 251px;height: 426px;">{"handle":"metromanga1","arch":"js","styles":{"a":"cc0000","b":100,"c":"FFFFFF","d":"FFFFFF","k":"cc0000","l":"cc0000","m":"cc0000","n":"FFFFFF","p":"9.36","q":"cc0000","r":100,"pos":"br","cv":1,"cvbg":"CC0000","cvw":251,"cvh":30,"cnrs":"0.26","ticker":1,"fwtickm":1}}</script>
		
		</div>
		<?php include("includes/footer.php"); ?>
	</div>
	</body>
</html>