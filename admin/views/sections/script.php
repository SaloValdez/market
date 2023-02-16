
<?php 
   session_start();
   if (isset($_SESSION['idEmpleado'])){
       // header('Location:/var=?docente');
       echo "<meta content='3600;URL=categoriasProductos' http-equiv='REFRESH' > </meta>";  #3600   los minutos de estado ssion
   }else{
       header('Location:../../market');
   }
?>

  <!-- <link rel="stylesheet" href="./views/src/lib/cropper/bootstrap/bootstrap.min.css"> -->
  <!-- TODO: Dependencias Cropper -->
  <link rel="stylesheet" href="./views/src/lib/cropper/cropperjs/cropper.min.css">
  <link rel="stylesheet" href="./views/src/lib/cropper/miCrooper.css">

     <!-- FIN: Dependencias de Cropper -->


<link rel="stylesheet" href="./views/src/css/fonts.css">
<link rel="stylesheet" href="./views/src/css/menu.css">
<link rel="stylesheet" href="./views/src/css/content.css">
<link rel="stylesheet" href="./views/src/css/grid.css">
<link rel="stylesheet" href="./views/src/css/forms.css">
<link rel="stylesheet" href="./views/src/css/modal.css">
<link rel="stylesheet" href="./views/src/css/buttons.css">
<link rel="stylesheet" href="./views/src/css/swetAlert.css">



  <!-- TODO: Dependencias de datatable -->
        <script type="text/javascript" src="./views/src/lib/datatable/js/jquery-3.6.0.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="./views/src/lib/datatable/js/jquery.dataTables.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="./views/src/lib/datatable/js/dataTables.responsive.min.js" charset="utf-8"></script>
        <script type="text/javascript" language="javascript" src="./views/src/lib/datatable/miDatatable.js"></script>
        

        <link rel="stylesheet" href="./views/src/lib/datatable/css/jquery.dataTables.min.css" type="text/css" />
        <link rel="stylesheet" href="./views/src/lib/datatable/css/responsive.dataTables.min.css" type="text/css"  />
        <!-- mi estilo -->
        <!-- <link rel="stylesheet" href="./views/src/lib/datatable/miDatatable.css" type="text/css" /> -->

        
   <!-- FIN: Dependencias de datatable -->
   




    <!-- <script src="./views/src/lib/cropper/bootstrap/bootstrap.min.js"></script>  -->
<!-- <script src="./views/src/lib/cropper/cropperjs/cropper.min.js"></script>
<script src="./views/src/lib/cropper/miCrooper.js"></script>  -->








