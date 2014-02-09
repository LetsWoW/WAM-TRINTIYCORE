<?php

// File Check
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Der Anschluss an das Zeichen Datenbank
db_select($mysql_db_characters);

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Rangliste<img class="nav-icon" src="<?php echo theme_file("images/icons/rank-star.png"); ?>" alt="Ranglisták" />
				 
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
						  
						  Hier sehen sie eine Rangliste mit verschiedenen Kategorien.
						  
						  </td>
						</tr>
					</table>
					
					<table class="body6" cellspacing="0" cellpadding="0">
					  <tr class="body6-top">
					    <td colspan="7">
					     Gold
					    </td>
					  </tr>
					  <tr>
					    <td width="60">Rang</td>
						<td>Name</td>
						<td>Gold</td>
						<td>Rasse</td>
						<td>Klasse</td>
						<td>Level</td>
						<td>Status</td>
					  </tr>
					
					<?php
					
					// Charaktere anfordern
					$query_money = db_query("SELECT name, race, class, gender, level, money, online FROM characters ORDER BY money DESC LIMIT 10");
					
					$top_rank = 1;
					
					// Arten und aufgrund von Kastenzugehörigkeit Bildtransformation
					while($results_topmoney = mysqli_fetch_array($query_money)){
						
						$results_topmoney_final = $results_topmoney["money"] / 10000;
						
						 switch($results_topmoney["online"]){
						 
							 case 0:
							 $results_topmoney_status = '<font color="red">Offline</font>';
							 break;
							 
							 case 1:
							 $results_topmoney_status = '<font color="green">Online</font>';
							 break;
							 
							 default:
							 $results_topmoney_status = '???';
							 break;
							 
						 }
						
						 $results_topmoney_race = '<img src="wam-images/'.$results_topmoney["race"].'-'.$results_topmoney["gender"].'.gif" alt="" />';
						 $results_topmoney_class = '<img src="wam-images/'.$results_topmoney["class"].'.gif" alt="" />';
						
						echo '<tr><td><b>'.$top_rank++.'.</b></td><td><b>'.$results_topmoney["name"].'</b></td><td class="top-rank"><b>'.$results_topmoney_final.'</b></td><td><b>'.$results_topmoney_race.'</b></td><td><b>'.$results_topmoney_class .'</b></td><td><b>'.$results_topmoney["level"].'</b></td><td><b>'.$results_topmoney_status.'</b></td>';
						
					}
					
					?>

					</table>
					<br />
					<table class="body6" cellspacing="0" cellpadding="0">
					  <tr class="body6-top">
					    <td colspan="7">
					     Kills
					    </td>
					  </tr>
					  <tr>
					    <td width="60">Rang</td>
						<td>Name</td>
						<td>Kill</td>
						<td>Rasse</td>
						<td>Klasse</td>
						<td>Level</td>
						<td>Status</td>
					  </tr>
					
					<?php

					// Charaktere anfordern
					$query_topkill = db_query("SELECT name, race, class, gender, level, totalKills, online FROM characters ORDER BY totalKills DESC LIMIT 10");
					
					$top_rank = 1;
					
					// Arten und aufgrund von Kastenzugehörigkeit Bildtransformation
					while($results_topkill = mysqli_fetch_array($query_topkill)){
					
						 switch($results_topkill["online"]){
							 
							 case 0:
							 $results_topkill_status = '<font color="red">Offline</font>';
							 break;
							 
							 case 1:
							 $results_topkill_status = '<font color="green">Online</font>';
							 break;
							 
							 default:
							 $results_topkill_status = '???';
							 break;
							 
						 }
						
						 $results_topkill_race = '<img src="wam-images/'.$results_topkill["race"].'-'.$results_topkill["gender"].'.gif" alt="" />';
						 $results_topkill_class = '<img src="wam-images/'.$results_topkill["class"].'.gif" alt="" />';
						
						echo '<tr><td><b>'.$top_rank++.'.</b></td><td><b>'.$results_topkill["name"].'</b></td><td class="top-rank"><b>'.$results_topkill["totalKills"].'</b></td><td><b>'.$results_topkill_race.'</b></td><td><b>'.$results_topkill_class .'</b></td><td><b>'.$results_topkill["level"].'</b></td><td><b>'.$results_topkill_status.'</b></td>';
						
					}
					
					?>

					</table>
					<br />
					<table class="body6" cellspacing="0" cellpadding="0">
					  <tr class="body6-top">
					    <td colspan="7">
					     HP
					    </td>
					  </tr>
					  <tr>
					    <td width="60">Rang</td>
						<td>Name</td>
						<td>HP</td>
						<td>Rasse</td>
						<td>Klasse</td>
						<td>Level</td>
						<td>Status</td>
					  </tr>
					
					<?php
					
					// Charaktere anfordern
					$query_tophp = db_query("SELECT name, race, class, gender, level, health, online FROM characters ORDER BY health DESC LIMIT 10");
					
					$top_rank = 1;
					
					// Arten und aufgrund von Kastenzugehörigkeit Bildtransformation
					while($results_tophp = mysqli_fetch_array($query_tophp)){
						
						 switch($results_tophp["online"]){
							 
							 case 0:
							 $results_tophp_status = '<font color="red">Offline</font>';
							 break;
							 
							 case 1:
							 $results_tophp_status = '<font color="green">Online</font>';
							 break;
							 
							 default:
							 $results_tophp_status = '???';
							 break;
							 
						 }
						
						 $results_tophp_race = '<img src="wam-images/'.$results_tophp["race"].'-'.$results_tophp["gender"].'.gif" alt="" />';
						 $results_tophp_class = '<img src="wam-images/'.$results_tophp["class"].'.gif" alt="" />';
						
						echo '<tr><td><b>'.$top_rank++.'.</b></td><td><b>'.$results_tophp["name"].'</b></td><td class="top-rank"><b>'.$results_tophp["health"].'</b></td><td><b>'.$results_tophp_race.'</b></td><td><b>'.$results_tophp_class .'</b></td><td><b>'.$results_tophp["level"].'</b></td><td><b>'.$results_tophp_status.'</b></td>';
						
					}
					
					?>

					</table>
					<br />
					<table class="body6" cellspacing="0" cellpadding="0">
					  <tr class="body6-top">
					    <td colspan="7">
					     Ehre
					    </td>
					  </tr>
					  <tr>
					    <td width="60">Rang</td>
						<td>Name</td>
						<td>Ehre</td>
						<td>Rasse</td>
						<td>Klasse</td>
						<td>Level</td>
						<td>Status</td>
					  </tr>
					
					<?php
					
					// Charaktere anfordern
					$query_tophonor = db_query("SELECT name, race, class, gender, level, totalHonorPoints, online FROM characters ORDER BY totalHonorPoints DESC LIMIT 10");
					
					$top_rank = 1;
					
					// Arten und aufgrund von Kastenzugehörigkeit Bildtransformation
						while($results_tophonor = mysqli_fetch_array($query_tophonor)){
						
						 switch($results_tophonor["online"]){
							 
							 case 0:
							 $results_tophonor_status = '<font color="red">Offline</font>';
							 break;
							 
							 case 1:
							 $results_tophonor_status = '<font color="green">Online</font>';
							 break;
							 
							 default:
							 $results_tophonor_status = '???';
							 break;
							 
						 }
						
						 $results_tophonor_race = '<img src="wam-images/'.$results_tophonor["race"].'-'.$results_tophonor["gender"].'.gif" alt="" />';
						 $results_tophonor_class = '<img src="wam-images/'.$results_tophonor["class"].'.gif" alt="" />';
						
						echo '<tr><td><b>'.$top_rank++.'.</b></td><td><b>'.$results_tophonor["name"].'</b></td><td class="top-rank"><b>'.$results_tophonor["totalHonorPoints"].'</b></td><td><b>'.$results_tophonor_race.'</b></td><td><b>'.$results_tophonor_class .'</b></td><td><b>'.$results_tophonor["level"].'</b></td><td><b>'.$results_tophonor_status.'</b></td>';
					
					}
					
					?>

					</table>
					<br />
					<table class="body6" cellspacing="0" cellpadding="0">
					  <tr class="body6-top">
					    <td colspan="7">
					     AP (Arena punkte)
					    </td>
					  </tr>
					  <tr>
					    <td width="60">Rang</td>
						<td>Name</td>
						<td>AP</td>
						<td>Rasse</td>
						<td>Klasse</td>
						<td>Level</td>
						<td>Status</td>
					  </tr>
					
					<?php
					
					// Charaktere anfordern
					$query_toparena = db_query("SELECT name, race, class, gender, level, arenaPoints, online FROM characters ORDER BY arenaPoints DESC LIMIT 10");
					
					$top_rank = 1;
					
					// Arten und aufgrund von Kastenzugehörigkeit Bildtransformation
					while($results_toparena = mysqli_fetch_array($query_toparena)){
						
						 switch($results_toparena["online"]){
						 
							 case 0:
							 $results_toparena_status = '<font color="red">Offline</font>';
							 break;
							 
							 case 1:
							 $results_toparena_status = '<font color="green">Online</font>';
							 break;
							 
							 default:
							 $results_toparena_status = '???';
							 break;
						 
						 }
						
						 $results_toparena_race = '<img src="wam-images/'.$results_toparena["race"].'-'.$results_toparena["gender"].'.gif" alt="" />';
						 $results_toparena_class = '<img src="wam-images/'.$results_toparena["class"].'.gif" alt="" />';
						
						echo '<tr><td><b>'.$top_rank++.'.</b></td><td><b>'.$results_toparena["name"].'</b></td><td class="top-rank"><b>'.$results_toparena["arenaPoints"].'</b></td><td><b>'.$results_toparena_race.'</b></td><td><b>'.$results_toparena_class .'</b></td><td><b>'.$results_toparena["level"].'</b></td><td><b>'.$results_toparena_status.'</b></td>';
						
					}
					
					?>

					</table>
				 
				 </td>
			   </tr>
			 </table>