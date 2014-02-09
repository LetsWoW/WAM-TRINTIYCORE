<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("notlogged");

?>

		     <table class="nav" cellspacing="0" cellpadding="0">
			   <tr>
			     <td>
				 
				     <ul class="nav">
					 <li class="nav-title">Menü<img class="nav-icon" src="<?php echo theme_file("images/icons/arrow.png"); ?>" alt="Menü" /></li>
					 <li><a href="index.php">Einloggen</a></li>
					 <div class="dotted-line"></div>
					 <li><a href="?id=reg">Neues Konto erstellen</a></li>
					 <div class="dotted-line"></div>
					 <li><a target="_blank" href="<?php echo $site_server_site; ?>">Startseite</a></li>
					 <div class="dotted-line"></div>
					 </ul>
				 
				 </td>
			   </tr>
			 </table>