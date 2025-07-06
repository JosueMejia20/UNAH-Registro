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
    nota_minima SMALLINT UNSIGNED NOT NULL
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
    postulante_id VARCHAR(25) NOT NULL,
    carrera_primaria INT NOT NULL,
    carrera_secundaria INT NOT NULL,
    estado_revision_id INT NOT NULL, -- guarda el estado de inscripcion "aprobado", "rechazado", "pendiente"
	centro_regional_id INT NOT NULL,
    ruta_certificado VARCHAR(255) NOT NULL,
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
    inscripcion_tipo_examen_id INT NOT NULL UNIQUE,
    resultado INT NOT NULL,
    
    FOREIGN KEY (inscripcion_tipo_examen_id) REFERENCES Inscripciones_Tipo_Examen(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);






