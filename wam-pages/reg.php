<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("notlogged");

// Sitzung starten
session_start();

// Überprüfen der Fertigstellung der Eingänge
if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && !empty($_POST["email"]) && ($_POST["expansion"])!="" && !empty($_POST["security"])){

	$reg_security_answer = $_SESSION["reg_security"] + $_SESSION["reg_security2"];

	string_check($reg_security_answer, $_POST["security"], "!=", "Ihre Antwort auf die Sicherheitsabfrage war falsch!");

	// Clear Session
	session_destroy();

	// Transformation der Daten gesendet
	$post_reg_username = variable($_POST["username"], "strtoupper", "db");
	$post_reg_password = variable($_POST["password"], "strtoupper", "db");
	$post_reg_password2 = variable($_POST["password2"], "strtoupper", "normal");
	$post_reg_email = variable($_POST["email"], "", "db");
	$post_reg_expansion = variable($_POST["expansion"], "", "db");
	$reg_password = sha_pass_hash($post_reg_username, $post_reg_password);

	// Checking Account Name
	$query_reg_acc_check = db_query("SELECT COUNT(*) FROM account WHERE username = '".$post_reg_username."'");
	$results_reg_acc_check = mysqli_fetch_array($query_reg_acc_check);
	if($results_reg_acc_check[0]!=0){ system_message("Der Account Name ist schon vergeben bitte nimm einen anderen!"); }

	// Überprüfen Daten Posztolt
	string_check($post_reg_password, $post_reg_password2, "!=", "Der Kennwort und seine Bestätigung stimmen nicht überein!");
	string_check($post_reg_username, 3, "<", "Der Account Name ist zu kurz!");
	string_check($post_reg_password, 6, "<", "Ihr Passwort ist zu kurz!");
	string_check($post_reg_username, 32, ">", "Der Account Name ist zu lang!");
	string_check($post_reg_password, 32, ">", "Ihr Passwort ist zu lang!");
	string_check($post_reg_username, $post_reg_password, "==", "Der Account Name und Passwort stimmen nicht überein!");
	string_check($post_reg_email, 64, ">", "E-Mail-Adresse ist zu lang!");
	string_check($post_reg_email, 8, "<", "E-Mail-Adresse ist zu kurz!");
	string_check($post_reg_username, "^[0-9a-zA-Z%]+$", "!error", "Der Name des Kontos enthält Zeichen, die nicht erlaubt sind!");
	string_check($post_reg_password, "^[0-9a-zA-Z%]+$", "!error", "Das Passwort enthält Zeichen, die nicht erlaubt sind!");
	string_check($post_reg_expansion, 1, ">", "Das Hilfs-Feld auf false gesetzt!");
	string_check($post_reg_expansion, "^[0-2%]+$", "!error", "Das Hilfs-Feld auf false gesetzt!");

	// Fügen Sie ein neues Konto
	db_query("INSERT INTO account (username, sha_pass_hash, email, last_ip, expansion) VALUES ('".$post_reg_username."', '".$reg_password."', '".$post_reg_email."', '".$site_ip."', '".$post_reg_expansion."')");

	// Erstellen Sicherheitsüberwachung (Register)
	site_log("reg", "IP: ".$site_ip." | Account name: ".$post_reg_username." | Datum: ".$site_date."");

	// Átirányítás
	system_message('Sie haben sich erfolgreich registriert '.$post_reg_username.' benannte Konto beiläufig!');

}

$reg_security = rand(1, 9);
$reg_security2 = rand(1, 9);
$_SESSION["reg_security"] = $reg_security;
$_SESSION["reg_security2"] = $reg_security2;

?>
			 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Neuen Account erstellen<img class="nav-icon" src="<?php echo theme_file("images/icons/plus.png"); ?>" alt="Neuen Account erstellen" />
				 
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
						  
						  Füllen Sie die Felder aus und klicken Sie auf Go! Stellen Sie sicher, dass die Account-Namen und Passwort nur Klein-und Grossbuchstaben des englischen Alphabets und Zahlen sind!
						  
						  </td>
						</tr>
					</table>
					
				 <script type="text/javascript">
				 function checkform ( form )
				 {
				 if (form.username.value == "") { alert( "Bitte füllen sie das Feld für ihren Account Namen aus!" ); form.username.focus(); return false; } else { if (form.username.value.length < 3) { alert( "Account Name ist zu kurz!" ); form.username.focus(); return false; } }
				 if (form.password.value == "") { alert( "Bitte gegeben sie ein Passwort ein!" ); form.password.focus(); return false; } else { if (form.password.value.length < 6) { alert( "Ihr Passwort ist zu kurz!" ); form.password.focus(); return false; } }
				 if (form.password2.value == "") { alert( "Haben Sie nicht füllen das Passwort-Feld wieder!" ); form.password2.focus(); return false; }
				 if (form.password.value == form.username.value) { alert( "Der Account-Name und Passwort stimmen nicht überein!" ); form.password.focus(); return false; }
				 if (form.password.value != form.password2.value) { alert( "Das Kennwort und Bestätigung stimmen nicht überein!" ); form.password.focus(); return false; }
				 if (form.email.value == "") { alert( "Bitte füllen sie das feld für ihre Email adresse aus!" ); form.email.focus(); return false; } else { if (form.email.value.length < 8) { alert( "E-Mail-Adresse ist zu kurz!" ); form.email.focus(); return false; } }
				 if (form.security.value == "") { alert( "Bite beantworten sie die sicherheitsfrage!" ); form.security.focus(); return false; }
				 return true ;
				 }
				 </script>
			 
				 <form action="?id=reg" method="POST" onsubmit="return checkform(reg);" name="reg"> 
				 <table class="body6" cellspacing="0" cellpadding="0">
				    <tr>
					  <td align="center" rowspan="7">
					  <img src="<?php echo theme_file("images/reg-animation".rand(1, 6).".gif"); ?>" width="150" height="150" alt="" />
					  </td>
					  <td align="right">
					  Account name:
					  </td>
					  <td align="left">
					  <input name="username" type="text" maxlength="32" /> <font class="mini">Mind. 3, maximal 32 Zeichen</font>
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Passwort:
					  </td>
					  <td align="left">
					  <input name="password" type="password" maxlength="32" /> <font class="mini">Min 6 Zeichen</font>
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Passwort wiederholen:
					  </td>
					  <td align="left">
					  <input name="password2" type="password" maxlength="32" /> <font class="mini">Min 6 Zeichen</font>
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  Email adresse:
					  </td>
					  <td align="left">
					  <input name="email" type="text" maxlength="64" />
					  </td>
					</tr>
				    <tr>
					  <td align="right">
					  WoW Erweiterung:
					  </td>
					  <td align="left">
					  <select name="expansion"><option value="<?php echo $wam_expansion_wotlk; ?>">WOTLK</option><option value="<?php echo $wam_expansion_bc; ?>">BC</option><option value="<?php echo $wam_expansion_classic; ?>">Classic</option></select><font class="mini">WOLTK ist die Standart Erweiterung</font>
					  </td>
					</tr>
					<tr>
					<td align="right">
					
					<?php
					
					echo '<img src="'.theme_file('images/number-'.$reg_security.'.png').'" alt="" /><img src="'.theme_file('images/plus.png').'" alt="" /><img src="'.theme_file('images/number-'.$reg_security2.'.png').'" alt="" /><img src="'.theme_file('images/equality.png').'" alt="" /><img src="'.theme_file('images/question.png').'" alt="" />
					';
					
					?>
					</td>
					<td align="left">
					<input name="security" type="text" maxlength="2" /> <font class="mini"><a title="Ezzel a kérdéssel szûrjük ki a robotokat" href="#">[?]</a></font>
					</td>
					</tr>
				    <tr>
					  <td colspan="2" style="text-align:right;">
					  <input type="submit" value="Mehet" class="input-sbm" />
					  </td>
					</tr>
			     </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>