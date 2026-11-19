<?php

// Representa una cabrita y permite consultar los datos de la tabla cabras.
class Cabra
{
    // Atributos privados: sus nombres coinciden con las columnas de la tabla.
    private $id;
    private $nombre;
    private $raza;
    private $edad_meses;
    private $precio;
    private $uso_principal;
    private $descripcion;
    private $imagen;
    private $disponible;

    // Obtiene todas las cabritas del catálogo, ordenadas por su identificador.
    public function getCabras()
    {
        try {
            // Solicitamos la conexión a la clase Conexion.
            $conexion = (new Conexion())->getConexion();

            // Ejecutamos la consulta que obtiene los registros del catálogo.
            $sql = "SELECT * FROM cabras ORDER BY id";
            $resultado = $conexion->query($sql);

            // Si PDO informa un error sin lanzar una excepción, mostramos el error.
            if ($resultado === false) {
                header("Location: ./index.php?page=500");
                exit;
            }

            // Convertimos cada fila en un objeto Cabra.
            // Si no hay registros, fetchAll devuelve un array vacío.
            return $resultado->fetchAll(PDO::FETCH_CLASS, Cabra::class);
        } catch (Exception $e) {
            // Si falla la consulta, redirigimos y detenemos la ejecución.
            header("Location: ./index.php?page=500");
            exit;
        }
    }

    // Obtengo solamente las cabritas que corresponden a una página.
    public function getCabrasByPage($page, $limit = 6)
    {
        try {
            // Convierto los valores en enteros y evito páginas o límites menores que uno.
            $page = (int) $page;
            $limit = (int) $limit;
            if ($page < 1) {
                $page = 1;
            }
            if ($limit < 1) {
                $limit = 6;
            }

            // Solicito la conexión y calculo cuántos registros debo saltar.
            $conexion = (new Conexion())->getConexion();
            $offset = ($page - 1) * $limit;

            // Limito la cantidad de registros y mantengo el orden por identificador.
            $sql = "SELECT * FROM cabras ORDER BY id LIMIT $limit OFFSET $offset";
            $resultado = $conexion->query($sql);

            // Muestro la página de error si la consulta no se puede ejecutar.
            if ($resultado === false) {
                header("Location: ./index.php?page=500");
                exit;
            }

            // Devuelvo los registros de esta página como objetos Cabra.
            return $resultado->fetchAll(PDO::FETCH_CLASS, Cabra::class);
        } catch (Exception $e) {
            // Redirijo a la página 500 si ocurre una excepción en la consulta.
            header("Location: ./index.php?page=500");
            exit;
        }
    }

    // Busca una cabrita por su identificador para mostrar su detalle.
    public function getCabraById($id)
    {
        try {
            // Obtenemos una conexión para realizar la búsqueda.
            $conexion = (new Conexion())->getConexion();

            // :id es un marcador: el valor se envía separado de la consulta.
            $sql = "SELECT * FROM cabras WHERE id = :id";
            $stmt = $conexion->prepare($sql);

            // Comprobamos que la consulta se haya preparado correctamente.
            if ($stmt === false) {
                header("Location: ./index.php?page=500");
                exit;
            }

            // Indicamos que el resultado debe convertirse en un objeto Cabra.
            $stmt->setFetchMode(PDO::FETCH_CLASS, Cabra::class);

            // Ejecutamos la consulta pasando el valor del identificador.
            if ($stmt->execute([":id" => $id]) === false) {
                header("Location: ./index.php?page=500");
                exit;
            }

            // Devuelve la cabrita encontrada, o false si ese id no existe.
            return $stmt->fetch();
        } catch (Exception $e) {
            // Un fallo de consulta lleva a la página de error de datos.
            header("Location: ./index.php?page=500");
            exit;
        }
    }

    // Devuelve el identificador de la cabrita.
    public function getId()
    {
        return $this->id;
    }

    // Devuelve el nombre sin espacios en los extremos y preparado para HTML.
    public function getNombre()
    {
        return htmlspecialchars(trim($this->nombre));
    }

    // Devuelve la raza preparada para mostrarla en HTML.
    public function getRaza()
    {
        return htmlspecialchars(trim($this->raza));
    }

    // Devuelve la edad en meses.
    public function getEdadMeses()
    {
        return $this->edad_meses;
    }

    // Devuelve el precio como dato numérico para poder darle formato en la card.
    public function getPrecio()
    {
        return $this->precio;
    }

    // Devuelve la aptitud principal preparada para mostrarla en HTML.
    public function getUsoPrincipal()
    {
        return htmlspecialchars(trim($this->uso_principal));
    }

    // Devuelve la descripción preparada para mostrarla en HTML.
    public function getDescripcion()
    {
        return htmlspecialchars(trim($this->descripcion));
    }

    // Devuelve la ruta de la imagen preparada para utilizarla en el HTML.
    public function getImagen()
    {
        return htmlspecialchars(trim($this->imagen));
    }

    // Devuelve 1 si está disponible o 0 si no lo está.
    public function getDisponible()
    {
        return $this->disponible;
    }
}

