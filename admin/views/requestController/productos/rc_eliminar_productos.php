<?php


require_once "../../../controllers/producto_controller.php";
require_once "../../../models/producto_model.php";



$id= $_POST['idProducto'];
// $id = 91;

    
    $obj = new ProductosController();
    $res = $obj->eliminarProductoController($id);
    echo json_encode($res);
    
?>
