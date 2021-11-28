<?php
$params = json_decode(file_get_contents('php://input'));
include "../../.env/base/DBEnviroment.php";

 // header('Content-Type: application/json'); use this to send shit
  //Functions definitions, i can recive and send objects.
function subirOferta($params, $conexion){
		$usuario = $conexion->usuariotests;
    	$password = $conexion->passwordtests;
    	$servername = $conexion->servernametests;
    	$db = $conexion->db;
    	$titulo = $params->title;
    	$contenido = $params->content;
    	$region = $params->region;
    	$tags = $params->tags;
    	$fin_oferta = $params->fin_oferta; //*Hacer si esto no esta definido que mande dia de hoy +7 dias a las 8AM
    	$servicios = $params->servicios;
    	$activa = $params->activa;
    	$sql = "INSERT INTO `ofertas`(`titulo`, `contenido`, `region`, `tags`, `fin_oferta`, `servicios`, `activa`) 
        VALUES ('$titulo','$contenido','$region','$tags','$fin_oferta','$servicios','$activa',)";

    	$conn = new mysqli($servername, $usuario, $password,$db);
    	$response = new stdClass();

      	if ($conn->connect_error) {
        	die("Connection failed: " . $conn->connect_error);
      	}
      	if ($conn->query($sql) === TRUE) {
        	$response->result['subir'] = 'OK';
        	$response->msg['subir'] = 'Oferta Agregada Correctamente';
        	$response->code['subir'] = '200';
      	} else {
          	$response->result['subir'] = 'ERROR';
          	$response->err['subir'] = 'Error al subir los datos';
          	$response->code['subir'] = $conn->errno;
        }
       return $response;
}

function borrarOferta($params, $conexion){
    	$usuario = $conexion->usuariotests;
    	$password = $conexion->passwordtests;
    	$servername = $conexion->servernametests;
    	$db = $conexion->db;
    	$id = $params->id;
    	$sql = "DELETE FROM `ofertas` WHERE '$id' = 'id'";

    	$conn = new mysqli($servername, $usuario, $password,$db);
    	$response = new stdClass();

      	if ($conn->connect_error) {
        	die("Connection failed: " . $conn->connect_error);
      	}
      	if ($conn->query($sql) === TRUE) {
        	$response->result['borrar'] = 'OK';
        	$response->msg['borrar'] = 'Oferta borrada Correctamente';
        	$response->code['borrar'] = '200';
      	} else {
          	$response->result['borrar'] = 'ERROR';
          	$response->err['borrar'] = 'Error borrar la oferta';
          	$response->code['borrar'] = $conn->errno;
        }
        return $response;
}

function desactivarOferta($params, $conexion){
	$usuario = $conexion->usuariotests;
	$password = $conexion->passwordtests;
	$servername = $conexion->servernametests;
	$db = $conexion->db;
	$id = $params->id;
	$sql = "UPDATE `ofertas` SET `activa`= 0 WHERE `id` = '$id'";

	$conn = new mysqli($servername, $usuario, $password,$db);
	$response = new stdClass();

	  if ($conn->connect_error) {
	    	die("Connection failed: " . $conn->connect_error);
	  }
	  if ($conn->query($sql) === TRUE) {
	    	$response->result['desactivar'] = 'OK';
	    	$response->msg['desactivar'] = 'Oferta desactivada Correctamente';
	    	$response->code['desactivar'] = '200';
	  } else {
	      	$response->result['desactivar'] = 'ERROR';
	      	$response->err['desactivar'] = 'Error borrar la oferta';
	      	$response->code['desactivar'] = $conn->errno;
   		}
 	return $response;
}
// ----------------Modificar Ofertas *unfinished---------------------
function modificarOferta($params, $conexion){
	$usuario = $conexion->usuariotests;
	$password = $conexion->passwordtests;
	$servername = $conexion->servernametests;
	$db = $conexion->db;
	$id = $params->id;
	$titulo = $params->title;
    	$contenido = $params->content;
    	$region = $params->region;
    	$tags = $params->tags;
    	$fin_oferta = $params->fin_oferta;
    	$servicios = $params->servicios;
	$sql = "UPDATE `ofertas` SET `activa`= 0 WHERE `id` = '$id'";

	$conn = new mysqli($servername, $usuario, $password,$db);
	$response = new stdClass();

	  if ($conn->connect_error) {
	    	die("Connection failed: " . $conn->connect_error);
	  }
	  if ($conn->query($sql) === TRUE) {
	    	$response->result['desactivar'] = 'OK';
	    	$response->msg['desactivar'] = 'Oferta desactivada Correctamente';
	    	$response->code['desactivar'] = '200';
	  } else {
	      	$response->result['desactivar'] = 'ERROR';
	      	$response->err['desactivar'] = 'Error borrar la oferta';
	      	$response->code['desactivar'] = $conn->errno;
   		}
 	return $response;
}
// ----------------Fin modificar Ofertas *unfinished---------------------
// ------------------ Pedir todas las ofertas (Lado administrador)-----------------
function TodasOfertas($conexion){
	$usuario = $conexion->usuariotests;
	$password = $conexion->passwordtests;
	$servername = $conexion->servernametests;
	$db = $conexion->db;
	$conn = new mysqli($servername, $usuario, $password,$db);
	if($conn->connect_error){
		die("Conexion fallida: ".$conn->connect_error);
	}
	$response = new stdClass();
	$result=$conn->query("SELECT * FROM `ofertas`");
	if ($result->num_rows > 0) {
		// output data of each row
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$response -> response['GET'] -> Titulo[$i]=$row['titulo'];
			$response -> response['GET'] -> Contenido[$i]=$row['contenido'];
			$response -> response['GET'] -> Tags[$i]=$row['tags'];
			$response -> response['GET'] -> Servicio[$i]=$row['servicios'];
			$i++;
		}
			$response->result['GET'] = 'OK';
	    	$response->msg['GET'] = 'Ofertas obtenidas correctamente';
	    	$response->code['GET'] = '200';
			$response = json_encode($response);
		return $response;
	} else {
		echo "0 Resultados";	
	}
	$conn->close();
}
//$testing = TodasOfertas($conexiondata);
switch($_SERVER['REQUEST_METHOD'])
{
case 'GET': $endpoint = TodasOfertas($conexiondata); echo $endpoint; break;
case 'POST': echo "Post funcionando"; break;
case 'PUT': echo "Put funcionando"; break;
default: echo "Error 403 Forbidden";
}
// ------------------ Fin pedir todas las ofertas (Lado administrador)-----------------
?>