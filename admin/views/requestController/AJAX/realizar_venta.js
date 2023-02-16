// Desarrollado  por © SaloCod
$(document).ready(function(){
    // TODO: INICIO______DOM
    AgregarProductoDetalleComprobante();
    verificarComprobanteEmpleado();
    // lisarSelectTipoDescuento();

  

    $("#detalleProducto").on("keyup change", function(e) {
    // FILTRAR PRODUCTO 
      let valor = $(this).val();
      if (valor == ' ') {
        console.log("vacio");
        return false
      }else{
            // console.log(valor);
              $.ajax({
                type:"POST",
                data: {tipo:'filtrarProducto',valorFiltroProducto:valor},
                url:"views/requestController/realizar_venta/rc_realizar_venta.php",
                success:function(r){
                  datos=jQuery.parseJSON(r);
                  if(datos['resp']==1){
                    $("#lista-detalle-producto").html('');
                        for(var i=0;i<datos['arrayFiltroProductos'].length;i++){
          
                          let cantidadInvDosDecimal=redondearDecimales(datos['arrayFiltroProductos'][i]['cantidad_inventario'], 2);
                          let precioUnitarioDosDecimal=redondearDecimales(datos['arrayFiltroProductos'][i]['precio_venta_inventario'],2);
                          let fotoProducto = datos['arrayFiltroProductos'][i]['foto_producto'];
                          let descripcionProducto = datos['arrayFiltroProductos'][i]['descripcion_producto'];
                          let cantidadContenidoProducto = datos['arrayFiltroProductos'][i]['cantidad_contenido_producto'];
                          let idProducto = datos['arrayFiltroProductos'][i]['id_producto'];
                        
                        // $("#lista-detalle-producto").append(datos['arrayFiltroProductos'][i]);
                        $("#lista-detalle-producto").append("\n\
                         <li onclick='verIdProducto("+idProducto+");'>\n\
                            <img class='fit-picture'src='./views/requestController/productos/foto_productos/"+fotoProducto+"'alt=''>\n\
                            <div class='detalle-producto'>\n\
                            "+descripcionProducto+" "+cantidadContenidoProducto+"\n\
                              <span class='precioUnitario' id='precioUnitario'>[ "+precioUnitarioDosDecimal+" ]</span>\n\
                              <span class='stock'>("+cantidadInvDosDecimal+")</span>\n\
                            </div>\n\
                        </li>");
                        }
                  }else if(datos['resp']==0){
                      console.log('no exixte datos');
                      $("#lista-detalle-producto").html('<li>No existe producto...</li>');
                  }
        
                }
              });
      }
    })

  


  $('body').on('click', '#miDataTableDetalleComprobante input', function(){
    let idCajaCantidad = $(this).attr('id');
    let idTempDetalleComprobante = idCajaCantidad.split('-')[2];
    // console.log(idTempDetalleComprobante);

    if (screen.width < 950) {
      $("#html-"+idTempDetalleComprobante).html('<input type="text"  value="744444">');
      $("#html-sub-"+idTempDetalleComprobante).html('<div></div>');
  }
  
    $("#"+idCajaCantidad).on("keyup change", function(e) {
        let cantidadProducto = $(this).val();
        let precioUnitario = $("#data-precio-"+idTempDetalleComprobante).attr('data-value');
        let subTotalProducto = precioUnitario * cantidadProducto;
        let subTotalProductoDosDecimal = subTotalProducto.toFixed(2); 
        let idProducto = $("#data-idProducto-"+idTempDetalleComprobante).val();
        // console.log(subTotalProductoDosDecimal);
        $("#html-subtotal-"+idTempDetalleComprobante).html(subTotalProductoDosDecimal);


        var misDatosCantidad = {
          'idTempDetalleComprobante':idTempDetalleComprobante,
          'fkIdProducto':idProducto,
          'cantidadPedido':cantidadProducto,
          'tipoAccion':'sumar_agregar_aleatorio'
         };

        // console.log(misDatosCantidad);

        $.ajax({
          type:"POST",
          data: {tipo:'sumaRestaCantidadDetalleUno_a_Uno',datosSumarRestarUnoCantidad:misDatosCantidad},
          url:"views/requestController/realizar_venta/rc_realizar_venta.php",
          success:function(r){
            datos=jQuery.parseJSON(r);
            console.log(datos);
            // listar_detalle_comprobante(idComprobante);
          }
        });     
    })
  })


  // TODO: FIN DOM
});

$(document).on('change', '#fkIdDescuento', function(event) {
  let id = $(this).children(":selected").attr("id");
  let idComprobante = $('#idComprobante').val();

      $.ajax({
        type:"POST",
        data: {tipo:'listarIdDescuento',idDescuento:id,idTemComprobante:idComprobante},
        url:"views/requestController/realizar_venta/rc_realizar_venta.php",
        success:function(r){
          datos=jQuery.parseJSON(r);
          let modoDescuento = datos['arrayDescuento']['modo_descuento'];
          let montoDescuento = datos['arrayDescuento']['monto_tipo_descuento'];

          let subtotal = datos['arrayTempComprobante']['subtotal_temp_comprobante'];
          let igv = datos['arrayTempComprobante']['igv_temp_comprobante'];
          let importeTotal = datos['arrayTempComprobante']['importetotal_temp_comprobante'];
          let idDescuento = datos['arrayTempComprobante']['fk_id_tipo_descuento'];
          let idTemComprobante =datos['arrayTempComprobante']['monto_tipo_descuento'];

          if(modoDescuento == 'porcentaje'){            
            let descuento = subtotal * montoDescuento;

              if($("#si").is(':checked')) {  
                  alert("Está activado");  
              }else if($("#no").is(':checked')) {  

              }  
              
          
          }else if(modoDescuento == 'valor_unico'){
            let descuento = subtotal - montoDescuento;

          }

        
 console.log(datos);
 
// $dato = array(
          
//     'montoDescuentoTempComprobante'=>11.11,
//     'igvTempComprobante'=>11.11,
//     'importeTotalTempComprobante'=>11.11,
//     'fkIdTipoDescuento'=>1,
//     'idTempComprobante'=>132
// );


            // $.ajax({
            //   type:"POST",
            //   data: {tipo:'listarIdDescuento',idDescuento:id},
            //   url:"views/requestController/realizar_venta/rc_realizar_venta.php",
            //   success:function(r){
            //     datos=jQuery.parseJSON(r);
            //     let modoDescuento = datos['modo_descuento'];
            //     let montoDescuento = datos['monto_tipo_descuento'];
            //     // console.log(modoDescuento + ' - '+montoDescuento );
      
            //   }
            // });  




        }
      });   
});

// $('#contenedor_tabla_comprobante').on("click","#fkIdDescuento",function(){
//     $.ajax({
//         type:"POST",
//         data: {tipo:'listarSelectTipoDescuento'},
//         url:"views/requestController/realizar_venta/rc_realizar_venta.php",
//         success:function(r){
//           console.log(r);
//           $("#fkIdDescuento").empty();
//           $("#fkIdDescuento").html(r);
//         }
//       });
// })
// Eliminado producto del detalle comprobante
function eliminarProductoDetalle(idDetalleComprobante,idComprobante){
 let var2  = idComprobante;
    $.ajax({
      type:"POST",
      data: {tipo:'eliminarProductoDetalle', idDetalle:idDetalleComprobante},
      url:"views/requestController/realizar_venta/rc_realizar_venta.php",
      success:function(r){
      
        datos=jQuery.parseJSON(r);
        console.log(datos);
        listar_detalle_comprobante(idComprobante);
      }
    });
}

function verIdProducto(variable){
  // console.log(variable);
  $.ajax({
    type:"POST",
    data: {tipo:'listarIdProductoInventario', idProducto:variable},
    url:"views/requestController/realizar_venta/rc_realizar_venta.php",
    success:function(r){
      // console.log(r);
      // $("#detalleProducto").val();
      datos=jQuery.parseJSON(r);
      if(datos['resp']==1){ 
        // console.log(datos['arrayIdProductoInventario']); 
        $("#detalleProducto").val(datos['arrayIdProductoInventario']['descripcion_producto']);
        $("#idProducto").val(datos['arrayIdProductoInventario']['id_producto']);
        $("#codigoProducto").val(datos['arrayIdProductoInventario']['codigo_producto']);
        $("#precioProducto").val(redondearDecimales(datos['arrayIdProductoInventario']['precio_venta_inventario'], 2));
        $("#lista-detalle-producto").html('');
      }
    }
  });



}



function sumarCantidad(idTempDetalleComprobante,precioUnitario,idProducto,idComprobante){
      let cantidadProducto  = $("#data-cantidad-"+idTempDetalleComprobante).val();
      cantidadProducto++;
      let cantidadDosDecimal = cantidadProducto.toFixed(2); 
      $("#data-cantidad-"+idTempDetalleComprobante).val(cantidadDosDecimal);
      let subTotalProducto = precioUnitario * cantidadDosDecimal;
      let subTotalProductoDosDecimal = subTotalProducto.toFixed(2); 

      if (screen.width < 950) {
          $("#html-"+idTempDetalleComprobante).html('<input type="text" id="id="data-cantidad-'+cantidadDosDecimal+'" value="'+cantidadDosDecimal+'">');
          $("#html-sub-"+idTempDetalleComprobante).html('<div></div>');
      }

      $("#html-subtotal-"+idTempDetalleComprobante).html(subTotalProductoDosDecimal);
      var subtotalPrimero = document.getElementById("html-subtotal-2");


        // creando variables (agregar cantidad del producto)
        let idTempDetalleComp = idTempDetalleComprobante;
        let  fkIdProductoComp=idProducto ;
        let cantidadPedidoComp = $("#data-cantidad-"+idTempDetalleComprobante).val();

        var misDatosCantidad = {
                                'idTempDetalleComprobante':idTempDetalleComp,
                                'fkIdProducto':fkIdProductoComp,
                                'cantidadPedido':cantidadPedidoComp,
                                'tipoAccion':'sumarUnoDetalle'
                               };
      $.ajax({
        type:"POST",
        data: {tipo:'sumaRestaCantidadDetalleUno_a_Uno',datosSumarRestarUnoCantidad:misDatosCantidad},
        url:"views/requestController/realizar_venta/rc_realizar_venta.php",
        success:function(r){
          datos=jQuery.parseJSON(r);
          console.log(datos);
          listar_detalle_comprobante(idComprobante);
        }
      });




}

function restarCantidad(idTempDetalleComprobante,precioUnitario,fkIdProducto,idComprobante){
      let cantidadProducto  = $("#data-cantidad-"+idTempDetalleComprobante).val();
      if(cantidadProducto < 1){
        cantidadProducto = 0;
      }else{
        cantidadProducto--;
      }
      var cantidadDosDecimal = cantidadProducto.toFixed(2); 
      $("#data-cantidad-"+idTempDetalleComprobante).val(cantidadDosDecimal);

      if (screen.width < 950) {
            $("#html-"+idTempDetalleComprobante).html('<input type="text" id="data-cantida'+idTempDetalleComprobante+'" value="'+cantidadDosDecimal+'">');
            let subTotalProducto = precioUnitario * cantidadProducto;
            var subTotalProductoDosDecimal = subTotalProducto.toFixed(2); 
            $("#html-subtotal-"+idTempDetalleComprobante).val(subTotalProductoDosDecimal);
      }

      let subTotalProducto = precioUnitario * cantidadDosDecimal;
      var subTotalProductoDosDecimal = subTotalProducto.toFixed(2); 
      $("#html-subtotal-"+idTempDetalleComprobante).html(subTotalProductoDosDecimal);

        //  creando variables (agregar cantidad del producto)
         let idTempDetalleComp = idTempDetalleComprobante;
         let  fkIdProductoComp=fkIdProducto ;
         let cantidadPedidoComp = $("#data-cantidad-"+idTempDetalleComprobante).val();
 
         var misDatosCantidad = {
                                  'idTempDetalleComprobante':idTempDetalleComp,
                                  'fkIdProducto':fkIdProductoComp,
                                  'cantidadPedido':cantidadPedidoComp,
                                  'tipoAccion':'restarUnoDetalle'
                                };

         $.ajax({
          type:"POST",
          data: {tipo:'sumaRestaCantidadDetalleUno_a_Uno',datosSumarRestarUnoCantidad:misDatosCantidad},
          url:"views/requestController/realizar_venta/rc_realizar_venta.php",
          success:function(r){
            datos=jQuery.parseJSON(r);
            console.log(datos);
            listar_detalle_comprobante(idComprobante);
          }
        });



}





function AgregarProductoDetalleComprobante(){
    $('#btnAgregarProductoDetalleComprobante').click(function(){

        // alert('agragr producto a detalle maestro');
        let datos=$('#formDetalleComprobante').serialize(); 
        $.ajax({
          type:"POST",
          data: {tipo:'agregarTempDetalleComprobante',datosForm_Temp_AgregarDetalle:datos},
          url:"views/requestController/realizar_venta/rc_realizar_venta.php",
          success:function(r){
            $data = jQuery.parseJSON(r);
            if($data['resp']==0){
              console.log($data);
            }else{
              console.log($data);
              let id_Temp_Comprobante = $data['idComprobante'];
               // $('#formDetalleComprobante')[0].reset();
               $('#idTempComprobante').val(id_Temp_Comprobante);
               // console.log(id_Temp_Comprobante);
               listar_detalle_comprobante(id_Temp_Comprobante);
            }

       
          }
        });  
    });
  }
  function listar_detalle_comprobante(id_Temp_Comprobante) {
    $.ajax({
      type:"POST",
      data: {tipo:'listar',idTempComprobante:id_Temp_Comprobante},

      url:"views/requestController/realizar_venta/rc_realizar_venta.php",
      success:function(r){
        // console.log(r);
        if(r==0){
          console.log(r+'---nones');
          console.log('No existe registros.');
          $("#contenedor_tabla_comprobante").empty();
        }else{
            $("#contenedor_tabla_comprobante").empty();
            $("#contenedor_tabla_comprobante").html(r);
        }
      }
    });
  
  }


  function verificarComprobanteEmpleado() {
    $.ajax({
      type:"POST",
      data: {tipo:'verificarComprobanteEmpleado'},
      url:"views/requestController/realizar_venta/rc_realizar_venta.php",
      success:function(r){
        let data = jQuery.parseJSON(r);
       console.log(data);

        if(data['resp']==1){
          // console.log(data['idTempComprobante']);
          listar_detalle_comprobante(data['idTempComprobante']);
          $('#idTempComprobante').val(data['idTempComprobante']);
          $('#idComprobante').val(data['idTempComprobante']);
        }else{
          // console.log('no existe comprobante');
        }
      }
    });
  
  }


// function lisarSelectTipoDescuento(){

//   $('#none').click(function(){
//     alert('hola');
//     // $.ajax({
//     //   type:"POST",
//     //   data: {tipo:'listarSelectTipoDescuento'},
  
//     //   url:"views/requestController/realizar_venta/rc_realizar_venta.php",
//     //   success:function(r){
//     //      $data = jQuery.parseJSON(r);
//     //       console.log($data);
//     //   }
//     // });
//   });


// }





