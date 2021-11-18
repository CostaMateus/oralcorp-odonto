<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware("auth");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view("patient.home");
    }

    public function treatments()
    {
        $treatments = [
            [
                "title"       => "Clínico Geral",
                "description" => "O dentista clínico geral é o profissional da saúde capacitado na área de odontologia, entre as suas competências estão prevenção, diagnósticos e tratamento de uma ampla variedade de condições, desordens e doenças dos dentes e gengiva. O dentista clínico geral prestam serviços relacionados a manutenção de higiene oral e saúde bucal.",
                "image"       => "images/treatments/clinico.png",
            ],[
                "title"       => "Cirurgia",
                "description" => "A cirurgia é a especialidade da Medicina Dentária que inclui o diagnóstico e o tratamento cirúrgico de lesões e defeitos, incluindo tanto os aspectos funcionais como os estéticos, dos tecidos moles e duros da região maxilofacial.\nNesta especialidade são englobados tratamentos como as conhecidos extrações dentárias, mas também ósseas ( tórus e exostoses, quistos, lesões tumorais, enxertos ósseos, etc) e nos tecidos moles (remoção de fibromas, sialolitos nas glândulas salivares, epúlides gengivais, freios linguais e labias que provocam limitações na fala e maloclusão, cirurgias pré-protéticas, drenagem de abcessos e outroas).",
                "image"       => "images/treatments/cirurgia.png",
            ],[
                "title"       => "3",
                "description" => "3",
                "image"       => "images/treatments/ortodontia.png",
            ],[
                "title"       => "4",
                "description" => "4",
                "image"       => "images/treatments/implantodontia.png",
            ],[
                "title"       => "5",
                "description" => "5",
                "image"       => "images/treatments/endodontia.png",
            ],[
                "title"       => "6",
                "description" => "6",
                "image"       => "images/treatments/odontopediatria.png",
            ],[
                "title"       => "7",
                "description" => "7",
                "image"       => "images/treatments/periodontia.png",
            ],[
                "title"       => "8",
                "description" => "8",
                "image"       => "images/treatments/protese.png",
            ],
        ];

        return view("patient.our_treatments", compact(["treatments"]));
    }

    public function contacts()
    {
        return view("patient.home");
    }

    public function schedule()
    {
        return view("patient.home");
    }

    public function mySmiles()
    {
        $data = [
            "before" => true,
            "after"  => false
        ];

        return view("patient.my_smiles", compact(["data"]));
    }

    public function financial()
    {
        return view("patient.home");
    }

    public function indicate()
    {
        return view("patient.home");
    }

    public function checkin()
    {
        return view("patient.home");
    }

}
