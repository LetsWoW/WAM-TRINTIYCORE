<?php

// File Check
if(!isset($mysql_connect)){ exit(); }

if(!empty($cookie_wam_id)){

	require_once("wam-pages/logged.php");

} else
{

	require_once("wam-pages/login.php");

}

?>