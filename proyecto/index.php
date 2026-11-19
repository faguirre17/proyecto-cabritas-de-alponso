<?php
// Cargo la clase que crea la conexión con la base de datos.
require_once __DIR__ . '/class/Conexion.php';

// Cargo la clase que representa las cabritas y consulta la tabla cabras.
require_once __DIR__ . '/class/Cabra.php';

// Defino las páginas que permito cargar y sus títulos.
$paginas = [
    'inicio' => 'Inicio',
    'nosotros' => 'Nosotros',
    'contacto' => 'Contacto',
    '404' => 'Página no encontrada',
    '500' => 'No pudimos cargar el catálogo',
];

// Leo la página solicitada en la URL; si no recibo ninguna, muestro el inicio.
$pagina = $_GET['page'] ?? 'inicio';

// Compruebo que la página solicitada pertenezca a mi lista de páginas permitidas.
if (!is_string($pagina) || !array_key_exists($pagina, $paginas)) {
    $pagina = '404';
}

// Preparo los textos para mostrarlos en HTML sin interpretarlos como etiquetas.
function escapar($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Preparo una lista vacía para guardar las cabritas del catálogo.
$cabras = [];

// Consulto la base y preparo el paginado solamente en la página de inicio.
if ($pagina === 'inicio') {
    // Leo currentPage desde la URL, igual que en el ejemplo del profesor.
    $currentPage = $_GET['currentPage'] ?? 1;

    // Compruebo que reciba un número y lo convierto en entero.
    if (!is_numeric($currentPage)) {
        $currentPage = 1;
    }
    $currentPage = (int) $currentPage;
    if ($currentPage < 1) {
        $currentPage = 1;
    }

    // Defino cuántas cabritas quiero mostrar por página.
    $limit = 3;
    $catalogo = new Cabra();

    // Obtengo el catálogo completo y calculo las páginas con count y ceil.
    $cabrasTotal = $catalogo->getCabras();
    $totalCabras = count($cabrasTotal);
    $totalPaginas = ceil($totalCabras / $limit);

    // Si solicito una página que no existe, uso la última disponible.
    if ($totalPaginas > 0 && $currentPage > $totalPaginas) {
        $currentPage = (int) $totalPaginas;
    }

    // Si el catálogo está vacío, mantengo la primera página y la lista vacía.
    if ($totalCabras === 0) {
        $currentPage = 1;
    } else {
        // Consulto solamente las cabritas de la página seleccionada.
        $cabras = $catalogo->getCabrasByPage($currentPage, $limit);
    }
}

// Preparo y valido el contacto antes de mostrar HTML para permitir las redirecciones.
if ($pagina === 'contacto') {
    require __DIR__ . '/actions/contacto_acc.php';
}

// Envío el código HTTP correspondiente cuando muestro una página de error.
if ($pagina === '404' || $pagina === '500') {
    http_response_code((int) $pagina);
}

// Armo el título que voy a mostrar en la pestaña del navegador.
$titulo = $paginas[$pagina] . ' | Cabritas de Alponso';
?>
<!doctype html>
<html lang="es-AR">

<head>
    <!-- Defino la codificación, la adaptación a celulares y los datos de la página. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Conocé las cabritas de Alponso: razas, edades, precios y aptitudes en un solo lugar.">
    <title><?= escapar($titulo) ?></title>
    <!-- Cargo Bootstrap y después mis estilos para personalizar el diseño. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="assets/img/logoindex.png">
    <link href="assets/css/estilos.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Agrego un enlace para saltar directamente al contenido con el teclado. -->
    <a class="visually-hidden-focusable skip-link" href="#contenido">Saltar al contenido</a>

    <!-- Incluyo la cabecera y el menú compartidos por todas las páginas. -->
    <?php require __DIR__ . '/componentes/nav.php'; ?>

    <!-- Muestro el contenido que corresponde a la página seleccionada. -->
    <main id="contenido" class="flex-grow-1" tabindex="-1">
        <?php if ($pagina === 'inicio'): ?>
            <!-- Presento el sitio y agrego un acceso directo al catálogo. -->
            <section class="bienvenida py-5" aria-labelledby="titulo-inicio">
                <div class="container py-md-3">
                    <div class="row align-items-center g-4">

                        <!-- Columna izquierda: texto de bienvenida -->
                        <div class="col-lg-6">
                            <p class="etiqueta mb-3">
                                Bienvenidos a nuestro pequeño campo
                            </p>

                            <h1 id="titulo-inicio" class="display-5 fw-bold mb-3">
                                Pequeñas cabritas,<br>grandes comienzos.
                            </h1>

                            <p class="lead text-secondary mb-4">
                                Conocé nuestras cabritas, descubrí sus características
                                <br class="d-none d-md-block">
                                y encontrá la que se adapte a tu proyecto.
                            </p>

                            <a class="btn btn-campo px-4 py-2" href="#catalogo">
                                Conocer las cabritas
                                <span aria-hidden="true">↓</span>
                            </a>
                        </div>

                        <!-- Columna derecha: banner de la cabrita -->
                        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
                            <img
                                src="assets/img/banner_index.png"
                                alt="Cabrita bebé en el campo"
                                class="img-fluid w-100">
                        </div>

                        <!-- Muestro el título del catálogo y la cantidad de cabritas cargadas. -->
                        <section id="catalogo" class="container py-5" aria-labelledby="titulo-catalogo">
                            <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
                                <div>
                                    <p class="etiqueta mb-2">Nuestro catálogo</p>
                                    <h2 id="titulo-catalogo" class="fw-bold mb-2">Una cabrita para cada historia</h2>
                                    <p class="text-secondary mb-0">Razas, edades y aptitudes para elegir con información.</p>
                                </div>
                                <span class="badge contador rounded-pill px-3 py-2"><?= $totalCabras ?> cabritas</span>
                            </div>

                            <!-- Compruebo si tengo cabritas para mostrar o si el catálogo está vacío. -->
                            <?php if (empty($cabras)): ?>
                                <div class="estado-vacio text-center p-5">
                                    <h3 class="h5">Todavía no hay cabritas en el catálogo</h3>
                                    <p class="text-secondary mb-0">Volvé pronto para conocer las próximas incorporaciones.</p>
                                </div>
                            <?php else: ?>
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                    <!-- Recorro el catálogo y reutilizo una card por cada cabrita. -->
                                    <?php foreach ($cabras as $cabra): ?>
                                        <div class="col">
                                            <?php require __DIR__ . '/componentes/card_cabra.php'; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <!-- Muestro los controles si el catálogo ocupa más de una página. -->
                                <?php if ($totalPaginas > 1): ?>
                                    <nav class="mt-4" aria-label="Páginas del catálogo">
                                        <ul class="pagination justify-content-center flex-wrap">
                                            <!-- Habilito Anterior solamente cuando no estoy en la primera página. -->
                                            <li class="page-item <?= $currentPage > 1 ? '' : 'disabled' ?>">
                                                <?php if ($currentPage > 1): ?>
                                                    <a class="page-link" href="index.php?page=inicio&amp;currentPage=<?= $currentPage - 1 ?>#catalogo">Anterior</a>
                                                <?php else: ?>
                                                    <span class="page-link" aria-disabled="true">Anterior</span>
                                                <?php endif; ?>
                                            </li>

                                            <!-- Recorro las páginas con un for y destaco la página actual. -->
                                            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                                <li class="page-item <?= $currentPage == $i ? 'active' : '' ?>">
                                                    <?php if ($currentPage == $i): ?>
                                                        <span class="page-link" aria-current="page"><?= $i ?></span>
                                                    <?php else: ?>
                                                        <a class="page-link" href="index.php?page=inicio&amp;currentPage=<?= $i ?>#catalogo"><?= $i ?></a>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endfor; ?>

                                            <!-- Habilito Siguiente solamente cuando no estoy en la última página. -->
                                            <li class="page-item <?= $currentPage < $totalPaginas ? '' : 'disabled' ?>">
                                                <?php if ($currentPage < $totalPaginas): ?>
                                                    <a class="page-link" href="index.php?page=inicio&amp;currentPage=<?= $currentPage + 1 ?>#catalogo">Siguiente</a>
                                                <?php else: ?>
                                                    <span class="page-link" aria-disabled="true">Siguiente</span>
                                                <?php endif; ?>
                                            </li>
                                        </ul>
                                    </nav>
                                <?php endif; ?>

                                <p class="small text-secondary mt-4 mb-0">La aptitud describe el uso habitual de la raza en su etapa adulta.</p>
                            <?php endif; ?>
                        </section>
                    <?php else: ?>
                        <!-- Cargo la vista de la página que seleccioné en la lista permitida. -->
                        <?php require __DIR__ . '/pages/' . $pagina . '.php'; ?>
                    <?php endif; ?>
    </main>

    <!-- Incluyo el pie compartido por todas las páginas. -->
    <?php require __DIR__ . '/componentes/footer.php'; ?>

    <!-- Cargo el JavaScript de Bootstrap para habilitar el menú en celulares. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>