use Registro;

DELIMITER $$

-- Funcion que retorna el id del usuario si existe en la tabla usuario sino retorna null
CREATE FUNCTION autenticarUsuario(
    p_correo VARCHAR(50),
    p_contrasenia VARCHAR(255)
)
RETURNS INT
NOT DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE v_usuario_id INT;

    SELECT usuario_id
    INTO v_usuario_id
    FROM Usuario
    WHERE correo_institucional = p_correo
      AND contrasenia = p_contrasenia
    LIMIT 1;

    RETURN v_usuario_id;
END$$


-- Funcion que retorna 1 si el usuario es tiene el rol de revisor y retorna 0 si el usuario no tiene ese rol
CREATE FUNCTION isRevisor(p_usuario_id INT)
RETURNS TINYINT
NOT DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE v_existe INT;

    SELECT COUNT(*)
    INTO v_existe
    FROM Usuario_Rol
    WHERE usuario_id = p_usuario_id AND rol_id = 1;

    RETURN IF(v_existe > 0, 1, 0);
END$$

DELIMITER ;
