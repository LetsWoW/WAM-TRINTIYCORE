<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); }

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     System Nachricht<img class="nav-icon" src="<?php echo theme_file("images/icons/alert.png"); ?>" alt="Rendszer üzenet" />
				 
				 </td>
			   </tr>
			   <tr>
			     <td class="body3-body">
					
					<?php echo $site_get_message; ?>
				 
				 </td>
			   </tr>
			 </table>