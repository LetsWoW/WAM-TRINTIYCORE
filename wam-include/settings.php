<?php

// MYSQL BEÁLLÍTÁSOK
$mysql_host = "localhost"; // MySQL Host (dies ist wahrscheinlich localhost)
$mysql_username = "root"; // MySQL-Benutzernamen
$mysql_password = "++++++"; // MySQL Passwort
$mysql_db_realmd = "auth"; // MySQL realmd Datenbank (trinity auth - Mango realmd)
$mysql_db_characters = "characters"; // MySQL characters datenbank
$mysql_db_world = "world"; // MySQL world datenbank

// Wert Erläuterung: 0 = deaktiviert, 1 = aktiviert

// PROGRAMM EINSTELLUNGEN
$wam_gmlevel_player = "0"; // Rang --> Player
$wam_gmlevel_vip = "9"; // Rang --> VIP  Dieser Rang ist eigentlich unwichtig da dieser nicht in der standart config vor kommt deswegen habe ich dort auch eine "9" rein gemacht da es diesen Rang nicht gibt
$wam_gmlevel_mod = "1"; // Rang --> Supporter
$wam_gmlevel_gm = "2"; // Rang --> GM
$wam_gmlevel_admin = "3"; // Rang --> Adminisztrator
$wam_expansion_wotlk = "2"; // Kiegészítõ --> Wrath Of The Lich King
$wam_expansion_bc = "1"; // Kiegészítõ --> Bruning Crusade
$wam_expansion_classic = "0"; // Kiegészítõ --> Classic World Of Warcraft
$wam_realmlist = "set realmlist rm.pradox.info"; // Realm liste (Trage hier deine Realm liste ein)
$wam_max_players = "100"; // Maximale Spieler anzahl die auf deinem Server Spielen kann/darf
$wam_vip_enable = "0"; // VIP panel
$wam_vip_enable_addmoney = "0"; // Geld Addon
$wam_vip_enable_addlevel = "0"; // Level Addon
$wam_vip_enable_additem = "0"; // Item Addon
$wam_vip_enable_charrename = "0"; // Charaktere Umbenennen

// Webseiten Einstellungen
$site_enable = "1"; // WEbseite aktivieren (Webseite an oder aus)
$site_enable_text = "Die Website ist vorübergehend nicht erreichbar!"; // Text angezeigt, wenn die Seite deaktiviert ist
$site_title = "Pradox - Web Account Manager"; // Seitentitel 
$site_popup = ""; // Pop-up-Fenster beim Öffnen Text des Panels (falls Sie dieses Feature deaktiviert haben möchten einfach freilasen) Ich hab selber kp was das für sin machen soll
$site_server_site = "http://webaccountmanager.info/"; // URL zu dieser seite (http://example.com
$site_theme = "wam1.3"; // Template ändern (Hier templte einstellen (/themes/...)
$site_admin_email = "pradoxblog@gmail.com"; // E Mail-Adresse des Administrators
$site_meta_keywords = "pradox, web account manager, kálmán roland, wam, wow, world of warcraft, cataclysm, wotlk, lich king, manager, account, mangos, trinity core, arcemu, php, szerver, private, server, tört, free, online, mmorpg, item, quest, insta, bug, game, wowemuf, tauri, fejlesztés, new world wow, nw host, nww"; // Meta Keywords
$site_meta_robots = "INDEX,NOFOLLOW"; // Meta-Suchmaschine 
$site_vip_information = "Bearbeiten ..."; // VIP informationen (für alle die nicht genau wissen wofür das ist das ist für das VIP Addon)
$site_log_enable = "0"; // Log einstellungen 

?>