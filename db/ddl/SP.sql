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
DROP PROCEDURE IF EXISTS ObtenerClasesPorDepartamentoYEstudiante;
DROP PROCEDURE IF EXISTS ObtenerSeccionesPorClasePeriodoActual;
DROP PROCEDURE IF EXISTS InsertarEstudianteMatricula;
DROP PROCEDURE IF EXISTS ObtenerSeccionesActualesEstudiante;
DROP PROCEDURE IF EXISTS UpdateEstudiante;
DROP PROCEDURE IF EXISTS obtenerFotoPerfilEstudiante;
DROP PROCEDURE IF EXISTS CancelarMatriculaEstudiante;
DROP PROCEDURE IF EXISTS ObtenerSolicitudesEstudiante;
DROP PROCEDURE IF EXISTS ObtenerCarrerasCentroExcepActualEstudiante;
DROP PROCEDURE IF EXISTS ObtenerCentrosExcepActualEstudiante;
DROP PROCEDURE IF EXISTS InsertarSolicitudCambioCarrera;
DROP PROCEDURE IF EXISTS InsertarSolicitudCambioCentro;
DROP PROCEDURE IF EXISTS InsertarSolicitudPagoReposicion;
DROP PROCEDURE IF EXISTS InsertarSolicitudCancelacionExcepc;
DROP PROCEDURE IF EXISTS ObtenerContactosEstudiante;
DROP PROCEDURE IF EXISTS ObtenerMensajesEntreEstudiantes;
DROP PROCEDURE IF EXISTS ObtenerSolicitudesContactoPorReceptor;
DROP PROCEDURE IF EXISTS AceptarSolicitudContacto;
DROP PROCEDURE IF EXISTS RechazarSolicitudContacto;
DROP PROCEDURE IF EXISTS InsertarMensaje;
DROP PROCEDURE IF EXISTS InsertarSolicitudContacto;
DROP PROCEDURE IF EXISTS ObtenerDocentesActualesPorEstudiante;
DROP PROCEDURE IF EXISTS ObtenerDatosDocente;
DROP PROCEDURE IF EXISTS ObtenerAsignaturasActualesDocente;
DROP PROCEDURE IF EXISTS obtenerTiposDeRecurso;
DROP PROCEDURE IF EXISTS GetClasesPorDocente;
DROP PROCEDURE IF EXISTS InsertarAutor;
DROP PROCEDURE IF EXISTS InsertarTag;
DROP PROCEDURE IF EXISTS InsertarRecurso;
DROP PROCEDURE IF EXISTS RelacionarAutorRecurso;
DROP PROCEDURE IF EXISTS RelacionarTagRecurso;
DROP PROCEDURE IF EXISTS RelacionarClaseRecurso;
DROP PROCEDURE IF EXISTS GetRecursosDetallados;
DROP PROCEDURE IF EXISTS RecursoDetalle;
DROP PROCEDURE IF EXISTS RecursoPortadaArchivo;
DROP PROCEDURE IF EXISTS ActualizarRecurso;
DROP PROCEDURE IF EXISTS EliminarRecurso;
DROP PROCEDURE IF EXISTS ObtenerHistorialEstudiante;
DROP PROCEDURE IF EXISTS ActualizarFotoDocente;
DROP PROCEDURE IF EXISTS ObtenerFotoPerfilDocente;
DROP PROCEDURE IF EXISTS ObtenerClasesEstudiante;
DROP PROCEDURE IF EXISTS InsertarEvaluacionDocente;
DROP PROCEDURE IF EXISTS ContarSolicitudesEstudiante;
DROP PROCEDURE IF EXISTS ObtenerNumeroCuentaEstudiante;
DROP PROCEDURE IF EXISTS ObtenerNumeroEmpleadoDocente;
DROP PROCEDURE IF EXISTS GetRecursosDetalladosEstudiante;
DROP PROCEDURE IF EXISTS ObtenerEstudiantesPorSeccion;



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
        i.numero_solicitud AS numero_solicitud,
        p.numero_telefono  AS telefono,
        p.correo_personal AS correo_personal,
        p.genero AS genero,
        p.instituto_educ_media AS instituto_educacion_media,
        p.anio_graduacion AS anio_graduacion,
        pa.pais_id AS pais_estudio,
        p.fecha_nacimiento AS fecha_nacimiento,
		i.inscripcion_id AS inscripcion_id,
		CONCAT(p.nombre_completo, ' ', p.apellido_completo) AS nombre_postulante,
		cp.nombre_carrera AS carrera_primaria,
        cs.nombre_carrera AS carrera_secundaria,
		i.fecha_inscripcion AS fecha_inscripcion,
        cr.nombre_centro AS centro_regional,
        er.nombre_estado AS estado_revision,
        i.imagen_certificado AS documento_adjunto,
        ec.nombre_estado_civil AS estado_civil,
        CONCAT(dir.descripcion, ', ',dp.nombre_departamento) AS direccion
        
	FROM Inscripcion i
    INNER JOIN Postulante p ON i.postulante_id = p.dni
    INNER JOIN Pais pa ON p.pais_estudio_id = pa.pais_id
    INNER JOIN Centro_Regional cr ON i.centro_regional_id = cr.centro_regional_id
    INNER JOIN Carrera cp ON i.carrera_primaria = cp.carrera_id
    INNER JOIN Carrera cs ON i.carrera_secundaria = cs.carrera_id
    INNER JOIN Estado_Revision er ON i.estado_revision_id = er.estado_revision_id
    INNER JOIN Estado_Civil ec ON p.estado_civil_id = ec.estado_civil_id
    INNER JOIN Direccion dir ON p.direccion_id = dir.direccion_id
    INNER JOIN Departamento_Pais dp ON dir.departamento_id = dp.departamento_id
    
    WHERE i.inscripcion_id = f_inscripcion_id;
END $$

CREATE PROCEDURE getEstudianteInfo(
	IN f_estudiante_id VARCHAR(11)
)
BEGIN
	SELECT
		CONCAT(p.nombre_completo, ' ', p.apellido_completo) AS nombre_estudiante,
        p.correo_personal AS correo_personal,
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

CREATE PROCEDURE ObtenerClasesPorDepartamentoYEstudiante(
    IN p_numero_cuenta VARCHAR(11),
    IN p_departamento_id INT
)
BEGIN
    SELECT c.*
    FROM Clase c
    INNER JOIN Clases_Carrera cc ON c.clase_id = cc.clase_id
    INNER JOIN Estudiante e ON cc.carrera_id = e.carrera_id
    WHERE e.numero_cuenta = p_numero_cuenta
      AND c.departamento_id = p_departamento_id;
END$$


CREATE PROCEDURE ObtenerSeccionesPorClasePeriodoActual(
    IN p_clase_id INT
)
BEGIN
    SELECT 
        s.id AS seccion_id,
        s.codigo_seccion,
        DATE_FORMAT(s.hora_inicio, '%H:%i') AS hora_inicio,
        DATE_FORMAT(s.hora_fin, '%H:%i') AS hora_fin,
        di.nombre AS dias,
        s.cupos,
        d.numero_empleado AS docente_id,
        p.nombre_completo AS nombre_docente,
        a.nombre AS aula,
        e.nombre AS edificio,
        du.nombre_departamento AS departamento_universidad,
        per.nombre AS periodo_academico
    FROM Seccion s
    JOIN Docente d ON s.docente_id = d.numero_empleado
    JOIN Persona p ON d.persona_id = p.dni
    JOIN Aula_Edificio a ON s.aula_id = a.id
    JOIN Edificio e ON a.edificio_id = e.edificio_id
    JOIN Centro_Regional cr ON e.centro_reg_id = cr.centro_regional_id
    JOIN Periodo_Academico per ON s.periodo_acad_id = per.id
    JOIN Clase c ON s.clase_id = c.clase_id
    JOIN Carrera ca ON c.departamento_id = ca.departamento_id
    JOIN Departamento_Uni du ON ca.departamento_id = du.departamento_id
    JOIN Dias di ON s.dias_id = di.id
    WHERE s.clase_id = p_clase_id
      AND CURRENT_DATE BETWEEN per.fecha_inicio AND per.fecha_fin
    ORDER BY s.codigo_seccion, s.hora_inicio;
END$$


CREATE PROCEDURE InsertarEstudianteMatricula(
    IN p_estudiante_id VARCHAR(11),
    IN p_seccion_id INT
)
BEGIN
    DECLARE v_periodo_acad_id INT;

    -- Obtener el periodo académico desde la sección
    SELECT periodo_acad_id
    INTO v_periodo_acad_id
    FROM Seccion
    WHERE id = p_seccion_id;

    -- Insertar en la tabla Estudiantes_Matricula
    INSERT INTO Estudiantes_Matricula(estudiante_id, seccion_id, periodo_acad_id)
    VALUES (p_estudiante_id, p_seccion_id, v_periodo_acad_id);
END$$


CREATE PROCEDURE ObtenerSeccionesActualesEstudiante(
    IN p_estudiante_id VARCHAR(11)
)
BEGIN
    SELECT 
        s.id AS seccion_id,
        s.codigo_seccion AS codigo_seccion,
		CONCAT(DATE_FORMAT(s.hora_inicio, '%H:%i'),' - ',DATE_FORMAT(s.hora_fin, '%H:%i')) AS horario,
        di.nombre AS dias,
        c.nombre_clase AS nombre_clase,
        c.codigo AS codigo_clase,
        CONCAT(p.nombre_completo, ' ', p.apellido_completo) AS nombre_docente,
        per.nombre AS periodo,
        a.nombre AS aula,
        e.nombre AS edificio
    FROM Estudiantes_Matricula em
    JOIN Seccion s ON em.seccion_id = s.id
    JOIN Clase c ON s.clase_id = c.clase_id
    JOIN Docente d ON s.docente_id = d.numero_empleado
    JOIN Persona p ON d.persona_id = p.dni
    JOIN Aula_Edificio a ON s.aula_id = a.id
    JOIN Edificio e ON a.edificio_id = e.edificio_id
    JOIN Periodo_Academico per ON em.periodo_acad_id = per.id
    JOIN Dias di ON s.dias_id = di.id
    WHERE em.estudiante_id = p_estudiante_id
      AND CURRENT_DATE BETWEEN per.fecha_inicio AND per.fecha_fin
    ORDER BY s.hora_inicio;
END$$


CREATE PROCEDURE UpdateEstudiante(
    IN p_estudiante_id VARCHAR(11),
    IN p_correo_personal VARCHAR(50),
    IN p_telefono VARCHAR(20),
    IN p_desc_direccion VARCHAR(250),
    IN p_foto_perfil MEDIUMBLOB
)
BEGIN
    DECLARE v_usuario_id INT;
    DECLARE v_persona_id VARCHAR(25);
    DECLARE v_direccion_id INT;

    -- Obtener usuario_id de Estudiante
    SELECT usuario_id INTO v_usuario_id
    FROM Estudiante
    WHERE numero_cuenta = p_estudiante_id;

    -- Obtener persona_id (dni) de Usuario
    SELECT persona_id INTO v_persona_id
    FROM Usuario
    WHERE usuario_id = v_usuario_id;

    -- Obtener direccion_id de Persona
    SELECT direccion_id INTO v_direccion_id
    FROM Persona
    WHERE dni = v_persona_id;

    -- Actualizar correo_institucional en Usuario
    UPDATE Persona
    SET correo_personal = p_correo_personal
    WHERE dni = v_persona_id;

    -- Actualizar telefono en Persona
    UPDATE Persona
    SET numero_telefono = p_telefono
    WHERE dni = v_persona_id;

    -- Actualizar descripcion en Direccion
    UPDATE Direccion
    SET descripcion = p_desc_direccion
    WHERE direccion_id = v_direccion_id;

    -- Actualizar foto_perfil en Estudiante
    UPDATE Estudiante
    SET foto_perfil = p_foto_perfil
    WHERE numero_cuenta = p_estudiante_id;

END $$

CREATE PROCEDURE obtenerFotoPerfilEstudiante(
	IN p_estudiante_id VARCHAR(11)
)
BEGIN
	SELECT foto_perfil FROM Estudiante WHERE numero_cuenta = p_estudiante_id;
END $$

CREATE PROCEDURE CancelarMatriculaEstudiante (
    IN p_estudiante_id VARCHAR(11),
    IN p_seccion_id INT
)
BEGIN
    DELETE FROM Estudiantes_Matricula
    WHERE estudiante_id = p_estudiante_id
      AND seccion_id = p_seccion_id;
END $$




CREATE PROCEDURE ObtenerSolicitudesEstudiante(
    IN p_estudiante_id VARCHAR(11),
    IN p_limite INT,
    IN p_offset INT
)
BEGIN
    SELECT 
        s.numero_solicitud AS solicitud_id,
        ts.nombre AS tipo_solicitud,
        DATE(s.fecha_solicitud) AS fecha_solicitud,
        COALESCE(es.nombre, epr.nombre, 'Desconocido') AS estado,
        
        -- Campos de cada tipo (pueden venir NULL según el tipo)
        scc.centro_nuevo_id,
        sccr.carrera_nueva_id,
        sce.seccion_id,
        spr.estado_pago_reposicion_id
        
    FROM Solicitudes s
    INNER JOIN Tipo_Solicitud ts ON ts.id = s.tipo_solicitud_id
    LEFT JOIN Solicitud_Cambio_Centro scc ON scc.solicitud_id = s.numero_solicitud
    LEFT JOIN Estado_Solicitudes es ON es.id = s.estado_solicitud_id

    LEFT JOIN Solicitud_Cambios_Carrera sccr ON sccr.solicitud_id = s.numero_solicitud

    LEFT JOIN Solicitud_Cancelacion_Excepc sce ON sce.solicitud_id = s.numero_solicitud

    LEFT JOIN Solicitud_Pago_Reposicion spr ON spr.solicitud_id = s.numero_solicitud
    LEFT JOIN Estado_Pago_Reposicion epr ON epr.id = spr.estado_pago_reposicion_id

    WHERE s.estudiante_id = p_estudiante_id
    ORDER BY s.fecha_solicitud DESC
    LIMIT p_limite OFFSET p_offset;
END $$


CREATE PROCEDURE ContarSolicitudesEstudiante(
    IN p_estudiante_id VARCHAR(11)
)
BEGIN
    SELECT COUNT(*) AS total
    FROM Solicitudes
    WHERE estudiante_id = p_estudiante_id;
END $$





CREATE PROCEDURE ObtenerCarrerasCentroExcepActualEstudiante(
    IN p_estudiante_id VARCHAR(11)
)
BEGIN
    DECLARE v_carrera_actual INT;
    DECLARE v_centro_actual INT;

    -- Obtener carrera y centro actual del estudiante
    SELECT carrera_id, centro_reg_id
    INTO v_carrera_actual, v_centro_actual
    FROM Estudiante
    WHERE numero_cuenta = p_estudiante_id;

    -- Traer todas las carreras del centro, excepto la actual
    SELECT 
        c.carrera_id AS carrera_id,
        c.nombre_carrera AS carrera_nombre
    FROM Carrera_Centro_Regional ccr
    INNER JOIN Carrera c ON ccr.carrera_id = c.carrera_id
    WHERE ccr.centro_regional_id = v_centro_actual
      AND c.carrera_id <> v_carrera_actual
    ORDER BY c.nombre_carrera;
END$$


CREATE PROCEDURE ObtenerCentrosExcepActualEstudiante(
    IN p_estudiante_id VARCHAR(11)
)
BEGIN
    DECLARE v_centro_actual INT;

    -- Obtener centro regional actual del estudiante
    SELECT centro_reg_id
    INTO v_centro_actual
    FROM Estudiante
    WHERE numero_cuenta = p_estudiante_id;

    -- Traer todos los centros excepto el actual
    SELECT 
        centro_regional_id AS centro_regional_id,
        nombre_centro AS centro_nombre
    FROM Centro_Regional
    WHERE centro_regional_id <> v_centro_actual
    ORDER BY nombre_centro;
END$$



CREATE PROCEDURE InsertarSolicitudCambioCentro (
    IN p_estudiante_id VARCHAR(11),
    IN p_centro_nuevo_id INT,
    IN p_observacion VARCHAR(255),
    IN p_archivoPDF MEDIUMBLOB
)
BEGIN
    DECLARE v_periodo_actual_id INT;
    DECLARE v_tipo_solicitud_id INT DEFAULT 2; -- Asumimos que 2 = Cambio de Centro Regional
    DECLARE v_solicitud_id INT;

    -- Obtener el período académico actual
    SELECT id INTO v_periodo_actual_id
    FROM Periodo_Academico
    WHERE CURRENT_DATE BETWEEN fecha_inicio AND fecha_fin
    LIMIT 1;

    -- Validación de existencia previa
    IF fn_existe_solicitud_en_periodo_actual(p_estudiante_id, v_tipo_solicitud_id) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe una solicitud de cambio de centro en el período actual.';
    ELSE
        -- Insertar en Solicitudes
        INSERT INTO Solicitudes (
            estudiante_id,
            periodo_acad_id,
            observacion,
            tipo_solicitud_id,
			estado_solicitud_id
        ) VALUES (
            p_estudiante_id,
            v_periodo_actual_id,
            p_observacion,
            v_tipo_solicitud_id,
            1
        );

        SET v_solicitud_id = LAST_INSERT_ID();

        -- Insertar en Solicitud_Cambio_Centro
        INSERT INTO Solicitud_Cambio_Centro (
            centro_nuevo_id,
            solicitud_id,
            archivoPDF
        ) VALUES (
            p_centro_nuevo_id,
            v_solicitud_id,
            p_archivoPDF
        );
    END IF;
END $$





CREATE PROCEDURE InsertarSolicitudCambioCarrera (
    IN p_estudiante_id VARCHAR(11),
    IN p_carrera_nueva_id INT,
    IN p_observacion VARCHAR(255),
    IN p_archivoPDF MEDIUMBLOB
)
BEGIN
    DECLARE v_periodo_actual_id INT;
    DECLARE v_tipo_solicitud_id INT DEFAULT 3; -- Asumimos que 3 = Cambio de Carrera
    DECLARE v_solicitud_id INT;

    -- Obtener el período académico actual
    SELECT id INTO v_periodo_actual_id
    FROM Periodo_Academico
    WHERE CURRENT_DATE BETWEEN fecha_inicio AND fecha_fin
    LIMIT 1;

    -- Validación de existencia previa
    IF fn_existe_solicitud_en_periodo_actual(p_estudiante_id, v_tipo_solicitud_id) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe una solicitud de cambio de carrera en el período actual.';
    ELSE
        -- Insertar en Solicitudes
        INSERT INTO Solicitudes (
            estudiante_id,
            periodo_acad_id,
            observacion,
            tipo_solicitud_id,
            estado_solicitud_id
        ) VALUES (
            p_estudiante_id,
            v_periodo_actual_id,
            p_observacion,
            v_tipo_solicitud_id,
            1
        );

        SET v_solicitud_id = LAST_INSERT_ID();

        -- Insertar en Solicitud_Cambios_Carrera
        INSERT INTO Solicitud_Cambios_Carrera (
            carrera_nueva_id,
            solicitud_id,
            archivoPDF
        ) VALUES (
            p_carrera_nueva_id,
            v_solicitud_id,
            p_archivoPDF
        );
    END IF;
END $$



CREATE PROCEDURE InsertarSolicitudPagoReposicion (
    IN p_estudiante_id VARCHAR(11),
    IN p_observacion VARCHAR(255)
)
BEGIN
    DECLARE v_periodo_id INT;
    DECLARE v_tipo_solicitud_id INT DEFAULT 1; -- Asumimos que 1 = Pago de Reposición
    DECLARE v_solicitud_id INT;

    -- Obtener el periodo académico actual
    SELECT id INTO v_periodo_id
    FROM Periodo_Academico
    WHERE CURDATE() BETWEEN fecha_inicio AND fecha_fin
    LIMIT 1;

    -- Validar si hay período activo
    IF v_periodo_id IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se encontró un período académico activo para la fecha actual.';
    END IF;

    -- Validar si ya existe una solicitud de reposición en este período
    IF fn_existe_solicitud_en_periodo_actual(p_estudiante_id, v_tipo_solicitud_id) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe una solicitud de pago de reposición en el período actual.';
    END IF;

    -- Insertar en Solicitudes
    INSERT INTO Solicitudes (
        estudiante_id,
        periodo_acad_id,
        observacion,
        tipo_solicitud_id,
        estado_solicitud_id
    ) VALUES (
        p_estudiante_id,
        v_periodo_id,
        p_observacion,
        v_tipo_solicitud_id,
        NULL
    );

    SET v_solicitud_id = LAST_INSERT_ID();

    -- Insertar en la tabla específica
    INSERT INTO Solicitud_Pago_Reposicion (
        estado_pago_reposicion_id,
        solicitud_id
    ) VALUES (
        1, -- Estado inicial: No pagado
        v_solicitud_id
    );
END $$



CREATE PROCEDURE InsertarSolicitudCancelacionExcepc(
    IN p_estudiante_id VARCHAR(11),
    IN p_justificacion VARCHAR(255),
    IN p_archivo_pdf MEDIUMBLOB,
    IN p_seccion_id INT
)
BEGIN
    DECLARE v_periodo_acad_id INT;
    DECLARE v_solicitud_id INT;
    DECLARE v_tipo_solicitud_id INT DEFAULT 4; -- Asumimos que 4 = Cancelación Excepcional

    -- Obtener el período académico actual
    SELECT id INTO v_periodo_acad_id
    FROM Periodo_Academico
    WHERE CURRENT_DATE BETWEEN fecha_inicio AND fecha_fin
    LIMIT 1;

    -- Validar si se encontró un período académico
    IF v_periodo_acad_id IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se encontró un período académico activo para la fecha actual.';
    END IF;

    -- Insertar en tabla central de Solicitudes
    INSERT INTO Solicitudes (
        estudiante_id,
        periodo_acad_id,
        observacion,
        tipo_solicitud_id,
        estado_solicitud_id
    ) VALUES (
        p_estudiante_id,
        v_periodo_acad_id,
        p_justificacion,
        v_tipo_solicitud_id,
        1
    );

    SET v_solicitud_id = LAST_INSERT_ID();

    -- Insertar en tabla específica de Cancelación Excepcional
    INSERT INTO Solicitud_Cancelacion_Excepc (
        solicitud_id,
        archivoPDF,
        seccion_id
    ) VALUES (
        v_solicitud_id,
        p_archivo_pdf,
        p_seccion_id
    );
END $$





CREATE PROCEDURE ObtenerContactosEstudiante(
    IN p_estudiante_id VARCHAR(11)
)
BEGIN
    SELECT 
        E.numero_cuenta AS contacto_id,
        concat(P.nombre_completo, ' ', P.apellido_completo) AS nombre_completo,
        C.fecha_contacto
    FROM Contactos C
    JOIN Estudiante E ON (
        (C.estudiante_1_id = p_estudiante_id AND C.estudiante_2_id = E.numero_cuenta) OR
        (C.estudiante_2_id = p_estudiante_id AND C.estudiante_1_id = E.numero_cuenta)
    )
    JOIN Usuario U ON U.usuario_id = E.usuario_id
    JOIN Persona P ON P.dni = U.persona_id
    ORDER BY C.fecha_contacto DESC;
END $$


CREATE PROCEDURE ObtenerMensajesEntreEstudiantes(
    IN p_estudiante1_id VARCHAR(11),
    IN p_estudiante2_id VARCHAR(11)
)
BEGIN
    SELECT 
        m.id,
        m.emisor_id,
        concat(emisor_p.nombre_completo, ' ', emisor_p.apellido_completo) AS nombre_emisor,
        m.receptor_id,
        concat(receptor_p.nombre_completo, ' ', receptor_p.apellido_completo) AS nombre_receptor,
        m.contenido,
        m.fecha_envio
    FROM Mensaje m
    INNER JOIN Estudiante emisor_e ON emisor_e.numero_cuenta = m.emisor_id
    INNER JOIN Usuario emisor_u ON emisor_u.usuario_id = emisor_e.usuario_id
    INNER JOIN Persona emisor_p ON emisor_p.dni = emisor_u.persona_id
    
    INNER JOIN Estudiante receptor_e ON receptor_e.numero_cuenta = m.receptor_id
    INNER JOIN Usuario receptor_u ON receptor_u.usuario_id = receptor_e.usuario_id
    INNER JOIN Persona receptor_p ON receptor_p.dni = receptor_u.persona_id

    WHERE 
        (m.emisor_id = p_estudiante1_id AND m.receptor_id = p_estudiante2_id)
        OR
        (m.emisor_id = p_estudiante2_id AND m.receptor_id = p_estudiante1_id)
    ORDER BY m.fecha_envio ASC;
END$$



CREATE PROCEDURE ObtenerSolicitudesContactoPorReceptor(
    IN p_receptor_id VARCHAR(11)
)
BEGIN
    SELECT 
        s.id AS solicitud_id,
        s.emisor_id AS emisor_id,
        CONCAT(p.nombre_completo, ' ', p.apellido_completo) AS nombre_completo_emisor,
        u.correo_institucional AS correo_institucional_emisor,
        s.fecha_solicitud AS fecha_solicitud
    FROM Solicitudes_Contacto s
    INNER JOIN Estudiante e ON s.emisor_id = e.numero_cuenta
    INNER JOIN Usuario u ON e.usuario_id = u.usuario_id
    INNER JOIN Persona p ON u.persona_id = p.dni
    WHERE s.receptor_id = p_receptor_id
      AND s.estado_solicitud_id = 1;
END$$



CREATE PROCEDURE AceptarSolicitudContacto(
    IN p_solicitud_id INT
)
BEGIN
    UPDATE Solicitudes_Contacto
    SET estado_solicitud_id = 3
    WHERE id = p_solicitud_id;
END$$

CREATE PROCEDURE RechazarSolicitudContacto(
    IN p_solicitud_id INT
)
BEGIN
    UPDATE Solicitudes_Contacto
    SET estado_solicitud_id = 2
    WHERE id = p_solicitud_id;
END$$




CREATE PROCEDURE InsertarMensaje (
    IN p_emisor_id VARCHAR(11),
    IN p_receptor_id VARCHAR(11),
    IN p_contenido VARCHAR(255)
)
BEGIN
    INSERT INTO Mensaje (emisor_id, receptor_id, contenido, fecha_envio)
    VALUES (p_emisor_id, p_receptor_id, p_contenido, NOW());
END $$



CREATE PROCEDURE InsertarSolicitudContacto(
    IN p_emisor_id VARCHAR(11),
    IN p_correo_institucional VARCHAR(50)
)
BEGIN
    DECLARE v_usuario_id INT;
    DECLARE v_receptor_id VARCHAR(11);

    -- 1. Obtener usuario_id a partir del correo institucional
    SELECT usuario_id INTO v_usuario_id
    FROM Usuario
    WHERE correo_institucional = p_correo_institucional
    LIMIT 1;

    -- 2. Obtener numero_cuenta del estudiante receptor
    SELECT numero_cuenta INTO v_receptor_id
    FROM Estudiante
    WHERE usuario_id = v_usuario_id
    LIMIT 1;

    -- 3. Insertar solicitud de contacto
    INSERT INTO Solicitudes_Contacto (
        emisor_id,
        receptor_id,
        estado_solicitud_id,
        fecha_solicitud
    )
    VALUES (
        p_emisor_id,
        v_receptor_id,
        1,
        NOW()
    );
END $$



CREATE PROCEDURE ObtenerDocentesActualesPorEstudiante (
    IN p_numero_cuenta VARCHAR(11)
)
BEGIN
    -- Declaramos una variable para la fecha actual
    DECLARE v_fecha_actual DATE;
    SET v_fecha_actual = CURDATE();

    SELECT 
        c.nombre_clase AS nombre_clase,
        s.id AS seccion_id,
        s.codigo_seccion AS codigo_seccion,
        d.numero_empleado AS numero_empleado_docente,
        concat(p.nombre_completo, ' ' ,p.apellido_completo) AS docente_nombre_completo,
        u.correo_institucional AS correo_institucional_docente
    FROM Estudiantes_Matricula em
    INNER JOIN Periodo_Academico pa ON em.periodo_acad_id = pa.id
    INNER JOIN Seccion s ON em.seccion_id = s.id
    INNER JOIN Clase c ON s.clase_id = c.clase_id
    INNER JOIN Docente d ON s.docente_id = d.numero_empleado
    INNER JOIN Persona p ON d.persona_id = p.dni
    INNER JOIN Usuario u ON d.usuario_id = u.usuario_id
    WHERE em.estudiante_id = p_numero_cuenta
      AND v_fecha_actual BETWEEN pa.fecha_inicio AND pa.fecha_fin;
END $$


CREATE PROCEDURE ObtenerDatosDocente (
    IN p_numero_empleado INT
)
BEGIN
    SELECT
		d.numero_empleado AS numero_empleado,
        CONCAT(p.nombre_completo, ' ', p.apellido_completo) AS nombre_completo,
        du.nombre_departamento,
        f.nombre_facultad,
        u.correo_institucional,
        p.numero_telefono,
        cr.nombre_centro AS centro_regional,
        (
            SELECT GROUP_CONCAT(r.nombre_rol SEPARATOR ', ')
            FROM Usuario_Rol ur
            INNER JOIN Rol r ON ur.rol_id = r.rol_id
            WHERE ur.usuario_id = u.usuario_id
        ) AS cargos
    FROM Docente d
    INNER JOIN Persona p ON d.persona_id = p.dni
    INNER JOIN Usuario u ON d.usuario_id = u.usuario_id
    INNER JOIN Departamento_Uni du ON d.departamento_id = du.departamento_id
    INNER JOIN Facultad f ON du.facultad_id = f.facultad_id
    INNER JOIN Centro_Regional cr ON d.centro_reg_id = cr.centro_regional_id
    WHERE d.numero_empleado = p_numero_empleado;
END $$




CREATE PROCEDURE ObtenerAsignaturasActualesDocente (
    IN p_docente_id INT
)
BEGIN
    DECLARE fecha_actual DATE;
    SET fecha_actual = CURDATE();

    SELECT 
        c.codigo AS codigo_clase,
        c.nombre_clase AS nombre_clase,
        s.codigo_seccion AS codigo_seccion,
        CONCAT(d.nombre, ', ', TIME_FORMAT(s.hora_inicio, '%H:%i'), '-', TIME_FORMAT(s.hora_fin, '%H:%i')) AS horario,
        CONCAT(e.nombre, '-', a.nombre) AS aula
    FROM Seccion s
    INNER JOIN Clase c ON s.clase_id = c.clase_id
    INNER JOIN Aula_Edificio a ON s.aula_id = a.id
    INNER JOIN Edificio e ON a.edificio_id = e.edificio_id
    INNER JOIN Periodo_Academico pa ON s.periodo_acad_id = pa.id
    INNER JOIN Dias d ON s.dias_id = d.id
    WHERE s.docente_id = p_docente_id
      AND fecha_actual BETWEEN pa.fecha_inicio AND pa.fecha_fin;
END $$

CREATE PROCEDURE obtenerTiposDeRecurso()
BEGIN
	SELECT * FROM Tipo_Recurso;
END $$

CREATE PROCEDURE GetClasesPorDocente(
    IN p_docente_id INT
)
BEGIN
    SELECT DISTINCT
        c.clase_id,
        c.codigo,
        c.nombre_clase,
        c.unidades_valorativas
    FROM Docente d
    INNER JOIN Departamento_Uni dep ON d.departamento_id = dep.departamento_id
    INNER JOIN Carrera ca ON ca.departamento_id = dep.departamento_id
    INNER JOIN Clases_Carrera cc ON cc.carrera_id = ca.carrera_id
    INNER JOIN Clase c ON c.clase_id = cc.clase_id
    WHERE d.numero_empleado = p_docente_id;
END $$



CREATE PROCEDURE InsertarAutor(
    IN p_nombre_completo VARCHAR(90),
    OUT p_autor_id INT
)
BEGIN
    INSERT INTO Autores(nombre_completo) VALUES (p_nombre_completo);
    SET p_autor_id = LAST_INSERT_ID();
END$$


CREATE PROCEDURE InsertarTag(
    IN p_nombre VARCHAR(60),
    OUT p_tag_id INT
)
BEGIN
    INSERT INTO Tags(nombre) VALUES (p_nombre);
    SET p_tag_id = LAST_INSERT_ID();
END$$


CREATE PROCEDURE InsertarRecurso(
    IN p_titulo VARCHAR(130),
    IN p_archivo MEDIUMBLOB,
    IN p_anio YEAR,
    IN p_portada MEDIUMBLOB,
    IN p_docente_id INT,
    IN p_tipo_recurso_id INT,
    IN p_descripcion VARCHAR(200),
    OUT p_recurso_id INT
)
BEGIN
    INSERT INTO Recursos(titulo, archivo, anio, portada, docente_id, tipo_recurso_id, descripcion)
    VALUES (p_titulo, p_archivo, p_anio, p_portada, p_docente_id, p_tipo_recurso_id, p_descripcion);
    
    SET p_recurso_id = LAST_INSERT_ID();
END$$


CREATE PROCEDURE RelacionarAutorRecurso(
    IN p_recurso_id INT,
    IN p_autor_id INT
)
BEGIN
    INSERT INTO Autores_Recursos(recurso_id, autor_id) VALUES (p_recurso_id, p_autor_id);
END$$


CREATE PROCEDURE RelacionarTagRecurso(
    IN p_recurso_id INT,
    IN p_tag_id INT
)
BEGIN
    INSERT INTO Recursos_Tags(recurso_id, tags_id) VALUES (p_recurso_id, p_tag_id);
END$$


CREATE PROCEDURE RelacionarClaseRecurso(
    IN p_recurso_id INT,
    IN p_clase_id INT
)
BEGIN
    INSERT INTO Recursos_Clase(recurso_id, clase_id) VALUES (p_recurso_id, p_clase_id);
END$$



CREATE PROCEDURE GetRecursosDetallados(
	IN p_docente_id INT
)
BEGIN
    SELECT 
        r.id,
        r.titulo,
        r.anio,
        r.portada,
        r.descripcion,
        tr.nombre AS tipo_recurso,
        
        -- Autores separados por coma
        (SELECT GROUP_CONCAT(a.nombre_completo SEPARATOR ', ')
         FROM Autores a
         INNER JOIN Autores_Recursos ar ON a.id = ar.autor_id
         WHERE ar.recurso_id = r.id) AS autores,
         
        -- Tags separados por coma
        (SELECT GROUP_CONCAT(t.nombre SEPARATOR ', ')
         FROM Tags t
         INNER JOIN Recursos_Tags tr2 ON t.id = tr2.tags_id
         WHERE tr2.recurso_id = r.id) AS tags,
         
        (SELECT GROUP_CONCAT(CONCAT(codigo, ' - ', nombre_clase) SEPARATOR ', ')
         FROM Clase c
         INNER JOIN Recursos_Clase cr ON c.clase_id = cr.clase_id
         WHERE cr.recurso_id = r.id) AS clases_asociadas
         
    FROM Recursos r
    INNER JOIN Tipo_Recurso tr ON r.tipo_recurso_id = tr.id
    
    WHERE EXISTS (
        SELECT 1
        FROM Recursos_Clase rc
        INNER JOIN Clases_Carrera cc ON rc.clase_id = cc.clase_id
        INNER JOIN Carrera ca ON cc.carrera_id = ca.carrera_id
        INNER JOIN Departamento_Uni du ON ca.departamento_id = du.departamento_id
        INNER JOIN Docente d ON d.departamento_id = du.departamento_id
        WHERE rc.recurso_id = r.id
          AND d.numero_empleado = p_docente_id
    );
END $$


CREATE PROCEDURE GetRecursosDetalladosEstudiante(
    IN p_estudiante_id VARCHAR(11)
)
BEGIN
    SELECT 
        r.id,
        r.titulo,
        r.anio,
        r.portada,
        r.descripcion,
        tr.nombre AS tipo_recurso,

        -- Autores separados por coma
        (SELECT GROUP_CONCAT(a.nombre_completo SEPARATOR ', ')
         FROM Autores a
         INNER JOIN Autores_Recursos ar ON a.id = ar.autor_id
         WHERE ar.recurso_id = r.id) AS autores,

        -- Tags separados por coma
        (SELECT GROUP_CONCAT(t.nombre SEPARATOR ', ')
         FROM Tags t
         INNER JOIN Recursos_Tags rt ON t.id = rt.tags_id
         WHERE rt.recurso_id = r.id) AS tags,

        -- Clases asociadas
        (SELECT GROUP_CONCAT(CONCAT(c.codigo, ' - ', c.nombre_clase) SEPARATOR ', ')
         FROM Clase c
         INNER JOIN Recursos_Clase rc2 ON c.clase_id = rc2.clase_id
         WHERE rc2.recurso_id = r.id) AS clases_asociadas

    FROM Recursos r
    INNER JOIN Tipo_Recurso tr ON r.tipo_recurso_id = tr.id
    WHERE EXISTS (
        SELECT 1
        FROM Recursos_Clase rc
        WHERE rc.recurso_id = r.id
          AND rc.clase_id IN (
              -- Clases que el estudiante curso
              SELECT s.clase_id
              FROM Estudiantes_Secciones es
              INNER JOIN Seccion s ON es.seccion_id = s.id
              WHERE es.estudiante_id = p_estudiante_id
              
              UNION

              -- Clases que el estudiante esta cursando
              SELECT s.clase_id
              FROM Estudiantes_Matricula em
              INNER JOIN Seccion s ON em.seccion_id = s.id
              WHERE em.estudiante_id = p_estudiante_id
          )
    );
END $$



CREATE PROCEDURE RecursoDetalle(IN p_recurso_id INT)
BEGIN
    SELECT 
        r.id,
        r.titulo,
        r.archivo,
        r.anio,
        r.descripcion,
        -- Autores separados por coma
        (SELECT GROUP_CONCAT(a.nombre_completo SEPARATOR ', ')
         FROM Autores a
         INNER JOIN Autores_Recursos ar ON a.id = ar.autor_id
         WHERE ar.recurso_id = r.id) AS autores,
         
         (SELECT GROUP_CONCAT(t.nombre SEPARATOR ', ')
         FROM Tags t
         INNER JOIN Recursos_Tags tr2 ON t.id = tr2.tags_id
         WHERE tr2.recurso_id = r.id) AS tags
         
    FROM Recursos r
    WHERE r.id = p_recurso_id;
END $$

CREATE PROCEDURE RecursoPortadaArchivo(IN p_recurso_id INT)
BEGIN
    SELECT 
        r.id,
        r.archivo,
		r.portada
    FROM Recursos r
    WHERE r.id = p_recurso_id;
END $$


CREATE PROCEDURE ActualizarRecurso(
    IN p_recurso_id INT,
    IN p_titulo VARCHAR(130),
    IN p_archivo MEDIUMBLOB,
    IN p_anio YEAR,
    IN p_portada MEDIUMBLOB,
    IN p_tipo_recurso_id INT,
    IN p_descripcion VARCHAR(200)
)
BEGIN
    UPDATE Recursos
    SET titulo = p_titulo,
        archivo = p_archivo,
        anio = p_anio,
        portada = p_portada,
        tipo_recurso_id = p_tipo_recurso_id,
        descripcion = p_descripcion
    WHERE id = p_recurso_id;

    DELETE FROM Autores_Recursos WHERE recurso_id = p_recurso_id;
    DELETE FROM Recursos_Tags WHERE recurso_id = p_recurso_id;
    DELETE FROM Recursos_Clase WHERE recurso_id = p_recurso_id;

   -- Desde el PHP hay que volver a hacer las relaciones e inserciones en autores, tags y clases.
END$$


CREATE PROCEDURE EliminarRecurso(
    IN p_recurso_id INT
)
BEGIN
    DELETE FROM Recursos
    WHERE id = p_recurso_id;
END$$



CREATE PROCEDURE ObtenerHistorialEstudiante (
    IN p_numero_cuenta VARCHAR(11)
)
BEGIN
    SELECT 
        e.numero_cuenta,
        concat(p.nombre_completo, ' ', p.apellido_completo) AS nombre_completo,
        c.codigo,
        c.nombre_clase,
        c.unidades_valorativas,
        es.nota,
        ec.nombre AS estado_clase
    FROM Estudiantes_Secciones es
    INNER JOIN Estudiante e ON es.estudiante_id = e.numero_cuenta
    INNER JOIN Usuario u ON e.usuario_id = u.usuario_id
    INNER JOIN Persona p ON u.persona_id = p.dni
    INNER JOIN Seccion s ON es.seccion_id = s.id
    INNER JOIN Clase c ON s.clase_id = c.clase_id
    INNER JOIN Estados_Clase ec ON es.estado_clase_id = ec.id
    WHERE e.numero_cuenta = p_numero_cuenta;
END$$


CREATE PROCEDURE ActualizarFotoDocente (
    IN p_numero_empleado INT,
    IN p_foto MEDIUMBLOB
)
BEGIN
    UPDATE Docente
    SET foto = p_foto
    WHERE numero_empleado = p_numero_empleado;
END $$



CREATE PROCEDURE ObtenerFotoPerfilDocente (
    IN p_numero_empleado INT
)
BEGIN
    SELECT
		d.foto AS foto_perfil
    FROM Docente d
    WHERE d.numero_empleado = p_numero_empleado;
END $$



CREATE PROCEDURE ObtenerClasesEstudiante (
    IN p_numero_cuenta VARCHAR(11)
)
BEGIN
    SELECT DISTINCT
        c.clase_id,
        c.nombre_clase,
        c.codigo,
        c.unidades_valorativas
    FROM (
        -- Clases ya cursadas
        SELECT s.clase_id
        FROM Estudiantes_Secciones es
        INNER JOIN Seccion s ON es.seccion_id = s.id
        WHERE es.estudiante_id = p_numero_cuenta

        UNION

        -- Clases actuales (matriculadas)
        SELECT s.clase_id
        FROM Estudiantes_Matricula em
        INNER JOIN Seccion s ON em.seccion_id = s.id
        WHERE em.estudiante_id = p_numero_cuenta
    ) AS clases_ids
    INNER JOIN Clase c ON clases_ids.clase_id = c.clase_id;
END $$


CREATE PROCEDURE InsertarEvaluacionDocente(
    IN p_estudiante_id VARCHAR(11),
    IN p_seccion_id INT,
    IN p_observacion VARCHAR(255),
    IN p_evidencia_pdf MEDIUMBLOB,
    IN p_evaluacion JSON
)
BEGIN
    INSERT INTO Evaluacion_Docente(
        estudiante_id,
        seccion_id,
        observacion,
        evidencia_pdf,
        evaluacion
    ) VALUES (
        p_estudiante_id,
        p_seccion_id,
        p_observacion,
        p_evidencia_pdf,
        p_evaluacion
    );
END $$


CREATE PROCEDURE ObtenerNumeroCuentaEstudiante(
    IN p_usuario_id INT,
    OUT p_numero_cuenta VARCHAR(11)
)
BEGIN
    SELECT numero_cuenta
    INTO p_numero_cuenta
    FROM Estudiante
    WHERE usuario_id = p_usuario_id
    LIMIT 1;
END $$


CREATE PROCEDURE ObtenerNumeroEmpleadoDocente(
    IN p_usuario_id INT,
    OUT p_numero_empleado INT
)
BEGIN
    SELECT numero_empleado
    INTO p_numero_empleado
    FROM Docente
    WHERE usuario_id = p_usuario_id
    LIMIT 1;
END $$


CREATE PROCEDURE ObtenerEstudiantesPorSeccion(
    IN p_seccion_id INT
)
BEGIN
    SELECT 
        e.numero_cuenta AS numero_cuenta,
        CONCAT(p.nombre_completo, ' ', p.apellido_completo) AS nombre_estudiante,
        c.nombre_carrera AS carrera,
        u.correo_institucional AS correo
    FROM Estudiantes_Matricula em
    INNER JOIN Estudiante e ON em.estudiante_id = e.numero_cuenta
    INNER JOIN Usuario u ON e.usuario_id = u.usuario_id
    INNER JOIN Persona p ON u.persona_id = p.dni
    INNER JOIN Carrera c ON e.carrera_id = c.carrera_id
    WHERE em.seccion_id = p_seccion_id;
END $$







DELIMITER ;

