<?php
// Recibo un objeto Cabra desde el foreach del catálogo.
// Uso sus getters para acceder a los atributos privados.
// Los getters de texto ya preparan sus valores para mostrarlos en HTML.
// Consulto la disponibilidad y la convierto en un valor booleano.
$disponible = (bool) $cabra->getDisponible();
// Obtengo la ruta de la imagen que tengo guardada en la base de datos.
$imagen = $cabra->getImagen();

// Compruebo que la imagen sea local, esté dentro de assets/img y exista.
$imagenValida = preg_match('~\Aassets/img/[a-zA-Z0-9_/-]+\.(?:jpe?g|png|webp)\z~i', $imagen)
    && is_file(__DIR__ . '/../' . $imagen);
?>
<!-- Muestro una tarjeta con la información de esta cabrita. -->
<article class="card card-cabra h-100">
    <div class="position-relative">
        <!-- Muestro la foto si existe; en caso contrario, uso un reemplazo. -->
        <?php if ($imagenValida): ?>
            <img src="<?= $imagen ?>" class="card-img-top foto-cabra"
                 alt="<?= $cabra->getNombre() ?>, raza <?= $cabra->getRaza() ?>"
                 width="600" height="400" loading="lazy">
        <?php else: ?>
            <div class="foto-cabra foto-pendiente d-flex flex-column align-items-center justify-content-center">
                <span class="cabra-emoji" aria-hidden="true">🐐</span>
                <span class="small">Foto próximamente</span>
            </div>
        <?php endif; ?>

        <!-- Indico si la cabrita está disponible o reservada. -->
        <span class="badge estado-cabra <?= $disponible ? 'estado-disponible' : 'estado-reservada' ?>">
            <?= $disponible ? 'Disponible' : 'Reservada' ?>
        </span>
    </div>

    <!-- Muestro la raza, el nombre, la edad, la aptitud y la descripción. -->
    <div class="card-body d-flex flex-column p-4">
        <p class="small text-secondary mb-1"><?= $cabra->getRaza() ?></p>
        <h3 class="h4 card-title fw-bold mb-3"><?= $cabra->getNombre() ?></h3>

        <dl class="small mb-3">
            <div class="d-flex justify-content-between gap-2 mb-2">
                <dt class="fw-normal text-secondary">Edad</dt>
                <dd class="mb-0"><?= (int) $cabra->getEdadMeses() ?> <?= (int) $cabra->getEdadMeses() === 1 ? 'mes' : 'meses' ?></dd>
            </div>
            <div class="d-flex justify-content-between gap-2">
                <dt class="fw-normal text-secondary">Aptitud de la raza</dt>
                <dd class="mb-0 text-end"><?= $cabra->getUsoPrincipal() ?></dd>
            </div>
        </dl>

        <p class="card-text small text-secondary mb-4"><?= $cabra->getDescripcion() ?></p>

        <div class="mt-auto border-top pt-3">
            <!-- Formateo el precio en pesos argentinos con separador de miles. -->
            <p class="precio h4 fw-bold mb-3">
                $ <?= number_format((float) $cabra->getPrecio(), 0, ',', '.') ?>
                <span class="small fw-normal text-secondary">ARS</span>
            </p>

            <!-- Habilito la consulta solamente si la cabrita está disponible. -->
            <?php if ($disponible): ?>
                <a href="index.php?page=contacto&amp;cabra=<?= (int) $cabra->getId() ?>" class="btn btn-campo w-100">
                    Consultar<span class="visually-hidden"> por <?= $cabra->getNombre() ?></span>
                </a>
            <?php else: ?>
                <button class="btn btn-outline-secondary w-100" type="button" disabled>No disponible</button>
            <?php endif; ?>
        </div>
    </div>
</article>
