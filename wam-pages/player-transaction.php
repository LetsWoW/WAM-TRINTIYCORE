<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin");

// Der Anschluss an das Zeichen Datenbank
db_select($mysql_db_characters);

// Überprüfen der Fertigstellung der Eingänge
if(!empty($_POST["playername"])){

	// Posztolt Datenkonvertierung
	$post_playertransaction_playername = variable($_POST["playername"], "", "db");

	// Überprüfen Daten Posztolt
	string_check($post_playertransaction_playername, 32, ">", "Der Spieler Name ist zu lang!");

	// Spieler steuert
	$query_playertransaction_check = db_query("SELECT COUNT(*) FROM characters WHERE name = '".$post_playertransaction_playername."'");
	$results_playertransaction_check = mysqli_fetch_array($query_playertransaction_check);
	if($results_playertransaction_check[0] == 0){

		system_message("Der Gesuchte Spieler würde nicht gefunden!");

	}

	// Führen Sie den Vorgang
	switch($site_post_action){

		// Löscht das Zeichen
		case "delete":

		// Holen Sie sich guid
		$query_playertransaction_guid = db_query("SELECT guid, name FROM characters WHERE name = '".$post_playertransaction_playername."'");
		$results_playertransaction_guid = mysqli_fetch_array($query_playertransaction_guid);

		db_query("DELETE FROM characters WHERE name = '".$results_playertransaction_guid["name"]."'");
		db_query("DELETE FROM arena_team_member WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_account_data WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_achievement WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_achievement_progress WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_action WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_aura WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_battleground_data WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_declinedname WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_equipmentsets WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_gifts WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_glyphs WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_homebind WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_inventory WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_queststatus WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_queststatus_daily WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_reputation WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_skills WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_social WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_spell WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_spell_cooldown WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM character_talent WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM corpse WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM pet_aura WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM pet_spell WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM pet_spell_cooldown WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM guild_member WHERE guid = '".$results_playertransaction_guid["guid"]."'");
		db_query("DELETE FROM item_instance WHERE owner_guid = '".$results_playertransaction_guid["guid"]."'");

		break;

		// Zero-Ebene
		case "level":
		db_query("UPDATE characters SET level = '1' WHERE name = '".$post_playertransaction_playername."'");
		break;

		// Zero Geld
		case "money":
		db_query("UPDATE characters SET money = '0' WHERE name = '".$post_playertransaction_playername."'");
		break;

		default:
		system_message("Ein Fehler ist aufgetretten!");
		break;

	}

	system_message("Erfolgreicher Abschluss der Operation!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.playername.value == "") { alert( "Haben Sie nicht füllen den Namen des Spielers Feld!" ); form.playername.focus(); return false; } else { if (form.playername.value.length < 2) { alert( "Der Spieler name ist zu kurz!" ); form.playername.focus(); return false; } }
				 if (form.action.value == "") { alert( "Operation nicht ausgewählt!" ); form.action.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Spieler Optionen<img class="nav-icon" src="<?php echo theme_file("images/icons/cmd.png"); ?>" alt="Spieler Operationen" />
				 
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
						  
						  Geben Sie den Character namen ein um die Optionen zu benutzten. (kleine anmerkung von mir also das was man hier machen kann verstehe ich selber nicht
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=player-transaction" method="POST" onsubmit="return checkform(playertransaction);" name="playertransaction"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Spieler name: <input name="playername" type="text" maxlength="32" /> <select name="action"><option value="" SELECTED>???</option><option value="delete">Löschen</option><option value="level">Ebene</option><option value="money">Gold</option></select> <input type="submit" value="Speichern" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>