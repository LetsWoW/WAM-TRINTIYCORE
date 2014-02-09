<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged,vip,vipmodule,addlevel");

// Der Anschluss an das Zeichen Datenbank
db_select($mysql_db_characters);

// Charaktere anfordern
$query_addlevel_characters = db_query("SELECT guid, name, level FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Überprüfen der Fertigstellung der Eingänge
if(!empty($_POST["mycharacter"])){

	// Posztolt Datenkonvertierung
	$post_addlevel_mycharacter = variable($_POST["mycharacter"], "", "db");

	// Inputok ellenõrzése
	string_check($post_addlevel_mycharacter, 32, ">", "Die Character-Feld auf false gesetzt!");
	string_check($post_addlevel_mycharacter, "^[0-9%]+$", "!erorr", "Die Character-Feld auf false gesetzt!");

	// Der Charakter des Besitzers des Check
	character_check($post_addlevel_mycharacter);

	$query_addlevel_characters_check = db_query("SELECT level FROM characters WHERE guid = '".$post_addlevel_mycharacter."'");
	$results_addlevel_characters_check = mysqli_fetch_array($query_addlevel_characters_check);

	if($results_addlevel_characters_check["level"] > 9){

		system_message("Bereits über dem Level 10!");

	}

	// Level Update
	db_query("UPDATE characters SET level = '80' WHERE guid = '".$post_addlevel_mycharacter."'");

	system_message("Sie haben erfolgreich Ihr Level aktualisiert!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Nem választottál karaktert!" ); form.mycharacter.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Level addolás<img class="nav-icon" src="<?php echo theme_file("images/icons/rank.png"); ?>" alt="Szint addolás" />
				 
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
						  
						  Hier können Sie ihre Character auf Level 80 setzten aber nur charactere die unter Level 10 sind!
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=add-level" method="POST" onsubmit="return checkform(addlevel);" name="addlevel"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 character: <select name="mycharacter">
					 
					 <option SELECTED value="">Auswählen!</option>
					 
					 <?php
					 
					 while($results_addlevel_characters = mysqli_fetch_array($query_addlevel_characters)){
					 
					 echo '<option value="'.$results_addlevel_characters["guid"].'">'.$results_addlevel_characters["name"].' ('.$results_addlevel_characters["level"].')</option>';
					 
					 }
					 
					 ?>
					 
					 </select> <input type="submit" value="Speichern" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>