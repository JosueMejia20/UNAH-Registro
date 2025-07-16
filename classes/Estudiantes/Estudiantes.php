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
    }