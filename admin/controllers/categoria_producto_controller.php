<?php

// require_once "../models/categoria_producto_model.php";

class CategoriaProductoController  {

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


    public static function listarIdCategoriaController($dato){
      $respuesta = CategoriaProductoModel::listarIdCategoriaProductoModel($dato);
      return $respuesta;
    }

    public static function actualizarCategorioProductoController($dato){
      $respuesta = CategoriaProductoModel::actualizarCategorioProductoModel($dato);
      return $respuesta;
    }

    public static function eliminarCategoriaController($datos){
      $respuesta = CategoriaProductoModel::eliminarCategoriaModel($datos);
      return $respuesta;
    }




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
