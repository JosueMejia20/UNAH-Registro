USE Registro;

DROP TRIGGER IF EXISTS trg_AfterInsertInscripcion;
DROP TRIGGER IF EXISTS antes_insertar_usuario;
DROP TRIGGER IF EXISTS before_insert_inscripcion;
DROP TRIGGER IF EXISTS trg_cancelar_seccion_matriculada;

-- Triggers

DELIMITER $$

CREATE TRIGGER trg_AfterInsertInscripcion
AFTER INSERT ON Inscripcion
FOR EACH ROW
BEGIN
	INSERT INTO Inscripciones_Tipo_Examen (inscripcion_id, tipo_examen_id)
		SELECT DISTINCT
			NEW.inscripcion_id,
			ec.tipo_examen_id
		FROM Examen_Carrera ec
		WHERE ec.carrera_id IN (NEW.carrera_primaria, NEW.carrera_secundaria);

END $$


CREATE TRIGGER antes_insertar_usuario
BEFORE INSERT ON Usuario
FOR EACH ROW
BEGIN
    DECLARE correo_generado VARCHAR(50);
    DECLARE contrasenia_generada VARCHAR(20);
    
    CALL generar_correo_institucional(NEW.persona_id, correo_generado);
    SET NEW.correo_institucional = correo_generado;
    
    CALL generar_contrasenia_random(contrasenia_generada);
    SET NEW.contrasenia = contrasenia_generada;
END$$


CREATE TRIGGER before_insert_inscripcion
BEFORE INSERT ON Inscripcion
FOR EACH ROW
BEGIN
    DECLARE codigo VARCHAR(8);

    IF NEW.numero_solicitud IS NULL THEN
        CALL generar_codigo_solicitud(codigo);
        SET NEW.numero_solicitud = codigo;
    END IF;
END$$


CREATE TRIGGER trg_cancelar_seccion_matriculada
BEFORE DELETE ON Estudiantes_Matricula
FOR EACH ROW
BEGIN
  INSERT INTO Estudiante_Seccion_Cancelada(estudiante_id, seccion_id)
  VALUES (OLD.estudiante_id, OLD.seccion_id);
END $$

/* DESCONGELAR CUANDO SEA NECESARIO
CREATE TRIGGER before_insert_solicitud_carrera
BEFORE INSERT ON Solicitud_Cambios_Carrera
FOR EACH ROW
BEGIN
    DECLARE v_carrera_actual INT;
    DECLARE v_coordinador_id INT;

    -- Obtener la carrera actual del estudiante
    SELECT carrera_id
    INTO v_carrera_actual
    FROM Estudiante
    WHERE numero_cuenta = NEW.estudiante_id;

    -- Obtener el coordinador de esa carrera
    SELECT id
    INTO v_coordinador_id
    FROM Coordinadores_Carrera
    WHERE carrera_id = v_carrera_actual
    LIMIT 1;

    -- Asignar el coordinador a la nueva fila
    SET NEW.coordinador_id = v_coordinador_id;
END $$
*/



DELIMITER ;