window.onload = iniciar;

function iniciar() {
  document.getElementById("enviar").addEventListener('click', validar, false);
}

//Formato Correo
var expresion = /\w+@\w+\.+[a-z]/;

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
function validarEmail() {
  var elemento = document.getElementById("email");
  if (elemento.value == "" || !expresion.test(elemento.value)) {
    console.log(elemento.value);
    alertica('Email Erroneo');
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
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertica('Elija Restaurante');
    return false;
  }
  return true;
}
function validarCargo() {
  var elemento = document.getElementById("rol");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertica('Elija Cargo');
    return false;
  }
  return true;
}

function validar(e) {
  if (validarCargo() && validarRestaurante() && validarNombre() && validarApellidos() && validarEmail() && validarPass()) {
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
    background: 'rgba(0,0,0,0.8)'
  });
}