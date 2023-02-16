<?php

// require_once "../models/empleado_model.php";

class EmpleadosController{

    public static function insertarEmpleadosController($datos){
        $respuesta = EmpeladosModel::insertarEmpleadosModel($datos);
        return $respuesta;
    }

    public static function listarEmpleadosController(){
      $respuesta = EmpeladosModel::listarEmpleadosModel();
      return $respuesta;
    }

   
    public static function listarUltimoEmpleadoController(){
      $respuesta = EmpeladosModel::listarUltimoEmpleadoModel();
      return $respuesta;
    }


    public static function listarIdEmpleadoController($dato){
      $respuesta = EmpeladosModel::listarIdEmpleadoModel($dato);
      return $respuesta;
    }
    public static function listarDniEmpleadoController($dato){
      $respuesta = EmpeladosModel::listarDniEmpleadoModel($dato);
      return $respuesta;
    }

    public static function actualizarEmpleadosController($dato){
      $respuesta = EmpeladosModel::actualizarEmpleadosModel($dato);
      return $respuesta;
    }

    public static function eliminarEmpleadosController($datos){
      $respuesta = EmpeladosModel::eliminarEmpleadosModel($datos);
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