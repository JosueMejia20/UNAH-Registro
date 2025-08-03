<?php
require_once __DIR__ . '/../db/DataBase.php';
require_once __DIR__ . '/../Utilities/Utilities.php';

class Biblioteca
{

    public function verificarUsuarioBiblioteca(int $idUsuario)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $queryRoles = "
                                SELECT r.rol_id 
                                FROM Rol r
                                INNER JOIN Usuario_Rol ur ON r.rol_id = ur.rol_id
                                WHERE ur.usuario_id = ?;
                            ";

            $stmtRoles = $pdo->prepare($queryRoles);
            $stmtRoles->execute([$idUsuario]);
            $roles = array_map('intval', $stmtRoles->fetchAll(PDO::FETCH_COLUMN));

            //roles
            $REVISOR = 1;
            $ESTUDIANTE = 2;
            $DOCENTE = 3;
            $COORDINADOR = 4;
            $JEFE_DEPT = 5;
            $ADMIN = 6;

            // Si solo es revisor
            if (in_array($REVISOR, $roles) && count($roles) === 1) {
                return 0;
            }
            // Si es coordinador o jefe, y a la vez tiene que ser docente
            if ((in_array($COORDINADOR, $roles) || in_array($JEFE_DEPT, $roles)) && in_array($DOCENTE, $roles)) {
                return 3;
            }

            // Si solo es docente
            if (in_array($DOCENTE, $roles)) {
                return 2;
            }

            // Si solo es estudiante
            if (in_array($ESTUDIANTE, $roles)) {
                return 1;
            }


            return 0;
            // Si solo tiene un rol
            /*
            if (count($roles) === 1) {
                if ($roles[0] === $REVISOR) {
                    return 0; // Revisor no tiene acceso
                } elseif (in_array($roles[0], [$ESTUDIANTE])) {
                    return 1; // Estudiante usuarios nivel 1
                } elseif (in_array($roles[0], [$DOCENTE])) {
                    return 2; // Docentes usuarios nivel 2
                } elseif (in_array($roles[0], [$ADMIN, $COORDINADOR, $JEFE_DEPT])) {
                    return 3; // Usuario de nivel 3
                }
            }

            // Si tiene múltiples roles

            $nivel2 = [$COORDINADOR, $JEFE_DEPT, $ADMIN];

            if (in_array($ESTUDIANTE, $roles)) {
                return 1; // Tiene rol de estudiante o docente nivel 1
            }
            if(in_array($DOCENTE, $roles)){
                return 2;
            }

            if (!empty(array_intersect($roles, $nivel2))) {
                return 3; // Tiene algún rol de nivel 2
            }

            return 0; // sin acceso al modulo
            */
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }


    //ELIMINAR
    public function obtenerRecursosDocente($idDocente)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerRecursosPorDocente($idDocente)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function obtenerTipoRecurso()
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL obtenerTiposDeRecurso()");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function obtenerClasesDocente($idDocente)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL GetClasesPorDocente($idDocente)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }


    public function insertarRecursoCompleto($titulo, $tags, $descripcion, $categoria, $autores, $anio, $idDocente, $archivoPdf, $portada, $cursos)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();
            $pdo->beginTransaction();

            // Convertir base64 a binario
            $archivo_binario = Utilities::obtenerBinario($archivoPdf);
            $portada_binaria = Utilities::obtenerBinario($portada);

            // Insertar recurso
            $stmt = $pdo->prepare("CALL InsertarRecurso(:titulo, :archivo, :anio, :portada, :docente_id, :tipo_recurso_id, :descripcion,@recurso_id)");
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $stmt->bindParam(':archivo', $archivo_binario, PDO::PARAM_LOB);
            $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
            $stmt->bindParam(':portada', $portada_binaria, PDO::PARAM_LOB);
            $stmt->bindParam(':docente_id', $idDocente, PDO::PARAM_INT);
            $stmt->bindParam(':tipo_recurso_id', $categoria, PDO::PARAM_INT);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->execute();

            $result = $pdo->query("SELECT @recurso_id AS recurso_id")->fetch(PDO::FETCH_ASSOC);
            $recursoId = $result['recurso_id'];

            if (!$recursoId) {
                throw new Exception("No se generó ID de recurso.");
            }

            // Insertar autores y relacionarlos
            foreach ($autores as $nombreAutor) {
                $stmt = $pdo->prepare("CALL InsertarAutor(:nombre, @autor_id)");
                $stmt->bindParam(':nombre', $nombreAutor, PDO::PARAM_STR);
                $stmt->execute();
                $res = $pdo->query("SELECT @autor_id AS autor_id")->fetch(PDO::FETCH_ASSOC);
                $autorId = $res['autor_id'];

                $stmt = $pdo->prepare("CALL RelacionarAutorRecurso(:recursoId, :autorId)");
                $stmt->bindParam(':recursoId', $recursoId, PDO::PARAM_INT);
                $stmt->bindParam(':autorId', $autorId, PDO::PARAM_INT);
                $stmt->execute();
            }

            // Insertar tags y relacionarlos
            foreach ($tags as $nombreTag) {
                $stmt = $pdo->prepare("CALL InsertarTag(:nombre, @tag_id)");
                $stmt->bindParam(':nombre', $nombreTag, PDO::PARAM_STR);
                $stmt->execute();
                $res = $pdo->query("SELECT @tag_id AS tag_id")->fetch(PDO::FETCH_ASSOC);
                $tagId = $res['tag_id'];

                $stmt = $pdo->prepare("CALL RelacionarTagRecurso(:recursoId, :tagId)");
                $stmt->bindParam(':recursoId', $recursoId, PDO::PARAM_INT);
                $stmt->bindParam(':tagId', $tagId, PDO::PARAM_INT);
                $stmt->execute();
            }
            //Relacionar Clase con Recurso
            $stmt = $pdo->prepare("CALL RelacionarClaseRecurso(:recursoId, :claseId)");
            $stmt->bindParam(':recursoId', $recursoId, PDO::PARAM_INT);
            $stmt->bindParam(':claseId', $cursos, PDO::PARAM_INT);
            $stmt->execute();

            $pdo->commit();
            return true;
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    public function obtenerRecursos()
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL GetRecursosDetallados()");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function verRecurso($idRecurso)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL RecursoDetalle($idRecurso)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function recursoPortadaArchivo($idRecurso)
    {
        try {
            $db = new DataBase();

            $datos = $db->executeQuery("CALL RecursoPortadaArchivo($idRecurso)");

            return $datos;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    public function updateRecurso($anio, $archivo, $autores, $categoria, $cursos, $descripcion, $portada, $tags, $titulo, $idRecurso)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();
            $pdo->beginTransaction();

            // Convertir base64 a binario
            $archivo_binario = Utilities::obtenerBinario($archivo);
            $portada_binaria = Utilities::obtenerBinario($portada);

            // Insertar recurso
            $stmt = $pdo->prepare("CALL ActualizarRecurso(:recurso_id, :titulo, :archivo, :anio, :portada, :tipo_recurso, :descripcion)");
            $stmt->bindParam(':recurso_id', $idRecurso, PDO::PARAM_INT);
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $stmt->bindParam(':archivo', $archivo_binario, PDO::PARAM_LOB);
            $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
            $stmt->bindParam(':portada', $portada_binaria, PDO::PARAM_LOB);
            $stmt->bindParam(':tipo_recurso', $categoria, PDO::PARAM_INT);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->execute();

            // Insertar autores y relacionarlos
            foreach ($autores as $nombreAutor) {
                $stmt = $pdo->prepare("CALL InsertarAutor(:nombre, @autor_id)");
                $stmt->bindParam(':nombre', $nombreAutor, PDO::PARAM_STR);
                $stmt->execute();
                $res = $pdo->query("SELECT @autor_id AS autor_id")->fetch(PDO::FETCH_ASSOC);
                $autorId = $res['autor_id'];

                $stmt = $pdo->prepare("CALL RelacionarAutorRecurso(:recursoId, :autorId)");
                $stmt->bindParam(':recursoId', $idRecurso, PDO::PARAM_INT);
                $stmt->bindParam(':autorId', $autorId, PDO::PARAM_INT);
                $stmt->execute();
            }

            // Insertar tags y relacionarlos
            foreach ($tags as $nombreTag) {
                $stmt = $pdo->prepare("CALL InsertarTag(:nombre, @tag_id)");
                $stmt->bindParam(':nombre', $nombreTag, PDO::PARAM_STR);
                $stmt->execute();
                $res = $pdo->query("SELECT @tag_id AS tag_id")->fetch(PDO::FETCH_ASSOC);
                $tagId = $res['tag_id'];

                $stmt = $pdo->prepare("CALL RelacionarTagRecurso(:recursoId, :tagId)");
                $stmt->bindParam(':recursoId', $idRecurso, PDO::PARAM_INT);
                $stmt->bindParam(':tagId', $tagId, PDO::PARAM_INT);
                $stmt->execute();
            }
            //Relacionar Clase con Recurso
            $stmt = $pdo->prepare("CALL RelacionarClaseRecurso(:recursoId, :claseId)");
            $stmt->bindParam(':recursoId', $idRecurso, PDO::PARAM_INT);
            $stmt->bindParam(':claseId', $cursos, PDO::PARAM_INT);
            $stmt->execute();

            $pdo->commit();
            return true;
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    public function deleteRecurso($idRecurso)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL EliminarRecurso(:idRecurso)");

            $stmt->bindParam(':idRecurso', $idRecurso, PDO::PARAM_INT);

            $resultado = $stmt->execute();

            return $resultado;
        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al eliminar: " . $e->getMessage();
        }
    }

    public function obtenerIdEstudiante($idUsuario)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $pdo->exec("SET @numeroCuenta = NULL");

            $stmt = $pdo->prepare("CALL ObtenerNumeroCuentaEstudiante(:usuarioId, @numeroCuenta)");
            $stmt->bindParam(':usuarioId', $idUsuario, PDO::PARAM_INT);
            $stmt->execute();

            $resultado = $pdo->query("SELECT @numeroCuenta AS numeroCuenta")->fetch(PDO::FETCH_ASSOC);

            return $resultado['numeroCuenta'];
        } catch (PDOException $e) {
            echo "Error al obtener número de cuenta: " . $e->getMessage();
        }
    }

    public function obtenerIdDocente($idUsuario)
    {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            $pdo->exec("SET @numeroEmpleado = NULL");

            $stmt = $pdo->prepare("CALL ObtenerNumeroEmpleadoDocente(:usuarioId, @numeroEmpleado)");
            $stmt->bindParam(':usuarioId', $idUsuario, PDO::PARAM_INT);
            $stmt->execute();

            $resultado = $pdo->query("SELECT @numeroEmpleado AS numeroEmpleado")->fetch(PDO::FETCH_ASSOC);

            return $resultado['numeroEmpleado'];
        } catch (PDOException $e) {
            echo "Error al obtener número de empleado: " . $e->getMessage();
        }
    }
}




//prueba
// $ob = new Biblioteca();
// echo 'esto es lo que retorna: '.$ob->verificarUsuarioBiblioteca(3);
