USE Registro;

DROP TRIGGER IF EXISTS trg_AfterInsertInscripcion;
DROP TRIGGER IF EXISTS antes_insertar_usuario;
DROP TRIGGER IF EXISTS before_insert_inscripcion;
DROP TRIGGER IF EXISTS trg_cancelar_seccion_matriculada;
DROP TRIGGER IF EXISTS after_update_solicitud_contacto;
DROP TRIGGER IF EXISTS UsuarioRoles_InsertEstudiante;
DROP TRIGGER IF EXISTS UsuarioRoles_InsertDocente;
DROP TRIGGER IF EXISTS trg_calcular_indices_estudiante;
DROP TRIGGER IF EXISTS trg_calcular_indices_estudiante_update;

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



CREATE TRIGGER after_update_solicitud_contacto
AFTER UPDATE ON Solicitudes_Contacto
FOR EACH ROW
BEGIN
  -- Solo si el nuevo estado es 3 y el anterior no lo era (para evitar reinserciones)
  IF NEW.estado_solicitud_id = 3 AND OLD.estado_solicitud_id <> 3 THEN
    INSERT INTO Contactos (estudiante_1_id, estudiante_2_id, fecha_contacto)
    VALUES (NEW.emisor_id, NEW.receptor_id, NOW());
  END IF;
END$$


CREATE TRIGGER UsuarioRoles_InsertEstudiante
AFTER INSERT ON Estudiante
FOR EACH ROW
BEGIN
    INSERT INTO Usuario_Rol (usuario_id, rol_id)
    VALUES (NEW.usuario_id, 2);
END $$


CREATE TRIGGER UsuarioRoles_InsertDocente
AFTER INSERT ON Docente
FOR EACH ROW
BEGIN
    INSERT INTO Usuario_Rol (usuario_id, rol_id)
    VALUES (NEW.usuario_id, 3);
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

CREATE TRIGGER trg_calcular_indices_estudiante
AFTER INSERT ON Estudiantes_Secciones
FOR EACH ROW
BEGIN
    DECLARE v_periodo_acad_id INT;
    DECLARE v_indice_periodo DECIMAL(5,2);
    DECLARE v_indice_global DECIMAL(5,2);
    DECLARE v_suma_notas_uv_periodo DECIMAL(10,2);
    DECLARE v_suma_uv_periodo DECIMAL(10,2);
    DECLARE v_suma_notas_uv_global DECIMAL(10,2);
    DECLARE v_suma_uv_global DECIMAL(10,2);
    DECLARE v_existe_registro INT DEFAULT 0;
    
    -- Obtener periodo de la seccion
    SELECT periodo_acad_id 
    INTO v_periodo_acad_id
    FROM Seccion 
    WHERE id = NEW.seccion_id;
    
    -- Verificar si ya existe un registro para este estudiante y periodo
    SELECT COUNT(*) 
    INTO v_existe_registro
    FROM Indices_Estudiantes 
    WHERE estudiante_id = NEW.estudiante_id 
      AND periodo_acad_id = v_periodo_acad_id;
    
    -- CALCULAR INDICE DEL PERIODO
    SELECT 
        COALESCE(SUM(es.nota * c.unidades_valorativas), 0),
        COALESCE(SUM(c.unidades_valorativas), 0)
    INTO 
        v_suma_notas_uv_periodo,
        v_suma_uv_periodo
    FROM Estudiantes_Secciones es
    INNER JOIN Seccion s ON es.seccion_id = s.id
    INNER JOIN Clase c ON s.clase_id = c.clase_id
    WHERE es.estudiante_id = NEW.estudiante_id
      AND s.periodo_acad_id = v_periodo_acad_id
      AND es.nota > 0;  -- Excluir notas = 0
    
    -- Verificacion
    IF v_suma_uv_periodo > 0 THEN
        SET v_indice_periodo = v_suma_notas_uv_periodo / v_suma_uv_periodo;
    ELSE
        SET v_indice_periodo = 0.00;
    END IF;
    
    -- CALCULAR INDICE GLOBAL
    SELECT 
        COALESCE(SUM(es.nota * c.unidades_valorativas), 0),
        COALESCE(SUM(c.unidades_valorativas), 0)
    INTO 
        v_suma_notas_uv_global,
        v_suma_uv_global
    FROM Estudiantes_Secciones es
    INNER JOIN Seccion s ON es.seccion_id = s.id
    INNER JOIN Clase c ON s.clase_id = c.clase_id
    WHERE es.estudiante_id = NEW.estudiante_id
      AND es.nota > 0;  -- Excluir notas = 0
    
    -- Verfificacion
    IF v_suma_uv_global > 0 THEN
        SET v_indice_global = v_suma_notas_uv_global / v_suma_uv_global;
    ELSE
        SET v_indice_global = 0.00;
    END IF;
    
    -- INSERTAR O ACTUALIZAR segun si existe el registro
    IF v_existe_registro = 0 THEN
        -- Insert si no existe un registro con el estudiante y periodo
        INSERT INTO Indices_Estudiantes (
            estudiante_id,
            periodo_acad_id,
            indice_periodo,
            indice_global,
            fecha_calculo
        ) VALUES (
            NEW.estudiante_id,
            v_periodo_acad_id,
            v_indice_periodo,
            v_indice_global,
            NOW()
        );
    ELSE
        -- Update si ya existe un registro con el estudiante y periodo
        UPDATE Indices_Estudiantes 
        SET 
            indice_periodo = v_indice_periodo,
            indice_global = v_indice_global,
            fecha_calculo = NOW()
        WHERE estudiante_id = NEW.estudiante_id 
          AND periodo_acad_id = v_periodo_acad_id;
    END IF;
    
END$$




-- SE AGREGO EL TRG ON UPDATE POR EL ON DUPLICATE KEY UPDATE DEL SP de Estudiantes_Secciones
-- Es casi igual que el anterior
CREATE TRIGGER trg_calcular_indices_estudiante_update
AFTER UPDATE ON Estudiantes_Secciones
FOR EACH ROW
BEGIN
    DECLARE v_periodo_acad_id INT;
    DECLARE v_indice_periodo DECIMAL(5,2);
    DECLARE v_indice_global DECIMAL(5,2);
    DECLARE v_suma_notas_uv_periodo DECIMAL(10,2);
    DECLARE v_suma_uv_periodo DECIMAL(10,2);
    DECLARE v_suma_notas_uv_global DECIMAL(10,2);
    DECLARE v_suma_uv_global DECIMAL(10,2);
    DECLARE v_existe_registro INT DEFAULT 0;
    
    SELECT periodo_acad_id 
    INTO v_periodo_acad_id
    FROM Seccion 
    WHERE id = NEW.seccion_id;
    
    SELECT COUNT(*) 
    INTO v_existe_registro
    FROM Indices_Estudiantes 
    WHERE estudiante_id = NEW.estudiante_id 
      AND periodo_acad_id = v_periodo_acad_id;
    
    -- CALCULAR INDICE DEL PERIODO
    SELECT 
        COALESCE(SUM(es.nota * c.unidades_valorativas), 0),
        COALESCE(SUM(c.unidades_valorativas), 0)
    INTO 
        v_suma_notas_uv_periodo,
        v_suma_uv_periodo
    FROM Estudiantes_Secciones es
    INNER JOIN Seccion s ON es.seccion_id = s.id
    INNER JOIN Clase c ON s.clase_id = c.clase_id
    WHERE es.estudiante_id = NEW.estudiante_id
      AND s.periodo_acad_id = v_periodo_acad_id
      AND es.nota > 0;  -- Excluir notas = 0
    
    IF v_suma_uv_periodo > 0 THEN
        SET v_indice_periodo = v_suma_notas_uv_periodo / v_suma_uv_periodo;
    ELSE
        SET v_indice_periodo = 0.00;
    END IF;
    
    -- CALCULAR INDICE GLOBAL
    SELECT 
        COALESCE(SUM(es.nota * c.unidades_valorativas), 0),
        COALESCE(SUM(c.unidades_valorativas), 0)
    INTO 
        v_suma_notas_uv_global,
        v_suma_uv_global
    FROM Estudiantes_Secciones es
    INNER JOIN Seccion s ON es.seccion_id = s.id
    INNER JOIN Clase c ON s.clase_id = c.clase_id
    WHERE es.estudiante_id = NEW.estudiante_id
      AND es.nota > 0;  -- Excluir notas = 0
    
    IF v_suma_uv_global > 0 THEN
        SET v_indice_global = v_suma_notas_uv_global / v_suma_uv_global;
    ELSE
        SET v_indice_global = 0.00;
    END IF;
    
    IF v_existe_registro = 0 THEN
        INSERT INTO Indices_Estudiantes (
            estudiante_id,
            periodo_acad_id,
            indice_periodo,
            indice_global,
            fecha_calculo
        ) VALUES (
            NEW.estudiante_id,
            v_periodo_acad_id,
            v_indice_periodo,
            v_indice_global,
            NOW()
        );
    ELSE
        UPDATE Indices_Estudiantes 
        SET 
            indice_periodo = v_indice_periodo,
            indice_global = v_indice_global,
            fecha_calculo = NOW()
        WHERE estudiante_id = NEW.estudiante_id 
          AND periodo_acad_id = v_periodo_acad_id;
    END IF;
    
END$$


DELIMITER ;