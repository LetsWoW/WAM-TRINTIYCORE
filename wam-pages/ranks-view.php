<?php

// Datei Prüfen
if(!isset($mysql_connect)){ exit(); } file_check("logged");

// Fordern Benutzerkonto auf Rang Basis (vip)
$query_ranksview_accountacces_vip = db_query( "SELECT id FROM account_access WHERE gmlevel = '".$wam_gmlevel_vip."'");

// Fordern Benutzerkonto auf Rang Basis (moderátor)
$query_ranksview_accountacces_mod = db_query("SELECT id FROM account_access WHERE gmlevel = '".$wam_gmlevel_mod."'");

// Fordern Benutzerkonto auf Rang Basis (gm)
$query_ranksview_accountacces_gm = db_query("SELECT id FROM account_access WHERE gmlevel = '".$wam_gmlevel_gm."'");

// Fordern Benutzerkonto auf Rang Basis (admin)
$query_ranksview_accountacces_admin = db_query("SELECT id FROM account_access WHERE gmlevel = '".$wam_gmlevel_admin."'");

?>
				 
		     <table class="body3" cellspacing="0" cellpadding="0">
			   <tr>
			     <td class="body3-title">
				 
				     Ränge Übersicht<img class="nav-icon" src="<?php echo theme_file("images/icons/rank.png"); ?>" alt="Ränge Übersicht" />
				 
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
						  
						   Hier sehen Sie sie haben einen höheren Rang als accountokat Spieler. Der Online-Benutzerkonto ist grün, die offline Benutzer-Account ist in rot dargestellt. Ráviszed Konto, wenn Sie mit der Maus über sie und sehen Sie die Namen der Bezeichner (ID).
						  
						  </td>
						</tr>
					</table>
					
					<table class="body6" cellspacing="0" cellpadding="0">
					   <tr>
					     <td align="right" width="180px;">
						 VIP Spiele accounts:
						 </td>
						 <td align="left">
						 <b>
						 
						 <?php
						 
						 if(mysqli_num_rows($query_ranksview_accountacces_vip) != 0){
						 
					    // Fordern Benutzerkonto auf Rang (VIP) basiert
						while($results_ranksview_accountacces_vip = mysqli_fetch_array($query_ranksview_accountacces_vip)){

							$query_ranksview_vip = db_query("SELECT id, username, online FROM account WHERE id = '".$results_ranksview_accountacces_vip["id"]."'");
							$results_rankview_vip = mysqli_fetch_array($query_ranksview_vip);
							
							if($results_rankview_vip["username"] == ""){ $results_rankview_vip["username"] = '<a href="#" title="Unbekannt">?</a>'; }
							
							// Conversion-Status
							switch($results_rankview_vip["online"]){
							
								case 1:
								$results_rankview_vip_online_color = "green";
								break;
								
								case 0:
								$results_rankview_vip_online_color = "red";
								break;
								
							}
							
							$array_results_rankview_vip[] = '<a href="#" title="ID: '.$results_rankview_vip["id"].'"><font color="'.$results_rankview_vip_online_color.'">'.$results_rankview_vip["username"].'</font></a>';
							 
						}
						
						echo implode(", ", $array_results_rankview_vip);
						 
						 } else { echo "Kein Spiele Account vorhanden mit dem Rank VIP"; }
					    ?>
						 
						 </b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right" width="180px;">
						 Moderator Spiele Accounts:
						 </td>
						 <td align="left">
						 <b>
						 
						 <?php
						 
						 if(mysqli_num_rows($query_ranksview_accountacces_mod) != 0){
						 
					    // Fordern Benutzerkonto auf Rang (Moderator) basiert
						while($results_ranksview_accountacces_mod = mysqli_fetch_array($query_ranksview_accountacces_mod)){

							$query_ranksview_mod = db_query("SELECT id, username, online FROM account WHERE id = '".$results_ranksview_accountacces_mod["id"]."'");
							$results_rankview_mod = mysqli_fetch_array($query_ranksview_mod);
							
							if($results_rankview_mod["username"] == ""){ $results_rankview_mod["username"] = '<a href="#" title="Unbenkannt">?</a>'; }
							
							// Conversion-Status
							switch($results_rankview_mod["online"]){
							
								case 1:
								$results_rankview_mod_online_color = "green";
								break;
								
								case 0:
								$results_rankview_mod_online_color = "red";
								break;
							
							}
							
							$array_results_rankview_mod[] = '<a href="#" title="ID: '.$results_rankview_mod["id"].'"><font color="'.$results_rankview_mod_online_color.'">'.$results_rankview_mod["username"].'</font></a>';
							 
						}
						
						echo implode(", ", $array_results_rankview_mod);
						
						} else { echo "Kein Spiele Account vorhanden"; }
						 
					    ?>
						 
						 </b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right" width="180px;">
						 GM Spiele Accounts:
						 </td>
						 <td align="left">
						 <b>
						 
						 <?php
						 
					    if(mysqli_num_rows($query_ranksview_accountacces_gm) != 0){
						 
					    // Fordern Benutzerkonto auf Rang (gm) basiert
						while($results_ranksview_accountacces_gm = mysqli_fetch_array($query_ranksview_accountacces_gm)){

							$query_ranksview_gm = db_query("SELECT id, username, online FROM account WHERE id = '".$results_ranksview_accountacces_gm["id"]."'");
							$results_rankview_gm = mysqli_fetch_array($query_ranksview_gm);
							
							if($results_rankview_gm["username"] == ""){ $results_rankview_gm["username"] = '<a href="#" title="Unbekannt">?</a>'; }
							
								// Conversion-Status
								switch($results_rankview_gm["online"]){
								
								case 1:
								$results_rankview_gm_online_color = "green";
								break;
								
								case 0:
								$results_rankview_gm_online_color = "red";
								break;
								
							}
							
							$array_results_rankview_gm[] = '<a href="#" title="ID: '.$results_rankview_gm["id"].'"><font color="'.$results_rankview_gm_online_color.'">'.$results_rankview_gm["username"].'</font></a>';
							 
						}
						
						echo implode(", ", $array_results_rankview_gm);
						
						} else { echo "Kein GM Spiele Account vorhanden"; }
						 
					    ?>
						 
						 </b>
						 </td>
					   </tr>
					   <tr>
					     <td align="right" width="180px;">
						 Admin Spiele Accounts:
						 </td>
						 <td align="left">
						 <b>
						 
						 <?php
						 
						if(mysqli_num_rows($query_ranksview_accountacces_admin) != 0){
						
					    // Fordern Benutzerkonto auf Rang Basis (admin)
						while($results_ranksview_accountacces_admin = mysqli_fetch_array($query_ranksview_accountacces_admin)){

							$query_ranksview_admin = db_query("SELECT id, username, online FROM account WHERE id = '".$results_ranksview_accountacces_admin["id"]."'");
							$results_rankview_admin = mysqli_fetch_array($query_ranksview_admin);
							
							if($results_rankview_admin["username"] == ""){ $results_rankview_admin["username"] = '<a href="#" title="Unbekannt">?</a>'; }
							
							// Conversion-Status
							switch($results_rankview_admin["online"]){
								
								case 1:
								$results_rankview_admin_online_color = "green";
								break;
								
								case 0:
								$results_rankview_admin_online_color = "red";
								break;
								
							}
							
							$array_results_rankview_admin[] = '<a href="#" title="ID: '.$results_rankview_admin["id"].'"><font color="'.$results_rankview_admin_online_color.'">'.$results_rankview_admin["username"].'</font></a>';
							 
						}
						
						echo implode(", ", $array_results_rankview_admin);
						
						} else { echo "Kein Spiele Account mit dem Rang Admin vorhanden"; }
						 
					    ?>
						 
						 </b>
						 </td>
					   </tr>
				 </table>

				 </td>
			   </tr>
			 </table>