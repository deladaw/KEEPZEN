<?php
//Conexión con la base de datos.
class Database {
    private $host = 'localhost';
    private $database = 'keepzen';
    protected $username = 'root';
    protected $password = '';

    protected $conn = null;

    public function __construct() {
        try {
            $this->connect();
        } catch (PDOException $err) {
            die("Error: " . $err->getMessage() . " No se ha podido conectar a la base de datos.");
        }
    }

    protected function connect() {
        $dsn = "mysql:host=$this->host;dbname=$this->database;charset=utf8mb4";

        $this->conn = new PDO($dsn, $this->username, $this->password);

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->conn;
    }
}

?>