<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); }

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     VIP informationen<img class="nav-icon" src="<?php echo theme_file("images/icons/direction.png"); ?>" alt="VIP informationen" />
				 
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
						  
						  Wenn Sie ein VIP sind aber nicht wissen welche Zusätzliche funktionen sie haben, können sie es hier nachlesen!
						  
						  </td>
						</tr>
					</table>
					
					<?php echo $site_vip_information; ?>
				 
				 </td>
			   </tr>
			 </table>