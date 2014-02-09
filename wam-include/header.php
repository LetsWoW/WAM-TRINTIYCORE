<?php

ob_start();

// Datei Prüfen
if(!isset($mysql_host)){ exit(); }

// Seite deaktiviert
if ($site_enable == "0"){ require_once("wam-include/lock.php"); exit(); }

// Zeichensatz
header("Content-Type: text/html; charset=ISO-8859-2");

// Zugehörigkeit und die MySQL-Datenbank (RealMod) Bezeichnung
$mysql_connect = mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die("Verbindung mit der Datenbank Nicht möglich!");
db_select($mysql_db_realmd);

// Programm Version
$wam_version = "1.3.4 RC";

// Wichtige Variablen
$site_get_pages = variable($_GET["id"], "", "normal");
$site_get_action = variable($_GET["act"], "", "normal");
$site_get_name = variable($_GET["name"], "", "db");
$site_post_action = variable($_POST["action"], "", "normal");
$site_get_cid = variable($_GET["cid"], "", "db");
$cookie_wam_id = variable($_COOKIE["wam_id"], "", "db");
$site_get_message = variable($_GET["msg"], "stripslashes,htmlspecialchars", "normal");
$cookie_worktime = $_COOKIE["wam_worktime"];
$site_ip = $_SERVER["REMOTE_ADDR"];

// Datum anzeigen, konvertieren
$site_date_day = date("D");

switch ($site_date_day){

	case "Mon":
	$site_date_day = "Montag";
	break;

	case "Tue":
	$site_date_day = "Dienstag";
	break;

	case "Wed":
	$site_date_day = "Mittwoch";
	break;

	case "Thu":
	$site_date_day = "Donnerstag";
	break;
	case "Fri":
	$site_date_day = "Freitag";
	break;

	case "Sat":
	$site_date_day = "Samstag";
	break;

	case "Sun":
	$site_date_day = "Sonntag";
	break;

}

$site_date = "".date("Y.m.d. H:i").", ".$site_date_day."";

// Erstellen Sicherheitsüberwachung (Besucher)
site_log("visitors", "IP: ".$site_ip." | Dátum: ".$site_date."");

// Cookies überprüfen
if(!empty($cookie_wam_id)){

	// Prüfung der korrekte Cookie-Daten
	$query_login = db_query("SELECT COUNT(*) FROM account WHERE wam_id = '".$cookie_wam_id."'");
	$results_login = mysqli_fetch_array($query_login);

	if($results_login[0] == 0){

		// Log aktiviert (schlechter  (Cookie)) wird halt überprüft ob der Cookie gültig ist omg
		site_log("bad-login-cookie", "IP: ".$site_ip." | Dátum: ".$site_date."");

		// Beenden
		header_location("logout");

	} else
	{

		// Account informations Anfrage
		$query_user_check = db_query("SELECT id, username, sha_pass_hash, email, expansion FROM account WHERE wam_id = '".$cookie_wam_id."'");
		$results_user_check = mysqli_fetch_array($query_user_check);

		// Account information speichern
		$user_check_accountid = $results_user_check["id"];
		$user_check_accountname = $results_user_check["username"];
		$user_check_password = $results_user_check["sha_pass_hash"];
		$user_check_email = $results_user_check["email"];
		$user_check_expansion = $results_user_check["expansion"];

		// Account Rang überprüfen (nix anderes als das gerüft wird ob das ein GM account ist oder nicht
		$query_user_check_gmlevel = db_query("SELECT gmlevel FROM account_access WHERE id = '".$user_check_accountid."'");
		$results_user_check_gmlevel = mysqli_fetch_array($query_user_check_gmlevel);

		// Account Rang abfrage
		$user_check_gmlevel = $results_user_check_gmlevel["gmlevel"];

		// Cookies aktualisieren
		$worktime_login_final = time()+$cookie_worktime;
		setcookie("wam_id", $_COOKIE["wam_id"], $worktime_login_final);
		setcookie("wam_worktime", $_COOKIE["wam_worktime"], $worktime_login_final);

	}

}

?>