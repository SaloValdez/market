<?php

// require_once "../models/cliente_model.php";

class ProductosController{

    public static function insertarProductoController($datos){
        $respuesta = ProductosModel::insertarProductoModel($datos);
        return $respuesta;
    }

    public static function listarProductoController(){
      $respuesta = ProductosModel::listarProductoModel();
      return $respuesta;
    }

   
    public static function listarUltimoProductoController(){
      $respuesta = ProductosModel::listarUltimoProductoModel();
      return $respuesta;
    }


    public static function listarIdProductoController($dato){
      $respuesta = ProductosModel::listarIdProductoModel($dato);
      return $respuesta;
    }
    public static function listarCodigoProductoModel($dato){
      $respuesta = ProductosModel::listarCodigoProductoModel($dato);
      return $respuesta;
    }

    public static function actualizarProductoController($dato){
      $respuesta = ProductosModel::actualizarProductoModel($dato);
      return $respuesta;
    }

    public static function eliminarProductoController($datos){
      $respuesta = ProductosModel::eliminarProductoModel($datos);
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