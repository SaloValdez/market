<?php


require_once "conexion.php";

 class SubCategoriaProductoModel extends Conexion{
    
  ##-----------------------------------------------------------------
    ##  INSERTAR Sub Categoria
    #==================================================================  'fechaRegistroProducto' => $fechaRegistroProducto,
     static public function insertarSubCategoriaProductoModel($datosModel){

      $stmt  = Conexion::cnx()->prepare("SELECT * FROM subcategoria_producto WHERE 
                                        detalle_subcategoria_producto = :detalleSubCategoriaProducto
                                        ");
      $stmt ->bindParam(":detalleSubCategoriaProducto",$datosModel['detalleSubCategoriaProducto'],PDO::PARAM_STR);
      if ($stmt -> execute()){
        if ($stmt->rowCount() > 0) {
            return array("resp" =>3);
        }else{
          // NO existe la categoria
                      $stmt  =  Conexion::cnx()->prepare("INSERT INTO subcategoria_producto 
                      (
                        detalle_subcategoria_producto,
                        fecha_registro_subcategoria_producto,
                        fk_id_empleado,
                        fk_id_categoria_producto
                      )
                  VALUES(
                      :detalleSubCategoriaProducto,
                      :fechaRegistroSubCategoriaProducto,
                      :fkIdEmpleado,
                      :fkIdCategoriaProducto
                      )
                        ");
                      try {
                            $stmt->bindParam(":detalleSubCategoriaProducto", $datosModel['detalleSubCategoriaProducto'], PDO::PARAM_STR);  
                            $stmt->bindParam(":fechaRegistroSubCategoriaProducto", $datosModel['fechaRegistroSubCategoriaProducto'], PDO::PARAM_STR);   
                            $stmt->bindParam(":fkIdEmpleado", $datosModel['fkIdEmpleado'], PDO::PARAM_INT);        
                            $stmt->bindParam(":fkIdCategoriaProducto", $datosModel['fkIdCategoriaProducto'], PDO::PARAM_INT);  
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
  ##  LISTAR SUB - CATEGORIA
  #==================================================================
  static public function listarSubCategoriaProductoModel(){
      $stmt  =  Conexion::cnx()->prepare("SELECT * FROM subcategoria_producto");
      $stmt->execute();
      return $stmt->fetchAll();  //fetch =  obtiene una fila / fetchAll =  ObtieneTodas las filas
  }



  

  ##-----------------------------------------------------------------
  ##  MOSTRAR ULTIMA Sub Categoria
  #==================================================================
  static public function listarUltimaSubCategoriaProductoModel(){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM subcategoria_producto ORDER BY id_subcategoria_producto DESC LIMIT 1");
    $stmt->execute();
    return $stmt->fetch();
}


  ##-----------------------------------------------------------------
  ##  MOSTRAR POR "ID" Sub Categoria
  #==================================================================
  static public function listarIdSubCategoriaProductoModel($idSubCategoria){
      $stmt  = Conexion::cnx()->prepare("SELECT * FROM subcategoria_producto WHERE id_subcategoria_producto = :idSubCategoriaProducto");
      $stmt ->bindParam(":idSubCategoriaProducto",$idSubCategoria,PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetch();
    //   $stmt->close();
  }

  

  ##-----------------------------------------------------------------
  ##  MOSTRAR POR ID Categoria
  #==================================================================
  static public function listarSub_IdCategoriaModel($idCategoria){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM subcategoria_producto WHERE fk_id_categoria_producto = :fkIdCategoriaProducto");
    $stmt ->bindParam(":fkIdCategoriaProducto",$idCategoria,PDO::PARAM_INT);
    $stmt -> execute();
    return $stmt->fetchAll();
  //   $stmt->close();
}



  ##-----------------------------------------------------------------
  ##  ACTUALIZAR POR "ID" SUB CATEGORIA
  #==================================================================
  static public function actualizarSubCategorioProductoModel($datosModel){
      try {
        $stmt  = Conexion::cnx()->prepare("SELECT * FROM subcategoria_producto WHERE 
                                          detalle_subcategoria_producto = :detalleSubCategoriaProducto
                                          ");
        $stmt ->bindParam(":detalleSubCategoriaProducto",$datosModel['detalleSubCategoriaProducto'],PDO::PARAM_STR);
        if ($stmt -> execute()){
            if ($stmt->rowCount() > 0) {
                return array("resp" =>3);
            }else{
                $stmt  = Conexion::cnx()->prepare("UPDATE subcategoria_producto SET

                                                  detalle_subcategoria_producto = :detalleSubCategoriaProducto,
                                                  fecha_registro_subcategoria_producto = :fechaRegistroSubCategoriaProducto,
                                                  fk_id_empleado=:fkIdEmpleado,
                                                  fk_id_categoria_producto=:fkIdCategoriaProducto
                                               

                                                  WHERE id_subcategoria_producto = :idSubCategoriaProducto
                                                  ");


                $stmt ->bindParam(":detalleSubCategoriaProducto",$datosModel['detalleSubCategoriaProducto'],PDO::PARAM_STR);
                $stmt ->bindParam(":fechaRegistroSubCategoriaProducto",$datosModel['fechaRegistroSubCategoriaProducto'],PDO::PARAM_STR);
                $stmt ->bindParam(":fkIdEmpleado",$datosModel['fkIdEmpleado'],PDO::PARAM_INT);
                $stmt ->bindParam(":fkIdCategoriaProducto",$datosModel['fkIdCategoriaProducto'],PDO::PARAM_INT);
                $stmt ->bindParam(":idSubCategoriaProducto",$datosModel['idSubCategoriaProducto'],PDO::PARAM_INT);
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
  ##  ELIMINAR POR "ID" SUB CATEGORIA
  #==================================================================
  static public function eliminarSubCategoriaModel($idSubCategoria){
    try{
            $stmt  = Conexion::cnx()->prepare("DELETE  FROM subcategoria_producto WHERE id_subcategoria_producto =:idSubCategoriaProducto");
            $stmt ->bindParam(":idSubCategoriaProducto",$idSubCategoria,PDO::PARAM_INT);
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