// Desarrollado  por © SaloCod
$(document).ready(function(){
  
    insertarEnvace();
    // listarEnvace();
    eliminarEnvace();
    actualizarEnvace();
    listarSelectEnvace();
  
});


$('#btnAbrirUnidadMedida').click(function(){
  listarEnvace();

});




function deshabilitarEnvace(){
  // $('#formularioMarca').empty();
  $("#formularioEnvace")[0].reset();
  $('#idEnvace').get(0).type = 'hidden';
}

$('#btnCancelarEnvace').click(function(){
  deshabilitarEnvace();
});

function listarEnvace(){
  $.ajax({
    type:"POST",
    data: {tipo:'listarTabla'},
    url:"views/requestController/envace_productos/rc_envace_productos.php",
    success:function(r){
      if ($(".dataTables_wrapper") ) {
        deshabilitarSmall();
        $(".contenedor_datatable").empty();
        $("#contenedor_datatable_envace").html(r);
       }
    }
  }); 
}

function listarSelectEnvace(){
  $.ajax({  
    type:"POST",
    data: {tipo:'listar'},
    url:"views/requestController/envace_productos/rc_envace_productos.php",
    success:function(r){
        datos=jQuery.parseJSON(r);
        let mostrar = datos['arrayEnvaceProductos'];
        
        $('#fkIdEnvaceProducto option').remove();
        $("#fkIdEnvaceProducto").append("<option value='0'>Seleccione una opcion</option>");
        for(var i in mostrar)
        { 
          $("#fkIdEnvaceProducto").append("<option value='"+mostrar[i]['id_envace_producto']+"'>"+mostrar[i]['detalle_envace_producto']+"</option>");
        }
    }
  });
}

function btnAccionMostrarDatosEnvace(id){
    $.ajax({
      type:"POST",
      data: {tipo:'mostrarId',idEnvace:id},
      url:"views/requestController/envace_productos/rc_envace_productos.php",
      success:function(r){
        datos=jQuery.parseJSON(r);
        habilitarSmall();
        $('#idEnvace').val(datos['arrayEnvaceProductos']['id_envace_producto']);
        $('#detalleEnvaceProducto').val(datos['arrayEnvaceProductos']['detalle_envace_producto']);
      }
    }); 
}



function insertarEnvace(){
    $('#btnInsertarEnvace').click(function(){
    
        let datos=$('#formularioEnvace').serialize(); 
        let descripcionEnvace =   $("#detalleEnvaceProducto").val();
                // try {
                    $.ajax({
                        type:"POST",
                        data: {tipo:'insertar',datosForm:datos},
                        url:"views/requestController/envace_productos/rc_envace_productos.php",
                        success:function(r){
                          let datos  = jQuery.parseJSON(r);
                       
                          let  respuesta = datos['resp'];
                          // console.log(respuesta);
                            if (respuesta == 1) {
                                successToast(3,'Muy bien','Se registro con exito.','','');
                                listarEnvace();
                                deshabilitarSmall();
                                listarSelectEnvace();
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

  function actualizarEnvace(){
    $('#btnActualizarEnvace').click(function(){
      // alert('actualizar');
        let datos=$('#formularioEnvace').serialize(); 
        let idEnvace = $('#idEnvace').val();
   
                // try {
                    $.ajax({
                        type:"POST",
                        data: {tipo:'actualizar',idEnvace:idEnvace,datosForm:datos},
                        url:"views/requestController/envace_productos/rc_envace_productos.php",
                        success:function(r){
                          let datos  = jQuery.parseJSON(r);
                          // console.log(datos);
                          let  respuesta = datos['resp'];
                          // console.log(respuesta);
                            if (respuesta == 1) {
                                successToast(3,'Muy bien','Se actualizó con exito.','','');
                                listarEnvace();
                                deshabilitarSmall();
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
  
function eliminarEnvace(){
  $('#btnEliminarEnvace').click(function(){
    habilitarSmall();
          idEnvace = $('#idEnvace').val();
          let datos=$('#formularioEnvace').serialize(); 
          $.ajax({  
            type:"POST",
            data: {tipo:'mostrarId',idEnvace:idEnvace},
            url:"views/requestController/envace_productos/rc_envace_productos.php",
            success:function(r){
              datos=jQuery.parseJSON(r);
                datos=jQuery.parseJSON(r);
                Swal.fire({
                  title: '¿Deseas eliminar?',
                  text:'['+ datos['arrayEnvaceProductos']['detalle_envace_producto']  +'] ',
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
                      data: {tipo:'eliminar',idEnvace:datos['arrayEnvaceProductos']['id_envace_producto']},
                      url:"views/requestController/envace_productos/rc_envace_productos.php",
                      success:function(r){
                          datos=jQuery.parseJSON(r);
                                  if(datos['resp']==1){
                                    Swal.fire(
                                      'Correcto',
                                      'Se elimino correctamente.',
                                      'success'
                                    );
                                    // deshabilitar_clientes();
                                    listarEnvace();
                                    deshabilitarSmall();
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