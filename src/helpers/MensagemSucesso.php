<?php
namespace src\helpers;

use src\interfaces\IMensagem;

class MensagemSucesso implements IMensagem
{
    public static function mostrarMensagem($code, $mensagem)
    {
        http_response_code($code);
        echo json_encode([
            "status" => $code,
            "message" => $mensagem
        ]);
    }
}