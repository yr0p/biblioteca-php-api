<?php
namespace src\controllers;

use src\interfaces\IController;

class IndexController implements IController
{
    public static function run()
    {
        header("Content-type: application/json;");
        echo json_encode([
            "author" => "Pablio Richardy",
            "GitHub" => [
                "Personal" => [
                "main" => "https://github.com/pablioRichardy",
                "alternnative" => "https://github.com/yr0p"
                ],
                "API" => ""
            ]
        ]);
    }
}

IndexController::run();