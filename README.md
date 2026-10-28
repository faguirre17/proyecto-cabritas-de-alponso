# Cabritas de Alponso

Primera etapa del trabajo práctico: estructura general, navegación, footer y cards reutilizables. Empresa, animales, descripciones y precios ficticios.

## Qué incluye esta etapa

- `index.php`: documento HTML, carga de Bootstrap, selección de página y catálogo.
- `componentes/nav.php`: cabecera y navegación en un único archivo. Marca la página activa y se despliega en celulares.
- `componentes/footer.php`: pie compartido y año automático.
- `componentes/card_cabra.php`: tarjeta reutilizable con imagen, nombre, raza, edad, aptitud, precio en ARS, estado y enlace de consulta.
- `assets/css/estilos.css`: colores, bordes y pequeños ajustes visuales. La distribución responsive la resuelve Bootstrap.
- Vistas iniciales de Nosotros y Contacto para que los enlaces funcionen, más páginas 404 y 500.
- Seis registros de muestra en `db/cabritas.json`, un archivo externo al código PHP.

**Esta base todavía no es la entrega final del TP.** Falta implementar MySQL si corresponde a la materia, el paginado, el formulario y su validación obligatoria en PHP. La página Contacto es una pantalla provisoria: no envía ni guarda consultas. Tampoco hay carrito ni pagos.

## Organización

Se interpretó `Views/Pages` del diagrama como `views/pages/`. Todos los nombres de carpeta se escriben en minúscula para evitar diferencias entre Windows y Linux.

```text
cabritas-de-alponso/
├── README.md
├── .gitignore
├── db/
│   └── cabritas.json
└── proyecto/
    ├── index.php
    ├── componentes/
    │   ├── nav.php
    │   ├── footer.php
    │   └── card_cabra.php
    ├── views/
    │   └── pages/
    │       ├── nosotros.php
    │       ├── contacto.php
    │       ├── 404.php
    │       └── 500.php
    ├── class/
    ├── actions/
    └── assets/
        ├── css/
        │   └── estilos.css
        └── img/
```

Las carpetas vacías contienen `.gitkeep` para conservarlas al subir a GitHub. En la próxima etapa se agregarán `class/Conexion.php`, `class/Cabra.php`, `actions/contacto_acc.php` y `db/cabritas.sql`. No se incluyen archivos vacíos con esos nombres para no confundirlos con implementaciones terminadas.

## Ejecutar con XAMPP

1. Copiar la carpeta **completa** `cabritas-de-alponso` dentro de `htdocs`. Mantener `db` al lado de `proyecto`, porque PHP lee el JSON desde esa ubicación.
2. Iniciar Apache. Esta etapa no necesita MySQL.
3. Abrir `http://localhost/cabritas-de-alponso/proyecto/`.

También se puede ejecutar desde la raíz del repositorio con PHP instalado:

```bash
php -S localhost:8000 -t proyecto
```

Abrir `http://localhost:8000/`. Usar PHP 8.x; no hacen falta Composer, npm ni un proceso de compilación. Bootstrap se carga desde un CDN, por lo que se necesita conexión a internet para sus estilos y el menú móvil.

## Cómo funciona index.php

1. Lee `$_GET['page']`; si no existe, usa `inicio`.
2. Verifica que el valor esté en una lista de páginas permitidas. Las rutas desconocidas muestran 404, sin incluir archivos arbitrarios.
3. En Inicio, lee el JSON externo y verifica que tenga los campos necesarios para las cards. Un archivo faltante, JSON inválido o registro mal formado muestra 500. Una lista vacía `[]` muestra el mensaje de catálogo vacío.
4. Carga `nav.php`, el contenido seleccionado y `footer.php` con `require`.
5. Incluye el JavaScript de Bootstrap para el menú móvil.

La lectura ocurre antes del HTML para poder enviar los códigos HTTP 404 o 500 correctamente. Los detalles de un error se registran en el servidor; la página muestra un mensaje sencillo.

Las rutas son:

- Inicio: `index.php`
- Nosotros: `index.php?page=nosotros`
- Contacto: `index.php?page=contacto`
- Prueba de 404: `index.php?page=no-existe`
- Vista de error de datos: `index.php?page=500`

## Cómo se reutiliza la card

`index.php` recorre el catálogo y entrega cada array `$cabra` al mismo componente:

```php
<?php foreach ($cabras as $cabra): ?>
    <div class="col">
        <?php require __DIR__ . '/componentes/card_cabra.php'; ?>
    </div>
<?php endforeach; ?>
```

Se usa `require`, y no `require_once`, porque la card debe renderizarse una vez por cada registro. El componente no consulta la base de datos y no contiene animales hardcodeados. Utiliza la función `escapar()` de `index.php` para mostrar textos sin interpretarlos como HTML.

Cada registro debe contener:

| Campo | Tipo esperado | Uso |
| --- | --- | --- |
| `id` | Entero positivo | Se envía en el enlace de consulta. |
| `nombre` | Texto | Título de la card. |
| `raza` | Texto | Raza de la cabrita. |
| `edad_meses` | Entero no negativo | Edad en meses. |
| `precio` | Número no negativo | Precio ficticio en ARS. |
| `uso_principal` | Texto | Aptitud habitual de la raza adulta. |
| `descripcion` | Texto | Presentación breve. |
| `imagen` | Texto | Ruta local dentro de `assets/img/`, o cadena vacía. |
| `disponible` | Booleano | `true`: permite consultar; `false`: muestra Reservada. |

Para agregar fotografías, guardar los archivos en `proyecto/assets/img/` y actualizar las rutas del JSON. Se admiten `.jpg`, `.jpeg`, `.png` y `.webp`, con nombres sin espacios ni tildes. Las rutas de ejemplo ya apuntan a `margarita.jpg`, `canela.jpg`, etc. Hasta agregarlas se ve un reemplazo, sin imágenes rotas.

El enlace Consultar lleva a `index.php?page=contacto&cabra=ID`. El formulario futuro deberá validar ese ID; esta primera versión solo prepara el enlace.

## Próximas etapas de la consigna

1. Crear e importar `db/cabritas.sql`, e implementar `Conexion.php` y `Cabra.php` si se utiliza MySQL. El JSON es un apoyo provisional para ver el diseño. Solo puede ser la fuente definitiva si la consigna permite esa alternativa para el alumno.
2. Traer registros con paginado y agregar suficientes datos para comprobar varias páginas. Hoy se muestran los seis ejemplos juntos.
3. Crear el formulario con al menos cuatro tipos de elementos y validar todo en `actions/contacto_acc.php`.
4. Reemplazar los textos y fotos de muestra por el contenido definitivo.
5. Agregar el documento con nombre del proyecto e integrantes solicitado en la entrega.

## Entrega en GitHub

Subir el contenido de esta carpeta como raíz del repositorio: `README.md`, `proyecto/`, `db/` y el documento de integrantes cuando esté listo. El repositorio sirve para entregar y versionar el código. GitHub Pages es hosting estático y no ejecuta este proyecto PHP: para probarlo, usar XAMPP o un servidor con PHP.

No se creó ni se publicó ningún repositorio remoto en esta etapa.

## Dependencias y referencias

- Bootstrap **5.3.8**, última versión estable verificada el 28/10/2026. Bootstrap 6.0.0-alpha.1 sigue siendo una versión preliminar.
- CSS y JS oficiales por CDN con sus atributos `integrity` y `crossorigin`.
- [Versiones oficiales de Bootstrap](https://getbootstrap.com/docs/versions/).
- [Instalación de Bootstrap 5.3](https://getbootstrap.com/docs/5.3/getting-started/introduction/).
- [Qué es GitHub Pages](https://docs.github.com/en/pages/getting-started-with-github-pages/what-is-github-pages).

## Verificación de esta base

Se verificaron los ocho archivos con el analizador de sintaxis de PHP 8.3.6 y se probaron por HTTP la navegación, las seis cards, las respuestas 404/500, el catálogo vacío, el archivo de datos ausente o inválido y el escape de textos HTML. No se completó una comprobación visual en navegador en este entorno.
