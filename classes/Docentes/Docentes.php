<?php

require_once __DIR__ . '/../db/DataBase.php';
require_once __DIR__ . '/../Utilities/Utilities.php';

class Docentes
{
    public function getDocenteInfo($idDocente)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerDatosDocente($idDocente)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function subirFotoDocente($foto_perfil, $idDocente)
    {
        $foto_binaria = Utilities::obtenerBinario($foto_perfil);

        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL ActualizarFotoDocente(:idDocente, :foto_perfil)");

            $stmt->bindParam(':idDocente', $idDocente, PDO::PARAM_INT);
            $stmt->bindParam(':foto_perfil', $foto_binaria, PDO::PARAM_LOB);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function getFotoPerfilDocente($idDocente)
    {
        try {
            $db = new DataBase();
            $datos = $db->executeQuery("CALL ObtenerFotoPerfilDocente($idDocente)");
            if (empty($datos) || !isset($datos[0]["foto_perfil"])) {
                return null;
            }

            $datos[0]["foto_perfil"] = Utilities::obtenerBase64($datos[0]["foto_perfil"]);

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }
}
