document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('cambiar<?php echo $idrec;?>').addEventListener('submit', function(event) {	 
            // Asegurar que el spinner se muestre al iniciar la carga
            let spinner = document.getElementById('loading-spinner');
            spinner.style.display = "flex"; 
/*<?php if(isset($_GET["l"])){
	echo "window.location.href='recibidos.php";
}
		
?>*/
           
        });
    });
