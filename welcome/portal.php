<?php

session_start();

require("assets/includes/connect.php");
require("assets/includes/functions.php");

$id_country = intval($_POST['country']);
$id_language = intval($_POST['language']);

//print_r($_POST);
portalize($mysqli,$id_country,$id_language);


?>