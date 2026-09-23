<body>
<?php

include 'conexion.php';

$id = $_GET['id'];
$token = $_GET['token'];

// Buscar en la tabla
$stmt = $conn->prepare("SELECT reset_token, temp_password, token_expiry FROM users WHERE id = ? AND reset_token = ?");
$stmt->bind_param("is", $id, $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $expiry = $row['token_expiry'];
    $now = date("Y-m-d H:i:s");

    if ($now <= $expiry) {
        // Actualiza contraseña final
        $stmt2 = $conn->prepare("UPDATE users SET password = ?, temp_password = NULL, reset_token = NULL, token_expiry = NULL WHERE id = ?");
        $stmt2->bind_param("si", $row['temp_password'], $id);
        $stmt2->execute();

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Contraseña actualizada',
                text: 'Tu nueva contraseña ha sido confirmada.',
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Token expirado',
                text: 'Solicita nuevamente el cambio de contraseña.',
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Token inválido',
            text: 'Verifica el enlace de confirmación.',
        });
    </script>";
}
?>
</body>