<?php


require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";


// $dniEmpleado = '46835582';
$dniEmpleado = $_POST['dniEmpleado'];

$obj = new EmpleadosController();
$resultado = $obj->listarDniEmpleadoController($dniEmpleado);

echo json_encode($resultado);




