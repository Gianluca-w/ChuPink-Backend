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
$sql = "SELECT * FROM `turnos` WHERE `horario_subida` > CURRENT_TIMESTAMP"
if ($conn->query($sql) === TRUE) {
    echo "Datos correctamente cargados<br>";
  } else {
    echo "error al subir datos". $conn->error."<br>";
  }
?>