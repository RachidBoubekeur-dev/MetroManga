<?php session_start(); ?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<link rel="stylesheet" href="contact.css" />
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
		<title>Contact - Metro Manga</title>
	</head>
	
	<body id="body">
		<div id="body2">
		<?php include("includes/loading.php"); ?>
		<?php include("includes/header.php"); ?>
		<div id="contenuloading">
			<div id="contenu">
				<div class="contenutitre">
					<span class="titrecontact">Contacter Metro Manga</span>
					<hr class="hrcontact" />
				</div>
				
				<div id="textform">
					<span id="errorcontact"></span>
					<label class="titreform">Nom *</label>
					<input type="text" autocomplete="off" class="contenutitreform" id="contenutitreformnom" maxlength="100" minlength="1" required />
					<br />
					<label class="titreform">E-mail *</label>
					<input type="mail" autocomplete="off" class="contenutitreform" id="contenutitreformmail" style="right:-1.3%;" maxlength="300" minlength="1" required />
					<br />
					<label class="titreform">Sujet *</label>
					<input type="text" autocomplete="off" class="contenutitreform" id="contenutitreformsujet" style="right:-2.75%;" maxlength="500" minlength="1" required />
					<br />
					<textarea class="contenutitreformtextarea" id="contenutitreformtextarea" placeholder="Message *" maxlength="9000" minlength="1" required ></textarea>
					
					<a href="#body" ><input type="submit" value="Valider" id="envoyerform" class="envoyerform" style="outline:none;" onclick="envoyerform();" /></a>
				</div>
				
				<p id="reponseform">Merci, Metro Manga vous répondra dans les plus brefs délais.</p>
				
				<script>
				
					$('a[href^="#"]').click(function(){
					var the_id = $(this).attr("href");
					$("#body2").mCustomScrollbar("scrollTo",$(the_id).offset().top -0, { scrollInertia: 1000 }); return false;});
					
					function envoyerform()
					{
						var xhr = new XMLHttpRequest();
						var valuenom = document.querySelector('#contenutitreformnom').value;
						var valuemail = document.querySelector('#contenutitreformmail').value;
						var valuesujet = document.querySelector('#contenutitreformsujet').value;
						var valuemessage = document.querySelector('#contenutitreformtextarea').value;
						
						var valuenom = encodeURIComponent(valuenom);
						var valuemail = encodeURIComponent(valuemail);
						var valuesujet = encodeURIComponent(valuesujet);
						var valuemessage = encodeURIComponent(valuemessage);
						
						xhr.open('POST', 'site/phpcontact.php');
						xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						xhr.send('contact=' + valuenom + '&mail=' + valuemail + '&sujet=' + valuesujet + '&message=' + valuemessage);
						
						xhr.onreadystatechange = function() 
						{
							if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
							{
								document.querySelector('#errorcontact').innerHTML = xhr.responseText;
								confirmenvoyerform();
							}
						};
						
						xhr.send(null);
					}
					
					function confirmenvoyerform()
					{
						if(document.querySelector('#errorcontact').innerHTML == "OK")
						{
							document.querySelector("#textform").style.display="none";
							document.querySelector("#reponseform").style.display="block";
							window.setTimeout("location=('index.php');",7000);
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