<?php

include 'DBEnviroment.php';
$usuario = $conexiondata->usuariotests;
$password = $conexiondata->passwordtests;
$servername = $conexiondata->servernametests;
$db = $conexiondata->db;
$conn = new mysqli($servername, $usuario, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$responses = new stdClass();
$sql = array(
    "CREATE DATABASE chupink",
    "CREATE TABLE turnos (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        apellido VARCHAR(30) NOT NULL,
        telefono VARCHAR(50) NOT NULL,
        hora_turno  TIMESTAMP,
        horario_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        confirmado INT(3),
        codigo_confirm INT(4),
    "CREATE TABLE noticias (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        contenido VARCHAR(250) NOT NULL,
        img VARCHAR(100),
    "CREATE TABLE carrusel (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        contenido VARCHAR(150) NOT NULL,
    "CREATE TABLE ofertas (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        contenido VARCHAR(100) NOT NULL,
        region VARCHAR(100) NOT NULL,
        tags VARCHAR(100),
        fin_oferta  TIMESTAMP,
        servicios VARCHAR(30),
    "CREATE TABLE banderin (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        img VARCHAR(100),
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellido VARCHAR(100),
        region VARCHAR(100),
        telefono VARCHAR(50),
        activo BOOLEAN DEFAULT 1,
    "CREATE TABLE curriculums (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellido VARCHAR(100),
        region VARCHAR(100),
        telefono VARCHAR(50),
        aceptado BOOLEAN DEFAULT 0,
        curriculum VARCHAR (250)
        )",
);
$num = count($sql);
$i=0;
if ($conn->query($sql[$i]) === TRUE) {
    echo $responses->accion[$i]."<br>";
  } else {
    echo $responses->error[$i] . $conn->error."<br>";
  }
$conn->close();
$action = new mysqli($servername, $usuario, $password,$db);
for ($i=1; $i < $num; $i++) { 
        if ($action->query($sql[$i]) === TRUE) {
            echo $responses->accion[$i]."<br>";
          } else {
            echo $responses->error[$i] . $action->error."<br>";
          }
    }

?>
