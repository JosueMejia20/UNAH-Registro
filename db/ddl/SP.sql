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
DROP PROCEDURE IF EXISTS getInscripcionById;
DROP PROCEDURE IF EXISTS getEstudianteInfo;
DROP PROCEDURE IF EXISTS generar_codigo_solicitud;
DROP PROCEDURE IF EXISTS generar_correo_institucional;
DROP PROCEDURE IF EXISTS generar_contrasenia_random;
DROP PROCEDURE IF EXISTS ObtenerDepartamentosPorClaseCarrera;

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
        CONCAT(p.nombre_completo, " ", p.apellido_completo) AS nombre_postulante,
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

CREATE PROCEDURE getInscripcionById(
	IN f_inscripcion_id INT
)
BEGIN
	SELECT
		p.dni AS identidad_postulante,
        p.numero_telefono  AS telefono,
        p.correo_personal,
        p.genero,
        p.instituto_educ_media AS instituto_educacion_media,
        p.anio_graduacion,
        pa.pais_id AS pais_estudio,
        p.fecha_nacimiento,
		i.inscripcion_id,
		CONCAT(p.nombre_completo, ' ', p.apellido_completo) AS nombre_postulante,
		cp.nombre_carrera AS carrera_primaria,
        cs.nombre_carrera AS carrera_secundaria,
		i.fecha_inscripcion,
        cr.nombre_centro AS centro_regional,
        er.nombre_estado AS estado_revision,
        i.imagen_certificado AS documento_adjunto
        
	FROM Inscripcion i
    INNER JOIN Postulante p ON i.postulante_id = p.dni
    INNER JOIN Pais pa ON p.pais_estudio_id = pa.pais_id
    INNER JOIN Centro_Regional cr ON i.centro_regional_id = cr.centro_regional_id
    INNER JOIN Carrera cp ON i.carrera_primaria = cp.carrera_id
    INNER JOIN Carrera cs ON i.carrera_secundaria = cs.carrera_id
    INNER JOIN Estado_Revision er ON i.estado_revision_id = er.estado_revision_id
    
    WHERE i.inscripcion_id = f_inscripcion_id;
END $$

CREATE PROCEDURE getEstudianteInfo(
	IN f_estudiante_id VARCHAR(11)
)
BEGIN
	SELECT
		CONCAT(p.nombre_completo, ' ', p.apellido_completo) AS nombre_estudiante,
        c.nombre_carrera AS carrera_estudiante,
        e.numero_cuenta AS numero_cuenta,
        u.correo_institucional AS correo_institucional,
        p.numero_telefono AS telefono,
        d.descripcion AS direccion,
        p.fecha_nacimiento AS fecha_nacimiento,
        p.dni AS identidad_estudiante,
        cr.nombre_centro AS centro_regional,
        f.nombre_facultad AS facultad_estudiante,
        e.anio_ingreso AS anio_ingreso,
        e.estado AS estado_estudiante
        FROM Estudiante e
        INNER JOIN Usuario u ON e.usuario_id = u.usuario_id
        INNER JOIN Persona p ON p.dni = u.persona_id
        INNER JOIN Carrera c ON e.carrera_id = c.carrera_id
        INNER JOIN Direccion d ON p.direccion_id = d.direccion_id
        INNER JOIN Centro_Regional cr ON e.centro_reg_id = cr.centro_regional_id
        INNER JOIN Departamento_Uni du ON c.departamento_id = du.departamento_id
        INNER JOIN Facultad f ON du.facultad_id = f.facultad_id
        
        WHERE e.numero_cuenta = f_estudiante_id;
END $$


CREATE PROCEDURE generar_correo_institucional(
    IN p_persona_id VARCHAR(25),
    OUT p_correo VARCHAR(50)
)
BEGIN
    DECLARE nombre VARCHAR(70);
    DECLARE apellido VARCHAR(70);
    DECLARE base_correo VARCHAR(50);
    DECLARE sufijo INT DEFAULT 0;

    -- Obtener nombres y apellidos
    SELECT nombre_completo, apellido_completo
    INTO nombre, apellido
    FROM Persona
    WHERE dni = p_persona_id;

    -- Construir base del correo
    SET base_correo = CONCAT(
        LOWER(LEFT(nombre, 2)),
        LOWER(SUBSTRING_INDEX(apellido, ' ', 1)),
        LOWER(LEFT(SUBSTRING_INDEX(apellido, ' ', -1), 1))
    );

    -- Generar sufijo para que el correo sea único
    REPEAT
        IF sufijo = 0 THEN
            SET p_correo = CONCAT(base_correo, '@unah.hn');
        ELSE
            SET p_correo = CONCAT(base_correo, sufijo, '@unah.hn');
        END IF;
        SET sufijo = sufijo + 1;
    UNTIL NOT EXISTS (
        SELECT 1 FROM Usuario WHERE correo_institucional = p_correo
    )
    END REPEAT;

END$$


CREATE PROCEDURE generar_contrasenia_random(
    OUT p_contrasenia VARCHAR(20)
)
BEGIN
    SET p_contrasenia = SUBSTRING(
        CONCAT(
            SHA2(UUID(), 512),
            SHA2(RAND(), 512)
        ), 1, 10
    );
END$$


CREATE PROCEDURE generar_codigo_solicitud(OUT codigo_generado VARCHAR(8))
BEGIN
    DECLARE caracteres CHAR(36) DEFAULT 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    DECLARE longitud INT DEFAULT 8;
    DECLARE i INT DEFAULT 0;
    DECLARE caracter CHAR(1);
    DECLARE generado VARCHAR(8) DEFAULT '';
    DECLARE existe INT;

    REPEAT
        SET generado = '';
        SET i = 0;

        WHILE i < longitud DO
            SET caracter = SUBSTRING(caracteres, FLOOR(1 + RAND() * 36), 1);
            SET generado = CONCAT(generado, caracter);
            SET i = i + 1;
        END WHILE;

        -- Verificar si ya existe
        SELECT COUNT(*) INTO existe
        FROM Inscripcion
        WHERE numero_solicitud = generado;

    UNTIL existe = 0
    END REPEAT;

    SET codigo_generado = generado;
END$$

CREATE PROCEDURE ObtenerDepartamentosPorClaseCarrera(IN p_estudiante_id VARCHAR(11))
BEGIN
    DECLARE v_carrera_id INT;

    -- Obtener la carrera del estudiante
    SELECT carrera_id INTO v_carrera_id
    FROM Estudiante
    WHERE numero_cuenta = p_estudiante_id;

        -- Consultar departamentos de las clases de la malla curricular
        SELECT DISTINCT d.departamento_id, d.nombre_departamento
        FROM Clases_Carrera cc
        INNER JOIN Clase c ON cc.clase_id = c.clase_id
        INNER JOIN Departamento_Uni d ON c.departamento_id = d.departamento_id
        WHERE cc.carrera_id = v_carrera_id;

END$$

DELIMITER ;


