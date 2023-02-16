<div class="page-center">
        <div class="card">
              <div class="card-general card-header">
                    <div class=" card-header-title">
                    <i class="fa-solid fa-users-rectangle"> </i><span>&nbsp; Clientes </span>
                    </div>
                    <div class="card-header-icon">
                    <button class="btnColorNormal" id="btnListarCliente" onclick="abriVentana();">
                    <i class="fa-solid fa-table-list"></i> Buscar
                    
                    </button>
                    </div>
              </div>
              <div class="card-general card-body">

                  <!-- TODO: FORMULARIO -->
                  <form id="formularioCliente"  class="formulario" >
                 

                            <div class="grupo">
                                <input   type="hidden" class="input-block" name="idCliente" id="idCliente"   style="user-select:none" disabled >
                                <label hidden class="label-block"   >Id Cliente</label>
                            </div>

                            <div class="grid">
                                    <div class="grupo item1">
                                        <span class="contador-input" id="btnBuscarRENIEC_clientes">8</span>    
                                        <input type="text" class="form-control soloNumeros buscarPorDni" name="dniCliente" id="dniCliente" required onkeyup="javascript:this.value=this.value.toUpperCase();"  tabindex="1">
                                        <label for="">Dni</label>
                                    </div>
                                    
                                    <div class="grupo item2 input-requerido">
                                        <input type="text" class="form-control " name="nombreCliente" id="nombreCliente" required onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                        <label for="">Nombres</label>
                                    </div>

                                    <div class="grupo item3 input-requerido">
                                        <input type="text" class="form-control" name="apellidoCliente" id="apellidoCliente" required onkeyup="javascript:this.value=this.value.toUpperCase();"  tabindex="3">
                                        <label for="">Apellidos</label>
                                    </div>
                                    
                                    <div class="grupo-check item4   input-requerido">
                                        <input class="input-radio" type="radio" name="generoCliente"  id="hombre" value="M" tabindex="4" >
                                        <label class="radio-and-checkbox label-radio" for="hombre" tabindex="5" >Masculino</label>

                                        <input class="input-radio" type="radio" name="generoCliente" id="mujer" value="F" tabindex="6">
                                        <label class="radio-and-checkbox label-radio" for="mujer" tabindex="7">Femenino</label>
                                    </div>

                                    <div class="grupo item-img">    
                                                <div class="content-img" id="content-img" >
                                                  <img src='./views/requestController/empleados/foto_perfil/img-user.png' style='height:170px; width:150px;' class='img-thumbnail'>
                                                </div>
                                   
                                                <div class="content-input-file">
                                                    <input type="hidden" name="hidden_fotoCliente" id="hidden_fotoCliente"> <!-- para actualizar-->

                                                    <input type="file" hidden class="InputFileHiden" id="filesFotoCliente" name="fotoCliente" aria-label="Archivo" style=" margin-top:40px !important;background-color: red; position:absolute">
                                                    <label  class="label-btn-file" for="filesFotoCliente" id="labelFiles">  <i class="fa-solid fa-upload"></i> Seleccionar</label>
                                                    <label class="nombre-formato-img" for="">jpj, png, jpeg</label>
                                                </div> 
                                     </div>
                             </div>




                                    <div class="grupo item5">
                                        <input type="text" class="form-control" name="direccionCliente" id="direccionCliente" required onkeyup="javascript:this.value=this.value.toUpperCase();" tabindex="8">
                                        <label for="">Direccion</label>
                                    </div>
                            
                
                                    <div class="grupo item6">
                                        <input type="text" class="form-control soloNumeros" name="telefonoCliente" id="telefonoCliente" required onkeyup="javascript:this.value=this.value.toUpperCase();" tabindex="9">
                                        <label for="">Telefono</label>
                                    </div> 

                                    <div class="grupo item7">
                                        <input type="text" class="form-control" name="correoCliente" id="correoCliente" required onkeyup="javascript:this.value=this.value.toUpperCase();" tabindex="10">
                                        <label for="">Correo Electrónico</label>
                                    </div>

                                 

                  </form>
                  <!-- TODO: FIN    FORMULARIO -->
                                    <div class="grupo grupo-col1 item8" styles="display:flex">
                                        <button class="btnPrimary btnInsertar"   id="btnInsertarCliente">
                                        <i class="fa-regular fa-floppy-disk"></i></i> Insertar
                                        </button> 
                                        <button hidden class="btnColorNormal btnActualizar"   id="btnActualizarCliente">
                                        <i class="fa-solid fa-arrows-spin"></i> Actulaizar
                                        </button> 
                                        <button hidden class="btnPrimary btnEliminar"   id="btnEliminarCliente">
                                        <i class="fa-solid fa-trash-can"></i> Eliminar
                                        </button>
                                        <button   class="btnSecondary btnCancelar"   id="btnCancelar_Cliente">
                                        <i class="fa-solid fa-ban"></i></i> Cancelar
                                        </button> 
                                    </div>
                                  
              </div>  
              
              

              <div class="card-general card-footer">
                <div class="mensajeAlertSpan" id="mensajeAlertSpan">
                   <div class="notas-form">
                                 <div style="user-select:none" class="">Ultimo registro fue el <span class="text-bold"  id="fechaUltimoRegistroCliente"></span></div><br>
                                 <div class="detalle-ultimo-registro">De: <span class="text-bold"                       id="nombresUltimoRegistroCliente"></span></div><br>
                              <div class="detalle-ultimo-registro">Por: <span class="text-bold"                         id="nombresPorUltimoRegistroCliente"></span>  </div>
            
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
        <div class="contenedor_datatable"  id="contenedor_datatable_clientes" >
        </div>
        </div>  
</div>
</div>





<?php 

// $valor = $_SESSION['idEmpleado'];

// echo $valor;
// echo 'HOLO GORGOOO';
// var_dump($_SESSION['idEmpleado']);
// 
// echo 1;

?>
