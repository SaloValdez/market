<?php


require_once "../../../controllers/categoria_producto_controller.php";
require_once "../../../models/categoria_producto_model.php";



date_default_timezone_set("America/Lima");

session_start();
$sessionIdEmpleado=$_SESSION['idEmpleado'];

$fechaRegistroCategoriaProducto = date('Y-m-d H:i:s');
$nombreCategoria =$_POST['detalleCategoriaProducto'];
$idEmpleado=$sessionIdEmpleado;



$datos  = array(
    'detalleCategoriaProducto'=>$nombreCategoria,  
    'fechaRegistroCategoriaProducto' => $fechaRegistroCategoriaProducto,
    'fkIdEmpleado'=>$idEmpleado
    
    );
    
    
    $obj = new CategoriaProductoController();
    $res = $obj->insertarCategoriaProductoController($datos);
    echo json_encode($res);
    
?>
