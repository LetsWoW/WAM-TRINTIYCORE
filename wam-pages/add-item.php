<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged,vip,vipmodule,additem");

// Der Anschluss an das Zeichen Datenbank
db_select($mysql_db_characters);

// Charaktere anfordern
$query_additem_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Überprüfen der Fertigstellung der Eingänge
if(!empty($_POST["itemid"]) && !empty($_POST["mycharacter"])){

	// Posztolt Datenkonvertierung
	$post_additem_itemid = variable($_POST["itemid"], "", "db");
	$post_additem_mycharacter = variable($_POST["mycharacter"], "", "db");
	$post_additem_count = variable($_POST["count"], "", "db");

	// Überprüfen der Eingabe
	string_check($post_additem_itemid, "^[0-9%]+$", "!error", "Item-id nicht gefunden!");
	string_check($post_additem_itemid, 10, ">", "Item id zu land!");
	string_check($post_additem_count, "^[0-9%]+$", "!error", "Bitte nur Zahlen als Item id angeben!");
	string_check($post_additem_count, 1, ">", "A darabszámtúl hosszú (kann ich nicht übersetzten)!");
	string_check($post_additem_mycharacter, "^[0-9%]+$", "!error", "Accountname nicht gefunden!");
	string_check($post_additem_mycharacter, 32, ">", "Der Wert der schlechten Charakter Eingang!");

	// Der Charakter des Besitzers des Check
	character_check($post_additem_mycharacter);

	// Verbindung mit der Datenbank Welt
	db_select($mysql_db_world);

	// Item wird überprüft
	$query_additem_check_item = db_query("SELECT COUNT(*) FROM item_template WHERE entry = '".$post_additem_itemid."'");
	$results_additem_check_item = mysqli_fetch_array($query_additem_check_item);
	
	if($results_additem_check_item[0] == 0){

		system_message("Das Item wurde nicht in der Datenbank gefunden! (".$post_additem_itemid.")");

	}

	// Der Anschluss an das Zeichen Datenbank
	db_select($mysql_db_characters);

	// ITEM GESENDET, Ingame Mail

	// 1. Schritt
	// Den maximalen Wert der ID anfordern
	$query_additem_step1 = db_query("SELECT MAX(guid) FROM item_instance");
	$results_additem_step1 = mysqli_fetch_array($query_additem_step1);
	$additem_id_step1 = $results_additem_step1[0] + 1;

	// Schreibe neue Stelle
	db_query("INSERT INTO item_instance (guid, owner_guid, data) VALUES (".$additem_id_step1.", '".$post_additem_mycharacter."', '".$additem_id_step1." 1073741824 3 ".$post_additem_itemid." 1065353216 0 24 0 0 0 0 0 0 0 ".$post_additem_count." 0 4294967295 0 0 0 0 64 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 500 0 0 ')");

	// 2. Schritt
	// Den maximalen Wert der ID anfordern
	$query_additem_step2 = db_query("SELECT MAX(id) FROM mail");
	$results_additem_step2 = mysqli_fetch_array($query_additem_step2);
	$additem_id_step2 = $results_additem_step2[0] + 1;

	// Schreibe neue Stelle
	db_query("INSERT INTO `mail` (`id`, `messageType`, `stationery`, `mailTemplateId`, `sender`, `receiver`, `subject`, `itemTextId`, `has_items`, `expire_time`, `deliver_time`, `money`, `cod`, `checked`) VALUES
	(".$additem_id_step2.", 0, 41, 0, 0, ".$post_additem_mycharacter.", 'WAM - VIP ITEM', 0, 1, 0, 0, 0, 0, 0)");

	// 3. Schritt
	// Schreibe neue Stelle
	db_query("INSERT INTO `mail_items` (`mail_id`, `item_guid`, `item_template`, `receiver`) VALUES
	(".$additem_id_step2.", ".$additem_id_step1.", ".$post_additem_itemid.", ".$post_additem_mycharacter.")");

	// Erstellen Sicherheitsüberwachung (Item senden)
	site_log("add-item", "IP: ".$site_ip." | Account name: ".$user_check_accountname." | Charakter ID: ".$post_additem_mycharacter." | Item Menge: ".$post_additem_count." | Datum: ".$site_date."");
	
	system_message("Ihre Anfrage wurde erfolgreich erstellt, das Item würde ihnen Ingame zugestellt!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Nem választottál karaktert!" ); form.mycharacter.focus(); return false; }
				 if (form.itemid.value == "") { alert( "Nem adtad meg az item ID-jét!" ); form.itemid.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Item senden<img class="nav-icon" src="<?php echo theme_file("images/icons/ipod.png"); ?>" alt="Item senden" />
				 
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
						  
						  Hier können Sie sich Ingame Items senden einfach gewünschten character wählen item id eingeben und ihnen wird das Item per Ingame Brief zugestellt.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=add-item" method="POST" onsubmit="return checkform(additem);" name="additem"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Character: <select name="mycharacter">
					 
					 <option SELECTED value="">Auswählen!</option>
					 
					 <?php
					 
					 while($results_additem_characters = mysqli_fetch_array($query_additem_characters)){
					 
					 echo '<option value="'.$results_additem_characters["guid"].'">'.$results_additem_characters["name"].'</option>';
					 
					 }
					 
					 ?>
					 
					 </select> Item ID: <input maxlength="10" type="text" name="itemid" /> Anzahl diegesendet wird: <select name="count"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select> <input type="submit" value="Senden" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>