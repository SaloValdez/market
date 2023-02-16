<?php 

// require_once "./../admin/models/usuario_model.php";
// require_once "./../admin/models/conexion.php";

 class SessionModel extends Conexion{
    
  static public function iniciarSessionModel(){
     session_start();
  }

  static public function nombrarSessionModel ($user){
    $_SESSION['user'] = $user;
  }


  static public function cerrarSessionModel(){
     session_unset();  //borra los valores de las sessiones
     session_destroy(); // destruye los valores de las sessicones
  }

  ##-----------------------------------------------------------------
  ##  logearse USUARIO
  #==================================================================
  static public function loginUsuarioModel($datos){
    $stmt  = Conexion::cnx()->prepare("SELECT * FROM usuario WHERE correo_usuario = :correoUsuario AND contrasena_usuario = :contrasenaUsuario");
    $stmt ->bindParam(":correoUsuario",$datos['correoUsuario'],PDO::PARAM_STR);
    $stmt ->bindParam(":contrasenaUsuario",$datos['contrasenaUsuario'],PDO::PARAM_STR);
    $stmt -> execute();
   $numRow = $stmt->rowCount();
   if ($numRow > 0) {

       $resultadoLogin = $stmt->fetch(PDO::FETCH_ASSOC);

      self::iniciarSessionModel();

       $idUsuario = $resultadoLogin['id_usuario'];
      $obj = new UsuarioModel();
      $resUsuarioEmpleado = $obj->listarIdUsuarioEmpleadoModel($idUsuario);

       $_SESSION['idEmpleado'] = $resUsuarioEmpleado['id_empleado'];
       $_SESSION['idUsuario'] = $resUsuarioEmpleado['id_usuario'];
      $nombresEmpleado = $resUsuarioEmpleado['nombre_empleado'].' '.$resUsuarioEmpleado['apellido_empleado'];
       $variables_de_session = array('resp'=>1,$_SESSION['idEmpleado'],$_SESSION['idUsuario'],'nombresUsuario'=>$nombresEmpleado);
      return $variables_de_session;

   }else {
     return $resp  = array('resp'=>0);
   }
  }
 }


//  $datos = array('correoUsuario'=>'user','contrasenaUsuario'=>'123');

// $obj = new SessionModel();
// $res = $obj -> loginUsuarioModel($datos);

// echo json_encode($res);

// var_dump($res);

//     $obj = new Conexion();
//        $sas = $obj->cnx();
//       var_dump($sas);













