   document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('upload-form<?=$idcor;?>').addEventListener('submit', function(event) {
            event.preventDefault();
            let formData = new FormData(this);
            
            // Asegurar que el spinner se muestre al iniciar la carga
            let spinner = document.getElementById('loading-spinner');
            spinner.style.display = "flex"; 

            fetch('upload1.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Ocultar el spinner después de recibir la respuesta
                spinner.style.display = "none";

                Swal.fire({
                    icon: data.status === "success" ? "success" : "error",
                    title: data.message
                }).then(() => {
                    if (data.status === "success") {
                        window.location.href = "mensajes.php";
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
                spinner.style.display = "none"; // Ocultar el spinner en caso de error
            });
        });
    });