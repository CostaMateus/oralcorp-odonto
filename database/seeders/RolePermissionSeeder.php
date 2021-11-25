<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$data = [
            [
                "name" => "Administrador",
                "slug" => "admin",
            ],
            [
                "name" => "Colaborador",
                "slug" => "collaborator",
            ],
            [
                "name" => "Membro",
                "slug" => "member",
            ],
            [
                "name" => "Paciente",
                "slug" => "patient",
            ],
		];

        foreach ($data as $r) $user = Role::create($r);

        // // SET ROLES
        // $dev_role           = new Role();
		// $dev_role->slug     = "developer";
		// $dev_role->name     = "Front-end Developer";
		// $dev_role->save();

		// $manager_role       = new Role();
		// $manager_role->slug = "manager";
		// $manager_role->name = "Assistant Manager";
		// $manager_role->save();

        // // SET PERMISSIONS
		// $createTasks        = new Permission();
		// $createTasks->slug  = "create-tasks";
		// $createTasks->name  = "Create Tasks";
		// $createTasks->save();

		// $editUsers          = new Permission();
		// $editUsers->slug    = "edit-users";
		// $editUsers->name    = "Edit Users";
		// $editUsers->save();


        // // ROLES ATTACH PERMISSIONS
    	// $dev_permission     = Permission::where("slug", "create-tasks")->first();
		// $manager_permission = Permission::where("slug", "edit-users")->first();
		// $dev_role->permissions()->attach($dev_permission);
		// $manager_role->permissions()->attach($manager_permission);

        // // OR PERMISSIONS ATTACH ROLES
		// $dev_role           = Role::where("slug", "developer")->first();
		// $manager_role       = Role::where("slug", "manager")->first();
		// $createTasks->roles()->attach($dev_role);
		// $editUsers->roles()->attach($manager_role);
    }
}
