window.onload = iniciar;

function iniciar() {
	document.getElementById("cambiarPass").addEventListener('click', validar, false);
}

function validarVacios() {
	var passOld = document.getElementById("passOld");
	var newPass = document.getElementById("newPass");
	var newPassC = document.getElementById("newPassC");
	if (passOld.value == "" || newPass.value == "" || newPassC.value == "") {
		alertica('Llena Los Campos');
		return false;
	} else if (newPass.textLength <= 4) {
		alertica('Mínimo 5 Caracteres');
		return false;
	} else if (newPass.value != newPassC.value) {
		alertica('No Coinciden Las Contraseñas');
		return false;
	}
	return true;
}


function validar(e) {
	if (validarVacios()) {
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