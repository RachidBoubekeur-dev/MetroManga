<?php
	header("Content-Type: text/javascript");
	
	session_start();
	
	$db = new PDO('mysql:host=localhost;dbname=metromanga', 'root', '');
	
	if(isset($_GET['suivremembre']) AND isset($_SESSION['ID']))
	{
		$IDpagemembre = htmlspecialchars($_GET['suivremembre']);	
		$IDmembre = $_SESSION['ID'];
		
		$verifIDpagemembreeexist = $db->query('SELECT COUNT(*) AS verifIDpagemembre FROM membres WHERE ID=\'' . $IDpagemembre . '\'');
		$verifIDpagemembre = $verifIDpagemembreeexist->fetch();
		
		if($verifIDpagemembre['verifIDpagemembre'] == 1)
		{
			$verifabonnementIDpagemembreexist = $db->query('SELECT COUNT(*) AS verifabonnementIDpagemembre FROM abonnermembre WHERE IDpagemembre=\'' . $IDpagemembre . '\' AND IDmembre=\'' . $IDmembre . '\'');
			$verifabonnementIDpagemembre = $verifabonnementIDpagemembreexist->fetch();
			
			if($verifabonnementIDpagemembre['verifabonnementIDpagemembre'] == 0 AND $IDpagemembre != $IDmembre)
			{
				$insertabonnementIDpagemembre = $db->prepare('INSERT INTO abonnermembre(IDpagemembre, IDmembre) VALUES (:IDpagemembre, :IDmembre)');
				$insertabonnementIDpagemembre->execute(array(
				'IDpagemembre' => $IDpagemembre,
				'IDmembre' => $IDmembre
				));
				
				$countnbabonnermembre = $db->query('SELECT COUNT(*) AS nbabonnermembre FROM abonnermembre WHERE IDpagemembre=\'' . $IDpagemembre . '\'');
				$nbabonnermembre = $countnbabonnermembre->fetch();
				
				$updatenbabonnermembre = $db->query('UPDATE membres SET nbabonner=\'' . $nbabonnermembre['nbabonnermembre'] . '\' WHERE ID=\'' . $IDpagemembre . '\'');
				
				echo $nbabonnermembre['nbabonnermembre'];
			}
		}
	}
	else if(isset($_GET['stopsuivremembre']) AND isset($_SESSION['ID']))
	{
		$IDpagemembre = htmlspecialchars($_GET['stopsuivremembre']);	
		$IDmembre = $_SESSION['ID'];
		
		$deleteabonnementmembre = $db->query('DELETE FROM abonnermembre WHERE IDpagemembre=\'' . $IDpagemembre . '\' AND IDmembre=\'' . $IDmembre . '\'');
		
		$countnbmembreabonner = $db->query('SELECT COUNT(*) AS nbmembreabonner FROM abonnermembre WHERE IDpagemembre=\'' . $IDpagemembre . '\'');
		$nbmembreabonner = $countnbmembreabonner->fetch();
		
		$uptadenbmembreabonner = $db->query('UPDATE membres SET nbabonner=\'' . $nbmembreabonner['nbmembreabonner'] . '\' WHERE ID=\'' . $IDpagemembre . '\'');
		
		if(isset($_GET['visiteur']) AND $_GET['visiteur'] == 'OK')
		{
			$countnbmembreabonnement = $db->query('SELECT COUNT(*) AS nbmembreabonnement FROM abonnermembre WHERE IDpagemembre=\'' . $IDpagemembre . '\'');
			$nbmembreabonnement = $countnbmembreabonnement->fetch();
		}
		else
		{
			$countnbmembreabonnement = $db->query('SELECT COUNT(*) AS nbmembreabonnement FROM abonnermembre WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
			$nbmembreabonnement = $countnbmembreabonnement->fetch();
		}
		
		echo $nbmembreabonnement['nbmembreabonnement'];
	}
	else if(isset($_GET['signalemembre']) AND isset($_SESSION['ID']))
	{
		$IDpagemembre = htmlspecialchars($_GET['signalemembre']);	
		$IDmembre = $_SESSION['ID'];
		
		$searchsignalemembre = $db->query('SELECT * FROM signalemembre WHERE IDpagemembre=\'' . $IDpagemembre .  '\'');
		$signalemembre = $searchsignalemembre->rowcount();
		
		if($signalemembre == 0)
		{
			$insertsignalemembre = $db->prepare('INSERT INTO signalemembre(IDmembre, IDpagemembre) VALUES(:IDmembre, :IDpagemembre)');
			$insertsignalemembre->execute(array(
			'IDmembre' => $IDmembre,
			'IDpagemembre' => $IDpagemembre
			));
		}
	}
	else if(isset($_GET['deletepublicationgallery']) AND isset($_SESSION['ID']))
	{
		$supprimerIDgallery = $_GET['deletepublicationgallery'];
		
		$searchimagegallery = $db->query('SELECT * FROM gallery WHERE ID=\'' . $supprimerIDgallery . '\'');
		$imagegallery = $searchimagegallery->fetch();
		
		@unlink("../gallery/" . $imagegallery['image']);
		
		$deleteimage = $db->query('DELETE FROM gallery WHERE ID=\'' . $supprimerIDgallery . '\'');
		$deletenoteimage = $db->query('DELETE FROM notesgallery WHERE IDgallery=\'' . $supprimerIDgallery . '\'');
		$deletesignalimage = $db->query('DELETE FROM signalegallery WHERE IDgallery=\'' . $supprimerIDgallery . '\'');
	}
	else if(isset($_GET['articlegallerynoteaime']) AND isset($_SESSION['ID']))
	{
		$IDgallerynotesgallery = htmlspecialchars($_GET['articlegallerynoteaime']);
		$IDmembrenotesgallery = $_SESSION['ID'];
		
		$verifIDgalleryexist = $db->query('SELECT COUNT(*) AS verifIDgallery FROM gallery WHERE ID=\'' . $IDgallerynotesgallery . '\'');
		$verifIDgallery = $verifIDgalleryexist->fetch();
		
		if($verifIDgallery['verifIDgallery'] == 1)
		{
			$verifnoteexist = $db->query('SELECT COUNT(*) AS verifnote FROM notesgallery WHERE IDgallery=\'' . $IDgallerynotesgallery . '\' AND IDmembre=\'' . $IDmembrenotesgallery . '\'');
			$verifnote = $verifnoteexist->fetch();
			
			if($verifnote['verifnote'] == 0)
			{
				$insertvoteimg = $db->prepare('INSERT INTO notesgallery(IDgallery, IDmembre) VALUES (:IDgallery, :IDmembre)');
				$insertvoteimg->execute(array(
				'IDgallery' => $IDgallerynotesgallery,
				'IDmembre' => $IDmembrenotesgallery
				));
				
				$countnbvoteimg = $db->query('SELECT COUNT(*) AS voteimg FROM notesgallery WHERE IDgallery=\'' . $IDgallerynotesgallery . '\'');
				$voteimg = $countnbvoteimg->fetch();
				
				$insertnbvoteimg = $db->query('UPDATE gallery SET note=\'' . $voteimg['voteimg'] . '\' WHERE ID=\'' . $IDgallerynotesgallery . '\'');
				
				echo $voteimg['voteimg'];
			}
		}
	}
	else if(isset($_GET['articlegallerynoteaimepas']) AND isset($_SESSION['ID']))
	{
		$IDgallerydeletenotesgallery = htmlspecialchars($_GET['articlegallerynoteaimepas']);	
		$IDmembredeletenotesgallery = $_SESSION['ID'];
		
		$verifIDgalleryexist2 = $db->query('SELECT COUNT(*) AS verifIDgallery2 FROM gallery WHERE ID=\'' . $IDgallerydeletenotesgallery . '\'');
		$verifIDgallery2 = $verifIDgalleryexist2->fetch();
		
		if($verifIDgallery2['verifIDgallery2'] == 1)
		{
			$deletevoteimg = $db->query('DELETE FROM notesgallery WHERE IDgallery=\'' . $IDgallerydeletenotesgallery . '\' AND IDmembre=\'' . $IDmembredeletenotesgallery . '\'');
		
			$countnbvoteimg2 = $db->query('SELECT COUNT(*) AS voteimg2 FROM notesgallery WHERE IDgallery=\'' . $IDgallerydeletenotesgallery . '\'');
			$voteimg2 = $countnbvoteimg2->fetch();
			
			$updatenbvoteimg = $db->query('UPDATE gallery SET note=\'' . $voteimg2['voteimg2'] . '\' WHERE ID=\'' . $IDgallerydeletenotesgallery . '\'');
			
			echo $voteimg2['voteimg2'];
		}
	}
	else if(isset($_GET['deletepublicationforum']) AND isset($_SESSION['ID']))
	{
		$lien = 'http://metromanga.com/forum.php?id=' . $_GET['deletepublicationforum'] . '';
		
		$supprimersujet = $db->query('DELETE FROM forumsujets WHERE ID =\'' . $_GET['deletepublicationforum'] . '\'');
		$supprimersujetcommentairesforum = $db->query('DELETE FROM commentairesforum WHERE IDsujet =\'' . $_GET['deletepublicationforum'] . '\'');
		$supprimersujetnotesforum = $db->query('DELETE FROM notesforum WHERE IDsujet =\'' . $_GET['deletepublicationforum'] . '\'');
		$supprimersujetsignalesujet = $db->query('DELETE FROM signalesujet WHERE IDsujet =\'' . $_GET['deletepublicationforum'] . '\'');
		$supprimersujetsignalecommentaire = $db->prepare('DELETE FROM signalecommentaire WHERE lien = ?');
		$supprimersujetsignalecommentaire->execute(array($lien));
	}
	else if(isset($_GET['modifierbio']) AND isset($_SESSION['ID']))
	{
		$modifierbio = htmlspecialchars($_GET['modifierbio']);
		
		if(strlen($modifierbio) >= 3 AND strlen($modifierbio) <= 300)
		{
			$update = $db->query('UPDATE infomembres SET bio=\'' . $modifierbio . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
			
			echo
			'<span class="infodivmembre1" id="infodivmembre1xhr" onclick="infodivmembre1xhr()">' . htmlspecialchars($modifierbio) . '</span>';
		}
		else if(strlen($modifierbio) <= 1)
		{
			$modifierbio = 'NULL';
			
			$update = $db->query('UPDATE infomembres SET bio=\'' . $modifierbio . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
			
			echo
			'<p class="infodivmembre1nobio" id="infodivmembre1nobioxhr" onclick="infodivmembre1nobioxhr()">Ajouter votre bio</p>';
		}
	}
	else if(isset($_GET['ajouterbio']) AND isset($_SESSION['ID']))
	{
		$ajoutbio = htmlspecialchars($_GET['ajouterbio']);
		
		if(strlen($ajoutbio) >= 3 AND strlen($ajoutbio) <= 300)
		{
			$searchbioexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
			$bioexist = $searchbioexist->rowcount();
			
			if($bioexist == 0)
			{
				$insertbio = $db->prepare('INSERT INTO infomembres(IDmembre, bio) VALUES (:IDmembre, :bio)');
				$insertbio->execute(array(
				'IDmembre' => $_SESSION['ID'],
				'bio' => $ajoutbio
				));
			}
			else
			{
				$updatebio = $db->query('UPDATE infomembres SET bio=\'' . $ajoutbio . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
			}
			
			echo
			'<span class="infodivmembre1" id="infodivmembre1xhr" onclick="infodivmembre1xhr()">' . htmlspecialchars($ajoutbio) . '</span>';
		}
	}
	else if(isset($_GET['addinstagram']) AND isset($_SESSION['ID']))
	{
		$urlinstagram = htmlspecialchars($_GET['addinstagram']);
		
		if(strlen($urlinstagram) >= 15 AND strlen($urlinstagram) <= 300)
		{
			$searchurlexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
			$urlexist = $searchurlexist->rowcount();
			
			$verifurl = strpos($urlinstagram, 'instagram');
			
			if($verifurl !== false)
			{
				if($urlexist == 0)
				{
					$inserturl = $db->prepare('INSERT INTO infomembres(IDmembre, instagram) VALUES (:IDmembre, :instagram)');
					$inserturl->execute(array(
					'IDmembre' => $_SESSION['ID'],
					'instagram' => $urlinstagram
					));
					
					echo
					'Lien ajouter';
				}
				else
				{
					$updateurl = $db->query('UPDATE infomembres SET instagram=\'' . $urlinstagram . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
					echo
					'Lien ajouter';
				}
			}
		}
	}
	else if(isset($_GET['addtwitter']) AND isset($_SESSION['ID']))
	{
		$urltwitter = htmlspecialchars($_GET['addtwitter']);
		
		if(strlen($urltwitter) >= 15 AND strlen($urltwitter) <= 300)
		{
			$searchurlexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
			$urlexist = $searchurlexist->rowcount();
			
			$verifurl = strpos($urltwitter, 'twitter');
			
			if($verifurl !== false)
			{
				if($urlexist == 0)
				{
					$inserturl = $db->prepare('INSERT INTO infomembres(IDmembre, twitter) VALUES (:IDmembre, :twitter)');
					$inserturl->execute(array(
					'IDmembre' => $_SESSION['ID'],
					'twitter' => $urltwitter
					));
					
					echo
					'Lien ajouter';
				}
				else
				{
					$updateurl = $db->query('UPDATE infomembres SET twitter=\'' . $urltwitter . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
					echo
					'Lien ajouter';
				}
			}
		}
	}
	else if(isset($_GET['addyoutube']) AND isset($_SESSION['ID']))
	{
		$addyoutube = htmlspecialchars($_GET['addyoutube']);
		
		if(strlen($addyoutube) >= 15 AND strlen($addyoutube) <= 300)
		{
			$searchurlexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
			$urlexist = $searchurlexist->rowcount();
			
			$verifurl = strpos($addyoutube, 'youtube');
			
			if($verifurl !== false)
			{
				if($urlexist == 0)
				{
					$inserturl = $db->prepare('INSERT INTO infomembres(IDmembre, youtube) VALUES (:IDmembre, :youtube)');
					$inserturl->execute(array(
					'IDmembre' => $_SESSION['ID'],
					'youtube' => $addyoutube
					));
					
					echo
					'Lien ajouter';
				}
				else
				{
					$updateurl = $db->query('UPDATE infomembres SET youtube=\'' . $addyoutube . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
					echo
					'Lien ajouter';
				}
			}
		}
	}
	else if(isset($_GET['addsnapchat']) AND isset($_SESSION['ID']))
	{
		$addsnapchat = htmlspecialchars($_GET['addsnapchat']);
		
		if(strlen($addsnapchat) >= 15 AND strlen($addsnapchat) <= 300)
		{
			$searchurlexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
			$urlexist = $searchurlexist->rowcount();
			
			$verifurl = strpos($addsnapchat, 'snapchat');
			
			if($verifurl !== false)
			{
				if($urlexist == 0)
				{
					$inserturl = $db->prepare('INSERT INTO infomembres(IDmembre, snapchat) VALUES (:IDmembre, :snapchat)');
					$inserturl->execute(array(
					'IDmembre' => $_SESSION['ID'],
					'snapchat' => $addsnapchat
					));
					
					echo
					'Lien ajouter';
				}
				else
				{
					$updateurl = $db->query('UPDATE infomembres SET snapchat=\'' . $addsnapchat . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
					echo
					'Lien ajouter';
				}
			}
		}
	}
	else if(isset($_GET['addtwitch']) AND isset($_SESSION['ID']))
	{
		$addtwitch = htmlspecialchars($_GET['addtwitch']);
		
		if(strlen($addtwitch) >= 15 AND strlen($addtwitch) <= 300)
		{
			$searchurlexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
			$urlexist = $searchurlexist->rowcount();
			
			$verifurl = strpos($addtwitch, 'twitch');
			
			if($verifurl !== false)
			{
				if($urlexist == 0)
				{
					$inserturl = $db->prepare('INSERT INTO infomembres(IDmembre, twitch) VALUES (:IDmembre, :twitch)');
					$inserturl->execute(array(
					'IDmembre' => $_SESSION['ID'],
					'twitch' => $addtwitch
					));
					
					echo
					'Lien ajouter';
				}
				else
				{
					$updateurl = $db->query('UPDATE infomembres SET twitch=\'' . $addtwitch . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
					echo
					'Lien ajouter';
				}
			}
		}
	}
	else if(isset($_GET['addfacebook']) AND isset($_SESSION['ID']))
	{
		$addfacebook = htmlspecialchars($_GET['addfacebook']);
		
		if(strlen($addfacebook) >= 15 AND strlen($addfacebook) <= 300)
		{
			$searchurlexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
			$urlexist = $searchurlexist->rowcount();
			
			$verifurl = strpos($addfacebook, 'facebook');
			
			if($verifurl !== false)
			{
				if($urlexist == 0)
				{
					$inserturl = $db->prepare('INSERT INTO infomembres(IDmembre, facebook) VALUES (:IDmembre, :facebook)');
					$inserturl->execute(array(
					'IDmembre' => $_SESSION['ID'],
					'facebook' => $addfacebook
					));
					
					echo
					'Lien ajouter';
				}
				else
				{
					$updateurl = $db->query('UPDATE infomembres SET facebook=\'' . $addfacebook . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
					echo
					'Lien ajouter';
				}
			}
		}
	}
	else if(isset($_GET['updateinstagram']) AND isset($_SESSION['ID']))
	{
		$updateinstagram = htmlspecialchars($_GET['updateinstagram']);
		
		$searchurlexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
		$urlexist = $searchurlexist->rowcount();
		if($urlexist == 1)
		{
			if(strlen($updateinstagram) >= 15 AND strlen($updateinstagram) <= 300)
			{
				$verifurl = strpos($updateinstagram, 'instagram');
				
				if($verifurl !== false)
				{
					$updateurl = $db->query('UPDATE infomembres SET instagram=\'' . $updateinstagram . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
					echo
					'Lien modifier';
				}
			}
			else
			{
				$updateurl = $db->query('UPDATE infomembres SET instagram = NULL WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
				echo
				'Lien supprimer';
			}
		}
	}
	else if(isset($_GET['updatetwitter']) AND isset($_SESSION['ID']))
	{
		$updatetwitter = htmlspecialchars($_GET['updatetwitter']);
		
		$searchurlexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
		$urlexist = $searchurlexist->rowcount();
		if($urlexist == 1)
		{
			if(strlen($updatetwitter) >= 15 AND strlen($updatetwitter) <= 300)
			{
				$verifurl = strpos($updatetwitter, 'twitter');
				
				if($verifurl !== false)
				{
					$updateurl = $db->query('UPDATE infomembres SET twitter=\'' . $updatetwitter . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
					echo
					'Lien modifier';
				}
			}
			else
			{
				$updateurl = $db->query('UPDATE infomembres SET twitter = NULL WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
				echo
				'Lien supprimer';
			}
		}
	}
	else if(isset($_GET['updateyoutube']) AND isset($_SESSION['ID']))
	{
		$updateyoutube = htmlspecialchars($_GET['updateyoutube']);
		
		$searchurlexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
		$urlexist = $searchurlexist->rowcount();
		if($urlexist == 1)
		{
			if(strlen($updateyoutube) >= 15 AND strlen($updateyoutube) <= 300)
			{
				$verifurl = strpos($updateyoutube, 'youtube');
				
				if($verifurl !== false)
				{
					$updateurl = $db->query('UPDATE infomembres SET youtube=\'' . $updateyoutube . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
					echo
					'Lien modifier';
				}
			}
			else
			{
				$updateurl = $db->query('UPDATE infomembres SET youtube = NULL WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
				echo
				'Lien supprimer';
			}
		}
	}
	else if(isset($_GET['updatesnapchat']) AND isset($_SESSION['ID']))
	{
		$updatesnapchat = htmlspecialchars($_GET['updatesnapchat']);
		
		$searchurlexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
		$urlexist = $searchurlexist->rowcount();
		if($urlexist == 1)
		{
			if(strlen($updatesnapchat) >= 15 AND strlen($updatesnapchat) <= 300)
			{
				$verifurl = strpos($updatesnapchat, 'snapchat');
				
				if($verifurl !== false)
				{
					$updateurl = $db->query('UPDATE infomembres SET snapchat=\'' . $updatesnapchat . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
					echo
					'Lien modifier';
				}
			}
			else
			{
				$updateurl = $db->query('UPDATE infomembres SET snapchat = NULL WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
				echo
				'Lien supprimer';
			}
		}
	}
	else if(isset($_GET['updatetwitch']) AND isset($_SESSION['ID']))
	{
		$updatetwitch = htmlspecialchars($_GET['updatetwitch']);
		
		$searchurlexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
		$urlexist = $searchurlexist->rowcount();
		if($urlexist == 1)
		{
			if(strlen($updatetwitch) >= 15 AND strlen($updatetwitch) <= 300)
			{
				$verifurl = strpos($updatetwitch, 'twitch');
				
				if($verifurl !== false)
				{
					$updateurl = $db->query('UPDATE infomembres SET twitch=\'' . $updatetwitch . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
					echo
					'Lien modifier';
				}
			}
			else
			{
				$updateurl = $db->query('UPDATE infomembres SET twitch = NULL WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
				echo
				'Lien supprimer';
			}
		}
	}
	else if(isset($_GET['updatefacebook']) AND isset($_SESSION['ID']))
	{
		$updatefacebook = htmlspecialchars($_GET['updatefacebook']);
		
		$searchurlexist = $db->query('SELECT * FROM infomembres WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
		$urlexist = $searchurlexist->rowcount();
		if($urlexist == 1)
		{
			if(strlen($updatefacebook) >= 15 AND strlen($updatefacebook) <= 300)
			{
				$verifurl = strpos($updatefacebook, 'facebook');
				
				if($verifurl !== false)
				{
					$updateurl = $db->query('UPDATE infomembres SET facebook=\'' . $updatefacebook . '\' WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
					echo
					'Lien modifier';
				}
			}
			else
			{
				$updateurl = $db->query('UPDATE infomembres SET facebook = NULL WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
					
				echo
				'Lien supprimer';
			}
		}
	}
	else
	{
		header("Location: ../index.php");
	}
?>