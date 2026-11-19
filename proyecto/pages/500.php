<?php
// Indico la imagen o el GIF que quiero mostrar en esta página de error.
// Puedo cambiar la extensión por .png, .jpg o .webp si utilizo otro formato.
$imagenError = 'assets/img/error-404.gif';

// Compruebo si agregué el archivo para evitar mostrar una imagen rota.
$tieneImagenError = is_file(__DIR__ . '/../' . $imagenError);
?>

<!-- Presento el error dentro de la estructura compartida del sitio. -->
<section class="container py-5 text-center" aria-labelledby="titulo-error">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <p class="etiqueta mb-2">Error 500</p>
            <h1 id="titulo-error" class="display-6 fw-bold mb-3">No pudimos cargar las cabritas</h1>
            <p class="lead text-secondary mb-4">Tuvimos un problema al obtener los datos del catálogo. Podés volver a intentarlo en unos momentos.</p>

            <!-- Reservo un espacio para mi imagen o GIF y lo adapto al ancho disponible. -->
            <div class="mx-auto mb-4" style="max-width: 560px;">
                <?php if ($tieneImagenError): ?>
                    <img src="<?= escapar($imagenError) ?>"
                         class="img-fluid rounded-3 d-block mx-auto"
                         style="max-height: 360px; object-fit: contain;"
                         alt="Ilustración de la página de error 500">
                <?php else: ?>
                    <!-- Muestro este espacio de reemplazo hasta agregar mi archivo. -->
                    <div class="bg-light border rounded-3 p-4 d-flex flex-column align-items-center justify-content-center"
                         style="min-height: 260px;">
                        <span class="display-3 mb-3" aria-hidden="true">🐐</span>
                        <p class="fw-bold mb-1">Acá va nuestra cabrita</p>
                        <p class="small text-secondary mb-0">Espacio para una imagen o GIF</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Ofrezco accesos para continuar navegando después del error. -->
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="index.php?page=inicio" class="btn btn-campo px-4">Volver a intentar</a>
                <a href="index.php?page=contacto" class="btn btn-outline-secondary px-4">Ir a contacto</a>
            </div>
        </div>
    </div>
</section>
