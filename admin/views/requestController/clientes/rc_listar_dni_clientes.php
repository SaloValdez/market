<?php


require_once "../../../controllers/cliente_controller.php";
require_once "../../../models/cliente_model.php";


// $dniCliente = '46835582';
$dniCliente = $_POST['dniCliente'];

$obj = new ClientesController();
$resultado = $obj->listarDniClienteController($dniCliente);

echo json_encode($resultado);




