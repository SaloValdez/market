<?php


require_once "conexion.php";

 class MarcaProductosModel extends Conexion{
    
  ##-----------------------------------------------------------------
    ##  INSERTAR 
    #==================================================================  
    static public function insertarMarcaProductoModel($datosModel){

      if(!empty($datosModel['detalleMarcaProducto'])){

        $stmt  = Conexion::cnx()->prepare("SELECT * FROM marca_producto WHERE  
                                                                    detalle_marca_producto = :detalleMarcaProducto
                                        ");
        $stmt ->bindParam(":detalleMarcaProducto",$datosModel['detalleMarcaProducto'],PDO::PARAM_STR);
        if ($stmt -> execute()){
              if ($stmt->rowCount() > 0) {
                return array("resp" =>3);
                exit();
              }
        }else {
          return array("resp"=>10);
        }
}
        
                $stmt2 =  Conexion::cnx()->prepare("INSERT INTO marca_producto ( 
                                                                            detalle_marca_producto,
                                                                            fecha_registro_marca_producto,
                                                                            fk_id_empleado
                                                                         )
                                                                      VALUES(
                                                                            :detalleMarcaProducto,
                                                                            :fechaRegistroMarcaProducto,
                                                                            :fkIdEmpleado
                                                                          )
                                                  ");
                 try {
                        #bindParam()  vinvula parametros con campos de SQL
                        $stmt2->bindParam(":detalleMarcaProducto", $datosModel['detalleMarcaProducto'], PDO::PARAM_STR);
                        $stmt2->bindParam(":fechaRegistroMarcaProducto", $datosModel['fechaRegistroMarcaProducto'], PDO::PARAM_STR);
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
  static public function listarMarcaProductoModel(){
      $stmt  =  Conexion::cnx()->prepare("SELECT * FROM marca_producto");
      if ($stmt -> execute()) {
        if ($stmt->rowCount() > 0) {
            return array("resp" =>1, "arrayMarcaProductos"=>$stmt->fetchAll());
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
  static public function listarUltimoMarcaProductoModel(){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM marca_producto ORDER BY id_marca_producto DESC LIMIT 1");
    if ($stmt -> execute()) {
      if ($stmt->rowCount() > 0) {
          return array("resp" =>1,"arrayMarcaProductos"=>$stmt->fetch());
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
  static public function listarIdMarcaProductoModel($datosModel){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM marca_producto WHERE id_marca_producto = :idMarcaProducto");
    $stmt ->bindParam(":idMarcaProducto",$datosModel,PDO::PARAM_INT);
    $stmt -> execute();
    // return $stmt->fetchAll();
    if ($stmt -> execute()) {
      if ($stmt->rowCount() > 0) {
          return array("resp" =>1,"arrayMarcaProductos"=>$stmt->fetch());
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
  static public function actualizarMarcaProductosModel($datosModel){
      try {
        if(!empty($datosModel['detalleMarcaProducto'])){
          $stmt  = Conexion::cnx()->prepare("SELECT * FROM marca_producto WHERE 
                                                                    detalle_marca_producto = :detalleMarcaProducto 
                                                                    AND NOT  id_marca_producto = :idMarcaProducto 
                                            ");
              $stmt ->bindParam(":detalleMarcaProducto",$datosModel['detalleMarcaProducto'],PDO::PARAM_STR);
              $stmt ->bindParam(":idMarcaProducto",$datosModel['idMarcaProducto'],PDO::PARAM_INT);
              if ($stmt -> execute()){
              if ($stmt->rowCount() > 0) {
              return array("resp" =>3);
              exit();
              }
              }else {
              return array("resp"=>10);
              }
        }

            $stmt2  = Conexion::cnx()->prepare("UPDATE marca_producto SET
                                                                detalle_marca_producto =:detalleMarcaProducto,
                                                                fecha_registro_marca_producto =:fechaRegistroMarcaProducto,
                                                                fk_id_empleado =:fkIdEmpleado
                                                                WHERE id_marca_producto = :idMarcaProducto
                                              ");
  
            $stmt2->bindParam(":detalleMarcaProducto", $datosModel['detalleMarcaProducto'], PDO::PARAM_STR);  
            $stmt2->bindParam(":fechaRegistroMarcaProducto", $datosModel['fechaRegistroMarcaProducto'], PDO::PARAM_STR);  
            $stmt2->bindParam(":fkIdEmpleado", $datosModel['fkIdEmpleado'], PDO::PARAM_INT);        
            $stmt2->bindParam(":idMarcaProducto", $datosModel['idMarcaProducto'], PDO::PARAM_INT);


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
  static public function eliminarMarcaProductoModel($datosModel){
    try{
            $stmt  = Conexion::cnx()->prepare("DELETE  FROM marca_producto WHERE id_marca_producto =:idMarcaProducto");
            $stmt ->bindParam(":idMarcaProducto",$datosModel,PDO::PARAM_INT);
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
//   'detalleMarcaProducto' =>'VASO',
//   'fechaRegistroMarcaProducto' =>'12-12-12',
//   'fkIdEmpleado' =>2,

// );


// $obj = new MarcaProductosModel();
// $res = $obj->insertarMarcaProductoModel($datos);
// var_dump($res);

// $obj = new MarcaProductosModel();
// $res = $obj->insertarMarcaProductoModel($datos);
// var_dump($res);
