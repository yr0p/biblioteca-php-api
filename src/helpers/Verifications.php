<?php
namespace src\helpers;

class Verifications{
    public static function isEmpty($data) {
        foreach($data as $key){
            if(empty($key)){
                MensagemErro::mostrarMensagem(400, "Alguns dados estão vazios!");
            }
        }
    }
}