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


$resEmpleado = $objEmpleado->listarEmpleadosController();
$arrayEmpleado = $resEmpleado['arrayEmpleados'];
// echo  json_encode($arrayEmpleado);

?>
        <table id="miTabla"  class="display responsive nowrap miTabla" style="width:100%">
          <thead>
              <tr>
                  <th>id</th>
                  <th>Dni</th>
                  <th>Nombres</th>
                  <th>Genero</th>
                  <th>Direccion</th>
                  <th>Telefono</th>
                  <th>Correo</th>
                  <th>Foto</th>
                  <th>Fecha Reg.</th>
                  <th>Registro por: </th>
                  <th>Accion</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach ($arrayEmpleado as $key => $value){
                       $resIdEmpleado = $objEmpleado->listarIdEmpleadoController($value['fk_id_empleado']);
                    //    $resCategoria = $objCategoria->listarIdCategoriaController($value['fk_id_categoria_producto']); 
            ?>
                                <tr>
                                    <td><?php echo $value['id_empleado'];?></td>
                                    <td><?php echo $value['dni_empleado'];?></td>
                                    <td><?php echo $value['nombre_empleado'].' '. $value['apellido_empleado'];?></td>
                                    <td><?php echo $value['genero_empleado'];?></td>
                                    <td><?php echo $value['direccion_empleado'];?></td>
                                    <td><?php echo $value['telefono_empleado'];?></td>
                                    <td><?php echo $value['correo_empleado'];?></td>
                                    <td><?php echo $value['foto_empleado'];?></td>
                                    <td><?php echo $value['fecha_registro_empleado'];?></td>
                                    <td style=" font-size: 10px !important;"><?php echo $resIdEmpleado['arrayEmpleado']['nombre_empleado'].' '.$resIdEmpleado['arrayEmpleado']['apellido_empleado'];?></td>
                               

                                    <td style="text-align: right;">
                                     <a href="#" class="btnDatatatbleInfo"  onclick="btnAccionMostrarDatos(<?php echo $value['id_empleado'];?>);">
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














