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
        $data     = [ "email" => $email ];
        $response = $this->makeRequest("RPCGetPacienteEmail", $data, $code);

        if ($response["code"] != 200) return $response;

        PersonalEasyHelper::dataConverter("users", $response["data"]);

        return $response;
    }

    /**
     * Altera a senha do paciente
     *
     * @param string $password
     * @return array
     */
    public function changePassword(string $password)
    {
        $data = [
            "nropac" => auth()->user()->external_id,
            "ssenha" => $password
        ];

        $response = $this->makeRequest("RPCPutPswPaciente", $data);

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
        $data     = [ "nropac" => $patient_id ?? auth()->user()->external_id ];

        $response = $this->makeRequest("RPCGetPacienteImagemIni", $data);

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
        $data     = [ "nropac" => $patient_id ?? auth()->user()->external_id ];

        $response = $this->makeRequest("RPCGetPacienteImagemFin", $data);

        return $response;
    }

    /**
     * Consulta Agenda do Paciente
     *
     * @param string $email
     * @param string $code
     * @return array
     */
    public function getSchedule()
    {
        $data     = [ "nropac" => auth()->user()->external_id, ];

        $response = $this->makeRequest("RPCGetPacienteAgenda", $data);

        return $response;
    }

    public function postSchedule()
    {


    }

    /**
     * Consulta as opções de status que um agendamento pode ter
     *
     * @return void
     */
    public function getScheduleStatus()
    {
        $response = $this->makeRequest("RPCGetStatusAgenda");

        return $response;
    }

    /**
     * Altera o status de um agendamento
     *
     * @return void
     */
    public function postScheduleStatus()
    {
        $data     = [];

        $response = $this->makeRequest("RPCGetStatusAgenda", $data);

        return $response;
    }

    /**
     * Consulta Financeiro do Paciente
     *
     * @return array
     */
    public function getFinancial()
    {
        $data = [
            // funciona tanto com nropac, com email qnt sem parametro nenhum,
            // confirmar com Rogério
            // "nropac" => auth()->user()->external_id,
            // "email"  => auth()->user()->email,
        ];

        $response = $this->makeRequest("RPCGetPacienteMensalidade", $data);

        return $response;
    }

    /**
     * Consulta opções de check-in
     *
     * @return array
     */
    public function getCheckinOptions()
    {
        $response = $this->makeRequest("RPCGetBT");

        return $response;
    }

    /**
     * Efetua um check-in dado o id
     *
     * @param string $checkin
     * @return array
     */
    public function postCheckin(string $checkin)
    {
        $data     = [
            "nropac" => auth()->user()->external_id,
            "btsel"  => (int) $checkin
        ];

        $response = $this->makeRequest("RPCPutBTSel", $data);

        return $response;
    }

    /**
     * Recupera os descontos do usuário
     *
     * @return array
     */
    public function getDiscounts()
    {
        $data     = [ "nropac" => auth()->user()->external_id, ];

        $response = $this->makeRequest("RPCGetPacienteDesconto", $data);

        return $response;
    }
}
