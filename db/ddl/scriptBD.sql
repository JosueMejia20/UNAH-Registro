DROP DATABASE IF EXISTS Proyecto;

CREATE DATABASE Proyecto;

USE Proyecto;


-- catalogo
CREATE TABLE Facultades(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL
);

-- catalogo
CREATE TABLE EstadoSolicitudContacto(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL
);

-- catalogo
CREATE TABLE Topicos(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30)
);

-- catalogo
CREATE TABLE EstadosClase(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL
);


CREATE TABLE Recursos(
	id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(50) NOT NULL,
    archivoPdf VARCHAR(255),
    anio YEAR
);

-- catalogo
CREATE TABLE Autores(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL
);

-- tabla intermedia
CREATE TABLE RecursosAutores(
	id INT AUTO_INCREMENT PRIMARY KEY,
    recursoId INT NOT NULL,
    autorId INT NOT NULL,
    
    FOREIGN KEY (recursoId) REFERENCES Recursos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (autorId) REFERENCES Autores(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE RecursosMusica(
	id INT AUTO_INCREMENT PRIMARY KEY,
    recursoId INT NOT NULL,
    archivoAudio VARCHAR(255),
    archivoPartitura VARCHAR(255),
    
    FOREIGN KEY (recursoId) REFERENCES Recursos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- catalogo
CREATE TABLE Departamentos(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(15) NOT NULL,
    facultadId INT NOT NULL,
    
    FOREIGN KEY (facultadId) REFERENCES Facultades(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Clases(
	id INT AUTO_INCREMENT PRIMARY KEY,
    departamentoId INT NOT NULL,
    unidadesValorativas INT NOT NULL,
    codigo VARCHAR(10) NOT NULL UNIQUE,
    claseRequisitoId INT NOT NULL,
    
    FOREIGN KEY (departamentoId) REFERENCES Departamentos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (claseRequisitoId) REFERENCES Clases(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Personas(
	id INT AUTO_INCREMENT PRIMARY KEY,
    identidad VARCHAR(13) NOT NULL UNIQUE,
    n1 VARCHAR(50),
    n2 VARCHAR(50),
    a1 VARCHAR(50),
    a2 VARCHAR(50),
    genero CHAR,
    telefono VARCHAR(9),
    email VARCHAR(40) NOT NULL UNIQUE
);

CREATE TABLE Empleados(
	id INT AUTO_INCREMENT PRIMARY KEY,
    personaId INT NOT NULL,
    numeroEmpleado INT NOT NULL UNIQUE,
    foto VARCHAR(500) NOT NULL, -- para guardar la ruta de la foto
    
    FOREIGN KEY (personaId) REFERENCES Personas(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- catalogo
CREATE TABLE CentrosRegionales(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL
);

CREATE TABLE Usuarios(
	id INT AUTO_INCREMENT PRIMARY KEY,
    correoInstitucional VARCHAR(60) NOT NULL UNIQUE,
    contrasenia VARCHAR(255) NOT NULL -- para guardar hashes
);

-- catalogo
CREATE TABLE Roles(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100)
);

-- tabla intermedia
CREATE TABLE Usuarios_Roles(
	id INT AUTO_INCREMENT PRIMARY KEY,
    usuarioId INT NOT NULL,
    rolId INT NOT NULL,
    
    UNIQUE (usuarioId, rolId), -- unique compuesto, evita que un usuario tenga el mismo rol dos veces
    
    FOREIGN KEY (usuarioId) REFERENCES Usuarios(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (rolId) REFERENCES Roles(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Docentes(
	id INT AUTO_INCREMENT PRIMARY KEY,
    empleadoId INT NOT NULL,
    centroRegId INT NOT NULL,
    usuarioId INT NOT NULL,
	departamentoId INT NOT NULL,
    
    FOREIGN KEY (usuarioId) REFERENCES Usuarios(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
    
    FOREIGN KEY (empleadoId) REFERENCES Empleados(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (centroRegId) REFERENCES CentrosRegionales(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	
	FOREIGN KEY (departamentoId) REFERENCES Departamentos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE PeriodosAcademicos(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFin DATE NOT NULL,
    bool_Actual TINYINT(1) DEFAULT 0
);

-- catalogo
CREATE TABLE Edificios(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL,
    centroRegId INT NOT NULL,
    
    FOREIGN KEY (centroRegId) REFERENCES CentrosRegionales(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- catalogo
CREATE TABLE AulasEdificio(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL,
    edificioId INT NOT NULL,
    
    FOREIGN KEY (edificioId) REFERENCES Edificios(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);



CREATE TABLE Secciones(
	id INT AUTO_INCREMENT PRIMARY KEY,
    codigoSeccion VARCHAR(10) NOT NULL,
    horaInicio TIME NOT NULL,
    horaFin TIME NOT NULL,
    claseId INT NOT NULL,
    docenteId INT NOT NULL,
    cupos INT NOT NULL,
    periodoAcadId INT NOT NULL,
    dias VARCHAR(20),
    aulaId INT NOT NULL,
    
    FOREIGN KEY (claseId) REFERENCES Clases(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	
    FOREIGN KEY (docenteId) REFERENCES Docentes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (periodoAcadId) REFERENCES PeriodosAcademicos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (aulaId) REFERENCES AulasEdificio(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- catalogo
CREATE TABLE TipoExamen(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- catalogo
CREATE TABLE Carreras(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    tipoExamenId INT NOT NULL,
    departamentoId INT NOT NULL,
    
    FOREIGN KEY (tipoExamenId) REFERENCES TipoExamen(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (departamentoId) REFERENCES Departamentos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);



CREATE TABLE Estudiantes(
	id INT AUTO_INCREMENT PRIMARY KEY,
    personaId INT NOT NULL,
    carreraId INT NOT NULL,
    usuarioId INT NOT NULL,
    centroRegId INT NOT NULL,
    numeroCuenta INT NOT NULL UNIQUE,
    direccion VARCHAR(200),
    
    FOREIGN KEY (personaId) REFERENCES Personas(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (carreraId) REFERENCES Carreras(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (usuarioId) REFERENCES Usuarios(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (centroRegId) REFERENCES CentrosRegionales(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Postulantes(
	id INT AUTO_INCREMENT PRIMARY KEY,
    personaId INT NOT NULL UNIQUE,
    numerosIntentos INT NOT NULL DEFAULT 1,
    
   FOREIGN KEY (personaId) REFERENCES Personas(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Inscripciones(
	id INT AUTO_INCREMENT PRIMARY KEY,
    postulanteId INT NOT NULL,
    numeroSolicitud INT NOT NULL UNIQUE,
    carreraP_Id INT NOT NULL,
    carreraS_Id INT NOT NULL,
    fotoCertificado VARCHAR(255) NOT NULL,
    centroRegId INT NOT NULL,
    Fecha DATETIME,
    
    FOREIGN KEY (postulanteId) REFERENCES Postulantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (carreraP_Id) REFERENCES Carreras(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (carreraS_Id) REFERENCES Carreras(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (centroRegId) REFERENCES CentrosRegionales(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- tabla automatica, trigger cuando se inserte en inscripciones
-- se utilizara la carreraP y carreraS para saber el tipo de examen(inner join)
-- tabla intermedia
CREATE TABLE Inscripciones_TipoExamen(
	id INT AUTO_INCREMENT PRIMARY KEY,
    inscripcionId INT NOT NULL,
    tipoExamenId INT NOT NULL,
	UNIQUE(inscripcionId, tipoExamenId),
    
    FOREIGN KEY (inscripcionId) REFERENCES Inscripciones(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	
    FOREIGN KEY (tipoExamenId) REFERENCES TipoExamen(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Resultados(
	id INT AUTO_INCREMENT PRIMARY KEY,
    inscripcionTipoExamenId INT NOT NULL UNIQUE,
    resultado INT NOT NULL,
    aprobo TINYINT(1),
    
    FOREIGN KEY (inscripcionTipoExamenId) REFERENCES Inscripciones_TipoExamen(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- tabla intermedia
CREATE TABLE RecursosTopicos(
	id INT AUTO_INCREMENT PRIMARY KEY,
    recursoId INT NOT NULL,
    topicoId INT NOT NULL,
    
    FOREIGN KEY (recursoId) REFERENCES Recursos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (topicoId) REFERENCES Topicos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- tabla intermedia
CREATE TABLE RecursosClases(
	id INT AUTO_INCREMENT PRIMARY KEY,
    recursoId INT NOT NULL,
    claseId INT NOT NULL,
    UNIQUE(recursoId, claseId),
    
    FOREIGN KEY (recursoId) REFERENCES Recursos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	
    FOREIGN KEY (claseId) REFERENCES Clases(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE PeriodoMatricula(
	id INT AUTO_INCREMENT PRIMARY KEY,
    periodoAcadId INT NOT NULL,
    FechaInicio DATE NOT NULL,
    FechaFin DATE NOT NULL,
    
    FOREIGN KEY (periodoAcadId) REFERENCES PeriodosAcademicos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- tabla intermedia
CREATE TABLE EstudiantesSecciones(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudianteId INT NOT NULL,
    seccionId INT NOT NULL,
    Nota INT DEFAULT NULL,
    estadoClaseId INT NOT NULL,
    UNIQUE(estudianteId, seccionId),
    
    FOREIGN KEY (estudianteId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (seccionId) REFERENCES Secciones(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (estadoClaseId) REFERENCES EstadosClase(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- tabla bitacora. Trigger on delete de tabla estudiantes seccion
CREATE TABLE EstudianteSeccionCancelada(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudianteId INT NOT NULL,
    seccionId INT NOT NULL,
    
    FOREIGN KEY (estudianteId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (seccionId) REFERENCES Secciones(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- tabla intermedia
CREATE TABLE ClasesCarrera(
	id INT AUTO_INCREMENT PRIMARY KEY,
    claseId INT NOT NULL,
    carreraId INT NOT NULL,
    UNIQUE(claseId, carreraId),
    
    FOREIGN KEY (claseId) REFERENCES Clases(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (carreraId) REFERENCES Carreras(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE MatriculaIndice(
	id INT AUTO_INCREMENT PRIMARY KEY,
    periodoMatriculaId INT NOT NULL,
    dia DATETIME NOT NULL,
    indiceMinimo DECIMAL(5,2) NOT NULL,
    indiceMaximo DECIMAL(5,2) NOT NULL,
    
    FOREIGN KEY (periodoMatriculaId) REFERENCES PeriodoMatricula(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE IndicesEstudiantes(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudianteId INT NOT NULL,
    periodoAcadId INT NOT NULL,
    indicePeriodo DECIMAL(5,2),
    indiceGlobal DECIMAL(5,2),
    fechaCalculo DATETIME,
    
    FOREIGN KEY (estudianteId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (periodoAcadId) REFERENCES PeriodosAcademicos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Contactos(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante1Id INT NOT NULL,
    estudiante2Id INT NOT NULL,
    fechaContacto DATETIME,
    
    UNIQUE(estudiante1Id, estudiante2Id),
    
    FOREIGN KEY (estudiante1Id) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (estudiante2Id) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE SolicitudesContacto(
	id INT AUTO_INCREMENT PRIMARY KEY,
    emisorId INT NOT NULL,
    receptorId INT NOT NULL,
    estadoSolicitudCId INT NOT NULL,
    fechaSolicitud DATETIME,
    
    UNIQUE(emisorId,receptorId),
    
    FOREIGN KEY (emisorId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	
    FOREIGN KEY (receptorId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (estadoSolicitudCId) REFERENCES EstadoSolicitudContacto(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Mensajes(
	id INT AUTO_INCREMENT PRIMARY KEY,
    emisorId INT NOT NULL,
    receptorId INT NOT NULL,
    contenido VARCHAR(255),
    fechaEnvio DATETIME,
    
    FOREIGN KEY (emisorId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	
    FOREIGN KEY (receptorId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE SeccionesCanceladas(
	id INT AUTO_INCREMENT PRIMARY KEY,
    codigoSeccion VARCHAR(10) NOT NULL,
    claseId INT NOT NULL,
    docenteId INT NOT NULL,
    periodoAcadId INT NOT NULL,
    fechaCancelacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    justificacion VARCHAR(255),
    
    FOREIGN KEY (claseId) REFERENCES Clases(id),
	
    FOREIGN KEY (docenteId) REFERENCES Docentes(id),
        
	FOREIGN KEY (periodoAcadId) REFERENCES PeriodosAcademicos(id)
);

CREATE TABLE CoordinadoresCarrera(
	id INT AUTO_INCREMENT PRIMARY KEY,
    docenteId INT NOT NULL,
    carreraId INT NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFin DATE,
    activo TINYINT(1) NOT NULL,
    
    FOREIGN KEY (docenteId) REFERENCES Docentes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (carreraId) REFERENCES Carreras(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE EvaluacionesDocentes(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudianteId INT NOT NULL,
    seccionId INT NOT NULL,
    observacion VARCHAR(255),
    fechaEvaluacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(estudianteId, seccionId),
    
    FOREIGN KEY (estudianteId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (seccionId) REFERENCES Secciones(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
    
);

-- catalogo
CREATE TABLE EstadoPagoReposicion(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL
);

CREATE TABLE SolicitudPagoReposicion(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudianteId INT NOT NULL,
    periodoAcadId INT NOT NULL,
    fechaSolicitud DATETIME NOT NULL DEFAULT current_timestamp,
    observacion VARCHAR(255) NOT NULL,
    estadoPagoReposicionId INT NOT NULL,
    
    FOREIGN KEY (estudianteId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (periodoAcadId) REFERENCES PeriodosAcademicos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (estadoPagoReposicionId) REFERENCES EstadoPagoReposicion(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
    
);

CREATE TABLE SolicitudCancelacionesExcepc(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudianteId INT NOT NULL,
    periodoAcadId INT NOT NULL,
    justificacion VARCHAR(255) NOT NULL,
    archivoPDF VARCHAR(255) NOT NULL, -- ver si se guarda la ruta
    coordinadorId INT DEFAULT NULL, -- ver si con un trigger se cambia al coordinador de la carrera actual del estudiante
    
    FOREIGN KEY (estudianteId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (periodoAcadId) REFERENCES PeriodosAcademicos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (coordinadorId) REFERENCES CoordinadoresCarrera(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- tabla intermedia
CREATE TABLE SolicitudCancelacionesSecciones(
	id INT AUTO_INCREMENT PRIMARY KEY,
    solicitudCancId INT NOT NULL,
    seccionId INT NOT NULL,
    UNIQUE(solicitudCancID, seccionId),
    
    FOREIGN KEY (solicitudCancId) REFERENCES SolicitudCancelacionesExcepc(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (seccionId) REFERENCES Secciones(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
    
);

CREATE TABLE SolicitudCambiosCarrera(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudianteId INT NOT NULL,
    carreraNuevaId INT NOT NULL,
    observacion VARCHAR(255),
    coordinadorId INT DEFAULT NULL, -- ver si con un trigger se cambia al coordinador de la carrera actual del estudiante
    
    FOREIGN KEY (estudianteId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (carreraNuevaId) REFERENCES Carreras(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (coordinadorId) REFERENCES CoordinadoresCarrera(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE SolicitudCambioCentro(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudianteId INT NOT NULL,
    centroNuevoId INT NOT NULL,
    observacion VARCHAR(255),
    coordinadorId INT DEFAULT NULL, -- ver si con un trigger se cambia al coordinador de la carrera actual del estudiante

	FOREIGN KEY (estudianteId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (centroNuevoId) REFERENCES CentrosRegionales(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
        
	FOREIGN KEY (coordinadorId) REFERENCES CoordinadoresCarrera(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);


CREATE TABLE Evento(
	id INT AUTO_INCREMENT PRIMARY KEY,
    periodoAcadId INT NOT NULL,
    FechaInicio DATE NOT NULL,
    FechaFin DATE NOT NULL,
    activo TINYINT(1) NOT NULL,
    
    FOREIGN KEY (periodoAcadId) REFERENCES PeriodosAcademicos(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- catalogo
CREATE TABLE EstadosListaEspera(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) not null
);

CREATE TABLE ListaEsperaSecciones(
	id INT AUTO_INCREMENT PRIMARY KEY,
    estudianteId INT NOT NULL,
    seccionId INT NOT NULL,
	fechaSolicitud DATETIME NOT NULL DEFAULT current_timestamp,
    estadoEsperaId INT NOT NULL,
    posicion INT NOT NULL,
    
    unique(estudianteId, seccionId),
    
	FOREIGN KEY (estudianteId) REFERENCES Estudiantes(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (seccionId) REFERENCES Secciones(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (estadoEsperaId) REFERENCES EstadosListaEspera(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE IntroduccionClase(
	id INT AUTO_INCREMENT PRIMARY KEY,
    seccionId INT NOT NULL UNIQUE,
    archivoPDF VARCHAR(255),
    video VARCHAR(255), -- siempre considerar la ruta o BLOB
    descripcion VARCHAR(400),
    fechaSubida DATETIME DEFAULT current_timestamp,
    
    FOREIGN KEY (seccionId) REFERENCES Secciones(id)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);



