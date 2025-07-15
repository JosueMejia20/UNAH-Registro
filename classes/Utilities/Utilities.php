<?php
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../db/DataBase.php';

class Utilities
{
    /**
     * Recibe una cadena en base64 (con o sin encabezado) y retorna los bits de la imagen.
     * 
     * @param string $base64 La cadena base64 de la imagen.
     * @return string|null Los datos binarios (bits) o null si falla la conversión.
     */
    public static function obtenerBinario(string $base64): ?string
    {
        // Remover encabezado MIME si está presente
        if (str_starts_with($base64, 'data:')) {
            $base64 = substr($base64, strpos($base64, ',') + 1);
        }

        // Reemplazar espacios por "+" si vienen mal codificados
        $base64 = str_replace(' ', '+', $base64);

        // Decodificar la cadena base64
        $binario = base64_decode($base64, true);

        // Verificar que la decodificación fue exitosa
        return $binario !== false ? $binario : null;
    }

    public static function obtenerBase64(string $binario){
        $base64 = base64_encode($binario);

        return $base64;
    }

    public static function enviarCorreo(string $mensaje, string $correoPersonal): bool
    {
        // Crear una instancia
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';      
            $mail->SMTPAuth   = true;
            $mail->Username   = 'unahcorreos@gmail.com';    // Correo remitente
            $mail->Password   = 'nupu xtow fkav gkoy';            // Contraseña del correo
            $mail->SMTPSecure = 'tls';                      
            $mail->Port       = 587;                        // 587 para TLS

            // Datos del mensaje
            $mail->setFrom('unahcorreos@gmail.com', 'UNAH');
            $mail->addAddress($correoPersonal);

            $mail->isHTML(false);
            $mail->Subject = 'Solicitud de Admision UNAH';
            $mail->Body    = $mensaje;

            $mail->send();
         //   echo 'Mensaje enviado correctamente';
            return true;
        } catch (Exception $e) {
        //    echo "Error al enviar el mensaje: {$e->getMessage()}";
            return false;
        }
    }

    public static function login(string $username, string $password){
        try{
            $db = new DataBase();
            $pdo = $db->connect();

            //VER COMO SE VA A LLAMAR EL SP
            $stmt = $pdo->prepare("SELECT autenticarUsuario(:username, :pass) AS resultado");

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':pass', $password);

            $stmt->execute();

            $fila = $stmt->fetch(PDO::FETCH_ASSOC);

            return $fila['resultado'];
        } catch(PDOException $e){
            return "Error en la base de datos: ".$e->getMessage();
        }
    }

    public function crearCSV(string $encabezado, array $data, string $ruta):bool
    {
        $archivo = fopen($ruta, 'w');
        if (!$archivo) {
            return false;
        }

        //escribir el encabezado
        $columnas = explode(',', $encabezado);
        fputcsv($archivo, $columnas);

        //escribiendo la data (contenido) linea por lines
        foreach ($data as $registro) {
            $valores = explode(',', $registro);
            fputcsv($archivo, $valores);
        }

        fclose($archivo);
        return true;
    }

    public function pruebaCSV () {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            //consulta sql retorna dnis sus tipos de examen y su nota minima
            $sql = "SELECT 
                        p.dni,
                        ite.tipo_examen_id,
                        te.nota_minima
                    FROM 
                        Postulante p
                    JOIN 
                        Inscripcion i ON p.dni = i.postulante_id
                    JOIN 
                        Inscripciones_Tipo_Examen ite ON i.inscripcion_id = ite.inscripcion_id
                    JOIN 
                        Tipo_Examen te ON ite.tipo_examen_id = te.tipo_examen_id
                    ORDER BY 
                        p.dni, ite.tipo_examen_id;";

            $stmt = $pdo->query($sql);
            $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //convirtiendo el array de resultados a array de líneas CSV
            $contenido = [];

            foreach ($filas as $fila) {
                $dni = $fila['dni'];
                $tipoExamen = $fila['tipo_examen_id'];
                $notaMinima = $fila['nota_minima'];
                $resultado = rand(0, $notaMinima); // valor aleatorio entre 0 y nota minima (solo es una prueba)

                $contenido[] = "$dni,$tipoExamen,$resultado";
            }


            //definiendo encabezado y ruta
            $encabezado = "dni,tipoExamen,resultado";
            $rutaArchivo = "../temp/postulantes_resultados.csv";

            if(self::crearCSV($encabezado, $contenido, $rutaArchivo)) {
                echo "csv creado exitosamente en: $rutaArchivo";
            }else {
                echo "error al crear csv";
            }
        }catch (PDOException $e) {
            return "Error en la base de datos: ".$e->getMessage();
        }
    }
}