<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "atabay_db";

$mysqli = new mysqli($servername,$username,$password, $database);
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$mysqli->set_charset('utf8');
