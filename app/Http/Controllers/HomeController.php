<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Helpers\PersonalEasyHelper;
use Illuminate\Support\Facades\Auth;
use App\Services\PersonalEasyService;

class HomeController extends Controller
{
    private $service = "";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware("auth");
        $this->service = new PersonalEasyService;
    }

    /**
     * Exibe tela inicial do sistema
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $folder_view = auth()->user()->roles()->get()->first()->slug;
        $folder_view = session("folder_view");

        return view("$folder_view.home");
    }

    /**
     * Exibe tela estática dos tratamentos ofertados
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function treatments()
    {
        $treatments = Helper::getTreatments();

        return view("patient.our_treatments", compact(["treatments"]));
    }

    /**
     * Exibe tela de opções de contato com as unidades
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contacts(Request $request)
    {
        $treatment = ($request->t) ? Helper::getTreatments()[$request->t]["title"] : "";

        return view("patient.contacts", compact(["treatment"]));
    }

    /**
     * Envia mensagem para e-mail da clínica
     *
     * @param Request $request
     *
     * @return array
     */
    public function postContacts(Request $request)
    {
        $msg  = $request->input("message");

        $mail = \Mail::to("costa.mack95@gmail.com")->send(new \App\Mail\Contact($msg));

        $response["statusText"] = "Mensagem enviada com sucesso. Aguarde o contato de nossa equipe.";

        return $response;
    }

    /**
     * Exibe tela de consultas agendadas
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function schedule()
    {
        $response     = $this->service->getSchedule();

        PersonalEasyHelper::dataConverter("schedule", $response["data"]);

        $appointments = $response["data"];

        return view("patient.schedule", compact(["appointments"]));
    }

    /**
     * Exibe tela do sorriso de antes e depois
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mySmiles()
    {
        $code      = auth()->user()->clinic->code;
        $response1 = $this->service->getStartImage();
        $response2 = $this->service->getEndImage();

        PersonalEasyHelper::dataConverter("images", $response1["data"]);
        PersonalEasyHelper::dataConverter("images", $response2["data"]);

        $startImg  = $response1["data"][0]["image"];
        $endImg    = $response2["data"][0]["image"];

        $startImg  = (is_null($startImg)) ? $startImg : "https://api.personal-ed.com.br/$code/getImagem?filename=$startImg";
        $endImg    = (is_null($endImg))   ? $endImg   : "https://api.personal-ed.com.br/$code/getImagem?filename=$endImg";

        $smile     = [
            "start" => $startImg,
            "end"   => $endImg
        ];

        return view("patient.my_smiles", compact(["smile"]));
    }

    /**
     * Exibe tela do financeiro
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function financial()
    {
        $response  = $this->service->getFinancial();

        PersonalEasyHelper::dataConverter("financial", $response["data"]);

        $financial = $response["data"];

        return view("patient.financial", compact(["financial"]));
    }

    /**
     * Exibe tela de indicação e descontos
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indicate()
    {
        $response = $this->service->getDiscounts();
        PersonalEasyHelper::dataConverter("discounts", $response["data"]);

        if (isset($response["data"][0]))
        {
            $indicate = $response["data"][0];
        }
        else
        {
            $indicate = [
                "indications_made"         => 0,
                "discounts_received"       => 0,
                "discounts_to_be_received" => 0
            ];
        }

        return view("patient.indicate", compact(["indicate"]));
    }

    /**
     * Exibe tela de check-in
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkin()
    {
        if (auth()->user()->clinic->code == "aodonto2") return redirect()->route("/");

        $response = $this->service->getCheckinOptions();
        PersonalEasyHelper::dataConverter("checkin", $response["data"]);

        // remover array_unique() caso seja resolvido os dados duplicados
        $checkins = array_unique($response["data"], SORT_REGULAR);

        return view("patient.checkin", compact(["checkins"]));
    }

    /**
     * Envia o check-in do usuário para o P.E.
     *
     * @param Request $request
     *
     * @return array
     */
    public function postCheckin(Request $request)
    {
        $response = $this->service->postCheckin($request->input("checkin"));

        PersonalEasyHelper::dataConverter("postCheckin", $response["data"]);

        return $response["data"][0];
    }

}
