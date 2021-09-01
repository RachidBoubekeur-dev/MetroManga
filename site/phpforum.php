<?php
	header("Content-Type: text/javascript");
	
	session_start();
	
	$db = new PDO('mysql:host=localhost;dbname=metromanga', 'root', '');
	
	if(isset($_GET['blocknoteretoile1']) AND isset($_GET['IDsujet']) AND isset($_SESSION['ID']))
	{
		$searchsujetid = $db->query('SELECT ID FROM forumsujets WHERE ID =\'' . $_GET['IDsujet'] . '\'');
		$searchsujetidexist = $searchsujetid->rowCount();
		if($searchsujetidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDsujet = $_GET['IDsujet'];
			$lien = 'http://metromanga.com/forum.php?id=' . $IDsujet . '';
			$IDmembre = $_SESSION['ID'];
			$note = 1;
			
			$insertnote = $db->prepare('INSERT INTO notesforum(IDsujet,lien,IDmembre,note) VALUES (:IDsujet,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDsujet' => $IDsujet,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
				
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\'');
			$notemoy = $searchmoynote->fetch();
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="arcticlesujetsmenuetoile" style="color:black;">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★<span style="color:black;">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★<span style="color:black;">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★<span style="color:black;">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★★<span style="color:black;">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['blocknoteretoile2']) AND isset($_GET['IDsujet']) AND isset($_SESSION['ID']))
	{
		$searchsujetid = $db->query('SELECT ID FROM forumsujets WHERE ID =\'' . $_GET['IDsujet'] . '\'');
		$searchsujetidexist = $searchsujetid->rowCount();
		if($searchsujetidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDsujet = $_GET['IDsujet'];
			$lien = 'http://metromanga.com/forum.php?id=' . $IDsujet . '';
			$IDmembre = $_SESSION['ID'];
			$note = 2;
			
			$insertnote = $db->prepare('INSERT INTO notesforum(IDsujet,lien,IDmembre,note) VALUES (:IDsujet,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDsujet' => $IDsujet,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
				
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\'');
			$notemoy = $searchmoynote->fetch();
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="arcticlesujetsmenuetoile" style="color:black;">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★<span style="color:black;">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★<span style="color:black;">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★<span style="color:black;">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★★<span style="color:black;">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['blocknoteretoile3']) AND isset($_GET['IDsujet']) AND isset($_SESSION['ID']))
	{
		$searchsujetid = $db->query('SELECT ID FROM forumsujets WHERE ID =\'' . $_GET['IDsujet'] . '\'');
		$searchsujetidexist = $searchsujetid->rowCount();
		if($searchsujetidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDsujet = $_GET['IDsujet'];
			$lien = 'http://metromanga.com/forum.php?id=' . $IDsujet . '';
			$IDmembre = $_SESSION['ID'];
			$note = 3;
			
			$insertnote = $db->prepare('INSERT INTO notesforum(IDsujet,lien,IDmembre,note) VALUES (:IDsujet,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDsujet' => $IDsujet,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
				
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\'');
			$notemoy = $searchmoynote->fetch();
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="arcticlesujetsmenuetoile" style="color:black;">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★<span style="color:black;">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★<span style="color:black;">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★<span style="color:black;">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★★<span style="color:black;">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['blocknoteretoile4']) AND isset($_GET['IDsujet']) AND isset($_SESSION['ID']))
	{
		$searchsujetid = $db->query('SELECT ID FROM forumsujets WHERE ID =\'' . $_GET['IDsujet'] . '\'');
		$searchsujetidexist = $searchsujetid->rowCount();
		if($searchsujetidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDsujet = $_GET['IDsujet'];
			$lien = 'http://metromanga.com/forum.php?id=' . $IDsujet . '';
			$IDmembre = $_SESSION['ID'];
			$note = 4;
			
			$insertnote = $db->prepare('INSERT INTO notesforum(IDsujet,lien,IDmembre,note) VALUES (:IDsujet,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDsujet' => $IDsujet,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
				
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\'');
			$notemoy = $searchmoynote->fetch();
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="arcticlesujetsmenuetoile" style="color:black;">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★<span style="color:black;">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★<span style="color:black;">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★<span style="color:black;">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★★<span style="color:black;">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['blocknoteretoile5']) AND isset($_GET['IDsujet']) AND isset($_SESSION['ID']))
	{
		$searchsujetid = $db->query('SELECT ID FROM forumsujets WHERE ID =\'' . $_GET['IDsujet'] . '\'');
		$searchsujetidexist = $searchsujetid->rowCount();
		if($searchsujetidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDsujet = $_GET['IDsujet'];
			$lien = 'http://metromanga.com/forum.php?id=' . $IDsujet . '';
			$IDmembre = $_SESSION['ID'];
			$note = 5;
			
			$insertnote = $db->prepare('INSERT INTO notesforum(IDsujet,lien,IDmembre,note) VALUES (:IDsujet,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDsujet' => $IDsujet,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
				
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\'');
			$notemoy = $searchmoynote->fetch();
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="arcticlesujetsmenuetoile" style="color:black;">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★<span style="color:black;">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★<span style="color:black;">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★<span style="color:black;">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★★<span style="color:black;">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="arcticlesujetsmenuetoile">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['signalersujet']) AND isset($_GET['IDsujet']))
	{
		$IDsujet = $_GET['IDsujet'];
		
		$searchinfosujet = $db->query('SELECT * FROM forumsujets WHERE ID =\'' . $_GET['IDsujet'] . '\'');
		$infosujet = $searchinfosujet->fetch();
		
		$searchsujetid2 = $db->query('SELECT ID FROM forumsujets WHERE ID =\'' . $_GET['IDsujet'] . '\'');
		$searchsujetidexist2 = $searchsujetid2->rowCount();
		if($searchsujetidexist2 == 0)
		{
			header("Location: ../index.php");
		}
		else
		{
			if(isset($_SESSION['ID']))
			{
				$IDmembre = $_SESSION['ID'];
			}
			else
			{
				$IDmembre = '0';
			}
			$theme = htmlspecialchars($infosujet['theme']);
			$titre = htmlspecialchars($infosujet['titre']);
			$image = htmlspecialchars($infosujet['image']);
			$contenu = htmlspecialchars($infosujet['contenu']);
			
			$signalersujet = $db->prepare('INSERT INTO signalesujet(IDsujet,IDmembre,theme,titre,image,contenu) VALUES (:IDsujet,:IDmembre,:theme,:titre,:image,:contenu)');
			$signalersujet->execute(array(
			'IDsujet' => $IDsujet,
			'IDmembre' => $IDmembre,
			'theme' => $theme,
			'titre' => $titre,
			'image' => $image,
			'contenu' => $contenu
			));	
			
			if(isset($_SESSION['ID']))
			{
				if($_SESSION['ID'] == '1')
				{
					echo
					'<span onclick="supprimersujet()"><img src="images/fermer.png" alt="Supprimer" class="infosujetssupprimer" /></span>';
				}
			}
			
			echo
			'<span><img src="images/signalerrouge.png" alt="Signaler" class="infosujetssignaler" style="cursor:default;"/></span>';
		}
	}
	else if(isset($_GET['supprimersujet']) AND isset($_GET['IDsujet']))
	{
		$lien = 'http://metromanga.com/forum.php?id=' . $_GET['IDsujet'] . '';
		
		$supprimersujet = $db->query('DELETE FROM forumsujets WHERE ID =\'' . $_GET['IDsujet'] . '\'');
		$supprimersujetcommentairesforum = $db->query('DELETE FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\'');
		$supprimersujetnotesforum = $db->query('DELETE FROM notesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\'');
		$supprimersujetsignalesujet = $db->query('DELETE FROM signalesujet WHERE IDsujet =\'' . $_GET['IDsujet'] . '\'');
		$supprimersujetsignalecommentaire = $db->prepare('DELETE FROM signalecommentaire WHERE lien = ?');
		$supprimersujetsignalecommentaire->execute(array($lien));
	}
	else if(isset($_GET['ajoutercommentaire']) AND isset($_GET['IDsujet']) AND isset($_SESSION['ID']))
	{	
		$searchinfosujet = $db->query('SELECT * FROM forumsujets WHERE ID =\'' . $_GET['IDsujet'] . '\'');
		$infosujet = $searchinfosujet->fetch();
		
		$IDsujet = $_GET['IDsujet'];
		$theme = $infosujet['theme'];
		$lien = 'http://metromanga.com/forum.php?id=' . $IDsujet . '';
		$IDmembre = $_SESSION['ID'];
		$commentaire = html_entity_decode($_GET['ajoutercommentaire']);
		
		if(mb_strlen($commentaire, 'utf8') >= 5 AND mb_strlen($commentaire, 'utf8') <= 255)
		{
			$commentaire = htmlspecialchars($_GET['ajoutercommentaire']);
			$insertcommentaire = $db->prepare('INSERT INTO commentairesforum(IDsujet,theme,lien,IDmembre,commentaire,date_creation) VALUES (:IDsujet,:theme,:lien,:IDmembre,:commentaire,NOW())');
			$insertcommentaire->execute(array(
			'IDsujet' => $IDsujet,
			'theme' => $theme,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'commentaire' => $commentaire
			));
			
			echo
			'<div class="blockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextarea" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaire()" style="outline:none;" /></legend>
					</fieldset>
				<span class="nbdecommentaires">' . $nbdecommentaires['nbdecommentaires'] . '</span>';				
			}
			else
			{
				echo
				'<p class="blockcommenternonmembre">La création de commentaire est exclusivement réserver aux membres.</p>';
			}
			
			echo
			'</div>';
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\' ORDER BY ID DESC LIMIT 0, 100');
				while ($infocommentaire = $searchinfocommentaire->fetch())
				{
				$searchinfocommentairemembre = $db->query('SELECT * FROM membres WHERE ID =\'' . $infocommentaire['IDmembre'] . '\'');
				$infocommentairemembre = $searchinfocommentairemembre->fetch();
		
			echo
			'<div class="infocommentaire">';
				$searchsignale = $db->prepare('SELECT * FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
				$searchsignale->execute(array($infocommentaire['ID'],$infocommentaire['lien']));
				$signaleexist = $searchsignale->rowCount();
				if($signaleexist == 0)
				{
					echo
					'<span onclick="signalecommentaire' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentaire' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
						}
					}
					
					echo
					'<span><img src="images/signalerrouge.png" alt="Signaler" class="infocommentairesignaler" style="cursor:default;"/></span>';
				}
					
					echo
					'<span><a href="profil.php?id=' . $infocommentairemembre['ID'] . '" ><img src="membre/avatar/' . $infocommentairemembre['avatar'] . '" alt="Avatar" class="infocommentaireavatar" /></a></span>
					<span class="infocommentairepseudo"><a href="profil.php?id=' . $infocommentairemembre['ID'] . '" style="color:white;text-decoration:none;">' . $infocommentairemembre['pseudo'] . '</a></span>
					<div class="infocommentairecontenu">
						<span class="infocommentairecontenuspan">' . $infocommentaire['commentaire'] . '</span>
					</div>
					<span class="infocommentairedate">' . date("H:i", strtotime($infocommentaire['date_creation'])) . '<span style="opacity:0;">-</span>' . date("d/m/Y", strtotime($infocommentaire['date_creation'])) . '</span>
			</div>';
			}
			$searchinfocommentaire->closeCursor();
			
			echo
			'<script>';
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentaire' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpforum.php?signalecommentaire=ok&IDsujet=' . $_GET['IDsujet'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajax\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentaire' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpforum.php?supprimercommentaire=ok&IDsujet=' . $_GET['IDsujet'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajax\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}';
			}
			$searchinfocommentairejs->closeCursor();
			
			echo
			'</script>';
		}
		else
		{
			echo
			'<div class="blockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextarea" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaire()" style="outline:none;" /></legend>
					</fieldset>
				<span class="nbdecommentaires">' . $nbdecommentaires['nbdecommentaires'] . '</span>';				
			}
			else
			{
				echo
				'<p class="blockcommenternonmembre">La création de commentaire est exclusivement réserver aux membres.</p>';
			}
			
			echo
			'</div>';
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\' ORDER BY ID DESC LIMIT 0, 100');
				while ($infocommentaire = $searchinfocommentaire->fetch())
				{
				$searchinfocommentairemembre = $db->query('SELECT * FROM membres WHERE ID =\'' . $infocommentaire['IDmembre'] . '\'');
				$infocommentairemembre = $searchinfocommentairemembre->fetch();
		
			echo
			'<div class="infocommentaire">';
				$searchsignale = $db->prepare('SELECT * FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
				$searchsignale->execute(array($infocommentaire['ID'],$infocommentaire['lien']));
				$signaleexist = $searchsignale->rowCount();
				if($signaleexist == 0)
				{
					echo
					'<span onclick="signalecommentaire' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentaire' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
						}
					}
					
					echo
					'<span><img src="images/signalerrouge.png" alt="Signaler" class="infocommentairesignaler" style="cursor:default;"/></span>';
				}
					
					echo
					'<span><a href="profil.php?id=' . $infocommentairemembre['ID'] . '" ><img src="membre/avatar/' . $infocommentairemembre['avatar'] . '" alt="Avatar" class="infocommentaireavatar" /></a></span>
					<span class="infocommentairepseudo"><a href="profil.php?id=' . $infocommentairemembre['ID'] . '" style="color:white;text-decoration:none;">' . $infocommentairemembre['pseudo'] . '</a></span>
					<div class="infocommentairecontenu">
						<span class="infocommentairecontenuspan">' . $infocommentaire['commentaire'] . '</span>
					</div>
					<span class="infocommentairedate">' . date("H:i", strtotime($infocommentaire['date_creation'])) . '<span style="opacity:0;">-</span>' . date("d/m/Y", strtotime($infocommentaire['date_creation'])) . '</span>
			</div>';
			}
			$searchinfocommentaire->closeCursor();
			
			echo
			'<script>';
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentaire' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpforum.php?signalecommentaire=ok&IDsujet=' . $_GET['IDsujet'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajax\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentaire' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpforum.php?supprimercommentaire=ok&IDsujet=' . $_GET['IDsujet'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajax\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}';
			}
			$searchinfocommentairejs->closeCursor();
			
			echo
			'</script>';
		}
	}
	else if(isset($_GET['signalecommentaire'])  AND isset($_GET['IDsujet']) AND isset($_GET['IDcommentaire']))
	{
		$signalecommentaire = $db->query('SELECT * FROM commentairesforum WHERE ID =\'' . $_GET['IDcommentaire'] . '\'');
		$signaleinfocommentaire = $signalecommentaire->fetch();
		
		$page = 'forum';
		$IDcommentaire = $signaleinfocommentaire['ID'];
		$lien = $signaleinfocommentaire['lien'];
		if(isset($_SESSION['ID']))
		{
			$IDmembre = $signaleinfocommentaire['IDmembre'];
		}
		else
		{
			$IDmembre = '0';
		}
		$commentaire = htmlspecialchars($signaleinfocommentaire['commentaire']);
			
		$signaler = $db->prepare('INSERT INTO signalecommentaire(page,IDcommentaire,lien,IDmembre,commentaire) VALUES (:page,:IDcommentaire,:lien,:IDmembre,:commentaire)');
		$signaler->execute(array(
		'page' => $page,
		'IDcommentaire' => $IDcommentaire,
		'lien' => $lien,
		'IDmembre' => $IDmembre,
		'commentaire' => $commentaire
		));
		
		echo
		'<div class="blockcommenter">';
		
		if(isset($_SESSION['ID']))
		{
			$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\'');
			$nbdecommentaires = $searchnbdecommentaires->fetch();
			
			echo
			'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
				<textarea id="blockcommentertextarea" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
				<fieldset class="blockcommenterajouterbarre">
					<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaire()" style="outline:none;" /></legend>
				</fieldset>
			<span class="nbdecommentaires">' . $nbdecommentaires['nbdecommentaires'] . '</span>';				
		}
		else
		{
			echo
			'<p class="blockcommenternonmembre">La création de commentaire est exclusivement réserver aux membres.</p>';
		}
		
		echo
		'</div>';
			$searchinfocommentaire = $db->query('SELECT * FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentaire = $searchinfocommentaire->fetch())
			{
			$searchinfocommentairemembre = $db->query('SELECT * FROM membres WHERE ID =\'' . $infocommentaire['IDmembre'] . '\'');
			$infocommentairemembre = $searchinfocommentairemembre->fetch();
		
		echo
		'<div class="infocommentaire">';
			$searchsignale = $db->prepare('SELECT * FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
			$searchsignale->execute(array($infocommentaire['ID'],$infocommentaire['lien']));
			$signaleexist = $searchsignale->rowCount();
			if($signaleexist == 0)
			{
				echo
				'<span onclick="signalecommentaire' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
			}
			else
			{
				if(isset($_SESSION['ID']))
				{
					if($_SESSION['ID'] == '1')
					{
						echo
						'<span onclick="supprimercommentaire' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
					}
				}
				
				echo
				'<span><img src="images/signalerrouge.png" alt="Signaler" class="infocommentairesignaler" style="cursor:default;"/></span>';
			}
				
				echo
				'<span><a href="profil.php?id=' . $infocommentairemembre['ID'] . '" ><img src="membre/avatar/' . $infocommentairemembre['avatar'] . '" alt="Avatar" class="infocommentaireavatar" /></a></span>
				<span class="infocommentairepseudo"><a href="profil.php?id=' . $infocommentairemembre['ID'] . '" style="color:white;text-decoration:none;">' . $infocommentairemembre['pseudo'] . '</a></span>
				<div class="infocommentairecontenu">
					<span class="infocommentairecontenuspan">' . $infocommentaire['commentaire'] . '</span>
				</div>
				<span class="infocommentairedate">' . date("H:i", strtotime($infocommentaire['date_creation'])) . '<span style="opacity:0;">-</span>' . date("d/m/Y", strtotime($infocommentaire['date_creation'])) . '</span>
		</div>';
		}
		$searchinfocommentaire->closeCursor();
		
		echo
		'<script>';
		
		$searchinfocommentairejs = $db->query('SELECT * FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\' ORDER BY ID DESC LIMIT 0, 100');
		while ($infocommentairejs = $searchinfocommentairejs->fetch())
		{
			echo
			'function signalecommentaire' . $infocommentairejs['ID'] . '()
			{
				var xhr = new XMLHttpRequest();
				
				xhr.open(\'GET\', \'site/phpforum.php?signalecommentaire=ok&IDsujet=' . $_GET['IDsujet'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
				
				xhr.onreadystatechange = function() 
				{
					if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
					{
						document.querySelector(\'#commentaireajax\').innerHTML = xhr.responseText;
					}
				};
				
				xhr.send(null);
			}
			
			function supprimercommentaire' . $infocommentairejs['ID'] . '()
			{
				var xhr = new XMLHttpRequest();
				
				xhr.open(\'GET\', \'site/phpforum.php?supprimercommentaire=ok&IDsujet=' . $_GET['IDsujet'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
				
				xhr.onreadystatechange = function() 
				{
					if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
					{
						document.querySelector(\'#commentaireajax\').innerHTML = xhr.responseText;
					}
				};
				
				xhr.send(null);
			}';
		}
		$searchinfocommentairejs->closeCursor();
		
		echo
		'</script>';
	}
	else if(isset($_GET['supprimercommentaire'])  AND isset($_GET['IDsujet']) AND isset($_GET['IDcommentaire']) AND isset($_GET['LIENcommentaire']) AND isset($_SESSION['ID']) AND $_SESSION['ID'] == '1')
	{
		$IDinfocommentaire = $_GET['IDcommentaire'];
		$lieninfocommentaire = $_GET['LIENcommentaire'];
		
		$supprimercommentaire = $db->prepare('DELETE FROM commentairesforum WHERE ID = ?');
		$supprimercommentaire->execute(array($IDinfocommentaire));	
		$supprimersignalecommentaire = $db->prepare('DELETE FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
		$supprimersignalecommentaire->execute(array($IDinfocommentaire,$lieninfocommentaire));
		
		echo
		'<div class="blockcommenter">';
		
		if(isset($_SESSION['ID']))
		{
			$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\'');
			$nbdecommentaires = $searchnbdecommentaires->fetch();
			
			echo
			'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
				<textarea id="blockcommentertextarea" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
				<fieldset class="blockcommenterajouterbarre">
					<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaire()" style="outline:none;" /></legend>
				</fieldset>
			<span class="nbdecommentaires">' . $nbdecommentaires['nbdecommentaires'] . '</span>';				
		}
		else
		{
			echo
			'<p class="blockcommenternonmembre">La création de commentaire est exclusivement réserver aux membres.</p>';
		}
		
		echo
		'</div>';
			$searchinfocommentaire = $db->query('SELECT * FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentaire = $searchinfocommentaire->fetch())
			{
			$searchinfocommentairemembre = $db->query('SELECT * FROM membres WHERE ID =\'' . $infocommentaire['IDmembre'] . '\'');
			$infocommentairemembre = $searchinfocommentairemembre->fetch();
		
		echo
		'<div class="infocommentaire">';
			$searchsignale = $db->prepare('SELECT * FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
			$searchsignale->execute(array($infocommentaire['ID'],$infocommentaire['lien']));
			$signaleexist = $searchsignale->rowCount();
			if($signaleexist == 0)
			{
				echo
				'<span onclick="signalecommentaire' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
			}
			else
			{
				if(isset($_SESSION['ID']))
				{
					if($_SESSION['ID'] == '1')
					{
						echo
						'<span onclick="supprimercommentaire' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
					}
				}
				
				echo
				'<span><img src="images/signalerrouge.png" alt="Signaler" class="infocommentairesignaler" style="cursor:default;"/></span>';
			}
				
				echo
				'<span><a href="profil.php?id=' . $infocommentairemembre['ID'] . '" ><img src="membre/avatar/' . $infocommentairemembre['avatar'] . '" alt="Avatar" class="infocommentaireavatar" /></a></span>
				<span class="infocommentairepseudo"><a href="profil.php?id=' . $infocommentairemembre['ID'] . '" style="color:white;text-decoration:none;">' . $infocommentairemembre['pseudo'] . '</a></span>
				<div class="infocommentairecontenu">
					<span class="infocommentairecontenuspan">' . $infocommentaire['commentaire'] . '</span>
				</div>
				<span class="infocommentairedate">' . date("H:i", strtotime($infocommentaire['date_creation'])) . '<span style="opacity:0;">-</span>' . date("d/m/Y", strtotime($infocommentaire['date_creation'])) . '</span>
		</div>';
		}
		$searchinfocommentaire->closeCursor();
		
		echo
		'<script>';
		
		$searchinfocommentairejs = $db->query('SELECT * FROM commentairesforum WHERE IDsujet =\'' . $_GET['IDsujet'] . '\' ORDER BY ID DESC LIMIT 0, 100');
		while ($infocommentairejs = $searchinfocommentairejs->fetch())
		{
			echo
			'function signalecommentaire' . $infocommentairejs['ID'] . '()
			{
				var xhr = new XMLHttpRequest();
				
				xhr.open(\'GET\', \'site/phpforum.php?signalecommentaire=ok&IDsujet=' . $_GET['IDsujet'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
				
				xhr.onreadystatechange = function() 
				{
					if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
					{
						document.querySelector(\'#commentaireajax\').innerHTML = xhr.responseText;
					}
				};
				
				xhr.send(null);
			}
			
			function supprimercommentaire' . $infocommentairejs['ID'] . '()
			{
				var xhr = new XMLHttpRequest();
				
				xhr.open(\'GET\', \'site/phpforum.php?supprimercommentaire=ok&IDsujet=' . $_GET['IDsujet'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
				
				xhr.onreadystatechange = function() 
				{
					if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
					{
						document.querySelector(\'#commentaireajax\').innerHTML = xhr.responseText;
					}
				};
				
				xhr.send(null);
			}';
		}
		$searchinfocommentairejs->closeCursor();
		
		echo
		'</script>';
	}
	else if(isset($_POST['ajoutersujet']) AND isset($_POST['titre']) AND isset($_POST['sujet']) AND isset($_POST['image']) AND isset($_POST['couleur']) AND isset($_SESSION['ID']))
	{
		$IDmembres = $_SESSION['ID'];
		$theme = htmlspecialchars($_POST['ajoutersujet']);
		$titre = html_entity_decode($_POST['titre']);
		$newimage = html_entity_decode($_POST['image']);
		$newimage = htmlspecialchars($_POST['image']);
		$couleur = htmlspecialchars($_POST['couleur']);
		$contenu = html_entity_decode($_POST['sujet']);
		$contenu = preg_replace('/<script(.*)>(.*)<\/script>/isU', null, $contenu);
		$contenu = preg_replace('/onload/isU', null, $contenu);
		
		if(mb_strlen($titre, 'utf8') >= 1)
		{	
			if(mb_strlen($titre, 'utf8') <= 100)
			{
				$titre = htmlspecialchars($titre);
				$searchtitre = $db->prepare('SELECT * FROM forumsujets WHERE theme = ? AND titre = ?');
				$searchtitre->execute(array($theme,$titre));
				$titreexist = $searchtitre->rowCount();
				if($titreexist == 0)
				{	
					if(mb_strlen($contenu, 'utf8') >= 120)
					{
						if(mb_strlen($contenu, 'utf8') <= 100000)
						{
							$contenu = htmlspecialchars($contenu);
							if($theme == 'animes')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontanimes.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'mangas')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontmangas.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'scans')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontscans.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'japanimation')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontjapanimation.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'queregarder')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontqueregarder.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'reglement')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontreglement.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'newsmetromanga')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontnews.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'evenements')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontevenements.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'bugs')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontbugs.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'actualite')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontactualite.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'audiovisuel')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontaudiovisuel.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'jeuxvideo')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontjeuxvideo.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'musique')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontmusique.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'informatique')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontinformatique.png';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'japon')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontjapon.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'rien')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontrien.jpg';
									
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:image,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'image' => $image,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$newsujet = $db->prepare('INSERT INTO forumsujets(IDmembres,theme,titre,image,couleur,contenu,date_creation) VALUES (:IDmembres,:theme,:titre,:newimage,:couleur,:contenu,NOW())');
									$newsujet->execute(array(
									'IDmembres' => $IDmembres,
									'theme' => $theme,
									'titre' => $titre,
									'newimage' => $newimage,
									'couleur' => $couleur,
									'contenu' => $contenu
									));
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
						}
						else
						{
							echo 
							'<br />
							<label id="titrecontenuajoutersujet2" class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
							<span id="confirmvaliderajoutersujet" style="display:none;">ERROR</span>
							<img class="erreurtitresujet" src="images/fermer.png" alt="Fermer" title="Votre sujet est trop long." />';
						}
					}
					else
					{
						echo 
						'<br />
						<label id="titrecontenuajoutersujet2" class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
						<span id="confirmvaliderajoutersujet" style="display:none;">ERROR</span>
						<img class="erreurtitresujet" src="images/fermer.png" alt="Fermer" title="Votre sujet est trop court." />';
					}
				}
				else
				{
					echo 
					'<img class="erreurtitre" src="images/fermer.png" alt="Fermer" title="Ce titre n\'est pas disponible." />
					<br />
					<label id="titrecontenuajoutersujet2" class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
					<span id="confirmvaliderajoutersujet" style="display:none;">ERROR</span>';
				}
			}
			else
			{
				echo 
				'<img class="erreurtitre" src="images/fermer.png" alt="Fermer" title="Le titre est trop long." />
				<br />
				<label id="titrecontenuajoutersujet2" class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
				<span id="confirmvaliderajoutersujet" style="display:none;">ERROR</span>';
			}
		}
		else
		{
			echo 
			'<img class="erreurtitre" src="images/fermer.png" alt="Fermer" title="Le titre est trop court." />
			<br />
			<label id="titrecontenuajoutersujet2" class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
			<span id="confirmvaliderajoutersujet" style="display:none;">ERROR</span>';
		}
	}
	else if(isset($_POST['modifiersujet']) AND isset($_POST['titre']) AND isset($_POST['sujet']) AND isset($_POST['image']) AND isset($_POST['couleur']) AND isset($_POST['idsujet']) AND isset($_SESSION['ID']))
	{
		$IDmembres = $_SESSION['ID'];
		$theme = htmlspecialchars($_POST['modifiersujet']);
		$titre = html_entity_decode($_POST['titre']);
		$newimage = html_entity_decode($_POST['image']);
		$newimage = htmlspecialchars($_POST['image']);
		$couleur = htmlspecialchars($_POST['couleur']);
		$idsujet = $_POST['idsujet'];
		$contenu = html_entity_decode($_POST['sujet']);
		$contenu = preg_replace('/<script(.*)>(.*)<\/script>/isU', null, $contenu);
		$contenu = preg_replace('/onload/isU', null, $contenu);
		
		if(mb_strlen($titre, 'utf8') >= 1)
		{	
			if(mb_strlen($titre, 'utf8') <= 100)
			{
				$titre = htmlspecialchars($titre);
				$searchtitre = $db->prepare('SELECT * FROM forumsujets WHERE ID != ? AND theme = ? AND titre = ?');
				$searchtitre->execute(array($idsujet,$theme,$titre));
				$titreexist = $searchtitre->rowCount();
				if($titreexist == 0)
				{	
					if(mb_strlen($contenu, 'utf8') >= 120)
					{
						if(mb_strlen($contenu, 'utf8') <= 100000)
						{
							$contenu = htmlspecialchars($contenu);
							if($theme == 'animes')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontanimes.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'mangas')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontmangas.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'scans')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontscans.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
								
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'japanimation')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontjapanimation.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'queregarder')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontqueregarder.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'reglement')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontreglement.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'newsmetromanga')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontnews.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'evenements')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontevenements.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'bugs')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontbugs.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'actualite')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontactualite.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'audiovisuel')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontaudiovisuel.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'jeuxvideo')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontjeuxvideo.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'musique')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontmusique.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'informatique')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontinformatique.png';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'japon')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontjapon.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
							else if($theme == 'rien')
							{
								if(strlen($newimage) <= 1)
								{
									$image = 'images/fontrien.jpg';
									
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $image . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
								else
								{
									$updatesujet = $db->query('UPDATE forumsujets SET theme=\'' . $theme . '\', titre=\'' . $titre . '\', image=\'' . $newimage . '\', couleur=\'' . $couleur . '\', contenu=\'' . $contenu . '\' WHERE ID=\'' . $idsujet . '\'');
									
									echo
									'<br />
									<label class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
									<span id="confirmvaliderajoutersujet" style="display:none;">OK</span>';
								}
							}
						}
						else
						{
							echo 
							'<br />
							<label id="titrecontenuajoutersujet2" class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
							<span id="confirmvaliderajoutersujet" style="display:none;">ERROR</span>
							<img class="erreurtitresujet" src="images/fermer.png" alt="Fermer" title="Votre sujet est trop long." />';
						}
					}
					else
					{
						echo 
						'<br />
						<label id="titrecontenuajoutersujet2" class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
						<span id="confirmvaliderajoutersujet" style="display:none;">ERROR</span>
						<img class="erreurtitresujet" src="images/fermer.png" alt="Fermer" title="Votre sujet est trop court." />';
					}
				}
				else
				{
					echo 
					'<img class="erreurtitre" src="images/fermer.png" alt="Fermer" title="Ce titre n\'est pas disponible." />
					<br />
					<label id="titrecontenuajoutersujet2" class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
					<span id="confirmvaliderajoutersujet" style="display:none;">ERROR</span>';
				}
			}
			else
			{
				echo 
				'<img class="erreurtitre" src="images/fermer.png" alt="Fermer" title="Le titre est trop long." />
				<br />
				<label id="titrecontenuajoutersujet2" class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
				<span id="confirmvaliderajoutersujet" style="display:none;">ERROR</span>';
			}
		}
		else
		{
			echo 
			'<img class="erreurtitre" src="images/fermer.png" alt="Fermer" title="Le titre est trop court." />
			<br />
			<label id="titrecontenuajoutersujet2" class="titrecontenuajoutersujet" for="titrecontenuajoutersujet">Contenu</label>
			<span id="confirmvaliderajoutersujet" style="display:none;">ERROR</span>';
		}
	}
	else
	{
		header("Location: ../index.php");
	}
?>