<?php
$params = json_decode(file_get_contents('php://input'));
include "../../.env/base/DBEnviroment.php";
function TraerOfertasGlobales(){
	$usuario = $conexion->usuariotests;
	$password = $conexion->passwordtests;
	$servername = $conexion->servernametests;
	$db = $conexion->db;
	$conn = new mysqli($servername, $usuario, $password,$db);
	$sql = "SELECT * FROM `ofertas` WHERE (
		`region`='global' AND 
		`activa`=1)";
	if($conn->connect_error){
		die("Conexion fallida: ".$conn->connect_error);
	}
	$response = new Result();
	$result=$conn->query($sql);
	if ($result->num_rows > 0) {
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$response -> response['fetch'] -> Titulo[$i]=$row['titulo'];
			$response -> response['fetch'] -> Contenido[$i]=$row['contenido'];
			$response -> response['fetch'] -> Tags[$i]=$row['tags'];
			$response -> response['fetch'] -> Servicio[$i]=$row['servicio'];
			$response -> response['fetch'] -> Fin[$i]=$row['fin_oferta'];
			$i++;
		}
			$response->result['fetch'] = 'OK';
	    	$response->msg['fetch'] = 'Ofertas obtenidas correctamente';
	    	$response->code['fetch'] = '200';
		return $response;
	} else {
		echo "0 Resultados";	
	}
	$conn->close();

}
?>