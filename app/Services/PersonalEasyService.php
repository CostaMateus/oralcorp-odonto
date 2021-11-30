<?php

namespace App\Services;

use Exception;
use App\Helpers\PersonalEasyHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PersonalEasyService
{

    /**
     * Consulta API segundo o metodo e os parametros passados
     *
     * @param string $method
     * @param array|null $params
     * @param string|null $code
     * @return array
     */
    private function makeRequest(string $method, array $params = null, string $code = null)
    {
        $code   = $code ?? auth()->user()->clinic->code;

        $data   = [ "Content-Type" => "application/json" ];
        $params = ($params != null) ? array_merge($data, $params) : $data;

        try
        {
            $response = Http::post(config("personaleasy.url") . "/$code/$method", $params);

            if ($response->successful() && isset($response["dados"]["ret"]))
            {
                $ret = $response["dados"]["ret"];

                if (isset($ret["tx_status"]) && ($ret["tx_status"] == "nao identificado"))
                {
                    $error    = true;
                    $msgLog   = "Unable to retrieve data";
                    $response = [
                        "code"    => 404,
                        "data"    => [],
                        "message" => $msgLog
                    ];
                }
                else
                {
                    $data     = (isset($response["dados"]["ret"][0])) ? $response["dados"]["ret"] : [ $response["dados"]["ret"] ];
                    $error    = false;
                    $msgLog   = "Success";
                    $response = [
                        "code"    => 200,
                        "data"    => $data,
                        "message" => "Success",
                    ];
                }
            }
            else if ($response->successful())
            {
                $error    = false;
                $msgLog   = "Success";
                $response = [
                    "code"    => 404,
                    "data"    => [],
                    "message" => "Success",
                ];
            }
            else
            {
                $error    = true;
                $server   = $response->serverError() ? "TRUE" : "FALSE";
                $client   = $response->clientError() ? "TRUE" : "FALSE";
                $msgLog   = "Response returned with failure - serverError:$server | clientError:$client";
                $response = [
                    "code"    => 400,
                    "data"    => [],
                    "message" => $msgLog
                ];
            }
        }
        catch (Exception $e)
        {
            $error    = true;
            $msgLog   = "Failed to connect to API";
            $response = [
                "code"    => 500,
                "data"    => [],
                "message" => $msgLog
            ];
        }

        if ($error)
        {
            $user = auth()->user();

            Log::channel("oracorp")->error("Error", [
                "user_id"     => is_null($user) ? null : $user->id,
                "external_id" => is_null($user) ? null : $user->external_id,
                "clinic_id"   => is_null($user) ? null : $user->clinic->id,
                "method"      => $method,
                "message"     => $msgLog
            ]);
        }

        return $response;
    }

    /**
     * Consulta paciente
     *
     * @param string $email
     * @param string $code
     * @return array
     */
    public function getUser(string $email, string $code)
    {
        $data = [
            "email" => $email,
        ];

        $response = $this->makeRequest("RPCGetPacienteEmail", $data, $code);

        if ($response["code"] != 200) return $response;

        PersonalEasyHelper::dataConverter("users", $response["data"]);

        return $response;
    }

    /**
     * Recupera a imagem do inicio do tratamento
     *
     * @param string|null $patient_id
     * @return array
     */
    public function getStartImage(string $patient_id = null)
    {
        $data = [
            "nropac" => $patient_id ?? auth()->user()->external_id,
        ];

        $code = auth()->user() ? auth()->user()->clinic->code : "aodonto2";

        $response = $this->makeRequest("RPCGetPacienteImagemIni", $data, $code);

        if ($response["data"]) PersonalEasyHelper::dataConverter("images", $response["data"]);

        return $response;
    }

    /**
     * Recupera a imagem do final do tratamento
     *
     * @param string|null $patient_id
     * @return array
     */
    public function getEndImage(string $patient_id = null)
    {
        $data = [
            "nropac" => $patient_id ?? auth()->user()->external_id,
        ];

        $code = auth()->user() ? auth()->user()->clinic->code : "aodonto2";

        $response = $this->makeRequest("RPCGetPacienteImagemFin", $data, $code);

        if ($response["data"]) PersonalEasyHelper::dataConverter("images", $response["data"]);

        return $response;
    }
}
