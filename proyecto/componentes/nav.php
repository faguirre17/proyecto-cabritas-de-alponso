<header class="cabecera">
    <nav class="navbar navbar-expand-md py-3" aria-label="Navegación principal">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 m-0" href="index.php">
                <span class="marca-icono" aria-hidden="true">🐐</span>
                <span class="marca-nombre">Cabritas <span class="d-block">de Alponso</span></span>
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
                           href="index.php"<?= $pagina === 'inicio' ? ' aria-current="page"' : '' ?>>Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $pagina === 'nosotros' ? ' active' : '' ?>"
                           href="index.php?page=nosotros"<?= $pagina === 'nosotros' ? ' aria-current="page"' : '' ?>>Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $pagina === 'contacto' ? ' active' : '' ?>"
                           href="index.php?page=contacto"<?= $pagina === 'contacto' ? ' aria-current="page"' : '' ?>>Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
