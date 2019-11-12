window.onload = iniciar;

function iniciar() {
  document.getElementById("enviar").addEventListener('click', validar, false);
}

function validarCantidad() {
  var elemento = document.getElementById("cantidad");
  if (elemento.value == "" || isNaN(elemento.value)) {
    alertica('Cantidad Erronea');
    return false;
  }
  return true;
}
function validarFecha() {
  var elemento = document.getElementById("fecha");

  if (elemento.value == "") {
    alertica('Introduzca Fecha');
    return false;
  } else {
    //Tomar la fecha actual Formato MES/DIA/AÑO
    var f = new Date();
    var dia = f.getDate();
    if (dia < 10) {
      dia = '0' + dia;
    };
    var mes = f.getMonth() + 1;
    if (mes < 10) {
      mes = '0' + mes;
    };
    var año = f.getFullYear();
    var fechaActual = mes + '/' + dia + '/' + año;
    //

    var arr = elemento.value.split('-');
    //Tomar fecha del FORM y damos Formato MES/DIA/AÑO
    var fechaFrom = arr[1] + '/' + arr[2] + '/' + arr[0];

    var fechaInput = Date.parse(fechaFrom);
    var fechaAct = Date.parse(fechaActual);

    console.log(fechaFrom);
    console.log(fechaActual);

    if (fechaAct == fechaInput) {
      alertica('La fecha no puede ser de hoy');
      return false;
    } else if (fechaAct > fechaInput) {
      alertica('La fecha ya paso');
      return false;
    }
    return true;
  }
}
function validarLote() {
  var elemento = document.getElementById("lote");
  if (elemento.value == "") {
    alertica('Lote Erroneo');
    return false;
  }
  return true;
}

function validar(e) {
  if (validarCantidad() && validarFecha() && validarLote()) {
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