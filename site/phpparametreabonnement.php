<?php
	header("Content-Type: text/javascript");
	
	session_start();
	
	$db = new PDO('mysql:host=localhost;dbname=metromanga', 'root', '');
	
	if(isset($_GET['trierparalaune']) AND isset($_SESSION['ID']))
	{
		$selectarticleabonnement = $db->query('SELECT * FROM articlepageanime ORDER BY note DESC');
		
		while($articleabonnement = $selectarticleabonnement->fetch())
		{
		$selectIDanimeabonnement = $db->query('SELECT * FROM abonneranime WHERE IDanime=\'' . $articleabonnement['IDanime'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
		$IDanimeabonnement = $selectIDanimeabonnement->rowCount();
		if($IDanimeabonnement == 1)
		{
			$selectinfoanimeabonnement = $db->query('SELECT * FROM animes WHERE ID=\'' . $articleabonnement['IDanime'] .  '\'');
			$infoanimeabonnement = $selectinfoanimeabonnement->fetch();
			
			$imageanimeabonnement = 'anime/' . htmlspecialchars($infoanimeabonnement['image']);
			$titreanimeabonnement = htmlspecialchars($infoanimeabonnement['titre']);
		
		echo
		'<div class="blockfilactualitearticle" id="blockfilabonnementarticle' . $articleabonnement['ID'] . '">';
		
			if($_SESSION['ID'] == '1')
			{
			
				echo
				'<img src="images/supprimerrecherche2.png" alt="supprimer" class="deleteactualitearticle" id="deleteabonnementarticle' . $articleabonnement['ID'] . '" onclick="deleteabonnementarticle' . $articleabonnement['ID'] . '()" />';
				
			}
			
			echo
			'<div style="background: url(' . $imageanimeabonnement . ')no-repeat;background-size: cover;" class="articleavatar"/></div>
			<span class="articlepseudo">' . $titreanimeabonnement . '</span><br />';
			
			$dateanimgN2 = date("Y", strtotime($articleabonnement['date_creation']));
			$datemoisimgN2 = date("m", strtotime($articleabonnement['date_creation']));
			$datedayimgN2 = date("d", strtotime($articleabonnement['date_creation']));
			$dateheureimgN2 = date("H", strtotime($articleabonnement['date_creation']));
			$dateminimgN2 = date("i", strtotime($articleabonnement['date_creation']));
			
			$dateannowN2 = date('Y');
			$datemoisnowN2 = date('m');
			$datedaynowN2 = date('d');
			$dateheurenowN2 = date('H');
			$dateminnowN2 = date('i');
			
			$dateanN2 =  $dateannowN2 - $dateanimgN2;
			$datemoisN2 = $datemoisnowN2 - $datemoisimgN2;
			$datemois2N2 = $datemoisimgN2 - $datemoisnowN2;
			$datedayN2 = $datedaynowN2 - $datedayimgN2;
			$dateheureN2 = $dateheurenowN2 - $dateheureimgN2;
			$dateminN2 = $dateminnowN2 - $dateminimgN2;
			
			$datemois3N2 = 12 - $datemois2N2;
			
			if($dateanN2 == 1 AND $datemois3N2 == 1 AND $datedayN2 != 0)
			{
				$dateday2N2 = 31 - $datedayimgN2;
				$dateday3N2 = $dateday2N2 + $datedaynowN2;
				if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
				{
					$dateheure2N2 = 24 - $dateheureimgN2;
					$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
					if($dateheure3N2 >= 2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
					
					}
					else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3N2 . 'heure</span>';
					
					}
					else if($dateheure3N2 == 1 AND $dateminN2 < 0)
					{
						$datemin2N2 = 60 + $dateminN2;
						
						echo
						'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
					
					}
					else if($dateheure3N2 == 1 AND $dateminN2 == 1)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
					
					}
				}
				else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
				
				}
				else if($dateday3N2 >= 31)
				{
					if($articleabonnement['date_delete'] == "1mois")
					{
						if($datemois3N2 == 1)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
							</script>';
						}
					}
				
					echo
					'<span class="articletemps">Il y a ' . $datemois3N2 . ' mois</span>';
				
				}else
				{
					if($articleabonnement['date_delete'] == "2semaines")
					{
						if($dateday3N2 >= 14)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
							</script>';
						}
					}
				
					echo
					'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
				}
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateheureN2 == 0 AND $dateminN2 == 0)
			{
				echo
				'<span class="articletemps">À l\'instant</span>';
			}
			else if($dateanN2 == 1 AND $datemois2N2 >= 2)
			{
				$datemois4N2 = 12 - $datemois2N2;
				
				if($articleabonnement['date_delete'] == "6mois")
				{
					if($datemois4N2 == 6)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
						</script>';
					}
				}
					
					echo
					'<span class="articletemps">Il y a ' . $datemois4N2 . ' mois</span>';
			}
			else if($dateanN2 == 1 AND ($datemoisN2 >= 1 OR $datemoisN2 <= 1))
			{	
				if($articleabonnement['date_delete'] == "1an")
				{
					if($dateanN2 == 1)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
						</script>';
					}
				}
					
				echo
				'<span class="articletemps">Il y a ' . $dateanN2 . ' an</span>';
			}
			else if($dateanN2 >= 2)
			{
				echo
				'<span class="articletemps">Il y a ' . $dateanN2 . ' ans</span>';
			}
			else if($datemoisN2 == 0 AND $dateanN2 >= 1)
			{
				if($dateanN2 == 1)
				{
					if($articleabonnement['date_delete'] == "1an")
					{
						if($dateanN2 == 1)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
							</script>';
						}
					}
					
					echo
					'<span class="articletemps">Il y a ' . $dateanN2 . ' an</span>';
					
				}
				else if($dateanN2 >= 1)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateanN2 . ' ans</span>';
				}
			}
			else if($dateanN2 == 0 AND $datemoisN2 >= 2)
			{
				if($articleabonnement['date_delete'] == "6mois")
				{
					if($datemoisN2 == 6)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
						</script>';
					}
				}
				
				echo
				'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 1 AND $datedayN2 == 0)
			{
				if($articleabonnement['date_delete'] == "1mois")
				{
					if($datemoisN2 == 1)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticleabonnement' .  $articleabonnement['ID'] . '(this.value);
						</script>';
					}
				}
				
				echo
				'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 >= 1)
			{
				if($datedayN2 >= 2)
				{
					if($articleabonnement['date_delete'] == "2semaines")
					{
						if($datedayN2 >= 14)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
							</script>';
						}
					}
					 echo
					'<span class="articletemps">Il y a ' . $datedayN2 . ' jours</span>';
				}
				else if($datedayN2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
				{
					$dateheure2N2 = 24 - $dateheureimgN2;
					$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
					if($dateheure3N2 >= 2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
					
					}
					else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						
					}
					else if($dateheure3N2 == 1 AND $dateminN2 < 0)
					{
						$datemin2N2 = 60 + $dateminN2;
						
						echo
						'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
					}
					else if($dateheure3N2 == 1 AND $dateminN2 == 1)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
					}
				}
				else if($datedayN2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
				{
					echo
					'<span class="articletemps">Il y a ' . $datedayN2 . ' jour</span>';
				}
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 1 AND $datedayN2 != 0)
			{
				if($datemoisimgN2 == 1)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
							
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
							
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
								
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					
					}
				}
				else if($datemoisimgN2 == 2)
				{
					$dateday2N2 = 28 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
							
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 28)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 3)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 4)
				{
					$dateday2N2 = 30 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 30)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 5)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 6)
				{
					$dateday2N2 = 30 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 30)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 7)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 8)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
									
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 9)
				{
					$dateday2N2 = 30 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 30)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 10)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 11)
				{
					$dateday2N2 = 30 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 30)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
					
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 12)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateminN2 == 1)
			{
				if($dateheureN2 == 0)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
				}
				else if($dateheureN2 == 1)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
				}
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateheureN2 == 0)
			{
				if($dateminN2 >= 2)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateminN2 . ' minutes</span>';
				}
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateheureN2 == 1 AND $dateminN2 < 0 )
			{
				$datemin2N2 = 60 + $dateminN2;
			
				echo
				'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateheureN2 == 1 AND $dateminN2 >= 0 )
			{
				$datemin2N2 = 60 + $dateminN2;
			
				echo
				'<span class="articletemps">Il y a ' . $dateheureN2 . ' heure</span>';
			}
			else if($dateheureN2 >= 2)
			{
				echo
				'<span class="articletemps">Il y a ' . $dateheureN2 . ' heures</span>';
			}
			
			echo
			'<div class="articlesujet">' . html_entity_decode($articleabonnement['contenu']) . '</div><br />
			<div class="articleblockaime">';
			
				$searchnoteexistabonnement = $db->query('SELECT * FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
				$noteexistabonnement = $searchnoteexistabonnement->rowCount();
				if($noteexistabonnement == 1)
				{
					
					echo
					'<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimeabonnementpas' . $articleabonnement['ID'] . '" onclick="articleimgaimeabonnementpas' . $articleabonnement['ID'] . '()" />
					
					<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaimeabonnement' . $articleabonnement['ID'] . '" onclick="articleimgaimeabonnement' . $articleabonnement['ID'] . '()" style="opacity:0.65;display:none;" />';
				}
				else
				{
					echo
					'<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaimeabonnement' . $articleabonnement['ID'] . '" onclick="articleimgaimeabonnement' . $articleabonnement['ID'] . '()" style="opacity:0.65;" />
				
					<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimeabonnementpas' . $articleabonnement['ID'] . '" onclick="articleimgaimeabonnementpas' . $articleabonnement['ID'] . '()" style="display:none;" />';
				}
				
				echo
				'<span class="articlenbaime" id="articlenbaimeabonnement' . $articleabonnement['ID'] . '">' . htmlspecialchars($articleabonnement['note']) . '</span>
			</div>
		</div>';
		}
		}
		$selectarticleabonnement->closeCursor();
		echo
		'<script>';
		
			$selectarticleabonnementjs = $db->query('SELECT * FROM articlepageanime ORDER BY note DESC');
			while($articleabonnementjs = $selectarticleabonnementjs->fetch())
			{
			$selectIDanimeabonnementjs = $db->query('SELECT * FROM abonneranime WHERE IDanime=\'' . $articleabonnementjs['IDanime'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
			$IDanimeabonnementjs = $selectIDanimeabonnementjs->rowCount();
			if($IDanimeabonnementjs == 1)
			{
			
				if($_SESSION['ID'] == '1')
				{
				
				echo
				'function deleteabonnementarticle' . $articleabonnementjs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpparametreabonnement.php?deletearticle=' . $articleabonnementjs['ID'] . '\');
					
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.getElementById(\'blockfilabonnementarticle' . $articleabonnementjs['ID'] . '\').style.transition="all 0.4s";
							document.getElementById(\'blockfilabonnementarticle' . $articleabonnementjs['ID'] . '\').style.opacity="1";
							setTimeout(function(){document.getElementById("blockfilabonnementarticle' . $articleabonnementjs['ID'] . '\").style.display="none";},200 )
							setTimeout(function(){document.getElementById("blockfilabonnementarticle' . $articleabonnementjs['ID'] . '\").style.opacity="0";},100 )
						}
					};
					
					xhr.send(null);
				}';
				
				}
				
				echo
				'function articleimgaimeabonnement' . $articleabonnementjs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpparametreabonnement.php?articlenoteaime=' . $articleabonnementjs['ID'] . '\');
					
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.getElementById(\'articleimgaimeabonnement' . $articleabonnementjs['ID'] . '\').style.display="none";
							document.getElementById(\'articleimgaimeabonnementpas' . $articleabonnementjs['ID'] . '\').style.display="inline-block";
							document.getElementById(\'articlenbaimeabonnement' . $articleabonnementjs['ID'] . '\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
			
				function articleimgaimeabonnementpas' . $articleabonnementjs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpparametreabonnement.php?articlenoteaimepas=' . $articleabonnementjs['ID'] . '\');
					
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.getElementById(\'articleimgaimeabonnementpas' . $articleabonnementjs['ID'] . '\').style.display="none";
							document.getElementById(\'articleimgaimeabonnement' . $articleabonnementjs['ID'] . '\').style.display="inline-block";
							document.getElementById(\'articlenbaimeabonnement' . $articleabonnementjs['ID'] . '\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function autodeletearticleabonnement' . $articleabonnementjs['ID'] . '()
				{
					document.getElementById(\'blockfilabonnementarticle' . $articleabonnementjs['ID'] . '\').style.display="none";
				}';
			}
			}
			$selectarticleabonnementjs->closeCursor();
		
		echo
		'</script>';
	}
	else if(isset($_GET['trierparrecent']) AND isset($_SESSION['ID']))
	{
		$selectarticleabonnement = $db->query('SELECT * FROM articlepageanime ORDER BY ID DESC');
		
		while($articleabonnement = $selectarticleabonnement->fetch())
		{
		$selectIDanimeabonnement = $db->query('SELECT * FROM abonneranime WHERE IDanime=\'' . $articleabonnement['IDanime'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
		$IDanimeabonnement = $selectIDanimeabonnement->rowCount();
		if($IDanimeabonnement == 1)
		{
			$selectinfoanimeabonnement = $db->query('SELECT * FROM animes WHERE ID=\'' . $articleabonnement['IDanime'] .  '\'');
			$infoanimeabonnement = $selectinfoanimeabonnement->fetch();
			
			$imageanimeabonnement = 'anime/' . htmlspecialchars($infoanimeabonnement['image']);
			$titreanimeabonnement = htmlspecialchars($infoanimeabonnement['titre']);
		
		echo
		'<div class="blockfilactualitearticle" id="blockfilabonnementarticle' . $articleabonnement['ID'] . '">';
		
			if($_SESSION['ID'] == '1')
			{
			
				echo
				'<img src="images/supprimerrecherche2.png" alt="supprimer" class="deleteactualitearticle" id="deleteabonnementarticle' . $articleabonnement['ID'] . '" onclick="deleteabonnementarticle' . $articleabonnement['ID'] . '()" />';
				
			}
			
			echo
			'<div style="background: url(' . $imageanimeabonnement . ')no-repeat;background-size: cover;" class="articleavatar"/></div>
			<span class="articlepseudo">' . $titreanimeabonnement . '</span><br />';
			
			$dateanimgN2 = date("Y", strtotime($articleabonnement['date_creation']));
			$datemoisimgN2 = date("m", strtotime($articleabonnement['date_creation']));
			$datedayimgN2 = date("d", strtotime($articleabonnement['date_creation']));
			$dateheureimgN2 = date("H", strtotime($articleabonnement['date_creation']));
			$dateminimgN2 = date("i", strtotime($articleabonnement['date_creation']));
			
			$dateannowN2 = date('Y');
			$datemoisnowN2 = date('m');
			$datedaynowN2 = date('d');
			$dateheurenowN2 = date('H');
			$dateminnowN2 = date('i');
			
			$dateanN2 =  $dateannowN2 - $dateanimgN2;
			$datemoisN2 = $datemoisnowN2 - $datemoisimgN2;
			$datemois2N2 = $datemoisimgN2 - $datemoisnowN2;
			$datedayN2 = $datedaynowN2 - $datedayimgN2;
			$dateheureN2 = $dateheurenowN2 - $dateheureimgN2;
			$dateminN2 = $dateminnowN2 - $dateminimgN2;
			
			$datemois3N2 = 12 - $datemois2N2;
			
			if($dateanN2 == 1 AND $datemois3N2 == 1 AND $datedayN2 != 0)
			{
				$dateday2N2 = 31 - $datedayimgN2;
				$dateday3N2 = $dateday2N2 + $datedaynowN2;
				if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
				{
					$dateheure2N2 = 24 - $dateheureimgN2;
					$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
					if($dateheure3N2 >= 2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
					
					}
					else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3N2 . 'heure</span>';
					
					}
					else if($dateheure3N2 == 1 AND $dateminN2 < 0)
					{
						$datemin2N2 = 60 + $dateminN2;
						
						echo
						'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
					
					}
					else if($dateheure3N2 == 1 AND $dateminN2 == 1)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
					
					}
				}
				else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
				
				}
				else if($dateday3N2 >= 31)
				{
					if($articleabonnement['date_delete'] == "1mois")
					{
						if($datemois3N2 == 1)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
							</script>';
						}
					}
				
					echo
					'<span class="articletemps">Il y a ' . $datemois3N2 . ' mois</span>';
				
				}else
				{
					if($articleabonnement['date_delete'] == "2semaines")
					{
						if($dateday3N2 >= 14)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
							</script>';
						}
					}
				
					echo
					'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
				}
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateheureN2 == 0 AND $dateminN2 == 0)
			{
				echo
				'<span class="articletemps">À l\'instant</span>';
			}
			else if($dateanN2 == 1 AND $datemois2N2 >= 2)
			{
				$datemois4N2 = 12 - $datemois2N2;
				
				if($articleabonnement['date_delete'] == "6mois")
				{
					if($datemois4N2 == 6)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
						</script>';
					}
				}
					
					echo
					'<span class="articletemps">Il y a ' . $datemois4N2 . ' mois</span>';
			}
			else if($dateanN2 == 1 AND ($datemoisN2 >= 1 OR $datemoisN2 <= 1))
			{	
				if($articleabonnement['date_delete'] == "1an")
				{
					if($dateanN2 == 1)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
						</script>';
					}
				}
					
				echo
				'<span class="articletemps">Il y a ' . $dateanN2 . ' an</span>';
			}
			else if($dateanN2 >= 2)
			{
				echo
				'<span class="articletemps">Il y a ' . $dateanN2 . ' ans</span>';
			}
			else if($datemoisN2 == 0 AND $dateanN2 >= 1)
			{
				if($dateanN2 == 1)
				{
					if($articleabonnement['date_delete'] == "1an")
					{
						if($dateanN2 == 1)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
							</script>';
						}
					}
					
					echo
					'<span class="articletemps">Il y a ' . $dateanN2 . ' an</span>';
					
				}
				else if($dateanN2 >= 1)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateanN2 . ' ans</span>';
				}
			}
			else if($dateanN2 == 0 AND $datemoisN2 >= 2)
			{
				if($articleabonnement['date_delete'] == "6mois")
				{
					if($datemoisN2 == 6)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
						</script>';
					}
				}
				
				echo
				'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 1 AND $datedayN2 == 0)
			{
				if($articleabonnement['date_delete'] == "1mois")
				{
					if($datemoisN2 == 1)
					{
						$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
						$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
						
						echo
						'<script>
							autodeletearticleabonnement' .  $articleabonnement['ID'] . '(this.value);
						</script>';
					}
				}
				
				echo
				'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 >= 1)
			{
				if($datedayN2 >= 2)
				{
					if($articleabonnement['date_delete'] == "2semaines")
					{
						if($datedayN2 >= 14)
						{
							$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
							$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
							
							echo
							'<script>
								autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
							</script>';
						}
					}
					 echo
					'<span class="articletemps">Il y a ' . $datedayN2 . ' jours</span>';
				}
				else if($datedayN2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
				{
					$dateheure2N2 = 24 - $dateheureimgN2;
					$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
					if($dateheure3N2 >= 2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
					
					}
					else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						
					}
					else if($dateheure3N2 == 1 AND $dateminN2 < 0)
					{
						$datemin2N2 = 60 + $dateminN2;
						
						echo
						'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
					}
					else if($dateheure3N2 == 1 AND $dateminN2 == 1)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
					}
				}
				else if($datedayN2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
				{
					echo
					'<span class="articletemps">Il y a ' . $datedayN2 . ' jour</span>';
				}
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 1 AND $datedayN2 != 0)
			{
				if($datemoisimgN2 == 1)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
							
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
							
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
								
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					
					}
				}
				else if($datemoisimgN2 == 2)
				{
					$dateday2N2 = 28 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
							
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 28)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 3)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 4)
				{
					$dateday2N2 = 30 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 30)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 5)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 6)
				{
					$dateday2N2 = 30 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 30)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 7)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 8)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
									
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 9)
				{
					$dateday2N2 = 30 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 30)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 10)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 11)
				{
					$dateday2N2 = 30 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
							
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 30)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
					
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
				else if($datemoisimgN2 == 12)
				{
					$dateday2N2 = 31 - $datedayimgN2;
					$dateday3N2 = $dateday2N2 + $datedaynowN2;
					if($dateday3N2 == 1 AND $dateheureimgN2 > $dateheurenowN2)
					{
						$dateheure2N2 = 24 - $dateheureimgN2;
						$dateheure3N2 = $dateheure2N2 + $dateheurenowN2;
						if($dateheure3N2 >= 2)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heures</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 >= 0)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateheure3N2 . ' heure</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 < 0)
						{
							$datemin2N2 = 60 + $dateminN2;
						
							echo
							'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
						}
						else if($dateheure3N2 == 1 AND $dateminN2 == 1)
						{
							echo
							'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
						}
					}
					else if($dateday3N2 == 1 AND $dateheureimgN2 <= $dateheurenowN2)
					{
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jour</span>';
					}
					else if($dateday3N2 >= 31)
					{
						if($articleabonnement['date_delete'] == "1mois")
						{
							if($datemoisN2 == 1)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $datemoisN2 . ' mois</span>';
					}
					else
					{
						if($articleabonnement['date_delete'] == "2semaines")
						{
							if($dateday3N2 >= 14)
							{
								$deletearticle = $db->query('DELETE FROM articlepageanime WHERE ID=\'' . $articleabonnement['ID'] . '\'');
								$deletenotearticle = $db->query('DELETE FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\'');
								
								echo
								'<script>
									autodeletearticleabonnement' . $articleabonnement['ID'] . '(this.value);
								</script>';
							}
						}
						
						echo
						'<span class="articletemps">Il y a ' . $dateday3N2 . ' jours</span>';
					}
				}
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateminN2 == 1)
			{
				if($dateheureN2 == 0)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
				}
				else if($dateheureN2 == 1)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateminN2 . ' minute</span>';
				}
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateheureN2 == 0)
			{
				if($dateminN2 >= 2)
				{
					echo
					'<span class="articletemps">Il y a ' . $dateminN2 . ' minutes</span>';
				}
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateheureN2 == 1 AND $dateminN2 < 0 )
			{
				$datemin2N2 = 60 + $dateminN2;
			
				echo
				'<span class="articletemps">Il y a ' . $datemin2N2 . ' minutes</span>';
			}
			else if($dateanN2 == 0 AND $datemoisN2 == 0 AND $datedayN2 == 0 AND $dateheureN2 == 1 AND $dateminN2 >= 0 )
			{
				$datemin2N2 = 60 + $dateminN2;
			
				echo
				'<span class="articletemps">Il y a ' . $dateheureN2 . ' heure</span>';
			}
			else if($dateheureN2 >= 2)
			{
				echo
				'<span class="articletemps">Il y a ' . $dateheureN2 . ' heures</span>';
			}
			
			echo
			'<div class="articlesujet">' . html_entity_decode($articleabonnement['contenu']) . '</div><br />
			<div class="articleblockaime">';
			
				$searchnoteexistabonnement = $db->query('SELECT * FROM notesarticleanime WHERE IDarticle=\'' . $articleabonnement['ID'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
				$noteexistabonnement = $searchnoteexistabonnement->rowCount();
				if($noteexistabonnement == 1)
				{
					
					echo
					'<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimeabonnementpas' . $articleabonnement['ID'] . '" onclick="articleimgaimeabonnementpas' . $articleabonnement['ID'] . '()" />
					
					<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaimeabonnement' . $articleabonnement['ID'] . '" onclick="articleimgaimeabonnement' . $articleabonnement['ID'] . '()" style="opacity:0.65;display:none;" />';
				}
				else
				{
					echo
					'<img src="images/aimenoir.png" alt="Aime" class="articleimgaime" id="articleimgaimeabonnement' . $articleabonnement['ID'] . '" onclick="articleimgaimeabonnement' . $articleabonnement['ID'] . '()" style="opacity:0.65;" />
				
					<img src="images/aimerouge.png" alt="Aime" class="articleimgaime" id="articleimgaimeabonnementpas' . $articleabonnement['ID'] . '" onclick="articleimgaimeabonnementpas' . $articleabonnement['ID'] . '()" style="display:none;" />';
				}
				
				echo
				'<span class="articlenbaime" id="articlenbaimeabonnement' . $articleabonnement['ID'] . '">' . htmlspecialchars($articleabonnement['note']) . '</span>
			</div>
		</div>';
		}
		}
		$selectarticleabonnement->closeCursor();
		echo
		'<script>';
		
			$selectarticleabonnementjs = $db->query('SELECT * FROM articlepageanime ORDER BY ID DESC');
			while($articleabonnementjs = $selectarticleabonnementjs->fetch())
			{
			$selectIDanimeabonnementjs = $db->query('SELECT * FROM abonneranime WHERE IDanime=\'' . $articleabonnementjs['IDanime'] . '\' AND IDmembre=\'' . $_SESSION['ID'] . '\'');
			$IDanimeabonnementjs = $selectIDanimeabonnementjs->rowCount();
			if($IDanimeabonnementjs == 1)
			{
			
				if($_SESSION['ID'] == '1')
				{
				
				echo
				'function deleteabonnementarticle' . $articleabonnementjs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpparametreabonnement.php?deletearticle=' . $articleabonnementjs['ID'] . '\');
					
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.getElementById(\'blockfilabonnementarticle' . $articleabonnementjs['ID'] . '\').style.transition="all 0.4s";
							document.getElementById(\'blockfilabonnementarticle' . $articleabonnementjs['ID'] . '\').style.opacity="1";
							setTimeout(function(){document.getElementById("blockfilabonnementarticle' . $articleabonnementjs['ID'] . '\").style.display="none";},200 )
							setTimeout(function(){document.getElementById("blockfilabonnementarticle' . $articleabonnementjs['ID'] . '\").style.opacity="0";},100 )
						}
					};
					
					xhr.send(null);
				}';
				
				}
				
				echo
				'function articleimgaimeabonnement' . $articleabonnementjs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpparametreabonnement.php?articlenoteaime=' . $articleabonnementjs['ID'] . '\');
					
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.getElementById(\'articleimgaimeabonnement' . $articleabonnementjs['ID'] . '\').style.display="none";
							document.getElementById(\'articleimgaimeabonnementpas' . $articleabonnementjs['ID'] . '\').style.display="inline-block";
							document.getElementById(\'articlenbaimeabonnement' . $articleabonnementjs['ID'] . '\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
			
				function articleimgaimeabonnementpas' . $articleabonnementjs['ID'] . '()
				{
					var xhr = new XMLHttpRequest();
					
					xhr.open(\'GET\', \'site/phpparametreabonnement.php?articlenoteaimepas=' . $articleabonnementjs['ID'] . '\');
					
					xhr.onreadystatechange = function()
					{
						if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
						{
							document.getElementById(\'articleimgaimeabonnementpas' . $articleabonnementjs['ID'] . '\').style.display="none";
							document.getElementById(\'articleimgaimeabonnement' . $articleabonnementjs['ID'] . '\').style.display="inline-block";
							document.getElementById(\'articlenbaimeabonnement' . $articleabonnementjs['ID'] . '\').innerHTML = xhr.responseText;
						}
					};
					
					xhr.send(null);
				}
				
				function autodeletearticleabonnement' . $articleabonnementjs['ID'] . '()
				{
					document.getElementById(\'blockfilabonnementarticle' . $articleabonnementjs['ID'] . '\').style.display="none";
				}';
			}
			}
			$selectarticleabonnementjs->closeCursor();
		
		echo
		'</script>';
	}
	else if(isset($_GET['stopsuivreanime']) AND isset($_SESSION['ID']))
	{
		$IDanime = htmlspecialchars($_GET['stopsuivreanime']);	
		$IDmembre = $_SESSION['ID'];
		
		$deleteabonnementanime = $db->query('DELETE FROM abonneranime WHERE IDanime=\'' . $IDanime . '\' AND IDmembre=\'' . $IDmembre . '\'');
		
		$countnbanimeabonner = $db->query('SELECT COUNT(*) AS nbanimeabonner FROM abonneranime WHERE IDanime=\'' . $IDanime . '\'');
		$nbanimeabonner = $countnbanimeabonner->fetch();
		
		$uptadenbanimeabonner = $db->query('UPDATE animes SET nbabonner=\'' . $nbanimeabonner['nbanimeabonner'] . '\' WHERE ID=\'' . $IDanime . '\'');
		
		$countnbanimeabonnement = $db->query('SELECT COUNT(*) AS nbanimeabonnement FROM abonneranime WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
		$nbanimeabonnement = $countnbanimeabonnement->fetch();
		
		echo $nbanimeabonnement['nbanimeabonnement'];
		
	}
	else if(isset($_GET['stopsuivremembre']) AND isset($_SESSION['ID']))
	{
		$IDpagemembre = htmlspecialchars($_GET['stopsuivremembre']);	
		$IDmembre = $_SESSION['ID'];
		
		$deleteabonnementmembre = $db->query('DELETE FROM abonnermembre WHERE IDpagemembre=\'' . $IDpagemembre . '\' AND IDmembre=\'' . $IDmembre . '\'');
		
		$countnbmembreabonner = $db->query('SELECT COUNT(*) AS nbmembreabonner FROM abonnermembre WHERE IDpagemembre=\'' . $IDpagemembre . '\'');
		$nbmembreabonner = $countnbmembreabonner->fetch();
		
		$uptadenbmembreabonner = $db->query('UPDATE membres SET nbabonner=\'' . $nbmembreabonner['nbmembreabonner'] . '\' WHERE ID=\'' . $IDpagemembre . '\'');
		
		$countnbmembreabonnement = $db->query('SELECT COUNT(*) AS nbmembreabonnement FROM abonnermembre WHERE IDmembre=\'' . $_SESSION['ID'] . '\'');
		$nbmembreabonnement = $countnbmembreabonnement->fetch();
		
		echo $nbmembreabonnement['nbmembreabonnement'];
		
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