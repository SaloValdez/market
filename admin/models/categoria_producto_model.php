<?php


require_once "conexion.php";

 class CategoriaProductoModel extends Conexion{
    
  ##-----------------------------------------------------------------
    ##  INSERTAR categoria
    #==================================================================  'fechaRegistroProducto' => $fechaRegistroProducto,
     static public function insertarCategoriaProductoModel($datosModel){

      $stmt  = Conexion::cnx()->prepare("SELECT * FROM categoria_producto WHERE detalle_categoria_producto = :detalleCategoriaProducto");
      $stmt ->bindParam(":detalleCategoriaProducto",$datosModel['detalleCategoriaProducto'],PDO::PARAM_STR);
      if ($stmt -> execute()){
        if ($stmt->rowCount() > 0) {
            return array("resp" =>3);
        }else{
          // NO existe la categoria
                      $stmt  =  Conexion::cnx()->prepare("INSERT INTO categoria_producto 
                      (
                      detalle_categoria_producto,
                      fecha_registro_categoria_producto,
                      fk_id_empleado
                      )
                  VALUES(
                      :detalleCategoriaProducto,
                      :fechaRegistroCategoriaProducto,
                      :fkIdEmpleado
                      )
                        ");
                      try {
                            $stmt->bindParam(":detalleCategoriaProducto", $datosModel['detalleCategoriaProducto'], PDO::PARAM_STR);  
                            $stmt->bindParam(":fechaRegistroCategoriaProducto", $datosModel['fechaRegistroCategoriaProducto'], PDO::PARAM_STR);  
                            $stmt->bindParam(":fkIdEmpleado", $datosModel['fkIdEmpleado'], PDO::PARAM_INT);        
                            if ($stmt->execute()) {
                              return array('resp' => 1);
                            }else {
                              return array('resp'=> 10);
                            }
                      } catch (Exception $e) {
                            return array("resp"=>10,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
                            exit();
                      }
        }
      }else {
        return array("resp"=>10);
      }

  }
  ##-----------------------------------------------------------------
  ##  LISTAR CATEGORIA
  #==================================================================
  static public function listarCategoriaProductoModel(){
      $stmt  =  Conexion::cnx()->prepare("SELECT * FROM categoria_producto");
      $stmt->execute();
      return $stmt->fetchAll();  //fetch =  obtiene una fila / fetchAll =  ObtieneTodas las filas
  }



  

  ##-----------------------------------------------------------------
  ##  MOSTRAR ULTIMA Categoria
  #==================================================================
  static public function listarUltimaCategoriaProductoModel(){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM categoria_producto ORDER BY id_categoria_producto DESC LIMIT 1");
    $stmt->execute();
    return $stmt->fetch();
}


  ##-----------------------------------------------------------------
  ##  MOSTRAR POR "ID" Categoria
  #==================================================================
  static public function listarIdCategoriaProductoModel($idCategoria){
      $stmt  = Conexion::cnx()->prepare("SELECT * FROM categoria_producto WHERE id_categoria_producto = :idCategoriaProducto");
      $stmt ->bindParam(":idCategoriaProducto",$idCategoria,PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetch();
    //   $stmt->close();
  }


  ##-----------------------------------------------------------------
  ##  ACTUALIZAR POR "ID" CATEGORIA
  #==================================================================
  static public function actualizarCategorioProductoModel($datosModel){
      try {
        $stmt  = Conexion::cnx()->prepare("SELECT * FROM categoria_producto WHERE detalle_categoria_producto = :detalleCategoriaProducto");
        $stmt ->bindParam(":detalleCategoriaProducto",$datosModel['detalleCategoriaProducto'],PDO::PARAM_STR);
        if ($stmt -> execute()){
            if ($stmt->rowCount() > 0) {
                return array("resp" =>3);
            }else{
                $stmt  = Conexion::cnx()->prepare("UPDATE categoria_producto SET 
                                                                    detalle_categoria_producto = :detalleCategoriaProducto,
                                                                    fecha_registro_categoria_producto = :fechaRegistroCategoriaProducto,
                                                                    fk_id_empleado=:fkIdEmpleado
                                                                    WHERE id_categoria_producto = :idCategoriaProducto");


                $stmt ->bindParam(":detalleCategoriaProducto",$datosModel['detalleCategoriaProducto'],PDO::PARAM_STR);
                $stmt ->bindParam(":fechaRegistroCategoriaProducto",$datosModel['fechaRegistroCategoriaProducto'],PDO::PARAM_STR);
                $stmt ->bindParam(":fkIdEmpleado",$datosModel['fkIdEmpleado'],PDO::PARAM_INT);
                $stmt ->bindParam(":idCategoriaProducto",$datosModel['idCategoriaProducto'],PDO::PARAM_INT);
                if ($stmt -> execute()) {
                  if ($stmt->rowCount() > 0) {
                      return array("resp" =>1);
                  }else{
                      return array("resp"=>0);
                  }
                }else {
                  return array("resp"=>10);
                }
            }
         } 
    }catch (Exception $e) {
        // return array("resp"=>'errorExceptionssss');
        return array("resp"=>10,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
         exit();
      }
  }

  ##-----------------------------------------------------------------
  ##  ELIMINAR POR "ID" CATEGORIA
  #==================================================================
  static public function eliminarCategoriaModel($idCategoria){
    try{
            $stmt  = Conexion::cnx()->prepare("DELETE  FROM categoria_producto WHERE id_categoria_producto =:idCategoriaProducto");
            $stmt ->bindParam(":idCategoriaProducto",$idCategoria,PDO::PARAM_INT);
            if ($stmt->execute()) {
                  if ($stmt->rowCount() > 0) {
                      return array("resp" =>1);
                  }else{
                      return array("resp"=>0);
                  }
            }else {
              return array("resp"=>10);
            }
            // $stmt->close();

       }
       catch(PDOException $e){
              return array("resp"=>10,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
               exit();
       }
  }

}
                      

// $datos = array('detalleCategoriaProducto'=>'OBJETOS PARA DORMITORIO','fechaRegistroCategoriaProducto'=>'2002-10-12','fkIdEmpleado'=>222, 'idCategoriaProducto'=>110);

// $obj = new CategoriaProductoModel();
// $ser = $obj -> actualizarCategorioProductoModel($datos);
// var_dump($ser);

// $datos = 100;
// $obj = new CategoriaProductoModel();
// $res = $obj -> eliminarCategoriaModel($datos);
// var_dump($res);


// $idCategoria= 87;
// $nombreCategoria = 'salomon valdeEDSSSSz';
// $fechaRegistroCategoriaProducto = '2022-10-24 11:35:16';
// $idUsuario= 88;

// $obj = new CategoriaProductoModel();
// $ser = $obj -> actualizarCategorioProductoModel($datos);
// var_dump($ser);