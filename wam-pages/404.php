<?php

// Daten Prüfen
if(!isset($mysql_connect)){ exit(); }

?>

		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Hiba - 404<img class="nav-icon" src="<?php echo theme_file("images/icons/404.png"); ?>" alt="Fehler 404" />
				 
				 </td>
			   </tr>
			   <tr>
			     <td class="body3-body">
				 
				     <table class="location-info" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="location-info-img">
						  
						  <img src="<?php echo theme_file("images/icons/info.png"); ?>" alt="Informationen" />
						  
						  </td>
						  <td class="location-info-text">
						  
						  Du hasst einen fehlerhaften Link geklickt, oder die gesuchte Seite existiert nicht!
						  
						  </td>
						</tr>
					</table>
					
					Die angeforderte Seite konnte nicht gefunden werden!
				 
				 </td>
			   </tr>
			 </table>