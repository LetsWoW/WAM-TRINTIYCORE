<?php

// Fájl ellenõrzése
if(!isset($mysql_connect)){ exit(); }

// Sütik törlése
setcookie("wam_id", "logout", time()-18000);
setcookie("wam_worktime", "logout", time()-18000);

// Átirányítás
header_location("index");

?>