<?php
//Kill session
session_start();
session_unset();
session_destroy();
//echo '<script type="text/javascript">alert("Porfesor/Academico registrado correctamente");</script>';
//header("refresh: 0.1; url = ../index.php");
header("Location: ../index.php");
?>