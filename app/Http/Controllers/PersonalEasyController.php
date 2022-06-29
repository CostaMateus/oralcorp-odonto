<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Clinic;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Services\PersonalEasyService;
use App\Http\Requests\NewPasswordRequest;
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

        if (empty($login["password"]))
        {
            $tempPass = "oralcorp" . date("Y");
            $userPass = strtolower($request->password);

            if ($tempPass != $userPass) return self::redirectLogin(404);

            session([
                "external_id" => $login["external_id"],
                "clinic_id"   => $request->clinic_id,
                "email"       => $request->email,
                "phone"       => $login["phone"],
                "name"        => $login["name"],
            ]);

            return redirect("/newpass");
        }

        if ($login["password"] != $request->password) return self::redirectLogin(404);

        $user     = User::firstWhere("email", $request->email);

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
            $user->load("roles");
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

    public function newPassword(Request $request)
    {
        return view("adminlte::auth.passwords.new");
    }

    public function savePassword(NewPasswordRequest $request)
    {
        $external_id = $request->external_id;
        $clinic_id   = $request->clinic_id;
        $password    = $request->password;
        $phone       = $request->phone;
        $email       = $request->email;
        $name        = $request->name;

        $clinic      = Clinic::find($clinic_id);

        $response    = (new PersonalEasyService)->changePassword($password, $external_id, $clinic->code);

        if ($response["code"] != 200) return self::redirectLogin($response["code"]);

        $user = User::create([
            "external_id" => $external_id,
            "clinic_id"   => $clinic_id,
            "email"       => $email,
            "phone"       => $phone ?? null,
            "name"        => explode(" ", $name)[0],
            "full_name"   => $name,
            "password"    => bcrypt($password . date("H:i:s")),
        ]);

        $role = Role::where("slug", "patient")->first();

        $user->roles()->attach($role);

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
