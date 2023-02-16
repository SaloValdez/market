

$(document).ready(function($){
 
  // $('#modalUnidadMEdida').slideDown("0");
  // $('#modalUnidadMEdida').css("visibility", 'visible');
  
  // abriVentanaSmallCropper();
});  




function abriVentana(){
  $(".contenedor-modal").slideDown("0");
  $(".contenedor-modal").css("visibility", 'visible');
}


function cerrarVentana(){
  $(".contenedor-modal").slideUp("0");
}
  




function abriVentanaSmallCropper(){
  $(".contenedor-modal-small.crooper").slideDown("0");
  $(".contenedor-modal-small.crooper").css("visibility", 'visible');
}
function cerrarVentanaSmallCropper(){
  $(".contenedor-modal-small.crooper").slideUp("0");
}




function abriVentanaSmall(selector){
  selector.slideDown("0");
  selector.css("visibility", 'visible');
}
function cerrarVentanaSmall(selector){
  selector.slideUp("0");
}
  
  

function openModal(selector){
  selector.slideDown("0");
  selector.css("visibility", 'visible');
}

function closeModal(selector){
  selector.slideUp("0");
  // selector.css("visibility", 'hidden');
}



// $('#btnListarCategoriaProducto').click(function(){
//   if ($(".dataTables_wrapper") ) {
//     $( ".dataTables_wrapper" ).remove();
//     $('#contenedor_datatable_categria_producto').load('./views/requestController/categoria_producto/rc_listar_tabla_categoria_producto.php');
//   }
// })







// $('#btnAbrirUnidadMedida').click(function(){
//   openModal($("#modalUnidadMEdida"));
 
// })