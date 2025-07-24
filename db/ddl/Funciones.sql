use Registro;

DROP FUNCTION IF EXISTS autenticarUsuario;
DROP FUNCTION IF EXISTS isRevisor;
DROP FUNCTION IF EXISTS obtener_examenes_postulante;
DROP FUNCTION IF EXISTS obtener_dni_de_inscripcion;
DROP FUNCTION IF EXISTS isEstudiante;
DROP FUNCTION IF EXISTS isDocente;
DROP FUNCTION IF EXISTS fn_existe_solicitud_en_periodo_actual;

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

CREATE FUNCTION isEstudiante(p_usuario_id INT)
RETURNS TINYINT
NOT DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE v_existe INT;

    SELECT COUNT(*)
    INTO v_existe
    FROM Usuario_Rol
    WHERE usuario_id = p_usuario_id AND rol_id = 2;

    RETURN IF(v_existe > 0, 1, 0);
END$$

CREATE FUNCTION isDocente(p_usuario_id INT)
RETURNS TINYINT
NOT DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE v_existe INT;

    SELECT COUNT(*)
    INTO v_existe
    FROM Usuario_Rol
    WHERE usuario_id = p_usuario_id AND rol_id = 3;

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




CREATE FUNCTION fn_existe_solicitud_en_periodo_actual(
    p_estudiante_id VARCHAR(11),
    p_tipo_solicitud_id INT
)
RETURNS BOOLEAN
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE v_periodo_actual_id INT;

    -- Obtener el ID del periodo academico actual segun la fecha del sistema
    SELECT id INTO v_periodo_actual_id
    FROM Periodo_Academico
    WHERE CURRENT_DATE BETWEEN fecha_inicio AND fecha_fin
    LIMIT 1;

    -- Si no hay periodo actual, devolvemos FALSE (no hay conflicto)
    IF v_periodo_actual_id IS NULL THEN
        RETURN FALSE;
    END IF;

    -- Verificar si ya existe una solicitud del mismo tipo en el periodo actual
    IF EXISTS (
        SELECT 1
        FROM Solicitudes
        WHERE estudiante_id = p_estudiante_id
          AND periodo_acad_id = v_periodo_actual_id
          AND tipo_solicitud_id = p_tipo_solicitud_id
    ) THEN
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;

END $$







DELIMITER ;
