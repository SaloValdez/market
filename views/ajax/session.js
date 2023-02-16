$(document).ready(function(){

    iniciarSesion();
    
    
    });
    
    function iniciarSesion(){
      $('#btnIngresar').click(function(){
    // alert("Ingresar");
       event.preventDefault();
                    caja1 =   $("#correoUsuario").val();
                    caja2 =   $("#contrasenaUsuario").val();
  
                  if (caja1.length < 1 || caja2.length < 1) {   //validando cajas vacias
                      // mensajeInfo('Llene los campos vacios','');
                      errorToast("Ups..",'Uno o  los dos campos estan vacios.','');
                  }else {
                    datos=$('#formularioLogin').serialize(); //se recoje todo los "VALORES" del formulario
                      $.ajax({
                        type:"POST",
                        data:datos,
                        url:"./views/requestController/rc_session.php",
                        success:function(r){
                          datos  = jQuery.parseJSON(r);

                          console.log(datos);
                          var  respuesta = datos['resp'];
                          if (respuesta==1) {
                                
                            Swal.fire(
                              'Bienvenido',
                             datos['nombresUsuario'] ,
                              'success'
                            );
                                setTimeout("location.href='admin/'", 3000);
                          }else if(respuesta ==0){
                                // alert('No exixte el usuario')

                            errorToast("No existe usuario",'Intente con otros datos.','');
                          }else{
                            errorToast("Ups",'Error.',' Comuniquese con el adminstrador');
                          }
                        }
                      });
                  }
      });
    }