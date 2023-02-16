<?php


require_once "../../../controllers/categoria_producto_controller.php";
require_once "../../../models/categoria_producto_model.php";



// $idCategoria = $_POST['id_categoria'];
$idCategoria = 129;

$obj = new CategoriaProductoController();
$resultado = $obj->listarIdCategoriaController($idCategoria);

echo json_encode($resultado);




