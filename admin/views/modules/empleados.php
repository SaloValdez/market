<div class="page-center">
        <div class="card">
              <div class="card-general card-header">
                    <div class=" card-header-title">
                    <i class="fa-solid fa-users-rectangle"> </i><span>&nbsp; Empleados </span>
                    </div>
                    <div class="card-header-icon">
                    <button class="btnColorNormal" id="btnListarEmpleado" onclick="abriVentana();">
                        <i class="fas fa-bars"></i> Buscar
                    
                    </button>
                    </div>
              </div>
              <div class="card-general card-body">

                  <!-- TODO: FORMULARIO -->
                  <form id="formularioEmpleado"  class="formulario" >
                 

                            <div class="grupo">
                                <input   type="hidden" class="input-block" name="idEmpleado" id="idEmpleado"   style="user-select:none" disabled >
                                <label hidden class="label-block"   >Id Empleado</label>
                            </div>

                            <div class="grid">
                                    <div class="grupo item1">
                                        <span class="contador-input" id="btnBuscarRENIEC"> 8</span>    
                                        <input type="text" class="form-control soloNumeros buscarPorDni" name="dniEmpleado" id="dniEmpleado" required onkeyup="javascript:this.value=this.value.toUpperCase();"  tabindex="1">
                                        <label for="">Dni</label>
                                    </div>
                                    
                                    <div class="grupo item2 input-requerido">
                                        <input type="text" class="form-control " name="nombreEmpleado" id="nombreEmpleado" required onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                        <label for="">Nombres</label>
                                    </div>

                                    <div class="grupo item3 input-requerido">
                                        <input type="text" class="form-control" name="apellidoEmpleado" id="apellidoEmpleado" required onkeyup="javascript:this.value=this.value.toUpperCase();"  tabindex="3">
                                        <label for="">Apellidos</label>
                                    </div>
                                    
                                    <div class="grupo-check item4   input-requerido">
                                        <input class="input-radio" type="radio" name="generoEmpleado"  id="hombre" value="M" tabindex="4" >
                                        <label class="radio-and-checkbox label-radio" for="hombre" tabindex="5" >Masculino</label>

                                        <input class="input-radio" type="radio" name="generoEmpleado" id="mujer" value="F" tabindex="6">
                                        <label class="radio-and-checkbox label-radio" for="mujer" tabindex="7">Femenino</label>
                                    </div>

                                    <div class="grupo item-img">    
                                                <div class="content-img" id="content-img" >
                                                  <img src='./views/requestController/empleados/foto_perfil/img-user.png' style='height:170px; width:150px;' class='img-thumbnail'>
                                                </div>
                                   
                                                <div class="content-input-file">
                                                    <input type="hidden" name="hidden_fotoEmpleado"> <!-- para actualizar-->
                                                    <input type="file" hidden class="InputFileHiden" id="filesFotoEmpleado" name="fotoEmpleado" aria-label="Archivo" style=" margin-top:40px !important;background-color: red; position:absolute">
                                                    <label  class="label-btn-file" for="filesFotoEmpleado" id="labelFiles">  <i class="fa-solid fa-upload"></i> Seleccionar</label>
                                                    <label class="nombre-formato-img" for="">jpj, png, jpeg</label>
                                                </div> 
                                     </div>
                             </div>




                                    <div class="grupo item5">
                                        <input type="text" class="form-control" name="direccionEmpleado" id="direccionEmpleado" required onkeyup="javascript:this.value=this.value.toUpperCase();" tabindex="8">
                                        <label for="">Direccion</label>
                                    </div>
                            
                
                                    <div class="grupo item6">
                                        <input type="text" class="form-control soloNumeros" name="telefonoEmpleado" id="telefonoEmpleado" required onkeyup="javascript:this.value=this.value.toUpperCase();" tabindex="9">
                                        <label for="">Telefono</label>
                                    </div> 

                                    <div class="grupo item7">
                                        <input type="text" class="form-control" name="correoEmpleado" id="correoEmpleado" required onkeyup="javascript:this.value=this.value.toUpperCase();" tabindex="10">
                                        <label for="">Correo Electrónico</label>
                                    </div>

                                 

                  </form>
                  <!-- TODO: FIN    FORMULARIO -->
                                    <div class="grupo grupo-col1 item8" styles="display:flex">
                                        <button class="btnPrimary btnInsertar"   id="btnInsertarEmpleado">
                                        <i class="fa-regular fa-floppy-disk"></i></i> Insertar
                                        </button> 
                                        <button hidden class="btnColorNormal btnActualizar"   id="btnActualizarEmpleado">
                                        <i class="fa-solid fa-arrows-spin"></i> Actulaizar
                                        </button> 
                                        <button hidden class="btnPrimary btnEliminar"   id="btnEliminarEmpleado">
                                        <i class="fa-solid fa-trash-can"></i> Eliminar
                                        </button>
                                        <button   class="btnSecondary btnCancelar"   id="btnCancelar_Empleados">
                                        <i class="fa-solid fa-ban"></i></i> Cancelar
                                        </button> 
                                    </div>
                                  
              </div>  
              
              

              <div class="card-general card-footer">
                <div class="mensajeAlertSpan" id="mensajeAlertSpan">
                   <div class="notas-form">
                                 <div style="user-select:none" class="">Ultimo registro fue el <span class="text-bold"  id="fechaUltimoRegistroEmpleado"></span></div><br>
                                 <div class="detalle-ultimo-registro">De: <span class="text-bold"                       id="nombresUltimoRegistro"></span></div><br>
                              <div class="detalle-ultimo-registro">Por: <span class="text-bold"                         id="nombresPorUltimoRegistro"></span>  </div>
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
        <div class="contenedor_datatable"  id="contenedor_datatable_empleados" >
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
