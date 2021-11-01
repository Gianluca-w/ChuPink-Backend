<?php
include "../../.env/base/DBEnviroment.php";
$usuario = $conexiondata->usuariotests;
$password = $conexiondata->passwordtests;
$servername = $conexiondata->servernametests;
$db = $conexiondata->db;
$conn = new mysqli($servername, $usuario, $password,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>