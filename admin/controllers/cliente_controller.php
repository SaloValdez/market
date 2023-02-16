<?php

// require_once "../models/cliente_model.php";

class ClientesController{

    public static function insertarClientesController($datos){
        $respuesta = ClientesModel::insertarClientesModel($datos);
        return $respuesta;
    }

    public static function listarClientesController(){
      $respuesta = ClientesModel::listarClientesModel();
      return $respuesta;
    }

   
    public static function listarUltimoClienteController(){
      $respuesta = ClientesModel::listarUltimoClienteModel();
      return $respuesta;
    }


    public static function listarIdClientesController($dato){
      $respuesta = ClientesModel::listarIdClienteModel($dato);
      return $respuesta;
    }
    public static function listarDniClientesController($dato){
      $respuesta = ClientesModel::listarDniClientesModel($dato);
      return $respuesta;
    }

    public static function actualizaClientesController($dato){
      $respuesta = ClientesModel::actualizaClientesModel($dato);
      return $respuesta;
    }

    public static function eliminarClientesController($datos){
      $respuesta = ClientesModel::eliminarClientesModel($datos);
      return $respuesta;
    }




  }

  // $datos = array(
  //   "dniEmpleado" => '',
  //   "nombreEmpleado" =>'GRINIA',
  //   "apellidoEmpleado" =>'CHOQUE MAQUERA ',
  //   "generoEmpleado" =>'F',
  //   "direccionEmpleado"=>'san francis',
  //   "telefonoEmpleado"=> '95295959',
  //   "correoEmpleado"=>'grnia@gmail.com',
  //   "fotoEmpleado"=>"imagen.png",
  //   "fechaRegistroEmpleado"=>"2022-11-18 23:02:19",
  //   "fkIdEmpleado"=>7,
  //   "idEmpleado"=>47
  // );
  // $obj= new EmpleadosController();
  // $res = $obj->insertarEmpleadosController($datos);
  // var_dump($res);

// $datos  = array(
// 'detalleCategoriaProducto'=>'EMMMMM',  
// 'fkIdUsuario'=>1

// );


// $var = new EmpleadosController();
// $exe = $var ->actualizarEmpledosController($datos);
// var_dump($exe);