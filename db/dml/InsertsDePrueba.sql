-- INSERT DE PRUEBA
USE Registro;

-- Direcciones
INSERT INTO Direccion (departamento_id, descripcion) VALUES
(1, 'Barrio El Centro, calle principal frente a la alcaldía'),
(2, 'Colonia San Miguel, casa #34, a 2 cuadras de la iglesia'),
(3, 'Aldea El Porvenir, carretera a la montaña, kilómetro 12'),
(4, 'Residencial Los Pinos, bloque D, casa 17'),
(5, 'Zona industrial norte, edificio 3, oficina 202');

-- Personas
INSERT INTO Persona (dni, nombre_completo, apellido_completo, numero_telefono, correo_personal, direccion_id, genero, fecha_nacimiento) VALUES
('0801199012345', 'Ana María', 'González Rivera', '9876-5432', 'ana.gonzalez@example.com', 1, 'F', '1990-03-15'),
('0801198812346', 'Carlos Andrés', 'López Martínez', '9456-7890', 'carlos.lopez@example.com', 2, 'M', '1988-07-22'),
('0801199512347', 'Daniela Fernanda', 'Ramírez Castro', '9123-4567', 'daniela.ramirez@example.com', 3, 'F', '1995-12-05'),
('0801199312348', 'Luis Alberto', 'Hernández Mejía', '9345-6789', 'luis.hernandez@example.com', 4, 'M', '1993-09-10'),
('0801199612349', 'Gabriela Sofía', 'Ortiz Pineda', '9789-1234', 'gabriela.ortiz@example.com', 5, 'F', '1996-01-28');

-- Usuarios
INSERT INTO Usuario (persona_id, correo_institucional, contrasenia) VALUES
('0801199012345', 'ana.gonzalez@unah.edu.hn', '1234'),
('0801198812346', 'carlos.lopez@unah.edu.hn', '1234'),
('0801199512347', 'daniela.ramirez@unah.edu.hn', '1234'),
('0801199312348', 'luis.hernandez@unah.edu.hn', '1234'),
('0801199612349', 'gabriela.ortiz@unah.edu.hn', '1234');

-- Roles usuarios
INSERT INTO Usuario_Rol (usuario_id, rol_id) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1);

-- Estudiante de prueba
INSERT INTO Estudiante (numero_cuenta, carrera_id,usuario_id,centro_reg_id,anio_ingreso,estado) VALUES (20201003849, 1,1,1,'2019',1);

INSERT INTO Estudiante (numero_cuenta, carrera_id, usuario_id, centro_reg_id, anio_ingreso, estado, foto_perfil) VALUES
(20201004567, 2, 2, 1, 2020, 1, NULL),
(20211001234, 1, 3, 2, 2021, 1, NULL),
(20221007890, 3, 4, 2, 2022, 1, NULL),
(20231001122, 4, 5, 3, 2023, 1, NULL);


-- Docente de Prueba
INSERT INTO Docente (numero_empleado, persona_id, centro_reg_id, usuario_id, departamento_id, foto) VALUES (1002, '0801198812346', 1, 2, 1, NULL);
INSERT INTO Docente (numero_empleado, persona_id, centro_reg_id, usuario_id, departamento_id, foto) VALUES (1003, '0801199512347',1,3,1, NULL);
-- Secciones de Prueba
INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('0800', '08:00:00', '09:30:00', 1, 1002, 30, 8, 1, 3),
('1000', '10:00:00', '11:30:00', 1, 1002, 30, 8, 2, 5),
('1200', '12:00:00', '13:30:00', 1, 1002, 25, 8, 3, 2),
('1400', '14:00:00', '15:30:00', 1, 1002, 20, 8, 4, 7),
('1600', '16:00:00', '17:30:00', 1, 1002, 15, 8, 5, 1),

('0801', '08:00:00', '09:30:00', 1, 1002, 30, 7, 6, 4),
('1001', '10:00:00', '11:30:00', 1, 1002, 30, 7, 7, 6),
('1201', '12:00:00', '13:30:00', 1, 1002, 25, 7, 8, 9);

INSERT INTO Seccion (codigo_seccion, hora_inicio, hora_fin, clase_id, docente_id, cupos, periodo_acad_id, dias_id, aula_id) VALUES
('1204', '12:00:00', '13:30:00', 1, 1003, 25, 8, 8, 9);

-- Contactos de Prueba.
INSERT INTO Contactos (estudiante_1_id, estudiante_2_id, fecha_contacto) VALUES
(20201003849, 20201004567, NOW()),
(20201003849, 20211001234, NOW()),
(20201003849, 20221007890, NOW()),
(20201003849, 20231001122, NOW());

-- Mensajes de Prueba
-- Mensajes entre 20201003849 y 20201004567
INSERT INTO Mensaje (emisor_id, receptor_id, contenido, fecha_envio) VALUES
('20201003849', '20201004567', 'Hola, ¿cómo va todo?', NOW() - INTERVAL 15 MINUTE),
('20201004567', '20201003849', 'Bien, gracias. ¿Y tú?', NOW() - INTERVAL 14 MINUTE);

-- Mensajes entre 20201003849 y 20211001234
INSERT INTO Mensaje (emisor_id, receptor_id, contenido, fecha_envio) VALUES
('20211001234', '20201003849', '¿Has revisado la tarea?', NOW() - INTERVAL 13 MINUTE),
('20201003849', '20211001234', 'Sí, la terminé anoche.', NOW() - INTERVAL 12 MINUTE);

-- Mensajes entre 20201003849 y 20221007890
INSERT INTO Mensaje (emisor_id, receptor_id, contenido, fecha_envio) VALUES
('20201003849', '20221007890', '¿Nos vemos en la biblioteca?', NOW() - INTERVAL 11 MINUTE),
('20221007890', '20201003849', 'Claro, a las 4 pm está bien.', NOW() - INTERVAL 10 MINUTE);

-- Mensajes entre 20201003849 y 20231001122
INSERT INTO Mensaje (emisor_id, receptor_id, contenido, fecha_envio) VALUES
('20231001122', '20201003849', '¿Terminaste el proyecto?', NOW() - INTERVAL 9 MINUTE),
('20201003849', '20231001122', 'Sí, ya lo envié.', NOW() - INTERVAL 8 MINUTE);

-- SOLICITUDES DE CONTACTO
-- Estudiante 20201004567 envía solicitud pendiente al estudiante 20201003849
INSERT INTO Solicitudes_Contacto (emisor_id, receptor_id, estado_solicitud_id, fecha_solicitud)
VALUES ('20201004567', '20201003849', 1, NOW());

-- Estudiante 20211001234 envía solicitud aceptada al estudiante 20201003849
INSERT INTO Solicitudes_Contacto (emisor_id, receptor_id, estado_solicitud_id, fecha_solicitud)
VALUES ('20211001234', '20201003849', 3, NOW());

-- Estudiante 20221007890 envía solicitud rechazada al estudiante 20201003849
INSERT INTO Solicitudes_Contacto (emisor_id, receptor_id, estado_solicitud_id, fecha_solicitud)
VALUES ('20221007890', '20201003849', 2, NOW());

-- Estudiante 20231001122 envía solicitud pendiente al estudiante 20201003849
INSERT INTO Solicitudes_Contacto (emisor_id, receptor_id, estado_solicitud_id, fecha_solicitud)
VALUES ('20231001122', '20201003849', 1, NOW());




