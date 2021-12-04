<?php
$params = json_decode(file_get_contents('php://input'));
include "../../.env/base/DBEnviroment.php";

 // header('Content-Type: application/json'); use this to send shit
  //Functions definitions, i can recive and send objects.
function subirOferta($params, $conexion){
		$response = new stdClass();
		$usuario = $conexion->usuariotests;
    	$password = $conexion->passwordtests;
    	$servername = $conexion->servernametests;
    	$db = $conexion->db;
		if(isset($params->titulo,$params->contenido,$params->region,$params->servicios,$params->user)){
		$titulo = $params->titulo;
    	$contenido = $params->contenido;
    	$region = $params->region;
    	$tags = $params->tags;
    	$fin_oferta = $params->fin_oferta; //*Hacer si esto no esta definido que mande dia de hoy +7 dias a las 8AM
    	$servicios = $params->servicios;
    	$activa = $params->activa;
		$user = $params->user;
    	$sql = "INSERT INTO ofertas(titulo, contenido, region, tags, fin_oferta, servicios, activa, added_by) 
        VALUES ('$titulo','$contenido','$region','$tags','$fin_oferta','$servicios','$activa','$user')";
    	$conn = new mysqli($servername, $usuario, $password,$db);
      	if ($conn->connect_error) {
        	die("Connection failed: " . $conn->connect_error);
      	}
      	if ($conn->query($sql) === TRUE) {
        	$response->result['POST'] = 'OK';
        	$response->msg['POST'] = 'Oferta Agregada Correctamente';
        	$response->code['POST'] = '200';
      	} else {
          	$response->result['POST'] = 'ERROR';
          	$response->err['POST'] = 'Error al subir la oferta: '.$conn->error;
          	$response->code['POST'] = $conn->errno;
        }
		$response = json_encode($response);
		return $response;
		}else{
			$response->result['POST'] = 'ERROR';
          	$response->err['POST'] = 'Error al subir la oferta: Faltan campos obligatorios';
          	$response->code['POST'] = 1026;
			$response = json_encode($response);
			return $response;
		}
    	
}

function borrarOferta($params, $conexion){
    	$usuario = $conexion->usuariotests;
    	$password = $conexion->passwordtests;
    	$servername = $conexion->servernametests;
    	$db = $conexion->db;
		$response = new stdClass();
    	if(isset($params->id)){
			$id = $params ->id;
    	$sql = "UPDATE `ofertas` SET `enabled`= 0 WHERE `id` = '$id'";
    	$conn = new mysqli($servername, $usuario, $password,$db);
      	if ($conn->connect_error) {
        	die("Connection failed: " . $conn->connect_error);
      	}
      	if ($conn->query($sql) === TRUE) {
        	$response->result['DELETE'] = 'OK';
        	$response->msg['DELETE'] = 'Oferta borrada Correctamente';
        	$response->code['DELETE'] = '200';
      	} else {
          	$response->result['DELETE'] = 'ERROR';
          	$response->err['DELETE'] = 'Error borrar la oferta';
          	$response->code['DELETE'] = $conn->errno;
        }
			$response = json_encode($response);
        return $response;
	}else{
			$response->result['DELETE'] = 'ERROR';
          	$response->err['DELETE'] = 'Id de la oferta no recibido';
          	$response->code['DELETE'] = '400';
			$response = json_encode($response);
		return $response;
	}
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
case 'POST': $endpoint = subirOferta($params, $conexiondata); echo $endpoint;  break;
case 'PUT': echo "Put funcionando"; break;
case 'DELETE': $endpoint = borrarOferta($params, $conexiondata); echo $endpoint; break;
default: echo "Error 403 Forbidden";
}
// ------------------ Fin pedir todas las ofertas (Lado administrador)-----------------
?>