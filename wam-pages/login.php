<?php

// Datei Prüen
if(!isset($mysql_connect)){ exit(); } file_check("notlogged");

// Pop-up-Fenster
if(!empty($site_popup)){ echo '<script type="text/javascript">alert("'.$site_popup.'");</script>'; }

// Überprüfen der Fertigstellung der Eingänge
if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["worktime"])){

	// Posztolt Datenkonvertierung
	$post_login_username = variable($_POST["username"], "strtoupper", "db");
	$post_login_password = variable($_POST["password"], "strtoupper", "db");
	$login_password = sha_pass_hash($post_login_username, $post_login_password);

	// Account kikeresése
	$query_login = db_query("SELECT COUNT(*) FROM account WHERE sha_pass_hash = '".$login_password."'");
	$results_login = mysqli_fetch_array($query_login);

	// Account név és jelszó ellenõrzése
	if($results_login[0] == 0){

		site_log("Falscher Login", "IP: ".$site_ip." | Account Name: ".$post_login_username." | Datum: ".$site_date."");

		system_message("Account Name und Passwort stimmen nicht überein!");

	}

	// Posztolt Sitzung Umwandlung
	switch($_POST["worktime"]){

		case "Dauerhaft":
		$worktime_login = 18000000;
		break;
		
		case "5h":
		$worktime_login = 18000;
		break;

		case "2h":
		$worktime_login = 7200;
		break;

		case "1h":
		$worktime_login = 3600;
		break;

		case "30m":
		$worktime_login = 1800;
		break;

		case "15m":
		$worktime_login = 900;
		break;

		case "5m":
		$worktime_login = 300;
		break;

		default:
		$worktime_login = 900;
		break;

	}

	$worktime_login_final = time()+$worktime_login;
	
	// WAM ID Erstellen und Einrichten
	
	$login_wam_id_length = 32;
    $login_wam_id_characters = "0123456789abcdefghijklmnopqrstuvwxyz"; 

    for ($login_wam_id_num = 0; $login_wam_id_num < $login_wam_id_length; $login_wam_id_num++) {
	
        $login_wam_id .= $login_wam_id_characters[mt_rand(0, strlen($login_wam_id_characters))];
		
    }
	
	db_query("UPDATE account SET wam_id = '".$login_wam_id ."' WHERE username = '".$post_login_username."'");

	// Cookies setzen
	setcookie("wam_id", $login_wam_id , $worktime_login_final);
	setcookie("wam_worktime", $worktime_login, $worktime_login_final);

	// Umleiten
	header_location("index");

}

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Login<img class="nav-icon" src="<?php echo theme_file("images/icons/key.png"); ?>" alt="Login" />
				 
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
						  
						  Cookies müssen aktiviert sein!
						  
						  </td>
						</tr>
					</table>
					
				 <script type="text/javascript">
				 function checkform ( form )
                 {
				 if (form.username.value == "") { alert( "Haben Sie nicht ausfüllen das Feld Kontoname!" ); form.username.focus(); return false; } else { if (form.username.value.length < 3) { alert( "Account Name ist zu kurz!" ); form.username.focus(); return false; } }
				 if (form.password.value == "") { alert( "Sie haben das Passwort feld freigelasen, bitte geben sie ihr Passwort ein!" ); form.password.focus(); return false; } else { if (form.password.value.length < 3) { alert( "Ihr Name Ihre Passwort ist zu kurz!" ); form.password.focus(); return false; } }
				 return true ;
				 }
				 </script>
				 
				 <form action="index.php" method="POST" onsubmit="return checkform(login);" name="login">
				 <table cellspacing="0" cellpadding="0" class="body5">
				   <tr>
				     <td align="center">
					 Account Name: <input name="username" type="text" maxlength="32" /> Passwort: <input name="password" type="password" maxlength="32" />
				     </td>
				   </tr>
				   <tr>
				     <td align="center">
					 Dauer: <select name="worktime"><option value="5h">5 Stunden</option><option value="2h">2 Stunden</option><option value="1h">1 Stunden</option><option value="30m">30 minuten</option><option SELECTED value="15m">15 minuten</option><option value="5m">5 minuten</option></select> <font class="mini"><a title="Hier können Sie auswählen wie lange sie eingelogt bleiben wollen bis sie das System automatisch auslogt" href="#">[?]</a></font> <input type="submit" value="Einllogen" class="input-sbm" /> 
					 </td>
				   </tr>
				 </table>
				 </form>
				 
				 </td>
			   </tr>
			 </table>