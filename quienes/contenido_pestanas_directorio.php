<?php
// Carga de resultados. Las consultas están definidas en llamados.php.
$institucional = directorioConsultar($pdo, $sqlInstitucional);
$academicosDepartamentos = directorioConsultar($pdo, $sqlAcademicosDepartamentos);
$academicosUnidades = directorioConsultar($pdo, $sqlAcademicosUnidades);
$comisionesDirectorio = directorioConsultar($pdo, $sqlComisiones);
$administrativoAreas = directorioConsultar($pdo, $sqlAdministrativoAreas);
$administrativoSecretarias = directorioConsultar($pdo, $sqlAdministrativoSecretarias);
$administrativoUnidades = directorioConsultar($pdo, $sqlAdministrativoUnidades);
$administrativoDepartamentos = directorioConsultar($pdo, $sqlAdministrativoDepartamentos);
$administrativoGrupos = directorioConsultar($pdo, $sqlAdministrativoGrupos);

// Agrupación para presentar el personal bajo su departamento/unidad.
$departamentosAgrupados = [];
foreach ($academicosDepartamentos as $persona) {
    $departamentosAgrupados[$persona['id_departamento']]['nombre'] = $persona['departamento'];
    $departamentosAgrupados[$persona['id_departamento']]['personas'][] = $persona;
}
$unidadesAcademicasAgrupadas = [];
foreach ($academicosUnidades as $persona) {
    $unidadesAcademicasAgrupadas[$persona['id_unidades']]['nombre'] = $persona['unidad'];
    $unidadesAcademicasAgrupadas[$persona['id_unidades']]['personas'][] = $persona;
}

// Agrupación de comisiones en el orden definido por comites_comisiones.ic_cc.
$comisionesAgrupadas = [];
foreach ($comisionesDirectorio as $filaComision) {
    $idComision = $filaComision['id_comision'];
    if (!isset($comisionesAgrupadas[$idComision])) {
        $comisionesAgrupadas[$idComision] = [
            'nombre' => $filaComision['comision'],
            'descripcion' => $filaComision['descripcion'],
            'enlace' => $filaComision['enlace'],
            'correo' => $filaComision['correo_comision'],
            'telefono' => $filaComision['telefono_comision'],
            'personas' => [],
        ];
    }
    if (!empty($filaComision['id_personal'])) {
        $comisionesAgrupadas[$idComision]['personas'][$filaComision['id_personal']] = $filaComision;
    }
}

// Agrupación administrativa por área del organigrama.
$administrativoAreasAgrupadas = [];
foreach ($administrativoAreas as $persona) {
    $key = $persona['id_organigrama'];
    $administrativoAreasAgrupadas[$key]['nombre'] = $persona['area'];
    $administrativoAreasAgrupadas[$key]['personas'][] = $persona;
}

// Agrupación administrativa: primero secretaría/área, después subtipo y departamento.
$administrativoSecretariasAgrupado = [];
foreach ($administrativoSecretarias as $persona) {
    $key = $persona['id_secretarias'];
    $subtipo = $persona['subtipo_area'] ?: 'Sin subtipo especificado';
    $depto = $persona['departamento_secretaria'] ?: 'Sin departamento especificado';
    $administrativoSecretariasAgrupado[$key]['area'] = $persona['area'];
    $administrativoSecretariasAgrupado[$key]['nombre'] = $persona['secretaria'];
    $administrativoSecretariasAgrupado[$key]['tipo'] = $persona['tipo_secretaria'];
    $administrativoSecretariasAgrupado[$key]['subtipos'][$subtipo]['departamentos'][$depto][] = $persona;
}
$administrativoUnidadesAgrupado = [];
foreach ($administrativoUnidades as $persona) {
    $key = $persona['id_unidades'];
    $subtipo = $persona['subtipo_area'] ?: '';
    $administrativoUnidadesAgrupado[$key]['area'] = $persona['area'];
    $administrativoUnidadesAgrupado[$key]['nombre'] = $persona['unidad'];
    $administrativoUnidadesAgrupado[$key]['tipo'] = $persona['tipo_unidad'];
    $administrativoUnidadesAgrupado[$key]['subtipos'][$subtipo][] = $persona;
}

// Agrupación del personal administrativo adscrito a departamentos y grupos.
$administrativoDepartamentosAgrupados = [];
foreach ($administrativoDepartamentos as $persona) {
    $key = $persona['id_departamento'];
    $administrativoDepartamentosAgrupados[$key]['nombre'] = $persona['departamento'];
    $administrativoDepartamentosAgrupados[$key]['personas'][] = $persona;
}
$administrativoGruposAgrupados = [];
foreach ($administrativoGrupos as $persona) {
    $key = $persona['id_grupo'];
    $administrativoGruposAgrupados[$key]['nombre'] = $persona['grupo'];
    $administrativoGruposAgrupados[$key]['personas'][] = $persona;
}

// Agrupar al personal administrativo por cargo, respetando la prioridad indicada.
foreach ($administrativoAreasAgrupadas as &$grupoArea) {
    $grupoArea['cargos'] = directorioAgruparPorCargo($grupoArea['personas']);
}
unset($grupoArea);
foreach ($administrativoSecretariasAgrupado as &$grupoSecretaria) {
    $grupoSecretaria['subtipos'] = directorioOrdenarSubareasSecretaria(
        $grupoSecretaria['subtipos'],
        trim($grupoSecretaria['area'] . ' ' . $grupoSecretaria['nombre'])
    );
    foreach ($grupoSecretaria['subtipos'] as $nombreSubtipo => &$grupoSubtipo) {
        // Unificar los registros de todos los departamentos internos de la
        // subárea antes de ordenar los cargos. Así el jefe de Presupuesto,
        // Adquisiciones o Recursos Humanos aparece al inicio de su organigrama
        // y no aislado al final en un bloque de departamento.
        $personasSubtipo = [];
        foreach ($grupoSubtipo['departamentos'] as $personasDepartamento) {
            foreach ($personasDepartamento as $persona) {
                $personasSubtipo[] = $persona;
            }
        }
        $grupoSubtipo['cargos'] = directorioAgruparPorCargoSecretaria(
            $personasSubtipo,
            trim($grupoSecretaria['area'] . ' ' . $grupoSecretaria['nombre']),
            $nombreSubtipo,
            ''
        );
        unset($grupoSubtipo['departamentos']);
    }
    unset($grupoSubtipo);
}
unset($grupoSecretaria);
foreach ($administrativoUnidadesAgrupado as &$grupoUnidad) {
    foreach ($grupoUnidad['subtipos'] as &$grupoSubtipoUnidad) {
        $grupoSubtipoUnidad = directorioAgruparPorCargo($grupoSubtipoUnidad);
    }
    unset($grupoSubtipoUnidad);
}
unset($grupoUnidad);
foreach ($administrativoDepartamentosAgrupados as &$grupoDepartamentoAdmin) {
    $grupoDepartamentoAdmin['cargos'] = directorioAgruparPorCargo($grupoDepartamentoAdmin['personas']);
}
unset($grupoDepartamentoAdmin);
foreach ($administrativoGruposAgrupados as &$grupoGrupoAdmin) {
    $grupoGrupoAdmin['cargos'] = directorioAgruparPorCargo($grupoGrupoAdmin['personas']);
}
unset($grupoGrupoAdmin);

?>

<!-- =============================================
     INSTITUCIONAL
============================================== -->
<div class="tab-pane fade show active" id="nav-institucional" role="tabpanel" aria-labelledby="nav-institucional-tab" tabindex="0">
    <div class="d-grid gap-3 mt-3">
        <?php if (!$institucional): ?>
            <div class="alert alert-light border">No hay responsables institucionales registrados.</div>
        <?php else: ?>
            <?php foreach ($institucional as $persona): ?>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="text-success small fw-semibold text-uppercase">
                            <?= directorioE($persona['area_organigrama']); ?>
                        </div>
                        <h5 class="card-title mt-1 mb-1"><?= directorioE($persona['nombre_area']); ?></h5>
                        <?php if (!empty($persona['tipo'])): ?>
                            <div class="text-muted small mb-2">Tipo: <?= directorioE($persona['tipo']); ?></div>
                        <?php endif; ?>
                        <div class="fw-semibold"><?= directorioE($persona['cargo']); ?></div>
                        <div><?= directorioE($persona['nombre']); ?></div>
                        <?php directorioContacto($persona); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- =============================================
     ACADÉMICOS
============================================== -->
<div class="tab-pane fade" id="nav-academico" role="tabpanel" aria-labelledby="nav-academico-tab" tabindex="0">
    <div class="mt-3">
        <h3 class="h4 mb-3">Departamentos</h3>
        <?php if (!$departamentosAgrupados): ?>
            <div class="alert alert-light border">No hay personal académico relacionado con departamentos.</div>
        <?php else: ?>
            <div class="accordion mb-4" id="accordionDepartamentos">
                <?php $i = 0; foreach ($departamentosAgrupados as $departamento): $i++; ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingDepartamento<?= $i; ?>">
                            <button class="accordion-button <?= $i === 1 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDepartamento<?= $i; ?>" aria-expanded="<?= $i === 1 ? 'true' : 'false'; ?>" aria-controls="collapseDepartamento<?= $i; ?>">
                                <?= directorioE($departamento['nombre']); ?>
                            </button>
                        </h2>
                        <div id="collapseDepartamento<?= $i; ?>" class="accordion-collapse collapse <?= $i === 1 ? 'show' : ''; ?>" aria-labelledby="headingDepartamento<?= $i; ?>" data-bs-parent="#accordionDepartamentos">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    <?php foreach ($departamento['personas'] as $persona): ?>
                                        <div class="col-12 col-lg-6">
                                            <div class="border rounded p-3 h-100 d-flex gap-3 align-items-start">
                                                <img
                                                    src="<?= directorioE(directorioFotoAcademico($persona['foto'] ?? '')); ?>"
                                                    alt="Fotografía de <?= directorioE($persona['nombre']); ?>"
                                                    class="rounded flex-shrink-0"
                                                    style="width: 88px; height: 88px; object-fit: cover;"
                                                    loading="lazy"
                                                    onerror="this.onerror=null;this.src='<?= BASE_URL ?>assets/img/avatar.png';"
                                                >
                                                <div class="flex-grow-1 min-w-0">
                                                   
													  <a
														href="../investigadores/perfil.php?id=<?= directorioE($persona['id_personal']);?>"
														class="text-decoration-none">
                                                    <div class="fw-semibold"><?= directorioE($persona['nombre']); ?></div>
													</a>
                                                    <?php if (!empty($persona['es_responsable'])): ?>
                                                        <span class="badge text-bg-success mb-1">Responsable</span>
                                                    <?php endif; ?>
                                                    <div class="small text-muted">
                                                        <?= directorioE($persona['categoria']); ?>
                                                        <?= !empty($persona['nivel']) ? ' · ' . directorioE($persona['nivel']) : ''; ?>
                                                        <?= !empty($persona['subnivel']) ? ' · ' . directorioE($persona['subnivel']) : ''; ?>
                                                    </div>
                                                    <?php if (!empty($persona['grupos'])): ?>
                                                        <div class="small mt-1"><strong>Grupo:</strong> <?= directorioE($persona['grupos']); ?></div>
                                                    <?php endif; ?>
                                                    <?php directorioContacto($persona); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <h3 class="h4 mb-3">Unidades</h3>
        <?php if (!$unidadesAcademicasAgrupadas): ?>
            <div class="alert alert-light border">No hay personal académico relacionado con unidades.</div>
        <?php else: ?>
            <div class="accordion" id="accordionUnidadesAcademicas">
                <?php $j = 0; foreach ($unidadesAcademicasAgrupadas as $unidad): $j++; ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingUnidadAcademica<?= $j; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUnidadAcademica<?= $j; ?>" aria-expanded="false" aria-controls="collapseUnidadAcademica<?= $j; ?>">
                                <?= directorioE($unidad['nombre']); ?>
                            </button>
                        </h2>
                        <div id="collapseUnidadAcademica<?= $j; ?>" class="accordion-collapse collapse" aria-labelledby="headingUnidadAcademica<?= $j; ?>" data-bs-parent="#accordionUnidadesAcademicas">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    <?php foreach ($unidad['personas'] as $persona): ?>
                                        <div class="col-12 col-lg-6">
                                            <div class="border rounded p-3 h-100 d-flex gap-3 align-items-start">
                                                <img
                                                    src="<?= directorioE(directorioFotoAcademico($persona['foto'] ?? '')); ?>"
                                                    alt="Fotografía de <?= directorioE($persona['nombre']); ?>"
                                                    class="rounded flex-shrink-0"
                                                    style="width: 88px; height: 88px; object-fit: cover;"
                                                    loading="lazy"
                                                    onerror="this.onerror=null;this.src='/assets/img/avatar.png';"
                                                >
                                                <div class="flex-grow-1 min-w-0">
                                                    <div class="fw-semibold"><?= directorioE($persona['nombre']); ?></div>
                                                    <?php if (!empty($persona['es_responsable'])): ?>
                                                        <span class="badge text-bg-success mb-1">Responsable</span>
                                                    <?php endif; ?>
                                                    <div class="small text-muted">
                                                        <?= directorioE($persona['categoria']); ?>
                                                        <?= !empty($persona['nivel']) ? ' · ' . directorioE($persona['nivel']) : ''; ?>
                                                        <?= !empty($persona['subnivel']) ? ' · ' . directorioE($persona['subnivel']) : ''; ?>
                                                    </div>
                                                    <?php if (!empty($persona['grupos'])): ?>
                                                        <div class="small mt-1"><strong>Grupo:</strong> <?= directorioE($persona['grupos']); ?></div>
                                                    <?php endif; ?>
                                                    <?php directorioContacto($persona); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- =============================================
     ADMINISTRATIVO
============================================== -->
<div class="tab-pane fade" id="nav-administrativo" role="tabpanel" aria-labelledby="nav-administrativo-tab" tabindex="0">
    <div class="mt-3">
        <div class="accordion" id="accordionAdministrativo">

            <!-- DIRECCIÓN: concentra las áreas del organigrama -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingAdminDireccion">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdminDireccion" aria-expanded="true" aria-controls="collapseAdminDireccion">
                        Dirección
                    </button>
                </h2>
                <div id="collapseAdminDireccion" class="accordion-collapse collapse show" aria-labelledby="headingAdminDireccion" data-bs-parent="#accordionAdministrativo">
                    <div class="accordion-body">
                        <?php if (!$administrativoAreasAgrupadas): ?>
                            <div class="alert alert-light border mb-0">No hay personal administrativo relacionado directamente con áreas del organigrama.</div>
                        <?php else: ?>
                            <?php foreach ($administrativoAreasAgrupadas as $area): ?>
                                <section class="mb-4">
                                    <h4 class="h5 border-bottom pb-2"><?= directorioE($area['nombre']); ?></h4>
                                    <?php foreach ($area['cargos'] as $nombreCargo => $personasCargo): ?>
                                        <h5 class="h6 text-success mt-3"><?= directorioE($nombreCargo); ?></h5>
                                        <div class="row g-3">
                                            <?php foreach ($personasCargo as $persona): ?>
                                                <div class="col-12 col-lg-6">
                                                    <div class="border rounded p-3 h-100">
                                                        <div><?= directorioE($persona['nombre']); ?></div>
                                                        <?php directorioContacto($persona); ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </section>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- UN ACORDEÓN POR SECRETARÍA -->
            <?php if (!$administrativoSecretariasAgrupado): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingAdminSecretariasVacio">
                        <button class="accordion-button collapsed" type="button" disabled>Secretarías</button>
                    </h2>
                    <div class="accordion-body"><div class="text-muted">No hay personal administrativo relacionado con secretarías.</div></div>
                </div>
            <?php else: ?>
                <?php $iSecretaria = 0; foreach ($administrativoSecretariasAgrupado as $secretaria): $iSecretaria++; ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingAdminSecretaria<?= $iSecretaria; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdminSecretaria<?= $iSecretaria; ?>" aria-expanded="false" aria-controls="collapseAdminSecretaria<?= $iSecretaria; ?>">
                                <?= directorioE($secretaria['nombre']); ?>
                                <?php if (!empty($secretaria['tipo'])): ?><span class="small text-muted ms-2">(<?= directorioE($secretaria['tipo']); ?>)</span><?php endif; ?>
                            </button>
                        </h2>
                        <div id="collapseAdminSecretaria<?= $iSecretaria; ?>" class="accordion-collapse collapse" aria-labelledby="headingAdminSecretaria<?= $iSecretaria; ?>" data-bs-parent="#accordionAdministrativo">
                            <div class="accordion-body">
                              
                                <?php foreach ($secretaria['subtipos'] as $subtipo => $datosSubtipo): ?>
                                    <h5 class="h6 text-success mt-3"><?php if (directorioE($subtipo) !== 'Sin subtipo especificado'){ directorioE($subtipo); } else {  } ?></h5>

                                    <?php foreach ($datosSubtipo['cargos'] as $nombreCargo => $personasCargo): ?>
                                        <?php
                                        // Agrupar por departamento dentro de cada cargo.
                                        // Así se conserva exactamente el orden de cargos
                                        // definido previamente por directorioAgruparPorCargoSecretaria().
                                        $personasPorDepartamento = [];

                                        foreach ($personasCargo as $persona) {
                                            $nombreDepartamento = trim($persona['departamento_secretaria'] ?? '');
                                            $personasPorDepartamento[$nombreDepartamento][] = $persona;
                                        }

                                        $etiquetaCargo = directorioEtiquetaCargoSecretaria($nombreCargo, $subtipo);
                                        ?>

                                        <?php foreach ($personasPorDepartamento as $nombreDepartamento => $personasDepartamento): ?>
                                            <?php if ($nombreDepartamento !== ''): ?>
                                                <div class="fw-semibold mb-2 ms-2">Departamento de <?= directorioE($nombreDepartamento); ?></div>
                                            <?php endif; ?>

                                            <h6 class="text-success mt-3"><?= directorioE($etiquetaCargo); ?><?php if ($nombreDepartamento !== ''): ?> de <?php endif; ?><?= directorioE($nombreDepartamento); ?></h6>
                                            <div class="row g-3">
                                                <?php foreach ($personasDepartamento as $persona): ?>
                                                    <div class="col-12 col-lg-6">
                                                        <div class="border rounded p-3 h-100">
                                                            <div><?= directorioE($persona['nombre']); ?></div>
                                                            <?php directorioContacto($persona); ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- UN ACORDEÓN POR DEPARTAMENTO -->
            <?php if (!$administrativoDepartamentosAgrupados): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingAdminDepartamentosVacio"><button class="accordion-button collapsed" type="button" disabled>Departamentos</button></h2>
                    <div class="accordion-body"><div class="text-muted">No hay personal administrativo relacionado con departamentos.</div></div>
                </div>
            <?php else: ?>
                <?php $iDepartamentoAdmin = 0; foreach ($administrativoDepartamentosAgrupados as $departamentoAdmin): $iDepartamentoAdmin++; ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingAdminDepartamento<?= $iDepartamentoAdmin; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdminDepartamento<?= $iDepartamentoAdmin; ?>" aria-expanded="false" aria-controls="collapseAdminDepartamento<?= $iDepartamentoAdmin; ?>">
                                <?= directorioE($departamentoAdmin['nombre']); ?>
                            </button>
                        </h2>
                        <div id="collapseAdminDepartamento<?= $iDepartamentoAdmin; ?>" class="accordion-collapse collapse" aria-labelledby="headingAdminDepartamento<?= $iDepartamentoAdmin; ?>" data-bs-parent="#accordionAdministrativo">
                            <div class="accordion-body">
                                <?php foreach ($departamentoAdmin['cargos'] as $nombreCargo => $personasCargo): ?>
                                    <h5 class="h6 text-success mt-3"><?= directorioE($nombreCargo); ?></h5>
                                    <div class="row g-3">
                                        <?php foreach ($personasCargo as $persona): ?>
                                            <div class="col-12 col-lg-6"><div class="border rounded p-3 h-100"><div><?= directorioE($persona['nombre']); ?></div><?php directorioContacto($persona); ?></div></div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- ACORDEÓN GENERAL DE GRUPOS CON UN ACORDEÓN INTERNO POR CADA GRUPO -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingAdminGrupos">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdminGrupos" aria-expanded="false" aria-controls="collapseAdminGrupos">
                        Grupos
                    </button>
                </h2>
                <div id="collapseAdminGrupos" class="accordion-collapse collapse" aria-labelledby="headingAdminGrupos" data-bs-parent="#accordionAdministrativo">
                    <div class="accordion-body">
                        <?php if (!$administrativoGruposAgrupados): ?>
                            <div class="text-muted">No hay personal administrativo relacionado con grupos.</div>
                        <?php else: ?>
                            <div class="accordion" id="accordionAdminGruposInterno">
                                <?php $iGrupoAdmin = 0; foreach ($administrativoGruposAgrupados as $grupoAdmin): $iGrupoAdmin++; ?>
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="headingAdminGrupo<?= $iGrupoAdmin; ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdminGrupo<?= $iGrupoAdmin; ?>" aria-expanded="false" aria-controls="collapseAdminGrupo<?= $iGrupoAdmin; ?>">
                                                <?= directorioE($grupoAdmin['nombre']); ?>
                                            </button>
                                        </h3>
                                        <div id="collapseAdminGrupo<?= $iGrupoAdmin; ?>" class="accordion-collapse collapse" aria-labelledby="headingAdminGrupo<?= $iGrupoAdmin; ?>" data-bs-parent="#accordionAdminGruposInterno">
                                            <div class="accordion-body">
                                                <?php foreach ($grupoAdmin['cargos'] as $nombreCargo => $personasCargo): ?>
                                                    <h5 class="h6 text-success mt-3"><?= directorioE($nombreCargo); ?></h5>
                                                    <div class="row g-3">
                                                        <?php foreach ($personasCargo as $persona): ?>
                                                            <div class="col-12 col-lg-6"><div class="border rounded p-3 h-100"><div><?= directorioE($persona['nombre']); ?></div><?php directorioContacto($persona); ?></div></div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ACORDEÓN GENERAL DE UNIDADES CON UN ACORDEÓN INTERNO POR CADA UNIDAD -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingAdminUnidades">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdminUnidades" aria-expanded="false" aria-controls="collapseAdminUnidades">
                        Unidades de Apoyo
                    </button>
                </h2>
                <div id="collapseAdminUnidades" class="accordion-collapse collapse" aria-labelledby="headingAdminUnidades" data-bs-parent="#accordionAdministrativo">
                    <div class="accordion-body">
                        <?php if (!$administrativoUnidadesAgrupado): ?>
                            <div class="text-muted">No hay personal administrativo relacionado con unidades.</div>
                        <?php else: ?>
                            <div class="accordion" id="accordionAdminUnidadesInterno">
                                <?php $iUnidadAdmin = 0; foreach ($administrativoUnidadesAgrupado as $unidad): $iUnidadAdmin++; ?>
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="headingAdminUnidad<?= $iUnidadAdmin; ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdminUnidad<?= $iUnidadAdmin; ?>" aria-expanded="false" aria-controls="collapseAdminUnidad<?= $iUnidadAdmin; ?>">
                                                <?= directorioE($unidad['nombre']); ?>
                                                
                                            </button>
                                        </h3>
                                        <div id="collapseAdminUnidad<?= $iUnidadAdmin; ?>" class="accordion-collapse collapse" aria-labelledby="headingAdminUnidad<?= $iUnidadAdmin; ?>" data-bs-parent="#accordionAdminUnidadesInterno">
                                            <div class="accordion-body">
                                           
                                                <?php foreach ($unidad['subtipos'] as $subtipo => $personas): ?>
                                                    <h5 class="h6 text-success mt-3"><?= directorioE($subtipo); ?></h5>
                                                    <?php foreach ($personas as $nombreCargo => $personasCargo): ?>
                                                        <h6 class="text-success mt-3"><?= directorioE($nombreCargo); ?></h6>
                                                        <div class="row g-3">
                                                            <?php foreach ($personasCargo as $persona): ?>
                                                                <div class="col-12 col-lg-6"><div class="border rounded p-3 h-100"><div><?= directorioE($persona['nombre']); ?></div><?php directorioContacto($persona); ?></div></div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- =============================================
     COMISIONES Y COMITÉS
============================================== -->
<div class="tab-pane fade" id="nav-comisiones" role="tabpanel" aria-labelledby="nav-comisiones-tab" tabindex="0">
    <div class="mt-3">
        <?php if (!$comisionesAgrupadas): ?>
            <div class="alert alert-light border">No hay comisiones o comités activos registrados.</div>
        <?php else: ?>
            <div class="accordion" id="accordionComisiones">
                <?php $indiceComision = 0; foreach ($comisionesAgrupadas as $comision): $indiceComision++; ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingComision<?= $indiceComision; ?>">
                            <button class="accordion-button <?= $indiceComision === 1 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComision<?= $indiceComision; ?>" aria-expanded="<?= $indiceComision === 1 ? 'true' : 'false'; ?>" aria-controls="collapseComision<?= $indiceComision; ?>">
                                <?= directorioE($comision['nombre']); ?>
                            </button>
                        </h2>
                        <div id="collapseComision<?= $indiceComision; ?>" class="accordion-collapse collapse <?= $indiceComision === 1 ? 'show' : ''; ?>" aria-labelledby="headingComision<?= $indiceComision; ?>" data-bs-parent="#accordionComisiones">
                            <div class="accordion-body">
                                <?php if (!empty($comision['descripcion'])): ?>
                                    <p><?= nl2br(directorioE($comision['descripcion'])); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($comision['personas'])): ?>
                                    <div class="row g-3">
                                        <?php foreach ($comision['personas'] as $integrante): ?>
                                            <div class="col-12 col-md-6">
                                                <div class="border rounded p-3 h-100">
                                                    <?php if (!empty($integrante['grado_academico'])): ?>
                                                        <span class="text-muted small fw-semibold"><?= directorioE(directorioAbreviarGrado($integrante['grado_academico'])); ?></span>
                                                    <?php endif; ?>
                                                    <div class="fw-semibold"><?= directorioE($integrante['nombre']); ?></div>
                                                    <?php if (!empty($integrante['correo_persona'])): ?>
                                                        <div class="small mt-1">
                                                            <a href="mailto:<?= directorioE($integrante['correo_persona']); ?>"><?= directorioE($integrante['correo_persona']); ?></a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted mb-0">No hay integrantes registrados para esta comisión.</p>
                                <?php endif; ?>
                                <?php if (!empty($comision['correo']) || !empty($comision['telefono']) || !empty($comision['enlace'])): ?>
                                    <div class="small text-muted mt-3">
                                        <?php if (!empty($comision['telefono'])): ?><span class="me-3">Tel. <?= directorioE($comision['telefono']); ?></span><?php endif; ?>
                                        <?php if (!empty($comision['correo'])): ?><a class="me-3" href="mailto:<?= directorioE($comision['correo']); ?>"><?= directorioE($comision['correo']); ?></a><?php endif; ?>
                                        <?php if (!empty($comision['enlace'])): ?><a href="<?= directorioE($comision['enlace']); ?>" target="_blank" rel="noopener">Más información</a><?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
