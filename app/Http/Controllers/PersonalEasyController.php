<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Clinic;
use App\Helpers\Helper;
use App\Services\PersonalEasyService;
use App\Http\Requests\PersonalEasyRequest;

class PersonalEasyController extends Controller
{

    public function login(PersonalEasyRequest $request)
    {
        $clinic   = Clinic::firstWhere("id", $request->clinic_id);

        if (!$clinic) return self::redirectLogin(404);

        $service  = new PersonalEasyService;
        $response = $service->getUser($request->email, $clinic->code);

        if ($response["code"] != 200) return self::redirectLogin($response["code"]);

        $login    = reset($response["data"]);

        if ($login["password"] != $request->password) return self::redirectLogin(404);

        $user     = User::firstWhere("email", $request->email)->load("roles");

        if (!$user)
        {
            $user = User::create([
                "clinic_id"   => $clinic->id,
                "external_id" => $login["external_id"],
                "name"        => explode(" ", $login["name"])[0],
                "full_name"   => $login["name"],
                "email"       => $request->email,
                "phone"       => $login["phone"] ?? null,
                "password"    => bcrypt($request->password . date("H:i:s")),
            ]);

            $role = Role::where("slug", "patient")->first();

            $user->roles()->attach($role);
        }
        else
        {
            $user->clinic_id   = $clinic->id;
            $user->external_id = $login["external_id"];
            $user->name        = explode(" ", $login["name"])[0];
            $user->full_name   = $login["name"];
            $user->phone       = $login["phone"] ?? null;
            $user->password    = bcrypt($request->password . date("H:i:s"));
            $user->save();
        }

        if (!isset($user)) return self::redirectLogin(404);

        auth()->loginUsingId($user->id);

        session(["folder_view" => $user->roles->first()->slug]);

        return redirect("/");
    }


    private static function redirectLogin($code)
    {
        $msg = Helper::loginResponse($code);
        return redirect("/login")->withErrors([ "status" => $msg ])->withInput();
    }
}
