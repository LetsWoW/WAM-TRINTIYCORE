<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged,vip,vipmodule,addmoney");

// Der Anschluss an das Zeichen Datenbank
db_select($mysql_db_characters);

// Charaktere anfordern
$query_addmoney_characters = db_query("SELECT guid, name FROM characters WHERE account = '".$user_check_accountid."' ORDER BY name ASC");

// Überprüfen der Fertigstellung der Eingänge
if(!empty($_POST["money"]) && !empty($_POST["mycharacter"])){

	// Posztolt Datenkonvertierung
	$post_addmoney_money = variable($_POST["money"], "", "db");
	$post_addmoney_mycharacter = variable($_POST["mycharacter"], "", "db");

	// Inputok ellenõrzése
	string_check($post_addmoney_money, "^[0-9%]+$", "!error", "Ein Fehler ist in der Höhe von Gold!");
	string_check($post_addmoney_money, 5, ">", "Soviel Gold kann man nicht senden!");
	string_check($post_addmoney_mycharacter, "^[0-9%]+$", "!error", "Der Wert der schlechten Charakter Eingang!");
	string_check($post_addmoney_mycharacter, 32, ">", "Der Wert der schlechten Charakter Eingang!");

	// Der Charakter des Besitzers des Check
	character_check($post_addmoney_mycharacter);
	
	// Holen Sie sich die aktuellen Gold wert
	$query_addmoney_money = db_query("SELECT money FROM characters WHERE guid = '".$post_addmoney_mycharacter."'");
	$results_addmoney_money = mysqli_fetch_array($query_addmoney_money);

	$post_addmoney_money = $post_addmoney_money * 10000;
	$post_addmoney_money_final = $post_addmoney_money + $results_addmoney_money["money"];

	// Gold aktualisieren
	db_query("UPDATE characters SET money = '".$post_addmoney_money_final."' WHERE guid = '".$post_addmoney_mycharacter."'");

	system_message("Sie haben erfolgreich Ihr Gold gesendet!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.mycharacter.value == "") { alert( "Nem választottál karaktert!" ); form.mycharacter.focus(); return false; }
				 if (form.money.value == "") { alert( "Nem adtad meg az aranyat!" ); form.money.focus(); return false; }
				 return true ;
				 }
				 </script>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Gold senden<img class="nav-icon" src="<?php echo theme_file("images/icons/coins.png"); ?>" alt="Pénz addolás" />
				 
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
						  
						  Hier können Sie sich gold senden!
						  
						  </td>
						</tr>
					</table>
					
				 <form action="?id=add-money" method="POST" onsubmit="return checkform(addmoney);" name="addmoney"> 
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Character: <select name="mycharacter">
					 
					 <option SELECTED value="">Auswählen!</option>
					 
					 <?php
					 
			        while($results_addmoney_characters = mysqli_fetch_array($query_addmoney_characters)){
					 
						 echo '<option value="'.$results_addmoney_characters["guid"].'">'.$results_addmoney_characters["name"].'</option>';
						 
					}
					 
					 ?>
					 
					 </select> Gold: <input maxlength="5" type="text" name="money" /> <input type="submit" value="Senden" class="input-sbm" />
				     </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>