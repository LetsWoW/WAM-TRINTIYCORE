<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin");

// Überprüfen der Fertigstellung der Eingänge
if(!empty($_POST["accountname"])){

	// Posztolt Datenkonvertierung
	$post_accounttransaction_accountname = variable($_POST["accountname"], "strtoupper", "db");

	// Überprüfen Daten Posztolt
	string_check($post_playertransaction_playername, ">", 32, "Der Account name ist zu lang!");
	string_check($post_playertransaction_playername, "<", 3, "Der Account name ist zu kurz!");
	
	// Spieler steuert
	$query_accounttransaction_check = db_query("SELECT COUNT(*) FROM account WHERE username = '".$post_accounttransaction_accountname."'");
	$results_accounttransaction_check = mysqli_fetch_array($query_accounttransaction_check);

	if($results_accounttransaction_check[0] == 0){

		system_message("Angegebener Accountname existiert nicht!");

	}

	// Holen Sie Konto-ID
	$query_accounttransaction_account = db_query("SELECT id FROM account WHERE username = '".$post_accounttransaction_accountname."'");
	$results_accounttransaction_account = mysqli_fetch_array($query_accounttransaction_account);

	// Kontozugriff hinzufügen, wenn es nicht existiert
	if($site_post_action == "gmlevelvip" || $site_post_action == "gmlevelgm" || $site_post_action == "gmlevelmod" || $site_post_action == "gmleveladmin"){

		$query_accounttransaction_accountaccess = db_query("SELECT COUNT(*) FROM account_access WHERE id = '".$results_accounttransaction_account["id"]."'");
		$results_accounttransaction_accountaccess = mysqli_fetch_array($query_accounttransaction_accountaccess);

		if($results_accounttransaction_accountaccess[0] == 0){

			db_query("INSERT INTO account_access (id, gmlevel, RealmID) VALUES ('".$results_accounttransaction_account["id"]."', '0', '1')");

		}

	}

		// Führen Sie den Vorgang
		switch($site_post_action){

		// Account Löschen
		case "delete":
		db_query("DELETE FROM account WHERE id = '".$results_accounttransaction_account["id"]."'");

		// Der Anschluss an das Zeichen Datenbank
		db_select($mysql_db_characters);

		// Löschen von Zeichen aus ein Konto
		$query_accounttransaction_character = db_query("SELECT guid, name FROM characters WHERE account = '".$results_accounttransaction_account["id"]."'");

		while($results_accounttransaction_character = mysqli_fetch_array($query_accounttransaction_character)){

			db_query("DELETE FROM characters WHERE name = '".$results_accounttransaction_character["name"]."'");
			db_query("DELETE FROM arena_team_member WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_account_data WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_achievement WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_achievement_progress WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_action WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_aura WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_battleground_data WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_declinedname WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_equipmentsets WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_gifts WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_glyphs WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_homebind WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_inventory WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_queststatus WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_queststatus_daily WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_reputation WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_skills WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_social WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_spell WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_spell_cooldown WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM character_talent WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM corpse WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM pet_aura WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM pet_spell WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM pet_spell_cooldown WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM guild_member WHERE guid = '".$results_accounttransaction_character["guid"]."'");
			db_query("DELETE FROM item_instance WHERE owner_guid = '".$results_accounttransaction_character["guid"]."'");

		}

		break;

		// Bannen
		case "bann":
		db_query("INSERT INTO account_banned (id, bannedby, banreason) VALUES ('".$results_accounttransaction_account["id"]."', 'WAM', 'WAM')");
		break;

		// Bann entfernen
		case "unbann":
		db_query("DELETE FROM account_banned WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> Spieler
		case "gmlevelplayer":
		db_query("DELETE FROM account_access WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> VIP
		case "gmlevelvip":
		db_query("UPDATE account_access SET gmlevel = '".$wam_gmlevel_vip."' WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> Moderator
		case "gmlevelmod":
		db_query("UPDATE account_access SET gmlevel = '".$wam_gmlevel_mod."' WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> GM
		case "gmlevelgm":
		db_query("UPDATE account_access SET gmlevel = '".$wam_gmlevel_gm."' WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		// Rang --> Admin
		case "gmleveladmin":
		db_query("UPDATE account_access SET gmlevel = '".$wam_gmlevel_admin."' WHERE id = '".$results_accounttransaction_account["id"]."'");
		break;

		default:
		system_message("Ein fehler ist aufgetretten bitte versuche es erneut!");
		break;

	}

	system_message("Erfolgreich geändert!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.accountname.value == "") { alert( "Nem töltötted ki az account név mezõt!" ); form.accountname.focus(); return false; } else { if (form.accountname.value.length < 3) { alert( "Az account név túl rövid!" ); form.accountname.focus(); return false; } }
				 if (form.action.value == "") { alert( "Nem választottál mûveletet!" ); form.action.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Account Administration<img class="nav-icon" src="<?php echo theme_file("images/icons/cmd.png"); ?>" alt="Spieler Operationen" />
				 
				 </td>
			   </tr>
			   <tr>
			     <td class="body3-body">
				 
				     <table class="location-info" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="location-info-img">
						  
						  <img src="<?php echo theme_file("images/icons/info.png"); ?>" alt="Information" />
						  
						  </td>
						  <td class="location-info-text">
						  
						  Hier kann der Admin des Server die Accounts verwalten löschen bannen etc... einfach nur den zu änderden Account Namen eingeben.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=account-transaction" method="POST" onsubmit="return checkform(accountransaction);" name="accountransaction"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Account-Name: <input name="accountname" type="text" maxlength="32" /> <select name="action"><option value="" SELECTED>nix</option><option value="delete">Löschen</option><option value="bann">Bannen</option><option value="unbann">Entbannen</option><option value="gmlevelplayer">Rang --> Spieler</option><option value="gmlevelvip">Rang --> VIP</option><option value="gmlevelmod">Rang --> Moderator</option><option value="gmlevelgm">Rang -- > GM</option><option value="gmleveladmin">Rang --> Admin</option></select> <input type="submit" value="Speichern" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>