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

            $tipoUsuario = 0;

            // Si solo es revisor
            if (in_array($REVISOR, $roles) && count($roles) === 1) {
                $tipoUsuario = 0;
            }
            // Si es coordinador o jefe, y a la vez tiene que ser docente
            if ((in_array($COORDINADOR, $roles) || in_array($JEFE_DEPT, $roles)) && in_array($DOCENTE, $roles)) {
                $tipoUsuario = 3;
            }

            // Si solo es docente
            if (in_array($DOCENTE, $roles)) {
                $tipoUsuario = 2;
            }

            // Si solo es estudiante
            if (in_array($ESTUDIANTE, $roles)) {
                $tipoUsuario = 1;
            }


            $queryVerificarCarreraDept = "CALL VerificarUsuarioMusicaArte(?, ?)";
            $stmtSP = $pdo->prepare($queryVerificarCarreraDept);
            $stmtSP->execute([$idUsuario, $tipoUsuario]);
            $resultadoSP = $stmtSP->fetch(PDO::FETCH_ASSOC);

            if($tipoUsuario == 1 && $resultadoSP['puede_acceder'] == 1){
                return 1;
            } else if($tipoUsuario == 2 && $resultadoSP['puede_acceder'] == 1){
                return 2;
            } else if($tipoUsuario == 3 && $resultadoSP['puede_acceder'] == 1){
                return 3;
            }

            return 0;
        } catch (PDOException $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }
}

//prueba
// $ob = new Musica();
// echo 'esto es lo que retorna: '.$ob->verificarUsuarioBiblioteca(5);