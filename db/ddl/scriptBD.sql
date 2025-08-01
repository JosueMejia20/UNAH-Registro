DROP DATABASE IF EXISTS Registro;

CREATE DATABASE Registro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE Registro;

CREATE TABLE Facultad(
	facultad_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_facultad VARCHAR(70) NOT NULL
);

CREATE TABLE Departamento_Pais(
	departamento_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_departamento VARCHAR(70) NOT NULL
);

CREATE TABLE Estado_Civil(
	estado_civil_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_estado_civil VARCHAR(50) NOT NULL
);

CREATE TABLE Pais(
	pais_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_pais VARCHAR(50) NOT NULL
);

CREATE TABLE Direccion(
	direccion_id INT AUTO_INCREMENT PRIMARY KEY,
    departamento_id INT NOT NULL,
    descripcion VARCHAR(250) NOT NULL,
    
    FOREIGN KEY (departamento_id) REFERENCES Departamento_Pais(departamento_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);



CREATE TABLE Departamento_Uni(
	departamento_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_departamento VARCHAR(70) NOT NULL,
    facultad_id INT NOT NULL,
    
    FOREIGN KEY (facultad_id) REFERENCES Facultad(facultad_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Carrera(
	carrera_id INT AUTO_INCREMENT PRIMARY KEY,
    departamento_id INT NOT NULL,
    nombre_carrera VARCHAR(70) NOT NULL,
    nota_minima_PAA SMALLINT UNSIGNED NOT NULL,
    
    FOREIGN KEY (departamento_id) REFERENCES Departamento_Uni(departamento_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Tipo_Examen(
	tipo_examen_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_examen VARCHAR(60),
    nota_minima SMALLINT UNSIGNED NOT NULL,
    nota_maxima SMALLINT UNSIGNED NOT NULL
);

CREATE TABLE Examen_Carrera(
	id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_examen_id INT NOT NULL,
    carrera_id INT NOT NULL,
    
    FOREIGN KEY (tipo_examen_id) REFERENCES Tipo_Examen(tipo_examen_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (carrera_id) REFERENCES Carrera(carrera_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Centro_Regional(
	centro_regional_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_centro VARCHAR(70) NOT NULL,
    departamento_id INT NOT NULL,
    
    FOREIGN KEY (departamento_id) REFERENCES Departamento_Pais(departamento_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Carrera_Centro_Regional(
	id INT AUTO_INCREMENT PRIMARY KEY,
    centro_regional_id INT NOT NULL,
    carrera_id INT NOT NULL,
    
    FOREIGN KEY (centro_regional_id) REFERENCES Centro_Regional(centro_regional_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (carrera_id) REFERENCES Carrera(carrera_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Rol(
	rol_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(40) NOT NULL
);

CREATE TABLE Persona(
	dni VARCHAR(25) PRIMARY KEY,
    nombre_completo VARCHAR(70) NOT NULL,
    apellido_completo VARCHAR(70) NOT NULL,
    numero_telefono VARCHAR(20) NOT NULL,
    correo_personal VARCHAR(50) UNIQUE NOT NULL,
    direccion_id INT NOT NULL,
    genero CHAR NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    
    FOREIGN KEY (direccion_id) REFERENCES Direccion(direccion_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Usuario(
	usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    persona_id VARCHAR(25) NOT NULL,
    correo_institucional VARCHAR(50) UNIQUE NOT NULL,
    contrasenia VARCHAR(255) NOT NULL, -- para guardar hashes
    
    FOREIGN KEY (persona_id) REFERENCES Persona(dni)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Usuario_Rol(
	id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    rol_id INT NOT NULL,
    
    FOREIGN KEY (usuario_id) REFERENCES Usuario(usuario_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (rol_id) REFERENCES Rol(rol_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Postulante(
	dni VARCHAR(25) PRIMARY KEY,
    nombre_completo VARCHAR(70) NOT NULL,
    apellido_completo VARCHAR(70) NOT NULL,
    numero_telefono VARCHAR(20) NOT NULL,
    correo_personal VARCHAR(50) UNIQUE NOT NULL,
    direccion_id INT NOT NULL,
    genero CHAR NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    estado_civil_id INT NOT NULL,
    instituto_educ_media VARCHAR(80) NOT NULL,
    anio_graduacion YEAR NOT NULL,
    pais_estudio_id INT NOT NULL,
    
    FOREIGN KEY (direccion_id) REFERENCES Direccion(direccion_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (estado_civil_id) REFERENCES Estado_Civil(estado_civil_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (pais_estudio_id) REFERENCES Pais(pais_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Estado_Revision(
	estado_revision_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_estado VARCHAR(40) NOT NULL
);

CREATE TABLE Inscripcion(
	inscripcion_id INT AUTO_INCREMENT PRIMARY KEY, -- numero de solicitud
    numero_solicitud VARCHAR(8) UNIQUE,
    postulante_id VARCHAR(25) NOT NULL,
    carrera_primaria INT NOT NULL,
    carrera_secundaria INT NOT NULL,
    estado_revision_id INT NOT NULL, -- guarda el estado de inscripcion "aprobado", "rechazado", "pendiente"
	centro_regional_id INT NOT NULL,
    imagen_certificado MEDIUMBLOB NOT NULL,
    fecha_inscripcion DATETIME NOT NULL,
    revisor_id INT DEFAULT NULL, -- a tabla de usuario. Este campo se rellenara luego con un SP

	FOREIGN KEY (postulante_id) REFERENCES Postulante(dni)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (carrera_primaria) REFERENCES Carrera(carrera_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (carrera_secundaria) REFERENCES Carrera(carrera_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (estado_revision_id) REFERENCES Estado_Revision(estado_revision_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (centro_regional_id) REFERENCES Centro_Regional(centro_regional_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (revisor_id) REFERENCES Usuario(usuario_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- tabla automatica, se hara un trigger para rellenarla al momento de insertarse una Inscripcion
CREATE TABLE Inscripciones_Tipo_Examen(
	id INT AUTO_INCREMENT PRIMARY KEY,
    inscripcion_id INT NOT NULL,
    tipo_examen_id INT NOT NULL,
	UNIQUE(inscripcion_id, tipo_examen_id),
    
    FOREIGN KEY (inscripcion_id) REFERENCES Inscripcion(inscripcion_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	
    FOREIGN KEY (tipo_examen_id) REFERENCES Tipo_Examen(tipo_examen_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Resultados(
	id INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(25) NOT NULL,
	tipo_examen_id INT NOT NULL,
    resultado INT NOT NULL,
    
    FOREIGN KEY (dni) REFERENCES Postulante(dni)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (tipo_examen_id) REFERENCES Tipo_Examen(tipo_examen_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Estudiante(
	numero_cuenta VARCHAR(11) PRIMARY KEY,
    -- persona_id INT NOT NULL, Ya esta en USUARIOID
    carrera_id INT NOT NULL,
    usuario_id INT NOT NULL,
    centro_reg_id INT NOT NULL,
    anio_ingreso YEAR NOT NULL,
    estado TINYINT NOT NULL,
    foto_perfil MEDIUMBLOB,
    
   /* FOREIGN KEY (personaId) REFERENCES Persona(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,*/
        
	FOREIGN KEY (carrera_id) REFERENCES Carrera(carrera_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (usuario_id) REFERENCES Usuario(usuario_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (centro_reg_id) REFERENCES Centro_Regional(centro_regional_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Periodo_Academico(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    bool_actual TINYINT(1) DEFAULT 0
);

-- Los insert seran manuales
CREATE TABLE Periodo_Matricula(
	id INT AUTO_INCREMENT PRIMARY KEY,
    periodo_acad_id INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    
    FOREIGN KEY (periodo_acad_id) REFERENCES Periodo_Academico(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Clase(
	clase_id INT AUTO_INCREMENT PRIMARY KEY,
    departamento_id INT NOT NULL,
    unidades_valorativas INT NOT NULL,
    nombre_clase VARCHAR(70) NOT NULL,
    codigo VARCHAR(10) NOT NULL UNIQUE,
    clase_requisito_id INT,
    
    FOREIGN KEY (departamento_id) REFERENCES Departamento_Uni(departamento_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (clase_requisito_id) REFERENCES Clase(clase_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- RECONSIDERAR SOLAMENTE DEJAR LA TABLA DE DOCENTES Y NO EMPLEADOS
CREATE TABLE Docente(
	numero_empleado INT PRIMARY KEY,
	persona_id VARCHAR(25) NOT NULL,
    centro_reg_id INT NOT NULL,
    usuario_id INT NOT NULL,
	departamento_id INT NOT NULL,
    foto MEDIUMBLOB, -- para guardar la ruta de la foto
    
    FOREIGN KEY (usuario_id) REFERENCES Usuario(usuario_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
    
    FOREIGN KEY (persona_id) REFERENCES Persona(dni)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (centro_reg_id) REFERENCES Centro_Regional(centro_regional_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	
	FOREIGN KEY (departamento_id) REFERENCES Departamento_Uni(departamento_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- catalogo
CREATE TABLE Edificio(
	edificio_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40) NOT NULL,
    centro_reg_id INT NOT NULL,
    
    FOREIGN KEY (centro_reg_id) REFERENCES Centro_Regional(centro_regional_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- catalogo
CREATE TABLE Aula_Edificio(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40) NOT NULL,
    edificio_id INT NOT NULL,
    
    FOREIGN KEY (edificio_id) REFERENCES Edificio(edificio_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Dias(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) UNIQUE
);

CREATE TABLE Seccion(
	id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_seccion VARCHAR(10) NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    clase_id INT NOT NULL,
    docente_id INT NOT NULL,
    cupos INT NOT NULL,
    periodo_acad_id INT NOT NULL,
    dias_id INT NOT NULL,
    aula_id INT NOT NULL,
    
    FOREIGN KEY (clase_id) REFERENCES Clase(clase_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	
    FOREIGN KEY (docente_id) REFERENCES Docente(numero_empleado)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (periodo_acad_id) REFERENCES Periodo_Academico(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (aula_id) REFERENCES Aula_Edificio(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (dias_id) REFERENCES Dias(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Estados_Clase(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL
);


-- Esta tabla simula el historial academico
-- El docente al momento de subir notas, se hara el insert en esta tabla.
-- El campo estado_clase_id es calculado, a excepcion de caso de abandono
CREATE TABLE Estudiantes_Secciones(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id VARCHAR(11) NOT NULL,
    seccion_id INT NOT NULL,
    nota INT DEFAULT NULL,
    estado_clase_id INT NOT NULL,
    UNIQUE(estudiante_id, seccion_id),
    
    FOREIGN KEY (estudiante_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (seccion_id) REFERENCES Seccion(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (estado_clase_id) REFERENCES Estados_Clase(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Estas son las clases que el estudiante matriculo segun el periodo
-- La de arriba seria el detalle de esta tabla, y cuando el docente ingrese notas al sistema
-- se debera hacer un get de esta tabla segun el docente de la seccion y el estudiante
-- El SP debera obtener la seccion, pero el periodo academico de esta tabla se debera insertar de acuerdo
-- al periodo de la seccion. Eso se hara en el SP.
-- Forma 03
CREATE TABLE Estudiantes_Matricula(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id VARCHAR(11) NOT NULL,
    seccion_id INT NOT NULL,
    periodo_acad_id INT NOT NULL,
    UNIQUE(estudiante_id, seccion_id),
    
    FOREIGN KEY (estudiante_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (seccion_id) REFERENCES Seccion(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (periodo_acad_id) REFERENCES Periodo_Academico(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- tabla bitacora. Trigger on delete de tabla estudiante matricula
CREATE TABLE Estudiante_Seccion_Cancelada(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id VARCHAR(11) NOT NULL,
    seccion_id INT NOT NULL,
    
    FOREIGN KEY (estudiante_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (seccion_id) REFERENCES Seccion(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- tabla intermedia. Se rellenara manualmente. Es el plan de estudios
CREATE TABLE Clases_Carrera(
	id INT AUTO_INCREMENT PRIMARY KEY,
    clase_id INT NOT NULL,
    carrera_id INT NOT NULL,
    UNIQUE(clase_id, carrera_id),
    
    FOREIGN KEY (clase_id) REFERENCES Clase(clase_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (carrera_id) REFERENCES Carrera(carrera_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Matricula_Indice(
	id INT AUTO_INCREMENT PRIMARY KEY,
    periodo_matricula_id INT NOT NULL,
    dia DATETIME NOT NULL,
    indice_minimo DECIMAL(5,2) NOT NULL,
    indice_maximo DECIMAL(5,2) NOT NULL,
    
    FOREIGN KEY (periodo_matricula_id) REFERENCES Periodo_Matricula(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Indices_Estudiantes(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id VARCHAR(11) NOT NULL,
    periodo_acad_id INT NOT NULL,
    indice_periodo DECIMAL(5,2),
    indice_global DECIMAL(5,2),
    fecha_calculo DATETIME,
    
    FOREIGN KEY (estudiante_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (periodo_acad_id) REFERENCES Periodo_Academico(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Contactos(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_1_id VARCHAR(11) NOT NULL,
    estudiante_2_id VARCHAR(11) NOT NULL,
    fecha_contacto DATETIME,
    
    UNIQUE(estudiante_1_id, estudiante_2_id),
    
    FOREIGN KEY (estudiante_1_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (estudiante_2_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Estado_Solicitud_Contacto(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL
);

-- TALVEZ SE DEBERIA DE QUITAR, YA QUE SE HACE CON LA SOLICITUD AL CORREO
CREATE TABLE Solicitudes_Contacto(
	id INT AUTO_INCREMENT PRIMARY KEY,
    emisor_id VARCHAR(11) NOT NULL,
    receptor_id VARCHAR(11) NOT NULL,
    estado_solicitud_id INT NOT NULL,
    fecha_solicitud DATETIME,
    
    UNIQUE(emisor_id,receptor_id),
    
    FOREIGN KEY (emisor_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	
    FOREIGN KEY (receptor_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (estado_solicitud_id) REFERENCES Estado_Solicitud_Contacto(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Mensaje(
	id INT AUTO_INCREMENT PRIMARY KEY,
    emisor_id VARCHAR(11) NOT NULL,
    receptor_id VARCHAR(11) NOT NULL,
    contenido VARCHAR(255),
    fecha_envio DATETIME,
    
    FOREIGN KEY (emisor_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	
    FOREIGN KEY (receptor_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Evaluacion_Docente(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id VARCHAR(11) NOT NULL,
    seccion_id INT NOT NULL,
    observacion VARCHAR(255),
    fecha_evaluacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    evidencia_pdf MEDIUMBLOB,
    evaluacion JSON,
    UNIQUE(estudiante_id, seccion_id),
    
    FOREIGN KEY (estudiante_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (seccion_id) REFERENCES Seccion(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
    
);

-- catalogo
CREATE TABLE Estado_Pago_Reposicion(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL
);

-- catalogo
CREATE TABLE Estado_Solicitudes(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL
);

CREATE TABLE Coordinadores_Carrera(
	id INT AUTO_INCREMENT PRIMARY KEY,
    docente_id INT NOT NULL,
    carrera_id INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE,
    activo TINYINT(1) NOT NULL,
    
    FOREIGN KEY (docente_id) REFERENCES Docente(numero_empleado)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (carrera_id) REFERENCES Carrera(carrera_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Tipo_Solicitud(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL
);

CREATE TABLE Solicitudes(
	numero_solicitud INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id VARCHAR(11) NOT NULL,
    periodo_acad_id INT NOT NULL,
    fecha_solicitud DATETIME NOT NULL DEFAULT current_timestamp,
    observacion VARCHAR(255) NOT NULL,
    estado_solicitud_id INT,
    tipo_solicitud_id INT NOT NULL,
    
    FOREIGN KEY (estudiante_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (periodo_acad_id) REFERENCES Periodo_Academico(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (tipo_solicitud_id) REFERENCES Tipo_Solicitud(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (estado_solicitud_id) REFERENCES Estado_Solicitudes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Solicitud_Pago_Reposicion(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estado_pago_reposicion_id INT NOT NULL,
	solicitud_id INT NOT NULL,
	FOREIGN KEY (estado_pago_reposicion_id) REFERENCES Estado_Pago_Reposicion(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (solicitud_id) REFERENCES Solicitudes(numero_solicitud)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Solo se hace 1 solicitud por seccion
CREATE TABLE Solicitud_Cancelacion_Excepc(
	id INT AUTO_INCREMENT PRIMARY KEY,
    archivoPDF MEDIUMBLOB NOT NULL, -- ver si se guarda la ruta
    seccion_id INT NOT NULL,
    coordinador_id INT DEFAULT NULL, -- ver si con un trigger se cambia al coordinador de la carrera actual del estudiante
	solicitud_id INT NOT NULL,
    FOREIGN KEY (coordinador_id) REFERENCES Coordinadores_Carrera(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (seccion_id) REFERENCES Seccion(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (solicitud_id) REFERENCES Solicitudes(numero_solicitud)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Solicitud_Cambios_Carrera(
	id INT AUTO_INCREMENT PRIMARY KEY,
    carrera_nueva_id INT NOT NULL,
    coordinador_id INT DEFAULT NULL, -- ver si con un trigger se cambia al coordinador de la carrera actual del estudiante
	solicitud_id INT NOT NULL,
    archivoPDF MEDIUMBLOB NOT NULL,
    FOREIGN KEY (carrera_nueva_id) REFERENCES Carrera(carrera_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (coordinador_id) REFERENCES Coordinadores_Carrera(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (solicitud_id) REFERENCES Solicitudes(numero_solicitud)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Solicitud_Cambio_Centro(
	id INT AUTO_INCREMENT PRIMARY KEY,
    centro_nuevo_id INT NOT NULL,
    coordinador_id INT DEFAULT NULL, -- ver si con un trigger se cambia al coordinador de la carrera actual del estudiante
    archivoPDF MEDIUMBLOB NOT NULL,
	solicitud_id INT NOT NULL,
    FOREIGN KEY (centro_nuevo_id) REFERENCES Centro_Regional(centro_regional_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (coordinador_id) REFERENCES Coordinadores_Carrera(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (solicitud_id) REFERENCES Solicitudes(numero_solicitud)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

/*
*	 MODULO DE BIBLIOTECA
*/
CREATE TABLE Tags(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60)
);

CREATE TABLE Autores(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(90)
);

CREATE TABLE Tipo_Recurso(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60)
);

CREATE TABLE Recursos(
	id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(130) NOT NULL,
    archivo MEDIUMBLOB,
    anio YEAR,
    portada MEDIUMBLOB,
    docente_id INT NOT NULL,
    tipo_recurso_id INT NOT NULL,
    descripcion VARCHAR (200) NOT NULL,
    
	FOREIGN KEY (docente_id) REFERENCES Docente(numero_empleado)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (tipo_recurso_id) REFERENCES Tipo_Recurso(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Autores_Recursos(
	id INT AUTO_INCREMENT PRIMARY KEY,
    recurso_id INT NOT NULL,
    autor_id INT NOT NULL,
    
    FOREIGN KEY (recurso_id) REFERENCES Recursos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (autor_id) REFERENCES Autores(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- tabla intermedia
CREATE TABLE Recursos_Tags(
	id INT AUTO_INCREMENT PRIMARY KEY,
    recurso_id INT NOT NULL,
    tags_id INT NOT NULL,
    
    FOREIGN KEY (recurso_id) REFERENCES Recursos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (tags_id) REFERENCES Tags(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- tabla intermedia
CREATE TABLE Recursos_Clase(
	id INT AUTO_INCREMENT PRIMARY KEY,
    recurso_id INT NOT NULL,
    clase_id INT NOT NULL,
    
    FOREIGN KEY (recurso_id) REFERENCES Recursos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	
    FOREIGN KEY (clase_id) REFERENCES Clase(clase_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Recursos_Musica(
	id INT AUTO_INCREMENT PRIMARY KEY,
    recurso_id INT NOT NULL,
    FOREIGN KEY (recurso_id) REFERENCES Recursos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Docentes

CREATE TABLE Introduccion_Clase(
	id INT AUTO_INCREMENT PRIMARY KEY,
    seccion_id INT NOT NULL UNIQUE,
    archivo_pdf MEDIUMBLOB,
    video LONGBLOB,
    descripcion VARCHAR(400),
    fecha_subida DATETIME DEFAULT current_timestamp,
    
    FOREIGN KEY (seccion_id) REFERENCES Seccion(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- catalogo
CREATE TABLE Estados_Lista_Espera(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40) not null
);

CREATE TABLE Lista_Espera_Secciones(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id VARCHAR(11) NOT NULL,
    seccion_id INT NOT NULL,
	fecha_solicitud DATETIME NOT NULL DEFAULT current_timestamp,
    estado_espera_id INT NOT NULL,
    posicion INT NOT NULL,
    
    unique(estudiante_id, seccion_id),
    
	FOREIGN KEY (estudiante_id) REFERENCES Estudiante(numero_cuenta)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (seccion_id) REFERENCES Seccion(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (estado_espera_id) REFERENCES Estados_Lista_Espera(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);





