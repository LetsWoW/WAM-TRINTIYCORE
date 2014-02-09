<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Der Anschluss an das Zeichen Datenbank
db_select($mysql_db_characters);

// Charaktere anfordern
$query_mycharacters = db_query("SELECT guid, name, race, class, gender, level FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");
$rows_mycharacters = mysqli_num_rows($query_mycharacters);

// Senden prüfen
if(!empty($_POST)){

	// Das Charakter des Besitzers des Check
	character_check($site_get_cid);

	// Überprüfung der Beendigung der Eingänge (Teleport)
	if($_POST["teleport"] != ""){

		switch($_POST["location"]){

			case 1:
			$mycharacters_location_x = "-1838.323486";
			$mycharacters_location_y = "5445.184570";
			$mycharacters_location_z = "-12.427721";
			$mycharacters_location_map = "530";
			$mycharacters_location_orientation = "4.223825";
			break;

			case 2:
			$mycharacters_location_x = "1629.36";
			$mycharacters_location_y = "-4373.39";
			$mycharacters_location_z = "31.2564";
			$mycharacters_location_map = "1";
			$mycharacters_location_orientation = "3.54839";
			break;

			case 3:
			$mycharacters_location_x = "-8833.38";
			$mycharacters_location_y = "628.628";
			$mycharacters_location_z = "94.0066";
			$mycharacters_location_map = "0";
			$mycharacters_location_orientation = "1.06535";
			break;

			case 4:
			$mycharacters_location_x = "5804.15";
			$mycharacters_location_y = "624.771";
			$mycharacters_location_z = "647.767";
			$mycharacters_location_map = "571";
			$mycharacters_location_orientation = "1.64";
			break;

			case 5:
			$mycharacters_location_x = "-1277.37";
			$mycharacters_location_y = "124.804";
			$mycharacters_location_z = "131.287";
			$mycharacters_location_map = "1";
			$mycharacters_location_orientation = "5.22274";
			break;

			case 6:
			$mycharacters_location_x = "-4918.88";
			$mycharacters_location_y = "-940.406";
			$mycharacters_location_z = "501.564";
			$mycharacters_location_map = "0";
			$mycharacters_location_orientation = "5.42347";
			break;

			case 7:
			$mycharacters_location_x = "9949.56";
			$mycharacters_location_y = "2284.21";
			$mycharacters_location_z = "1341.4";
			$mycharacters_location_map = "1";
			$mycharacters_location_orientation = "1.59587";
			break;

			case 8:
			$mycharacters_location_x = "-3965.7";
			$mycharacters_location_y = "-11653.6";
			$mycharacters_location_z = "-138.844";
			$mycharacters_location_map = "530";
			$mycharacters_location_orientation = "0.852154";
			break;

			case 9:
			$mycharacters_location_x = "9487.69";
			$mycharacters_location_y = "-7279.2";
			$mycharacters_location_z = "14.2866";
			$mycharacters_location_map = "530";
			$mycharacters_location_orientation = "6.16478";
			break;

			case 10:
			$mycharacters_location_x = "1584.07";
			$mycharacters_location_y = "241.987";
			$mycharacters_location_z = "-52.1534";
			$mycharacters_location_map = "0";
			$mycharacters_location_orientation = "0.049647";
			break;

			default:
			$mycharacters_location_x = "-1838.323486";
			$mycharacters_location_y = "5445.184570";
			$mycharacters_location_z = "-12.427721";
			$mycharacters_location_map = "530";
			$mycharacters_location_orientation = "4.223825";
			break;

		}

		db_query("UPDATE characters SET position_x = '".$mycharacters_location_x."', position_y = '".$mycharacters_location_y."', position_z = '".$mycharacters_location_z."', map = '".$mycharacters_location_map."', orientation ='".$mycharacters_location_orientation."' WHERE guid = '".$site_get_cid."'");

	}

	// Überprüfung der Beendigung der Eingänge (Revive)
	if($_POST["revive"] != ""){

		db_query("DELETE FROM character_aura WHERE guid = '".$site_get_cid."' AND spell = '8326'");
		db_query("DELETE FROM character_aura WHERE guid = '".$site_get_cid."' AND spell = '20584'");
		db_query("DELETE FROM character_aura WHERE guid = '".$site_get_cid."' AND spell = '9036'");
		db_query("DELETE FROM corpse WHERE player = '".$site_get_cid."'");

	}

		system_message("Erfolgreich aktualisiert!");

}

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Meine Charaktere<img class="nav-icon" src="<?php echo theme_file("images/icons/characters.png"); ?>" alt="Meine Charaktere" />
				 
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
						  
						  Hier können Sie ihren eigenen karaktereidet wem gehören verschiedenen Operationen. Wenn dein Charakter in einen Teleport-Funktion stecken soll, sparen Sie.
						  
						  </td>
						</tr>
					</table>
					
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
					    <td align="center" colspan="5">Anzahl ihrer Characteren: <b><?php echo $rows_mycharacters; ?></b></td>
				   </tr>
				 </table>
				 
				 <?php
				 
				 if($rows_mycharacters != 0){
				 
					 echo '
						
						<table class="body6" cellspacing="0" cellpadding="0">
						
						';
						
						if(!empty($site_get_action)){
						
							echo '<form action="?id=my-characters&cid='.$site_get_cid.'" method="POST">';
							
								switch($site_get_action){
								
								case "teleport":
								echo '<tr class="show"><td colspan="5" align="center"><b>'.$site_get_name.'</b> telepotieren nach: <select name="location"><option value="1">Shattrath</option><option value="4">Dalaran</option><option value="1">-------------</option><option value="2">Orgrimmar</option><option value="5">Thunder Bluff</option><option value="9">Silvermoon City</option><option value="10">Undercity</option><option value="1">-------------</option><option value="3">Stormwind</option><option value="6">Ironforge</option><option value="7">Darnassus</option><option value="8">Exodar</option></select> <input type="hidden" value="'.$site_get_cid.'" name="teleport" /><input class="input-sbm" type="submit" value="bestätigen" /></td></tr>';
								break;
								
								case "revive":
								echo '<tr class="show"><td colspan="5" align="center">Wollen Sie wirklich ihren Charackter <b>'.$site_get_name.'</b> wiederbeleben? <input type="hidden" value="'.$site_get_cid.'" name="revive" /><input class="input-sbm" type="submit" value="Wiederbeleben" /></td></tr>';
								break;
								
							}
							
							echo '</form>';
							
						}
						
						echo '
						
						  <tr>
							<td>Name</td>
							<td>Rasse</td>
							<td>Klasse</td>
							<td>Level</td>
							<td>Operations</td>
						  </tr>
						  
						  ';
						
						while($results_mycharacters = mysqli_fetch_array($query_mycharacters)){
						
							// Arten und aufgrund von Kastenzugehörigkeit Bildtransformation
							 $results_mycharacters_race = '<img src="wam-images/'.$results_mycharacters["race"].'-'.$results_mycharacters["gender"].'.gif" alt="" />';
							 $results_mycharacters_class = '<img src="wam-images/'.$results_mycharacters["class"].'.gif" alt="" />';
							
							echo "<tr><td><b>".$results_mycharacters["name"]."</b></td><td><b>".$results_mycharacters_race."</b></td><td><b>".$results_mycharacters_class."</b></td><td><b>".$results_mycharacters["level"]."</b></td><td><b><a href='?id=my-characters&act=teleport&name=".$results_mycharacters["name"]."&cid=".$results_mycharacters["guid"]."'>Teleport</a> / <a href='?id=my-characters&act=revive&name=".$results_mycharacters["name"]."&cid=".$results_mycharacters["guid"]."'>Wiederbeleben</a></td></tr>";
							
						}
						
					}
					
					?>

					</table>
				 
				 </td>
			   </tr>
			 </table>