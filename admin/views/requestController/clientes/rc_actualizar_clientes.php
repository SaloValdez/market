<?php


require_once "../../../controllers/cliente_controller.php";
require_once "../../../models/cliente_model.php";

session_start();
$sessionIdEmpleado=$_SESSION['idEmpleado'];



// $datos = array(
//     "dniCliente" => '',
//     "nombreCliente" =>'yaya',
//     "apellidoCliente" =>'CHOQUE MAQUERA ',
//     "generoCliente" =>'F',
//     "direccionCliente"=>'san francis',
//     "telefonoCliente"=> '95295959',
//     "correoCliente"=>'grnia@gmail.com',
//     "fotoCliente"=>"lolo.png",
//     "fechaRegistroCliente"=>"2022-11-18 23:02:19",
//     "fkIdEmpleado"=>7,
//     "idCliente"=>6
//   );

if (isset($_FILES["fotoCliente"]["name"])) {
    if($_FILES["fotoCliente"]["name"] != ''){

        $extension = explode('.', $_FILES['fotoCliente']['name']);
        $nombre_foto = rand() . '.' . $extension[1];
        $destination = './foto_perfil/'. $nombre_foto;
        move_uploaded_file($_FILES['fotoCliente']['tmp_name'], $destination);

    }else{ 
        $nombre_foto  = $_POST['hidden_fotoCliente'];
    }
}else{
    $nombre_foto  = $_POST['hidden_fotoCliente'];
}



$dniCliente= $_POST['dniCliente'];
$nombreCliente = $_POST['nombreCliente'];
$apellidoCliente= $_POST['apellidoCliente'];
$generoCliente = $_POST['generoCliente'];
$direccionCliente= $_POST['direccionCliente'];
$telefonoCliente = $_POST['telefonoCliente'];
$correoCliente= $_POST['correoCliente'];
$fotoCliente = $nombre_foto;
date_default_timezone_set("America/Lima");
$fechaRegistroCliente =date('Y-m-d H:i:s');
$fkIdEmpleado = $sessionIdEmpleado;
$idCliente= $_POST['idCliente'];

$datos = array(
    "dniCliente" =>$dniCliente,
    "nombreCliente" =>$nombreCliente ,
    "apellidoCliente" =>$apellidoCliente ,
    "generoCliente" => $generoCliente,
    "direccionCliente"=> $direccionCliente  ,
    "telefonoCliente"=> $telefonoCliente ,
    "correoCliente"=> $correoCliente ,
    "fotoCliente"=> $fotoCliente  ,
    "fechaRegistroCliente"=>$fechaRegistroCliente  ,
    "fkIdEmpleado"=> $fkIdEmpleado  ,
    "idCliente"=> $idCliente
);

$var = new ClientesController();
$exe = $var ->actualizaClientesController($datos);
echo json_encode($exe);





// 
    // $obj = new CategoriaProductoController();
    // $res = $obj->actualizarCategorioProductoController($datos);
    // echo json_encode($res);
    
?>
