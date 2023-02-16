<div class="page-center">
        <div class="card">
              <div class="card-general card-header">
                    <div class=" card-header-title">
                    <i class="fa-solid fa-layer-group"></i><span> Sub Categoria</span>
                    </div>
                    <div class="card-header-icon">
                        <button class="btnColorNormal" id="btnListarSubCategoriaProducto" onclick="abriVentana();">
                        <i class="fas fa-bars"></i> Buscar
                        </button>
                        
                    </div>
              </div>
              <div class="card-general card-body">
              <!-- class="display responsive nowrap dataTable no-footer dtr-inline" -->
                     <!-- display responsive nowrap dataTable no-footer dtr-inline collapsed -->


                  <form id="frmSubCategoriaProducto">
                    <!-- <div class="form-texbox"> -->
                    <div class="grupo">
                            <input   type="hidden" class="input-block" name="idSubCategoriaProducto" id="idSubCategoriaProducto"   style="user-select:none" disabled >
                            <label hidden class="label-block"   >Id Sub Categoria</label>
                        </div>
                        <div class="grupo">
                            <input type="text" class="form-control" name="detalleSubCategoriaProducto" id="detalleSubCategoriaProducto" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <label for="">Nombre sub categoria</label>
                        </div>

                        <div class="grupo">
                           <select  class="select" name="categoriaProductoSelect" id="categoriaProductoSelect">

                               
                           </select>
                           <label class="label-block-visible" for="">Categoria</label>
                        </div>

                        <!-- <div class="grupo">
                            <input type="text" class="form-control" name="fechaRegistroCategoriaProducto" id="fechaRegistroCategoriaProducto" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <label for="">Fecha Registro</label>
                        </div> -->

                      

                        <!-- <div class="grupo">
                            <input type="text" class="form-control" name="idUsuario" id="idUsuario" required  value="2">
                         
                        </div> -->
                
                        <div class="grupo" id="grupo">
                        </div>
                  </form>
                    

                  <div class="grupo grupo-col1">
                    <button class="btnPrimary btnInsertar"   id="btnInsertarSubCategoriaProducto">
                            <i class="fas fa-bars"></i> Insertar
                    </button> 


                    <button hidden class="btnColorNormal btnActualizar"   id="btnActualizarSubCategoriaProducto">
                            <i class="fas fa-bars"></i> Actulaizar
                    </button> 
                    <button hidden class="btnPrimary btnEliminar"   id="btnEliminarSubCategoriaProducto">
                            <i class="fas fa-bars"></i> Eliminar
                    </button>

                    <button   class="btnSecondary btnCancelar"   id="btnCancelar">
                            <i class="fas fa-bars"></i> Cancelar
                    </button> 
                  </div>
          


              </div>

        


                <script>
                    //   document.getElementById('btn').disabled = true;
                </script>
                 
              <div class="card-general card-footer">
                <div class="mensajeAlertSpan" id="mensajeAlertSpan">
                   <div class="notas-form">
                                 <div style="user-select:none" class="">Ultimo registro fue el <span class="text-bold" id="fechaUltimoRegistroSubcategoria"></span></div><br>
                                 <div class="detalle-ultimo-registro">De: <span class="text-bold" id="nombreUltimoRegistroSubcategoria"></span></div><br>
                              <div class="detalle-ultimo-registro">Por: <span class="text-bold" id="usuarioUltimoRegistroSubcategoria"></span>  </div>
                   </div>
                </div>
              </div>
              
        </div>
</div>



       

<div class="contenedor-modal" > 

<div class="modal">
        <div class="cabecera-modal"> 
            <div class="cerrarModal" onclick="cerrarVentana();" id=""><span>x</span></div>
        </div>
        <div class="body-modal">
        <div class="contenedor_datatable"  id="contenedor_datatable_subcategria_producto" >
        </div>
        </div>  
</div>
</div>






<?php 

$valor = $_SESSION['idEmpleado'];

echo $valor;
// echo 'HOLO GORGOOO';
// var_dump($_SESSION['idEmpleado']);
// 
// echo 1;

?>
