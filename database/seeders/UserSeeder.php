<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
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
        // $timestamp = date("Y-m-d");

        $data = [
            [
                "clinic_id"         => 1,
                "name"              => "Mateus Costa",
                "email"             => "costa.mack95@gmail.com",
                'email_verified_at' => now(),
                "password"          => Hash::make("password"),
                'remember_token'    => Str::random(10),
                // "created_at"        => $timestamp,
                // "updated_at"        => $timestamp
            ],
            [
                "clinic_id"         => 1,
                "name"              => "Filipe Lucas",
                "email"             => "filipeanfer@gmail.com",
                'email_verified_at' => now(),
                "password"          => Hash::make("password"),
                'remember_token'    => Str::random(10),
                // "created_at"        => $timestamp,
                // "updated_at"        => $timestamp
            ],
        ];

        foreach ($data as $key => $u)
        {
            $user = User::create($u);

            $user->roles()->attach(Role::where("slug", "admin")->first());

            // // SET ROLE
            // $role = ($key % 2 == 0)
            //     ? Role::where("slug", "developer")->first()
            //     : Role::where("slug", "manager")->first();

            // $user->roles()->attach($role);

            // // SET PERMISSION
            // $perm = ($key % 2 == 0)
            //     ? Permission::where("slug", "create-tasks")->first()
            //     : Permission::where("slug", "edit-users")->first();

            // $user->permissions()->attach($perm);
        }
    }
}
