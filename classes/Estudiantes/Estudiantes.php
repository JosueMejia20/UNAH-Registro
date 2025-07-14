<?php

    require_once __DIR__ . '/../db/DataBase.php';
    require_once __DIR__.'/../Utilities/Utilities.php';

    class Estudiantes{

        public function getEstudianteInfo(string $id){
            try{
            $db = new DataBase();
            $pdo = $db->connect();

            //VER COMO SE VA A LLAMAR EL SP
            $stmt = $pdo->prepare("SELECT getEstudianteInfo(:idEstudiante) AS info");

            $stmt->bindParam(':idEstudiante', $id, PDO::PARAM_STR);

            $info = $stmt->execute();

            return $info;
        } catch(PDOException $e){
            return "Error en la base de datos: ".$e->getMessage();
        }
        }
    }