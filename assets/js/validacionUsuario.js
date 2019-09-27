window.onload = iniciar;

function iniciar() {
  document.getElementById("enviar").addEventListener('click', validar, false);
}

var spam = document.getElementById('btnLang');
var txt = spam.innerText;
console.log(txt);
if (txt == 'INGLES') {
  var Rol = 'Elija Cargo';
  var Restaurante = 'Elija Restaurante';
  var Nombre = 'Nombre Erroneo';
  var Apellido = 'Apellido Erroneo';
  var Correo = 'Correo Erroneo';
  var Contraseña = 'Contraseña Erroneo';
} else {
  var Rol = 'Choose Position';
  var Restaurante = 'Choose restaurant';
  var Nombre = 'Worng Name';
  var Apellido = 'Worng Last Name';
  var Correo = 'Worng Mail';
  var Contraseña = 'Worng Password';
}
//Formato Correo
var expresion = /\w+@\w+\.+[a-z]/;

function validarNombre() {
  var elemento = document.getElementById("nombres");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertica(Nombre);
    return false;
  }
  return true;
}
function validarApellidos() {
  var elemento = document.getElementById("apellidos");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertica(Apellido);
    return false;
  }
  return true;
}
function validarEmail() {
  var elemento = document.getElementById("email");
  if (elemento.value == "" || !expresion.test(elemento.value)) {
    alertica(Correo);
    return false;
  }
  return true;
}
function validarPass() {
  var elemento = document.getElementById("pass");
  if (elemento.value == "") {
    alertica(Contraseña);
    return false;
  }
  return true;
}

function validarRestaurante() {
  var elemento = document.getElementById("restaurante");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertica(Restaurante);
    return false;
  }
  return true;
}
function validarCargo() {
  var elemento = document.getElementById("rol");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertica(Rol);
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