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

    public static function number_format(int $number)
    {
        return number_format($number, 2, ',', ' ');
    }

    public static function getTreatments()
    {
        return [
            "1cl" => [
                "title"       => "Clínico Geral",
                "description" => "O dentista clínico geral é o profissional da saúde capacitado na área de odontologia, entre as suas competências estão prevenção, diagnósticos e tratamento de uma ampla variedade de condições, desordens e doenças dos dentes e gengiva. O dentista clínico geral prestam serviços relacionados a manutenção de higiene oral e saúde bucal.",
                "image"       => "images/treatments/clinico.png",
            ],
            "2ci" => [
                "title"       => "Cirurgia",
                "description" => "A cirurgia é a especialidade da Medicina Dentária que inclui o diagnóstico e o tratamento cirúrgico de lesões e defeitos, incluindo tanto os aspectos funcionais como os estéticos, dos tecidos moles e duros da região maxilofacial.\nNesta especialidade são englobados tratamentos como as conhecidos extrações dentárias, mas também ósseas ( tórus e exostoses, quistos, lesões tumorais, enxertos ósseos, etc) e nos tecidos moles (remoção de fibromas, sialolitos nas glândulas salivares, epúlides gengivais, freios linguais e labias que provocam limitações na fala e maloclusão, cirurgias pré-protéticas, drenagem de abcessos e outroas).",
                "image"       => "images/treatments/cirurgia.png",
            ],
            "3or" => [
                "title"       => "Ortodontia",
                "description" => "Uma das especialidades mais conhecidas, pelas melhorias significativas que traz à vida de alguém com dentes \"tortos, fora de sítio ou encavalitados\". Assim, quando estamos perante uma criança ou adulto com alterações nas posições ou crescimento e desenvolvimento ósseo ou dentário, a ortodontia  permite-nos corrigir essas alterações, normalizar o crescimento, a função e obviamente a estética.\nTudo isto se resume a: tratamento das alterações das posições ósseas e dentárias e das relações oclusais e entre os maxilares, bem como suas implicações na função mastigatória, estética e fala.",
                "image"       => "images/treatments/ortodontia.png",
            ],
            "4im" => [
                "title"       => "Implantodontia",
                "description" => "Especialidade muito recente na reabilitação oral, a implantodontia dedica-se ao diagnóstico de implantes (peças de titânio especiais que visam substituir raizes dentárias) nas arcadas dentárias de pacientes que perderam peças dentárias.\nOs implantes são um complemento às próteses fixas e removíveis, sendo imensas as vantagens sobre a prótese tradicional sem implantes. Promovem maior estabilidade, menor necessidade de desgastes dentários, melhor higiene e maior longevidade das próteses.",
                "image"       => "images/treatments/implantodontia.png",
            ],
            "5en" => [
                "title"       => "Endodontia",
                "description" => "Endodontia é a especialidade da odontologia responsável pelo estudo da polpa dentárias, de todo o sistema de canais radiculares e dos tecidos periapicais, bem como doenças que os afligem.\nEm casos de alterações por cárie, fraturas dentárias, trauma dentário, trauma ortodôntico, lesões endoperiodontais, necessidades protéticas e outras patologias endodônticas, o tratamento endodôntico (ou o tratamento de canal) está indicado, visando a manutenção do dente na cavidade bucal, e a saúde dos tecidos periapicais.",
                "image"       => "images/treatments/endodontia.png",
            ],
            "6od" => [
                "title"       => "Odontopediatria",
                "description" => "Vertente da medcina dentária vocacionada para o tratamento das crianças e adolescentes.\nEmbora muitos dos tratamentos sejam os mesmos dos adultos, muitos há que são exclusivos destas faixas estárias e todos têm sempre particularidades inerentes às suas características físicas e psíquicas, crescimento ósseo dos maxilares e crânio, processo eruptivo dinâmico da dentição, presença de dentes de leite, menores dimensões corporais e orais, etc.",
                "image"       => "images/treatments/odontopediatria.png",
            ],
            "7pe" => [
                "title"       => "Periodontia",
                "description" => "A Periodontia especializou-se na região envolvente do dente - o periodonto, zona constituída pelas gengivas, ligamento periodontal e osso alveolar. É uma zona e importância fulcral, pois confere o suporte, estabilidade e proteção aos dentes.\nMediante o tratamento de patologias específicas desta área, como as gengivites e periodontites (que originam sangramento gengival, diminuição do tamanho da gengiva, esposição de raiz dentária, mobilidade dos dentes e por vezes perda destes) asseguramos que os dentes não só se mantêm íntegros mas também têm uma base saudável e que duram uma vida com cuidados apropriados.",
                "image"       => "images/treatments/periodontia.png",
            ],
            "8pr" => [
                "title"       => "Prótese Dental",
                "description" => "A prótese dentária (ou prótese dental) é a arte dental, ciência que lida com a reposição de tecidos bucais e dentes perdidos, visando restarua e manter a forma, função, aparência e saúde bucal.\nAplicados à odontologia, são utilizados indistintamente os termos prostodontia e prótese dentária. O termo \"prótese dentária\" também é utilizado para se referir ao artefato que se propõe a substituir a função dos dentes perdidos ou ausentes.",
                "image"       => "images/treatments/protese.png",
            ],
        ];
    }

    // public static function usort(&$data)
    // {
    //     usort($data, function($a, $b) {
    //         return $a["NROPAC"] <= $b["NROPAC"];
    //     });
    // }
}
