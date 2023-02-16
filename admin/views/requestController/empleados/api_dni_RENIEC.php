<?php
// Datos
$token = 'apis-token-1.aTSI1U7KEuT-6bbbCguH-4Y8TI6KS73N';
if (isset($_POST['dniEmpleado'])){
  $dni = $_POST['dniEmpleado'];
}

if (isset($_POST['dniCliente'])){
  $dni = $_POST['dniCliente'];
}

// $dni = '46852585';
// $dni = '46835582';





// Iniciar llamada a API
$curl = curl_init();

// Buscar dni
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 2,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Referer: https://apis.net.pe/consulta-dni-api',
    'Authorization: Bearer ' . $token
  ),
));

$response = curl_exec($curl);


// $tiempo  = set_time_limit(2);

// if($tiempo < 1){
//   $res = array('resp'=>0, 'detalleError'=>'No se imgresó DNI.');
  
// }






$datos = json_decode($response,true);
if($datos== NULL){
  $res = array('resp'=>3, 'detalleError'=>'El numero DNI no existe en RENIEC.');
  echo json_encode($res);
    exit;
}

if(isset($datos['error'])){
      if ($datos['error']=='Nro DNI requerido'){
          $res = array('resp'=>0, 'detalleError'=>'No se imgresó DNI.');
          echo json_encode($res);
      }else if($datos['error']=="Nro DNI debe contener 8 digitos"){
              $res = array('resp'=>3, 'detalleError'=>'Nro DNI debe contener 8 números.');
              echo json_encode($res);
      }
}else{
  $arrayDatos = json_decode($response);
  $res = array('resp'=>1,"arrayDatos"=>$arrayDatos);
  echo json_encode($res);
}
// var_dump($datos->error);
// var_dump($datos['error']);




