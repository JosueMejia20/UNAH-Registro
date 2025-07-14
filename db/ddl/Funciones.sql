use Registro;

DROP FUNCTION IF EXISTS autenticarUsuario;
DROP FUNCTION IF EXISTS isRevisor;
DROP FUNCTION IF EXISTS obtener_examenes_postulante;
DROP FUNCTION IF EXISTS obtener_dni_de_inscripcion;

DELIMITER $$

-- Funcion que retorna el id del usuario si existe en la tabla usuario sino retorna null
CREATE FUNCTION autenticarUsuario(
    p_correo VARCHAR(50),
    p_contrasenia VARCHAR(255)
)
RETURNS INT
NOT DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE v_usuario_id INT;

    SELECT usuario_id
    INTO v_usuario_id
    FROM Usuario
    WHERE correo_institucional = p_correo
      AND contrasenia = p_contrasenia
    LIMIT 1;

    RETURN v_usuario_id;
END$$


-- Funcion que retorna 1 si el usuario es tiene el rol de revisor y retorna 0 si el usuario no tiene ese rol
CREATE FUNCTION isRevisor(p_usuario_id INT)
RETURNS TINYINT
NOT DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE v_existe INT;

    SELECT COUNT(*)
    INTO v_existe
    FROM Usuario_Rol
    WHERE usuario_id = p_usuario_id AND rol_id = 1;

    RETURN IF(v_existe > 0, 1, 0);
END$$


CREATE FUNCTION obtener_examenes_postulante(p_dni VARCHAR(25))
RETURNS VARCHAR(1000)
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE lista_examenes VARCHAR(1000);

    SELECT 
        GROUP_CONCAT(DISTINCT te.nombre_examen ORDER BY te.nombre_examen SEPARATOR ', ')
    INTO lista_examenes
    FROM Inscripcion i
    JOIN Carrera c ON c.carrera_id IN (i.carrera_primaria, i.carrera_secundaria)
    JOIN Examen_Carrera ec ON ec.carrera_id = c.carrera_id
    JOIN Tipo_Examen te ON te.tipo_examen_id = ec.tipo_examen_id
    WHERE i.postulante_id = p_dni;

    RETURN lista_examenes;
END$$

CREATE FUNCTION obtener_dni_de_inscripcion(v_inscripcion_id VARCHAR(25))
RETURNS VARCHAR(25)
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE dni VARCHAR(25);

    SELECT 
        postulante_id
    INTO dni
    FROM Inscripcion
    WHERE inscripcion_id = v_inscripcion_id;

    RETURN dni;
END$$

DELIMITER ;
