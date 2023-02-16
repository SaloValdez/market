<?php

// require_once "../models/realizar_venta_model.php";

class RealizarVentaController{

  

  public static function actualizar_temp_comprobanteController($datos){
    $respuesta = RealizarVentaModel::actualizar_temp_comprobanteModel($datos);
    return $respuesta;
  }
  public static function actualizarCantidadProductoDetalleController($datos){
    $respuesta = RealizarVentaModel::actualizarCantidadProductoDetalleModel($datos);
    return $respuesta;
  }
  
    public static function agregar_Temp_ComprobanteController($datos){
      $respuesta = RealizarVentaModel::agregar_Temp_ComprobanteModel($datos);
      return $respuesta;
    }
    public static function agregar_Temp_DetalleComprobanteController($datos,$id_temp_comprobante){
        $respuesta = RealizarVentaModel::agregar_Temp_DetalleComprobanteModel($datos,$id_temp_comprobante);
        return $respuesta;
    }

    public static function listar_Temp_DetalleComprobanteController($datos){
      $respuesta = RealizarVentaModel::listar_Temp_DetalleComprobanteModel($datos);
      return $respuesta;
    }
    public static function filtrar_ProductoComprobanteController($datos){
      $respuesta = RealizarVentaModel::filtrar_ProductoComprobanteModel($datos);
      return $respuesta;
    }
   

    public static function verificarComprobanteEmpleadoController($datos){
      $respuesta = RealizarVentaModel::verificarComprobanteEmpleadoModel($datos);
      return $respuesta;
    }
    public static function eliminar_Temp_ProductoDetalleController($idDetalle){
      $respuesta = RealizarVentaModel::eliminar_Temp_ProductoDetalleModel($idDetalle);
      return $respuesta;
    }

    

    public static function lisarSelectTipoDescuentoController(){
      $respuesta = RealizarVentaModel::lisarSelectTipoDescuentoModel();
      return $respuesta;
    }

    public static function lisarIdSelectTipoDescuentoController($idDescuento){
      $respuesta = RealizarVentaModel::lisarIdSelectTipoDescuentoModel($idDescuento);
      return $respuesta;
    }
    

    public static function listar_id_temp_comprobanteController($idComprobante){
      $respuesta = RealizarVentaModel::listar_id_temp_comprobanteModel($idComprobante);
        return $respuesta;
      }

  }

//   $datos = array('idTempDetalleComprobante'=>91,'fkIdProducto'=>103,'cantidadPedido'=>5);
// $obj = new RealizarVentaController();
// $res = $obj->  actualizarCantidadProductoDetalleController($datos);

// echo json_encode($res);