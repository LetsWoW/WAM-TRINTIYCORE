<?php

// MYSQL BE�LL�T�SOK
$mysql_host = "localhost"; // MySQL Host (dies ist wahrscheinlich localhost)
$mysql_username = "root"; // MySQL-Benutzernamen
$mysql_password = "++++++"; // MySQL Passwort
$mysql_db_realmd = "auth"; // MySQL realmd Datenbank (trinity auth - Mango realmd)
$mysql_db_characters = "characters"; // MySQL characters datenbank
$mysql_db_world = "world"; // MySQL world datenbank

// Wert Erl�uterung: 0 = deaktiviert, 1 = aktiviert

// PROGRAMM EINSTELLUNGEN
$wam_gmlevel_player = "0"; // Rang --> Player
$wam_gmlevel_vip = "9"; // Rang --> VIP  Dieser Rang ist eigentlich unwichtig da dieser nicht in der standart config vor kommt deswegen habe ich dort auch eine "9" rein gemacht da es diesen Rang nicht gibt
$wam_gmlevel_mod = "1"; // Rang --> Supporter
$wam_gmlevel_gm = "2"; // Rang --> GM
$wam_gmlevel_admin = "3"; // Rang --> Adminisztrator
$wam_expansion_legion = "6"; // Kieg�sz�t� --> Legion
$wam_expansion_wod = "5"; // Kieg�sz�t� --> Warlords of Draenor
$wam_expansion_mop = "4"; // Kieg�sz�t� --> Mist of Pandoria
$wam_expansion_cataclysm = "3"; // Kieg�sz�t� --> Cataclysm
$wam_expansion_wotlk = "2"; // Kieg�sz�t� --> Wrath Of The Lich King
$wam_expansion_bc = "1"; // Kieg�sz�t� --> Bruning Crusade
$wam_expansion_classic = "0"; // Kieg�sz�t� --> Classic World Of Warcraft
$wam_realmlist = "set realmlist rm.pradox.info"; // Realm liste (Trage hier deine Realm liste ein)
$wam_max_players = "100"; // Maximale Spieler anzahl die auf deinem Server Spielen kann/darf
$wam_vip_enable = "0"; // VIP panel
$wam_vip_enable_addmoney = "0"; // Geld Addon
$wam_vip_enable_addlevel = "0"; // Level Addon
$wam_vip_enable_additem = "0"; // Item Addon
$wam_vip_enable_charrename = "0"; // Charaktere Umbenennen

// Webseiten Einstellungen
$site_enable = "1"; // WEbseite aktivieren (Webseite an oder aus)
$site_enable_text = "Die Website ist vor�bergehend nicht erreichbar!"; // Text angezeigt, wenn die Seite deaktiviert ist
$site_title = "Pradox - Web Account Manager"; // Seitentitel 
$site_popup = ""; // Pop-up-Fenster beim �ffnen Text des Panels (falls Sie dieses Feature deaktiviert haben m�chten einfach freilasen) Ich hab selber kp was das f�r sin machen soll
$site_server_site = "http://webaccountmanager.info/"; // URL zu dieser seite (http://example.com
$site_theme = "wam1.3"; // Template �ndern (Hier templte einstellen (/themes/...)
$site_admin_email = "pradoxblog@gmail.com"; // E Mail-Adresse des Administrators
$site_meta_keywords = "pradox, web account manager, k�lm�n roland, wam, wow, world of warcraft, cataclysm, wotlk, lich king, manager, account, mangos, trinity core, arcemu, php, szerver, private, server, t�rt, free, online, mmorpg, item, quest, insta, bug, game, wowemuf, tauri, fejleszt�s, new world wow, nw host, nww"; // Meta Keywords
$site_meta_robots = "INDEX,NOFOLLOW"; // Meta-Suchmaschine 
$site_vip_information = "Bearbeiten ..."; // VIP informationen (f�r alle die nicht genau wissen wof�r das ist das ist f�r das VIP Addon)
$site_log_enable = "0"; // Log einstellungen 

?>