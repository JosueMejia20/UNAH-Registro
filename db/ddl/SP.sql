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

DELIMITER ;


