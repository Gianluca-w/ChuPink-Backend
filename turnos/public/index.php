<?php
$params = json_decode(file_get_contents('php://input'));
function VerTurnos(){
    include "../../.env/base/DBEnviroment.php";
    $response = new stdClass();
	$usuario = $conexiondata->usuariotests;
	$password = $conexiondata->passwordtests;
	$servername = $conexiondata->servernametests;
	$db = $conexiondata->db;
	$conn = new mysqli($servername, $usuario, $password,$db);
    $sql = "SELECT a.hora_turno, a.duracion, b.nombre\n"

    . "                FROM turnos a, personal b\n"

    . "                WHERE a.empleado_asignado = b.id";
	if($conn->connect_error){
		die("Conexion fallida: ".$conn->connect_error);
	}
	$result=$conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$response -> response['GET'] -> HoraTurno[$i]=$row['hora_turno'];
			$response -> response['GET'] -> Duracion[$i]=$row['duracion'];
			$response -> response['GET'] -> Empleado[$i]=$row['nombre'];
			$i++;
		}
			$response->result['GET'] = 'OK';
	    	$response->msg['GET'] = 'Turnos obtenidos correctamente';
	    	$response->code['GET'] = '200';
			$response = json_encode($response);
		    echo $response;
	} else {
		$response->result['GET'] = 'OK';
	    	$response->msg['GET'] = 'No hay turnos disponibles';
	    	$response->code['GET'] = '200';
			$response = json_encode($response);
		    echo $response;
	}
	$conn->close();

}
function PedirTurnos($params, $conexion){
    include "../../.env/base/DBEnviroment.php";
    $response = new stdClass();
	$usuario = $conexiondata->usuariotests;
	$password = $conexiondata->passwordtests;
	$servername = $conexiondata->servernametests;
	$db = $conexiondata->db;
    $nombre = $params -> nombre;
    $apellido = $params -> apellido;
    $turno = $params -> horaTurno;
    $empleado = $params -> empleado;
    $telefono = $params -> telefono;
    $confirmacion = rand(0,9999);
	
    $conn = new mysqli($servername, $usuario, $password,$db);
    $sql = "INSERT INTO turnos(nombre, apellido, telefono, hora_turno, codigo_confirm, empleado_asignado, added_by) VALUES ('$nombre','$apellido','$telefono','$turno','$confirmacion','$empleado','system')";
	if ($conn->query($sql) === TRUE) {
		//instertar API Whatsapp
        $response->result['POST'] = 'OK';
        $response->msg['POST'] = 'Turno Reservado, Confirmacion pendiente';
        $response->code['POST'] = '200';
		$response->confirm['POST'] = $confirmacion;
		$response = json_encode($response);
		    echo $response;

	} else {
          $response->result['POST'] = 'ERROR';
          $response->err['POST'] = 'Error al pedir el turno: '.$conn->error;
          $response->code['POST'] = $conn->errno;
		  $response = json_encode($response);
		    echo $response;
    }
}
switch($_SERVER['REQUEST_METHOD'])
{
case 'GET': $endpoint = VerTurnos($conexiondata); echo $endpoint; break;
case 'POST': $endpoint = PedirTurno($params, $conexiondata); echo $endpoint;  break;
default: echo "Error 400 Bad Request";
}
?>