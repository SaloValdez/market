
$(document).ready(function(){
  actualizarSubCategoriaProducto();
    insertarSubCategoriaProducto();
    listarUltimaSubCategoria();
    listarCategoriaSelect();
    eliminarSubCategoria();
});



$('#btnListarSubCategoriaProducto').click(function(){
  if ( $(".dataTables_wrapper") ) {
    $( ".dataTables_wrapper" ).remove();
    $('#contenedor_datatable_subcategria_producto').load('./views/requestController/subcategoria_producto/rc_listar_tabla_subcategoria_producto.php');
  }
})


function listarCategoriaSelect(){
  $.ajax({  
    type:"POST",
    // data:"listar=r",
    url:"./views/requestController/categoria_producto/rc_listar_categoria_producto.php",
    success:function(r){
        datos=jQuery.parseJSON(r);
        $('#categoriaProductoSelect option').remove();
        $("#categoriaProductoSelect").append("<option value='0'>Seleccione una opcion</option>");

        for(var i in datos)
        { 
          $("#categoriaProductoSelect").append("<option value='"+datos[i]['id_categoria_producto']+"'>"+datos[i]['detalle_categoria_producto']+"</option>");
          
        }
    
     
    }
    
  });
}


function listarUltimaSubCategoria(){
  $.ajax({  
      type:"POST",
      url:"./views/requestController/subcategoria_producto/rc_listar_ultima_subcategoria_producto.php",
      success:function(r){
          datos=jQuery.parseJSON(r);
          resp = datos['resp'];
          if (resp == 0){
            $('#fechaUltimoRegistroSubcategoria').text('No existe registros');
            $(".detalle-ultimo-registro").remove();
          }else{
           
              $('#fechaUltimoRegistroSubcategoria').text(datos['fecha']+ ' ('+ datos['hora'] +')');
              $('#nombreUltimoRegistroSubcategoria').text(datos[0]['detalle_subcategoria_producto']);
              $('#usuarioUltimoRegistroSubcategoria').text(datos[1]['arrayEmpleado']['nombre_empleado']+ ' '+ datos[1]['arrayEmpleado']['apellido_empleado']);
          }
        
       
      }
    });
}

function btnIdDatos_SubCategoria(idSubCategoria){
      $.ajax({  
        type:"POST",
        data:"id_subcategoria=" + idSubCategoria,
        url:"./views/requestController/subcategoria_producto/rc_listar_id_subcategoria_producto.php",
        success:function(r){
            datos=jQuery.parseJSON(r);

            // console.log(datos);
            $('.input-block').show();
            $('.label-block').show();

            $('#idSubCategoriaProducto').val(datos['id_subcategoria_producto']);
            $('#detalleSubCategoriaProducto').val(datos['detalle_subcategoria_producto']);
           
            $('#categoriaProductoSelect').val(datos['fk_id_categoria_producto']);
        
         
            cerrarVentana();
            habilitar();  
        }
      });
}
    
function insertarSubCategoriaProducto(){
    $('#btnInsertarSubCategoriaProducto').click(function(){

              caja1 =   $("#detalleSubCategoriaProducto").val();
              seleccion= $('#categoriaProductoSelect').children("option:selected").val();

            if (caja1.length < 1) {   
                errorToast("Error",'Los campos estan vacios.','');
            }else {
              if(seleccion == 0){
                errorToast("Error",'Por favor seleccione una categoria.','');
                return
              }
             
              datos=$('#frmSubCategoriaProducto').serialize(); 
                $.ajax({
                  type:"POST",
                  data:datos,
                  url:"./views/requestController/subcategoria_producto/rc_insertar_subcategoria_producto.php",
                  success:function(r){
                
                    datos  = jQuery.parseJSON(r);
                    console.log(datos);
                    var  respuesta = datos['resp'];
                    if (respuesta==1) {
                      successToast('Muy bien','Se registro con exito.','','');
                      deshabilitar();
                      listarUltimaSubCategoria();
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

  function actualizarSubCategoriaProducto(){
    $('#btnActualizarSubCategoriaProducto').click(function(){
      activarId();
      datos=$('#frmSubCategoriaProducto').serialize();
      caja1 =   $("#idSubCategoriaProducto").val();
      caja2 =   $("#detalleSubCategoriaProducto").val();
      seleccion= $('#categoriaProductoSelect').children("option:selected").val();
      // alert('actialuzar product');
      if(seleccion == 0){
        errorToast("Error",'Por favor seleccione una categoria.','');
        return
      }
    
      if(caja1.length<1 || caja2.length<1){
           errorToast("Error",'Los campos estan vacios.','');
            // return false;
      }else{
      
          $.ajax({
              type:"POST",
              data:datos,
              url:"./views/requestController/subcategoria_producto/rc_actualizar_subcategoria_producto.php",
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


function eliminarSubCategoria(){
  $('#btnEliminarSubCategoriaProducto').click(function(){
          datos = $('#idSubCategoriaProducto').val();
          $.ajax({  
            type:"POST",
            data:"id_subcategoria=" + datos,
            url:"./views/requestController/subcategoria_producto/rc_listar_id_subcategoria_producto.php",
            success:function(r){
                datos=jQuery.parseJSON(r);

                console.log(datos);
                Swal.fire({
                  title: 'Deseas eliminar?',
                  text:datos['detalle_subcategoria_producto'] + datos['id_subcategoria_producto'],
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
                      data:"id_subcategoria=" + datos['id_subcategoria_producto'],
                      url:"./views/requestController/subcategoria_producto/rc_eliminar_subcategoria_producto.php",
                      success:function(r){
                          datos=jQuery.parseJSON(r);
                              
                                console.log(datos);
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