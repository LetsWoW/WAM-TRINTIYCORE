<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Account Datenanfrage
$query_logged = db_query("SELECT joindate, last_ip, last_login FROM account WHERE id = '".$user_check_accountid."'");
$results_logged = mysqli_fetch_array($query_logged);

// Account-Daten-Abfrage (ban)
$query_logged_ban = db_query("SELECT active FROM account_banned WHERE id = '".$user_check_accountid."'");
$results_logged_ban = mysqli_fetch_array($query_logged_ban);

// Konvertieren von Daten abgerufen
switch($results_logged_ban["active"]){

	case "0":
	$results_logged_ban["active"] = '<font color="green">Nicht gebannt</font>';
	break;

	case "1":
	$results_logged_ban["active"] = '<font color="red">Gebannt</font>';
	break;

	default:
	$results_logged_ban["active"] = '<font color="green">Nicht gebannt</font>';
	break;

}

switch($user_check_gmlevel){

	case $wam_gmlevel_player:
	$user_check_gmlevel = "Spieler";
	break;

	case $wam_gmlevel_vip:
	$user_check_gmlevel = "VIP";
	break;

	case $wam_gmlevel_mod:
	$user_check_gmlevel = "Supporter";
	break;

	case $wam_gmlevel_gm:
	$user_check_gmlevel = "GM";
	break;

	case $wam_gmlevel_admin:
	$user_check_gmlevel = "Admin";
	break;

	case 0:
	$user_check_gmlevel = "Spieler";
	break;

	default:
	$user_check_gmlevel = "Unbekannt";
	break;

}

switch($user_check_expansion){

	case $wam_expansion_wotlk:
	$user_check_expansion = "WOTLK";
	break;

	case $wam_expansion_bc:
	$user_check_expansion = "BC";
	break;

	case $wam_expansion_classic:
	$user_check_expansion = "Classic";
	break;

	default:
	$user_check_expansion = "Unbekannt";
	break;

}

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
						  Acount informationen (Eingeloggt als: <?php echo $user_check_accountname; ?>)<img class="nav-icon" src="<?php echo theme_file("images/icons/page.png"); ?>" alt="Kontoinformationen (Eingeloggt: <?php echo $user_check_accountname; ?>)" />
				 
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
						  
						  Hier sehen sie die wichtigsten Informationen zu ihrem Account. Verwendete Email adresse, eingerichtete WoW Erweiterung etc....

						  </td>
						</tr>
					</table>
					
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td width="150px" align="right">
						 Account name:
						 </td>
						 <td align="left">
						 <b><?php echo $user_check_accountname; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Identifizierung:
						 </td>
						 <td align="left">
						 <b><?php echo $user_check_accountid; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 E-Mail Adresse:
						 </td>
						 <td align="left">
                         <b><?php echo $user_check_email; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Rang:
						 </td>
						 <td align="left">
						 <b><?php echo $user_check_gmlevel; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Ban status:
						 </td>
						 <td align="left">
						 <b><?php echo $results_logged_ban["active"]; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Erweiterung:
						 </td>
						 <td align="left">
						 <b><?php echo $user_check_expansion; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Datum der Registrierung:
						 </td>
						 <td align="left">
						 <b><?php echo $results_logged["joindate"]; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Letzter Login:
						 </td>
						 <td align="left">
						 <b><?php echo $results_logged["last_login"]; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Letzte IP:
						 </td>
						 <td align="left">
						 <b><?php echo $results_logged["last_ip"]; ?></b>
						 </td>
					   </tr>
					</table>
				 
				 </td>
			   </tr>
			 </table>