<?php

use PDO;
use PDOException;
use Exception;

class DataBase {
    private $host;
    private $user;
    private $password;
    private $port;
    private $dbName;
    private $pdo;

    public function __construct($envPath= __DIR__ . '/../../.env') {
        $envVars = $this->loadEnv($envPath);

        $this->host = $envVars['DB_HOST'] ?? 'localhost';
        $this->user = $envVars['DB_USER'] ?? 'root';
        $this->password = $envVars['DB_PASSWORD'] ?? '';
        $this->port = $envVars['DB_PORT'] ?? '3306';
        $this->dbName = $envVars['DB_NAME'] ?? '';

        $this->connect();
    }

    private function loadEnv($filePath) {
        $variables = [];

        if (!file_exists($filePath)) {
            throw new Exception("El archivo .env no existe en la ruta especificada: $filePath\n");
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            //para ignorar los comentarios del archivo .env
            if(str_starts_with(trim($line), '#')) {
                continue;
            }

            //separa con clave y valor
            $parts = explode('=', $line, 2);

            if(count($parts) == 2) {
                $key = trim($parts[0]);
                $value = trim($parts[1], "\"' ");//quita las comillas o espacios
                $variables[$key] = $value;
            }
        }

        return $variables;
    }

    //funcion de conexion a la base de datos
    public function connect() {
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbName};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            die("Error al tratar de conectar con base de datos: " . $e->getMessage());
        }
    }

    //funcion para recuperar todos los usuarios
    public function getUsuarios() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM Usuario");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            return ['error' => $e->getMessage()];
        }
    }
}