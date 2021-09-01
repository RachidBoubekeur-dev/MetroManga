<?php session_start(); ?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<link rel="stylesheet" href="faq.css" />
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
		<title>F.A.Q - Metro Manga</title>
	</head>
	
	<body id="body">
		<div id="body2">
		<?php include("includes/loading.php"); ?>
		<?php include("includes/header.php"); ?>
		<div id="contenuloading">
			<div id="contenu">
				<div class="contenutitre">
					<span class="titrecontact">F.A.Q</span>
					<hr class="hrcontact" />
				</div>
				
				<div class="blockfaq">
					<div class="themefaq">
						<span class="titrethemefaq">À propos de Metro Manga</span>
					</div>
					<div class="themefaq2" id="themefaq1">
						<span class="titrethemefaq2">Qu'est-ce que Metro Manga ?</span>
						<img src="images/queregarder.png" alt="FAQ" class="titrethemefaqimg" />
					</div>
					<div class="reponsefaq2" id="reponsefaq1">
						<span class="titrereponsefaq2" id="titrereponsefaq1">Metro Manga est une plateforme streaming communautaire dédier aux passionnées de l'animation et de la culture japonaise, fondée sur le principe de liberté et de partage.</span>
					</div>
					<div class="themefaq2" id="themefaq2">
						<span class="titrethemefaq2">Qui y a-t-il sur Metro Manga ?</span>
						<img src="images/queregarder.png" alt="FAQ" class="titrethemefaqimg" />
					</div>
					<div class="reponsefaq2" id="reponsefaq2">
						<span class="titrereponsefaq2" id="titrereponsefaq2">Metro Manga vous propose un large panel de divertissement.<br />
						Une webradio pour écouter les musiques en provenance d'Asie, d'une newsletter pour suivre l'actualité de l'animation japonaise, 
						vos animés préférer avec leurs épisodes VF/VOSTFR, leurs scans, leurs films, leurs oavs et leurs génériques, 
						vos films préférer en VF/VOSTFR, 
						d'un forum où vous pouvez trouver des articles de qualité de toute catégorie, 
						d'une gallery où trouver de magnifique illustration, 
						et pleines d'autres surprises...
						</span>
					</div>
					<div class="themefaq2" id="themefaq3">
						<span class="titrethemefaq2">Quel est le but de Metro Manga ?</span>
						<img src="images/queregarder.png" alt="FAQ" class="titrethemefaqimg" />
					</div>
					<div class="reponsefaq2" id="reponsefaq3">
						<span class="titrereponsefaq2" id="titrereponsefaq3">Le but de Metro Manga est de faciliter la découverte de la culture et de l'animation japonaise, de rassembler les passionnées, 
						d'adhérer le grand public qu'importe la tranche d'âge ou le milieu social pour ainsi augmenter la croissance du marché du manga et de l'animation japonaise.</span>
					</div>
				</div>
				
				<div class="blockfaq">
					<div class="themefaq">
						<span class="titrethemefaq">Problèmes techniques</span>
					</div>
					<div class="themefaq2" id="themefaq4">
						<span class="titrethemefaq2">Le lecteur vidéo ne fonctionne pas ?!</span>
						<img src="images/queregarder.png" alt="FAQ" class="titrethemefaqimg" />
					</div>
					<div class="reponsefaq2" id="reponsefaq4">
						<span class="titrereponsefaq2" id="titrereponsefaq4">Souvent il suffit simplement de réactualiser la page, mais si toutefois le problème persiste, signaler la vidéo si cela n'a pas déjà été fait pour que nous puissions remplacer le lecteur vidéo.</span>
					</div>
					<div class="themefaq2" id="themefaq5">
						<span class="titrethemefaq2">Autres questions</span>
						<img src="images/queregarder.png" alt="FAQ" class="titrethemefaqimg" />
					</div>
					<div class="reponsefaq2" id="reponsefaq5">
						<span class="titrereponsefaq2" id="titrereponsefaq5">Si vous avez des questions différentes ou que vous désirez des réponses précises, 
						nous vous invitons à nous contacter par le formulaire de contact disponible au pied de page pour des renseignements de type professionnel, ou via les réseaux sociaux pour les autres types de renseignement.</span>
					</div>
				</div>
				
				<script>
				
					document.querySelector("#themefaq1").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('#reponsefaq1')).height=='0px')
						{
							setTimeout(function(){document.querySelector("#titrereponsefaq1").style.display="block";}, 400);
							document.querySelector("#reponsefaq1").style.height="80px";
							document.querySelector("#reponsefaq1").style.paddingBottom="10px";
							document.querySelector("#reponsefaq1").style.marginBottom="2px";
							document.querySelector("#titrereponsefaq2").style.display="none";
							document.querySelector("#reponsefaq2").style.height="0px";
							document.querySelector("#reponsefaq2").style.paddingBottom="0px";
							document.querySelector("#reponsefaq2").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq3").style.display="none";
							document.querySelector("#reponsefaq3").style.height="0px";
							document.querySelector("#reponsefaq3").style.paddingBottom="0px";
							document.querySelector("#reponsefaq3").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq4").style.display="none";
							document.querySelector("#reponsefaq4").style.height="0px";
							document.querySelector("#reponsefaq4").style.paddingBottom="0px";
							document.querySelector("#reponsefaq4").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq5").style.display="none";
							document.querySelector("#reponsefaq5").style.height="0px";
							document.querySelector("#reponsefaq5").style.paddingBottom="0px";
							document.querySelector("#reponsefaq5").style.marginBottom="0px";
							
						}
						else
						{
							document.querySelector("#titrereponsefaq1").style.display="none";
							document.querySelector("#reponsefaq1").style.height="0px";
							document.querySelector("#reponsefaq1").style.paddingBottom="0px";
							document.querySelector("#reponsefaq1").style.marginBottom="0px";
						}
					}
					
					document.querySelector("#themefaq2").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('#reponsefaq2')).height=='0px')
						{
							setTimeout(function(){document.querySelector("#titrereponsefaq2").style.display="block";}, 400);
							document.querySelector("#reponsefaq2").style.height="190px";
							document.querySelector("#reponsefaq2").style.paddingBottom="10px";
							document.querySelector("#reponsefaq2").style.marginBottom="2px";
							document.querySelector("#titrereponsefaq1").style.display="none";
							document.querySelector("#reponsefaq1").style.height="0px";
							document.querySelector("#reponsefaq1").style.paddingBottom="0px";
							document.querySelector("#reponsefaq1").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq3").style.display="none";
							document.querySelector("#reponsefaq3").style.height="0px";
							document.querySelector("#reponsefaq3").style.paddingBottom="0px";
							document.querySelector("#reponsefaq3").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq4").style.display="none";
							document.querySelector("#reponsefaq4").style.height="0px";
							document.querySelector("#reponsefaq4").style.paddingBottom="0px";
							document.querySelector("#reponsefaq4").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq5").style.display="none";
							document.querySelector("#reponsefaq5").style.height="0px";
							document.querySelector("#reponsefaq5").style.paddingBottom="0px";
							document.querySelector("#reponsefaq5").style.marginBottom="0px";
							
						}
						else
						{
							document.querySelector("#titrereponsefaq2").style.display="none";
							document.querySelector("#reponsefaq2").style.height="0px";
							document.querySelector("#reponsefaq2").style.paddingBottom="0px";
							document.querySelector("#reponsefaq2").style.marginBottom="0px";
						}
					}
					
					document.querySelector("#themefaq3").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('#reponsefaq3')).height=='0px')
						{
							setTimeout(function(){document.querySelector("#titrereponsefaq3").style.display="block";}, 400);
							document.querySelector("#reponsefaq3").style.height="120px";
							document.querySelector("#reponsefaq3").style.paddingBottom="10px";
							document.querySelector("#reponsefaq3").style.marginBottom="2px";
							document.querySelector("#titrereponsefaq1").style.display="none";
							document.querySelector("#reponsefaq1").style.height="0px";
							document.querySelector("#reponsefaq1").style.paddingBottom="0px";
							document.querySelector("#reponsefaq1").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq2").style.display="none";
							document.querySelector("#reponsefaq2").style.height="0px";
							document.querySelector("#reponsefaq2").style.paddingBottom="0px";
							document.querySelector("#reponsefaq2").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq4").style.display="none";
							document.querySelector("#reponsefaq4").style.height="0px";
							document.querySelector("#reponsefaq4").style.paddingBottom="0px";
							document.querySelector("#reponsefaq4").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq5").style.display="none";
							document.querySelector("#reponsefaq5").style.height="0px";
							document.querySelector("#reponsefaq5").style.paddingBottom="0px";
							document.querySelector("#reponsefaq5").style.marginBottom="0px";
							
						}
						else
						{
							document.querySelector("#titrereponsefaq3").style.display="none";
							document.querySelector("#reponsefaq3").style.height="0px";
							document.querySelector("#reponsefaq3").style.paddingBottom="0px";
							document.querySelector("#reponsefaq3").style.marginBottom="0px";
						}
					}
					
					document.querySelector("#themefaq4").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('#reponsefaq4')).height=='0px')
						{
							setTimeout(function(){document.querySelector("#titrereponsefaq4").style.display="block";}, 400);
							document.querySelector("#reponsefaq4").style.height="80px";
							document.querySelector("#reponsefaq4").style.paddingBottom="10px";
							document.querySelector("#reponsefaq4").style.marginBottom="2px";
							document.querySelector("#titrereponsefaq1").style.display="none";
							document.querySelector("#reponsefaq1").style.height="0px";
							document.querySelector("#reponsefaq1").style.paddingBottom="0px";
							document.querySelector("#reponsefaq1").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq2").style.display="none";
							document.querySelector("#reponsefaq2").style.height="0px";
							document.querySelector("#reponsefaq2").style.paddingBottom="0px";
							document.querySelector("#reponsefaq2").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq3").style.display="none";
							document.querySelector("#reponsefaq3").style.height="0px";
							document.querySelector("#reponsefaq3").style.paddingBottom="0px";
							document.querySelector("#reponsefaq3").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq5").style.display="none";
							document.querySelector("#reponsefaq5").style.height="0px";
							document.querySelector("#reponsefaq5").style.paddingBottom="0px";
							document.querySelector("#reponsefaq5").style.marginBottom="0px";
							
						}
						else
						{
							document.querySelector("#titrereponsefaq4").style.display="none";
							document.querySelector("#reponsefaq4").style.height="0px";
							document.querySelector("#reponsefaq4").style.paddingBottom="0px";
							document.querySelector("#reponsefaq4").style.marginBottom="0px";
						}
					}
					
					document.querySelector("#themefaq5").onclick = function()
					{ 
						if (window.getComputedStyle(document.querySelector('#reponsefaq5')).height=='0px')
						{
							setTimeout(function(){document.querySelector("#titrereponsefaq5").style.display="block";}, 400);
							document.querySelector("#reponsefaq5").style.height="115px";
							document.querySelector("#reponsefaq5").style.paddingBottom="10px";
							document.querySelector("#reponsefaq5").style.marginBottom="2px";
							document.querySelector("#titrereponsefaq1").style.display="none";
							document.querySelector("#reponsefaq1").style.height="0px";
							document.querySelector("#reponsefaq1").style.paddingBottom="0px";
							document.querySelector("#reponsefaq1").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq2").style.display="none";
							document.querySelector("#reponsefaq2").style.height="0px";
							document.querySelector("#reponsefaq2").style.paddingBottom="0px";
							document.querySelector("#reponsefaq2").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq3").style.display="none";
							document.querySelector("#reponsefaq3").style.height="0px";
							document.querySelector("#reponsefaq3").style.paddingBottom="0px";
							document.querySelector("#reponsefaq3").style.marginBottom="0px";
							document.querySelector("#titrereponsefaq4").style.display="none";
							document.querySelector("#reponsefaq4").style.height="0px";
							document.querySelector("#reponsefaq4").style.paddingBottom="0px";
							document.querySelector("#reponsefaq4").style.marginBottom="0px";
							
						}
						else
						{
							document.querySelector("#titrereponsefaq5").style.display="none";
							document.querySelector("#reponsefaq5").style.height="0px";
							document.querySelector("#reponsefaq5").style.paddingBottom="0px";
							document.querySelector("#reponsefaq5").style.marginBottom="0px";
						}
					}
					
				</script>
				
			</div>
			<script id="cid0020000205644521856" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 251px;height: 426px;">{"handle":"metromanga1","arch":"js","styles":{"a":"cc0000","b":100,"c":"FFFFFF","d":"FFFFFF","k":"cc0000","l":"cc0000","m":"cc0000","n":"FFFFFF","p":"9.36","q":"cc0000","r":100,"pos":"br","cv":1,"cvbg":"CC0000","cvw":251,"cvh":30,"cnrs":"0.26","ticker":1,"fwtickm":1}}</script>
		
		</div>
		<?php include("includes/footer.php"); ?>
	</div>
	</body>
</html>