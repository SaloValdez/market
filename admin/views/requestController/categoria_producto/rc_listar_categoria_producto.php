<?php


require_once "../../../controllers/categoria_producto_controller.php";
require_once "../../../models/categoria_producto_model.php";


$obj = new CategoriaProductoController();
$resultado = $obj->listarCategoriaProductoController();

echo json_encode($resultado);



