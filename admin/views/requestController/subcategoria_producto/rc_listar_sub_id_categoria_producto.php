<?php


require_once "../../../controllers/subcategoria_producto_controller.php";
require_once "../../../models/subcategoria_producto_model.php";



$idCategoria = $_POST['dato'];

// $idCategoria = 132;

$obj = new SubCategoriaProductoController();
$resultado = $obj->listarSub_IdCategoriaController($idCategoria);

echo json_encode($resultado);




