<?php
namespace src\helpers;

use src\interfaces\IMensagem;

class Mensagem
{
    public static function mostrarMensagem(IMensagem $tipoMensagem, $code, $mensagem)
    {
        $tipoMensagem::mostrarMensagem($code, $mensagem);
    }
}