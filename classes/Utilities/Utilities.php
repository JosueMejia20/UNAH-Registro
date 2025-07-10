<?php

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
}