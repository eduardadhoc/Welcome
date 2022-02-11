<?php

/* CONFIG */

//SITE URL
$siteURL="https://dev.b2brouter.net/";

//DDBB
$bbdd_Connection="localhost";
$bbdd_Login="dev2_b2brouter_n";
$bbdd_Pass="ahsheequa8";
$bbdd_dbName="dev2_b2brouter_net_db1";

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
