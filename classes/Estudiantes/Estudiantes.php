<?php

    require_once __DIR__ . '/../db/DataBase.php';
    require_once __DIR__.'/../Utilities/Utilities.php';

    class Estudiantes{

        public function getEstudianteInfo(string $id){
            try{
            $db = new DataBase();

            $datos = $db->executeQuery("CALL getEstudianteInfo($id)");
           
            return $datos;
        } catch(PDOException $e){
            return "Error en la base de datos: ".$e->getMessage();
        }
        }

        public function getDeptPorClaseCarrera(string $id){
            try{
            $db = new DataBase();

            $datos = $db->executeQuery("CALL ObtenerDepartamentosPorClaseCarrera($id)");
           
            return $datos;
        } catch(PDOException $e){
            return "Error en la base de datos: ".$e->getMessage();
        }
        }

        public function getClasePorDeptEstudiante(string $idEstudiante, int $idDepartamento){
            try{
                $db = new DataBase();

                $datos = $db->executeQuery("CALL ObtenerClasesPorDepartamentoYEstudiante($idEstudiante, $idDepartamento)");
            
                return $datos;
            } catch(PDOException $e){
                return "Error en la base de datos: ".$e->getMessage();
            }
        }

        public function getSeccionPeriodoActualPorClase(int $idAsignatura){
            try{
                $db = new DataBase();

                $datos = $db->executeQuery("CALL ObtenerSeccionesPorClasePeriodoActual($idAsignatura)");
            
                return $datos;
            } catch(PDOException $e){
                return "Error en la base de datos: ".$e->getMessage();
            }
        }

        public function getMateriasActualesEstudiante(string $idEstudiante){
            try{
                $db = new DataBase();

                $datos = $db->executeQuery("CALL ObtenerSeccionesActualesEstudiante($idEstudiante)");
            
                return $datos;
            } catch(PDOException $e){
                return "Error en la base de datos: ".$e->getMessage();
            }
        }

        //Todos los inserts deberian ser de esta forma, manejo de errores
        public function insertEstudianteMatricula(string $idEstudiante, int $idSeccion){
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

        public function updateEstudiante(string $idEstudiante, string $correo, 
        string $telefono, string $direccion, string $imagen_base64){

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

        public function obtenerFotoPerfilB64(string $idEstudiante){
            try{
                $db = new DataBase();

                $datos = $db->executeQuery("CALL obtenerFotoPerfilEstudiante($idEstudiante)");
            


                if(empty($datos) || !isset($datos[0]["foto_perfil"])){
                    return null;
                }

                $datos[0]["foto_perfil"] = Utilities::obtenerBase64($datos[0]["foto_perfil"]);

                return $datos;
            } catch(PDOException $e){
                return "Error en la base de datos: ".$e->getMessage();
            }
        }

        public function deleteEstudianteMatricula(string $idEstudiante, int $idSeccion){
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
    }