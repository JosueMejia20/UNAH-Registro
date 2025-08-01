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

            $stmt = $pdo->prepare("SELECT numero_solicitud FROM Inscripcion WHERE postulante_id = :dni");
            $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
            $stmt->execute();

            $numero_solicitud = $stmt->fetchColumn();

            if ($numero_solicitud) {
                Utilities::enviarCorreo(
                "Su solicitud ha sido recibida, por favor estar pendiente de su correo ya que en los próximos días se hará su revisión. Solicitud número: " . $numero_solicitud,
                $correo
                );
            }else {
                echo "No se pudo obtener el número de solicitud.";
            }

        } catch (PDOException $e) {
            // Manejo de error
            echo "Error al insertar postulante: " . $e->getMessage();
        }
    }

    public function getInscripcionesByRevisor(int $id_revisor){
        $db = new DataBase();
        return $db->executeQuery("CALL getAllSolicitudesByRevisor($id_revisor)");
    }

    public function asignarRevisores(){
        $db = new DataBase();
        return $db->executeQuery("CALL AsignarRevisores()");
    }

    public function cambiarEstadoInscripcion(int $inscripcionId, int $valor, string $justificacion, string $correo){
        try{
            $db = new DataBase();
            $pdo = $db->connect();

            $stmt = $pdo->prepare("CALL CambiarEstadoRevision(:inscripcion_id, :valor)");

            $stmt->bindParam(':inscripcion_id', $inscripcionId, PDO::PARAM_INT);
            $stmt->bindParam(':valor', $valor, PDO::PARAM_INT);

            $resultado = $stmt->execute();

            if($valor==0){
                Utilities::enviarCorreo($justificacion, $correo);
            } else{
                $resultDni = $db->executeQuery("SELECT obtener_dni_de_inscripcion($inscripcionId) AS dni");
                $dni = strval($resultDni[0]['dni']);
                $examenes = $db->executeQuery("SELECT obtener_examenes_postulante('$dni') AS examenes");
                Utilities::enviarCorreo("Su solicitud ha sido aceptada, por favor asistir a hacer los siguientes examenes:".$examenes[0]['examenes'], $correo);
            }

            return $resultado;
        } catch(PDOException $e){
            return "Error en la base de datos: ".$e->getMessage();
        }
        
    }

    public function getInscripcionById(int $id_inscripcion){
        $db = new DataBase();

        $datos = $db->executeQuery("CALL getInscripcionById($id_inscripcion)");
        $datos[0]["documento_adjunto"] = Utilities::obtenerBase64($datos[0]["documento_adjunto"]);
       return $datos;
    }

    /*
    public function loginRevisor(string $username, string $password){
        try{
            $db = new DataBase();
            $pdo = $db->connect();

            //VER COMO SE VA A LLAMAR EL SP
            $stmt = $pdo->prepare("SELECT autenticarUsuario(:username, :password)");

            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);

            $resultado = $stmt->execute();

            return $resultado;
        } catch(PDOException $e){
            return "Error en la base de datos: ".$e->getMessage();
        }
    }
*/
    public function verificarUsuarioRevisor(int $idRevisor){
        try{
            $db = new DataBase();
            $pdo = $db->connect();

            //VER COMO SE VA A LLAMAR EL SP
            $stmt = $pdo->prepare("SELECT isRevisor(:idRevisor) AS resultado");

            $stmt->bindParam(':idRevisor', $idRevisor, PDO::PARAM_INT);

            $resultado = $stmt->execute();

            return $resultado;
        } catch(PDOException $e){
            return "Error en la base de datos: ".$e->getMessage();
        }
    }
}

