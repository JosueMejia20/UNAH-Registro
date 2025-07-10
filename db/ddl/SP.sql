USE Registro;

DROP PROCEDURE IF EXISTS getAllFacultad;
DROP PROCEDURE IF EXISTS getFacultadByID;
DROP PROCEDURE IF EXISTS getAllEstado_Civil;
DROP PROCEDURE IF EXISTS getAllDepartamento_Pais;
DROP PROCEDURE IF EXISTS getAllPais;
DROP PROCEDURE IF EXISTS getAllCentro_Regional;
DROP PROCEDURE IF EXISTS getAllCarrera;
DROP PROCEDURE IF EXISTS getCarrerasByCentro;
DROP PROCEDURE IF EXISTS InsertarPostulanteEInscripcion;
DROP PROCEDURE IF EXISTS getAllSolicitudesByRevisor;
DROP PROCEDURE IF EXISTS AsignarRevisores;
DROP PROCEDURE IF EXISTS CambiarEstadoRevision;

DELIMITER $$

CREATE PROCEDURE getAllFacultad()
BEGIN
	SELECT * FROM Facultad;
END $$

CREATE PROCEDURE getFacultadByID(
	IN f_id INT
)
BEGIN
	SELECT * FROM Facultad WHERE facultad_id = f_id;
END $$

CREATE PROCEDURE getAllEstado_Civil()
BEGIN
	SELECT * FROM Estado_Civil;
END $$

CREATE PROCEDURE getAllDepartamento_Pais()
BEGIN
	SELECT * FROM Departamento_Pais;
END $$

CREATE PROCEDURE getAllPais()
BEGIN
	SELECT * FROM Pais;
END $$

CREATE PROCEDURE getAllCentro_Regional()
BEGIN
	SELECT * FROM Centro_Regional;
END $$

CREATE PROCEDURE getAllCarrera()
BEGIN
	SELECT * FROM Carrera;
END $$

CREATE PROCEDURE getCarrerasByCentro(
	IN centro_id INT
)
BEGIN
	SELECT c.carrera_id, c.nombre_carrera
	FROM Carrera c
	INNER JOIN Carrera_Centro_Regional cc ON c.carrera_id = cc.carrera_id
	WHERE cc.centro_regional_id = centro_id;
END $$


CREATE PROCEDURE InsertarPostulanteEInscripcion(
    -- Dirección
    IN p_departamento_id INT,
    IN p_descripcion_direccion VARCHAR(250),

    -- Postulante
    IN p_dni VARCHAR(25),
    IN p_nombre_completo VARCHAR(70),
    IN p_apellido_completo VARCHAR(70),
    IN p_numero_telefono VARCHAR(20),
    IN p_correo_personal VARCHAR(50),
    IN p_genero CHAR(1),
    IN p_fecha_nacimiento DATE,
    IN p_estado_civil_id INT,
    IN p_instituto_educ_media VARCHAR(80),
    IN p_anio_graduacion YEAR,
    IN p_pais_estudio_id INT,

    -- Inscripción
    IN p_carrera_primaria INT,
    IN p_carrera_secundaria INT,
    IN p_centro_regional_id INT,
    IN p_imagen_certificado MEDIUMBLOB
)
BEGIN
    DECLARE v_direccion_id INT;
    DECLARE v_existe Int;
    
    SELECT COUNT(*) INTO v_existe FROM Postulante
    WHERE dni = p_dni;

	IF v_existe = 0 THEN
    -- 1. Insertar Dirección
    INSERT INTO Direccion(departamento_id, descripcion)
    VALUES (p_departamento_id, p_descripcion_direccion);
    
    SET v_direccion_id = LAST_INSERT_ID();

    -- 2. Insertar Postulante
    INSERT INTO Postulante(
        dni, nombre_completo, apellido_completo,
        numero_telefono, correo_personal, direccion_id,
        genero, fecha_nacimiento, estado_civil_id,
        instituto_educ_media, anio_graduacion, pais_estudio_id
    )
    VALUES (
        p_dni, p_nombre_completo, p_apellido_completo,
        p_numero_telefono, p_correo_personal, v_direccion_id,
        p_genero, p_fecha_nacimiento, p_estado_civil_id,
        p_instituto_educ_media, p_anio_graduacion, p_pais_estudio_id
    );

    -- 3. Insertar Inscripción
    INSERT INTO Inscripcion(
        postulante_id, carrera_primaria, carrera_secundaria,
        estado_revision_id, centro_regional_id,
        imagen_certificado, fecha_inscripcion
    )
    VALUES (
        p_dni, p_carrera_primaria, p_carrera_secundaria,
        1, p_centro_regional_id,
        p_imagen_certificado, NOW()
    );
    ELSE
		SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe un postulante con ese DNI';
    END IF;

END$$

CREATE PROCEDURE getAllSolicitudesByRevisor(
	IN p_revisor_id INT
)
BEGIN
	SELECT
		i.inscripcion_id,
		i.fecha_inscripcion,
        p.dni AS postulante_dni,
        CONCAT(p.nombre_completo, "", p.apellido_completo) AS nombre_postulante,
        cp.nombre_carrera AS carrera_primaria,
        er.nombre_estado AS estado_revision
        
	FROM Inscripcion i
    INNER JOIN Postulante p ON i.postulante_id = p.dni
    INNER JOIN Carrera cp ON i.carrera_primaria = cp.carrera_id
    INNER JOIN Estado_Revision er ON i.estado_revision_id = er.estado_revision_id
    
    WHERE i.revisor_id = p_revisor_id AND er.estado_revision_id = 1
    ORDER BY i.fecha_inscripcion ASC;
END $$



CREATE PROCEDURE AsignarRevisores()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE idx INT DEFAULT 0;
    DECLARE total_revisores INT;
    DECLARE total_inscripciones INT;
    DECLARE revisor_actual_id INT;

    -- Temporal para guardar IDs de revisores
    DROP TEMPORARY TABLE IF EXISTS RevisoresDisponibles;
    CREATE TEMPORARY TABLE RevisoresDisponibles (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT
    );

    -- Temporal para guardar inscripciones pendientes
    DROP TEMPORARY TABLE IF EXISTS InscripcionesPendientes;
    CREATE TEMPORARY TABLE InscripcionesPendientes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        inscripcion_id INT
    );

    -- Llenar tabla temporal con los revisores
    INSERT INTO RevisoresDisponibles (usuario_id)
    SELECT u.usuario_id
    FROM Usuario u
    JOIN Usuario_Rol ur ON u.usuario_id = ur.usuario_id
    JOIN Rol r ON ur.rol_id = r.rol_id
    WHERE r.rol_id = 1;

    -- Llenar tabla temporal con inscripciones sin revisor y estado pendiente
    INSERT INTO InscripcionesPendientes (inscripcion_id)
    SELECT i.inscripcion_id
    FROM Inscripcion i
    JOIN Estado_Revision er ON i.estado_revision_id = er.estado_revision_id
    WHERE i.revisor_id IS NULL
      AND er.estado_revision_id = 1;

    -- Obtener conteos
    SELECT COUNT(*) INTO total_revisores FROM RevisoresDisponibles;
    SELECT COUNT(*) INTO total_inscripciones FROM InscripcionesPendientes;

    IF total_revisores = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No hay revisores disponibles.';
    END IF;

    -- Loop para asignar inscripciones una por una a los revisores en forma rotativa
    WHILE idx < total_inscripciones DO
        SET revisor_actual_id = (
            SELECT usuario_id
            FROM RevisoresDisponibles
            WHERE id = ((idx MOD total_revisores) + 1)
        );

        UPDATE Inscripcion i
        JOIN InscripcionesPendientes ip ON i.inscripcion_id = ip.inscripcion_id
        SET i.revisor_id = revisor_actual_id
        WHERE ip.id = idx + 1;

        SET idx = idx + 1;
    END WHILE;
END $$

CREATE PROCEDURE CambiarEstadoRevision(
    IN p_inscripcion_id INT,
    IN p_valor TINYINT
)
BEGIN
    IF p_valor = 0 THEN
        UPDATE Inscripcion
        SET estado_revision_id = 3
        WHERE inscripcion_id = p_inscripcion_id;
        
    ELSEIF p_valor = 1 THEN
        UPDATE Inscripcion
        SET estado_revision_id = 2
        WHERE inscripcion_id = p_inscripcion_id;
        
    ELSE
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Valor inválido. Solo se permite 0 o 1.';
    END IF;
END $$

DELIMITER ;


