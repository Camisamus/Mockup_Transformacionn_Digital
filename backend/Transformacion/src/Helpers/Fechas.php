<?php
namespace App\Helpers;

class Fechas
{
    /**
     * Suma días hábiles (Lunes a Viernes) a una fecha.
     * @param string $fecha Fecha inicial (Y-m-d)
     * @param int $dias Cantidad de días hábiles a sumar
     * @return string Fecha resultante (Y-m-d)
     */
    /**
     * Suma días hábiles (Lunes a Viernes) a una fecha, considerando feriados si se provee conexión.
     * @param string $fecha Fecha inicial (Y-m-d)
     * @param int $dias Cantidad de días hábiles a sumar
     * @param \PDO|null $conn Conexión a BD para consultar sup_feriados
     * @return string Fecha resultante (Y-m-d)
     */
    public static function sumarDiasHabiles($fecha, $dias, $conn = null)
    {
        $fecha_dt = new \DateTime($fecha);

        $feriados = [];
        if ($conn) {
            try {
                // Consultamos feriados en un rango razonable (ej: 60 días desde la fecha inicial)
                // Usamos un margen amplio para asegurar que cubrimos los 20+ días hábiles
                $fecha_fin_estimada = clone $fecha_dt;
                $fecha_fin_estimada->modify('+' . ($dias * 2) . ' days'); // Estimación generosa

                $query = "SELECT fer_fecha FROM sup_feriados 
                          WHERE fer_fecha BETWEEN :inicio AND :fin";
                $stmt = $conn->prepare($query);
                $stmt->execute([
                    'inicio' => $fecha_dt->format('Y-m-d'),
                    'fin' => $fecha_fin_estimada->format('Y-m-d')
                ]);
                $feriados = $stmt->fetchAll(\PDO::FETCH_COLUMN);
            } catch (\Exception $e) {
                error_log("Error al consultar feriados: " . $e->getMessage());
            }
        }

        $i = 0;
        while ($i < $dias) {
            $fecha_dt->modify('+1 day');
            $w = $fecha_dt->format('w');
            $f = $fecha_dt->format('Y-m-d');

            $esFeriado = in_array($f, $feriados);

            if ($w != 0 && $w != 6 && !$esFeriado) { // 0=Domingo, 6=Sábado
                $i++;
            }
        }
        return $fecha_dt->format('Y-m-d');
    }

    /**
     * Formatea una fecha de Y-m-d a d-m-Y (DD-MM-AAAA)
     * @param string|null $fecha
     * @return string
     */
    public static function formatearFecha($fecha)
    {
        if (!$fecha || $fecha === '0000-00-00')
            return '-';
        try {
            $dt = new \DateTime($fecha);
            return $dt->format('d-m-Y');
        } catch (\Exception $e) {
            return '-';
        }
    }
}