<?php
  session_start();
  if(isset($_SESSION['idEmpleado'])){
        header('Location: admin/index.php');
  }


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dddd</title>

<!--TODO: estilosde ADMIN   -->
<link rel="stylesheet" href="./admin/views/src/css/fonts.css">
<link rel="stylesheet" href="./admin/views/src/css/menu.css">
<link rel="stylesheet" href="./admin/views/src/css/content.css">
<link rel="stylesheet" href="./admin/views/src/css/grid.css">
<link rel="stylesheet" href="./admin/views/src/css/forms.css">
<link rel="stylesheet" href="./admin/views/src/css/modal.css">
<link rel="stylesheet" href="./admin/views/src/css/buttons.css">
<link rel="stylesheet" href="./admin/views/src/css/swetAlert.css">
<!-- FIN estilos de ADMIN   -->
<link rel="stylesheet" href="./views/src/css/form_login.css">



  <!-- TODO:  de ADMIN Dependencias de datatable -->
        <script type="text/javascript" src="./admin/views/src/lib/datatable/js/jquery-3.6.0.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="./admin/views/src/lib/datatable/js/jquery.dataTables.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="./admin/views/src/lib/datatable/js/dataTables.responsive.min.js" charset="utf-8"></script>
        <!-- <script type="text/javascript" language="javascript" src="./admin/views/src/lib/datatable/miDatatable.js"></script> -->
        

        <link rel="stylesheet" href="./admin/views/src/lib/datatable/css/jquery.dataTables.min.css" type="text/css" />
        <link rel="stylesheet" href="./admin/views/src/lib/datatable/css/responsive.dataTables.min.css" type="text/css"  />
        <!-- mi estilo -->
        <link rel="stylesheet" href="./admin/views/src/lib/datatable/miDatatable.css" type="text/css" />
   <!-- FIN: Dependencias de datatable -->





    
    <script src="./admin/views/src/lib/datatable/js/jquery-3.6.0.min.js"></script>
    <script src="./views/ajax/session.js"></script>
    <script src="./views/src/js/form_login.js"></script>



</head>
<body>


<div class="contenador_general_login">
 
        <form class="formularioLogin" id="formularioLogin">
        <div class="grupo">
            <center><h3>Ingresar Sistema</h3></center>
        </div>
        <div class="grupo">
            <input type="text" class="form-control" name="correoUsuario" id="correoUsuario" onkeyup="javascript:this.value=this.value.toUpperCase();">
            <label for="">CORREO</label>
        </div>
        <div class="grupo">
            <input type="text" class="form-control" name="contrasenaUsuario" id="contrasenaUsuario"  onkeyup="javascript:this.value=this.value.toUpperCase();">
            <label for="">CONTRASEÑA</label>
        </div>
        <div class="grupo">
        <button class="btnColorNormal btnLogin"   id="btnIngresar">
                            <i class="fas fa-bars"></i> INGRESAR
                    </button> 
        </form>
        </div>
  
</div>

          

<script src="https://kit.fontawesome.com/efa1b37ea8.js" crossorigin="anonymous"></script>
<!-- <script src="./admin//views/src/js/menu.js"></script> -->

<script type="text/javascript" src="./admin/views/src/js/modal.js"></script>



<script src="./admin/views/src/lib/swetAlert/sweetalert2@11.js"></script>
<script src="./admin/views/src/js/miSwetAlert.js"></script>


<script src="./admin/views/src/js/sweetAlertToast.js"></script>


</body>
</html>