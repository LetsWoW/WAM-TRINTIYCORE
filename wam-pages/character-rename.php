<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged,vip,vipmodule,charrename");

// Der Anschluss an das Zeichen Datenbank
db_select($mysql_db_characters);

// Charaktere anfordern
$query_charrename_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Überprüfen der Fertigstellung der Eingänge
if(!empty($_POST["newname"]) && !empty($_POST["mycharacter"])){

	// Posztolt Datenkonvertierung
	$post_charrename_newname = variable($_POST["newname"], "strtolower,ucfirst", "db");
	$post_charrename_mycharacter = variable($_POST["mycharacter"], "", "db");
	
	// Prüfung der Verwendbarkeit ist
	$char_check_query = db_query("SELECT COUNT(*) FROM characters WHERE name = '".$post_charrename_newname."'");
	$char_check = mysqli_fetch_array($char_check_query);
	
	if($char_check[0] != 0){
	
		system_message("Dieser Name wird bereits von jemand anderem verwendet!");
	
	}

	// Inputok ellenõrzése
	string_check($post_charrename_newname, 12, ">", "Der neue Name ist zu lang!");
	string_check($post_charrename_newname, 2, "<", "Der neue Name ist zu kurz!");
	string_check($post_charrename_newname, "^[a-zA-Z%]+$", "!error", "Der neue Name enthält Zeichen, die nicht erlaubt sind!");
	string_check($post_charrename_mycharacter, "^[0-9%]+$", "!error", "Der Wert der schlechten Charakter Eingang!");
	string_check($post_charrename_mycharacter, 32, ">", "Die Character-Feld auf false gesetzt!");

	// Der Charakter des Besitzers des Check
	character_check($post_charrename_mycharacter);

	// aktualisieren Name
	db_query("UPDATE characters SET name = '".$post_charrename_newname."' WHERE guid = '".$post_charrename_mycharacter."'");

	system_message("Dein Character würde erfolgreich umbenannt!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Ein Zeichen wurde nicht ausgewählt!" ); form.mycharacter.focus(); return false; }
				 if (form.newname.value == "") { alert( "Es wurde kein neuer Name angegeben!" ); form.newname.focus(); return false; } else { if (form.newname.value.length < 2) { alert( "Der neue Name ist zu kurz!" ); form.newname.focus(); return false; } }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Charaktere Umbenennen<img class="nav-icon" src="<?php echo theme_file("images/icons/refresh.png"); ?>" alt="Charaktere Umbenennen" />
				 
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
						  
						  Wählen Sie das Zeichen, das Sie umbenennen möchten, geben Sie dann den neuen Namen. Stellen Sie sicher, dass der Name des Charakters kann nur Buchstaben des englischen Alphabets.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=character-rename" method="POST" onsubmit="return checkform(charrename);" name="charrename"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Character: <select name="mycharacter">
					 
					 <option SELECTED value="">Auswählen!</option>
					 
					 <?php
					 
					 while($results_charrename_characters = mysqli_fetch_array($query_charrename_characters)){
					 
						 echo '<option value="'.$results_charrename_characters["guid"].'">'.$results_charrename_characters["name"].'</option>';
						 
					 }
					 
					 ?>
					 
					 </select> Neuer Name: <input maxlength="12" type="text" name="newname" /> <input type="submit" value="Umbenennen" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>