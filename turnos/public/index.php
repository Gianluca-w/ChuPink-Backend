<?php
$params = json_decode(file_get_contents('php://input'));
include "../../.env/base/DBEnviroment.php";

switch($_SERVER['REQUEST_METHOD'])
{
case 'GET': $endpoint = VerTurnos($conexiondata); echo $endpoint; break;
case 'POST': $endpoint = PedirTurno($params, $conexiondata); echo $endpoint;  break;
default: echo "Error 403 Forbidden";
}
?>