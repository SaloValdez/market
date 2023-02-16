<h1>contactos</h1>

<!-- <button class="btnColorNormal" id="btnListarEmpleado" onclick="abriVentana();">
                        <i class="fas fa-bars"></i> Buscar
                    
</button> -->



<!--TODO: cropper PRODUCTO------------MODAL -->
<div class="container">
            <h5>Upload Images</h5>
            <form method="post">
                <input type="file" name="image" class="input-file-cropper">
            </form>
</div>
<div class="contenedor-modal .contenedor-modal-small" id="modal"> 
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
</div>

<!--FIN cropper PRODUCTO------------MODAL -->