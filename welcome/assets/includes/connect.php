<?php

/* CONFIG */

//SITE URL
$siteURL="https://dev.b2brouter.net/";

//DDBB
$bbdd_Connection="localhost";
$bbdd_Login="dev_b2brouter_ne";
$bbdd_Pass="iez6zahy6p";
$bbdd_dbName="dev_b2brouter_net_db1";

$mysqli = new mysqli($bbdd_Connection, $bbdd_Login, $bbdd_Pass, $bbdd_dbName);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if (!$mysqli->set_charset("utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
    exit();
} else {
    //printf("Conjunto de caracteres actual: %s\n", $mysqli->character_set_name());
}
 
?>
