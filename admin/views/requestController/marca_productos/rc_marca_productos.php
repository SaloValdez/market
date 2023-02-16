<?php 
require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";

require_once "../../../controllers/marca_producto_controller.php";
require_once "../../../models/marca_producto_model.php";

session_start();
$sessionIdEmpleado=$_SESSION['idEmpleado'];

date_default_timezone_set("America/Lima");
$fechaRegistro = date('Y-m-d H:i:s');


if(isset($_POST['idMarca'])){
    $postIdMarca = $_POST['idMarca'];
}


if(isset($_POST['datosForm'])){
    $datosForm=$_POST['datosForm'];
    parse_str($datosForm,$myArray);
    
    $datos  = array(
        'detalleMarcaProducto' =>$myArray['detalleMarcaProducto'],
        'fechaRegistroMarcaProducto' =>$fechaRegistro,
        'fkIdEmpleado' =>$sessionIdEmpleado
      );

    if(isset($_POST['idMarca'])){
        $datos['idMarcaProducto'] = $_POST['idMarca'];
    }
}


if(isset($_POST['tipo'])){
    $tipo = $_POST['tipo'];
}else{
    $tipo = 'listar';
}

// $datos = array(
//                 'idMarcaProducto' =>1,
//                 'detalleMarcaProducto' =>'SAPOLIO',
//                 'fechaRegistroMarcaProducto' =>$fechaRegistro,
//                 'fkIdEmpleado' =>$sessionIdEmpleado
// );

// $postIdMarca = 4;
switch ($tipo){
    case 'insertar':  
        echo json_encode(insertarMarca($datos));
        break;
    case 'actualizar':  
        echo json_encode(actualizarMarca($datos));
        break;
    case 'eliminar':  
        echo json_encode(eliminarMarca($postIdMarca));
        break;  
    case 'mostrarId':  
        echo json_encode(mostrarIdMarca($postIdMarca));
        break;  
    case 'listarTabla':  
        echo listarMarcaTabla();
        break;    
    case 'listar':  
        echo  json_encode(listarMarca());
        break;  
    case 'test':  
        echo json_encode('Modo test');
        break;  
    default:
     echo json_encode('sin exito');
}
function listarMarca(){
    $obj= new MarcaProductosController();
    $res = $obj->listarMarcaProductoController();
    return $res;
}

function actualizarMarca($datos){
    $obj= new MarcaProductosController();
    $res = $obj->actualizarMarcaProductosController($datos);
    return $res;
}

function insertarMarca($datos){
    $obj= new MarcaProductosController();
    $res = $obj->insertarMarcaProductoController($datos);
     return $res;
}

function mostrarIdMarca($id){
  $obj = new MarcaProductosController();
  $res = $obj->listarIdMarcaProductoController($id);
  return $res;
}

function listarMarcaTabla(){          
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
        $obj= new MarcaProductosController();
        $res = $obj->listarMarcaProductoController();
        if(!empty($res['arrayMarcaProductos'])){
            $arrayMarca = $res['arrayMarcaProductos'];
                    foreach ($arrayMarca as $key => $value){
                        $resIdEmpleado = $objEmpleado->listarIdEmpleadoController($value['fk_id_empleado']);
                    ?>
                        <tr>
                            <td><?php echo $value['id_marca_producto'] ?></td>
                            <td><?php echo $value['detalle_marca_producto'] ?></td>
                            <td><?php echo $value['fecha_registro_marca_producto'] ?></td>
                            <td style=" "><?php  echo $resIdEmpleado['arrayEmpleado']['nombre_empleado'].'-'.$resIdEmpleado['arrayEmpleado']['apellido_empleado']; ?></td>
                            <td style="text-align: right;">
                                <a href="#" class="btnDatatatbleInfo"  onclick="btnAccionMostrarDatosMarca(<?php echo $value['id_marca_producto'];?>);">
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

function eliminarMarca($datos){
    $obj= new MarcaProductosController();
    $res = $obj->eliminarMarcaProductoController($datos);
    return $res;
}



