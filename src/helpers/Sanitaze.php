<?php

namespace src\helpers;

class Sanitaze
{
    public static function limpar($user, $password, $email = "1", $name = "1")
    {
        $data = [];

        $user = preg_replace('/[()=;]/', '', filter_var($user, FILTER_SANITIZE_SPECIAL_CHARS));
        $password = preg_replace('/[()=;]/', '', filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS));
        $email = preg_replace('/[()=;]/', '', filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS));
        $name = preg_replace('/[()=;]/', '', filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS));

        if($email == "1" && $name = "1")
        {
            $data = [
                'user' => $password,
                'password' => $password
            ];
            return $data;
        }
        $data = [
            'user' => $user,
            'password' => $password,
            'email' => $email,
            'name' => $name
        ];
        return $data;
    }
}