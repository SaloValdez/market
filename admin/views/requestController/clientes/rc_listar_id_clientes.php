<?php


require_once "../../../controllers/cliente_controller.php";
require_once "../../../models/cliente_model.php";



$idCliente = $_POST['idCliente'];
// $idCliente = 8;

$obj = new ClientesController();
$resultado = $obj->listarIdClientesController($idCliente);

echo json_encode($resultado);




