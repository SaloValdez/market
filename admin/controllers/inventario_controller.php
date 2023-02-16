<?php
// require_once "../models/conexion.php";
// require_once "../models/inventario_model.php";

class InventarioController  {
    public static function mostrarIdProductoInventarioController($datos){
        $respuesta = InventarioModel::mostrarIdProductoInventarioModel($datos);
        return $respuesta;
    }
 
    public static function listarIdProductoIventarioController($idproducto){
        $respuesta = InventarioModel::listarIdProductoIventarioModel($idproducto);
        return $respuesta;
    }

      
        // public static function listarUltimaCategoriaProductoController(){
        //   $respuesta = CategoriaProductoModel::listarUltimaCategoriaProductoModel();
        //   return $respuesta;
        // }


        // public static function listarIdCategoriaController($dato){
        //   $respuesta = CategoriaProductoModel::listarIdCategoriaProductoModel($dato);
        //   return $respuesta;
        // }

        // public static function actualizarCategorioProductoController($dato){
        //   $respuesta = CategoriaProductoModel::actualizarCategorioProductoModel($dato);
        //   return $respuesta;
        // }

        // public static function eliminarCategoriaController($datos){
        //   $respuesta = CategoriaProductoModel::eliminarCategoriaModel($datos);
        //   return $respuesta;
        // }
  }


// $obj = new InventarioController();
// $res = $obj->mostrarIdProdcutoInventarioController(102);
// var_dump($res);
                      




// $obj = new InventarioController();
// $res = $obj->listarIdProductoIventarioController(102);
// var_dump($res);
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
