<?php
$servername = "db5016617248.hosting-data.io";
$username = "dbu349122";  
$password = "elAlumnado_a_veces_es_Muy_tr4vi3so";      
$dbname = "dbs13472821";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8");

