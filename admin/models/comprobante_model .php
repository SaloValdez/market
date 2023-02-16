<?php


require_once "conexion.php";

 class ProductosModel extends Conexion{
    
  ##-----------------------------------------------------------------
    ##  INSERTAR 
    #==================================================================  
    static public function insertarProductoModel($datosModel){

      if(!empty($datosModel['codigoProducto'] OR  $datosModel['descripcionProducto'])){
        $stmt  = Conexion::cnx()->prepare("SELECT * FROM productos WHERE codigo_producto =:codigoProducto OR
                                                                          descripcion_producto = :descripcionProducto
                                                                        
                                          ");
            $stmt ->bindParam(":codigoProducto",$datosModel['codigoProducto'],PDO::PARAM_STR);
            $stmt ->bindParam(":descripcionProducto",$datosModel['descripcionProducto'],PDO::PARAM_INT);
            if ($stmt -> execute()){
              if ($stmt->rowCount() > 0) {
                return array("resp" =>3,'msj'=>'existe Codigo o Descripcion');
                exit();
              }
            }else {
              return array("resp"=>10);
            }
      }
        
                $stmt  =  Conexion::cnx()->prepare("INSERT INTO productos ( 
                                                                            codigo_producto,
                                                                            descripcion_producto,
                                                                            stock_min_producto,
                                                                            estado_producto,
                                                                            foto_producto,
                                                                            fecha_registro_producto,
                                                                            fk_id_envace_producto,
                                                                            fk_id_marca,
                                                                            fk_id_categoria_producto,
                                                                            fk_id_subcategoria_producto,
                                                                            fk_id_empleado
                                                                         )
                                                                      VALUES(
                                                                            :codigoProducto,
                                                                            :descripcionProducto,
                                                                            :stockMinProducto,
                                                                            :estadoProducto,
                                                                            :fotoProducto,
                                                                            :fechaRegistroProducto,
                                                                            :fkIdEnvaceProducto,
                                                                            :fkIdMarca,
                                                                            :fkIdCategoriaProducto,
                                                                            :fkIdSubcategoriaProducto,
                                                                            :fkIdEmpleado
                                                                          )
                                                  ");
                 try {
                        #bindParam()  vinvula parametros con campos de SQL
                        $stmt->bindParam(":codigoProducto", $datosModel['codigoProducto'], PDO::PARAM_STR);
                        $stmt->bindParam(":descripcionProducto", $datosModel['descripcionProducto'], PDO::PARAM_STR);
                        $stmt->bindParam(":stockMinProducto", $datosModel['stockMinProducto'], PDO::PARAM_STR);
                        $stmt->bindParam(":estadoProducto", $datosModel['estadoProducto'], PDO::PARAM_INT);
                        $stmt->bindParam(":fotoProducto", $datosModel['fotoProducto'], PDO::PARAM_STR);
                        $stmt->bindParam(":fechaRegistroProducto", $datosModel['fechaRegistroProducto'], PDO::PARAM_STR);
                        $stmt->bindParam(":fkIdEnvaceProducto", $datosModel['fkIdEnvaceProducto'], PDO::PARAM_INT);
                        $stmt->bindParam(":fkIdMarca", $datosModel['fkIdMarca'], PDO::PARAM_INT);
                        $stmt->bindParam(":fkIdCategoriaProducto", $datosModel['fkIdCategoriaProducto'], PDO::PARAM_INT);
                        $stmt->bindParam(":fkIdSubcategoriaProducto", $datosModel['fkIdSubcategoriaProducto'], PDO::PARAM_INT);
                        $stmt->bindParam(":fkIdEmpleado", $datosModel['fkIdEmpleado'], PDO::PARAM_STR);
                    
                  if ($stmt->execute()) {
                        return array('resp' => 1);
                  }else {
                       return array('resp'=> 45);
                  }
                // $stmt->close();
        } catch (Exception $e) {
          return array("resp"=>55555);
          // return array("reps"=>0,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
           exit();
        }
  }
  ##-----------------------------------------------------------------
  ##  LISTAR 
  #==================================================================
  static public function listarProductoModel(){
      $stmt  =  Conexion::cnx()->prepare("SELECT * FROM productos");
      if ($stmt -> execute()) {
        if ($stmt->rowCount() > 0) {
            return array("resp" =>1, "arrayProductos"=>$stmt->fetchAll());
            // return $stmt->fetchAll();
        }else{
            return array("resp"=>0);
        }
      }else {
        return array("resp"=>10);
      } 
  }



  

  ##-----------------------------------------------------------------
  ##  MOSTRAR ULTIMO REGISTRO
  #==================================================================
  static public function listarUltimoProductoModel(){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM productos ORDER BY id_producto DESC LIMIT 1");
    if ($stmt -> execute()) {
      if ($stmt->rowCount() > 0) {
          return array("resp" =>1,"arrayProductos"=>$stmt->fetch());
      }else{
          return array("resp"=>0);
      }
    }else {
      return array("resp"=>10);
    } 
}


 ##-----------------------------------------------------------------
  ##  MOSTRAR POR "ID" 
  #==================================================================
  static public function listarIdProductoModel($datosModel){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM productos WHERE id_producto = :idProducto");
    $stmt ->bindParam(":idProducto",$datosModel,PDO::PARAM_INT);
    $stmt -> execute();
    // return $stmt->fetchAll();
    if ($stmt -> execute()) {
      if ($stmt->rowCount() > 0) {
          return array("resp" =>1,"arrayProductos"=>$stmt->fetch());
      }else{
          return array("resp"=>0);
      }
    }else {
      return array("resp"=>10);
    } 
  }

   ##-----------------------------------------------------------------
  ##  MOSTRAR POR "DNI" 
  #==================================================================
  static public function listarCodigoProductoModel($datosModel){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM productos WHERE codigo_producto = :codigoProducto");
    $stmt ->bindParam(":codigoProducto",$datosModel,PDO::PARAM_STR);
    $stmt -> execute();
    if ($stmt -> execute()) {
      if ($stmt->rowCount() > 0) {
          return array("resp" =>1,"arrayProductos"=>$stmt->fetch());
      }else{
          return array("resp"=>0);
      }
    }else {
      return array("resp"=>10);
    } 
  }


  ##-----------------------------------------------------------------
  ##  ACTUALIZAR POR "ID" 
  #==================================================================
  static public function actualizarProductoModel($datosModel){
      try {
        if(!empty($datosModel['codigoProducto'] AND $datosModel['idProducto'])){
          $stmt  = Conexion::cnx()->prepare("SELECT * FROM productos WHERE  NOT id_producto =:idProducto AND
                                                                            codigo_producto = :codigoProducto
                                                                          
                                            ");
              $stmt ->bindParam(":codigoProducto",$datosModel['codigoProducto'],PDO::PARAM_STR);
              $stmt ->bindParam(":idProducto",$datosModel['idProducto'],PDO::PARAM_INT);
              if ($stmt -> execute()){
                if ($stmt->rowCount() > 0) {
                  return array("resp" =>3,'msj'=>'existe codigo producto');
                  exit();
                }
              }else {
                return array("resp"=>10);
              }
        }

        if(!empty($datosModel['descripcionProducto'] AND $datosModel['idProducto'])){
          $stmt  = Conexion::cnx()->prepare("SELECT * FROM productos WHERE  NOT id_producto =:idProducto AND
                                                                            descripcion_producto = :descripcionProducto
                                                                          
                                            ");
              $stmt ->bindParam(":descripcionProducto",$datosModel['descripcionProducto'],PDO::PARAM_STR);
              $stmt ->bindParam(":idProducto",$datosModel['idProducto'],PDO::PARAM_INT);
              if ($stmt -> execute()){
                if ($stmt->rowCount() > 0) {
                  return array("resp" =>3,'msj'=>'existe descripcion producto');
                  exit();
                }
              }else {
                return array("resp"=>10);
              }
        }

            $stmt  = Conexion::cnx()->prepare("UPDATE productos SET
                                                                  codigo_producto=:codigoProducto,
                                                                  descripcion_producto=:descripcionProducto,
                                                                  stock_min_producto=:stockMinProducto,
                                                                  estado_producto= :estadoProducto,
                                                                  foto_producto=:fotoProducto,
                                                                  fecha_registro_producto=:fechaRegistroProducto,
                                                                  fk_id_envace_producto=:fkIdEnvaceProducto,
                                                                  fk_id_marca=:fkIdMarca,
                                                                  fk_id_categoria_producto=:fkIdCategoriaProducto,
                                                                  fk_id_subcategoria_producto=:fkIdSubcategoriaProducto,
                                                                  fk_id_empleado=:fkIdEmpleado
                                                                WHERE id_producto = :idProducto
                                              ");
             $stmt->bindParam(":codigoProducto", $datosModel['codigoProducto'], PDO::PARAM_STR);
             $stmt->bindParam(":descripcionProducto", $datosModel['descripcionProducto'], PDO::PARAM_STR);
             $stmt->bindParam(":stockMinProducto", $datosModel['stockMinProducto'], PDO::PARAM_STR);
             $stmt->bindParam(":estadoProducto", $datosModel['estadoProducto'], PDO::PARAM_INT);
             $stmt->bindParam(":fotoProducto", $datosModel['fotoProducto'], PDO::PARAM_STR);
             $stmt->bindParam(":fechaRegistroProducto", $datosModel['fechaRegistroProducto'], PDO::PARAM_STR);
             $stmt->bindParam(":fkIdEnvaceProducto", $datosModel['fkIdEnvaceProducto'], PDO::PARAM_INT);
             $stmt->bindParam(":fkIdMarca", $datosModel['fkIdMarca'], PDO::PARAM_INT);
             $stmt->bindParam(":fkIdCategoriaProducto", $datosModel['fkIdCategoriaProducto'], PDO::PARAM_INT);
             $stmt->bindParam(":fkIdSubcategoriaProducto", $datosModel['fkIdSubcategoriaProducto'], PDO::PARAM_INT);
             $stmt->bindParam(":fkIdEmpleado", $datosModel['fkIdEmpleado'], PDO::PARAM_INT);
             $stmt->bindParam(":idProducto", $datosModel['idProducto'], PDO::PARAM_INT);


            if ($stmt -> execute()) {
              if ($stmt->rowCount() > 0) {
                  return array("resp" =>1);
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
  ##-----------------------------------------------------------------
  ##  ELIMINAR POR "ID" 
  #==================================================================
  static public function eliminarProductoModel($datosModel){
    try{
            $stmt  = Conexion::cnx()->prepare("DELETE  FROM productos WHERE id_producto =:idProducto");
            $stmt ->bindParam(":idProducto",$datosModel,PDO::PARAM_INT);
            if ($stmt->execute()) {
                  if ($stmt->rowCount() > 0) {
                      return array("resp" =>1);
                  }else{
                      return array("resp"=>0);
                  }
            }else {
              return array("resp"=>10);
            }
       }
       catch(PDOException $e){
              return array("resp"=>10,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
               exit();
       }
  }

}



// $datos  = array(
//   'codigoProducto' =>'fdfdf',
//   'nombreProducto' =>'AsssssAA',
//   'descripcionProducto' =>'AAAA',
//   'estadoProducto' =>1,
//   'stockMinProducto' =>'12',
//   'unidadMedidaProducto' =>'AAAA',
//   'fechaRegistroProducto' =>'2022-11-24',
//   'fkIdCategoriaProducto' =>'130',
//   'fkIdSubcategoriaProducto' =>'19',
//   'fkIdEmpleado' =>'3',
//   'fkIdMarca' =>'3'
// );


// $obj = new ProductoModel();
// $res = $obj->insertarProductoModel($datos);
// var_dump($res);
