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
    "INSERT INTO noticias (titulo, contenido, img, tags)
     VALUES ('ABRIMOS ChuPink', 'Finalmente despues de años de preparacion ChuPink sale al mercado', 'img/placeholder1.jpg','SUCURSAL/IMPORTANTE')",
     "INSERT INTO noticias (titulo, contenido, img, tags)
     VALUES ('Nueva sucursal ChuPink', 'Hemos abierto una nueva sucursal de ChuPink en Santa Cruz', 'img/placeholder2.jpg','SUCURSAL/IMPORTANTE')",
     "INSERT INTO noticias (titulo, contenido, img, tags)
     VALUES ('Ahora Cortamos el pelo!', 'Luego de mucho trabajo, podes pedir un corte de pelo!',null,'SERVICIOS')",
     "INSERT INTO carrusel (titulo, contenido, img)
     VALUES ('Uñas acrilicas a medida', 'Bonitas y relucientes', 'img/placeholder1.jpg')",
     "INSERT INTO carrusel (titulo, contenido, img)
     VALUES ('Manicura avanzada', 'El cuidado de las manos es importante', 'img/placeholder2.jpg')",
     "INSERT INTO carrusel (titulo, contenido, img)
     VALUES ('Pedicura', 'Nuestros expertos te daran los cuidados necesarios', 'img/placeholder3.jpg')",
     "INSERT INTO ofertas (titulo, contenido, region, tags , fin_oferta , servicios)
     VALUES ('50% OFF EN MANICURA', 'Descuento del 50% en trabajos de manicura', 'arg/rn/bariloche','UÑAS','','MANICURA')",
     "INSERT INTO ofertas (titulo, contenido, region, tags , fin_oferta , servicios)
     VALUES ('50% OFF EN PEDICURA', 'Descuento del 50% en trabajos de pedicura', 'arg/ch/epuyen','UÑAS','','PEDICURA')",
     "INSERT INTO ofertas (titulo, contenido, region, tags , fin_oferta , servicios)
     VALUES ('2x1 EN ACRILICOS', 'Trae una amiga a hacerce los acrilicos y solo paga los tuyos', 'arg/rn/viedma','UÑAS','','ACRILICOS')",
     "INSERT INTO banderin (titulo, img, contenido)
     VALUES ('MIRA NUESTRAS OFERTAS', '', 'Mira nuestro apartado de ofertas!')",
     "INSERT INTO banderin (titulo, img, contenido)
     VALUES ('Flamenco va a ser el logo', 'img/logo.png', 'El logo es un flamenco rosa')",
     "INSERT INTO banderin (titulo, img, contenido)
     VALUES ('LAAAAAAAAAARGO', '', 'Aunque este string sea largo la animacion no se debe cortar ya que sino algo no anda bien, asegurence que funcione')",
     "INSERT INTO empleados (nombre, apellido, region, telefono)
     VALUES ('Martin','Gomez','arg/rn/bariloche','542944143724')",
     "INSERT INTO empleados (nombre, apellido, region, telefono)
     VALUES ('Nadia','Dolores','arg/ch/elhoyo','542944348912')",
     "INSERT INTO empleados (nombre, apellido, region, telefono)
     VALUES ('Ema','Carmela','arg/ch/el hoyo','542944919884')"
     
);
$num = count($sql);
$conn = new mysqli($servername, $usuario, $password,$db);
for ($i=0; $i < $num; $i++) { 
        if ($conn->query($sql[$i]) === TRUE) {
            echo "Datos correctamente cargados<br>";
          } else {
            echo "error al subir datos". $conn->error."<br>";
          }
    }

?>
