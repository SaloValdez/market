<?php




require_once "../../../controllers/producto_controller.php";
require_once "../../../models/producto_model.php";

require_once "../../../controllers/categoria_producto_controller.php";
require_once "../../../models/categoria_producto_model.php";

require_once "../../../controllers/subcategoria_producto_controller.php";
require_once "../../../models/subcategoria_producto_model.php";

require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";



$objProducto = new ProductosController();
$objCategoria = new CategoriaProductoController();
$objSubCategoria = new SubCategoriaProductoController();
$objEmpleado= new EmpleadosController();


$resProducto = $objProducto->listarProductoController();


if(!($resProducto['resp']==0)){
    $arrayProducto = $resProducto['arrayProductos'];
    // var_dump($resProducto['nombre_producto']);
}



   


?>
        <table id="miTabla"  class="display responsive nowrap miTabla" style="width:100%">
          <thead>
              <tr>
                  <th>id</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Stock Min.</th>
                  <th>Estado.</th>
                  <th>Foto</th>
                  <th>F.Registro</th>
                  <th>Id Envace</th>
                  <th>Id Marca</th>
                  <th>Categoria</th>
                  <th>Sub Categoria</th>
                  <th>Empleado</th>
                  <th>Accion</th>
              </tr>
          </thead>
          <tbody>
           
          <?php 
          if(isset($arrayProducto)){
          
          foreach ($arrayProducto as $key => $value){
                       $resIdEmpleado = $objEmpleado->listarIdEmpleadoController($value['fk_id_empleado']);
                       $resCategoria = $objCategoria->listarIdCategoriaController($value['fk_id_categoria_producto']); 
                       $resSubCategoria = $objSubCategoria->listarIdSubCategoriaController($value['fk_id_subcategoria_producto']); 
            ?>
                                <tr>
                                    <td><?php echo $value['id_producto'];?></td>
                                    <td><?php echo $value['codigo_producto'];?></td>
                                    <td><?php echo $value['descripcion_producto'];?></td>
                                    <td><?php echo $value['stock_min_producto'];?></td>
                                    <td><?php echo $value['estado_producto'];?></td>
                                    <td><?php echo $value['foto_producto'];?></td>
                                    <td><?php echo $value['fecha_registro_producto'];?></td>
                                    <td><?php echo $value['fk_id_envace_producto'];?></td>
                                    <td><?php echo $value['fk_id_marca'];?></td>
                                    <td><?php echo $resCategoria['detalle_categoria_producto'];?></td>
                                    <td><?php echo $resSubCategoria['detalle_subcategoria_producto'];?></td>
                                    <td style=" font-size: 10px !important;"><?php echo $resIdEmpleado['arrayEmpleado']['nombre_empleado'].' '.$resIdEmpleado['arrayEmpleado']['apellido_empleado'];?></td>
                               

                                    <td style="text-align: right;">
                                     <a href="#" class="btnDatatatbleInfo"  onclick="btnAccionMostrarDatos(<?php echo $value['id_producto'];?>);">
                                        <i class="fa-solid fa-arrow-left"></i> 
                                     </a>
                                    </td>
                                </tr>
             <?php
                        
                       
                }
            }
            ?>
          </tbody>
      </table> 
      <script type="text/javascript" language="javascript" src="./views/src/lib/datatable/miDatatable.js"></script>














