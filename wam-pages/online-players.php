<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Der Anschluss an das Zeichen Datenbank
db_select($mysql_db_characters);

// Charaktere anfordern
$query_onlineplayers = db_query("SELECT name, race, class, gender, level FROM characters WHERE online = '1' ORDER BY name ASC");
$rows_onlineplayers = mysqli_num_rows($query_onlineplayers);

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Wer is gerade Online<img class="nav-icon" src="<?php echo theme_file("images/icons/online.png"); ?>" alt="Online Spieler" />
				 
				 </td>
			   </tr>
			   <tr>
			     <td class="body3-body">
				 
				     <table class="location-info" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="location-info-img">
						  
						  <img src="<?php echo theme_file("images/icons/info.png"); ?>" alt="Információ" />
						  
						  </td>
						  <td class="location-info-text">
						  
						  Hier können Sie die Spieler sehen die gerade auf dem Server Online sind.
						  
						  </td>
						</tr>
					</table>
					
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center" colspan="4">Online Spieler: <b><?php echo $rows_onlineplayers; ?> / <?php echo $wam_max_players; ?></b></td>
				   </tr>
				 </table>
					
					<?php
					
					if($rows_onlineplayers != 0){
					
						echo '
						<table class="body6" cellspacing="0" cellpadding="0">
						  <tr>
							<td>Name</td>
							<td>Rase</td>
							<td>Klasse</td>
							<td>Level</td>
						  </tr>'
						  ;
						
						// Arten und aufgrund von Kastenzugehörigkeit Bildtransformation
						while($results_onlineplayers = mysqli_fetch_array($query_onlineplayers)){
						
							 $results_onlineplayers_race = '<img src="wam-images/'.$results_onlineplayers["race"].'-'.$results_onlineplayers["gender"].'.gif" alt="" />';
							 $results_onlineplayers_class = '<img src="wam-images/'.$results_onlineplayers["class"].'.gif" alt="" />';
							
							echo "<tr><td><b>".$results_onlineplayers["name"]."</b></td><td><b>".$results_onlineplayers_race."</b></td><td><b>".$results_onlineplayers_class ."</b></td><td><b>".$results_onlineplayers["level"]."</b></td>";
						
						}

						echo "</table>";
					
					}
					
					?>
				 
				 </td>
			   </tr>
			 </table>