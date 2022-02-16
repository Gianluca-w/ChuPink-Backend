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
$responses->accion =array("Database created successfully ","Table turnos created succesfully ","Table noticias created succesfully ","Table carrusel created succesfully ","Table ofertas created succesfully ","Table banderin created succesfully ","Table personal created succesfully ");
$responses->error =array("Error creating database: ", "Error creating table turnos: ", "Error creating table noticias: ", "Error creating table carrusel: ", "Error creating table ofertas: ", "Error creating table banderin: ","Error creating table personal ");
$sql = array(
    "CREATE DATABASE chupink",
    "CREATE TABLE personal (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellido VARCHAR(100),
        region VARCHAR(100),
        telefono VARCHAR(50),
        mail VARCHAR(40),
        servicios VARCHAR(100),
        activo BOOLEAN DEFAULT 1,
        added_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        added_by VARCHAR(20) NOT NULL,
        enabled BOOLEAN DEFAULT 1
        ) ENGINE = InnoDB",
    "CREATE TABLE turnos (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        apellido VARCHAR(30) NOT NULL,
        telefono VARCHAR(50) NOT NULL,
        hora_turno  TIMESTAMP,
        duracion INT(10) NOT NULL DEFAULT 60,
        horario_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        confirmado INT(3),
        codigo_confirm INT(4),
        empleado_asignado INT(3) UNSIGNED NOT NULL,
        CONSTRAINT `fk_empleado_asignado_id`
        FOREIGN KEY (empleado_asignado) REFERENCES personal(id) ON DELETE CASCADE
    ON UPDATE RESTRICT,
        added_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        added_by VARCHAR(20) NOT NULL,
        enabled BOOLEAN DEFAULT 1
        
    ) ENGINE = InnoDB",
    "CREATE TABLE noticias (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        contenido VARCHAR(250) NOT NULL,
        img VARCHAR(100),
        tags VARCHAR(100),
        added_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        added_by VARCHAR(20) NOT NULL,
        enabled BOOLEAN DEFAULT 1
        ) ENGINE = InnoDB",
    "CREATE TABLE carrusel (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        contenido VARCHAR(150) NOT NULL,
        img VARCHAR(100),
        added_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        added_by VARCHAR(20) NOT NULL,
        enabled BOOLEAN DEFAULT 1
        ) ENGINE = InnoDB",
    "CREATE TABLE ofertas (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        contenido VARCHAR(100) NOT NULL,
        region VARCHAR(100) NOT NULL,
        tags VARCHAR(100),
        fin_oferta  TIMESTAMP,
        servicios VARCHAR(30),
        activa BOOLEAN DEFAULT 1,
        added_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        added_by VARCHAR(20) NOT NULL,
        enabled BOOLEAN DEFAULT 1
        ) ENGINE = InnoDB",
    "CREATE TABLE banderin (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        img VARCHAR(100),
        contenido VARCHAR(200),
        added_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        added_by VARCHAR(20) NOT NULL,
        enabled BOOLEAN DEFAULT 1
        ) ENGINE = InnoDB",
    "CREATE TABLE curriculums (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellido VARCHAR(100),
        region VARCHAR(100),
        telefono VARCHAR(50),
        mail VARCHAR(40),
        aceptado BOOLEAN DEFAULT 0,
        curriculum VARCHAR (250),
        added_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        added_by VARCHAR(20) NOT NULL,
        enabled BOOLEAN DEFAULT 1
        ) ENGINE = InnoDB",
    "CREATE TABLE archivo (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        nombre_original VARCHAR(100) NOT NULL,
        ruta VARCHAR(100) NOT NULL,
        tipo INT(4),
        peso VARCHAR(10),
        archivo LONGBLOB NOT NULL,
        added_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        added_by VARCHAR(20) NOT NULL,
        enabled BOOLEAN DEFAULT 1
        ) ENGINE = InnoDB",
    "CREATE TABLE rol (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        permisos VARCHAR(20) NOT NULL,
        extension VARCHAR(6) NOT NULL
        ) ENGINE = InnoDB",
    "CREATE TABLE usuario (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        usuario VARCHAR(50) NOT NULL,
        contrasenia VARCHAR(100),
        added_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        added_by VARCHAR(20) NOT NULL,
        enabled BOOLEAN NOT NULL,
        id_permisos INT(4) UNSIGNED NOT NULL,
        CONSTRAINT `fk_id_permisos`
        FOREIGN KEY (id_permisos) REFERENCES rol(id) ON DELETE CASCADE
    ON UPDATE RESTRICT
        
        ) ENGINE = InnoDB",
    "CREATE TABLE multimedia (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(40) NOT NULL,
        added_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        added_by VARCHAR(20) NOT NULL,
        enabled BOOLEAN NOT NULL,
        archivo INT(5) UNSIGNED NOT NULL,
        CONSTRAINT `fk_id_archivos`
        FOREIGN KEY (archivo) REFERENCES archivo(id) ON DELETE CASCADE
    ON UPDATE RESTRICT        
        ) ENGINE = InnoDB"

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
