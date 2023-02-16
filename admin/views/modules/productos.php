<div class="page-center">
        <div class="card">
              <div class="card-general card-header">
                    <div class=" card-header-title">
                    <i class="fa-solid fa-users-rectangle"> </i><span>&nbsp; Productos </span>
                    </div>
                    <div class="card-header-icon">
                    <button class="btnColorNormal" id="btnListarProductos" onclick="abriVentana();">
                    <i class="fa-solid fa-table-list"></i> Buscar
                    
                    </button>
                    </div>
              </div>
              <div class="card-general card-body">

                  <!-- TODO: FORMULARIO -->
                  <form id="formularioProducto"  class="formulario" >
                 

                            <div class="grupo">
                                <input   type="hidden" class="input-block" name="idProducto" id="idProducto"   style="user-select:none" disabled >
                                <label hidden class="label-block">Id Producto</label>
                            </div>

                            <div class="grid">
                                 
                                    <div class="grupo item2 input-requerido">
                                        <input type="text" class="form-control " name="codigoProducto" id="codigoProducto" required onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                        <label for="">Código Producto</label>
                                    </div>
                               

                           
                                    
                                    <div class="grupo item2 input-requerido">
                                        <input type="text" class="form-control " name="descripcionProducto" id="descripcionProducto" required onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                        <label for="">Descipcion Producto</label>
                                    </div>

                              
                                    <div class="grupo item2 input-requerido">
                                        <input type="text" class="form-control " name="stockMinProducto" id="stockMinProducto" required onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                        <label for="">Stock Minimo (Ejemplo: 2)</label>
                                    </div>


                                    <div class="grupo-check item4   input-requerido">
                                        <input class="input-radio" type="radio" name="estadoProducto"  id="habilitado" value="1" tabindex="4" >
                                        <label class="radio-and-checkbox label-radio" for="habilitado" tabindex="5" >Habilitado</label>

                                        <input class="input-radio" type="radio" name="estadoProducto" id="deshabilitado" value="0" tabindex="6">
                                        <label class="radio-and-checkbox label-radio" for="deshabilitado" tabindex="7">Desabilitado</label>
                                    </div>


                                   

                                    <div class="grupo item-img">    
                                                <div class="content-img" id="content-img" >
                                                
                                                  <img src='./views/requestController/empleados/foto_perfil/img-user.png' style='' class='img-thumbnail' id="imgPreview">
                                                </div>
                                   
                                                <div class="content-input-file">
                                                    <input type="hidden" name="hidden_fotoCliente" id="hidden_fotoCliente">
                                                    <input type="file" hidden class="input-file-cropper" id="filesFotoCliente" name="fotoProducto" aria-label="Archivo" style=" margin-top:40px !important;background-color: red; position:absolute">

                                                    <label  class="label-btn-file" for="filesFotoCliente" id="labelFiles">  <i class="fa-solid fa-upload"></i> Seleccionar</label>
                                                    <label class="nombre-formato-img" for="">jpj, png, jpeg</label>
                                                </div> 
                                     </div>
                             </div>



                                    <div class="grupo-2">
                                            <div class="grupo">
                                               <span class="btnBefore" id="btnAbrirUnidadMedida"><i class="fa-solid fa-plus" onclick="openModal($('#modalUnidadMEdida'))"></i></span>  

                                                <select  class="select" name="fkIdEnvaceProducto" id="fkIdEnvaceProducto"> 
                                                </select>
                                                <label class="label-block-visible" for="">Envace </label>
                                            </div>

                                            <div class="grupo">
                                               <span class="btnBefore" id="btnAbrirMarcaProducto"><i class="fa-solid fa-plus" onclick="openModal($('#marcaProductoModal'))"></i></span>  

                                                <select  class="select" name="fkIdMarcaProducto" id="fkIdMarcaProducto">
                                                </select>
                                                <label class="label-block-visible" for="">Marca </label>
                                            </div>


                                          
                                    </div>
                                 
                                 
                                <div class="grupo-2">
                                       <div class="grupo">
                                            <select  class="select" name="fkIdCategoriaProducto" id="fkIdCategoriaProducto">
                                            </select>
                                            <label class="label-block-visible" for="">Categoria</label>
                                        </div>
                                        <div class="grupo">
                                            <select  class="select" name="fkIdSubCategoriaProducto" id="fkIdSubCategoriaProducto">
                                            </select>
                                            <label class="label-block-visible" for="">Sub Ctegoria</label>
                                        </div>
                                </div>
                  </form>
                  <!-- TODO: FIN    FORMULARIO -->
                                    <div class="grupo grupo-col1 item8" styles="display:flex">
                                        <button class="btnPrimary btnInsertar"   id="btnInsertarProducto">
                                        <i class="fa-regular fa-floppy-disk"></i></i> Insertar
                                        </button> 
                                        <button hidden class="btnColorNormal btnActualizar"   id="btnActualizarProducto">
                                        <i class="fa-solid fa-arrows-spin"></i> Actulaizar
                                        </button> 
                                        <button hidden class="btnPrimary btnEliminar"   id="btnEliminarProducto">
                                        <i class="fa-solid fa-trash-can"></i> Eliminar
                                        </button>
                                        <button   class="btnSecondary btnCancelar"   id="btnCancelar_Producto">
                                        <i class="fa-solid fa-ban"></i></i> Cancelar
                                        </button> 
                                    </div>
                                  
              </div>  
              
              <div class="card-general card-footer">
                <div class="mensajeAlertSpan" id="mensajeAlertSpan">
                   <div class="notas-form">
                                 <div style="user-select:none" class="">Ultimo registro fue el <span class="text-bold"  id="fechaUltimoRegistroCliente"></span></div><br>
                                 <div class="detalle-ultimo-registro">De: <span class="text-bold" id="nombresUltimoRegistroCliente"></span></div><br>
                              <div class="detalle-ultimo-registro">Por: <span class="text-bold"  id="nombresPorUltimoRegistroCliente"></span>  </div>
            
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
        <div class="contenedor_datatable"  id="contenedor_datatable_productos" >
        </div>
        </div>  
</div>
</div>













<!--TODO: cropper PRODUCTO------------MODAL -->
<!-- <div class="contenedor-modal-small crooper"    id="modal_cropper"> 
    <div class="modal-small">
        <div class="card">
                <div class="card-general card-header">
                        <div class=" card-header-title">
                        <i class="fa-solid fa-camera"></i><span>&nbsp; Capturar Imagen </span>
                        </div>
                </div>
                <div class="card-body contenedor-cropper">

                        <div class="col-md-8  contenedor-img-cropper" >                
                                <img id="imgCropper"  width="" >
                        </div>

                        <div class="preview">

                        </div>                
                </div>  
                <div class="card-general card-footer">
                    <button type="button"  id="cancelarImagenCropper" class="btn btn-secondary btnSecondary btnCancelar" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btnPrimary btnInsertar" id="mandarImagenCropper">Capturar</button> 
                </div>
                
        </div>
    </div>
</div> -->

<!--FIN cropper PRODUCTO------------MODAL -->








<!--TODO: Envace PRODUCTO------------MODAL -->
<div class="contenedor-modal-small crooper" id="modal_cropper"> 
        <div class="modal-small">
            <div class="card">
            <div class="card-general card-header">
                            <div class=" card-header-title">
                            <i class="fa-solid fa-camera"></i><span>&nbsp; Capturar Imagen </span>
                            </div>
            </div>
                    <div class="card-body contenedor-cropper">

                            <div class="  contenedor-img-cropper" >                
                                    <img id="imgCropper"  width="100%" >
                            </div>

                            <div class="preview" id="preview">

                            </div>                
                    </div>  
                    <div class="card-general card-footer">
                        <button type="button"  id="cancelarImagenCropper" class="btn btn-secondary btnSecondary btnCancelar" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btnPrimary" id="mandarImagenCropper">Capturar</button> 
                    </div>
        </div>
    </div>
</div>
<!--FIN Envace PRODUCTO-------------MODAL -->
















<!--TODO: Envace PRODUCTO------------MODAL -->
<div class="contenedor-modal-small" id="modalUnidadMEdida"> 
    <div class="modal-small">
        <div class="card">
                <div class="card-general card-header">
                        <div class=" card-header-title">
                        <i class="fa-solid fa-box-open"></i><span>&nbsp;Envace Producto </span>
                        </div>
                        <div class="cerrarModal"onclick="closeModal($('#modalUnidadMEdida'))" id=""><span>x</span></div>
                </div>

                <div class="card-body">
                    <form id="formularioEnvace" class="form-controlSmall">
                         <div class="grupo">
                                <input   type="hidden" class="inputBlockSmall" name="idEnvace" id="idEnvace"   style="user-select:none" disabled >
                                <label hidden class="labelBlockSmall">Id Envace</label>
                            </div>

                                <div class="grupo item2 input-requerido">
                                    <input type="text" class="form-control " name="detalleEnvaceProducto" id="detalleEnvaceProducto" required onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                    <label for="">Envace</label>
                                </div>
                    </form>
                    <div class="grupo grupo-col1 item8" styles="display:flex">
                        <button type="button" class="btn btn-primary btnPrimary  btnInsertarSmall" id="btnInsertarEnvace"><i class="fa-regular fa-floppy-disk"></i></i>Insertar</button> 
                        <button  class="btnColorNormal btnActualizarSmall"   id="btnActualizarEnvace">
                        <i class="fa-solid fa-arrows-spin"></i> Actulaizar
                        </button> 
                        <button  class="btnPrimary btnEliminarSmall"   id="btnEliminarEnvace">
                        <i class="fa-solid fa-trash-can"></i> Eliminar
                        </button>
                        <button   class="btnSecondary btnCancelarSmall"   id="btnCancelarEnvace">
                        <i class="fa-solid fa-ban"></i></i> Cancelar
                        </button> 
        
                    </div>
                </div>  

                <div class="">
                 <div class="body-modal">
                <div class="contenedor_datatable"  id="contenedor_datatable_envace" >
                </div>

                
                </div>
                
        </div>
    </div>
</div>
</div>
<!--FIN Envace PRODUCTO-------------MODAL -->

<!--TODO: Marca PRODUCTO------------MODAL -->
<div class="contenedor-modal-small" id="marcaProductoModal"> 
    <div class="modal-small">
        <div class="card">
                <div class="card-general card-header">
                        <div class=" card-header-title">
                        <i class="fa-solid fa-box-open"></i><span>&nbsp;Marca Producto </span>
                        </div>
                        <div class="cerrarModal"onclick="closeModal($('#marcaProductoModal'))" id=""><span>x</span></div>
                </div>

                <div class="card-body">
                    <form id="formularioMarca" class="form-controlSmall">
                         <div class="grupo">
                                <input   type="hidden" class="inputBlockSmall" name="idMarca" id="idMarca"   style="user-select:none" disabled >
                                <label hidden class="labelBlockSmall">Id Marca</label>
                            </div>

                                <div class="grupo item2 input-requerido">
                                    <input type="text" class="form-control " name="detalleMarcaProducto" id="detalleMarcaProducto" required onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                    <label for="">Marca</label>
                                </div>
                    </form>
                    <div class="grupo grupo-col1 item8" styles="display:flex">
                        <button type="button" class="btn btn-primary btnPrimary  btnInsertarSmall" id="btnInsertarMarca"><i class="fa-regular fa-floppy-disk"></i></i>Insertar</button> 
                        <button  class="btnColorNormal btnActualizarSmall"   id="btnActualizarMarca">
                        <i class="fa-solid fa-arrows-spin"></i> Actulaizar
                        </button> 
                        <button  class="btnPrimary btnEliminarSmall"   id="btnEliminarMarca">
                        <i class="fa-solid fa-trash-can"></i> Eliminar
                        </button>
                        <button   class="btnSecondary btnCancelarSmall"   id="btnCancelarMarca">
                        <i class="fa-solid fa-ban"></i></i> Cancelar
                        </button> 
        
                    </div>
                </div>  
                
                <div class="">
                 <div class="body-modal">
                <div class="contenedor_datatable"  id="contenedor_datatable_marca" >
                </div>

                
                </div>
                
        </div>
    </div>
</div>
</div>

<!--FIN nidad medida PRODUCTO-------------MODAL -->
