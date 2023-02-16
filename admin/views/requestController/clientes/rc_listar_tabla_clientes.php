<?php




require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";

require_once "../../../controllers/cliente_controller.php";
require_once "../../../models/cliente_model.php";



$objClientes = new ClientesController();
$objEmpleado = new EmpleadosController();



$resClientes = $objClientes->listarClientesController();


if(!($resClientes['resp']==0)){
    $arrayCliente = $resClientes['arrayClientes'];
}



   


// $resIdEmpleado = $objEmpleado->listarIdEmpleadoController(7);
// var_dump($resIdEmpleado);


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
           
          <?php 
          if(isset($arrayCliente)){
          
          foreach ($arrayCliente as $key => $value){
                       $resIdEmpleado = $objEmpleado->listarIdEmpleadoController($value['fk_id_empleado']);
                    //    $resCategoria = $objCategoria->listarIdCategoriaController($value['fk_id_categoria_producto']); 
            ?>
                                <tr>
                                    <td><?php echo $value['id_cliente'];?></td>
                                    <td><?php echo $value['dni_cliente'];?></td>
                                    <td><?php echo $value['nombre_cliente'].' '. $value['apellido_cliente'];?></td>
                                    <td><?php echo $value['genero_cliente'];?></td>
                                    <td><?php echo $value['direccion_cliente'];?></td>
                                    <td><?php echo $value['telefono_cliente'];?></td>
                                    <td><?php echo $value['correo_cliente'];?></td>
                                    <td><?php echo $value['foto_cliente'];?></td>
                                    <td><?php echo $value['fecha_registro_cliente'];?></td>
                                    <td style=" font-size: 10px !important;"><?php echo $resIdEmpleado['arrayEmpleado']['nombre_empleado'].' '.$resIdEmpleado['arrayEmpleado']['apellido_empleado'];?></td>
                               

                                    <td style="text-align: right;">
                                     <a href="#" class="btnDatatatbleInfo"  onclick="btnAccionMostrarDatos(<?php echo $value['id_cliente'];?>);">
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














