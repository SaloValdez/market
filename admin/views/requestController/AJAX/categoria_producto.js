
$(document).ready(function(){
    
      actualizarCategoriaProducto();
      insertarCategoriaProducto();
      listarUltimaCategoria();
      eliminarCategoria();

});





$('#btnListarCategoriaProducto').click(function(){
  if ( $(".dataTables_wrapper") ) {
    $( ".dataTables_wrapper" ).remove();
    $('#contenedor_datatable_categria_producto').load('./views/requestController/categoria_producto/rc_listar_tabla_categoria_producto.php');
  }
})





function listarUltimaCategoria(){
  $.ajax({  
      type:"POST",
      url:"./views/requestController/categoria_producto/rc_listar_ultima_categoria_producto.php",
      success:function(r){
          datos=jQuery.parseJSON(r);

          // console.log(datos);
          resp = datos['resp'];
          if (resp == 0){
            $('#fechaUltimoRegistroProducto').text('No existe registros');
            $(".detalle-ultimo-registro").remove();
          }else{
              $('#fechaUltimoRegistroProducto').text(datos['fecha']+ ' ('+ datos['hora'] +')');
              $('#nombreUltimoRegistroProducto').text(datos[0]['detalle_categoria_producto']);
              $('#usuarioUltimoRegistroProducto').text(datos[1]['arrayEmpleado']['nombre_empleado']+ ' '+ datos[1]['arrayEmpleado']['apellido_empleado']);
          }
        
       
      }
    });
}

function btnIdDatos_Categoria(idCategoria){

    $.ajax({  
          type:"POST",
          data:"id_categoria=" + idCategoria,
          url:"./views/requestController/categoria_producto/rc_listar_id_categoria_producto.php",
          success:function(r){
              datos=jQuery.parseJSON(r);
  
  
              $('.input-block').show();
              $('.label-block').show();
  
              $('#idCategoriaProducto').val(datos['id_categoria_producto']);
              $('#detalleCategoriaProducto').val(datos['detalle_categoria_producto']);
              $('#fechaRegistroCategoriaProducto').val(datos['fecha_registro_categoria_producto']);
              $('#idUsuario').val(datos['fk_id_usuario']);
              cerrarVentana();
              habilitar();
          }
        });
}

    
function insertarCategoriaProducto(){
    $('#btnInsertarCategoriaProducto').click(function(){

              caja1 =   $("#detalleCategoriaProducto").val();

            if (caja1.length < 1) {   
                errorToast("Error",'Los campos estan vacios.','');
            }else {
             
              datos=$('#frmCategoriaProducto').serialize(); 
                $.ajax({
                  type:"POST",
                  data:datos,
                  url:"./views/requestController/categoria_producto/rc_insertar_categoria_producto.php",
                  success:function(r){
                
                    datos  = jQuery.parseJSON(r);
                    var  respuesta = datos['resp'];
                    if (respuesta==1) {
                      successToast('Muy bien','Se registro con exito.','','');
                      deshabilitar();
                    }else if(respuesta ==3){
                      errorToast("Error",'Nombre categoria ya existe.','','');
                    }else{
                      errorToast("Error",'Comuniquese con el administrador','');
                    }
                  
                  }
                });
            }
    });
  }

  function actualizarCategoriaProducto(){
    $('#btnActualizarCategoriaProducto').click(function(){
      activarId();
      datos=$('#frmCategoriaProducto').serialize();
      caja1 =   $("#idCategoriaProducto").val();
      caja2 =   $("#detalleCategoriaProducto").val();
      // alert('actialuzar product');

      if(caja1.length<1 || caja2.length<1){
           errorToast("Error",'Los campos estan vacios.','');
            // return false;
      }else{
      
          $.ajax({
              type:"POST",
              data:datos,
              url:"./views/requestController/categoria_producto/rc_actualizar_categoria_producto.php",
              success:function(r){
              datos=jQuery.parseJSON(r);
                var res = datos['resp'];
                console.log(res);

                if(res==1){
                   successToast('Muy bien','Se actializo Correctamente.','','');
                   deshabilitar();
                }else if(res==3) {
                  errorToast('Ups..','La categoria ya',' existe.');
                }else{
                  errorToast('Ups..','Comuniquese con el administrador.','','');
                }
              }
          });
      }
    });
  }


function eliminarCategoria(){
  $('#btnEliminarCategoriaProducto').click(function(){
    activarId();
          datos = $('#idCategoriaProducto').val();
          $.ajax({  
            type:"POST",
            data:"id_categoria=" + datos,
            url:"./views/requestController/categoria_producto/rc_listar_id_categoria_producto.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                Swal.fire({
                  title: 'Deseas eliminar a?',
                  text:datos['detalle_categoria_producto'] ,
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: 'var(--colorpalet1)',
                  confirmButtonText: 'Si, Eliminar',
                  allowOutsideClick: false,
                  
                }).then((result) => {
                  if (result.isConfirmed) {
                          $.ajax({  
                      type:"POST",
                      data:"id_categoria=" + datos['id_categoria_producto'],
                      url:"./views/requestController/categoria_producto/rc_eliminar_categoria_producto.php",
                      success:function(r){
                          datos=jQuery.parseJSON(r);
                              
                                 
                                  if(datos['resp']==1){
                                    Swal.fire(
                                      'Correcto',
                                     
                                      'Se elimino correctamente.',
                                      'success'
                                    );
                                    deshabilitar();
                                  }else{
                                    Swal.fire(
                                      'Upps...',
                                      'No se elimo registro',
                                      'error'
                                    )
                                    deshabilitar();
                                  }
                            }
                          });
                  }
                })
            }
          });

       
    });
  }