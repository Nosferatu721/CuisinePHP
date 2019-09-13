window.onload = iniciar;

function iniciar() {
  document.getElementById("enviar").addEventListener('click', validar, false);
}

//Formato Correo
var expresion = /\w+@\w+\.+[a-z]/;

function validarNombre() {
  var elemento = document.getElementById("nombre");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertica('Nombre Erroneo');
    return false;
  }
  return true;
}


function validar(e) {
  if (validarNombre()) {
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
    title: '<span style="color: white">' + mensaje + '</span>',
    background: 'rgba(0,0,0,0.9)'
  });
}