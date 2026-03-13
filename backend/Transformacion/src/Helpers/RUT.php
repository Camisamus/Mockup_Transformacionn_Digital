<?php
namespace App\Helpers;

class RUT
{
    /**
     * Formats a RUT to xxxxxxxx-k format (lowercase, no dots, with hyphen).
     *
     * @param string|null $rut
     * @return string|null
     */
    public static function format($rut)
    {
        if (empty($rut)) {
            return $rut;
        }

        // Remove points, spaces and hyphens
        $rut = str_replace(['.', '-', ' '], '', $rut);

        // Convert to lowercase
        $rut = strtolower($rut);

        // Insert hyphen before last character if length > 1
        if (strlen($rut) > 1) {
            $rut = substr($rut, 0, -1) . '-' . substr($rut, -1);
        }

        return $rut;
    }

    /**
     * Validates a Chilean RUT.
     * 
     * @param string $rut
     * @return bool
     */
    public static function validate($rut)
    {
        $rut = preg_replace('/[^0-9kK]/i', '', $rut);
        if (strlen($rut) < 2)
            return false;

        $dv = substr($rut, -1);
        $numero = substr($rut, 0, -1);

        $i = 2;
        $suma = 0;
        foreach (array_reverse(str_split($numero)) as $v) {
            if ($i == 8)
                $i = 2;
            $suma += $v * $i;
            $i++;
        }

        $dvr = 11 - ($suma % 11);
        if ($dvr == 11)
            $dvr = 0;
        if ($dvr == 10)
            $dvr = 'K';

        return strtoupper($dv) == (string) $dvr;
    }

    /**
     * Checks if a RUT belongs to a legal entity (empresa).
     * In Chile, company RUTs start from 50,000,000.
     * 
     * @param string $rut
     * @return bool
     */
    public static function isLegalEntity($rut)
    {
        $rut = preg_replace('/[^0-9]/', '', $rut);
        if (empty($rut))
            return false;
        $num = (int) $rut;
        // Business RUTs are usually > 50.000.000
        return $num > 50000000;
    }
}
