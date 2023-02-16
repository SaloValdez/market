<?php 

require_once "../../admin/models/usuario_model.php";
require_once "../../admin/models/conexion.php";

require_once "../../models/session_model.php";
require_once "../../controllers/session_controller.php";













if (isset($_POST['correoUsuario']) && isset($_POST['contrasenaUsuario'])) {
    $correo= $_POST['correoUsuario'];
    $contrasena = $_POST['contrasenaUsuario'];
    
    $datos = array('correoUsuario'=>$correo,'contrasenaUsuario'=>$contrasena);
    $obj = new SessionController();
    $res = $obj -> loginUsuarioController($datos);
    echo json_encode($res);
}else{
    echo json_encode($res);
}

