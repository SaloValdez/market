<?php

// require_once "../models/marca_producto_model.php";

class MarcaProductosController{

    public static function insertarMarcaProductoController($datos){
        $respuesta = MarcaProductosModel::insertarMarcaProductoModel($datos);
        return $respuesta;
    }

    public static function listarMarcaProductoController(){
      $respuesta = MarcaProductosModel::listarMarcaProductoModel();
      return $respuesta;
    }

   
    public static function listarUltimoMarcaProductoController(){
      $respuesta = MarcaProductosModel::listarUltimoMarcaProductoModel();
      return $respuesta;
    }


    public static function listarIdMarcaProductoController($dato){
      $respuesta = MarcaProductosModel::listarIdMarcaProductoModel($dato);
      return $respuesta;
    }
    public static function listarCodigoMarcaProductoModel($dato){
      $respuesta = MarcaProductosModel::listarCodigoMarcaProductoModel($dato);
      return $respuesta;
    }

    public static function actualizarMarcaProductosController($dato){
      $respuesta = MarcaProductosModel::actualizarMarcaProductosModel($dato);
      return $respuesta;
    }

    public static function eliminarMarcaProductoController($datos){
      $respuesta = MarcaProductosModel::eliminarMarcaProductoModel($datos);
      return $respuesta;
    }




  }

  

  // $datos  = array(
  //   'detalleMarcaProducto' =>'ddddddddd',
  //   'fechaRegistroMarcaProducto' =>'12-12-12',
  //   'fkIdEmpleado' =>23,
  // );


  // $obj= new MarcaProductosController();
  // $res = $obj->insertarMarcaProductoController($datos);
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