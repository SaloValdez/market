<?php 
// require_once "./../models/session_model.php";


class SessionController {

 static public function cerrarSessionController(){
  $respuesta = SessionModel::cerrarSessionModel();
  return $respuesta;
 }

 static public function loginUsuarioController($datos){
    $respuesta = SessionModel::loginUsuarioModel($datos);
    return $respuesta;
}

}
//  $datos = array('correoUsuario'=>'admin@gmail.com','contrasenaUsuario'=>'tresmastres');

// $obj = new SessionController();
// $res = $obj -> loginUsuarioController($datos);

// var_dump($res);






?>