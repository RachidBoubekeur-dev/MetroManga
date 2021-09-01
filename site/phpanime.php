<?php
	header("Content-Type: text/javascript");
	
	session_start();
	
	$db = new PDO('mysql:host=localhost;dbname=metromanga', 'root', '');
	
	if(isset($_GET['trierparalphabetique']))
	{
		$searchanime = $db->query('SELECT * FROM animes ORDER BY titre');
		while($infoanime = $searchanime->fetch())
		{
			echo
			'<div id="' . htmlspecialchars($infoanime['lettre']) . '" class="blockanime">
				<div class="cadreanime">
					<a href="anime.php?anime=' . $infoanime['ID'] . '"><span class="titreanime"><strong>&nbsp;&nbsp;' . htmlspecialchars($infoanime['titre']) . '</strong>';
									
						$searchnbvf = $db->query('SELECT COUNT(*) AS nbvf FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\' AND videovf >\'' . 2 . '\'');
						$nbvf = $searchnbvf->fetch();
						
						$searchderniervf = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\' AND videovf >\'' . 2 . '\' ORDER BY numero DESC LIMIT 0, 1');
						$derniervf = $searchderniervf->fetch();	
						
						$searchnbvostfr = $db->query('SELECT COUNT(*) AS nbvostfr FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$nbvostfr = $searchnbvostfr->fetch();
						
						$searchderniervostfr = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\' ORDER BY numero DESC LIMIT 0, 1');
						$derniervostfr = $searchderniervostfr->fetch();	
						
						$searchnbscan = $db->query('SELECT COUNT(*) AS nbscan FROM scans WHERE IDanime =\'' . $infoanime['ID'] . '\' AND page = 1');
						$nbscan = $searchnbscan->fetch();
						
						$searchdernierscan = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $infoanime['ID'] . '\' AND page = 1 ORDER BY numero DESC LIMIT 0, 1');
						$dernierscan = $searchdernierscan->fetch();
						
						$searchnbfilmanime = $db->query('SELECT COUNT(*) AS nbfilmanime FROM filmsanimes WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$nbfilmanime = $searchnbfilmanime->fetch();
						
						$searchnbfilmspecial = $db->query('SELECT COUNT(*) AS nbfilmspecial FROM filmsspecial WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$nbfilmspecial = $searchnbfilmspecial->fetch();
						
						$nbfilm = $nbfilmanime['nbfilmanime'] + $nbfilmspecial['nbfilmspecial'];
						
						$searchdernierfilmanime = $db->query('SELECT * FROM filmsanimes WHERE IDanime =\'' . $infoanime['ID'] . '\' ORDER BY numero DESC LIMIT 0, 1');
						$dernierfilmanime = $searchdernierfilmanime->fetch();
						
						$searchnboav = $db->query('SELECT COUNT(*) AS nboav FROM oavs WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$nboav = $searchnboav->fetch();
						
						$searchdernieroav = $db->query('SELECT * FROM oavs WHERE IDanime =\'' . $infoanime['ID'] . '\' ORDER BY numero DESC LIMIT 0, 1');
						$dernieroav = $searchdernieroav->fetch();
						
						$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesanimes WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$notemoy = $searchmoynote->fetch();	
						$notemoyenne = $notemoy['notemoy'];
						$ID = $infoanime['ID'];
						$updatenotemoy = $db->prepare('UPDATE animes SET note = :note WHERE ID = :ID');
						$updatenotemoy->execute(array('note' => $notemoyenne, 'ID' => $ID));
						if($notemoy['notemoy'] == 0)
						{
							echo
							'<span class="etoile" style="color:rgb(10,10,10);">★★★★★</span>';
						}
						else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
						{
							echo
							'<span class="etoile">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
						}
						else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
						{
							echo
							'<span class="etoile">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
						}
						else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
						{
							echo
							'<span class="etoile">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
						}
						else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
						{
							echo
							'<span class="etoile">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
						}
						else if($notemoy['notemoy'] >= 5)
						{
							echo
							'<span class="etoile">★★★★★</span>';
						}
					echo
					'</a>';
					
					$dateanime = date("Y-m-d", strtotime($infoanime['date']));
					$newcontenuimg = date('Y-m-d');
					
					if($dateanime >= $newcontenuimg)
					{
						echo
						'<img src="images/new.png" alt="New" class="newcontenuimg" style="margin-top: -25px;" />';
					}
					
					echo
					'<a href="anime.php?anime=' . $infoanime['ID'] . '"><img src="anime/' . $infoanime['image'] . '" alt="' . htmlspecialchars($infoanime['titre']) . '" class="imageanime" width="345" height="210" /></a>
					<span class="annee">Année : ' . htmlspecialchars($infoanime['annee']) . '</span>
					<span class="auteur">Auteur : ' . htmlspecialchars($infoanime['auteur']) . '</span>
					<span class="synopsis">Synopsis :</span>
					<span class="synopsis2">
						' . htmlspecialchars($infoanime['synopsis']) . '
					</span>
					<span class="genre">';
					
					if($infoanime['action'] == "Action")
					{
						echo
						'<span style="font-size:9px;background:orange;color:orange;border:1px solid orange;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Action </span>';
					}
					if($infoanime['aventure'] == "Aventure")
					{
						echo
						'<span style="font-size:9px;background:green;color:green;border:1px solid green;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Aventure </span>';
					}
					if($infoanime['amitier'] == "Amitié")
					{
						echo
						'<span style="font-size:9px;background:pink;color:pink;border:1px solid pink;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Amitié </span>';
					}
					if($infoanime['comedie'] == "Comédie")
					{
						echo
						'<span style="font-size:9px;background:yellow;color:yellow;border:1px solid yellow;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Comédie </span>';
					}
					if($infoanime['drame'] == "Drame")
					{
						echo
						'<span style="font-size:9px;background:red;color:red;border:1px solid red;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Drame </span>';
					}
					if($infoanime['fantastique'] == "Fantastique")
					{
						echo
						'<span style="font-size:9px;background:blue;color:blue;border:1px solid blue;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Fantastique </span>';
					}
					if($infoanime['guerre'] == "Guerre")
					{
						echo
						'<span style="font-size:9px;background:darkred;color:darkred;border:1px solid darkred;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Guerre </span>';
					}
					if($infoanime['cyber'] == "Cyber")
					{
						echo
						'<span style="font-size:9px;background:purple;color:purple;border:1px solid purple;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Cyber </span>';
					}
					if($infoanime['mecha'] == "Mecha")
					{
						echo
						'<span style="font-size:9px;background:gray;color:gray;border:1px solid gray;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Mecha </span>';
					}
					if($infoanime['sport'] == "Sport")
					{
						echo
						'<span style="font-size:9px;background:brown;color:brown;border:1px solid brown;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Sport </span>';
					}
					if($infoanime['horreur'] == "Horreur")
					{
						echo
						'<span style="font-size:9px;background:black;color:black;border:1px solid black;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Horreur </span>';
					}
					
					echo
					'</span>
					<ul class="menuanime">
						<li class="vf"><a href="anime.php?anime=' . $infoanime['ID'] . '&episode=' . $derniervf['numero'] . '">' . $nbvf['nbvf'] . ' VF</a></li>
						<li class="vostfr"><a href="anime.php?anime=' . $infoanime['ID'] . '&episode=' . $derniervostfr['numero'] . '">' . $nbvostfr['nbvostfr'] . ' VOSTFR</a></li>
						<li class="scan"><a href="anime.php?anime=' . $infoanime['ID'] . '&scan=' . $dernierscan['numero'] . '">' . $nbscan['nbscan'] . ' SCANS</a></li>
						<li class="film"><a href="anime.php?anime=' . $infoanime['ID'] . '&filmanime=' . $dernierfilmanime['numero'] . '">' . $nbfilm . ' FILMS</a></li>
						<li class="oav"><a href="anime.php?anime=' . $infoanime['ID'] . '&oav=' . $dernieroav['numero'] . '">' . $nboav['nboav'] . ' OAVs</a></li>
					</ul>
				</div>
			</div>';
		}
		$searchanime->closeCursor();
	}
	else if(isset($_GET['trierparrecent']))
	{
		$searchanime = $db->query('SELECT * FROM animes ORDER BY ID DESC');
		while($infoanime = $searchanime->fetch())
		{
			echo
			'<div id="' . htmlspecialchars($infoanime['lettre']) . '" class="blockanime">
				<div class="cadreanime">
					<a href="anime.php?anime=' . $infoanime['ID'] . '"><span class="titreanime"><strong>&nbsp;&nbsp;' . htmlspecialchars($infoanime['titre']) . '</strong>';
									
						$searchnbvf = $db->query('SELECT COUNT(*) AS nbvf FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\' AND videovf >\'' . 2 . '\'');
						$nbvf = $searchnbvf->fetch();
						
						$searchderniervf = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\' AND videovf >\'' . 2 . '\' ORDER BY numero DESC LIMIT 0, 1');
						$derniervf = $searchderniervf->fetch();	
						
						$searchnbvostfr = $db->query('SELECT COUNT(*) AS nbvostfr FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$nbvostfr = $searchnbvostfr->fetch();
						
						$searchderniervostfr = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\' ORDER BY numero DESC LIMIT 0, 1');
						$derniervostfr = $searchderniervostfr->fetch();	
						
						$searchnbscan = $db->query('SELECT COUNT(*) AS nbscan FROM scans WHERE IDanime =\'' . $infoanime['ID'] . '\' AND page = 1');
						$nbscan = $searchnbscan->fetch();
						
						$searchdernierscan = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $infoanime['ID'] . '\' AND page = 1 ORDER BY numero DESC LIMIT 0, 1');
						$dernierscan = $searchdernierscan->fetch();
						
						$searchnbfilmanime = $db->query('SELECT COUNT(*) AS nbfilmanime FROM filmsanimes WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$nbfilmanime = $searchnbfilmanime->fetch();
						
						$searchnbfilmspecial = $db->query('SELECT COUNT(*) AS nbfilmspecial FROM filmsspecial WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$nbfilmspecial = $searchnbfilmspecial->fetch();
						
						$nbfilm = $nbfilmanime['nbfilmanime'] + $nbfilmspecial['nbfilmspecial'];
						
						$searchdernierfilmanime = $db->query('SELECT * FROM filmsanimes WHERE IDanime =\'' . $infoanime['ID'] . '\' ORDER BY numero DESC LIMIT 0, 1');
						$dernierfilmanime = $searchdernierfilmanime->fetch();
						
						$searchnboav = $db->query('SELECT COUNT(*) AS nboav FROM oavs WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$nboav = $searchnboav->fetch();
						
						$searchdernieroav = $db->query('SELECT * FROM oavs WHERE IDanime =\'' . $infoanime['ID'] . '\' ORDER BY numero DESC LIMIT 0, 1');
						$dernieroav = $searchdernieroav->fetch();
						
						$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesanimes WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$notemoy = $searchmoynote->fetch();	
						$notemoyenne = $notemoy['notemoy'];
						$ID = $infoanime['ID'];
						$updatenotemoy = $db->prepare('UPDATE animes SET note = :note WHERE ID = :ID');
						$updatenotemoy->execute(array('note' => $notemoyenne, 'ID' => $ID));
						if($notemoy['notemoy'] == 0)
						{
							echo
							'<span class="etoile" style="color:rgb(10,10,10);">★★★★★</span>';
						}
						else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
						{
							echo
							'<span class="etoile">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
						}
						else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
						{
							echo
							'<span class="etoile">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
						}
						else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
						{
							echo
							'<span class="etoile">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
						}
						else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
						{
							echo
							'<span class="etoile">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
						}
						else if($notemoy['notemoy'] >= 5)
						{
							echo
							'<span class="etoile">★★★★★</span>';
						}
					echo
					'</a>';
					
					$dateanime = date("Y-m-d", strtotime($infoanime['date']));
					$newcontenuimg = date('Y-m-d');
					
					if($dateanime >= $newcontenuimg)
					{
						echo
						'<img src="images/new.png" alt="New" class="newcontenuimg" style="margin-top: -25px;" />';
					}
					
					echo
					'<a href="anime.php?anime=' . $infoanime['ID'] . '"><img src="anime/' . $infoanime['image'] . '" alt="' . htmlspecialchars($infoanime['titre']) . '" class="imageanime" width="345" height="210" /></a>
					<span class="annee">Année : ' . htmlspecialchars($infoanime['annee']) . '</span>
					<span class="auteur">Auteur : ' . htmlspecialchars($infoanime['auteur']) . '</span>
					<span class="synopsis">Synopsis :</span>
					<span class="synopsis2">
						' . htmlspecialchars($infoanime['synopsis']) . '
					</span>
					<span class="genre">';
					
					if($infoanime['action'] == "Action")
					{
						echo
						'<span style="font-size:9px;background:orange;color:orange;border:1px solid orange;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Action </span>';
					}
					if($infoanime['aventure'] == "Aventure")
					{
						echo
						'<span style="font-size:9px;background:green;color:green;border:1px solid green;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Aventure </span>';
					}
					if($infoanime['amitier'] == "Amitié")
					{
						echo
						'<span style="font-size:9px;background:pink;color:pink;border:1px solid pink;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Amitié </span>';
					}
					if($infoanime['comedie'] == "Comédie")
					{
						echo
						'<span style="font-size:9px;background:yellow;color:yellow;border:1px solid yellow;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Comédie </span>';
					}
					if($infoanime['drame'] == "Drame")
					{
						echo
						'<span style="font-size:9px;background:red;color:red;border:1px solid red;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Drame </span>';
					}
					if($infoanime['fantastique'] == "Fantastique")
					{
						echo
						'<span style="font-size:9px;background:blue;color:blue;border:1px solid blue;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Fantastique </span>';
					}
					if($infoanime['guerre'] == "Guerre")
					{
						echo
						'<span style="font-size:9px;background:darkred;color:darkred;border:1px solid darkred;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Guerre </span>';
					}
					if($infoanime['cyber'] == "Cyber")
					{
						echo
						'<span style="font-size:9px;background:purple;color:purple;border:1px solid purple;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Cyber </span>';
					}
					if($infoanime['mecha'] == "Mecha")
					{
						echo
						'<span style="font-size:9px;background:gray;color:gray;border:1px solid gray;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Mecha </span>';
					}
					if($infoanime['sport'] == "Sport")
					{
						echo
						'<span style="font-size:9px;background:brown;color:brown;border:1px solid brown;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Sport </span>';
					}
					if($infoanime['horreur'] == "Horreur")
					{
						echo
						'<span style="font-size:9px;background:black;color:black;border:1px solid black;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Horreur </span>';
					}
					
					echo
					'</span>
					<ul class="menuanime">
						<li class="vf"><a href="anime.php?anime=' . $infoanime['ID'] . '&episode=' . $derniervf['numero'] . '">' . $nbvf['nbvf'] . ' VF</a></li>
						<li class="vostfr"><a href="anime.php?anime=' . $infoanime['ID'] . '&episode=' . $derniervostfr['numero'] . '">' . $nbvostfr['nbvostfr'] . ' VOSTFR</a></li>
						<li class="scan"><a href="anime.php?anime=' . $infoanime['ID'] . '&scan=' . $dernierscan['numero'] . '">' . $nbscan['nbscan'] . ' SCANS</a></li>
						<li class="film"><a href="anime.php?anime=' . $infoanime['ID'] . '&filmanime=' . $dernierfilmanime['numero'] . '">' . $nbfilm . ' FILMS</a></li>
						<li class="oav"><a href="anime.php?anime=' . $infoanime['ID'] . '&oav=' . $dernieroav['numero'] . '">' . $nboav['nboav'] . ' OAVs</a></li>
					</ul>
				</div>
			</div>';
		}
		$searchanime->closeCursor();
	}
	else if(isset($_GET['trierparmieuxnotes']))
	{
		$searchanime = $db->query('SELECT * FROM animes ORDER BY note DESC');
		while($infoanime = $searchanime->fetch())
		{
			echo
			'<div id="' . htmlspecialchars($infoanime['lettre']) . '" class="blockanime">
				<div class="cadreanime">
					<a href="anime.php?anime=' . $infoanime['ID'] . '"><span class="titreanime"><strong>&nbsp;&nbsp;' . htmlspecialchars($infoanime['titre']) . '</strong>';
									
						$searchnbvf = $db->query('SELECT COUNT(*) AS nbvf FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\' AND videovf >\'' . 2 . '\'');
						$nbvf = $searchnbvf->fetch();
						
						$searchderniervf = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\' AND videovf >\'' . 2 . '\' ORDER BY numero DESC LIMIT 0, 1');
						$derniervf = $searchderniervf->fetch();	
						
						$searchnbvostfr = $db->query('SELECT COUNT(*) AS nbvostfr FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$nbvostfr = $searchnbvostfr->fetch();
						
						$searchderniervostfr = $db->query('SELECT * FROM episodes WHERE IDanime =\'' . $infoanime['ID'] . '\' ORDER BY numero DESC LIMIT 0, 1');
						$derniervostfr = $searchderniervostfr->fetch();	
						
						$searchnbscan = $db->query('SELECT COUNT(*) AS nbscan FROM scans WHERE IDanime =\'' . $infoanime['ID'] . '\' AND page = 1');
						$nbscan = $searchnbscan->fetch();
						
						$searchdernierscan = $db->query('SELECT * FROM scans WHERE IDanime =\'' . $infoanime['ID'] . '\' AND page = 1 ORDER BY numero DESC LIMIT 0, 1');
						$dernierscan = $searchdernierscan->fetch();
						
						$searchnbfilmanime = $db->query('SELECT COUNT(*) AS nbfilmanime FROM filmsanimes WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$nbfilmanime = $searchnbfilmanime->fetch();
						
						$searchnbfilmspecial = $db->query('SELECT COUNT(*) AS nbfilmspecial FROM filmsspecial WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$nbfilmspecial = $searchnbfilmspecial->fetch();
						
						$nbfilm = $nbfilmanime['nbfilmanime'] + $nbfilmspecial['nbfilmspecial'];
						
						$searchdernierfilmanime = $db->query('SELECT * FROM filmsanimes WHERE IDanime =\'' . $infoanime['ID'] . '\' ORDER BY numero DESC LIMIT 0, 1');
						$dernierfilmanime = $searchdernierfilmanime->fetch();
						
						$searchnboav = $db->query('SELECT COUNT(*) AS nboav FROM oavs WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$nboav = $searchnboav->fetch();
						
						$searchdernieroav = $db->query('SELECT * FROM oavs WHERE IDanime =\'' . $infoanime['ID'] . '\' ORDER BY numero DESC LIMIT 0, 1');
						$dernieroav = $searchdernieroav->fetch();
						
						$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesanimes WHERE IDanime =\'' . $infoanime['ID'] . '\'');
						$notemoy = $searchmoynote->fetch();	
						$notemoyenne = $notemoy['notemoy'];
						$ID = $infoanime['ID'];
						$updatenotemoy = $db->prepare('UPDATE animes SET note = :note WHERE ID = :ID');
						$updatenotemoy->execute(array('note' => $notemoyenne, 'ID' => $ID));
						if($notemoy['notemoy'] == 0)
						{
							echo
							'<span class="etoile" style="color:rgb(10,10,10);">★★★★★</span>';
						}
						else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
						{
							echo
							'<span class="etoile">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
						}
						else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
						{
							echo
							'<span class="etoile">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
						}
						else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
						{
							echo
							'<span class="etoile">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
						}
						else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
						{
							echo
							'<span class="etoile">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
						}
						else if($notemoy['notemoy'] >= 5)
						{
							echo
							'<span class="etoile">★★★★★</span>';
						}
					echo
					'</a>';
					
					$dateanime = date("Y-m-d", strtotime($infoanime['date']));
					$newcontenuimg = date('Y-m-d');
					
					if($dateanime >= $newcontenuimg)
					{
						echo
						'<img src="images/new.png" alt="New" class="newcontenuimg" style="margin-top: -25px;" />';
					}
					
					echo
					'<a href="anime.php?anime=' . $infoanime['ID'] . '"><img src="anime/' . $infoanime['image'] . '" alt="' . htmlspecialchars($infoanime['titre']) . '" class="imageanime" width="345" height="210" /></a>
					<span class="annee">Année : ' . htmlspecialchars($infoanime['annee']) . '</span>
					<span class="auteur">Auteur : ' . htmlspecialchars($infoanime['auteur']) . '</span>
					<span class="synopsis">Synopsis :</span>
					<span class="synopsis2">
						' . htmlspecialchars($infoanime['synopsis']) . '
					</span>
					<span class="genre">';
					
					if($infoanime['action'] == "Action")
					{
						echo
						'<span style="font-size:9px;background:orange;color:orange;border:1px solid orange;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Action </span>';
					}
					if($infoanime['aventure'] == "Aventure")
					{
						echo
						'<span style="font-size:9px;background:green;color:green;border:1px solid green;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Aventure </span>';
					}
					if($infoanime['amitier'] == "Amitié")
					{
						echo
						'<span style="font-size:9px;background:pink;color:pink;border:1px solid pink;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Amitié </span>';
					}
					if($infoanime['comedie'] == "Comédie")
					{
						echo
						'<span style="font-size:9px;background:yellow;color:yellow;border:1px solid yellow;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Comédie </span>';
					}
					if($infoanime['drame'] == "Drame")
					{
						echo
						'<span style="font-size:9px;background:red;color:red;border:1px solid red;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Drame </span>';
					}
					if($infoanime['fantastique'] == "Fantastique")
					{
						echo
						'<span style="font-size:9px;background:blue;color:blue;border:1px solid blue;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Fantastique </span>';
					}
					if($infoanime['guerre'] == "Guerre")
					{
						echo
						'<span style="font-size:9px;background:darkred;color:darkred;border:1px solid darkred;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Guerre </span>';
					}
					if($infoanime['cyber'] == "Cyber")
					{
						echo
						'<span style="font-size:9px;background:purple;color:purple;border:1px solid purple;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Cyber </span>';
					}
					if($infoanime['mecha'] == "Mecha")
					{
						echo
						'<span style="font-size:9px;background:gray;color:gray;border:1px solid gray;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Mecha </span>';
					}
					if($infoanime['sport'] == "Sport")
					{
						echo
						'<span style="font-size:9px;background:brown;color:brown;border:1px solid brown;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Sport </span>';
					}
					if($infoanime['horreur'] == "Horreur")
					{
						echo
						'<span style="font-size:9px;background:black;color:black;border:1px solid black;border-radius: 2.5px 2.5px 2.5px 2.5px;margin-right:4px;">*****</span><span>Horreur </span>';
					}
					
					echo
					'</span>
					<ul class="menuanime">
						<li class="vf"><a href="anime.php?anime=' . $infoanime['ID'] . '&episode=' . $derniervf['numero'] . '">' . $nbvf['nbvf'] . ' VF</a></li>
						<li class="vostfr"><a href="anime.php?anime=' . $infoanime['ID'] . '&episode=' . $derniervostfr['numero'] . '">' . $nbvostfr['nbvostfr'] . ' VOSTFR</a></li>
						<li class="scan"><a href="anime.php?anime=' . $infoanime['ID'] . '&scan=' . $dernierscan['numero'] . '">' . $nbscan['nbscan'] . ' SCANS</a></li>
						<li class="film"><a href="anime.php?anime=' . $infoanime['ID'] . '&filmanime=' . $dernierfilmanime['numero'] . '">' . $nbfilm . ' FILMS</a></li>
						<li class="oav"><a href="anime.php?anime=' . $infoanime['ID'] . '&oav=' . $dernieroav['numero'] . '">' . $nboav['nboav'] . ' OAVs</a></li>
					</ul>
				</div>
			</div>';
		}
		$searchanime->closeCursor();
	}
	else if(isset($_GET['blocknoteretoile1']) AND isset($_GET['IDanime']) AND isset($_SESSION['ID']))
	{
		$searchanimeid = $db->query('SELECT ID FROM animes WHERE ID =\'' . $_GET['IDanime'] . '\'');
		$searchanimeidexist = $searchanimeid->rowCount();
		if($searchanimeidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDanime = $_GET['IDanime'];
			$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '';
			$IDmembre = $_SESSION['ID'];
			$note = 1;
			
			$searchnote = $db->prepare('SELECT * FROM notesanimes WHERE IDanime = ? AND IDmembre = ?');
			$searchnote->execute(array($_GET['IDanime'],$_SESSION['ID']));
			$noteexist = $searchnote->rowCount();
			if($noteexist == 0)
			{	
				$insertnote = $db->prepare('INSERT INTO notesanimes(IDanime,lien,IDmembre,note) VALUES (:IDanime,:lien,:IDmembre,:note)');
				$insertnote->execute(array(
				'IDanime' => $IDanime,
				'lien' => $lien,
				'IDmembre' => $IDmembre,
				'note' => $note
				));
			}
			else
			{
				$modifnote = $db->query('UPDATE notesanimes SET note=\'' . $note . '\' WHERE IDanime=\'' . $IDanime . '\' AND IDmembre=\'' . $IDmembre . '\'');
			}
			
				$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesanimes WHERE IDanime =\'' . $_GET['IDanime'] . '\'');
				$notemoy = $searchmoynote->fetch();	
				if($notemoy['notemoy'] == 0)
				{
					echo
					'<span class="contenuanimeblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
				}
				else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
				}
				else if($notemoy['notemoy'] >= 5)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★★★</span>';
				}
		}
	}
	else if(isset($_GET['blocknoteretoile2']) AND isset($_GET['IDanime']) AND isset($_SESSION['ID']))
	{
		$searchanimeid = $db->query('SELECT ID FROM animes WHERE ID =\'' . $_GET['IDanime'] . '\'');
		$searchanimeidexist = $searchanimeid->rowCount();
		if($searchanimeidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDanime = $_GET['IDanime'];
			$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '';
			$IDmembre = $_SESSION['ID'];
			$note = 2;
			
			$searchnote = $db->prepare('SELECT * FROM notesanimes WHERE IDanime = ? AND IDmembre = ?');
			$searchnote->execute(array($_GET['IDanime'],$_SESSION['ID']));
			$noteexist = $searchnote->rowCount();
			if($noteexist == 0)
			{	
				$insertnote = $db->prepare('INSERT INTO notesanimes(IDanime,lien,IDmembre,note) VALUES (:IDanime,:lien,:IDmembre,:note)');
				$insertnote->execute(array(
				'IDanime' => $IDanime,
				'lien' => $lien,
				'IDmembre' => $IDmembre,
				'note' => $note
				));
			}
			else
			{
				$modifnote = $db->query('UPDATE notesanimes SET note=\'' . $note . '\' WHERE IDanime=\'' . $IDanime . '\' AND IDmembre=\'' . $IDmembre . '\'');
			}
			
				$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesanimes WHERE IDanime =\'' . $_GET['IDanime'] . '\'');
				$notemoy = $searchmoynote->fetch();	
				if($notemoy['notemoy'] == 0)
				{
					echo
					'<span class="contenuanimeblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
				}
				else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
				}
				else if($notemoy['notemoy'] >= 5)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★★★</span>';
				}
		}
	}
	else if(isset($_GET['blocknoteretoile3']) AND isset($_GET['IDanime']) AND isset($_SESSION['ID']))
	{
		$searchanimeid = $db->query('SELECT ID FROM animes WHERE ID =\'' . $_GET['IDanime'] . '\'');
		$searchanimeidexist = $searchanimeid->rowCount();
		if($searchanimeidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDanime = $_GET['IDanime'];
			$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '';
			$IDmembre = $_SESSION['ID'];
			$note = 3;
			
			$searchnote = $db->prepare('SELECT * FROM notesanimes WHERE IDanime = ? AND IDmembre = ?');
			$searchnote->execute(array($_GET['IDanime'],$_SESSION['ID']));
			$noteexist = $searchnote->rowCount();
			if($noteexist == 0)
			{	
				$insertnote = $db->prepare('INSERT INTO notesanimes(IDanime,lien,IDmembre,note) VALUES (:IDanime,:lien,:IDmembre,:note)');
				$insertnote->execute(array(
				'IDanime' => $IDanime,
				'lien' => $lien,
				'IDmembre' => $IDmembre,
				'note' => $note
				));
			}
			else
			{
				$modifnote = $db->query('UPDATE notesanimes SET note=\'' . $note . '\' WHERE IDanime=\'' . $IDanime . '\' AND IDmembre=\'' . $IDmembre . '\'');
			}
			
				$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesanimes WHERE IDanime =\'' . $_GET['IDanime'] . '\'');
				$notemoy = $searchmoynote->fetch();	
				if($notemoy['notemoy'] == 0)
				{
					echo
					'<span class="contenuanimeblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
				}
				else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
				}
				else if($notemoy['notemoy'] >= 5)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★★★</span>';
				}
		}
	}
	else if(isset($_GET['blocknoteretoile4']) AND isset($_GET['IDanime']) AND isset($_SESSION['ID']))
	{
		$searchanimeid = $db->query('SELECT ID FROM animes WHERE ID =\'' . $_GET['IDanime'] . '\'');
		$searchanimeidexist = $searchanimeid->rowCount();
		if($searchanimeidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDanime = $_GET['IDanime'];
			$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '';
			$IDmembre = $_SESSION['ID'];
			$note = 4;
			
			$searchnote = $db->prepare('SELECT * FROM notesanimes WHERE IDanime = ? AND IDmembre = ?');
			$searchnote->execute(array($_GET['IDanime'],$_SESSION['ID']));
			$noteexist = $searchnote->rowCount();
			if($noteexist == 0)
			{	
				$insertnote = $db->prepare('INSERT INTO notesanimes(IDanime,lien,IDmembre,note) VALUES (:IDanime,:lien,:IDmembre,:note)');
				$insertnote->execute(array(
				'IDanime' => $IDanime,
				'lien' => $lien,
				'IDmembre' => $IDmembre,
				'note' => $note
				));
			}
			else
			{
				$modifnote = $db->query('UPDATE notesanimes SET note=\'' . $note . '\' WHERE IDanime=\'' . $IDanime . '\' AND IDmembre=\'' . $IDmembre . '\'');
			}
			
				$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesanimes WHERE IDanime =\'' . $_GET['IDanime'] . '\'');
				$notemoy = $searchmoynote->fetch();	
				if($notemoy['notemoy'] == 0)
				{
					echo
					'<span class="contenuanimeblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
				}
				else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
				}
				else if($notemoy['notemoy'] >= 5)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★★★</span>';
				}
		}
	}
	else if(isset($_GET['blocknoteretoile5']) AND isset($_GET['IDanime']) AND isset($_SESSION['ID']))
	{
		$searchanimeid = $db->query('SELECT ID FROM animes WHERE ID =\'' . $_GET['IDanime'] . '\'');
		$searchanimeidexist = $searchanimeid->rowCount();
		if($searchanimeidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDanime = $_GET['IDanime'];
			$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '';
			$IDmembre = $_SESSION['ID'];
			$note = 5;
			
			$searchnote = $db->prepare('SELECT * FROM notesanimes WHERE IDanime = ? AND IDmembre = ?');
			$searchnote->execute(array($_GET['IDanime'],$_SESSION['ID']));
			$noteexist = $searchnote->rowCount();
			if($noteexist == 0)
			{	
				$insertnote = $db->prepare('INSERT INTO notesanimes(IDanime,lien,IDmembre,note) VALUES (:IDanime,:lien,:IDmembre,:note)');
				$insertnote->execute(array(
				'IDanime' => $IDanime,
				'lien' => $lien,
				'IDmembre' => $IDmembre,
				'note' => $note
				));
			}
			else
			{
				$modifnote = $db->query('UPDATE notesanimes SET note=\'' . $note . '\' WHERE IDanime=\'' . $IDanime . '\' AND IDmembre=\'' . $IDmembre . '\'');
			}
			
				$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesanimes WHERE IDanime =\'' . $_GET['IDanime'] . '\'');
				$notemoy = $searchmoynote->fetch();	
				if($notemoy['notemoy'] == 0)
				{
					echo
					'<span class="contenuanimeblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
				}
				else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
				}
				else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
				}
				else if($notemoy['notemoy'] >= 5)
				{
					echo
					'<span class="contenuanimeblockaffichenote">★★★★★</span>';
				}
		}
	}
	else if(isset($_GET['signaleranimelecteurvf']) AND isset($_GET['IDanime']) AND isset($_GET['IDepisode']) AND isset($_GET['episode']))
	{
		$IDanime = $_GET['IDanime'];
		$IDepisode = $_GET['IDepisode'];
		$episode = $_GET['episode'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&episode=' . $episode . '';
		if(isset($_SESSION['ID']))
		{
			$IDmembre = $_SESSION['ID'];
		}
		else
		{
			$IDmembre = '0';
		}
		$video = "VF";
		
		$signalerepisodelecteur = $db->prepare('INSERT INTO signaleepisode(IDepisode,lien,IDmembre,video) VALUES (:IDepisode,:lien,:IDmembre,:video)');
		$signalerepisodelecteur->execute(array(
		'IDepisode' => $IDepisode,
		'lien' => $lien,
		'IDmembre' => $IDmembre,
		'video' => $video
		));
		
		echo
		'<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>';
	}
	else if(isset($_GET['signaleranimelecteurvostfr']) AND isset($_GET['IDanime']) AND isset($_GET['IDepisode']) AND isset($_GET['episode']))
	{
		$IDanime = $_GET['IDanime'];
		$IDepisode = $_GET['IDepisode'];
		$episode = $_GET['episode'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&episode=' . $episode . '';
		if(isset($_SESSION['ID']))
		{
			$IDmembre = $_SESSION['ID'];
		}
		else
		{
			$IDmembre = '0';
		}
		$video = "VOSTFR";
		
		$signalerepisodelecteur = $db->prepare('INSERT INTO signaleepisode(IDepisode,lien,IDmembre,video) VALUES (:IDepisode,:lien,:IDmembre,:video)');
		$signalerepisodelecteur->execute(array(
		'IDepisode' => $IDepisode,
		'lien' => $lien,
		'IDmembre' => $IDmembre,
		'video' => $video
		));
		
		echo
		'<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>';
	}
	else if(isset($_GET['ajoutercommentaire']) AND isset($_GET['IDanime']) AND isset($_GET['IDepisode']) AND isset($_GET['episode']) AND isset($_SESSION['ID']))
	{
		$IDanime = $_GET['IDanime'];
		$IDepisode = $_GET['IDepisode'];
		$episode = $_GET['episode'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&episode=' . $episode . '';
		$IDmembre = $_SESSION['ID'];
		$commentaire = html_entity_decode($_GET['ajoutercommentaire']);
		
		if(mb_strlen($commentaire, 'utf8') >= 5 AND mb_strlen($commentaire, 'utf8') <= 255)
		{
			$commentaire = htmlspecialchars($_GET['ajoutercommentaire']);
			$insertcommentaire = $db->prepare('INSERT INTO commentairesepisodes(IDepisode,lien,IDmembre,commentaire,date_creation) VALUES (:IDepisode,:lien,:IDmembre,:commentaire,NOW())');
			$insertcommentaire->execute(array(
			'IDepisode' => $IDepisode,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'commentaire' => $commentaire
			));
			
			echo
			'<div class="blockcommentairesblockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesepisodes WHERE IDepisode =\'' . $_GET['IDepisode'] . '\'');
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesepisodes WHERE IDepisode =\'' . $_GET['IDepisode'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesepisodes WHERE IDepisode =\'' . $_GET['IDepisode'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentaire' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentaire=ok&IDanime=' . $_GET['IDanime'] . '&IDepisode=' . $_GET['IDepisode'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
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
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentaire=ok&IDanime=' . $_GET['IDanime'] . '&IDepisode=' . $_GET['IDepisode'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
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
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesepisodes WHERE IDepisode =\'' . $_GET['IDepisode'] . '\'');
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesepisodes WHERE IDepisode =\'' . $_GET['IDepisode'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesepisodes WHERE IDepisode =\'' . $_GET['IDepisode'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentaire' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentaire=ok&IDepisode=' . $_GET['IDepisode'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
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
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentaire=ok&IDepisode=' . $_GET['IDepisode'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
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
	else if(isset($_GET['signalecommentaire'])  AND isset($_GET['IDepisode']) AND isset($_GET['IDcommentaire']))
	{
		$signalecommentaire = $db->query('SELECT * FROM commentairesepisodes WHERE ID =\'' . $_GET['IDcommentaire'] . '\'');
		$signaleinfocommentaire = $signalecommentaire->fetch();
		
		$page = 'episode';
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
			$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesepisodes WHERE IDepisode =\'' . $_GET['IDepisode'] . '\'');
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
			$searchinfocommentaire = $db->query('SELECT * FROM commentairesepisodes WHERE IDepisode =\'' . $_GET['IDepisode'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
		
		$searchinfocommentairejs = $db->query('SELECT * FROM commentairesepisodes WHERE IDepisode =\'' . $_GET['IDepisode'] . '\' ORDER BY ID DESC LIMIT 0, 100');
		while ($infocommentairejs = $searchinfocommentairejs->fetch())
		{
			echo
			'function signalecommentaire' . $infocommentairejs['ID'] . '()
			{
				var xhr = new XMLHttpRequest();
				
				xhr.open(\'GET\', \'site/phpanime.php?signalecommentaire=ok&IDepisode=' . $_GET['IDepisode'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
				
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
				
				xhr.open(\'GET\', \'site/phpanime.php?supprimercommentaire=ok&IDepisode=' . $_GET['IDepisode'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
				
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
	else if(isset($_GET['supprimercommentaire'])  AND isset($_GET['IDepisode']) AND isset($_GET['IDcommentaire']) AND isset($_GET['LIENcommentaire']) AND isset($_SESSION['ID']) AND $_SESSION['ID'] == '1')
	{
		$IDinfocommentaire = $_GET['IDcommentaire'];
		$lieninfocommentaire = $_GET['LIENcommentaire'];
		
		$supprimercommentaire = $db->prepare('DELETE FROM commentairesepisodes WHERE ID = ?');
		$supprimercommentaire->execute(array($IDinfocommentaire));	
		$supprimersignalecommentaire = $db->prepare('DELETE FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
		$supprimersignalecommentaire->execute(array($IDinfocommentaire,$lieninfocommentaire));
		
		echo
		'<div class="blockcommentairesblockcommenter">';
		
		if(isset($_SESSION['ID']))
		{
			$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesepisodes WHERE IDepisode =\'' . $_GET['IDepisode'] . '\'');
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
			$searchinfocommentaire = $db->query('SELECT * FROM commentairesepisodes WHERE IDepisode =\'' . $_GET['IDepisode'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
		
		$searchinfocommentairejs = $db->query('SELECT * FROM commentairesepisodes WHERE IDepisode =\'' . $_GET['IDepisode'] . '\' ORDER BY ID DESC LIMIT 0, 100');
		while ($infocommentairejs = $searchinfocommentairejs->fetch())
		{
			echo
			'function signalecommentaire' . $infocommentairejs['ID'] . '()
			{
				var xhr = new XMLHttpRequest();
				
				xhr.open(\'GET\', \'site/phpanime.php?signalecommentaire=ok&IDepisode=' . $_GET['IDepisode'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
				
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
				
				xhr.open(\'GET\', \'site/phpanime.php?supprimercommentaire=ok&IDepisode=' . $_GET['IDepisode'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
				
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
	else if(isset($_GET['blocknoteretoile1filmanime']) AND isset($_GET['IDanime']) AND isset($_GET['IDfilmanime']) AND isset($_SESSION['ID']))
	{
		$searchfilmanimeid = $db->query('SELECT ID FROM filmsanimes WHERE ID =\'' . $_GET['IDfilmanime'] . '\'');
		$searchfilmanimeidexist = $searchfilmanimeid->rowCount();
		if($searchfilmanimeidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDanime = $_GET['IDanime'];
			$IDfilmanime = $_GET['IDfilmanime'];
			$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&filmanime=' . $IDfilmanime . '';
			$IDmembre = $_SESSION['ID'];
			$note = 1;
			
			$insertnote = $db->prepare('INSERT INTO notesfilmanime(IDfilmanime,lien,IDmembre,note) VALUES (:IDfilmanime,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDfilmanime' => $IDfilmanime,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
			
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\'');
			$notemoy = $searchmoynote->fetch();
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="contenuanimeblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['blocknoteretoile2filmanime']) AND isset($_GET['IDanime']) AND isset($_GET['IDfilmanime']) AND isset($_SESSION['ID']))
	{
		$searchfilmanimeid = $db->query('SELECT ID FROM filmsanimes WHERE ID =\'' . $_GET['IDfilmanime'] . '\'');
		$searchfilmanimeidexist = $searchfilmanimeid->rowCount();
		if($searchfilmanimeidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDanime = $_GET['IDanime'];
			$IDfilmanime = $_GET['IDfilmanime'];
			$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&filmanime=' . $IDfilmanime . '';
			$IDmembre = $_SESSION['ID'];
			$note = 2;
			
			$insertnote = $db->prepare('INSERT INTO notesfilmanime(IDfilmanime,lien,IDmembre,note) VALUES (:IDfilmanime,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDfilmanime' => $IDfilmanime,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
			
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\'');
			$notemoy = $searchmoynote->fetch();
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="contenuanimeblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['blocknoteretoile3filmanime']) AND isset($_GET['IDanime']) AND isset($_GET['IDfilmanime']) AND isset($_SESSION['ID']))
	{
		$searchfilmanimeid = $db->query('SELECT ID FROM filmsanimes WHERE ID =\'' . $_GET['IDfilmanime'] . '\'');
		$searchfilmanimeidexist = $searchfilmanimeid->rowCount();
		if($searchfilmanimeidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDanime = $_GET['IDanime'];
			$IDfilmanime = $_GET['IDfilmanime'];
			$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&filmanime=' . $IDfilmanime . '';
			$IDmembre = $_SESSION['ID'];
			$note = 3;
			
			$insertnote = $db->prepare('INSERT INTO notesfilmanime(IDfilmanime,lien,IDmembre,note) VALUES (:IDfilmanime,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDfilmanime' => $IDfilmanime,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
			
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\'');
			$notemoy = $searchmoynote->fetch();
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="contenuanimeblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['blocknoteretoile4filmanime']) AND isset($_GET['IDanime']) AND isset($_GET['IDfilmanime']) AND isset($_SESSION['ID']))
	{
		$searchfilmanimeid = $db->query('SELECT ID FROM filmsanimes WHERE ID =\'' . $_GET['IDfilmanime'] . '\'');
		$searchfilmanimeidexist = $searchfilmanimeid->rowCount();
		if($searchfilmanimeidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDanime = $_GET['IDanime'];
			$IDfilmanime = $_GET['IDfilmanime'];
			$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&filmanime=' . $IDfilmanime . '';
			$IDmembre = $_SESSION['ID'];
			$note = 4;
			
			$insertnote = $db->prepare('INSERT INTO notesfilmanime(IDfilmanime,lien,IDmembre,note) VALUES (:IDfilmanime,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDfilmanime' => $IDfilmanime,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
			
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\'');
			$notemoy = $searchmoynote->fetch();
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="contenuanimeblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['blocknoteretoile5filmanime']) AND isset($_GET['IDanime']) AND isset($_GET['IDfilmanime']) AND isset($_SESSION['ID']))
	{
		$searchfilmanimeid = $db->query('SELECT ID FROM filmsanimes WHERE ID =\'' . $_GET['IDfilmanime'] . '\'');
		$searchfilmanimeidexist = $searchfilmanimeid->rowCount();
		if($searchfilmanimeidexist == 0)
		{
			header("Location: ../index.php");
		}
		else
		{			
			$IDanime = $_GET['IDanime'];
			$IDfilmanime = $_GET['IDfilmanime'];
			$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&filmanime=' . $IDfilmanime . '';
			$IDmembre = $_SESSION['ID'];
			$note = 5;
			
			$insertnote = $db->prepare('INSERT INTO notesfilmanime(IDfilmanime,lien,IDmembre,note) VALUES (:IDfilmanime,:lien,:IDmembre,:note)');
			$insertnote->execute(array(
			'IDfilmanime' => $IDfilmanime,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'note' => $note
			));
			
			$searchmoynote = $db->query('SELECT AVG(note) AS notemoy FROM notesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\'');
			$notemoy = $searchmoynote->fetch();
			if($notemoy['notemoy'] == 0)
			{
				echo
				'<span class="contenuanimeblockaffichenote" style="color:rgb(10,10,10);">★★★★★</span>';
			}
			else if($notemoy['notemoy'] > 0 && $notemoy['notemoy'] < 2)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★<span style="color:rgb(10,10,10);">★★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 2 && $notemoy['notemoy'] < 3)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★<span style="color:rgb(10,10,10);">★★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 3 && $notemoy['notemoy'] < 4)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★<span style="color:rgb(10,10,10);">★★</span></span>';
			}
			else if($notemoy['notemoy'] >= 4 && $notemoy['notemoy'] < 5)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★★<span style="color:rgb(10,10,10);">★</span></span>';
			}
			else if($notemoy['notemoy'] >= 5)
			{
				echo
				'<span class="contenuanimeblockaffichenote">★★★★★</span>';
			}
		}
	}
	else if(isset($_GET['signaleranimelecteurvffilmanime']) AND isset($_GET['IDanime']) AND isset($_GET['IDfilmanime']) AND isset($_GET['filmanime']))
	{
		$IDanime = $_GET['IDanime'];
		$IDfilmanime = $_GET['IDfilmanime'];
		$filmanime = $_GET['filmanime'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&filmanime=' . $filmanime . '';
		if(isset($_SESSION['ID']))
		{
			$IDmembre = $_SESSION['ID'];
		}
		else
		{
			$IDmembre = '0';
		}
		$video = "VF";
		
		$signalerfilmanimelecteurvf = $db->prepare('INSERT INTO signalefilmanime(IDfilmanime,lien,IDmembre,video) VALUES (:IDfilmanime,:lien,:IDmembre,:video)');
		$signalerfilmanimelecteurvf->execute(array(
		'IDfilmanime' => $IDfilmanime,
		'lien' => $lien,
		'IDmembre' => $IDmembre,
		'video' => $video
		));
		
		echo
		'<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>';
	}
	else if(isset($_GET['signaleranimelecteurvostfrfilmanime']) AND isset($_GET['IDanime']) AND isset($_GET['IDfilmanime']) AND isset($_GET['filmanime']))
	{
		$IDanime = $_GET['IDanime'];
		$IDfilmanime = $_GET['IDfilmanime'];
		$filmanime = $_GET['filmanime'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&filmanime=' . $filmanime . '';
		if(isset($_SESSION['ID']))
		{
			$IDmembre = $_SESSION['ID'];
		}
		else
		{
			$IDmembre = '0';
		}
		$video = "VOSTFR";
		
		$signalerfilmanimelecteurvf = $db->prepare('INSERT INTO signalefilmanime(IDfilmanime,lien,IDmembre,video) VALUES (:IDfilmanime,:lien,:IDmembre,:video)');
		$signalerfilmanimelecteurvf->execute(array(
		'IDfilmanime' => $IDfilmanime,
		'lien' => $lien,
		'IDmembre' => $IDmembre,
		'video' => $video
		));
		
		echo
		'<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>';
	}
	else if(isset($_GET['ajoutercommentairefilmanime']) AND isset($_GET['IDanime']) AND isset($_GET['IDfilmanime']) AND isset($_GET['filmanime']) AND isset($_SESSION['ID']))
	{
		$IDanime = $_GET['IDanime'];
		$IDfilmanime = $_GET['IDfilmanime'];
		$filmanime = $_GET['filmanime'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&filmanime=' . $filmanime . '';
		$IDmembre = $_SESSION['ID'];
		$commentaire = html_entity_decode($_GET['ajoutercommentairefilmanime']);
		
		if(mb_strlen($commentaire, 'utf8') >= 5 AND mb_strlen($commentaire, 'utf8') <= 255)
		{
			$commentaire = htmlspecialchars($_GET['ajoutercommentairefilmanime']);
			$insertcommentaire = $db->prepare('INSERT INTO commentairesfilmanime(IDfilmanime,lien,IDmembre,commentaire,date_creation) VALUES (:IDfilmanime,:lien,:IDmembre,:commentaire,NOW())');
			$insertcommentaire->execute(array(
			'IDfilmanime' => $IDfilmanime,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'commentaire' => $commentaire
			));
			
			echo
			'<div class="blockcommentairesblockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareafilmanime" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairefilmanime()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentairefilmanime' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentairefilmanime' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentairefilmanime' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentairefilmanime=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmanime=' . $_GET['IDfilmanime'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmanime\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentairefilmanime' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentairefilmanime=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmanime=' . $_GET['IDfilmanime'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmanime\').innerHTML = xhr.responseText;
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
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareafilmanime" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairefilmanime()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentairefilmanime' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentairefilmanime' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentairefilmanime' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentairefilmanime=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmanime=' . $_GET['IDfilmanime'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmanime\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentairefilmanime' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentairefilmanime=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmanime=' . $_GET['IDfilmanime'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmanime\').innerHTML = xhr.responseText;
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
	else if(isset($_GET['signalecommentairefilmanime'])  AND isset($_GET['IDfilmanime']) AND isset($_GET['IDcommentaire']))
	{
		$signalecommentaire = $db->query('SELECT * FROM commentairesfilmanime WHERE ID =\'' . $_GET['IDcommentaire'] . '\'');
		$signaleinfocommentaire = $signalecommentaire->fetch();
		
		$page = 'filmanime';
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
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareafilmanime" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairefilmanime()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentairefilmanime' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentairefilmanime' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentairefilmanime' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentairefilmanime=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmanime=' . $_GET['IDfilmanime'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmanime\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentairefilmanime' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentairefilmanime=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmanime=' . $_GET['IDfilmanime'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmanime\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}';
			}
			$searchinfocommentairejs->closeCursor();
			
			echo
			'</script>';
		
	}
	else if(isset($_GET['supprimercommentairefilmanime'])  AND isset($_GET['IDfilmanime']) AND isset($_GET['IDcommentaire']) AND isset($_GET['LIENcommentaire']) AND isset($_SESSION['ID']) AND $_SESSION['ID'] == '1')
	{
		$IDinfocommentaire = $_GET['IDcommentaire'];
		$lieninfocommentaire = $_GET['LIENcommentaire'];
		
		$supprimercommentaire = $db->prepare('DELETE FROM commentairesfilmanime WHERE ID = ?');
		$supprimercommentaire->execute(array($IDinfocommentaire));	
		$supprimersignalecommentaire = $db->prepare('DELETE FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
		$supprimersignalecommentaire->execute(array($IDinfocommentaire,$lieninfocommentaire));
		
		echo
			'<div class="blockcommentairesblockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareafilmanime" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairefilmanime()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentairefilmanime' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentairefilmanime' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesfilmanime WHERE IDfilmanime =\'' . $_GET['IDfilmanime'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentairefilmanime' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentairefilmanime=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmanime=' . $_GET['IDfilmanime'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmanime\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentairefilmanime' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentairefilmanime=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmanime=' . $_GET['IDfilmanime'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmanime\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}';
			}
			$searchinfocommentairejs->closeCursor();
			
			echo
			'</script>';
	
	}
	else if(isset($_GET['signaleranimelecteurvffilmspecial']) AND isset($_GET['IDanime']) AND isset($_GET['IDfilmspecial']) AND isset($_GET['filmspecial']))
	{
		$IDanime = $_GET['IDanime'];
		$IDfilmspecial = $_GET['IDfilmspecial'];
		$filmspecial = $_GET['filmspecial'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&filmspecial=' . $filmspecial . '';
		if(isset($_SESSION['ID']))
		{
			$IDmembre = $_SESSION['ID'];
		}
		else
		{
			$IDmembre = '0';
		}
		$video = "VF";
		
		$signalerfilmspeciallecteurvf = $db->prepare('INSERT INTO signalespecial(IDspecial,lien,IDmembre,video) VALUES (:IDfilmspecial,:lien,:IDmembre,:video)');
		$signalerfilmspeciallecteurvf->execute(array(
		'IDfilmspecial' => $IDfilmspecial,
		'lien' => $lien,
		'IDmembre' => $IDmembre,
		'video' => $video
		));
		
		echo
		'<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>';
	}
	else if(isset($_GET['signaleranimelecteurvostfrfilmspecial']) AND isset($_GET['IDanime']) AND isset($_GET['IDfilmspecial']) AND isset($_GET['filmspecial']))
	{
		$IDanime = $_GET['IDanime'];
		$IDfilmspecial = $_GET['IDfilmspecial'];
		$filmspecial = $_GET['filmspecial'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&filmspecial=' . $filmspecial . '';
		if(isset($_SESSION['ID']))
		{
			$IDmembre = $_SESSION['ID'];
		}
		else
		{
			$IDmembre = '0';
		}
		$video = "VOSTFR";
		
		$signalerfilmspeciallecteurvf = $db->prepare('INSERT INTO signalespecial(IDspecial,lien,IDmembre,video) VALUES (:IDfilmspecial,:lien,:IDmembre,:video)');
		$signalerfilmspeciallecteurvf->execute(array(
		'IDfilmspecial' => $IDfilmspecial,
		'lien' => $lien,
		'IDmembre' => $IDmembre,
		'video' => $video
		));
		
		echo
		'<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>';
	}
	else if(isset($_GET['ajoutercommentairefilmspecial']) AND isset($_GET['IDanime']) AND isset($_GET['IDfilmspecial']) AND isset($_GET['filmspecial']) AND isset($_SESSION['ID']))
	{
		$IDanime = $_GET['IDanime'];
		$IDfilmspecial = $_GET['IDfilmspecial'];
		$filmspecial = $_GET['filmspecial'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&filmspecial=' . $filmspecial . '';
		$IDmembre = $_SESSION['ID'];
		$commentaire = html_entity_decode($_GET['ajoutercommentairefilmspecial']);
		
		if(mb_strlen($commentaire, 'utf8') >= 5 AND mb_strlen($commentaire, 'utf8') <= 255)
		{
			$commentaire = htmlspecialchars($_GET['ajoutercommentairefilmspecial']);
			$insertcommentaire = $db->prepare('INSERT INTO commentairesspecial(IDspecial,lien,IDmembre,commentaire,date_creation) VALUES (:IDfilmspecial,:lien,:IDmembre,:commentaire,NOW())');
			$insertcommentaire->execute(array(
			'IDfilmspecial' => $IDfilmspecial,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'commentaire' => $commentaire
			));
			
			echo
			'<div class="blockcommentairesblockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesspecial WHERE IDspecial =\'' . $_GET['IDfilmspecial'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareafilmspecial" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairefilmspecial()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesspecial WHERE IDspecial =\'' . $_GET['IDfilmspecial'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentairefilmspecial' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentairefilmspecial' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesspecial WHERE IDspecial =\'' . $_GET['IDfilmspecial'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentairefilmspecial' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentairefilmspecial=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmspecial=' . $_GET['IDfilmspecial'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmspecial\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentairefilmspecial' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentairespecial=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmspecial=' . $_GET['IDfilmspecial'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmspecial\').innerHTML = xhr.responseText;
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
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesspecial WHERE IDspecial =\'' . $_GET['IDfilmspecial'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareafilmspecial" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairefilmspecial()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesspecial WHERE IDspecial =\'' . $_GET['IDfilmspecial'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentairefilmspecial' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentairefilmspecial' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesspecial WHERE IDspecial =\'' . $_GET['IDfilmspecial'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentairefilmspecial' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentairefilmspecial=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmspecial=' . $_GET['IDfilmspecial'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmspecial\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentairefilmspecial' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentairespecial=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmspecial=' . $_GET['IDfilmspecial'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmspecial\').innerHTML = xhr.responseText;
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
	else if(isset($_GET['signalecommentairefilmspecial'])  AND isset($_GET['IDfilmspecial']) AND isset($_GET['IDcommentaire']))
	{
		$signalecommentaire = $db->query('SELECT * FROM commentairesspecial WHERE ID =\'' . $_GET['IDcommentaire'] . '\'');
		$signaleinfocommentaire = $signalecommentaire->fetch();
		
		$page = 'filmspecial';
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
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesspecial WHERE IDspecial =\'' . $_GET['IDfilmspecial'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareafilmspecial" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairefilmspecial()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesspecial WHERE IDspecial =\'' . $_GET['IDfilmspecial'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentairefilmspecial' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentairefilmspecial' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesspecial WHERE IDspecial =\'' . $_GET['IDfilmspecial'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentairefilmspecial' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentairefilmspecial=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmspecial=' . $_GET['IDfilmspecial'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmspecial\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentairefilmspecial' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentairespecial=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmspecial=' . $_GET['IDfilmspecial'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmspecial\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}';
			}
			$searchinfocommentairejs->closeCursor();
			
			echo
			'</script>';
		
	}
	else if(isset($_GET['supprimercommentairefilmspecial'])  AND isset($_GET['IDfilmspecial']) AND isset($_GET['IDcommentaire']) AND isset($_GET['LIENcommentaire']) AND isset($_SESSION['ID']) AND $_SESSION['ID'] == '1')
	{
		$IDinfocommentaire = $_GET['IDcommentaire'];
		$lieninfocommentaire = $_GET['LIENcommentaire'];
		
		$supprimercommentaire = $db->prepare('DELETE FROM commentairesspecial WHERE ID = ?');
		$supprimercommentaire->execute(array($IDinfocommentaire));	
		$supprimersignalecommentaire = $db->prepare('DELETE FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
		$supprimersignalecommentaire->execute(array($IDinfocommentaire,$lieninfocommentaire));
		
		echo
			'<div class="blockcommentairesblockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesspecial WHERE IDspecial =\'' . $_GET['IDfilmspecial'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareafilmspecial" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairefilmspecial()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesspecial WHERE IDspecial =\'' . $_GET['IDfilmspecial'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentairefilmspecial' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentairefilmspecial' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesspecial WHERE IDspecial =\'' . $_GET['IDfilmspecial'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentairefilmspecial' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentairefilmspecial=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmspecial=' . $_GET['IDfilmspecial'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmspecial\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentairefilmspecial' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentairespecial=ok&IDanime=' . $_GET['IDanime'] . '&IDfilmspecial=' . $_GET['IDfilmspecial'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxfilmspecial\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}';
			}
			$searchinfocommentairejs->closeCursor();
			
			echo
			'</script>';
	
	}
	else if(isset($_GET['signaleranimelecteurvfoav']) AND isset($_GET['IDanime']) AND isset($_GET['IDoav']) AND isset($_GET['oav']))
	{
		$IDanime = $_GET['IDanime'];
		$IDoav = $_GET['IDoav'];
		$oav = $_GET['oav'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&oav=' . $oav . '';
		if(isset($_SESSION['ID']))
		{
			$IDmembre = $_SESSION['ID'];
		}
		else
		{
			$IDmembre = '0';
		}
		$video = "VF";
		
		$signaleroavlecteurvf = $db->prepare('INSERT INTO signaleoav(IDoav,lien,IDmembre,video) VALUES (:IDoav,:lien,:IDmembre,:video)');
		$signaleroavlecteurvf->execute(array(
		'IDoav' => $IDoav,
		'lien' => $lien,
		'IDmembre' => $IDmembre,
		'video' => $video
		));
		
		echo
		'<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>';
	}
	else if(isset($_GET['signaleranimelecteurvostfroav']) AND isset($_GET['IDanime']) AND isset($_GET['IDoav']) AND isset($_GET['oav']))
	{
		$IDanime = $_GET['IDanime'];
		$IDoav = $_GET['IDoav'];
		$oav = $_GET['oav'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&oav=' . $oav . '';
		if(isset($_SESSION['ID']))
		{
			$IDmembre = $_SESSION['ID'];
		}
		else
		{
			$IDmembre = '0';
		}
		$video = "VOSTFR";
		
		$signaleroavlecteurvf = $db->prepare('INSERT INTO signaleoav(IDoav,lien,IDmembre,video) VALUES (:IDoav,:lien,:IDmembre,:video)');
		$signaleroavlecteurvf->execute(array(
		'IDoav' => $IDoav,
		'lien' => $lien,
		'IDmembre' => $IDmembre,
		'video' => $video
		));
		
		echo
		'<span><img src="images/signalerrouge.png" alt="Signaler" class="contenuanimeblockepisodesignaler" /></span>';
	}
	else if(isset($_GET['ajoutercommentaireoav']) AND isset($_GET['IDanime']) AND isset($_GET['IDoav']) AND isset($_GET['oav']) AND isset($_SESSION['ID']))
	{
		$IDanime = $_GET['IDanime'];
		$IDoav = $_GET['IDoav'];
		$oav = $_GET['oav'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&oav=' . $oav . '';
		$IDmembre = $_SESSION['ID'];
		$commentaire = html_entity_decode($_GET['ajoutercommentaireoav']);
		
		if(mb_strlen($commentaire, 'utf8') >= 5 AND mb_strlen($commentaire, 'utf8') <= 255)
		{
			$commentaire = htmlspecialchars($_GET['ajoutercommentaireoav']);
			$insertcommentaire = $db->prepare('INSERT INTO commentairesoavs(IDoav,lien,IDmembre,commentaire,date_creation) VALUES (:IDoav,:lien,:IDmembre,:commentaire,NOW())');
			$insertcommentaire->execute(array(
			'IDoav' => $IDoav,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'commentaire' => $commentaire
			));
			
			echo
			'<div class="blockcommentairesblockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesoavs WHERE IDoav =\'' . $_GET['IDoav'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareaoav" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaireoav()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesoavs WHERE IDoav =\'' . $_GET['IDoav'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentaireoav' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentaireoav' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesoavs WHERE IDoav =\'' . $_GET['IDoav'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentaireoav' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentaireoav=ok&IDanime=' . $_GET['IDanime'] . '&IDoav=' . $_GET['IDoav'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxoav\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentaireoav' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentaireoav=ok&IDanime=' . $_GET['IDanime'] . '&IDoav=' . $_GET['IDoav'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxoav\').innerHTML = xhr.responseText;
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
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesoavs WHERE IDoav =\'' . $_GET['IDoav'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareaoav" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaireoav()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesoavs WHERE IDoav =\'' . $_GET['IDoav'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentaireoav' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentaireoav' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesoavs WHERE IDoav =\'' . $_GET['IDoav'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentaireoav' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentaireoav=ok&IDanime=' . $_GET['IDanime'] . '&IDoav=' . $_GET['IDoav'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxoav\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentaireoav' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentaireoav=ok&IDanime=' . $_GET['IDanime'] . '&IDoav=' . $_GET['IDoav'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxoav\').innerHTML = xhr.responseText;
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
	else if(isset($_GET['signalecommentaireoav'])  AND isset($_GET['IDoav']) AND isset($_GET['IDcommentaire']))
	{
		$signalecommentaire = $db->query('SELECT * FROM commentairesoavs WHERE ID =\'' . $_GET['IDcommentaire'] . '\'');
		$signaleinfocommentaire = $signalecommentaire->fetch();
		
		$page = 'oav';
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
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesoavs WHERE IDoav =\'' . $_GET['IDoav'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareaoav" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaireoav()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesoavs WHERE IDoav =\'' . $_GET['IDoav'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentaireoav' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentaireoav' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesoavs WHERE IDoav =\'' . $_GET['IDoav'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentaireoav' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentaireoav=ok&IDanime=' . $_GET['IDanime'] . '&IDoav=' . $_GET['IDoav'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxoav\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentaireoav' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentaireoav=ok&IDanime=' . $_GET['IDanime'] . '&IDoav=' . $_GET['IDoav'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxoav\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}';
			}
			$searchinfocommentairejs->closeCursor();
			
			echo
			'</script>';
		
	}
	else if(isset($_GET['supprimercommentaireoav'])  AND isset($_GET['IDoav']) AND isset($_GET['IDcommentaire']) AND isset($_GET['LIENcommentaire']) AND isset($_SESSION['ID']) AND $_SESSION['ID'] == '1')
	{
		$IDinfocommentaire = $_GET['IDcommentaire'];
		$lieninfocommentaire = $_GET['LIENcommentaire'];
		
		$supprimercommentaire = $db->prepare('DELETE FROM commentairesoavs WHERE ID = ?');
		$supprimercommentaire->execute(array($IDinfocommentaire));	
		$supprimersignalecommentaire = $db->prepare('DELETE FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
		$supprimersignalecommentaire->execute(array($IDinfocommentaire,$lieninfocommentaire));
		
		echo
			'<div class="blockcommentairesblockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesoavs WHERE IDoav =\'' . $_GET['IDoav'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareaoav" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentaireoav()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesoavs WHERE IDoav =\'' . $_GET['IDoav'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentaireoav' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentaireoav' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesoavs WHERE IDoav =\'' . $_GET['IDoav'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentaireoav' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentaireoav=ok&IDanime=' . $_GET['IDanime'] . '&IDoav=' . $_GET['IDoav'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxoav\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentaireoav' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentaireoav=ok&IDanime=' . $_GET['IDanime'] . '&IDoav=' . $_GET['IDoav'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxoav\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}';
			}
			$searchinfocommentairejs->closeCursor();
			
			echo
			'</script>';
	
	}
	else if(isset($_GET['ajoutercommentairescan']) AND isset($_GET['IDanime']) AND isset($_GET['IDscan']) AND isset($_SESSION['ID']))
	{
		$IDanime = $_GET['IDanime'];
		$IDscan = $_GET['IDscan'];
		$lien = 'http://metromanga.com/anime.php?anime=' . $IDanime . '&scan=' . $IDscan . '';
		$IDmembre = $_SESSION['ID'];
		$commentaire = html_entity_decode($_GET['ajoutercommentairescan']);
		
		if(mb_strlen($commentaire, 'utf8') >= 5 AND mb_strlen($commentaire, 'utf8') <= 255)
		{
			$commentaire = htmlspecialchars($_GET['ajoutercommentairescan']);
			$insertcommentaire = $db->prepare('INSERT INTO commentairesscans(IDanime,IDscan,lien,IDmembre,commentaire,date_creation) VALUES (:IDanime,:IDscan,:lien,:IDmembre,:commentaire,NOW())');
			$insertcommentaire->execute(array(
			'IDanime' => $IDanime,
			'IDscan' => $IDscan,
			'lien' => $lien,
			'IDmembre' => $IDmembre,
			'commentaire' => $commentaire
			));
			
			echo
			'<div class="blockcommentairesblockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesscans WHERE IDanime =\'' . $_GET['IDanime'] . '\' AND IDscan =\'' . $_GET['IDscan'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareascan" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairescan()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesscans WHERE IDanime =\'' . $_GET['IDanime'] . '\' AND IDscan =\'' . $_GET['IDscan'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentairescan' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentairescan' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesscans WHERE IDanime =\'' . $_GET['IDanime'] . '\' AND IDscan =\'' . $_GET['IDscan'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentairescan' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentairescan=ok&IDanime=' . $_GET['IDanime'] . '&IDscan=' . $_GET['IDscan'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxscan\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentairescan' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentairescan=ok&IDanime=' . $_GET['IDanime'] . '&IDscan=' . $_GET['IDscan'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxscan\').innerHTML = xhr.responseText;
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
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesscans WHERE IDanime =\'' . $_GET['IDanime'] . '\' AND IDscan =\'' . $_GET['IDscan'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareascan" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairescan()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesscans WHERE IDanime =\'' . $_GET['IDanime'] . '\' AND IDscan =\'' . $_GET['IDscan'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentairescan' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentairescan' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesscans WHERE IDanime =\'' . $_GET['IDanime'] . '\' AND IDscan =\'' . $_GET['IDscan'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentairescan' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentairescan=ok&IDanime=' . $_GET['IDanime'] . '&IDscan=' . $_GET['IDscan'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxscan\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentairescan' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentairescan=ok&IDanime=' . $_GET['IDanime'] . '&IDscan=' . $_GET['IDscan'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxscan\').innerHTML = xhr.responseText;
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
	else if(isset($_GET['signalecommentairescan'])  AND isset($_GET['IDscan']) AND isset($_GET['IDcommentaire']))
	{
		$signalecommentaire = $db->query('SELECT * FROM commentairesscans WHERE ID =\'' . $_GET['IDcommentaire'] . '\'');
		$signaleinfocommentaire = $signalecommentaire->fetch();
		
		$page = 'scan';
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
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesscans WHERE IDanime =\'' . $_GET['IDanime'] . '\' AND IDscan =\'' . $_GET['IDscan'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareascan" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairescan()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesscans WHERE IDanime =\'' . $_GET['IDanime'] . '\' AND IDscan =\'' . $_GET['IDscan'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentairescan' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentairescan' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesscans WHERE IDanime =\'' . $_GET['IDanime'] . '\' AND IDscan =\'' . $_GET['IDscan'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentairescan' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentairescan=ok&IDanime=' . $_GET['IDanime'] . '&IDscan=' . $_GET['IDscan'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxscan\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentairescan' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentairescan=ok&IDanime=' . $_GET['IDanime'] . '&IDscan=' . $_GET['IDscan'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxscan\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}';
			}
			$searchinfocommentairejs->closeCursor();
			
			echo
			'</script>';
		
	}
	else if(isset($_GET['supprimercommentairescan']) AND isset($_GET['IDanime']) AND isset($_GET['IDscan']) AND isset($_GET['IDcommentaire']) AND isset($_GET['LIENcommentaire']) AND isset($_SESSION['ID']) AND $_SESSION['ID'] == '1')
	{
		$IDinfocommentaire = $_GET['IDcommentaire'];
		$lieninfocommentaire = $_GET['LIENcommentaire'];
		
		$supprimercommentaire = $db->prepare('DELETE FROM commentairesscans WHERE ID = ?');
		$supprimercommentaire->execute(array($IDinfocommentaire));	
		$supprimersignalecommentaire = $db->prepare('DELETE FROM signalecommentaire WHERE IDcommentaire = ? AND lien = ?');
		$supprimersignalecommentaire->execute(array($IDinfocommentaire,$lieninfocommentaire));
		
		echo
			'<div class="blockcommentairesblockcommenter">';
			
			if(isset($_SESSION['ID']))
			{
				$searchnbdecommentaires = $db->query('SELECT COUNT(*) AS nbdecommentaires FROM commentairesscans WHERE IDanime =\'' . $_GET['IDanime'] . '\' AND IDscan =\'' . $_GET['IDscan'] . '\'');
				$nbdecommentaires = $searchnbdecommentaires->fetch();
				
				echo
				'<span><img src="membre/avatar/' . $_SESSION['avatar'] . '" alt="Avatar" class="blockcommenteravatar" /></span>
					<textarea id="blockcommentertextareascan" class="blockcommentertextarea" placeholder="Ajouter un Commentaire..." required minlength="5" maxlength="255" ></textarea><br />
					<fieldset class="blockcommenterajouterbarre">
						<legend><input type="submit" value="Ajouter" class="blockcommenterajouter" onclick="ajoutercommentairescan()" /></legend>
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
				$searchinfocommentaire = $db->query('SELECT * FROM commentairesscans WHERE IDanime =\'' . $_GET['IDanime'] . '\' AND IDscan =\'' . $_GET['IDscan'] . '\' ORDER BY ID DESC LIMIT 0, 100');
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
					'<span onclick="signalecommentairescan' . $infocommentaire['ID'] . '()"><img src="images/signaler.png" alt="Signaler" class="infocommentairesignaler"/></span>';
				}
				else
				{
					if(isset($_SESSION['ID']))
					{
						if($_SESSION['ID'] == '1')
						{
							echo
							'<span onclick="supprimercommentairescan' . $infocommentaire['ID'] . '()"><img src="images/fermer.png" alt="Supprimer" class="infocommentairesupprimer" /></span>';							
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
			
			$searchinfocommentairejs = $db->query('SELECT * FROM commentairesscans WHERE IDanime =\'' . $_GET['IDanime'] . '\' AND IDscan =\'' . $_GET['IDscan'] . '\' ORDER BY ID DESC LIMIT 0, 100');
			while ($infocommentairejs = $searchinfocommentairejs->fetch())
			{
				echo
				'function signalecommentairescan' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?signalecommentairescan=ok&IDanime=' . $_GET['IDanime'] . '&IDscan=' . $_GET['IDscan'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxscan\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function supprimercommentairescan' . $infocommentairejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpanime.php?supprimercommentairescan=ok&IDanime=' . $_GET['IDanime'] . '&IDscan=' . $_GET['IDscan'] . '&IDcommentaire=' . $infocommentairejs['ID'] . '&LIENcommentaire=' . $infocommentairejs['lien'] . '\');
					
					xhr.onreadystatechange = function() 
					{
						if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.querySelector(\'#commentaireajaxscan\').innerHTML = xhr.responseText;
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