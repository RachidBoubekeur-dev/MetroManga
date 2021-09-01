<?php
	header("Content-Type: text/javascript");
	
	session_start();
	
	$db = new PDO('mysql:host=localhost;dbname=metromanga', 'root', '');
	
	if(isset($_GET['trierparalphabetique']))
	{
		$searchinfofilm = $db->query('SELECT * FROM films ORDER BY titre');
		while($infofilm = $searchinfofilm->fetch())
		{
			echo
			'<a href="film.php?id=' . $infofilm['ID'] . '" style="text-decoration:none;">
			<div class="blockfilm" id="' . htmlspecialchars($infofilm['lettre']) . '">';
			
			$datefilm = date("Y-m-d", strtotime($infofilm['date_ajout']));
			$newcontenuimg = date('Y-m-d');
			
			if($datefilm >= $newcontenuimg)
			{
				echo
				'<img src="images/new.png" alt="New" class="newcontenuimg" />';
			}
				echo
				'<span><img src="film/' . $infofilm['image'] . '" alt="Affiche du film" title="' . htmlspecialchars($infofilm['titre']) . '" class="blockfilmimg" /></span>
			</div>
			</a>';
		}
		$searchinfofilm->closeCursor();
	}
	else if(isset($_GET['trierparrecent']))
	{
		$searchinfofilm = $db->query('SELECT * FROM films ORDER BY ID DESC');
		while($infofilm = $searchinfofilm->fetch())
		{
			echo
			'<a href="film.php?id=' . $infofilm['ID'] . '" style="text-decoration:none;">
			<div class="blockfilm" id="' . htmlspecialchars($infofilm['lettre']) . '">';
			
			$datefilm = date("Y-m-d", strtotime($infofilm['date_ajout']));
			$newcontenuimg = date('Y-m-d');
			
			if($datefilm >= $newcontenuimg)
			{
				echo
				'<img src="images/new.png" alt="New" class="newcontenuimg" />';
			}
				echo
				'<span><img src="film/' . $infofilm['image'] . '" alt="Affiche du film" title="' . htmlspecialchars($infofilm['titre']) . '" class="blockfilmimg" /></span>
			</div>
			</a>';
		}
		$searchinfofilm->closeCursor();
	}
	else if(isset($_GET['trierparmieuxnotes']))
	{
		$searchinfofilm = $db->query('SELECT * FROM films ORDER BY note DESC');
		while($infofilm = $searchinfofilm->fetch())
		{
			echo
			'<a href="film.php?id=' . $infofilm['ID'] . '" style="text-decoration:none;">
			<div class="blockfilm" id="' . htmlspecialchars($infofilm['lettre']) . '">';
			
			$datefilm = date("Y-m-d", strtotime($infofilm['date_ajout']));
			$newcontenuimg = date('Y-m-d');
			
			if($datefilm >= $newcontenuimg)
			{
				echo
				'<img src="images/new.png" alt="New" class="newcontenuimg" />';
			}
				echo
				'<span><img src="film/' . $infofilm['image'] . '" alt="Affiche du film" title="' . htmlspecialchars($infofilm['titre']) . '" class="blockfilmimg" /></span>
			</div>
			</a>';
		}
		$searchinfofilm->closeCursor();
	}
	else if(isset($_GET['blocknoteretoile1film']) AND isset($_GET['IDfilm']) AND isset($_SESSION['ID']))
	{
		$searchfilmid = $db->query('SELECT ID FROM films WHERE ID =\'' . $_GET['IDfilm'] . '\'');
		$searchfilmidexist = $searchfilmid->rowCount();
		if($searchfilmidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDfilm = $_GET['IDfilm'];
			$lien = 'http://metromanga.com/film.php?id=' . $IDfilm . '';
			$IDmembre = $_SESSION['ID'];
			$note = 1;
			
			$insertnote = $db->prepare('INSERT INTO notesfilms(IDfilm,lien,IDmembre,note) VALUES (:IDfilm,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDfilm' => $IDfilm,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
				
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\'');
			$notemoy = $searchmoynote->fetch();
			$updatenote = $db->query('UPDATE films SET note =\'' . $notemoy['notemoy'] . '\' WHERE ID =\'' . $_GET['IDfilm'] . '\'');
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="contenufilmblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="contenufilmblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['blocknoteretoile2film']) AND isset($_GET['IDfilm']) AND isset($_SESSION['ID']))
	{
		$searchfilmid = $db->query('SELECT ID FROM films WHERE ID =\'' . $_GET['IDfilm'] . '\'');
		$searchfilmidexist = $searchfilmid->rowCount();
		if($searchfilmidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDfilm = $_GET['IDfilm'];
			$lien = 'http://metromanga.com/film.php?id=' . $IDfilm . '';
			$IDmembre = $_SESSION['ID'];
			$note = 2;
			
			$insertnote = $db->prepare('INSERT INTO notesfilms(IDfilm,lien,IDmembre,note) VALUES (:IDfilm,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDfilm' => $IDfilm,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
				
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\'');
			$notemoy = $searchmoynote->fetch();	
			$updatenote = $db->query('UPDATE films SET note =\'' . $notemoy['notemoy'] . '\' WHERE ID =\'' . $_GET['IDfilm'] . '\'');
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="contenufilmblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="contenufilmblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['blocknoteretoile3film']) AND isset($_GET['IDfilm']) AND isset($_SESSION['ID']))
	{
		$searchfilmid = $db->query('SELECT ID FROM films WHERE ID =\'' . $_GET['IDfilm'] . '\'');
		$searchfilmidexist = $searchfilmid->rowCount();
		if($searchfilmidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDfilm = $_GET['IDfilm'];
			$lien = 'http://metromanga.com/film.php?id=' . $IDfilm . '';
			$IDmembre = $_SESSION['ID'];
			$note = 3;
			
			$insertnote = $db->prepare('INSERT INTO notesfilms(IDfilm,lien,IDmembre,note) VALUES (:IDfilm,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDfilm' => $IDfilm,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
				
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\'');
			$notemoy = $searchmoynote->fetch();	
			$updatenote = $db->query('UPDATE films SET note =\'' . $notemoy['notemoy'] . '\' WHERE ID =\'' . $_GET['IDfilm'] . '\'');
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="contenufilmblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="contenufilmblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['blocknoteretoile4film']) AND isset($_GET['IDfilm']) AND isset($_SESSION['ID']))
	{
		$searchfilmid = $db->query('SELECT ID FROM films WHERE ID =\'' . $_GET['IDfilm'] . '\'');
		$searchfilmidexist = $searchfilmid->rowCount();
		if($searchfilmidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDfilm = $_GET['IDfilm'];
			$lien = 'http://metromanga.com/film.php?id=' . $IDfilm . '';
			$IDmembre = $_SESSION['ID'];
			$note = 4;
			
			$insertnote = $db->prepare('INSERT INTO notesfilms(IDfilm,lien,IDmembre,note) VALUES (:IDfilm,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDfilm' => $IDfilm,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
				
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\'');
			$notemoy = $searchmoynote->fetch();
			$updatenote = $db->query('UPDATE films SET note =\'' . $notemoy['notemoy'] . '\' WHERE ID =\'' . $_GET['IDfilm'] . '\'');
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="contenufilmblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="contenufilmblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['blocknoteretoile5film']) AND isset($_GET['IDfilm']) AND isset($_SESSION['ID']))
	{
		$searchfilmid = $db->query('SELECT ID FROM films WHERE ID =\'' . $_GET['IDfilm'] . '\'');
		$searchfilmidexist = $searchfilmid->rowCount();
		if($searchfilmidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDfilm = $_GET['IDfilm'];
			$lien = 'http://metromanga.com/film.php?id=' . $IDfilm . '';
			$IDmembre = $_SESSION['ID'];
			$note = 5;
			
			$insertnote = $db->prepare('INSERT INTO notesfilms(IDfilm,lien,IDmembre,note) VALUES (:IDfilm,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDfilm' => $IDfilm,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
				
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\'');
			$notemoy = $searchmoynote->fetch();	
			$updatenote = $db->query('UPDATE films SET note =\'' . $notemoy['notemoy'] . '\' WHERE ID =\'' . $_GET['IDfilm'] . '\'');
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="contenufilmblockaffichenote" style="color:rgb(10,10,10);cursor:default;">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="contenufilmblockaffichenote">★<span style="color:rgb(10,10,10);cursor:default;">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★<span style="color:rgb(10,10,10);cursor:default;">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★<span style="color:rgb(10,10,10);cursor:default;">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="contenufilmblockaffichenote">★★★★<span style="color:rgb(10,10,10);cursor:default;">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="contenufilmblockaffichenote" style="cursor:default;">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['signalerfilmlecteurvf']) AND isset($_GET['IDfilm']))
	{
		$IDfilm = $_GET['IDfilm'];
		$lien = 'http://metromanga.com/film.php?id=' . $IDfilm . '';
		if(isset($_SESSION['ID']))
		{
			$IDmembre = $_SESSION['ID'];
		}
		else
		{
			$IDmembre = '0';
		}
		$video = "VF";
		
		$signalerfilmlecteurvf = $db->prepare('INSERT INTO signalefilm(IDfilm,lien,IDmembre,video) VALUES (:IDfilm,:lien,:IDmembre,:video)');
		$signalerfilmlecteurvf->execute(array(
		'IDfilm' => $IDfilm,
		'lien' => $lien,
		'IDmembre' => $IDmembre,
		'video' => $video
		));
		
		echo
		'<span><img src="images/signalerrouge.png" alt="Signaler" class="contenufilmblocksignaler" style="cursor:default;" /></span>';
	}
	else if(isset($_GET['signalerfilmlecteurvostfr']) AND isset($_GET['IDfilm']))
	{
		$IDfilm = $_GET['IDfilm'];
		$lien = 'http://metromanga.com/film.php?id=' . $IDfilm . '';
		if(isset($_SESSION['ID']))
		{
			$IDmembre = $_SESSION['ID'];
		}
		else
		{
			$IDmembre = '0';
		}
		$video = "VOSTFR";
		
		$signalerfilmlecteurvostfr = $db->prepare('INSERT INTO signalefilm(IDfilm,lien,IDmembre,video) VALUES (:IDfilm,:lien,:IDmembre,:video)');
		$signalerfilmlecteurvostfr->execute(array(
		'IDfilm' => $IDfilm,
		'lien' => $lien,
		'IDmembre' => $IDmembre,
		'video' => $video
		));
		
		echo
		'<span><img src="images/signalerrouge.png" alt="Signaler" class="contenufilmblocksignaler" style="cursor:default;" /></span>';
	}
	else if(isset($_GET['ajoutercommentaire']) AND isset($_GET['IDfilm']) AND isset($_SESSION['ID']))
	{
		$IDfilm = $_GET['IDfilm'];
		$lien = 'http://metromanga.com/film.php?id=' . $IDfilm . '';
		$IDmembre = $_SESSION['ID'];
		$commentaire = html_entity_decode($_GET['ajoutercommentaire']);
		
		if(mb_strlen($commentaire, 'utf8') >= 5 AND mb_strlen($commentaire, 'utf8') <= 255)
		{
			$commentaire = htmlspecialchars($_GET['ajoutercommentaire']);
			$insertcommentaire = $db->prepare('INSERT INTO commentairesfilms(IDfilm,lien,IDmembre,commentaire,date_creation) VALUES (:IDfilm,:lien,:IDmembre,:commentaire,NOW())');
			$insertcommentaire->execute(array(
			'IDfilm' => $IDfilm,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'commentaire' => $commentaire
			));
			
			echo
			'<div class="blockcommentairesblockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextarea" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaire()" /></legend>
					</fieldset>
				<span class="nbdecommentaires">' . $nbdecommentaires['nbdecommentaires'] . '</span>';				
			}
			else
			{
				echo
				'<p class="blockcommenternonmembre">La création de commentaire est exclusivement réserver aux membres.</p>';
			}
			
			echo
			'</div>
			<br />';
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentaire' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpfilm.php?signalecommentaire=ok&IDfilm=' . $_GET['IDfilm'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
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
					
					xhr.open(\'GET\', \'site/phpfilm.php?supprimercommentaire=ok&IDfilm=' . $_GET['IDfilm'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
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
			'<div class="blockcommentairesblockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextarea" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaire()" /></legend>
					</fieldset>
				<span class="nbdecommentaires">' . $nbdecommentaires['nbdecommentaires'] . '</span>';				
			}
			else
			{
				echo
				'<p class="blockcommenternonmembre">La création de commentaire est exclusivement réserver aux membres.</p>';
			}
			
			echo
			'</div>
			<br />';
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentaire' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpfilm.php?signalecommentaire=ok&IDfilm=' . $_GET['IDfilm'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
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
					
					xhr.open(\'GET\', \'site/phpfilm.php?supprimercommentaire=ok&IDfilm=' . $_GET['IDfilm'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
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
	else if(isset($_GET['signalecommentaire'])  AND isset($_GET['IDfilm']) AND isset($_GET['IDcommentaire']))
	{
		$signalecommentaire = $db->query('SELECT * FROM commentairesfilms WHERE ID =\'' . $_GET['IDcommentaire'] . '\'');
		$signaleinfocommentaire = $signalecommentaire->fetch();
		
		$page = 'film';
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
		'<div class="blockcommentairesblockcommenter">';
		
		if(isset($_SESSION['ID']))
		{
			$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\'');
			$nbdecommentaires = $searchnbdecommentaires->fetch();
			
			echo
			'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
				<textarea id="blockcommentertextarea" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
				<fieldset class="blockcommenterajouterbarre">
					<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaire()" /></legend>
				</fieldset>
			<span class="nbdecommentaires">' . $nbdecommentaires['nbdecommentaires'] . '</span>';				
		}
		else
		{
			echo
			'<p class="blockcommenternonmembre">La création de commentaire est exclusivement réserver aux membres.</p>';
		}
		
		echo
		'</div>
		<br />';
			$searchinfocommentaire = $db->query('SELECT * FROM commentairesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentaire' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpfilm.php?signalecommentaire=ok&IDfilm=' . $_GET['IDfilm'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
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
					
					xhr.open(\'GET\', \'site/phpfilm.php?supprimercommentaire=ok&IDfilm=' . $_GET['IDfilm'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
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
	else if(isset($_GET['supprimercommentaire'])  AND isset($_GET['IDfilm']) AND isset($_GET['IDcommentaire']) AND isset($_GET['LIENcommentaire']) AND isset($_SESSION['ID']) AND $_SESSION['ID'] == '1')
	{
		$IDinfocommentaire = $_GET['IDcommentaire'];
		$lieninfocommentaire = $_GET['LIENcommentaire'];
		
		$supprimercommentaire = $db->prepare('DELETE FROM commentairesfilms WHERE ID = ?');
		$supprimercommentaire->execute(array($IDinfocommentaire));	
		$supprimersignalecommentaire = $db->prepare('DELETE FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
		$supprimersignalecommentaire->execute(array($IDinfocommentaire,$lieninfocommentaire));
		
		echo
		'<div class="blockcommentairesblockcommenter">';
		
		if(isset($_SESSION['ID']))
		{
			$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\'');
			$nbdecommentaires = $searchnbdecommentaires->fetch();
			
			echo
			'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
				<textarea id="blockcommentertextarea" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
				<fieldset class="blockcommenterajouterbarre">
					<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaire()" /></legend>
				</fieldset>
			<span class="nbdecommentaires">' . $nbdecommentaires['nbdecommentaires'] . '</span>';				
		}
		else
		{
			echo
			'<p class="blockcommenternonmembre">La création de commentaire est exclusivement réserver aux membres.</p>';
		}
		
		echo
		'</div>
		<br />';
			$searchinfocommentaire = $db->query('SELECT * FROM commentairesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
		
		$searchinfocommentairejs = $db->query('SELECT * FROM commentairesfilms WHERE IDfilm =\'' . $_GET['IDfilm'] . '\' ORDER BY ID DESC LIMIT 0, 100');
		while ($infocommentairejs = $searchinfocommentairejs->fetch())
		{
			echo
			'function signalecommentaire' . $infocommentairejs['ID'] . '()
			{
				var xhr = new XMLHttpRequest();
				
				xhr.open(\'GET\', \'site/phpfilm.php?signalecommentaire=ok&IDfilm=' . $_GET['IDfilm'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
				
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
				
				xhr.open(\'GET\', \'site/phpfilm.php?supprimercommentaire=ok&IDfilm=' . $_GET['IDfilm'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
				
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
		header("Location: ../index.php");
	}
?>