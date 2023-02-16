
$(document).ready(function(){
    btnCancelar();
    deshabilitar();
    deshabilitarSmall();
    btnCancelarSmall();


    $(".contenedor-modal").slideDown("0");
 
    $('.soloNumeros').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
    });

});



function redondearDecimales(numero, decimales) {
  numeroRegexp = new RegExp('\\d\\.(\\d){' + decimales + ',}');   // Expresion regular para numeros con un cierto numero de decimales o mas
  if (numeroRegexp.test(numero)) {         // Ya que el numero tiene el numero de decimales requeridos o mas, se realiza el redondeo
      return Number(numero).toFixed(decimales);
  } else {
      return Number(numero).toFixed(decimales) === 0 ? 0 : numero;  // En valores muy bajos, se comprueba si el numero es 0 (con el redondeo deseado), si no lo es se devuelve el numero otra vez.
  }
}


function btnCancelar(){
    $('#btnCancelar').click(function(){
      deshabilitar();
      $(".select :selected").val("0");
      });
 }

 function activarId(){
    $('.input-block').prop('disabled',false)
  }

  
function habilitar(){
    $(".btnInsertar").hide();
    $(".btnActualizar").show();
    $(".btnEliminar").show();
  
    $('.input-block').get(0).type = 'text';
    $(".label-block").show();
  
    $('.input-block').addClass('input-block');
    $('.label-block').addClass('label-block');
  }

  function deshabilitar(){
    $(".btnInsertar").show();
    $(".btnEliminar").hide();
    $(".btnActualizar").hide();
    // $('.form-control').prop('value','');
    listarUltimaCategoria();
    $(".input-block").val('');
    
    $('#categoriaProductoSelect').val(0);
    $(".input-block").hide();
    $(".label-block").hide();
    $('.input-block').prop('disabled',true);
  }
  




  function btnCancelarSmall(){
    $('.btnCancelarSmall').click(function(){
      deshabilitarSmall();
      // $(".select :selected").val("0");
      });
  }




  function habilitarSmall(){
    $(".btnInsertarSmall").hide();
    $(".btnActualizarSmall").show();
    $(".btnEliminarSmall").show();
  
    $('.inputBlockSmall').get(0).type = 'text';
    $('.inputBlockSmall').addClass('label-block');
  }

  function deshabilitarSmall(){
    $(".btnInsertarSmall").show();
    $(".btnEliminarSmall").hide();
    $(".btnActualizarSmall").hide();
    $('.form-controlSmall').prop('value','');
    // listarUltimaCategoria();
    $(".inputBlockSmall").val('');


    if (document.getElementsByClassName('inputBlockSmall').length) {
      if($('.inputBlockSmall').get(0).type){
        $('.inputBlockSmall').get(0).type = 'hidden';
      }
  }




      
  

      $('.inputBlockSmall').addClass('label-block');
  }
  






  // $('body').on('click', '#miDataTableDetalleComprobante input', function(){
  //   let idCajaCantidad = $(this).attr('id');
  //   let idTempDetalleComprobante = idCajaCantidad.split('-')[2];
  //   console.log(idTempDetalleComprobante);
  
  //   $("#"+idCajaCantidad).on("keyup change", function(e) {
  //       let cantidadProducto = $(this).val();
  //       // let cantidadDosDecimal = cantidadProducto.toFixed(2);
  //       let precioUnitario = $("#data-precio-"+idTempDetalleComprobante).attr('data-value');
  //       let subTotalProducto = precioUnitario * cantidadProducto;

  //       let subTotalProductoDosDecimal = subTotalProducto.toFixed(2); 


  //   })
  // })