<?php 

require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";


session_start();
$sessionIdEmpleado = $_SESSION['idEmpleado'];
// $sessionIdEmpleado = 7;

$obj = new EmpleadosController();
$res = $obj->listarIdEmpleadoController($sessionIdEmpleado);




echo json_encode($res);



