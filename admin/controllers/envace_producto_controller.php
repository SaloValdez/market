<?php

// require_once "../models/envace_producto_model.php";

class EnvaceProductosController{

    public static function insertarEnvaceProductoController($datos){
        $respuesta = EnvaceProductosModel::insertarEnvaceProductoModel($datos);
        return $respuesta;
    }

    public static function listarEnvaceProductoController(){
      $respuesta = EnvaceProductosModel::listarEnvaceProductoModel();
      return $respuesta;
    }

   
    public static function listarUltimoEnvaceProductoController(){
      $respuesta = EnvaceProductosModel::listarUltimoEnvaceProductoModel();
      return $respuesta;
    }


    public static function listarIdEnvaceProductoController($dato){
      $respuesta = EnvaceProductosModel::listarIdEnvaceProductoModel($dato);
      return $respuesta;
    }
    public static function listarCodigoEnvaceProductoModel($dato){
      $respuesta = EnvaceProductosModel::listarCodigoEnvaceProductoModel($dato);
      return $respuesta;
    }

    public static function actualizarEnvaceProductosController($dato){
      $respuesta = EnvaceProductosModel::actualizarEnvaceProductosModel($dato);
      return $respuesta;
    }

    public static function eliminarEnvaceProductoController($datos){
      $respuesta = EnvaceProductosModel::eliminarEnvaceProductoModel($datos);
      return $respuesta;
    }




  }

  

  // $datos  = array(
  //   'detalleEnvaceProducto' =>'ddddddddd',
  //   'fechaRegistroEnvaceProducto' =>'12-12-12',
  //   'fkIdEmpleado' =>23,
  // );


  // $obj= new EnvaceProductosController();
  // $res = $obj->insertarEnvaceProductoController($datos);
  // var_dump($res);


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