<?php
// Este componente recibe un array $cabra desde el foreach del catálogo.
// La función escapar() está declarada en index.php.
$disponible = (bool) $cabra['disponible'];
$imagen = $cabra['imagen'];

// Solo mostramos imágenes locales dentro de assets/img; si faltan, usamos un reemplazo.
$imagenValida = preg_match('~\Aassets/img/[a-zA-Z0-9_/-]+\.(?:jpe?g|png|webp)\z~i', $imagen)
    && is_file(__DIR__ . '/../' . $imagen);
?>
<article class="card card-cabra h-100">
    <div class="position-relative">
        <?php if ($imagenValida): ?>
            <img src="<?= escapar($imagen) ?>" class="card-img-top foto-cabra"
                 alt="<?= escapar($cabra['nombre']) ?>, raza <?= escapar($cabra['raza']) ?>"
                 width="600" height="400" loading="lazy">
        <?php else: ?>
            <div class="foto-cabra foto-pendiente d-flex flex-column align-items-center justify-content-center">
                <span class="cabra-emoji" aria-hidden="true">🐐</span>
                <span class="small">Foto próximamente</span>
            </div>
        <?php endif; ?>

        <span class="badge estado-cabra <?= $disponible ? 'estado-disponible' : 'estado-reservada' ?>">
            <?= $disponible ? 'Disponible' : 'Reservada' ?>
        </span>
    </div>

    <div class="card-body d-flex flex-column p-4">
        <p class="small text-secondary mb-1"><?= escapar($cabra['raza']) ?></p>
        <h3 class="h4 card-title fw-bold mb-3"><?= escapar($cabra['nombre']) ?></h3>

        <dl class="small mb-3">
            <div class="d-flex justify-content-between gap-2 mb-2">
                <dt class="fw-normal text-secondary">Edad</dt>
                <dd class="mb-0"><?= (int) $cabra['edad_meses'] ?> <?= (int) $cabra['edad_meses'] === 1 ? 'mes' : 'meses' ?></dd>
            </div>
            <div class="d-flex justify-content-between gap-2">
                <dt class="fw-normal text-secondary">Aptitud de la raza</dt>
                <dd class="mb-0 text-end"><?= escapar($cabra['uso_principal']) ?></dd>
            </div>
        </dl>

        <p class="card-text small text-secondary mb-4"><?= escapar($cabra['descripcion']) ?></p>

        <div class="mt-auto border-top pt-3">
            <p class="precio h4 fw-bold mb-3">
                $ <?= number_format((float) $cabra['precio'], 0, ',', '.') ?>
                <span class="small fw-normal text-secondary">ARS</span>
            </p>

            <?php if ($disponible): ?>
                <a href="index.php?page=contacto&amp;cabra=<?= (int) $cabra['id'] ?>" class="btn btn-campo w-100">
                    Consultar<span class="visually-hidden"> por <?= escapar($cabra['nombre']) ?></span>
                </a>
            <?php else: ?>
                <button class="btn btn-outline-secondary w-100" type="button" disabled>No disponible</button>
            <?php endif; ?>
        </div>
    </div>
</article>
