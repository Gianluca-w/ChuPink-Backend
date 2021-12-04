<?php
//playground file for testing purposes
$usuariotests = "root";
$passwordtests = "";
$servernametests = "localhost";
$usuario = "";
$password = "";
$servername = "";
$db = "chupink";
$conn = new mysqli($servernametests, $usuariotests, $passwordtests,$db);
$dia=date_create();
$formateado =  date_format($dia,"Y-m-d H:i:s");
echo $formateado;
$sql = "SELECT * FROM `ofertas` WHERE (`activa`=1 AND `fin_oferta`>'$formateado')";
$response = new stdClass();
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
}

?>