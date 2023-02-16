<div class="page-center">
        <div class="card">
              <div class="card-general card-header">
                    <div class=" card-header-title">
                    <i class="fa-solid fa-cart-plus"></i><span>&nbsp; Realizar Venta </span>
                    </div>
                    <div class="card-header-icon">
                    <!-- <button class="btnColorNormal" id="btnListarProductos" onclick="abriVentana();">
                    <i class="fa-solid fa-table-list"></i> Buscar
                    
                    </button> -->
                     
                    </div>
              </div>
              <div class="card-general card-body">
                         <div class="comprobanteActivo">
                            
                             <center><span id=""> Este comprobante aun no se guardo</span></center>
                        </div>
                        <form id="formComprobante"> 
                            <div class="grupo">
                                <input   type="hidden" class="input-block" name="idComprobante" id="idComprobante"   style="user-select:none" disabled >
                                <label hidden class="label-block">Id Conbrobante</label>
                            </div>
                            <div class="grupo item2 input-requerido">
                                <input type="text" class="form-control" name="fechaComprobante" id="fechaComprobante" value="12/12/23"  onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                <label for="">Fecha Comprobante</label></label>
                            </div>
    
                            <div class="grupo item2 input-requerido">
                                <input type="text" class="form-control " name="descripcionProducto" id="descripcionProducto" required onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                <label for="">Descipcion Producto</label>
                            </div>  
                        </form>

                        <Form id="formDetalleComprobante"> 
                                    <div class="grupo item2 input-requerido">
                                        <input type="text" class="form-control " name="name[]" id="TextId" required value="101" onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                        <label for="">id Producto</label>
                                    </div>  


                                    <div class="grupo item2 input-requerido">
                                        <input type="text" class="form-control " name="codigoProducto" id="codigoProducto" required onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                        <label for="">Codigo</label>
                                    </div>  


                                    <div class="contenedor-autocomplete">
                                        <div class="grupo item2 input-requerido">
                                            <input type="hidden" name="idProducto" id="idProducto">
                                            <input type="hidden" name="precioProducto" id="precioProducto">
                                            <input type="text" class="form-control " name="detalleProducto" id="detalleProducto" required onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                            <label for="">Producto</label>
                                        </div>  
                                        <div class="lista-detalle-producto" id="lista-detalle-producto">
                                        </div>           
                                    </div>

                                    <div class="grupo item2 input-requerido">
                                        <input type="text" class="form-control " name="cantidadProducto" id="cantidadProducto" required onkeyup="javascript:this.value=this.value.toUpperCase();"tabindex="2">
                                        <label for="">Cantidad</label>
                                    </div>  

                                    <input type="hidden" name="idTempComprobante" id="idTempComprobante" value="">
                        </Form>



                            <button class="btnPrimary btnInsertar"   id="btnAgregarProductoDetalleComprobante">
                                        <i class="fa-regular fa-floppy-disk"></i></i> Agregar
                            </button> 

                            <!--TODO: DETALLE COMPROBANTE  -->

                        <div id="contenedor_tabla_comprobante">
                           
    
                        </div>
                            <!--TODO: FINNNNN   DETALLE COMPROBANTE  -->
                           
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



       





