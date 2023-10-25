<?php
namespace src\helpers;

use src\interfaces\IMensagem;

class MensagemErro implements IMensagem
{
    public static function mostrarMensagem($code, $mensagem)
    {
        http_response_code($code);
        die(json_encode([
            "status" => $code,
            "message" => $mensagem
        ]));
    }
}