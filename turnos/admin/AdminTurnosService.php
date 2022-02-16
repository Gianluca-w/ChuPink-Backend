<?php
$params = json_decode(file_get_contents('php://input'));
include "../../.env/base/DBEnviroment.php";

 // header('Content-Type: application/json'); use this to send shit
  //Functions definitions, i can recive and send objects.
  //---------------------Inicio Subir Turno----------------------
function subirTurno($params, $conexion){
    $response = new stdClass();
	$usuario = $conexion->usuariotests;
    $password = $conexion->passwordtests;
    $servername = $conexion->servernametests;
    $db = $conexion->db;
}
//---------------------Fin Subir Turno----------------------
//----------------------Inicio Borrar turnos-------------------------------
function borrarTurno($params, $conexion){
}
//----------------------Fin Borrar turnos-------------------------------
// ----------------Modificar Ofertas *unfinished---------------------
function modificarTurno($params, $conexion){
}
// ----------------Fin modificar Ofertas *unfinished---------------------
// ------------------ Pedir todas las ofertas (Lado administrador)-----------------
function todosTurnos($conexion){
    $usuario = $conexion->usuariotests;
	$password = $conexion->passwordtests;
	$servername = $conexion->servernametests;
	$db = $conexion->db;
    $sql = "SELECT a.cliente, a.apellido, a.telefono, a.hora_turno, a.duracion, a.confirmado, a.codigo_confirm, b.nombre\n"

    . "                FROM turnos a, personal b\n"

    . "                WHERE a.empleado_asignado = b.id";
	$conn = new mysqli($servername, $usuario, $password,$db);
	if($conn->connect_error){
		die("Conexion fallida: ".$conn->connect_error);
	}
	$response = new stdClass();
	$result=$conn->query("SELECT * FROM `turnos`");
	if ($result->num_rows > 0) {
		// output data of each row
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$response -> response['GET'] -> Nombre[$i]=$row['cliente'];
			$response -> response['GET'] -> Apellido[$i]=$row['apellido'];
			$response -> response['GET'] -> Telefono[$i]=$row['telefono'];
			$response -> response['GET'] -> HoraTurno[$i]=$row['hora_turno'];
            $response -> response['GET'] -> Duracion[$i]=$row['duracion'];
            $response -> response['GET'] -> Duracion[$i]=$row['confirmado'];
			$response -> response['GET'] -> CodigoConfirmacion[$i]=$row['codigo_confirm'];
			$response -> response['GET'] -> Tags[$i]=$row['nombre'];
			$i++;
		}
			$response->result['GET'] = 'OK';
	    	$response->msg['GET'] = 'Ofertas obtenidas correctamente';
	    	$response->code['GET'] = '200';
			$response = json_encode($response);
		    return $response;
	} else {
		$response = json_encode($response);
		return $response;	
	}
	$conn->close();
}
//$testing = TodasOfertas($conexiondata);
switch($_SERVER['REQUEST_METHOD'])
{
case 'GET': $endpoint = todosTurnos($conexiondata); echo $endpoint; break;
case 'POST': $endpoint = subirTurno($params, $conexiondata); echo $endpoint;  break;
case 'PUT': $endpoint = modificarTurno($params, $conexiondata); break;
case 'DELETE': $endpoint = borrarTurno($params, $conexiondata); echo $endpoint; break;
default: echo "Error 400 Bad Request";
}
// ------------------ Fin pedir todas las ofertas (Lado administrador)-----------------
?>