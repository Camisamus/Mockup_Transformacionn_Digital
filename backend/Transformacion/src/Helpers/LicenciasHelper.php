<?php
namespace App\Helpers;

class LicenciasHelper
{
    /**
     * Convierte una hora (HH:mm) al número de bloque (1-48).
     * Cada bloque es de 30 minutos.
     * @param string $hora Formato "HH:mm"
     * @return int Bloque del 1 al 48
     */
    public static function horaABloque($hora)
    {
        $partes = explode(':', $hora);
        if (count($partes) < 2)
            return 1;

        $horas = (int) $partes[0];
        $minutos = (int) $partes[1];

        // Cada hora tiene 2 bloques. 
        // 00:00 -> Bloque 1
        // 00:30 -> Bloque 2
        // 23:30 -> Bloque 48
        return ($horas * 2) + ($minutos >= 30 ? 2 : 1);
    }

    /**
     * Convierte un número de bloque (1-48) a la hora de inicio (HH:mm).
     * @param int $bloque Bloque del 1 al 48
     * @return string Formato "HH:mm"
     */
    public static function bloqueAHora($bloque)
    {
        $bloque = (int) $bloque;
        if ($bloque < 1)
            $bloque = 1;
        if ($bloque > 48)
            $bloque = 48;

        // Ajustamos a base 0 para el cálculo
        $b0 = $bloque - 1;
        $horas = floor($b0 / 2);
        $minutos = ($b0 % 2) * 30;

        return sprintf("%02d:%02d", $horas, $minutos);
    }

    /**
     * Retorna el diccionario completo de bloques para el día.
     * Utíl para el frontend.
     * @return array
     */
    public static function obtenerDiccionarioBloques()
    {
        $diccionario = [];
        for ($i = 1; $i <= 48; $i++) {
            $diccionario[$i] = self::bloqueAHora($i);
        }
        return $diccionario;
    }
}
