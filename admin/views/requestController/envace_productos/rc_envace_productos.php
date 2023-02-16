<?php 
require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";

require_once "../../../controllers/envace_producto_controller.php";
require_once "../../../models/envace_producto_model.php";

session_start();
$sessionIdEmpleado=$_SESSION['idEmpleado'];

date_default_timezone_set("America/Lima");
$fechaRegistro = date('Y-m-d H:i:s');


if(isset($_POST['idEnvace'])){
    $postIdEnvace = $_POST['idEnvace'];
}


if(isset($_POST['datosForm'])){
    $datosForm=$_POST['datosForm'];
    parse_str($datosForm,$myArray);
    
    $datos  = array(
        'detalleEnvaceProducto' =>$myArray['detalleEnvaceProducto'],
        'fechaRegistroEnvaceProducto' =>$fechaRegistro,
        'fkIdEmpleado' =>$sessionIdEmpleado
      );

    if(isset($_POST['idEnvace'])){
        $datos['idEnvaceProducto'] = $_POST['idEnvace'];
    }
}


if(isset($_POST['tipo'])){
    $tipo = $_POST['tipo'];
}


switch ($tipo){
    case 'insertar':  
        echo json_encode(insertarEnvace($datos));
        break;
    case 'actualizar':  
        echo json_encode(actualizarEnvace($datos));
        break;
    case 'eliminar':  
        echo json_encode(eliminarEnvace($postIdEnvace));
        break;  
    case 'mostrarId':  
        echo json_encode(mostrarIdEnvace($postIdEnvace));
        break;  
    case 'listarTabla':  
        echo listarEnvaceTabla();
        break;    
    case 'listar':  
        echo  json_encode(listarEnvace());
        break;  
}
function listarEnvace(){
    $obj= new EnvaceProductosController();
    $res = $obj->listarEnvaceProductoController();
    return $res;
}

function actualizarEnvace($datos){
    $obj= new EnvaceProductosController();
    $res = $obj->actualizarEnvaceProductosController($datos);
    return $res;
}

function insertarEnvace($datos){
    $obj= new EnvaceProductosController();
    $res = $obj->insertarEnvaceProductoController($datos);
     return $res;
}

function mostrarIdEnvace($id){
  $obj = new EnvaceProductosController();
  $res = $obj->listarIdEnvaceProductoController($id);
  return $res;
}

function listarEnvaceTabla(){          
        ?>
    <table id="miTabla"  class="display responsive nowrap miTabla" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>Detalle</th>
                <th>Fech. Reg</th>
                <th>Empleado</th>
                <th>Accion</th>
            </tr>
        </thead>

        <tbody>
        <?php 
        $objEmpleado = new EmpleadosController();
        $obj= new EnvaceProductosController();
        $res = $obj->listarEnvaceProductoController();
        if(!empty($res['arrayEnvaceProductos'])){
            $arrayEnvace = $res['arrayEnvaceProductos'];
                    foreach ($arrayEnvace as $key => $value){
                        $resIdEmpleado = $objEmpleado->listarIdEmpleadoController($value['fk_id_empleado']);
                    ?>
                        <tr>
                            <td><?php echo $value['id_envace_producto'] ?></td>
                            <td><?php echo $value['detalle_envace_producto'] ?></td>
                            <td><?php echo $value['fecha_registro_envace_producto'] ?></td>
                            <td style=" "><?php  echo $resIdEmpleado['arrayEmpleado']['nombre_empleado'].'-'.$resIdEmpleado['arrayEmpleado']['apellido_empleado']; ?></td>
                            <td style="text-align: right;">
                                <a href="#" class="btnDatatatbleInfo"  onclick="btnAccionMostrarDatosEnvace(<?php echo $value['id_envace_producto'];?>);">
                                    <i class="fa-solid fa-arrow-left"></i> 
                                </a>
                            </td>
                        </tr>
                    <?php 
                    }
        }
                    ?>
         </tbody>
    </table> 

        <script type="text/javascript" language="javascript" src="./views/src/lib/datatable/miDatatable.js"></script>
        <?php 
} 

function eliminarEnvace($datos){
    $obj= new EnvaceProductosController();
    $res = $obj->eliminarEnvaceProductoController($datos);
    return $res;
}



