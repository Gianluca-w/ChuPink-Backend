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
    "INSERT INTO rol (nombre, permisos)
    VALUES ('admin','r/e/l')",
    "INSERT INTO rol (nombre, permisos)
    VALUES ('checker','r/l')",
    "INSERT INTO rol (nombre, permisos)
    VALUES ('user','r')",

    "INSERT INTO personal (nombre, apellido, region, telefono, mail, activo, servicios, added_by)
    VALUES ('Emiliano','Erebes','arg/rn/bariloche','2944143724','llameya@gmail.com','1','manicura/pedicura/esmaltados','admin')",
    "INSERT INTO personal (nombre, apellido, region, telefono, mail, activo, servicios, added_by)
    VALUES ('Juan','Cerbantes','arg/ch/elhoyo','2944143724','nollame@gmail.com','1','manicura/pedicura','admin')",
    "INSERT INTO personal (nombre, apellido, region, telefono, mail, activo, servicios, added_by)
    VALUES ('Esteman','Quito','arg/rn/gralroca','2944143724','soyporteño@gmail.com','1','pedicura','admin')",
    "INSERT INTO personal (nombre, apellido, region, telefono, mail, activo, servicios, added_by)
    VALUES ('José','Villareal','arg/rn/viedma','2944143724','españa@gmail.com','1','manicura','admin')",
    "INSERT INTO personal (nombre, apellido, region, telefono, mail, activo, servicios, added_by)
    VALUES ('Carlos','García','arg/ch/epuyen','2944143724','CarlosMayer@gmail.com','1','manicura/pedicura/peluqueria/esmaltado','admin')",

    // "INSERT INTO archivos (nombre, ruta, tipo, peso, added_by)
    // VALUES ('placeholder1','../assets/img/jpg/placeholder1.jpg','jpg','1Kb','admin')",
    // "INSERT INTO archivos (nombre, ruta, tipo, peso, added_by)
    // VALUES ('placeholder2','../assets/img/png/placeholder2.png','png','1Kb','admin')",
    // "INSERT INTO archivos (nombre, ruta, tipo, peso, added_by)
    // VALUES ('placeholder3','../assets/img/gif/placeholder3.gif','gif','1Kb','admin')",

    "INSERT INTO turnos (cliente, apellido, telefono, hora_turno, duracion, confirmado, codigo_confirm, empleado_asignado, added_by)
     VALUES ('Manuel','Belgrano','542944543286',2021-11-21,'30','1','33','1','admin')",
    "INSERT INTO turnos (cliente, apellido, telefono, hora_turno, confirmado, codigo_confirm, empleado_asignado, added_by)
     VALUES ('Manuela','Belgrano','542944543286',2021-12-11,'60','1','13','1','admin')",
    "INSERT INTO turnos (cliente, apellido, telefono, hora_turno, confirmado, codigo_confirm, empleado_asignado, added_by)
     VALUES ('Juana','DelArco','542945543216',2021-11-29 14:30:00,'120','1','13','2','admin')",
     

    "INSERT INTO noticias (titulo, contenido, img, tags, added_by)
    VALUES ('Nueva Sucursal De Chupink','La nueva sucursal de chupink abre sus puertas en el hoyo Epuyen para que todos puedan disfrutarlo',null,'SUCURSAL','admin')",
    "INSERT INTO noticias (titulo, contenido, img, tags, added_by)
    VALUES ('Nuevo Logo De Chupink','Finalmente tenemos un logo decente para mostrar','../assets/img/png/placeholder2.png','NOVEDAD','admin')",
    "INSERT INTO noticias (titulo, contenido, img, tags, added_by)
    VALUES ('Nuevo Empleado Contratado','Hemos contratado un nuevo empleado para ayudar en el comercio','../assets/img/jpg/placeholder1.jpg','NOVEDAD','admin')",

    // "INSERT INTO carrusel (titulo, contenido, img, tags, added_by)
    // VALUES ('')",

    "INSERT INTO ofertas (titulo, contenido, region, tags, fin_oferta, servicios, added_by)
    VALUES ('2X1 EN ELECTRO','Con la compra de un esmaltado de uñas te puedes llevar un 2 x 1 en electrodomesticos','global','LIMITADA',2021-11-29,'ESMALTADO','admin')",
    "INSERT INTO ofertas (titulo, contenido, region, tags, fin_oferta, servicios, added_by)
    VALUES ('Sorteo viaje las vegas','Con un permanente de uñas puedes ganarte un viaje a las vegas a pagar!','arg/rn/bariloche','LIMITADA/SORTEO',2021-11-29,'PERMANENTE','admin')",
    "INSERT INTO ofertas (titulo, contenido, region, tags, fin_oferta, servicios, added_by)
    VALUES ('Trae a tus amigas','Por el dia del amige si traes alguien  se hacen uñas correlativas les hacemos un descuento del 80%!','arg/ch/epuyen','LIMITADA',2021-11-29,'UÑAS','admin')",

    // "INSERT INTO banderin (titulo, img, contenido, tags, fin_oferta, servicios, added_by)
    // VALUES ('')",

    "INSERT INTO curriculums (nombre, apellido, region, telefono, mail, added_by)
    VALUES ('Manuel','Benjamin','arg/ch/epuyen','2945658856','martindejas2000@hotmail.com','admin')",

    "INSERT INTO usuario (usuario, contrasenia, added_by, id_permisos)
    VALUES ('admin','admin','admin','1')"

    // "INSERT INTO multimedia (added_by, archivo)
    // VALUES ('admin')",

     
     
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
