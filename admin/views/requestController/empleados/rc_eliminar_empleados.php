<?php


require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";



$idEmpleado= $_POST['idEmpleado'];
// $idSubCategoria = 1222;

    
    $obj = new EmpleadosController();
    $res = $obj->eliminarEmpleadosController($idEmpleado);
    echo json_encode($res);
    
?>
