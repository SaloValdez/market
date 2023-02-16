<?php


require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";

session_start();
$sessionIdEmpleado=$_SESSION['idEmpleado'];



// $datos = array(
//     "dniEmpleado" => '',
//     "nombreEmpleado" =>'yaya',
//     "apellidoEmpleado" =>'CHOQUE MAQUERA ',
//     "generoEmpleado" =>'F',
//     "direccionEmpleado"=>'san francis',
//     "telefonoEmpleado"=> '95295959',
//     "correoEmpleado"=>'grnia@gmail.com',
//     "fotoEmpleado"=>"lolo.png",
//     "fechaRegistroEmpleado"=>"2022-11-18 23:02:19",
//     "fkIdEmpleado"=>7,
//     "idEmpleado"=>47
//   );


  if (isset($_FILES["fotoEmpleado"]["name"])) {
        if($_FILES["fotoEmpleado"]["name"] != ''){

            $extension = explode('.', $_FILES['fotoEmpleado']['name']);
            $nombre_foto = rand() . '.' . $extension[1];
            $destination = './foto_perfil/'. $nombre_foto;
            move_uploaded_file($_FILES['fotoEmpleado']['tmp_name'], $destination);

        }else{ 
            $nombre_foto  = $_POST['hidden_fotoEmpleado'];
        }
    }else{
        $nombre_foto  = $_POST['hidden_fotoEmpleado'];
    }




$dniEmpleado= $_POST['dniEmpleado'];
$nombreEmpleado = $_POST['nombreEmpleado'];
$apellidoEmpleado= $_POST['apellidoEmpleado'];
$generoEmpleado = $_POST['generoEmpleado'];
$direccionEmpleado= $_POST['direccionEmpleado'];
$telefonoEmpleado = $_POST['telefonoEmpleado'];
$correoEmpleado= $_POST['correoEmpleado'];
$fotoEmpleado = $nombre_foto;
date_default_timezone_set("America/Lima");
$fechaRegistroEmpleado =date('Y-m-d H:i:s');
$fkIdEmpleado = $sessionIdEmpleado;
$idEmpleado= $_POST['idEmpleado'];

$datos = array(
    "dniEmpleado" =>$dniEmpleado,
    "nombreEmpleado" =>$nombreEmpleado ,
    "apellidoEmpleado" =>$apellidoEmpleado ,
    "generoEmpleado" => $generoEmpleado,
    "direccionEmpleado"=> $direccionEmpleado  ,
    "telefonoEmpleado"=> $telefonoEmpleado ,
    "correoEmpleado"=> $correoEmpleado ,
    "fotoEmpleado"=> $fotoEmpleado  ,
    "fechaRegistroEmpleado"=>$fechaRegistroEmpleado  ,
    "fkIdEmpleado"=> $fkIdEmpleado  ,
    "idEmpleado"=> $idEmpleado
);

$var = new EmpleadosController();
$exe = $var ->actualizarEmpledosController($datos);
echo json_encode($exe);





// 
    // $obj = new CategoriaProductoController();
    // $res = $obj->actualizarCategorioProductoController($datos);
    // echo json_encode($res);
    
?>
