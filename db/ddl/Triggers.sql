USE Registro;

DROP TRIGGER IF EXISTS trg_AfterInsertInscripcion;

-- Triggers

DELIMITER $$

CREATE TRIGGER trg_AfterInsertInscripcion
AFTER INSERT ON Inscripcion
FOR EACH ROW
BEGIN
	INSERT INTO Inscripciones_Tipo_Examen (inscripcion_id, tipo_examen_id)
		SELECT DISTINCT
			NEW.inscripcion_id,
			ec.tipo_examen_id
		FROM Examen_Carrera ec
		WHERE ec.carrera_id IN (NEW.carrera_primaria, NEW.carrera_secundaria);

END $$

DELIMITER ;