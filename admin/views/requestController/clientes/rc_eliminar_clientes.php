<?php


require_once "../../../controllers/cliente_controller.php";
require_once "../../../models/cliente_model.php";



$idCliente= $_POST['idCliente'];
// $idCliente = 12;

    
    $obj = new ClientesController();
    $res = $obj->eliminarClientesController($idCliente);
    echo json_encode($res);
    
?>
