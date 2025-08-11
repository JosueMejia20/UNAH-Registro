-- INSERT DE PRUEBA
USE Registro;

-- Direcciones
INSERT INTO Direccion (departamento_id, descripcion) VALUES
(8, 'Colonia Kennedy, avenida los Próceres, casa #125'),
(6, 'Barrio Guamilito, 3ra calle, 2da avenida, casa amarilla'),
(4, 'Aldea Los Laureles, entrada principal, casa blanca con portón azul'),
(15, 'Barrio El Progreso, diagonal a la escuela primaria'),
(2, 'Residencial Vista Hermosa, bloque C, apartamento 301'),
(8, 'Colonia Miraflores, boulevard Morazán, edificio San Carlos'),
(6, 'Zona Rosa, 21 calle, 14 avenida, casa #89'),
(1, 'Barrio La Ceiba, frente al parque central'),
(7, 'Aldea San Antonio, carretera al cementerio, km 5'),
(18, 'Colonia Nueva Esperanza, 5ta avenida, casa esquinera'),
(5, 'Barrio Santa Rosa, calle del comercio, casa #67'),
(12, 'Residencial Las Flores, casa 45, cerca del supermercado'),
(3, 'Puerto Castilla, zona industrial, bodega 12'),
(9, 'Aldea Krausirpi, casa comunal, frente al río'),
(11, 'Roatán, barrio Los Fuertes, casa celeste con balcón');

-- Personas
INSERT INTO Persona (dni, nombre_completo, apellido_completo, numero_telefono, correo_personal, direccion_id, genero, fecha_nacimiento) VALUES
('0801199112350', 'María José', 'Zelaya Núñez', '9234-5678', 'maria.zelaya@example.com', 1, 'F', '1991-05-14'),
('0801198512351', 'Roberto Carlos', 'Medina Silva', '9567-8901', 'roberto.medina@example.com', 2, 'M', '1985-11-03'),
('0801199412352', 'Andrea Carolina', 'Vásquez Torres', '9890-1234', 'andrea.vasquez@example.com', 3, 'F', '1994-08-19'),
('0801199212353', 'Jorge Enrique', 'Morales Aguilar', '9345-6789', 'jorge.morales@example.com', 9, 'M', '1992-02-28'),
('0801199712354', 'Sofía Alejandra', 'Carranza Díaz', '9678-9012', 'sofia.carranza@example.com', 10, 'F', '1997-06-12'),
('0801198912355', 'Diego Fernando', 'Sánchez Rodríguez', '9123-4567', 'diego.sanchez@example.com', 11, 'M', '1989-10-07'),
('0801199312356', 'Valeria Beatriz', 'Flores Espinoza', '9456-7890', 'valeria.flores@example.com', 12, 'F', '1993-04-25'),
('0801199112357', 'Alejandro José', 'Castillo Ramos', '9789-0123', 'alejandro.castillo@example.com', 13, 'M', '1991-09-16'),
('0801199512358', 'Isabella María', 'Guerrero Peña', '9012-3456', 'isabella.guerrero@example.com', 14, 'F', '1995-01-30'),
('0801199012359', 'Kevin Alexander', 'Padilla Herrera', '9345-6789', 'kevin.padilla@example.com', 15, 'M', '1990-12-11'),
('0801198812360', 'Paola Fernanda', 'Rivera Mendoza', '9678-9012', 'paola.rivera@example.com', 14, 'F', '1988-03-08'),
('0801199612361', 'Oscar David', 'Cruz Alvarado', '9901-2345', 'oscar.cruz@example.com', 7, 'M', '1996-07-23'),
('0801199412362', 'Natalia Esperanza', 'Jiménez Valdez', '9234-5678', 'natalia.jimenez@example.com', 12, 'F', '1994-11-17'),
('0801199212363', 'Fernando José', 'Avilés Montoya', '9567-8901', 'fernando.aviles@example.com', 9, 'M', '1992-05-02'),
('0801199712364', 'Camila Alejandra', 'Rosales García', '9890-1234', 'camila.rosales@example.com', 12, 'F', '1997-08-14'),
('0801198512365', 'Manuel Antonio', 'Vargas López', '9123-4567', 'manuel.vargas@example.com', 6, 'M', '1985-12-29'),
('0801199312366', 'Stephanie Nicole', 'Bautista Cruz', '9456-7890', 'stephanie.bautista@example.com', 7, 'F', '1993-06-06'),
('0801199112367', 'Ricardo Emilio', 'Escoto Mejía', '9789-0123', 'ricardo.escoto@example.com', 8, 'M', '1991-10-20'),
('0801199512368', 'Melissa Andrea', 'Reyes Solano', '9012-3456', 'melissa.reyes@example.com', 9, 'F', '1995-02-15'),
('0801199012369', 'Jonathan David', 'Perdomo Cáceres', '9345-6789', 'jonathan.perdomo@example.com', 10, 'M', '1990-09-03');

-- Usuarios
INSERT INTO Usuario (persona_id, correo_institucional, contrasenia) VALUES
('0801199112350', 'maria.zelaya@unah.edu.hn', '1234'),
('0801198512351', 'roberto.medina@unah.edu.hn', '1234'),
('0801199412352', 'andrea.vasquez@unah.edu.hn', '1234'),
('0801199212353', 'jorge.morales@unah.edu.hn', '1234'),
('0801199712354', 'sofia.carranza@unah.edu.hn', '1234'),
('0801198912355', 'diego.sanchez@unah.edu.hn', '1234'),
('0801199312356', 'valeria.flores@unah.edu.hn', '1234'),
('0801199112357', 'alejandro.castillo@unah.edu.hn', '1234'),
('0801199512358', 'isabella.guerrero@unah.edu.hn', '1234'),
('0801199012359', 'kevin.padilla@unah.edu.hn', '1234'),
('0801198812360', 'paola.rivera@unah.edu.hn', '1234'),
('0801199612361', 'oscar.cruz@unah.edu.hn', '1234'),
('0801199412362', 'natalia.jimenez@unah.edu.hn', '1234'),
('0801199212363', 'fernando.aviles@unah.edu.hn', '1234'),
('0801199712364', 'camila.rosales@unah.edu.hn', '1234'),
('0801198512365', 'manuel.vargas@unah.edu.hn', '1234'),
('0801199312366', 'stephanie.bautista@unah.edu.hn', '1234'),
('0801199112367', 'ricardo.escoto@unah.edu.hn', '1234'),
('0801199512368', 'melissa.reyes@unah.edu.hn', '1234'),
('0801199012369', 'jonathan.perdomo@unah.edu.hn', '1234');


-- Estudiantes 
INSERT INTO Estudiante (numero_cuenta, carrera_id, usuario_id, centro_reg_id, anio_ingreso, estado, foto_perfil) VALUES
(20191001235, 1, 1, 1, 2019, 1, NULL),   -- Ana María - Licenciatura en Matemáticas
(20181002468, 2, 2, 1, 2018, 1, NULL),   -- Carlos Andrés - Licenciatura en Física  
(20201003691, 24, 3, 1, 2020, 1, NULL),  -- Daniela Fernanda - Licenciatura en Música
(20191004925, 1, 4, 1, 2019, 1, NULL),   -- Luis Alberto - Licenciatura en Matemáticas
(20221005258, 2, 5, 1, 2022, 1, NULL);   -- Gabriela Sofía - Licenciatura en Física

-- Docentes
INSERT INTO Docente (numero_empleado, persona_id, centro_reg_id, usuario_id, departamento_id, foto) VALUES
(1004, '0801199112350', 1, 6, 1, NULL),   -- María José - Dept. Matemáticas
(1005, '0801198512351', 1, 7, 2, NULL),   -- Roberto Carlos - Dept. Física
(1006, '0801199412352', 1, 8, 21, NULL),  -- Andrea Carolina - Dept. Arte
(1007, '0801199212353', 1, 9, 1, NULL),   -- Jorge Enrique - Dept. Matemáticas
(1008, '0801199712354', 1, 10, 2, NULL),  -- Sofía Alejandra - Dept. Física
(1009, '0801198912355', 1, 11, 21, NULL), -- Diego Fernando - Dept. Arte
(1010, '0801199312356', 1, 12, 1, NULL),  -- Valeria Beatriz - Dept. Matemáticas
(1011, '0801199112357', 1, 13, 2, NULL),  -- Alejandro José - Dept. Física
(1012, '0801199512358', 1, 14, 21, NULL), -- Isabella María - Dept. Arte
(1013, '0801199012359', 1, 15, 1, NULL),  -- Kevin Alexander - Dept. Matemáticas
(1014, '0801198812360', 1, 16, 2, NULL),  -- Paola Fernanda - Dept. Física
(1015, '0801199612361', 1, 17, 21, NULL), -- Oscar David - Dept. Arte
(1016, '0801199412362', 1, 18, 1, NULL),  -- Natalia Esperanza - Dept. Matemáticas
(1017, '0801199212363', 1, 19, 2, NULL),  -- Fernando José - Dept. Física
(1018, '0801199712364', 1, 20, 21, NULL); -- Camila Alejandra - Dept. Arte



-- Secciones para todas las clases - Periodo II PAC 2025 (periodo_acad_id = 8)

-- DEPARTAMENTO DE MATEMÁTICAS (clase_id 1-12)
-- Docentes disponibles: 1004, 1007, 1010, 1013, 1016

-- Clase 1: Matematicas I
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 1, 1004, 30, 8, 1, 1),
('1000', '10:00:00', '11:30:00', 1, 1007, 28, 8, 2, 2);

-- Clase 2: Geometria y Trigonometria
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 2, 1010, 30, 8, 3, 3),
('1400', '14:00:00', '15:30:00', 2, 1013, 25, 8, 1, 4);

-- Clase 3: Introduccion a la Computacion
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1200', '12:00:00', '13:30:00', 3, 1016, 25, 8, 4, 5);

-- Clase 4: Calculo I
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 4, 1004, 30, 8, 5, 6),
('1600', '16:00:00', '17:30:00', 4, 1007, 22, 8, 2, 7);

-- Clase 5: Vectores y Matrices
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1000', '10:00:00', '11:30:00', 5, 1010, 28, 8, 6, 8);

-- Clase 6: Programacion I
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1400', '14:00:00', '15:30:00', 6, 1013, 20, 8, 7, 9);

-- Clase 7: Calculo II
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 7, 1016, 30, 8, 8, 10),
('1200', '12:00:00', '13:30:00', 7, 1004, 26, 8, 3, 11);

-- Clase 8: Estadistica
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1000', '10:00:00', '11:30:00', 8, 1007, 30, 8, 9, 12);

-- Clase 9: Ecuaciones Diferenciales
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1600', '16:00:00', '17:30:00', 9, 1010, 24, 8, 1, 13);

-- Clase 10: Variable Compleja
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1400', '14:00:00', '15:30:00', 10, 1013, 20, 8, 4, 14);

-- Clase 11: Analisis Numerico
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 11, 1016, 25, 8, 10, 15);

-- Clase 12: Matematica Discreta
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1200', '12:00:00', '13:30:00', 12, 1004, 30, 8, 5, 16);

-- DEPARTAMENTO DE FÍSICA (clase_id 13-25)
-- Docentes disponibles: 1005, 1008, 1011, 1014, 1017

-- Clase 13: Fisica I
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 13, 1005, 30, 8, 11, 17),
('1000', '10:00:00', '11:30:00', 13, 1008, 28, 8, 2, 18);

-- Clase 14: Fisica II
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1200', '12:00:00', '13:30:00', 14, 1011, 30, 8, 12, 19),
('1600', '16:00:00', '17:30:00', 14, 1014, 25, 8, 3, 20);

-- Clase 15: Mecanica I
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1400', '14:00:00', '15:30:00', 15, 1017, 26, 8, 13, 21);

-- Clase 16: Elect. y Magnetismo I
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 16, 1005, 28, 8, 14, 22);

-- Clase 17: Mecanica II
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1000', '10:00:00', '11:30:00', 17, 1008, 24, 8, 15, 23);

-- Clase 18: Met. Fisico-Matematico
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1200', '12:00:00', '13:30:00', 18, 1011, 22, 8, 16, 24);

-- Clase 19: Fisica Moderna
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1400', '14:00:00', '15:30:00', 19, 1014, 30, 8, 17, 25),
('1600', '16:00:00', '17:30:00', 19, 1017, 26, 8, 4, 26);

-- Clase 20: Elect. y Magnetismo II
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 20, 1005, 25, 8, 18, 27);

-- Clase 21: Term. y Mec. Est. I
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1000', '10:00:00', '11:30:00', 21, 1008, 28, 8, 19, 28);

-- Clase 22: Mecanica Cuantica I
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1200', '12:00:00', '13:30:00', 22, 1011, 20, 8, 20, 29);

-- Clase 23: Lab Avanzado
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1400', '14:00:00', '15:30:00', 23, 1014, 18, 8, 21, 30);

-- Clase 24: Mecanica Cuantica II
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1600', '16:00:00', '17:30:00', 24, 1017, 16, 8, 22, 31);

-- Clase 25: Elem de Fis. Nuclear
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 25, 1005, 15, 8, 23, 32);

-- DEPARTAMENTO DE ARTE (MÚSICA) (clase_id 26-38)
-- Docentes disponibles: 1006, 1009, 1012, 1015, 1018

-- Clase 26: Instrumento I
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 26, 1006, 15, 8, 24, 33),
('1400', '14:00:00', '15:30:00', 26, 1009, 12, 8, 1, 34);

-- Clase 27: Solfeo
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1000', '10:00:00', '11:30:00', 27, 1012, 20, 8, 25, 35);

-- Clase 28: Armonia I
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1200', '12:00:00', '13:30:00', 28, 1015, 18, 8, 26, 36);

-- Clase 29: Instrumento II
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1600', '16:00:00', '17:30:00', 29, 1018, 15, 8, 27, 37);

-- Clase 30: Solfeo II
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 30, 1006, 18, 8, 28, 38);

-- Clase 31: Armonia II
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1000', '10:00:00', '11:30:00', 31, 1009, 16, 8, 29, 39);

-- Clase 32: Instrumento III
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1200', '12:00:00', '13:30:00', 32, 1012, 14, 8, 30, 40),
('1400', '14:00:00', '15:30:00', 32, 1015, 12, 8, 2, 41);

-- Clase 33: Solfeo III
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1600', '16:00:00', '17:30:00', 33, 1018, 15, 8, 31, 42);

-- Clase 34: Armonia III
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 34, 1006, 16, 8, 6, 43);

-- Clase 35: Historia de Musica I
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1000', '10:00:00', '11:30:00', 35, 1009, 25, 8, 7, 44);

-- Clase 36: Instrumento IV
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1200', '12:00:00', '13:30:00', 36, 1012, 12, 8, 8, 45);

-- Clase 37: Solfeo IV
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1400', '14:00:00', '15:30:00', 37, 1015, 18, 8, 9, 46);

-- Clase 38: Armonia IV
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1600', '16:00:00', '17:30:00', 38, 1018, 14, 8, 10, 47);




-- JEFES Y COORDINADORES DE CADA DEPARTAMENTO.

INSERT INTO Usuario_Rol (usuario_id, rol_id) VALUES
(8, 4),(11,5),(6,4),(9,5),(7,4),(10,5);




-- INSERTS PARA HISTORIAL ACADEMICO
-- Estudiante inscrito a 10 secciones con diferentes notas
-- INSERT INTO Estudiantes_Secciones (estudiante_id, seccion_id, nota, estado_clase_id)
-- VALUES 
-- ('20201003849', 1, 87, 1),  
-- ('20201003849', 2, 73, 1),
-- ('20201003849', 3, 91, 1),
-- ('20201003849', 4, 52, 2),  
-- ('20201003849', 5, 0, 4),   
-- ('20201003849', 6, 60, 2),
-- ('20201003849', 7, 75, 1),
-- ('20201003849', 8, 44, 2),
-- ('20201003849', 9, 66, 1),
-- ('20201003849', 12, 0, 4);


