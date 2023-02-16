<?php

// require_once "../models/categoria_producto_model.php";

class UsuarioController  {





  // public static function loginUsuarioController($datos){
  //   $respuesta = UsuarioModel::loginUsuarioModel($datos);
  //   return $respuesta;
  // }



    public static function insertarCategoriaProductoController($datos){
        $respuesta = CategoriaProductoModel::insertarCategoriaProductoModel($datos);
        return $respuesta;
    }

    public static function listarCategoriaProductoController(){
      $respuesta = CategoriaProductoModel::listarCategoriaProductoModel();
      return $respuesta;
    }

   
    public static function listarUltimaCategoriaProductoController(){
      $respuesta = CategoriaProductoModel::listarUltimaCategoriaProductoModel();
      return $respuesta;
    }


    public static function listarIdUsuarioEmpleadoController($dato){
      $respuesta =UsuarioModel::listarIdUsuarioEmpleadoModel($dato);
      return $respuesta;
    }

    // public static function actualizarIdCategorioProductoController($dato){
    //   $respuesta = CategoriaProductoModel::actualizarIdCategorioProductoModel($dato);
    //   return $respuesta;
    // }









  }



// $datos  = array(
// 'detalleCategoriaProducto'=>'EMMMMM',  
// 'fkIdUsuario'=>1

// );


// $obj = new CategoriaProductoController();
// $res = $obj->insertarCategoriaProductoController($datos);
// var_dump($res);





// $obj = new  CategoriaProductoController();
// $res = $obj->listarCategoriaProductoController();
// echo json_encode($res);



  ?>
