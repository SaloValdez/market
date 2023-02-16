
   
   <!-- mi script -->
   <!-- <script type="text/javascript" src="./views/src/lib/datatable/miDatatable.js" charset="utf-8"></script> -->
   
   <!-- <script  src="./views/requestController/ajax/producto.js"  type="text/javascript" ></script> -->



<!-- VALIDACIONES ---BOTONES Y OTROS     -->
   <!-- <script  src="./views/requestController/ajax/____validaciones.js"  type="text/javascript" ></script> -->


<!-- AJAX  por modulos -->
   <!-- <script  src="./views/requestController/ajax/categoria_producto.js"  type="text/javascript" ></script>
   <script  src="./views/requestController/ajax/subcategoria_producto.js"  type="text/javascript" ></script>
   <script  src="./views/requestController/ajax/session_admin.js"  type="text/javascript" ></script>
   <script  src="./views/requestController/ajax/empleados.js"  type="text/javascript" ></script>
   <script  src="./views/requestController/ajax/clientes.js"  type="text/javascript" ></script>
   <script  src="./views/requestController/ajax/productos.js"  type="text/javascript" ></script> -->
   




   <?php
// session_start();
    $enlazar = null;
    $directorio  = opendir("views/requestController/AJAX/");
    while ($elemento = readdir($directorio)) {
          if (is_dir("views/requestController/AJAX/".$elemento)) {
            // $enlazar .= "<script src='admin/views/ajax/".$elemento."'></script>";
          }else {
            #:: Enlazando  todos lo archivos js AJAX
            $enlazar .= "<script type='text/javascript' src='views/requestController/AJAX/".$elemento."'></script>";
          }
    }
    echo $enlazar;
 ?>