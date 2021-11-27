<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date("Y-m-d");

        Clinic::insert([
            [
                "name"        => "Campinas (centro)",
                "full_name"   => "Unidade 1 - Campinas (centro)",
                "code"        => "ioc",
                "address"     => "Av. Francisco Glicério, 669 – Vila Lidia, Campinas - SP 13012-100",
                "whatsapp"    => "(19) 97417-0441",
                "phone"       => "(19) 3305-5555",
                "instagram"   => "oralcorpodontologia",
                "created_at"  => $timestamp,
                "updated_at"  => $timestamp
            ],
            [
                "name"        => "Campinas",
                "full_name"   => "Unidade 2 - Campinas",
                "code"        => "aodonto2",
                "address"     => "Rua Barão de Jaguara, 352, Campinas - SP 13026-063",
                "whatsapp"    => "(19) 97417-0441",
                "phone"       => "(19) 3324-3733",
                "instagram"   => "oralcorpcampinas",
                "created_at"  => $timestamp,
                "updated_at"  => $timestamp
            ],
            [
                "name"        => "Valinhos",
                "full_name"   => "Unidade 3 - Valinhos",
                "code"        => "amodonto",
                "address"     => "Av. Independência, 705, Valinhos - SP 13276-030",
                "whatsapp"    => "(19) 97417-0441",
                "phone"       => "(19) 3869-8110",
                "instagram"   => "oralcorpvalinhos",
                "created_at"  => $timestamp,
                "updated_at"  => $timestamp
            ]
        ]);
    }
}
