<?php
namespace src\helpers;

class MensagemErro{
    public static function mostrarMensagem($code, $mensagem){
        http_response_code($code);
        die(json_encode([
            "status" => "400",
            "message" => $mensagem
        ]));
    }
}