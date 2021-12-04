<?php
$params = json_decode(file_get_contents('php://input'));
include "../../.env/base/DBEnviroment.php";
$usuario = $conexiondata->usuariotests;
$password = $conexiondata->passwordtests;
$servername = $conexiondata->servernametests;
$db = $conexiondata->db;
$conn = new mysqli($servername, $usuario, $password,$db);
$dia=date_create();
$formateado =  date_format($dia,"Y-m-d H:i:s");
$response = new stdClass();
	if(isset($params->pattern)){
	$filter = $params->pattern;
	$filter = '%'.$filter.'%';
	$sql = "SELECT * FROM `ofertas` WHERE (
		`activa`=1 AND `fin_oferta`>'$formateado' AND (servicios LIKE '$filter' OR titulo LIKE '$filter'OR contenido LIKE '$filter'))";
	if($conn->connect_error){
		die("Conexion fallida: ".$conn->connect_error);
	}
	$result=$conn->query($sql);
	if ($result->num_rows > 0) {
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$response -> response['GET'] -> Titulo[$i]=$row['titulo'];
			$response -> response['GET'] -> Contenido[$i]=$row['contenido'];
			$response -> response['GET'] -> Tags[$i]=$row['tags'];
			$response -> response['GET'] -> Servicio[$i]=$row['servicios'];
			$response -> response['GET'] -> Fin[$i]=$row['fin_oferta'];
			$i++;
		}
			$response->result['GET'] = 'OK';
	    	$response->msg['GET'] = 'Ofertas obtenidas correctamente';
	    	$response->code['GET'] = '200';
			$response = json_encode($response);
		echo $response;
	} else {
			$response->result['GET'] = 'OK';
			$response->msg['GET'] = 'No hay resultados Validos, Request valida';
			$response->code['GET'] = '200';
			$response = json_encode($response);
		echo $response;	
	}
	$conn->close();
	}else{

	$sql = "SELECT * FROM `ofertas` WHERE (
		`activa`=1 AND `fin_oferta`>'$formateado')";
	if($conn->connect_error){
		die("Conexion fallida: ".$conn->connect_error);
	}
	$result=$conn->query($sql);
	if ($result->num_rows > 0) {
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$response -> response['GET'] -> Titulo[$i]=$row['titulo'];
			$response -> response['GET'] -> Contenido[$i]=$row['contenido'];
			$response -> response['GET'] -> Tags[$i]=$row['tags'];
			$response -> response['GET'] -> Servicio[$i]=$row['servicios'];
			$response -> response['GET'] -> Fin[$i]=$row['fin_oferta'];
			$i++;
		}
			$response->result['GET'] = 'OK';
	    	$response->msg['GET'] = 'Ofertas obtenidas correctamente';
	    	$response->code['GET'] = '200';
			$response = json_encode($response);
		echo $response;
	} else {
			$response->result['GET'] = 'OK';
			$response->msg['GET'] = 'No hay resultados Validos, Request valida';
			$response->code['GET'] = '200';
			$response = json_encode($response);
		echo $response;	
	}
	$conn->close();
}
?>