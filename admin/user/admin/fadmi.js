¡
    document.getElementById('add-tema').addEventListener('click', function() {
        let container = document.getElementById('temas-container');
        let div = document.createElement('div');
        div.classList.add('input-group', 'mb-2');
        div.innerHTML = `
            <select  id="tema<?=++$a;?>"  name="temas[]" class="form-control" placeholder="Agregar tema">
			
				<?php echo $topt; ?>
			</select>
            <button type="button" class="btn btn-danger remove-tema">X</button>
        `;
        container.appendChild(div);
    });

    document.getElementById('temas-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-tema')) {
            e.target.parentElement.remove();
        }
    });
	
	// Loader
document.addEventListener("DOMContentLoaded", function () {
	document.getElementById('loginForm').addEventListener('submit', function(event) {	 
		// Asegurar que el spinner se muestre al iniciar la carga
		let spinner = document.getElementById('loading-spinner');
		spinner.style.display = "flex"; 
});
})
	// Loader
document.addEventListener("DOMContentLoaded", function () {
	document.getElementById('loginForm1').addEventListener('submit', function(event) {	 
		// Asegurar que el spinner se muestre al iniciar la carga
		let spinner = document.getElementById('loading-spinner');
		spinner.style.display = "flex"; 
});
})
	// Loader
document.addEventListener("DOMContentLoaded", function () {
	document.getElementById('registroForm').addEventListener('submit', function(event) {	 
		// Asegurar que el spinner se muestre al iniciar la carga
		let spinner = document.getElementById('loading-spinner');
		spinner.style.display = "flex"; 
});
})
¡

