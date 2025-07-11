<?php
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
}