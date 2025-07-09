<?php

    require_once __DIR__ . '/../db/DataBase.php';
    require_once __DIR__.'/../Utilities/Utilities.php';

    class Admisiones{
        

        public function getFacultadById(int $id) {
            $db = new DataBase();
            return $db->executeQuery("CALL getFacultadByID($id)");
        }

        public function getFacultades() {
            $db = new DataBase();
            return $db->executeQuery("CALL getAllFacultad");
        }

        public function getEstadoCivil(){
            $db = new DataBase();
            return $db->executeQuery("CALL getAllEstado_Civil");
        }

        public function getDepartamentoPais(){
            $db = new DataBase();
            return $db->executeQuery("CALL getAllDepartamento_Pais");
        }

        public function getPais(){
            $db = new DataBase();
            return $db->executeQuery("CALL getAllPais");
        }

        public function getCentroRegional(){
            $db = new DataBase();
            return $db->executeQuery("CALL getAllCentro_Regional");
        }

        public function getCarreras(){
            $db = new DataBase();
            return $db->executeQuery("CALL getAllCarrera");
        }

        public function getCarrerasByCentro(int $id_centro){
            $db = new DataBase();
            return $db->executeQuery("CALL getCarrerasByCentro($id_centro)");
        }
/*
        public function insertPostulanteInscripcion($dept_id, $desc_dir, $dni, $nombre, $apellido,
            $telefono, $correo, $genero, $fecha_nac, $estado_civil, $instituto_educ, $anio_grad, $pais_estudio,
            $carrera_p, $carrera_s, $centro_reg, $imagen_base64)
            {
            
                $imagen_binaria = Utilities::obtenerBinario($imagen_base64);

                $db = new DataBase();
                $db->executeQuery("CALL InsertarPostulanteEInscripcion($dept_id, '$desc_dir', '$dni', $nombre, $apellido,
                $telefono, $correo, $genero, $fecha_nac, $estado_civil, $instituto_educ, $anio_grad, $pais_estudio,
                $carrera_p, $carrera_s, $centro_reg, $imagen_binaria)");
        }
*/

        public function insertPostulanteInscripcion(
        $dept_id, $desc_dir, $dni, $nombre, $apellido,
        $telefono, $correo, $genero, $fecha_nac, $estado_civil,
        $instituto_educ, $anio_grad, $pais_estudio,
        $carrera_p, $carrera_s, $centro_reg, $imagen_base64
    ) {
        try {
            $imagen_binaria = Utilities::obtenerBinario($imagen_base64);
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL InsertarPostulanteEInscripcion(
                :dept_id, :desc_dir, :dni, :nombre, :apellido,
                :telefono, :correo, :genero, :fecha_nac, :estado_civil,
                :instituto_educ, :anio_grad, :pais_estudio,
                :carrera_p, :carrera_s, :centro_reg, :imagen_binaria)");

            $stmt->bindParam(':dept_id', $dept_id, PDO::PARAM_INT);
            $stmt->bindParam(':desc_dir', $desc_dir, PDO::PARAM_STR);
            $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_nac', $fecha_nac, PDO::PARAM_STR);
            $stmt->bindParam(':estado_civil', $estado_civil, PDO::PARAM_STR);
            $stmt->bindParam(':instituto_educ', $instituto_educ, PDO::PARAM_STR);
            $stmt->bindParam(':anio_grad', $anio_grad, PDO::PARAM_INT);
            $stmt->bindParam(':pais_estudio', $pais_estudio, PDO::PARAM_STR);
            $stmt->bindParam(':carrera_p', $carrera_p, PDO::PARAM_INT);
            $stmt->bindParam(':carrera_s', $carrera_s, PDO::PARAM_INT);
            $stmt->bindParam(':centro_reg', $centro_reg, PDO::PARAM_INT);
            $stmt->bindParam(':imagen_binaria', $imagen_binaria, PDO::PARAM_LOB);

            $stmt->execute();

            // Si el procedimiento devuelve datos, puedes hacer fetch aquí

        } catch (PDOException $e) {
            // Manejo de error
            die("Error al insertar postulante: " . $e->getMessage());
        }
    }
}

