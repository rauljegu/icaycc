<?php
include_once 'includes/functions.php'; // include functions
include_once 'includes/connect.php'; //include connection
session_start();
$sessionverify = new Login;
$sessionverify->SessionVerify();

if(isset($_GET["error"])){ 
//echo '<script type="text/javascript">alert("'.$_GET["error"].' ");</script>'; 
	echo "<script>
					Swal.fire({
						icon: 'error',
						title: 'Clave Incorrecta',
						text: '".$_GET["error"]."',
						confirmButtonText: 'Entendido',
						customClass: {
							popup: 'swal2-popup'
						}
					});
				</script>";
}
 ?>
