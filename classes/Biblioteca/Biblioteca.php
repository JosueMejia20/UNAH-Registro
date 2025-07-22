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

        public function obtenerRecursosDocente($idDocente){
            try{
                $db = new DataBase();

                $datos = $db->executeQuery("CALL ObtenerRecursosPorDocente($idDocente)");
            
                return $datos;
            } catch(PDOException $e){
                return "Error en la base de datos: ".$e->getMessage();
            }
        }

    }




/* prueba
$ob = new Biblioteca();
echo 'esto es lo que retorna: '.$ob->verificarUsuarioBiblioteca(1);*/

    