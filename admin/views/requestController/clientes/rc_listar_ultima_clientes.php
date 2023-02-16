<?php

// require_once "../../../controllers/subcategoria_producto_controller.php";
// require_once "../../../models/subcategoria_producto_model.php";

require_once "../../../controllers/cliente_controller.php";
require_once "../../../models/cliente_model.php";

require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";


$obj = new ClientesController();
$resultado = $obj->listarUltimoClienteController();

// var_dump($resultado);
if (empty($resultado)){
    echo json_encode(array('resp'=>0));
    exit();     
}


$fecha = $resultado['arrayRegistro']['fecha_registro_cliente'];
$hora = date("H:i:s", strtotime($fecha));


// var_dump($fecha);
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
    $idEmpleado= $resultado['arrayRegistro']['fk_id_empleado'];

    $objEmpleado = new EmpleadosController();
    $detallesEmpleado = $objEmpleado->listarIdEmpleadoController($idEmpleado);


    if ($detallesEmpleado['resp'] ==1){

        $mostrarUltimoRegistro= array('resp'=>1,$resultado,
                                       $detallesEmpleado,           
                                       'fecha'=>fechaEs($fecha),
                                       'hora'=>$hora);
        echo json_encode($mostrarUltimoRegistro);
         
    }else{
        echo json_encode(array('resp'=>0));
        exit;
    }

}

?>








