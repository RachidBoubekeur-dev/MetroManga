<?php
	header("Content-Type: text/javascript");
	
	session_start();
	
	$db = new PDO('mysql:host=localhost;dbname=metromanga', 'root', '');
	
	if(isset($_GET['trierparalaune']) AND isset($_SESSION['ID']))
	{
		$selectarcticleactualite = $db->query('SELECT * FROM articlepageanime ORDER BY note DESC');
		
		while($articleactualite = $selectarcticleactualite->fetch())
		{
			if($articleactualite['IDanime'] == '0')
			{
				$imageanimearticle = 'images/avatarmetromanga.png';
				$titreanimearticle = 'Metro Manga';
			}
			else
			{
				$selectinfoanimearticle = $db->query('SELECT * FROM animes WHERE ID=\'' . $articleactualite['IDanime'] .  '\'');
				$infoanimearticle = $selectinfoanimearticle->fetch();
				
				$imageanimearticle = 'anime/' . htmlspecialchars($infoanimearticle['image']);
				$titreanimearticle = htmlspecialchars($infoanimearticle['titre']);
			}
		
		echo
		'<div class="blockfilactualitearticle" id="blockfilactualitearticle' . $articleactualite['ID'] . '">';
		
			if($_SESSION['ID'] == '1')
			{
			
				echo
				'<img src="images/supprimerrecherche2.png" alt="supprimer" class="deleteactualitearticle" id="deleteactualitearticle' . $articleactualite['ID'] . '" onclick="deleteactualitearticle' . $articleactualite['ID'] . '()" />';
				
			}
			
			echo
			'<div style="background: url(' . $imageanimearticle . ')no-repeat;background-size: cover;" class="articleavatar"/></div>
			<span class="articlepseudo">' . $titreanimearticle . '</span><br />';
			
			$dateanimg = date("Y", strtotime($articleactualite['date_creation']));
			$datemoisimg = date("m", strtotime($articleactualite['date_creation']));
			$datedayimg = date("d", strtotime($articleactualite['date_creation']));
			$dateheureimg = date("H", strtotime($articleactualite['date_creation']));
			$dateminimg = date("i", strtotime($articleactualite['date_creation']));
			
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
						echo
						'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
					
					}
					else if($dateheure3 == 1 AND $datemin >= 0)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3 . 'heure</span>';
					
					}
					else if($dateheure3 == 1 AND $datemin < 0)
					{
						$datemin2 = 60 + $datemin;
						
						echo
						'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
					
					}
					else if($dateheure3 == 1 AND $datemin == 1)
					{
						echo
						'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
					
					}
				}
				else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
				
				}
				else if($dateday3 >= 31)
				{
					if($articleactualite['date_delete'] == "1mois")
					{
						if($datemois3 == 1)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticle' . $articleactualite['ID'] . '(this.value);
							</script>';
						}
					}
				
					echo
					'<span class="articletemps">Il y a ' . $datemois3 . ' mois</span>';
				
				}else
				{
					if($articleactualite['date_delete'] == "2semaines")
					{
						if($dateday3 >= 14)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticle' . $articleactualite['ID'] . '(this.value);
							</script>';
						}
					}
				
					echo
					'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
				}
			}
			else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 0 AND $datemin == 0)
			{
				echo
				'<span class="articletemps">À l\'instant</span>';
			}
			else if($datean == 1 AND $datemois2 >= 2)
			{
				$datemois4 = 12 - $datemois2;
				
				if($articleactualite['date_delete'] == "6mois")
				{
					if($datemois4 == 6)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticle' . $articleactualite['ID'] . '(this.value);
						</script>';
					}
				}
					
					echo
					'<span class="articletemps">Il y a ' . $datemois4 . ' mois</span>';
			}
			else if($datean == 1 AND ($datemois >= 1 OR $datemois <= 1))
			{	
				if($articleactualite['date_delete'] == "1an")
				{
					if($datean == 1)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticle' . $articleactualite['ID'] . '(this.value);
						</script>';
					}
				}
					
				echo
				'<span class="articletemps">Il y a ' . $datean . ' an</span>';
			}
			else if($datean >= 2)
			{
				echo
				'<span class="articletemps">Il y a ' . $datean . ' ans</span>';
			}
			else if($datemois == 0 AND $datean >= 1)
			{
				if($datean == 1)
				{
					if($articleactualite['date_delete'] == "1an")
					{
						if($datean == 1)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticle' . $articleactualite['ID'] . '(this.value);
							</script>';
						}
					}
					
					echo
					'<span class="articletemps">Il y a ' . $datean . ' an</span>';
					
				}
				else if($datean >= 1)
				{
					echo
					'<span class="articletemps">Il y a ' . $datean . ' ans</span>';
				}
			}
			else if($datean == 0 AND $datemois >= 2)
			{
				if($articleactualite['date_delete'] == "6mois")
				{
					if($datemois == 6)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticle' . $articleactualite['ID'] . '(this.value);
						</script>';
					}
				}
				
				echo
				'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
			}
			else if($datean == 0 AND $datemois == 1 AND $dateday == 0)
			{
				if($articleactualite['date_delete'] == "1mois")
				{
					if($datemois == 1)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticle' .  $articleactualite['ID'] . '(this.value);
						</script>';
					}
				}
				
				echo
				'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
			}
			else if($datean == 0 AND $datemois == 0 AND $dateday >= 1)
			{
				if($dateday >= 2)
				{
					if($articleactualite['date_delete'] == "2semaines")
					{
						if($dateday >= 14)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticle' . $articleactualite['ID'] . '(this.value);
							</script>';
						}
					}
					 echo
					'<span class="articletemps">Il y a ' . $dateday . ' jours</span>';
				}
				else if($dateday == 1 AND $dateheureimg > $dateheurenow)
				{
					$dateheure2 = 24 - $dateheureimg;
					$dateheure3 = $dateheure2 + $dateheurenow;
					if($dateheure3 >= 2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
					
					}
					else if($dateheure3 == 1 AND $datemin >= 0)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						
					}
					else if($dateheure3 == 1 AND $datemin < 0)
					{
						$datemin2 = 60 + $datemin;
						
						echo
						'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
					}
					else if($dateheure3 == 1 AND $datemin == 1)
					{
						echo
						'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
					}
				}
				else if($dateday == 1 AND $dateheureimg <= $dateheurenow)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateday . ' jour</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
							
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
							
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
								
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
					
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
							
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 28)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 30)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 30)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
									
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 30)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 30)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
					
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
					}
				}
			}
			else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $datemin == 1)
			{
				if($dateheure == 0)
				{
					echo
					'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
				}
				else if($dateheure == 1)
				{
					echo
					'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
				}
			}
			else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 0)
			{
				if($datemin >= 2)
				{
					echo
					'<span class="articletemps">Il y a ' . $datemin . ' minutes</span>';
				}
			}
			else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 1 AND $datemin < 0 )
			{
				$datemin2 = 60 + $datemin;
			
				echo
				'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
			}
			else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 1 AND $datemin >= 0 )
			{
				$datemin2 = 60 + $datemin;
			
				echo
				'<span class="articletemps">Il y a ' . $dateheure . ' heure</span>';
			}
			else if($dateheure >= 2)
			{
				echo
				'<span class="articletemps">Il y a ' . $dateheure . ' heures</span>';
			}
			
			echo
			'<div class="articlesujet">' . html_entity_decode($articleactualite['contenu']) . '</div><br />
			<div class="articleblockaime">';
			
				$searchnoteexist = $db->query('SELECT * FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
				$noteexist = $searchnoteexist->rowCount();
				if($noteexist == 1)
				{
					
					echo
					'<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimepas' . $articleactualite['ID'] . '" onclick="articleimgaimepas' . $articleactualite['ID'] . '()" />
					
					<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaime' . $articleactualite['ID'] . '" onclick="articleimgaime' . $articleactualite['ID'] . '()" style="opacity:0.65;display:none;" />';
				}
				else
				{
					echo
					'<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaime' . $articleactualite['ID'] . '" onclick="articleimgaime' . $articleactualite['ID'] . '()" style="opacity:0.65;" />
				
					<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimepas' . $articleactualite['ID'] . '" onclick="articleimgaimepas' . $articleactualite['ID'] . '()" style="display:none;" />';
				}
				
				echo
				'<span class="articlenbaime" id="articlenbaime' . $articleactualite['ID'] . '">' . htmlspecialchars($articleactualite['note']) . '</span>
			</div>
		</div>';
		}
		$selectarcticleactualite->closeCursor();
		
		echo
		'<script>';
		
			$selectarcticleactualitejs = $db->query('SELECT * FROM articlepageanime ORDER BY note DESC');
			while($articleactualitejs = $selectarcticleactualitejs->fetch())
			{
			
				if($_SESSION['ID'] == '1')
				{
			
				echo
				'function deleteactualitearticle' . $articleactualitejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpparametreactualite.php?deletearticle=' . $articleactualitejs['ID'] . '\');
					
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.getElementById(\'blockfilactualitearticle' . $articleactualitejs['ID'] . '\').style.transition="all 0.4s";
							document.getElementById(\'blockfilactualitearticle' . $articleactualitejs['ID'] . '\').style.opacity="1";
							setTimeout(function(){document.getElementById(\'blockfilactualitearticle' . $articleactualitejs['ID'] . '\').style.display="none";},200 )
							setTimeout(function(){document.getElementById(\'blockfilactualitearticle' . $articleactualitejs['ID'] . '\').style.opacity="0";},100 )
						}
					};
					
					xhr.send(null);
				}';
			
				}
				
				echo
				'function articleimgaime' . $articleactualitejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpparametreactualite.php?articlenoteaime=' . $articleactualitejs['ID'] . '\');
					
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.getElementById(\'articleimgaime' . $articleactualitejs['ID'] . '\').style.display="none";
							document.getElementById(\'articleimgaimepas' . $articleactualitejs['ID'] . '\').style.display="inline-block";
							document.getElementById(\'articlenbaime' . $articleactualitejs['ID'] . '\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function articleimgaimepas' . $articleactualitejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpparametreactualite.php?articlenoteaimepas=' . $articleactualitejs['ID'] . '\');
					
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.getElementById(\'articleimgaimepas' . $articleactualitejs['ID'] . '\').style.display="none";
							document.getElementById(\'articleimgaime' . $articleactualitejs['ID'] . '\').style.display="inline-block";
							document.getElementById(\'articlenbaime' . $articleactualitejs['ID'] . '\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function autodeletearticle' . $articleactualitejs['ID'] . '()
				{
					document.getElementById(\'blockfilactualitearticle' . $articleactualitejs['ID'] . '\').style.display="none";
				}';
			}
			$selectarcticleactualitejs->closeCursor();
		
		echo
		'</script>';
	}
	else if(isset($_GET['trierparrecent']) AND isset($_SESSION['ID']))
	{
		$selectarcticleactualite = $db->query('SELECT * FROM articlepageanime ORDER BY ID DESC');
		
		while($articleactualite = $selectarcticleactualite->fetch())
		{
			if($articleactualite['IDanime'] == '0')
			{
				$imageanimearticle = 'images/avatarmetromanga.png';
				$titreanimearticle = 'Metro Manga';
			}
			else
			{
				$selectinfoanimearticle = $db->query('SELECT * FROM animes WHERE ID=\'' . $articleactualite['IDanime'] .  '\'');
				$infoanimearticle = $selectinfoanimearticle->fetch();
				
				$imageanimearticle = 'anime/' . htmlspecialchars($infoanimearticle['image']);
				$titreanimearticle = htmlspecialchars($infoanimearticle['titre']);
			}
		
		echo
		'<div class="blockfilactualitearticle" id="blockfilactualitearticle' . $articleactualite['ID'] . '">';
		
			if($_SESSION['ID'] == '1')
			{
			
				echo
				'<img src="images/supprimerrecherche2.png" alt="supprimer" class="deleteactualitearticle" id="deleteactualitearticle' . $articleactualite['ID'] . '" onclick="deleteactualitearticle' . $articleactualite['ID'] . '()" />';
				
			}
			
			echo
			'<div style="background: url(' . $imageanimearticle . ')no-repeat;background-size: cover;" class="articleavatar"/></div>
			<span class="articlepseudo">' . $titreanimearticle . '</span><br />';
			
			$dateanimg = date("Y", strtotime($articleactualite['date_creation']));
			$datemoisimg = date("m", strtotime($articleactualite['date_creation']));
			$datedayimg = date("d", strtotime($articleactualite['date_creation']));
			$dateheureimg = date("H", strtotime($articleactualite['date_creation']));
			$dateminimg = date("i", strtotime($articleactualite['date_creation']));
			
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
						echo
						'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
					
					}
					else if($dateheure3 == 1 AND $datemin >= 0)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3 . 'heure</span>';
					
					}
					else if($dateheure3 == 1 AND $datemin < 0)
					{
						$datemin2 = 60 + $datemin;
						
						echo
						'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
					
					}
					else if($dateheure3 == 1 AND $datemin == 1)
					{
						echo
						'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
					
					}
				}
				else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
				
				}
				else if($dateday3 >= 31)
				{
					if($articleactualite['date_delete'] == "1mois")
					{
						if($datemois3 == 1)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticle' . $articleactualite['ID'] . '(this.value);
							</script>';
						}
					}
				
					echo
					'<span class="articletemps">Il y a ' . $datemois3 . ' mois</span>';
				
				}else
				{
					if($articleactualite['date_delete'] == "2semaines")
					{
						if($dateday3 >= 14)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticle' . $articleactualite['ID'] . '(this.value);
							</script>';
						}
					}
				
					echo
					'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
				}
			}
			else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 0 AND $datemin == 0)
			{
				echo
				'<span class="articletemps">À l\'instant</span>';
			}
			else if($datean == 1 AND $datemois2 >= 2)
			{
				$datemois4 = 12 - $datemois2;
				
				if($articleactualite['date_delete'] == "6mois")
				{
					if($datemois4 == 6)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticle' . $articleactualite['ID'] . '(this.value);
						</script>';
					}
				}
					
					echo
					'<span class="articletemps">Il y a ' . $datemois4 . ' mois</span>';
			}
			else if($datean == 1 AND ($datemois >= 1 OR $datemois <= 1))
			{	
				if($articleactualite['date_delete'] == "1an")
				{
					if($datean == 1)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticle' . $articleactualite['ID'] . '(this.value);
						</script>';
					}
				}
					
				echo
				'<span class="articletemps">Il y a ' . $datean . ' an</span>';
			}
			else if($datean >= 2)
			{
				echo
				'<span class="articletemps">Il y a ' . $datean . ' ans</span>';
			}
			else if($datemois == 0 AND $datean >= 1)
			{
				if($datean == 1)
				{
					if($articleactualite['date_delete'] == "1an")
					{
						if($datean == 1)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticle' . $articleactualite['ID'] . '(this.value);
							</script>';
						}
					}
					
					echo
					'<span class="articletemps">Il y a ' . $datean . ' an</span>';
					
				}
				else if($datean >= 1)
				{
					echo
					'<span class="articletemps">Il y a ' . $datean . ' ans</span>';
				}
			}
			else if($datean == 0 AND $datemois >= 2)
			{
				if($articleactualite['date_delete'] == "6mois")
				{
					if($datemois == 6)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticle' . $articleactualite['ID'] . '(this.value);
						</script>';
					}
				}
				
				echo
				'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
			}
			else if($datean == 0 AND $datemois == 1 AND $dateday == 0)
			{
				if($articleactualite['date_delete'] == "1mois")
				{
					if($datemois == 1)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticle' .  $articleactualite['ID'] . '(this.value);
						</script>';
					}
				}
				
				echo
				'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
			}
			else if($datean == 0 AND $datemois == 0 AND $dateday >= 1)
			{
				if($dateday >= 2)
				{
					if($articleactualite['date_delete'] == "2semaines")
					{
						if($dateday >= 14)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticle' . $articleactualite['ID'] . '(this.value);
							</script>';
						}
					}
					 echo
					'<span class="articletemps">Il y a ' . $dateday . ' jours</span>';
				}
				else if($dateday == 1 AND $dateheureimg > $dateheurenow)
				{
					$dateheure2 = 24 - $dateheureimg;
					$dateheure3 = $dateheure2 + $dateheurenow;
					if($dateheure3 >= 2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
					
					}
					else if($dateheure3 == 1 AND $datemin >= 0)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						
					}
					else if($dateheure3 == 1 AND $datemin < 0)
					{
						$datemin2 = 60 + $datemin;
						
						echo
						'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
					}
					else if($dateheure3 == 1 AND $datemin == 1)
					{
						echo
						'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
					}
				}
				else if($dateday == 1 AND $dateheureimg <= $dateheurenow)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateday . ' jour</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
							
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
							
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
								
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
					
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
							
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 28)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 30)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 30)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
									
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 30)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 30)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
					
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
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
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heures</span>';
						}
						else if($dateheure3 == 1 AND $datemin >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3 . ' heure</span>';
						}
						else if($dateheure3 == 1 AND $datemin < 0)
						{
							$datemin2 = 60 + $datemin;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
						}
						else if($dateheure3 == 1 AND $datemin == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
						}
					}
					else if($dateday3 == 1 AND $dateheureimg <= $dateheurenow)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jour</span>';
					}
					else if($dateday3 >= 31)
					{
						if($articleactualite['date_delete'] == "1mois")
						{
							if($datemois == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemois . ' mois</span>';
					}
					else
					{
						if($articleactualite['date_delete'] == "2semaines")
						{
							if($dateday3 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleactualite['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticle' . $articleactualite['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3 . ' jours</span>';
					}
				}
			}
			else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $datemin == 1)
			{
				if($dateheure == 0)
				{
					echo
					'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
				}
				else if($dateheure == 1)
				{
					echo
					'<span class="articletemps">Il y a ' . $datemin . ' minute</span>';
				}
			}
			else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 0)
			{
				if($datemin >= 2)
				{
					echo
					'<span class="articletemps">Il y a ' . $datemin . ' minutes</span>';
				}
			}
			else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 1 AND $datemin < 0 )
			{
				$datemin2 = 60 + $datemin;
			
				echo
				'<span class="articletemps">Il y a ' . $datemin2 . ' minutes</span>';
			}
			else if($datean == 0 AND $datemois == 0 AND $dateday == 0 AND $dateheure == 1 AND $datemin >= 0 )
			{
				$datemin2 = 60 + $datemin;
			
				echo
				'<span class="articletemps">Il y a ' . $dateheure . ' heure</span>';
			}
			else if($dateheure >= 2)
			{
				echo
				'<span class="articletemps">Il y a ' . $dateheure . ' heures</span>';
			}
			
			echo
			'<div class="articlesujet">' . html_entity_decode($articleactualite['contenu']) . '</div><br />
			<div class="articleblockaime">';
			
				$searchnoteexist = $db->query('SELECT * FROM notesarticleanime WHERE IDarticle=\'' . $articleactualite['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
				$noteexist = $searchnoteexist->rowCount();
				if($noteexist == 1)
				{
					
					echo
					'<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimepas' . $articleactualite['ID'] . '" onclick="articleimgaimepas' . $articleactualite['ID'] . '()" />
					
					<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaime' . $articleactualite['ID'] . '" onclick="articleimgaime' . $articleactualite['ID'] . '()" style="opacity:0.65;display:none;" />';
				}
				else
				{
					echo
					'<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaime' . $articleactualite['ID'] . '" onclick="articleimgaime' . $articleactualite['ID'] . '()" style="opacity:0.65;" />
				
					<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimepas' . $articleactualite['ID'] . '" onclick="articleimgaimepas' . $articleactualite['ID'] . '()" style="display:none;" />';
				}
				
				echo
				'<span class="articlenbaime" id="articlenbaime' . $articleactualite['ID'] . '">' . htmlspecialchars($articleactualite['note']) . '</span>
			</div>
		</div>';
		}
		$selectarcticleactualite->closeCursor();
		
		echo
		'<script>';
		
			$selectarcticleactualitejs = $db->query('SELECT * FROM articlepageanime ORDER BY ID DESC');
			while($articleactualitejs = $selectarcticleactualitejs->fetch())
			{
			
				if($_SESSION['ID'] == '1')
				{
			
				echo
				'function deleteactualitearticle' . $articleactualitejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpparametreactualite.php?deletearticle=' . $articleactualitejs['ID'] . '\');
					
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.getElementById(\'blockfilactualitearticle' . $articleactualitejs['ID'] . '\').style.transition="all 0.4s";
							document.getElementById(\'blockfilactualitearticle' . $articleactualitejs['ID'] . '\').style.opacity="1";
							setTimeout(function(){document.getElementById(\'blockfilactualitearticle' . $articleactualitejs['ID'] . '\').style.display="none";},200 )
							setTimeout(function(){document.getElementById(\'blockfilactualitearticle' . $articleactualitejs['ID'] . '\').style.opacity="0";},100 )
						}
					};
					
					xhr.send(null);
				}';
			
				}
				
				echo
				'function articleimgaime' . $articleactualitejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpparametreactualite.php?articlenoteaime=' . $articleactualitejs['ID'] . '\');
					
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.getElementById(\'articleimgaime' . $articleactualitejs['ID'] . '\').style.display="none";
							document.getElementById(\'articleimgaimepas' . $articleactualitejs['ID'] . '\').style.display="inline-block";
							document.getElementById(\'articlenbaime' . $articleactualitejs['ID'] . '\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function articleimgaimepas' . $articleactualitejs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpparametreactualite.php?articlenoteaimepas=' . $articleactualitejs['ID'] . '\');
					
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.getElementById(\'articleimgaimepas' . $articleactualitejs['ID'] . '\').style.display="none";
							document.getElementById(\'articleimgaime' . $articleactualitejs['ID'] . '\').style.display="inline-block";
							document.getElementById(\'articlenbaime' . $articleactualitejs['ID'] . '\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function autodeletearticle' . $articleactualitejs['ID'] . '()
				{
					document.getElementById(\'blockfilactualitearticle' . $articleactualitejs['ID'] . '\').style.display="none";
				}';
			}
			$selectarcticleactualitejs->closeCursor();
		
		echo
		'</script>';
	}
	else if(isset($_GET['suivreanime']) AND isset($_SESSION['ID']))
	{
		$IDanime = htmlspecialchars($_GET['suivreanime']);	
		$IDmembre = $_SESSION['ID'];
		
		$verifIDanimeeexist = $db->query('SELECT COUNT(*) AS verifIDanime FROM animes WHERE ID=\'' . $IDanime . '\'');
		$verifIDanime = $verifIDanimeeexist->fetch();
		
		if($verifIDanime['verifIDanime'] == 1)
		{
			$verifabonnementexist = $db->query('SELECT COUNT(*) AS verifabonnement FROM abonneranime WHERE IDanime=\'' . $IDanime . '\' AND IDmembre=\'' . $IDmembre . '\'');
			$verifabonnement = $verifabonnementexist->fetch();
			
			if($verifabonnement['verifabonnement'] == 0)
			{
				$insertabonnement = $db->prepare('INSERT INTO abonneranime(IDanime, IDmembre) VALUES (:IDanime, :IDmembre)');
				$insertabonnement->execute(array(
				'IDanime' => $IDanime,
				'IDmembre' => $IDmembre
				));
				
				$countnbabonner = $db->query('SELECT COUNT(*) AS nbabonner FROM abonneranime WHERE IDanime=\'' . $IDanime . '\'');
				$nbabonner = $countnbabonner->fetch();
				
				$insertnbabonner = $db->query('UPDATE animes SET nbabonner=\'' . $nbabonner['nbabonner'] . '\' WHERE ID=\'' . $IDanime . '\'');
				
				echo $nbabonner['nbabonner'];
			}
		}
	}
	else if(isset($_GET['suivremembre']) AND isset($_SESSION['ID']))
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
				
				$insertnbabonnermembre = $db->query('UPDATE membres SET nbabonner=\'' . $nbabonnermembre['nbabonnermembre'] . '\' WHERE ID=\'' . $IDpagemembre . '\'');
				
				echo $nbabonnermembre['nbabonnermembre'];
			}
		}
	}
	else if(isset($_GET['deletearticle']) AND $_SESSION['ID'] == '1')
	{
		$IDarticle = $_GET['deletearticle'];
		
		$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $IDarticle . '\'');
		$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $IDarticle . '\'');
	}
	else if(isset($_GET['articlenoteaime']) AND isset($_SESSION['ID']))
	{
		$IDarticle = htmlspecialchars($_GET['articlenoteaime']);	
		$IDmembre = $_SESSION['ID'];
		
		$verifIDarticleexist = $db->query('SELECT COUNT(*) AS verifIDarticle FROM articlepageanime WHERE ID=\'' . $IDarticle . '\'');
		$verifIDarticle = $verifIDarticleexist->fetch();
		
		if($verifIDarticle['verifIDarticle'] == 1)
		{
			$verifnoteexist = $db->query('SELECT COUNT(*) AS verifnote FROM notesarticleanime WHERE IDarticle=\'' . $IDarticle . '\' AND IDmembre=\'' . $IDmembre . '\'');
			$verifnote = $verifnoteexist->fetch();
			
			if($verifnote['verifnote'] == 0)
			{
				$insertvotearticle = $db->prepare('INSERT INTO notesarticleanime(IDarticle, IDmembre) VALUES (:IDarticle, :IDmembre)');
				$insertvotearticle->execute(array(
				'IDarticle' => $IDarticle,
				'IDmembre' => $IDmembre
				));
				
				$countnbvotearticle = $db->query('SELECT COUNT(*) AS votearticle FROM notesarticleanime WHERE IDarticle=\'' . $IDarticle . '\'');
				$votearticle = $countnbvotearticle->fetch();
				
				$insertnbvotearticle = $db->query('UPDATE articlepageanime SET note=\'' . $votearticle['votearticle'] . '\' WHERE ID=\'' . $IDarticle . '\'');
				
				echo $votearticle['votearticle'];
			}
		}
	}
	else if(isset($_GET['articlenoteaimepas']) AND isset($_SESSION['ID']))
	{
		$IDarticle = htmlspecialchars($_GET['articlenoteaimepas']);	
		$IDmembre = $_SESSION['ID'];
		
		$verifIDarticleexist = $db->query('SELECT COUNT(*) AS verifIDarticle FROM articlepageanime WHERE ID=\'' . $IDarticle . '\'');
		$verifIDarticle = $verifIDarticleexist->fetch();
		
		if($verifIDarticle['verifIDarticle'] == 1)
		{
			$deletevotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $IDarticle . '\' AND IDmembre=\'' . $IDmembre . '\'');
				
			$countnbvotearticle = $db->query('SELECT COUNT(*) AS votearticle FROM notesarticleanime WHERE IDarticle=\'' . $IDarticle . '\'');
			$votearticle = $countnbvotearticle->fetch();
			
			$insertnbvotearticle = $db->query('UPDATE articlepageanime SET note=\'' . $votearticle['votearticle'] . '\' WHERE ID=\'' . $IDarticle . '\'');
			
			echo $votearticle['votearticle'];
		}
	}
	else
	{
		header("Location: ../index.php");
	}
?>