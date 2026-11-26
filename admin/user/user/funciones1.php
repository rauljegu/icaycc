<?php
/**
 * Funciones para administrar los perfiles de personal.
 * Las entradas se validan y las consultas se ejecutan con sentencias preparadas.
 */

if (!function_exists('limpiar')) {
    function limpiar($datos): string
    {
        if (is_array($datos) || is_object($datos)) {
            return '';
        }
        return trim((string)($datos ?? ''));
    }
}

if (!function_exists('mostrarNotificacion')) {
    function mostrarNotificacion(string $mensaje, string $tipo = 'warning', int $tiempo = 5000, bool $recargar = false): void
    {
        $mensajeJS = json_encode($mensaje, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        $tipoJS = json_encode($tipo);
       /* $recargarJS = $recargar ? 'window.location.href = window.location.pathname + window.location.search + window.location.hash;' : '';*/
	   $recargarJS = $recargar
		? 'const url = new URL(window.location.href);
		   url.searchParams.delete("eq");
		   url.searchParams.delete("ok");
		   window.location.href = url.toString();'
		: '';
        echo '<script>
        if (typeof Swal !== "undefined") {
            Swal.fire({
                toast: true,
                position: "center",
                icon: ' . $tipoJS . ',
                title: ' . $mensajeJS . ',
                showConfirmButton: false,
                timer: ' . $tiempo . ',
                timerProgressBar: true
            }).then(() => {' . $recargarJS . '});
        } else {
            alert(' . $mensajeJS . ');
            ' . $recargarJS . '
        }
        </script>';
    }
}

if (!function_exists('obtenerConexionPersonal')) {
    function obtenerConexionPersonal()
    {
        global $conn;
        require_once __DIR__ . '/../../includes/connect.php';
        if (!isset($conn) || !($conn instanceof mysqli)) {
            throw new RuntimeException('No fue posible establecer la conexión con la base de datos.');
        }
        return $conn;
    }
}

if (!function_exists('actualizar')) {
    function actualizar(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            mostrarNotificacion('Solicitud no válida.');
            return;
        }

        $campos = [
            'nombres' => limpiar($_POST['name'] ?? ''),
            'apellido_paterno' => limpiar($_POST['paterno'] ?? ''),
            'apellido_materno' => limpiar($_POST['materno'] ?? ''),
            'correo' => limpiar($_POST['correo'] ?? ''),
            'extension' => limpiar($_POST['extension'] ?? ''),
            'telefono' => limpiar($_POST['telefono'] ?? ''),
            'grado_academico' => limpiar($_POST['grado'] ?? ''),
            'semblanza' => limpiar($_POST['semblanza'] ?? ''),
            'scholar' => limpiar($_POST['scholar'] ?? ''),
            'researchgate' => limpiar($_POST['researchgate'] ?? ''),
            'orcid' => limpiar($_POST['orcid'] ?? ''),
            'scopus' => limpiar($_POST['scopus'] ?? ''),
            'id_categoria_personal' => limpiar($_POST['categoria'] ?? ''),
            'id_nivel' => limpiar($_POST['nivel'] ?? ''),
            'id_sub_nivel' => limpiar($_POST['subnivel'] ?? ''),
            'cargo' => limpiar($_POST['cargo'] ?? '')
        ];

        if (isset($_POST['siia']) && !empty($_POST['siia'])) {
            $campos['siia'] = limpiar($_POST['siia']);
        } else {
			$campos['siia'] = NULL;
		}

        if ($campos['nombres'] === '' || $campos['apellido_paterno'] === '' || $campos['correo'] === '') {
            mostrarNotificacion('Nombre, apellido paterno y correo son obligatorios.');
            return;
        }

        if (!filter_var($campos['correo'], FILTER_VALIDATE_EMAIL)) {
            mostrarNotificacion('El correo electrónico no tiene un formato válido.');
            return;
        }

        $conn = null;
        try {
            $conn = obtenerConexionPersonal();
            $conn->begin_transaction();

            $asignaciones = [];
            foreach (array_keys($campos) as $campo) {
                $asignaciones[] = "`$campo` = ?";
            }
            $sql = 'UPDATE personal SET ' . implode(', ', $asignaciones) . ' WHERE id_personal = ?';
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new RuntimeException($conn->error);
            }

            $valores = array_values($campos);
            $tipos = str_repeat('s', count($valores)) . 'i';
            $valores[] = $id;
            $referencias = [];
            foreach ($valores as $indice => &$valor) {
                $referencias[$indice] = &$valor;
            }
            unset($valor);
            call_user_func_array([$stmt, 'bind_param'], array_merge([$tipos], $referencias));
            if (!$stmt->execute()) {
                throw new RuntimeException($stmt->error);
            }
            $stmt->close();

            // Actualiza o inserta la adscripción al departamento.
            if (isset($_POST['departamento']) && (int)$_POST['departamento'] > 0) {
                $dep = (int)$_POST['departamento'];
                $stmt = $conn->prepare('SELECT id FROM investigador_departamento WHERE id_investigador = ? LIMIT 1');
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->store_result();
                $existe = $stmt->num_rows > 0;
                $stmt->close();

                if ($existe) {
                    $stmt = $conn->prepare('UPDATE investigador_departamento SET id_departamento = ? WHERE id_investigador = ?');
                    $stmt->bind_param('ii', $dep, $id);
                } else {
                    $stmt = $conn->prepare('INSERT INTO investigador_departamento (id_investigador, id_departamento) VALUES (?, ?)');
                    $stmt->bind_param('ii', $id, $dep);
                }
                if (!$stmt->execute()) {
                    throw new RuntimeException($stmt->error);
                }
                $stmt->close();
            }

            // Actualiza o inserta el grupo.
            if (isset($_POST['grupo']) && (int)$_POST['grupo'] > 0) {
                $grupo = (int)$_POST['grupo'];
                $stmt = $conn->prepare('SELECT id FROM investigador_grupo WHERE id_investigador = ? LIMIT 1');
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->store_result();
                $existe = $stmt->num_rows > 0;
                $stmt->close();

                if ($existe) {
                    $stmt = $conn->prepare('UPDATE investigador_grupo SET id_grupo = ? WHERE id_investigador = ?');
                    $stmt->bind_param('ii', $grupo, $id);
                } else {
                    $stmt = $conn->prepare('INSERT INTO investigador_grupo (id_investigador, id_grupo) VALUES (?, ?)');
                    $stmt->bind_param('ii', $id, $grupo);
                }
                if (!$stmt->execute()) {
                    throw new RuntimeException($stmt->error);
                }
                $stmt->close();
            }

            // Actualiza o inserta la unidad de apoyo.
            if (isset($_POST['unidades']) && (int)$_POST['unidades'] > 0) {
                $unidad = (int)$_POST['unidades'];
                $stmt = $conn->prepare('SELECT id FROM personal_unidades WHERE id_personal = ? LIMIT 1');
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->store_result();
                $existe = $stmt->num_rows > 0;
                $stmt->close();

                if ($existe) {
                    $stmt = $conn->prepare('UPDATE personal_unidades SET id_unidades = ? WHERE id_personal = ?');
                    $stmt->bind_param('ii', $unidad, $id);
                } else {
                    $stmt = $conn->prepare('INSERT INTO personal_unidades (id_personal, id_unidades) VALUES (?, ?)');
                    $stmt->bind_param('ii', $id, $unidad);
                }
                if (!$stmt->execute()) {
                    throw new RuntimeException($stmt->error);
                }
                $stmt->close();
            }

            $conn->commit();
            mostrarNotificacion('Datos actualizados correctamente.', 'success', 1800, true);
        } catch (Throwable $e) {
            if ($conn instanceof mysqli) {
                $conn->rollback();
                error_log('Error al actualizar personal: ' . $e->getMessage());
            }
            mostrarNotificacion('No fue posible actualizar los datos. Revisa el registro de errores.');
        }
    }
}

if (!function_exists('cambiarEstadoPersonal')) {
    function cambiarEstadoPersonal(int $estado): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id || !in_array($estado, [0, 1], true)) {
            mostrarNotificacion('Solicitud no válida.');
            return;
        }

        try {
            $conn = obtenerConexionPersonal();
            $stmt = $conn->prepare('UPDATE personal SET activo = ? WHERE id_personal = ?');
            $stmt->bind_param('ii', $estado, $id);

            if (!$stmt->execute()) {
                throw new RuntimeException($stmt->error);
            }

            if ($stmt->affected_rows === 0) {
                // Puede ser que el registro ya tuviera el estado solicitado.
                $stmt->close();
                mostrarNotificacion('El registro ya tenía ese estado o no existe.', 'info', 1800, true);
                return;
            }

            $stmt->close();
            mostrarNotificacion($estado === 1 ? 'Personal activado.' : 'Personal desactivado.', 'success', 1500, true);
        } catch (Throwable $e) {
            error_log('Error al cambiar estado del personal: ' . $e->getMessage());
            mostrarNotificacion('No fue posible cambiar el estado del registro.');
        }
    }
}

if (!function_exists('activar')) {
    function activar(): void
    {
        cambiarEstadoPersonal(1);
    }
}

if (!function_exists('desactivar')) {
    function desactivar(): void
    {
        cambiarEstadoPersonal(0);
    }
}
