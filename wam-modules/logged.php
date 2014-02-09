<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged");

?>

		     <table class="nav" cellspacing="0" cellpadding="0">
			   <tr>
			     <td>
				 
				     <ul class="nav">
					 <li class="nav-title">Menü<img class="nav-icon" src="<?php echo theme_file("images/icons/arrow.png") ?>" alt="Menü" /></li>
					 <li><a href="index.php">Startseite</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=vip-information">VIP informationen</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=online-players">Spieler Online</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=player-search">Spielersuche</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=top-players">Rangliste</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=bug">Error Reporting</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=logout">Abmelden</a></li>
					 <div class="dotted-line"></div>
					 </ul>
				 
				 </td>
			   </tr>
			 </table>
			 
			 <?php
			 
			 // VIP menü
		    if($user_check_gmlevel == $wam_gmlevel_vip){
			 
				if($wam_vip_enable == 1){
					 
					 require_once("logged-vip.php");
				 
				}
			 
			}

			 // Admin menü
			 if($user_check_gmlevel == $wam_gmlevel_admin){
			 
				 require_once("logged-admin.php");
				 
			 }
			 
			 ?>
			 
		     <table class="nav" cellspacing="0" cellpadding="0">
			   <tr>
			     <td>
				 
				     <ul class="nav">
					 <li class="nav-title">Systemsteuerung<img class="nav-icon" src="<?php echo theme_file("images/icons/tools.png") ?>" alt="Account mûveletek" /></li>
					 <li><a href="index.php">Account Daten</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=account-modify">Daten ändern</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=my-characters">Meine Charaktere</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=character-transfer">Charaktertransfer</a></li>
					 <div class="dotted-line"></div>
					 </ul>
				 
				 </td>
			   </tr>
			 </table>