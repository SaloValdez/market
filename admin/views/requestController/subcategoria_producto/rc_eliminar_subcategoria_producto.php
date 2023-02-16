<?php


require_once "../../../controllers/subcategoria_producto_controller.php";
require_once "../../../models/subcategoria_producto_model.php";




$idSubCategoria= $_POST['id_subcategoria'];
// $idSubCategoria = 1222;

    
    $obj = new SubCategoriaProductoController();
    $res = $obj->eliminarSubCategoriaController($idSubCategoria);
    echo json_encode($res);
    
?>
