<?php


require_once "../../../controllers/subcategoria_producto_controller.php";
require_once "../../../models/subcategoria_producto_model.php";



$idSubCategoria = $_POST['id_subcategoria'];

$obj = new SubCategoriaProductoController();
$resultado = $obj->listarIdSubCategoriaController($idSubCategoria);

echo json_encode($resultado);




