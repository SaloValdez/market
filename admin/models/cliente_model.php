<?php


require_once "conexion.php";

 class ClientesModel extends Conexion{
    
  ##-----------------------------------------------------------------
    ##  INSERTAR 
    #==================================================================  
     static public function insertarClientesModel($datosModel){
      // 1er proceso :::: VERIFICAR DNI SI EXISTE 
      if(!empty($datosModel['dniCliente'])){

                $stmt  = Conexion::cnx()->prepare("SELECT * FROM clientes WHERE 
                dni_cliente = :dniCliente
                ");
                $stmt ->bindParam(":dniCliente",$datosModel['dniCliente'],PDO::PARAM_STR);
                if ($stmt -> execute()){
                if ($stmt->rowCount() > 0) {
                return array("resp" =>3);
                exit();
                }
                }else {
                return array("resp"=>10);
                }
      }
   // 2do proceso :::: insertar Cliente 
          $stmt  =  Conexion::cnx()->prepare("INSERT INTO clientes 
          (
            dni_cliente,
            nombre_cliente,
            apellido_cliente,
            genero_cliente,
            direccion_cliente,
            telefono_cliente,
            correo_cliente,
            foto_cliente,
            fecha_registro_cliente,
            fk_id_empleado
          )
        VALUES(
            :dniCliente,
            :nombreCliente,
            :apellidoCliente,
            :generoCliente,
            :direccionCliente,
            :telefonoCliente,
            :correoCliente,
            :fotoCliente,
            :fechaRegistroCliente,
            :fkIdEmpleado
          )
            ");
          try {
                $stmt->bindParam(":dniCliente", $datosModel['dniCliente'], PDO::PARAM_STR);  
                $stmt->bindParam(":nombreCliente", $datosModel['nombreCliente'], PDO::PARAM_STR);   
                $stmt->bindParam(":apellidoCliente", $datosModel['apellidoCliente'], PDO::PARAM_STR);  
                $stmt->bindParam(":generoCliente", $datosModel['generoCliente'], PDO::PARAM_STR);  
                $stmt->bindParam(":direccionCliente", $datosModel['direccionCliente'], PDO::PARAM_STR);  
                $stmt->bindParam(":telefonoCliente", $datosModel['telefonoCliente'], PDO::PARAM_STR);  
                $stmt->bindParam(":correoCliente", $datosModel['correoCliente'], PDO::PARAM_STR);  
                $stmt->bindParam(":fotoCliente", $datosModel['fotoCliente'], PDO::PARAM_STR);  
                $stmt->bindParam(":fechaRegistroCliente", $datosModel['fechaRegistroCliente'], PDO::PARAM_STR);        
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
  ##  LISTAR 
  #==================================================================
  static public function listarClientesModel(){
      $stmt  =  Conexion::cnx()->prepare("SELECT * FROM clientes");
      if ($stmt -> execute()) {
        if ($stmt->rowCount() > 0) {
            return array("resp" =>1, "arrayClientes"=>$stmt->fetchAll());
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
  static public function listarUltimoClienteModel(){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM clientes ORDER BY id_cliente DESC LIMIT 1");
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
  static public function listarIdClienteModel($idCliente){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM clientes WHERE id_cliente = :idCliente");
    $stmt ->bindParam(":idCliente",$idCliente,PDO::PARAM_INT);
    $stmt -> execute();
    // return $stmt->fetchAll();
    if ($stmt -> execute()) {
      if ($stmt->rowCount() > 0) {
          return array("resp" =>1,"arrayCliente"=>$stmt->fetch());
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
  static public function listarDniClienteModel($dniCliente){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM clientes WHERE dni_Cliente = :dniCliente");
    $stmt ->bindParam(":dniCliente",$dniCliente,PDO::PARAM_STR);
    $stmt -> execute();
    if ($stmt -> execute()) {
      if ($stmt->rowCount() > 0) {
          return array("resp" =>1,"arrayCliente"=>$stmt->fetch());
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
  static public function actualizaClientesModel($datosModel){
      try {
        if(!empty($datosModel['dniCliente'])){
              $stmt  = Conexion::cnx()->prepare("SELECT * FROM clientes WHERE NOT  id_cliente = :idCliente AND  dni_Cliente = :dniCliente ");
              $stmt ->bindParam(":dniCliente",$datosModel['dniCliente'],PDO::PARAM_STR);
              $stmt ->bindParam(":idCliente",$datosModel['idCliente'],PDO::PARAM_STR);
              if ($stmt -> execute()){
              if ($stmt->rowCount() > 0) {
              return array("resp" =>3);
              exit();
              }
              }else {
              return array("resp"=>10);
              }
        }

            $stmt  = Conexion::cnx()->prepare("UPDATE clientes SET
                                                dni_cliente =:dniCliente,
                                                nombre_cliente =:nombreCliente,
                                                apellido_cliente = :apellidoCliente,
                                                genero_cliente =:generoCliente,
                                                direccion_cliente =:direccionCliente,
                                                telefono_cliente =:telefonoCliente,
                                                correo_cliente =:correoCliente,
                                                foto_cliente =:fotoCliente,
                                                fecha_registro_cliente =:fechaRegistroCliente,
                                                fk_Id_Empleado =:fkIdEmpleado
                                              WHERE id_cliente = :idCliente
                                              ");

            $stmt->bindParam(":dniCliente", $datosModel['dniCliente'], PDO::PARAM_STR);  
            $stmt->bindParam(":nombreCliente", $datosModel['nombreCliente'], PDO::PARAM_STR);   
            $stmt->bindParam(":apellidoCliente", $datosModel['apellidoCliente'], PDO::PARAM_STR);  
            $stmt->bindParam(":generoCliente", $datosModel['generoCliente'], PDO::PARAM_STR);  
            $stmt->bindParam(":direccionCliente", $datosModel['direccionCliente'], PDO::PARAM_STR);  
            $stmt->bindParam(":telefonoCliente", $datosModel['telefonoCliente'], PDO::PARAM_STR);  
            $stmt->bindParam(":correoCliente", $datosModel['correoCliente'], PDO::PARAM_STR);  
            $stmt->bindParam(":fotoCliente", $datosModel['fotoCliente'], PDO::PARAM_STR);  
            $stmt->bindParam(":fechaRegistroCliente", $datosModel['fechaRegistroCliente'], PDO::PARAM_STR);        
            $stmt->bindParam(":fkIdEmpleado", $datosModel['fkIdEmpleado'], PDO::PARAM_INT);
            $stmt->bindParam(":idCliente", $datosModel['idCliente'], PDO::PARAM_INT);

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
  static public function eliminarClientesModel($idCliente){
    try{
            $stmt  = Conexion::cnx()->prepare("DELETE  FROM clientes WHERE id_cliente =:idCliente");
            $stmt ->bindParam(":idCliente",$idCliente,PDO::PARAM_INT);
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
//   "dniCliente" => '11111111',
//   "nombreCliente" =>'JULIANA',
//   "apellidoCliente" =>'OXCENFORD',
//   "generoCliente" =>'F',
//   "direccionCliente"=>'los robles 3455',
//   "telefonoCliente"=> '95295959',
//   "correoCliente"=>'juli@gmail.com',
//   "fotoCliente"=>"imagen.png",
//   "fechaRegistroCliente"=>"2022-11-18 23:02:19",
//   "fkIdEmpleado"=>7

// );


// $datos = '22222D222';
// $obj= new EmpeladosModel();
// $res = $obj->listarDniClienteModel($datos);
// var_dump($res);

// $res = $obj->listarIdClienteModel(7);

// var_dump($res);

// $res = $obj->listarClientesModel();
// var_dump($res);

// echo '----------------------------------------------------<br>';

// var_dump($res['arrayClientes'][0][1]);

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