<?php

namespace App\Helpers;

class PersonalEasyHelper
{
    /**
     * Undocumented function
     *
     * @param int $phase
     * @param array $data
     * @return void
     */
    public static function dataConverter($option, &$data)
    {
        if (empty($data)) return;

        switch ($option)
        {
            case "users":
                $newKeys = [
                    "nropac"   =>  "external_id",
                    "snome"    =>  "name",
                    "telefone" =>  "phone",
                    "ssenha"   =>  "password"
                ];
                self::arrayReplaceKeys($data, $newKeys);
            break;

            case "images":
                $newKeys = [
                    "imagem" => "image",
                ];
                self::arrayReplaceKeys($data, $newKeys);
            break;

            case "userSchedule":
                $newKeys = [
                    "horario"        => "schedule",
                    "id_agendamento" => "schedule_id",
                ];
                self::arrayReplaceKeys($data, $newKeys);
            break;

            case "createSchedule":
            case "cancelSchedule":
                $newKeys = [
                    "vl" => "schedule_id",
                    "tx" => "statusText"
                ];
                self::arrayReplaceKeys($data, $newKeys);
            break;

            case "financial":
                $newKeys = [
                    "data"  => "date",
                    "valor" => "value"
                ];
                self::arrayReplaceKeys($data, $newKeys);
            break;

            case "discounts":
                $newKeys = [
                    "indicacoes_efetivadas" => "indications_made",
                    "descontos_concedidos"  => "discounts_received",
                    "descontos_a_receber"   => "discounts_to_be_received"
                ];
                self::arrayReplaceKeys($data, $newKeys);
            break;

            case "checkin":
                $newKeys = [
                    "bt"       => "checkin_id",
                    "bt_descr" => "name",
                    // "bt_ag"    => "schedule",
                    // "bt_reag"  => "reschedule"
                ];
                self::arrayReplaceKeys($data, $newKeys);
            break;

            case "postCheckin":
                $newKeys = [
                    "tx" => "statusText",
                ];
                self::arrayReplaceKeys($data, $newKeys);
            break;

            case "freeSchedules":
                $newKeys = [
                    "data"    => "date",
                    "horario" => "hour",
                ];
                self::arrayReplaceKeys($data, $newKeys);
            break;
        }

    }

    private static function arrayReplaceKeys(array &$array, array $replacements)
    {
        foreach ($array as $key => &$arr)
        {
            foreach ($replacements as $old => $new)
            {
                $arr = array_change_key_case( $arr, CASE_LOWER);

                if (array_key_exists($old, $arr))
                {
                    $arr[$new] = !empty($arr[$old]) ? $arr[$old] : null;
                    unset($arr[$old]);
                }
                else
                {
                    $arr[$new] = null;
                }

                // only case: userSchedule
                if ($old == "horario" && $new == "schedule")
                {
                    $aux = explode(" ", $arr[$new]);

                    if ($aux[0] == "00/00/0000" || $aux[0] == "00/00/0001")
                    {
                        unset($array[$key]);
                        continue;
                    }

                    $arr[$new] = [
                        "date" => $aux[0],
                        "hour" => $aux[1],
                    ];
                }

                // only case: financial e freeSchedules
                if ($old == "data" && $new == "date")
                {
                    if ($arr[$new] == "00/00/0000" || $arr[$new] == "00/00/0001")
                    {
                        unset($array[$key]);
                        continue;
                    }
                }

                // only case: discounts
                if (in_array($new, ["indications_made", "discounts_received", "discounts_to_be_received"]))
                {
                    $arr[$new] = ($arr[$new] >= 0) ? $arr[$new] : 0;
                }
            }
        }

        return $array;
    }
}
