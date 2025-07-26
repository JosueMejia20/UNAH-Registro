<?php
    require_once __DIR__ . '/../db/DataBase.php';
    require_once __DIR__.'/../Utilities/Utilities.php';

    class Biblioteca {

        public function verificarUsuarioBiblioteca(int $idUsuario){
            try {
                $db = new DataBase();
                $pdo = $db->connect();

                $queryRoles = "
                                SELECT r.rol_id 
                                FROM Rol r
                                INNER JOIN Usuario_Rol ur ON r.rol_id = ur.rol_id
                                WHERE ur.usuario_id = ?;";

                $stmtRoles = $pdo->prepare($queryRoles);
                $stmtRoles->execute([$idUsuario]);
                $roles = $stmtRoles->fetchAll(PDO::FETCH_COLUMN);

                $roles = array_map('intval', $roles);

                if (count($roles) === 1) {
                    if ($roles[0] === 1) {
                        return 0; // revisores no tienen permiso
                    } elseif ($roles[0] === 2) {
                        return 1; // Solo estudiante
                    }
                }

                $superiores = [3, 4, 5];

                if (!in_array(2, $roles) && !empty(array_intersect($roles, $superiores))) {
                    return 2;
                }

                if (in_array(2, $roles)) {
                    return 1;
                }

                return 0; // No tiene permisos válidos

            } catch(PDOException $e){
                return "Error en la base de datos: ".$e->getMessage();
            }
        }

        //ELIMINAR
        public function obtenerRecursosDocente($idDocente){
            try{
                $db = new DataBase();

                $datos = $db->executeQuery("CALL ObtenerRecursosPorDocente($idDocente)");
            
                return $datos;
            } catch(PDOException $e){
                return "Error en la base de datos: ".$e->getMessage();
            }
        }

        public function obtenerTipoRecurso(){
            try{
                $db = new DataBase();

                $datos = $db->executeQuery("CALL obtenerTiposDeRecurso()");
            
                return $datos;
            } catch(PDOException $e){
                return "Error en la base de datos: ".$e->getMessage();
            }
        }

        public function obtenerClasesDocente($idDocente){
            try{
                $db = new DataBase();

                $datos = $db->executeQuery("CALL GetClasesPorDocente($idDocente)");
            
                return $datos;
            } catch(PDOException $e){
                return "Error en la base de datos: ".$e->getMessage();
            }
        }


        public function insertarRecursoCompleto($titulo, $tags, $descripcion, $categoria, $autores, $anio, $idDocente, $archivoPdf, $portada, $cursos) {
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

        public function obtenerRecursos(){
            try{
                $db = new DataBase();

                $datos = $db->executeQuery("CALL GetRecursosDetallados()");
            
                return $datos;
            } catch(PDOException $e){
                return "Error en la base de datos: ".$e->getMessage();
            }
        }

        public function verRecurso($idRecurso){
            try{
                $db = new DataBase();

                $datos = $db->executeQuery("CALL RecursoDetalle($idRecurso)");
            
                return $datos;
            } catch(PDOException $e){
                return "Error en la base de datos: ".$e->getMessage();
            }
        }


    }




/* prueba
$ob = new Biblioteca();
echo 'esto es lo que retorna: '.$ob->verificarUsuarioBiblioteca(1);*/

    