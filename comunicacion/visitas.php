<?php
require_once __DIR__ . '/../config/config.php';

$sql = "
SELECT
   *
FROM visitas d

";
//echo $sql;
$stmt = $pdo->prepare($sql);
$stmt->execute();

$vis = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container py-5">

    <h1 class="mb-4">
        Visitas Guiadas
    </h1>

    <div class="row g-4">



        <!-- PROCEDIMIENTO -->
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body" >
                    <h2 class="card-title"><?= nl2br(htmlspecialchars($vis['procedimiento'])); ?></h2>

                    <p>
                        <?= htmlspecialchars($vis['contenido_procedimiento']); ?>
                    </p>
					 <h2><?= htmlspecialchars($vis['areas']); ?></h2>
					 <p>
                        <?= nl2br(htmlspecialchars($vis['contenido_areas'])); ?>
                    </p>
                </div>
            </div>
        </div>     
		<!-- REQUISITOS -->
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body" >
                    <h2 class="card-title"><?= nl2br(htmlspecialchars($vis['requisitos'])); ?></h2>

                    <p>
                        <?= nl2br(htmlspecialchars($vis['contenido_requisitos'])); ?>
                    </p>
                </div>
            </div>
        </div> 
		



        




    </div>
</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>