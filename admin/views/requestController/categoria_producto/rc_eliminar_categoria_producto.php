<?php


require_once "../../../controllers/categoria_producto_controller.php";
require_once "../../../models/categoria_producto_model.php";




$idCategoria= $_POST['id_categoria'];
// $idCategoria = 73;

    
    $obj = new CategoriaProductoController();
    $res = $obj->eliminarCategoriaController($idCategoria);
    echo json_encode($res);
    
?>
