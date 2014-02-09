<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged,notbanned");

// Der Anschluss an das Charaktere Datenbank
db_select($mysql_db_characters);

// Charaktere anfordern
$query_chartrans_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Überprüfen der Fertigstellung der Eingänge
if(!empty($_POST["account"]) && !empty($_POST["mycharacter"])){

	// Posztolt Datenkonvertierung
	$post_chartrans_account = variable($_POST["account"], "", "db");
	$post_chartrans_mycharacter = variable($_POST["mycharacter"], "", "db");

	// Inputok ellenõrzése
	string_check($post_chartrans_account, 32, ">", "Der Account name ist zu lang!");
	string_check($post_chartrans_mycharacter, 32, ">", "Der Wert der schlechten Charakter Eingang!");
	string_check($post_chartrans_mycharacter, "^[0-9%]+$", "!error", "Der Wert der schlechten Charakter Eingang!");

	// Der Charakter des Besitzers des Check
	character_check($post_chartrans_mycharacter);

	// Verbindung mit der Datenbank RealMod
	db_select($mysql_db_realmd);

	// Account Datenabfrage
	$query_chartrans_account = db_query("SELECT id FROM account WHERE username = '".$post_chartrans_account."'");
	$results_chartrans_account = mysqli_fetch_array($query_chartrans_account);

	if(mysqli_num_rows($query_chartrans_account) == 0){

		system_message("Der eingegebene Accountname existiert nicht!");

	}

	// Der Anschluss an das Charaktere Datenbank
	db_select($mysql_db_characters);

	// Charaktertransfer
	db_query("UPDATE characters SET account = '".$results_chartrans_account["id"]."' WHERE guid = '".$post_chartrans_mycharacter."'");

	// Logging Charakter Transfers
	site_log("character-transfer", "IP: ".$site_ip." | Besitzer account: ".$user_check_accountname." | Character: ".$results_chartrans_check_account["name"]." | Konto (wo er): ".$post_chartrans_account." | Datum: ".$site_date."");

	system_message("Erfolgreich, Der Character wurde transferiert!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Nicht ausgewählt ein Zeichen!" ); form.mycharacter.focus(); return false; }
				 if (form.account.value == "") { alert( "Der Account haben keine!" ); form.account.focus(); return false; } else { if (form.account.value.length < 3) { alert( "Account Name ist zu kurz!" ); form.account.focus(); return false; } }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Charaktertransfer<img class="nav-icon" src="<?php echo theme_file("images/icons/transfer.png"); ?>" alt="Charaktertransfer" />
				 
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
						  
						  Hier kann man ein Chartransfer durchführen einfach Chars auswählen und den Accountname eingeben wohin der char transferiert werden soll.
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=character-transfer" method="POST" onsubmit="return checkform(chartrans);" name="chartrans"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Charakter: <select name="mycharacter">
					 
					 <option SELECTED value="">Auswählen!</option>
					 
					 <?php
					 
					 while($results_chartrans_characters = mysqli_fetch_array($query_chartrans_characters)){
					 
					 echo '<option value="'.$results_chartrans_characters["guid"].'">'.$results_chartrans_characters["name"].'</option>';
					 
					 }
					 
					 ?>
					 
					 </select> Account name: <font class="mini"><a title="Der Rechnung wird dies ein Zeichen sein" href="#">[?]</a></font> <input maxlength="32" type="text" name="account" /> <input type="submit" value="Transferieren" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>