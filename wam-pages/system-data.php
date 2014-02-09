<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin");

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Systemdaten<img class="nav-icon" src="<?php echo theme_file("images/icons/alert-window.png"); ?>" alt="Rendszer adatok" />
				 
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
						  
						  Hier sehen sie als Admin verschiedene Einstellungen ihres WoW Projekts betreffend.
						  
						  </td>
						</tr>
					</table>
					
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td align="right" width="180px">
						 Projekt name:
						 </td>
						 <td align="left">
						 <b>Web Account Manager</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Entwickler:
						 </td>
						 <td align="left">
						 <b>Kálmán Roland (Pradox)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Kontakt:
						 </td>
						 <td align="left">
						 <b>pradox@index.hu (MSN), pradoxblog@gmail.com (Email)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Aktuelle Version:
						 </td>
						 <td align="left">
						 <b><?php echo $wam_version; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Website:
						 </td>
						 <td align="left">
						 <b><a target="_blank" href="http://wam.nwhost.hu/">http://wam.nwhost.hu/</a></b>
						 </td>
					   </tr>
					   </tr>
					</table>
					<br />
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					   <tr>
					     <td align="right" width="180px;">
						 MySQL host:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_host; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL Benutzername:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_username; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL Passwort:
						 </td>
						 <td align="left">
						 <b>Nicht sichtbar</b> <a href="#" title="Aus Sicherheitsgründen ist das MySQL-Passwort nicht sichtbar"><font class="mini">[?]</font></a>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL realm Datenbank:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_db_realmd; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL characters datenbank:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_db_characters; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 MySQL world datenbank:
						 </td>
						 <td align="left">
						 <b><?php echo $mysql_db_world; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Die Server realmlist:
						 </td>
						 <td align="left">
						 <b><?php echo $wam_realmlist; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Die Administrator Email Adresse:
						 </td>
						 <td align="left">
						 <b><?php echo $site_admin_email; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Ranks:
						 </td>
						 <td align="left">
						 <b>Spieler (<?php echo $wam_gmlevel_player; ?>), VIP (<?php echo $wam_gmlevel_vip; ?>), Moderator (<?php echo $wam_gmlevel_mod; ?>), GM (<?php echo $wam_gmlevel_gm; ?>), Admin (<?php echo $wam_gmlevel_admin; ?>)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 WoW erweiterung:
						 </td>
						 <td align="left">
						 <b>Classic (<?php echo $wam_expansion_classic; ?>), BC (<?php echo $wam_expansion_bc; ?>), WOTLK (<?php echo $wam_expansion_wotlk; ?>)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 VIP Bereich:
						 </td>
						 <td align="left">
						 <b><?php if($wam_vip_enable==0){ echo "Deaktiviert"; } elseif ($wam_vip_enable==1) { echo "Aktiviert"; } ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 VIP Features:
						 </td>
						 <td align="left">
						 <b>Items senden (
						 
						 <?php if($wam_vip_enable_additem==0){ echo "Deaktiviert"; } elseif ($wam_vip_enable_additem==1) { echo "Aktiviert"; } ?>), Auf Level 80 setzten (<?php if($wam_vip_enable_addlevel==0){ echo "Deaktiviert"; } elseif ($wam_vip_enable_addlevel==1) { echo "Aktiviert"; } ?>), Gold senden (<?php if($wam_vip_enable_addmoney==0){ echo "Deaktiviert"; } elseif ($wam_vip_enable_addmoney==1) { echo "Aktiviert"; } ?>), Character Umbenenen (<?php if($wam_vip_enable_charrename==0){ echo "Deaktiviert"; } elseif ($wam_vip_enable_charrename==1) { echo "Aktiviert"; } ?>)</b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Sicherheitsprotokollierung:
						 </td>
						 <td align="left">
						 <b><?php if($site_log_enable==0){ echo "Deaktivert"; } elseif ($site_log_enable==1) { echo "Aktiviert"; } ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Seitentitel:
						 </td>
						 <td align="left">
						 <b><?php echo $site_title; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Webseite:
						 </td>
						 <td align="left">
						 <b><a target="_blank" href="<?php echo $site_server_site; ?>"><?php echo $site_server_site; ?></a></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Seiten Thema:
						 </td>
						 <td align="left">
						 <b><?php echo $site_theme; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Suche Roboter:
						 </td>
						 <td align="left">
						 <b><?php echo $site_meta_robots; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Stichwort:
						 </td>
						 <td align="left">
						 <b><?php echo $site_meta_keywords; ?></b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right">
						 Pop-up-Fenster:
						 </td>
						 <td align="left">
						 <b><?php if(empty($site_popup)){ echo "deaktiviert"; } else { echo "Aktiviert (Text: ".$site_popup.")"; } ?></b>
						 </td>
					   </tr>
					</table>
					
				 </td>
			   </tr>
			 </table>