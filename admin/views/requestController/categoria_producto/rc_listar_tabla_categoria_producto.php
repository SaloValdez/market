<?php


require_once "../../../controllers/categoria_producto_controller.php";
require_once "../../../models/categoria_producto_model.php";





$obj = new CategoriaProductoController();
$resultado = $obj->listarCategoriaProductoController();
// echo json_encode($resultado);

if(isset($_POST['listar'])){
  echo json_encode($resultado);
}else{
?>
    
    <table id="miTabla"  class="display responsive nowrap miTabla" style="width:100%">
          <thead>
              <tr>
                  <th>id</th>
                  <th>Nombre Categoria</th>
                  <th>id Usuario</th>
                  <th>Accion</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach ($resultado as $key => $value){?>
              <tr>
                  <td><?php echo $value['id_categoria_producto'];?></td>
                  <td><?php echo $value['detalle_categoria_producto'];?></td>
                  <td><?php echo $value['fk_id_empleado'];?></td>
                <td style="text-align: right;">
                    <a href="#" class="btnDatatatbleInfo"  onclick="btnIdDatos_Categoria(<?php echo $value['id_categoria_producto'];?>);">
                    <i class="fa-solid fa-arrow-left"></i> 
                    </a>
                    <!-- btnAccionMostrarDatos(idCategoria) -->
                </td>
              </tr>

        

             <?php
                }

            ?>
          </tbody>
      </table> 
      <script type="text/javascript" language="javascript" src="./views/src/lib/datatable/miDatatable.js"></script>



<?php 

}
?>







