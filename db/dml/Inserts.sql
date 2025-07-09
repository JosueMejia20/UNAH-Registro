USE Registro;

-- Inserts para Facultades
INSERT INTO Facultad (nombre_facultad) VALUES ('Facultad de Ciencias');
INSERT INTO Facultad (nombre_facultad) VALUES ('Facultad de Ingenieria');
INSERT INTO Facultad (nombre_facultad) VALUES ('Facultad de Ciencias Sociales');
INSERT INTO Facultad (nombre_facultad) VALUES ('Facultad de Quimica y Farmacia');
INSERT INTO Facultad (nombre_facultad) VALUES ('Facultad de Odontologia');
INSERT INTO Facultad (nombre_facultad) VALUES ('Facultad de Ciencias Juridicas');
INSERT INTO Facultad (nombre_facultad) VALUES ('Facultad de Humanidades y Artes');
INSERT INTO Facultad (nombre_facultad) VALUES ('Facultad de Ciencias Espaciales');
INSERT INTO Facultad (nombre_facultad) VALUES ('Facultad de Ciencias Economicas, Administrativas y Contables');
INSERT INTO Facultad (nombre_facultad) VALUES ('Facultad de Ciencias Medicas');

-- Inserts para Departamento_Pais
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Atlántida');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Choluteca');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Colón');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Comayagua');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Copán');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Cortés');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('El Paraíso');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Francisco Morazán');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Gracias a Dios');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Intibucá');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Islas de la Bahía');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('La Paz');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Lempira');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Ocotepeque');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Olancho');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Santa Bárbara');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Valle');
INSERT INTO Departamento_Pais (nombre_departamento) VALUES ('Yoro');


-- Inserts para Estado_Civil
INSERT INTO Estado_Civil (nombre_estado_civil) VALUES ('Soltero(a)');
INSERT INTO Estado_Civil (nombre_estado_civil) VALUES ('Casado(a)');
INSERT INTO Estado_Civil (nombre_estado_civil) VALUES ('Divorciado(a)');
INSERT INTO Estado_Civil (nombre_estado_civil) VALUES ('Union libre');


-- Inserts para Pais
INSERT INTO Pais (nombre_pais) VALUES ('Honduras');
INSERT INTO Pais (nombre_pais) VALUES ('Guatemala');
INSERT INTO Pais (nombre_pais) VALUES ('El Salvador');
INSERT INTO Pais (nombre_pais) VALUES ('Costa Rica');
INSERT INTO Pais (nombre_pais) VALUES ('Belice');
INSERT INTO Pais (nombre_pais) VALUES ('Panama');
INSERT INTO Pais (nombre_pais) VALUES ('Nicaragua');
INSERT INTO Pais (nombre_pais) VALUES ('Otro');

-- Inserts para Departamento_Uni
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Matematicas', 1);

-- Inserts para Carreras
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (1, 'Matematicas', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (1, 'Fisica', 1000);

-- Inserts para TipoExamen
INSERT INTO Tipo_Examen (nombre_examen, nota_minima) VALUES ('PAA', 700);

-- Inserts para ExamenCarrera
INSERT INTO Examen_Carrera (tipo_examen_id, carrera_id) VALUES (1,1);

-- Inserts para CentroRegional
INSERT INTO Centro_Regional (nombre_centro, departamento_id) VALUES ('Ciudad Universitaria', 8);
INSERT INTO Centro_Regional (nombre_centro, departamento_id) VALUES ('Campus Cortes', 6);

-- Inserts para Carrera_Centro_Regional
INSERT INTO Carrera_Centro_Regional(centro_regional_id, carrera_id) VALUES (1,1);
INSERT INTO Carrera_Centro_Regional(centro_regional_id, carrera_id) VALUES (2,2);
INSERT INTO Carrera_Centro_Regional(centro_regional_id, carrera_id) VALUES (2,1);

-- Inserts para Rol
INSERT INTO Rol (nombre_rol) VALUES ('Revisor');
INSERT INTO Rol (nombre_rol) VALUES ('Estudiante');
INSERT INTO Rol (nombre_rol) VALUES ('Docente');
INSERT INTO Rol (nombre_rol) VALUES ('Coordinador');
INSERT INTO Rol (nombre_rol) VALUES ('JefeDept');
INSERT INTO Rol (nombre_rol) VALUES ('Administrador');

-- Inserts para Estado_Revision
INSERT INTO Estado_Revision (nombre_estado) VALUES ('Pendiente');
INSERT INTO Estado_Revision (nombre_estado) VALUES ('Aprobado');
INSERT INTO Estado_Revision (nombre_estado) VALUES ('Rechazado');







