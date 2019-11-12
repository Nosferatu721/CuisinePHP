window.onload = iniciar;

function iniciar() {
  document.getElementById("enviar").addEventListener('click', validar, false);
}

var spam = document.getElementById('btnLang');
var txt = spam.innerText;
console.log(txt);
if (txt == 'INGLES') {
  var Producto = 'Elija Producto';
  var Cantidad = 'Cantidad Erronea';
} else {
  var Producto = 'Choose Product';
  var Cantidad = 'Worng Amount';
}

function validarProducto() {
  var elemento = document.getElementById("producto");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertica(Producto);
    return false;
  }
  return true;
}

function validarCantidad() {
  var elemento = document.getElementById("cantidad");
  if (elemento.value == "" || isNaN(elemento.value)) {
    alertica(Cantidad);
    return false;
  }
  return true;
}


function validar(e) {
  if (validarProducto() && validarCantidad()) {
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