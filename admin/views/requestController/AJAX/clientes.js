// Desarrollado  por © SaloCod
$(document).ready(function(){
      actualizarClientes();
      insertarCliente();
      eliminarClientes();
      listarUltimoCliente();

});



$('#content-img').click(function(){
  $("#labelFiles").click();
});



// function btnCancelarClientes(){
  $('#btnCancelar_Cliente').click(function(){
      deshabilitar_clientes();
      // alert("Client");
     
    });
// }


function deshabilitar_clientes(){
          // formatear input file
        document.querySelector(".InputFileHiden").value ="";
        $("#content-img").html("<img style='height:170px; width:150px;' src='./views/requestController/clientes/foto_perfil/img-user.png'>" );
        $('.nombre-formato-img').text("jpj, png, jpeg");
        document.getElementById('hombre').checked = false;
        document.getElementById('mujer').checked = false;
        deshabilitar();
};

$('#btnBuscarRENIEC_clientes').click(function(){
  consultaDni__API__RENIEC_CLIENTE();
})

$('#dniCliente').focus(function() {
  $("#dniCliente").keypress(function(e) {
    // 13 = si se presiona ENTER
    if(e.which == 13) {
      consultaDni__API__RENIEC_CLIENTE();
    }
  });
});

// // -----------------------------------------------------------------------
// // TODO: INICIO  PARA CONSULTA API RENIEC
// // -----------------------------------------------------------------------
function consultaDni__API__RENIEC_CLIENTE(){
  let cajaDniCliente = $("#dniCliente").val();
  if (cajaDniCliente.length == 8 ) {
          $.ajax({
                          type:"POST",
                          data:'dniCliente='+cajaDniCliente,
                          url:"./views/requestController/empleados/api_dni_RENIEC.php",
                          success:function(r){
                          datos=jQuery.parseJSON(r);
                          // console.log(datos);
                            var res = datos['resp'];
                            if(res == 1){
                                successToast(2,'Muy bien','Se se encontro datos cliente.','','');
                                $('#nombreCliente').val(datos['arrayDatos']['nombres']);
                                $('#apellidoCliente').val(datos['arrayDatos']['apellidoPaterno'] +' '+datos['arrayDatos']['apellidoMaterno']);
                                $('#dniCliente').val(datos['arrayDatos']['numeroDocumento']);
                            }else if(res == 0){
                              errorToast(2,datos['detalleError'],'Ingrese DNI por favor.','');
                            }else if(res == 3){
                              errorToast(2,datos['detalleError'],'Ingrese Ingrese otro DNI por favor.','');
                            }
                          }
          });

  }else{
    errorToast(2,'Ingrese 8 numeros','Corrija el DNI por favor.','');
  }
}
// // -----------------------------------------------------------------------
// // FIN  CONSULTA API RENIEC
// // ---------------------------------------------------------------------


$('#btnListarCliente').click(function(){
    if ( $(".dataTables_wrapper") ) {
      $( ".dataTables_wrapper" ).remove();
      $('#contenedor_datatable_clientes').load('./views/requestController/clientes/rc_listar_tabla_clientes.php');
    }
  })
  
function listarUltimoCliente(){
  $.ajax({  
      type:"POST",
      url:"./views/requestController/clientes/rc_listar_ultima_clientes.php",
      success:function(r){
          datos=jQuery.parseJSON(r);
          // console.log(datos);
          resp = datos['resp'];
          if (resp == 0){
            $('#fechaUltimoRegistroCliente').text('No existe registros');
            $(".detalle-ultimo-registro").remove();
          }else{
            console.log(datos[0]['arrayRegistro']['nombre_cliente']);
              $('#fechaUltimoRegistroCliente').text(datos['fecha']+ ' ('+ datos['hora'] +')');
              $('#nombresUltimoRegistroCliente').text(datos[0]['arrayRegistro']['nombre_cliente']+ ' '+ datos[0]['arrayRegistro']['apellido_cliente']);
              $('#nombresPorUltimoRegistroCliente').text(datos[1]['arrayEmpleado']['nombre_empleado']+ ' '+ datos[1]['arrayEmpleado']['apellido_empleado']);
          }
      }
    });
}




function btnAccionMostrarDatos(id){
      $.ajax({  
        type:"POST",
        data:"idCliente=" + id,
        url:"./views/requestController/clientes/rc_listar_id_clientes.php",
        success:function(r){
            datos=jQuery.parseJSON(r);
              console.log(datos);

            $('#idCliente').val(datos['arrayCliente']['id_cliente']);
            $('#dniCliente').val(datos['arrayCliente']['dni_cliente']);
            $('#nombreCliente').val(datos['arrayCliente']['nombre_cliente']);
            $('#apellidoCliente').val(datos['arrayCliente']['apellido_cliente']);

            if(datos['arrayCliente']['genero_cliente']=='M'){
              document.getElementById('hombre').checked = true;
         
            }else if(datos['arrayCliente']['genero_cliente']=='F'){
          
              document.getElementById('mujer').checked = true;
            }


            $('#direccionCliente').val(datos['arrayCliente']['direccion_cliente']);
            $('#telefonoCliente').val(datos['arrayCliente']['telefono_cliente']);
            $('#correoCliente').val(datos['arrayCliente']['correo_cliente']);

            $("#content-img").html("<img style='height:170px; width:150px;' src='./views/requestController/clientes/foto_perfil/"+datos['arrayCliente']['foto_cliente']+"'>" );
            $('#hidden_fotoCliente').val(datos['arrayCliente']['foto_cliente']);
         
            $('.input-block').show();
            $('.label-block').show();
         
            cerrarVentana();
            habilitar();  
        }
      });
}
// 2:30
    
function insertarCliente(){
    $('#btnInsertarCliente').click(function(){
        let  datos = new FormData($('#formularioCliente')[0]);
             cajaNombres =   $("#nombreCliente").val();
             cajaApellidos =   $("#apellidoCliente").val();
             cajaDniCliente = $("#dniCliente").val();
        let  extension = $('#filesFotoCliente').val().split('.').pop().toLowerCase();
         
           
            
            if (cajaNombres.length < 1 ||cajaApellidos.length < 1 ) {   
                errorToast(3,"Error",'Los campos estan vacios.','');
                return false;
            }else {
              if(!$("input[name='generoCliente']").is(':checked')){
                errorToast(3,"Error",'Seleccione un genero.','');
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

              if(cajaDniCliente.length >= 1){
                  if(!(cajaDniCliente.length==8)){
                     errorToast(3,"Corrija el DNI ",'Ingrese (8) numeros.','');
                     return false;
                  } 
              }
            
                $.ajax({
                  type:"POST",
                  data:datos,
                  contentType: false,
                  processData: false,
                  url:"./views/requestController/clientes/rc_insertar_clientes.php",
                  success:function(r){
                    datos  = jQuery.parseJSON(r);
                    console.log(datos);

                    var  respuesta = datos['resp'];
                    if (respuesta==1) {
                      successToast(3,'Muy bien','Se registro con exito.','','');
                     
                    deshabilitar_clientes();
                 
                      listarUltimaSubCategoria();
                    }else if(respuesta==3){
                      errorToast(3,"Error",'Cliente con DNI : ('+cajaDniCliente+')  ','  Ya existe.');
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

  function actualizarClientes(){
    $('#btnActualizarCliente').click(function(){
      activarId();
           datos = new FormData($('#formularioCliente')[0]);
           cajaNombres =   $("#nombreCliente").val();
           cajaApellidos =   $("#apellidoCliente").val();
           cajaDniCliente = $("#dniCliente").val();
      var  extension = $('#filesFotoCliente').val().split('.').pop().toLowerCase();


      if (cajaNombres.length < 1 ||cajaApellidos.length < 1 ) {   
        errorToast(3,"Error",'Los campos estan vacios.','');
        return false;
       }

      if(!$("input[name='generoCliente']").is(':checked')){
        errorToast(3,"Error",'Seleccione un genero.','');
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

      if(cajaDniCliente.length >= 1){
          if(!(cajaDniCliente.length==8)){
             errorToast(3,"Corrija el DNI ",'Ingrese (8) numeros.','');
             return false;
          } 
      }

          $.ajax({
              type:"POST",
              data:datos,
              contentType: false,
              processData: false,
              url:"./views/requestController/clientes/rc_actualizar_clientes.php",
              success:function(r){
              datos=jQuery.parseJSON(r);
                var res = datos['resp'];
                console.log(res);

                if(res==1){
                   successToast(3,'Muy bien','Se actuializo Correctamente.','','');
          
                   deshabilitar_clientes();
                }else if(res==3) {
                  errorToast(3,'Ups..','El DNI','Ya existe.');
                }else{
                  errorToast(3,'Ups..','Comuniquese con el administrador.','','');
                }
              }
          });
    });
  }


function eliminarClientes(){
  $('#btnEliminarCliente').click(function(){
          datos = $('#idCliente').val();
          $.ajax({  
            type:"POST",
            data:"idCliente=" + datos,
            url:"./views/requestController/clientes/rc_listar_id_clientes.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                Swal.fire({
                  title: '¿Deseas eliminar?',
                  text:'['+datos['arrayCliente']['id_cliente']+'] ' +datos['arrayCliente']['nombre_cliente'] +' '+ datos['arrayCliente']['apellido_cliente'],
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
                      data:"idCliente=" + datos['arrayCliente']['id_cliente'],
                      url:"./views/requestController/clientes/rc_eliminar_clientes.php",
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