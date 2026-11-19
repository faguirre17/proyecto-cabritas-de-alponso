<?php
// Preparo un bloque reutilizable para mostrar cada foto o reservar su espacio.
$mostrarImagenNosotros = function ($archivo, $alt, $proporcion, $clases = '', $carga = 'lazy') {
    // Busco la imagen dentro de la carpeta de Nosotros.
    $ruta = 'assets/img/nosotros/' . $archivo;
    $existe = is_file(__DIR__ . '/../' . $ruta);
    ?>
    <div class="ratio <?= escapar($proporcion) ?> bg-light overflow-hidden <?= escapar($clases) ?>">
        <?php if ($existe): ?>
            <!-- Ajusto la foto al espacio disponible con las clases de Bootstrap. -->
            <img src="<?= escapar($ruta) ?>"
                 alt="<?= escapar($alt) ?>"
                 class="w-100 h-100 object-fit-cover"
                 loading="<?= escapar($carga) ?>">
        <?php else: ?>
            <!-- Reservo el espacio hasta agregar el archivo. -->
            <div class="d-flex align-items-center justify-content-center border text-secondary"
                 aria-hidden="true">
                <span class="fs-2">🐐</span>
            </div>
        <?php endif; ?>
    </div>
    <?php
};
?>

<!-- Presento la identidad del emprendimiento ficticio y el propósito del catálogo. -->
<section class="bienvenida py-5" aria-labelledby="titulo-nosotros">
    <div class="container">
        <p class="etiqueta mb-3">Nuestro pequeño campo</p>
        <h1 id="titulo-nosotros" class="display-5 fw-bold mb-3">Somos Cabritas de Alponso</h1>
        <p class="lead text-secondary mb-0 col-lg-9">Un proyecto pensado para acercarte al mundo de las cabritas y ayudarte a conocer sus razas, características y aptitudes antes de elegir.</p>
        <!-- Ubico el banner principal debajo de la presentación. -->
        <?php $mostrarImagenNosotros('banner-nosotros.png', 'Cabritas de Alponso en el campo', 'ratio-21x9', 'rounded-3 mt-4', 'eager'); ?>
    </div>
</section>

<!-- Cuento qué ofrecemos y cómo se utiliza nuestro catálogo. -->
<section class="container py-5" aria-labelledby="titulo-proyecto">
    <div class="row g-4 align-items-start">
        <div class="col-lg-7">
            <p class="etiqueta mb-2">Pequeñas cabritas, grandes comienzos</p>
            <h2 id="titulo-proyecto" class="fw-bold mb-3">Conocer también es cuidar</h2>
            <p>Cabritas de Alponso es un pequeño emprendimiento de venta de cabritas. Nuestro catálogo reúne ejemplares de distintas razas, con su edad, precio, disponibilidad y una descripción de sus características.</p>
            <p class="text-secondary mb-0">Queremos que puedas comparar opciones y encontrar información clara, tanto si te interesa la crianza como si estás explorando un proyecto de leche, fibra, producción de carne o compañía. Desde cada tarjeta podés acceder al formulario de contacto e indicar qué cabrita te interesa.</p>
        </div>
        <div class="col-lg-5">
            <!-- Coloco la imagen de cuidado encima de Nuestra propuesta. -->
            <?php $mostrarImagenNosotros('conocer-es-cuidar.png', 'Una cabrita en un entorno de crianza', 'ratio-4x3', 'rounded-3 mb-3'); ?>
            <div class="card border-0 shadow-sm p-4">
                <h3 class="h5 fw-bold mb-3">Nuestra propuesta</h3>
                <ul class="text-secondary mb-0 ps-3">
                    <li class="mb-2">Información sencilla sobre cada ejemplar.</li>
                    <li class="mb-2">Precios y disponibilidad en un mismo lugar.</li>
                    <li class="mb-2">Una guía para entender las aptitudes de las razas.</li>
                    <li>Un espacio de contacto para plantear tus consultas.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Explico las razas presentes en el catálogo y sus usos habituales. -->
<section class="container pb-5" aria-labelledby="titulo-razas">
    <p class="etiqueta mb-2">Una raza para cada proyecto</p>
    <h2 id="titulo-razas" class="fw-bold mb-3">Conocé nuestras razas</h2>
    <p class="text-secondary mb-4">Las aptitudes describen usos habituales en la etapa adulta. No garantizan el rendimiento de un ejemplar ni significan que una cabrita bebé ya produzca leche o esté lista para reproducirse.</p>
    <!-- Muestro una imagen general antes de las tarjetas de razas. -->
    <?php $mostrarImagenNosotros('banner-razas.png', 'Cabras de distintas razas en el campo', 'ratio-21x9', 'rounded-3 mb-4'); ?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <!-- Presento la raza Saanen y explico su aptitud principal. -->
        <div class="col">
            <article class="card card-cabra h-100">
                <?php $mostrarImagenNosotros('saanen.png', 'Ejemplar de raza Saanen', 'ratio-4x3', 'rounded-top'); ?>
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">Saanen</h3>
                    <p class="small fw-bold text-success mb-3">Leche</p>
                    <p class="text-secondary mb-0">Es una raza lechera, generalmente de pelaje blanco o crema y orejas erguidas. Su aptitud principal es la producción de leche; es una de las opciones para proyectos de lechería caprina.</p>
                </div>
            </article>
        </div>
        <!-- Presento la raza Alpina y explico su aptitud principal. -->
        <div class="col">
            <article class="card card-cabra h-100">
                <?php $mostrarImagenNosotros('alpina.png', 'Ejemplar de raza Alpina', 'ratio-4x3', 'rounded-top'); ?>
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">Alpina</h3>
                    <p class="small fw-bold text-success mb-3">Leche</p>
                    <p class="text-secondary mb-0">Es una raza lechera que presenta distintos colores y combinaciones de pelaje. Se utiliza principalmente para producir leche y forma parte de las razas habituales de los tambos caprinos.</p>
                </div>
            </article>
        </div>
        <!-- Presento la raza Anglo Nubian y explico su aptitud principal. -->
        <div class="col">
            <article class="card card-cabra h-100">
                <?php $mostrarImagenNosotros('anglo-nubian.png', 'Ejemplar de raza Anglo Nubian', 'ratio-4x3', 'rounded-top'); ?>
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">Anglo Nubian</h3>
                    <p class="small fw-bold text-success mb-3">Leche y doble propósito</p>
                    <p class="text-secondary mb-0">Se reconoce por sus orejas largas y caídas y su perfil facial convexo. Se utiliza para leche y también en sistemas de doble propósito, orientados a leche y carne.</p>
                </div>
            </article>
        </div>
        <!-- Presento la raza Enana nigeriana y explico su aptitud principal. -->
        <div class="col">
            <article class="card card-cabra h-100">
                <?php $mostrarImagenNosotros('enana-nigeriana.png', 'Ejemplar de raza Enana nigeriana', 'ratio-4x3', 'rounded-top'); ?>
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">Enana nigeriana</h3>
                    <p class="small fw-bold text-success mb-3">Leche a pequeña escala y compañía</p>
                    <p class="text-secondary mb-0">Es una raza lechera de tamaño miniatura y pelaje variado. Además de su aptitud lechera, puede formar parte de proyectos de compañía y crianza, siempre que se disponga de espacio y condiciones adecuadas.</p>
                </div>
            </article>
        </div>
        <!-- Presento la raza Angora y explico su aptitud principal. -->
        <div class="col">
            <article class="card card-cabra h-100">
                <?php $mostrarImagenNosotros('angora.png', 'Ejemplar de raza Angora', 'ratio-4x3', 'rounded-top'); ?>
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">Angora</h3>
                    <p class="small fw-bold text-success mb-3">Fibra: mohair</p>
                    <p class="text-secondary mb-0">Se distingue por su pelaje largo y rizado. Su principal producto es el mohair, una fibra utilizada en textiles. No debe confundirse con la fibra de angora que se obtiene del conejo de angora.</p>
                </div>
            </article>
        </div>
        <!-- Presento la raza Boer y explico su aptitud principal. -->
        <div class="col">
            <article class="card card-cabra h-100">
                <?php $mostrarImagenNosotros('boer.png', 'Ejemplar de raza Boer', 'ratio-4x3', 'rounded-top'); ?>
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">Boer</h3>
                    <p class="small fw-bold text-success mb-3">Carne</p>
                    <p class="text-secondary mb-0">Es una raza desarrollada para la producción de carne, reconocida por su conformación corporal. En el catálogo aparecen ejemplares de cuerpo blanco y cabeza marrón, una combinación habitual de esta raza.</p>
                </div>
            </article>
        </div>
        <!-- Presento la raza Criolla y explico su aptitud principal. -->
        <div class="col">
            <article class="card card-cabra h-100">
                <?php $mostrarImagenNosotros('criolla.png', 'Ejemplar de raza Criolla', 'ratio-4x3', 'rounded-top'); ?>
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">Criolla</h3>
                    <p class="small fw-bold text-success mb-3">Usos según el biotipo</p>
                    <p class="text-secondary mb-0">El nombre criolla reúne poblaciones locales con características diversas. Según el biotipo y la región, se orientan a carne, leche o fibra. En nuestro catálogo también aparecen vinculadas al pastoreo; esto describe una actividad, no una especialización exclusiva de raza.</p>
                </div>
            </article>
        </div>
    </div>

    <!-- Aclaro cómo interpretar la guía y enlazo las fuentes de consulta. -->
    <div class="bg-light rounded-3 p-4 mt-4">
        <h3 class="h5 fw-bold">La raza es un punto de partida</h3>
        <p class="text-secondary">La elección también depende del ejemplar, del espacio disponible y del manejo. “Crianza” y “compañía” describen el objetivo de quien incorpora una cabrita; no reemplazan su aptitud productiva.</p>
        <p class="small text-secondary mb-2">Fuentes para ampliar la información:</p>
        <ul class="small mb-0">
            <li><a href="https://extension.psu.edu/dairy-goat-production">Penn State Extension: razas lecheras</a>.</li>
            <li><a href="https://cals.cornell.edu/nys-4-h-animal-science-programs/livestock/goats/goat-fact-sheets/meat-goat-breeds">Cornell University: razas y producción de carne</a>.</li>
            <li><a href="https://ucanr.edu/program/uc-small-farms-network/angora-goats">University of California: Angora y mohair</a>.</li>
            <li><a href="https://repositorio.inta.gob.ar/bitstream/handle/20.500.12123/5408/INTA_CRSaltaJujuy_EEASalta_Martinez_GM_Lecheria_caprina_produccion_manejo_sanidad.pdf?sequence=1">INTA: lechería caprina y biotipos criollos</a>.</li>
        </ul>
    </div>
</section>

<!-- Invito a explorar el catálogo o continuar por el formulario de contacto. -->
<section class="container pb-5" aria-labelledby="titulo-elegir">
    <div class="card border-0 shadow-sm p-4 p-md-5 text-center">
        <h2 id="titulo-elegir" class="h3 fw-bold mb-3">¿Cuál se adapta a tu proyecto?</h2>
        <p class="text-secondary mb-4">Conocé los ejemplares del catálogo o dejanos tu consulta.</p>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a class="btn btn-campo px-4" href="index.php?page=inicio#catalogo">Ver las cabritas</a>
            <a class="btn btn-outline-secondary px-4" href="index.php?page=contacto">Ir a contacto</a>
        </div>
    </div>
</section>
