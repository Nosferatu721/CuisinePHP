window.onload = iniciar;

function iniciar() {
  document.getElementById("enviar").addEventListener('click', validar, false);
}

function validarNombre() {
  var elemento = document.getElementById("nombre");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertica('Nombre Erroneo');
    return false;
  }
  return true;
}
function validarDireccion() {
  var elemento = document.getElementById("direccion");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertica('Direccion Erronea');
    return false;
  }
  return true;
}

function validar(e) {
  if (validarNombre() && validarDireccion()) {
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
    timer: 3000
  });
  Toast.fire({
    type: 'error',
    title: mensaje,
    background: 'rgba(255,255,255,0.9)'
  });
}