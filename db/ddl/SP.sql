USE Registro;

DROP PROCEDURE IF EXISTS getAllFacultad;
DROP PROCEDURE IF EXISTS getFacultadByID;
DROP PROCEDURE IF EXISTS getAllEstado_Civil;
DROP PROCEDURE IF EXISTS getAllDepartamento_Pais;
DROP PROCEDURE IF EXISTS getAllPais;
DROP PROCEDURE IF EXISTS getAllCentro_Regional;
DROP PROCEDURE IF EXISTS getAllCarrera;
DROP PROCEDURE IF EXISTS getCarrerasByCentro;

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

DELIMITER ;


