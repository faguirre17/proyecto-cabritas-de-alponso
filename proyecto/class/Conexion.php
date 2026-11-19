<?php

// Esta clase reúne los datos y la lógica para conectarse a la base de datos.
class Conexion
{
    // Datos de conexión de MySQL
    private $server = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "cabritas_de_alponso";

    // Método para crear la conexión y devolverla para poder realizar consultas.
    public function getConexion()
    {
        // Intento conectarme. Si ocurre una excepción, se ejecuta el catch.
        try {
            $dsn = "mysql:host=$this->server;dbname=$this->dbname;charset=utf8mb4";

            // Creamos un objeto PDO con el DSN, el usuario y la contraseña.
            $conexion = new PDO($dsn, $this->user, $this->pass);

            return $conexion;
        } catch (Exception $e) {
            // Si falla la conexión, redirijo a la página de error 500.
            header("Location: ./index.php?page=500");

            // Detengo la ejecución para que no continúe sin conexión.
            exit;
        }
    }
}
