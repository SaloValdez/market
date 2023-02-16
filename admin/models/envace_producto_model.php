<?php


require_once "conexion.php";

 class EnvaceProductosModel extends Conexion{
    
  ##-----------------------------------------------------------------
    ##  INSERTAR 
    #==================================================================  
    static public function insertarEnvaceProductoModel($datosModel){

      if(!empty($datosModel['detalleEnvaceProducto'])){

        $stmt  = Conexion::cnx()->prepare("SELECT * FROM envace_producto WHERE  
                                                                    detalle_envace_producto = :detalleEnvaceProducto
                                        ");
        $stmt ->bindParam(":detalleEnvaceProducto",$datosModel['detalleEnvaceProducto'],PDO::PARAM_STR);
        if ($stmt -> execute()){
              if ($stmt->rowCount() > 0) {
                return array("resp" =>3);
                exit();
              }
        }else {
          return array("resp"=>10);
        }
}
        
                $stmt2 =  Conexion::cnx()->prepare("INSERT INTO envace_producto ( 
                                                                            detalle_envace_producto,
                                                                            fecha_registro_envace_producto,
                                                                            fk_id_empleado
                                                                         )
                                                                      VALUES(
                                                                            :detalleEnvaceProducto,
                                                                            :fechaRegistroEnvaceProducto,
                                                                            :fkIdEmpleado
                                                                          )
                                                  ");
                 try {
                        #bindParam()  vinvula parametros con campos de SQL
                        $stmt2->bindParam(":detalleEnvaceProducto", $datosModel['detalleEnvaceProducto'], PDO::PARAM_STR);
                        $stmt2->bindParam(":fechaRegistroEnvaceProducto", $datosModel['fechaRegistroEnvaceProducto'], PDO::PARAM_STR);
                        $stmt2->bindParam(":fkIdEmpleado", $datosModel['fkIdEmpleado'], PDO::PARAM_INT);
                    
                  if ($stmt2->execute()) {
                        return array('resp' => 1);
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
  ##-----------------------------------------------------------------
  ##  LISTAR 
  #==================================================================
  static public function listarEnvaceProductoModel(){
      $stmt  =  Conexion::cnx()->prepare("SELECT * FROM envace_producto");
      if ($stmt -> execute()) {
        if ($stmt->rowCount() > 0) {
            return array("resp" =>1, "arrayEnvaceProductos"=>$stmt->fetchAll());
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
  static public function listarUltimoEnvaceProductoModel(){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM envace_producto ORDER BY id_envace_producto DESC LIMIT 1");
    if ($stmt -> execute()) {
      if ($stmt->rowCount() > 0) {
          return array("resp" =>1,"arrayEnvaceProductos"=>$stmt->fetch());
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
  static public function listarIdEnvaceProductoModel($datosModel){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM envace_producto WHERE id_envace_producto = :idEnvaceProducto");
    $stmt ->bindParam(":idEnvaceProducto",$datosModel,PDO::PARAM_INT);
    $stmt -> execute();
    // return $stmt->fetchAll();
    if ($stmt -> execute()) {
      if ($stmt->rowCount() > 0) {
          return array("resp" =>1,"arrayEnvaceProductos"=>$stmt->fetch());
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
  static public function actualizarEnvaceProductosModel($datosModel){
      try {
        if(!empty($datosModel['detalleEnvaceProducto'])){
          $stmt  = Conexion::cnx()->prepare("SELECT * FROM envace_producto WHERE 
                                                                    detalle_envace_producto = :detalleEnvaceProducto 
                                                                    AND NOT  id_envace_producto = :idEnvaceProducto 
                                            ");
              $stmt ->bindParam(":detalleEnvaceProducto",$datosModel['detalleEnvaceProducto'],PDO::PARAM_STR);
              $stmt ->bindParam(":idEnvaceProducto",$datosModel['idEnvaceProducto'],PDO::PARAM_INT);
              if ($stmt -> execute()){
              if ($stmt->rowCount() > 0) {
              return array("resp" =>3);
              exit();
              }
              }else {
              return array("resp"=>10);
              }
        }

            $stmt2  = Conexion::cnx()->prepare("UPDATE envace_producto SET
                                                                detalle_envace_producto =:detalleEnvaceProducto,
                                                                fecha_registro_envace_producto =:fechaRegistroEnvaceProducto,
                                                                fk_id_empleado =:fkIdEmpleado
                                                                WHERE id_envace_producto = :idEnvaceProducto
                                              ");
  
            $stmt2->bindParam(":detalleEnvaceProducto", $datosModel['detalleEnvaceProducto'], PDO::PARAM_STR);  
            $stmt2->bindParam(":fechaRegistroEnvaceProducto", $datosModel['fechaRegistroEnvaceProducto'], PDO::PARAM_STR);  
            $stmt2->bindParam(":fkIdEmpleado", $datosModel['fkIdEmpleado'], PDO::PARAM_INT);        
            $stmt2->bindParam(":idEnvaceProducto", $datosModel['idEnvaceProducto'], PDO::PARAM_INT);


            if ($stmt2 -> execute()) {
              if ($stmt2->rowCount() > 0) {
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
  static public function eliminarEnvaceProductoModel($datosModel){
    try{
            $stmt  = Conexion::cnx()->prepare("DELETE  FROM envace_producto WHERE id_envace_producto =:idEnvaceProducto");
            $stmt ->bindParam(":idEnvaceProducto",$datosModel,PDO::PARAM_INT);
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
//   'detalleEnvaceProducto' =>'VASO',
//   'fechaRegistroEnvaceProducto' =>'12-12-12',
//   'fkIdEmpleado' =>2,

// );


// $obj = new EnvaceProductosModel();
// $res = $obj->insertarEnvaceProductoModel($datos);
// var_dump($res);

// $obj = new EnvaceProductosModel();
// $res = $obj->insertarEnvaceProductoModel($datos);
// var_dump($res);
