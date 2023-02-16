<?php


require_once "../../../controllers/subcategoria_producto_controller.php";
require_once "../../../models/subcategoria_producto_model.php";

session_start();
$sessionIdEmpleado=$_SESSION['idEmpleado'];

$idSubCategoria= $_POST['idSubCategoriaProducto'];
$detalleSubCategoria = $_POST['detalleSubCategoriaProducto'];
date_default_timezone_set("America/Lima");
$fechaRegistroSubCategoriaProducto =date('Y-m-d H:i:s');
$idCategoria = $_POST['categoriaProductoSelect'];

$datos = array(
    'detalleSubCategoriaProducto'=>$detalleSubCategoria,
    'fechaRegistroSubCategoriaProducto'=>$fechaRegistroSubCategoriaProducto,
    'fkIdEmpleado'=>$sessionIdEmpleado, 
    'fkIdCategoriaProducto'=>$idCategoria,
    'idSubCategoriaProducto'=>$idSubCategoria
);

$obj = new SubCategoriaProductoController();
$res = $obj -> actualizarSubCategorioProductoController($datos);
    echo json_encode($res);



// 
    // $obj = new CategoriaProductoController();
    // $res = $obj->actualizarCategorioProductoController($datos);
    // echo json_encode($res);
    
?>
