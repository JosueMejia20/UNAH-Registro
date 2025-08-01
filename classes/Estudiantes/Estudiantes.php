<?php

require_once __DIR__ . '/../db/DataBase.php';
require_once __DIR__ . '/../Utilities/Utilities.php';

class Estudiantes
{

    public function getEstudianteInfo(string $id)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL getEstudianteInfo($id)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function getDeptPorClaseCarrera(string $id)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerDepartamentosPorClaseCarrera($id)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function getClasePorDeptEstudiante(string $idEstudiante, int $idDepartamento)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerClasesPorDepartamentoYEstudiante($idEstudiante, $idDepartamento)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function getSeccionPeriodoActualPorClase(int $idAsignatura)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerSeccionesPorClasePeriodoActual($idAsignatura)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function getMateriasActualesEstudiante(string $idEstudiante)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerSeccionesActualesEstudiante($idEstudiante)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    //Todos los inserts deberian ser de esta forma, manejo de errores
    public function insertEstudianteMatricula(string $idEstudiante, int $idSeccion)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL InsertarEstudianteMatricula(:estudiante_id, :seccion_id)");

            $stmt->bindParam(':estudiante_id', $idEstudiante, PDO::PARAM_STR);
            $stmt->bindParam(':seccion_id', $idSeccion, PDO::PARAM_INT);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al insertar postulante: " . $e->getMessage();
        }
    }

    public function updateEstudiante(
        string $idEstudiante,
        string $correo,
        string $telefono,
        string $direccion,
        string $imagen_base64
    ) {

        try {
            $imagen_binaria = Utilities::obtenerBinario($imagen_base64);
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL UpdateEstudiante(:idEstudiante, :correo, :telefono, :direccion, :imagen)");

            $stmt->bindParam(':idEstudiante', $idEstudiante, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
            $stmt->bindParam(':imagen', $imagen_binaria, PDO::PARAM_LOB);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function obtenerFotoPerfilB64(string $idEstudiante)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL obtenerFotoPerfilEstudiante($idEstudiante)");



            if (empty($datos) || !isset($datos[0]["foto_perfil"])) {
                return null;
            }

            $datos[0]["foto_perfil"] = Utilities::obtenerBase64($datos[0]["foto_perfil"]);

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function deleteEstudianteMatricula(string $idEstudiante, int $idSeccion)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL CancelarMatriculaEstudiante(:idEstudiante, :idSeccion)");

            $stmt->bindParam(':idEstudiante', $idEstudiante, PDO::PARAM_STR);
            $stmt->bindParam(':idSeccion', $idSeccion, PDO::PARAM_INT);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function obtenerCarrerasSinActual(string $idEstudiante)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerCarrerasCentroExcepActualEstudiante($idEstudiante)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function obtenerCentrosSinActual($idEstudiante)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerCentrosExcepActualEstudiante($idEstudiante)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function insertCambioCarrera($idEstudiante, $carreraNueva, $justificacion, $archivoPdf64)
    {
        try {
            $archivoPdfBinario = Utilities::obtenerBinario($archivoPdf64);
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL InsertarSolicitudCambioCarrera(:idEstudiante, :carreraNuevaId, :justificacion, :archivo)");

            $stmt->bindParam(':idEstudiante', $idEstudiante, PDO::PARAM_STR);
            $stmt->bindParam(':carreraNuevaId', $carreraNueva, PDO::PARAM_INT);
            $stmt->bindParam(':justificacion', $justificacion, PDO::PARAM_STR);
            $stmt->bindParam(':archivo', $archivoPdfBinario, PDO::PARAM_LOB);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function insertCambioCentro($idEstudiante, $centroNuevo, $justificacion, $archivoPdf64)
    {
        try {
            $archivoPdfBinario = Utilities::obtenerBinario($archivoPdf64);
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL InsertarSolicitudCambioCentro(:idEstudiante, :centroNuevoId, :justificacion, :archivo)");

            $stmt->bindParam(':idEstudiante', $idEstudiante, PDO::PARAM_STR);
            $stmt->bindParam(':centroNuevoId', $centroNuevo, PDO::PARAM_INT);
            $stmt->bindParam(':justificacion', $justificacion, PDO::PARAM_STR);
            $stmt->bindParam(':archivo', $archivoPdfBinario, PDO::PARAM_LOB);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function insertPagoReposicion($idEstudiante, $justificacion)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL InsertarSolicitudPagoReposicion(:idEstudiante, :justificacion)");

            $stmt->bindParam(':idEstudiante', $idEstudiante, PDO::PARAM_STR);
            $stmt->bindParam(':justificacion', $justificacion, PDO::PARAM_STR);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function obtenerSolicitudesRecientes($idEstudiante)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerSolicitudesEstudiante($idEstudiante)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function insertCancelacionExcep($idEstudiante, $justificacion, $archivoPdf64, $idSeccion)
    {
        try {
            $archivoPdfBinario = Utilities::obtenerBinario($archivoPdf64);
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL InsertarSolicitudCancelacionExcepc(:idEstudiante, :justificacion, :archivo, :seccion)");

            $stmt->bindParam(':idEstudiante', $idEstudiante, PDO::PARAM_STR);
            $stmt->bindParam(':justificacion', $justificacion, PDO::PARAM_STR);
            $stmt->bindParam(':archivo', $archivoPdfBinario, PDO::PARAM_LOB);
            $stmt->bindParam(':seccion', $idSeccion, PDO::PARAM_INT);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function obtenerContactos($idEstudiante)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerContactosEstudiante($idEstudiante)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function obtenerMensajes($idEstudiante, $contactoId)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerMensajesEntreEstudiantes($idEstudiante, $contactoId)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function obtenerSolicitudesContacto($idEstudiante)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerSolicitudesContactoPorReceptor($idEstudiante)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function aceptarSolicitudContacto($idSolicitud)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL AceptarSolicitudContacto(:idSolicitud)");

            $stmt->bindParam(':idSolicitud', $idSolicitud, PDO::PARAM_INT);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function rechazarSolicitudContacto($idSolicitud)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL RechazarSolicitudContacto(:idSolicitud)");

            $stmt->bindParam(':idSolicitud', $idSolicitud, PDO::PARAM_INT);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function enviarMensaje($emisor_id, $receptor_id, $mensaje)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL InsertarMensaje(:emisor_id, :receptor_id, :mensaje)");

            $stmt->bindParam(':emisor_id', $emisor_id, PDO::PARAM_STR);
            $stmt->bindParam(':receptor_id', $receptor_id, PDO::PARAM_STR);
            $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function insertSolicitudContacto($correoReceptor, $emisorId)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL InsertarSolicitudContacto(:emisor_id, :correo_receptor)");

            $stmt->bindParam(':emisor_id', $emisorId, PDO::PARAM_STR);
            $stmt->bindParam(':correo_receptor', $correoReceptor, PDO::PARAM_STR);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function obtenerDocentesActualesPorEstudiante($idEstudiante)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerDocentesActualesPorEstudiante($idEstudiante)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function obtenerInfoDocente($idDocente)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerDatosDocente($idDocente)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function obtenerAsignaturasActualesDocente($idDocente)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerAsignaturasActualesDocente($idDocente)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function obtenerHistorial($cuenta)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerHistorialEstudiante('" . $cuenta . "')");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function obtenerClasesEstudiante($idEstudiante)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerClasesEstudiante('" . $idEstudiante . "')");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function insertEvaluacionDocente($idEstudiante, $idSeccion, $observacion, $archivoPDF, $jsonEvaluacion)
    {
        try {
            if ($archivoPDF != null) {
                $archivoPdfBinario = Utilities::obtenerBinario($archivoPDF);
            } else{
                $archivoPdfBinario = null;
            }
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL InsertarEvaluacionDocente(:idEstudiante, :seccion, :observacion, :evidencia, :jsonEvaluacion)");

            $stmt->bindParam(':idEstudiante', $idEstudiante, PDO::PARAM_STR);
            $stmt->bindParam(':seccion', $idSeccion, PDO::PARAM_INT);
            $stmt->bindParam(':observacion', $observacion, PDO::PARAM_STR);
            $stmt->bindParam(':evidencia', $archivoPdfBinario, PDO::PARAM_LOB);
            $stmt->bindParam(':jsonEvaluacion', $jsonEvaluacion, PDO::PARAM_STR);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al actualizar: " . $e->getMessage();
        }
    }
}
