<?php 
require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";

require_once "../../../controllers/realizar_venta_controller.php";
require_once "../../../models/realizar_venta_model.php";

require_once "../../../controllers/producto_controller.php";
require_once "../../../models/producto_model.php";

require_once "../../../controllers/inventario_controller.php";
require_once "../../../models/inventario_model.php";

$obj = new RealizarVentaController();



session_start();
$sessionIdEmpleado=$_SESSION['idEmpleado'];



// session_start();
// $_SESSION['sessionComprobante'] = array();
// $_SESSION['sessionComprobante']['idComprobanteSession'] = 1000;
// $_SESSION['sessionComprobante']['idEmpleado'] = 7;






// $obj = new RealizarVentaController();
// $idProductos = array('idTempDetalleComprobante'=>91,'fkIdProducto'=>103,'cantidadPedido'=>5);
// $res = $obj->actualizarCantidadProductoDetalleController($idProductos);
// echo json_encode($res);












date_default_timezone_set("America/Lima");
$fechaRegistro = date('Y-m-d H:i:s');

$ipCliente = getenv('REMOTE_ADDR');


  $tipo = $_POST['tipo'];
// $tipo = 'listar';
// $idTempComprobantePOST = array('fkIdTempComprobante'=>129);

if(isset($_POST['idTempComprobante'])){
    $id = $_POST['idTempComprobante'];
    $idTempComprobantePOST = array('fkIdTempComprobante'=>$id);
}



if(isset($_POST['valorFiltroProducto'])){
        $valorFiltroProducto = $_POST['valorFiltroProducto'];
}
if(isset($_POST['idProducto'])){
    $idProducto = $_POST['idProducto'];
}

if(isset($_POST['idDetalle'])){
    $idDetalle = $_POST['idDetalle'];
}



$datos_Temp_AgregarComprobante  = array(
    'fechaTempComprobante' =>$fechaRegistro,
    'estadoTempComprobante' =>0,
    'ipTempComprobante' =>$ipCliente,
    'fkIdTempEmpleado' =>$sessionIdEmpleado
  );

if(isset($_POST['datosForm_Temp_AgregarDetalle'])){
    $datosForm=$_POST['datosForm_Temp_AgregarDetalle'];
    parse_str($datosForm,$myArray);
    $datos_Temp_AgregarDetalle  = array(
        'cantidadTempDetalleComprobante' =>$myArray['cantidadProducto'],
        'precioUnitarieTempDetalleComprobante' =>$myArray['precioProducto'],
        'fkIdTempProducto' =>$myArray['idProducto'],
        // 'fkIdTempComprobante' =>500,
        'fkIdTempComprobante' =>$myArray['idTempComprobante'],

        'accion' =>'agregar'
      );
      $idTempComprobante = $myArray['idTempComprobante'];

}

// if(isset($_POST['sumarCantidad'])){
//     $bari = $_POST['sumarCantidad'];

// }


if(isset($_POST['datosSumarRestarUnoCantidad'])){
    // $datosSumaRestaCantidadDetalle = $_POST['datosSumarCantidad'];

        if($_POST['datosSumarRestarUnoCantidad']['cantidadPedido']==''){
             $cantidadPedido = 0.00;
        }else{
            $cantidadPedido=$_POST['datosSumarRestarUnoCantidad']['cantidadPedido'];
        }
        $datosSumaRestaCantidadDetalle = array(
            'idTempDetalleComprobante'=>$_POST['datosSumarRestarUnoCantidad']['idTempDetalleComprobante'],
            'fkIdProducto'=>$_POST['datosSumarRestarUnoCantidad']['fkIdProducto'],
            'cantidadPedido'=>$cantidadPedido,
            'tipoAccion'=>$_POST['datosSumarRestarUnoCantidad']['tipoAccion']
        );
}
 
    if(isset($_POST['idDescuento']) AND isset($_POST['idTemComprobante'])){
        $idDescuento = $_POST['idDescuento'];
        $idTemComprobante = $_POST['idTemComprobante'];
    }




switch ($tipo){
    case 'sumaRestaCantidadDetalleUno_a_Uno':  
        echo json_encode(sumaRestaCantidadDetalleUno_a_Uno($datosSumaRestaCantidadDetalle));
        break; 
    case 'eliminarProductoDetalle':  
        echo json_encode(eliminarProductoDetalle($idDetalle));
        break; 
    case 'verificarComprobanteEmpleado':  
        echo json_encode(verificarComprobante($sessionIdEmpleado));
        break; 
    case 'agregarTempDetalleComprobante':  
        echo json_encode(agregar_temp_detalleComprobante($datos_Temp_AgregarComprobante,$datos_Temp_AgregarDetalle,$idTempComprobante));
        break;  
    case 'listarIdProductoInventario':  
        echo json_encode(listarIdProductoInventario($idProducto));
        break;  
    case 'filtrarProducto':  
        // echo json_encode('comoniti');
        echo json_encode(filtrarProducto($valorFiltroProducto));
        break;    
    case 'listar':  
            $varFunction = listarDetalleComprobante($idTempComprobantePOST);
            if($varFunction == 0){
                echo json_encode(0);
            }else{
                echo $varFunction;
            }
        break; 
    case 'listarIdDescuento':  
        // echo json_encode('comoniti');
        echo json_encode(lisarIdSelectTipoDescuento($idDescuento,$idTemComprobante));
        break;
        
    // case 'listarId_temp_Comprobante':  

    //     echo json_encode(listar_id_temp_comprobante($idTempComprobante));
    //     break;  

    default:
     echo json_encode('sin exito');
}

function lisarIdSelectTipoDescuento($idDescuen,$idTemComproba){

    // return $datos;
    $obj = new RealizarVentaController();
    $resDescuento = $obj->lisarIdSelectTipoDescuentoController($idDescuen);
    // return $res;

    $resTempComprobante = listar_id_temp_comprobante($idTemComproba);

$resultado = array('arrayDescuento'=>$resDescuento,'arrayTempComprobante'=>$resTempComprobante);


return $resultado;



}

function sumaRestaCantidadDetalleUno_a_Uno($datos){

    // return $datos;
    $obj = new RealizarVentaController();
    $res = $obj->actualizarCantidadProductoDetalleController($datos);
    return $res;
}

function  eliminarProductoDetalle($idDetalle){
        
    $obj = new RealizarVentaController();
    $res = $obj-> eliminar_Temp_ProductoDetalleController($idDetalle);
    $return = $res;
    return $return;
// return $idDetalleProducto;
}


function verificarComprobante($idEmpleado){
    // Verificar si comprobante no esta guardado 
    $obj = new RealizarVentaController();
    $res = $obj-> verificarComprobanteEmpleadoController($idEmpleado);
    $return = $res;
    if($res['resp']==1){
        $return = array('resp'=>1,'idTempComprobante' =>$res['arrayVerificarComprobanteEmpleado'][0]['id_temp_comprobante']);
    }else{
        $return = array('resp'=>0);
    }
    return $return;
}



function agregar_temp_detalleComprobante($datos1,$datos2,$id_temp_comprobante){
    $obj = new RealizarVentaController();
    if(empty($datos2['fkIdTempProducto'])){
        return  array('resp' => 0,'txt'=>'Seleccione unproducto por favor');
   
    }
    if(empty($datos2['cantidadTempDetalleComprobante'])){
        return array('resp' => 0,'txt'=>'Agrege cantidad por favor');
    }else{
        if(empty($id_temp_comprobante)){
            // el id_temp_comprobante 'SI esta vacio';
            $res1 = $obj->agregar_Temp_ComprobanteController($datos1);
            $ultimoId_Temp_comprobante= $res1['ultimoId_Temp_comprobante'];

            $resp= $obj->agregar_Temp_DetalleComprobanteController($datos2,$ultimoId_Temp_comprobante);
            $respuesta = array($resp,'idComprobante'=>$ultimoId_Temp_comprobante);
        }else{
            // el id_temp_comprobante 'NO esta vacio';
            $resp= $obj->agregar_Temp_DetalleComprobanteController($datos2,$id_temp_comprobante);
            $respuesta = array($resp,'idComprobante'=>$id_temp_comprobante);
        }
    }

    return $respuesta;
}

function filtrarProducto($valor){
    $obj = new RealizarVentaController();
    $res = $obj->filtrar_ProductoComprobanteController($valor);
    return $res;
}


function listarIdProductoInventario($idProducto){
    $obj = new InventarioController();
    $res = $obj->listarIdProductoIventarioController($idProducto);
    // listarIdProductoIventarioController
    return  $res;
}


function listar_id_temp_comprobante($idTempComprobante){
    $obj = new RealizarVentaController();
    $listaIdComprobante = $obj-> listar_id_temp_comprobanteController($idTempComprobante);
    return $listaIdComprobante;
}





function listarDetalleComprobante($datos){

    $obj = new RealizarVentaController();
    $resTipoDescuento = $obj->  lisarSelectTipoDescuentoController();
        
    // $contenido='';
    // foreach ($resTipoDescuento as $key => $value){
    //     $contenido.='<option id='.$value['id_tipo_descuento'].'>'.$value['detalle_tipo_descuento'].'</option>';
    // }
    // return $contenido;






    $obj = new RealizarVentaController();
    $res = $obj->listar_Temp_DetalleComprobanteController($datos);
    // $tabla =$res;
   
    if($res['resp']==0){
        // 'no existe registros';
        $tabla = 0;
        // return $tabla;
     }else if($res['resp']==1){
        $arrayDetalle =  $res['arraylistarTempDetalleComprobante'];

        $tabla='';
        $tabla.='<table id="miDataTableDetalleComprobante"  class="responsive nowrap miTabla on-delete" style="width:100%">
                    <thead>
                        <tr>
                            <th class="col-sm-3" style="width:50px">CODIGO</th>
                            <th class="col-sm-10">DETALLE</th>
                            <th class="col-sm-4">PRECIO UNIT.</th>
                            <th>CANTIDAD</th>
                            <th>SUBTOTAL</th>
                            <th></th>
                        </tr>
                    </thead>  
                    <tbody>';

                    $sumaSubTotal =0;
                    foreach ($arrayDetalle as $key => $value){
                            $obj2 = new ProductosController();
                            $resProducto = $obj2->listarIdProductoController($value['fk_id_temp_producto']);
                            $resArrayProducto = $resProducto['arrayProductos'];
                
                            $tabla.='
                            <tr>
                                <td>'
                                    .$resArrayProducto["codigo_producto"].
                                '</td>
                                <td>'
                                    .$resArrayProducto['descripcion_producto'].
                                '</td>
                                <td  id="data-precio-'.$value['id_temp_detalle_comprobante'].'"  data-value="'.$value['precio_unitario_temp_detalle_comprobante'].'">'
                                    .$value['precio_unitario_temp_detalle_comprobante'].'
                                </td>
                                <td id="html-'.$value['id_temp_detalle_comprobante'].'">
                                    <button class="btnDatatatbleInfo" id="data-btn-restar-'.$value["fk_id_temp_producto"].'" onclick="restarCantidad('.$value['id_temp_detalle_comprobante'].','.$value['precio_unitario_temp_detalle_comprobante'].','.$value['fk_id_temp_producto'].','.$value['fk_id_temp_comprobante'].');"> <i class="fa-solid fa-minus"></i></button>

                                           <input type="text" id="data-cantidad-'.$value['id_temp_detalle_comprobante'].'" value="'.$value["cantidad_temp_detalle_comprobante"].'">

                                           <input type="hidden" id="data-idProducto-'.$value['id_temp_detalle_comprobante'].'" value="'.$value["fk_id_temp_producto"].'">

                                    <button class="btnDatatatbleInfo"id="data-btn-sumar-'.$value['fk_id_temp_producto'].'"onclick="sumarCantidad('.$value['id_temp_detalle_comprobante'].','.$value['precio_unitario_temp_detalle_comprobante'].','.$value['fk_id_temp_producto'].','.$value['fk_id_temp_comprobante'].');"> <i class="fa-solid fa-plus"></i> </button>
                                </td>
                            
                                <td id="html-sub-'.$value['id_temp_detalle_comprobante'].'">
                                    <div  data-subtotal="'.$value['sub_total_temp_detalle_comprobante'].'" id="html-subtotal-'.$value['id_temp_detalle_comprobante'].'">'
                                    .$value['sub_total_temp_detalle_comprobante'].
                                    '</div>
                                </td>

                                <td id="conten-btn-delete-'.$value['id_temp_detalle_comprobante'].'">
                                    <a href="javascript:void(0);" class="btnAccion btnDeleteComprobante" id="btnAccion" onclick="eliminarProductoDetalle('.$value['id_temp_detalle_comprobante'].','.$value['fk_id_temp_comprobante'].');">
                                                            <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            ';
                            $sumaSubTotal = $sumaSubTotal + $value['sub_total_temp_detalle_comprobante'];
                    }

                    // TODO:  [[[  TOTALES  ]]]

        $tabla.='  </tbody>
                </table> 
               
               <div class="contenedor_totales">
                   
                     <div class="item_contenador_totales span2">
                        
                        <div class="grupo item2 input-requerido ">
                            <input type="text" class="form-control input-pago-con" name="detalleProducto" id="detalleProducto" required="" onkeyup="javascript:this.value=this.value.toUpperCase();" tabindex="2">
                            <label for="">Pago con...</label>
                        </div>
                       <div class="grupo-vuelto">
                            <div class="txt-vuelto">Vuelto : </div>
                            <div class="txt-monto-vuelto txt-bold">s/. 435.00</div>
                       </div>
                     </div>
                     <div class="item_contenador_totales span3">
                            <div class="contenedor-item-3">
                                <div class="item3 txt-total txt-color-secundary">Total :</div>
                                <div class="item3 total-num txt-color-secundary">'.$sumaSubTotal.'</div>
                            </div>
                            <div   class="contenedor-item-3 select">
                                <div class="item3 txt-total txt-color-secundary conteneddor-selec-descuento">    
                                    <select class="selectDescuento" name="fkIdDescuento" id="fkIdDescuento">';
                                      
                            foreach ($resTipoDescuento as $key => $value){
                                $tabla.='<option value='.$value['id_tipo_descuento'].' id='.$value['id_tipo_descuento'].'>'.$value['detalle_tipo_descuento'].'</option>';
                            }

                                    $tabla.='</select>
                                    <div>Desc.:</div>
                                </div>
                                <div class="item3 total-num txt-color-secundary monto-descuento"><div>00.00</div></div>
                            </div>
                            <div class="contenedor-item-3">
                                <div class="item3 txt-total txt-color-secundary">
                                
    
                                <input type="radio"  name="radioIgv" value="1" id="si" >
                                <input type="radio" name="radioIgv" value="0" id="no" checked >
                               
                                <div class="switch">
                                  
                                  <label for="si">IGV(18%)</label>
                                  <label for="no" >NO</label>
                                  <span></span>
                                  
                                </div>
                                
                                </div>
                                <div class="item3 total-num txt-color-secundary">00.00</div>
                            </div>
                            <div class="contenedor-item-3">
                                <div class="item3 txt-total txt-total txt-bold">TOTAL IMPORTE:</div>
                                <div class="item3 total-num txt-bold">56.56</div>
                            </div>
                     </div>
                </div>
                <script type="text/javascript" language="javascript" src="./views/src/lib/datatable/miDatatable.js">

                
                </script>
                
                
                
                ';
    }

    return  $tabla;
        
}     



function formatoMoneda($valor, $centavos = 1) { //convertidos deciamles moneda
        if (is_numeric($valor)) { // a number
          if (!$valor) { // zero
            $money = ($centavos == 2 ? '0.00' : '0'); 
          } else { // value
            if (floor($valor) == $valor) { // whole number
              $money = number_format($valor, ($centavos == 2 ? 2 : 0)); 
            } else { // cents
              $money = number_format(round($valor, 2), ($centavos == 0 ? 0 : 2)); 
            } // integer or decimal
          } // value
          return 'S/. '.$money;
        } // numeric
} 
