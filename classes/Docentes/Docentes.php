<?php

require_once __DIR__ . '/../db/DataBase.php';
require_once __DIR__ . '/../Utilities/Utilities.php';

class Docentes
{

    public function verificarUsuarioDocente(int $idUsuario): int
    {

        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("SELECT isDocente(:idUsuario) AS resultado");

            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return isset($resultado['resultado']) ? (int)$resultado['resultado'] : 0;
        } catch (PDOException $e) {
            error_log("Error en verificarUsuarioDocente: " . $e->getMessage());
            return 0;
        }
    }


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

    public function getNumeroDocenteByUsuarioId($usuarioId)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL ObtenerNumeroEmpleadoDocente(:usuarioId, @numeroEmpleado)");
            $stmt->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();

            $resultado = $pdo->query("SELECT @numeroEmpleado AS numeroEmpleado")->fetch(PDO::FETCH_ASSOC);

            return isset($resultado['numeroEmpleado']) ? (string)$resultado['numeroEmpleado'] : "";
        } catch (PDOException $e) {
            echo 'error en base de datos: ' . $e->getMessage();
            return "";
        }
    }

    public function getInfo($idDocente)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $sql = "
                SELECT
                    s.id,
                    c.codigo AS codigo_clase,
                    c.nombre_clase,
                    duni.nombre_departamento AS departamento_clase,
                    s.codigo_seccion
                FROM Seccion s
                JOIN Clase c ON s.clase_id = c.clase_id
                JOIN Departamento_Uni duni ON c.departamento_id = duni.departamento_id
                JOIN Periodo_Academico pa ON s.periodo_acad_id = pa.id
                WHERE s.docente_id = :idDocente
                AND CURDATE() BETWEEN pa.fecha_inicio AND pa.fecha_fin
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idDocente', $idDocente, PDO::PARAM_INT);

            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function getEstudiantes($idSeccion)
    {
        try {
            $db = new DataBase();
            $datos = $db->executeQuery("CALL ObtenerEstudiantesPorSeccion($idSeccion)");
            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function insertarRecursosDeSeccion($idSeccion, $linkVideo, $base64PDF)
    {
        $binaryPDF = Utilities::obtenerBinario($base64PDF);

        try {
            $db = new DataBase();
            $pdo = $db->getConnection();

            $stmt = $pdo->prepare("CALL Insertar_Introduccion_Clase(:seccion_id, :archivo_pdf, :video)");

            $stmt->bindParam(':seccion_id', $idSeccion, PDO::PARAM_INT);
            $stmt->bindParam(':archivo_pdf', $binaryPDF, PDO::PARAM_LOB);
            $stmt->bindParam(':video', $linkVideo, PDO::PARAM_STR);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "error en la base de datos ".$e->getMessage();
            return false;
        }
    }

    public function obtenerIntroduccionesPorDocente($idDocente){
        try {
            $db = new DataBase();
            $datos = $db->executeQuery("CALL obtenerIntroduccionesPorDocente($idDocente)");
            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function getClaseSeccion($idSeccion){
        try {
            $db = new DataBase();
            $datos = $db->executeQuery("CALL ObtenerClasePorSeccion($idSeccion)");
            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function insertarEstudiantesSecciones($idSeccion, $idEstudiante, $nota){
        try {
            $db = new DataBase();
            $pdo = $db->getConnection();

            $stmt = $pdo->prepare("CALL Insertar_Estudiantes_Secciones(:estudiante_id, :seccion_id, :nota)");

            $stmt->bindParam(':seccion_id', $idSeccion, PDO::PARAM_INT);
            $stmt->bindParam(':estudiante_id', $idEstudiante, PDO::PARAM_STR);
            $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "error en la base de datos ".$e->getMessage();
            return false;
        }
    }

    public function getEstudiantesNotas($idSeccion){
        try {
            $db = new DataBase();
            $datos = $db->executeQuery("CALL ObtenerEstudiantesSeccionConNotas($idSeccion)");
            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }
}

// prueba
// $docente = new Docentes();
// echo $docente->verificarUsuarioDocente(758) , "    ";
