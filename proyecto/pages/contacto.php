<!-- Presento el formulario de contacto con el mismo diseño del catálogo. -->
<section class="container py-5" aria-labelledby="titulo-contacto">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <p class="etiqueta mb-2">Conversemos</p>
            <h1 id="titulo-contacto" class="fw-bold mb-3">Contactanos</h1>
            <p class="text-secondary mb-4">Dejanos tu consulta sobre nuestras cabritas, su disponibilidad o sus cuidados.</p>

            <!-- Confirmo que los datos son válidos sin simular un envío de correo. -->
            <?php if ($consultaValida): ?>
                <div class="alert alert-success" role="status">
                    Los datos de tu consulta se validaron correctamente. Este formulario es una demostración: todavía no envía correos ni guarda mensajes.
                </div>
            <?php endif; ?>

            <!-- Muestro los errores encontrados por PHP y conservo los datos escritos. -->
            <?php if (!empty($errores)): ?>
                <div class="alert alert-danger" role="alert">
                    <p class="fw-bold mb-2">Revisá los siguientes datos:</p>
                    <ul class="mb-0">
                        <?php foreach ($errores as $error): ?>
                            <li><?= escapar($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Indico la cabrita elegida desde el botón Consultar del catálogo. -->
            <?php if ($cabraConsulta !== false): ?>
                <div class="alert alert-info">
                    Estás consultando por <strong><?= $cabraConsulta->getNombre() ?></strong>, raza <?= $cabraConsulta->getRaza() ?>.
                </div>
            <?php endif; ?>

            <!-- Envío los datos por POST al índice, que incluye la acción antes del HTML. -->
            <form action="index.php?page=contacto" method="POST" class="card border-0 shadow-sm p-4">
                <!-- Conservo el identificador de la cabrita para validarlo en el backend. -->
                <input type="hidden" name="cabra" value="<?= escapar($idCabra) ?>">

                <!-- Solicito el nombre y recupero su valor si hay errores. -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre y apellido</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" autocomplete="name" maxlength="200" required value="<?= escapar($nombre) ?>">
                </div>

                <!-- Solicito una dirección de correo y vuelvo a validarla en PHP. -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" autocomplete="email" maxlength="254" required value="<?= escapar($email) ?>">
                </div>

                <!-- Genero las opciones del motivo con la lista que uso para validar. -->
                <div class="mb-3">
                    <label for="motivo" class="form-label">Motivo de la consulta</label>
                    <select id="motivo" name="motivo" class="form-select" required>
                        <option value="">Seleccioná un motivo</option>
                        <?php foreach ($motivos as $valor => $texto): ?>
                            <option value="<?= escapar($valor) ?>" <?= $motivo === $valor ? 'selected' : '' ?>><?= escapar($texto) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Solicito el mensaje y conservo su contenido si la validación falla. -->
                <div class="mb-4">
                    <label for="mensaje" class="form-label">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" class="form-control" rows="5" maxlength="5000" required><?= escapar($mensaje) ?></textarea>
                </div>

                <!-- Permito validar el formulario y volver al catálogo. -->
                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-campo">Enviar consulta</button>
                    <a href="index.php?page=inicio" class="btn btn-outline-secondary">Volver al catálogo</a>
                </div>
                <p class="small text-secondary mt-3 mb-0">Formulario de demostración académica. No envía correos ni guarda mensajes.</p>
            </form>
        </div>
    </div>
</section>
