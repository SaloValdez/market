// Desarrollado  por © SaloCod
$(document).ready(function(){
      actualizarProductos();
    
      eliminarProductos()

      insertarProducto();
      listarCategoriaSelectProductos();


      
});



$('#content-img').click(function(){
  $("#labelFiles").click();
});

  $('#btnCancelar_Producto').click(function(){
  
      location.reload();
     
    });
$('#stockMinProducto').focus(function() {
  $("#stockMinProducto").keypress(function(e) {

  });8
});

function deshabilitar_clientes(){
          // formatear input file
        document.querySelector(".InputFileHiden").value ="";
        $("#content-img").html("<img style='height:170px; width:150px;' src='./views/requestController/clientes/foto_perfil/img-user.png'>" );
        $('.nombre-formato-img').text("jpj, png, jpeg");
        document.getElementById('hombre').checked = false;
        document.getElementById('mujer').checked = false;
        deshabilitar();
};




// // TODO::::::: Cropper Productos   
                  var bs_modal = $('#modal_cropper');
                  var imgCropper = document.getElementById('imgCropper');
                  var cropper,reader,file;

                  $("body").on("change", ".input-file-cropper", function(e) {
                  // $(".input-file-cropper").on("change",function(e){
                    var modalCropper = $("#modal_cropper");
                    abriVentanaSmallCropper(modalCropper);
                      var files = e.target.files; //nombre array detallis imagen
                      // imgCropper.src = url;
                      var done = function(url) {
                          imgCropper.src = url;
                          bs_modal.modal({backdrop: 'static', keyboard: false});
                      };

                      if (files && files.length > 0) {
                          file = files[0];
                          if (URL) {
                              done(URL.createObjectURL(file));
                          } else if (FileReader){
                              reader = new FileReader();
                              reader.onload = function(e) {
                                  done(reader.result);
                              };
                              reader.readAsDataURL(file);
                          }
                      }
                  });



                  bs_modal.on('shown.bs.modal', function() {
                      cropper = new Cropper(imgCropper, {
                          aspectRatio:1,
                          viewMode: 2,
                          preview: '.preview',
                      });

                  }).on('hidden.bs.modal', function() {
                      // eliminando canvas (eliminando imagen de coopper)
                      cropper.destroy();
                      cropper = null;
                  });


                      $("#mandarImagenCropper").click(function() {
                    
                          canvas = cropper.getCroppedCanvas({
                              // calidad imagen (tamaño)
                              width: 500,
                              height: 500,
                          });
                          canvas.toBlob(function(blob){

                          
                            // $("#imgPreview")[0].setAttribute("src", "");
                            $("#imgPreview").attr("src",'');
                              url = URL.createObjectURL(blob);
                              $("#imgPreview").attr("src",url);
                              var modalCropper = $("#modal_cropper");

                              var reader = new FileReader();
                              muc =  reader.readAsDataURL(blob);

                              reader.onloadend = function() {
                              base64data = reader.result;
                              // alert(base64data);
                              cerrarVentanaSmallCropper(modalCropper);
                              };
                          });
                      });


                  $("#cancelarImagenCropper").click(function() {
                      cerrarVentanaSmall();
                      document.querySelector(".input-file-cropper").value ="";
                  });








$('#btnListarProductos').click(function(){
    if ( $(".dataTables_wrapper") ) {
      $( ".dataTables_wrapper" ).remove();
      $('#contenedor_datatable_productos').load('./views/requestController/productos/rc_listar_tabla_productos.php');
    }
})

function listarCategoriaSelectProductos(){
  $.ajax({  
    type:"POST",
    // data:"listar=r",
    url:"./views/requestController/categoria_producto/rc_listar_categoria_producto.php",
    success:function(r){
        datos=jQuery.parseJSON(r);
        $('#fkIdCategoriaProducto option').remove();
        $("#fkIdCategoriaProducto").append("<option value='0'>Seleccione una opcion</option>");
        for(var i in datos)
        { 
          $("#fkIdCategoriaProducto").append("<option value='"+datos[i]['id_categoria_producto']+"'>"+datos[i]['detalle_categoria_producto']+"</option>");
        }
    }
  });
}

$("#fkIdCategoriaProducto").change(function() {
  // console.log($("#fkIdCategoriaProducto").val());
  let idCategoria = $("#fkIdCategoriaProducto").val();
  listarSubCategoria(idCategoria,0);
});


function listarSubCategoria(idCategoria,valorSeleccionado){
  $.ajax({  
    type:"POST",
    data:"dato="+idCategoria,
    url:"./views/requestController/subcategoria_producto/rc_listar_sub_id_categoria_producto.php",
    success:function(r){
      // $("#fkIdSubCategoriaProducto").append('');
      $("#fkIdSubCategoriaProducto").empty();
        let datos=jQuery.parseJSON(r);
        $("#fkIdSubCategoriaProducto").children("option:first").remove();

        if(datos.length>=1){
          $("#fkIdSubCategoriaProducto").append("<option value='0'>Seleccione una subcategoria...</option>")
          for(var i in datos)
          { 
           
            $("#fkIdSubCategoriaProducto").append("<option value='"+datos[i]['id_subcategoria_producto']+"'>"+datos[i]['detalle_subcategoria_producto']+"</option>");
          }
        }else{
            $("#fkIdSubCategoriaProducto").append("<option value='0'> ! No existe sub categoria !</option>");
        }

        $('#fkIdSubCategoriaProducto').val(valorSeleccionado);
    }
  });
}



  
// function listarUltimoCliente(){
//   $.ajax({  
//       type:"POST",
//       url:"./views/requestController/clientes/rc_listar_ultima_clientes.php",
//       success:function(r){
//           datos=jQuery.parseJSON(r);
//           // console.log(datos);
//           resp = datos['resp'];
//           if (resp == 0){
//             $('#fechaUltimoRegistroCliente').text('No existe registros');
//             $(".detalle-ultimo-registro").remove();
//           }else{
//             console.log(datos[0]['arrayRegistro']['nombre_cliente']);
//               $('#fechaUltimoRegistroCliente').text(datos['fecha']+ ' ('+ datos['hora'] +')');
//               $('#nombresUltimoRegistroCliente').text(datos[0]['arrayRegistro']['nombre_cliente']+ ' '+ datos[0]['arrayRegistro']['apellido_cliente']);
//               $('#nombresPorUltimoRegistroCliente').text(datos[1]['arrayEmpleado']['nombre_empleado']+ ' '+ datos[1]['arrayEmpleado']['apellido_empleado']);
//           }
//       }
//     });
// }

function btnAccionMostrarDatos(id){
      $.ajax({  
        type:"POST",
        data:"idProducto=" + id,
        url:"./views/requestController/productos/rc_listar_id_productos.php",
        success:function(r){
            datos=jQuery.parseJSON(r);
              console.log(datos);
            $('#idProducto').val(datos['arrayProductos']['id_producto']);
            $('#codigoProducto').val(datos['arrayProductos']['codigo_producto']);
            $('#descripcionProducto').val(datos['arrayProductos']['descripcion_producto']);
            $('#stockMinProducto').val(datos['arrayProductos']['stock_min_producto']);

            if(datos['arrayProductos']['estado_producto']==1){
              document.getElementById('habilitado').checked = true;
         
            }else if(datos['arrayProductos']['estado_producto']==0){
          
              document.getElementById('desabilitado').checked = true;
            }
            $("#content-img").html("<img style='height:170px; width:150px;' src='./views/requestController/productos/foto_productos/"+datos['arrayProductos']['foto_producto']+"' id='imgPreview'>" );

            $('#hidden_fotoCliente').val(datos['arrayProductos']['foto_producto']);

            $('#fkIdEnvaceProducto').val(datos['arrayProductos']['fk_id_envace_producto']);
            $('#fkIdMarcaProducto').val(datos['arrayProductos']['fk_id_marca']);
            $('#fkIdCategoriaProducto').val(datos['arrayProductos']['fk_id_categoria_producto']);
    
            listarSubCategoria(datos['arrayProductos']['fk_id_categoria_producto'],datos['arrayProductos']['fk_id_subcategoria_producto']);
            habilitar();
            $('.input-block').show();
            $('.label-block').show();
         
            cerrarVentana();
            habilitar();  
        }
      });
}

    
function insertarProducto(){
    $('#btnInsertarProducto').click(function(){
        // let  datos = new FormData($('#formularioProducto')[0]);
        datos=$('#formularioProducto').serialize(); 
        codigoProducto =   $("#codigoProducto").val();
        descripcionProducto =   $("#descripcionProducto").val();
            //  cajaDniCliente = $("#dniCliente").val();
        let  extension = $('#filesFotoCliente').val().split('.').pop().toLowerCase();
            if (codigoProducto.length < 1 ||descripcionProducto.length < 1 ) {   
                errorToast(3,"Error",'Los campos estan vacios.','');
                return false;
            }else {
              if(!$("input[name='estadoProducto']").is(':checked')){
                errorToast(3,"Error",'Seleccione un estado.','');
                return false;
              }
              if(extension != '')
              {
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                {
                  errorToast(3,"Error",'Extencion foto INVALIDA.',' Seleccione otra foto');
                  return false;
                }
              }
                try {
                  var imagen64 = base64data;
                }
                catch(e) {
                  var imagen64 = 0;
                }
                
                $.ajax({
                  type:"POST",
                  data: {imagen:imagen64,datosForm:datos},
                  // contentType: true,
                  // processData: true,
                  url:"./views/requestController/productos/rc_insertar_productos.php",
                  success:function(r){
                    // console.log(r);
                    let datos  = jQuery.parseJSON(r);
                    console.log(datos);
                    let  respuesta = datos['resp'];
                    let  mensaje = datos['msj'];

                    
                    // console.log(respuesta);
                    if (respuesta==1) {
                      successToast(3,'Muy bien','Se registro con exito.','','');
                      setTimeout(function() {
                        // alert('Reloading Page');
                        location.reload();
                      }, 3000);
                      // location.reload();
                      // listarUltimaSubCategoria();
                    }else if(respuesta==3){
                      errorToast(3,"Error",'Producto ya existe,',mensaje);
                    }else if(respuesta ==10){
                      errorToast(3,"Error",'Algo paso en el servidor.','','');
                    }else{
                      errorToast(3,"Error",'Comuniquese con el Administador.','');
                    }
                  }
                });
            }
    });
  }






  function actualizarProductos(){
    $('#btnActualizarProducto').click(function(){
      activarId();
        // let  datos = new FormData($('#formularioProducto')[0]);
        datos=$('#formularioProducto').serialize(); 
        codigoProducto =   $("#codigoProducto").val();
        descripcionProducto =   $("#descripcionProducto").val();
            //  cajaDniCliente = $("#dniCliente").val();
        let  extension = $('#filesFotoCliente').val().split('.').pop().toLowerCase();
            if (codigoProducto.length < 1 ||descripcionProducto.length < 1 ) {   
                errorToast(3,"Error",'Los campos estan vacios.','');
                return false;
            }else {
              if(!$("input[name='estadoProducto']").is(':checked')){
                errorToast(3,"Error",'Seleccione un estado.','');
                return false;
              }
              if(extension != '')
              {
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                {
                  errorToast(3,"Error",'Extencion foto INVALIDA.',' Seleccione otra foto');
                  return false;
                }
              }
                try {
                  var imagen64 = base64data;
                  $('#hidden_fotoCliente').val('');
                }
                catch(e) {
                  var imagen64 = 0;
                  // valor =  $('#hidden_fotoCliente').val();
                  // alert(valor);
                }
                
                $.ajax({
                  type:"POST",
                  data: {imagen:imagen64,datosForm:datos},
                  // contentType: true,
                  // processData: true,
                  url:"./views/requestController/productos/rc_actualizar_productos.php",
                  success:function(r){
                    // console.log(r);
                    let datos  = jQuery.parseJSON(r);
                    console.log(datos);
                    let  respuesta = datos['resp'];
                    let  mensaje = datos['msj'];

                    // console.log(respuesta);
                    if (respuesta==1) {
                      successToast(3,'Muy bien','Se actualizó con exito.','','');
                      setTimeout(function() {
                        // alert('Reloading Page');
                        location.reload();
                      }, 3000);
                      // location.reload();
                      // listarUltimaSubCategoria();
                    }else if(respuesta==3){
                      errorToast(3,"Error",'Producto ya existe,',mensaje);
                    }else if(respuesta ==10){
                      errorToast(3,"Error",'Algo paso en el servidor.','','');
                    }else{
                      errorToast(3,"Error",'Comuniquese con el Administador.','');
                    }
                  }
                });
            }
    });
  }



function eliminarProductos(){
  $('#btnEliminarProducto').click(function(){
          datos = $('#idProducto').val();
          $.ajax({  
            type:"POST",
            data:"idProducto=" + datos,
            url:"./views/requestController/productos/rc_listar_id_productos.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                console.log(datos);
                Swal.fire({
                  title: '¿Deseas eliminar?',
                  text:'['+datos['arrayProductos']['id_producto']+'] ' +datos['arrayProductos']['descripcion_producto']+']',
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
                      data:"idProducto=" + datos['arrayProductos']['id_producto'],
                      url:"./views/requestController/productos/rc_eliminar_productos.php",
                      success:function(r){
                          datos=jQuery.parseJSON(r);
                                  if(datos['resp']==1){
                                    Swal.fire(
                                      'Correcto',
                                      'Se elimino correctamente.',
                                      'success'
                                    );
                                    deshabilitar_clientes();
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