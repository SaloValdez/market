<?php


require_once "../../../controllers/subcategoria_producto_controller.php";
require_once "../../../models/subcategoria_producto_model.php";

require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";

require_once "../../../controllers/categoria_producto_controller.php";
require_once "../../../models/categoria_producto_model.php";

$obj = new SubCategoriaProductoController();
$resultado = $obj->listarSubCategoriaProductoController();

$objEmpleado = new EmpleadosController();
$objCategoria = new CategoriaProductoController();


?>
        <table id="miTabla"  class="display responsive nowrap miTabla" style="width:100%">
          <thead>
              <tr>
                  <th>id</th>
                  <th>Sub Categoria</th>
                  <th>Fech. Registro</th>
                  <th>Empleado</th>
                  <th>Categoria</th>
                  <th>Accion</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach ($resultado as $key => $value){
                       $resEmpleado = $objEmpleado->listarIdEmpleadoController($value['fk_id_empleado']);
                       $resCategoria = $objCategoria->listarIdCategoriaController($value['fk_id_categoria_producto']); 
                       
            ?>
                                <tr>
                                    <td><?php echo $value['id_subcategoria_producto'];?></td>
                                    <td><?php echo $value['detalle_subcategoria_producto'];?></td>
                                    <td><?php echo $value['fecha_registro_subcategoria_producto'];?></td>
                                 
                                    <td><?php echo $resEmpleado['arrayEmpleado']['nombre_empleado'].' '.$resEmpleado['arrayEmpleado']['apellido_empleado'];?></td>
                                    <td><?php echo $resCategoria['detalle_categoria_producto'];?></td>

                                    <td style="text-align: right;">
                                     <a href="#" class="btnDatatatbleInfo"  onclick="btnIdDatos_SubCategoria(<?php echo $value['id_subcategoria_producto'];?>);">
                                        <i class="fa-solid fa-arrow-left"></i> 
                                     </a>
                                    </td>
                                </tr>
             <?php
                        
                       
                }
            ?>
          </tbody>
      </table> 
      <script type="text/javascript" language="javascript" src="./views/src/lib/datatable/miDatatable.js"></script>













