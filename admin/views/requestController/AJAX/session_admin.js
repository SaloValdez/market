$(document).ready(function(){

    // mostrarDetalleEmpleadoSession();


mostrarDetalleEmpleadoSession();


});


function mostrarDetalleEmpleadoSession(){
    $.ajax({  
        type:"POST",
        url:"./views/requestController/session_admin/rc_mostrar_empleado_session.php",
        success:function(r){
            datos=jQuery.parseJSON(r);
            resp = datos["resp"];

            if (resp == 0){
            //   $('#fechaUltimoRegistroProducto').text('No existe registros');
            //   $(".detalle-ultimo-registro").remove();
            }else{
              
                $('#nombresPersonalSession1').text(datos['arrayEmpleado']['nombre_empleado']+' '+ datos['arrayEmpleado']['apellido_empleado']);
                $('#nombresPersonalSession2').text(datos['arrayEmpleado']['nombre_empleado']+' '+ datos['arrayEmpleado']['apellido_empleado']);
            }
          
         
        }
      });
  }