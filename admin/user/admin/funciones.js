document.getElementById("formFoto").addEventListener("submit", function (e) {
	e.preventDefault();

	let inputFoto = document.getElementById("inputFoto");

	// Verificar que se haya seleccionado una imagen
	if (!inputFoto.files.length) {
		Swal.fire("Error", "Por favor, selecciona una imagen.", "error");
		return;
	}

	let formData = new FormData(this);

	fetch("subir_foto.php", {
		method: "POST",
		body: formData
	})
		.then(response => response.json())
		.then(data => {
			console.log("Respuesta del servidor:", data); // <-- Agregar este log
			if (data.status === "success") {
				Swal.fire("Éxito", data.mensaje, "success");
				if (data.ruta) {
					document.getElementById("fotoPerfil").src = data.ruta;
				}
			} else {
				Swal.fire("Error", data.mensaje, "error");
			}
		})
			.catch(error => {
				console.error("Error:", error);
				Swal.fire("Error", "Hubo un problema al subir la foto.", "error");
			});
});

function cambiarFoto() {
	const input = document.getElementById("inputFoto");
	const img = document.getElementById("fotoPerfil");
	if (input.files && input.files[0]) {
		const reader = new FileReader();
		reader.onload = function (e) {
			img.src = e.target.result;
		};
	reader.readAsDataURL(input.files[0]);
	}
}
document.getElementById('registroForm').addEventListener('submit', function(event) {
    let form = event.target;
    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
});