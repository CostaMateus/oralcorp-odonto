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

        // $common = [
        //     "NROPAC"  => "patient_id",
        //     "PRINOM"  => "name",
        //     "CELULAR" => "phone",
        // ];

        switch ($option)
        {
            // case 1:
            //     $newKeys = [
            //         "ULTAGE"       => "scheduled", // date
            //         "PREST_ULTAGE" => "provider",  // string
            //         "ST_ULTAGE"    => "status",    // string
            //         "MOT_ULTAGE"   => "motive",    // string
            //     ];

            //     $newKeys = array_merge($common, $newKeys);

            //     self::arrayReplaceKeys($data, $newKeys);
            // break;

            // case 2:
            //     $newKeys = [
            //         "AG7"            => "above",     // boolean
            //         "PROXCONS"       => "scheduled", // date
            //         "PREST_PROXCONS" => "provider",  // string
            //         "ST_PROXCONS"    => "status",    // string
            //         "MOT_PROXCONS"   => "motive",    // string
            //     ];

            //     $newKeys = array_merge($common, $newKeys);

            //     self::arrayReplaceKeys($data, $newKeys);
            // break;

            // case 3:
            //     $newKeys = [
            //         "PROXCONS"       => "scheduled", // date
            //         "PREST_PROXCONS" => "provider",  // string
            //         "ULTHIS"         => "last_note", // string
            //     ];

            //     $newKeys = array_merge($common, $newKeys);

            //     self::arrayReplaceKeys($data, $newKeys);
            // break;

            // case 4:
            //     $newKeys = [
            //         "PROXCONS" => "scheduled", // boolean
            //         "VL_DEB"   => "overdue",   // boolean
            //         "VL_VNP"   => "opened",    // boolean
            //         "ULTHIS"   => "last_note", // string
            //     ];

            //     $newKeys = array_merge($common, $newKeys);

            //     self::arrayReplaceKeys($data, $newKeys);
            // break;

            // case 5:
            //     $newKeys = [
            //         "RETORNO" => "scheduled", // boolean
            //         "VL_DEB"  => "overdue",   // boolean
            //         "VL_VNP"  => "opened",    // boolean
            //         "ULTHIS"  => "last_note", // string
            //     ];

            //     $newKeys = array_merge($common, $newKeys);

            //     self::arrayReplaceKeys($data, $newKeys);
            // break;

            // case "returnOpt":
            //     $newKeys = [
            //         "NM_RETORNO" => "name", // string
            //     ];
            //     self::arrayReplaceKeys($data, $newKeys);
            // break;

            // case "put":
            //     $newKeys = [
            //         "VL" => "statusCode", // string
            //         "TX" => "statusText", // string
            //     ];
            //     self::arrayReplaceKeys($data, $newKeys);
            // break;

            // case "providers":
            //     $newKeys = [
            //         "ID_PRESTADOR" => "provider_id",   // int
            //         "NM_PRESTADOR" => "provider_name", // string
            //     ];
            //     self::arrayReplaceKeys($data, $newKeys);
            // break;

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
                    // "nropac"   =>  "external_id",
                ];
                self::arrayReplaceKeys($data, $newKeys);
            break;

            case "schedule":
                $newKeys = [
                    "horario" => "schedule",
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
                    "bt_ag"    => "schedule",
                    "bt_reag"  => "reschedule"
                ];
                self::arrayReplaceKeys($data, $newKeys);
            break;

            case "postCheckin":
                $newKeys = [
                    "tx" => "statusText",
                ];
                self::arrayReplaceKeys($data, $newKeys);
            break;
        }

    }

    private static function arrayReplaceKeys(array &$array, array $replacements)
    {
        foreach ($array as &$arr)
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

                // Separar a data e a hora
                if ($new == "schedule")
                {
                    if (strlen($arr[$new]) == 1)
                        self::toBoolean($arr, $new, $arr[$new]);
                    else
                        self::convertDate($arr, $new, $arr[$new]);
                }

                // only case: discounts
                if (in_array($new, ["indications_made", "discounts_received", "discounts_to_be_received"]))
                {
                    $arr[$new] = ($arr[$new] >= 0) ? $arr[$new] : 0;
                }

                // // only cases: 1/2/3/4/5
                // if ($new == "scheduled")
                // {
                //     if (strlen($arr[$new]) == 1)
                //         self::toBoolean($arr, $new, $arr[$new]);
                //     else
                //         self::convertDate($arr, $new, $arr[$new]);
                // }

                // // only case: put
                // if ($new == "statusCode")
                // {
                //     $arr[$new] = !empty($arr[$new]) ? (int) $arr[$new] : 0;
                // }

                // // only case: providers
                // if ($new == "provider_id")
                // {
                //     $arr[$new] = (int) $arr[$new];
                // }
            }
        }

        return $array;
    }

    private static function toBoolean(&$arr, $key, $value)
    {
        $arr[$key] = ($value == "S") ? 1 : 0;
    }

    /**
     * Convert timestamp to date
     * 2021-10-01T00:00:00 -> 01/10/2021
     *
     * @param array $arr
     * @param string $key
     * @param string $value
     * @return void
     */
    private static function convertDate(&$arr, $key, $value)
    {
        $arr[$key] = !empty($value) ? explode(" ", $value) : "";
    }

    private static function usort(&$data)
    {
        usort($data, function($a, $b) {
            return $a["patient_id"] <= $b["patient_id"];
        });
    }
}
