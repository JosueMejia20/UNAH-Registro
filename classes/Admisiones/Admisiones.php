<?php

    require_once __DIR__ . '/../db/DataBase.php';

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

    }

