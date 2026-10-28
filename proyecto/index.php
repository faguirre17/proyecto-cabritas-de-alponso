<?php
// Entrada del sitio: solo se pueden cargar las páginas de esta lista.
$paginas = [
    'inicio' => 'Inicio',
    'nosotros' => 'Nosotros',
    'contacto' => 'Contacto',
    '404' => 'Página no encontrada',
    '500' => 'No pudimos cargar el catálogo',
];

$pagina = $_GET['page'] ?? 'inicio';

if (!is_string($pagina) || !array_key_exists($pagina, $paginas)) {
    $pagina = '404';
}

// Escapamos los textos al mostrarlos en HTML, incluso si vienen de la base de datos.
function escapar($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$cabras = [];

if ($pagina === 'inicio') {
    try {
        // Datos externos de muestra. Luego reemplazo esta lectura por Cabra.php.
        $archivo = __DIR__ . '/../db/cabritas.json';
        $contenido = @file_get_contents($archivo);

        if ($contenido === false) {
            throw new RuntimeException('No se pudo leer el archivo del catálogo.');
        }

        // Decodificamos primero como objetos para distinguir [] de {}.
        $datos = json_decode($contenido, false, 512, JSON_THROW_ON_ERROR);

        if (!is_array($datos)) {
            throw new RuntimeException('El catálogo debe contener una lista.');
        }

        foreach ($datos as $registro) {
            if (!is_object($registro)) {
                throw new RuntimeException('Hay un registro inválido en el catálogo.');
            }

            $cabra = (array) $registro;

            // Validación mínima de los campos que necesita la card.
            foreach (['nombre', 'raza', 'uso_principal', 'descripcion', 'imagen'] as $campo) {
                if (!isset($cabra[$campo]) || !is_string($cabra[$campo])) {
                    throw new RuntimeException('Falta un texto del catálogo: ' . $campo);
                }
            }

            if (!isset($cabra['id'], $cabra['edad_meses'], $cabra['precio'], $cabra['disponible'])
                || !is_int($cabra['id']) || $cabra['id'] < 1
                || !is_int($cabra['edad_meses']) || $cabra['edad_meses'] < 0
                || !is_numeric($cabra['precio']) || (float) $cabra['precio'] < 0
                || !is_bool($cabra['disponible'])) {
                throw new RuntimeException('Hay datos inválidos en una cabrita.');
            }

            $cabras[] = $cabra;
        }
    } catch (Throwable $error) {
        // El detalle técnico queda en el registro del servidor, no en la pantalla.
        error_log('Cabritas de Alponso: ' . $error->getMessage());
        $pagina = '500';
    }
}

if ($pagina === '404' || $pagina === '500') {
    http_response_code((int) $pagina);
}

$titulo = $paginas[$pagina] . ' | Cabritas de Alponso';
?>
<!doctype html>
<html lang="es-AR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Conocé las cabritas de Alponso: razas, edades, precios y aptitudes en un solo lugar.">
    <title><?= escapar($titulo) ?></title>
    <!-- Bootstrap primero; los estilos después para poder personalizarlo. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="assets/css/estilos.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <a class="visually-hidden-focusable skip-link" href="#contenido">Saltar al contenido</a>

    <?php require __DIR__ . '/componentes/nav.php'; ?>

    <main id="contenido" class="flex-grow-1" tabindex="-1">
        <?php if ($pagina === 'inicio'): ?>
            <section class="bienvenida py-5" aria-labelledby="titulo-inicio">
                <div class="container py-md-3">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <p class="etiqueta mb-3">Bienvenidos a nuestro pequeño campo</p>
                            <h1 id="titulo-inicio" class="display-5 fw-bold mb-3">Pequeñas cabritas,<br>grandes comienzos.</h1>
                            <p class="lead text-secondary mb-4">Conocé nuestras cabritas, descubrí sus características<br class="d-none d-md-block"> y encontrá la que se adapte a tu proyecto.</p>
                            <a class="btn btn-campo px-4 py-2" href="#catalogo">Conocer las cabritas <span aria-hidden="true">↓</span></a>
                        </div>
                        <div class="col-lg-4 d-none d-lg-flex justify-content-center" aria-hidden="true">
                            <div class="sello-cabra">🐐</div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="catalogo" class="container py-5" aria-labelledby="titulo-catalogo">
                <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
                    <div>
                        <p class="etiqueta mb-2">Nuestro catálogo</p>
                        <h2 id="titulo-catalogo" class="fw-bold mb-2">Una cabrita para cada historia</h2>
                        <p class="text-secondary mb-0">Razas, edades y aptitudes para elegir con información.</p>
                    </div>
                    <span class="badge contador rounded-pill px-3 py-2"><?= count($cabras) ?> cabritas</span>
                </div>

                <?php if (empty($cabras)): ?>
                    <div class="estado-vacio text-center p-5">
                        <h3 class="h5">Todavía no hay cabritas en el catálogo</h3>
                        <p class="text-secondary mb-0">Volvé pronto para conocer las próximas incorporaciones.</p>
                    </div>
                <?php else: ?>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        <?php foreach ($cabras as $cabra): ?>
                            <div class="col">
                                <?php require __DIR__ . '/componentes/card_cabra.php'; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <p class="small text-secondary mt-4 mb-0">La aptitud describe el uso habitual de la raza en su etapa adulta.</p>
                <?php endif; ?>
            </section>
        <?php else: ?>
            <?php require __DIR__ . '/views/pages/' . $pagina . '.php'; ?>
        <?php endif; ?>
    </main>

    <?php require __DIR__ . '/componentes/footer.php'; ?>

    <!-- El bundle habilita el menú desplegable en celulares. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
