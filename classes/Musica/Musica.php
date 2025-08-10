<?php
require_once __DIR__ . '/../db/DataBase.php';
require_once __DIR__ . '/../Utilities/Utilities.php';

class Musica
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
    
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

}