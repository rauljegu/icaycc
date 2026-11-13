
<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../includes/wp-media.php';
// ==========================================
// FUNCIONES AUXILIARES
// ==========================================

function escapar($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}

// Categoría que vamos a consultar
$categoria = 'Publicaciones';

// ==========================================
// SI SE RECIBE UN ID, MOSTRAR ENTRADA
// ==========================================

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$entrada = null;
$categorias = [];
$etiquetas = [];

if ($id) {

    $sql = "
        SELECT p.*,
               imagen.guid AS imagen_destacada
        FROM wp_posts p

        INNER JOIN wp_term_relationships tr
            ON p.ID = tr.object_id

        INNER JOIN wp_term_taxonomy tt
            ON tr.term_taxonomy_id = tt.term_taxonomy_id

        INNER JOIN wp_terms t
            ON tt.term_id = t.term_id

        LEFT JOIN wp_postmeta pm
            ON pm.post_id = p.ID
            AND pm.meta_key = '_thumbnail_id'

        LEFT JOIN wp_posts imagen
            ON imagen.ID = CAST(pm.meta_value AS UNSIGNED)
            AND imagen.post_type = 'attachment'

        WHERE p.ID = :id
          AND p.post_type = 'post'
          AND p.post_status = 'publish'
          AND tt.taxonomy = 'category'
          AND t.name = :categoria

        LIMIT 1
    ";
//echo $sql;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':categoria' => $categoria
    ]);

    $entrada = $stmt->fetch();

    if ($entrada) {

        // Recuperar categorías
        $sql = "
            SELECT DISTINCT t.name
            FROM wp_terms t
            INNER JOIN wp_term_taxonomy tt
                ON t.term_id = tt.term_id
            INNER JOIN wp_term_relationships tr
                ON tt.term_taxonomy_id = tr.term_taxonomy_id
            WHERE tr.object_id = :id
              AND tt.taxonomy = 'category'
            ORDER BY t.name
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $categorias = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Recuperar etiquetas
        $sql = "
            SELECT DISTINCT t.name
            FROM wp_terms t
            INNER JOIN wp_term_taxonomy tt
                ON t.term_id = tt.term_id
            INNER JOIN wp_term_relationships tr
                ON tt.term_taxonomy_id = tr.term_taxonomy_id
            WHERE tr.object_id = :id
              AND tt.taxonomy = 'post_tag'
            ORDER BY t.name
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $etiquetas = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}

// ==========================================
// LISTADO DE ENTRADAS
// ==========================================

$sql = "
    SELECT
        p.ID,
        p.post_title,
        p.post_excerpt,
        p.post_content,
        p.post_date,
        p.post_name,
        imagen.guid AS imagen_destacada

    FROM wp_posts p

    INNER JOIN wp_term_relationships tr
        ON p.ID = tr.object_id

    INNER JOIN wp_term_taxonomy tt
        ON tr.term_taxonomy_id = tt.term_taxonomy_id

    INNER JOIN wp_terms t
        ON tt.term_id = t.term_id

    LEFT JOIN wp_postmeta pm
        ON pm.post_id = p.ID
        AND pm.meta_key = '_thumbnail_id'

    LEFT JOIN wp_posts imagen
        ON imagen.ID = CAST(pm.meta_value AS UNSIGNED)
        AND imagen.post_type = 'attachment'

    WHERE p.post_type = 'post'
      AND p.post_status = 'publish'
      AND tt.taxonomy = 'category'
      AND t.name = :categoria

    GROUP BY p.ID
    ORDER BY p.post_date DESC
    LIMIT 30
";
//echo $sql;
$stmt = $pdo->prepare($sql);
$stmt->execute([':categoria' => $categoria]);
$entradas = $stmt->fetchAll();

?>



<div class="container contenedor">

<?php if ($id): ?>

    <?php if ($entrada): ?>

        <!-- VISTA INDIVIDUAL -->

        <a href="medios.php" class="btn btn-outline-secondary mb-4">
            &larr; Regresar a las publicaciones
        </a>

        <article class="bg-white rounded-3 p-4 p-md-5 shadow-sm">

            <h1 class="mb-3">
                <?= escapar($entrada['post_title']) ?>
            </h1>

            <p class="fecha mb-4">
                Publicado el
                <?= date('d/m/Y', strtotime($entrada['post_date'])) ?>
            </p>

            <?php if ($entrada['imagen_destacada']): ?>
			<?php
				$imagen = wordpressMediaUrl($entrada['imagen_destacada']);
			?>
			
                <img
                    src="<?= escapar($imagen) ?>"
                    class="img-fluid rounded mb-4"
                    alt="<?= escapar($entrada['post_title']) ?>">
            <?php endif; ?>

            <div class="mb-4">

                <strong>Categorías:</strong>

                <?php foreach ($categorias as $cat): ?>
                    <span class="etiqueta">
                        <?= escapar($cat) ?>
                    </span>
                <?php endforeach; ?>

            </div>

            <?php if ($etiquetas): ?>
                <div class="mb-4">

                    <strong>Etiquetas:</strong>

                    <?php foreach ($etiquetas as $tag): ?>
                        <span class="etiqueta">
                            <?= escapar($tag) ?>
                        </span>
                    <?php endforeach; ?>

                </div>
            <?php endif; ?>

            <hr>

            <div class="contenido-noticia">
                <?= wordpressMediaUrl($entrada['post_content']) ?>
            </div>

        </article>

    <?php else: ?>

        <div class="alert alert-warning">
            No se encontró la entrada solicitada.
        </div>

        <a href="publicaiones.php" class="btn btn-primary">
            Regresar
        </a>

    <?php endif; ?>

<?php else: ?>

    <!-- VISTA DE LISTADO -->

    <header class="mb-5">
        <h1>Artículos Recientes</h1>

		<p class="text-secondary">
			Publicaciones del Instituto de Ciencias de la Atmósfera y Cambio Climático.
		</p>
    </header>

    <div class="row g-4">

        <?php foreach ($entradas as $noticia): ?>

            <?php
            $resumen = $noticia['post_excerpt'];

            if (empty($resumen)) {
                $resumen = strip_tags($noticia['post_content']);
                $resumen = mb_substr($resumen, 0, 180) . '...';
            }
			  

        $resumen = wordpressMediaUrl($resumen);
        $resumen = mb_substr($resumen, 0, 180) . '...';

        // Imagen destacada de esta noticia
        $imagen = wordpressMediaUrl($noticia['imagen_destacada']);
        ?>

								   
		  

            <div class="col-md-6 col-lg-4">


                <div class="card card-noticia">
					<?php if (!empty($imagen)): ?>
						<img
							src="<?= escapar($imagen) ?>"
							class="img-fluid rounded mb-4"
							alt="<?= escapar($noticia['post_title']) ?>">
					<?php endif; ?>

                    <div class="card-body d-flex flex-column">

                        <p class="fecha mb-2">
                            <?= date('d/m/Y', strtotime($noticia['post_date'])) ?>
                        </p>



                        <h5 class="card-title">
                            <?= escapar($noticia['post_title']) ?>
                        </h5>

                        <p class="card-text">
                            <?= escapar($resumen) ?>
                        </p>

                        <a
                            href="publicaciones.php?id=<?= (int)$noticia['ID'] ?>"
                            class="btn btn-primary mt-auto">
                            Leer Artículo						 									 											
                        </a>
                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>
<?php endif; ?>

</div>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
