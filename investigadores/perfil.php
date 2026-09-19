<?php

require_once __DIR__ . '/../config/config.php';

$id = intval($_GET['id'] ?? 0);

if($id <= 0){
    die('Investigador no válido');
}

/* ==========================
   DATOS DEL INVESTIGADOR
   ========================== */

$sql = "
SELECT *
FROM personal
WHERE id_personal = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$investigador = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$investigador){
    die('Investigador no encontrado');
}

/* ==========================
   DEPARTAMENTOS
   ========================== */

$sql = "
SELECT d.nombre
FROM departamentos d

INNER JOIN investigador_departamento id
    ON id.id_departamento = d.id_departamento

WHERE id.id_investigador = ?

ORDER BY d.nombre
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<div class="container py-5">

    <div class="row">

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <img
                        src="../assets/img/avatar.png"
                        class="img-fluid rounded-circle mb-3"
                        style="width:180px;height:180px;object-fit:cover;"
                        alt="Investigador">

                    <h3>
                        <?= htmlspecialchars($investigador['nombre']); ?>
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-8">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h4 class="titulo-seccion">
                        Información General
                    </h4>

                    <hr>

                    <p>
                        <strong>Nombre:</strong><br>
                        <?= htmlspecialchars($investigador['nombre']); ?>
                    </p>

                    <p>
                        <strong>Departamento(s):</strong><br>

                        <?php

                        if(count($departamentos)>0){

                            foreach($departamentos as $dep){

                                echo htmlspecialchars($dep['nombre'])."<br>";

                            }

                        }else{

                            echo "No registrado";

                        }

                        ?>

                    </p>

                    <?php if(!empty($investigador['correo'])){ ?>

                    <p>
                        <strong>Correo:</strong><br>
                        <?= htmlspecialchars($investigador['correo']); ?>
                    </p>

                    <?php } ?>

                    <?php if(!empty($investigador['orcid'])){ ?>

                    <p>
                        <strong>ORCID:</strong><br>
                        <?= htmlspecialchars($investigador['orcid']); ?>
                    </p>

                    <?php } ?>

                    <?php if(!empty($investigador['semblanza'])){ ?>

                    <h5 class="mt-4">
                        Semblanza
                    </h5>

                    <p>
                        <?= nl2br(htmlspecialchars($investigador['semblanza'])); ?>
                    </p>

                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>