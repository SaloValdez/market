<?php


require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";



$idEmpleado = $_POST['idEmpleado'];

$obj = new EmpleadosController();
$resultado = $obj->listarIdEmpleadoController($idEmpleado);

echo json_encode($resultado);




