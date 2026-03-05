<?php
namespace App\Helpers;

class Encode
{
    public function cifrar($dato)
    {
        $datocifrado = 'L$U';
        for ($i = 0; $i < strlen($dato); $i++) {
            $datocifrado .= $this->diccionario[$dato[$i]];
            $random_str = substr(str_shuffle("RULe$"), 0, 1);
            $datocifrado .= $random_str;
        }
        return $datocifrado;
    }
    public function descifrar($dato)
    {
        $datoDesifrado = '';
        for ($i = 0; $i < strlen($dato); $i++) {
            $datoDesifrado .= $this->diccionario[$dato[$i]];
        }
        return $datoDesifrado;
    }
    public function descifrarMasivo($dato)
    {
        $datosDesifrados = [];
        for ($i = 0; $i < count($dato); $i++) {
            $datosDesifrados[$i] = $this->descifrar($dato[$i]);
        }
        return $datosDesifrados;
    }
    private $diccionario = [
        '0' => 'c',
        '1' => 'a',
        '2' => 'm',
        '3' => 'i',
        '4' => 's',
        '5' => 'A',
        '6' => 'M',
        '7' => 'u',
        '8' => 'S',
        '9' => '!',
        'c' => '0',
        'a' => '1',
        'm' => '2',
        'i' => '3',
        's' => '4',
        'A' => '5',
        'M' => '6',
        'u' => '7',
        'S' => '8',
        '!' => '9',
        'R' => '',
        'U' => '',
        'L' => '',
        'e' => '',
        '$' => '',
    ];
}
