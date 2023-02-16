<?php


require_once "../../../controllers/categoria_producto_controller.php";
require_once "../../../models/categoria_producto_model.php";

session_start();
$sessionIdEmpleado=$_SESSION['idEmpleado'];

$idCategoria= $_POST['idCategoriaProducto'];
$detalleCategoria = $_POST['detalleCategoriaProducto'];
date_default_timezone_set("America/Lima");
$fechaRegistroCategoriaProducto =date('Y-m-d H:i:s');

$datos = array(
    'detalleCategoriaProducto'=>$detalleCategoria,
    'fechaRegistroCategoriaProducto'=>$fechaRegistroCategoriaProducto,
    'fkIdEmpleado'=>$sessionIdEmpleado, 
    'idCategoriaProducto'=>$idCategoria
);

$obj = new CategoriaProductoController();
$res = $obj -> actualizarCategorioProductoController($datos);
    echo json_encode($res);



// 
    // $obj = new CategoriaProductoController();
    // $res = $obj->actualizarCategorioProductoController($datos);
    // echo json_encode($res);
    
?>
