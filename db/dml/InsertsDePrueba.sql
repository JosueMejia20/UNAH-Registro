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

-- Docente de Prueba
INSERT INTO Docente (numero_empleado, persona_id, centro_reg_id, usuario_id, departamento_id, foto) VALUES (1002, '0801198812346', 1, 2, 1, NULL);

