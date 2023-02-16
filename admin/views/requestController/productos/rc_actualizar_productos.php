<?php



require_once "../../../controllers/producto_controller.php";
require_once "../../../models/producto_model.php";


session_start();
$sessionIdEmpleado=$_SESSION['idEmpleado'];


date_default_timezone_set("America/Lima");
$fechaRegistro = date('Y-m-d H:i:s');

$datosForm=$_POST['datosForm'];
parse_str($datosForm,$myArray);
// print_r($myArray);

if(!empty($myArray['hidden_fotoCliente'])){
  $nombre_imagen =$myArray['hidden_fotoCliente'];
}else{
  if(isset($_POST['imagen'])){
    if(!($_POST['imagen']==0)){
      $folderPath = 'foto_productos/';
      $image_parts = explode(";base64,", $_POST['imagen']);
      $image_type_aux = explode("image/", $image_parts[0]);
      $image_type = $image_type_aux[1];
      $image_base64 = base64_decode($image_parts[1]);
      $file = $folderPath . uniqid(). '.png';
      file_put_contents($file, $image_base64);
      // $nombre_imagen = $file;
      $nombre_imagen = substr($file,15);
    }else{
      $nombreProducto= "";
      $nombre_imagen = 'sinFoto.png';
    }
  }else{
  $nombre_imagen = 'sinFoto.png';
  }
}






// $codigoProducto =$_POST['codigoProducto'];
// $nombreProducto =$_POST['nombreProducto'];
// $descripcionProducto =$_POST['descripcionProducto'];
// $estadoProducto =$_POST['estadoProducto'];
// $stockMinProducto =$_POST['stockMinProducto'];
// $unidadMedidaProducto =$_POST['unidadMedidaProducto'];
// $fotoProducto =$nombre_imagen;
// $fechaRegistroProducto =$fechaRegistro;
// // $fkIdCategoriaProducto =$_POST['fkIdCategoriaProducto'];
// // $fkIdSubcategoriaProducto =$_POST['fkIdSubcategoriaProducto'];
// $fkIdCategoriaProducto =129;
// $fkIdSubcategoriaProducto =19;
// $fkIdEmpleado =$sessionIdEmpleado;
// $fkIdMarca =$_POST['fkIdMarca'];

$datos = array(
    "codigoProducto" =>$myArray['codigoProducto'],
    "descripcionProducto" =>$myArray['descripcionProducto'],
    "stockMinProducto"=>$myArray['stockMinProducto'],
    "estadoProducto" =>$myArray['estadoProducto'],
    "fotoProducto"=>$nombre_imagen,
    "fechaRegistroProducto"=>$fechaRegistro,
    "fkIdEnvaceProducto"=>$myArray['fkIdEnvaceProducto'],
    "fkIdMarca"=>$myArray['fkIdMarcaProducto'],
    "fkIdCategoriaProducto"=>$myArray['fkIdCategoriaProducto'],
    "fkIdSubcategoriaProducto"=>$myArray['fkIdSubCategoriaProducto'],
    "fkIdEmpleado"=>$sessionIdEmpleado,
    "idProducto" =>$myArray['idProducto'],
  );
  $obj = new ProductosController();
  $res = $obj->actualizarProductoController($datos);


echo json_encode($res);



