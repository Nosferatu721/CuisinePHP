window.onload = iniciar;

function iniciar() {
  document.getElementById("enviar").addEventListener('click', validar, false);
}

function validarTipo() {
  var elemento = document.getElementById("tipoMerma");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertica('Elija Tipo de Merma');
    return false;
  }
  return true;
}

function validarCantidad() {
  var elemento = document.getElementById("cantidad");
  if (elemento.value == "" || isNaN(elemento.value)) {
    alertica('Cantidad Erroneo');
    return false;
  }
  return true;
}

function validarMotivo() {
  var elemento = document.getElementById("motivo");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertica('Motivo Erroneo');
    return false;
  }
  return true;
}

function validar(e) {
  if (validarCantidad() && validarTipo() && validarMotivo()) {
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