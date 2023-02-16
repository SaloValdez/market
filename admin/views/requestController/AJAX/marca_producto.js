// Desarrollado  por © SaloCod
$(document).ready(function(){
  
    insertarMarca();
    // listarMarca();
    eliminarMarca();
    actualizarMarca();
    listarSelectMarca();
  
});


function habilitarMarca(){
  $('#idMarca').get(0).type = 'text';
}


function deshabilitarMarca(){
  // $('#formularioMarca').empty();
  $("#formularioMarca")[0].reset();
  $('#idMarca').get(0).type = 'hidden';
}
$('#btnCancelarMarca').click(function(){
  deshabilitarMarca();
});



$('#btnAbrirMarcaProducto').click(function(){
  listarMarca();
});

function listarMarca(){
  $.ajax({
    type:"POST",
    data: {tipo:'listarTabla'},
    url:"views/requestController/marca_productos/rc_marca_productos.php",
    success:function(r){
      if ($(".dataTables_wrapper") ) {
        deshabilitarSmall();
        $(".contenedor_datatable").empty();
        $("#contenedor_datatable_marca").html(r);
       }
    }
  }); 
}
function listarSelectMarca(){
  $.ajax({  
    type:"POST",
    data: {tipo:'listar'},
    url:"views/requestController/marca_productos/rc_marca_productos.php",
    success:function(r){
        datos=jQuery.parseJSON(r);
        let mostrar = datos['arrayMarcaProductos'];
        
        $('#fkIdMarcaProducto option').remove();
        $("#fkIdMarcaProducto").append("<option value='0'>Seleccione una opcion</option>");
        for(var i in mostrar)
        { 
          $("#fkIdMarcaProducto").append("<option value='"+mostrar[i]['id_marca_producto']+"'>"+mostrar[i]['detalle_marca_producto']+"</option>");
        }
    }
  });
}


function btnAccionMostrarDatosMarca(id){
    $.ajax({
      type:"POST",
      data: {tipo:'mostrarId',idMarca:id},
      url:"views/requestController/marca_productos/rc_marca_productos.php",
      success:function(r){
        datos=jQuery.parseJSON(r);
        // console.log(datos);
        habilitarSmall();
        habilitarMarca();



        $('#idMarca').val(datos['arrayMarcaProductos']['id_marca_producto']);
        $('#detalleMarcaProducto').val(datos['arrayMarcaProductos']['detalle_marca_producto']);
      }
    }); 
}



function insertarMarca(){
    $('#btnInsertarMarca').click(function(){
        // alert('insertarmarca');
        let datos=$('#formularioMarca').serialize(); 
        let descripcionMarca =   $("#detalleMarcaProducto").val();
                // try {
                    $.ajax({
                        type:"POST",
                        data: {tipo:'insertar',datosForm:datos},
                        url:"views/requestController/marca_productos/rc_marca_productos.php",
                        success:function(r){
                          let datos  = jQuery.parseJSON(r);
                       
                          let  respuesta = datos['resp'];
                          // console.log(respuesta);
                            if (respuesta == 1) {
                                successToast(3,'Muy bien','Se registro con exito.','','');
                                listarMarca();
                                deshabilitarSmall();
                                listarSelectMarca();
                                deshabilitarMarca();
                            }else if(respuesta==3){
                              errorToast(3,"Error",'Producto con codigo o  nombre este,','  Ya existe.');
                            }else if(respuesta == 10){
                                errorToast(3,"Error",'Algo paso en el servidor.','','');
                            }else{
                              errorToast(3,"Error",'Algo paso en el servidor.','','');
                            }
                        }
                      });
                // }
                // catch(e) {
                //     // errorToast(3,"Error",'Comuniquese con el Administador.','');
                // } 
    });
  }

  function actualizarMarca(){
    $('#btnActualizarMarca').click(function(){
      // alert('actualizar');
        let datos=$('#formularioMarca').serialize(); 
        let idMarca = $('#idMarca').val();
   
                // try {
                    $.ajax({
                        type:"POST",
                        data: {tipo:'actualizar',idMarca:idMarca,datosForm:datos},
                        url:"views/requestController/marca_productos/rc_marca_productos.php",
                        success:function(r){
                          let datos  = jQuery.parseJSON(r);
                          // console.log(datos);
                          let  respuesta = datos['resp'];
                          // console.log(respuesta);
                            if (respuesta == 1) {
                                successToast(3,'Muy bien','Se actualizó con exito.','','');
                                listarMarca();
                                deshabilitarSmall();
                                listarSelectMarca();
                                deshabilitarMarca();
                            }else if(respuesta==3){
                              errorToast(3,"Error",'Producto con codigo o  nombre este,','  Ya existe.');
                            }else if(respuesta == 10){
                                errorToast(3,"Error",'Algo paso en el servidor.','','');
                            }else{
                              errorToast(3,"Error",'Algo paso en el servidor.','','');
                            }
                        }
                      });
                // }
                // catch(e) {
                //     // errorToast(3,"Error",'Comuniquese con el Administador.','');
                // } 
    });
  }
  
function eliminarMarca(){
  $('#btnEliminarMarca').click(function(){
    habilitarSmall();
          idMarca = $('#idMarca').val();
          let datos=$('#formularioMarca').serialize(); 
          $.ajax({  
            type:"POST",
            data: {tipo:'mostrarId',idMarca:idMarca},
            url:"views/requestController/marca_productos/rc_marca_productos.php",
            success:function(r){
              datos=jQuery.parseJSON(r);
                datos=jQuery.parseJSON(r);
                Swal.fire({
                  title: '¿Deseas eliminar?',
                  text:'['+ datos['arrayMarcaProductos']['detalle_marca_producto']  +'] ',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: 'var(--colorpalet1)',
                  confirmButtonText: 'Si, Eliminar',
                  allowOutsideClick: false,
                }).then((result) =>{
                  if (result.isConfirmed) {
                          $.ajax({  
                      type:"POST",
                      data: {tipo:'eliminar',idMarca:datos['arrayMarcaProductos']['id_marca_producto']},
                      url:"views/requestController/marca_productos/rc_marca_productos.php",
                      success:function(r){
                          datos=jQuery.parseJSON(r);
                                  if(datos['resp']==1){
                                    Swal.fire(
                                      'Correcto',
                                      'Se elimino correctamente.',
                                      'success'
                                    );
                                    // deshabilitar_clientes();
                                    listarMarca();
                                    deshabilitarSmall();
                                    listarSelectMarca();
                                    deshabilitarMarca();
                                  }else{
                                    Swal.fire(
                                      'Upps...',
                                      'No se elimo registro',
                                      'error'
                                    )
                                    
                                  }
                            }
                          });
                  }
                })

            }
          });
    });
  }