<div class="modal fade" id="myModal1" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">
                    Admin 
                    <img src="../assets/img/logo_icaycc_negro.svg" alt="Logo" width="20%">
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" class="form-signin" action="includes/login.php" method="POST" autocomplete="off">
                    <div class="card border-info">
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Usuario:</span>
                                <input name="login" type="text" id="inputEmail" class="form-control" placeholder="Usuario" autocomplete="off" required autofocus>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Contraseña:</span>
                                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" autocomplete="new-password" required>
                            </div>
							<!--<div class="input-group mb-3">
								<span class="input-group-text"> ¿Olvidaste tu contrase&ntilde;a?  </span>
								<a href="recuperar.php" style="text-decoration:none" class="btn btn-warning"> Recuperar contrase&ntilde;a</a> 
 							</div>-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary " type="submit" name="submit">Ingresar</button>                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
