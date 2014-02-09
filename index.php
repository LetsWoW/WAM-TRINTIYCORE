<?php

// Einbeziehung von wichtigen Dateien
require_once("wam-include/settings.php");
require_once("wam-include/functions.php");
require_once("wam-include/header.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<link rel="stylesheet" type="text/css" href="<?php echo theme_file("style.css"); ?>" />
<script language="javascript" type="text/javascript" src="wam-others/script.js"></script>
<meta name="description" content="Accountmanagement für die Verwaltung ihrer WoW Accounts" />
<meta name="keywords" content="<?php echo $site_meta_keywords; ?>" />
<meta name="robots" content="<?php echo $site_meta_robots ?>" />
<meta name="author" content="Pradox (Kálmán Roland)" />
<link rel="shortcut icon" href="<?php echo theme_file("images/favicon.png"); ?>" type="image/png" />
<title><?php echo $site_title; ?></title>
</head>
<body>

<div align="center">

<table class="site" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	
	<table class="header" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		
		<a href="index.php"><img src="<?php echo theme_file("images/logo.png"); ?>" alt="<?php echo $site_title; ?>" /></a>
		
		</td>
      </tr>
    </table>
	
	<table align="left" class="body-header2" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		
		<b><?php echo $wam_realmlist; ?></b>
		
		</td>
      </tr>
    </table>
	
	<table align="right" class="body-header" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		
		<?php echo $site_date; ?> | <a href="javascript:history.back()">&lt;&lt; Züruck</a> | <a href="javascript:history.go(1)">Weiter &gt;&gt;</a> | <a href="javascript:location.reload();">Update</a> | <a class="dark" href="index.php?id=computer-dangerous">Die Gefahren des Spielens</a>
		
		</td>
      </tr>
    </table>
	 
	<table class="body" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		
	     <table class="body2" cellspacing="0" cellpadding="0">
           <tr>
             <td class="body2-left">
			 
			 <?php
			 
			 if(!empty($cookie_wam_id)){
			 
				require_once("wam-modules/logged.php");
			 
			} else {
			 
				require_once("wam-modules/not-logged.php");
			 
			}
			 
			 ?>
		
		     </td>
			 <td class="body2-right">
			 
			 	 <?php
	 
	            if(!empty($site_get_pages)){

					 if (file_exists("wam-pages/".$site_get_pages.".php")) {
		   
						 require_once("wam-pages/".$site_get_pages.".php");

					 } else {

						 require_once("wam-pages/404.php");

					 }
 
                } else { require_once("wam-pages/index.php"); }

                 ?>
		
		     </td>

             </tr>
         </table>
		
		</td>
      </tr>
    </table>
	 
	<table align="center" class="body-footer" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		
		2010 &copy; Pradox - <a target="_blank" href="http://wam.nwhost.hu/">Web Account Manager</a><br />2014 &copy; Let's WoW <a target="_blank" href="http://lets-wow.de/"> Let's WoW Homepage </a>

<?
///////////////////////////////////////////////////////////////
// Bitte lasst das Copyright drinne um die Arbeit            //
// die ich rein gesteckt habe zu würdigen                    //
// MFG                                                       //
// Saugjunkie                                                //
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
// Please leave the copyright drinne to work                 //
// I have inserted purely to appreciate                      //
// MFG                                                       //
// Saugjunkie                                                //
///////////////////////////////////////////////////////////////
?>		
		</td>
      </tr>
    </table>
	
	</td>
  </tr>
</table>

</div>

</body>
</html>

<?php

// Fontos fájlok beillesztése
require_once("wam-include/footer.php");

?>