// Desarrollado  por © SaloCode
$(document).ready(function(){
      actualizarEmpleados();
      insertarEmpleado();
      eliminarEmpleados();
      listarUltimoEmpleado();
      vistaPreviaNombreImagenInputFile();
      vistaPreviaImagenInputFile();

      $('.contador-input').hide();
      contadorDigitos();
});


// function btnCancelarEmpleados(){
  $('#btnCancelar_Empleados').click(function(){
      deshabilitar_empleados();
      deshabilitar();
    });
// }


function deshabilitar_empleados(){
          // formatear input file
        document.querySelector(".InputFileHiden").value ="";
        $("#content-img").html("<img style='height:170px; width:150px;' src='./views/requestController/empleados/foto_perfil/img-user.png'>" );
        $('.nombre-formato-img').text("jpj, png, jpeg");
        document.getElementById('hombre').checked = false;
        document.getElementById('mujer').checked = false;
        deshabilitar();
      
};

$('#btnBuscarRENIEC').click(function(){
  consultaDni__API__RENIEC();
})

$('#dniEmpleado').focus(function() {
  $("#dniEmpleado").keypress(function(e) {
    // 13 = si se presiona ENTER
    if(e.which == 13) {
      consultaDni__API__RENIEC();
    }
  });
});

// -----------------------------------------------------------------------
// TODO: INICIO  PARA CONSULTA API RENIEC
// -----------------------------------------------------------------------
function consultaDni__API__RENIEC(){
  var cajaDni = $("#dniEmpleado").val();
  if (cajaDni.length == 8 ) {
          $.ajax({
                          type:"POST",
                          data:'dniEmpleado='+cajaDni,
                          url:"./views/requestController/empleados/api_dni_RENIEC.php",
                          success:function(r){
                          datos=jQuery.parseJSON(r);
                            var res = datos['resp'];

                            if(res == 1){
                                successToast(2,'Muy bien','Se se encontro datos cliente.','','');
                                // console.log(datos);
                                $('#nombreEmpleado').val(datos['arrayDatos']['nombres']);
                                $('#apellidoEmpleado').val(datos['arrayDatos']['apellidoPaterno'] +' '+datos['arrayDatos']['apellidoMaterno']);
                                $('#dniEmpleado').val(datos['arrayDatos']['numeroDocumento']);
                            }else if(res == 0){
                              errorToast(3,datos['detalleError'],'Ingrese DNI por favor.','');
                            }else if(res == 3){
                              errorToast(3,datos['detalleError'],'Ingrese Ingrese otro DNI por favor.','');
                            }
                          }
          });

  }else{
    errorToast(2,'Ingrese 8 numeros','Corrija el DNI por favor.','');
  }
}
// -----------------------------------------------------------------------
// FIN  CONSULTA API RENIEC
// ---------------------------------------------------------------------

// -----------------------------------------------------------------------
// TODO: INICIO contador de  dijitos de dni
// -----------------------------------------------------------------------
function contadorDigitos(){
      $('.buscarPorDni').keyup(function (){
        num = $(this).val().length;
        $('.contador-input').show().text(num);
      });
}
// -----------------------------------------------------------------------
// FIN  contador digitos txt DNI
// ----------------------------------------------------------------------

// -----------------------------------------------------------------------
// TODO: INICIO input file
// -----------------------------------------------------------------------
        //  Ver nombre imagen File
        function vistaPreviaNombreImagenInputFile(){
          $(".InputFileHiden").on("change",function(){
              let cadenaNombre =  $(this)[0].files[0].name;
                let nombre = cadenaNombre.substring(1,5);
                    extencion = cadenaNombre.split('.')[1];
                    $(".nombre-formato-img").text(nombre +'...(.'+ extencion+')');
                // $(".nombre-formato-img").text($(this)[0].files[0].name);

          });
        }
        // Vista Previa Imagen imagen File
        function vistaPreviaImagenInputFile(){
              $('.InputFileHiden').change(function(){
                // vistaPreviaImagen(this);
                if (this.files  && this.files[0]) {
                    var  reader  = new FileReader(); //clase que permite leer archivos
                    reader.onload = function(e){  // e -> evento que permite acceder a la ruta de la imagen
                        $('.content-img').html("<img src='"+e.target.result+"' class='img-thumbnail' style='height:170px; width:150px;'/>");
                    }
                    reader.readAsDataURL(this.files[0]);
                }
              });
        } 
// -----------------------------------------------------------------------
// FIN  input file
// -----------------------------------------------------------------------


$('#btnListarEmpleado').click(function(){
    if ( $(".dataTables_wrapper") ) {
      $( ".dataTables_wrapper" ).remove();
      $('#contenedor_datatable_empleados').load('./views/requestController/empleados/rc_listar_tabla_empleados.php');
    }
  })
  
function listarUltimoEmpleado(){
  $.ajax({  
      type:"POST",
      url:"./views/requestController/empleados/rc_listar_ultima_empleados.php",
      success:function(r){
          datos=jQuery.parseJSON(r);
          resp = datos['resp'];
          if (resp == 0){
            $('#fechaUltimoRegistroSubcategoria').text('No existe registros');
            $(".detalle-ultimo-registro").remove();
          }else{
            // console.log(datos[1]['arrayEmpleado']['nombre_empleado']);
              $('#fechaUltimoRegistroEmpleado').text(datos['fecha']+ ' ('+ datos['hora'] +')');
              $('#nombresUltimoRegistro').text(datos[0]['arrayRegistro']['nombre_empleado']+ ' '+ datos[0]['arrayRegistro']['apellido_empleado']);
              $('#nombresPorUltimoRegistro').text(datos[1]['arrayEmpleado']['nombre_empleado']+ ' '+ datos[1]['arrayEmpleado']['apellido_empleado']);
          }
      }
    });
}



function btnAccionMostrarDatos(id){
      $.ajax({  
        type:"POST",
        data:"idEmpleado=" + id,
        url:"./views/requestController/empleados/rc_listar_id_empleados.php",
        success:function(r){
            datos=jQuery.parseJSON(r);

            $('#idEmpleado').val(datos['arrayEmpleado']['id_empleado']);
            $('#dniEmpleado').val(datos['arrayEmpleado']['dni_empleado']);
            $('#nombreEmpleado').val(datos['arrayEmpleado']['nombre_empleado']);
            $('#apellidoEmpleado').val(datos['arrayEmpleado']['apellido_empleado']);

            if(datos['arrayEmpleado']['genero_empleado']== 'M'){
              document.getElementById('hombre').checked = true;
         
            }else if(datos['arrayEmpleado']['generoEmpleado'] =='F'){
          
              document.getElementById('mujer').checked = true;
            }


            $('#direccionEmpleado').val(datos['arrayEmpleado']['direccion_empleado']);
            $('#telefonoEmpleado').val(datos['arrayEmpleado']['telefono_empleado']);
            $('#correoEmpleado').val(datos['arrayEmpleado']['correo_empleado']);

            $("#content-img").html("<img style='height:170px; width:150px;' src='./views/requestController/empleados/foto_perfil/"+datos['arrayEmpleado']['foto_empleado']+"'>" );

            $('.input-block').show();
            $('.label-block').show();
         
            cerrarVentana();
            habilitar();  
        }
      });
}
    
function insertarEmpleado(){
    $('#btnInsertarEmpleado').click(function(){
        var  datos = new FormData($('#formularioEmpleado')[0]);
             cajaNombres =   $("#nombreEmpleado").val();
             cajaApellidos =   $("#apellidoEmpleado").val();
             cajaDniEmpleado = $("#dniEmpleado").val();
        var  extension = $('#filesFotoEmpleado').val().split('.').pop().toLowerCase();
         
           
            
            if (cajaNombres.length < 1 ||cajaApellidos.length < 1 ) {   
                errorToast(3,"Error",'Los campos estan vacios.','');
                return false;
            }else {
              if(!$("input[name='generoEmpleado']").is(':checked')){
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

              if(cajaDniEmpleado.length >= 1){
                  if(!(cajaDniEmpleado.length==8)){
                     errorToast(3,"Corrija el DNI ",'Ingrese (8) numeros.','');
                     return false;
                  } 
              }
            
                $.ajax({
                  type:"POST",
                  data:datos,
                  contentType: false,
                  processData: false,
                  url:"./views/requestController/empleados/rc_insertar_empleados.php",
                  success:function(r){
                    datos  = jQuery.parseJSON(r);
                    console.log(datos);

                    var  respuesta = datos['resp'];
                    if (respuesta==1) {
                      successToast(3,'Muy bien','Se registro con exito.','','');
                     
                    deshabilitar_empleados();
                 
                      listarUltimaSubCategoria();
                    }else if(respuesta==3){
                      errorToast(3,"Error",'Empleado con DNI : ('+cajaDniEmpleado+')  ','  Ya existe.');
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

  function actualizarEmpleados(){
    $('#btnActualizarEmpleado').click(function(){
      activarId();
           datos = new FormData($('#formularioEmpleado')[0]);
           cajaNombres =   $("#nombreEmpleado").val();
           cajaApellidos =   $("#apellidoEmpleado").val();
           cajaDniEmpleado = $("#dniEmpleado").val();
      var  extension = $('#filesFotoEmpleado').val().split('.').pop().toLowerCase();


      if (cajaNombres.length < 1 ||cajaApellidos.length < 1 ) {   
        errorToast(3,"Error",'Los campos estan vacios.','');
        return false;
       }

      if(!$("input[name='generoEmpleado']").is(':checked')){
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

      if(cajaDniEmpleado.length >= 1){
          if(!(cajaDniEmpleado.length==8)){
             errorToast(3,"Corrija el DNI ",'Ingrese (8) numeros.','');
             return false;
          } 
      }

          $.ajax({
              type:"POST",
              data:datos,
              contentType: false,
              processData: false,
              url:"./views/requestController/empleados/rc_actualizar_empleados.php",
              success:function(r){
              datos=jQuery.parseJSON(r);
                var res = datos['resp'];
                console.log(res);

                if(res==1){
                   successToast(3,'Muy bien','Se actuializo Correctamente.','','');
          
                   deshabilitar_empleados();
                }else if(res==3) {
                  errorToast(3,'Ups..','El DNI','Ya existe.');
                }else{
                  errorToast(3,'Ups..','Comuniquese con el administrador.','','');
                }
              }
          });
    });
  }


function eliminarEmpleados(){
  $('#btnEliminarEmpleado').click(function(){
          datos = $('#idEmpleado').val();
          $.ajax({  
            type:"POST",
            data:"idEmpleado=" + datos,
            url:"./views/requestController/empleados/rc_listar_id_empleados.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                Swal.fire({
                  title: '¿Deseas eliminar?',
                  text:'['+datos['arrayEmpleado']['id_empleado']+'] ' +datos['arrayEmpleado']['nombre_empleado'] +' '+ datos['arrayEmpleado']['apellido_empleado'],
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
                      data:"idEmpleado=" + datos['arrayEmpleado']['id_empleado'],
                      url:"./views/requestController/empleados/rc_eliminar_empleados.php",
                      success:function(r){
                          datos=jQuery.parseJSON(r);
                                  if(datos['resp']==1){
                                    Swal.fire(
                                      'Correcto',
                                      'Se elimino correctamente.',
                                      'success'
                                    );
                                    deshabilitar_empleados();
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