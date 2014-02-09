<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); } file_check("logged,admin");

?>

		     <table class="nav" cellspacing="0" cellpadding="0">
			   <tr>
			     <td>
				 
				     <ul class="nav">
					 <li class="nav-title">Verwaltung<img class="nav-icon" src="<?php echo theme_file("images/icons/admin.png"); ?>" alt="Adminisztráció" /></li>
					 <li><a href="?id=system-data">Systemdaten</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=account-transaction">Account verwalten</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=player-transaction">Spieler Aktivitäten</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=ranks-view">Ränge Übersicht</a></li>
					 <div class="dotted-line"></div>
					 </ul>
				 
				 </td>
			   </tr>
			 </table>