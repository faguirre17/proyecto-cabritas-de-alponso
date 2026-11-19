<?php
// Preparo los campos, los errores y el estado de la consulta.
$nombre = '';
$email = '';
$motivo = '';
$mensaje = '';
$errores = [];
$consultaValida = false;
$cabraConsulta = false;
$idCabra = '';

// Defino los únicos motivos que acepto tanto en el formulario como en el backend.
$motivos = [
    'cabritas' => 'Información sobre una cabrita',
    'disponibilidad' => 'Precios y disponibilidad',
    'cuidados' => 'Cuidados y crianza',
    'otra' => 'Otra consulta',
];

// Leo la cabrita desde el botón Consultar o desde el formulario enviado.
$idRecibido = $_GET['cabra'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idRecibido = $_POST['cabra'] ?? '';
}

// Compruebo el identificador antes de consultar la base de datos.
if ($idRecibido !== '') {
    if (!is_string($idRecibido) || !ctype_digit($idRecibido) || (int) $idRecibido < 1) {
        $errores[] = 'La cabrita seleccionada no es válida.';
    } else {
        $cabraConsulta = (new Cabra())->getCabraById((int) $idRecibido);
        if ($cabraConsulta === false) {
            $errores[] = 'No encontré la cabrita seleccionada.';
        } else {
            $idCabra = $cabraConsulta->getId();
            $motivo = 'cabritas';
        }
    }
}

// Proceso los datos solamente cuando recibo el formulario mediante POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Compruebo que reciba textos y elimino los espacios de los extremos.
    $nombre = isset($_POST['nombre']) && is_string($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $email = isset($_POST['email']) && is_string($_POST['email']) ? trim($_POST['email']) : '';
    $motivo = isset($_POST['motivo']) && is_string($_POST['motivo']) ? trim($_POST['motivo']) : '';
    $mensaje = isset($_POST['mensaje']) && is_string($_POST['mensaje']) ? trim($_POST['mensaje']) : '';

    // Valido el nombre sin depender del atributo required del navegador.
    if ($nombre === '' || strlen($nombre) > 200) {
        $errores[] = 'Ingresá tu nombre y apellido; si es muy largo, usá una versión más breve.';
    }

    // Compruebo que el correo tenga un formato válido y una longitud permitida.
    if (strlen($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Ingresá un correo electrónico válido.';
    }

    // Verifico que el motivo pertenezca a las opciones que definí.
    if (!array_key_exists($motivo, $motivos)) {
        $errores[] = 'Seleccioná un motivo de consulta válido.';
    }

    // Compruebo que el mensaje esté completo y no sea demasiado largo.
    if ($mensaje === '' || strlen($mensaje) > 5000) {
        $errores[] = 'Escribí un mensaje; si es muy largo, resumí la consulta.';
    }

    // Confirmo la validación; en esta etapa no envío correos ni guardo consultas.
    if (empty($errores)) {
        $consultaValida = true;
        $nombre = '';
        $email = '';
        $mensaje = '';
        $motivo = '';
        $idCabra = '';
        $cabraConsulta = false;
    }
}
