<?php


require_once "conexion.php";

 class EmpeladosModel extends Conexion{
    
  ##-----------------------------------------------------------------
    ##  INSERTAR EMPLEADO
    #==================================================================  
     static public function insertarEmpleadosModel($datosModel){
      // 1er proceso :::: VERIFICAR DNI SI EXISTE 
      if(!empty($datosModel['dniEmpleado'])){

                $stmt  = Conexion::cnx()->prepare("SELECT * FROM empleados WHERE 
                dni_empleado = :dniEmpleado
                ");
                $stmt ->bindParam(":dniEmpleado",$datosModel['dniEmpleado'],PDO::PARAM_STR);
                if ($stmt -> execute()){
                if ($stmt->rowCount() > 0) {
                return array("resp" =>3);
                exit();
                }
                }else {
                return array("resp"=>10);
                }
      }
   // 2do proceso :::: insertar Empleado 
          $stmt  =  Conexion::cnx()->prepare("INSERT INTO empleados 
          (
            dni_empleado,
            nombre_empleado,
            apellido_empleado,
            genero_empleado,
            direccion_empleado,
            telefono_empleado,
            correo_empleado,
            foto_empleado,
            fecha_registro_empleado,
            fk_id_empleado
          )
        VALUES(
            :dniEmpleado,
            :nombreEmpleado,
            :apellidoEmpleado,
            :generoEmpleado,
            :direccionEmpleado,
            :telefonoEmpleado,
            :correoEmpleado,
            :fotoEmpleado,
            :fechaRegistroEmpleado,
            :fkIdEmpleado
          )
            ");
          try {
                $stmt->bindParam(":dniEmpleado", $datosModel['dniEmpleado'], PDO::PARAM_STR);  
                $stmt->bindParam(":nombreEmpleado", $datosModel['nombreEmpleado'], PDO::PARAM_STR);   
                $stmt->bindParam(":apellidoEmpleado", $datosModel['apellidoEmpleado'], PDO::PARAM_STR);  
                $stmt->bindParam(":generoEmpleado", $datosModel['generoEmpleado'], PDO::PARAM_STR);  
                $stmt->bindParam(":direccionEmpleado", $datosModel['direccionEmpleado'], PDO::PARAM_STR);  
                $stmt->bindParam(":telefonoEmpleado", $datosModel['telefonoEmpleado'], PDO::PARAM_STR);  
                $stmt->bindParam(":correoEmpleado", $datosModel['correoEmpleado'], PDO::PARAM_STR);  
                $stmt->bindParam(":fotoEmpleado", $datosModel['fotoEmpleado'], PDO::PARAM_STR);  
                $stmt->bindParam(":fechaRegistroEmpleado", $datosModel['fechaRegistroEmpleado'], PDO::PARAM_STR);        
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
  ##-----------------------------------------------------------------
  ##  LISTAR - EMPLEADO
  #==================================================================
  static public function listarEmpleadosModel(){
      $stmt  =  Conexion::cnx()->prepare("SELECT * FROM empleados");
      if ($stmt -> execute()) {
        if ($stmt->rowCount() > 0) {
            return array("resp" =>1, "arrayEmpleados"=>$stmt->fetchAll());
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
  static public function listarUltimoEmpleadoModel(){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM empleados ORDER BY id_empleado DESC LIMIT 1");
    if ($stmt -> execute()) {
      if ($stmt->rowCount() > 0) {
          return array("resp" =>1,"arrayRegistro"=>$stmt->fetch());
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
  static public function listarIdEmpleadoModel($idEmpleado){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM empleados WHERE id_empleado = :idEmpleado");
    $stmt ->bindParam(":idEmpleado",$idEmpleado,PDO::PARAM_INT);
    $stmt -> execute();
    // return $stmt->fetchAll();
    if ($stmt -> execute()) {
      if ($stmt->rowCount() > 0) {
          return array("resp" =>1,"arrayEmpleado"=>$stmt->fetch());
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
  static public function listarDniEmpleadoModel($dniEmpleado){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM empleados WHERE dni_empleado = :dniEmpleado");
    $stmt ->bindParam(":dniEmpleado",$dniEmpleado,PDO::PARAM_STR);
    $stmt -> execute();
    if ($stmt -> execute()) {
      if ($stmt->rowCount() > 0) {
          return array("resp" =>1,"arrayEmpleado"=>$stmt->fetch());
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
  static public function actualizarEmpleadosModel($datosModel){
      try {
        if(!empty($datosModel['dniEmpleado'])){
              $stmt  = Conexion::cnx()->prepare("SELECT * FROM empleados WHERE dni_empleado = :dniEmpleado AND NOT  id_empleado = :idEmpleado 

              ");
              $stmt ->bindParam(":dniEmpleado",$datosModel['dniEmpleado'],PDO::PARAM_STR);
              $stmt ->bindParam(":idEmpleado",$datosModel['idEmpleado'],PDO::PARAM_STR);
              if ($stmt -> execute()){
              if ($stmt->rowCount() > 0) {
              return array("resp" =>3);
              exit();
              }
              }else {
              return array("resp"=>10);
              }
        }

            $stmt  = Conexion::cnx()->prepare("UPDATE empleados SET
                                                dni_empleado =:dniEmpleado,
                                                nombre_empleado =:nombreEmpleado,
                                                apellido_empleado = :apellidoEmpleado,
                                                genero_empleado =:generoEmpleado,
                                                direccion_empleado =:direccionEmpleado,
                                                telefono_empleado =:telefonoEmpleado,
                                                correo_empleado =:correoEmpleado,
                                                foto_empleado =:fotoEmpleado,
                                                fecha_registro_empleado =:fechaRegistroEmpleado,
                                                fk_id_empleado =:fkIdEmpleado
                                              WHERE id_empleado = :idEmpleado
                                              ");

            $stmt->bindParam(":dniEmpleado", $datosModel['dniEmpleado'], PDO::PARAM_STR);  
            $stmt->bindParam(":nombreEmpleado", $datosModel['nombreEmpleado'], PDO::PARAM_STR);   
            $stmt->bindParam(":apellidoEmpleado", $datosModel['apellidoEmpleado'], PDO::PARAM_STR);  
            $stmt->bindParam(":generoEmpleado", $datosModel['generoEmpleado'], PDO::PARAM_STR);  
            $stmt->bindParam(":direccionEmpleado", $datosModel['direccionEmpleado'], PDO::PARAM_STR);  
            $stmt->bindParam(":telefonoEmpleado", $datosModel['telefonoEmpleado'], PDO::PARAM_STR);  
            $stmt->bindParam(":correoEmpleado", $datosModel['correoEmpleado'], PDO::PARAM_STR);  
            $stmt->bindParam(":fotoEmpleado", $datosModel['fotoEmpleado'], PDO::PARAM_STR);  
            $stmt->bindParam(":fechaRegistroEmpleado", $datosModel['fechaRegistroEmpleado'], PDO::PARAM_STR);        
            $stmt->bindParam(":fkIdEmpleado", $datosModel['fkIdEmpleado'], PDO::PARAM_INT);
            $stmt->bindParam(":idEmpleado", $datosModel['idEmpleado'], PDO::PARAM_INT);

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
  static public function eliminarEmpleadosModel($idEmpleado){
    try{
            $stmt  = Conexion::cnx()->prepare("DELETE  FROM empleados WHERE id_empleado =:idEmpleado");
            $stmt ->bindParam(":idEmpleado",$idEmpleado,PDO::PARAM_INT);
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



                      
// $datos = array(
//   "dniEmpleado" => '11111111',
//   "nombreEmpleado" =>'JULIANA',
//   "apellidoEmpleado" =>'OXCENFORD',
//   "generoEmpleado" =>'F',
//   "direccionEmpleado"=>'los robles 3455',
//   "telefonoEmpleado"=> '95295959',
//   "correoEmpleado"=>'juli@gmail.com',
//   "fotoEmpleado"=>"imagen.png",
//   "fechaRegistroEmpleado"=>"2022-11-18 23:02:19",
//   "fkIdEmpleado"=>7

// );


// $datos = '22222D222';
// $obj= new EmpeladosModel();
// $res = $obj->listarDniEmpleadoModel($datos);
// var_dump($res);

// $res = $obj->listarIdEmpleadoModel(7);

// var_dump($res);

// $res = $obj->listarEmpleadosModel();
// var_dump($res);

// echo '----------------------------------------------------<br>';

// var_dump($res['arrayEmpleados'][0][1]);

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