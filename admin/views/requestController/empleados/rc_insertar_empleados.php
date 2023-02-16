<?php


require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";







session_start();
$sessionIdEmpleado=$_SESSION['idEmpleado'];


date_default_timezone_set("America/Lima");
$fechaRegistroCategoriaProducto = date('Y-m-d H:i:s');


$dniEmpleado =$_POST['dniEmpleado'];
$nombreEmpleado =$_POST['nombreEmpleado'];
$apellidoEmpleado =$_POST['apellidoEmpleado'];
$generoEmpleado =$_POST['generoEmpleado'];
$direccionEmpleado =$_POST['direccionEmpleado'];
$telefonoEmpleado =$_POST['telefonoEmpleado'];
$correoEmpleado =$_POST['correoEmpleado'];
$fechaRegistroCategoriaProducto =$fechaRegistroCategoriaProducto;
$fkEmpleado =$sessionIdEmpleado;


// $ff = 'hola';
// $ff = $_FILES["fotoEmpleado"];

// $nombreArchivo = $_FILES['fotoEmpleado']; 

// //Compruebo si el nombre del archivo no está vacío:



if (isset($_FILES["fotoEmpleado"]["name"])) {
    if($_FILES["fotoEmpleado"]["name"] != '')
    {
      $extension = explode('.', $_FILES['fotoEmpleado']['name']);
      $nombre_foto = rand() . '.' . $extension[1];
      $destination = './foto_perfil/'. $nombre_foto;
      move_uploaded_file($_FILES['fotoEmpleado']['tmp_name'], $destination);

    }
    else {
      if ($_POST["generoEmpleado"] =='F') {
            $nombre_foto = 'sinFotoF.jpg';
      }else if ($_POST["generoEmpleado"] =='M') {
            $nombre_foto = 'sinFotoM.jpg';
      }else {
            $nombre_foto = 'sinFoto.jpg';
      }
    }
}else{
      if ($_POST["generoEmpleado"] =='F') {
            $nombre_foto = 'sinFotoF.jpg';
      }else if ($_POST["generoEmpleado"] =='M') {
            $nombre_foto = 'sinFotoM.jpg';
      }else {
            $nombre_foto = 'sinFoto.jpg';
      }
}



$datos = array(
    "dniEmpleado" => $dniEmpleado,
    "nombreEmpleado" =>$nombreEmpleado,
    "apellidoEmpleado" =>$apellidoEmpleado,
    "generoEmpleado" =>$generoEmpleado,
    "direccionEmpleado"=>$direccionEmpleado,
    "telefonoEmpleado"=>$telefonoEmpleado,
    "correoEmpleado"=>$correoEmpleado,
    "fotoEmpleado"=>$nombre_foto,
    "fechaRegistroEmpleado"=>$fechaRegistroCategoriaProducto,
    "fkIdEmpleado"=>$fkEmpleado
  );

    $obj= new EmpleadosController();
  $res = $obj->insertarEmpleadosController($datos);

  echo json_encode($res);




// // $var = $_FILES['fotoEmpleado']['name'];
// $var = array('nombre-foto'=>$nombre_foto);



// echo json_encode($var);


  
