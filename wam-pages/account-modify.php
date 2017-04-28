<?php

// Datei Pr�fen
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// �berpr�fung der Form die gesendet wird
if(!empty($_POST)){

	// �berpr�fung der Beendigung der Eingabe (Passwort)
	if(!empty($_POST["newpassword"]) && !empty($_POST["newpassword2"]) && !empty($_POST["password"])){

		// Datenkonvertierung
		$post_accountmodify_password = variable($_POST["password"], "strtoupper", "db");
		$post_accountmodify_newpassword = variable($_POST["newpassword"], "strtoupper", "db");
		$post_accountmodify_newpassword2 = variable($_POST["newpassword2"], "strtoupper", "normal");
		$accountmodify_password = sha_pass_hash($user_check_accountname, $post_accountmodify_password);
		$accountmodify_password_final = sha_pass_hash($user_check_accountname, $post_accountmodify_newpassword);

		if($accountmodify_password == $user_check_password){

			// Postolt �berpr�fung der Daten
			string_check($post_accountmodify_newpassword, $post_accountmodify_newpassword2, "!=", "Die eigebenen Passw�rter stimmen nicht �berein widerhole die eingabe!");
			string_check($post_accountmodify_newpassword, $user_check_accountname, "==", "Account Name und Passwort stimmen nicht �berein!");
			string_check($post_accountmodify_newpassword, 6, "<", "Das Passwort ist zu kurz!");
			string_check($post_accountmodify_newpassword, 32, ">", "Ihr Passwort ist zu lang!");
			string_check($post_accountmodify_newpassword, "^[0-9a-zA-Z%]+$", "!Error", "Das Passwort enth�lt Zeichen, die nicht erlaubt sind!");

			// Passwort �ndern
			db_query("UPDATE account SET sha_pass_hash = '".$accountmodify_password_final."' WHERE id = '".$user_check_accountid."'");

		} else {

			system_message("Eingebenes Passwort ist falsch!");

		}

	}

	// �berpr�fung der eingegebenen Email adresse
	if($_POST["email"] != $user_check_email){

		// Datenkonvertierung
		$post_accountmodify_email = variable($_POST["email"], "", "db");

		// Posztolt adatok ellen�rz�se
		string_check($post_accountmodify_email, 64, ">", "Eingegebene E-Mail-Adresse ist zu lang!");
		string_check($post_accountmodify_email, 8, "<", "Eingegebene E-Mail-Adresse ist zu kurz!");

		// Email m�dos�t�sa
		db_query("UPDATE account SET email = '".$post_accountmodify_email."' WHERE id = '".$user_check_accountid."'");

	}

	// Inputok kit�lt�s�nek ellen�rz�se (expansion)
	if($_POST["expansion"] != $user_check_expansion){

		// Posztolt adatok �talak�t�s
		$post_accountmodify_expansion = variable($_POST["expansion"], "", "db");
		
		// Posztolt adatok ellen�rz�se
		string_check($post_accountmodify_expansion, $user_check_expansion, "<num", "Schalten Sie nicht auf eine neuere Add-on Ausgabe!");
		string_check($post_accountmodify_expansion, 1, ">", "Die Hilfs-Feld auf false gesetzt!");
		string_check($post_accountmodify_expansion, "^[0-2%]+$", "!ereg", "Die Hilfs-Feld auf false gesetzt!");

		// Expansion m�dos�t�sa
		db_query("UPDATE account SET expansion = '".$post_accountmodify_expansion."' WHERE id = '".$user_check_accountid."'");

	}

	system_message("Sie haben erfolgreich ihre Account daten aktualisiert!");

}

?>

				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.password.value != "" || form.newpassword.value != "" || form.newpassword2.value != "") {

                 if (form.newpassword.value == "") { alert( "Falsches Passwort im Feld neues Passwort!" ); form.newpassword.focus(); return false; } else { if (form.newpassword.value.length < 6) { alert( "Das neue Passwort ist zu kurz!" ); form.newpassword.focus(); return false; } }
				 if (form.newpassword2.value == "") { alert( "Fehler beim Feld neue Passwort erneut eingeben!" ); form.newpassword2.focus(); return false; } else { if (form.newpassword2.value.length < 6) { alert( "Best�tigen Sie das neue Passwort ist zu kurz!" ); form.newpassword2.focus(); return false; } }
				 if (form.password.value == "") { alert( "Fehler beim das aktuelle Passwort-Feld komplett!" ); form.password.focus(); return false; } else { if (form.password.value.length < 6) { alert( "Das aktuelle Passwort ist zu kurz!" ); form.password.focus(); return false; } }
				 
				 } else {
				 
				 if (form.email.value != "<?php echo $user_check_email; ?>") { if (form.email.value.length < 8) { alert( "E-Mail-Adresse ist zu kurz!" ); form.email.focus(); return false; } return true; }
				 if (form.expansion.value != "<?php echo $user_check_expansion; ?>") { return true; }
				 
				 return false;
				 
				 }

				 return true ;
				 
				 }
				 </script>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
						  Daten �ndern<img class="nav-icon" src="<?php echo theme_file("images/icons/refresh.png"); ?>" alt="Adatok m�dos�t�sa" />
						
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
						  
						  Hier k�nnen sie die Daten ihres Account �ndern.
						  
						  </td>
						</tr>
					</table>
					

				 
					<form action="?id=account-modify" method="POST" onsubmit="return checkform(accountmodify);" name="account bearbeiten">
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td align="right">
						 Neues Passwort
						 </td>
						 <td align="left">
						 <input name="newpassword" class="normal" type="password" maxlength="32" /> <font class="mini"><a href="#" title="Wenn kein neues Passwort gesetzt werden soll einfach frei lassen">[?]</a> Min. 6 Zeichen</font>
						 </td>
					   </tr>
				       <tr>
					     <td align="right">
						 Passwort wiederhohlen
						 </td>
						 <td align="left">
						 <input name="newpassword2" class="normal" type="password" maxlength="32" /> <font class="mini"><a href="#" title="Wenn kein neues Passwort gesetzt werden soll einfach frei lassen">[?]</a> Min. 6 Zeichen</font>
						 </td>
					   </tr>
					   					   <tr>
					     <td align="right">
						 Aktuelles Passwort
						 </td>
						 <td align="left">
						 <input name="password" class="normal" type="password" maxlength="32" /> <font class="mini"><a href="#" title="Um die �nderungen zu best�tigen bitte aktuelles Passwort eingeben">[?]</a></font>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 E-Mail Adresse:
						 </td>
						 <td align="left">
					     <input name="email" class="normal" type="text" value="<?php echo $user_check_email; ?>" maxlength="64" /> <font class="mini"><a href="#" title="Wenn sie ihre angegebene Email adresse �ndern wollen hier eingeben">[?]</a></font>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 WoW Addon:
						 </td>
						 <td align="left">
					     <select name="expansion">
						<option value="<?php echo $wam_expansion_legion; ?>"<?php if($user_check_expansion == $wam_expansion_mop){ echo "SELECTED"; } ?>>Legion</option>
						<option value="<?php echo $wam_expansion_wod; ?>"<?php if($user_check_expansion == $wam_expansion_mop){ echo "SELECTED"; } ?>>Warlords of Draenor</option>
						 <option value="<?php echo $wam_expansion_mop; ?>"<?php if($user_check_expansion == $wam_expansion_mop){ echo "SELECTED"; } ?>>Mist of Pandoria</option>
						 <option value="<?php echo $wam_expansion_cataclysm; ?>"<?php if($user_check_expansion == $wam_expansion_cataclysm){ echo "SELECTED"; } ?>>Cataclysm</option>
						 <option value="<?php echo $wam_expansion_wotlk; ?>"<?php if($user_check_expansion == $wam_expansion_wotlk){ echo "SELECTED"; } ?>>WOTLK</option>
						 <option value="<?php echo $wam_expansion_bc; ?>"<?php if($user_check_expansion == $wam_expansion_bc){ echo "SELECTED"; } ?>>Burning Crusade</option>
						 <option value="<?php echo $wam_expansion_classic; ?>"<?php if($user_check_expansion == $wam_expansion_classic){ echo "SELECTED"; } ?>>Classic</option>
						 </select><font class="mini"><a href="#" title="W�hlen sie hier ihre WoW Erweiterung standart m��ig Cataclysm ausw�hlen">[?]</a></font>
						 </td>
					   </tr>
					   <tr>
					     <td align="right" colspan="2">
						 <input type="submit" value="Speichern" class="input-sbm" />
						 </td>
					   </tr>
					</table>
					</form>
				 
				 </td>
			   </tr>
			 </table>