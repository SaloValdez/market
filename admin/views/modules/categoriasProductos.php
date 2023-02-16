<div class="page-center">
        <div class="card">
              <div class="card-general card-header">
                    <div class=" card-header-title">
                    <i class="fa-solid fa-layer-group"></i><span> Categoria</span>
                    </div>
                    <div class="card-header-icon">
                        <button class="btnColorNormal" id="btnListarCategoriaProducto" onclick="abriVentana();">
                        <i class="fas fa-bars"></i> Buscar
                    
                        </button>
                        
                    </div>
              </div>
              <div class="card-general card-body">
      


                  <form id="frmCategoriaProducto">
                    <!-- <div class="form-texbox"> -->
                    <div class="grupo">
                            <input   type="hidden" class="input-block" name="idCategoriaProducto" id="idCategoriaProducto"   style="user-select:none" disabled >
                            <label hidden class="label-block"   >id Categoria</label>
                    </div>
                        <div class="grupo">
                            <input type="text" class="form-control" name="detalleCategoriaProducto" id="detalleCategoriaProducto" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <label for="">Nombre categoria</label>
                        </div>
               
                     
                  </form>
                    

                  <div class="grupo grupo-col1">
                    <button class="btnPrimary btnInsertar"   id="btnInsertarCategoriaProducto">
                            <i class="fas fa-bars"></i> Insertar
                    </button> 


                    <button hidden class="btnColorNormal btnActualizar"   id="btnActualizarCategoriaProducto">
                            <i class="fas fa-bars"></i> Actulaizar
                    </button> 
                    <button hidden class="btnPrimary btnEliminar"   id="btnEliminarCategoriaProducto">
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
                                 <div style="user-select:none" class="">Ultimo registro fue el <span class="text-bold" id="fechaUltimoRegistroProducto"></span></div><br>
                                 <div class="detalle-ultimo-registro">De: <span class="text-bold" id="nombreUltimoRegistroProducto"></span></div><br>
                              <div class="detalle-ultimo-registro">Por: <span class="text-bold" id="usuarioUltimoRegistroProducto"></span>  </div>
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
        <div class="contenedor_datatable"  id="contenedor_datatable_categria_producto" >
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
