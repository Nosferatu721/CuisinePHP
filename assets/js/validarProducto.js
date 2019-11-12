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

function validarPrecio() {
  var elemento = document.getElementById("precio");
  if (elemento.value == "" || isNaN(elemento.value)) {
    alertica('Precio Erroneo');
    return false;
  }
  return true;
}


function validar(e) {
  if (validarNombre() && validarPrecio()) {
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