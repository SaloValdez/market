<?php


require_once "../../../controllers/producto_controller.php";
require_once "../../../models/producto_model.php";



$idProducto = $_POST['idProducto'];
// $idProducto = 74;

$obj = new ProductosController();
$resultado = $obj->listarIdProductoController($idProducto);

echo json_encode($resultado);




