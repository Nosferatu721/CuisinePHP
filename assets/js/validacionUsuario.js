window.onload = iniciar;

function iniciar() {
  document.getElementById("enviar").addEventListener('click', validar, false);
}

function validarNombre() {
  var elemento = document.getElementById("nombres");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertica('Nombre Erroneo');
    return false;
  }
  return true;
}
function validarApellidos() {
  var elemento = document.getElementById("apellidos");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertica('Apellido Erroneo');
    return false;
  }
  return true;
}
function validarPass() {
  var elemento = document.getElementById("pass");
  if (elemento.value == "") {
    alertica('Contraseña Erronea');
    return false;
  }
  return true;
}

function validarRestaurante() {
  var elemento = document.getElementById("restaurante");
  if (elemento.value == "Eliga...") {
    console.log(elemento.value);
    alertica('Eliga Restaurante');
    return false;
  }
  return true;
}

function validar(e) {
  if (validarNombre() && validarApellidos() && validarPass() && validarRestaurante()) {
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