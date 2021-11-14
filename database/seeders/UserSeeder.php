<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date("Y-m-d");

        User::insert([
            [
                "clinic_id"         => 1,
                "name"              => "Mateus Costa",
                "email"             => "costa.mack95@gmail.com",
                'email_verified_at' => now(),
                "password"          => Hash::make("password"),
                'remember_token'    => Str::random(10),
                "created_at"        => $timestamp,
                "updated_at"        => $timestamp
            ],
            [
                "clinic_id"         => 1,
                "name"              => "Filipe Lucas",
                "email"             => "filipeanfer@gmail.com",
                'email_verified_at' => now(),
                "password"          => Hash::make("password"),
                'remember_token'    => Str::random(10),
                "created_at"        => $timestamp,
                "updated_at"        => $timestamp
            ]
        ]);
    }
}
