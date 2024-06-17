<?php
class Conexion
{
    private $host = "localhost"; // Nombre del servidor de la base de datos
    private $usuario = "root"; // Usuario de la base de datos
    private $password = ""; // Contraseña de la base de datos
    private $base_datos = "realstate"; // Nombre de la base de datos
    public $con;

    // Método constructor para establecer la conexión
    public function __construct()
    {
        $this->con = new mysqli($this->host, $this->usuario, $this->password, $this->base_datos);

        // Verificar conexión
        if ($this->con->connect_error) {
            die("Conexión fallida: " . $this->con->connect_error);
        }

        // Establecer el conjunto de caracteres de la conexión
        $this->con->set_charset("utf8");
    }

    public function getConexion()
    {
        return $this->con;
    }

    // Método para cerrar la conexión
    public function cerrarConexion()
    {
        $this->con->close();
    }
}
