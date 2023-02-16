<?php


require_once "../../../controllers/subcategoria_producto_controller.php";
require_once "../../../models/subcategoria_producto_model.php";



date_default_timezone_set("America/Lima");

session_start();
$sessionIdEmpleado=$_SESSION['idEmpleado'];

$fechaRegistroCategoriaProducto = date('Y-m-d H:i:s');
$nombreSubCategoria =$_POST['detalleSubCategoriaProducto'];
$idEmpleado=$sessionIdEmpleado;
$idCategoria =$_POST['categoriaProductoSelect'];



$datos  = array(
    'detalleSubCategoriaProducto'=>$nombreSubCategoria,  
    'fechaRegistroSubCategoriaProducto' => $fechaRegistroCategoriaProducto,
    'fkIdEmpleado'=>$idEmpleado,
    'fkIdCategoriaProducto'=>$idCategoria
    
    );



    // $datos  = array(
    //     'detalleSubCategoriaProducto'=>'eddw3ERER',  
    //     'fechaRegistroSubCategoriaProducto' => '12-12-12',
    //     'fkIdEmpleado'=>7,
    //     'fkIdCategoriaProducto'=>133
    // //     );
        
    //     echo json_encode($datos);
    
    $obj = new SubCategoriaProductoController();
    $res = $obj->insertarSubCategoriaProductoController($datos);
    echo json_encode($res);
    
?>
