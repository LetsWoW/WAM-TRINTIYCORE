<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Der Anschluss an das Zeichen Datenbank
db_select($mysql_db_characters);

// Überprüfen der Fertigstellung der Eingänge
if(!empty($_POST["playername"])){

	// Posztolt Datenkonvertierung
	$post_playersearch_playername = variable($_POST["playername"], "" ,"db");

	// Überprüfen Daten Posztolt
	string_check($post_playersearch_playername, 12, ">", "Der Spieler isr zu lang!");
	string_check($post_playersearch_playername, 2, "<", "Bitte geben Sie mindestens 2 Zeichen ein!");

	// Email módosítása
	$query_playersearch_playername = db_query("SELECT name, race, class, gender, level, online FROM characters WHERE name LIKE '%".$post_playersearch_playername."%' ORDER BY name ASC");
	$rows_playersearch = mysqli_num_rows($query_playersearch_playername);

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.playername.value == "") { alert( "Haben Sie nicht füllen den Namen des Spielers Feld!" ); form.playername.focus(); return false; } else { if (form.playername.value.length < 2) { alert( "Bitte geben Sie mindestens 2 Zeichen ein!" ); form.playername.focus(); return false; } }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Spielersuche<img class="nav-icon" src="<?php echo theme_file("images/icons/search.png"); ?>" alt="Spielersuche" />
				 
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
						  
						  Gib dem Spieler suchen den Namen oder einen Teil des Namens eines.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=player-search" method="POST" onsubmit="return checkform(playersearch);" name="playersearch"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Spielernamen: <input name="playername" type="text" maxlength="12" /> <input type="submit" value="Suche" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 <?php
				 
				 // Überprüfen der Fertigstellung der Eingänge
                 if(!empty($post_playersearch_playername)){
				 
					 echo '
					 
					 <table cellspacing="0" cellpadding="0" class="body5">
					   <tr>
						 <td align="center" colspan="5">Eingegebene Zeichen \'<em>'.$post_playersearch_playername.'</em>\' Treffer: <b>'.$rows_playersearch.'</b></td>
					   </tr>
					 </table>
					 
					 ';
					 
					 if($rows_playersearch != 0){
						 
						 echo '
						 
						 <table class="body6" cellspacing="0" cellpadding="0">
							  <tr>
								<td>Name</td>
								<td>Rasse</td>
								<td>Klasse</td>
								<td>Level</td>
								<td>Status</td>
							  </tr>
							
							';
							
							// Arten und aufgrund von Kastenzugehörigkeit Bildtransformation
							while($results_playersearch = mysqli_fetch_array($query_playersearch_playername)){
							
								 $results_playersearch_race = '<img src="wam-images/'.$results_playersearch["race"].'-'.$results_playersearch["gender"].'.gif" alt="" />';
								 $results_playersearch_class = '<img src="wam-images/'.$results_playersearch["class"].'.gif" alt="" />';
								 
								 switch($results_playersearch["online"]){
								 
								 case 0:
								 $results_playersearch_status = '<font color="red">Offline</font>';
								 break;
								 
								 case 1:
								 $results_playersearch_status = '<font color="green">Online</font>';
								 break;
								 
								 default:
								 $results_playersearch_status = '???';
								 break;
								 
							 }
							
							echo "<tr><td><b>".$results_playersearch["name"]."</b></td><td><b>".$results_playersearch_race."</b></td><td><b>".$results_playersearch_class ."</b></td><td><b>".$results_playersearch["level"]."</b></td><td><b>".$results_playersearch_status."</b></td></tr>";
							
							}
							
							echo "</table>";
							
						}
						
					}
					
					?>
				 
				 </td>
			   </tr>
			 </table>