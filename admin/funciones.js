
document.addEventListener("DOMContentLoaded", function () {
    // 1. Limpiar valores precargados
    document.getElementById("correo").value = "";
    document.getElementById("correoConfirmacion").value = "";
    document.getElementById("pass").value = "";
    document.getElementById("passConfirmacion").value = "";
});
	
document.addEventListener("DOMContentLoaded", function() {
    let correo = document.getElementById("correo");
    let pass = document.getElementById("pass");
    let correoConfirmacion = document.getElementById("correoConfirmacion");
    let passConfirmacion = document.getElementById("passConfirmacion");
    let mensajeError = document.getElementById("mensajeError");
    let mensajeError1 = document.getElementById("mensajeError1");
    let btnVerificarCorreo = document.getElementById("btnVerificarCorreo");
    let form = document.getElementById("registroForm");
	document.getElementById("correoConfirmacion").addEventListener("paste", function(event) {
    event.preventDefault();
   const Toast = Swal.mixin({
								toast: true,
								position: 'center',
								showConfirmButton: false,
								timer: 3500,
								timerProgressBar: true,
								didOpen: (toast) => {
									toast.onmouseenter = Swal.stopTimer;
									toast.onmouseleave = Swal.resumeTimer;
								}
							});

							Toast.fire({
								icon: 'warning',
								title: 'Por favor reescribe tu correo'
							})
	});
	document.getElementById("passConfirmacion").addEventListener("paste", function(event) {
    event.preventDefault();
   const Toast = Swal.mixin({
								toast: true,
								position: 'center',
								showConfirmButton: false,
								timer: 3500,
								timerProgressBar: true,
								didOpen: (toast) => {
									toast.onmouseenter = Swal.stopTimer;
									toast.onmouseleave = Swal.resumeTimer;
								}
							});

							Toast.fire({
								icon: 'warning',
								title: 'Por favor reescribe tu contraseña'
							})
	});
	


    // 2. Validar en tiempo real	
    function validarCampos() {
        let errores = false;

        if (correoConfirmacion && correo.value.trim() !== correoConfirmacion.value.trim()) {
            mensajeError.classList.remove("d-none");
            errores = true;
        } else {
            mensajeError.classList.add("d-none");
        }

        if (passConfirmacion && pass.value.trim() !== passConfirmacion.value.trim()) {
            mensajeError1.classList.remove("d-none");
            errores = true;
        } else {
            mensajeError1.classList.add("d-none");
        }

        return !errores; // Retorna true si no hay errores
    }

    if (correoConfirmacion) correoConfirmacion.addEventListener("input", validarCampos);
    if (passConfirmacion) passConfirmacion.addEventListener("input", validarCampos);

    btnVerificarCorreo.addEventListener("click", function(event) {
        if (!validarCampos()) {
            event.preventDefault(); // Evita el envío si hay errores
			const Toast = Swal.mixin({
								toast: true,
								position: 'center',
								showConfirmButton: false,
								timer: 4500,
								timerProgressBar: true,
								didOpen: (toast) => {
									toast.onmouseenter = Swal.stopTimer;
									toast.onmouseleave = Swal.resumeTimer;
								}
							});

							Toast.fire({
								icon: 'warning',
								title: 'Correo o contraseña no coinciden'
							})
							}/* else {
            form.submit();
        }*/
    });
});


// Loader
document.addEventListener("DOMContentLoaded", function () {
	document.getElementById('registroForm').addEventListener('submit', function(event) {	 
		// Asegurar que el spinner se muestre al iniciar la carga
		let spinner = document.getElementById('loading-spinner');
		spinner.style.display = "flex"; 
});
});

// Loader
document.addEventListener("DOMContentLoaded", function () {
	document.getElementById('loginForm').addEventListener('submit', function(event) {	 
		// Asegurar que el spinner se muestre al iniciar la carga
		let spinner = document.getElementById('loading-spinner');
		spinner.style.display = "flex"; 
});
});

// Loader
document.addEventListener("DOMContentLoaded", function () {
	document.getElementById('registroForm3').addEventListener('submit', function(event) {	 
		// Asegurar que el spinner se muestre al iniciar la carga
		let spinner = document.getElementById('loading-spinner');
		spinner.style.display = "flex"; 
});
});
// Loader
document.addEventListener("DOMContentLoaded", function () {
	document.getElementById('loginForm1').addEventListener('submit', function(event) {	 
		// Asegurar que el spinner se muestre al iniciar la carga
		let spinner = document.getElementById('loading-spinner');
		spinner.style.display = "flex"; 
});
});