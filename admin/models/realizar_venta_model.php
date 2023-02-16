<?php


require_once "conexion.php";

 class RealizarVentaModel extends Conexion{

  //   ##-----------------------------------------------------------------
//     ##  INSERTAR  tem_ comprobante
//     #==================================================================  
  static public function agregar_Temp_ComprobanteModel($datosModel){

    if(!empty($datosModel['fechaTempComprobante'])){
      
      $conectar =Conexion::cnx();
      $stmt2 = $conectar->prepare("INSERT INTO temp_comprobante ( 
                                                        fecha_temp_comprobante,
                                                        estado_temp_comprobante,
                                                        ip_temp_comprobante,
                                                        fk_id_temp_empleado
                                                    )
                                                  VALUES(
                                                        :fechaTempComprobante,
                                                        :estadoTempComprobante,
                                                        :ipTempComprobante,
                                                        :fkIdTempEmpleado
                                                      )
                                           ");
            try {
            #bindParam()  vinvula parametros con campos de SQL
            $stmt2->bindParam(":fechaTempComprobante", $datosModel['fechaTempComprobante'], PDO::PARAM_STR);
            $stmt2->bindParam(":estadoTempComprobante", $datosModel['estadoTempComprobante'], PDO::PARAM_STR);
            $stmt2->bindParam(":ipTempComprobante", $datosModel['ipTempComprobante'], PDO::PARAM_STR);
            $stmt2->bindParam(":fkIdTempEmpleado", $datosModel['fkIdTempEmpleado'], PDO::PARAM_INT);

            if ($stmt2->execute()) {
              $id = $conectar->lastInsertId();
                 return array('resp' => 1, 'ultimoId_Temp_comprobante'=>$id);
            }else {
                 return array('resp'=> 0);
            }
            // $stmt->close();
            } catch (Exception $e) {
                   return array("resp"=>55555);
            // return array("reps"=>0,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
            exit();
            }
  
     }
      
}
    
//   ##-----------------------------------------------------------------
//     ##  INSERTAR 
//     #==================================================================  
    static public function agregar_Temp_DetalleComprobanteModel($datosModel,$id_temp_comprobante){
      $mostrarCantidadInventario=self::mostrarCantidadInventarioIdProductoModel($datosModel['fkIdTempProducto']);
      $cantidadInventario = $mostrarCantidadInventario['cantidadInventario'];

      if(!empty($datosModel['accion'])){
          if($datosModel['accion']=='eliminar'){
            //TODO: [ Eliminar ] producto detalle
            $stmt  = Conexion::cnx()->prepare("DELETE  FROM temp_detalle_comprobante WHERE id_temp_detalle_comprobante  =:idTempDetalleComprobante");
            $stmt ->bindParam(":idTempDetalleComprobante",$datosModel['idTempDetalleComprobante'],PDO::PARAM_INT);
                        if ($stmt->execute()) {
                              if ($stmt->rowCount() > 0) {

                                  // [ restar ]  inventario
                                  $mostrarCantidadInventario=self::mostrarCantidadInventarioIdProductoModel($datosModel['fkIdTempProducto']);
                                  return $mostrarCantidadInventario;

                                  // return array("resp" =>1,'txt'=>'eliminado producto');
                               






                              }else{
                                  return array("resp"=>0,'txt'=>'no se pudo eliminar producto');
                              }
                        }else {
                          return array("resp"=>10);
                        }
            
          }else{
              if(!empty($datosModel['fkIdTempProducto']) AND !empty($datosModel['fkIdTempComprobante'])){
                // Verificar 
                $stmt1  =  Conexion::cnx()->prepare("SELECT  * FROM temp_detalle_comprobante WHERE fk_id_temp_producto = :fkIdTempProducto AND fk_id_temp_comprobante = :fkIdTempComprobante");
                $stmt1 ->bindParam(":fkIdTempProducto",$datosModel['fkIdTempProducto'],PDO::PARAM_INT);
                $stmt1 ->bindParam(":fkIdTempComprobante",$datosModel['fkIdTempComprobante'],PDO::PARAM_INT);
                if ($stmt1 -> execute()) {
                    if ($stmt1->rowCount() > 0) {
                      // [ restar inventario]
                        if($cantidadInventario >=$datosModel['cantidadTempDetalleComprobante']){
                              $cantidad_actualizado_inventario = $cantidadInventario - $datosModel['cantidadTempDetalleComprobante'];
                              $stmt  = Conexion::cnx()->prepare("UPDATE `inventario` 
                                                                    SET `cantidad_inventario` = $cantidad_actualizado_inventario 
                                                                  WHERE `fk_id_producto` = :fkIdProducto
                                                                    ");
                              $stmt->bindParam(":fkIdProducto", $datosModel['fkIdTempProducto'], PDO::PARAM_INT);
                              if ($stmt -> execute()) {
                            //  [ SUMAR  detalle ] 
                                  $resp_detalle = $stmt1 ->fetch();
                                  $incremento_cantidad_detalle =  $resp_detalle['cantidad_temp_detalle_comprobante'] + $datosModel['cantidadTempDetalleComprobante'];
                                  $subtotal_detalle = $incremento_cantidad_detalle * $resp_detalle['precio_unitario_temp_detalle_comprobante'];
                                  //  return $incremento_cantidad_detalle;
                                  $stmt2  = Conexion::cnx()->prepare("UPDATE temp_detalle_comprobante SET cantidad_temp_detalle_comprobante =:cantidadTempDetalleComprobante,
                                                                                                          sub_total_temp_detalle_comprobante =:subTotalTempDetalleComprobante
                                                                                                    WHERE id_temp_detalle_comprobante =:idTempDetalleComprobante
                                                                    ");
                                  $stmt2->bindParam(":cantidadTempDetalleComprobante",$incremento_cantidad_detalle, PDO::PARAM_STR);  
                                  $stmt2->bindParam(":subTotalTempDetalleComprobante",$subtotal_detalle, PDO::PARAM_STR); 
                                  $stmt2->bindParam(":idTempDetalleComprobante", $resp_detalle['id_temp_detalle_comprobante'], PDO::PARAM_INT);  
                                  // return $stmt2 -> execute();
                                  if ($stmt2 -> execute()) {
                                    if ($stmt2->rowCount() > 0) {
                                        return array("resp" =>1,'txt'=>'se actualizo detalle');
                                    }else{
                                        return array("resp"=>0,'txt'=>'no se pudo actualizar detalle');
                                    }
                                  }else {
                                    return array("resp"=>10);
                                  }
                              }
                        }else{
                          return array("resp" =>0,'txt'=>'Excede el inventario');

                        }
                        
                        //___________actualizar detalle
                        
                        // $resp_detalle = $stmt1 ->fetch();
                        // $incremento_cantidad_detalle =  $resp_detalle['cantidad_temp_detalle_comprobante'] + $datosModel['cantidadTempDetalleComprobante'];
                        // $subtotal_detalle = $incremento_cantidad_detalle * $resp_detalle['precio_unitario_temp_detalle_comprobante'];
                        // //  return $incremento_cantidad_detalle;
                        // $stmt2  = Conexion::cnx()->prepare("UPDATE temp_detalle_comprobante SET cantidad_temp_detalle_comprobante =:cantidadTempDetalleComprobante,
                        //                                                                         sub_total_temp_detalle_comprobante =:subTotalTempDetalleComprobante
                        //                                                                   WHERE id_temp_detalle_comprobante =:idTempDetalleComprobante
                        //                                   ");
                        // $stmt2->bindParam(":cantidadTempDetalleComprobante",$incremento_cantidad_detalle, PDO::PARAM_STR);  
                        // $stmt2->bindParam(":subTotalTempDetalleComprobante",$subtotal_detalle, PDO::PARAM_STR); 
                        // $stmt2->bindParam(":idTempDetalleComprobante", $resp_detalle['id_temp_detalle_comprobante'], PDO::PARAM_INT);  
                        // // return $stmt2 -> execute();
                        //             if ($stmt2 -> execute()) {
                        //               if ($stmt2->rowCount() > 0) {
                        //                   return array("resp" =>1,'txt'=>'se actualizo detalle');
                        //               }else{
                        //                   return array("resp"=>0,'txt'=>'no se pudo actualizar detalle');
                        //               }
                        //             }else {
                        //               return array("resp"=>10);
                        //             }
                    }else{
                // [ AGREGAR MAS PRODUCTOS A DETALLE]
                        if($cantidadInventario >=$datosModel['cantidadTempDetalleComprobante']){
                          // [restar inventario]

                          $cantidad_actualizado_inventario = $cantidadInventario - $datosModel['cantidadTempDetalleComprobante'];
                          $stmt  = Conexion::cnx()->prepare("UPDATE `inventario` 
                                                                SET `cantidad_inventario` = $cantidad_actualizado_inventario 
                                                              WHERE `fk_id_producto` = :fkIdProducto
                                                                ");
                          $stmt->bindParam(":fkIdProducto", $datosModel['fkIdTempProducto'], PDO::PARAM_INT);
                          if ($stmt -> execute()) {
                                $stmt2 =  Conexion::cnx()->prepare("INSERT INTO temp_detalle_comprobante
                                                                                (
                                                                                cantidad_temp_detalle_comprobante,
                                                                                precio_unitario_temp_detalle_comprobante,
                                                                                sub_total_temp_detalle_comprobante,
                                                                                fk_id_temp_producto,
                                                                                fk_id_temp_comprobante
                                                                                )
                                                                          VALUES(
                                                                                :cantidadTempDetalleComprobante,
                                                                                :precioUnitarieTempDetalleComprobante,
                                                                                :subTotalTempDetalleComprobante,
                                                                                :fkIdTempProducto,
                                                                                :fkIdTempComprobante
                                                                              )
                                                                   ");
                                    try {
                                          $sub_total_detalle = $datosModel['cantidadTempDetalleComprobante'] * $datosModel['precioUnitarieTempDetalleComprobante'];
                                          $stmt2->bindParam(":cantidadTempDetalleComprobante", $datosModel['cantidadTempDetalleComprobante'], PDO::PARAM_STR);
                                          $stmt2->bindParam(":precioUnitarieTempDetalleComprobante",$datosModel['precioUnitarieTempDetalleComprobante'] , PDO::PARAM_STR);
                                          $stmt2->bindParam(":subTotalTempDetalleComprobante",$sub_total_detalle, PDO::PARAM_STR);
                                          $stmt2->bindParam(":fkIdTempProducto", $datosModel['fkIdTempProducto'],PDO::PARAM_INT);
                                          $stmt2->bindParam(":fkIdTempComprobante",$datosModel['fkIdTempComprobante'], PDO::PARAM_INT);

                                          if ($stmt2->execute()) {
                                              return array('resp' => 1,'txt'=>'Se adiciono un producto más.');
                                          }else {
                                               return array('resp'=> 0,'txt'=>'No se pudo agregar un poducto mas.');
                                          }
                                    } catch (Exception $e) {
                                        return array("resp"=>55555);
                                    // return array("reps"=>0,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
                                    exit();
                                    }
                          }
                        }else{
                          return array("resp" =>0,'txt'=>'Excede el inventario');
                        }
                    }
                  }else {
                        return array("resp"=>10);
                  } 
              }else if(empty($datosModel['fkIdTempComprobante'])){
                // [ INSERTA EL PRIMER PRODUCTO DEL COMPROBANTE ] 'Cuando no exixte comprobante aun'
                if($cantidadInventario >= $datosModel['cantidadTempDetalleComprobante']){

                    $cantidad_actualizado_inventario = $cantidadInventario - $datosModel['cantidadTempDetalleComprobante'];
                    $stmt  = Conexion::cnx()->prepare("UPDATE `inventario` 
                                                          SET `cantidad_inventario` = $cantidad_actualizado_inventario 
                                                        WHERE `fk_id_producto` = :fkIdProducto
                                                          ");
                    $stmt->bindParam(":fkIdProducto", $datosModel['fkIdTempProducto'], PDO::PARAM_INT);
                    if ($stmt -> execute()) {
                      $stmt2 =  Conexion::cnx()->prepare("INSERT INTO temp_detalle_comprobante
                                                                      (
                                                                      cantidad_temp_detalle_comprobante,
                                                                      precio_unitario_temp_detalle_comprobante,
                                                                      sub_total_temp_detalle_comprobante,
                                                                      fk_id_temp_producto,
                                                                      fk_id_temp_comprobante
                                                                      )
                                                                VALUES(
                                                                      :cantidadTempDetalleComprobante,
                                                                      :precioUnitarieTempDetalleComprobante,
                                                                      :subTotalTempDetalleComprobante,
                                                                      :fkIdTempProducto,
                                                                      :fkIdTempComprobante
                                                                      )
                      ");
                      try {
                          $sub_total_detalle = $datosModel['cantidadTempDetalleComprobante'] * $datosModel['precioUnitarieTempDetalleComprobante'];
                          #bindParam()  vinvula parametros con campos de SQL
                          $stmt2->bindParam(":cantidadTempDetalleComprobante", $datosModel['cantidadTempDetalleComprobante'], PDO::PARAM_STR);
                          $stmt2->bindParam(":precioUnitarieTempDetalleComprobante",$datosModel['precioUnitarieTempDetalleComprobante'] , PDO::PARAM_STR);
                          $stmt2->bindParam(":subTotalTempDetalleComprobante",$sub_total_detalle, PDO::PARAM_STR);
                          $stmt2->bindParam(":fkIdTempProducto", $datosModel['fkIdTempProducto'],PDO::PARAM_INT);
                          $stmt2->bindParam(":fkIdTempComprobante",$id_temp_comprobante, PDO::PARAM_INT);

                          if ($stmt2->execute()) {
                          return array('resp' => 1,'txt'=>'Se agrego detalle nuevo');
                          }else {
                          return array('resp'=> 0,'txt'=>'No se pudo agregar detalle');
                          }
                      } catch (Exception $e) {
                         return array("resp"=>55555);
                          exit();
                      }
                    }
                }else{
                  return array("resp" =>0,'txt'=>'Excede el inventario');
                }
              }
          }
      }
  }

//   ##-----------------------------------------------------------------
//   ##  LISTAR DETALLE COMPROBANTE 
//   #==================================================================
  static public function listar_Temp_DetalleComprobanteModel($datosModel){
      $stmt  =  Conexion::cnx()->prepare("SELECT * FROM temp_detalle_comprobante WHERE fk_id_temp_comprobante = :fkIdTempComprobante");
      $stmt ->bindParam(":fkIdTempComprobante",$datosModel['fkIdTempComprobante'],PDO::PARAM_INT);
      // $stmt -> execute();
      // return $stmt->fetchAll();
      if ($stmt -> execute()) {
        if ($stmt->rowCount() > 0) {
            return array("resp" =>1,"arraylistarTempDetalleComprobante"=>$stmt->fetchAll(PDO::FETCH_ASSOC));
        }else{
            return array("resp"=>0);
        }
      }else {
        return array("resp"=>10);
      } 
  }

    ##-----------------------------------------------------------------
//   ##  LISTAR 
//   #==================================================================
    static public function filtrar_ProductoComprobanteModel($detalleProducto){
      if ($detalleProducto ==" "){
        return array("resp"=>0);
        exit();
      // echo "Error. La cadena contiene espacios vacíos.";
      }
        if(empty($detalleProducto)){
          return array("resp"=>0);
          exit();
        }else{
          try {
            $stmt  =  Conexion::cnx()->prepare ("SELECT  P.id_producto, P.foto_producto,P.descripcion_producto,P.cantidad_contenido_producto,P.stock_min_producto,P.cantidad_contenido_producto,MAR.detalle_marca_producto, CAT.detalle_categoria_producto,SUB.detalle_subcategoria_producto,
            ENV.detalle_envace_producto,INVENT.precio_venta_inventario,INVENT.precio_compra_inventario,INVENT.cantidad_inventario
            FROM productos P
            INNER JOIN marca_producto MAR 
            ON fk_id_marca = id_marca_producto
            INNER JOIN categoria_producto CAT
            ON  fk_id_categoria_producto = id_categoria_producto
            INNER JOIN subcategoria_producto SUB
            ON fk_id_subcategoria_producto = id_subcategoria_producto
            INNER JOIN envace_producto ENV
            ON fk_id_envace_producto = id_envace_producto
            INNER JOIN inventario INVENT
            ON  fk_id_producto = Id_producto WHERE 
            P.descripcion_producto REGEXP '$detalleProducto' OR
            P.cantidad_contenido_producto REGEXP '$detalleProducto' OR
            MAR.detalle_marca_producto REGEXP '$detalleProducto' OR
            CAT.detalle_categoria_producto REGEXP '$detalleProducto' OR
            SUB.detalle_subcategoria_producto REGEXP '$detalleProducto'
          ");
          if ($stmt -> execute()) {
                if ($stmt->rowCount() > 0) {
                    return array("resp" =>1, "arrayFiltroProductos"=>$stmt->fetchAll());
                    // return $stmt->fetchAll();
                }else{
                    return array("resp"=>0);
                }
          }else {
            return array("resp"=>10);
          } 
        }catch (Exception $e) {
                  // return array("resp"=>'errorExceptionssss');
                  return array("resp"=>10,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
                  exit();
        }
        }
    }
      ##-----------------------------------------------------------------
//   ##  LISTAR 
//   #==================================================================
  static public function verificarComprobanteEmpleadoModel($idEmpleado){
      $stmt  =  Conexion::cnx()->prepare("SELECT  * FROM temp_comprobante WHERE fk_id_temp_empleado = :idEmpleado");
      $stmt ->bindParam(":idEmpleado",$idEmpleado,PDO::PARAM_INT);
      if ($stmt -> execute()) {
        if ($stmt->rowCount() > 0) {
            return array("resp" =>1, "arrayVerificarComprobanteEmpleado"=>$stmt->fetchAll());
            // return $stmt->fetchAll();
        }else{
            return array("resp"=>0);
        }
      }else {
        return array("resp"=>10);
      } 
  

    }

    static public function eliminar_Temp_ProductoDetalleModel($idDetalle){
      $datosIdProductoDetalle= self::mostrarCantidadProductoDetalleModel($idDetalle);
       $idProducto =  $datosIdProductoDetalle['idProductoDetalle'];
       $cantidadDetalle =  $datosIdProductoDetalle['cantidaDetalleComprobante'];
       $cantidadInventario = self::mostrarCantidadInventarioIdProductoModel($idProducto);
      
          try{
                  $stmt  = Conexion::cnx()->prepare("DELETE  FROM temp_detalle_comprobante WHERE id_temp_detalle_comprobante =:idDetalle");
                  $stmt ->bindParam(":idDetalle",$idDetalle,PDO::PARAM_INT);
                  if ($stmt->execute()) {
                        if ($stmt->rowCount() > 0) {
                          // [ sumar inventario]
                            $cantidad_actual_inventario = $cantidadInventario['cantidadInventario'] + $cantidadDetalle;
                            $stmt  = Conexion::cnx()->prepare("UPDATE `inventario` 
                                                                  SET `cantidad_inventario` = $cantidad_actual_inventario 
                                                                WHERE `fk_id_producto` = :fkIdProducto
                            ");
                          $stmt->bindParam(":fkIdProducto", $idProducto, PDO::PARAM_INT);
                          if ($stmt -> execute()) {
                            return array("resp"=>1,'txt'=>'se actualizo inventario despues de; eliminar detalle');
                          }
                           return $cantidad_actual_inventario;
                        }else{
                            return array("resp"=>0);
                        }
                  }else {
                    return array("resp"=>10);
                  }
             }
             catch(PDOException $e){
                    return array("resp"=>10,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
                     
             }
    }
      

  ##-----------------------------------------------------------------
  ##  VERIFICAR DETALLE  CANTIDAD  ID DETALLE
  #==================================================================
  static public function mostrarCantidadProductoDetalleModel($idTempDetalleComprobante){
    if(!empty($idTempDetalleComprobante)){
          $stmt  = Conexion::cnx()->prepare("SELECT cantidad_temp_detalle_comprobante,precio_unitario_temp_detalle_comprobante,fk_id_temp_producto
                                               FROM temp_detalle_comprobante
                                              WHERE id_temp_detalle_comprobante = :idTempDetalleComprobante
                                       ");
          $stmt ->bindParam(":idTempDetalleComprobante",$idTempDetalleComprobante,PDO::PARAM_INT);
          if ($stmt -> execute()){
            $cantidadTempDetalleComprobante  = $stmt->fetch();
            // return $cantidadTempDetalleComprobante;
            return array(
                          'resp'=>1,
                          'idProductoDetalle'=> $cantidadTempDetalleComprobante['fk_id_temp_producto'],
                          'cantidaDetalleComprobante'=> $cantidadTempDetalleComprobante['cantidad_temp_detalle_comprobante'],
                          'precioUnitarioDetalle'=> $cantidadTempDetalleComprobante['precio_unitario_temp_detalle_comprobante'],
                          'txt'=>'ok'
                        );
          }else {
          return array("resp"=>10);
          }
    }
  }
  ##-----------------------------------------------------------------
  ##  VERIFICAR INVENTARIO  CANTIDAD  ID PRODUCTO
  #==================================================================
  static public function mostrarCantidadInventarioIdProductoModel($idProducto){
    if(!empty($idProducto)){
      $stmt  = Conexion::cnx()->prepare("SELECT cantidad_inventario FROM inventario WHERE fk_id_producto = :fkIdProducto
                                       ");
          $stmt ->bindParam(":fkIdProducto",$idProducto,PDO::PARAM_INT);
          if ($stmt -> execute()){
            $cantidadInventario  = $stmt->fetch()[0];
            return array('resp'=>1,'cantidadInventario'=> $cantidadInventario,'txt'=>'ok');
          }else {
          return array("resp"=>10);
          }
    }
  }
  ##-----------------------------------------------------------------
  ##  ACTUALIZAR  CANTIDAD POR "ID"  DETALLE
  #==================================================================
  static public function actualizarCantidadProductoDetalleModel($datosModel){
      try {
        

          $mostrarCantidadInventario=self::mostrarCantidadInventarioIdProductoModel($datosModel['fkIdProducto']);
          $cantidadActualInventario =$mostrarCantidadInventario['cantidadInventario'];


          if($datosModel['tipoAccion']=='sumarUnoDetalle'){
                  if(!($cantidadActualInventario< 1)){
                    // Restar del inventario
                      $cantidadActualizadaInventario = $cantidadActualInventario - 1;
                      $stmt  = Conexion::cnx()->prepare("UPDATE `inventario` 
                                                            SET `cantidad_inventario` = $cantidadActualizadaInventario 
                                                          WHERE `fk_id_producto` = :fkIdProducto
                                                            ");
                      $stmt->bindParam(":fkIdProducto", $datosModel['fkIdProducto'], PDO::PARAM_INT);
                      if ($stmt -> execute()) {
                        // sumar cantidad detalle

                        $cantidadTempDetalleComprobante=self::mostrarCantidadProductoDetalleModel($datosModel['idTempDetalleComprobante']);

                        if($cantidadTempDetalleComprobante['resp']==1 ){
                            $cantidadDetalle = $cantidadTempDetalleComprobante['cantidaDetalleComprobante'];

                            $cantidadProductoDetalleActualizado = $cantidadDetalle + 1;

                              $subtotalProductoDetalleActualizado = round($cantidadProductoDetalleActualizado * $cantidadTempDetalleComprobante['precioUnitarioDetalle'], 2);

                              $stmt1  = Conexion::cnx()->prepare("UPDATE `temp_detalle_comprobante` 
                                                                        SET `cantidad_temp_detalle_comprobante`  =  $cantidadProductoDetalleActualizado, 
                                                                            `sub_total_temp_detalle_comprobante` =   $subtotalProductoDetalleActualizado
                                                                      WHERE `id_temp_detalle_comprobante` = :idTempDetalleComprobante 
                                                                        AND `fk_id_temp_producto` = :fkIdTempProducto
                                                              ");
                              $stmt1->bindParam(":fkIdTempProducto", $datosModel['fkIdProducto'], PDO::PARAM_INT);
                              $stmt1->bindParam(":idTempDetalleComprobante", $datosModel['idTempDetalleComprobante'], PDO::PARAM_INT);
                            
                            if($stmt1->execute()){
                              return  array('resp'=>1,'txt'=>'Se actualizo <detalle> con exito');
                            }else {
                              return array("resp"=>10,'txt'=> 'error en la base de datos <actualizarCantidadProductoDetalleModel()>');
                            }
                        }
                      }
                  }else{
                          return  array('resp'=>0,'txt'=>'Cantidad excede el inventario');
                  }
          }
          
          if($datosModel['tipoAccion']=='restarUnoDetalle'){
            
            $cantidadTempDetalleComprobante=self::mostrarCantidadProductoDetalleModel($datosModel['idTempDetalleComprobante']);
            if(!($cantidadTempDetalleComprobante['cantidaDetalleComprobante'] < 1)){
                // Sumar __el inventario
                    $cantidadActualizadaInventario = $cantidadActualInventario + 1;
                    $stmt  = Conexion::cnx()->prepare("UPDATE `inventario` 
                                                      SET `cantidad_inventario` = $cantidadActualizadaInventario 
                                                    WHERE `fk_id_producto` = :fkIdProducto
                                                      ");
                $stmt->bindParam(":fkIdProducto", $datosModel['fkIdProducto'], PDO::PARAM_INT);
                if ($stmt -> execute()) {
                  // Restar__cantidad detalle
                 

                  if($cantidadTempDetalleComprobante['resp']==1 ){
                      $cantidadDetalle = $cantidadTempDetalleComprobante['cantidaDetalleComprobante'];
                      $cantidadProductoDetalleActualizado = $cantidadDetalle - 1;

                      $subtotalProductoDetalleActualizado = round($cantidadProductoDetalleActualizado * $cantidadTempDetalleComprobante['precioUnitarioDetalle'], 2);
                        $stmt1  = Conexion::cnx()->prepare("UPDATE `temp_detalle_comprobante` 
                                                                  SET `cantidad_temp_detalle_comprobante`  =  $cantidadProductoDetalleActualizado,
                                                                      `sub_total_temp_detalle_comprobante` =   $subtotalProductoDetalleActualizado
                                                                WHERE `id_temp_detalle_comprobante` = :idTempDetalleComprobante 
                                                                  AND `fk_id_temp_producto` = :fkIdTempProducto
                                                        ");
                        $stmt1->bindParam(":fkIdTempProducto", $datosModel['fkIdProducto'], PDO::PARAM_INT);
                        $stmt1->bindParam(":idTempDetalleComprobante", $datosModel['idTempDetalleComprobante'], PDO::PARAM_INT);
                      
                      if($stmt1->execute()){
                        return  array('resp'=>1,'txt'=>'Se actualizo <detalle> con exito');
                      }else {
                        return array("resp"=>10,'txt'=> 'error en la base de datos <actualizarCantidadProductoDetalleModel()>');
                      }
                  }
                }
              }else{
                return  array('resp'=>0,'txt'=>'Cantidad excede el detalle');
              }
          }
          if($datosModel['tipoAccion']=='sumar_agregar_aleatorio'){
              $cantidadTempDetalleComprobante=self::mostrarCantidadProductoDetalleModel($datosModel['idTempDetalleComprobante']);
              if($datosModel['cantidadPedido'] < $cantidadTempDetalleComprobante['cantidaDetalleComprobante']){
                  // Se [ reduce ] EL DETALLE comprobante

                  $restoDetalle =  $cantidadTempDetalleComprobante['cantidaDetalleComprobante'] - $datosModel['cantidadPedido'];
                  // return $restoDetalle ;
                       // Sumar __el inventario    
                       $cantidadActualizadaInventario = $cantidadActualInventario + $restoDetalle;
                       $stmt  = Conexion::cnx()->prepare("UPDATE `inventario` 
                                                         SET `cantidad_inventario` = $cantidadActualizadaInventario 
                                                       WHERE `fk_id_producto` = :fkIdProducto
                                                         ");
                   $stmt->bindParam(":fkIdProducto", $datosModel['fkIdProducto'], PDO::PARAM_INT);
                   if ($stmt -> execute()) {
                        $cantidadDetalle = $cantidadTempDetalleComprobante['cantidaDetalleComprobante'];
                        $cantidadProductoDetalleActualizado = $cantidadDetalle - $restoDetalle;
                        $subtotalProductoDetalleActualizado = round($cantidadProductoDetalleActualizado * $cantidadTempDetalleComprobante['precioUnitarioDetalle'], 2);
                          $stmt1  = Conexion::cnx()->prepare("UPDATE `temp_detalle_comprobante` 
                                                                    SET `cantidad_temp_detalle_comprobante`  =  $cantidadProductoDetalleActualizado,
                                                                        `sub_total_temp_detalle_comprobante` =   $subtotalProductoDetalleActualizado
                                                                  WHERE `id_temp_detalle_comprobante` = :idTempDetalleComprobante 
                                                                    AND `fk_id_temp_producto` = :fkIdTempProducto
                                                          ");
                          $stmt1->bindParam(":fkIdTempProducto", $datosModel['fkIdProducto'], PDO::PARAM_INT);
                          $stmt1->bindParam(":idTempDetalleComprobante", $datosModel['idTempDetalleComprobante'], PDO::PARAM_INT);
                        if($stmt1->execute()){
                          return  array('resp'=>1,'txt'=>'Se actualizo <detalle> con exito');
                        }else {
                          return array("resp"=>10,'txt'=> 'error en la base de datos <actualizarCantidadProductoDetalleModel()>');
                        }
                   }


              }
              if($datosModel['cantidadPedido'] >= $cantidadTempDetalleComprobante['cantidaDetalleComprobante']){
               // Se [ aumenta ] EL DETALLE comprobante
                    $sumar_a_Detalle =  $datosModel['cantidadPedido']-$cantidadTempDetalleComprobante['cantidaDetalleComprobante'];

                    if(!($cantidadActualInventario< $sumar_a_Detalle)){
                      
                        $cantidadActualizadaInventario = $cantidadActualInventario - $sumar_a_Detalle;
                        $stmt  = Conexion::cnx()->prepare("UPDATE `inventario` 
                                                              SET `cantidad_inventario` = $cantidadActualizadaInventario 
                                                            WHERE `fk_id_producto` = :fkIdProducto
                                                              ");
                        $stmt->bindParam(":fkIdProducto", $datosModel['fkIdProducto'], PDO::PARAM_INT);
                        if ($stmt -> execute()) {

                            $cantidadDetalle = $cantidadTempDetalleComprobante['cantidaDetalleComprobante'];
                            $cantidadProductoDetalleActualizado = $cantidadDetalle + $sumar_a_Detalle;

                              $subtotalProductoDetalleActualizado = round($cantidadProductoDetalleActualizado * $cantidadTempDetalleComprobante['precioUnitarioDetalle'], 2);

                              $stmt1  = Conexion::cnx()->prepare("UPDATE `temp_detalle_comprobante` 
                                                                        SET `cantidad_temp_detalle_comprobante`  =  $cantidadProductoDetalleActualizado, 
                                                                            `sub_total_temp_detalle_comprobante` =   $subtotalProductoDetalleActualizado
                                                                      WHERE `id_temp_detalle_comprobante` = :idTempDetalleComprobante 
                                                                        AND `fk_id_temp_producto` = :fkIdTempProducto
                                                              ");
                              $stmt1->bindParam(":fkIdTempProducto", $datosModel['fkIdProducto'], PDO::PARAM_INT);
                              $stmt1->bindParam(":idTempDetalleComprobante", $datosModel['idTempDetalleComprobante'], PDO::PARAM_INT);
                            
                            if($stmt1->execute()){
                              return  array('resp'=>1,'txt'=>'Se actualizo <detalle> con exito');
                            }else {
                              return array("resp"=>10,'txt'=> 'error en la base de datos <actualizarCantidadProductoDetalleModel()>');
                            }
                        }
                    }else{
                      return  array('resp'=>0,'txt'=>'Cantidad excede el inventario');
                    }
              }
          }
    }catch (Exception $e) {
        // return array("resp"=>'errorExceptionssss');
        return array("resp"=>10,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
         exit();
    }
  }

  static public function lisarSelectTipoDescuentoModel(){
    $stmt  =  Conexion::cnx()->prepare("SELECT * FROM `tipo_descuento`");
    if ($stmt -> execute()) {

      // return json_encode($stmt -> fetch(PDO::FETCH_ASSOC));
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
  }
  static public function lisarIdSelectTipoDescuentoModel($idDescuento){
    $stmt  =  Conexion::cnx()->prepare("SELECT * FROM `tipo_descuento` WHERE id_tipo_descuento =:idDescuento");
    $stmt->bindParam(":idDescuento", $idDescuento, PDO::PARAM_INT);
    if ($stmt -> execute()) {
        return $stmt -> fetch();
    }
  }


  static public function listar_id_temp_comprobanteModel($id_temp_Comprobante){
    $stmt  =  Conexion::cnx()->prepare("SELECT * FROM `temp_comprobante` WHERE `id_temp_comprobante` = :idTempComprobante");
    $stmt->bindParam(":idTempComprobante", $id_temp_Comprobante, PDO::PARAM_INT);
    if ($stmt -> execute()) {
        return $stmt -> fetch();
    }
  }


  static public function actualizar_temp_comprobanteModel($datosModel){
          $stmt  = Conexion::cnx()->prepare("UPDATE `temp_comprobante` 
                                                SET  `monto_descuento_temp_comprobante` = :montoDescuentoTempComprobante,
                                                     `igv_temp_comprobante` = :igvTempComprobante,
                                                     `importe_total_temp_comprobante` = :importeTotalTempComprobante,
                                                     `fk_id_tipo_descuento`= :fkIdTipoDescuento
                                                WHERE  `id_temp_comprobante` = :idTempComprobante
                                           ");
          $stmt->bindParam(":montoDescuentoTempComprobante", $datosModel['montoDescuentoTempComprobante'], PDO::PARAM_STR);
          $stmt->bindParam(":igvTempComprobante", $datosModel['igvTempComprobante'], PDO::PARAM_STR);
          $stmt->bindParam(":importeTotalTempComprobante", $datosModel['importeTotalTempComprobante'], PDO::PARAM_STR);
          $stmt->bindParam(":fkIdTipoDescuento", $datosModel['fkIdTipoDescuento'], PDO::PARAM_INT);
          $stmt->bindParam(":idTempComprobante", $datosModel['idTempComprobante'], PDO::PARAM_INT);
          if ($stmt -> execute()) {
            return  array('resp'=>1,'txt'=>'Se actualizo <TEM comprobante> con exito');
          }else {
            return array("resp"=>10,'txt'=> 'error en la base de datos <actualizar_temp_comprobante()>');
          
          }
  }

}

// $dato = array(
//     'montoDescuentoTempComprobante'=>11.11,
//     'igvTempComprobante'=>11.11,
//     'importeTotalTempComprobante'=>11.11,
//     'fkIdTipoDescuento'=>1,
//     'idTempComprobante'=>132
// );

// $obj = new RealizarVentaModel();
// $res = $obj->actualizar_temp_comprobanteModel($dato);

// var_dump($res);





// $datos  = array(
//   'idTempDetalleComprobante' =>5,
//   'cantidadTempDetalleComprobante' =>8.30,
//   'precioUnitarieTempDetalleComprobante' =>3.45,
//   'subTotalTempDetalleComprobante' =>45.67,
//   'fkIdTempProducto' =>10,
//   'fkIdTempComprobante' =>18,
//   'accion' =>'agregar',
// );


// $obj = new RealizarVentaModel();
// $res = $obj->agregar_Temp_DetalleComprobanteModel($datos);
// // var_dump($res);
// echo json_encode($res);
// // $datos  = array(
// //   'fkIdTempComprobante' =>2,
// // );





// $obj = new RealizarVentaModel();
// $idProductos = array('idTempDetalleComprobante'=>91,'fkIdProducto'=>103,'cantidadPedido'=>5);
// $res = $obj->actualizarCantidadProductoDetalleModel($idProductos);
// echo json_encode($res);


// // $obj = new RealizarVentaModel();
// // $res = $obj->listar_Temp_DetalleComprobanteModel($datos);
// // // var_dump($res);
// // echo json_encode($res);




// $datos = 'alicorp';
// $obj = new RealizarVentaModel();
// $res = $obj->filtrar_ProductoComprobanteModel($datos);
// var_dump($res);



// //Selecionar  los registros vinculados con WHERE
// $sql = "SELECT especie.Nombre, animales.Animales FROM especie INNER JOIN animales ON especie.id=animales.IdEspecie
// where animales.IdEspecie=1";
// $resultado = mysqli_query($conectar, $sql);
// $sql = "SELECT p.id,
// p.name,
// ps.name AS size_name
// FROM PRODUCT p
// JOIN PRODUCT_SIZES ps ON ps.size_id = p.size_id";
// $result = mysql_query($sql, $connection) or die(mysql_error());


// ?>