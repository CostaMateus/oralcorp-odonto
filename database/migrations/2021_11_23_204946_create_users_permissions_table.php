<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("users_permissions", function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();

            $table->integer("user_id")->unsigned()->index()
                  ->foreign()->references("id")->on("users")
                  ->onDelete("cascade");
            $table->integer("permission_id")->unsigned()->index()
                  ->foreign()->references("id")->on("permissions")
                  ->onDelete("cascade");

            // $table->unsignedInteger("user_id");
            // $table->unsignedInteger("permission_id");
            // //FOREIGN KEY CONSTRAINTS
            // $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            // $table->foreign("permission_id")->references("id")->on("permissions")->onDelete("cascade");
            // //SETTING THE PRIMARY KEYS
            // $table->primary(["user_id","permission_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("users_permissions");
    }
}
