<?php


require_once "conexion.php";

 class UsuarioModel extends Conexion{
    





  ##-----------------------------------------------------------------
    ##  INSERTAR usuario
    #==================================================================  'fechaRegistroProducto' => $fechaRegistroProducto,
     static public function insertarUsuarioProductoModel($datosModel){
        
                $stmt  =  Conexion::cnx()->prepare("INSERT INTO categoria_producto (detalle_categoria_producto,fecha_registro_categoria_producto,fk_id_usuario
                                                                         )
                                                                      VALUES(
                                                                           :detalleCategoriaProducto,:fechaRegistroCategoriaProducto,:fkIdUsuario
                                                                          )
                                                  ");
                 try {
                        $stmt->bindParam(":detalleCategoriaProducto", $datosModel['detalleCategoriaProducto'], PDO::PARAM_STR);  
                        $stmt->bindParam(":fechaRegistroCategoriaProducto", $datosModel['fechaRegistroCartegoriaProducto'], PDO::PARAM_STR);  
                        $stmt->bindParam(":fkIdUsuario", $datosModel['fkIdUsuario'], PDO::PARAM_INT);        
                  if ($stmt->execute()) {
                        return array('resp' => 1);
                  }else {
                       return array('resp'=> 45);
                  }
                // $stmt->close();
        } catch (Exception $e) {
          return array("reps"=>0,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
           exit();
        }
  }
  ##-----------------------------------------------------------------
  ##  LISTAR CATEGORIA
  #==================================================================
  static public function listarUsuarioProductoModel(){
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
  ##  MOSTRAR POR "ID" Usuario
  #==================================================================
  static public function listarIdUsuarioProductoModel($idCategoria){
      $stmt  = Conexion::cnx()->prepare("SELECT * FROM categoria_producto WHERE id_categoria_producto = :idCategoriaProducto");
      $stmt ->bindParam(":idCategoriaProducto",$idCategoria,PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetch();
    //   $stmt->close();
  }


  ##-----------------------------------------------------------------
  ##  MOSTRAR POR "ID" Usuario + Personal
  #==================================================================
  static public function listarIdUsuarioEmpleadoModel($idUsuario){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM usuario usu INNER JOIN empleados EMP ON usu.fk_id_empleado = EMP.id_empleado WHERE usu.id_usuario =:idUsuario");
    $stmt ->bindParam(":idUsuario",$idUsuario,PDO::PARAM_INT);
    $stmt -> execute();
    return $stmt->fetch();
  //   $stmt->close();
  }


  ##-----------------------------------------------------------------
  ##  ACTUALIZAR POR "ID" CATEGORIA
  #==================================================================
  static public function actualizarIdCategorioProductoModel($datosCurso){
      try {
            $stmt  = Conexion::cnx()->prepare("UPDATE categoria_producto SET detalle_categoria_producto = :detalleCategoriaProducto,
                                                                fk_id_usuario=:fkIdUsuario
                                                          WHERE id_categoria_producto = :idCategoriaProducto");
            $stmt ->bindParam(":detalleCategoriaProducto",$datosCurso['detalleCategoriaProducto'],PDO::PARAM_STR);
            $stmt ->bindParam(":fkIdUsuario",$datosCurso['fkIdUsuario'],PDO::PARAM_INT);
            $stmt ->bindParam(":idCategoriaProducto",$datosCurso['idCategoriaProducto'],PDO::PARAM_INT);
            if ($stmt -> execute()) {
              if ($stmt->rowCount() > 0) {
                  return array("resp" =>1);
              }else{
                  return array("resp"=>0);
              }
            }else {
              return array("resp"=>0);
            }
            // $stmt->close();
      } catch (Exception $e) {
        return array("resp"=>'errorExceptionssss');
        // return array("reps"=>0,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
         exit();
      }
  }

  ##-----------------------------------------------------------------
  ##  ELIMINAR POR "ID" CURSO
  #==================================================================
  public function eliminarCursoModel($idCurso){
    try{
            $stmt  = Conexion::cnx()->prepare("DELETE  FROM curso WHERE id_curso =:idCurso");
            $stmt ->bindParam(":idCurso",$idCurso,PDO::PARAM_INT);

            if ($stmt->execute()) {
                  if ($stmt->rowCount() > 0) {
                      return array("resp" =>1);
                  }else{
                      return array("resp"=>0);
                  }
            }else {
              return array("resp"=>0);
            }
            // $stmt->close();

       }
       catch(PDOException $e){
              return array("resp"=>0);
              // return array("reps"=>0,"<br>","menssajeError"=>$e->getMessage(),"<br>","lineaDeError"=>$e->getLine());
               exit();
       }
  }

}
                      



// $datos = array('correoUsuario'=>'admin@gmail.com','contrasenaUsuario'=>'tresmastres');

// $datos = 4;

// $obj = new UsuarioModel();
// $res = $obj -> listarIdUsuarioEmpleadoModel($datos);
// var_dump ($res);