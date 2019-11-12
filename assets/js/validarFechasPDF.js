window.onload = iniciar;

function iniciar() {
  document.getElementById("generarPDF").addEventListener('click', validar, false);
}

function validarFechas() {
  var elemento = document.getElementById("fechaInicial");
  var elemento2 = document.getElementById("fechaFinal");

  if (elemento.value == "" || elemento2.value == "") {
    alertica('Introduzca Fecha');
    return false;
  } else {
    return true;
  }
}


function validar(e) {
  if (validarFechas()) {
    return true;
  } else {
    e.preventDefault();
    return false;
  }
}

// Alertica :v
function alertica(mensaje) {
  const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 5000
  });
  Toast.fire({
    type: 'error',
    title: '<span style="color: white; font-weight: 300; font-size: 14px;">' + mensaje + '</span>',
    background: 'rgba(0,0,0,0.9)'
  });
}