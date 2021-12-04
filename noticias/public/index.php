<?php
$params = json_decode(file_get_contents('php://input'));
include "../../.env/base/DBEnviroment.php";
$usuario = $conexiondata->usuariotests;
$password = $conexiondata->passwordtests;
$servername = $conexiondata->servernametests;
$db = $conexiondata->db;
$conn = new mysqli($servername, $usuario, $password,$db);
$response = new stdClass();
	if(isset($params->pattern)){
	$filter = $params->pattern;
	//sanitize this tshit
	$filter = '%'.$filter.'%';
	$sql = "SELECT * FROM `noticias` WHERE (enabled = 1 AND (titulo LIKE '$filter' OR contenido LIKE '$filter' OR tags LIKE '$filter'))";
	if($conn->connect_error){
		die("Conexion fallida: ".$conn->connect_error);
	}
	$result=$conn->query($sql);
	if ($result->num_rows > 0) {
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$response -> response['GET'] -> Titulo[$i]=$row['titulo'];
			$response -> response['GET'] -> Contenido[$i]=$row['contenido'];
			$response -> response['GET'] -> Tags[$i]=$row['img'];
			$response -> response['GET'] -> Servicio[$i]=$row['tags'];
			$i++;
		}
			$response->result['GET'] = 'OK';
	    	$response->msg['GET'] = 'Noticias obtenidas correctamente';
	    	$response->code['GET'] = '200';
			$response = json_encode($response);
		echo $response;
	} else {
		$response->result['GET'] = 'OK';
	    	$response->msg['GET'] = 'Ningun resultado obtenido';
	    	$response->code['GET'] = '200';
			$response = json_encode($response);
		echo $response;
	}
	$conn->close();
	}else{
	$sql = "SELECT * FROM `noticias` WHERE (enabled = 1)";
	if($conn->connect_error){
		die("Conexion fallida: ".$conn->connect_error);
	}
	$result=$conn->query($sql);
	if ($result->num_rows > 0) {
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$response -> response['GET'] -> Titulo[$i]=$row['titulo'];
			$response -> response['GET'] -> Contenido[$i]=$row['contenido'];
			$response -> response['GET'] -> Tags[$i]=$row['img'];
			$response -> response['GET'] -> Servicio[$i]=$row['tags'];
			$i++;
		}
			$response->result['GET'] = 'OK';
	    	$response->msg['GET'] = 'Noticias obtenidas correctamente';
	    	$response->code['GET'] = '200';
			$response = json_encode($response);
		echo $response;
	} else {
		$response->result['GET'] = 'OK';
	    	$response->msg['GET'] = 'Ningun resultado obtenido';
	    	$response->code['GET'] = '200';
			$response = json_encode($response);
		echo $response;
	}
	$conn->close();
}
?>