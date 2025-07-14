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

-- **********Inserts para Departamento_Uni******************
-- Facultad de Ciencias
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Matematicas', 1);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Fisica', 1);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Biologia', 1);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Microbiologia', 1);

-- Facultad de Ingenieria
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Ingenieria Civil', 2);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Ingenieria Mecanica', 2);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Ingenieria Electrica', 2);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Ingenieria Quimica', 2);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Ingenieria Industrial', 2);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Ingenieria en Sistemas', 2);

-- Facultad de Ciencias Sociales
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Sociologia', 3);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Trabajo Social', 3);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Ciencias Psicologicas', 3);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Historia y Antropologia', 3);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Ciencias de la Comunicacion', 3);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Ciencias Politicas', 3);

-- Facultad de Quimica y Farmacia
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Quimica', 4);

-- Facultad de Odontologia
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Odontologia', 5);

-- Facultad de Ciencias Juridicas
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Derecho', 6);

-- Facultad de Humanidades y Artes
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Arquitectura', 7);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Arte', 7);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Filosofia', 7);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Letras y Lenguas', 7);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Ciencias de la Educacion', 7);

-- Facultas de Ciencias Espaciales
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Astronomia y Astrofisica', 8);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Ciencias Aeronauticas', 8);

-- Facultad de Ciencias Economicas
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Economia', 9);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Banca y Finanzas', 9);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Contaduria Publica', 9);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Informatica Administrativa', 9);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Metodos Cuantitativos', 9);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Mercadotecnia', 9);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Comercio Internacional', 9);
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Administracion Publica', 9);

-- Facultad de Ciencias Medicas
INSERT INTO Departamento_Uni (nombre_departamento, facultad_id) VALUES ('Departamento de Medicina y Cirugia', 10);



-- ***************** Inserts para Carreras ************************
-- Facultad de Ciencias
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (1, 'Licenciatura en Matematicas', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (2, 'Licenciatura en Fisica', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (2, 'Licenciatura en Geologia', 800);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (2, 'Tecnico Universitario en Metalurgia', 800);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (2, 'Tecnico Universitario en Meteorologia', 800);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (3, 'Licenciatura en Biologia', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (4, 'Licenciatura en Microbiologia', 1000);

-- Facultad de Ingenieria
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (5, 'Licenciatura en Ingenieria Civil', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (6, 'Licenciatura en Ingenieria Mecanica', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (7, 'Licenciatura en Ingenieria Electrica', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (8, 'Licenciatura en Ingenieria Quimica', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (9, 'Licenciatura en Ingenieria Industrial', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (10, 'Licenciatura en Ingenieria en Sistemas', 1000);

-- Facultad de Ciencias Sociales
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (11, 'Licenciatura en Sociologia', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (12, 'Licenciatura en Trabajo Social', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (13, 'Licenciatura en Psicologia', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (14, 'Licenciatura en Historia', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (15, 'Licenciatura en Periodismo', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (16, 'Licenciatura en Ciencias Politicas', 1000);

-- Facultad de Quimica y Farmacia
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (17, 'Licenciatura en Quimica y Farmacia', 1000);

-- Facultad de Odontologia
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (18, 'Licenciatura en Odontologia', 1000);

-- Facultad de Ciencias Jurificas
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (19, 'Licenciatura en Derecho', 1000);

-- Facultad de Humanidades y Artes
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (20, 'Licenciatura en Arquitectura', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (21, 'Licenciatura en Musica', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (22, 'Licenciatura en Filosofia', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (23, 'Licenciatura en Lenguas Extranjeras', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (24, 'Licenciatura en Pedagogia', 1000);

-- Facultad de Ciencias Espaciales
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (25, 'Licenciatura en Astronomia y Astrofisica', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (26, 'Licenciatura en Operaciones Aeronauticas', 1000);

-- FacultaD De ciencias economicas
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (27, 'Licenciatura en Economia', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (28, 'Licenciatura en Banca y Finanzas', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (29, 'Licenciatura en Contaduria Publica', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (30, 'Licenciatura en Informatica Administrativa', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (31, 'Licenciatura en Metodos Cuantitativos', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (32, 'Licenciatura en Mercadotecnica', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (33, 'Licenciatura en Comercio Internacional', 1000);
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (34, 'Licenciatura en Administracion Publica', 1000);

-- Facultad de Ciencias Medicas
INSERT INTO Carrera (departamento_id, nombre_carrera, nota_minima_PAA) VALUES (35, 'Licenciatura en Medicina y Cirugia', 1000);


-- ******************Inserts para TipoExamen***********************
INSERT INTO Tipo_Examen (nombre_examen, nota_minima) VALUES ('PAA', 700);
INSERT INTO Tipo_Examen (nombre_examen, nota_minima) VALUES ('PCCNS', 400);
INSERT INTO Tipo_Examen (nombre_examen, nota_minima) VALUES ('PAM', 400);

-- *****************Inserts para ExamenCarrera***************************
-- PAA
INSERT INTO Examen_Carrera (tipo_examen_id, carrera_id) VALUES
(1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (1, 6), (1, 7), (1, 8), (1, 9), (1, 10),
(1, 11), (1, 12), (1, 13), (1, 14), (1, 15), (1, 16), (1, 17), (1, 18), (1, 19), (1, 20),
(1, 21), (1, 22), (1, 23), (1, 24), (1, 25), (1, 26), (1, 27), (1, 28), (1, 29), (1, 30),
(1, 31), (1, 32), (1, 33), (1, 34), (1, 35), (1, 36), (1, 37), (1, 38);

-- PCCNS
INSERT INTO Examen_Carrera (tipo_examen_id, carrera_id) VALUES (2,38);

-- PAM
INSERT INTO Examen_Carrera (tipo_examen_id, carrera_id) VALUES
(3, 8), (3, 9), (3, 10), (3, 11), (3, 12), (3, 13);


-- **********Inserts para CentroRegional***************
INSERT INTO Centro_Regional (nombre_centro, departamento_id) VALUES ('Ciudad Universitaria', 8);
INSERT INTO Centro_Regional (nombre_centro, departamento_id) VALUES ('Campus Cortes', 6);
INSERT INTO Centro_Regional (nombre_centro, departamento_id) VALUES ('Campus Comayagua', 4);
INSERT INTO Centro_Regional (nombre_centro, departamento_id) VALUES ('Campus Atlantida', 1);
INSERT INTO Centro_Regional (nombre_centro, departamento_id) VALUES ('Campus Choluteca', 2);
INSERT INTO Centro_Regional (nombre_centro, departamento_id) VALUES ('Campus Copan', 5);
INSERT INTO Centro_Regional (nombre_centro, departamento_id) VALUES ('Campus Olancho', 15);
INSERT INTO Centro_Regional (nombre_centro, departamento_id) VALUES ('Campus El Paraiso', 7);
INSERT INTO Centro_Regional (nombre_centro, departamento_id) VALUES ('Campus Yoro', 18);

-- ************Inserts para Carrera_Centro_Regional*************
-- Para CU
INSERT INTO Carrera_Centro_Regional (centro_regional_id, carrera_id) VALUES
(1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (1, 6), (1, 7), (1, 8), (1, 9), (1, 10),
(1, 11), (1, 12), (1, 13), (1, 14), (1, 15), (1, 16), (1, 17), (1, 18), (1, 19), (1, 20),
(1, 21), (1, 22), (1, 23), (1, 24), (1, 25), (1, 26), (1, 27), (1, 28), (1, 29), (1, 30),
(1, 31), (1, 32), (1, 33), (1, 34), (1, 35), (1, 36), (1, 37), (1, 38);

-- CAMPUS CORTES
INSERT INTO Carrera_Centro_Regional (centro_regional_id, carrera_id) VALUES
(2, 1), (2, 2),
(2, 6), (2, 7), (2, 8), (2, 9), (2, 10), (2, 11), (2, 12), (2, 13),
(2, 20), (2, 21), (2, 22),
(2, 30), (2, 31), (2, 32), (2, 33), (2, 34), (2, 35), (2, 36), (2, 37), (2, 38);

-- CAMPUS COMAYAGUA
INSERT INTO Carrera_Centro_Regional (centro_regional_id, carrera_id) VALUES
(3, 8), (3, 9), (3, 10), (3, 11), (3, 12), (3, 13),
(3, 30), (3, 31), (3, 32), (3, 33), (3, 34), (3, 35), (3, 36), (3, 37), (3, 38);

-- El resto de CAMPUS solo tendran ingenieria
INSERT INTO Carrera_Centro_Regional (centro_regional_id, carrera_id) VALUES
(4, 8), (4, 9), (4, 10), (4, 11), (4, 12), (4, 13),
(5, 8), (5, 9), (5, 10), (5, 11), (5, 12), (5, 13),
(6, 8), (6, 9), (6, 10), (6, 11), (6, 12), (6, 13),
(7, 8), (7, 9), (7, 10), (7, 11), (7, 12), (7, 13),
(8, 8), (8, 9), (8, 10), (8, 11), (8, 12), (8, 13),
(9, 8), (9, 9), (9, 10), (9, 11), (9, 12), (9, 13);


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







