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
                "name"        => "Campinas (Centro)",
                "code"        => "camp-1",
                "created_at"  => $timestamp,
                "updated_at"  => $timestamp
            ],
            [
                "name"        => "Campinas (Bosque)",
                "code"        => "camp-2",
                "created_at"  => $timestamp,
                "updated_at"  => $timestamp
            ],
            [
                "name"        => "Valinhos",
                "code"        => "vali",
                "created_at"  => $timestamp,
                "updated_at"  => $timestamp
            ]
        ]);
    }
}
