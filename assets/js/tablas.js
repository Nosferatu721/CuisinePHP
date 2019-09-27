$(document).ready(function () {
  var spam = document.getElementById('btnLang');
  var txt = spam.innerText;
  console.log(txt);
  if (txt == 'SPANISH') {
    $('#tabla').DataTable();
  } else {
    $('#tabla').DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Registros en total - _TOTAL_",
        "infoEmpty": "0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "sProcessing": "Procesando...",
      }
    });
  }
});