<?php

require_once "../../../controllers/categoria_producto_controller.php";
require_once "../../../models/categoria_producto_model.php";

require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";


$obj = new CategoriaProductoController();
$resultado = $obj->listarUltimaCategoriaProductoController();

if(empty($resultado)){
    echo json_encode(array('resp'=>0));
    exit();
}
$fecha = $resultado['fecha_registro_categoria_producto'];
$hora = date("H:i:s", strtotime($fecha));


// funcion para Fecha convertir ESPAÑOL
function fechaEs($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace( $dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}



if ($resultado == 0){

    echo json_encode(array('resp'=>0));
    exit;

}else{
    $idEmpleado= $resultado['fk_id_empleado'];

    $objEmpleado = new EmpleadosController();
    $detallesEmpleado = $objEmpleado->listarIdEmpleadoController($idEmpleado);

//     echo json_encode($detallesEmpleado['arrayEmpleado']);

//     var_dump($detallesEmpleado);
//    var_dump($detallesEmpleado["arrayEmpleado"]['nombre_empleado']);

    if ($detallesEmpleado['resp'] ==1){

        $mostrarUltimoRegistro= array('resp'=>1,$resultado,$detallesEmpleado,'fecha'=>fechaEs($fecha),'hora'=>$hora);
        echo json_encode($mostrarUltimoRegistro);
         
    }else{
        echo json_encode(array('resp'=>0));
        exit;
    }

}



?>








