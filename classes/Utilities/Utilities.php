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

            $mail->isHTML(true);
            $mail->Subject = 'Solicitud de Admision UNAH';

            $mail->addEmbeddedImage(__DIR__ . '/img/UNAH-logo.png', 'UNAH-logo');

            $html = '
                    <!DOCTYPE html>
                    <html lang="es">
                    <head>
                        <meta charset="UTF-8">
                        <title>Solicitud Aceptada</title>
                    </head>
                    <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 0; margin: 0;">
                        <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 20px 0;">
                            <tr>
                                <td align="center">
                                    <table width="550" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                                        <tr>
                                            <td style="padding: 30px; text-align: center;">
                                                <img src="cid:UNAH-logo" alt="UNAH" width="80" style="margin-bottom: 20px;">
                                                <h2 style="color: #333333;">'.$mensaje.'</h2>
                                                <p style="font-size: 12px; color: #999999; margin-top: 30px;">
                                                    Atentamente: UNAH<br>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #005f87; text-align: center; padding: 15px; font-size: 11px; color:rgb(255, 255, 255);">
                                                © 2025 Universidad Nacional Autónoma de Honduras
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </body>
                    </html>';

            $mail->Body    = $html;

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

    public function csvGenerarInscripcionesAceptadas() {
        try {
            $db = new DataBase();
            $pdo = $db->connect();

            //consulta sql retorna dnis sus tipos de examen y su nota minima
            $sql = "SELECT 
                        p.dni,
                        te.tipo_examen_id,
                        te.nota_maxima
                    FROM Postulante p
                    JOIN Inscripcion i ON p.dni = i.postulante_id
                    JOIN Inscripciones_Tipo_Examen ite ON i.inscripcion_id = ite.inscripcion_id
                    JOIN Tipo_Examen te ON ite.tipo_examen_id = te.tipo_examen_id
                    WHERE i.estado_revision_id = 2";


            $stmt = $pdo->query($sql);
            $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //convirtiendo el array de resultados a array de líneas CSV
            $contenido = [];

            foreach ($filas as $fila) {
                $dni = $fila['dni'];
                $tipoExamen = $fila['tipo_examen_id'];
                $notaMaxima = $fila['nota_maxima'];
                $resultado = rand(400, $notaMaxima); // valor aleatorio entre 0 y nota maxima (solo es una prueba)

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

    public static function insertarResultados() {
        $db = new DataBase();
        $pdo = $db->connect();
        $archivoCSV = fopen("../temp/postulantes_resultados.csv", "r");

        if ($archivoCSV !== false) {
            // Omitir encabezado
            fgetcsv($archivoCSV);

            while (($datos = fgetcsv($archivoCSV)) !== false) {
                $dni = trim($datos[0]);
                $tipoExamen = trim($datos[1]);
                $resultado = trim($datos[2]);

                // Validación básica
                if ($dni && $tipoExamen && is_numeric($resultado)) {
                    // Verificar si ya existe
                    $stmtCheck = $pdo->prepare("SELECT id FROM Resultados WHERE dni = ? AND tipo_examen_id = ?");
                    $stmtCheck->execute([$dni, $tipoExamen]);

                    if ($stmtCheck->rowCount() > 0) {
                        // Ya existe, hacer UPDATE
                        $stmtUpdate = $pdo->prepare("UPDATE Resultados SET resultado = ? WHERE dni = ? AND tipo_examen_id = ?");
                        $stmtUpdate->execute([$resultado, $dni, $tipoExamen]);
                    } else {
                        // No existe, hacer INSERT
                        $stmtInsert = $pdo->prepare("INSERT INTO Resultados (dni, tipo_examen_id, resultado) VALUES (?, ?, ?)");
                        $stmtInsert->execute([$dni, $tipoExamen, $resultado]);
                    }
                }
            }

            fclose($archivoCSV);
            echo "Registros insertados o actualizados correctamente.";
        } else {
            echo "No se pudo abrir el archivo CSV.";
        }
    }
}