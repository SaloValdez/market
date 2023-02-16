$(document).ready(function() {


  // miTablaComprobante.dataTable().fnDestroy();
  // miDataTableDetalleComprobante();
  miDataTable();

  if ( $.fn.dataTable.isDataTable( '#miTabla' ) ) {
    table = $('#miTabla').DataTable();
  }
  else {
      table = $('#miTabla').DataTable();
  }

  if ( $.fn.dataTable.isDataTable( '#miDataTableDetalleComprobante' ) ) {
    table = $('#miDataTableDetalleComprobante').DataTable();
    
  }
  else {
      table = $('#miDataTableDetalleComprobante').DataTable();
  }

 

});


function  miDataTable(){
  // mitabla.destroy();
    mitabla =  $('#miTabla').DataTable({
      // paging: false,
      // searching: false,

      "language": {
      "emptyTable":			"<i>No hay datos disponibles en la tabla.</i>",
      "info":		   		"Del _START_ al _END_ de _TOTAL_ ",
      "infoEmpty":			"Mostrando 0 registros de un total de 0.",
      "infoFiltered":			"(filtrados de un total de _MAX_ registros)",
      "infoPostFix":			"(actualizados)",
      "lengthMenu":			"Mostrar _MENU_ registros",
      "loadingRecords":		"Cargando...",
      "processing":			"Procesando...",
      "search":			"<span style='font-size:15px;'>Buscar:</span>",
      "searchPlaceholder":		"Dato para buscar",
      "zeroRecords":			"No se han encontrado coincidencias.",
      "paginate": {
        "first":			"Primera",
        "last":				"Última",
        "next":				"Siguiente",
        "previous":			"Anterior"
      },
      "aria": {
        "sortAscending":	"Ordenación ascendente",
        "sortDescending":	"Ordenación descendente"
      }
    },

    "lengthMenu":		[[2,5,7, 10, 20, 25, 50, -1, "Todos"], [2,5,7, 10, 20, 25, 50, "Todos"]],
    "iDisplayLength":	10,
    });
}

// function  miDataTableDetalleComprobante(){
  var miTablaComprobante = $('#miDataTableDetalleComprobante').DataTable({
    paging: false,
    searching: false,
    select: true,

    "language": {
    "emptyTable":			"<i>No hay datos disponibles en la tabla.</i>",
    "info":		   		"Del _START_ al _END_ de _TOTAL_ ",
    "infoEmpty":			"Mostrando 0 registros de un total de 0.",
    "infoFiltered":			"(filtrados de un total de _MAX_ registros)",
    "infoPostFix":			"(actualizados)",
    "lengthMenu":			"Mostrar _MENU_ registros",
    "loadingRecords":		"Cargando...",
    "processing":			"Procesando...",
    "search":			"<span style='font-size:15px;'>Buscar:</span>",
    "searchPlaceholder":		"Dato para buscar",
    "zeroRecords":			"No se han encontrado coincidencias.",
    "paginate": {
      "first":			"Primera",
      "last":				"Última",
      "next":				"Siguiente",
      "previous":			"Anterior"
    },
    "aria": {
      "sortAscending":	"Ordenación ascendente",
      "sortDescending":	"Ordenación descendente"
    }
  },

  "lengthMenu":		[[2,5,7, 10, 20, 25, 50, -1, "Todos"], [2,5,7, 10, 20, 25, 50, "Todos"]],
  "iDisplayLength":	10,
  });
// }
