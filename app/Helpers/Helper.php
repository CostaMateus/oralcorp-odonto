<?php

namespace App\Helpers;

class Helper
{
    public static function loginResponse($code)
    {
        switch ($code) {
            case 500:
                $return = "Falha na comunicação do serviço. Tente novamente mais tarde. 500";
            break;
            case 404:
                $return = "Unidade, e-mail e/ou senha incorreta. 404";
            break;
            case 401:
                $return = "Usuário não autorizado. 401";
            break;
            case 400:
                $return = "Ocorreu um erro. Tente novamente. 400";
            break;
            case 200:
                $return = "Sucesso. 200";
            break;
        }

        return $return;
    }

    // public static function usort(&$data)
    // {
    //     usort($data, function($a, $b) {
    //         return $a["NROPAC"] <= $b["NROPAC"];
    //     });
    // }
}
