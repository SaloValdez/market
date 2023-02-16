<?php


require_once "../../../controllers/cliente_controller.php";
require_once "../../../models/cliente_model.php";







session_start();
$sessionIdEmpleado=$_SESSION['idEmpleado'];


date_default_timezone_set("America/Lima");
$fechaRegistro = date('Y-m-d H:i:s');


$dniCliente =$_POST['dniCliente'];
$nombreCliente =$_POST['nombreCliente'];
$apellidoCliente =$_POST['apellidoCliente'];
$generoCliente =$_POST['generoCliente'];
$direccionCliente =$_POST['direccionCliente'];
$telefonoCliente =$_POST['telefonoCliente'];
$correoCliente =$_POST['correoCliente'];
$fechaRegistroCliente =$fechaRegistro;
$fkIdEmpleado =$sessionIdEmpleado;


// $dniCliente ='3232323';
// $nombreCliente ='dfdsgdsgfdsgsg';
// $apellidoCliente ='DFDSFSDFSDF';
// $generoCliente ='m';
// $direccionCliente ='ggggggg';
// $telefonoCliente ='44444444444';
// $correoCliente ='dfdfdsfsd';
// $fechaRegistroCliente ='';
// $fkIdEmpleado =2;




if (isset($_FILES["fotoCliente"]["name"])) {
    if($_FILES["fotoCliente"]["name"] != '')
    {
      $extension = explode('.', $_FILES['fotoCliente']['name']);
      $nombre_foto = rand() . '.' . $extension[1];
      $destination = './foto_perfil/'. $nombre_foto;
      move_uploaded_file($_FILES['fotoCliente']['tmp_name'], $destination);

    }
    else {
      if ($_POST["generoCliente"] =='F') {
            $nombre_foto = 'sinFotoF.jpg';
      }else if ($_POST["generoCliente"] =='M') {
            $nombre_foto = 'sinFotoM.jpg';
      }else {
            $nombre_foto = 'sinFoto.jpg';
      }
    }
}else{
      if ($_POST["generoCliente"] =='F') {
            $nombre_foto = 'sinFotoF.jpg';
      }else if ($_POST["generoCliente"] =='M') {
            $nombre_foto = 'sinFotoM.jpg';
      }else {
            $nombre_foto = 'sinFoto.jpg';
      }
}



$datos = array(
    "dniCliente" => $dniCliente,
    "nombreCliente" =>$nombreCliente,
    "apellidoCliente" =>$apellidoCliente,
    "generoCliente" =>$generoCliente,
    "direccionCliente"=>$direccionCliente,
    "telefonoCliente"=>$telefonoCliente,
    "correoCliente"=>$correoCliente,
    "fotoCliente"=>$nombre_foto,
    "fechaRegistroCliente"=>$fechaRegistroCliente,
    "fkIdEmpleado"=>$fkIdEmpleado
  );

  $obj= new ClientesController();
  $res = $obj->insertarClientesController($datos);

  echo json_encode($res);




// // $var = $_FILES['fotoCliente']['name'];
// $var = array('nombre-foto'=>$nombre_foto);



// echo json_encode($var);


  
