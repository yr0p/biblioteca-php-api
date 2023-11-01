<?php
namespace src\controllers;

class IndexController
{
    public static function welcome()
    {
        header("Content-type: application/json;");
        echo json_encode([
            "author" => "Pablio Richardy",
            "GitHub" => [
                "Personal" => [
                "main" => "https://github.com/pablioRichardy",
                "alternnative" => "https://github.com/yr0p"
                ],
                'API' => ''
            ]
        ]);
    }
}
