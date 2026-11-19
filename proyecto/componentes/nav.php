<header class="cabecera">
    <nav class="navbar navbar-expand-md py-3" aria-label="Navegación principal">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/img/logoindex.png" alt="Logo Cabritas de Alponso" width="100" height="100" class="me-2">
                <span class="nombre-marca">Cabritas de Alponso</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#menuPrincipal" aria-controls="menuPrincipal"
                aria-expanded="false" aria-label="Abrir o cerrar el menú">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto gap-md-2 pt-3 pt-md-0">
                    <li class="nav-item">
                        <a class="nav-link<?= $pagina === 'inicio' ? ' active' : '' ?>"
                            href="index.php" <?= $pagina === 'inicio' ? ' aria-current="page"' : '' ?>>Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $pagina === 'nosotros' ? ' active' : '' ?>"
                            href="index.php?page=nosotros" <?= $pagina === 'nosotros' ? ' aria-current="page"' : '' ?>>Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $pagina === 'contacto' ? ' active' : '' ?>"
                            href="index.php?page=contacto" <?= $pagina === 'contacto' ? ' aria-current="page"' : '' ?>>Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>