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
    }