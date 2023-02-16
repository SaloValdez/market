<?php

// require_once "../models/categoria_producto_model.php";

class SubCategoriaProductoController  {

    public static function insertarSubCategoriaProductoController($datos){
        $respuesta = SubCategoriaProductoModel::insertarSubCategoriaProductoModel($datos);
        return $respuesta;
    }

    public static function listarSubCategoriaProductoController(){
      $respuesta = SubCategoriaProductoModel::listarSubCategoriaProductoModel();
      return $respuesta;
    }

   
    public static function listarUltimaSubCategoriaProductoController(){
      $respuesta = SubCategoriaProductoModel::listarUltimaSubCategoriaProductoModel();
      return $respuesta;
    }


    public static function listarIdSubCategoriaController($dato){
      $respuesta = SubCategoriaProductoModel::listarIdSubCategoriaProductoModel($dato);
      return $respuesta;
    }
    public static function listarSub_IdCategoriaController($dato){
      $respuesta = SubCategoriaProductoModel::listarSub_IdCategoriaModel($dato);
      return $respuesta;
    }
    

    public static function actualizarSubCategorioProductoController($dato){
      $respuesta = SubCategoriaProductoModel::actualizarSubCategorioProductoModel($dato);
      return $respuesta;
    }

    public static function eliminarSubCategoriaController($datos){
      $respuesta = SubCategoriaProductoModel::eliminarSubCategoriaModel($datos);
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
